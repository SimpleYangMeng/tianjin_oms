<?php

/**
*
*/
class WayBillUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    //接口代码 WayBill->接口代码
    protected $apiCode = 'WayBill';
    
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
        $wayBillData = Service_Waybill::getByField($itemRow['ref_id'] , 'wb_id');
        if(empty($wayBillData)){
            $this->_error[] = "运单[{$itemRow['ref_cus_code']}]不存在";
            return false;
        }

        if($wayBillData['logistic_customer_code'] != ''){
            $logisticsCustomerData = Service_Customer::getByField($wayBillData['logistic_customer_code'], 'customer_code');
            if(empty($logisticsCustomerData)){
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]物流企业编号[{$wayBillData['logistic_customer_code']}]不存在";
                return false;
            }
            if($logisticsCustomerData['ciq_reg_num'] == ''){
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]物流企业编号[{$wayBillData['logistic_customer_code']}]属地检验检疫机构代码为空";
                return false;
            }else {
                //属地检验检疫机构代码
                $this->_insUnitCode = $logisticsCustomerData['ins_unit_code'];
            }
        }else{
            $this->_error[] = "运单[{$itemRow['ref_cus_code']}]物流企业编号不存在";
            return false;
        }

        if($wayBillData['customer_code'] != ''){
            $ecp_code = Service_Customer::getByField($wayBillData['customer_code'],'customer_code','ciq_reg_num');
            if(empty($ecp_code) || $ecp_code['ciq_reg_num'] == ''){
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]电商平台编号[{$wayBillData['customer_code']}]不存在";
                return false;
            }
        }else{
            $this->_error[] = "运单[{$itemRow['ref_cus_code']}]电商平台编号不存在";
            return false;
        }

        //目前存的是ship_name ，以后可能会改成存ship_code
        if(!isset($wayBillData['ship_code'])){
            if($wayBillData['ship_name'] != ''){
                $ship_code_arr = Service_TrafTool::getByField($wayBillData['ship_name'],'traf_tool_name','traf_tool');
                if(empty($ship_code_arr) || $ship_code_arr['traf_tool'] == ''){
                    $this->_error[] = "运单[{$itemRow['ref_cus_code']}]运输工具编号ID[{$wayBillData['ship_code']}]不存在";
                    return false;
                }
            }else{
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]运输工具编号为空";
                return false;
            }
        }else {
            if($wayBillData['ship_code'] != ''){
                $ship_code_arr['traf_tool'] = $wayBillData['ship_code'];
            }else{
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]运输工具编号ID[{$wayBillData['ship_code']}]不存在";
                return false;
            }
        }

        if(!empty($wayBillData['currency_code'])){
            $currency_code_arr = Service_Currency::getByField($wayBillData['currency_code'],'currency_code','b_bbd_currency_code');
            if(empty($currency_code_arr) || $currency_code_arr['b_bbd_currency_code'] == ''){
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]币值[{$wayBillData['currency_code']}]检验检疫编码不存在";
                return false;
            }
        }else{
            $this->_error[] = "运单[{$itemRow['ref_cus_code']}]币值编号不存在";
            return false;
        }

        if(!empty($wayBillData['shipper_country'])){
            $shipper_country_arr = Service_Country::getByField($wayBillData['shipper_country'],'country_code','b_bbd_country_code');
            if(empty($shipper_country_arr) || $shipper_country_arr['b_bbd_country_code'] == ''){
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]发货人所在国[{$wayBillData['shipper_country']}]检验检疫编码不存在";
                return false;
            }
        }else{
            $this->_error[] = "运单[{$itemRow['ref_cus_code']}]发货人所在国不存在";
            return false;
        }

        if(!empty($wayBillData['consignee_country'])){
            $consignee_country_arr = Service_Country::getByField($wayBillData['consignee_country'],'country_code','b_bbd_country_code');
            if(empty($consignee_country_arr) || $consignee_country_arr['b_bbd_country_code'] == ''){
                $this->_error[] = "运单[{$itemRow['ref_cus_code']}]收货人所在国[{$wayBillData['consignee_country']}]不存在";
                return false;
            }
        }else{
            $this->_error[] = "运单[{$itemRow['ref_cus_code']}]收货人所在国不存在";
            return false;
        }

        $billHead = array(
            'BILL_SERIAL_NO' => $wayBillData['wb_id'],
            'ORDER_NO'       => $wayBillData['order_code'],
            'LOGISTICS_NO'   => $wayBillData['log_no'],
            'MAIN_WB_NO'     => '',
            'LOGISTICS_CODE' => $logisticsCustomerData['ciq_reg_num'],
            'ECP_CODE'       => $ecp_code['ciq_reg_num'],
            'GET_WAYBILL_NO' => $wayBillData['bill_no'],
            'VOYAGE_NO'      => $wayBillData['voyage_no'],
            'TRANS_CODE'     => $ship_code_arr['traf_tool'],
            'FREIGHT'        => $wayBillData['freight'],
            'SUPPORT_VALUE'  => $wayBillData['insure_fee'],
            'CURRENCY_CODE'  => $currency_code_arr['b_bbd_currency_code'],
            'IE_TYPE'        => $wayBillData['ie_type'],
            'GOODS_NAME'     => $wayBillData['goods_info'],
            'COUNT_NUM'      => $wayBillData['pack_no'],
            'WEIGHT'         => $wayBillData['weight'],
            'NET_WEIGHT'     => $wayBillData['net_weight'],
            'CONSIGNOR_NAME' => $wayBillData['shipper'],
            'CONSIGNOR_TEL'  => $wayBillData['shipper_telephone'],
            'CONSIGNOR_ADDRESS'       => $wayBillData['shipper_address'],
            'CONSIGNOR_COUNTRY_CODE'  => $shipper_country_arr['b_bbd_country_code'],
            'CONSIGNEE_NAME' => $wayBillData['consignee'],
            'CONSIGNEE_TEL'  => $wayBillData['consignee_telephone'],
            'CONSIGNEE_ADDRESS'       => $wayBillData['consignee_address'],
            'CONSIGNEE_COUNTRY_CODE'  => $consignee_country_arr['b_bbd_country_code'],
            'REMARK'         => $wayBillData['note'],
        );
        $MessageBody = array(
            'BillDocument'=>array(
                'BillHead'=>$billHead
            ),
        );
        // echo '<pre>';
        // print_r($MessageBody);
        // return false;
        return $MessageBody;
    }
}
