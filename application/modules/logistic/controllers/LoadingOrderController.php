<?php
class Logistic_LoadingOrderController extends Ec_Controller_Action {
	
	public function preDispatch ()
	{
		$this->tplDirectory = "logistic/views/loadingOrder/";
		$this->customerAuth = new Zend_Session_Namespace("customerAuth");
        $this->customerId = $this->_customerAuth['id'];
	}
	
	public function listAction()
    {
		$customer = $this->_customerAuth;
        $statusArray = Service_ShipBatchProcess::getStatus();
		$customerId = $customer['id'];
		$page = $this->_request->getParam('page', 1);
		$pageSize = $this->_request->getParam('pageSize', 20);

		$sbCode = trim($this->_request->getParam('sb_code', ''));
		$decl_port	= $this->_request->getParam('decl_port', '');
		$ie_port	= $this->_request->getParam('ie_port', '');
		$status = $this->_request->getParam('status', '0');

		$created_start	= $this->_request->getParam('created_start','');
		$created_end	= $this->_request->getParam('created_end','');
		
		$created_start	= ($created_start)?$created_start.' 00:00:00':'';
		$created_end	= ($created_end)?$created_end.' 59:59:59':'';
		$page = $page ? $page : 1;
		$pageSize = $pageSize ? $pageSize : 20;
		$condition = array(
			'sb_code'	=> $sbCode,
			'decl_port'=>$decl_port,
			'ie_port' => $ie_port,
			'created_start'=>$created_start,
			'created_end'  =>$created_end,
			'status'=>$status,
			'customer_code'=>$customer['code'],
		);
		$count = Service_ShipBatch::getByCondition($condition, 'count(*)');
		$result='';
		if ($count > 0) {
			$result = Service_ShipBatch::getByCondition($condition, '*', $pageSize, $page, array('sb_id desc'));
		}
		$this->view->statusArray	= $statusArray;
		if(!empty($statusArray)){
			$numConditon = $condition;
			foreach($statusArray as $keys=>$values){
				$numConditon['status'] = $keys;
				$countstatus = Service_ShipBatch::getByCondition($numConditon, 'count(*)');
				$statusArray[$keys] = $values."({$countstatus})";
			}
		}
		$iePortsCode	= array();
		$iePorts = Service_IePort::getAll();
		foreach($iePorts as $key=>$val){
			$iePortsCode[$val['ie_port']]	= $val;
		}
		$this->view->status	= $statusArray;
        $this->view->iePorts = $iePorts;
		$this->view->iePortsCode = $iePortsCode;
		$this->view->page		= $page;
		$this->view->pageSize	= $pageSize;
        $this->view->count		= $count;
        $this->view->result = $result;
        $this->view->params = $condition;
        echo Ec::renderTpl($this->tplDirectory . "list.tpl",  'noleftlayout');
	}
	
	public function detailAction()
	{
		$customer = $this->_customerAuth;
		$code = $this->_request->getParam('code', '');
        $row = Service_ShipBatch::getByField($code,'sb_code',"*");
		if(empty($row) || $customer['code'] != $row['customer_code']){
			exit('未找到对应数据');
		}
		if($row['ie_port']){
			$ieport = Service_IePort::getByField($row['ie_port'],"ie_port","*");
			$row['ie_port_name'] = $ieport['ie_port_name'];
		}
		if($row['decl_port']){
			$ieport = Service_IePort::getByField($row['decl_port'],"ie_port","*");
			$row['decl_port_name'] = $ieport['ie_port_name'];
		}
        $statusArray = Service_ShipBatchProcess::getStatus();
		$this->view->status	= $statusArray;
		$this->view->deleteStatus = Service_ShipBatchProcess::getDeleteStatus();
        $detail = Service_ShipBatchOrder::getByCondition(array('sb_code'=>$code),"*");
		foreach($detail as $key=>$val){
			$persionItemInfo	= Service_PersonItem::getByField($val['order_code'],'order_code');
			$detail[$key]['wb_code']	= $persionItemInfo['wb_code'];
			$detail[$key]['po_code']	= $persionItemInfo['po_code'];
			$detail[$key]['order_reference_no']	= $persionItemInfo['order_reference_no'];
		}
		$this->view->detail	= $detail;
		$this->view->row	= $row;
		$this->view->log	= Service_ShipBatchLog::getByCondition(array('sb_code'=>$code),"*");
        echo Ec::renderTpl($this->tplDirectory . "detail.tpl",  'noleftlayout');
	}
	
