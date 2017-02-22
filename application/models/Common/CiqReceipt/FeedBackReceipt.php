<?php
class FeedBackReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    //商检接收回执状态变化
    private static $sjreceiveStatus = array(
        //已接收
        'accept' => array(
            'fromStatus' => array('0', '1'),
            'toStatus' => '1',
        ),
        //已回复
        'receive' => array(
            'fromStatus' => array('1', '3'),
            'toStatus' => '4',
        ),
        //申报失败
        'notpass' => array(
            'fromStatus' => array('1', '3'),
            'toStatus' => '2',
        ),
        //待回复
        'wait' => array(
            'fromStatus' => array('1'),
            'toStatus' => '3',
        ),
    );
    /**
     * @todo 咨询投诉回执
     */
    public static function feedBackReceive(array $bodyRow, array $headRow)
    {   
        $apiMessage = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessage)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        
        //获取备案信息
        $feedBackData = Service_Feedback::getByFieldLock($apiMessage['ref_id'], 'feedback_id', array('feedback_id', 'ciq_status'));

        if(empty($feedBackData)){
            throw new Exception("咨询投诉ID[{$apiMessage['ref_id']}]不存在");
        }

        switch (trim($bodyRow['msg_code'])) {
            case '1':
                //入库成功
                $fromStatus = self::$sjreceiveStatus['accept']['fromStatus'];
                $toStatus = self::$sjreceiveStatus['accept']['toStatus']; 
                if(in_array($feedBackData['ciq_status'], $fromStatus)){
                    //更改状态
                    $feedBackUpdateData = array(
                        'ciq_status' => $toStatus,
                        'receipt' => $bodyRow['msg_name'].','.$bodyRow['msg_desc'],
                    );
                    if(Service_Feedback::update($feedBackUpdateData, $feedBackData['feedback_id'], 'feedback_id') === false){
                        throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]更新状态[{$toStatus}]失败");
                    }                
                }else {
                    throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]未到[已发送/待回复]流程");
                }                
                break;

            case '2':
                //已发送 -> 申请失败
                $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
                $toStatus = self::$sjreceiveStatus['notpass']['toStatus']; 
                if(in_array($feedBackData['ciq_status'], $fromStatus)){
                    //更改状态
                    $feedBackUpdateData = array(
                        'ciq_status' => $toStatus,
                        'receipt' => $bodyRow['msg_name'].','.$bodyRow['msg_desc'],
                    );
                    if(Service_Feedback::update($feedBackUpdateData, $feedBackData['feedback_id'], 'feedback_id') === false){
                        throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]更新状态[{$toStatus}]失败");
                    }                
                }else {
                    throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]未到[已发送/待回复]流程");
                }                
                break;
            
            case '3':
                //已发送 -> 待回复
                $fromStatus = self::$sjreceiveStatus['wait']['fromStatus'];
                $toStatus = self::$sjreceiveStatus['wait']['toStatus']; 
                if(in_array($feedBackData['ciq_status'], $fromStatus)){
                    //更改状态
                    $feedBackUpdateData = array(
                        'ciq_status' => $toStatus,
                        'receipt' => $bodyRow['msg_name'].','.$bodyRow['msg_desc'],
                    );
                    if(Service_Feedback::update($feedBackUpdateData, $feedBackData['feedback_id'], 'feedback_id') === false){
                        throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]更新状态[{$toStatus}]失败");
                    }                
                }else {
                    throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]未到[已发送/待回复]流程");
                }                
                break;

            case '4':
                //已发送 -> 已回复
                $fromStatus = self::$sjreceiveStatus['receive']['fromStatus'];
                $toStatus = self::$sjreceiveStatus['receive']['toStatus']; 
                if(in_array($feedBackData['ciq_status'], $fromStatus)){
                    //更改状态
                    $feedBackUpdateData = array(
                        'ciq_status' => $toStatus,
                        'receipt' => $bodyRow['msg_name'].','.$bodyRow['msg_desc'],
                    );
                    if(Service_Feedback::update($feedBackUpdateData, $feedBackData['feedback_id'], 'feedback_id') === false){
                        throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]更新状态[{$toStatus}]失败");
                    }                
                }else {
                    throw new Exception("投诉建议ID[{$feedBackData['feedback_id']}]未到[已发送/待回复]流程");
                }
                break;
            default:
                echo '状态'.$bodyRow['msg_code'].'暂不处理';
                break;
        }
    }
}