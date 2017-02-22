<?php
/**
 * 下载文件解析到数据表
 * Enter description here ...
 * @author simple
 *
 */
class Common_CiqDownload {
	//FTP 配置
    public static $_ftpConfig = array(
            'hostname' => '10.128.132.202',
            'username' => 'ftpuser',
            'password' => 'ftpuser',
            'port' => 21
	);
	//FTP路径
	protected static $_ftpDir = array('BdsSort/Response/Source','/BdsSort/Request/Source/');
//	protected static $_localPath = APP.'/../data/';
	//文件类型
	private static $type = array(
		//产品备案
		'110' => 'GoodsRegReceived',
		//企业备案
		'200' => 'EntRegReceived',
		//企业锁定
		'201' => 'EntLockReceived',
		//商品备案状态回执
		'210' => 'GoodsRegReceived',
		////商品锁定
		'211' => 'GoodsLockReceived',
		//订单
		'350' => 'OrderReceived',
		//运单
		'351' => 'BillReceived',
		//支付单
		'352' => 'PaymentReceived',
		//物品清单
		'230' => 'IODeclReceived',
		//入库单
		'220' => 'IIDeclReceived',
		//入区单检疫
		'221'=> 'IIDeclQfReceived',
		//二维码
		'228' => 'IIQR',
		'226' => 'IIDeclCfReceived',//入库单抽验
		'236' => 'IODeclCfReceived',//物品清单抽验
		'231' => 'IODeclQfReceived',//物品清单检疫
		//咨询建议
		'552' => 'ConsultComplainReceived',
		
	);
	
	/**
	 * 列出目录
	 * Enter description here ...
	 */
	public static function downloadFile(){
		//下载目录
		$downPath = APPLICATION_PATH.'/../data/ftp/ciq_receive/';
		$ftp = new Common_Ftp(self::$_ftpConfig);
		//连接FTP
		if(!$ftp->connect()){
			self::debug(join('-', $ftp->getError()));
		}
		//切换至对应目录
		$remoteDir	= self::$_ftpDir;
		foreach($remoteDir as $dir){
			if(!$ftp->chgdir($dir, true)){
				self::debug(join('-', $ftp->getError()));
			}
			//列出文件
			$fileList = $ftp->filelist();
			if(!empty($fileList) && is_array($fileList)){
				//创建目录
				if(!is_dir($downPath)){
					if(Common_Common::createPath($downPath) === false){
						self::debug('下载目录创建失败');
					}
				}
				foreach ($fileList as $file){
					//下载目录
					if($ftp->download($file, $downPath.$file)){
						//写入到表
						$result = self::parseIntoTable($downPath.$file);
						//本地处理成功
						if(isset($result['ask']) && $result['ask'] == 1){
							//删除文件
							$ftp->delete_file($file);
							echo $file.'下载处理成功';
						}else {
							echo $file.'处理失败：'.$result['message'];			
						}
					}else{
						self::debug(join('-', $ftp->getError()));
					}
				}
			}
		}
	}
	
	/**
	 * 解析XML
	 * Enter description here ...
	 * @param unknown_type $xmlFile
	 * @throws Exception
	 */
	public static function parseIntoTable($xmlFile)
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
				if(isset(self::$type[$xmlType])){
					$xmlStringPre 	= self::$type[$xmlType];
					$file 			= pathinfo($xmlFile);
					//保存文件路径
					$targetPath 	= APPLICATION_PATH . '/../data/ciq_'.self::$type[$xmlType].'/'.date('Y/m/d');
					if(!is_dir($targetPath)){
						if(!Common_Common::createPath($targetPath)){
							throw new Exception('创建目录失败');
						}
					}
					$targetFile 	= $targetPath.'/'.$file['basename'];
					//消息存在不处理
					/*
					$cbmhId = Service_CiqBackMessHead::getByField($xmlData['MessageHead']['MESSAGE_ID'], 'message_id', array('cbmh_id'));
					if( $cbmhId ){
						throw new Exception('该条记录已存在消息头ID:'.$cbmhId['cbmh_id']);
					}
					*/
					$header	= array(
						'message_id'	=> isset($xmlData['MessageHead']['MESSAGE_ID']) ? $xmlData['MessageHead']['MESSAGE_ID'] : '',
						'message_type'	=> isset($xmlData['MessageHead']['MESSAGE_TYPE']) ? $xmlData['MessageHead']['MESSAGE_TYPE'] : '',
						'send_code'		=> isset($xmlData['MessageHead']['SEND_CODE']) ? $xmlData['MessageHead']['SEND_CODE'] : '',
						'recipt_code'	=> isset($xmlData['MessageHead']['RECIPT_CODE']) ? $xmlData['MessageHead']['RECIPT_CODE'] : '',
						'add_time'		=> isset($xmlData['MessageHead']['MESSAGE_TIME']) ? $xmlData['MessageHead']['MESSAGE_TIME'] : '',
						'update_time'	=> date('Y-m-d H:i:s'),
						'status'		=> '-1',
						'file_path'		=> $targetFile,
					);
					$lastId = Service_CiqBackMessHead::add($header);
					if(!$lastId){
						throw new Exception('头部写入失败');
					}
					
					$receiptType = isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_TYPE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_TYPE'] : '';
					//企业备案
					if($receiptType == '200'){
						$attribute = isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE6'])&&!empty($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE6']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE6'] : '';
					//商品备案
					}else if($receiptType == '210'){
						$attribute = isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE7'])&&!empty($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE7']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE7'] : '';
					}else {
						$attribute = '';
					}
					$body	= array(
						'cbmh_id'		=> $lastId,
						'receipt_type'	=> $receiptType,
						'receipt_no'	=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_NO']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_NO'] : '',
						'msg_code'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_CODE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_CODE'] : '',
						'msg_name'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_NAME']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_NAME'] : '',
						'msg_desc'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_DESC']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_DESC'] : '',
						'msg_time'		=> date('Y-m-d H:i:s'),
						'attribute'		=> $attribute,
						'back_field'	=> '',
						'status'		=> -1,
						'from_id'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECIPT_CODE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECIPT_CODE'] : '',
						'update_time'	=> date('Y-m-d H:i:s'),
					);
					if(!Service_CiqBackMessBody::add($body)){
						throw new Exception('表体写入失败');
					}
					if(!copy($xmlFile, $targetFile)){
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
			//	throw new Exception($e->getMessage());
				$result['message'] = $e->getMessage();
			}
		}else{
			$result['message'] = '报文不存在';
		}
		return $result;
	}
	
 	/**
     * [debug 调试输出]
     * @param  [type] $msg [description]
     * @return [type]      [description]
     */
    public static function debug($message = '')
    {
        print $message."\n\t";
    }
}
