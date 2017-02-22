<?php
/**
 * @todo 校验设置API传过订单数据
 */
class Api_OrderCheck {
	public static function TransformData($rowData,$customer){
		$orderRow = array (
				'customer_id' => '',
				'warehouse_id' => '',
				'warehouse_code' => '',
				'to_warehouse_id' => '',
				'to_warehouse_code' => '',
				'order_type'=>'0',//普通订单
				'sm_code' => '',
				'oab_country_name'=>'',
				'oab_country_id'=>'0',
				'oab_state' => '', // 省份
				'oab_state_name' => '',
				'oab_city' => '', // 城市
				'oab_district'=>'',
				'currency_code' => 'RMB', // 默认为人民币
				'order_status' => '1',
				'reference_no' => '',
				'ref_tracking_number'=>'',
				'oab_lastname' => '',
				'oab_firstname' => '',
				'oab_company' => '',
				'oab_postcode' => '',
				'oab_street_address1' => '',
				'oab_street_address2' => '',
				'oab_phone' => '',
				'oab_email' => '',
				'remark' => '',
				'grossWt' => '0.00',
				//'change_order' => '1',
				'grossWt' => '0.00',
				'charge' => '0.00',
				'IdType' => '1',
				'idNumber' => '',
				'pay_no'=>'',
				'order_mode_type' => '1',
				'is_first'=>0,
        'discount' => '1.00', // 订单折扣
        'delivery_fee' => '0.00', // 订单物流费
        'coupon' => '', // 乐天折扣价
        'invoice_code' => 'NG', // 配货单打印类型
        'transaction_order_code' => '', // 乐天订单号
				'is_valid' => '1', // 是否可用
				'order_product' => array (),
				'error' => array () 
		);
		$order_mode_type = '1';
		if (isset ( $rowData ['order_mode_type'] ) && $rowData ['order_mode_type'] !== '') {
			$order_mode_type = $rowData ['order_mode_type']; // 订单模式
		}
		
		$jxwarehousecode = ''; // 交货仓库
		if (isset ( $rowData ['warehouse_code'] ) && $rowData ['warehouse_code'] != '') {
			$jxwarehousecode = $rowData ['warehouse_code']; // 交货仓库
		}
		$mdwarehousecode = $jxwarehousecode;
		if (isset ( $rowData ['to_warehouse_code'] ) && $rowData ['to_warehouse_code'] != '') {
			$mdwarehousecode = $rowData ['to_warehouse_code']; // 目的仓库
		}
		
		$oab_country_name = '';
		if (isset ( $rowData ['oab_country_name'] ) && $rowData ['oab_country_name'] != '') {
			$oab_country_name = $rowData ['oab_country_name']; // 国家
		}
		//var_dump($oab_country_name);
		$provinceName = '';
		if (isset ( $rowData ['oab_state_name'] ) && $rowData ['oab_state_name'] != '') {
			$provinceName = $rowData ['oab_state_name']; // 省份
		}
		$cityName = '';
		if (isset ( $rowData ['oab_city'] ) && $rowData ['oab_city'] != '') {
			$cityName = $rowData ['oab_city']; // 城市
		}
		$districtName = '';
		if (isset ( $rowData ['oab_district'] ) && $rowData ['oab_district'] != '') {
			$districtName = trim($rowData ['oab_district']); // 城市
		}

		$shipName = '';
		if (isset ( $rowData ['sm_code'] ) && $rowData ['sm_code'] != '') {
			$shipName = $rowData ['sm_code']; // 运输方式
		}
		$reference_no = ''; // 交易订单号
		if (isset ( $rowData ['reference_no'] ) && $rowData ['reference_no'] != '') {
			$reference_no = $rowData ['reference_no']; // 交易订单号
		}
		$tracking_number = '';
		if (isset ( $rowData ['ref_tracking_number'] ) && $rowData ['ref_tracking_number'] != '') {
			$tracking_number = $rowData ['ref_tracking_number']; // 交易订单号
		}
		/* $lastName = ''; // 姓
		if (isset ( $rowData ['oab_lastname'] ) && $rowData ['oab_lastname'] != '') {
			$lastName = $rowData ['oab_lastname']; // 姓
		} */
		$firstName = ''; // 姓名
		if (isset ( $rowData ['oab_firstname'] ) && $rowData ['oab_firstname'] != '') {
			$firstName = $rowData ['oab_firstname']; // 名
		}
		$companyName = ''; // 公司名称
		if (isset ( $rowData ['oab_company'] ) && $rowData ['oab_company'] != '') {
			$companyName = $rowData ['oab_company']; // 公司名称
		}
		$zipCode = ''; // 邮编
		if (isset ( $rowData ['oab_postcode'] ) && $rowData ['oab_postcode'] != '') {
			$zipCode = $rowData ['oab_postcode']; // 邮编
		}
		$address1 = ''; // 地址一
		if (isset ( $rowData ['oab_street_address1'] ) && $rowData ['oab_street_address1'] != '') {
			$address1 = $rowData ['oab_street_address1']; // 地址一
		}
		$address2 = ''; // 地址2
		if (isset ( $rowData ['oab_street_address2'] ) && $rowData ['oab_street_address2'] != '') {
			$address2 = $rowData ['oab_street_address2']; // 地址2
		}
		$telephone = ''; // 电话
		if (isset ( $rowData ['oab_phone'] ) && $rowData ['oab_phone'] != '') {
			$telephone = $rowData ['oab_phone']; // 电话
		}
		$email = ''; // 电子邮件
		if (isset ( $rowData ['oab_email'] ) && $rowData ['oab_email'] != '') {
			$email = $rowData ['oab_email']; // 电子邮件
		}
		$grossWt = ''; // 毛重
		if (isset ( $rowData ['grossWt'] ) && $rowData ['grossWt'] != '') {
			$grossWt = $rowData ['grossWt']; // 毛重
		}
		$charge = ''; // 成交总价
		if (isset ( $rowData ['charge'] ) && $rowData ['charge'] != '') {
			$charge = $rowData ['charge']; // 成交总价
		}
		$currency_code=''; //币种
		if (isset ( $rowData ['currency'] ) && $rowData ['currency'] != '') {
			$currency_code = $rowData ['currency']; // 币种
		}
		$IdType = ''; // 证件类型
		if (isset ( $rowData ['idType'] ) && $rowData ['idType'] != '') {
			$IdType = $rowData ['idType']; // 证件类型
		}
		$idNumber = ''; // 证件号码
		if (isset ( $rowData ['idNumber'] ) && $rowData ['idNumber'] != '') {
			$idNumber = $rowData ['idNumber']; // 证件号码
		}
		$pay_no = '';
		if (isset ( $rowData ['pay_no'] ) && $rowData ['pay_no'] != '') {
			$pay_no = $rowData ['pay_no']; // 证件号码
		}
		$remark = ''; // 备注
		if (isset ( $rowData ['remark'] ) && $rowData ['remark'] != '') {
			$remark = $rowData ['remark']; // 备注
		}

    $discount = ''; // 折扣
    if (isset($rowData['discount']) && '' !== trim($rowData['discount'])) {
      $discount = trim($rowData['discount']);
    }

    $deliveryFee = ''; // 物流费
    if (isset($rowData['delivery_fee']) && '' !== trim($rowData['delivery_fee'])) {
      $deliveryFee = trim($rowData['delivery_fee']);
    }

    $coupon = ''; // 乐天折扣价
    if (isset($rowData['coupon']) && '' !== trim($rowData['coupon'])) {
      $coupon = trim($rowData['coupon']);
    }

    $invoiceCode = ''; // 配货单类型
    if (isset($rowData['invoice_code']) && '' !== trim($rowData['invoice_code'])) {
      $invoiceCode = strtoupper(trim($rowData['invoice_code']));
    }

    $transactionOrderCode = ''; // 乐天订单号
    if (isset($rowData['transaction_order_code']) && '' !== trim($rowData['transaction_order_code'])) {
      $transactionOrderCode = trim($rowData['transaction_order_code']);
    }

		//echo "<pre>";
		//print_r($rowData);
		$orderRow['customer_id'] = $customer['customer_id'];
		$orderRow['oab_district']=trim($rowData['oab_district']);
		//print_r($orderRow);
		//exit;
		if(isset($rowData['action'])=='update'){
			$orderRow['action'] = $rowData['action'];
			$orderRow['ordersCode'] = $rowData['ordersCode'];
		}
		$orderProducts = $rowData['productDeatil'];
		$orderRow = self::checkOrderMode($order_mode_type,$orderRow); //订单模型
		$orderRow = self::checkwarehouse ( $jxwarehousecode, $orderRow );
		$orderRow = self::checkwarehousemd ( $mdwarehousecode, $orderRow );
		
		$orderRow = self::checkCountry($oab_country_name, $orderRow);
		
		$orderRow = self::checkProvince ( $provinceName, $orderRow, $shipName );
		$orderRow = self::checkCity ( $cityName, $orderRow, $shipName );
		$orderRow = self::checkShipType ( $shipName, $orderRow );
		$orderRow = self::checkReference ( $reference_no, $orderRow);
		$orderRow = self::checkTracking($tracking_number,$orderRow);
		//$orderRow = self::checkLastName ( $lastName, $orderRow );
		$orderRow = self::checkFirstName ( $firstName, $orderRow );
		$orderRow = self::checkCompany ( $companyName, $orderRow );
		$orderRow = self::checkPostcode ( $zipCode, $orderRow );
		$orderRow = self::checkAddress1 ( $address1, $orderRow );
		$orderRow = self::checkAddress2 ( $address2, $orderRow );
		$orderRow = self::checkTelephone ( $telephone, $orderRow );
		$orderRow = self::checkEmail ( $email, $orderRow );
		$orderRow = self::checkgrossWt ( $grossWt, $orderRow );
		$orderRow = self::checkCharge ( $charge, $orderRow );
		$orderRow = self::checkCurrency($currency_code, $orderRow);
		//$orderRow = self::checkIdType ( $IdType, $orderRow );
		$orderRow = self::checkIdNumber ( $idNumber, $orderRow );
        $orderRow = self::checkPayNo($pay_no,$orderRow);
		$orderRow = self::checkRemark ( $remark, $orderRow );
		//file_put_contents('/var/www/php/import_test/oms/application/models/Api/yus.txt', var_export($orderProducts,true));
		$orderRow = self::checkProduct ( $orderProducts, $orderRow );
		$orderRow = self::checkDiscount($discount, $orderRow);
		$orderRow = self::checkDeliveryFee($deliveryFee, $orderRow);
		$orderRow = self::checkCoupon($coupon, $orderRow);
		$orderRow = self::checkInvoiceCode($invoiceCode, $orderRow);
		$orderRow = self::checkTransactionOrderCode($transactionOrderCode, $orderRow);
		//$orderRow = self::checkReferenceDocument ( $reference_no, $referenceArr, $orderRow );
		// print_r($orderRow);
		$orderRow = self::checkDistrict($districtName,$shipName,$orderRow);
		return $orderRow;
	}
	
