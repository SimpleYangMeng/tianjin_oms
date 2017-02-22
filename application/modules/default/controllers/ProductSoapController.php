<?php
class Default_ProductSoapController extends Zend_Controller_Action{
	public function preDispatch(){
		$this->tplDirectory	= "default/views/default/";
	}
	public function indexAction () {
		$this->_forward('wsdl');
	}
	
	public function webServiceAction () {
		$input = file_get_contents('php://input');
		if(!empty($input)){
			$server = new SoapServer(APPLICATION_PATH . "/../data/wsdl/ServiceForProduct.wsdl");
			$server->setClass('Api_ServiceForProduct');
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
		$content = file_get_contents(APPLICATION_PATH . "/../data/wsdl/ServiceForProduct.wsdl");
		//$content = preg_replace('/www\.jinkouoms\.com/', $host, $content);
		if ('C0286' === strtoupper($format)) {
			$content = str_replace('http://imoms.globex.cn/default/product-soap/web-service', 'http://global-man.int.jumei.com/default/product-soap/web-service', $content);
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
	public function updateAction(){
		$HeaderRequest['customerCode'] = 'EC001';
		$HeaderRequest['appToken'] = 'N2NK51GC0B0ERSYD';
		$HeaderRequest['appKey'] = 'f8c3XDECRAJYAI4a4v3ZLw/3+E0U8LUAcBmKxRDfc+sjj2yb7EAG16JZ0qsrvAYTIaJsyEb5XoXQgnI4lgWlKVHI+7hnNtczqMKcXXOj0hU+';
		
		
		$paragram['HeaderRequest']= $HeaderRequest;
		
		
		$productDeatil = array(
				'0'=>array(
						'product_sku'=>'adf-23',
						'op_quantity'=>'1',
				),
				'1'=>array(
						'product_sku'=>'test0021',
						'op_quantity'=>'1'
				)
		);
		
		$ordersinfo['order_model'] = '0'; //备货模式订单
		$ordersinfo['orderCode'] = 'SOEC0011309250000005';
		$ordersinfo['warehouse_name'] = '郑州仓';
		$ordersinfo['to_warehouse_name'] = '郑州仓';
		$ordersinfo['oab_state_name'] = '广东';
		$ordersinfo['oab_city'] = '深圳';
		$ordersinfo['sm_code'] = 'HKEMS';
		$ordersinfo['reference_no'] = '123456001';
		$ordersinfo['oab_lastname'] = '任';
		$ordersinfo['oab_firstname'] = '我行';
		$ordersinfo['oab_company'] = '魔教';
		$ordersinfo['oab_postcode'] = '888888';
		$ordersinfo['oab_street_address1'] = '天堂路魔教总坛';
		$ordersinfo['oab_street_address2'] = '你猜';
		$ordersinfo['oab_phone'] = '111111';
		$ordersinfo['oab_email'] = 'renwoxing@mojiao.com';
		$ordersinfo['grossWt'] = '2.00';
		$ordersinfo['charge'] = '200';
		$ordersinfo['IdType'] = '1';
		$ordersinfo['idNumber'] = '123456789';
		$ordersinfo['remark'] = '暗号：反清复明';
		$ordersinfo['productDeatil'] = $productDeatil;
		
		
		$paragram['OrderInfo'] = $ordersinfo;
		$aa=new Api_ServiceForOrder();
		$aa->updateOrder($paragram);
		exit;
	}
	public function getorderAction(){
		$HeaderRequest['customerCode'] = 'EC001';
		$HeaderRequest['appToken'] = 'N2NK51GC0B0ERSYD';
		$HeaderRequest['appKey'] = 'f8c3XDECRAJYAI4a4v3ZLw/3+E0U8LUAcBmKxRDfc+sjj2yb7EAG16JZ0qsrvAYTIaJsyEb5XoXQgnI4lgWlKVHI+7hnNtczqMKcXXOj0hU+';
		
		
		$paragram['HeaderRequest']= $HeaderRequest;
		
		$paragram['orderCode'] = 'SOEC0010000107';
		$aa=new Api_ServiceForOrder();
		$aa->getOrderByCode($paragram);
	}
	/**
	 * @author william-fan
	 * @todo 用于更新订单状态
	 */
	public function updateStatusAction(){
		$result = array(
				'ask' => 'Error',
				'message' => '',
				'orderNo' => '',
				'time' => $this->_date
		);

		
		$HeaderRequest['customerCode'] = 'EC001';
		$HeaderRequest['appToken'] = 'N2NK51GC0B0ERSYD';
		$HeaderRequest['appKey'] = 'f8c3XDECRAJYAI4a4v3ZLw/3+E0U8LUAcBmKxRDfc+sjj2yb7EAG16JZ0qsrvAYTIaJsyEb5XoXQgnI4lgWlKVHI+7hnNtczqMKcXXOj0hU+';
		
		$paragram['HeaderRequest']= $HeaderRequest;
		
		
		
		$ordersCode = $this->_paramterArr['orderNo'];
		$result['orderNo'] = $ordersCode;
		
		if (empty($ordersCode)) {
			$this->_error = 'orderNo Can Not Be Null ';
			$result['message'] = $this->_error;
			return $result;
		}
		$order = Merchant_Service_Orders::getByField($ordersCode, 'orders_code');
		if (empty($order)) {
			$this->_error = 'order Not Exists For orderNo ' . $ordersCode;
			$result['message'] = $this->_error;
			return $result;
		}
		
		$process = new Service_OrderProcess();
		
		$status = $this->_paramterArr['orderStatu'];
		// 状态更新
		if (! in_array($status, array( 0, 1, 2, 3))) { // 不再允许更新的状态之内
			$result['ask'] = 'SuccessWithWarning';
			$result['message'] = 'Status Not Allow';
			return $result;
		} else { // 更新状态
			$return1 = $process->submit($ordersCode, $status);
			$result['message'] = $return1['message'];
			if ($return1['ask']) { // 状态更新失败
				$result['ask'] = 'Success';
				return $result;
			}
		}
		
		return $result;
	}
	
}