<?php

/**
*
*/
class ProductSendMessage extends SendMessageParent
{
    protected $messageType = 'BAA002';
    //操作对应的状态
    protected $status = 0;
    //当前操作
    //protected $_status = '';
    //接口代码
    protected $apiCode = 'product';
    //报文类型

    public function createMessage($itemRow)
    {
        $productRow = Service_Product::getByField($itemRow['ref_id'] , 'product_id');
        if(empty($productRow)){
            $this->_error = "商品[{$itemRow['ref_id']}]不存在！";
            return false;
        }
        $xmlArray = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
        $country = Common_DataCache::getCountryByCode($productRow['country_code_of_origin'],'country_code');


        $currency = Service_Currency::getByField($productRow['currency_code'],'currency_code');
        $goodsTax = Service_GoodsTax::getByField($productRow['gt_code'],'gt_code');

        $declaration = array(
            'GOODS'=>array(
                'SEQ_ID'=>$itemRow['am_id'],
                'IE_TYPE'=>$productRow['ie_type'],
                'CUSTOM_CODE'=>$productRow['customs_code'],
                'CODE_TS'=>$productRow['hs_code'],
				'HSNAME'=>$productRow['hs_goods_name'],
                'G_NAME'=>$productRow['product_title'],
                'G_MODEL'=>$productRow['product_model'],
                'G_UNIT'=>$productRow['g_unit'],
                'DECL_PRICE'=>$productRow['product_declared_value'],
                'ORIGIN_COUNTRY'=>$country['trade_country'],
                'CURR'=>$currency['currency_hs_code'],
                'CODE_TX'=>'',
                'TAX_NAME'=>'',
                'CUS_GOODS_ID'=>$productRow['registerID'],
                'EBCCODE'=>$productRow['customer_code'],
                'EBCNAME'=>$productRow['enp_name'],
                'AGENT_CODE'=>$productRow['storage_customer_code'],
                'AGENT_NAME'=>$productRow['storage_enp_name'],
                'DECL_TIME'=>date("YmdHis",strtotime($productRow['product_add_time'])),
                'NET_WT'=>$productRow['product_net_weight'],
                'GROSS_WT'=>$productRow['product_weight'],
                'BAR_CODE'=>$productRow['product_barcode'],
                'NOTE_S'=>$productRow['product_description'],
                'BRAND'=>$productRow['brand'],
                'G_UNIT2'=>$productRow['second_unit'],
                'IS_GIFT'=>$productRow['gift_flag'],
                'SKU_NO'=>$productRow['product_sku'],
            )
        );
        $xmlArray['Declaration'] = $declaration;

        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "商品[{$itemRow['ref_cus_code']}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }

    public function handleReceipt($receiveReceipt)
    {
        # code...
    }


}


