<?php
class Default_OrderSoapController extends Zend_Controller_Action{
	public function preDispatch(){
		$this->tplDirectory	= "default/views/default/";
	}
	public function indexAction () {
		$this->_forward('wsdl');
	}
	
	public function webServiceAction () {
		$input = file_get_contents('php://input');
		if(!empty($input)){
			$server = new SoapServer(APPLICATION_PATH . "/../data/wsdl/ServiceForOrder.wsdl");
			$server->setClass('Api_ServiceForOrder');
			$server->handle();
		}else{
			echo 'Invalid SOAP request';
		}
		exit;
	}
	public function wsdlAction () {
		$host = $this->_request->getHttpHost();
		$format = trim($this->_request->getParam('format', ''));
		//echo $host;exit;
		header("Content-type: text/xml; Charset=utf-8");
		$content = file_get_contents(APPLICATION_PATH . "/../data/wsdl/ServiceForOrder.wsdl");
		//$content = preg_replace('/www\.jinkouoms\.com/', $host, $content);
		if ('C0286' === strtoupper($format)) {
			$content = str_replace('http://imoms.globex.cn/default/order-soap/web-service', 'http://global-man.int.jumei.com/default/order-soap/web-service', $content);
		}
		echo $content;
		exit();
	}
	public function wsdlFileAction () {
		$host = $this->_request->getHttpHost();
		$content =  file_get_contents(APPLICATION_PATH . "/../data/wsdl/ServiceForOrder.wsdl");
		$content = preg_replace('/www\.jinkouoms\.com/',$host,$content);
		$fileName = preg_replace('/([a-zA-Z_0-9]+)\.([a-zA-Z_0-9]+)\.([a-zA-Z_0-9]+)/e', 'strtolower(\\1)', $host);
		$fileName = APPLICATION_PATH.'/../data/cache/'.$fileName.'-ServiceForOrder.wsdl';
		if(!file_exists($fileName)){
			file_put_contents($fileName, $content);
		}
		Common_Common::downloadFile($fileName);
		exit;
	}
	
}