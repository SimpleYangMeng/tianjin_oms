<?php

/**
 *  企业海关备案回执处理
 *  events
 */
class RecordCompaniesReceipt {
	private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );

	//起始状态
    private static $fromStatus = array(
        //发送
        'sendFromStatus' => array('1'),
    );
    private static $toStatus = array(
    	'receive' => 2,
    	'backBill' => 3
    );
	public static function receiveReceipt(array $bodyRow, array $headRow) {
		$formId = $bodyRow['form_id'];
		$date = $bodyRow['feedback_date'];
		$time = date('Y-m-d H:i:s');
		$commIp = Common_Common::getRealIp();
		$customerData = Service_Customer::getByField($formId, 'customs_seq_id');
		if (empty($customerData)) {
			throw new Exception('企业customs_seq_id['.$formId.']不存在');
			/*
			self::$return['message'] = '企业customs_seq_id['.$formId.']不存在';
            return self::$return;
            */
		}

		//api_message
		$apiId = Service_ApiMessage::getByCondition(array('api_code'=> 'RecordCompanies', 'ref_id'=> $customerData['customer_id']), array('am_id'));
		if(empty($apiId)){
			throw new Exception("消息队列不存在");
			/*
			self::$return['message'] = "消息队列不存在";
            return self::$return;
            */
		}else {
			$apiId = $apiId[0];
		}

		//try{
			if (in_array($customerData['customs_status'], self::$fromStatus['sendFromStatus'])) {
				//海关接收申报
				if ($bodyRow['feedback_flag'] == '01') {
					/*
					$row = array(
						'api_type' => 'receive',
						'am_status' => '2',
						'receiving_time' => $date,
					);
					//修改消息队列
					if (Service_ApiMessage::update($row, $apiId['am_id'], 'am_id') === false) {
						throw new Exception("企业备案更新接收回执状态失败");
					}
					*/
					if (Service_Customer::update(array('customs_status' => self::$toStatus['receive'], 'customer_update_time' => $time), $customerData['customer_id']) === false) {
						throw new Exception("企业备案ID[{$customerData['customer_id']}]接收回执[{$bodyRow['feedback_flag']}]: 更新状态失败");
					}
					//写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => self::$toStatus['receive'],
                        'cl_ciq_from_status' => $customerData['ciq_status'],
                        'cl_ciq_to_status' => $customerData['ciq_status'],
                        'cl_add_time' => $time,
                        'cl_user_id' => 0,
                        'cl_user_name' => 'system',
                        'cl_ip' => $commIp,
                        'cl_comment' => '接收海关回执['.$bodyRow['feedback_flag'].':'.$bodyRow['feedback_mess'].']',
                        'status_type' => 1
                    );
                    if(Service_CustomerLog::add($logRow) === false ) {
                        throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['feedback_flag']}]日志写入失败");
                    }
				}
				//海关退回申报
				if ($bodyRow['feedback_flag'] == '02') {
					/*
					$row = array(
						'api_type' => 'receive',
						'am_status' => '3', //已退回
						'receiving_time' => $date,
					);
					if (Service_ApiMessage::update($row, $apiId['am_id'], 'am_id') === false) {
						throw new Exception("企业备案更新接收回执状态失败");
					}
					*/
					if (Service_Customer::update(array('customs_status' => self::$toStatus['backBill'], 'customer_update_time' => $time), $customerData['customer_id']) === false) {
						throw new Exception("企业备案ID[{$customerData['customer_id']}]接收回执[{$bodyRow['feedback_flag']}]: 更新状态失败");
					}
					//写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => self::$toStatus['backBill'],
                        'cl_ciq_from_status' => $customerData['ciq_status'],
                        'cl_ciq_to_status' => $customerData['ciq_status'],
                        'cl_add_time' => $time,
                        'cl_user_id' => 0,
                        'cl_user_name' => 'system',
                        'cl_ip' => $commIp,
                        'cl_comment' => '接收海关回执['.$bodyRow['feedback_flag'].':'.$bodyRow['feedback_mess'].']',
                        'status_type' => 1
                    );
                    if(Service_CustomerLog::add($logRow) === false ) {
                        throw new Exception("企业[{$customerData['customer_code']}]状态[{$bodyRow['feedback_flag']}]日志写入失败");
                    }
				}
			} else {
				throw new Exception("企业备案ID[{$customerData['customer_id']}]未到[已发送海关-1]状态");
			}
			self::$return['ask'] = 1;
            self::$return['message'] = "企业备案ID[{$customerData['customer_id']}]接收回执[{$bodyRow['feedback_flag']}]:队列处理成功";
        /*
		}catch (Exception $e) {
            self::$return['message'] = $e->getMessage();
        }
        */
        return self::$return;
	}
}
