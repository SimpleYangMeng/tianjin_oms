<?php
/**
* 运单接收 - simple
*/
class WaybillReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );

    //状态切换
    private static $status = array(
        'change_before' => 4,
        'change_after' => 5
    );

    /*
     * [receiveReceipt 接收回执处理]
     * @param  array  $bodyRow [回执表体]
     * @param  array  $headRow [回执表头]
     * @return [type]          [description]
     */
    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        $where = array(
                'log_no' => $bodyRow['form_id'],
                'logistic_customer_code' => $bodyRow['add_field']
        );
        $waybillData = Service_Waybill::getByWhere($where, array('app_status', 'wb_id', 'wb_code'));
        if(empty($waybillData)){
           // throw new Exception("运单:{$fromId}不存在");
           self::$return['message'] = "运单:{$where['log_no']}不存在";
           return self::$return;
        }
        //待审核的修改状态
        if($waybillData['app_status'] == self::$status['change_before']){
            
            if($bodyRow['feedback_flag'] == '01'){
                //修改运单为待审核状态
                if(Service_Waybill::update(array('app_status' => self::$status['change_after'], 'update_time' => date('Y-m-d H:i:s')), $waybillData['wb_id']) === false){
                    throw new Exception("更新运单状态失败");
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
                    throw new Exception('运单日志写入异常');
                }
            }else {
                throw new Exception('回执标示不为已接收（01）');
            }
        }else {
            throw new Exception("运单不为待已发送海关（4）");
        }
    }

    /**
     * 审核回执处理
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function receiveExamine(array $bodyRow, array $headRow)
    {        
        echo '暂时没有审核回执';
    }
}
