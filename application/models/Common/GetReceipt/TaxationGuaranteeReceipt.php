<?php
/**
* simple
*/
class TaxationGuaranteeReceipt
{

    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );

    private static $_PRIMARY = 'tg_id';
    //状态切换
    private static $status = array(
        //接收起始状态
        'receiveFromStatus' => array('2'),
        //审核起始状态
        'checkFromStatus' => array('3'),
        //暂停起始状态
        'suspendFromStatus' => array('4'),
        //恢复启用起始状态
        'recoveryFromStatus' => array('7'),
        //待审核
        'audit' => 2,
        //审核中
        'auditIng' => 3,
        //已审核
        'auditPass' => 4,
        //审核不通过
        'noPass' => 5,
        //暂停
        'suspend' => 7
    );
    
    /**
     * [receiveReceipt 接收回执处理]
     * @param  array  $bodyRow [回执表体]
     * @param  array  $headRow [回执表头]
     * @return [type]          [description]
     */
    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        $fromId = $bodyRow['form_id'];
        $tgData = Service_TaxationGuarantee::getByField($fromId, self::$_PRIMARY);
        if(empty($tgData)){
            //throw new Exception("税费担保ID:{$fromId}不存在");
            self::$return['message'] = "税费担保ID:{$fromId}不存在";
            return self::$return;
        }
        $receiveFromStatus = self::$status['receiveFromStatus'];
        $toStatus = self::$status['auditIng'];
        $note = $bodyRow['feedback_mess'];
        //待审核的修改状态
        if(in_array($tgData['status'], $receiveFromStatus)){
            if($bodyRow['feedback_flag'] == '01'){
                //修改税费担保为待审核状态
                if(Service_TaxationGuarantee::update(array('status' => $toStatus, 'note'=>$note), $fromId, self::$_PRIMARY) === false){
                    throw new Exception("更新税费担保ID[{$tgData['tg_id']}]状态为[{$toStatus}-审核中]失败");
                }
            }else {
                throw new Exception('回执标示不为已接收（01）');
            }
        }else {
            throw new Exception("税费担保不为待审核状态（1）");
        }
    }

    /**
     * 审核回执处理
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function receiveExamine(array $bodyRow, array $headRow)
    {   
        /*     
        if($bodyRow['feedback_flag'] != '03'){
            throw new Exception('回执标示不为已接收（03）');
        }
        */
        $fromId = $bodyRow['form_id'];
        $tgData = Service_TaxationGuarantee::getByField($fromId, self::$_PRIMARY);
        if(empty($tgData)){
            throw new Exception("税费担保ID:{$fromId}不存在");
        }
        $note = $bodyRow['feedback_mess'];
        $checkFromStatus = self::$status['checkFromStatus'];
        //审核状态修改
        if(in_array($tgData['status'], $checkFromStatus)){
            switch($bodyRow['feedback_flag']){
                //海关审核
                case '03':
                    $taxationStatus = self::$status['auditPass']; 
                    break;
                //海关审核不通过
                case '04':
                    $taxationStatus = self::$status['noPass']; 
                    break;
                default:
            }
            //审核通过
            if(isset($taxationStatus) && $taxationStatus != ''){
                if(Service_TaxationGuarantee::update(array('status' => $taxationStatus, 'note'=>$note), $fromId, self::$_PRIMARY) === false){
                    throw new Exception("税费担保ID[{$tgData['tg_id']}]更新为状态[{$taxationStatus}]失败");
                }
                /*
                //增加余额 -- 暂未写入余额记录表
                $customerBalanceData = Service_CustomerBalance::getByField($tgData['customer_code'], 'customer_code', array('cb_id', 'cb_value'));
                if(empty($customerBalanceData)){
                    $customerData = Service_Customer::getByField($tgData['customer_code'], 'customer_code', array('customer_id', 'customer_code'));
                    if(empty($customerData)){
                        throw new Exception("用户不存在");
                    }
                    $customerBalanceData = array(
                            'customer_id' => $customerData['customer_id'],
                            'customer_code' => $customerData['customer_code'],
                            'cb_value' => $tgData['tg_value'],
                            'cb_update_time' => date('Y-m-d H:i:s')
                    );                    
                    $addRes = Service_CustomerBalance::add($customerBalanceData);
                    if(!$addRes){
                        throw new Exception("余额添加失败");
                    }
                }else {
                    $cbValue = $customerBalanceData['cb_value'] + $tgData['tg_value'];
                    $updateRes = Service_CustomerBalance::update(array('cb_value'=>$cbValue), $tgData['customer_code'], 'customer_code');
                    if(!$updateRes){
                        throw new Exception("余额修改失败");
                    }
                }
                */
            }
        }

        //暂停状态修改 审核通过 -> 暂停
        if(in_array($tgData['status'], self::$status['suspendFromStatus'])){
            $taxationStatus = self::$status['suspend']; 
            //暂停使用
            if($bodyRow['feedback_flag'] == '05'){
                if(Service_TaxationGuarantee::update(array('status' => $taxationStatus, 'note'=>$note), $fromId, self::$_PRIMARY) === false){
                    throw new Exception("税费担保ID[{$tgData['tg_id']}]更新为状态[{$taxationStatus}]失败");
                }
            }
        }

        //恢复使用 暂停 -> 已审核
        if(in_array($tgData['status'], self::$status['recoveryFromStatus'])){
            $taxationStatus = self::$status['auditPass']; 
            //暂停使用
            if($bodyRow['feedback_flag'] == '08'){
                if(Service_TaxationGuarantee::update(array('status' => $taxationStatus, 'note'=>$note), $fromId, self::$_PRIMARY) === false){
                    throw new Exception("税费担保ID[{$tgData['tg_id']}]更新为状态[{$taxationStatus}]失败");
                }
            }
        }
    }
}
