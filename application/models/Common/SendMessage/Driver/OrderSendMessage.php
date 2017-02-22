<?php

/**
*
*/
class OrderSendMessage extends SendMessageParent
{

    protected $messageType = 'BIL001';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'Order';
    //报文类型

    public function createMessage($itemRow)
    {
        $ordersRow = Service_Orders::getByField($itemRow['ref_cus_code'] , 'order_code');
        if(empty($ordersRow)){
            $this->_error = "订单编号[{$itemRow['ref_cus_code']}]不存在！";
            return false;
        }
        $condition = array(
            'customs_status_arr' =>array('1','2','3','4','5','6','7','8','9'),
            'order_code'=>$itemRow['order_code'],
        );
        $personItems = Service_PersonItem::getByCondition($condition,'*',1,1);
        if(empty($personItems)){
            $this->_error = "订单编号[{$itemRow['ref_cus_code']}]物品清单不存在！";
            return false;
        }else{
            $personItem = $personItems[0];
            $statusArr = array(
                '1',
                '3',
                '5'
            );
            /*if(!(in_array($personItem['status'],$statusArr) && $personItem['is_comparison']=='1')){
                $this->_error = "物品清单[{$personItem['pim_code']}]必须已经对比并且对比通过！";
                return false;
            }*/
        }
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        
        $orderAddressBookRow = Service_OrderAddressBook::getByField($itemRow['ref_cus_code'] , 'order_code');
        $shipperCountry = Common_DataCache::getCountryByCode($orderAddressBookRow['consignee_country'],'country_code'); 
        $currency = Service_Currency::getByField($ordersRow['currency_code'],'currency_code');
        $declaration = array(
            'OrderBillHead' => array(
                "appType" => $ordersRow['app_type'],
                "appTime" => date("Ymdhis"),
                "appStatus" => $ordersRow['app_status'],
                "orderNo" => $ordersRow['reference_no'],
                "ebpCode" => $ordersRow['customer_code'],
                "ebpName" => $ordersRow['customer_name'],
                "ebcCode" => $ordersRow['ecommerce_platform_customer_code'],
                "ebcName" => $ordersRow['ecommerce_platform_customer_name'],
                "goodsValue" => $ordersRow['goods_amount'],
                "freight" => $ordersRow['freight'],
                "currency" => !empty($currency)?$currency['currency_hs_code']:'',//$ordersRow['currency_code'],
                "consignee" => $orderAddressBookRow['consignee'],
                "consigneeAddress" => $orderAddressBookRow['consignee_addres'],
                "consigneeTelephone" => $orderAddressBookRow['consignee_telephone'],
                "consigneeCountry" => $shipperCountry['trade_country'],//$orderAddressBookRow['consignee_country'],
                "ProAmount" => $ordersRow['pro_amount'],
                "ProRemark" => $ordersRow['pro_remark'],
                "note" => $ordersRow['note'],
                "order_type" => 'I',//新增订单类型默认进口
                "tax_total" => $ordersRow['tax_total'],//新增订单商品税款
                "actual_paid" => $ordersRow['acctual_paid'],//新增实际支付金额
                "buyer_reg_no" => $ordersRow['buyer_reg_no'],//新增订购人注册号
                "buyer_name" => $ordersRow['buyer_name'],//新增订购人姓名
                "buyer_id_type" => '1', //新增订购人证件类型默认为1身份证
                "buyer_id" => $ordersRow['buyer_id'], //新增订购人证件号码，默认和收件人身份证一样
                "pay_code" => $ordersRow['pay_code'], //新增支付企业代码
                "pay_name" => $ordersRow['pay_name'], //新增支付企业名称
                "transaction_id" => $ordersRow['pay_no'], //新增支付单号
                "batch_numbers" => "", //新增商品批次号，默认为空
                "consignee_district" => "",//新增收货人行政区划代码，默认为空
            )
        );

        $orderProduct = Service_OrderProduct::getByCondition(array(
            'order_code' => $ordersRow['order_code']
        ));

        foreach ($orderProduct as $key => $product) {
        	$currency = Service_Currency::getByField($product['currency_code'],'currency_code');
            if($product['origin_country']!=''){
                $originCountry = Common_DataCache::getCountryByCode($orderAddressBookRow['origin_country'],'country_code');
            }
            $declaration['OrderBillList'][$key] = array(
                "gnum" => $key+1,
                "itemNo" => $product['product_no'],
                "gno" => $product['registerID'],
                "gcode" => $product['hs_code'],
                "gname" => $product['product_title'],
                "gmodel" => $product['product_model'],
                "barCode" => $product['product_barcode'],
                "brand" => $product['brand'],
                "unit" => $product['pu_code'],
                "currency" => !empty($currency)?$currency['currency_hs_code']:'',//$product['currency_code'],
                "qty" => $product['quantity'],
                "price" => $product['price'],
                "total" => $product['total_price'],
                "giftFlag" => $product['gift_flag'],
                "note" => $product['note'],
                "item_name" => $product['product_title'],
                "item_describe" => $product['item_desc'],
                "country" => $originCountry['trade_country'],
                "gift_price" => $product['gift_price']
            );
        }
        $xmlArray['Declaration'] = $declaration;

        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "订单[{$itemRow['ref_cus_code']}] ".Common_Message::getError();
            return false;
        }


        return $message;
    }
}
