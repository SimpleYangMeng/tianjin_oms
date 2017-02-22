<?php
/**
 * @author william-fan 
 * @todo 订单批量上传类
 */
class Service_OrderUpload{
    const CHECK_PAYNO = true; //是否校验支付单号
    const CHECK_ID = true; //是否校验身份证
    const CHECK_PRICE = true;//是否校验成交价格
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
			if(!mkdir($path,0700,true)){
				$result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('Failed_to_upload_file'),'error'=>array(Ec_Lang::getInstance()->getTranslate('directory_not_exist_result_upload_failed')));
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
		if ( ! $upload->do_upload($_FILES,$field) ){
			$result['ask'] = '0';
			$result['message'] = Ec_Lang::getInstance()->getTranslate('Failed_to_upload_file');
			$result['error'] =  $upload->display_errors();
			return $result;
			exit;
		}
		
		$resultArray = $upload->data();
		$full_path = $resultArray['full_path'];
		if(empty($resultArray) || empty($full_path)){
			$result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('Failed_to_upload_file'),'error'=>array(Ec_Lang::getInstance()->getTranslate('data_not_exists')));
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
		if(empty($resultArray) || !is_array($resultArray)){
			$result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('The_contents_of_the_file_does_not_match_the_expected_result_data_is_empty'),'error'=>array());
			//echo json_encode($result);
			//exit;
		}
		@unlink($full_path);
		return $resultArray;
	}
	/**
	 * @author william-fan
	 * @todo 用于处理excel文件返回成有效的数组
	 */
	public static function getDataArr($rows){
		$model = self::checkModel($rows[0]);
		if(self::checkModel($rows[0])=='1'){
			$transdate=self::henpaiData($rows);
			return $transdate;
		}else{
			$transdate=self::shupaiData($rows);
			return self::mergeOrder($transdate);
		}
		//exit;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验是横排还是竖排订单
	 */
	public static function checkModel($titleArr){
		//产品sku
		//第一个sku标题名称
		$skutitle = $titleArr['21'];
		/*if(strpos($skutitle, '1')!==false){
			//是横排情况
			$model = '1';
		}else{
			$model = '0';
		}*/
        if($skutitle=="备注"){
            //是竖排情况
            $model = '0';
        }else{
            $model = '1';
        }
		return $model;
	}
	/**
	 * @author william-fan
	 * @todo 横排数据转换
	 */
	public static function henpaiData($rows){
		$orderRows = array();
		$referenceArr = array();
        $payNOArr = array();
		foreach ($rows as $key=>$rowData){
			//print_r($key);
			if($key>=1){
				$orderRow=self::TransformData($rowData,$referenceArr,$payNOArr);
				$referenceArr[] = $rowData[7];
                if($rowData[8]!=''){
                    $payNOArr[] = $rowData[8];
                }
				$orderRows[] = $orderRow;
			}
		}
		return $orderRows;
	}
	/**
	 * @author william-fan
	 * @todo 合并订单
	 */
	public static function mergeOrder($rows){
		$orderRows = array();
		if(!empty($rows)){
			foreach($rows as $key=>$rowData){
				/* if($rowData['reference_no']){
					
				} */
				$reference_no=$rowData['reference_no'];
				if(!isset($orderRows[$reference_no])){
					$orderRows[$reference_no] = $rowData;
				}else{
					if($rowData['is_valid']=='0'){
						$error = $rowData['error'];
						$orderRows[$reference_no]['is_valid'] = '0';
						$error_old = $orderRows[$reference_no]['error'];
						$errornew=array_merge($error,$error_old);
						$orderRows[$reference_no]['error']=array_unique($errornew);
					}
					//将产品加入
					$productOld=$orderRows[$reference_no]['order_product'];
					$productnow=$rowData['order_product'];
					$product=array_merge($productOld,$productnow);
					$product = self::checkProductRepeat($product);
					$orderRows[$reference_no]['order_product'] = $product;
				}
			}
		}
		return $orderRows;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验sku的重复
	 */
	public static function checkProductRepeat($products){
		if(!empty($products)){
			$productArr = array();
			foreach ($products as $key=>$product){
				if(in_array($product['product_id'], $productArr)){
					unset($products[$key]);
				}else{
					$productArr[] = $product['product_id'];
				}
			}
		}
		return $products;
	}
	/**
	 * @author william-fan
	 * @todo 用于转换一行的订单数据(横排)
	 */
	public static function TransformData($rowData,$referenceArr,$payNoArr){
	// var_dump($rowData);
		//exit(); 
		//var_dump($rowData);
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		if(!empty($rowData)){
			$orderRow = array(
                'action'=>'add',
				'customer_id'=>$customerId,	
				'warehouse_id'=>'',
				'warehouse_name'=>'',
				'to_warehouse_id'=>'',
				'to_warehouse_name'=>'',
				'sm_code'=>'',
				'oab_state'=>'', //省份
				'oab_state_name'=>'',
				'oab_city'=>'', //城市
                'oab_city_id'=>'',
                'oab_district'=>'',
				'currency_code'=>'RMB',//默认为人民币
				'order_status'=>'1',
				'reference_no'=>'',
				//'oab_lastname'=>'',
				'oab_firstname'=>'',
				'oab_company'=>'',
				'oab_postcode'=>'',
				'oab_street_address1'=>'',
				'oab_street_address2'=>'',
				'oab_phone'=>'',
				'oab_email'=>'',			
				'remark'=>'',
				'grossWt'=>'0.00',	
				'change_order'=>'0',
				'grossWt'=>'',
				'charge'=>'0.00',
				'IdType'=>'1',
				'idNumber'=>'',
				'order_mode_type'=>'1',	
				'is_valid'=>'1',//是否可用
				'order_product'=>array(),
				'error'=>array(),
                //'is_discount'=>'',
                //'is_gift'=>'',
			);
			/*var_dump($rowData);
			exit();*/
			$order_mode_name = ''; ////订单模式
			if(isset($rowData[0]) && $rowData[0]!= ''){
				$order_mode_name = $rowData[0]; ////订单模式
			}
			
			$jxwarehousename = ''; //交货仓库
			if(isset($rowData[1]) && $rowData[1]!= ''){
				$jxwarehousename = $rowData[1]; //交货仓库
			}
			$mdwarehousename = '';
			if(isset($rowData[2]) && $rowData[2]!= ''){
				$mdwarehousename = $rowData[2]; //目的仓库
			}
			$provinceName = '';
			if(isset($rowData[3]) && $rowData[3]!= ''){
				$provinceName	 = $rowData[3]; //省份
			}
			$cityName	= '';
			if(isset($rowData[4]) && $rowData[4]!= ''){
				$cityName		 = $rowData[4]; //城市
			}
			$districtName	= '';
			if(isset($rowData[5]) && $rowData[5]!= ''){
				$districtName		 = $rowData[5]; //区县
			}
			$shipName	= '';
			if(isset($rowData[6]) && $rowData[6]!= ''){
				$shipName		 = $rowData[6]; //运输方式
			}
			$reference_no	 = ''; //交易订单号
			if(isset($rowData[7]) && $rowData[7]!= ''){
				$reference_no	 = strval($rowData[7]); //交易订单号
			}
            //add 2014-11-03增加支付单号
            $pay_no = '';
            if(isset($rowData[8]) && $rowData[8]!= ''){
                $pay_no	 = strval($rowData[8]); //交易订单号
            }
			/*$lastName		 = ''; //姓名
			if(isset($rowData[7]) && $rowData[7]!= ''){
				$lastName		 = $rowData[7]; //姓
			}*/
			$firstName		 = ''; //姓名
			if(isset($rowData[9]) && $rowData[9]!= ''){
				$firstName		 = $rowData[9]; //姓名
			}
			$companyName	 = ''; //公司名称
			if(isset($rowData[10]) && $rowData[10]!= ''){
				$companyName	 = $rowData[10]; //公司名称
			}
			$zipCode		 = ''; //邮编
			if(isset($rowData[11]) && $rowData[11]!= ''){
				$zipCode		 = strval($rowData[11]); //邮编
			}
			$address1		 = '';//地址一
			if(isset($rowData[12]) && $rowData[12]!= ''){
				$address1		 = $rowData[12];//地址一
			}
			$address2		 = '';//地址2
			if(isset($rowData[13]) && $rowData[13]!= ''){
				$address2		 = $rowData[13];//地址2
			}
			$telephone		 = '';//电话
			if(isset($rowData[14]) && $rowData[14]!= ''){
				$telephone		 = strval($rowData[14]);//电话
			}
			$email			 = '';//电子邮件
			if(isset($rowData[15]) && $rowData[15]!= ''){
				$email			 = $rowData[15];//电子邮件
			}
			$grossWt		 = '';//毛重
			if(isset($rowData[16]) && $rowData[16]!= ''){
				$grossWt		 = $rowData[16];//毛重
			}
			$currency_code			 = '';//币种
			if(isset($rowData[17]) && $rowData[17]!= ''){
				$currency_code = $rowData[17];//币种
			}
			$charge			 = '';//成交总价
			/*if(isset($rowData[18]) && $rowData[18]!= ''){
				$charge			 = strval($rowData[18]);//成交总价
			}*/
			$IdType			 = '';//证件类型
			if(isset($rowData[18]) && $rowData[18]!= ''){
				$IdType			 = $rowData[18];//证件类型
			}
			$idNumber		 = '';//证件号码
			if(isset($rowData[19]) && $rowData[19]!= ''){
				$idNumber		 = strval($rowData[19]);//证件号码
				//echo $idNumber;
			}
            /*$isDiscount = "";
            if(isset($rowData[21])&&$rowData[21]!=""){
                $isDiscount = $rowData[21];
            }
            $isGift = "";
            if(isset($rowData[22])&&$rowData[22]!=""){
                $isGift = $rowData[22];
            }*/
			$remark			 = '';//备注
			if(isset($rowData[20]) && $rowData[20]!= ''){
				$remark			 = $rowData[20];//备注
			}
			//echo $address1;
			$orderProducts	 = self::getProduct($rowData);
			$orderRow = self::checkOrderMode($order_mode_name, $orderRow);
			$orderRow = self::checkwarehouse($jxwarehousename, $orderRow);
			$orderRow = self::checkwarehousemd($mdwarehousename, $orderRow);
			$orderRow = self::checkCountry('CN', $orderRow);
			$orderRow = self::checkProvince($provinceName, $orderRow);
			$orderRow = self::checkCity($cityName, $orderRow);
			$orderRow = self::checkShipType($shipName, $orderRow);
			$orderRow = self::checkReference($reference_no, $orderRow);
            $orderRow = self::checkPayNo($pay_no,$orderRow);
			//$orderRow = self::checkLastName($lastName, $orderRow);
			$orderRow = self::checkFirstName($firstName, $orderRow);
			$orderRow = self::checkCompany($companyName, $orderRow);
			$orderRow = self::checkPostcode($zipCode, $orderRow);
			$orderRow = self::checkAddress1($address1, $orderRow);
			$orderRow = self::checkAddress2($address2, $orderRow);
			$orderRow = self::checkTelephone($telephone, $orderRow);
			$orderRow = self::checkEmail($email, $orderRow);
			$orderRow = self::checkgrossWt($grossWt, $orderRow);
			$orderRow = self::checkCurrency($currency_code, $orderRow);
			//$orderRow = self::checkCharge($charge, $orderRow);
			$orderRow = self::checkIdType($IdType, $orderRow);
			$orderRow = self::checkIdNumber($idNumber, $orderRow);
			$orderRow = self::checkRemark($remark, $orderRow);
			$orderRow = self::checkProduct($orderProducts, $orderRow);
            //$orderRow = self::checkIsDiscount($isDiscount,$orderRow);
            //$orderRow = self::checkIsGift($isGift,$orderRow);
			$orderRow = self::checkReferenceDocument($reference_no,$referenceArr,$orderRow);
            $orderRow = self::checkPayNoDocument($pay_no,$payNoArr,$orderRow);
            $orderRow = self::checkDistrict($districtName, $shipName,$orderRow);
			//print_r($orderRow);
			//die(); 
			return $orderRow;
			//print_r($orderProduct);
		}else{
			
		}
	}
	/**
	 * @author william-fan
	 * @todo 得到产品信息
	 */
	public static function getProduct($rowData){
		//print_r($rowData);
		$productArr = array_slice($rowData,21);
		if($productArr){
            for($i=count($productArr)-1;$i>=0;$i--){
                if(!empty($productArr[$i])){
                    break;
                }else{
                    unset($productArr[$i]);
                }
            }
			/*foreach($productArr as $key=>$value){
				if(empty($value)){
					unset($productArr[$key]);
				}
			}*/
		}
		//$productArr = array_slice(18, array_values($rowData));
		return array_values($productArr);
	}
    /**
     * @author william-fan
     * @todo 用于取得更新的产品信息
     */
    public static function getUpProduct($rowData){
        $productArr = array_slice($rowData,5);
        if($productArr){
            for($i=count($productArr)-1;$i>=0;$i--){
                if(!empty($productArr[$i])){
                    break;
                }else{
                    unset($productArr[$i]);
                }
            }
        }
        return array_values($productArr);
    }
	/**
	 * @author william-fan
	 * @todo 用于设置订单模式
	 */
	public static function checkOrderMode($order_mode_name,$orderRow){
		if($order_mode_name!=''){
			if($order_mode_name=='集货模式'){
				$orderRow['order_mode_type'] = '1';
			}elseif ($order_mode_name=='备货模式'){
				$orderRow['order_mode_type'] = '0';
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('order_model_only_include_collection_stocking');//
				$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = Ec_Lang::getInstance()->getTranslate('order_model_required');
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验交货仓库
	 */
	public static function checkwarehouse($jxwarehousename,$orderRow){
		if($jxwarehousename!=''){
			if($orderRow['order_mode_type']=='0'){
				//备货模式不支持日本仓
				if($jxwarehousename=='日本仓'){
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = Ec_Lang::getInstance()->getTranslate('japanese_warehouse_not_support_stocking_model');
					$orderRow['error'] = $error;
					return $orderRow;
				}
			}
			
			$warehousejh = Service_Warehouse::getByField($jxwarehousename,'warehouse_name'); //交货仓库
			if(!empty($warehousejh)){
				if($orderRow['order_mode_type']=='1'){
					if($warehousejh['is_jihuo']=='1'){
						$orderRow['warehouse_id'] = $warehousejh['warehouse_id'];
						$orderRow['warehouse_name'] = $jxwarehousename;
					}else{
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] =  Ec_Lang::getInstance()->getTranslate('delivery_warehouse_do_not_support_collection_model');
						$orderRow['error'] = $error;
					}
				}elseif($orderRow['order_mode_type']=='0'){
					if($warehousejh['is_beihuo']=='1'){
						$orderRow['warehouse_id'] = $warehousejh['warehouse_id'];
						$orderRow['warehouse_name'] = $jxwarehousename;
					}else{
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = Ec_Lang::getInstance()->getTranslate('delivery_warehouse_do_not_support_collection_model');
						$orderRow['error'] = $error;
					}
				}

				/* if("" != $row['reference_no']){
				 $orders = Service_Orders::getByCondition(array('reference_no'=>$row['reference_no'],'orders_status_arr'=>array(1,2,3,4,6,7,8,9,10,11,12,13)));
				if(!empty($orders)){
				$error[] = Ec_Lang::getInstance()->getTranslate('ReferenceNumberAlreadyExists')."--->".$row['reference_no'];
				}
				} */
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('delivery_warehouse_not_exists');
				$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = Ec_Lang::getInstance()->getTranslate('delivery_warehouse_not_empty');
			$orderRow['error'] = $error;
		}
		return $orderRow;	
	}
	/**
	 * @author william-fan
	 * @todo 用于校验目的仓库
	 */
	public static function checkwarehousemd($mdwarehousename,$orderRow){
		//开始校验目的仓
		if($mdwarehousename!=''){
			$warehousemd = Service_Warehouse::getByField($mdwarehousename,'warehouse_name');
			if($orderRow['order_mode_type']=='1'){
				//集货模式校验
				if($warehousemd['is_jihuo']=='1'){
					$orderRow['to_warehouse_id'] = $warehousemd['warehouse_id'];
					$orderRow['to_warehouse_name'] = $mdwarehousename;
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = Ec_Lang::getInstance()->getTranslate('target_warehouse_not_support_collection_model');
					$orderRow['error'] = $error;
				}
			}elseif($orderRow['order_mode_type']=='0'){
				if($warehousemd['is_beihuo']=='1'){
					$orderRow['to_warehouse_id'] = $warehousemd['warehouse_id'];
					$orderRow['to_warehouse_name'] = $mdwarehousename;
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = Ec_Lang::getInstance()->getTranslate('target_warehouse_not_support_collection_model');
					$orderRow['error'] = $error;
				}
			}

			if($orderRow['warehouse_id']!='1'){
				if($orderRow['warehouse_id']!=$orderRow['to_warehouse_id']){
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = Ec_Lang::getInstance()->getTranslate('not_japanese_warehouse_and_target_warehouse_is_inconsistent');
					$orderRow['error'] = $error;
				}
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = Ec_Lang::getInstance()->getTranslate('target_warehouse_not_exists');
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验省份数据
	 */
	public static function checkProvince($provinceName,$orderRow){
		if($provinceName!=''){
            if($orderRow['oab_country_id']=='49' || $orderRow['oab_country_id']=='50' || $orderRow['oab_country_id']=='51'){
                $provinceNameArr = self::sysSubStr($provinceName,strlen($provinceName));
                if(in_array("省",$provinceNameArr)){
                    $Arr2 =  self::sysSubStr($provinceName,strlen($provinceName)-3);
                    $newprovinceName = implode("",$Arr2);
                }else{
                    $newprovinceName = $provinceName;
                }

                $province = Service_Region::getByField($newprovinceName,'region_name');
                if(empty($province)){
                    $condition = array();
                    $condition['region_name_like'] = mb_substr($newprovinceName,0,2,'UTF-8');
                    $condition['region_type'] = '1';
                    $provinces = Service_Region::getByCondition($condition);
                    if(count($provinces)>1){ $provinces =""; $province="";}
                    if($provinces){
                        $province = $provinces[0];
                    }

                }

                if(!empty($province)){
                    if($province['region_type']=='1'){
                        if($orderRow['to_warehouse_id']=='6'){
                            if($province['region_customcode']!=''){
                                $orderRow['oab_state_id'] = $province['region_id'];
                                $orderRow['oab_state'] = $provinceName;
                                $orderRow['oab_state_name'] = $province['region_name'];
                            }else{
                                $orderRow['is_valid'] = '0';
                                $error = $orderRow['error'];
                                $error[] = "城市编码不能为空";
                                $orderRow['error'] = $error;
                            }
                        }else{
                            //是省份
                            $orderRow['oab_state_id'] = $province['region_id'];
                            $orderRow['oab_state'] = $provinceName;
                            $orderRow['oab_state_name'] = $province['region_name'];
                        }
                    }else{
                        //不是省份
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = $provinceName.Ec_Lang::getInstance()->getTranslate('not_province');
                        $orderRow['error'] = $error;
                    }
                }else{

                    $orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = $provinceName.Ec_Lang::getInstance()->getTranslate('DoesNotExist');
                    $orderRow['error'] = $error;
                }
            }else{
                $orderRow['oab_state'] = $provinceName;
            }
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = Ec_Lang::getInstance()->getTranslate('ProvinceRequire');
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验城市
	 */
	public static function checkCity($cityName,$orderRow){
		if(!empty($cityName)){
            if($orderRow['oab_country_id']=='49' || $orderRow['oab_country_id']=='50' || $orderRow['oab_country_id']=='51'){
                $cityNameArr = self::sysSubStr($cityName,strlen($cityName));
                if(in_array("市",$cityNameArr)){
                    $Arr2 =  self::sysSubStr($cityName,strlen($cityName)-3);
                    $NewCityName = implode("",$Arr2);
                }else{
                    $NewCityName = $cityName;
                }
                $cityCondition = array(
                    'parent_id'=>$orderRow['oab_state_id'],
                    'region_name_like'=>$NewCityName
                );
                $citys = Service_Region::getByCondition($cityCondition,'*');
                //$city = Service_Region::getByField($NewCityName,'region_name');
                //$city = Service_Region::getByField($NewCityName,'region_name');
                if(!empty($citys)){
                    $city = $citys[0];
                    if($city['region_type']=='2'){
                        $orderRow['oab_city_id'] = $city['region_id'];
                        $orderRow['oab_city'] = $cityName;
                    }else{
                        $orderRow['oab_city_id'] = $city['region_id'];
                        $orderRow['oab_city'] = $cityName;
                    }
                }else{
                    /*$orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = $city.Ec_Lang::getInstance()->getTranslate('city_not_exists');
                    $orderRow['error'] = $error;*/
                    $orderRow['oab_city'] = $cityName;
                }
                //$orderRow['oab_city'] = $cityName;
            }else{
                $orderRow['oab_city'] = $cityName;
            }
		}
        if($orderRow['to_warehouse_id']=='6'){
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
		}else{
			$orderRow['oab_district']=$districtName;
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验运输方式
	 */
	public static function checkShipType($shipName,$orderRow){
		$warehouse_id = $orderRow['warehouse_id'];
		if($warehouse_id=='1'){
			$warehouse_id =$orderRow['to_warehouse_id'];
		};
		$condition = array(
				'country_ids'=>array(49),
				'warehouse_ids'=>array('0',$warehouse_id),
				'sm_status'=>'1'
		);
		$type = array('shipping_method.sm_id','shipping_method.sm_code');
		//$type = 'count(*)';
		$validShipType=Service_ShippingMethod::getJoinShipmentByCondition($condition,$type,0,1,'','shipping_method.sm_code');
		if($orderRow['order_mode_type']=='0'){
			//备货模式
			if($orderRow['warehouse_id']=='1'){
				//日本仓
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('this_warehouse_not_support_this_shipping_method');
				$orderRow['error'] = $error;
			}else{
				if(self::checkSmValid($shipName, $validShipType)){
					$orderRow['sm_code'] = strtoupper($shipName);
				}else{
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = Ec_Lang::getInstance()->getTranslate('this_warehouse_not_support_this_shipping_method_or_shipping_method_wrong');
					
					$orderRow['error'] = $error;
				}
			}
		}elseif($orderRow['order_mode_type']=='1'){
			if(self::checkSmValid($shipName, $validShipType)){
				$orderRow['sm_code'] = strtoupper($shipName);
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('this_warehouse_not_support_this_shipping_method_or_shipping_method_wrong');
				$orderRow['error'] = $error;
			}
		}
		
		
		/* switch(strtoupper($shipName)){
			case "CNAM":
				$orderRow['sm_code'] = strtoupper($shipName);
				break;
			case "CNEMS":
				$orderRow['sm_code'] = strtoupper($shipName);
				break;	
			case "NEUB":
				$orderRow['sm_code'] = strtoupper($shipName);
				break;
				
			default:
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "运输方式只能支持CNAM、CNEMS、NEUB、SF、YT";
				$orderRow['error'] = $error;
		} */
		return $orderRow;
	}
	/**
	 * @author willia-fan
	 * @todo 设置收件人国家
	 */
	public static function checkCountry($oab_country_name,$orderRow){
		$oab_country_name = trim($oab_country_name);
		if($oab_country_name!=''){
			$country_code = substr($oab_country_name, 0,2);
			$country_code = strtoupper($country_code);
			if($country_code=='ES'){
				//ES就默认取西班牙
				$country = Service_Country::getByField('221','country_id');
			}elseif($country_code=='PT'){
				//PT默认取葡萄牙
				$country = Service_Country::getByField('195','country_id');
			}else{
				$country = Service_Country::getByField($country_code,'country_code');
			}
			//$country = Service_Country::getByField($oab_country_name,'country_name');
			if(!empty($country)){
				$orderRow['oab_country_id'] = $country['country_id'];
				$orderRow['oab_country_name'] = $oab_country_name;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "国家{$country_code}不存在";
				$orderRow['error'] = $error;
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
	 * @todo 用于校验交易订单号
	 */
	public static function checkReference($reference_no,$orderRow){
		if("" != $reference_no){
		 	$ordersCount = Service_Orders::getByCondition(array('reference_no'=>$reference_no,'order_status_arr'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14)),'count(*)');
		 	$orderRow['reference_no'] = $reference_no;
		 	if($ordersCount>0){
		 		$orderRow['is_valid'] = '0';
		 		$error = $orderRow['error'];
		 		$error[] = Ec_Lang::getInstance()->getTranslate('exists_CustomerReference_in_system');
		 		$orderRow['error'] = $error;
		 	}else{
		 		$orderRow['reference_no'] = $reference_no;
		 	}
		}
		return $orderRow;
	}
    /**
     * @author william-fan
     * @todo 用于校验支付单号
     */
    public static function checkPayNo($pay_no,$orderRow){
        $pay_no = trim($pay_no);
        if($pay_no!=''){
            $ordersCount = Service_Orders::getByCondition(array('pay_no'=>$pay_no,'order_status_arr'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14)),'count(*)');
            if($ordersCount>0){
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
                if(self::CHECK_PAYNO){
                    $orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = "支付单号必填";
                    $orderRow['error'] = $error;
                }else{
                    $orderRow['pay_no'] = '';
                }
            }
        }else{
            $orderRow['pay_no'] = $pay_no;
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
			$error[] = Ec_Lang::getInstance()->getTranslate('LastNameNeed');
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
			$error[] = Ec_Lang::getInstance()->getTranslate('The_recipient_name_is_required');
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
			$error[] =  Ec_Lang::getInstance()->getTranslate('address1_required');
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
			/* if(preg_match('/^[0-9]+$/i', $telephone)!==false){
				$orderRow['oab_phone'] = $telephone;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = "电话必须是数字";
				$orderRow['error'] = $error;
			} */
			$orderRow['oab_phone'] = $telephone;
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = Ec_Lang::getInstance()->getTranslate('phone_required');
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
			/*if (preg_match("/^[a-zA-Z0-9_\.-]+\@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/i", $email)) {
				$orderRow['oab_email'] = $email;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('Email_format_error');
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
				$error[] = Ec_Lang::getInstance()->getTranslate('Gross_weight_must_be_numeric');
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
		/* if($charge!=''){
			if(is_numeric($charge) && $charge>0){
				$orderRow['charge'] = $charge;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('Clinch_a_deal_the_price_must_is_a_number_greater_than_0');
				$orderRow['error'] = $error;
			}
		}else{
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = Ec_Lang::getInstance()->getTranslate('purchase_price_required');
			$orderRow['error'] = $error;
		} */
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 设置币种信息
	 */
	public static function checkCurrency($currency_code,$orderRow){
		if($currency_code!=''){
			$currency=Service_Currency::getByField($currency_code,'currency_code');
			if(!empty($currency)){
				$orderRow['currency_code'] = $currency_code;
			}else{
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('currency_is_not_exists');
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
					$orderRow['IdType'] = '1';
					break;
				case '军官证':
					$orderRow['IdType'] = '2';
					break;
				case '护照':
					$orderRow['IdType'] = '3';
					break;
				case '其他':
					$orderRow['IdType'] = '4';
					break;
				/*default:
					$orderRow['is_valid'] = '0';
					$error = $orderRow['error'];
					$error[] = "证件类型填写错误";
					$orderRow['error'] = $error;*/
			}
		}else{
			/*$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "证件类型必填";
			$orderRow['error'] = $error;*/
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
			/*$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = "证件号码必填";
			$orderRow['error'] = $error;*/
            if($orderRow['to_warehouse_id']=='6'){
                if(self::CHECK_ID){
                    $orderRow['is_valid'] = '0';
                    $error = $orderRow['error'];
                    $error[] = "证件号码必填";
                    $orderRow['error'] = $error;
                }
            }
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
	 * @todo 用于设置校验产品
	 */
	public static function checkProduct($orderProducts,$orderRow){
		//error_reporting(E_ALL);
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		//print_r($orderProducts);
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];	
	    //print_r($orderRow['to_warehouse_id']);exit;
		if(!empty($orderProducts)){
			$skunumber=count($orderProducts);
			/*if($skunumber % 4){ // 不再验证仓库，交易价格、成交单价都必须填写，因此必须被4整除
				//不为偶数				
				$orderRow['is_valid'] = '0';
				$error = $orderRow['error'];
				$error[] = Ec_Lang::getInstance()->getTranslate('SKU_quantity_price_purchase_price_must_be_team');
				$orderRow['error'] = $error;
			}else{*/
				/* foreach ($orderProducts as $){
					
				} */
				$orderSku = array();
				$xuNumber = $skunumber/4; //循环次数
				$productSkuArr = array();
				for($i=0;$i<$xuNumber;$i++){
					$index = $i*4;
					$product_sku = strval($orderProducts[$index]);
					$product_qty = strval($orderProducts[$index+1]);
                    $op_price = strval($orderProducts[$index+2]);
                    /*$op_total_price = strval($orderProducts[$index+3]);
                    if(!(is_numeric($op_total_price) && $op_total_price>0)){
                        $op_total_price = $op_price*$product_qty;
                    }*/
                    $op_total_price = $op_price * $product_qty; // 成交总价固定为交易单价乘以数量
                    //$charge = $charge + $productCharge;
					/* var_dump($product_sku);
					echo '<br/>'; */
					//exit;
					if(empty($product_sku)){
						//sku为空跳过
						continue;
					}
                    if(empty($product_qty)){
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_quantity_required'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
                    if(empty($op_price)){
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_unit_purchase_price_required'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
                    if(empty($op_total_price)){
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_purchase_price_required'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
					$condition = array(
							'customer_id'=>$customerId,
							'product_sku'=>$product_sku,
					);
					$orderInfoAll = Service_Product::getByCondition($condition,'*','',1,1); //取一条
					if(!empty($orderInfoAll)){
						$productInfo = $orderInfoAll[0];
					}else{
						$productInfo = array();
					}
                    if($orderRow['to_warehouse_id']=='6'){
                        if($productInfo['goods_id']=='' && $productInfo['product_type']=='0'){
                            //非组合产品sku
                            $orderRow['is_valid'] = '0';
                            $error = $orderRow['error'];
                            $error[] = "料件号为空";//
                            $orderRow['error'] = $error;
                        }
                    }
					//$productInfo = Service_Product::getByField($product_sku,'product_sku');
					if(!empty($productInfo)){
						if($productInfo['product_status']=='1'){
							if($productInfo['product_type']!='1'){
								if($productInfo['customer_id']!=$customerId){
									//不是这个客户的产品
									$orderRow['is_valid'] = '0';
									$error = $orderRow['error'];
									$error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_not_exists'),array($product_sku));
									$orderRow['error'] = $error;
								}else{
									if(!in_array($product_sku,$productSkuArr)){
										$productSkuArr[] = $product_sku;
										$orderProduct = array('product_id'=>$productInfo['product_id'],'qty'=>$product_qty,'price'=>$op_price,'total_price'=>$op_total_price);
										$orderSku[] = $orderProduct;
									}else{
										
										/* $orderRow['is_valid'] = '0';
										$error = $orderRow['error'];
										$error[] = '产品sku:'.$product_sku."文档中有相同的sku";
										$orderRow['error'] = $error; */
									}
								}
							}else{
								//组合产品不能添加到订单里面
								//$orderRow['is_valid'] = '0';
								//$error = $orderRow['error'];
								//$error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_cannot_add_to_order'),array($product_sku));
								//$orderRow['error'] = $error;
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

                                $orderSku[] = $orderProduct;
							}
						}else{
							//产品状态不对
							$orderRow['is_valid'] = '0';
							$error = $orderRow['error'];
							$error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_product_status_not_ok'),array($product_sku));
							$orderRow['error'] = $error;
						}
					}else{
						//产品状态不对
						$orderRow['is_valid'] = '0';
						$error = $orderRow['error'];
						$error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_not_exists'),array($product_sku));
						$orderRow['error'] = $error;
					}
				}
				$orderRow['order_product'] = $orderSku;
			//} // 无需验证成双成对问题，目前交易单价、总价均为必填
		}
		return $orderRow;
	}
	/**
	 * @author william-fan
	 * @todo 校验输入的交易订单号的重复性(检查本文档的情况)
	 */
	public static function checkReferenceDocument($reference_no,$referenceArr,$orderRow){
		if(in_array($reference_no, $referenceArr)){
			$orderRow['is_valid'] = '0';
			$error = $orderRow['error'];
			$error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('transaction_orderno_repeat'),array($reference_no));
			$orderRow['error'] = $error;
		}
		return $orderRow;
	}
    /**
     * @author william-fan
     * @todo 校验文档的支付单号重复性
     */
    public static function checkPayNoDocument($pay_no,$payNoArr,$orderRow){
        if(in_array($pay_no, $payNoArr)){
            $orderRow['is_valid'] = '0';
            $error = $orderRow['error'];
            $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('transaction_orderno_repeat'),array($pay_no));
            $orderRow['error'] = $error;
        }
        return $orderRow;
    }
	/**
	 * @author william-fan
	 * @todo 检查运输方式是否有效
	 */
	public static function checkSmValid($sm_code,$validShipType){
		$valuelid = false;
		if(!empty($validShipType)){
			foreach ($validShipType as $key=>$shipType){
				if($sm_code==$shipType['sm_code']){
					return true;
				}
			}
		}
		return $valuelid;
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

    public static function checkIsDiscount($isDiscount,$orderRow){
        if($isDiscount==""){
            $orderRow['is_valid'] = '0';
            $error = $orderRow['error'];
            $error[] = Ec_Lang::getInstance()->getTranslate('discount_required');
            $orderRow['error'] = $error;
        }else{
            if($isDiscount=='有'){
                $orderRow['is_discount'] = 1;
            }else{
                $orderRow['is_discount'] = "0";
            }
        }
        return $orderRow;
    }

    public static function checkIsGift($isGift,$orderRow){
        if($isGift==""){
            $orderRow['is_valid'] = '0';
            $error = $orderRow['error'];
            $error[] = Ec_Lang::getInstance()->getTranslate('Whether_the_gifts');
            $orderRow['error'] = $error;
        }else{
            if($isGift=='是'){
                $orderRow['is_gift'] = 1;
            }else{
                $orderRow['is_gift'] = "0";
            }
        }
        return $orderRow;
    }

    public static function shupaiData($rows){
        $orderRows = array();
        $referenceArr = array();
        $payNoArr = array();
        foreach ($rows as $key=>$rowData){
            //print_r($key);
            if($key>=1){
                $orderRow=self::TransformShuPaiData($rowData,$referenceArr);
                //print_r($rowData);
                $referenceArr[] = $rowData[7];
                if($rowData[8]!=''){
                    $payNoArr = $rowData[8];
                }
                $orderRows[] = $orderRow;
            }
        }

        return $orderRows;
    }

    public static function TransformShuPaiData($rowData,$referenceArr){
    	//var_dump($rowData);
    	//exit();
        $customerAuth = new Zend_Session_Namespace("customerAuth");

        $customer	= $customerAuth->data;
        $customerId = $customer['id'];
        if(!empty($rowData)){
            $orderRow = array(
                'action'=>'add',
                'customer_id'=>$customerId,
                'warehouse_id'=>'',
                'warehouse_name'=>'',
                'to_warehouse_id'=>'',
                'to_warehouse_name'=>'',
                'sm_code'=>'',
                'oab_state'=>'', //省份
                'oab_state_name'=>'',
                'oab_city'=>'', //城市
                'oab_city_id'=>'',
                'oab_district'=>'',
                'currency_code'=>'RMB',//默认为人民币
                'order_status'=>'1',
                'reference_no'=>'',
                //'oab_lastname'=>'',
                'oab_firstname'=>'',
                'oab_company'=>'',
                'oab_postcode'=>'',
                'oab_street_address1'=>'',
                'oab_street_address2'=>'',
                'oab_phone'=>'',
                'oab_email'=>'',
                'remark'=>'',
                'grossWt'=>'0.00',
                'change_order'=>'0',
                'grossWt'=>'',
                'charge'=>'0.00',
                'IdType'=>'1',
                'idNumber'=>'',
                'order_mode_type'=>'1',
                'is_valid'=>'1',//是否可用
                'order_product'=>array(),
                'error'=>array(),
                //'is_discount'=>'',
                //'is_gift'=>'',
            );

            $order_mode_name = ''; ////订单模式
            if(isset($rowData[0]) && $rowData[0]!= ''){
                $order_mode_name = $rowData[0]; ////订单模式
            }

            $jxwarehousename = ''; //交货仓库
            if(isset($rowData[1]) && $rowData[1]!= ''){
                $jxwarehousename = $rowData[1]; //交货仓库
            }
            $mdwarehousename = '';
            if(isset($rowData[2]) && $rowData[2]!= ''){
                $mdwarehousename = $rowData[2]; //目的仓库
            }
            $provinceName = '';
            if(isset($rowData[3]) && $rowData[3]!= ''){
                $provinceName	 = $rowData[3]; //省份
            }
            $cityName	= '';
            if(isset($rowData[4]) && $rowData[4]!= ''){
                $cityName		 = $rowData[4]; //城市
            }
            $districtName	= '';
            if(isset($rowData[5]) && $rowData[5]!= ''){
                $districtName		 = $rowData[5]; //区县
            }
            $shipName	= '';
            if(isset($rowData[6]) && $rowData[6]!= ''){
                $shipName		 = $rowData[6]; //运输方式
            }
            $reference_no	 = ''; //交易订单号
            if(isset($rowData[7]) && $rowData[7]!= ''){
                $reference_no	 = strval($rowData[7]); //交易订单号
            }
            //add 2014-11-03增加支付单号
            $pay_no = '';
            if(isset($rowData[8]) && $rowData[8]!= ''){
                $pay_no	 = strval($rowData[8]); //交易订单号
            }
            /*$lastName		 = ''; //姓
            if(isset($rowData[7]) && $rowData[7]!= ''){
                $lastName		 = $rowData[7]; //姓
            }*/
            $firstName		 = ''; //姓名
            if(isset($rowData[9]) && $rowData[9]!= ''){
                $firstName		 = $rowData[9]; //姓名
            }
            $companyName	 = ''; //公司名称
            if(isset($rowData[10]) && $rowData[10]!= ''){
                $companyName	 = $rowData[10]; //公司名称
            }
            $zipCode		 = ''; //邮编
            if(isset($rowData[11]) && $rowData[11]!= ''){
                $zipCode		 = strval($rowData[11]); //邮编
            }
            $address1		 = '';//地址一
            if(isset($rowData[12]) && $rowData[12]!= ''){
                $address1		 = $rowData[12];//地址一
            }
            $address2		 = '';//地址2
            if(isset($rowData[13]) && $rowData[13]!= ''){
                $address2		 = $rowData[13];//地址2
            }
            $telephone		 = '';//电话
            if(isset($rowData[14]) && $rowData[14]!= ''){
                $telephone		 = strval($rowData[14]);//电话
            }
            $email			 = '';//电子邮件
            if(isset($rowData[15]) && $rowData[15]!= ''){
                $email			 = $rowData[15];//电子邮件
            }
            $grossWt		 = '';//毛重
            if(isset($rowData[16]) && $rowData[16]!= ''){
                $grossWt		 = $rowData[16];//毛重
            }
            $currency_code			 = '';//币种
            if(isset($rowData[17]) && $rowData[17]!= ''){
                $currency_code = $rowData[17];//币种
            }
            $charge			 = '';//成交总价
            if(isset($rowData[18]) && $rowData[18]!= ''){
                $charge			 = strval($rowData[18]);//成交总价
            }
            $IdType			 = '';//证件类型
            if(isset($rowData[19]) && $rowData[19]!= ''){
                $IdType			 = $rowData[19];//证件类型
            }
            $idNumber		 = '';//证件号码
            if(isset($rowData[20]) && $rowData[20]!= ''){
                $idNumber		 = strval($rowData[20]);//证件号码
            }
            /*$isDiscount = "";
            if(isset($rowData[21])&&$rowData[21]!=""){
                $isDiscount = $rowData[21];
            }
            $isGift = "";
            if(isset($rowData[22])&&$rowData[22]!=""){
                $isGift = $rowData[22];
            }*/
            $remark			 = '';//备注
            if(isset($rowData[21]) && $rowData[21]!= ''){
                $remark			 = $rowData[21];//备注
            }
            //echo $address1;
            $orderProducts	 = self::getShuPaiProduct($rowData);
            $orderRow = self::checkOrderMode($order_mode_name, $orderRow);
            $orderRow = self::checkwarehouse($jxwarehousename, $orderRow);
            $orderRow = self::checkwarehousemd($mdwarehousename, $orderRow);
            $orderRow = self::checkCountry('CN', $orderRow);
            $orderRow = self::checkProvince($provinceName, $orderRow);
            $orderRow = self::checkCity($cityName, $orderRow);
            $orderRow = self::checkShipType($shipName, $orderRow);
            $orderRow = self::checkReference($reference_no, $orderRow);
            $orderRow = self::checkPayNo($pay_no,$orderRow);
            //$orderRow = self::checkLastName($lastName, $orderRow);
            $orderRow = self::checkFirstName($firstName, $orderRow);
            $orderRow = self::checkCompany($companyName, $orderRow);
            $orderRow = self::checkPostcode($zipCode, $orderRow);
            $orderRow = self::checkAddress1($address1, $orderRow);
            $orderRow = self::checkAddress2($address2, $orderRow);
            $orderRow = self::checkTelephone($telephone, $orderRow);
            $orderRow = self::checkEmail($email, $orderRow);
            $orderRow = self::checkgrossWt($grossWt, $orderRow);
            $orderRow = self::checkCurrency($currency_code, $orderRow);
            $orderRow = self::checkCharge($charge, $orderRow);
            $orderRow = self::checkIdType($IdType, $orderRow);
            $orderRow = self::checkIdNumber($idNumber, $orderRow);
            $orderRow = self::checkRemark($remark, $orderRow);
            $orderRow = self::checkShuPaiProduct($orderProducts, $orderRow);
            $orderRow = self::checkDistrict($districtName,$shipName,$orderRow);
            //$orderRow = self::checkIsDiscount($isDiscount,$orderRow);
            //$orderRow = self::checkIsGift($isGift,$orderRow);
            //$orderRow = self::checkReferenceDocument($reference_no,$referenceArr,$orderRow);
           // echo $districtName;
            //print_r($orderRow);
            return $orderRow;
            //print_r($orderProduct);
        }else{

        }
    }
    public static function getShuPaiProduct($rowData){
        $productArr = array_slice($rowData,18,7);
        /*if($productArr){
            foreach($productArr as $key=>$value){
                if(empty($value)){
                    unset($productArr[$key]);
                }
            }
        }*/
        //$productArr = array_slice(18, array_values($rowData));
        return array_values($productArr);
    }

    public static function checkShuPaiProduct($orderProducts, $orderRow){
        //error_reporting(E_ALL);
        $customerAuth = new Zend_Session_Namespace("customerAuth");
        $customer	= $customerAuth->data;
        $customerId = $customer['id'];
        if(!empty($orderProducts)){
            $skunumber=count($orderProducts);
            if($skunumber%7){
                //不为偶数
                $orderRow['is_valid'] = '0';
                $error = $orderRow['error'];
                $error[] = Ec_Lang::getInstance()->getTranslate('SKU_quantity_must_be_team');//SKU_quantity_must_be_team
                $orderRow['error'] = $error;
            }else{
                /* foreach ($orderProducts as $){

                } */
                $orderSku = array();
                $xuNumber = $skunumber/2; //循环次数
                $productSkuArr = array();
                for($i=0;$i<$xuNumber;$i++){
                    $index = $i*7;
                    $product_sku = strval($orderProducts[$index+4]);
                    $product_qty = strval($orderProducts[$index+5]);
                    $op_price = strval($orderProducts[$index+6]);
                    /*$op_total_price = strval($orderProducts[$index]);
                    if(!(is_numeric($op_total_price) && $op_total_price>0)){
                        $op_total_price = $op_price*$product_qty;
                    }*/
                    $op_total_price = $op_price * $product_qty; // 成交总价固定为交易单价乘以数量
                    /* var_dump($product_sku);
                    echo '<br/>'; */
                    //exit;
                    if(empty($product_sku)){
                        //sku为空跳过
                        continue;
                    }
                    if(empty($product_qty)){
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_quantity_required'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
                    if(empty($op_price)){
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_unit_purchase_price_required'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
                    if(empty($op_total_price)){
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_purchase_price_required'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
                    $condition = array(
                        'customer_id'=>$customerId,
                        'product_sku'=>$product_sku,
                    );
                    $orderInfoAll = Service_Product::getByCondition($condition,'*','',1,1); //取一条
                    if(!empty($orderInfoAll)){
                        $productInfo = $orderInfoAll[0];
                    }else{
                        $productInfo = array();
                    }
                    if($orderRow['to_warehouse_id']=='6'){
                        if($productInfo['goods_id']=='' && $productInfo['product_type']=='0'){
                            //非组合产品sku
                            $orderRow['is_valid'] = '0';
                            $error = $orderRow['error'];
                            $error[] = "料件号为空";//
                            $orderRow['error'] = $error;
                        }
                    }
                    //$productInfo = Service_Product::getByField($product_sku,'product_sku');
                    if(!empty($productInfo)){
                        if($productInfo['product_status']=='1'){
                            if($productInfo['product_type']!='1'){
                                if($productInfo['customer_id']!=$customerId){
                                    //不是这个客户的产品
                                    $orderRow['is_valid'] = '0';
                                    $error = $orderRow['error'];
                                    $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_not_exists'),array($product_sku));//
                                    $orderRow['error'] = $error;
                                }else{
                                    if(!in_array($product_sku,$productSkuArr)){
                                        $productSkuArr[] = $product_sku;
                                        $orderProduct = array('product_id'=>$productInfo['product_id'],'qty'=>$product_qty,'price'=>$op_price,'total_price'=>$op_total_price);
                                        $orderSku[] = $orderProduct;
                                    }else{

                                        /* $orderRow['is_valid'] = '0';
                                        $error = $orderRow['error'];
                                        $error[] = '产品sku:'.$product_sku."文档中有相同的sku";
                                        $orderRow['error'] = $error; */
                                    }
                                }
                            }else{
                                //组合产品不能添加到订单里面
                                //$orderRow['is_valid'] = '0';
                                //$error = $orderRow['error'];
                                //$error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_cannot_add_to_order'),array($product_sku));
                                //$orderRow['error'] = $error;
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

                                $orderSku[] = $orderProduct;
                            }
                        }else{
                            //产品状态不对
                            $orderRow['is_valid'] = '0';
                            $error = $orderRow['error'];
                            $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_sku_product_status_not_ok'),array($product_sku));
                            $orderRow['error'] = $error;
                        }
                    }else{
                        //产品状态不对
                        $orderRow['is_valid'] = '0';
                        $error = $orderRow['error'];
                        $error[] = vsprintf(Ec_Lang::getInstance()->getTranslate('product_not_exists'),array($product_sku));
                        $orderRow['error'] = $error;
                    }
                }
                $orderRow['order_product'] = $orderSku;
            }
        }
        return $orderRow;
    }
}
