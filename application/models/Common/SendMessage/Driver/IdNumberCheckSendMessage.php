<?php

/**
*
*/
class IdNumberCheckSendMessage extends SendMessageParent
{

    protected $messageType = 'BIL004';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'IdNumberCheck';
    //报文类型

    public function createMessage($itemRow)
    {
        $idNumberCheckRow = Service_IdNumberCheck::getByField($itemRow['ref_id'] , 'inc_id');
        if(empty($idNumberCheckRow)){
            $this->_error = "身份证编号[{$itemRow['ref_cus_code']}]不存在！";
            return false;
        }
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $orderRow = Service_Orders::getByField($idNumberCheckRow['inc_id'], 'inc_id');
        if(empty($orderRow)){
            $this->_error = "无订单信息{$idNumberCheckRow['inc_id']}";
            return false;
        }
        $status = ($idNumberCheckRow['status'] == 2) ? 1 : 0;

        $declaration = array(
            'IDAuthentication'=>array(
                "appType" => "1" ,
                "appTime" =>  date('YmdHis') ,
                "appStatus" => 2 ,
                "appUid" => '',
                "appUname" => '' ,
                "authType" => "0" ,
                "authNo" => $idNumberCheckRow['inc_id'] ,
                "orderNo" => $orderRow["order_code"] ,
                "ebpCode" => $orderRow["customer_code"] ,
                "ebpName" => $orderRow["customer_name"] ,
                "authName" => $idNumberCheckRow["id_name"],
                "authID" =>  $idNumberCheckRow["idNumber"],
                "authOriginalNo" => '',
                "authOriginalResult" =>  $status,
                "authOriginalTime" => date('YmdHis') ,
                "note"=> ""
            )
        );
        $xmlArray['Declaration'] = $declaration;

        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "身份证编号[{$itemRow['ref_cus_code']}] ".Common_Message::getError();
            return false;
        }

        return $message;
    }

}
