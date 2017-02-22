<?php
class OrderReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //商检接收回执状态变化
    private static $sjreceiveStatus = array(
        //商检已接受
        'receive' => array(
            'fromStatus' => array('1', '3'),
            'toStatus' => '2',
        ),
        //商检接收失败
        'notpass' => array(
            'fromStatus' => array('1', '3'),
            'toStatus' => '3',
        ),
    );
    /**
     * @todo 订单商检回执处理接收回执
     */
    public static function recordCompaniesReceive(array $bodyRow, array $headRow)
    {
        $apiMessageData = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessageData)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        
        //获取订单信息
        $orderData = Service_Orders::getByFieldLock($apiMessageData['ref_id'], 'order_id', array('order_id', 'ciq_status', 'app_status'));
        if(empty($orderData)){
            throw new Exception("订单[{$apiMessageData['refer_code']}]不存在");
        }
        
        //状态代码 01已入库 02入库失败(报文格式错误、必填项不满足)
        if(trim($bodyRow['msg_code']) === '01'){
            //已发送 -> 接收入库
            $fromStatus = self::$sjreceiveStatus['receive']['fromStatus'];
            //待受理 商检已接收
            $toStatus = self::$sjreceiveStatus['receive']['toStatus']; 
            self::changeStatusByCondition($fromStatus, $toStatus, $orderData, $bodyRow);
        //入库失败
        }else if(trim($bodyRow['msg_code']) === '02'){
            //已发送 -> 接收入库失败
            $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
            $toStatus = self::$sjreceiveStatus['notpass']['toStatus']; 
            self::changeStatusByCondition($fromStatus, $toStatus, $orderData, $bodyRow);
        }else {
            echo '状态'.$bodyRow['msg_code'].'暂不处理';
        }
    }
    /**
     * [changeStatusByCondition 改变状态]
     * @param  [type] $forStatus [description]
     * @param  [type] $toStatus  [description]
     * @param  [type] $orderData [description]
     * @return [type]            [description]
     */
    protected static function changeStatusByCondition($fromStatus, $toStatus, $orderData, $bodyRow){
        if(empty($orderData)){
            throw new Exception('订单不存在');
        }
        $dateTime = date('Y-m-d H:i:s',time());
        if(in_array($orderData['ciq_status'], $fromStatus)){
            //更改状态
            $orderUpdateData = array(
                'ciq_status' => $toStatus,
                'update_time' => $dateTime,
                'ciq_reject_reason' => '',
            );
            if(trim($bodyRow['msg_code']) === '02'){
                $orderUpdateData['ciq_reject_reason'] = $bodyRow['msg_name'].':'.$bodyRow['msg_desc'];
            }
            if(Service_Orders::update($orderUpdateData, $orderData['order_id'], 'order_id') === false){
                throw new Exception('订单状态更新失败');
            }                
            $orderLog = array(
                    'order_id' => $orderData['order_id'],
                    'order_code' => $orderData['order_code'],
                    'ol_add_time' => $dateTime,
                    'user_id' => '0',
                    'ol_ip' => Common_Common::getIP(),
                    'ol_comments' => $bodyRow['msg_name'].':'.$bodyRow['msg_desc'],
                    'account_name' => 'system',
                    'ciq_status_from' => $orderData['ciq_status'],
                    'ciq_status_to' => $toStatus,
                    'status_type'=> '2',
                    'order_status_from' => $orderData['order_status'],
                    'order_status_to' => $orderData['order_status'],
            );
            if(Service_OrderLog::add($orderLog) === false){
                throw new Exception('订单日志写入异常');
            }
        }else {
            throw new Exception('该订单状态未到[发送商检]流程');
        }
    }
}