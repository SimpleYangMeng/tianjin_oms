<?php
class Merchant_ReceivingDetailController extends Ec_Controller_Action{
	public function preDispatch ()
	{
		$this->tplDirectory = "merchant/views/receiving/";
		$this->customerAuth = new Zend_Session_Namespace("customerAuth");
	}

    public function downloadTempleteAction(){
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache'); 
    	$fullPath = APPLICATION_PATH."/../data/file".'/ReceivingImport.xls';
    	$filename = basename($fullPath);
    	header("Content-Type: APPLICATION/OCTET-STREAM");
    	$header="Content-Disposition: attachment; filename=".$filename.";";
    	header($header );
    	echo file_get_contents($fullPath);
    	exit;
    }
	
	public function indexAction(){		
		echo Ec::renderTpl($this->tplDirectory . "receiving-import.tpl",'noleftlayout');
	}
	
	public function importPreviewAction(){
		$receivingUpload = new Zend_Session_Namespace('receivingUpload');
		$field = 'XMLForInput';		
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$this->view->uploadinfo = $xlsData;			
			echo Ec::renderTpl($this->tplDirectory . "receiving-import.tpl",'noleftlayout');
		}else{
			$rows = $this->_getDataArr($xlsData);
			$receivingUpload->uploadData = $rows;
			$this->view->uploadData=$rows;
			echo Ec::renderTpl($this->tplDirectory . "receiving-import-preview.tpl",'noleftlayout');
		}
	}
	
	public function insertAction(){
		$error 			 	= array();
		$message			= array();
		$receivingUpload	= new Zend_Session_Namespace('receivingUpload');
		$sessionData 		= $receivingUpload->uploadData;
		if(empty($sessionData) || !$sessionData['valid']){
			$this->_redirect('/merchant/receiving-detail/index');
		}
		$db = Common_Common::getAdapter();
		$db->beginTransaction();
		try{
			$i = 0;
			foreach($sessionData['data'] as $key =>$val){
				if($i==0)Service_ReceivingDetail::delete($val['receivingCode'],'receiving_code');
				$receivingDetail = array(
					'receiving_code'	=> $val['receivingCode'],
					'goods_id'			=> $val['goodsId'],
					'g_no'				=> $val['gNo'],
					'code_ts'			=> $val['codeTs'],
					'g_name_cn'			=> $val['nameCn'],
					'g_model'			=> $val['gModel'],
					'g_name_en'			=> $val['nameEn'],
					'g_qty'				=> $val['gQty'],
					'g_unit'			=> $val['gUnit'],
					'decl_price'		=> $val['declPrice'],
					'curr'				=> $val['currency'],
					'qty_1'				=> $val['qty1'],
					'unit_1'			=> $val['unit1'],
					'qty_2'				=> $val['qty2'],
					'unit_2'			=> $val['unit2'],
					'origin_country'	=> $val['originCountry'],
					'duty_mode'			=> $val['dutyMode'],
					'use_to'			=> $val['useTo'],
					'decl_total'		=> $val['declTotal'],
					'note_s'			=> $val['notes'],
            	);
            	if(!Service_ReceivingDetail::add($receivingDetail)){
            		$error[]	= '料件号'.$val['goodsId'].'添加失败';
            	}
				$i++;
			}
			if(empty($error)){
				$message[]	= '上传成功';
				$db->commit();
			}else{
				$message	= $error;
				$db->rollback();
			}
		}catch(Exception  $e ){
			$error[]	= $e->getMessage();
			$db->rollback();
		}
		if($sessionData){unset($sessionData->uploadData);}
		$this->view->message = $message;
		echo Ec::renderTpl($this->tplDirectory . "receiving-import.tpl",'noleftlayout');
	}
	
	public static function getXLSData($uploadFile,$field){
		set_time_limit(300);
		ini_set('memory_limit','1024M');
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		$path = APPLICATION_PATH.'/../data/receivingupload/';
		$path.= $customerId;
		if(!file_exists($path)){
			if(!mkdir($path,0700,true)){
				$result = array("ask"=>0,"message"=>"上传文件失败失败",'error'=>array('上传目录不存在创建文件目录失败'));
				return $result;
			}
		}		
		$config = array();
		$config['upload_path']		= $path;
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= '5250000';
		$config['encrypt_name']		= true;		
		$upload	= new Common_UploadFile($config);
		$upload->set_upload_path($path);		
		if (!$upload->do_upload($_FILES,$field) ){
			$result['ask'] = '0';
			$result['message'] = '上传文件失败';
			$result['error'] =  $upload->display_errors();
			return $result;
			exit;
		}
		
		$resultArray = $upload->data();
		$full_path = $resultArray['full_path'];
		if(empty($resultArray) || empty($full_path)){
			$result = array("ask"=>0,"message"=>"上传文件失败失败",'error'=>array('数据不存在'));
			return $result;
			exit;
		}
		
		if($resultArray['file_ext'] =='.xls' || $resultArray['file_ext'] =='.xlsx'){		
				$resultArray = Common_Upload::readEXCEL($full_path);		
		}
		
		if($resultArray['file_ext'] =='.csv'){		
				$resultArray = Common_Upload::readCSV($full_path);		
		}
		@unlink($full_path);
		return $resultArray;
	}	
	
	private function  _getDataArr($productRow){
		$result		= array();
		$returnData = array();
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($productRow as $key=>$row){
			if($key<1){continue;}
			$returnData[$key]['receivingCode']	= $row[0];
			$returnData[$key]['goodsId'] 		= $row[1];
			$returnData[$key]['gNo'] 			= $row[2];
			$returnData[$key]['codeTs'] 		= $row[3];
			$returnData[$key]['gModel']			= $row[4];
			$returnData[$key]['nameCn']			= $row[5];
			$returnData[$key]['nameEn']			= $row[6];
			$returnData[$key]['gQty']			= $row[7];
			$returnData[$key]['gUnit']			= $row[8];
			$returnData[$key]['declPrice']		= $row[9];
			$returnData[$key]['currency']		= $row[10];
			$returnData[$key]['qty1']			= $row[11];
			$returnData[$key]['unit1']			= $row[12];
			$returnData[$key]['qty2']			= $row[13];
			$returnData[$key]['unit2']			= $row[14];
			$returnData[$key]['originCountry']	= $row[15];
			$returnData[$key]['dutyMode']		= $row[16];
			$returnData[$key]['useTo']			= $row[17];
			$returnData[$key]['declTotal']		= $row[18];
			$returnData[$key]['notes']			= $row[19];
		}
		$result['data']		= $returnData;
		$vaildResult	= Service_AsnProccess::validateDetail($returnData,$customerId);
		if(!empty($vaildResult)){
			$result['error']	= $vaildResult;
			$result['valid']	= 0;
		}else{
			$result['valid']	= 1;
		}
		return $result;
	}
}