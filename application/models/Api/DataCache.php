<?php

class Common_DataCache
{

    /*
     * 清除全部缓存
     */
    public static function clean($subDir = '', $directoryLevel = 0)
    {
        $cache = Ec::cache($subDir, $directoryLevel);
        return $cache->clean('all');
    }

    public static function getWarehouse($operation = 0, $warehouseId = 0)
    {
        $cacheName = 'warehouse';
        $cache = Ec::cache();
        if ($operation == 1) {
            $cache->remove($cacheName);
        }
        if (!$result = $cache->load($cacheName)) {
            $results = Service_Warehouse::getAll();
            foreach ($results as $k => $v) {
                $result[$v['warehouse_id']] = $v;
            }
            $cache->setLifetime(72 * 3600);
            $cache->save($result, $cacheName);
        }
        if ($warehouseId) {
            $result = $result[$warehouseId];
        }
        return $result;
    }
    public static function getWarehousebh($operation = 0, $warehouseId = 0)
    {
    	$cacheName = 'warehousebh';
    	$cache = Ec::cache();
    	if ($operation == 1) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$results = Service_Warehouse::getByCondition(array('is_beihuo'=>'1'));
    		foreach ($results as $k => $v) {
    			$result[$v['warehouse_id']] = $v;
    		}
    		$cache->setLifetime(72 * 3600);
    		$cache->save($result, $cacheName);
    	}
    	if ($warehouseId) {
    		$result = $result[$warehouseId];
    	}
    	return $result;
    }
    public static function getWarehousejh($operation = 0, $warehouseId = 0)
    {
    	$cacheName = 'warehousejh';
    	$cache = Ec::cache();
    	if ($operation == 1) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$results = Service_Warehouse::getByCondition(array('is_jihuo'=>'1'));
    		foreach ($results as $k => $v) {
    			$result[$v['warehouse_id']] = $v;
    		}
    		$cache->setLifetime(72 * 3600);
    		$cache->save($result, $cacheName);
    	}
    	if ($warehouseId) {
    		$result = $result[$warehouseId];
    	}
    	return $result;
    }
    public static function getCurrency($remove = FALSE)
    {
    	$cacheName	= 'currency';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_Currency::getCustomQuery('*', 'order by currency_id asc');
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$result[$row['currency_id']]	= $row; 
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	return $result;
    }
    
    public static function getCountry($remove = FALSE,$country_id=0)
    {
    	$cacheName	= 'country';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_Country::getCustomQuery('*', 'order by country_sort asc,country_id asc');
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$result[$row['country_id']]	= $row;
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	if ($country_id) {
    		return isset($result[$country_id]) ? $result[$country_id] : array();
    	}
    	return $result;
    }
    
    public static function getProductUom($remove = FALSE)
    {
    	$cacheName	= 'productuom';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_ProductUom::getCustomQuery('*', 'order by pu_sort asc,pu_id asc');
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$result[$row['pu_id']]	= array(
    				'id'	=> $row['pu_id'],
    				'code'	=> $row['pu_code'],
    				'name'	=> $row['pu_name'],
    				'en'	=> $row['pu_name_en']
    			);
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	return $result;
    }

    public static function getProductCategory($categoryId = 0,$remove = FALSE)
    {
    	$cacheName	= 'productcategory';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	$categories = array();
    	if (!$categories = $cache->load($cacheName)) {
    		$rows	= Service_ProductCategory::getCustomQuery('*', 'order by pc_sort_id asc,pc_id asc');
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$categories[$row['pc_id']]	= $row;
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($categories, $cacheName);
    	}
    	if ($categoryId) {
    		return isset($categories[$categoryId]) ? $categories[$categoryId] : array();
    	}
    	return $categories;
    }
    /**
     * @author william-fan
     * @todo 得到分类
     */
    public static function getProductCategoryId($categoryId = 0,$remove = FALSE)
    {
    	$cacheName	= 'productcategoryId';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_ProductCategory::getByField($categoryId);
    		if (empty($rows)) {
    			return FALSE;
    		}
    		
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	return $result;
    }
	/**
	 * @todo 生成
	 */
    public static function getCategory($categoryId = 0, $operation = 0){
    	$cacheName = 'product_category_ecg';
    	$cache = Ec::cache();
    	if ($operation == 1) {
    		$isRemove = $cache->remove($cacheName);
    	}
    	$categories = array();
    	if (!$categories = $cache->load($cacheName)) {
    		$result = Service_ProductCategory::getAll();
    	
    		foreach ($result as $ca) {
    			$categories[$ca['pc_id']] = $ca;
    		}
    		$cache->setLifetime(24 * 3600); // 设置时间，为空则永久
    		$cache->save($categories, $cacheName);
    	}
    	if ($categoryId) {
    		return isset($categories[$categoryId]) ? $categories[$categoryId] : array();
    	}
    	return $categories;
    }
    /**
     * @author william-fan
     * @todo 用于获取运输方式
     */
    public static function getShippingMethod($sm_id = 0, $operation = 0)
    {
    	$cacheName = 'shipping_method';
    	$cache = Ec::cache();
    	if ($operation == 1) {
    		$isRemove = $cache->remove($cacheName);
    	}
    	$arr = array();
    	if (!$arr = $cache->load($cacheName)) {
    		$result = Service_ShippingMethod::getAll();
    
    		foreach ($result as $ca) {
    			$arr[$ca['sm_id']] = $ca;
    		}
    		$cache->setLifetime(24 * 3600); // 设置时间，为空则永久
    		$cache->save($arr, $cacheName);
    	}
    	if ($sm_id) {
    		return isset($arr[$sm_id]) ? $arr[$sm_id] : array();
    	}
    	return $arr;
    }
    /**
     * @author william-fan
     * @todo 运输方式和国家对应关系
     */
    public static function getShipTypeCountryMap($operation = 0)
    {
    	$cacheName = 'sm_country_map';
    	$cache = Ec::cache();
    	if ($operation == 1) {
    		$isRemove = $cache->remove($cacheName);
    	}
    	if (!$arr = $cache->load($cacheName)) {
    		$country = self::getCountry();
    		$arr = array();
    		foreach ($country as $k => $v) {
    			$map = Service_SmCountryMap::getByCondition(array(
    					'country_id' => $v['country_id']
    			), array(
    					'country_id',
    					'sm_code',
    					'warehouse_id'
    			), 0, 0, 'sm_code', 'sm_code');
    			$v['ship_type'] = $map;
    			if(!empty($map)){
    				$arr[$v['country_id']] = $v;
    			}
    		}
    		$cache->setLifetime(24 * 3600); // 设置时间，为空则永久
    		$cache->save($arr, $cacheName);
    	}
    
    	return $arr;
    }
    /**
     * @author william-fan
     * @todo 得到产品信息
     */
    public static function getProduct($productId, $customerId=0,$operation = 0)
    {
    	$cacheName = 'product__' . $productId;
    	$subDir = 'product';
    	$directoryLevel = 1;
    	$cache = Ec::cache($subDir, $directoryLevel);
    	if ($operation == 1) {
    		$isRemove = $cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$result = Service_Product::getProductAllInfo($productId,$customerId);
    		$cache->setLifetime(24 * 3600); // 设置时间，为空则永久
    		$cache->save($result, $cacheName);
    	}
    
    	return $result;
    }
    /**
     * @author william-fan
     * @todo 得到订单的其它信息
     */
    public static function getOrderElseInfo($ordersCode, $operation = 0)
    {
    	$cacheName = 'order__' . $ordersCode;
    	$cache = Ec::cache('order', 1);
    	if ($operation == 1) {
    		$isRemove = $cache->remove($cacheName);
    	}
    	if (!$order = $cache->load($cacheName)) {
    		$order = Service_Orders::getByField($ordersCode, 'order_code');
    		$customer = Service_Customer::getByField($order['customer_code'],'customer_code');
    		$order['currency_code'] = $customer['customer_currency'];//默认货币
    
    		$orderAddress = Service_OrderAddressBook::getByField($ordersCode, 'order_code');
    		$con = array(
    				'order_code' => $ordersCode
    		);
    		//print_r($con);
    		$orderProduct = Service_OrderProduct::getByCondition($con, "*");
    		/* echo '<pre>';
    		print_r($orderProduct);
    		echo '</pre>'; */
    		foreach ($orderProduct as $key => $p) {
    
    			$product = Common_DataCache::getProduct($p['product_id'],$order['customer_id']); // 缓存中获取
    			$p['product_sku'] = $product['product_sku'];
    
    			$p['product_title_en'] = !empty($p['product_title_en']) ? $p['product_title_en'] : $product['product_title_en']; //英文描述
    			$p['product_title'] = !empty($p['product_title']) ? $p['product_title'] : $product['product_title']; //中文描述
    			$p['product_weight'] = !empty($p['product_weight']) ? $p['product_weight'] : $product['product_weight']; //产品重量
    
    			$p['category_name'] = $product['category_name'];
    			$orderProduct[$key] = $p;
    		}
    
    		$orderUniqueProducts = array();
    		foreach($orderProduct as $v){//提取所有产品（判断有无组合产品）
    			$product = Common_DataCache::getProduct($v['product_id']); // 缓存中获取
    			if($product['product_type']==1){//组合产品
    				$con = array('product_id'=>$product['product_id']);
    				$productCombine = Service_ProductCombineRelation::getByCondition($con,"*");
    				foreach($productCombine as $sub){
    					$subProduct = Common_DataCache::getProduct($sub['pcr_product_id']);
    
    					if(isset($orderUniqueProducts[$sub['pcr_product_id']])){
    						$orderUniqueProducts[$sub['pcr_product_id']]['op_quantity'] += $sub['pcr_quantity']*$v['op_quantity'];
    					}else{
    						$orderUniqueProducts[$sub['pcr_product_id']] = array(
    								'orders_code'=>$ordersCode,
    								'product_id'=>$subProduct['product_id'],
    								'product_title'=>$subProduct['product_title'],
    								'product_title_cn'=>$subProduct['product_title_cn'],
    								'product_sku'=>$subProduct['product_sku'],
    								'product_barcode'=>$subProduct['product_barcode'],
    								'customer_id'=>$subProduct['customer_id'],
    								'op_quantity'=>$sub['pcr_quantity']*$v['op_quantity'],
    								'op_weight'=>$subProduct['product_weight'],
    								'op_unit_price'=>$subProduct['product_declared_value'],
    						);
    					}
    				}
    
    			}else{
    				if(isset($orderUniqueProducts[$v['product_id']])){
    					$orderUniqueProducts[$v['product_id']]['op_quantity'] +=$v['op_quantity'];
    				}else{
    					$orderUniqueProducts[$v['product_id']] = array(
    							'orders_code' => $ordersCode,
    							'product_id' => $product['product_id'],
    							'product_sku' => $product['product_sku'],
    							'product_title'=>$product['product_title'],
    							'product_title_cn'=>$product['product_title_cn'],
    							'product_barcode'=>$product['product_barcode'],
    							'customer_id'=>$product['customer_id'],
    							'op_quantity' => $v['op_quantity'],
    							'op_weight' => $product['product_weight'],
    							'op_unit_price' => $product['product_declared_value'],
    					);
    				}
    			}
    		}
    		//             print_r($orderUniqueProducts);exit;
    		$productUnique = $orderUniqueProducts;//唯一产品
    
    		$warehouse = Common_DataCache::getWarehouse($order['warehouse_id']);
    		//$order['warehouse_name'] = $warehouse['warehouse_name'];
    
    		$country = Common_DataCache::getCountry(false,$orderAddress['oab_country_id']);
    		/* echo '<pre>';
    		print_r($country);
    		echo '</pre>'; */
    		$order['country_name'] = $country['country_name']?$country['country_name']:'';
    		$order['oa_country_code'] = $country['country_code']?$country['country_code']:'';
    		$order['oa_country_name'] = $country['country_name_en']?$country['country_name_en']:'';
    		
    		$allorderType = Service_Orders::getorderType();
    		$order['order_type_title'] = $allorderType[$order['order_type']];
    		$order['order_type_title'] = $allorderType[$order['order_type']];
    
    		$order['order_product'] = $orderProduct;
    		$order['order_product_unique'] = $productUnique;
    
    		if(!empty($orderAddress)){
                $order = array_merge($order, $orderAddress);
            }
    		if($order['order_mode_type']=='1'){
    			//查询收货人信息
    			$orderSendAddress=Service_OrderSendAddressBook::getByField($order['order_id'],'order_id');
                if(!empty($orderSendAddress)){
                    $order = array_merge($order, $orderSendAddress);
                }
    		}
    		
    
    		$cache->setLifetime(24 * 3600); // 设置时间，为空则永久
    		$cache->save($order, $cacheName);
    	}
    
    	return $order;
    }
}