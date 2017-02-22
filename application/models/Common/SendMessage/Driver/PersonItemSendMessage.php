<?php

/**
 * 自己拿着去测试
 * 首先在SendMessage里建一个相关类
 * 要定义的变量有 status _status apiCode
 * 要定义的方法有  createMessage handleReceipt
 * 里面有了一个 PersonItem 例子
 * 调用如下
 *public function sendmessageAction()
 *    {
 *            try {
 *                $object = Common_SendMessage::getInstance('PersonItem');
 *                //发送报文
 *                $object->sendMessage();
 *                //获取回执
 *                // $object->getReceipt();
 *            } catch (Exception $e) {
 *                echo $e->getMessage();
 *            }
 *    }
 */

class PersonItemSendMessage extends SendMessageParent
{
    protected $messageType = 'BUS002';
    //操作对应的状态
    /*protected $status = array(
    'sendMessage' => 0,
    'getReceipt' => 1
    );*/
    //当前操作
    protected $status = 0;
    //接口代码
    protected $apiCode = 'PersonItem';
    //报文类型

    protected $hgStatus = array(
        'order_status'   => 4, //订单海关已接受状态
        'waybill_status' => 5, //运单海关已接收状态
        'pay_status'     => 5, //支付单已接收状态
    );

    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createMessage($itemRow)
    {
        $row = Service_PersonItem::getByField($itemRow['ref_id'], 'pim_id');
		//echo $row['pim_code'];
        //exit;
        if (empty($row)) {
            $this->_error = "个人物品清单[{$itemRow['ref_id']}]不存在！";
            return false;
        }
        $xmlArray         = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        //$country = Common_DataCache::getCountryByCode($productRow['country_code_of_origin']);

        //$currency = Service_Currency::getByField($productRow['currency_code'],'currency_code');

        //$goodsTax = Service_GoodsTax::getByField($productRow['gt_code'],'gt_code');
        //查找账册
        $warehouseCondition = array(
            'customer_code' => $row['storage_customer_code'],
            'ie_type'       => 'I',
            'warehouse_status'=>'5',
            'customs_code'  => $row['declare_ie_port'],
        );
        $warehouse = Service_Warehouse::getByCondition($warehouseCondition, '*', 1, 1);
        $ems_no    = ''; //电子账册号
        if (!empty($warehouse)) {
            $ems_no = $warehouse[0]['warehouse_code'];
        } else {
            $this->_error = '账册不存在';
        }
        //判断三单是否已接收回执
        //判断订单
        $orderStatus   = $this->hgStatus['order_status'];
        $waybillStatus = $this->hgStatus['waybill_status'];
        $payStatus     = $this->hgStatus['pay_status'];
        $order         = Service_Orders::getByField($row['order_code'], 'order_code');
        if (empty($order)) {
            $this->_error = '订单不存在';
        } else {
            if ($order['order_status'] != $orderStatus) {
                $this->_error = "订单{$row['order_code']},海关尚未接收";
                return false;
            }
        }

        $waybill = Service_Waybill::getByField($row['wb_code'], 'wb_code');
        if (empty($waybill)) {
            $this->_error = '物流单不存在';
        } else {
            if ($waybill['app_status'] != $waybillStatus) {
                $this->_error = "物流单{$row['wb_code']},海关尚未接收";
            }
        }
        //支付单
        $payOrder = Service_PayOrder::getByField($row['po_code'], 'po_code');
        if (empty($payOrder)) {
            $this->_error = '支付单不存在';
        } else {
            if ($payOrder['app_status'] != $payStatus) {
                $this->_error = "支付单{$row['po_code']},海关尚未接收";
            }
        }
        if (!empty($this->_error)) {
            return false;
        }
        //发件人国别
        $ship_trade_country = '';
        if ($row['ship_trade_country_id']) {
            $country = Service_Country::getByField($row['ship_trade_country_id']);
            if (!empty($country)) {
                $ship_trade_country = $country['trade_country'];
            }
        }
        $receive_country_id = '';
        if ($row['receive_country_id']) {
            $country = Service_Country::getByField($row['receive_country_id']);
            if (!empty($country)) {
                $receive_country_id = $country['trade_country'];
            }
        }
        //默认传汽车
        $traf_name = '汽车';
        $traf_mode = $row['traf_mode'];
        if ($row['traf_mode'] != '') {
            $trafMode = Service_TrafMode::getByField($row['traf_mode'],'tfm_id');
            $traf_mode = $trafMode['traf_mode'];
        }

        //启运国
        $start_country = '';
        if ($row['outset_country_id']) {
            $country = Service_Country::getByField($row['outset_country_id']);
            if (!empty($country)) {
                $start_country = $country['trade_country'];
            }
        }
        //抵运国家
        $trade_country = '';
        if ($row['aim_country_id']) {
            $country = Service_Country::getByField($row['aim_country_id']);
            if (!empty($country)) {
                $trade_country = $country['trade_country'];
            }
        }

        //获取商品信息
        $personProductCondition = array(
            'pim_id' => $row['pim_id'],
        );
        $personItemProduct = Service_PersonItemProduct::getByCondition($personProductCondition, '*');
        $personItemProduct = Service_PersonItemProduct::productMerge($personItemProduct);

        //修改为customs_reg_num
        $storageCustomer = Service_Customer::getByField($row['storage_customer_code'], 'customer_code');
        //$dsCustomer = Service_Customer::getByField($row['customer_code'],'customer_code');
        $bilLists = array();
        //物流企业
        $logisticCustomer = array();
        if($row['logistic_customer_code']){
            $logisticCustomer = Service_Customer::getByField($row['logistic_customer_code'], 'customer_code');
        }
        foreach ($personItemProduct as $key => $p) {
            $country                   = Common_DataCache::getCountryByCode($p['country'], 'country_code');
            $currency                  = Service_Currency::getByField($p['curr'], 'currency_code');
            $product = Service_Product::getByField($p['registerID'],'registerID');
            $bilList['FORM_ID']        = $p['pim_code'];
            $bilList['CODE_TX']        = '';//$p['gt_code'];
            $bilList['CUS_GOODS_ID']   = $p['registerID'];
            $bilList['G_NO']           = $p['g_no'];
            $bilList['GOODS_ID']       = $p['goods_id'];
            $bilList['CODE_TS']        = $p['hs_code'];
            $bilList['DECL_TOTAL']     = $p['total_price'];
            $bilList['CURR']           = !empty($currency) ? $currency['currency_hs_code'] : ''; //$p['curr'];
            $bilList['G_NAME_CN']      = $p['g_name_cn'];
            $bilList['G_MODEL']        = $p['g_model'];
            $bilList['G_QTY']          = $p['g_qty'];
            $bilList['G_UNIT']         = $p['g_uint'];
            $bilList['DECL_PRICE']     = $p['price'];
            $bilList['ORIGIN_COUNTRY'] = $country['trade_country'];
            $bilList['ITEM_NO']         = $p['product_sku'];
            $bilList['ITEM_NAME']       = $product['product_title'];
            $bilList['BAR_CODE']        = $p['product_barcode'];
            $bilList['QTY1']             = $p['qty_1'];
            $bilList['UNIT1']            = $p['unit_1'];
            $bilList['QTY2']             = $p['qty_2'];
            $bilList['UNIT2']            = $p['unit_2'];
            $bilList['CUSTOMS_RATE']    = '';
            $bilList['CUSTOMS_DUTY']    = '';
            $bilList['VALUE_ADDED_RATE'] = '';
            $bilList['VALUE_ADDED_TAX']  = '';
            $bilList['CONSUMPTION_RATE'] = '';
            $bilList['CONSUMPTION_TAX']  = '';
            $bilList['POST_TAX_RATE']    = '';
            $bilLists[]                = $bilList;
        }
        $declaration = array(
            'BillHead' => array(
                'DECL_PORT'             => $row['declare_ie_port'],
                'FORM_ID'               => $row['pim_code'],
                'FORM_TYPE'             => $row['form_type'],
                'WH_CODE'               => $storageCustomer['customs_reg_num'], //$row['storage_customer_code'],
                'WH_NAME'               => $row['storage_name'],
                'EBCCODE'               => $row['customer_code'], //$dsCustomer['customs_reg_num'],//$row['customer_code'],
                'EBCNAME'               => $row['enp_name'],
                'AGENT_CODE'            => $row['agent_customer_code'],
                'AGENT_NAME'            => $row['agent_name'],
                'ORDER_NO'              => $row['order_reference_no'],
                'SENDER'                => $row['ship_name'],
                'SENDER_COUNTRY'        => $ship_trade_country,
                'SENDER_CITY'           => $row['ship_city'],
                'RECEIVER'              => $row['receive_name'],
                'RECEIVER_COUNTRY'      => $receive_country_id,
                'RECEIVER_CITY'         => $row['receive_city'],
                'RECEIVER_IDENTITYCARD' => $row['receive_id_number'],
                'RECEIVER_TEL'          => $row['receive_telphone'],
                'INPUT_COMPANY'         => $row['input_company'],
                'DECLARE_NO'            => $row['declare_no'],
                'AGENT_ADDRESS'         => $row['agent_address'],
                'AGENT_POST'            => $row['agent_post'],
                'AGENT_TEL'             => $row['agent_tel'],
                'LOGISTICS_NO'          => $row['log_no'],
                'PAYMENT_NO'            => $row['pay_no'],
                'TRS_FEE'               => $row['freight'],
                'INSUR_FEE'             => $row['insure_fee'],
                'CUSTOMS_FIELD'         => $row['customs_field'],
                'I_E_PORT'              => $row['ie_port'],
                'TRAF_NAME'             => '',//运输工具名称，传空
                'NET_WT'                => $row['net_wt'],
                'WRAP_TYPE'             => $row['wrap_type'],
                'I_E_DATE'              => date("YmdHis", strtotime($row['i_e_date'])),
                'TRAF_MODE'             => $traf_mode,
                'INPUT_DATE'            => date("YmdHis", strtotime($row['input_date'])),
                'INPUT_NO'              => $row['input_no'],
                'GROSS_WT'              => $row['gross_wt'],
                'EMS_NO'                => $ems_no,
                'START_COUNTRY'         => $start_country,
                'TRADE_COUNTRY'         => $trade_country,
                'PACK_NO'               => $row['pack_no'],
                'D_DATE'                => date("YmdHis", strtotime($row['declare_date'])),
                'REMARK'                => $row['note'],
                'COP_NO'                => $row['pim_reference_no'],//新增企业内部编号
                'PRE_NO'                => '',//新增预录入编号,默认为空
                'ASSURE_CODE'          => $row['customer_code'],//新增担保企业编号,默认为电商企业代码
                'EBP_CODE'             => $row['ebp_code'],//新增电商平台代码
                'EBP_NAME'             => $row['ebp_name'],//新增电商平台名称
                'LOGISTICS_CODE'      => $row['logistic_customer_code'],//新增物流企业编码
                'LOGISTICS_NAME'      => $logisticCustomer['trade_name'],//新增物料企业名称
                'I_E_FLAG'             => 'I',//新增进出口标记默认进口
                'BUYER_ID_TYPE'       => '1', //新增订购人证件类型,默认身份证
                'BUYER_ID'            => $row['buyer_id'], //新增订购人证件号码
                'BUYER_NAME'          => $row['buyer_name'], //新增订购人姓名
                'CONSIGNEE_PHONE'    => $row['receive_telphone'], //新增收件人电话
                'CONSIGNEE_ADDR'     => $row['receive_state'].'(省)'.$row['receive_city'].'(市)'.$row['receiving_address'], //新增收件人地址 省份 + 城市
                'TRADE_MODE'         => '1210', //新增贸易方式
                'VOYAGE_NO'          => '', //新增航班航次号,默认为空
                'BILL_NO'            => '', //新增提运单号，默认为空
                'LICENSE_NO'         => $row['customs_field'],//新增监管场所代码
                'CURRENCY'           => '142', //新增币制，默认rmb
                'TOTAL_TAX'          => '', //税款总额
                'TOTAL_PRICE'        => '', //
                'CUSTOMS_TAX'        => '', //
                'CONSUMER_TAX'       => '', //
                'VALUE_ADD_TAX'      => '', //
                'BillList'              => $bilLists,
            ),
        );
        $xmlArray['Declaration'] = $declaration;
        /*print_r($xmlArray);
        ciq_g_no
        exit;*/

        $message = Common_Message::cearteMessage($xmlArray);
        if ($message === false) {
            $this->_error = "个人物品清单[{$itemRow['ref_cus_code']}] " . Common_Message::getError();
            return false;
        }
        return $message;
    }

    /**
     * [analyzeReceiveReceipt description]
     * @param  [type] $receiveReceipt [description]
     * @return [type]                 [description]
     */
    protected function handleReceipt($xmlArray)
    {
        // 发送报文
        if ($this->_status == 'sendMessage') {
            // 报文发送成功要做的操作

        } else {
            // 获取报文回执
            // 根据回执修改数据库
        }

    }

}