    public function downloadTempleteAction(){
		$id 	= $this->_request->getParam('id');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		if(1 == $id){
			$fullPath = APPLICATION_PATH."/../data/file/loader-person-item.xlsx";
		}else{
			$fullPath = APPLICATION_PATH."/../data/file/loader-product-item.xlsx";
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
		$personItemUpload	= new Zend_Session_Namespace('personItemUpload');
		$field = 'detailInput';
		$arrayData	= array();
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$result['message']	= $xlsData['message'];
		}else{
			$rows = $this->_getDataArr($xlsData);
			if(0 == $rows['valid']){
				$result['error']	= $rows['error'];
			}else{
				$result['ask']		= 1;
				$result['data']		= $rows['data'];
				$arrayData			= $rows['data'];
			}
		}
		$personItemUpload->uploadData	= $arrayData;
		die(json_encode($result));
	}
	
	public function productImportPreviewAction(){
		$result				= array('ask'=>0,'error'=>array(),'message'=>'','data'=>array());
		$personItemUpload	= new Zend_Session_Namespace('personItemUpload');
		$field = 'productInput';
		$arrayData	= array();
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			$result['message']	= $xlsData['message'];
		}else{
			$rows = $this->_getProductDataArr($xlsData);
			if(0 == $rows['valid']){
				$result['error']	= $rows['error'];
			}else{
				$result['ask']		= 1;
				$result['data']		= $rows['data'];
				$arrayData			= $rows['data'];
			}
		}
		$personItemUpload->productUploadData	= $arrayData;
		die(json_encode($result));
	}
	
	public static function getXLSData($uploadFile,$field){
		set_time_limit(300);
		ini_set('memory_limit','1024M');
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		$path = APPLICATION_PATH.'/../data/personitemupload/';
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
		}else if($resultArray['file_ext'] =='.csv'){		
			$resultArray = Common_Upload::readCSV($full_path);		
		}
		@unlink($full_path);
		return $resultArray;
	}
	
	private function  _getDataArr($row){
		$result		= array();
		$returnData = array();
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($row as $key=>$val){
			if($key<1){continue;}
			$returnData[$key]['pim_reference_no'] 	= $val[0];
			$returnData[$key]['form_type'] 			= $val[1];
		}
		$shipBatchObject = new Service_ShipBatchProcess();
		$vaildResult	= $shipBatchObject->validateDetails($returnData,$customerId);
		$result['data']	= $returnData;
		if(!empty($vaildResult)){
			$result['error']	= $vaildResult;
			$result['valid']	= 0;
		}else{
			$result['valid']	= 1;
		}
		return $result;
	}
	
	private function  _getProductDataArr($row){
		$result		= array();
		$returnData = array();
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		foreach($row as $key=>$val){
			if($key<1){continue;}
			$returnData[$key]['declNumber'] 	= trim($val[0]);
			$returnData[$key]['formId'] 		= trim($val[1]);
			$returnData[$key]['gNo'] 			= trim($val[2]);
			$returnData[$key]['codeTs'] 		= trim($val[3]);
			$returnData[$key]['gModel']			= trim($val[4]);
			$returnData[$key]['nameCn']			= trim($val[5]);
			$returnData[$key]['nameEn']			= trim($val[6]);
			$returnData[$key]['gQty']			= trim($val[7]);
			$returnData[$key]['gUnit']			= trim($val[8]);
			$returnData[$key]['declPrice']		= trim($val[9]);
			$returnData[$key]['currency']		= trim($val[10]);
			$returnData[$key]['qty1']			= trim($val[11]);
			$returnData[$key]['unit1']			= trim($val[12]);
			$returnData[$key]['qty2']			= trim($val[13]);
			$returnData[$key]['unit2']			= trim($val[14]);
			$returnData[$key]['originCountry']	= trim($val[15]);
			$returnData[$key]['dutyMode']		= trim($val[16]);
			$returnData[$key]['useTo']			= trim($val[17]);
			$returnData[$key]['declTotal']		= trim($val[18]);
			$returnData[$key]['note']			= trim($val[19]);
		}
		$shipBatchObject = new Service_ShipBatchProcess();
		$vaildResult	= $shipBatchObject->validateProduct($returnData,$customerId);
		$result['data']	= $returnData;
		if(!empty($vaildResult)){
			$result['error']	= $vaildResult;
			$result['valid']	= 0;
		}else{
			$result['valid']	= 1;
		}
		return $result;
	}
	
    public function createAction() {
		$personItemUpload	= new Zend_Session_Namespace('personItemUpload');
        $orderError = array();
        if ($this->_request->isPost()) {
            $params = $this->_request->getParams();
            $shipBatchObject = new Service_ShipBatchProcess();
			$detail = $personItemUpload->uploadData;
			foreach($params as $key=>$val){
				$params[$key]	= trim($val);
			}
            $result = $shipBatchObject->createPayOrderTransaction($params , $this->_customerAuth['id']);
            die(Zend_Json_Encoder::encode($result));
        }
		if(!empty($personItemUpload->uploadData))unset($personItemUpload->uploadData);
		if(!empty($personItemUpload->productUploadData))unset($personItemUpload->productUploadData);
        $this->view->actionLabel = 1;
        $this->view->iePorts = Service_IePort::getAll();
		$this->view->customer	= $this->_customerAuth;
		$conformtypes = array(
        	'is_display'=>'1'
        );
		$formtypes = Service_FormType::getByCondition($conformtypes);
        $this->view->formtypes=$formtypes;
        echo Ec::renderTpl($this->tplDirectory . 'create.tpl', 'noleftlayout');
        exit;
    }
	
	public function markDeleteAction() {
		$result = array('ask' => '0', 'message' => '');
		$customer = $this->_customerAuth;
		$sbCode	= $this->_request->getParam('sbCode');
		$reason	= $this->_request->getParam('reason','');
		if(empty($sbCode)){
			$result['message'] = '载货单号不能空';
			die(json_encode($result));
		}
		$shipBatch	= Service_ShipBatch::getByField($sbCode,'sb_code');
		if(empty($shipBatch) || $shipBatch['customer_code'] != $customer['code']){
			$result['message'] = '载货单不存在';
			die(json_encode($result));
		}
		if(0 != $shipBatch['mark_delete'] || !in_array($shipBatch['status'],array('3','4','5'))){
			$result['message'] = '载货单不允许申请删除';
			die(json_encode($result));
		}
		$shipBatchObject = new Service_ShipBatchProcess();
		$result = $shipBatchObject->markDelete($sbCode,$reason);
		die(json_encode($result));
		exit;
    }

    /**
     * [printAction 载货单打印]
     * @return [type] [description]
     */
    public function printAction()
    {
    	$customer = $this->_customerAuth;
        $code = $this->_request->getParam('code', "");
        if (empty($code)) {
            header("Location:/");
            exit;
        }
        $shipBatch = Service_ShipBatch::getByField($code, 'sb_code', '*');
        if(empty($shipBatch)){
        	header("Location:/");
            exit;
        }
        $shipBatch['sb_update_time'] = date('Y/m/d H:i:s', strtotime($shipBatch['sb_update_time']));
        $shipBatchProduct = Service_ShipBatchProduct::getByCondition(array('sb_code'=>$code));
        if(!empty($shipBatchProduct) && is_array($shipBatchProduct)){
        	foreach ($shipBatchProduct as $key => $product) {
        		$pudata = Service_ProductUom::getByField($product['g_unit'], 'pu_code');
        		$shipBatchProduct[$key]['g_unit'] = $pudata['pu_name'];
        		$pudata = Service_ProductUom::getByField($product['unit_1'], 'pu_code');
        		$shipBatchProduct[$key]['unit_1'] = $pudata['pu_name'];

        	}
        }
        $this->view->customer = $customer;
        $this->view->shipBatch = $shipBatch;
        $this->view->shipBatchProduct = $shipBatchProduct;

        $tplname = 'special_print.tpl';
        switch ($shipBatch['ie_port']) {
        	//东疆区
        	case '0213':
        		$tplname = '0213_print.tpl';
        		break;
        	//天津保税区
        	case '0208':
        		$tplname = '0208_print.tpl';
        		break;
        	default:
        		$tplname = 'special_print.tpl';
        		break;
        }
        //echo Ec::renderTpl($this->tplDirectory . 'print.tpl', 'noleftlayout');
		echo $this->view->render($this->tplDirectory . $tplname);
    }

    /**
     * [barcodeAction 生成条码]
     * @return [type] [description]
     */
    public function barcodeAction(){
        Common_Barcode::barcode($this->_request->code, 'code39');
        exit;
    }
}
