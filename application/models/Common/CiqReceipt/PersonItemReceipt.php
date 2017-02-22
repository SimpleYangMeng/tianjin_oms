<?php
/**
 * 物品清单回执处理
 */
class PersonItemReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );
    // 0:草单 3:已发送商检 5:商检已接收 6:已审核 7:审核不通过
    //商检接收回执状态变化
    private static $sjreceiveStatus = array(
        //商检已接受 -- 暂无用
        'receive' => array(
            'fromStatus' => array('3'),
            'toStatus' => '5',
        ),
        //审核通过
        'check'=>array(
            'fromStatus'=>array('5', '6', '7'),
            'toStatus'=>'6',
            'customs_status' => '6',
            //总的状态审核通过
            'totalStatus'=>'6'
        ),
        //商检审核失败
        'notpass' => array(
            'fromStatus' => array('5', '6', '7'),
            'toStatus' => '7',
            'customs_status' => '7',
            //总的状态审核通过
            'totalStatus'=>'7'
        ),
        'bkStatus'=>array(
            'fromStatus' => array('5'),
            'toStatus' => '8',
            'customs_status' => '7',
            //总的状态审核通过
            'totalStatus'=>'7'
        ),
    );
    /**
     * @todo 物品清单商检回执处理接收回执
     */
    public static function recordCompaniesReceive(array $bodyRow, array $headRow)
    {
        $time = date('Y-m-d H:i:s',time());
        $apiMessageData = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessageData)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        
        //获取物品清单信息
        $personItemData = Service_PersonItem::getByFieldLock($apiMessageData['ref_id'], 'pim_id');

        if(empty($personItemData)){
            throw new Exception("物品清单[{$apiMessageData['refer_code']}]不存在");
        }
        /**
        * 状态代码：                               
        *   1 电子审单通过
        *   2 人工审单通过
        *   3 退单
        *   4 放行
        *   5 部分放行
        *   6 截留
        *   7 销毁
        *   8 退运
        *   9 电子审单未通过 
        */
        switch (strtolower(trim($bodyRow['msg_code']))) {
            //电子审单通过
            //人工审单通过
            case '1':
            case '2':
                //已发送 -> 已接收
                $fromStatus = self::$sjreceiveStatus['receive']['fromStatus'];
                //待受理 商检已接收
                $toStatus = self::$sjreceiveStatus['receive']['toStatus']; 
                if(in_array($personItemData['ciq_status'], $fromStatus)){
                    //更改状态
                    $personItemUpdateData = array(
                        'ciq_status' => $toStatus,
                        'pim_update_time' => $time,
                        'ciq_reject_reason' => '',
                    );
                    if(Service_PersonItem::update($personItemUpdateData, $personItemData['pim_id'], 'pim_id') === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]更新状态[{$toStatus}]失败");
                    }
                    //物品清单日志
                    $personItemLog = array(
                        'pim_id' => $personItemData['pim_id'], 
                        'pim_code' => $personItemData['pim_code'],
                        'status_type' => '2', //商检状态变化日志
                        'pim_ciq_status_from' => $personItemData['ciq_status'],
                        'pim_ciq_status_to' => $toStatus,
                        'pil_add_time' => $time,
                        'user_id' => '-1',
                        'pil_ip' => Common_Common::getIP(),
                        'pil_comments' => '接收商检回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                        'account_name' => 'system',
                    );
                    if(Service_PersonItemLog::add($personItemLog) === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志[{$toStatus}]异常");
                    }
                }else {
                    throw new Exception('该物品清单状态未到[发送商检]流程!');
                }
                break;

            //退单
            case '3':
                //已发送 -> 审核不通过
                $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
                //待受理 商检已接收
                $toStatus = self::$sjreceiveStatus['notpass']['toStatus']; 
                if(in_array($personItemData['ciq_status'], $fromStatus)){
                    //更改状态 - 审核不通过 整个单不通过
                    $personItemUpdateData = array(
                        'status' => self::$sjreceiveStatus['notpass']['totalStatus'],
                        'ciq_status' => $toStatus,
                        'pim_update_time' => $time,
                        'ciq_reject_reason' => $bodyRow['msg_name'].':'.$bodyRow['msg_desc'],
                    );
                    if(Service_PersonItem::update($personItemUpdateData, $personItemData['pim_id'], 'pim_id') === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]更新状态[{$toStatus}]失败");
                    }
                    //物品清单日志
                    $personItemLog = array(
                        'pim_id' => $personItemData['pim_id'], 
                        'pim_code' => $personItemData['pim_code'],
                        'pim_ciq_status_from' => $personItemData['ciq_status'],
                        'pim_ciq_status_to' => $toStatus,
                        'pil_add_time' => $time,
                        'user_id' => '-1',
                        'pil_ip' => Common_Common::getIP(),
                        'pil_comments' => '接收商检回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                        'account_name' => 'system',
                    );
                    if(Service_PersonItemLog::add($personItemLog) === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志[{$toStatus}]异常");
                    }
                }else {
                    throw new Exception('该物品清单状态未到[发送商检]流程!');
                }
                break;
                
            //放行
            case '4':
                //已发送 -> 审核通过
                $fromStatus = self::$sjreceiveStatus['check']['fromStatus'];
                //待受理 商检已接收
                $toStatus = self::$sjreceiveStatus['check']['toStatus']; 
                if(in_array($personItemData['ciq_status'], $fromStatus)){
                    //更改状态
                    $personItemUpdateData = array(
                        'ciq_status' => $toStatus,
                        'pim_update_time' => $time,
                        'ciq_reject_reason' => '',
                    );
                    //海关也审核通过 - 更新整个状态为审核通过
                    if($personItemData['customs_status'] == self::$sjreceiveStatus['check']['customs_status']){
                        $personItemUpdateData['status'] = self::$sjreceiveStatus['check']['totalStatus'];
                    }
                    if(Service_PersonItem::update($personItemUpdateData, $personItemData['pim_id'], 'pim_id') === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]更新状态[{$toStatus}]失败");
                    }
                    //物品清单日志
                    $personItemLog = array(
                        'pim_id' => $personItemData['pim_id'], 
                        'pim_code' => $personItemData['pim_code'],
                        'status_type' => '2', //商检状态变化日志
                        'pim_ciq_status_from' => $personItemData['ciq_status'],
                        'pim_ciq_status_to' => $toStatus,
                        'pil_add_time' => $time,
                        'user_id' => '-1',
                        'pil_ip' => Common_Common::getIP(),
                        'pil_comments' => '接收商检回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                        'account_name' => 'system',
                    );
                    if(Service_PersonItemLog::add($personItemLog) === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志[{$toStatus}]异常");
                    }
                }else {
                    throw new Exception('该物品清单状态未到[发送商检]流程!');
                }
                break;
            //暂不处理 - 部分放行
            case '5':
                $logRow = array(
                    'pim_id' => $personItemData['pim_id'], 
                    'pim_code' => $personItemData['pim_code'],
                    'pim_ciq_status_from' => $personItemData['ciq_status'],
                    'pim_ciq_status_to' => $personItemData['ciq_status'],
                    'pil_add_time' => $time,
                    'user_id' => '-1',
                    'pil_ip' => Common_Common::getIP(),
                    'pil_comments' => '接收商检回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                    'account_name' => 'system',
                );
                if(!Service_ProductLog::add($logRow)){
                    throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志异常");
                }
                break;
            //审核不通过
            case '6':
            case '7':
            case '8':
            case '9':
                //已发送 -> 审核不通过
                $fromStatus = self::$sjreceiveStatus['notpass']['fromStatus'];
                //待受理 商检已接收
                $toStatus = self::$sjreceiveStatus['notpass']['toStatus']; 
                if(in_array($personItemData['ciq_status'], $fromStatus)){
                    //更改状态 - 审核不通过 整个单不通过
                    $personItemUpdateData = array(
                        'status' => self::$sjreceiveStatus['notpass']['totalStatus'],
                        'ciq_status' => $toStatus,
                        'pim_update_time' => $time,
                        'ciq_reject_reason' => $bodyRow['msg_name'].':'.$bodyRow['msg_desc'],
                    );
                    if(Service_PersonItem::update($personItemUpdateData, $personItemData['pim_id'], 'pim_id') === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]更新状态[{$toStatus}]失败");
                    }
                    //物品清单日志
                    $personItemLog = array(
                        'pim_id' => $personItemData['pim_id'], 
                        'pim_code' => $personItemData['pim_code'],
                        'pim_ciq_status_from' => $personItemData['ciq_status'],
                        'pim_ciq_status_to' => $toStatus,
                        'pil_add_time' => $time,
                        'user_id' => '-1',
                        'pil_ip' => Common_Common::getIP(),
                        'pil_comments' => '接收商检回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
                        'account_name' => 'system',
                    );
                    if(Service_PersonItemLog::add($personItemLog) === false){
                        throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志[{$toStatus}]异常");
                    }
                }else {
                    throw new Exception('该物品清单状态未到[发送商检]流程!');
                }
                break;
            default:
                echo '[暂不处理]';
                break;
        }
    }

    /**
     * [bkReceive 查验]
     * @param  array  $bodyRow [description]
     * @param  array  $headRow [description]
     * @return [type]          [description]
     */
    public static function bkReceive(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s', time());
        $apiMessageData = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessageData)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        //获取物品清单信息
        $personItemData = Service_PersonItem::getByFieldLock($apiMessageData['ref_id'], 'pim_id');
        if(empty($personItemData)){
            throw new Exception("物品清单[{$apiMessageData['refer_code']}]不存在");
        }
        if($bodyRow['msg_code'] == '1'){
            //插入待检队列
            $ccm_row = array(
                'pim_code' => $personItemData['pim_code'],
                'ccm_add_time' => date('Y-m-d H:i:s')
            );
            if(Service_CiqCheckMessage::add($ccm_row) === false){
                throw new Exception("物品清单[{$personItemData['pim_code']}]插入检疫待查队列异常");
            }
        }
        $updateRow = array(
            'check' => $bodyRow['msg_code'],
            'pim_update_time' => $time,
        );
        if(!Service_PersonItem::update($updateRow, $personItemData['pim_id'])){
            throw new Exception("物品清单[{$personItemData['pim_code']}]更新查验状态失败");
        }
        //物品清单日志
        $personItemLog = array(
            'pim_id' => $personItemData['pim_id'],
            'pim_code' => $personItemData['pim_code'],
            'status_type' => '2', //商检状态变化日志
            'pim_status_from' => $personItemData['customs_status'],
            'pim_status_to' => $personItemData['customs_status'],
            'pim_ciq_status_from' => $personItemData['ciq_status'],
            'pim_ciq_status_to' => $personItemData['ciq_status'],
            'pil_add_time' => $time,
            'user_id' => '0',
            'account_name' => 'system',
            'pil_ip' => Common_Common::getIP(),
            'pil_comments' => '接收商检查验回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
        );
        if(Service_PersonItemLog::add($personItemLog) === false){
            throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志[{$toStatus}]异常");
        }
        self::$return['ask'] = 1;
        self::$return['message'] = "物品清单[{$personItemData['pim_code']}]处理查验[231]回执成功";
        return self::$return;
    }

    /**
     * [ReceivingQuarantine 物品清单检疫 231 ] -- 检疫合格和不合格是否需要暂停物品清单总状态
     * @param array $bodyRow [description]
     * @param array $headRow [description]
     */
    public static function QuarantineReceiv(array $bodyRow, array $headRow){
        $time = date('Y-m-d H:i:s', time());
        $apiMessageData = Service_CiqApiMessage::getByField($bodyRow['from_id']);
        if(empty($apiMessageData)){
            throw new Exception("队列消息体{$bodyRow['from_id']}不存在");
        }
        //获取物品清单信息
        $personItemData = Service_PersonItem::getByFieldLock($apiMessageData['ref_id'], 'pim_id');
        if(empty($personItemData)){
            throw new Exception("物品清单[{$apiMessageData['refer_code']}]不存在");
        }
        $updateRow = array(
            'quarantine' => $bodyRow['msg_code'],
            'pim_update_time' => $time,
        );
        if(!Service_PersonItem::update($updateRow, $personItemData['pim_id'])){
            throw new Exception("物品清单[{$personItemData['pim_code']}]更新检疫状态失败");
        }
        //物品清单日志
        $personItemLog = array(
            'pim_id' => $personItemData['pim_id'],
            'pim_code' => $personItemData['pim_code'],
            'status_type' => '2', //商检状态变化日志
            'pim_status_from' => $personItemData['customs_status'],
            'pim_status_to' => $personItemData['customs_status'],
            'pim_ciq_status_from' => $personItemData['ciq_status'],
            'pim_ciq_status_to' => $personItemData['ciq_status'],
            'pil_add_time' => $time,
            'user_id' => '0',
            'account_name' => 'system',
            'pil_ip' => Common_Common::getIP(),
            'pil_comments' => '接收商检检疫回执['.$bodyRow['msg_name'].':'.$bodyRow['msg_desc'].']',
        );
        if(Service_PersonItemLog::add($personItemLog) === false){
            throw new Exception("物品清单[{$personItemData['pim_code']}]写入日志[{$toStatus}]异常");
        }
        self::$return['ask'] = 1;
        self::$return['message'] = "物品清单[{$personItemData['pim_code']}]处理检疫[231]回执成功";
        return self::$return;
    }
}