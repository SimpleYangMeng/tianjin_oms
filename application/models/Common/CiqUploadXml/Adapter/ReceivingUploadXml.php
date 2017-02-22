<?php
/**
* 产品生成 XML 
*/
class ReceivingUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    protected $apiCode = 'Receiving';
	
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
    	$receivingData = Service_Receiving::getByField($itemRow['ref_id'] , 'receiving_id');
    	if(empty($receivingData)){
            $this->_error[] = "入库单[{$itemRow['refer_code']}]不存在！";
            return false;
        }
		$receivingId	= $itemRow['ref_id'];
        $genArrayData	= array();
		$customerInfo	= Service_Customer::getByField($receivingData['customer_code'], 'customer_code');
		//属地检验检疫机构代码
        $this->_insUnitCode = $customerInfo['ins_unit_code'];
		$elecInfo 		= Service_Customer::getByField($receivingData['ebc_no'], 'ciq_reg_num');
		$receivingContainer= Service_ReceivingContainer::getByCondition(array('receiving_code'=>$receivingData['receiving_code']));
		$receivingDetail= Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingData['receiving_code']));
		$countryInfo1	= Service_Country::getByField($receivingData['trade_country'],'country_code');
		$tradeModeInfo	= Service_TradeMode::getByField($receivingData['trade_mode'],'trade_mode');
		$receivingArray	= array(
			'II_SERIAL_NO'		=> $receivingId,							//境外进区流水号
			'DECL_NO'			=> $receivingData['receiving_code'],		//申报号
			'LAW_NO'			=> $receivingData['law_no'],				//报检单号
			'DECL_PERSON'		=> $receivingData['decl_person'],			//申报人名称,
			'DECL_DATE'			=> date('YmdHis',strtotime($receivingData['import_date'])),	//申报时间
			'ORG_NO'			=> $receivingData['trade_co'],				//仓储企业组织机构代码
			'DECL_TYPE_CODE'	=> 'FI',									//申报类型代码
			'TRADE_MODE_CODE'	=> $tradeModeInfo['ciq_code'],				//贸易方式
			'ENT_CODE'			=> $customerInfo['ciq_reg_num'],			//仓储企业 申报单位代码
			'CBECODE'			=> $receivingData['ebc_no'],				//电商企业代码
			'CHECK_ORG_CODE'	=> $receivingData['check_org_code'],		//施检机构代码
			'ORG_CODE'			=> $receivingData['org_code'],				//目的机构代码
			'TRADE_COUNTRY_CODE'=> $countryInfo1['b_bbd_country_code'],		//贸易国别/地区代码
			'DESP_COUNTRY_CODE'	=> $countryInfo1['b_bbd_country_code'],		//启运国代码
			'DESP_PORT_CODE'	=> $receivingData['desp_port'],				//启运口岸代码
			'ENTRY_PORT_CODE'	=> $receivingData['entry_port'],			//入境口岸代码
			'STOCK_FLAG'		=> 'C',										//集货/备货标识 C备货 B集货
			'STOCK_FLAG_NAME'	=> '备货',
			'CONSIGNEE_CNAME'	=> $elecInfo['corporate'],					//收货人
			'CONSIGNEE_ADDRESS'	=> $customerInfo['customer_address'],		//收货人地址,
			'CONSIGNEE_TEL'		=> $elecInfo['corporate_phone'],			//收货人电话
			'CONSIGNEE_IDNUM'	=> $elecInfo['corporate_num'],				//收货人证件号码
			'CONSIGNOR_CNAME'	=> '',//发货人(必填)						//发货人
			'CONSIGNOR_ADDRESS'	=> '',//发货人地址(必填)					//发货人地址
			'CONSIGNOR_TEL'		=> '',//发货人电话(必填)					//发货人电话
			'CONSIGNOR_IDNUM'	=> '',//发货人证件号码(必填)				//发货人证件号码
			'WASTE_FLAG'		=> $receivingData['waste_flag'],			//是否有废旧物品
			'PACK_FLAG'			=> $receivingData['pack_flag'],				//是否带有植物性包装及铺垫材料
			'SAMPLE_NO'			=> '',//抽样单号(可空)
			'CONSIGNEE_IDTYPE'	=> '',//收货人证件类型
			'CONSIGNOR_IDTYPE'	=> '',//发货人证件类型
			'TRANS_TYPE_CODE'	=> '',//运输工具代码(可空)
			'CONSIGNEE_NO'		=> '',//收货人编号(可空)
			'CONSIGNEE_ENAME'	=> '',//收货人英文名称(可空)
			'CONSGINOR_NO'		=> '',//发货人编号(可空)
			'CONSGINOR_ENAME'	=> '',//发货人英文名称(可空)
			'TRANS_TYPE_NO'		=> $receivingData['trans_type_no'],//运输号码
			'CONTRACT_NO'		=> $receivingData['contract_no'],//合同号
			'CARRIER_NOTE_NO'	=> $receivingData['bill_no'],//提/运单号
			'SHEET_TYPE_CODES'	=> '',//随附单据代码串,由相应单据代码串联而得
			'GOODS_ADDRESS'		=> $receivingData['goods_address'],//货物存放地点
		);
		$product	= array();
		$container	= array();
		foreach($receivingDetail as $key=>$val){
			$productInfo	= Service_Product::getByField($val['cus_goods_id'],'registerID');
			$countryInfo	= Service_Country::getByField($productInfo['country_code_of_origin'],'country_code');
			$currencyInfo	= Service_Currency::getByField($val['curr'],'currency_code');
			$product[$key]['II_GOODS_SERIAL_NO']	= $val['ciq_g_no'];						//商品流水号
			$product[$key]['SEQ_NO']				= $val['g_no'];							//序号
			$product[$key]['ENT_CODE']				= $elecInfo['ciq_reg_num'];				//企业备案号
			$product[$key]['GOODS_REG_NO']			= $productInfo['inspection_code'];		//商品备案号
			$product[$key]['HS_CODE']				= $productInfo['hs_code'];				//HS编码
			$product[$key]['ENT_CNAME']				= $customerInfo['trade_name'];			//企业中文名
			$product[$key]['GOODS_NO']				= $productInfo['product_sku'];			//企业中文名
			$product[$key]['GOODS_NAME']			= $productInfo['product_title'];		//商品名称
			$product[$key]['ORIGIN_COUNTRY_CODE']	= $countryInfo['b_bbd_country_code'];	//原产国代码
			$product[$key]['QTY']					= $val['g_qty'];						//包装数量
			$product[$key]['QTY_UNIT_CODE']			= $val['g_unit'];						//包装单位代码
			$product[$key]['SMALL_QTY']				= '';									//最小包装数量
			$product[$key]['SMALL_QTY_UNIT_CODE']	= '';									//最小包装单位代码
			$product[$key]['GOODS_UNIT_PRICE']		= $val['decl_price'];					//单价
			$product[$key]['WEIGHT']				= $productInfo['product_weight']*$val['g_qty'];//重量
			$product[$key]['GOODS_TOTAL_VALUES']	= $val['decl_price']*$val['g_qty'];				//总价
			$product[$key]['CURR_UNIT']				= $currencyInfo['b_bbd_currency_code'];			//货币单位代码
			$product[$key]['REMARK']				= '';
		}
		$receivingArr = array(
			'IIDeclDocument'	=> array(
				'IIDeclHead'	=> $receivingArray,
				'IIDeclGoodsList'=> array(
					'IIDeclGoodsListInformation' => $product,
				)
			)
		);
		if(!empty($receivingContainer)){
			foreach($receivingContainer as $key=>$val){
				$container[$key]['BIZ_TYPE']	= 1;
				$container[$key]['CON_MODEL']	= $val['rc_model'];
				$container[$key]['CON_NUM']		= $val['rc_num'];
				$container[$key]['CON_NO']		= $val['rc_no'];
			}
			$receivingArr['IIDeclDocument']['IIDeclContainerList']['IIDeclContainerListInformation']	= $container;
		}
        return $receivingArr;
    }
}
