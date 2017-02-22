<?php

/**
*
*/
class AuditRecordCompaniesReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    private static $customsStatus = array(
        // '0' => '0',//待发送
        // '1' => '1',//已发送
        '01' => '2',//已接收
        '02' => '3',//已退单
        '03' => '4',//审核通过
        '04' => '5',//审核不通过
        '05' => '6',//暂停使用
        '07' => '7',//终止使用
       // '08' => '8',//恢复使用
        '08' => '4',//恢复使用 - 审核通过
    );

    //起始状态
    private static $fromStatus = array(
        //审核起始状态
        'checkFromStatus' => array('2'),
        //暂停起始状态
        'suspendFromStatus' => array('4'),
        //恢复启用起始状态
        'recoveryFromStatus' => array('6', '7'),
    );

    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s');
        $commIp = Common_Common::getRealIp();
        // throw new Exception("Error Processing Request", 1);
        $formId = $bodyRow['form_id'];
        $date = $bodyRow['feedback_date'];
        $time = strtotime('Y-m-d H:i:s');
        $customerData = Service_Customer::getByField($formId,'customs_seq_id');
        if(empty($customerData)){
            throw new Exception("企业customs_seq_id:[{$formId}]不存在");
            /*
            self::$return['message'] = "企业customs_seq_id:[{$formId}]不存在";
            return self::$return;
            */
        }
        //api_message
        $apiId = Service_ApiMessage::getByCondition(array('api_code'=> 'RecordCompanies', 'ref_id'=> $customerData['customer_id']), array('am_id'));
        if(empty($apiId)){
            throw new Exception("消息队列api_code[RecordCompanies]ref_id[{$customerData['customer_id']}]不存在");
            /*
            self::$return['message'] = "消息队列api_code[RecordCompanies]ref_id[{$customerData['customer_id']}]不存在";
            return self::$return;
            */
        }else {
            $apiId = $apiId[0];
        }
        //try{
            if(in_array($customerData['customs_status'], self::$fromStatus['checkFromStatus'])){
                //海关审核成功
                if($bodyRow['feedback_flag'] == '03'){
                    /*
                    $row = array(
                        'api_type'=>'receive',
                        'am_status'=>'5',
                        'receiving_count'=>'1',
                        'receiving_time'=>$date
                    );
                    //审核成功
                    if(Service_ApiMessage::update($row, $apiId['am_id'], 'am_id') === false){
                        throw new Exception("企业备案审核回执api_messageID[{$apiId['am_id']}]状态更新失败");
                    }
                    */
                    $customerUpdateData = array(
                            'customs_status'=>self::$customsStatus[$bodyRow['feedback_flag']],
                            'customer_update_time'=>$time
                    );
                    //商检状态同时审核通过
                    if ($customerData['ciq_status'] == 3) {
                        $customerUpdateData['customer_status'] = 2;
                    }
                    if(Service_Customer::update($customerUpdateData, $customerData['customer_id']) === false){
                        throw new Exception("企业备案ID[{$customerData['customer_id']}]更新状态失败");
                    }
                    //写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => self::$customsStatus[$bodyRow['feedback_flag']],
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

                //海关审核不通过
                if($bodyRow['feedback_flag'] == '04'){
                    /*
                    $row = array(
                        'api_type'=>'receive',
                        'am_status'=>'4',//审核不通过
                        'receiving_time'=>$date
                    );
                    if(Service_ApiMessage::update($row, $apiId['am_id'], 'am_id') === false){
                        throw new Exception("企业备案审核回执api_messageID[{$apiId['am_id']}]状态更新失败");
                    }
                    */
                    $customerUpdateData = array(
                            'customs_status'=>self::$customsStatus[$bodyRow['feedback_flag']],
                            'customer_status'=>'3',
                            'customer_update_time'=>$time
                    );
                    if(Service_Customer::update($customerUpdateData, $customerData['customer_id']) === false){
                        throw new Exception("企业备案ID[{$customerData['customer_id']}]更新状态失败");
                    }
                    //写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => self::$customsStatus[$bodyRow['feedback_flag']],
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
            }

            //暂停使用、停止使用
            if(in_array($customerData['customs_status'], self::$fromStatus['suspendFromStatus'])){
                if($bodyRow['feedback_flag'] == '05' || $bodyRow['feedback_flag'] == '07'){
                        /*
                        $amStatus = ($bodyRow['feedback_flag'] == '05') ? 6 : 7;
                        $row = array(
                            'api_type'=>'receive',
                            'am_status'=>$amStatus,//6.暂停使用7.停止使用
                            'receiving_time'=>$date
                        );
                        if(Service_ApiMessage::update($row, $apiId['am_id'], 'am_id') === false){
                            throw new Exception("企业备案审核回执api_messageID[{$apiId['am_id']}]状态更新失败");
                        }
                        */
                        $customerUpdateData = array(
                            'customs_status'=>self::$customsStatus[$bodyRow['feedback_flag']],
                            'customer_status'=>'3',
                            'customer_update_time'=>$time,
                        );
                        if(Service_Customer::update($customerUpdateData, $customerData['customer_id']) === false){
                            throw new Exception("企业备案ID[{$customerData['customer_id']}]更新状态失败");
                        }
                        //写入日志
                        $logRow = array(
                            'customer_id' => $customerData['customer_id'],
                            'customer_code' => $customerData['customer_code'],
                            'cl_from_status' => $customerData['customs_status'],
                            'cl_to_status' => self::$customsStatus[$bodyRow['feedback_flag']],
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
            }

            //恢复使用
            if(in_array($customerData['customs_status'], self::$fromStatus['recoveryFromStatus'])){
                if($bodyRow['feedback_flag'] == '08'){
                    /*
                    $row = array(
                        'api_type'=>'receive',
                        'am_status'=>'8',
                        'receiving_time'=>$date
                    );
                    if(Service_ApiMessage::update($row, $apiId['am_id'], 'am_id') === false){
                        throw new Exception("企业备案审核回执api_messageID[{$apiId['am_id']}]状态更新失败");
                    }
                    */
                    $customerUpdateData = array(
                            'customs_status'=>self::$customsStatus[$bodyRow['feedback_flag']],
                            'customer_update_time'=>$time
                    );
                    //商检审核通过 - 企业可用
                    if($customerData['ciq_status'] == 3){
                        $customerUpdateData['customer_status'] = 2;
                    }
                    if(Service_Customer::update($customerUpdateData, $customerData['customer_id']) === false){
                        throw new Exception("企业备案ID[{$customerData['customer_id']}]更新状态失败");
                    }
                    //写入日志
                    $logRow = array(
                        'customer_id' => $customerData['customer_id'],
                        'customer_code' => $customerData['customer_code'],
                        'cl_from_status' => $customerData['customs_status'],
                        'cl_to_status' => self::$customsStatus[$bodyRow['feedback_flag']],
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
            }
            self::$return['ask'] = 1;
            self::$return['message'] = "企业备案ID[{$customerData['customer_id']}]回执[{$bodyRow['feedback_flag']}]：队列处理成功";
        /*
        } catch (Exception $e) {
            self::$return['message'] = $e->getMessage();
        }
        */
        return self::$return;
    }
}
