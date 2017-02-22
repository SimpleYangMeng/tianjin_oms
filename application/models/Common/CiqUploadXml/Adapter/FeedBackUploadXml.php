<?php

/**
*
*/
class FeedBackUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    protected $apiCode = 'FeedBack';
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
    	$feedBackData = Service_Feedback::getByField($itemRow['ref_id'], 'feedback_id');
    	if(empty($feedBackData)){
            $this->_error = "咨询投诉ID:[{$itemRow['ref_id']}]不存在！";
            return false;
        }
        /*
        $customerRow = Service_Customer::getByField($FeedBackInfo['pay_customer_code'], 'customer_code');
        if(empty($customerRow)){
            $this->_error = "商检备案号reference_no:[{$itemRow['ciq_reg_num']}]不存在！";
            return false;
        }
        */
        //属地检验检疫机构代码
        $this->_insUnitCode = '120010';
        $feedBackInfo = array(
            'ConsultComplainDocument'=>array(
        		//支付单备案代理信息
        		'ConsultComplainHead' => array(
        				'CC_SERIAL_NO' => $feedBackData['feedback_id'],
        				'CC_TYPE' => $feedBackData['message_type'],
        				'CC_QUESTION' => $feedBackData['message'],
        				'CC_STATUS' => $feedBackData['ciq_status'],
        		),
            ),
        );
	// echo '<pre>';
	// print_r($feedBackInfo);
	// return false;
        return $feedBackInfo;
    }
}
