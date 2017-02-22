<?php

/**
*
*/
class GoodsListSendMessage extends SendMessageParent
{
    protected $messageType = 'BUS005';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'GoodsList';
    //报文类型

    public function createMessage($itemRow)
    {
        $row = Service_GoodsList::getByField($itemRow['ref_id'] , 'gl_id');
        if(empty($row)){
            $this->_error = "货物清单:[{$itemRow['refer_code']}]不存在！";
            return false;
        }
        $warehouseCondition = array(
            'customer_code'=>$row['agent_customer_code'],
            'ie_type'=>'E',
            'customs_code'=>$row['declare_ie_port'],
        );
        $warehouse = Service_Warehouse::getByCondition($warehouseCondition,'*',1,1);
        $ems_no =''; //电子账册号
        if(!empty($warehouse)){
            $ems_no = $warehouse[0]['warehouse_code'];
        }else{
            $this->_error = '账册不存在';
            return false;
        }
        $trade_country = '';
        if($row['departure_or_destination_country']){
            $country = Service_Country::getByField($row['departure_or_destination_country']);
            if(!empty($country)){
                $trade_country = $country['trade_country'];
            }
        }
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        //获取商品信息
        $condition = array(
            'gl_id'=>$row['gl_id'],
        );
        $goodListDetail = Service_GoodsListDetail::getByCondition($condition,'*');
        $bilLists = array();
        foreach($goodListDetail as $key=>$p){
            $bilList['FORM_ID'] = $p['gl_code'];
            $bilList['CODE_TX'] = $p['code_tx'];
            $bilList['CUS_GOODS_ID'] =  $p['register_id'];
            $bilList['G_NO']        =   $p['g_no'];
            $bilList['GOODS_ID']        =   $p['goods_id'];
            $bilList['CODE_TS']        =    $p['hs_code'];
            $bilList['DECL_TOTAL']     =    $p['total_price'];
            $bilList['CURR']        =   $p['currency'];
            $bilList['G_NAME_CN']    =  $p['g_name_cn'];
            $bilList['G_MODEL']        =    $p['g_model'];
            $bilList['G_QTY']        =  $p['g_qty'];
            $bilList['G_UNIT']        = $p['g_unit'];
            $bilList['DECL_PRICE']        = $p['price'];
            $bilList['BAR_CODE']        = $p['product_barcode'];
            $bilList['ORIGIN_COUNTRY']        = $p['country'];
            $bilLists[] = $bilList;
        }
        $declaration = array(
            'BillHead'=>array(
                'DECL_PORT'=>$row['declare_ie_port'],
                'ORDER_NO'=>$row['order_reference_no'],
                'FORM_ID'=>$row['gl_code'],
                'FORM_TYPE'=>$row['form_type'],
                'TRADE_CODE'=>$row['storage_customer_code'],
                'TRADE_NAME'=>$row['storage_name'],
                'ENP_CODE'=>$row['customer_code'],
                'ENP_NAME'=>$row['enp_name'],
                'AGENT_NAME'=>$row['agent_name'],
                'AGENT_CODE'=>$row['agent_customer_code'],
                'OWNER_CODE'=>$row['owner_code'],
                'OWNER_NAME'=>$row['owner_name'],
                'BILL_NO'=>$row['bill_no'],
                'TRAF_MODE'=>$row['traf_mode'],
                'TRAF_NAME'=>$row['traf_name'],
                'WRAP_TYPE'=>$row['wrap_type'],
                'CUS_LICENSE'=>$row['cus_license'],
                'GROSS_WT'=>$row['gross_weight'],
                'NET_WT'=>$row['net_weight'],
                'TRS_FEE'=>$row['freight'],
                'INSUR_FEE'=>$row['insure_fee'],
                'PACK_NO'=>$row['pack_no'],
                'INPUT_COMPANY'=>$row['input_company'],
                'INPUT_NO'=>$row['input_no'],
                'DECLARE_NO'=>$row['declare_no'],
                'AGENT_ADDRESS'=>$row['agent_address'],
                'AGENT_POST'=>$row['agent_post'],
                'AGENT_TEL'=>$row['agent_tel'],
                'CUSTOMS_FIELD'=>$row['customs_field'],
                'I_E_PORT'=>$row['ie_port'],
                'D_DATE'=>date('YmdHis',strtotime($row['declare_date'])),
                'EMS_NO'=>$ems_no,
                'LOAD_PORT'=>$row['port_of_departure'],
                'COUNTRY'=>$trade_country,
                'VOYNO'=>$row['flight_or_voyage_number'],
                'FILL_DATE'=>date('YmdHis',strtotime($row['filled_date'])),
                'LOGISTICS_NO'=>$row['log_no'],
                'PAYMENT_NO'=>$row['pay_no'],
                'BillList'=>$bilLists
            )
        );

        $xmlArray['Declaration'] = $declaration;
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "货物清单:[{$row['refer_code']}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }

    public function handleReceipt($receiveReceipt)
    {
        # code...
    }


}


