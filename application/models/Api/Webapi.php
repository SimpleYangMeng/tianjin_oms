<?php
/**
 * Created by PhpStorm.
 * User: WilliamFan
 * Date: 15-11-11
 * Time: 上午11:33
 */
class Api_Webapi{

    private $_customerId; //调用者的客户id
    private $opCustomer; //操作的客户

    private $logisticCustomer;
    private $payCustomerCustomer;
    private $storageCustomer;

    private $errors = '';


    //电商角色
    private $is_ecommerce = array(
        '0'=>array(
            'apiname'=>'getStock',
            'name'=>'查询产品库存',
        ),
        '1'=>array(
            'apiname'=>'getProductInfo',
            'name'=>'查询产品信息',
        ),
        '2'=>array(
            'apiname'=>'getBatchStock',
            'name'=>'批量查询产品库存',
        ),
        '3'=>array(
            'apiname'=>'operateOrder',
            'name'=>'创建/更新订单',
        ),
        '4'=>array(
            'apiname'=>'getOrderByCode',
            'name'=>'查询三单信息',
        ),
        '5'=>array(
            'apiname'=>'getpersonItem',
            'name'=>'查询个人物品清单信息',
        ),
    );
    //物流角色
    private $is_shipping = array(
        '0'=>array(
            'apiname'=>'operateLogisticOrder',
            'name'=>'创建/更新运单',
        ),
    );

    //支付企业角色
    private $is_pay =  array(
        '0'=>array(
            'apiname'=>'operatePayOrder',
            'name'=>'创建及更新支付订单',
        ),
        '1'=>array(
            'apiname'=>'getOrderByCode',
            'name'=>'查询三单信息',
        ),
    );

    //仓租企业
    private $is_storage = array(
        '0'=>array(
            'apiname'=>'createProduct',
            'name'=>'创建产品',
        ),
        '1'=>array(
            'apiname'=>'getStock',
            'name'=>'查询产品库存',
        ),
        '2'=>array(
            'apiname'=>'getBatchStock',
            'name'=>'批量查询产品库存',
        ),
        '3'=>array(
            'apiname'=>'getOrderByCode',
            'name'=>'查询三单信息',
        ),
        '4'=>array(
            'apiname'=>'createPersonItem',
            'name'=>'创建/更新个人物品清单',
        ),
        '5'=>array(
            'apiname'=>'getpersonItem',
            'name'=>'查询个人物品清单信息',
        ),
        '6'=>array(
            'apiname'=>'createLoader',
            'name'=>'创建载货单',
        ),
        '7'=>array(
            'apiname'=>'getSurveillance',
            'name'=>'海关布控查询',
        ),
        '8'=>array(
            'apiname'=>'operateAsn',
            'name'=>'创建/更新ASN',
        ),
        '9'=>array(
            'apiname'=>'getAsnByCode',
            'name'=>'查询ASN信息',
        ),
    );

    /**
     * is_ecommerce:电商角色，
     * is_shipping 物流角色
     * is_pay 支付角色
     * is_storage 仓租角色
     */
    private $apiPrivilege = ''; //可以操作api接口的角色
    /**
     * @author william-fan
     * @todo 用于转换产品参数
     */
    private function translateProduct($param){
         $productFiele = array(
             'customerCode'=>'customer_code',//电商客户代码
             'skuNo'=>'product_sku',
             'skuName'=>'product_title',
             'skuEnName'=>'product_title_en',
             'UOM'=>'pu_code',
             'barcodeDefine'=>'product_barcode',
             'length'=>'product_length',
             'width'=>'product_width',
             'height'=>'product_height',
             'weight'=>'product_weight',
             'brand'=>'brand',
             'productCountry'=>'country_code_of_origin',//要转换成id(country_code_of_origin)
             'hs_code'=>'hs_code',
             'currencyCode'=>'currency_code',
             'declaredValue'=>'product_declared_value',
             'brandCountry'=>'brand_country',//
             'enterprisesName'=>'enterprises_name',
             'element'=>'element',
             'inspectionFlag'=>'inspection_flag',
             'giftFlag'=>'gift_flag',
             'standards'=>'standards',
             'certification'=>'certification',
             'supervisionFlag'=>'supervision_flag',
             'foodEnterpriseNumber'=>'food_enterprise_number',
             'warningFlag'=>'warning_flag',
             'productDescription'=>'product_description',
             'hsGoodsName'=>'hs_goods_name',
             'gmodel'=>'product_model',
             'taxCode'=>'gt_code'
        );

        //print_r($param);

        $productinfo = array();
        foreach($productFiele as $key=>$val){
            if(isset($param[$key])){
                $productinfo[$val] = $param[$key];
            }else{
                $productinfo[$val] = '';
            }
        }
        return $productinfo;
    }

