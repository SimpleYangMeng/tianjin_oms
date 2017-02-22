<?php
class Service_ProductSoap {
	 /**
     * addProduct
     * @param array $ProductInfo
       @return array 
		产品新增API  colin-yang	
    */
    public  static function addProduct(array $parameter) { 		 		 	
		 $ProductInfo = $parameter['ProductInfo'];
		 $row = array();
		 $time = date('Y-m-d H:i:s');
		 $row['product_sku'] = $ProductInfo['product_sku'];//sku编码
		 $row['product_title'] = $ProductInfo['skuName'];//中文名称
		 $row['product_title_en'] = $ProductInfo['skuEnName'];//英文名称
		 $row['pc_id'] = $ProductInfo['skuCategory'];//产品目录
		 $row['pu_code'] = $ProductInfo['UOM'];//产品单位
		 $row['product_barcode_type'] = $ProductInfo['barcodeType'];//条码类型
		 $row['barcode'] = $ProductInfo['barcodeDefine'];//自定义条码		 
		 $row['product_length'] = $ProductInfo['length'];//长
		 $row['product_width'] = $ProductInfo['width'];//宽
		 $row['product_height'] = $ProductInfo['height'];//高
		 $row['product_weight'] = $ProductInfo['weight'];//重量
		 $row['country_code_of_origin'] = $ProductInfo['productCountry'];//原产国
		 $row['hs_code'] = $ProductInfo['hs_code'];
		 $row['product_declared_value'] = $ProductInfo['product_declared_value'];
		 $customer_code ='EC001';
		 $row['customer_id'] =1;
		 $row['customer_code'] = 'EC001';		 
		 $row['product_add_time'] = $time;
		 $row['product_update_time'] = $time;
		 $row['product_type'] = 0;
		 $row['product_status'] = 1;		 
		 
		 $result = Service_Product::createProductTransaction($row,$customer_code);
		 
		 $resultArray = array();
		 if($resultArray['ask']==1){
		 	$resultArray['ask']='Success';
		 }else{
		 	$resultArray['ask']='Error';
			$resultArray['message'] = $result['message'];
			$resultArray['error'] = $result['error'];
		 }
		 
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
	
    public  static function queryStock(array $parameter) {
		$result_array = array(//
			'ask'=>'Fail',
			'message'=>'',
			'Data' => array(),
			'time'=>time()		
		);
		$productSku = $parameter['productSku'];
		$customer_id = 1;
		$condition_array = array();	
		$condition_array['product_sku'] = $productSku;
		$condition_array['customer_id'] = $customer_id;			
		$product_array = Service_Product::getByCondition($condition_array);
		
		if(empty($product_array)){
			$result_array['ask'] = 'Fail';	
			$result_array['message'] = '非法的产品SKU.';
			return 	$result_array;	
		}	
		
		$condition_array = array();	
		$condition_array['product_id'] =  $product_array[0]['product_id'];
		$condition_array['customer_id'] = $customer_id;				
		$ProductInventoryArray =  Service_ProductInventory::getByCondition($condition_array);
		if(empty($ProductInventoryArray)){
			$result_array['ask'] = 'Fail';	
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
				'shippedQty'=>$row['pi_shipped']//已出库数量				
			);		
		}//foreach
		
		$result_array['ask'] = 'Success';
		$result_array['message'] = '获取库存信息成功.';
		$result_array['Data'] =  $return_data_array;
		return $result_array;
    }
	/*
    public  static function sayHello2(array $name) {
        return array('hello ' . $name);
		
		$num=func_num_args();
		$list=func_get_args(); 
    }
	*/
	
	
	 /**
     * queryStock
     * @param string $productSku
       @return string 
		查询库存API  colin-yang
		
    */	
	public static function test($productSku){
		 
		return "hello";
    }	
	
}