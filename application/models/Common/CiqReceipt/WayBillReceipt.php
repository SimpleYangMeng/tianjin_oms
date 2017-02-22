<?php
class WayBillReceipt
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
     * @todo 企业备案接收回执
     */
    public static function recordCompaniesReceive(array $bodyRow, array $headRow)
    {   
        $apiMessage = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        
        //获取备案信息
        $wayBillData = Service_Waybill::getByFieldLock($apiMessage['ref_id'], 'wb_id', array('wb_id', 'ciq_status', 'app_status'));

        if(empty($wayBillData)){
            throw new Exception("运单[{$bodyRow['receipt_no']}]不存在");
        }
        $time = date('Y-m-d H:i:s',time());

        switch (trim($bodyRow['msg_code'])) {
            case '01':
                //已发送 -> 接收入库
                $fromStatus = self::$sjreceiveStatus['receive']['fromStatus'];
                //待受理 商检已接收
                $toStatus = self::$sjreceiveStatus['receive']['toStatus']; 
                if(in_array($wayBillData['ciq_status'], $fromStatus)){
                    //更改状态
                    $wayBillUpdateData = array(
                        'ciq_status' => $toStatus,
                        'update_time' => $time,
                        'ciq_reject_reason' => '',
                    );
                    if(Service_WayBill::update($wayBillUpdateData, $bodyRow['receipt_no'], 'wb_id') === false){
                        throw new Exception('运单状态更新失败');
                    }                
                    $waybillLog = array(
                            'wb_id' => $wayBillData['wb_id'],
                            'wb_code' => $wayBillData['wb_code'],
                            'wb_status_from' => $wayBillData['app_status'],
                            'wb_status_to' => $wayBillData['app_status'],
                            'wb_ciq_status_from' => $wayBillData['ciq_status'],
                            'wb_ciq_status_to' => $toStatus,
                            'status_type' => '2',
                            'wb_add_time' => date('Y-m-d H:i:s'),
                            'user_id' => 0,
                            'wb_ip' => Common_Common::getRealIp(),
                            'wb_comments' => $bodyRow['msg_name'].':'.$bodyRow['msg_desc'],
                            'account_name' => 'system',
                    );
                    if(Service_WaybillLog::add($waybillLog) === false){
                        throw new Exception('运单日志写入异常');
                    }
                }else {
                    throw new Exception('该运单状态未到[已发送]流程!');
                }
                break;
            
            case '02':
                //已发送 -> 接收入库失败
                $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
                $toStatus = self::$sjreceiveStatus['notpass']['toStatus']; 
                if(in_array($wayBillData['ciq_status'], $fromStatus)){
                    //更改状态
                    $wayBillUpdateData = array(
                        'ciq_status' => $toStatus,
                        'update_time' => $time,
                        'ciq_reject_reason' => $bodyRow['msg_name'].':'.$bodyRow['msg_desc'],
                    );
                    if(Service_WayBill::update($wayBillUpdateData, $bodyRow['receipt_no'], 'wb_id') === false){
                        throw new Exception('运单状态更新失败');
                    }                
                    $waybillLog = array(
                            'wb_id' => $wayBillData['wb_id'],
                            'wb_code' => $wayBillData['wb_code'],
                            'wb_status_from' => $wayBillData['app_status'],
                            'wb_status_to' => $wayBillData['app_status'],
                            'wb_ciq_status_from' => $wayBillData['ciq_status'],
                            'wb_ciq_status_to' => $toStatus,
                            'status_type' => '2',
                            'wb_add_time' => date('Y-m-d H:i:s'),
                            'user_id' => 0,
                            'wb_ip' => Common_Common::getRealIp(),
                            'wb_comments' => $bodyRow['msg_name'].':'.$bodyRow['msg_desc'],
                            'account_name' => 'system',
                    );
                    if(Service_WaybillLog::add($waybillLog) === false){
                        throw new Exception('运单日志写入异常');
                    }
                }else {
                    throw new Exception('该运单状态未到[已发送]流程!');
                }                
                break;
            default:
                echo '状态'.$bodyRow['msg_code'].'暂不处理';
                break;
        }
    }
}