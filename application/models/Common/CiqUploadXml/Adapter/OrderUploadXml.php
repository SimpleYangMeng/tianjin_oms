<?php
/**
* 产品生成 XML 
*/
class OrderUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    //接口代码 Product->产品备案
    protected $apiCode = 'Order';
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
    	$orderInfo = Service_Orders::getByField($itemRow['ref_id'] , 'order_id');
    	if(empty($orderInfo)){
            $this->_error[] = "订单[{$itemRow['refer_code']}]不存在";
            return false;
        }
		$orderCurrencyCode = Service_Currency::getByField($orderInfo['currency_code'], 'currency_code', array('b_bbd_currency_code'));
		if(empty($orderCurrencyCode)){
			$this->_error[] = "订单[{$orderInfo['order_code']}]币制{$orderInfo['currency_code']}商检币制编号不存在";
			return false;
		}
		//电商企业
		$customerInfo	= Service_Customer::getByField($orderInfo['customer_code'], 'customer_code', array('ciq_reg_num', 'bus_name', 'customer_telephone', 'customer_address', 'ins_unit_code'));
		if(empty($customerInfo)){
			$this->_error[] = "订单[{$orderInfo['order_code']}]电商企业{$orderInfo['customer_code']}不存在";
			return false;
		}
		//属地检验检疫机构代码
		$this->_insUnitCode = $customerInfo['ins_unit_code'];
		//电商平台
		$ecommerceCustomerInfo = Service_Customer::getByField($orderInfo['ecommerce_platform_customer_code'], 'customer_code', array('ciq_reg_num'));
		if(empty($ecommerceCustomerInfo)){
			$this->_error[] = "订单[{$orderInfo['order_code']}]电商平台{$orderInfo['ecommerce_platform_customer_code']}不存在";
			return false;
		}
		//收货人地址
		$orderAddressData = Service_OrderAddressBook::getByField($orderInfo['order_id'], 'order_id');
		//收货人所在国
		if(!empty($orderAddressData['consignee_country'])){
			$addBookCountryInfo = Service_Country::getByField($orderAddressData['consignee_country'], 'country_code', array('b_bbd_country_code'));
		}else {
			$this->_error[] = "订单[{$orderInfo['order_code']}]收货地址不存在";
			return false;
		}
		
		$orderBaseInfo = array(
			//订单流水号
			'ORDER_SERIAL_NO'			=> $orderInfo['order_id'],
			//订单编号
			'ORDER_NO'					=> $orderInfo['order_code'],
			//订单批次号 -- 可为空
			'BATCH_NO'					=> '',
			//电商平台编号
			'ECP_CODE'					=> $ecommerceCustomerInfo['ciq_reg_num'],
			//进/出口编号 I进口 E出口
			'IE_TYPE'					=> $orderInfo['ie_type'],
			//电商企业编号
			'CBE_CODE'					=> $customerInfo['ciq_reg_num'],
			//业务类型 1保税备货 2保税集货
			'BIZ_TYPE'					=> 1,
			//代理申报企业编号 - 电商企业编号
			'AGENT_CODE'				=> $customerInfo['ciq_reg_num'],
			'CONSIGNEE_NAME'			=> $orderAddressData['consignee'],
			'CONSIGNEE_TEL'				=> $orderAddressData['consignee_telephone'],
			'CONSIGNEE_ADDRESS'			=> $orderAddressData['consignee_addres'],
			'CONSIGNEE_COUNTRY_CODE' 	=> $addBookCountryInfo['b_bbd_country_code'],
			//发货人信息 - 电商企业信息
			'CONSIGNOR_CNAME'			=> $customerInfo['bus_name'],
			'CONSIGNOR_ADDRESS'			=> $customerInfo['customer_address'],
			'CONSIGNOR_TEL'				=> $customerInfo['customer_telephone'],
			'CONSIGNOR_COUNTRY_CODE'	=> '156',
			//收货人证件类型编号 1身份证 2军官证 3护照 4其他
			'ID_TYPE'					=> 1,
			'ID_CARD'					=> $orderAddressData['consignee_id_number'],
			'GOODS_VALUE'				=> $orderInfo['goods_amount'],
			'FREIGHT'					=> $orderInfo['freight'],
			'CURRENCY'					=> $orderCurrencyCode['b_bbd_currency_code'],
			//贸易国别编号 - 默认中国
			'TRADE_COUNTRY_CODE'		=> empty($orderInfo['trade_country']) ? '156' : $orderInfo['trade_country'],
			'REMARK'					=> $orderInfo['note'],
		);
		$orderProducts = array(
			0 => array(
					'SEQ_NO' => '',
					'GOODS_NO' => '',
					'GOODS_BARCODE' => '',
					'GOODS_NAME' => '',
					'SHELF_GOODS_NAME' => '',
					'PRICE' => '',
					'PRICE_TOTAL' => '',
					'CURRENCY' => '',
					'COUNTRY_CODE' => '',
					'COUNT_NUM' => '',
					'UNIT_CODE' => '',
					'WRAPTYPE_CODE' => '',
					'PURPOSE_CODE' => '',
					'GOODS_MODEL' => '',
					'REMARK' => ''
			),
		);
		//订单产品
		$orderProductData = Service_OrderProduct::getByCondition(array('order_id' => $orderInfo['order_id']));
		if(!empty($orderProductData) && is_array($orderProductData)){
			foreach($orderProductData as $key=>$orderProduct){
				$productInfo = Service_Product::getByField($orderProduct['product_id'], 'product_id', array('country_code_of_origin', 'use_way'));
				$productCuntry = Service_Country::getByField($productInfo['country_code_of_origin'], 'country_code', array('b_bbd_country_code'));
				$productCurrencyCode = Service_Currency::getByField($orderProduct['currency_code'], 'currency_code', array('b_bbd_currency_code'));
				$orderProducts[$key]['SEQ_NO']	= $orderProduct['op_id'];
				$orderProducts[$key]['GOODS_NO'] = $orderProduct['product_no'];
				//商品条码 -- 可为空
				$orderProducts[$key]['GOODS_BARCODE']	= $orderProduct['product_barcode'];
				$orderProducts[$key]['GOODS_NAME']		= $orderProduct['product_title'];
				$orderProducts[$key]['SHELF_GOODS_NAME'] = $orderProduct['brand'];
				$orderProducts[$key]['PRICE'] = $orderProduct['price'];
				$orderProducts[$key]['PRICE_TOTAL'] = $orderProduct['total_price'];
				$orderProducts[$key]['CURRENCY'] = $productCurrencyCode['b_bbd_currency_code'];
				//原产国/产地编号
				$orderProducts[$key]['COUNTRY_CODE'] = $productCuntry['b_bbd_country_code'];
				//成交数量
				$orderProducts[$key]['COUNT_NUM'] = $orderProduct['quantity'];
				//计量单位编号
				$orderProducts[$key]['UNIT_CODE'] = $orderProduct['pu_code'];
				//包装种类编号
				$orderProducts[$key]['WRAPTYPE_CODE'] = '';
				//用途编号
				$orderProducts[$key]['PURPOSE_CODE'] = $productInfo['use_way'];
				//规格型号
				$orderProducts[$key]['GOODS_MODEL'] = $orderProduct['product_model'];
				//备注
				$orderProducts[$key]['REMARK'] = $orderProduct['note'];
			}
		}
		$orderData = array(
			'OrderDocument'	=> array(
				'OrderHead'	=> $orderBaseInfo,
				'OrderGoodsList'=> array(
					'OrderGoodsListInformation' => $orderProducts,
				)
			)
		);
		/*
		echo '<pre>';
		print_r($orderData);
		return false;
		*/
        return $orderData;
    }
}
