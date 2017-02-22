<?php
/**
* 妥投接收回执 - simple
*/
class DeliveredReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );

    //状态切换
    private static $status = array(
        'change_before' => 6,
        'change_after' => 7
    );

    /*
     * [receiveReceipt 接收回执处理]
     * @param  array  $bodyRow [回执表体]
     * @param  array  $headRow [回执表头]
     * @return [type]          [description]
     */
    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
    	$formId = $bodyRow['form_id'];
        $apiMessage = Service_ApiMessage::getByField($formId);
        if(empty($apiMessage)){
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }
        /*
        //查询条件要确认
        $where = array(
                'log_no' => $bodyRow['form_id'],
                'logistic_customer_code' => $bodyRow['add_field']
        );
        $waybillData = Service_Waybill::getByWhere($where, array('app_status', 'wb_id', 'wb_code'));
        */
        $waybillData = Service_Waybill::getByField($apiMessage['ref_id']);
        if(empty($waybillData)){
           throw new Exception("运单ID:{$apiMessage['ref_id']}不存在");
           // self::$return['message'] = "运单ID:{$apiMessage['ref_id']}不存在";
           // return self::$return;
        }
        //待审核的修改状态
        if($waybillData['app_status'] == self::$status['change_before']){
            
            if($bodyRow['feedback_flag'] == '01'){
                //修改运单为接收妥投状态
                if(Service_Waybill::update(array('app_status' => self::$status['change_after'], 'update_time' => date('Y-m-d H:i:s')), $waybillData['wb_id']) === false){
                    throw new Exception("运单[{$waybillData['wb_code']}]更新状态失败");
                }
                $waybillLog = array(
                        'wb_id' => $waybillData['wb_id'],
                        'wb_code' => $waybillData['wb_code'],
                        'wb_status_from' => self::$status['change_before'],
                        'wb_status_to' => self::$status['change_after'],
                        'wb_add_time' => date('Y-m-d H:i:s'),
                        'user_id' => 0,
                        'wb_ip' => Common_Common::getRealIp(),
                        'wb_comments' => $bodyRow['feedback_mess'],
                        'account_name' => 'system',
                );
                if(Service_WaybillLog::add($waybillLog) === false){
                    throw new Exception('运单'.$waybillData['wb_code'].'日志写入异常');
                }
            }else {
                throw new Exception('回执标示'.$bodyRow['feedback_flag'].'不为已接收（01）');
            }
        }else {
            throw new Exception("运单[{$waybillData['wb_code']}]状态不为已妥投（6）");
        }
    }
}
