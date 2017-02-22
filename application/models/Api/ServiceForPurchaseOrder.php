<?php 
/**
 * @author LuffyZhao
 * @todo 采购单接口
 */
class Api_ServiceForPurchaseOrder
{
	protected $_customerId = null;    
    protected $_customer = null;
    protected $_token = null;
    protected $_key = null;
    protected $_auth = false;
    protected $_error = null;  
    protected $_date = null;
    protected $_paramterArr = array();//将传递过来的对象转为数组存储	


    /**
     * @author LuffyZhao
     * @todo 创建采购单
     */
    public function createPurchaseOrder($data){    	
        $result = ['ask' => '0' , 'message' => '' , 'ASNCode' => '' , 'error'=>''];
        //初始化
        $this->_init($data);

        if($this->_auth === false){
        	$result['error']['errorMessage'] = $this->_error;
        	return $result;
        }
        $numberArray	=	[];
        $productSkuArray	=	[];
        if( isset($this->_paramterArr['PurchaseOrderInfo']['poItem']['productSku']) ){
        	$this->_paramterArr['PurchaseOrderInfo']['poItem']	=	[ $this->_paramterArr['PurchaseOrderInfo']['poItem'] ];
        }

        foreach($this->_paramterArr['PurchaseOrderInfo']['poItem'] as $key=>$value){        	
        	$productRows = Service_Product::getByCondition(['customer_code'=>$this->_customerId , 'product_sku'=>$value['productSku']] , ['product_id']);
        	
        	if($productRows && isset($productRows[0]) && $this->_auth === true){
        		$numberArray[$productRows[0]['product_id']]	=	$value['poQuantity'];
        		$productSkuArray[$productRows[0]['product_id']]	=	$value['productSku'];
        	}else{
        		$this->_auth = false;
        		$this->_error[] = "SKU does not exist . -->[{$value['productSku']}]";
        	}
        }

        if($this->_auth === false){
        	$result['error'] = Common_TransError::Transerror($this->_error);;
        	return $result;
        }
        //构建数据
        $data =	['action'=>'create' , 'product_sku'=>$productSkuArray , 'sku'=>$numberArray , 'customer_id'=>$this->_customer['customer_id'] , 'customer_code'=>$this->_customerId , 'po_code'=>$this->_paramterArr['PurchaseOrderInfo']['poCode'] , 'supply_code'=>$this->_paramterArr['PurchaseOrderInfo']['supplyCode'] , 'po_description'=>$this->_paramterArr['PurchaseOrderInfo']['poDescription']];
        //调用创建采购单接口    
        $doresult = Service_PurchaseOrderProcess::createTransaction($data);

        if (isset($doresult['msg'])) {
            $result['message'] = $doresult['msg'];
        }
        if($doresult['ask'] == '1'){
        	$result['ask'] = '1';
        }else{
        	$result['error'] = Common_TransError::Transerror($doresult['error']);
        }

        return $result;

    }

    /**
     * @author LuffyZhao
     * @todo 关闭采购单
     */
    public function closePurchaseOrderItem($data){
    	$result = ['ask' => '0' , 'message' => ''  , 'error'=>''];
        //初始化
        $this->_init($data);
   
        if($this->_auth === false){
        	$result['error']['errorMessage'] = $this->_error;
        	return $result;
        }

        $productRows = Service_Product::getByCondition(['customer_code'=>$this->_customerId , 'product_sku'=>$this->_paramterArr['productSku']] , ['product_id']);
        if(!($productRows && isset($productRows[0]))){
        	$result['error']['errorMessage'] = "SKU does not exist . -->[{$this->_paramterArr['productSku']}]";
        	return $result;
        }

        $pobdRows = Service_PurchaseOrderBody::getByField($productRows[0]['product_id'],'product_id', ['pobd_id']);
        if( !($pobdRows) ){
        	$result['error']['errorMessage'] = "Purchase Order does not exist . -->[{$this->_paramterArr['poCode']}:{$this->_paramterArr['productSku']}]";
        	return $result;
        }

        $doresult = Service_PurchaseOrderProcess::ClosePurchaseOrderItem($this->_customer['customer_id'] , $pobdRows['pobd_id']);

        if($doresult['ask'] == '1'){
        	$result['ask'] = 1;
        	$result['message'] = $doresult['message'];
        }else{
        	$result['error']['errorMessage'] = $doresult['message'];
        }
        return $result;
    }

    /**
     * @author LuffyZhao
     * @todo 获取采购单
     */
    public function getPurchaseOrder($data){
    	$result = ['ask' => '0' , 'message' => ''];
        //初始化
        $this->_init($data);
   
        if($this->_auth === false){
        	$result['error']['errorMessage'] = $this->_error;
        	return $result;
        }

        $poCode = $this->_paramterArr['poCode'];
        $poRow = Service_PurchaseOrder::getByField($poCode , 'po_code');

        if(!$poRow){
        	$result['error']['errorMessage'] = 'Purchase Order does not exist';
        	return $result;
        }

        $pobdRows = Service_PurchaseOrderBody::getByCondition(['po_id'=>$poRow['po_id']]);

        if(empty($pobdRows)){
        	$result['error']['errorMessage'] = 'Not Product!';
        	return $result;
        }       

        foreach ($pobdRows as $key => $value) {
        	$productRow = Service_Product::getByField($value['product_id'] , 'product_id' , ['product_sku']);
        	if($productRow && $this->_auth == true){        		
        		$result['poItem'][$key]['productSku']	=	$productRow['product_sku'];
	        	$result['poItem'][$key]['poQuantity']	=	(int)$value['order_quantity'];
	        	$result['poItem'][$key]['poStatus']	=	(int)$value['pobd_status'];
	        	$result['poItem'][$key]['ansStatus']	=	(int)$value['is_created_asn'];	        	
        	}else{
        		$this->_error[] = "Not Product!";
        		$this->_auth = false;
        	}        	
        }

        if($this->_auth == false){
        	$result['error'] = Common_TransError::Transerror($this->_error['error']);
        	return $result;
        }

        $result['poCode']	=	$poRow['po_code'];
        $result['supplyCode']	=	$poRow['supply_code'];
        $result['createTime']	=	$poRow['create_time'];
        $result['ask'] = 1;
        return $result;
    }


    /**
     * @author LuffyZhao
     * @param  array $paramter 原始数据
     */
    private function _init($paramter){
    	//对象转数组
    	$this->_paramterArr = Common_Common::objectToArray($paramter);

    	$this->_customerId = (string) $this->_paramterArr['HeaderRequest']['customerCode'];
        $this->_token = (string) $this->_paramterArr['HeaderRequest']['appToken'];
        $this->_key = (string) $this->_paramterArr['HeaderRequest']['appKey'];
        $this->_date = date('Y-m-d H:i:s');
        //密钥验证
        $this->authenticate();
    }

    /**
     * @author LuffyZhao
     * @todo 密钥验证
     */
    private function authenticate(){
    	$customer = Service_Customer::getByField($this->_customerId, 'customer_code' , ['customer_status','customer_id']);
        if (! $customer || $customer['customer_status'] != 2) {
            $this->_error = 'No Authority For ' . $this->_customerId . '.';
        }
        $this->_customer = $customer;
        $customerAuth = Service_CustomerApi::getByField($this->_customerId, 'customer_code' , ['ca_token' , 'ca_key']);

        if ($customerAuth && $customerAuth['ca_token'] == $this->_token && $customerAuth['ca_key'] == $this->_key) {
            $this->_auth = true;
        }else
        	$this->_error = 'App Token/App Key Not match for ' . $this->_customerId . '.';
    }

}