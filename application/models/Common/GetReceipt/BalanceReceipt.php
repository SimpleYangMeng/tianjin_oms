<?php
/**
* 妥投接收回执 - simple
*/
class BalanceReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );

    //状态切换
    private static $status = array(
        'change_before' => 1,
        'change_after' => 2
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
        /*
        $apiMessage = Service_ApiMessage::getByField($formId);
        if(empty($apiMessage)){
            self::$return['message'] = "队列消息体{$formId}不存在";
            return self::$return;
        }
        */
        $balanceData = Service_Balance::getByField($formId, 'id_code');
        if(empty($balanceData)){
           throw new Exception("余额查询身份证:{$formId}不存在");
        }
        //待审核的修改状态
        if($balanceData['state'] == self::$status['change_before']){
            if($bodyRow['feedback_flag'] == '01'){
                $updateRow = array(
                    'state' => self::$status['change_after'], 
                    'update_time' => date('Y-m-d H:i:s'),
                    //余额
                    'balance' => $bodyRow['feedback_mess']
                );
                //修改余额信息
                if(Service_Balance::update($updateRow, $balanceData['b_id']) === false){
                    throw new Exception("余额查询[{$balanceData['customer_code']}-{$balanceData['id_code']}]更新[".self::$status['change_after']."]状态");
                }
            }else {
                throw new Exception('回执标示bodyId['.$bodyRow['bmb_id'].']'.'标示headId['.$bodyRow['bmh_id'].']'.$bodyRow['feedback_flag'].'不为已接收（01）');
            }
        }else {
            throw new Exception("余额查询[{$balanceData['customer_code']}-{$balanceData['id_code']}]状态不为已发送[".self::$status['change_before']."]");
        }
    }
}
