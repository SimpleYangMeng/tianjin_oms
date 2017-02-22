<?php

/**
*
*/
class InventoryModifySendMessage extends SendMessageParent
{
    protected $messageType = 'ZCC002';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'inventoryModify';
    //报文类型

    public function createMessage($itemRow)
    {
		$xmlArray 		= array();
		$currencyInfo	= Common_DataCache::getCurrencyCode();
		$countryInfo	= Common_DataCache::getCountryCode();
		$inventoryModifyInfo	= Service_InventoryModify::getByField($itemRow['ref_id'],'im_id');
		
		$code	= $inventoryModifyInfo['im_code'];
		$xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);
		if(!empty($inventoryModifyInfo)){
			$products		= Service_InventoryModifyProduct::getByCondition(array('im_code'=>$code));
			$mergers		= Service_InventoryModifyMerger::getByCondition(array('im_code'=>$code));
			
			$storageInfo		= Service_Customer::getByField($inventoryModifyInfo['wh_code'],'customer_code');
			$ecommerceInfo		= Service_Customer::getByField($inventoryModifyInfo['ebc_code'],'customer_code');
			
			$inventoryModifyArray		= array(
				'CUSTOMS_CODE'		=> $inventoryModifyInfo['customs_code'],
				'FORM_ID'			=> $code,
				'WH_CODE'			=> $storageInfo['customs_reg_num'],
				'WH_NAME'			=> $inventoryModifyInfo['wh_name'],
				'EBCCODE'			=> $ecommerceInfo['customs_reg_num'],
				'EBCNAME'			=> $inventoryModifyInfo['ebc_name'],			
				'AGENT_CODE'		=> $inventoryModifyInfo['agent_code'],			
				'AGENT_NAME'		=> $inventoryModifyInfo['agent_name'],			
				'DECL_BY'			=> $inventoryModifyInfo['decl_by'],				
				'DECL_TIME'			=> date('YmdHis',strtotime($inventoryModifyInfo['decl_time'])),	
				'EMS_NO'			=> $inventoryModifyInfo['ems_no'],	
				'I_E_FLAG'			=> $inventoryModifyInfo['ie_flag'],		
				'ADJUST_REASON'		=> $inventoryModifyInfo['note'],			
			);
			$inventoryModifyProductArray		= array();
			foreach($products as $key=>$val){
				$currencyCode	= isset($currencyInfo[$val['curr']])?$currencyInfo[$val['curr']]['currency_hs_code']:$val['curr'];
				$inventoryModifyProductArray[]	= array(
					'FORM_ID'		=> $code,
					'GOODS_ID'		=> $val['goods_id'],
					'CUS_GOODS_ID'	=> $val['cus_goods_id'],					//商品备案号
					'CODE_TS'		=> $val['code_ts'],
					'G_NAME'		=> $val['g_name'],
					'STOCK_ALL'		=> $val['stock_all'],
					'STOCK_ALL_BF'	=> $val['stock_all_bf'],
					'UNIT_1'		=> $val['unit_1'],
					'G_MODEL'		=> $val['g_model'],
					'G_UNIT'		=> $val['g_unit'],
					'DECL_PRICE'	=> $val['decl_price'],
					'CURR'			=> $currencyCode,
					
				);
			}
			$inventoryModifyMergeArray		= array();
			foreach($mergers as $key=>$val){
				$originCountry	= isset($countryInfo[$val['origin_country']])?$countryInfo[$val['origin_country']]['trade_country']:$val['origin_country'];
				$currencyCode	= isset($currencyInfo[$val['curr']])?$currencyInfo[$val['curr']]['currency_hs_code']:$val['curr'];
				$inventoryModifyMergeArray[]	= array(
					'FORM_ID'		=> $code,
					'SEQ_ID'		=> $val['seq_id'],
					'I_FORM_ID'		=> $val['i_form_id'],
					'I_FORM_ITEM'	=> $val['i_form_item'],
					'CODE_TS'		=> $val['code_ts'],
					'G_NAME'		=> $val['g_name'],
					'G_MODEL'		=> $val['g_model'],
					'QTY_1'			=> $val['qty_1'],
					'QTY_1_BF'		=> $val['qty_1_bf'],
					'UNIT_1'		=> $val['unit_1'],
					'STOCK_ALL'		=> $val['stock_all'],
					'STOCK_ALL_BF'	=> $val['stock_all_bf'],
					'G_UNIT'		=> $val['g_unit'],
					'TOTAL_PRICE'	=> $val['total_price'],
					'CURR'			=> $currencyCode,
					'ORIGIN_COUNTRY'=> $originCountry,
				);
			}
			$inventoryModifyArray['EMS_LIST']	= $inventoryModifyProductArray;
			$inventoryModifyArray['EMS_LIST_FZXT']	= $inventoryModifyMergeArray;
		}
		$inventoryModifyData['EMS_HEAD'] = $inventoryModifyArray;
        $xmlArray['Declaration'] = $inventoryModifyData;
        $message = Common_Message::cearteMessage($xmlArray);
        if($message === false){
            $this->_error = "账册调整新增队列[{$code}] ".Common_Message::getError();
            return false;
        }
        return $message;
    }

}


