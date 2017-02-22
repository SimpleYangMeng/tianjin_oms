<?php
/*colin 接口的测试程序，可以不用发布在正式*/
class Default_WebServiceController extends Zend_Controller_Action {
    public function init() {//
        $this->_helper->viewRenderer->setNoRender();
    }
    /*http://www.jinkouoms.new/web-service/index/?wsdl*/
	/*查看WSDL*/
    public function indexAction() {
        
	
    }

    /*新增产品APi test  http://www.jinkouoms.new/web-service/client-product-add  */
	public function clientProductAddAction(){	
		
		$params = array();
		$HeaderRequest = array();
		$HeaderRequest['customerCode'] = 'CC001';
		$HeaderRequest['appToken'] = '8F87D4CB56B921BB';
		$HeaderRequest['appKey'] = '96f8c4723c45020e728eb7f64ee1d3a2';
		
		$params['HeaderRequest']= $HeaderRequest;		
		$params['ProductInfo'] = array(
			'skuNo'=>'colin-2d5241',//产品SKU
			'skuName'=>'玉米',//产品中文名字
			'skuEnName'=>'maojing',//产品英文名字
			'skuCategory'=>2,//目录ID
			'UOM'=>2,//单位
			'barcodeType'=>0,//条码类型
			'barcodeDefine'=>'maojin-258654',//自定义条码
			'length'=>1300,//长度
			'width'=>120,//高度
			'height'=>120,//高度
			'weight'=>140,//重量
			'brand'=>'安名',
			'currency_code'=>'RMB',
			'productCountry'=>'CN',//原产国
			'product_declared_value'=>1.65,//申报价值
			'hs_code'=>''//海关编码		
		);			
		$url = 'http://jinkouoms.cargo.com/product-soap/wsdl';
		$client = new SoapClient($url,array( 'trace' => 1 ));
		//print_r($client);exit;
		//print_r($client->__getFunctions());exit;	
		//print_r($params);
		//exit;
		//$client = new SoapClient($url);
		//$result = $client->createProduct($params);
		//var_dump($result);
		try{
		
			//$a=$client->__soapCall('createProduct',$params);
			$a = $client->createProduct($params);
		}catch(SoapFault $fault){
		
            echo $fault->faultcode;
			echo "<br>";
			echo $fault->faultstring ; 
		}
		print_r($a);
		
	}

 	/*库存查询APi test */
	public function clientQueryStockAction(){

		$params = array();
		$HeaderRequest = array();
		$HeaderRequest['customerCode'] = 'EC001';
		$HeaderRequest['appToken'] = 'N2NK51GC0B0ERSYD';
		$HeaderRequest['appKey'] = 'f8c3XDECRAJYAI4a4v3ZLw/3+E0U8LUAcBmKxRDfc+sjj2yb7EAG16JZ0qsrvAYTIaJsyEb5XoXQgnI4lgWlKVHI+7hnNtczqMKcXXOj0hU+';
		
		$params['HeaderRequest']= $HeaderRequest;		
		$params['skuNo'] = 'LED11';				
		$url = 'http://jinkouoms.cargo.com/product-soap/wsdl';		
		$client = new SoapClient($url);
		//print_r($client);exit;
		//print_r($client->__getFunctions());
		//exit;	
		//print_r($params);
		//exit;
		//$client = new SoapClient($url);
		//$result = $client->createProduct($params);
		//var_dump($result);
		try{			
			//$a=$client->__soapCall('createProduct',$params);
			$a = $client->getStock($params);
		}catch(SoapFault $fault){
		
            echo $fault->faultcode;
			echo "<br>";
			echo $fault->faultstring ; 
		}
		print_r($a);		

	}
	
	/*采购单新增colin
	http://www.jinkouoms.new/web-service/create-purchase-order
	*/
	public function createPurchaseOrderAction(){

		$params = array();
		$HeaderRequest = array();
		$HeaderRequest['customerCode'] = 'CC001';
		$HeaderRequest['appToken'] = '8F87D4CB56B921BB';
		$HeaderRequest['appKey'] = '96f8c4723c45020e728eb7f64ee1d3a2';
		
		$params['HeaderRequest']= $HeaderRequest;		
		$params['poCode'] = 'purchase-2014254544';
		$params['supplyCode'] = 'CARGO';
		$params['poDescription'] = '采购单';	
		
		$product = array();
		$product['productSku']='13-212313';
		$product['poQuantity']='5';
		
		$params['poItem'][] = $product; 

		$product = array();
		$product['productSku']='2014061805';
		$product['poQuantity']='12';
		
		$params['poItem'][] = $product;	
					
		$url = 'http://www.jinkouoms/purchase-order-soap/wsdl';		
		$client = new SoapClient($url);
		//print_r($client);exit;
		//print_r($client->__getFunctions());
		//exit;	
		//print_r($params);
		//exit;
		//$client = new SoapClient($url);
		//$result = $client->createProduct($params);
		//var_dump($result);
		
		try{	
			
			//$a=$client->__soapCall('createProduct',$params);
			$a = $client->CreatePurchaseOrder($params);
		}catch(SoapFault $fault){
		
            echo $fault->faultcode;
			echo "<br>";
			echo $fault->faultstring ; 
		}
		print_r($a);		

	}	 
	
	

}