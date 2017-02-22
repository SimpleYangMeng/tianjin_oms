<?php
/**
* simple
*/
class PayOrderReceipt
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
                'pay_no' => $bodyRow['form_id'],
                'pay_customer_code' => $bodyRow['add_field']
        );
        $payOrderData = Service_PayOrder::getByWhere($where, array('po_id', 'app_status', 'po_code'));
        
        if(empty($payOrderData)){
           // throw new Exception("支付单:{$fromId}不存在");
           self::$return['message'] = "支付单:{$fromId}不存在";
           return self::$return;
        }
        //待审核的修改状态
        if($payOrderData['app_status'] == self::$status['change_before']){

            if($bodyRow['feedback_flag'] == '01'){
                //修改支付单为待审核状态
                $res = Service_PayOrder::update(array('app_status' => self::$status['change_after'], 'update_time' => date('Y-m-d H:i:s')), $payOrderData['po_id']);
                if(!$res){
                    throw new Exception("更新支付单[{$payOrderData['po_code']}]状态失败");
                }
                $orderLog = array(
                        'po_id' => $payOrderData['po_id'],
                        'po_code' => $payOrderData['po_code'],
                        'pl_status_from' => self::$status['change_before'],
                        'pl_status_to' => self::$status['change_after'],
                        'pl_add_time' => date('Y-m-d H:i:s'),
                        'user_id' => 0,
                        'pl_ip' => Common_Common::getRealIp(),
                        'pl_comments' => $bodyRow['feedback_mess'],
                        'account_name' => 'system',
                );
                if(Service_PayOrderLog::add($orderLog) === false){
                    throw new Exception("支付单[{$payOrderData['po_code']}]日志写入异常");
                }
            }else {
                throw new Exception("支付单[{$payOrderData['po_code']}]回执标示不为已接收(01)");
            }
        }else {
            throw new Exception("支付单[{$payOrderData['po_code']}]不为待已发送海关(4)");
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
