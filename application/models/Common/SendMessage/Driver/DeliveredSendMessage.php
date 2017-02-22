<?php
/**
* 发送妥投回执 - simple 
*/
class DeliveredSendMessage extends SendMessageParent
{
    protected $messageType = 'YTT001';
    //接口代码
    protected $apiCode = 'Delivered';
    //操作对应的状态
    protected $status = 0;

    public function createMessage($itemRow)
    {
        $waybillRow = Service_Waybill::getByField($itemRow['ref_id'] , 'wb_id');

        if(empty($waybillRow)){
            $this->_error = "运单:[{$itemRow['refer_code']}]不存在！";
            return false;
        }
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $declaration = array(
                'SEQID' => $waybillRow['wb_id'],
                'LOGNO' => $waybillRow['log_no'],
                'APPTYPE' => $waybillRow['app_type'],
                'IE_TYPE' => $waybillRow['ie_type'],
                'LOGISTICSCODE' => $waybillRow['logistic_customer_code'],
                'LOGISTICSNAME' => $waybillRow['logistic_enp_name'],
                'LOGISTICSSTATUS' => '已妥投',
                'DELIVERDATE' => date('YmdHis', strtotime($waybillRow['delivered_time'])),
                'NOTE_S' => $waybillRow['delivered_comment']
        );
        $xmlArray['Declaration'] = array('Info'=> $declaration);
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "运单:[{$itemRow['refer_code']}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }

    public function handleReceipt($receiveReceipt)
    {
        # code...
    }


}


