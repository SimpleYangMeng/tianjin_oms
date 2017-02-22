<?php

/**
*
*/
class ShipBatchDeleteSendMessage extends SendMessageParent
{
    protected $messageType = 'BUS004';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'ShipBatchDelete';
    //报文类型

    public function createMessage($itemRow)
    {
		$message		= '';
		$xmlArray 		= array();
		$currencyInfo	= Common_DataCache::getCurrencyCode();
		$countryInfo	= Common_DataCache::getCountryCode();
		$shipBatchInfo	= Service_ShipBatch::getByField($itemRow['ref_id'],'sb_id');
		$agentInfo			= Service_Customer::getByField($shipBatchInfo['agent_code'],'customer_code');
		if(!empty($shipBatchInfo)){
			$body			= array();
			$sbArray		= array(
				'FORM_ID'			=> $shipBatchInfo['sb_code'],
				'DECL_REASON'		=> $shipBatchInfo['mark_delete_reason'],
				'DECL_DATE'			=> date('YmdHis'),
				'NOTES'				=> '',
				'SYS_CODE'			=> 'ZH',
				'C_NO'				=> $shipBatchInfo['mark_delete_code'],
				'CUSTOMS_CODE'		=> $shipBatchInfo['decl_port'],
				'AGENT_CODE'		=> $agentInfo['customs_reg_num'],		//申报单位代码
				'AGENT_NAME'		=> $shipBatchInfo['agent_name'],        //申报单位名称
				'FIELD_01'			=> '',
				'FIELD_02'			=> '',
				'FIELD_03'			=> '',
				'FIELD_04'			=> '',
				'FIELD_05'			=> '',
			);
			$body['BillHead']	= $sbArray;
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


