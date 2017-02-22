<?php
/**
* simple
*/
class PayOrderSendMessage extends SendMessageParent
{
    protected $messageType = 'BIL003';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'PayOrder';
    //报文类型

    public function createMessage($itemRow)
    {
        $payOrderRow = Service_PayOrder::getByField($itemRow['ref_id'] , 'po_id');
        if(empty($payOrderRow)){
            $this->_error = "支付ID:[{$itemRow['po_id']}]不存在！";
            return false;
        }
        $condition = array(
            'customs_status_arr' =>array('1','2','3','4','5','6','7','8','9'),
            'po_code'=>$itemRow['po_code'],
        );
        $personItems = Service_PersonItem::getByCondition($condition,'*',1,1);
        if(empty($personItems)){
            $this->_error = "支付单号[{$itemRow['refer_code']}]物品清单不存在";
            return false;
        }else{
            $personItem = $personItems[0];
            $statusArr = array(
                '1',
                '3',
                '5'
            );
            /*if(!($personItem['status']=='1' && $personItem['is_comparison']=='1')){
                $this->_error = "物品清单[{$personItem['pim_code']}]必须已经对比并且对比通过！";
                return false;
            }*/
        }
        $currency = Service_Currency::getByField($payOrderRow['pay_currency_code'],'currency_code');
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $declaration = array(
                'appType' => $payOrderRow['app_type'],
                'appTime' => date('Ymdhis'),
                'appStatus' => $payOrderRow['app_status'],
                'payCode' => $payOrderRow['pay_customer_code'],
                'payName' => $payOrderRow['pay_enp_name'],
                'payNo' => $payOrderRow['pay_no'],
                'orderNo' => $payOrderRow['reference_no'],
                'ebpCode' => $payOrderRow['ecommerce_platform_customer_code'],
                'ebpName' => $payOrderRow['ecommerce_platform_customer_name'],
                'PayerName' => $payOrderRow['cosignee_name'],
                'PayerID' => $payOrderRow['cosignee_code'],
                'charge' => $payOrderRow['pay_amount'],
                'currency' => !empty($currency)?$currency['currency_hs_code']:'',//$payOrderRow['pay_currency_code'],
                'note' => $payOrderRow['note'],
                'ebcCode' => $payOrderRow['customer_code'],
                'ebcName' => $payOrderRow['enp_name'],
                'payer_id_type' => '1',
                'payer_phone' => $payOrderRow['cosignee_telephone'],
                'pay_date' => $payOrderRow['pay_time'],
        );
        $xmlArray['Declaration'] = array('Payment'=> $declaration);
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "支付ID:[{$itemRow['po_id']}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }
}


