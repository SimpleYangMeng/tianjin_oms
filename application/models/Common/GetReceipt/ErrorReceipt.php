<?php

class ErrorReceipt
{
    private static $return = array(
        'ask' => 0,
        'message' => '',
        'error' => ''
    );

    public static function receive(array $bodyRow, array $headRow)
    {
		$fileDir = $headRow['filedirectory'].$headRow['filename'];
		if(is_file($fileDir)){
			$xmlFile	= file_get_contents($fileDir);
			$xml		= simplexml_load_string($xmlFile);
			$formId		= (string)$xml->Declaration->Info->FORM_ID;
			$fileType	= (string)$xml->Declaration->Info->NULL_FIELD;
			$note		= (string)$xml->Declaration->Info->FEEDBACK_MESS;
			$fmtInfo	= Service_FtpMessageType::getByField($fileType,'fmt_code');
			if(empty($fmtInfo)){
				throw new Exception($fileType.'系统报文类型未配置');
			}
			if(!class_exists($fmtInfo['fmt_error_class'])){
				throw new Exception($fmtInfo['fmt_error_class'].'系统处理类未配置');
			}
			$data =  Service_ApiMessage::getByField($formId,'am_id');
			if(empty($data)){
				throw new Exception($fmtInfo['fmt_name'].'对应的系统Id:'.$formId.'不存在');
			}
			$abnormal = array(
				'fmt_code'	=> $fileType,
				'fma_status'=> 1,
				'fma_note'	=> $note,
				'fma_add_time'	=> date('Y-m-d H:i:s'),
				'fma_sys_code'	=> $data['refer_code'],
			);
			$lastId = Service_FtpMessageAbnormal::add($abnormal);
			if(!$lastId){
				throw new Exception($fileType.":".$formId."添加错误");
			}
			self::$return['ask'] = 1;
			self::$return['message'] = "异常报文".$fileType.":".$formId."写入系统成功";
			return self::$return;
		}else{
			throw new Exception("报文不存在:".$fileDir);
		}
    }
}