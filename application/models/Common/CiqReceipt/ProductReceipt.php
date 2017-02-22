<?php

/**
 * @author william-fan
 * @todo 用于处理审核回执
 *
 *          *  03 待受理
 * 4  一级审核否决
 * 5  一级审核通过
 * 6  二级审核通过
 * 7  二级审核否决
 * 10 注销申请
 * 11 已注销
 * 9  电子审单未通过
 *   `ciq_status` tinyint(2) NOT NULL DEFAULT '-1'
COMMENT '国检审核状态：-1待发送商检，1：已发送商检，2:商检已接收，3：审核通过(二级)，
 * 4：审核不通过((一级,二级都可能,电子审核不通过) 5：异常,6:一级审核通过',
 */
class ProductReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //03 待受理 4  审批否决     5  一级审批通过 6  审批通过 9  电子审单未通过
    //商检接收回执状态变化
    //国检审核状态：-1待发送商检，1：已发送商检，2:商检已接收，3：审核通过(二级)，4：审核不通过((一级,二级都可能,电子审核不通过) 5：异常,6:一级审核通过'
    private static $sjreceiveStatus = array(
        //商检已接收
        'receive'=>array(
            'fromStatus'=>array('1'),
            'toStatus'=>'2',
        ),
        //审核通过 (一级)
        'firstCheck' => array(
            'fromStatus' => array('2'),
            'toStatus' => '6'
        ),
        //审核通过(二级)
        'check'=>array(
        //    'fromStatus'=>array('1','2','6'),
            'fromStatus'=>array('6'),
            'toStatus'=>'3',
            'totalStatus'=>'1'//总的状态审核通过
        ),
        //审核不通过(1:已发送商检，2商检已接收，6一级审核通过)
        'notpass'=>array(
            'fromStatus'=>array('1','2','6'),
            'toStatus'=>'4',
            'totalStatus'=>'0'//总的状态审核不通过
        ),
    );

    /**
     * @author william-fan
     * @todo 商品接收回执
     */
    public static function productReceive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $formId = $bodyRow['from_id'];//ciq_api_message主键
        $apiMessage = Service_CiqApiMessage::getByField($formId);

        if(empty($apiMessage)){
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }
        $row = Service_Product::getByFieldLock($apiMessage['ref_id']); //获取商品信息
        /*$fromStatus = self::$sjreceiveStatus['fromStatus'];
        $toStatus = self::$sjreceiveStatus['toStatus'];*/
        /**
        03 待受理 ----商检已接收
        4  审批否决---审核不通过
        5  一级审批通过---不处理
        6  审批通过---审核通过
        9  电子审单未通过---格式异常
         *
         *  03 待受理
         * 4  一级审核否决
         * 5  一级审核通过
         * 6  二级审核通过
         * 7  二级审核否决
         * 10 注销申请
         * 11 已注销
         * 9  电子审单未通过
         *
         *
         *
         */
        /* var_dump($bodyRow);
        try { */
            //03 待受理 4  审批否决     5  一级审批通过 6  审批通过 9  电子审单未通过
            switch($bodyRow['msg_code']){
                case '03':
                    $fromStatus = self::$sjreceiveStatus['receive']['fromStatus'];
                    $status = self::$sjreceiveStatus['receive']['toStatus']; //待受理 商检已接收
                    $status_total = $row['product_status'];
                    if(in_array($row['ciq_status'],$fromStatus)){
                        //审核通过
                        $updateRow = array(
                            'ciq_status'=>$status,
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                            'ciq_reject_reason' => '',
                        );
                        if(!Service_Product::update($updateRow,$apiMessage['ref_id'])){
                            throw new Exception('商品更新失败');
                        }else{
                            //添加日志
                            $note ='';
                            if($bodyRow['msg_name']!=''){
                                $note.=$bodyRow['msg_name'];
                            }
                            if($bodyRow['msg_desc']!=''){
                                $note.=':'.$bodyRow['msg_name'];
                            }
                            $logRow = array(
                                'product_id'=>$apiMessage['ref_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>$status_total,
                                'ciq_status_from'=>$row['ciq_status'],
                                'ciq_status_to'=>$status,
                                'pl_note'=>'接收商检回执:'.$note,
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception('商品日志添加失败！');
                            }
                        }
                    }else{
                        throw new Exception("队列消息体{$formId},商品{$row['registerID']},暂未发送商检,无法处理商检接收回执!");
                    }
                    break;
                case '4':
                    //一级审核否决（一级审核不通过）
                    $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
                    $status = self::$sjreceiveStatus['notpass']['toStatus']; //审核不通过
                    $status_total = self::$sjreceiveStatus['notpass']['totalStatus'];
                    if(in_array($row['ciq_status'],$fromStatus)){
                        //审核不通过
                        //添加日志
                        $note ='';
                        if($bodyRow['msg_name']!=''){
                            $note.=$bodyRow['msg_name'];
                        }
                        if($bodyRow['msg_desc']!=''){
                            $note.=':'.$bodyRow['msg_name'];
                        }
                        $updateRow = array(
                            'product_status'=>$status_total,
                            'ciq_status'=>$status,
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                            'ciq_reject_reason' => '接收商检回执:'.$note,
                        );
                        if(!Service_Product::update($updateRow,$apiMessage['ref_id'])){
                            throw new Exception('商品更新失败');
                        }else{
                            $logRow = array(
                                'product_id'=>$apiMessage['ref_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>$status_total,
                                'ciq_status_from'=>$row['ciq_status'],
                                'ciq_status_to'=>$status,
                                'pl_note'=>'接收商检回执:'.$note,
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception('商品日志添加失败！');
                            }
                        }
                    }else{
                        throw new Exception("队列消息体{$formId},商品{$row['registerID']},不是1,2,6状态,无法处理商检一级审核否决!");
                    }
                    break;
                case '5':
                    //一级审核通过
                    $fromStatus = self::$sjreceiveStatus['firstCheck']['fromStatus'];
                    $status = self::$sjreceiveStatus['firstCheck']['toStatus']; //一级审核通过
                    if(in_array($row['ciq_status'],$fromStatus)){
                        $note ='';
                        if($bodyRow['msg_name']!=''){
                            $note.=$bodyRow['msg_name'];
                        }
                        if($bodyRow['msg_desc']!=''){
                            $note.=':'.$bodyRow['msg_name'];
                        }
                        $updateRow = array(
                            'ciq_status'=>$status,
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                            'ciq_reject_reason' => '接收商检回执:'.$note,
                        );
                        if(!Service_Product::update($updateRow,$apiMessage['ref_id'])){
                            throw new Exception('商品更新失败');
                        }else{
                            $logRow = array(
                                'product_id'=>$apiMessage['ref_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>$row['product_status'],
                                'ciq_status_from'=>$row['ciq_status'],
                                'ciq_status_to'=>$status,
                                'pl_note'=>'接收商检回执:'.$note,
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            //print_r($logRow);
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception('商品日志添加失败！');
                            }
                        }
                    }else{
                        throw new Exception("队列消息体{$formId},商品{$row['registerID']},不是1,2,6状态,无法处理商检一级审核否决!");
                    }
                    break;
                case '6':
                    //审核通过
                    $fromStatus = self::$sjreceiveStatus['check']['fromStatus'];
                    $status = self::$sjreceiveStatus['check']['toStatus'];
                    if(empty($fromStatus) || empty($status)){
                        throw new Exception("状态异常");
                    }
                    if(in_array($row['ciq_status'],$fromStatus)){
                        //审核通过
                        $updateRow = array(
                            'ciq_status'=>$status,
                            'inspection_code'=>$bodyRow['attribute'],
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                        );
                        if($row['customs_status']=='1'){
                            $updateRow['product_status'] = '1';
                        }

                        if(!Service_Product::update($updateRow,$apiMessage['ref_id'])){
                            throw new Exception('商品更新失败');
                        }else{
                            //添加日志
                            $note ='';
                            if($bodyRow['msg_name']!=''){
                                $note.=$bodyRow['msg_name'];
                            }
                            if($bodyRow['msg_desc']!=''){
                                $note.=':'.$bodyRow['msg_name'];
                            }
                            $logRow = array(
                                'product_id'=>$apiMessage['ref_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>'1',
                                'pl_note'=>'接收商检回执:'.$note,
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception('商品日志添加失败！');
                            }
                        }
                    }else{
                        throw new Exception('尚未接收商品回执');
                    }
                    break;
                case '7':
                    //二级审核否决
                    $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
                    $status = self::$sjreceiveStatus['notpass']['toStatus']; //审核不通过
                    $status_total = self::$sjreceiveStatus['notpass']['totalStatus'];
                    if(in_array($row['ciq_status'],$fromStatus)){
                        //审核不通过
                        //添加日志
                        $note ='';
                        if($bodyRow['msg_name']!=''){
                            $note.=$bodyRow['msg_name'];
                        }
                        if($bodyRow['msg_desc']!=''){
                            $note.=':'.$bodyRow['msg_name'];
                        }
                        $updateRow = array(
                            'product_status'=>$status_total,
                            'ciq_status'=>$status,
                            'product_update_time'=>date('Y-m-d H:i:s',time()),
                            'ciq_reject_reason' => '接收商检回执:'.$note,
                        );
                        if(!Service_Product::update($updateRow,$apiMessage['ref_id'])){
                            throw new Exception('商品更新失败');
                        }else{
                            $logRow = array(
                                'product_id'=>$apiMessage['ref_id'],
                                'pl_type'=>'2',
                                'user_id'=>'0',
                                'pl_statu_pre'=>$row['product_status'],
                                'pl_statu_now'=>$status_total,
                                'ciq_status_from'=>$row['ciq_status'],
                                'ciq_status_to'=>$status,
                                'pl_note'=>'接收商检回执:'.$note,
                                'pl_ip' => Common_Common::getIP(),
                                'pl_add_time'=>$time
                            );
                            if(!Service_ProductLog::add($logRow)){
                                throw new Exception('商品日志添加失败！');
                            }
                        }
                    }else{
                        throw new Exception("队列消息体{$formId},商品{$row['registerID']},不是1,2,6状态,无法处理商检一级审核否决!");
                    }
                    break;
                case '9':
                    //电子审单未通过---格式异常
                    $note ='';
                    if($bodyRow['msg_name']!=''){
                        $note.=$bodyRow['msg_name'];
                    }
                    if($bodyRow['msg_desc']!=''){
                        $note.=':'.$bodyRow['msg_name'];
                    }
                    $updateRow = array(
                        'product_status'=>'0',
                        'ciq_status'=>'4',
                        'product_update_time'=>date('Y-m-d H:i:s',time()),
                        'ciq_reject_reason' => '接收商检回执:'.$note,
                    );
                    if(!Service_Product::update($updateRow,$apiMessage['ref_id'])){
                        $logRow = array(
                            'product_id'=>$apiMessage['ref_id'],
                            'pl_type'=>'2',
                            'user_id'=>'0',
                            'pl_statu_pre'=>$row['product_status'],
                            'pl_statu_now'=>$row['product_status'],
                            'pl_note'=>'接收商检回执:'.$note,
                            'pl_ip' => Common_Common::getIP(),
                            'pl_add_time'=>$time
                        );
                        if(!Service_ProductLog::add($logRow)){
                            throw new Exception('商品日志添加失败！');
                        }
                    }
                    break;
                default:
            }
            self::$return['ask'] = 1;
            self::$return['message'] = '商品接收回执：队列处理成功！';
        /* } catch (Exception $e) {
            self::$return['error'] = $e->getMessage();
        } */
        /*if($row['product_status'] == $fromStatus){

        } else{
            self::$return['error'] = '该商品还没走到[已发送海关]流程！';
        }*/
        return self::$return;
    }
	
	public static function productLockReceive(array $bodyRow, array $headRow)
	{
		$time = date('Y-m-d H:i:s',time());
        $productId = $bodyRow['receipt_no'];
        $row = Service_Product::getByFieldLock($productId,'product_id'); //获取商品信息
        //$row = Service_Product::getByFieldLock($apiMessage['ref_id']); //获取商品信息
		$productStatus	= $row['product_status'];
		if(empty($row)){
			throw new Exception($productId."未找到对应商品");
		}
		if('N' == $bodyRow['msg_code']){
			//海关已审核和商检已放行
			if(3 == $row['ciq_status'] && 1 == $row['customs_status']){
				$productStatus = 1;
			}
		}
        if('Y' == $bodyRow['msg_code']){
            //锁定了，商品变成不可用状态
            $productStatus = '0';
        }
		$updateRow = array(
			'product_status'=>$productStatus,
			'is_lock'	=> $bodyRow['msg_code'],
			'product_update_time'=>date('Y-m-d H:i:s',time()),
		);
		if(!Service_Product::update($updateRow,$productId)){
			$logRow = array(
				'product_id'=>$productId,
				'pl_type'=>'2',
				'user_id'=>'0',
				'pl_statu_pre'=>$row['product_status'],
				'pl_statu_now'=>$productStatus,
				'pl_note'=>'接收商检回执:'.$bodyRow['msg_name'],
				'pl_ip' => Common_Common::getIP(),
				'pl_add_time'=>$time
			);
			if(!Service_ProductLog::add($logRow)){
				throw new Exception('商品日志添加失败！');
			}
		}
		self::$return['ask'] = 1;
		self::$return['message'] = '商品接收回执：队列处理成功！';
		return self::$return;
	}

}
