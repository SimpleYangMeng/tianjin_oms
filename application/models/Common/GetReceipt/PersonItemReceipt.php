<?php

/**
 * @author william-fan
 * @todo 用于个人物品清单处理回执
 */
class PersonItemReceipt
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
        'fromStatus'=>array('5','8'),//海关已接收
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
        'notpassStatus'=>'7',//解控不通过
    );

    //清单作废
    private static $voidStatus = array(
        'fromStatus' => array('5', '6','8'),
        'toStatus'=> '4',
    );

    //商检状态
    private static $sjStatus = array(
        'haveSendStatus'=>'3',//已发送
        'havereceiveStatus'=>'5',//已接收
        'haveCheckStatus'=>'6',//已审核
        'notpassStatus'=>'7'//审核不通过
    );
    //总的状态
    private static $status = array(
        'haveCheckStatus'=>'6',
        'notpassStatus'=>'7',
    );


    /**
     * @author william-fan
     * @todo 物品清单接收回执
     */
    public static function personItemReceive(array $bodyRow, array $headRow)
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
        $row = Service_PersonItem::getByField($formId,'pim_code'); //获取物品清单信息
        if(empty($row)){
            throw new Exception("物品清单{$bodyRow['form_id']}不存在");
        }
        $fromStatus = self::$hgreceiveStatus['fromStatus'];
        $toStatus = self::$hgreceiveStatus['toStatus'];
        $row = Service_PersonItem::getByFieldLock($row['pim_id'],'pim_id');

        if(($row['customs_status']) == $fromStatus){
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
                        'customs_status'=>$toStatus,
                        'pim_update_time'=>date('Y-m-d H:i:s',time()),
                    );
                    if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                        throw new Exception('个人物品清单更新失败');
                    }else{
                        //添加日志
                        $logRow = array(
                            'pim_id'=>$row['pim_id'],
                            'pim_code'=> $row['pim_code'],
                            'pim_status_from'=>$row['customs_status'],
                            'pim_status_to'=>$itemStatus,
                            'pil_add_time'=>$time,
                            'user_id'=>'0',
                            'pil_comments'=>'接收个人物品清单回执:'.$bodyRow['feedback_mess'],
                            'pil_ip' => Common_Common::getIP(),
                        );
                        if(!Service_PersonItemLog::add($logRow)){
                            throw new Exception('个人物品清单日志创建失败！');
                        }
                    }
                }
                //退单的添加产品日志
                if($bodyRow['feedback_flag']=='02'){
                    $toStatus = self::$hgcheckStatus['notpassStatus'];
                    $updateRow = array(
                        'customs_status'=>$toStatus,
                        'status'=>'7',//退单整单审核不通过
                        'pim_update_time'=>date('Y-m-d H:i:s',time()),
                    );
                    if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                        throw new Exception('个人物品清单更新失败');
                    }
                    $logRow = array(
                        'pim_id'=>$row['pim_id'],
                        'pim_code'=> $row['pim_code'],
                        'pim_status_from'=>$row['customs_status'],
                        'pim_status_to'=>$toStatus,
                        'pil_add_time'=>$time,
                        'user_id'=>'0',
                        'pil_comments'=>'接收个人物品清单回执退单:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    $logResult = Service_PersonItemLog::add($logRow);
                    if(!$logResult){
                        throw new Exception('个人物品清单日志创建失败！');
                    }
                    //更新三单
                    $orderRow = array(
                        'order_status'=>'2',
                        'update_time'=>date("Y-m-d H:i:s",time()),
                    );
                    if(!Service_Orders::update($orderRow,$row['order_code'],'order_code')){
                        throw new Exception('更新订单异常失败');
                    }else{
                        $order = Service_Orders::getByField($row['order_code'],'order_code');
                        if(!empty($order)){
                            //日志
                            $orderLogRow = array(
                                "order_id"          => $order['order_id'],
                                "order_code"        => $order['order_code'],
                                "ol_add_time"       => $time,
                                "user_id"           => '0',
                                "ol_ip"             => Common_Common::getIP(),
                                "ol_comments"       => '物品清单退单:订单回退异常',
                                "account_name"      => '',
                                'order_status_from' => 4,
                                'order_status_to'   => 2,
                            );
                            if (Service_OrderLog::add($orderLogRow) == false) {
                                throw new Exception("订单日志创建失败！");
                            }
                        }else{
                            throw new Exception("订单数据为空");
                        }
                    }
                    $waybillRow = array(
                        'app_status'=>'3',
                        'update_time'=>date("Y-m-d H:i:s",time()),
                    );
                    if(!Service_Waybill::update($waybillRow,$row['wb_code'],'wb_code')){
                        throw new Exception('更新运单异常失败');
                    }else{
                        //日志
                        $waybill = Service_Waybill::getByField($row['wb_code'],'wb_code');
                        if(!empty($waybill)){
                            $wblData = array(
                                'wb_id' => $waybill['wb_id'],
                                'wb_code' => $waybill['wb_code'],
                                'wb_status_from' => 5,
                                'wb_status_to' => 3,
                                'wb_add_time' => date('Y-m-d H:i:s',time()),
                                'user_id' => '0',
                                'wb_ip' => Common_Common::getRealIp(),
                                'wb_comments' => '运单退回异常',
                                'account_name' => '',
                            );
                            if(!Service_WaybillLog::add($wblData)){
                                throw new Exception('运单日志更新失败');
                            }
                        }else{
                            throw new Exception('运单数据为空');
                        }
                    }
                    $payRow = array(
                        'app_status'=>'3',
                        'update_time'=>date("Y-m-d H:i:s",time()),
                    );
                    if(!Service_PayOrder::update($payRow,$row['po_code'],'po_code')){
                        throw new Exception('更新支付单异常失败');
                    }else{
                        //日志
                        $poRow = Service_PayOrder::getByField($row['po_code'],'po_code');
                        $polData = array(
                            'po_id' => $poRow['po_id'],
                            'po_code' => $poRow['po_code'],
                            'pl_add_time' => date("Y-m-d H:i:s",time()),
                            'user_id' => 0,
                            'pl_ip' => Common_Common::getRealIp(),
                            'pl_comments' => '物品清单退单:订单回退异常',
                            'account_name' =>''
                        );
                        $polId = Service_PayOrderLog::add($polData);
                        if(!$polId){
                            throw new Exception("支付单日志写入异常", 501);
                        }
                    }

                    $warehouseCondition = array(
                        'customer_code'=>$row['agent_customer_code'],
                        'ie_type'=>'I',
						'warehouse_status'=>'5',
                    );
                    $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
                    $ems_no =''; //电子账册号
                    if(!empty($warehouse)){
                        $ems_no = $warehouse[0]['warehouse_code'];
                    }
                    $personProduct = array(
                        'pim_id'=>$row['pim_id'],
                    );
                    $products = Service_PersonItemProduct::getByCondition($personProduct,'*');
                    $productInventoryObj = new Service_ProductInventoryProcess();
                    foreach($products as $key=>$val){
                        $param = array(
                            'operationType'=>3,//物品清单审核失败
                            'quantity'=>$val['g_qty'],
                            'goodsId'=>$val['goods_id'],
                            'warehouseCode'=>$ems_no,
                            'note'=>'物品清单审核失败:'.$bodyRow['feedback_mess'],
                        );
                        $result = $productInventoryObj->update($param);
                        if($result['state']=='0'){
                            throw new Exception('库存更新失败:'.$result['message']['errorMse']);
                        }
                    }
                }
                self::$return['ask'] = 1;
                self::$return['message'] = '个人物品清单接收回执：队列处理成功！';
            /*} catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }*/
        } else{
            throw new Exception('该物品清单还没走到[已发送海关]流程！');
            self::$return['error'] = '该物品清单还没走到[已发送海关]流程！';
        }
        return self::$return;
    }
    /**
     * @author william-fan
     * @todo 用于处理物品清单审核回执
     */
    public static function personItemCheck(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        /*$apiMessage = Service_ApiMessage::getByField($formId);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$formId}不存在");
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }*/
        $row = Service_PersonItem::getByField($formId,'pim_code'); //获取物品清单信息
        if(empty($row)){
            throw new Exception("物品清单{$bodyRow['form_id']}不存在");
        }
        $row = Service_PersonItem::getByFieldLock($row['pim_id'],'pim_id');
        $fromStatus = self::$hgcheckStatus['fromStatus'];
        $toStatus = self::$hgcheckStatus['toStatus'];
        $notpassStatus = self::$hgcheckStatus['notpassStatus'];
        $dispatchedStatus = self::$hgcheckStatus['dispatchedStatus'];
        $personProduct = array(
            'pim_id'=>$row['pim_id'],
        );
        $products = Service_PersonItemProduct::getByCondition($personProduct,'*');
        if(in_array($row['customs_status'],$fromStatus) ){
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
                    //布控发审核通过回执直接忽略
                    if($row['customs_status']!=self::$hgbkStatus['toStatus']){
//审核通过
                        $updateRow = array(
                            'customs_status'=>$toStatus,
                            'pim_update_time'=>date('Y-m-d H:i:s',time()),
                        );
                        $status = self::$status['haveCheckStatus'];
                        if($row['ciq_status'] == self::$sjStatus['haveCheckStatus']){
                            $updateRow['status'] = $status;
                        }
                        if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                            throw new Exception('物品清单更新失败');
                        }else{
                            //添加日志
                            $logRow = array(
                                'pim_id'=>$row['pim_id'],
                                'pim_code'=>$row['pim_code'],
                                'pim_status_from'=>$row['customs_status'],
                                'pim_status_to'=>$productStatus,
                                'pil_add_time'=>$time,
                                'user_id'=>'0',
                                'pil_comments'=>'接收海关审核回执:'.$bodyRow['feedback_mess'],
                                'pil_ip' => Common_Common::getIP(),
                            );
                            if(!Service_PersonItemLog::add($logRow)){
                                throw new Exception('物品清单日志创建失败！');
                            }
                            //操作库存(审核通过不变，载货单时扣减)
                        }
                    }
                }
                $warehouseCondition = array(
                    'customer_code'=>$row['agent_customer_code'],
                    'ie_type'=>'I',
					'warehouse_status'=>'5',
                );
                $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
                $ems_no =''; //电子账册号
                if(!empty($warehouse)){
                    $ems_no = $warehouse[0]['warehouse_code'];
                }

                //退单的添加产品日志
                if(isset($productStatus) && $productStatus==$notpassStatus){
                    $logRow = array(
                        'pim_id'=>$row['pim_id'],
                        'pim_code'=>$row['pim_code'],
                        'pim_status_from'=>$row['customs_status'],
                        'pim_status_to'=>$productStatus,
                        'pil_add_time'=>$time,
                        'user_id'=>'0',
                        'pil_comments'=>'接收海关审核回执:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    if(!Service_PersonItemLog::add($logRow)){
                        throw new Exception('日志创建失败！');
                    }else{
                        $updateRow = array(
                            'customs_status'=>$notpassStatus,
                            'pim_update_time'=>date('Y-m-d H:i:s',time()),
                        );
                        $updateRow['status'] = self::$status['notpassStatus'];
                        if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                            throw new Exception('物品清单更新失败');
                        }
                        //更新三单
                        /*$orderRow = array(
                            'order_status'=>'2',
                            'update_time'=>date("Y-m-d H:i:s",time()),
                        );
                        if(!Service_Orders::update($orderRow,$row['order_code'],'order_code')){
                            throw new Exception('更新订单异常失败');
                        }else{
                            //日志
                        	$order = Service_Orders::getByField($row['order_code'],'order_code');
                        	if(!empty($order)){
                        		//日志
                        		$orderLogRow = array(
                        				"order_id"          => $order['order_id'],
                        				"order_code"        => $order['order_code'],
                        				"ol_add_time"       => $time,
                        				"user_id"           => '-1',
                        				"ol_ip"             => Common_Common::getIP(),
                        				"ol_comments"       => '物品清单退单:订单回退异常',
                        				"account_name"      => '',
                        				'order_status_from' => 4,
                        				'order_status_to'   => 2,
                        		);
                        		if (Service_OrderLog::add($orderLogRow) == false) {
                        			throw new Exception("订单日志创建失败！");
                        		}
                        	}else{
                        		throw new Exception("订单数据为空");
                        	}
                        }
                        $waybillRow = array(
                            'app_status'=>'3',
                            'update_time'=>date("Y-m-d H:i:s",time()),
                        );
                        if(!Service_Waybill::update($waybillRow,$row['wb_code'],'wb_code')){
                            throw new Exception('更新运单异常失败');
                        }else{
                            //日志
                        	$waybill = Service_Waybill::getByField($row['wb_code'],'wb_code');
                        	if(!empty($waybill)){
                        		$wblData = array(
                        				'wb_id' => $waybill['wb_id'],
                        				'wb_code' => $waybill['wb_code'],
                        				'wb_status_from' => 5,
                        				'wb_status_to' => 3,
                        				'wb_add_time' => date('Y-m-d H:i:s',time()),
                        				'user_id' => 0,
                        				'wb_ip' => Common_Common::getRealIp(),
                        				'wb_comments' => '运单退回异常',
                        				'account_name' => '',
                        		);
                        		if(!Service_WaybillLog::add($wblData)){
                        			throw new Exception('运单日志更新失败');
                        		}
                        	}else{
                        		throw new Exception('运单数据为空');
                        	}

                        }
                        $payRow = array(
                            'app_status'=>'3',
                            'update_time'=>date("Y-m-d H:i:s",time()),
                        );
                        if(!Service_PayOrder::update($payRow,$row['po_code'],'po_code')){
                            throw new Exception('更新支付单异常失败');
                        }else{
                            //日志
                        	$poRow = Service_PayOrder::getByField($row['po_code'],'po_code');
                        	$polData = array(
                        			'po_id' => $poRow['po_id'],
                        			'po_code' => $poRow['po_code'],
                        			'pl_add_time' => date("Y-m-d H:i:s",time()),
                        			'user_id' => 0,
                        			'pl_ip' => Common_Common::getRealIp(),
                        			'pl_comments' => '物品清单退单:订单回退异常',
                        			'account_name' =>''
                        	);
                        	$polId = Service_PayOrderLog::add($polData);
                        	if(!$polId){
                        		throw new Exception("支付单日志写入异常", 501);
                        	}
                        }*/


                        /* $warehouseCondition = array(
                            'customer_code'=>$row['agent_customer_code'],
                            'ie_type'=>'I',
                            'customs_code'=>$row['declare_ie_port'],
                        );
                        $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
                        $ems_no =''; //电子账册号
                        if(!empty($warehouse)){
                            $ems_no = $warehouse[0]['warehouse_code'];
                        } */
                        $personProduct = array(
                            'pim_id'=>$row['pim_id'],
                        );
                        $products = Service_PersonItemProduct::getByCondition($personProduct,'*');
                        $productInventoryObj = new Service_ProductInventoryProcess();
                        foreach($products as $key=>$val){
                            $param = array(
                                'operationType'=>3,//物品清单审核失败
                                'quantity'=>$val['g_qty'],
                                'goodsId'=>$val['goods_id'],
                                'warehouseCode'=>$ems_no,
                                'note'=>'物品清单审核失败:'.$bodyRow['feedback_mess'],
                            );
                            $result = $productInventoryObj->update($param);
                            if($result['state']=='0'){
                                throw new Exception('库存更新失败:'.$result['message']['errorMse']);
                            }
                        }
                    }
                }
                self::$return['ask'] = 1;
                self::$return['message'] = '物品清单审核回执：队列处理成功！';
            /*} catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }*/
        } else{
            throw new Exception('该物品清单还没走到[海关已接收]流程！');
            //self::$return['error'] = ;
        }
        return self::$return;
    }

    /**
     * @author william-fan
     * @todo 用于处理布控
     */
    public static function personItemBukong(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        $row = Service_PersonItem::getByField($formId,'pim_code'); //获取物品清单信息
        if(empty($row)){
            throw new Exception("物品清单{$bodyRow['form_id']}不存在");
        }
        $row = Service_PersonItem::getByFieldLock($row['pim_id'],'pim_id');
        $fromStatus = self::$hgbkStatus['fromStatus'];
        $toStatus = self::$hgbkStatus['toStatus'];
        /*$personProduct = array(
            'pim_id'=>$row['pim_id'],
        );*/
        //$products = Service_PersonItemProduct::getByCondition($personProduct,'*');
        if(in_array($row['customs_status'],$fromStatus) ){
            //try {
            switch($bodyRow['feedback_flag']){
                case '01':
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
                    'customs_status'=>$toStatus,
                    'pim_update_time'=>date('Y-m-d H:i:s',time()),
                );
                if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                    throw new Exception('物品清单更新失败');
                }else{
                    //添加日志
                    $logRow = array(
                        'pim_id'=>$row['pim_id'],
                        'pim_code'=>$row['pim_code'],
                        'pim_status_from'=>$row['customs_status'],
                        'pim_status_to'=>$productStatus,
                        'pil_add_time'=>$time,
                        'user_id'=>'0',
                        'pil_comments'=>'接收海关布控回执:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    if(!Service_PersonItemLog::add($logRow)){
                        throw new Exception('物品清单日志创建失败！');
                    }
                }
            }

            //审核不通过
            if(isset($productStatus) && $productStatus == $notpassStatus){
                //审核通过
                $updateRow = array(
                    //总状态审核不通过
                    'status' => self::$status['notpassStatus'],
                    'customs_status' => $notpassStatus,
                    'pim_update_time' => date('Y-m-d H:i:s',time()),
                );
                if(!Service_PersonItem::update($updateRow, $row['pim_id'])){
                    throw new Exception('物品清单更新失败');
                }else{
                    //添加日志
                    $logRow = array(
                        'pim_id'=>$row['pim_id'],
                        'pim_code'=>$row['pim_code'],
                        'pim_status_from'=>$row['status'],
                        'pim_status_to'=>$productStatus,
                        'pil_add_time'=>$time,
                        'user_id'=>'0',
                        'pil_comments'=>'接收海关布控回执:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    if(!Service_PersonItemLog::add($logRow)){
                        throw new Exception('物品清单日志创建失败！');
                    }
                }
            }
            
            /*$warehouseCondition = array(
                'customer_code'=>$row['agent_customer_code'],
                'ie_type'=>'I',
                'customs_code'=>$row['declare_ie_port'],
            );
            $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
            $ems_no =''; //电子账册号
            if(!empty($warehouse)){
                $ems_no = $warehouse[0]['warehouse_code'];
            }*/
            self::$return['ask'] = 1;
            self::$return['message'] = '物品清单布控回执：队列处理成功！';
            /*} catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }*/
        } else{
            throw new Exception('该物品清单还没走到[海关已接收、海关审核]流程！');
            //self::$return['error'] = ;
        }
        return self::$return;
    }

    /**
     * @author william-fan
     * @todo 处理解控
     */
    public static function personItemjiekong(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];

        $row = Service_PersonItem::getByField($formId,'pim_code'); //获取物品清单信息
        if(empty($row)){
            throw new Exception("物品清单{$bodyRow['form_id']}不存在");
        }
        $row = Service_PersonItem::getByFieldLock($row['pim_id'],'pim_id');
        $fromStatus = self::$hgjkStatus['fromStatus'];
        $toStatus = self::$hgjkStatus['toStatus'];
        $notpassStatus = self::$hgjkStatus['notpassStatus'];
        /*$personProduct = array(
            'pim_id'=>$row['pim_id'],
        );*/
        //$products = Service_PersonItemProduct::getByCondition($personProduct,'*');
        if($row['customs_status'] == $fromStatus){
            //try {
            switch($bodyRow['feedback_flag']){
                case '01':
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
                    'customs_status'=>$toStatus,
                    'pim_update_time'=>date('Y-m-d H:i:s',time()),
                );
                if($row['ciq_status']=='6'){
                    $updateRow['status'] = '6';
                }
                if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                    throw new Exception('物品清单更新失败');
                }else{
                    //添加日志
                    $logRow = array(
                        'pim_id'=>$row['pim_id'],
                        'pim_code'=>$row['pim_code'],
                        'pim_status_from'=>$row['customs_status'],
                        'pim_status_to'=>$productStatus,
                        'pil_add_time'=>$time,
                        'user_id'=>'0',
                        'pil_comments'=>'接收海关解控回执:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    if(!Service_PersonItemLog::add($logRow)){
                        throw new Exception('物品清单日志创建失败！');
                    }
                }
            }
            if(isset($productStatus) && $productStatus==$notpassStatus){
                //布控不通过,变成审核不通过
                $updateRow = array(
                    'customs_status'=>$productStatus,
                    'pim_update_time'=>date('Y-m-d H:i:s',time()),
                );
                $updateRow['status'] = self::$status['notpassStatus'];
                if(!Service_PersonItem::update($updateRow,$row['pim_id'])){
                    throw new Exception('物品清单更新失败');
                }else{
                    //添加日志
                    $logRow = array(
                        'pim_id'=>$row['pim_id'],
                        'pim_code'=>$row['pim_code'],
                        'pim_status_from'=>$row['customs_status'],
                        'pim_status_to'=>$productStatus,
                        'pil_add_time'=>$time,
                        'user_id'=>'0',
                        'pil_comments'=>'接收海关解控回执:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    if(!Service_PersonItemLog::add($logRow)){
                        throw new Exception('物品清单日志创建失败！');
                    }
                    $warehouseCondition = array(
                        'customer_code'=>$row['agent_customer_code'],
                        'ie_type'=>'I',
                        'warehouse_status'=>'5',
                    );
                    $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
                    $ems_no =''; //电子账册号
                    if(!empty($warehouse)){
                        $ems_no = $warehouse[0]['warehouse_code'];
                    }
                    $personProduct = array(
                        'pim_id'=>$row['pim_id'],
                    );
                    $products = Service_PersonItemProduct::getByCondition($personProduct,'*');
                    if(empty($products)){
                        throw new Exception("清单{$row['pim_code']}商品为空");
                    }
                    $productInventoryObj = new Service_ProductInventoryProcess();
                    foreach($products as $key=>$val){
                        $param = array(
                            'operationType'=>3,//物品清单审核失败
                            'quantity'=>$val['g_qty'],
                            'goodsId'=>$val['goods_id'],
                            'warehouseCode'=>$ems_no,
                            'note'=>'物品清单审核失败:'.$bodyRow['feedback_mess'],
                        );
                        $result = $productInventoryObj->update($param);
                        if($result['state']=='0'){
                            throw new Exception('库存更新失败:'.$result['message']['errorMse']);
                        }
                    }
                }
            }
            self::$return['ask'] = 1;
            self::$return['message'] = '物品清单解控回执：队列处理成功！';
            /*} catch (Exception $e) {
                self::$return['error'] = $e->getMessage();
            }*/
        } else{
            throw new Exception('该物品清单还没走到[海关已布控]流程！');
            //self::$return['error'] = ;
        }
        return self::$return;
    }

    /**
     * [personItemVoid 清单作废]
     * @param  array  $bodyRow [description]
     * @param  array  $headRow [description]
     * @return [type]          [description]
     */
    public static function personItemVoid(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['form_id'];
        //获取物品清单信息
        $row = Service_PersonItem::getByField($formId, 'pim_code'); 
        if(empty($row)){
            throw new Exception("物品清单[{$formId}]不存在");
        }
        $row = Service_PersonItem::getByFieldLock($row['pim_id'], 'pim_id');
		$warehouseCondition = array(
			'customer_code'=>$row['agent_customer_code'],
			'ie_type'=>'I',
			'warehouse_status'=>'5',
		);
		$warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
		$ems_no =''; //电子账册号
		if(!empty($warehouse)){
			$ems_no = $warehouse[0]['warehouse_code'];
		}
        $fromStatus = self::$voidStatus['fromStatus'];
        $toStatus = self::$voidStatus['toStatus'];
        $personProduct = array(
            'pim_id'=>$row['pim_id'],
        );
        $products = Service_PersonItemProduct::getByCondition($personProduct, '*');
        if(in_array($row['customs_status'], $fromStatus)){
         //   try {
                if($bodyRow['feedback_flag'] == '01'){
                    //作废
                    $updateRow = array(
                        'customs_status' => $toStatus,
                        'pim_update_time' => $time,
                    );
                    if(!Service_PersonItem::update($updateRow, $row['pim_id'])){
                        throw new Exception("物品清单[{$row['pim_code']}]作废失败");
                    }
                    //添加日志
                    $logRow = array(
                        'pim_id' => $row['pim_id'],
                        'pim_code' => $row['pim_code'],
                        'pim_status_from' => $row['customs_status'],
                        'pim_status_to' => $toStatus,
                        'pil_add_time' => $time,
                        'user_id' => '0',
                        'pil_comments' => '接收海关作废回执:'.$bodyRow['feedback_mess'],
                        'pil_ip' => Common_Common::getIP(),
                    );
                    if(!Service_PersonItemLog::add($logRow)){
                        throw new Exception("物品清单[{$row['pim_code']}]作废日志创建失败");
                    }
                    //操作库存(作废清单)
                    $productInventoryObj = new Service_ProductInventoryProcess();
                    if(!empty($products) && is_array($products)){
                        foreach($products as $key=>$val){
                            $param = array(
                                //清单作废返还库存
                                'operationType'=>3,
                                'quantity'=>$val['g_qty'],
                                'goodsId'=>$val['goods_id'],
                                'warehouseCode'=>$ems_no,
                                'note'=>'物品清单作废:'.$bodyRow['feedback_mess'],
                            );
                            $result = $productInventoryObj->update($param);
                            if($result['state']=='0'){
                                throw new Exception("物品清单[{$row['pim_code']}]作废:商品库存更新失败:{$result['message']['errorMse']}");
                            }
                        }
                    }
                }
                self::$return['ask'] = 1;
                self::$return['message'] = "物品清单[{$row['pim_code']}]作废回执：队列处理成功";
        /*    } catch (Exception $e) {
                self::$return['message'] = $e->getMessage();
            }
        */
        } else {
            //throw new Exception("该物品清单[{$row['pim_code']}]状态不可作废");
            self::$return['message'] = "该物品清单[{$row['pim_code']}]状态不可作废";
        }
        return self::$return;
    }
}
