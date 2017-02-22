<?php
/**
 * 下载文件解析到数据表
 * Enter description here ...
 * @author simple
 *
 */
class Common_CiqNoticeDownload {
	//FTP 配置
	//使用CiqDownload配置
	/*
    protected static $_ftpConfig = array(
            'hostname' => '10.128.132.215',
            'username' => 'administrator',
            'password' => 'tgfw@2015',
            'port' => 21
	);
	*/
	//FTP路径
	protected static $_ftpDir = array('/BdsSort/Request/Source/');
//	protected static $_localPath = APP.'/../data/';
	//文件类型
	private static $type = array(
		//公告
		'500' => 'Notice'
	);
	
	/**
	 * 列出目录
	 * Enter description here ...
	 */
	public static function downloadFile(){
		//下载目录
		$downPath = APPLICATION_PATH.'/../data/ftp/ciq_receive/';
		$ftp = new Common_Ftp(Common_CiqDownload::$_ftpConfig);
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
					$targetFile = $targetPath.'/'.$file['basename'];
					//写入公告表
					$sjNoticeData = array(
							'sn_notice_serial_no' => isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['NOTICE_SERIAL_NO']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['NOTICE_SERIAL_NO'] : '',
							'sn_title' => isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['TITLE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['TITLE'] : '',
							'sn_info' => isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['INFO']) ? urldecode($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['INFO']) : '',
							//ISTOP
							'sn_decl_status' => isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['DECL_STATUS']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['DECL_STATUS'] : '', 
							'sn_add_time' => isset($xmlData['MessageHead']['MESSAGE_TIME']) ? $xmlData['MessageHead']['MESSAGE_TIME'] : '',
							'sn_update_time' => date('Y-m-d H:i:s'),
					);
					if(Service_SjNotice::add($sjNoticeData) === false){
						throw new Exception('公告写入失败');
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
        print $message . "\n\t";
    }
}
