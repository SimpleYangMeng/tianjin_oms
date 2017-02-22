<?php
class Default_PurchaseOrderSoapController extends Zend_Controller_Action{
	public function preDispatch(){
		$this->tplDirectory	= "default/views/default/";
	}
	public function indexAction () {
		$this->_forward('wsdl');
	}

	public function wsdlAction () {
		$host = $this->_request->getHttpHost();
		//echo $host;exit;
		header("Content-type: text/xml; Charset=utf-8");
		$content = file_get_contents(APPLICATION_PATH . "/../data/wsdl/ServiceForPurchaseOrder.wsdl");
		$content = preg_replace('/imoms\.globex\.cn/', $host, $content);
		echo $content;
		exit();
	}

	public function webServiceAction() {
		$input = file_get_contents('php://input');
        if(!empty($input)){
            $server = new SoapServer(APPLICATION_PATH . "/../data/wsdl/ServiceForPurchaseOrder.wsdl");
            $server->setClass('Api_ServiceForPurchaseOrder');
            $server->handle();
        }else{
            echo 'Invalid SOAP request';
        }
        exit;
	}
	
}