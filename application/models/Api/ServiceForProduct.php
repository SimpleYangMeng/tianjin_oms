<?php
class Api_ServiceForProduct {

 	protected $_customerId = null;
    
    protected $_customer = null;

    protected $_token = null;

    protected $_key = null;

    protected $_auth = false;

    protected $_error = null;    

    protected $_date = null;

    protected $_paramterArr = array();//将传递过来的对象转为数组存储
    

    private function _init ($headerRequest) {
        $this->_customerId = (string) $headerRequest['customerCode'];
        $this->_token = (string) $headerRequest['appToken'];
        $this->_key = (string) $headerRequest['appKey'];
    }
    /**
     * @author william-fan
     * @todo Authenticate
     */
	private function authenticate(){
        $customer = Service_Customer::getByField($this->_customerId, 'customer_code');
        if (! $customer || $customer['customer_status'] != 2) {
            $this->_error = 'No Authority For ' . $this->_customerId . '.';
            return false;
        }
        $this->_customer = $customer;
        $customerAuth = Service_CustomerApi::getByField($this->_customerId, 'customer_code');
        //file_put_contents('token.txt', $this->_token);
        
        //file_put_contents('authenticate.txt', var_export($customerAuth,true).$this->_customerId.$this->_token.'>>>>'. $this->_key);
        // return true;
        if ($customerAuth && $customerAuth['ca_token'] == $this->_token && $customerAuth['ca_key'] == $this->_key) {
            $this->_auth = true;
            return true;
        }
        $this->_error = 'App Token/App Key Not match for ' . $this->_customerId . '.';
        return false;
    }
	/**
	 * @todo 写日志
	 */
    private function logError ($error) {
        $logger = new Zend_Log();
        $uploadDir = APPLICATION_PATH . "/../data/log/";
        $writer = new Zend_Log_Writer_Stream($uploadDir . 'api-product.log');
        $logger->addWriter($writer);
        $logger->info(date('Y-m-d H:i:s') . ': ' . $error . " \n");
    }
    
	/**
	 * @author william-fan
	 * @todo 对wsdl 自动将多维数组转为一维数组的处理
	 */
    private function multiArr ($arr) {
        $return = array();
        if(is_array($arr)){
            $isMulti = true;
            foreach($arr as $k=>$v){
                if(!is_int($k)){
                    $isMulti = false;
                }
            }
            if(!$isMulti){
                $return[] = $arr;
            }else{
                $return = $arr;
            }             
        }else if(is_string($arr)){
            $return[] = $arr;
        }
        return $return;
    }
    
    /**
     * @author william-fam
     * @todo 公共方法
     */ 
    private function common($paramter) {
		// var_dump($paramter);exit;
        // 对象转数组		
        $this->_paramterArr = Common_Common::objectToArray($paramter);//对象转数组		 
        $headRequest = $this->_paramterArr['HeaderRequest'];
        $this->_init($headRequest);
        //print_r($this->_paramterArr);
        //$this->_token = $this->_paramterArr['appToken'];
        //file_put_contents('error002.txt', '00000221'.$this->_token.var_export($this->_paramterArr,true));
        $this->_date = date('Y-m-d H:i:s');
        //file_put_contents('common.txt', '00000221'.$this->_token.var_export($this->_paramterArr,true));
        
        $this->authenticate();
        /* exit;
        file_put_contents('error003.txt', '0000020000555'.var_export($this->_paramterArr,true));return; */
    }
	
	
	
   public  function createProduct(object $parameter) {   			 		 	
		//print_r($parameter);exit;	
		//$parameter['HeaderRequest'] = (array)$parameter['HeaderRequest'];
		//$parameter['ProductInfo'] = (array)$parameter['ProductInfo'];
		//$this->_paramterArr = Common_Common::objectToArray($paramter);//对象转数组		
		$result = array('ask'=>'0','message'=>'','error'=>'','skuNo'=>'');		
		$this->common($parameter);
 		if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }	
		
		$uploadDir = APPLICATION_PATH . "/../data/log/test.log";
		//file_put_contents($uploadDir ,print_r($this->_paramterArr,1));		
					 
		 $ProductInfo = $this->_paramterArr['ProductInfo'];
		 $row = array();
		 $time = date('Y-m-d H:i:s');
		 $row['product_sku'] = $ProductInfo['skuNo'];//sku编码
		 $row['product_title'] = $ProductInfo['skuName'];//中文名称
		 $row['product_title_en'] = $ProductInfo['skuEnName'];//英文名称
		 $row['pc_id'] = $ProductInfo['skuCategory'];//产品目录
		 $row['pu_code'] = $ProductInfo['UOM'];//产品单位
		 $row['product_barcode_type'] = $ProductInfo['barcodeType'];//条码类型
		 $row['product_barcode'] = $ProductInfo['barcodeDefine'];//自定义条码
		 $row['product_length'] = $ProductInfo['length'];//长
		 $row['product_width'] = $ProductInfo['width'];//宽
		 $row['product_height'] = $ProductInfo['height'];//高
		 $row['product_weight'] = $ProductInfo['weight'];//重量
		 $row['country_code_of_origin'] = $ProductInfo['productCountry'];//原产国
		 $row['hs_code'] = $ProductInfo['hs_code'];
		 $row['product_declared_value'] = $ProductInfo['product_declared_value'];
		 $row['brand'] = $ProductInfo['brand'];//
		 $row['currency_code'] = $ProductInfo['currency_code']?$ProductInfo['currency_code']:'RMB';//
		 //$customer_code ='EC001';
		 $row['customer_id'] = $this->_customer['customer_id'];
		 $row['customer_code'] = $this->_customer['customer_code'];		 
		 $row['product_add_time'] = $time;
		 $row['product_update_time'] = $time;
		 $row['product_type'] = 0;
		 $row['product_status'] = 1;		 
		 
