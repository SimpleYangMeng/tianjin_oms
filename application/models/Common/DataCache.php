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

    /**
     * 获取主管海关代码
     * @param  string $iePort [description]
     * @return [type]         [description]
     */
    public static function getIePort($operation = 0, $iePort = '')
    {
        $cacheName = 'IePort';
        $cache = Ec::cache();
        if ($operation == 1) {
            $cache->remove($cacheName);
        }
        if (!$result = $cache->load($cacheName)) {
            $results = Service_IePort::getAll();
            foreach ($results as $k => $v) {
                $result[$v['ie_port']] = $v;
            }
            $cache->setLifetime(72 * 3600);
            $cache->save($result, $cacheName);
        }
        if ($iePort) {
            $result = $result[$iePort];
        }
        return $result;
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
	public static function getContainer($remove = FALSE)
    {
    	$cacheName	= 'container';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_Container::getAll();
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$result[$row['container_code']]	= $row;
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	return $result;
    }
	public static function getPort($remove = FALSE)
    {
    	$cacheName	= 'port';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_Port::getAll();
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$result[$row['port_code']]	= $row;
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	return $result;
    }

	public static function getCurrencyCode($remove = FALSE)
    {
    	$cacheName	= 'currencyCode';
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
    			$result[$row['currency_code']]	= $row;
    		}
    		$cache->setOption('caching',TRUE);
    		$cache->setOption('lifetime',86400);
    		$cache->save($result, $cacheName);
    	}
    	return $result;
    }

	public static function getProductUomCode($remove = FALSE)
    {
    	$cacheName	= 'productuomcode';
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
    			$result[$row['pu_code']]	= array(
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

	public static function getHsCode($remove = FALSE)
    {
    	$cacheName	= 'hscode';
    	$cache		= Ec::cache();
    	if ($remove) {
    		$cache->remove($cacheName);
    	}
    	if (!$result = $cache->load($cacheName)) {
    		$rows	= Service_Hscodes::getAll();
    		if (empty($rows)) {
    			return FALSE;
    		}
    		foreach ($rows as $row) {
    			$result[$row['hs_code']]	= $row;
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
    public static function getCountryByCode($countryCode){
        $countryRows = self::getCountryCode();
        foreach ($countryRows as $countryRow) {
            if( $countryRow['country_code'] == $countryCode ){
                return $countryRow;
            }
        }
        return false;
    }
	public static function getCountryCode($remove = FALSE,$country_id=0)
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
    			$result[$row['country_code']]	= $row;
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

    public static function getTrafMode($remove = FALSE, $tfm_id = 0)
    {
        $cacheName  = 'TrafMode';
        $cache      = Ec::cache();
        if ($remove) {
            $cache->remove($cacheName);
        }
        if (!$result = $cache->load($cacheName)) {
            $rows   = Service_TrafMode::getAll();
            if (empty($rows)) {
                return FALSE;
            }
            foreach ($rows as $row) {
                $result[$row['tfm_id']]   = $row;
            }
            $cache->setOption('caching',TRUE);
            $cache->setOption('lifetime',86400);
            $cache->save($result, $cacheName);
        }
        if ($tfm_id) {
            return isset($result[$tfm_id]) ? $result[$tfm_id] : array();
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

    public static function getProductUomByCode($code='')
    {
        $productUomRows = self::getProductUom();

        foreach ($productUomRows as $row) {
            if($row['code'] == $code)
                return $row['name'];
        }
        return '';
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
    		$result = Service_ShippingMethod::getByCondition(array('sm_status'=>1));

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
    								'product_title_cn'=>$subProduct['product_title'],
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
    							'product_title_cn'=>$product['product_title'],
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

	public static function getSupervision()
	{
		$inspection	= array(
			array('code'=>'0101','name'=>'CCC目录内产品'),
			array('code'=>'0102','name'=>'HS编码检验检疫监管条件为L'),
			array('code'=>'0201','name'=>'普通食品、化妆品'),
			array('code'=>'0202','name'=>'保健食品'),
			array('code'=>'0203','name'=>'有检疫要求（含肉、含蛋、含乳等）的深加工食品'),
			array('code'=>'0204','name'=>'备案管理的化妆品（婴幼儿化妆品除外）'),
			array('code'=>'0205','name'=>'实施注册管理的进口婴幼儿乳粉、实施备案管理的进口婴幼儿化妆品'),
			array('code'=>'0206','name'=>'其他有特殊检验检疫监管要求的食品'),
			array('code'=>'0301','name'=>'一次性卫生用品'),
			array('code'=>'0401','name'=>'医学微生物、人体组、生物制品、血液及其制品、环保微生物菌剂'),
			array('code'=>'9999','name'=>'其他产品'),
		);
		return $inspection;
	}

	public static function getSupervisionCode()
	{
		$inspectionCode	= array('0101','0102','0201','0202','0203','0204','0205','0206','0301','0401','9999');
		return $inspectionCode;
	}
    /**
     * @author luffy丶大叔
     * 监管类型附件名称
     */
    public static function getTypeBySupervisionCode($supervision_code) {
       $type    =   array(
            '0101'=>array('01'=>'第三方检测报告' , '02'=>'原产国地区自由销售证明' , '03'=>'3C认证证书' , '04'=>'3C无需办理证明' , '05'=>'3C免办证明（手册）'),
            '0102'=>array('01'=>'第三方检测报告' , '02'=>'原产国（地区）自由销售证明' , '06'=>'技术说明3C目录外' , '07'=>'中检界定结果（3C目录外）' , '08'=>'检验检疫界定结果（3C目录外）'),
            '0201'=>array('01'=>'第三方检测报告' , '02'=>'原产国地区销售证明'),
            '0202'=>array('01'=>'第三方检测报告' , '02'=>'原产国地区自由销售证明' , '09'=>'进口保健食品批准证书' , '10'=>'原产地证明' , '14'=>'化妆品食品相关证明材料（如产品成分、原料及配比、加工工艺说明等）'),
            '0203'=>array('02'=>'原产国（地区）自由销售证明' , '10'=>'原产地证明' , '14'=>'化妆品食品相关证明材料（如产品成分、原料及配比、加工工艺说明等）'),
            '0204'=>array('01'=>'第三方检测报告' , '02'=>'原产国地区销售证明' , '10'=>'原产地证明' , '12'=>'化妆品备案凭证' , '14'=>'食品/化妆品相关证明材料（如产品成分、原料及配比、加工工艺说明等）'),
            '0205'=>array('01'=>'第三方检测报告' , '02'=>'原产国地区销售证明' , '10'=>'原产地证明' , '11'=>'婴幼儿乳粉的全项目检测报告' , '14'=>'食品/化妆品相关证明材料（如产品成分、原料及配比、加工工艺说明等）'),
            '0206'=>array('01'=>'第三方检测报告' , '02'=>'原产国地区销售证明' , '10'=>'原产地证明' , '13'=>'食品新品种、新原料的进口许可' , '14'=>'食品/化妆品相关证明材料（如产品成分、原料及配比、加工工艺说明等）'),
            '0301'=>array('01'=>'第三方检测报告' , '02'=>'原产国（地区）自由销售证明'),
            '0401'=>array('15'=>'《入/出境特殊物品卫生检疫审批单》' , '16'=>'对纳入编码范围，但不属于特殊物品的，需办理《行政许可申请不予受理决定书》'),
            '9999'=>array('99'=>'其他')
         );

       if(isset($type[$supervision_code])){
           return $type[$supervision_code];
       }
       return false;
    }

    /**
     * @author luffy丶大叔
     * @todo HMTL5上传
     */
    public static function html5Upload($data , $filename) {
        $ext    =   array(
            'data:image/jpeg;',
            'data:image/gif;',
            'data:image/png;'
        );
        $result = explode('base64,', $data);
        if(!in_array($result[0], $ext)){
            throw new Exception("只能上传图片文件！");
        }
        $fileExt    =   ($result[0] == 'data:application/pdf;') ? ".pdf" : ".jpg";
        $result =   $result[1];
        $fileResult =   base64_decode($result);
        if($fileResult){
            if(file_put_contents($filename.$fileExt, $fileResult)){
                return $fileExt;
            }
        }
        return false;
    }
}