    /**
     * @author william-fan
     * @todo 用于转换订单
     */
    private function translateOrders($param){
        $fields = array(
            'orderModel'=>'order_mode_type',
            'opType'=>'opType',
            'logisticCustomerCode'=>'logistic_customer_code',
            'payCustomerCode'=>'pay_customer_code',
            'storageCustomerCode'=>'storage_customer_code',
            'warehouseCode'=>'warehouse_code',
            'oabCounty'=>'oabCounty',
            'oabStateName'=>'oabStateName',
            'oabCity'=>'oabCity',
            'oabDistrict'=>'oab_district',
            'smCode'=>'sm_code',
            'referenceNo'=>'reference_no',
            'trackingNumber'=>'ref_tracking_number',
            'oabName'=>'oab_firstname',
            'oabCompany'=>'oab_company',
            'oabPostcode'=>'oab_postcode',
            'oabStreetAddress1'=>'oab_street_address1',
            'oabStreetAddress2'=>'oab_street_address2',
            'oabPhone'=>'oab_phone',
            'oabEmail'=>'oab_email',
            'grossWt'=>'grossWt',
            'currencyCode'=>'currency_code',
            'idType'=>'IdType',
            'idNumber'=>'idNumber',
            'remark'=>'remark',
            'amount'=>'charge',
            'pay_no'=>'pay_no',
            'orderStatus'=>'order_status',
        );

        $info = array();
        foreach($fields as $key=>$val){
            if(isset($param[$key])){
                $info[$val] = $param[$key];
            }else{
                $info[$val] = '';
            }
        }
        $errors = array();
        if(isset($param['opType'])){
            if($param['opType']=='Add'){
                $info['action'] = 'add';
            }
            if($param['opType']=='Update'){
                $info['action'] = 'update';
            }
        }

        if(isset($info['warehouse_code']) && $info['warehouse_code']!=''){
            $warehouse = Service_Warehouse::getByField($info['warehouse_code'],'warehouse_code');
            if(empty($warehouse)){
                $errors[] = "仓租代码{$info['warehouse_code']}不存在";
            }else{
                $info['warehouse_id'] 	= $warehouse['warehouse_id'];
                $info['warehouse_code'] = $warehouse['warehouse_code'];
            }
        }else{
            $errors[] = "仓租代码必填";
        }


        if(isset($param['oabCounty']) && $param['oabCounty']!=''){
            //转换国家
            $country = Service_Country::getByField($param['oabCounty'],'country_code');
            if(!empty($country)){
                $info['oab_country_id'] = $country['country_id'];
                $info['oab_country_name'] = $country['country_name'];
            }else{
                $errors[] = "国家{$param['oabCounty']}不存在";
            }
        }
        //省份校验
        if(isset($param['oabStateName']) && $param['oabStateName']!=''){
            $provinceName = $param['oabStateName'];
            //转换国家
            $provinceSuffix = array(
                '省', // 如广东省
                '维吾尔自治区', // 如新疆维吾尔自治区
                '壮族自治区', // 如广西壮族自治区
                '回族自治区', // 如宁夏回族自治区
                '自治区', // 如内蒙古自治区
                '特别行政区', // 如香港特别行政区
                '市', // 如北京市
            );
            $provinceName = str_replace($provinceSuffix, '', $param['oabStateName']);
            $province = Service_Region::getByField($provinceName,'region_name');
            if(!empty($province)){
                if($province['region_type']=='1'){
                    //是省份
                    $info['oab_state'] = $provinceName;
                    $info['oab_state_id'] = $province['region_id'];
                    $info['oab_state_name'] = $provinceName;
                }else{
                    //不是省份
                    $errors[] = $provinceName."不是省份";
                }
            }else{
                $errors[] = $provinceName."不存在";
            }
        }else{
            $errors[] = '省份必填,且不能为空';
        }
        //城市校验
        if(isset($param['oabCity']) && $param['oabCity']!=''){
            $cityName = $param['oabCity'];
            $cityNameArr = Api_OrderCheck::sysSubStr($cityName,strlen($cityName));
            if(in_array("市",$cityNameArr)){
                $Arr2 =  Api_OrderCheck::sysSubStr($cityName,strlen($cityName)-3);
                $NewCityName = implode("",$Arr2);
            }else{
                $NewCityName = $cityName;
            }
            $cityCondition = array(
                'parent_id'=>$info['oab_state_id'],
                'region_name'=>$cityName
            );
            $citys = Service_Region::getByCondition($cityCondition,'*');
            if(!empty($citys)){
                $city = $citys[0];
            }else{
                $cityCondition = array(
                    'parent_id'=>$info['oab_state_id'],
                    'region_name'=>$NewCityName
                );
                $citys = Service_Region::getByCondition($cityCondition,'*');
                $city = $citys[0];
            }
            if(!empty($city)){
                if($city['region_type']=='2'){
                    $info['oab_city_id'] = $city['region_id'];
                    $info['oab_city'] = $cityName;
                }else{
                    $info['oab_city'] = $cityName;
                }
            }else{
                $errors[] = $city."城市数据不存在";
            }
        }else{
            $errors[] = '城市必填,且不能为空';
        }

        $orderProducts = $param['productDeatil'];
        //print_r($orderProducts);
        //处理产品
        $orderProductArr = array();
        if(!empty($orderProducts)){
            foreach($orderProducts as $key=>$value){
                $condition = array(
                    'customer_id'=>$this->_customer['customer_id'],
                    'product_sku'=>$value['productSku'],
                );
                $productInfo = Service_Product::getRowByCondition($condition,'*');

                if(!empty($productInfo)){
                    if($productInfo['product_status']!='1'){
                        $errors[] = $value['productSku'].'不存在,或不可用';
                    }else{
                        $op_price = $value['dealPrice']>0?$value['dealPrice']:0;
                        $product_qty = $value['opQuantity'];
                        $op_total_price = $value['opQuantity']*$op_price;

                        $orderProduct = array('product_id'=>$productInfo['product_id'],'qty'=>$product_qty);
                        $orderProduct['price'] = $op_price;
                        $orderProduct['total_price'] = $op_total_price;
                        $orderProductArr[] = $orderProduct;
                    }
                }else{
                    $errors[] = $value['productSku'].'不存在';
                }
            }
        }
        $info['order_product'] = $orderProductArr;
        $info['customer_id'] = $this->_customer['customer_id'];

        //更新时候把订单默认的数据填充过来
        if($param['opType']=='Update'){
            //获取已存在的订单，填充
            $order = Service_Orders::getOrderAllInfo($info['reference_no'],$this->_customer['customer_id']);
            if(empty($order)){
                $errors[] = '订单不存在';
            }
            //将没传值得订单以前的数据填充过来
            if(!isset($param['logisticCustomerCode'])){
            	$info['logistic_customer_code'] = $order['logistic_customer_code'];
            }
            if(!isset($param['payCustomerCode'])){
            	$info['pay_customer_code'] = $order['pay_customer_code'];
            }
            if(!isset($param['storageCustomerCode'])){
            	$info['storage_customer_code'] = $order['storage_customer_code'];
            }
            if(!isset($param['warehouseCode'])){
            	$info['warehouse_id'] = $order['warehouse_id'];
            }
            if(!isset($param['oabStateName'])){
            	$info['oab_state'] = $order['oab_state'];
            	$info['oab_state_id'] = $order['oab_state_id'];
            	$info['oab_state'] = $order['oab_state'];
            }
            if(!isset($param['oabCity'])){
            	$info['oab_city_id'] = $order['oab_city_id'];
            	$info['oab_city'] = $order['oab_city'];;
            }
            if(!isset($param['smCode'])){
            	$info['sm_code'] = $order['sm_code'];
            }
            if(!isset($param['referenceNo'])){
            	$info['reference_no'] = $order['reference_no'];
            }
            if(!isset($param['trackingNumber'])){
            	$info['ref_tracking_number'] = $order['ref_tracking_number'];
            }
            if(!isset($param['oabName'])){
            	$info['oab_firstname'] = $order['oab_firstname'];
            }
            if(!isset($param['oabCompany'])){
            	$info['oab_company'] = $order['oab_company'];
            }
            if(!isset($param['oabPostcode'])){
            	$info['oab_postcode'] = $order['oab_postcode'];
            }
            if(!isset($param['oabStreetAddress1'])){
            	$info['logistic_customer_code'] = $order['logistic_customer_code'];
            }
            if(!isset($param['logisticCustomerCode'])){
            	$info['oab_street_address1'] = $order['oab_street_address1'];
            }
            if(!isset($param['oabStreetAddress2'])){
            	$info['oab_street_address2'] = $order['oab_street_address2'];
            }
            if(!isset($param['oabPhone'])){
            	$info['oab_phone'] = $order['oab_phone'];
            }
            if(!isset($param['oabEmail'])){
            	$info['oab_phone'] = $order['oab_phone'];
            }
            if(!isset($param['oabPhone'])){
            	$info['oab_email'] = $order['oab_email'];
            }
            if(!isset($param['grossWt'])){
            	$info['grossWt'] = $order['grossWt'];
            }
            if(!isset($param['currencyCode'])){
            	$info['currency_code'] = $order['currency_code'];
            }
            if(!isset($param['idType'])){
            	$info['idType'] = $order['idType'];
            }
            if(!isset($param['idNumber'])){
            	$info['idNumber'] = $order['idNumber'];
            }
            if(!isset($param['idNumber'])){
            	$info['idNumber'] = $order['idNumber'];
            }
            if(!isset($param['remark'])){
            	$info['remark'] = $order['remark'];
            }
            if(!isset($param['amount'])){
            	$info['amount'] = $order['amount'];
            }
            if(!isset($param['pay_no'])){
            	$info['pay_no'] = $order['pay_no'];
            }
            $info['order_code'] = $order['order_code'];
            $info['ordersCode'] = $order['order_code'];
        }

        if(!empty($errors)){
            $this->errors = $errors;
        }
        return $info;
    }

