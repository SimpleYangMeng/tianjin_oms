<?php

/**
*
*/
class ShipBatchSendMessage extends SendMessageParent
{
    protected $messageType = 'BUS003';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'shipBatch';
    //报文类型

    public function createMessage($itemRow)
    {
		$message		= '';
		$xmlArray 		= array();
		$currencyInfo	= Common_DataCache::getCurrencyCode();
		$countryInfo	= Common_DataCache::getCountryCode();
		$shipBatchInfo	= Service_ShipBatch::getByField($itemRow['ref_id'],'sb_id');
		$tradeCustomerInfo	= Service_Customer::getByField($shipBatchInfo['trade_code'],'customer_code');
		$ownCustomerInfo	= Service_Customer::getByField($shipBatchInfo['owner_code'],'customer_code');
		$storageInfo		= Service_Customer::getByField($shipBatchInfo['wh_code'],'customer_code');
		$agentInfo			= Service_Customer::getByField($shipBatchInfo['agent_code'],'customer_code');
		if(!empty($shipBatchInfo)){
			$body		= array();
			$sbDetail	= array();
			$sbProduct	= array();
			$shipBatchOrder	= Service_ShipBatchOrder::getByCondition(array('sb_code'=>$shipBatchInfo['sb_code']));
			foreach($shipBatchOrder as $key=>$val){
				$personItemInfo	= Service_PersonItem::getByField($val['order_code'],'order_code');
				$sbDetail['URM_LIST'][]		= array(
					'URM_NO'	=> $shipBatchInfo['sb_code'],
					'FORM_ID'	=> $val['form_id'],			//业务单证号
					'FORM_TYPE'	=> $val['form_type'],		//业务单证类型
				);
			}
			$shipBatchProdutInfo	= Service_ShipBatchProduct::getByCondition(array('sb_code'=>$shipBatchInfo['sb_code']));
			foreach($shipBatchProdutInfo as $key=>$val){
				$originCountry	= isset($countryInfo[$val['origin_country']])?$countryInfo[$val['origin_country']]['trade_country']:$val['origin_country'];
				$currencyCode	= isset($currencyInfo[$val['curr']])?$currencyInfo[$val['curr']]['currency_hs_code']:$val['curr'];
				$sbProduct['URM_LIST_TO_FZXT'][]	= array(
					'URM_NO'		=> $shipBatchInfo['sb_code'],
					'FORM_ID'		=> $val['form_id'],							//出入库单号
					//'FZXT_G_NO'		=> $val['merge_no'],						//项号
					'ENTRY_ID'		=> $val['decl_number'],						//报关单号
					'G_NO'			=> $val['g_no'],							//商品序号 
					'CODE_TS'		=> $val['code_ts'],							//商品编码 
					'G_NAME_CN'		=> $val['g_name_cn'],						//商品中文名称
					'G_MODEL'		=> $val['g_model'],							//规格型号
					'G_NAME_EN'		=> $val['g_name_en'],						//商品英文名称 
					'G_QTY'			=> $val['g_qty'],							//计量单位   
					'G_UNIT'		=> $val['g_unit'],							//申报数量   
					'DECL_PRICE'	=> $val['decl_price'],						//申报单价    
					'CURR'			=> $currencyCode,							//币制    
					'QTY_1'			=> $val['qty_1'],							//法定数量   
					'UNIT_1'		=> $val['unit_1'],							//法定单位   
					'QTY_2'			=> $val['qty_2'],							//第二数量
					'UNIT_2'		=> $val['unit_2'],							//第二单位
					'ORIGIN_COUNTRY'=> $originCountry,							//原产国/目的地
					'DUTY_MODE'		=> $val['duty_mode'],						//征免方式
					'USE_TO'		=> $val['use_to'],							//用途 
					'NOTE_S'		=> $val['note_s'],							//备注 
					'DECL_TOTAL'	=> $val['decl_total'],						//用途 
				);
			}
			$sbArray		= array(
				'URM_NO'			=> $shipBatchInfo['sb_code'],
				'CAR_NO'			=> $shipBatchInfo['car_no'],
				'DECL_PORT'			=> $shipBatchInfo['decl_port'],
				'I_E_PORT'			=> $shipBatchInfo['ie_port'],
				'I_E_FLAG'			=> $shipBatchInfo['ie_type'],
				'PACK_NO'			=> $shipBatchInfo['pack_no'],			//总件数
				'TOTAL_WT'			=> $shipBatchInfo['total_wt'],			//总重量
				'CAR_WT'			=> $shipBatchInfo['car_wt'],			//车自重
				'FORM_NUM'			=> $shipBatchInfo['form_num'],			//单证总数
				'D_DATE'			=> date('YmdHis'),
				'SEAL_NO'			=> '',									//关锁号
				'SEAL_KEY'			=> '',									//关锁密钥
				'EMC_EPORTCARD_ID'	=> '',									//电子口岸卡号
				'SIGN'				=> 'BH',								//加签字段
				'TRAF_NAME'			=> '',									//船名
				'VOYAGE_NO'			=> '',
				'BILL_NO'			=> '',
				'AGENT_CODE'		=> $agentInfo['customs_reg_num'],		//申报单位代码
				'AGENT_NAME'		=> $shipBatchInfo['agent_name'],        //申报单位名称
				'TRADE_CODE'		=> $tradeCustomerInfo['customs_reg_num'],        //经营单位代码
				'TRADE_NAME'		=> $shipBatchInfo['trade_name'],        //经营单位名称
				'WH_CODE'			=> $storageInfo['customs_reg_num'],			//仓储企业单位代码
				'WH_NAME'			=> $shipBatchInfo['wh_name'],        	//仓储企业单位名称
				'OWNER_CODE'		=> $shipBatchInfo['owner_code'],		//收发货人代码
				'OWNER_NAME'		=> $shipBatchInfo['owner_name'],        //收发货人名称
			);
			$sbArray	= array_merge($sbArray,$sbDetail,$sbProduct);
			$body['URM_HEAD']	= $sbArray;
			$xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
			$xmlArray['Declaration'] = $body;
			$message = Common_Message::cearteMessage($xmlArray);
			if($message === false){
				$this->_error = "载货单[{$shipBatchInfo['sb_code']}] ".Common_Message::getError();
				return false;
			}
		}
		return $message;
    }

}


