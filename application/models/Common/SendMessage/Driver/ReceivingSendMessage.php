<?php

/**
*
*/
class ReceivingSendMessage extends SendMessageParent
{
    protected $messageType = 'BUS001';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'receiving';
    //报文类型

    public function createMessage($itemRow)
    {
		$xmlArray 		= array();
		$currencyInfo	= Common_DataCache::getCurrencyCode();
		$countryInfo	= Common_DataCache::getCountryCode();
		$receivingInfo	= Service_Receiving::getByField($itemRow['ref_id'],'receiving_id');
		
		$receivingCode	= $receivingInfo['receiving_code'];
		$xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
		$tradeCountry	= isset($countryInfo[$receivingInfo['trade_country']])?$countryInfo[$receivingInfo['trade_country']]['trade_country']:$receivingInfo['trade_country'];
		if(!empty($receivingInfo)){
			$receivingDetail	= Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode));
			$receivingMerge		= Service_ReceivingDetailMerge::getByCondition(array('receiving_code'=>$receivingCode));
			$receivingContainer	= Service_ReceivingContainer::getByCondition(array('receiving_code'=>$receivingCode));
			$tradeCustomerInfo	= Service_Customer::getByField($receivingInfo['trade_co'],'customer_code');
			$ownCustomerInfo	= Service_Customer::getByField($receivingInfo['owner_code'],'customer_code');
			$storageInfo		= Service_Customer::getByField($receivingInfo['storage_co'],'customer_code');
			$agentInfo			= Service_Customer::getByField($receivingInfo['agent_code'],'customer_code');
			$receivingArray		= array(
				'SERIAL_NO'			=> $receivingInfo['receiving_id'],
				'DECL_PORT'			=> $receivingInfo['decl_port'],
				'I_E_PORT'			=> $receivingInfo['ie_port'],
				'FORM_ID'			=> $receivingInfo['receiving_code'],
				'I_E_MODE'			=> $receivingInfo['ie_mode'],						//出入库
				'EMS_NO'			=> $receivingInfo['warehouse_code'],				//仓库账册号 
				'EMS_COP_NO'		=> $receivingInfo['list_no'],						//清单企业内部编号
				'TRAF_NAME'			=> $receivingInfo['traf_name'],						//运输工具名称
				'VOYAGE_NO'			=> $receivingInfo['voyage_no'],						//航次号
				'BILL_NO'			=> $receivingInfo['bill_no'],						//提运单号
				'GROSS_WT'			=> $receivingInfo['roughweight'],					//毛重
				'NET_WT'			=> $receivingInfo['net_weight'],					//净重
				'PACK_NO'			=> $receivingInfo['pack_no'],						//总件数
				'WRAP_TYPE'			=> $receivingInfo['wrap_type'],						//包装种类 
				'I_E_DATE'			=> date('YmdHis',strtotime($receivingInfo['import_date'])),					//入出库日期 
				'TRAF_MODE'			=> $receivingInfo['traf_mode'],						//运输方式
				'TRADE_CODE'		=> $tradeCustomerInfo['customs_reg_num'],						//经营单位代码
				'TRADE_MODE'		=> $receivingInfo['trade_mode'],					//监管方式
				'TRANS_MODE'		=> $receivingInfo['trans_mode'],					//成交方式
				'AGENT_CODE'		=> $agentInfo['customs_reg_num'],					//申报单位代码
				'TRADE_COUNTRY'		=> $tradeCountry,									//贸易国别
				'OWNER_CODE'		=> $receivingInfo['owner_code'],					//收（发）货单位代码
				'NOTE_S'			=> $receivingInfo['notes'],							//备注
				'RELATIVE_FORM_TYPE'=> $receivingInfo['receiving_type'],				//关联单证类型
				'RELATIVE_FORM_ID'	=> $receivingInfo['declaration_number'],			//关联单证号码
				'D_DATE'			=> date('YmdHis'),
				'EMC_EPORTCARD_ID'	=> '',												//电子口岸卡号
				'SIGN'				=> 'BH',											//加签
				'FORM_TYPE'			=> $receivingInfo['form_type'],
				'TRADE_NAME'		=> $receivingInfo['trade_name'],					//经营单位名称
				'OWNER_NAME'		=> $receivingInfo['owner_name'],					//收（发）货单位名称
				'AGENT_NAME'		=> $receivingInfo['agent_name'],					//申报单位名称
				'DESTINATION_PORT'	=> $receivingInfo['destination_port'],
				'DECLARE_REMARK'	=> '',												//申报提示
				'I_E_FLAG'			=> $receivingInfo['ie_flag'],						//进出口
				'WH_CODE'			=> $storageInfo['customs_reg_num'],					//仓储企业代码 
				'WH_NAME'			=> $receivingInfo['storage_name'],					//仓储企业名称
			);
			$receivingDetailArray		= array();
			foreach($receivingDetail as $key=>$val){
				$originCountry	= isset($countryInfo[$val['origin_country']])?$countryInfo[$val['origin_country']]['trade_country']:$val['origin_country'];
				$currencyCode	= isset($currencyInfo[$val['curr']])?$currencyInfo[$val['curr']]['currency_hs_code']:$val['curr'];
				$receivingDetailArray[]	= array(
					'FORM_ID'		=> $val['receiving_code'],
					'GOODS_ID'		=> $val['goods_id'],
					'CUS_GOODS_ID'	=> $val['cus_goods_id'],					//商品备案号
					'G_NO'			=> $val['g_no'],
					'MERGER_G_NO'	=> $val['merge_g_no'],
					'CODE_TS'		=> $val['code_ts'],
					'G_NAME_CN'		=> $val['hs_name'],
					'G_MODEL'		=> $val['g_model'],
					'G_NAME_EN'		=> $val['g_name_en'],
					'G_QTY'			=> $val['g_qty'],
					'G_UNIT'		=> $val['g_unit'],
					'DECL_PRICE'	=> $val['decl_price'],
					'CURR'			=> $currencyCode,
					'QTY_1'			=> $val['qty_1'],
					'UNIT_1'		=> $val['unit_1'],
					'QTY_2'			=> $val['qty_2'],
					'UNIT_2'		=> $val['unit_2'],
					'ORIGIN_COUNTRY'=> $originCountry,
					'DUTY_MODE'		=> $val['duty_mode'],
					'USE_TO'		=> $val['use_to'],
					'NOTE_S'		=> $val['note_s'],
					'DECL_TOTAL'	=> $val['decl_total'],
				);
			}
			$receivingDetailMergeArray		= array();
			foreach($receivingMerge as $key=>$val){
				$originCountry	= isset($countryInfo[$val['origin_country']])?$countryInfo[$val['origin_country']]['trade_country']:$val['origin_country'];
				$currencyCode	= isset($currencyInfo[$val['curr']])?$currencyInfo[$val['curr']]['currency_hs_code']:$val['curr'];
				$receivingDetailMergeArray[]	= array(
					'FORM_ID'		=> $val['receiving_code'],
					'G_NO'			=> $val['g_no'],
					'CODE_TS'		=> $val['code_ts'],
					'G_NAME_CN'		=> $val['hs_name'],
					'G_MODEL'		=> $val['g_model'],
					'G_NAME_EN'		=> $val['g_name_en'],
					'G_QTY'			=> $val['g_qty'],
					'G_UNIT'		=> $val['g_unit'],
					'DECL_PRICE'	=> $val['decl_price'],
					'CURR'			=> $currencyCode,
					'QTY_1'			=> $val['qty_1'],
					'UNIT_1'		=> $val['unit_1'],
					'QTY_2'			=> $val['qty_2'],
					'UNIT_2'		=> $val['unit_2'],
					'ORIGIN_COUNTRY'=> $originCountry,
					'DUTY_MODE'		=> $val['duty_mode'],
					'USE_TO'		=> $val['use_to'],
					'NOTE_S'		=> $val['note_s'],
					'DECL_TOTAL'	=> $val['decl_total'],
				);
			}
			$receivingContainerArray		= array();
			if(!empty($receivingContainer)){
				foreach($receivingContainer as $key=>$val){
					$receivingContainerArray[]	= array(
						'FORM_ID'		=> $val['receiving_code'],
						'CONTA_ID'		=> $val['rc_no'],
						'CONTA_MODEL'	=> $val['rc_model'],
						'CONTA_WT'		=> $val['rc_weight'],
					);
				}
			}
			$receivingArray['BillList']	= $receivingDetailArray;
			if(!empty($receivingContainerArray)){
				$receivingArray['BillConta']= $receivingContainerArray;
			}
			$receivingArray['BillToFZXT']= $receivingDetailMergeArray;
		}
		$receivingData['BillHead'] = $receivingArray;
        $xmlArray['Declaration'] = $receivingData;
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "入库单[{$receivingCode}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }

}


