<?php
/**
 *
 */
class Storage_InventoryModifyController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "storage/views/Inventory/";
    }
	
    public function indexAction()
    {
        $customer = $this->_customerAuth;
        $allStatus = Service_InventoryModifyProccess::getStatus();
		$customerId = $customer['id'];
		$page = $this->_request->getParam('page', 1);
		$pageSize = $this->_request->getParam('pageSize', 20);
		$status = $this->_request->getParam('status', '');
		$ems_no = $this->_request->getParam('ems_no','');
		$im_code = $this->_request->getParam('im_code','');
		$customs_code	= $this->_request->getParam('customs_code','');
		$created_start_s = $created_start	= $this->_request->getParam('created_start','');
		$created_end_s = $created_end	= $this->_request->getParam('created_end','');
		$created_start	= ($created_start)?$created_start.' 00:00:00':'';
		$created_end	= ($created_end)?$created_end.' 59:59:59':'';
		
		$page = $page ? $page : 1;
		$pageSize = $pageSize ? $pageSize : 20;
		$condition = array(
			'customer_id'=>$customerId,
			'status'=>$status,
			'ems_no'=>$ems_no,
			'im_code'=>$im_code,
			'customs_code'=>$customs_code,
			'created_start'=>$created_start,
			'created_end'  =>$created_end,
		);
		$count = Service_InventoryModify::getByCondition($condition, 'count(*)');
		$result='';
		if ($count > 0) {
			$result = Service_InventoryModify::getByCondition($condition, '*', $pageSize, $page, array('im_id desc'));
		}
		$this->view->status	= $allStatus;
		if(!empty($allStatus)){
			$numConditon = $condition;
			foreach($allStatus as $keys=>$values){
				$numConditon['status'] = $keys;
				$countstatus = Service_InventoryModify::getByCondition($numConditon, 'count(*)');
				$allStatus[$keys] = $values."({$countstatus})";
			}
		}
		$iePortsCode	= array();
		$iePorts = Service_IePort::getAll();
		foreach($iePorts as $key=>$val){
			$iePortsCode[$val['ie_port']]	= $val;
		}
		$this->view->iePorts 	= $iePorts; 
		$this->view->iePortsCode= $iePortsCode;
		$this->view->page		= $page;
		$this->view->pageSize	= $pageSize;
        $this->view->count		= $count;
        $this->view->statusArr 	= $allStatus;
        $this->view->result 	= $result;
        $this->view->params 	= $condition;
        echo Ec::renderTpl($this->tplDirectory . "inventory-modify-list.tpl",  'noleftlayout');
    }
	
	public function detailAction()
	{
		$customer = $this->_customerAuth;
		$code = $this->_request->getParam('code', '');
		if(empty($code))die('操作有误');
		$inventoryModify = Service_InventoryModify::getByField($code,'im_code');
		if(empty($inventoryModify) || $customer['code'] != $inventoryModify['customer_code'])die('数据不存在');
		$iePorts = Service_IePort::getAll();
		foreach($iePorts as $key=>$val){
			$iePortsCode[$val['ie_port']]	= $val;
		}
		$allStatus = Service_InventoryModifyProccess::getStatus();
		$this->view->productUom	= Common_DataCache::getProductUomCode();
		$this->view->countryCache	= Common_DataCache::getCountryCode();
		$this->view->status	= $allStatus;
		$this->view->iePortsCode = $iePortsCode;
		$this->view->row = $inventoryModify;
		$this->view->products = Service_InventoryModifyProduct::getByCondition(array('im_code'=>$code));
		$this->view->merger = Service_InventoryModifyMerger::getByCondition(array('im_code'=>$code));
		$this->view->log = Service_InventoryModifyLog::getByCondition(array('im_code'=>$code));
		echo Ec::renderTpl($this->tplDirectory . "inventory-modify-detail.tpl",  'noleftlayout');
	}

    public function createAction()
    {
        set_time_limit(1800);
		$result = array(
			'ask' => '0', 
			'msg' => '', 
			'code' => '',
			'forwardUrl'	=> '/storage/inventory-modify/create'
		);
		$customer = $this->_customerAuth;
        $customerId = $customer['id'];
        if ($this->_request->isPost()) {
            $data = $this->getRequest()->getParams();
            $inventoryModify = new Service_InventoryModifyProccess();
			$data['customerId'] = $customerId;
            $doresult = $inventoryModify->createTransaction($data, $customerId);
            if (isset($doresult['msg'])) {
                $result['msg'] = $doresult['msg'];
            }
            $result['error']=$doresult['error'];
            $result['ask']=$doresult['ask'];
			die(json_encode($result));
        }
		$inventoryUpload	= new Zend_Session_Namespace('inventoryUpload');
		unset($inventoryUpload->mergerUploadData);
		unset($inventoryUpload->productUploadData);
		$iePorts = Service_IePort::getAll();
		$this->view->customer	= $customer;
        $this->view->iePorts = $iePorts;
		echo Ec::renderTpl($this->tplDirectory . 'inventory-modify-create.tpl', 'noleftlayout');
    }
	
	public function downloadTempleteAction(){
		$id 	= $this->_request->getParam('id');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		if(1 == $id){
			$fullPath = APPLICATION_PATH."/../data/file".'/inventoryProductAdjust.xlsx';
		}else{
			$fullPath = APPLICATION_PATH."/../data/file".'/inventoryMergerAdjust.xlsx';
		}
    	$filename = basename($fullPath);
    	header("Content-Type: APPLICATION/OCTET-STREAM");
    	$header="Content-Disposition: attachment; filename=".$filename.";";
    	header($header );
    	echo file_get_contents($fullPath);
    	exit;
    }
	
	public function mergerImportPreviewAction(){
		$result				= array('ask'=>0,'error'=>array(),'message'=>'','data'=>array()); 
		$inventoryUpload	= new Zend_Session_Namespace('inventoryUpload');
		$field = 'mergerInput';		
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$result['message']	= 'excel读取失败';
		}else{
			if(isset($inventoryUpload->productUploadData)){
				$rows = $this->_getMergerArr($xlsData);
				if(0 == $rows['valid']){
					$result['error']	= $rows['error'];
				}else{
					$result['ask']		= 1;
					$result['data']		= $rows['data'];
					$inventoryUpload->mergerUploadData	= $rows['data'];
				}
			}else{
				$result['message']	= '请先上传料件级商品信息';
			}
		}
		die(json_encode($result));
	}
	
	public function productImportPreviewAction(){
		$result				= array('ask'=>0,'error'=>array(),'message'=>'','data'=>array()); 
		$inventoryUpload	= new Zend_Session_Namespace('inventoryUpload');
		$field = 'productInput';
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$result['message']	= 'excel读取失败';
		}else{
			$rows = $this->_getProductArr($xlsData);
			if(0 == $rows['valid']){
				$result['error']	= $rows['error'];
			}else{
				$result['ask']		= 1;
				$result['data']		= $rows['data'];
				$inventoryUpload->productUploadData	= $rows['data'];
			}
		}
		die(json_encode($result));
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
	
	private function _getProductArr($row)
	{
		$result		= array();
		$returnData = array();
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($row as $key=>$val){
			if($key<1){continue;}
			$returnData[$key]['goodsId'] 		= trim($val[0]);
			$returnData[$key]['registerId'] 	= trim($val[1]);
			$returnData[$key]['codeTs'] 		= trim($val[2]);
			$returnData[$key]['nameCn'] 		= trim($val[3]);
			$returnData[$key]['stockAll']		= trim($val[4]);
			$returnData[$key]['gUnit']			= trim($val[5]);
			$returnData[$key]['unit1']			= trim($val[6]);
			$returnData[$key]['gModel']			= trim($val[7]);
			$returnData[$key]['declPrice']		= trim($val[8]);
			$returnData[$key]['currency']		= trim($val[9]);
		}
		$result['data']		= $returnData;
		$vaildResult	= Service_InventoryModifyProccess::validateProduct($returnData,$customerId);
		if(!empty($vaildResult)){
			$result['error']	= $vaildResult;
			$result['valid']	= 0;
		}else{
			$result['valid']	= 1;
		}
		return $result;
	}
	
	private function  _getMergerArr($mergerRow){
		$result		= array();
		$returnData = array();
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($mergerRow as $key=>$val){
			if($key<1){continue;}
			$returnData[$key]['gNo'] 			= trim($val[0]);
			$returnData[$key]['declNum'] 		= trim($val[1]);
			$returnData[$key]['mergerNo'] 		= trim($val[2]);
			$returnData[$key]['codeTs'] 		= trim($val[3]);
			$returnData[$key]['nameCn']			= trim($val[4]);
			$returnData[$key]['gModel']			= trim($val[5]);
			$returnData[$key]['gUnit']			= trim($val[6]);
			$returnData[$key]['stockAll']		= trim($val[7]);
			$returnData[$key]['unit1']			= trim($val[8]);
			$returnData[$key]['qty1']			= trim($val[9]);
			$returnData[$key]['declTotal']		= trim($val[10]);
			$returnData[$key]['currency']		= trim($val[11]);
			$returnData[$key]['originCountry']	= trim($val[12]);
		}
		$result['data']		= $returnData;
		$vaildResult	= Service_InventoryModifyProccess::validateMerger($returnData,$customerId);
		if(!empty($vaildResult)){
			$result['error']	= $vaildResult;
			$result['valid']	= 0;
		}else{
			$result['valid']	= 1;
		}
		return $result;
	}
}