    private function _init ($headerRequest) {
        $this->_customerId = (string) $headerRequest['customerCode'];
        $this->_token = (string) $headerRequest['appToken'];
        $this->_key = (string) $headerRequest['appKey'];
        $this->apiPrivilege = array(
            'is_ecommerce'=>$this->is_ecommerce,//$this->is_ecommerce,
            'is_shipping'=>$this->is_shipping,
            'is_pay'=>$this->is_pay,
            'is_storage'=>$this->is_storage,
        );
    }
    /**
     * @author william-fan
     * @todo 查找是否有权限调用接口
     */
    private function checkPrivilege($apiname,$customerArr){
        //查看电商角色
        if($customerArr['is_ecommerce']=='1'){
            //是电商角色
            $privileges = $this->apiPrivilege['is_ecommerce'];
            foreach($privileges as $k=>$v){
                if($v['apiname']==$apiname){
                    return true;
                }
            }
        }
        if($customerArr['is_shipping']=='1'){
            //是电商角色
            $privileges = $this->apiPrivilege['is_shipping'];
            foreach($privileges as $k=>$v){
                if($v['apiname']==$apiname){
                    return true;
                }
            }
        }
        if($customerArr['is_pay']=='1'){
            //是电商角色
            $privileges = $this->apiPrivilege['is_pay'];
            foreach($privileges as $k=>$v){
                if($v['apiname']==$apiname){
                    return true;
                }
            }
        }
        if($customerArr['is_storage']=='1'){
            //是电商角色
            $privileges = $this->apiPrivilege['is_storage'];
            foreach($privileges as $k=>$v){
                if($v['apiname']==$apiname){
                    return true;
                }
            }
        }
        foreach($this->apiPrivilege as $k1=>$v1){
            foreach($v1 as $k2=>$v2){
                if($v2['apiname']==$apiname){
                    $this->_error = $customerArr['customer_code'].'无权限调用'.$v2['name'];
                }
            }
        }
        return false;
    }
    /**
     * @author william-fan
     * @todo Authenticate
     */
    private function authenticate(){
        $this->_error = '';
        $customer = Service_Customer::getByField($this->_customerId, 'customer_code');
        if(empty($customer)){
            $this->_error = 'CustomerCode: ' . $this->_customerId . '不存在.';
            return false;
        }
        if (! $customer || $customer['customer_status'] != 2) {
            $this->_error = 'CustomerCode: ' . $this->_customerId . '账户不可用.';
            return false;
        }
        $this->_customer = $customer;
        $customerAuth = Service_CustomerApi::getByField($this->_customerId, 'customer_code');
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
    }

