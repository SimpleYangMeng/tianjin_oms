<?php

/**
 * @author william-fan
 * @todo 用于
 */
class ProductReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //海关接收回执状态变化
    private static $hgreceiveStatus = array(
        'fromStatus'=>5,
        'toStatus'=> 7
    );
    //海关审核回执状态变化
    private static $hgcheckStatus = array(
        'fromStatus'=>7,
        'toStatus'=> 1,
        'notpassStatus'=>4,
        'ztStatus'=>array(1),
        'ztToStatus'=>6,
        'qyStatus'=>array(6),
        'qyToStatus'=>1,
    );


    /**
     * @author william-fan
     * @todo 商品接收回执
     */
    public static function productReceive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        $apiMessage = Service_ApiMessage::getByField($formId);
        if(empty($apiMessage)){
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }
        $row = Service_Product::getByFieldLock($apiMessage['ref_id']); //获取商品信息
        $fromStatus = self::$hgreceiveStatus['fromStatus'];
        $toStatus = self::$hgreceiveStatus['toStatus'];
        if($row['customs_status'] == $fromStatus){
            //try {
                switch($bodyRow['feedback_flag']){
                    case '01':
                        $productStatus = $toStatus; //海关已接收
                        break;
                    case '02':
                        //$productStatus = 7; //海关退单
                        break;
                    default:
                }
                if(isset($productStatus) && $productStatus==$toStatus){
                    //审核通过
                    $updateRow = array(
                        'customs_status'      => $toStatus,
                        'product_update_time' => date('Y-m-d H:i:s', time()),
                    );
                    if (!Service_Product::update($updateRow, $apiMessage['ref_id'])) {
                        throw new Exception("商品[{$row['registerID']}]更新失败");
                    }else{
                        //添加日志
                        $logRow = array(
                            'product_id'=>$apiMessage['ref_id'],
                            'pl_type'=>'2',
                            'user_id'=>'0',
                            'pl_statu_pre'=>$row['product_status'],
                            'pl_statu_now'=>0,
                            'pl_note'=>'接收海关回执',
                            'pl_ip' => Common_Common::getIP(),
                            'pl_add_time'=>$time
                        );
                        if(!Service_ProductLog::add($logRow)){
                            throw new Exception("商品[{$row['registerID']}]日志创建失败");
                        }
                    }
                }
                //退单的添加产品日志
                if($bodyRow['feedback_flag']=='02'){
                    $updateRow = array(
                        'customs_status'      => '4',
                        'product_status'=>'0',
                        'product_update_time' => date('Y-m-d H:i:s', time()),
                    );
                    if (!Service_Product::update($updateRow, $apiMessage['ref_id'])) {
                        throw new Exception("商品[{$row['registerID']}]更新状态失败");
                    }else{
                        $logRow = array(
                            'product_id'=>$apiMessage['ref_id'],
                            'pl_type'=>'2',
                            'user_id'=>'0',
                            'pl_statu_pre'=>$row['product_status'],
                            'pl_statu_now'=>$row['product_status'],
                            'pl_note'=>'海关接收退单',
                            'pl_ip' => Common_Common::getIP(),
                            'pl_add_time'=>$time
                        );
                        if(!Service_ProductLog::add($logRow)){
                            throw new Exception("商品[{$row['registerID']}]日志创建失败");
                        }
                    }
                }
                self::$return['ask'] = 1;
                self::$return['message'] = "商品[{$row['registerID']}]接收回执：队列处理成功";
            /* } catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            } */
        } else{
            throw new Exception('商品['.$row['registerID'].']未到[已发送海关]流程');
            //self::$return['error'] = '商品['.$row['registerID'].']未到[已发送海关]流程';
        }
        return self::$return;
    }
    /**
     * @author william-fan
     * @todo 用于处理商品审核回执
     */
    public static function productCheck(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        $apiMessage = Service_ApiMessage::getByField($formId);
        if(empty($apiMessage)){
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }
        $row = Service_Product::getByFieldLock($apiMessage['ref_id']); //获取商品信息
        $fromStatus = self::$hgcheckStatus['fromStatus'];
        $toStatus = self::$hgcheckStatus['toStatus'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
        $stopStatus = self::$hgcheckStatus['ztToStatus'];
        
        switch($bodyRow['feedback_flag']){
            case '03':
                $productStatus = $toStatus; //海关审核
                if($row['customs_status'] == $fromStatus){
                    //var_dump(isset($productStatus) && $productStatus==$toStatus);
                    if(isset($productStatus) && $productStatus==$toStatus){
                        //审核通过
                        $updateRow = array(
                            'customs_status'=>$toStatus,
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                        );
                        $productStatus = '1';//商品可用
                        if ($row['ciq_status'] == '3') {
                            $updateRow['product_status'] = $productStatus;
                        }
                        if(!Service_Product::update($updateRow,$row['product_id'])){
                            throw new Exception('商品更新失败');
                        }else{
                            //添加日志
                            $logRow = array(
                                'product_id'=>$row['product_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>$productStatus,
                                'pl_note'=>'接收海关审核回执',
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception('订单日志创建失败');
                            }
                        }
                    }
                    //退单的添加产品日志
                    if($bodyRow['feedback_flag']==$notpassStatus){
                        $updateRow = array(
                            'customs_status'=>$notpassStatus,
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                            'product_status'=>'0'
                        );
                        if(!Service_Product::update($updateRow,$row['product_id'])){
                            throw new Exception("商品[{$row['registerID']}]更新状态失败");
                        }else{
                            $logRow = array(
                                'product_id'=>$row['product_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>$row['product_status'],
                                'pl_note'=>'海关接收退单',
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception("商品[{$row['registerID']}]日志创建失败");
                            }
                        }
                    }
                    self::$return['ask'] = 1;
                    self::$return['message'] = "商品[{$row['registerID']}]接收回执：队列处理成功";
                } else{
                    throw new Exception("商品[{$row['registerID']}]未到到[海关已接收]流程");
                    //self::$return['error'] = "商品[{$row['registerID']}]未到到[海关已接收]流程";
                }
                break;
            case '04':
                $productStatus = $notpassStatus; //海关审核不通过
                if($row['customs_status'] == $fromStatus){
                    $updateRow = array(
                        'customs_status'=>$productStatus,
                        'product_update_time'=>date('Y-m-d H:i:s',time()),
                        'product_status'=>'0'
                    );
                    if(!Service_Product::update($updateRow,$row['product_id'])){
                        throw new Exception("商品[{$row['registerID']}]更新状态失败");
                    }else{
                        $logRow = array(
                            'product_id'=>$row['product_id'],
                            'pl_type'=>'2',
                            'user_id'=>'0',
                            'pl_statu_pre'=>$row['product_status'],
                            'pl_statu_now'=>$row['product_status'],
                            'pl_note'=>'海关审核不通过',
                            'pl_ip' => Common_Common::getIP(),
                            'pl_add_time'=>$time
                        );
                        if(!Service_ProductLog::add($logRow)){
                            throw new Exception("商品[{$row['registerID']}]日志创建失败");
                        }
                    }
                }
                break;
            case '05':
                $productStatus = $stopStatus; //海关暂停
                if(in_array($row['customs_status'],self::$hgcheckStatus['ztStatus'])){
                    $updateRow = array(
                        'customs_status'=>$productStatus,
                        'product_update_time'=>date('Y-m-d H:i:s',time()),
                        'product_status'=>'0'
                    );
                    if(!Service_Product::update($updateRow,$row['product_id'])){
                        throw new Exception("商品[{$row['registerID']}]更新状态失败");
                    }else{
                        $logRow = array(
                            'product_id'=>$row['product_id'],
                            'pl_type'=>'2',
                            'user_id'=>'0',
                            'pl_statu_pre'=>$row['product_status'],
                            'pl_statu_now'=>$row['product_status'],
                            'pl_note'=>'海关暂停商品',
                            'pl_ip' => Common_Common::getIP(),
                            'pl_add_time'=>$time
                        );
                        if(!Service_ProductLog::add($logRow)){
                            throw new Exception("商品[{$row['registerID']}]日志创建失败");
                        }
                    }
                }else{
                    throw new Exception("商品[{$row['registerID']}]未审核,无法接收暂停");
                }
                break;
            case '08':
                $productStatus = $toStatus; //海关恢复使用商品
                if(in_array($row['customs_status'],self::$hgcheckStatus['qyStatus'])){
                    $updateRow = array(
                        'customs_status'=>$productStatus,
                        'product_update_time'=>date('Y-m-d H:i:s',time()),
                    );
                    $productStatus = '1';//商品可用
                    if ($row['ciq_status'] == '3') {
                        $updateRow['product_status'] = $productStatus;
                    }
                    if(!Service_Product::update($updateRow,$row['product_id'])){
                        throw new Exception("商品[{$row['registerID']}]更新状态失败");
                    }else{
                        $logRow = array(
                            'product_id'=>$row['product_id'],
                            'pl_type'=>'2',
                            'user_id'=>'0',
                            'pl_statu_pre'=>$row['product_status'],
                            'pl_statu_now'=>$row['product_status'],
                            'pl_note'=>'海关暂停商品',
                            'pl_ip' => Common_Common::getIP(),
                            'pl_add_time'=>$time
                        );
                        if(!Service_ProductLog::add($logRow)){
                            throw new Exception("商品[{$row['registerID']}]日志创建失败");
                        }
                    }
                }else{
                    throw new Exception("商品[{$row['registerID']}]未审核,无法接收暂停");
                }
                break;
            default:
        }
        self::$return['ask'] = 1;
        return self::$return;
    }
}
