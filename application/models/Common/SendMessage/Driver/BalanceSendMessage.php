<?php
/**
* 发送余额查询 - simple 
*/
class BalanceSendMessage extends SendMessageParent
{
    protected $messageType = 'LBQ001';
    //接口代码
    protected $apiCode = 'Balance';
    //操作对应的状态
    protected $status = 0;

    public function createMessage($itemRow)
    {
        $balanceRow = Service_Balance::getByField($itemRow['ref_id'] , 'b_id');
        if(empty($balanceRow)){
            $this->_error = "余额查询申请:[{$itemRow['b_id']}]-[{$itemRow['ref_cus_code']}]不存在";
            return false;
        }
        //关区代码
        $customerRow = Service_Customer::getByField($balanceRow['customer_code'], 'customer_code', array('customs_code'));
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $declaration = array(
                'ID' => $balanceRow['id_code'],
                'NAME' => $balanceRow['name'],
                'APPNO' => $customerRow['customs_code']
        );
        $xmlArray['Declaration'] = array('LBQ'=> $declaration);
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "余额查询申请:[{$itemRow['b_id']}]-[{$itemRow['ref_cus_code']}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }
}