	/**
	 * @author william-fan
	 * @todo 用于设置订单模式
	 */
	public static function checkOrderMode($order_mode_type,$orderRow){
		if($order_mode_type!=''){
			if($order_mode_type=='1'){
				$orderRow['order_mode_type'] = '1';
			}elseif ($order_mode_type=='0'){
				$orderRow['order_mode_type'] = '0';
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = '订单模式只能有集货模式和备货模式两种';
				$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = '订单模式必须必填';
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	
	/**
	 * @author william-fan
	 * @todo 用于校验交货仓库
	 */
	public static function checkwarehouse($jxwarehousecode,$orderRow){
		if('' != $jxwarehousecode){
			$warehousejh = Service_Warehouse::getByField($jxwarehousecode,'warehouse_code'); //交货仓库
			if(!empty($warehousejh)){
				//集货模式及备货模式对应仓库判断 0备货 1集货
				if("1" === $orderRow['order_mode_type']){
					if(1 == $warehousejh['is_jihuo']){
						$orderRow['warehouse_id'] 	= $warehousejh['warehouse_id'];
						$orderRow['warehouse_code'] = $warehousejh['warehouse_code'];
					}else{
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = "交货仓库不支持集货模式";
						$orderRow['error'] = $error;
					}
				}else if("0" ===  $orderRow['order_mode_type']){
					if(1 == $warehousejh['is_beihuo']){
						$orderRow['warehouse_id'] 	= $warehousejh['warehouse_id'];
						$orderRow['warehouse_code'] = $warehousejh['warehouse_code'];
					}else{
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = "交货仓库不支持备货模式";
						$orderRow['error'] = $error;
					}
				}
				$orderRow['is_first']	= $warehousejh['is_first'];
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "交货仓库不存在";
				$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = '交货仓库必填';
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验目的仓库
	 */
	public static function checkwarehousemd($mdwarehousecode,$orderRow){
		//开始校验目的仓
		if($mdwarehousecode!=''){
			$warehousemd = Service_Warehouse::getByField($mdwarehousecode,'warehouse_code');
			if($warehousemd['is_jihuo']=='1'){
				$orderRow['to_warehouse_id'] = $warehousemd['warehouse_id'];
				$orderRow['to_warehouse_code'] = $mdwarehousecode;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "目的仓库不支持集货模式";
				$orderRow['error'] = $error;
			}
			if($orderRow['warehouse_id']!='1'){
				if($orderRow['warehouse_id']!=$orderRow['to_warehouse_id']){
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = "非日本仓交货仓库和目的仓库不一致";
					$orderRow['error'] = $error;
				}
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "目的仓库不存在";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	
	/**
	 * @author willia-fan
	 * @todo 设置收件人国家
	 */
	public static function checkCountry($oab_country_name,$orderRow){
		if($oab_country_name!=''){
			$country = Service_Country::getByField($oab_country_name,'country_name');
			if(!empty($country)){
				$orderRow['oab_country_id'] = $country['country_id'];
				$orderRow['oab_country_name'] = $country['country_name'];
			}else{
				$country = Service_Country::getByField($oab_country_name,'country_code');
				if(!empty($country)){
					$orderRow['oab_country_id'] = $country['country_id'];
					$orderRow['oab_country_name'] = $country['country_name'];
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = "国家{$oab_country_name}不存在";
					$orderRow['error'] = $error;
				}
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = '收件人国家必填';
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	
	/**
	 * @author william-fan
	 * @todo 用于校验省份数据
	 */
	public static function checkProvince($provinceName,$orderRow,$shipName){
		if($provinceName!=''){
			if($orderRow['oab_country_id']=='49' || $orderRow['oab_country_id']=='50' || $orderRow['oab_country_id']=='51'){

        // 若运输方式为HKPT，把过滤省份
        /*if ('HKPT' === strtoupper(trim($shipName))) {

        }*/
                $provinceSuffix = array(
                    '省', // 如广东省
                    '维吾尔自治区', // 如新疆维吾尔自治区
                    '壮族自治区', // 如广西壮族自治区
                    '回族自治区', // 如宁夏回族自治区
                    '自治区', // 如内蒙古自治区
                    '特别行政区', // 如香港特别行政区
                    '市', // 如北京市
                );
                $provinceName = str_replace($provinceSuffix, '', $provinceName);
				$province = Service_Region::getByField($provinceName,'region_name');
				if(!empty($province)){
					if($province['region_type']=='1'){
						//是省份
						$orderRow['oab_state'] = $provinceName;
						$orderRow['oab_state_id'] = $province['region_id'];
						$orderRow['oab_state_name'] = $provinceName;
					}else{
						//不是省份
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = $provinceName."不是省份";
						$orderRow['error'] = $error;
					}
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = $provinceName."不存在";
					$orderRow['error'] = $error;
				}				
			}else{
				$orderRow['oab_state'] = $provinceName;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "省份必填";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验城市
	 */
	public static function checkCity($cityName,$orderRow, $shipName){
		if(!empty($cityName)){
			if($orderRow['oab_country_id']=='49' || $orderRow['oab_country_id']=='50' || $orderRow['oab_country_id']=='51'){
				// 若运输方式为HKPT，把过城市
				/*if ('HKPT' === strtoupper(trim($shipName))) {
					$citys	=  Service_Region::getByCondition(array('region_name_like'=>mb_substr($cityName,0,1,'utf-8'),'region_type'=>2));
					$city	= isset($citys[0])?$citys[0]:array();
				}else{
					$city = Service_Region::getByField($cityName,'region_name');
				}
				if(!empty($city)){
					if($city['region_type']=='2'){
						$orderRow['oab_city'] = $cityName;
						$orderRow['oab_city_id'] = $city['region_id'];
					}
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = $city."城市数据不存在";
					$orderRow['error'] = $error;
				}*/
                $cityNameArr = self::sysSubStr($cityName,strlen($cityName));
                if(in_array("市",$cityNameArr)){
                    $Arr2 =  self::sysSubStr($cityName,strlen($cityName)-3);
                    $NewCityName = implode("",$Arr2);
                }else{
                    $NewCityName = $cityName;
                }
                $cityCondition = array(
                    'parent_id'=>$orderRow['oab_state_id'],
                    'region_name'=>$cityName
                );
                $citys = Service_Region::getByCondition($cityCondition,'*');
                if(!empty($citys)){
                    $city = $citys[0];
                }else{
                    $cityCondition = array(
                        'parent_id'=>$orderRow['oab_state_id'],
                        'region_name'=>$NewCityName
                    );
                    $citys = Service_Region::getByCondition($cityCondition,'*');
                    $city = $citys[0];
                }
                if(!empty($city)){
                    if($city['region_type']=='2'){
                        $orderRow['oab_city_id'] = $city['region_id'];
                        $orderRow['oab_city'] = $cityName;
                    }else{
                        $orderRow['oab_city'] = $cityName;
                    }
                }else{
                    /*$orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = $city.Ec_Lang::getInstance()->getTranslate('city_not_exists');
                    $orderRow['error'] = $error;*/
                    $orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = $city."城市数据不存在";
                    $orderRow['error'] = $error;
                    //$orderRow['oab_city'] = $cityName;
                }

			}else{
				$orderRow['oab_city'] = $cityName;
			}
		}
        if($orderRow['to_warehouse_id']=='6'||$orderRow['warehouse_id']=='6'){
            if($orderRow['oab_city']==''){
                $error[] = "";
                $orderRow['is_valid'] = '0';
                $error = $orderRow['error'];
                $error[] = '前海仓城市不能为空';
                $orderRow['error'] = $error;
            }else{
                if($city['region_customcode']==''){
                    $orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = '城市编码不能为空';
                    $orderRow['error'] = $error;
                }
            }
        }
		return $orderRow;
	}
	/**
	 * @author kevin-wang
	 * @todo 用于校验区县
	 */
	public static function checkDistrict($districtName,$shipName,$orderRow){
		if(empty($districtName)){
        	if ($shipName=='STO-QH') {
        			$orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = '运输渠道是STO-QH时收件人区县必填';
                    $orderRow['error'] = $error;
        	}
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验运输方式
	 */
	public static function checkShipType($sm_code,$orderRow){
		if($sm_code!=''){
			$shipMethod=Service_ShippingMethod::getByField($sm_code,'sm_code');
			if(empty($shipMethod)){
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "运输方式{$sm_code}不存在";
				$orderRow['error'] = $error;
			}
			if(!empty($shipMethod) && $shipMethod['sm_status']=='0'){
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = '运输方式{$sm_code}已禁用';
				$orderRow['error'] = $error;
			}
			if($orderRow['order_mode_type'] == '1'){
				$orderRow['sm_code'] = $sm_code;
			}
				
			//备货模式的才检查国家运输方式
			if($orderRow['order_mode_type'] == '0'){
				$countryArr = Common_DataCache::getShipTypeCountryMap();
				$countryId = $orderRow['oab_country_id'];
				$countrySM = array();
				if($countryId){
					if(isset($countryArr[$countryId])){
						$countrySM = $countryArr[$countryId];
					}
				}
					
				if(!empty($countrySM)){
					$shipTypeAll = $countrySM['ship_type'];
					if(!empty($shipTypeAll)){
						$support = false; //支持该运输方式情况
						foreach ($shipTypeAll as $keys=>$shiptype){
							if(strtoupper($shiptype['sm_code'])==strtoupper($sm_code)){
								$support = true;
								break;
							}
						}
						if($support){
							$orderRow['sm_code'] = $sm_code;
						}else{
							$orderRow['is_valid'] = '0';
							$error = $orderRow['error'];
							$error[] = '该国家不支持此运输方式1';
							$orderRow['error'] = $error;
						}
					}else{
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = '该国家不支持此运输方式2';
						$orderRow['error'] = $error;
					}
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = '该国家不支持此运输方式3';
					$orderRow['error'] = $error;
				}
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = '运输方式必填';
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验交易订单号
	 */
	public static function checkReference($reference_no,$orderRow){
		if("" != $reference_no){
      $originalOrderCode = isset($orderRow['ordersCode']) ? trim($orderRow['ordersCode']) : '';
			$orders = Service_Orders::getByCondition(array('reference_no'=>$reference_no,'customer_id'=>$orderRow['customer_id'],'order_status_arr'=>array(1,2,3,4,6,7,8,9,10,11,12,13)));
			$orderRow['reference_no'] = $reference_no;
			if($orders && ($originalOrderCode ? $originalOrderCode !== $orders[0]['order_code'] : TRUE)){
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "系统已经存在该交易订单号";
				$orderRow['error'] = $error;
				$orderRow['existed_order_code'] = $orders[0]['order_code'];
			}else{
				$orderRow['reference_no'] = $reference_no;
			}
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于创建校验跟踪号
	 */
	public static function checkTracking($tracking_number,$orderRow){
		if($tracking_number!=''){
            $originalOrderCode = isset($orderRow['ordersCode']) ? trim($orderRow['ordersCode']) : '';
			$trackingCondition = array(
				'ref_tracking_number'=>$tracking_number,
                'customer_id'=>$orderRow['customer_id'],
                'order_status_arr'=>array(1,2,3,4,6,7,8,9,10,11,12,13)
			);
            $orders = Service_Orders::getByCondition($trackingCondition,"*");
            if($orders && (count($orders) > 2 || $originalOrderCode !== $orders[0]['order_code'])){
                $orderRow['is_valid'] = '0';
                $error = $orderRow['error'];
                $error[] = "系统已经存在该物流单号";
                $orderRow['error'] = $error;
            }else{
                $orderRow['ref_tracking_number'] = $tracking_number;
            }
		}
        if($orderRow['to_warehouse_id']=='6'){
            if($orderRow['sm_code']=='EMS-JUMEI'||$orderRow['sm_code']=='ZT-JUMEI'){
                if($tracking_number==''){
                    $orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = "前海仓运输方式为".$orderRow['sm_code']."的参考物流单号必填";
                    $orderRow['error'] = $error;
                }
            }
        }
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验姓
	 */
	public static function checkLastName($lastName,$orderRow){
		if($lastName!=''){
			$orderRow['oab_lastname'] = $lastName;
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "姓氏必须填写";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验名
	 */
	public static function checkFirstName($firstName,$orderRow){
		if($firstName!=''){
			$orderRow['oab_firstname'] = $firstName;
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "名必填";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验公司名称
	 */
	public static function checkCompany($companyName,$orderRow){
		if($companyName!=''){
			$orderRow['oab_company'] = $companyName;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置邮编
	 */
	public static function checkPostcode($zipCode,$orderRow){
		if($zipCode!=''){
			$orderRow['oab_postcode'] = $zipCode;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置校验地址一
	 */
	public static function checkAddress1($address1,$orderRow){
		if($address1!=''){
			$orderRow['oab_street_address1'] = $address1;
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "地址1必填";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置地址2
	 */
	public static function checkAddress2($address2,$orderRow){
		if($address2!=''){
			$orderRow['oab_street_address2'] = $address2;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置校验电话
	 */
	public static function checkTelephone($telephone,$orderRow){
		if($telephone!=''){
			if(preg_match('/^[0-9]+$/i', $telephone)!==false){
				$orderRow['oab_phone'] = $telephone;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "电话必须是数字";
				$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "电话必填";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置校验电子邮件
	 */
	public static function checkEmail($email,$orderRow){
		if($email!=''){
            $orderRow['oab_email'] = $email;
			/*if (preg_match("/^[\+a-zA-Z0-9_\.-]+\@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/i", $email)) {
				$orderRow['oab_email'] = $email;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "Email格式错误";
				$orderRow['error'] = $error;
			}*/
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置校验毛重
	 */
	public static function checkgrossWt($grossWt,$orderRow){
		if($grossWt!=''){
			if(is_numeric($grossWt)){
				$orderRow['grossWt'] = $grossWt;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "毛重必须是数字";
				$orderRow['error'] = $error;
			}
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置成交总价
	 */
	public static function checkCharge($charge,$orderRow){
		if($charge!=''){
			if(is_numeric($charge) && $charge>=0){
				$orderRow['charge'] = $charge;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "成交总价必须大于0";
				$orderRow['error'] = $error;
			}
		}/*else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "成交总价必填";
			$orderRow['error'] = $error;
		}*/
		return $orderRow;
	}
	public static function checkCurrency($currency_code,$orderRow){
		if($currency_code!=''){
			$currency=Service_Currency::getByField($currency_code,'currency_code');
			if(!empty($currency)){
				$orderRow['currency_code'] = $currency_code;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "传递的币种无效";
				$orderRow['error'] = $error;
			}
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置校验证件类型
	 */
	public static function checkIdType($IdType,$orderRow){
		if($IdType!=''){
			switch($IdType){
				case '身份证':
					$orderRow['idType'] = '1';
					break;
				case '军官证':
					$orderRow['idType'] = '2';
					break;
				case '护照':
					$orderRow['idType'] = '3';
					break;
				case '其他':
					$orderRow['idType'] = '4';
					break;
				default:
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = "证件类型填写错误";
					$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "证件类型必填";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置校验证件号码
	 */
	public static function checkIdNumber($idNumber,$orderRow){
		if($idNumber!=''){
			$orderRow['idNumber'] = $idNumber;
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "证件号码必填";
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
    /**
     * @author william-fan
     * @todo 设置交易单号
     */
    public static function checkPayNo($pay_no,$orderRow){
        $pay_no = trim($pay_no);
        //file_put_contents('pay.txt',var_export($pay_no,true));
        if($pay_no!=''){
            $orderCode = isset($orderRow['ordersCode']) ? $orderRow['ordersCode'] : '';
            $orders = Service_Orders::getByCondition(array('pay_no'=>$pay_no,'order_status_arr'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14)));
            if(count($orders)>0 && $orderCode != $orders[0]['order_code']){
                $orderRow['is_valid'] = '0';
                $error = $orderRow['error'];
                $error[] = '支付单号已经存在';
                $orderRow['error'] = $error;
                return $orderRow;
            }
        }
        if($orderRow['to_warehouse_id']=='6'){
            //前海仓
            if($pay_no!=''){
                $orderRow['pay_no'] = $pay_no;
            }else{
                $orderRow['is_valid'] = '0';
                $error = $orderRow['error'];
                $error[] = "支付单号必填";
                $orderRow['error'] = $error;
            }
        }else{
            $orderRow['pay_no'] = $pay_no;
        }
        return $orderRow;
    }
	/**
	 * @author william-fan
	 * @todo 设置备注
	 */
	public static function checkRemark($remark,$orderRow){
		if($remark!=''){
			$orderRow['remark'] = $remark;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置产品
	 */
	public static function checkProduct($orderProducts, $orderRow){
		$orderProductArr = array();
		if(!empty($orderProducts)){
			foreach($orderProducts as $key=>$value){
				$condition = array(
					'customer_id'=>$orderRow['customer_id'],
					'product_sku'=>$value['product_sku'],	
				);
                $productInfo = Service_Product::getRowByCondition($condition,'*');
                if($orderRow['to_warehouse_id']=='6'){
                    if($productInfo['goods_id']=='' && $productInfo['product_type']=='0'){
                        //非组合产品sku
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = "料件号为空";//
                        $orderRow['error'] = $error;
                    }
                }
				if(!empty($productInfo)){
					if($productInfo['product_status']!='1'){
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = $value['product_sku'].'不存在';
						$orderRow['error'] = $error;
					}else{
                        if($orderRow['to_warehouse_id']=='6'){
                            //$op_price = $value['op_price']>0?$value['op_price']:$productInfo['product_declared_value'];
                            $op_price = $value['op_price']>0?$value['op_price']:0;
                            $product_qty = $value['op_quantity'];
                            $op_total_price = $value['op_quantity']*$op_price;
                            $invoice_price = (isset($value['invoice_price']) && $value['invoice_price'] > 0) ? $value['invoice_price'] : $op_price;
                            if($productInfo['product_type']!='1'){
                                $orderProduct = array('product_id'=>$productInfo['product_id'],'qty'=>$product_qty,'price'=>$op_price,'total_price'=>$op_total_price,'invoice_price'=>$invoice_price);
                                $orderProductArr[] = $orderProduct;
                            }else{
                                if($orderRow['to_warehouse_id']=='6'){
                                    $relationCondition = array(
                                        'product_id'=>$productInfo['product_id']
                                    );
                                    $relation = Service_ProductCombineRelation::getByCondition($relationCondition,"*");
                                    foreach($relation as $key=>$productRelation){
                                        $p = Service_Product::getByField($productRelation['pcr_product_id']);
                                        if($p['goods_id']==''){
                                            $orderRow['is_valid'] = '0';
                                            $error = $orderRow['error'];
                                            $error[] = "组合产品子sku:".$p['product_sku']."料件号为空";//
                                            $orderRow['error'] = $error;
                                        }
                                    }
                                }

                                $orderProduct = array('product_id'=>$productInfo['product_id'],'qty'=>$product_qty);
                                $orderProduct['price'] = $op_price;
                                $orderProduct['total_price'] = $op_total_price;
                                $orderProduct['invoice_price'] = $invoice_price;

                                $orderProductArr[] = $orderProduct;
                            }

                        }else{
                            $price = $value['op_price']>0?$value['op_price']:$productInfo['product_declared_value'];
                            $total_price = $value['op_quantity']*$price;
                            $orderProductArr[] = array(
                                'product_id'=>$productInfo['product_id'],
                                'price'=>$price,
                                'transactionPrice'=>$value['op_total_price'],
                                'total_price'=>$total_price,
                                'invoice_price' => (isset($value['invoice_price']) && $value['invoice_price'] > 0) ? $value['invoice_price'] : $price,
                                'qty'=>$value['op_quantity']
                            );
                        }
					}
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = $value['product_sku'].'不存在';
					$orderRow['error'] = $error;
				}
			}
		}
		$orderRow['order_product'] = $orderProductArr;
		return $orderRow;
	}

  /**
   * 设置折扣
   */
  public static function checkDiscount($discount, $orderRow) {
    if ('' !== $discount) {
      if (!preg_match('/^\d{1,10}(?:\.\d{1,4})?$/', $discount)) {
        $error = $orderRow['error'];
        $error[] = '折扣格式不正确';
        $orderRow['error'] = $error;
        $orderRow['is_valid'] = '0';
      }
      else {
        $orderRow['discount'] = $discount;
      }
    }

    return $orderRow;
  }

  /**
   * 设置物流费用
   */
  public static function checkDeliveryFee($deliveryFee, $orderRow) {
    if ('' !== $deliveryFee) {
      if (!preg_match('/^\d{1,10}(?:\.\d{1,4})?$/', $deliveryFee)) {
        $error = $orderRow['error'];
        $error[] = '物流费用格式不正确';
        $orderRow['error'] = $error;
        $orderRow['is_valid'] = '0';
      }
      else {
        $orderRow['delivery_fee'] = $deliveryFee;
      }
    }

    return $orderRow;
  }

  /**
   * 设置乐天折扣价
   */
  public static function checkCoupon($coupon, $orderRow) {
    if ('' !== $coupon) {
      if (!preg_match('/^\d{1,10}(?:\.\d{1,4})?$/', $coupon)) {
        $error = $orderRow['error'];
        $error[] = '折扣价格式不正确';
        $orderRow['error'] = $error;
        $orderRow['is_valid'] = '0';
      }
      else {
        $orderRow['coupon'] = $coupon;
      }
    }

    return $orderRow;
  }

  /**
   * 配货单类型
   */
  public static function checkInvoiceCode($invoiceCode, $orderRow) {
    if ('' !== $invoiceCode) {
      $code = self::validInvoiceCode();

      if (in_array(trim($invoiceCode), array_keys($code), TRUE)) {
        $orderRow['invoice_code'] = $code[trim($invoiceCode)];
      }
      elseif (in_array(trim($invoiceCode), $code, TRUE)) {
        $orderRow['invoice_code'] = trim($invoiceCode);
      }
      else {
        $error = $orderRow['error'];
        $error[] = '配货单（发票）类型错误';
        $orderRow['error'] = $error;
        $orderRow['is_valid'] = '0';
      }
    }

    return $orderRow;
  }

  /**
   * 乐天订单号
   */
  public static function checkTransactionOrderCode($transactionOrderCode, $orderRow) {
    if ('' !== $transactionOrderCode) {
      $orderRow['transaction_order_code'] = $transactionOrderCode;
    }

    return $orderRow;
  }
    public static function sysSubStr($string,$length)
    {
        $i = 0;
        while ($i < $length)
        {
            $stringTMP = substr($string,$i,1);
            if ( ord($stringTMP) >=224 )
            {
                $stringTMP = substr($string,$i,3);
                $i = $i + 3;
            }
            elseif( ord($stringTMP) >=192 )
            {
                $stringTMP = substr($string,$i,2);
                $i = $i + 2;
            }
            else
            {
                $i = $i + 1;
            }
            $stringLast[] = $stringTMP;
            //$stringLast = implode("",$stringLast);
        }
        return $stringLast;
    }
  /**
   * 有效的配货单类型
   */
  public static function validInvoiceCode() {
    return array(
      '03' => 'CN', // Tmall配货模板
      '01' => 'JP', // 发往日本配货模板
      '02' => 'RT', // Rakuten配货模板
      '_DEFAULT_' => 'NG', // 普通默认配货模板
    );
  }
}