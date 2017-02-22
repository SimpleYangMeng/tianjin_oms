<?php

/**
 * @author
 * @todo 用于货物清单处理回执
 */
class GoodsListReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => '',
    );
    //海关接收回执状态变化
    private static $hgreceiveStatus = array(
        'fromStatus'=>'3',//已发送海关
        'toStatus'=> '5'//海关已接收
    );
    //海关审核回执状态变化
    private static $hgcheckStatus = array(
        'fromStatus'=>'5',//海关已接收
        'toStatus'=> '6',//海关已审核
        'notpassStatus'=>'7',//审核不通过
        'dispatchedStatus'=>'8'//布控
    );
    //海关布控指令
    private static $hgbkStatus = array(
        'fromStatus' => array(5,6),//可以接受布控指令
        'toStatus'=>'8',//布控
    );
    //海关解控
    private static $hgjkStatus = array(
        'fromStatus' =>'8',//可以接受布控指令
        'toStatus'=>'6',//海关已审核
    );


    /**
     * @author william-fan
     * @todo 物品清单接收回执
     */
    public static function goodsListReceive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        /*$apiMessage = Service_ApiMessage::getByField($formId);
        var_dump($apiMessage);
        if(empty($apiMessage)){
            //throw new Exception("队列消息体{$formId}不存在");
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }else{
        }*/
        $row = Service_GoodsList::getByField($formId,'gl_code'); //获取物品清单信息
        if(empty($row)){
            throw new Exception("物品清单{$bodyRow['form_id']}不存在");
        }
        $fromStatus = self::$hgreceiveStatus['fromStatus'];
        $toStatus = self::$hgreceiveStatus['toStatus'];

        if(($row['status']) == $fromStatus){
            //try {
                switch($bodyRow['feedback_flag']){
                    case '01':
                        $itemStatus = $toStatus; //海关已接收
                        break;
                    case '02':
                        //$productStatus = 7; //海关退单
                        break;
                    default:
                }

                if(isset($itemStatus) && $itemStatus==$toStatus){
                    //审核通过
                    $updateRow = array(
                        'status'=>$toStatus,
                        'gl_update_time'=>date('Y-m-d H:i:s',time()),
                    );
                    if(!Service_GoodsList::update($updateRow,$row['gl_id'])){
                        throw new Exception('货物清单更新失败');
                    }else{
                        //添加日志
                        $logRow = array(
                            'gl_id'=>$row['pim_id'],
                            'gl_code'=> $row['pim_code'],
                            'gl_status_from'=>$row['status'],
                            'gl_status_to'=>$itemStatus,
                            'gll_add_time'=>$time,
                            'user_id'=>'0',
                            'gll_comments'=>'接收货物清单回执:'.$bodyRow['feedback_mess'],
                            'gll_ip' => Common_Common::getIP(),
                        );
                        if(!Service_GoodsListLog::add($logRow)){
                            throw new Exception('货物清单日志创建失败！');
                        }
                    }
                }
                //退单的添加产品日志
                if($bodyRow['feedback_flag']=='02'){
                    $logRow = array(
                        'gl_id'=>$row['gl_id'],
                        'gl_code'=> $row['gl_code'],
                        'gl_status_from'=>$row['status'],
                        'gl_status_to'=>$row['status'],
                        'gll_add_time'=>$time,
                        'user_id'=>'0',
                        'gll_comments'=>'接收货物清单回执退单:'.$bodyRow['feedback_mess'],
                        'gll_ip' => Common_Common::getIP(),
                    );
                    $logResult = Service_GoodsListLog::add($logRow);
                    if(!$logResult){
                        throw new Exception('货物清单日志创建失败！');
                    }
                }
                self::$return['ask'] = 1;
                self::$return['message'] = '货物清单接收回执：队列处理成功！';
            /*} catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }*/
        } else{
            throw new Exception('该货物清单还没走到[已发送海关]流程！');
            self::$return['error'] = '该货物清单还没走到[已发送海关]流程！';
        }
        return self::$return;
    }
    /**
     * @author william-fan
     * @todo 用于处理物品清单审核回执
     */
    public static function GoodsListCheck(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        /*$apiMessage = Service_ApiMessage::getByField($formId);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$formId}不存在");
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }*/
        $row = Service_GoodsList::getByField($formId,'gl_code'); //获取物品清单信息
        if(empty($row)){
            throw new Exception("货物清单{$bodyRow['form_id']}不存在");
        }
        $fromStatus = self::$hgcheckStatus['fromStatus'];
        $toStatus = self::$hgcheckStatus['toStatus'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
        $dispatchedStatus = self::$hgcheckStatus['dispatchedStatus'];
        $personProduct = array(
            'gl_id'=>$row['gl_id'],
        );
        $products = Service_GoodsListDetail::getByCondition($personProduct,'*');
        if($row['status'] == $fromStatus){
            //try {
                switch($bodyRow['feedback_flag']){
                    case '03':
                        $productStatus = $toStatus; //海关审核
                        break;
                    case '04':
                        $productStatus = $notpassStatus; //海关审核不通过
                        break;
                    default:
                }
                if(isset($productStatus) && $productStatus==$toStatus){
                    //审核通过
                    $updateRow = array(
                        'status'=>$toStatus,
                        'gl_update_time'=>date('Y-m-d H:i:s',time()),
                    );
                    if(!Service_GoodsList::update($updateRow,$row['pim_id'])){
                        throw new Exception('货品清单更新失败');
                    }else{
                        //添加日志
                        $logRow = array(
                            'gl_id'=>$row['pim_id'],
                            'gl_code'=>$row['pim_code'],
                            'gl_status_from'=>$row['status'],
                            'gl_status_to'=>$productStatus,
                            'gl_add_time'=>$time,
                            'user_id'=>'0',
                            'gll_comments'=>'接收海关审核回执:'.$bodyRow['feedback_mess'],
                            'gll_ip' => Common_Common::getIP(),
                        );
                        if(!Service_GoodsListLog::add($logRow)){
                            throw new Exception('货品清单日志创建失败！');
                        }
                        //操作库存(审核通过不变，载货单时扣减)
                    }
                }
                $warehouseCondition = array(
                    'customer_code'=>$row['agent_customer_code'],
                    'ie_type'=>'E',
                    'customs_code'=>$row['declare_ie_port'],
                );
                $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
                $ems_no =''; //电子账册号
                if(!empty($warehouse)){
                    $ems_no = $warehouse[0]['warehouse_code'];
                }

                //退单的添加产品日志
                if($bodyRow['feedback_flag']==$notpassStatus){
                    $logRow = array(
                        'gl_id'=>$row['pim_id'],
                        'gl_code'=>$row['pim_code'],
                        'gl_status_from'=>$row['status'],
                        'gl_status_to'=>$productStatus,
                        'gl_add_time'=>$time,
                        'user_id'=>'0',
                        'gll_comments'=>'接收海关审核回执:'.$bodyRow['feedback_mess'],
                        'gll_ip' => Common_Common::getIP(),
                    );
                    if(!Service_GoodsListLog::add($logRow)){
                        throw new Exception('日志创建失败！');
                    }/*else{

                        $warehouseCondition = array(
                            'customer_code'=>$row['agent_customer_code'],
                            'ie_type'=>'I',
                            'customs_code'=>$row['declare_ie_port'],
                        );
                        $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
                        $ems_no =''; //电子账册号
                        if(!empty($warehouse)){
                            $ems_no = $warehouse[0]['warehouse_code'];
                        }

                        $productInventoryObj = new Service_ProductInventoryProcess();
                        foreach($products as $key=>$val){
                            $param = array(
                                'operationType'=>3,//物品清单审核失败
                                'quantity'=>$val['g_qty'],
                                'goodsId'=>$val['goods_id'],
                                'warehouseCode'=>$ems_no,
                                'note'=>'货品清单审核失败:'.$bodyRow['feedback_mess'],
                            );
                            $result = $productInventoryObj->update($param);
                            if($result['state']=='0'){
                                throw new Exception('库存更新失败'.$result['message']);
                            }
                        }
                    }*/
                }
                self::$return['ask'] = 1;
                self::$return['message'] = '货品清单审核回执：队列处理成功！';
            /*} catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }*/
        } else{
            throw new Exception('该货物清单还没走到[海关已接受]流程！');
            //self::$return['error'] = ;
        }
        return self::$return;
    }
}