	public function getStock($parameter) {
        $result = array('ask'=>'0','message'=>'','error'=>'');
        $this->common($parameter);
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
		$productSku = $this->_paramterArr['skuNo'];
        $checkprivilege=$this->checkPrivilege('getStock',$this->_customer);
		//print_R($this->_customer);exit;
        //判断客户类型
        if(!$checkprivilege){
            $result['message'] = $this->_error;
            return $result;
        }
		$productInfo	= Service_Product::getByWhere(array('product_sku'=>$productSku,'customer_id'=>$this->_customer['customer_id']));
		if(empty($productInfo)){
			$result['message'] = '没找到库存数据';
            return $result;
		}else{
			$returnData			= array(
				'skuNo'	=> $productSku,
				'warehouseCode'=>'',
				'onwayQty'	=> '0',
				'pendingQty'=>'0',
				'sellableQty'=>'0',
				'unsellableQty'=>'0',
				'reservedQty'=>'0',
				'shippedQty'=>'0',
				'expireQty'=>'0',
			);

			$productInventory	= Service_ProductInventory::getByField($productInfo['product_id'],'product_id');
			if(!empty($productInventory)){
				$warehouseInfo	= Service_Warehouse::getByField($productInventory['warehouse_id'],'warehouse_id');
				$returnData['warehouseCode']	= $warehouseInfo['warehouse_code'];
				$returnData['onwayQty']	= $productInventory['pi_onway'];
				$returnData['pendingQty']	= $productInventory['pi_pending'];
				$returnData['sellableQty']	= $productInventory['pi_sellable'];
				$returnData['unsellableQty']	= $productInventory['pi_unsellable'];
				$returnData['shippedQty']	= $productInventory['pi_shipped'];
				$returnData['expireQty']	= $productInventory['pi_expired'];
			}
			$result['ask']	= 1;
			$result['message']	= '获取库存信息成功';
			$result['data']	= $returnData;
		}
		return $result;
		exit;
	}

