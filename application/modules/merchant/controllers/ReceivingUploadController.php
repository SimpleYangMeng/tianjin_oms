<?php

class Merchant_ReceivingUploadController extends Ec_Controller_Action
{
	public function preDispatch ()
	{
		$this->tplDirectory = "merchant/views/receiving/";
		$this->customerAuth = new Zend_Session_Namespace("customerAuth");
	}

    public function downloadTempleteAction(){
		$id 	= $this->_request->getParam('id');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		if(1 == $id){
			$fullPath = APPLICATION_PATH."/../data/file".'/ReceivingImport.xlsx';
		}else{
			$fullPath = APPLICATION_PATH."/../data/file".'/BoatImport.xlsx';
		}
    	$filename = basename($fullPath);
    	header("Content-Type: APPLICATION/OCTET-STREAM");
    	$header="Content-Disposition: attachment; filename=".$filename.";";
    	header($header );
    	echo file_get_contents($fullPath);
    	exit;
    }

	
	public function importPreviewAction(){
		$result				= array('ask'=>0,'error'=>array(),'message'=>'','data'=>array()); 
		$receivingUpload	= new Zend_Session_Namespace('receivingUpload');
		$field = 'detailInput';		
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$result['message']	= 'excel读取失败';
		}else{
			$rows = $this->_getDataArr($xlsData);
			if(0 == $rows['valid']){
				$result['error']	= $rows['error'];
			}else{
				$result['ask']		= 1;
				$result['data']		= $rows['data'];
				$receivingUpload->uploadData	= $rows['data'];
			}
		}
		die(json_encode($result));
	}
	
	public function boatImportPreviewAction(){
		$result				= array('ask'=>0,'error'=>array(),'message'=>'','data'=>array()); 
		$receivingUpload	= new Zend_Session_Namespace('receivingUpload');
		$field = 'boatInput';
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$result['message']	= 'excel读取失败';
		}else{
			if(isset($receivingUpload->uploadData) && !empty($receivingUpload->uploadData)){
				$rows = $this->_getBoatDataArr($xlsData);
				if(0 == $rows['valid']){
					$result['error']	= $rows['error'];
				}else{
					$result['ask']		= 1;
					$result['data']		= $rows['data'];
					$receivingUpload->boatUploadData	= $rows['data'];
				}
			}else{
				$result['message']	= '请先上传入库单明细';
			}
		}
		die(json_encode($result));
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
		else if($resultArray['file_ext'] =='.csv'){		
			$resultArray = Common_Upload::readCSV($full_path);		
		}
		@unlink($full_path);
		return $resultArray;
	}	
	
	private function _getBoatDataArr($row)
	{
		$result		= array();
		$returnData = array();
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($row as $key=>$val){
			if($key<1){continue;}
			$returnData[$key]['conta_id'] 		= trim($val[0]);
			$returnData[$key]['conta_model'] 	= trim($val[1]);
			$returnData[$key]['conta_wt'] 		= trim($val[2]);
			$returnData[$key]['conta_num'] 		= trim($val[3]);
		}
		$result['data']		= $returnData;
		$vaildResult	= Service_AsnProccess::validateBoat($returnData,$customerId);
		if(!empty($vaildResult)){
			$result['error']	= $vaildResult;
			$result['valid']	= 0;
		}else{
			$result['valid']	= 1;
		}
		return $result;
	}
	
	private function  _getDataArr($productRow){
		$result		= array();
		$returnData = array();
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($productRow as $key=>$row){
			if($key<1){continue;}
			$returnData[$key]['goodsId'] 		= trim($row[0]);
			$returnData[$key]['registerId'] 	= trim($row[1]);
			$returnData[$key]['gNo'] 			= trim($row[2]);
			$returnData[$key]['ciqGNo'] 		= trim($row[3]);
			$returnData[$key]['codeTs'] 		= trim($row[4]);
			$returnData[$key]['gModel']			= trim($row[5]);
			$returnData[$key]['nameCn']			= trim($row[6]);
			$returnData[$key]['nameEn']			= trim($row[7]);
			$returnData[$key]['gQty']			= trim($row[8]);
			$returnData[$key]['gUnit']			= trim($row[9]);
			$returnData[$key]['declPrice']		= trim($row[10]);
			$returnData[$key]['currency']		= trim($row[11]);
			$returnData[$key]['qty1']			= trim($row[12]);
			$returnData[$key]['unit1']			= trim($row[13]);
			$returnData[$key]['qty2']			= trim($row[14]);
			$returnData[$key]['unit2']			= trim($row[15]);
			$returnData[$key]['originCountry']	= trim($row[16]);
			$returnData[$key]['dutyMode']		= trim($row[17]);
			$returnData[$key]['useTo']			= trim($row[18]);
			$returnData[$key]['declTotal']		= trim($row[19]);
			$returnData[$key]['notes']			= trim($row[20]);
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