<?php
class Common_ParseXML
{
	private $type = array(
		'110'	=> 'GoodsRegReceived',	//产品备案
		'200'	=> 'EntRegReceived',	//企业备案
	);
	
	public function parseIntoTable($xmlFile)
	{
		$result = array('ask'=>0,'message'=>'');
		if(is_file($xmlFile))
		{
			try{
				$db = Common_Common::getAdapter();
				$db->beginTransaction();
				$xml = file_get_contents($xmlFile);
				$xmlObj = simplexml_load_string($xml);
				$xmlData = Common_Message::analyzeResult($xmlObj);
				$xmlType = $xmlData['MessageHead']['MESSAGE_TYPE'];
				if(isset($this->type[$xmlType])){
					$xmlStringPre 	= $this->type[$xmlType];
					$file 			= pathinfo($xmlFile);
					$targetPath 	= APPLICATION_PATH . '/../data/ciq_product/'.date('Y/m/d');
					if(!is_dir($targetPath)){
						if(!Common_Common::createPath($targetPath)){
							throw new Exception('创建目录失败');
						}
					}
					$targetFile 	= $targetPath.'/'.$file['basename'];
					$header	= array(
						'message_id'	=> $xmlData['MessageHead']['MESSAGE_ID'],
						'message_type'	=> $xmlData['MessageHead']['MESSAGE_TYPE'],
						'send_code'		=> $xmlData['MessageHead']['SEND_CODE'],
						'recipt_code'	=> $xmlData['MessageHead']['RECIPT_CODE'],
						'add_time'		=> $xmlData['MessageHead']['MESSAGE_TIME'],
						'update_time'	=> date('Y-m-d H:i:s'),
						'status'		=> '-1',
						'file_path'		=> $targetFile,
					);
					$lastId = Service_CiqBackMessHead::add($header);
					if(!$lastId){
						throw new Exception('头部写入失败');
					}
					$body	= array(
						'cbmh_id'		=> $lastId,
						'receipt_type'	=> $xmlType,
						'receipt_no'	=> $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_NO'],
						'msg_code'		=> $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_CODE'],
						'msg_name'		=> $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_NAME'],
						'msg_desc'		=> $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_NAME'],
						'msg_time'		=> date('Y-m-d H:i:s'),
						'attribute'		=> '',
						'back_field'	=> '',
						'status'		=> -1,
						'update_time'	=> date('Y-m-d H:i:s'),
					);
					if(!Service_CiqBackMessBody::add($body)){
						throw new Exception('表体写入失败');
					}
					if(!copy($xmlFile,$targetFile)){
						throw new Exception('拷贝文件失败');
					}
					@unlink($xmlFile);
				}else{
					throw new Exception('类型未找到');
				}
				$db->commit();
				$result['ask'] = 1;
				$result['message'] = '处理成功';
			}catch(Exception $e){
				$db->rollback();
				throw new Exception($e->getMessage());
			}
		}else{
			$result['message'] = '报文不存在';
		}
		return $result;
	}
}
?>