	public function getBatchStock($parameter) {
        $result = array('ask'=>'0','message'=>'','error'=>'');
        $this->common($parameter);
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
		$productSkuArr = $this->_paramterArr['skuNoArr'];
        $checkprivilege=$this->checkPrivilege('getBatchStock',$this->_customer);
		//print_R($this->_customer);exit;
        //判断客户类型
        if(!$checkprivilege){
            $result['message'] = $this->_error;
            return $result;
        }
		if(empty($productSkuArr)){
			$result['message'] = 'sku填写错误';
            return $result;
		}else{
			$errorFlag	= false;
			$message	= '';
			$returnData	= array();
			foreach($productSkuArr as $key=>$val){
				$returnData[$key]			= array(
					'skuNo'	=> $val,
					'warehouseCode'=>'',
					'onwayQty'	=> '0',
					'pendingQty'=>'0',
					'sellableQty'=>'0',
					'unsellableQty'=>'0',
					'reservedQty'=>'0',
					'shippedQty'=>'0',
					'expireQty'=>'0',
				);

				$productInfo	= Service_Product::getByWhere(array('product_sku'=>$val,'customer_id'=>$this->_customer['customer_id']));
				if(empty($productInfo)){
					$errorFlag	= true;
					$message .= 'sku'.$val.'不存在';
				}else{
					$productInventory	= Service_ProductInventory::getByField($productInfo['product_id'],'product_id');
					if(!empty($productInventory)){
						$warehouseInfo	= Service_Warehouse::getByField($productInventory['warehouse_id'],'warehouse_id');
						$returnData[$key]['warehouseCode']	= $warehouseInfo['warehouse_code'];
						$returnData[$key]['onwayQty']	= $productInventory['pi_onway'];
						$returnData[$key]['pendingQty']	= $productInventory['pi_pending'];
						$returnData[$key]['sellableQty']	= $productInventory['pi_sellable'];
						$returnData[$key]['unsellableQty']	= $productInventory['pi_unsellable'];
						$returnData[$key]['shippedQty']	= $productInventory['pi_shipped'];
						$returnData[$key]['expireQty']	= $productInventory['pi_expired'];
					}
				}
			}
			if(true == $errorFlag){
				$result['message'] = $message;
			}else{
				$result['ask']	= 1;
				$result['message']	= '获取库存信息成功';
				$result['data']	= $returnData;
			}
		}
		return $result;
		exit;
	}

	public function getProductInfo($parameter) {
        $result = array('ask'=>'0','message'=>'','error'=>'');
        $this->common($parameter);
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
		$productSku = $this->_paramterArr['skuNo'];
        $checkprivilege=$this->checkPrivilege('getProductInfo',$this->_customer);
		//print_R($this->_customer);exit;
        //判断客户类型
        if(!$checkprivilege){
            $result['message'] = $this->_error;
            return $result;
        }
		$productInfo	= Service_Product::getByWhere(array('product_sku'=>$productSku,'customer_id'=>$this->_customer['customer_id']));
		if(empty($productInfo)){
			$result['message'] = '没找产品';
            return $result;
		}else{
			if($productInfo['gt_id']){
				$goodTaxInfo	= Service_GoodTax::getByField($productInfo['gt_id'],'gt_id');
			}
			$returnData			= array(
				'skuNo'	=> $productSku,
				'skuStatus'=>'',
				'taxCode'	=> $productInfo['gt_code'],
				'taxName'=>@$goodTaxInfo['gt_name'],
				'taxRate'=>@$goodTaxInfo['gt_rate'],
				'hsCode'=>@$goodTaxInfo['hs_code'],
				'backupCode'=>$productInfo['backup_code'],
				'inspectionCode'=>$productInfo['inspection_code'],
				'uom'=>$productInfo['pu_code'],
				'goodsModel'=>$productInfo['product_model'],
				'brand'=>$productInfo['brand'],
				'weight'=>$productInfo['product_weight'],
			);
			$result['ask']	= 1;
			$result['message']	= '获取产品信息成功';
			$result['data']	= $returnData;
		}
		return $result;
		exit;
	}

