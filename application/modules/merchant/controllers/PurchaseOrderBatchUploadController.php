<?php
class Merchant_PurchaseOrderBatchUploadController extends Ec_Controller_Action{
	public function preDispatch ()
	{
		$this->tplDirectory = "merchant/views/purchaseOrder/";
		// $this->tplDirectory = "merchant/account_config/";
		$this->customerAuth = new Zend_Session_Namespace("customerAuth");
	}
	/**
	 * @author william-fan
	 * @todo 用于下载订单导入的模板
	 */
	public function downOrderTempleteAction(){
		$file = $this->_request->getParam('file','');
		switch($file){
			case 'orderupload':
				$fullPath = APPLICATION_PATH."/../data/file".'/PurchaseOrderbatchUpload.xls';
				break;
		}
		//方法2
		$filename = basename($fullPath);

		header("Content-Type: APPLICATION/OCTET-STREAM");
		//Force the download
		$header="Content-Disposition: attachment; filename=".$filename.";";
		header($header );
		// 	header("Content-Transfer-Encoding: binary");
		// 	header("Content-Length: ".$len);
		echo file_get_contents($fullPath);
		exit;
	}
	/**
	 * @author william-fan
	 * @todo 用于订单的导入
	 */
	public function batchOrderAction(){
		$customer = $this->_customerAuth;
		$customerId = $customer['id'];
		//print_r($customer);
		$customerId = $customer['id'];
		echo Ec::renderTpl($this->tplDirectory . "purchase-order-batch.tpl",'noleftlayout');
	}
	/**
	 * @author colin
	 * @todo 的采购单订单导入检查
	 */
	public function batchcheckAction(){
		//header('Content-type:text/html;charset=utf-8');
		//set_time_limit(300);
		$purchaseOrderUpload = new Zend_Session_Namespace('PurchaseOrderUpload');
		$field = 'PurchaseOrderFile';
		$xlsData = Service_OrderUpload::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			//echo 'sss';
			$this->view->uploadinfo = $xlsData;
			echo Ec::renderTpl($this->tplDirectory . "purchase-order-batch.tpl",'noleftlayout');
		}else{		
		
			$purchaseOrderRows = Service_PurchaseOrderUpload::getDataArr($xlsData);
			
			
			$purchaseOrderUpload->uploadData = $purchaseOrderRows;
			$doupload=1;
			if(!empty($orderRows)){
				foreach($purchaseOrderRows as $key=>$order){
					if($order['is_valid']=='0'){
						$doupload = 0;
					}
				}
			}
			$this->view->doupload=$doupload;
			$this->view->uploadData=$purchaseOrderRows;
			
			echo Ec::renderTpl($this->tplDirectory . "purchase-order-upload-edit.tpl",'noleftlayout');
		}
	}
	/**
	 * @author colin
	 * @todo 用于采购订单导入
	 */
	public function importAction(){
		set_time_limit(300);
		ini_set('memory_limit','1024M');
		
		$purchaseOrderUpload = new Zend_Session_Namespace('PurchaseOrderUpload');
		$sessionData = $purchaseOrderUpload->uploadData;

		$ids = $this->_request->getParam('select');
		$process = new Service_PurchaseOrderProcess();
		
		$success =0;
		$false =0;
		$successHtml = '';
		$failseHtml = '';
		$html = '';
		$index=1;
		$doupload = true;
		foreach($sessionData as $key=>$order){
			if($order['is_valid']=='0'){
				$doupload = false;
				$html = '上传采购单中有不符合要求的采购单,已终止上传';
			}
		}
		if($doupload){
			foreach ($ids as $val){
					
				$status = 1;
				$orderRow = $sessionData[$val];
				$orderRow['action'] = 'create';
				$result = $process->createTransaction($orderRow);
				if($result['ask']=='1'){
					$successHtml.="<p>第{$index}个订单".$result['ordersCode'].'创建成功'.'</p>';
					$success++;
				}else{
					$failseHtml.="<p>第{$index}个订单".$result['message'];
					if(isset($result['error'])){
						$error = $result['error'];
						if(!empty($error)){
							foreach($error as $key=>$err){
								$failseHtml.="<div class='error'>{$err}</div>";
							}
						}
					}
					$failseHtml.='</p>';
					$false++;
				}
				$index++;
			}
			$uploadResult = "<p>成功{$success}失败$false</p>";
			$html = $html.$successHtml.$failseHtml.$uploadResult;
		}

		$this->view->uploadResult=$html;
		unset($orderUpload->uploadData);
		echo Ec::renderTpl($this->tplDirectory . "purchase-order-batch.tpl",'noleftlayout');
	}
	
	
}