		 $result = Service_Product::createProductTransaction($row,$row['customer_code']);
		 
		 $resultArray = array();
		 if($result['ask']==1){
		 	$resultArray['ask'] = '1';
			$resultArray['message'] = $result['message'];
			$resultArray['skuNo'] = $row['product_sku'];
		 }else{
		 	$resultArray['ask']='0';
			$resultArray['message'] = $result['message'];
			$resultArray['error'] = Common_TransError::Transerror($result['error']);
		 }
		 //file_put_contents($uploadDir ,print_r($resultArray,1));
		return $resultArray;
		 //parent::checkRow($row);
		 
		// return $name;
    }			
 
    

	 /**
     * queryStock
     * @param string $productSku
       @return array 
		查询库存API  colin-yang
		
    */
	
    public  function getStock($parameter) {
		$result = array('ask'=>'0','message'=>'','error'=>'');		
		$uploadDir = APPLICATION_PATH . "/../data/log/test.log";
		//	file_put_contents($uploadDir ,print_r($parameter,1));
		//file_put_contents($uploadDir ,print_r($this->_paramterArr,1));
		$this->common($parameter);
		//file_put_contents($uploadDir ,print_r($this->_paramterArr,1));
 		if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }		
		$result_array = array(//
			'ask'=>'0',
			'message'=>'',
			'Data' => array()			
		);
		$productSku = $this->_paramterArr['skuNo'];
		//file_put_contents($uploadDir ,print_r($this->_customer['customer_id'],1));
		$customer_id = $this->_customer['customer_id'];
		$condition_array = array();	
		$condition_array['product_sku'] = $productSku;
		$condition_array['customer_id'] = $customer_id;			
		$product_array = Service_Product::getByCondition($condition_array);
		
		if(empty($product_array)){
			$result_array['ask'] = '0';	
			$result_array['message'] = '非法的产品SKU.';
			return 	$result_array;	
		}	
		
		$condition_array = array();	
		$condition_array['product_id'] =  $product_array[0]['product_id'];
		$condition_array['customer_id'] = $customer_id;				
		$ProductInventoryArray =  Service_ProductInventory::getByCondition($condition_array);
		if(empty($ProductInventoryArray)){
			$result_array['ask'] = '0';	
			$result_array['message'] = '没找到库存数据.';
			return 	$result_array;	
		}
		
		$return_data_array = array();
		
		foreach($ProductInventoryArray as $k =>$row){
			$warehouse_id = $row['warehouse_id'];
			$warehouse_array = Service_Warehouse::getByField($warehouse_id,'warehouse_id');
			if(empty($warehouse_array)){continue;}
			
			$return_data_array[] = array(
				'skuNo'=>$productSku,
				'warehouseCode'=>$warehouse_array['warehouse_code'],
				'onwayQty'=>$row['pi_onway'],//在途数
				'pendingQty'=>$row['pi_pending'],//到货（未上架数量）
				'sellableQty'=>$row['pi_sellable'],//可用
				'unsellableQty'=>$row['pi_unsellable'],//不可用
				'reservedQty'=>$row['pi_reserved'],//冻结数量
				'shippedQty'=>$row['pi_shipped'],//已出库数量
				'expireQty'=>$row['pi_expired'],//过期数
			);		
		}//foreach
		
		$result_array['ask'] = '1';
		$result_array['message'] = '获取库存信息成功.';
		$result_array['data'] =  $return_data_array;
		return $result_array;
    }

    public function getBatchStock($parameter){
        $result = array('ask'=>'0','error'=>'','message'=>'');
        $this->common($parameter);
        if ($this->_error) {
            $result['error'] = $this->_error;
        }
        $return_data_array = array();
        $skuArr = $this->_paramterArr['skuNoArr'];

        if (!is_array($skuArr)) {
          $skuArr = array($skuArr);
        }

        foreach($skuArr as $key=>$val){

            $customer_id = $this->_customer['customer_id'];
            $condition_array = array();
            $condition_array['product_sku'] = $val;
            $condition_array['customer_id'] = $customer_id;
            $product_array = Service_Product::getByCondition($condition_array);

            if(empty($product_array)){
                $result['ask'] = '0';
                $result['error'][] = $val."非法的产品SKU.";
                continue;
            }

            $condition_array = array();
            $condition_array['product_id'] =  $product_array[0]['product_id'];
            $condition_array['customer_id'] = $customer_id;
            $ProductInventoryArray =  Service_ProductInventory::getByCondition($condition_array);
            if(empty($ProductInventoryArray)){
                $result['ask'] = '0';
                $result['error'][] = $val."没找到库存数据.";
                continue;
            }
            foreach($ProductInventoryArray as $pik =>$row){
                $warehouse_id = $row['warehouse_id'];
                $warehouse_array = Service_Warehouse::getByField($warehouse_id,'warehouse_id');
                if(empty($warehouse_array)){continue;}

                $return_data_array[] = array(
                    'skuNo'=>$val,
                    'warehouseCode'=>$warehouse_array['warehouse_code'],
                    'onwayQty'=>$row['pi_onway'],//在途数
                    'pendingQty'=>$row['pi_pending'],//到货（未上架数量）
                    'sellableQty'=>$row['pi_sellable'],//可用
                    'unsellableQty'=>$row['pi_unsellable'],//不可用
                    'reservedQty'=>$row['pi_reserved'],//冻结数量
                    'shippedQty'=>$row['pi_shipped'],//已出库数量
                    'expireQty'=>$row['pi_expired'],//过期数
                );
            }//foreach

        }

        $result['ask'] = '1';
        $result['data'] =  $return_data_array;
        return $result;
    }
    /**
     * @author william-fan
     * @todo 用于产品查询
     */
    public function getProductinfo($parameter){
    	$result = array(
    				'ask'=>'0',
    				'message'=>'',
    				'skuNo'=>'',
    				'productName'=>'',
    				'hsProductName'=>'',
    				'skuStatus'=>'',
    				'taxCode'=>'',
    				'taxName'=>'',
    				'taxRate'=>'',
                    'hsCode'=>'',
    				'backupCode'=>'',
                    'uom'=>'',
                    'goodsModel'=>'',
                    'brand'=>'',
                    'weight'=>'',
                    'declaredPrice'=>'',
    			);
    	
    	$this->common($parameter);
    	if ($this->_error) {
    		$result['message'] = $this->_error;
    		return $result;
    	}
    	//$row['customer_id'] = $this->_customer['customer_id'];
    	$customer_code = $this->_customer['customer_code'];
    	$productSkuNo = $this->_paramterArr['ProductSkuNo'];
    	$condition = array(
    		'customer_code'=>$customer_code,
    		'product_sku'=>$productSkuNo			
    	);
    	if(empty($productSkuNo)){
    		$result['message'] = "sku不能为空";
    		return $result;
    	}
    	$products = Service_Product::getByCondition($condition,"*");
    	if(empty($products)){
    		$result['message'] = '该sku不存在';
    		return $result;
    	}else{
    		if(count($products)>1){
    			$result['message'] = "该sku不唯一";
    			return $result;
    		}else{
    			$product = $products[0];
    			$result['ask'] = '1';
    			$result['message'] = "获取信息成功";
    			$result['skuNo'] = $product['product_sku'];
    			$result['productName'] = $product['product_title'];
    			$result['hsProductName'] = $product['hs_goods_name'];
    			$status = '';
    			switch($product['product_status']){
    				case "2":
    					$status = '草稿';
    					break;
    				case "0":
    					$status = '备案中';
    					break;
    				case "1":
    					$status = '已备案';
    					break;
    				case "3":
    					$status = "确认";
    					break;		
    			}
    			$result['skuStatus'] = $status;
    			$result['taxCode'] = $product['gt_code'];
    			if($product['gt_id']>0){
    				$gtinfo = Service_GoodsTax::getByField($product['gt_id']);
    				if(!empty($gtinfo)){
    					$result['taxName'] = $gtinfo['gt_name'];
    				}
    			}
    			$result['taxRate'] = $product['parcel_tax'];
                $result['hsCode'] = $product['hs_code'];
    			//backupCode
    			if($product['goods_id']!=''){
    				$productGoodInfo = Service_ProductGoods::getByField($product['goods_id'],'goods_code');
    				if(!empty($productGoodInfo)){
    					$result['backupCode'] = $productGoodInfo['registerID'];
    				}
    			}

                $result['uom'] = $product['pu_code'];
                $goodsModel = array();
                $hsCondition = array(
                    'product_id'=>$product['product_id']
                );
                $hsMaps = Service_HsElementMap::getByCondition($hsCondition,'*');
                if(!empty($hsMaps)){
                    foreach($hsMaps as $key=>$map){
                        if ('' !== trim($map['hem_detail'])) {
                          $goodsModel[] = $map['hem_detail'];
                        }
                    }
                }
                $result['goodsModel'] = implode('|', $goodsModel);
                $result['brand'] = $product['brand'];
                $result['weight'] = $product['product_weight'];
                $result['declaredPrice'] = $product['product_declared_value'];
    		}
    	}
    	return $result;
    }
    
}