    /**
     * @author william-fan
     * @todo 用于产品备案
     */
    public function createProduct($parameter) {
        $result = array('ask'=>'0','message'=>'','error'=>'','skuNo'=>'');
        $this->common($parameter);
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
        $ProductInfo = $this->_paramterArr['ProductInfo'];
        $opType = $ProductInfo['opType'];//操作类型
        $checkprivilege=$this->checkPrivilege('createProduct',$this->_customer);
        //判断客户类型
        if(!$checkprivilege){
            $result['message'] = $this->_error;
            return $result;
        }
        //未经转换之前的参数
        if(isset($ProductInfo['customerCode']) && $ProductInfo['customerCode']!=''){
            $opCustomer = Service_Customer::getByField($ProductInfo['customerCode'],'customer_code');
            if(!empty($opCustomer)){
                if($opCustomer['customer_status']!='2'){
                    $result['message'] = "customerCode:{$ProductInfo['customerCode']},不存在";
                    return $result;
                }else{
                    $this->opCustomer = $opCustomer;
                }
            }else{
                $result['message'] = "customerCode:{$ProductInfo['customerCode']},不存在";
                return $result;
            }
        }else{
            $result['message'] = '电商企业客户代码customerCode必须填写';
            return $result;
        }
        //Service_Customer::
        switch($opType){
            case 'Add':
                //转换成数据库字段
                $ProductInfo = $this->translateProduct($ProductInfo);

                $row = array();
                $time = date('Y-m-d H:i:s');
                $row['product_sku'] = $ProductInfo['product_sku'];//sku编码
                $row['product_title'] = $ProductInfo['product_title'];//中文名称
                $row['product_title_en'] = $ProductInfo['product_title_en'];//英文名称
                //$row['pc_id'] = $ProductInfo['skuCategory'];//产品目录
                $row['pu_code'] = $ProductInfo['pu_code'];//产品单位
                //$row['product_barcode_type'] = $ProductInfo['barcodeType'];//条码类型
                $row['product_barcode'] = $ProductInfo['product_barcode'];//自定义条码
                $row['product_length'] = $ProductInfo['product_length'];//长
                $row['product_width'] = $ProductInfo['product_width'];//宽
                $row['product_height'] = $ProductInfo['product_height'];//高
                $row['product_weight'] = $ProductInfo['product_weight'];//重量
                $row['country_code_of_origin'] = $ProductInfo['country_code_of_origin'];//原产国
                $row['hs_code'] = $ProductInfo['hs_code'];
                $row['product_declared_value'] = $ProductInfo['product_declared_value'];
                $row['brand'] = $ProductInfo['brand'];//

                $row['brand_country'] = $ProductInfo['brand_country'];//
                $row['currency_code'] = $ProductInfo['currency_code']?$ProductInfo['currency_code']:'RMB';//
                //$customer_code ='EC001';
                $row['customer_id'] = $this->_customer['customer_id'];
                $row['customer_code'] = $this->_customer['customer_code'];
                $row['product_add_time'] = $time;
                $row['product_update_time'] = $time;
                $row['product_model'] = $ProductInfo['product_model'];
                $row['gt_code'] = $ProductInfo['gt_code'];
                $row['enterprises_name'] = $ProductInfo['enterprises_name'];
                $row['element'] = $ProductInfo['element'];
                $row['standards'] = $ProductInfo['standards'];
                $row['supervision_flag'] = $ProductInfo['supervision_flag'];

                $row['inspection_flag'] = isset($ProductInfo['inspection_flag'])&&$ProductInfo['inspection_flag']!=''?$ProductInfo['inspection_flag']:0;

                $row['gift_flag'] = isset($ProductInfo['gift_flag'])&&$ProductInfo['gift_flag']!=''?$ProductInfo['gift_flag']:0;
                $row['certification'] = isset($ProductInfo['certification'])&&$ProductInfo['certification']!=''?$ProductInfo['certification']:1;//默认认证

                $row['food_enterprise_number'] = $ProductInfo['food_enterprise_number'];
                $row['warning_flag'] = isset($ProductInfo['warning_flag'])&&$ProductInfo['warning_flag']!=''?$ProductInfo['warning_flag']:1;


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
                break;
            case 'Update':
                error_reporting(E_ERROR);
                //转换成数据库字段
                $ProductInfo = $this->translateProduct($ProductInfo);

                $row = array();
                $time = date('Y-m-d H:i:s');
                $row['product_sku'] = $ProductInfo['product_sku'];//sku编码
                $row['product_title'] = $ProductInfo['product_title'];//中文名称
                $row['product_title_en'] = $ProductInfo['product_title_en'];//英文名称
                //$row['pc_id'] = $ProductInfo['skuCategory'];//产品目录
                $row['pu_code'] = $ProductInfo['pu_code'];//产品单位
                //$row['product_barcode_type'] = $ProductInfo['barcodeType'];//条码类型
                $row['product_barcode'] = $ProductInfo['product_barcode'];//自定义条码
                $row['product_length'] = $ProductInfo['product_length'];//长
                $row['product_width'] = $ProductInfo['product_width'];//宽
                $row['product_height'] = $ProductInfo['product_height'];//高
                $row['product_weight'] = $ProductInfo['product_weight'];//重量
                $row['country_code_of_origin'] = $ProductInfo['country_code_of_origin'];//原产国
                $row['hs_code'] = $ProductInfo['hs_code'];
                $row['product_declared_value'] = $ProductInfo['product_declared_value'];
                $row['brand'] = $ProductInfo['brand'];//

                $row['brand_country'] = $ProductInfo['brand_country'];//
                $row['currency_code'] = $ProductInfo['currency_code']?$ProductInfo['currency_code']:'RMB';//
                //$customer_code ='EC001';
                $row['customer_id'] = $this->_customer['customer_id'];
                $row['customer_code'] = $this->_customer['customer_code'];
                $row['product_add_time'] = $time;
                $row['product_update_time'] = $time;
                $row['product_model'] = $ProductInfo['product_model'];
                $row['gt_code'] = $ProductInfo['gt_code'];
                $row['enterprises_name'] = $ProductInfo['enterprises_name'];
                $row['element'] = $ProductInfo['element'];
                $row['standards'] = $ProductInfo['standards'];
                $row['supervision_flag'] = $ProductInfo['supervision_flag'];

                $row['inspection_flag'] = isset($ProductInfo['inspection_flag'])&&$ProductInfo['inspection_flag']!=''?$ProductInfo['inspection_flag']:0;

                $row['gift_flag'] = isset($ProductInfo['gift_flag'])&&$ProductInfo['gift_flag']!=''?$ProductInfo['gift_flag']:0;
                $row['certification'] = isset($ProductInfo['certification'])&&$ProductInfo['certification']!=''?$ProductInfo['certification']:1;//默认认证

                $row['food_enterprise_number'] = $ProductInfo['food_enterprise_number'];
                $row['warning_flag'] = isset($ProductInfo['warning_flag'])&&$ProductInfo['warning_flag']!=''?$ProductInfo['warning_flag']:1;


                $row['product_type'] = 0;
                $row['product_status'] = 1;

                $condition = array(
                    'product_barcode'=>$ProductInfo['product_barcode'],
                    'customer_code'=>$this->opCustomer['customer_code']
                );

                $products = Service_Product::getByCondition($condition,'*');

                $result = Service_Product::updateProductTransaction($row, $products[0]['product_id'],$this->opCustomer['customer_id']);
                return $result;
                break;
            default:
                $result['ask']='0';
                $result['message'] = "操作类型错误,只能是Add、Update";
                $result['error'] = '';
                return $result;
        }

    }

