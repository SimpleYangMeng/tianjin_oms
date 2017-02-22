<?php
/**
 * @author colin 
 * @todo 采购订单批量上传类
 */
class Service_PurchaseOrderUpload{
	/**
	 * @author wiliam-fan
	 * @todo 读取EXCEL文件数据  
	 */
	public static function getXLSData($uploadFile,$field){
		$customerAuth = new Zend_Session_Namespace("customerAuth");

		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		//print_r($customer);
		//exit('sss');
		$path = APPLICATION_PATH.'/../data/orderupload/';
		$path.= $customerId;
		if(!file_exists($path)){
			if(!mkdir($path,0777,true)){
				$result = array("ask"=>0,"message"=>"上传文件失败失败",'error'=>array('上传目录不存在创建文件目录失败'));
				return $result;
			}
		}
		$config = array();
		$config['upload_path']		= $path;
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= '10000';
		$config['encrypt_name']		= true;
		$upload	= new Common_UploadFile($config);
		$upload->set_upload_path($path);
		$uploadResult = $upload->do_upload($_FILES,$field);
		if ( ! $uploadResult ){
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
		switch($resultArray['file_ext']){
			case ".xls":
			case ".xlsx":
				$resultArray = Common_Upload::readEXCEL($full_path);
				break;
			case ".csv":
				$resultArray = Common_Upload::readCSV($full_path);
				break;
			default:
				$resultArray = array();
				break;
		}
		/* var_dump($resultArray);
		var_dump($uploadResult);
		exit; */
		if(empty($resultArray) || !is_array($resultArray)){
			$result = array("ask"=>0,"message"=>"文件内容不符合格式或数据为空.",'error'=>array());
			//echo json_encode($result);
			//exit;
		}
		/* if(empty($resultArray) || !is_array($resultArray)){
			$result = array("ask"=>0,"message"=>"文件内容不符合格式或数据为空.",'error'=>array());
			echo json_encode($result);
			exit;
		} */
		@unlink($full_path);
		return $resultArray;
	}
	/**
	 * @author colin
	 * @todo 用于处理excel文件返回成有效的数组
	 */
	public static function getDataArr($rows){		
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];	
		$customer_code = $customer['code'];		
		$PurchaseOrderRows = array();		
		foreach ($rows as $key=>$rowData){			
			if($key==0){continue;}
			$po_code = $rowData[0];
			$supply_code = $rowData[1];
			$po_description = $rowData[2];
			$product_sku = $rowData[3];
			$product_quantity = $rowData[4];			
			if($po_code=='' || $product_sku=='' ){continue;}										
			if(!isset($PurchaseOrderRows[$po_code])){//如果已经存在键值				
				$PurchaseOrderRow = array(
					'customer_id'=>$customerId,				
					'po_code'=>$po_code,
					'supply_code'=>$supply_code,	
					'po_description'=>$po_description,
					'is_valid'=>1,
					'error'=>array(),																	
				);	
				$PurchaseOrderRows[$po_code] = $PurchaseOrderRow;				
			}
			$PurchaseOrderRows[$po_code]['product_sku'][] = $product_sku;
			$PurchaseOrderRows[$po_code]['sku'][] = $product_quantity;	
								
		}
		
		if($PurchaseOrderRows){
		     
			  
		
								
			  foreach($PurchaseOrderRows as $po_code=>&$PurchaseOrderRow){	  
			        
	
					if($PurchaseOrderRow['supply_code']==''){
						$PurchaseOrderRow['error'][] = Ec_Lang::getInstance()->getTranslate('supplier_code_required');//'进出口口岸必填';
					}else{
						 $supplies = Service_Distributor::getByCondition($a=array('customer_code'=>$customer_code,'distributor_code'=>$PurchaseOrderRow['supply_code']));
						 if(empty($supplies)){			 	
							$PurchaseOrderRow['error'][] = Ec_Lang::getInstance()->getTranslate('supplier_code_not_exists');//'进出口口岸必填';
						 }else{
						 	$supply= $supplies[0];							
						 	if($supply['distributor_status']!=1){
								$PurchaseOrderRow['error'][] = Ec_Lang::getInstance()->getTranslate('supplier_code_can_not_use');
							}
						 
						 }
					} 
					
					 $purchase_order = Service_PurchaseOrder::getByField($PurchaseOrderRow['po_code'],'po_code'); 
					 if(!empty($purchase_order)){			 	
						$PurchaseOrderRow['error'][] = Ec_Lang::getInstance()->getTranslate('purchase_order_code_exist');//'进出口口岸必填';
					 }	
			  		 if(count($PurchaseOrderRow['product_sku'])==0){
					 	$PurchaseOrderRow['error'][] = '产品信息为空';
					 }else{
					 	if(count($PurchaseOrderRow['product_sku'])!= count(array_flip($PurchaseOrderRow['product_sku']))){
							$PurchaseOrderRow['error'][] = '产品SKU有重复';
						}else{
							if(count($PurchaseOrderRow['sku'])!=count($PurchaseOrderRow['product_sku'])){
								$PurchaseOrderRow['error'][] = '采购数量跟产品个数不一致';							
							}else{
								 //检查产品是否存在
								 $po_products = &$PurchaseOrderRow['product_sku'];					 
								 foreach($po_products as $k=>$product_sku){
										$po_quantity = $PurchaseOrderRow['sku'][$k];
										if(!(preg_match('/^[0-9]+$/i',$po_quantity) && is_numeric($po_quantity) && $po_quantity>0)){											
											  $PurchaseOrderRow['error'][] = "产品SKU[{$product_sku}]数量必须为正整数";										
										}
										
								 		$products = Service_Product::getByCondition(array('customer_id'=>$customerId,'product_sku'=>$product_sku));
										if(empty($products)){
											$PurchaseOrderRow['error'][] = "产品SKU[{$product_sku}]找不到";											
										}else{
											$product = $products[0];
											if($product['product_type']!='0'){
												$PurchaseOrderRow['error'][] = vsprintf(Ec_Lang::getInstance()->getTranslate('can_not_combine_product'),array($product_sku));
											}
											if($product['product_status']!='1'){
												$PurchaseOrderRow['error'][] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_no_record'),array($product_sku));
											}											
											
											
										}
										
									
								 }
								 
								 					 
														 
							
							}//	count($PurchaseOrderRow['sku'])!=count($PurchaseOrderRow['product_sku'])				
						
						}
					 
					 }//count($PurchaseOrderRow['product_sku'])== count(a  产品
					 if(count($PurchaseOrderRow['error'])>0){
					 		$PurchaseOrderRow['is_valid'] = 0;							
					 }else{
					 		$PurchaseOrderRow['is_valid'] = 1;					 
					 }
					 
					 
			  
			  }//foreach($PurchaseOrderRows as $po_code
			  


		}
		
		

		
		if($PurchaseOrderRows){				
			  foreach($PurchaseOrderRows as $po_code=>&$PurchaseOrderRow){	
			  		$product_sku_array = array();
					$product_quantity_array = array();
					 if($PurchaseOrderRow['is_valid']!='1'){continue;}						 					 									 
					 foreach($PurchaseOrderRow['product_sku'] as $k=>$product_sku){
							$products = Service_Product::getByCondition(array('customer_id'=>$customerId,'product_sku'=>$product_sku,'product_type'=>'0','product_status'=>'1'));								
							$product =  $products[0];
							$product_id = $product['product_id'];
							$product_sku_array[$product_id] = $product_sku;
							$product_quantity_array[$product_id] = $PurchaseOrderRow['sku'][$k];
					 }
					 $PurchaseOrderRow['product_sku'] = $product_sku_array;
					 $PurchaseOrderRow['sku'] = $product_quantity_array;
								  
			  }//foreach($PurchaseOrderRows as $po_code	
			  
					
		}//	if($PurchaseOrderRows){	
				
		
		
		
		
		
		
		
		
		
		
			
		
			
		//echo "</pre>";
		return $PurchaseOrderRows; 
		//exit;
	}

	
}
