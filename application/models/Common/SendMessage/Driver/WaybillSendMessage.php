<?php

/**
*
*/
class WaybillSendMessage extends SendMessageParent
{
    protected $messageType = 'BIL002';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'Waybill';
    //报文类型

    public function createMessage($itemRow)
    {
        $waybillRow = Service_Waybill::getByField($itemRow['ref_id'] , 'wb_id');
        if(empty($waybillRow)){
            $this->_error = "运单:[{$itemRow['refer_code']}]不存在！";
            return false;
        }
        $condition = array(
            'customs_status_arr' =>array('1','2','3','4','5','6','7','8','9'),
            'wb_code'=>$itemRow['wb_code'],
        );
        $personItems = Service_PersonItem::getByCondition($condition,'*',1,1);
        if(empty($personItems)){
            $this->_error = "运单编号[{$itemRow['refer_code']}]物品清单不存在";
            return false;
        }else{
            $personItem = $personItems[0];
           /* if(!($personItem['status']=='1' && $personItem['is_comparison']=='1')){
                $this->_error = "物品清单[{$personItem['pim_code']}]必须已经对比并且对比通过！";
                return false;
            }*/
        }
        $country = Common_DataCache::getCountryByCode($waybillRow['consignee_country'],'country_code');
        $shipperCountry = Common_DataCache::getCountryByCode($waybillRow['shipper_country'],'country_code');
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $currency = Service_Currency::getByField($waybillRow['currency_code'],'currency_code');
        $declaration = array(
                'customsCode' => $waybillRow['customs_code'],
                'appType' => $waybillRow['app_type'],
                'appTime' => date('Ymdhis'),
                'appStatus' => $waybillRow['app_status'],
                'orderNo' => $waybillRow['reference_no'],
                'ebpCode' => $waybillRow['customer_code'],
                'ebpName' => $waybillRow['ebp_name'],
                'logisticsCode' => $waybillRow['logistic_customer_code'],
                'logisticsName' => $waybillRow['logistic_enp_name'],
                'logNo' => $waybillRow['log_no'],
        		//只取 I E - 12-11
                'ieFlag' => strtoupper(substr($waybillRow['ie_type'], -1, 1)),
                'trafMode' => $waybillRow['traf_mode'],
                'trafName' => $waybillRow['ship_name'],
                'voyageNo' => $waybillRow['voyage_no'],
                'billNo' => $waybillRow['bill_no'],
                'freight' => $waybillRow['freight'],
                'insureFee' => $waybillRow['insure_fee'],
                'currency' => !empty($currency)?$currency['currency_hs_code']:'',//$waybillRow['currency_code'],
                'weight' => $waybillRow['weight'],
                'netWt' => $waybillRow['net_weight'],
                'packNo' => $waybillRow['pack_no'],
                'parcelInfo' => $waybillRow['parcel_info'],
                'goodsInfo' => $waybillRow['goods_info'],
                'consignee' => $waybillRow['consignee'],
                'consigneeCountry' => $country['trade_country'],//$waybillRow['consignee_country'],
                'Province' => $waybillRow['consignee_province'],
                'City' => $waybillRow['consignee_city'],
                'District' => $waybillRow['consignee_district'],
                'consigneeAddress' => $waybillRow['consignee_address'],
                'consigneeTelephone' => $waybillRow['consignee_telephone'],
                'shipper' => $waybillRow['shipper'],
                'shipperAddress' => $waybillRow['shipper_address'],
                'shipperTelephone' => $waybillRow['shipper_telephone'],
                'shipperCountry' => $shipperCountry['trade_country'],//$waybillRow['shipper_country'],
                'note' => $waybillRow['note'],
        );
        $xmlArray['Declaration'] = array('Logistics'=> $declaration);
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


