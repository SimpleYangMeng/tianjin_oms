<?php
include 'ftp.php';
class Service_FtpMessageProcess
{
	/**
	 * 路径
	 * @author solar
	 * @return string
	 */
	public function getBasePath() {
		return APPLICATION_PATH.'/../data/ftp';
	}
	
	/**
	 * 添加发送消息
	 * @author solar
	 * @param string $sb_code
	 * @return boolean|int
	 */
	public function addSendMessage($receiving_code) {
		$fileName = $receiving_code.'.xml';
		$relativePath = '/inbound_send/'.date('Y/m/d');
		//添加一条模拟海关编码的文件
		$relativeHgPath = $this->getBasePath().'/inbound_receive/'.date('Y/m/d'); //注释掉
		$absolutePath = $this->getBasePath().$relativePath;
		if(!file_exists($absolutePath)) {
			mkdir($absolutePath, 0777, true);
		}
		if(!file_exists($relativeHgPath)) {
			mkdir($relativeHgPath, 0777, true);
		}
		$obxProcess = new Service_ReceiptXmlProcess($receiving_code);
		$result = $obxProcess->generate($absolutePath.'/'.$fileName);
		//////$obxProcess->generate($relativeHgPath.'/'.$fileName); //注释掉		
		if($result===false) return false;
		$row['fmt_type'] = 'BSG011';	//暂时
		$row['refercence_no'] = $receiving_code;
		$row['fml_path'] = $relativePath.'/'.$fileName;
		$row['fml_add_time'] = date('Y-m-d H:i:s');
		$row['fml_send_time'] = $obxProcess->sendtime;
		return Service_FtpMessageSendlist::add($row);		
	}
	/**
	 * 发送消息文件到FTP服务器
	 * @author william
	 * @param $fml_id
	 * @return boolean
	 */
	public function ftpSendMessage($fml_id) {
		$result = false;
		$fmsRow = Service_FtpMessageSendlist::getByField($fml_id);
		$fmtRow = Service_FtpMessageType::getByField('MRK', 'fmt_code');
		$connect = ftp_connect($fmtRow['fmt_host']);
		ftp_login($connect, $fmtRow['fmt_username'], $fmtRow['fmt_password']);
		$remote_file = $fmtRow['fmt_folder'].'/'.$fmsRow['refercence_no'].'.xml';
		$remote_backup_file = $fmtRow['fmt_folder'].'/backup/'.$fmsRow['refercence_no'].'.xml';
		$local_file = $this->getBasePath().$fmsRow['fml_path'];
		$haiguan_femote = '/inbound_receive/'.$fmsRow['refercence_no'].'.xml';
		if (ftp_put($connect, $remote_file, $local_file, FTP_BINARY)) {
			ftp_put($connect, $remote_backup_file, $local_file, FTP_BINARY);
			ftp_put($connect, $haiguan_femote, $local_file, FTP_BINARY);
			Service_FtpMessageSendlist::update(array('fml_status'=>2), $fml_id);
			$result = true;
		} else {
			$fmsUpdate['fml_failed_count'] = $fmsRow['fml_failed_count'] + 1;
			$fmsUpdate['fml_status'] = 1;
			Service_FtpMessageSendlist::update($fmsUpdate, $fml_id);
		}
		ftp_close($connect);
		return $result;
	}
	/**
	 * @author william-fan
	 * @todo 用于获取海关回传的xml文件
	 */
	public function getFtpXml(){
		$fmtRow = Service_FtpMessageType::getByField('MRK', 'fmt_code');
		$connect = ftp_connect($fmtRow['fmt_host']);
		$login=ftp_login($connect, $fmtRow['fmt_username'], $fmtRow['fmt_password']);
		if($login){
			//ftp_chdir($connect,'inbound_receive');
			$fileArr = ftp_nlist($connect, '/inbound_receive');
			
			//找到所有的xml
			$receivingXml = array();
			if(!empty($fileArr)){
				foreach ($fileArr as $key=>$value){
					if(strpos($value, 'xml')!==false){
						$xmlArr = explode('/', $value);
						$xmlfile = array_pop($xmlArr);
						$resultftp = self::processXml($xmlfile);
						$xmlArr = explode('.',$xmlfile);
						$AsnCode = $xmlArr[1];
						/* echo $xmlfile;
						echo '<br/>';
						$hand=fopen($xmlfile,'w+');
						
						echo $value; */
						print_r($resultftp);
						file_put_contents(APPLICATION_PATH.'/../data/ftp/'.'test1'.($key+1).'.txt', var_export($resultftp,true));
						//exit;
						self::ftpMessageReceivelist($resultftp);
						print_r($resultftp);
						if($resultftp['ask']=='1'){
							//成功 保存一份到备份 删除
							$ftp = new class_ftp($fmtRow['fmt_host'],21,$fmtRow['fmt_username'], $fmtRow['fmt_password']);
							//var_dump($ftp);
							//$ftp->move_file("/inbound_receive/$xmlfile","/inbound_receive/backup/$xmlfile"); // 移动文件
						}else{
							//失败 保存到 failed
							$ftp = new class_ftp($fmtRow['fmt_host'],21,$fmtRow['fmt_username'], $fmtRow['fmt_password']);
							//var_dump($ftp);
							//$ftp->move_file("/inbound_receive/$xmlfile","/inbound_receive/failed/$xmlfile"); // 移动文件
							
						}
						
						//fclose($hand);
						
						//print_r($resultftp);
						file_put_contents(APPLICATION_PATH.'/../data/'.'test002.txt', var_export($resultftp,true));
						$receivingXml[] = $xmlfile;
					}
				}
			}
			return $receivingXml;
		}
		ftp_close($connect);
		return $login; //连接ftp出错
	}
	/**
	 * @author william-fan
	 * @todo 用于处理海关回传的xml文件
	 */
	public static function processXml($xmlfile){
		$result = array('ask' => 0, 'message' => '确认失败', 'error' => array());
		$error = array();
		try {
			$DB = Common_Common::getAdapter();
			$DB->beginTransaction();
			$xmlArr = explode('.',$xmlfile);
			$AsnCode = $xmlArr[0];
			$receiving = Service_Receiving::getByField($AsnCode,'receiving_code');
			if(empty($receiving)){
				$error = 'ASN不存在';
				$result['message'] = "确认失败,ASN不存在";
			}
			if($receiving['receiving_status']!='3'){
				//ASN状态不对
				$result['ASNCode'] = $receiving['receiving_code'];
				$result['receiving'] = $receiving;
				$error[]='ASN状态不为待审核';
			}
			if(!empty($error)){
				$result['error'] = $error;
				$DB->rollBack();
				return $result;
			}
			$receivingRow = array(
				'receiving_status'=>'4',
				'receiving_update_time'=>date('Y-m-d H:i:s'),		
			);
			//print_r($receivingRow);
			//var_dump(Service_Receiving::update($receivingRow, $AsnCode, 'receiving_code'));
			if(!Service_Receiving::update($receivingRow, $AsnCode, 'receiving_code')){
				throw new Exception("更新ASN失败");
			}
			$ASNLog = array(
					'receiving_id'=>$receiving['receiving_id'],
					'receiving_code' => $receiving['receiving_code'],
					'user_id'=>'0',
					'rl_note' => '处理海关回馈的ASn单',
					'rl_add_time'=>date('Y-m-d H:i:s',time()),
					'rl_ip'=>''
			);
						
			if(!Service_ReceivingLog::add($ASNLog)){
				throw new Exception("添加日志错误");
			}
			$DB->rollBack();
			//$DB->commit();
			$result = array('ask' => 1, 'msg' => '更新成功!', 'error' => array(), 'ASNCode' => $AsnCode);
			return $result;
		} catch (Exception $e) {
	   		$DB->rollBack();
	   		$result['error'][] = $e->getMessage();
	   		$result['message'] = $e->getMessage();
	   		$result['ASNCode'] = $AsnCode;
	   		return $result;
	   	}
	}
	
	
	/**
	 * @author william-fan
	 * @todo 添加接收情况记录
	 */
	public static function ftpMessageReceivelist($result,$fmr_status='1'){
		
		if($result.ask=='1'){
			$fmr_status='4';
		}else{
			$fmr_status='5';
		}
		$fml_send_time = date('YmdHis').str_pad(rand(1,888), 3, '0', STR_PAD_LEFT);
		$MessageReceivingRow = array(
			'fmt_type'=>'BSG011',
			'refercence_no'=>$result['ASNCode'],
			'fmr_status'=>$fmr_status,
			'fmr_add_time'=>date('Y-m-d H:i:s',time()),
			'fmr_receive_time'=>$fml_send_time,				
		);
		Service_FtpMessageReceivelist::add($MessageReceivingRow);
	}

	
}