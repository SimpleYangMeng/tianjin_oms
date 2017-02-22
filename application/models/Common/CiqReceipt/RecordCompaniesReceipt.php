<?php
/**
 * @todo 用于处理企业接收回执
 * @author simple
 */
class RecordCompaniesReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //03待审批 1审批未通过 2审批通过 9电子审单未通过
    //检验检疫接收回执状态变化
    private static $sjStatus = array(

        //检验检疫已接收
        'receive' => array(
            'fromStatus' => array('1'),
            'toStatus' => '2',
        ),

        //审核通过 (一级)
        'firstCheck' => array(
            'fromStatus' => array('2', '4', '6'),
            'toStatus' => '6'
        ),

        //审核通过 (二级)
        'check' => array(
            'fromStatus' => array('2', '4', '6'),
            'toStatus' => '3',
        	//总的状态审核通过
            'totalStatus' => '2'
        ),

        //审核不通过 （1 - 4 一级二级都为不通过）
        'notpass' => array(
            'fromStatus' => array('2', '3', '4'),
            'toStatus' => '4',
        	//总的状态审核不通过
            'totalStatus' => '3'
        ),

        //锁定状态
        'sjLock' => array(
            'lock' => '1',
            'unLock' => '0',
            'okTotalStatus' => '2',
            'ngTotalStatus' => '3',
        ),
    );

    /**
     * @todo 企业备案接收回执
     */
    public static function recordCompaniesReceive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $commIp = Common_Common::getRealIp();
    	$apiMessage = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        
        //获取备案信息
        $customerData = Service_Customer::getByFieldLock($apiMessage['ref_id'], 'customer_id');
        
        if(empty($customerData)){
            throw new Exception("企业[{$bodyRow['receipt_no']}]不存在");
        }

        /**
        * 废弃 begin
        * 03 待受理 ----检验检疫已接收
        * 1  审核不通过
        * 2  审批通过---审核通过
        * 9  电子审单未通过---格式异常
        * 废弃 end
        * 
        * 03 待审核 
        * 1 一级审核未通过 
        * 2 二级审核通过 
        * 4 二级审核未通过 
        * 5 一级审核通过 
        * 9 电子审单未通过
		*/
            
        //已接受
        if(trim($bodyRow['msg_code']) === '03'){
	        //已发送 -> 接收入库
	        $fromStatus = self::$sjStatus['receive']['fromStatus'];
	        //待受理 检验检疫已接收
	        $toStatus = self::$sjStatus['receive']['toStatus']; 
	        if(in_array($customerData['ciq_status'], $fromStatus)){
	        	//更改状态
	        	$customerUpdateData = array(
	        		'ciq_status' => $toStatus,
				//	'customer_note' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
	        		'customer_update_time' => $time,
                    'ciq_reject_reason' => '',
	        	);
				if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
					throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]更新失败");
				}
                //写入日志
                $logRow = array(
                    'customer_id' => $customerData['customer_id'],
                    'customer_code' => $customerData['customer_code'],
                    'cl_from_status' => $customerData['customs_status'],
                    'cl_to_status' => $customerData['customs_status'],
                    'cl_ciq_from_status' => $customerData['ciq_status'],
                    'cl_ciq_to_status' => $toStatus,
                    'cl_add_time' => $time,
                    'cl_user_id' => 0,
                    'cl_user_name' => 'system',
                    'cl_ip' => $commIp,
                    'cl_comment' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'status_type' => 2
                );
                if(Service_CustomerLog::add($logRow) === false ) {
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                }
	        }else {
	            throw new Exception("企业[{$customerData['customer_code']}]状态未到[已发送]流程");
	        }

		//审核通过
        }else if(trim($bodyRow['msg_code']) === '2'){
        	//接收入库 -> 审批通过
	        $fromStatus = self::$sjStatus['check']['fromStatus'];
	        $toStatus = self::$sjStatus['check']['toStatus'];
        	if(in_array($customerData['ciq_status'], $fromStatus)){
	        	//更改状态
	        	$customerUpdateData = array(
	        		'ciq_status' => $toStatus,
	        	//	'customer_note' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
	        		//检验检疫备案号
	        		'ciq_reg_num' => $bodyRow['attribute'],
	        		'customer_update_time' => $time,
                    'ciq_reject_reason' => '',
	        	);
	        	//海关也审核通过 - 更新整个状态为审核通过
	        	if($customerData['customs_status'] == 4){
	        		$customerUpdateData['customer_status'] = self::$sjStatus['check']['totalStatus'];
	        	}
				if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
					throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]更新失败");
				}

                //写入日志
                $logRow = array(
                    'customer_id' => $customerData['customer_id'],
                    'customer_code' => $customerData['customer_code'],
                    'cl_from_status' => $customerData['customs_status'],
                    'cl_to_status' => $customerData['customs_status'],
                    'cl_ciq_from_status' => $customerData['ciq_status'],
                    'cl_ciq_to_status' => $toStatus,
                    'cl_add_time' => $time,
                    'cl_user_id' => 0,
                    'cl_user_name' => 'system',
                    'cl_ip' => $commIp,
                    'cl_comment' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'status_type' => 2
                );
                if(Service_CustomerLog::add($logRow) === false ) {
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                }

	        }else {
	        	throw new Exception('该企业状态未到[接收入库]流程!');
	        }

        //审核不通过 (一级 二级)
        }else if(trim($bodyRow['msg_code']) === '1' || trim($bodyRow['msg_code']) === '4'){
        	//接收入库 -> 审批通过
	        $fromStatus = self::$sjStatus['notpass']['fromStatus'];
	        $toStatus = self::$sjStatus['notpass']['toStatus'];
        	if(in_array($customerData['ciq_status'], $fromStatus)){
	        	//更改状态
	        	$customerUpdateData = array(
	        		'customer_status' => self::$sjStatus['notpass']['totalStatus'],
	        		'ciq_status' => $toStatus,
	        	//	'customer_note' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
	        		'customer_update_time' => $time,
                    'ciq_reject_reason' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
	        	);
				if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
					throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]更新失败");
				}

                //写入日志
                $logRow = array(
                    'customer_id' => $customerData['customer_id'],
                    'customer_code' => $customerData['customer_code'],
                    'cl_from_status' => $customerData['customs_status'],
                    'cl_to_status' => $customerData['customs_status'],
                    'cl_ciq_from_status' => $customerData['ciq_status'],
                    'cl_ciq_to_status' => $toStatus,
                    'cl_add_time' => $time,
                    'cl_user_id' => 0,
                    'cl_user_name' => 'system',
                    'cl_ip' => $commIp,
                    'cl_comment' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'status_type' => 2
                );
                if(Service_CustomerLog::add($logRow) === false ) {
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                }

	        }else {
	        	throw new Exception('该企业状态未到[已发送或者接收入库]流程!');
	        }

        //一级审核通过
        }else if(trim($bodyRow['msg_code']) === '5'){

            $fromStatus = self::$sjStatus['firstCheck']['fromStatus'];
            $toStatus = self::$sjStatus['firstCheck']['toStatus'];
            if(in_array($customerData['ciq_status'], $fromStatus)){
                //更改状态
                $customerUpdateData = array(
                    'ciq_status' => $toStatus,
                //    'customer_note' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'customer_update_time' => $time,
                    'ciq_reject_reason' => '',
                );
                if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]更新失败");
                }

                //写入日志
                $logRow = array(
                    'customer_id' => $customerData['customer_id'],
                    'customer_code' => $customerData['customer_code'],
                    'cl_from_status' => $customerData['customs_status'],
                    'cl_to_status' => $customerData['customs_status'],
                    'cl_ciq_from_status' => $customerData['ciq_status'],
                    'cl_ciq_to_status' => $toStatus,
                    'cl_add_time' => $time,
                    'cl_user_id' => 0,
                    'cl_user_name' => 'system',
                    'cl_ip' => $commIp,
                    'cl_comment' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'status_type' => 2
                );
                if(Service_CustomerLog::add($logRow) === false ) {
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                }

            }else {
                throw new Exception('该企业状态未到[已发送或者接收入库]流程!');
            }

        //电子审单未通过 - 审核不通过
        }else if(trim($bodyRow['msg_code']) === '9'){
            //接收入库 -> 审核不通过
            $fromStatus = self::$sjStatus['notpass']['fromStatus'];
            $toStatus = self::$sjStatus['notpass']['toStatus'];
            if(in_array($customerData['ciq_status'], $fromStatus)){
                //更改状态
                $customerUpdateData = array(
                    'customer_status' => self::$sjStatus['notpass']['totalStatus'],
                    'ciq_status' => $toStatus,
                //    'customer_note' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'customer_update_time' => $time,
                    'ciq_reject_reason' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                );
                if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]更新失败");
                }

                //写入日志
                $logRow = array(
                    'customer_id' => $customerData['customer_id'],
                    'customer_code' => $customerData['customer_code'],
                    'cl_from_status' => $customerData['customs_status'],
                    'cl_to_status' => $customerData['customs_status'],
                    'cl_ciq_from_status' => $customerData['ciq_status'],
                    'cl_ciq_to_status' => $toStatus,
                    'cl_add_time' => $time,
                    'cl_user_id' => 0,
                    'cl_user_name' => 'system',
                    'cl_ip' => $commIp,
                    'cl_comment' => '接收检验检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'status_type' => 2
                );
                if(Service_CustomerLog::add($logRow) === false ) {
                    throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                }

            }else {
                throw new Exception('该企业状态未到[已发送或者接收入库]流程!');
            }
        }else {
        	echo '状态'.$bodyRow['msg_code'].'暂不处理';
        }
    }

    /**
     * [lockCompaniesReceive 锁定解锁]
     * @param  array  $bodyRow [description]
     * @param  array  $headRow [description]
     * @return [type]          [description]
     */
    public static function lockCompaniesReceive(array $bodyRow, array $headRow){

        $time = date('Y-m-d H:i:s',time());
        $commIp = Common_Common::getRealIp();
        $apiMessage = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        
        //获取备案信息
        $customerData = Service_Customer::getByFieldLock($apiMessage['ref_id'], 'customer_id');
        
        if(empty($customerData)){
            throw new Exception("企业[{$bodyRow['receipt_no']}]不存在");
        }
        /*
        * Y - 锁定
        * N - 解锁
        */
        switch (trim($bodyRow['msg_code'])) {
            //解锁
            case 'N':
                if($customerData['ciq_is_lock'] == 1){
                    //更改状态
                    $customerUpdateData = array(
                        'ciq_is_lock' => self::$sjStatus['sjLock']['unLock'],
                        'customer_update_time' => $time
                    );
                    if($customerData['ciq_status'] == 3 && $customerData['customs_status'] == 4){
                        $customerUpdateData['customer_status'] = self::$sjStatus['sjLock']['okTotalStatus'];
                    }
                    if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
                        throw new Exception('企业状态更新失败');
                    }
                    //写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => $customerData['customs_status'],
                        'cl_ciq_from_status' => $customerData['ciq_status'],
                        'cl_ciq_to_status' => $customerData['ciq_status'],
                        'cl_add_time' => $time,
                        'cl_user_id' => 0,
                        'cl_user_name' => 'system',
                        'cl_ip' => $commIp,
                        'cl_comment' => '接收检验检疫解锁回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                        'status_type' => 2
                    );
                    if(Service_CustomerLog::add($logRow) === false ) {
                        throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                    }
                }else {
                    throw new Exception("企业[{$customerData['customer_code']}]不是已锁定状态");
                }
                break;
                
            //锁定
            case 'Y':
                if($customerData['ciq_is_lock'] == 0){
                    //更改状态
                    $customerUpdateData = array(
                        //总状态 停用
                        'customer_status' => self::$sjStatus['sjLock']['ngTotalStatus'],
                        'ciq_is_lock' => self::$sjStatus['sjLock']['lock'],
                        'customer_update_time' => $time
                    );
                    if(Service_Customer::update($customerUpdateData, $customerData['customer_id'], 'customer_id') === false){
                        throw new Exception('企业状态更新失败');
                    }
                    //写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => $customerData['customs_status'],
                        'cl_ciq_from_status' => $customerData['ciq_status'],
                        'cl_ciq_to_status' => $customerData['ciq_status'],
                        'cl_add_time' => $time,
                        'cl_user_id' => 0,
                        'cl_user_name' => 'system',
                        'cl_ip' => $commIp,
                        'cl_comment' => '接收检验检疫锁定回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                        'status_type' => 2
                    );
                    if(Service_CustomerLog::add($logRow) === false ) {
                        throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]日志写入失败");
                    }
                }else {
                    throw new Exception("企业[{$customerData['customer_code']}]不是未锁定状态");
                }
                break;
            default:
                echo "企业[{$customerData['customer_code']}]状态[{$bodyRow['msg_code']}]暂不处理";
        }
    }

}