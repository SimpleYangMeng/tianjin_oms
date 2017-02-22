<?php

/**
*
*/
class TaxationGuaranteeSendMessage extends SendMessageParent
{
    protected $messageType = 'BAA003';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'TaxationGuarantee';
    //报文类型

    public function createMessage($itemRow)
    {
        $tgRow = Service_TaxationGuarantee::getByField($itemRow['ref_id'] , 'tg_id');
        if(empty($tgRow)){
            $this->_error = "税费担保ID:[{$itemRow['ref_id']}]不存在！";
            return false;
        }
        //税费担保类型 -- 汉字
        $gTypes = Service_TaxationGuaranteeProcess::getGtype('auto');
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $declaration = array(
                'SEQ_ID' => $tgRow['tg_id'],
                'G_TYPE' => $gTypes[$tgRow['g_type']],
                'CUSTOM_CODE' => $tgRow['customs_code'],
                'ENP_DM_CODE' => $tgRow['customer_code'],
                'ENP_DM_NAME' => $tgRow['customer_company_name'],
                'CURR' => $tgRow['currency_code'],
                'AMOUNT' => $tgRow['tg_value'],
                'AGENT_CODE' => $tgRow['storage_customer_code'],
                'AGENT_NAME' => $tgRow['storage_customer_company_name'],
                'G_ACCORDING' => $tgRow['guarantee_basis'],
                'NOTE_S' => $tgRow['note'],
                'GUARANTOR' => $tgRow['tg_bank_name'],
                'G_VALID_TIME' => date('YmdHis', strtotime($tgRow['tg_v_time'])),
                'G_PERIOD' => date('YmdHis', strtotime($tgRow['tg_limit_time'])),
        );
        $xmlArray['Declaration'] = array('Guarantee'=> $declaration);
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "税费担保ID:[{$itemRow['ref_id']}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }
}