    /**
     * @author william-fan
     * @todo 用于operateOrder
     */
    public function operateOrder($parameter){
        $result = array('ask'=>'0','message'=>'','error'=>'');
        $this->common($parameter);
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
        $orderInfo = $this->_paramterArr['OrderInfo'];
        $opType = $orderInfo['opType'];//操作类型
        $checkprivilege=$this->checkPrivilege('operateOrder',$this->_customer);
        //判断客户类型
        if(!$checkprivilege){
            $result['message'] = $this->_error;
            return $result;
        }
        //未经转换之前的参数
        //物流企业代码必须要填写
        if(isset($orderInfo['logisticCustomerCode']) && $orderInfo['logisticCustomerCode']!=''){
            $opCustomer = Service_Customer::getByField($orderInfo['logisticCustomerCode'],'customer_code');
            if(!empty($opCustomer)){
                if($opCustomer['customer_status']!='2'){
                    $result['message'] = "物流企业customerCode:{$orderInfo['logisticCustomerCode']},不可用";
                    return $result;
                }else{
                    $this->logisticCustomer = $opCustomer;
                }
            }else{
                $result['message'] = "物流企业customerCode:{$orderInfo['logisticCustomerCode']},不存在";
                return $result;
            }
        }else{
            $result['message'] = '物流企业customerCode必须填写';
            return $result;
        }
        //支付企业客户代码
        if(isset($orderInfo['payCustomerCode']) && $orderInfo['payCustomerCode']!=''){
            $opCustomer = Service_Customer::getByField($orderInfo['payCustomerCode'],'customer_code');
            if(!empty($opCustomer)){
                if($opCustomer['customer_status']!='2'){
                    $result['message'] = "支付企业customerCode:{$orderInfo['payCustomerCode']},不可用";
                    return $result;
                }else{
                    $this->payCustomerCustomer = $opCustomer;
                }
            }else{
                $result['message'] = "支付企业customerCode:{$orderInfo['payCustomerCode']},不存在";
                return $result;
            }
        }else{
            $result['message'] = '支付企业customerCode必须填写';
            return $result;
        }
        //仓储企业客户代码
        if(isset($orderInfo['storageCustomerCode']) && $orderInfo['storageCustomerCode']!=''){
            $opCustomer = Service_Customer::getByField($orderInfo['storageCustomerCode'],'customer_code');
            if(!empty($opCustomer)){
                if($opCustomer['customer_status']!='2'){
                    $result['message'] = "仓租企业customerCode:{$orderInfo['storageCustomerCode']},不可用";
                    return $result;
                }else{
                    $this->storageCustomer = $opCustomer;
                }
            }else{
                $result['message'] = "仓租企业customerCode:{$orderInfo['storageCustomerCode']},不存在";
                return $result;
            }
        }else{
            $result['message'] = '仓租企业customerCode必须填写';
            return $result;
        }

        //Service_Customer::
        switch($opType){
            case 'Add':
                //转换成数据库字段
                $orderInfo = $this->translateOrders($orderInfo);
                if(!empty($this->errors)){
                    $result['error'] = Common_TransError::Transerror($this->errors);
                    return $result;
                }
                $process = new Service_OrderProcess();
                if($orderInfo['order_mode_type']=='1'){
                    //集货模式的订单创建
                    $doresult = $process->createjhOrderTransaction($orderInfo);
                }else{
                    //备货模式的订单创建
                    $doresult = $process->createOrderTransaction($orderInfo);
                }
                $status = $orderInfo['order_status'];
                if($doresult['ask']=='1'){
                    $result['ask'] = '1';
                    $result['message'] = $doresult['message'];
                    $result['orderCode'] = $doresult['ordersCode'];
                    //更新状态
                    if(!in_array($status, array(1,4))){//不再允许更新的状态之内
                        $result['ask'] = '1';
                        $result['message'] = $result['message'].';移动状态失败状态不允许';
                        $result['error'] = Common_TransError::Transerror(array('订单状态移动失败,状态不允许'));
                        return $result;
                    }else{//更新状态
                        if($status=='4'){
                            //确认成功 然后 提交订单
                            $moveresult=$process->submit($doresult['orderCode'],$this->_customer['customer_id']);
                            if($moveresult['result']=='0'){
                                $result['message'] = $result['message'].';移至已提交失败';
                                $result['error'] = Common_TransError::Transerror($moveresult['error']);
                            }else{
                                //提交
                                $result['message'] = $result['message'].';移至已提交成功';
                            }
                        }
                    }
                }else{
                    $result['message'] = $doresult['message'];
                    $result['error'] = Common_TransError::Transerror($doresult['error']);
                }
                //file_put_contents($uploadDir ,print_r($resultArray,1));
                return $result;
                break;
            case 'Update':
                error_reporting(E_ERROR);
                //转换成数据库字段
                $orderInfo = $this->translateOrders($orderInfo);
                if(!empty($this->errors)){
                    $result['error'] = Common_TransError::Transerror($this->errors);
                    return $result;
                }
                $process = new Service_OrderProcess();
                $result = $process->updateOrderTransaction($orderInfo, $orderInfo['order_code'], $this->_customer['customer_id']);
                if($result['error']!=''){
                    $result['error'] = Common_TransError::Transerror($result['error']);
                }
                $result['action'] = 'update';
                return $result;
                break;
            default:
                $result['ask']='0';
                $result['message'] = "操作类型错误,只能是Add、Update";
                $result['error'] = '';
                return $result;
        }
    }

    /**
     * @author william-fan
     * @todo 用于 创建/更新运单（operateLogisticOrder）
     */
    public function operateLogisticOrder(){

    }





}
