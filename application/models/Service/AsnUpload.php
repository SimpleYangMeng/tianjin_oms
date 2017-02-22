<?php
/**
 * @author william-fan 
 * @todo 订单批量上传类
 */
class Service_AsnUpload{
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
		$path = APPLICATION_PATH.'/../data/asnupload/';
		$path.= $customerId;
		if(!file_exists($path)){
			if(!mkdir($path,0700,true)){
				$result = array("ask"=>0,"message"=>"上传文件失败失败",'error'=>array('上传目录不存在创建文件目录失败'));
				return $result;
			}
		}
		$config = array();
		$config['upload_path']		= $path;
		$config['allowed_types']	= 'xls|xlsx';
		$config['max_size']			= '10000';
		$config['encrypt_name']		= true;
		$upload	= new Common_UploadFile($config);
		$upload->set_upload_path($path);
		if ( ! $upload->do_upload($_FILES,$field) ){
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
		
		$resultArray = Common_Upload::readEXCEL($full_path);
		/* if(empty($resultArray) || !is_array($resultArray)){
			$result = array("ask"=>0,"message"=>"文件内容不符合格式或数据为空.",'error'=>array());
			echo json_encode($result);
			exit;
		} */
		@unlink($full_path);
		return $resultArray;
	}
	/**
	 * @author william-fan
	 * @todo 用于处理excel文件返回成有效的数组
	 */
	public static function getDataArr($rows){
		//echo "<pre>";
		$asnRows = array();
		foreach ($rows as $key=>$rowData){
			//print_r($key);
			if($key>=1){
				$asnRow=self::TransformData($rowData);
				$asnRows[] = $asnRow;
			}
		}
		//echo "</pre>";
		return $asnRows; 
		//exit;
	}
	/**
	 * @author william-fan
	 * @todo 用于转换一行的ASN数据
	 */
	public static function TransformData($rowData){
		/* var_dump($rowData);
		return; */
		//var_dump($rowData);
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		if(!empty($rowData)){
			$asnRow = array(
				'customer_id'=>$customerId,	
				'receive_model_type'=>'1',
				'warehouseId'=>'',
				'warehouse_name'=>'',
				'to_warehouse'=>'',
				'to_warehouse_name'=>'',
				'ref_code' =>'',
				'traf_name'=>'',
				'roughweight'=>'',
				'length'=>'',
				'width'=>'',
				'height'=>'',				
				'instructions'=>'',	
				'is_valid'=>'1',//是否可用
				'asn_order'=>array(),
				'error'=>array(),											
			);
			
			
			$jxwarehousename = ''; //交货仓库
			if(isset($rowData[0]) && $rowData[0]!= ''){
				$jxwarehousename = $rowData[0]; //交货仓库
			}
			$mdwarehousename = ''; //目的仓库
			if(isset($rowData[1]) && $rowData[1]!= ''){
				$mdwarehousename = $rowData[1]; //目的仓库
			}
			$ref_code = ''; //客户参考号
			if(isset($rowData[2]) && $rowData[2]!= ''){
				$ref_code	 = $rowData[2]; //客户参考号
			}
			$traf_name	= ''; //航空单号
			if(isset($rowData[3]) && $rowData[3]!= ''){
				$traf_name		 = $rowData[3]; //航空单号
			}
			$roughweight	= ''; //毛重
			if(isset($rowData[4]) && $rowData[4]!= ''){
				$roughweight		 = $rowData[4]; //毛重
			}
			$length	 = ''; //长
			if(isset($rowData[5]) && $rowData[5]!= ''){
				$length	 = $rowData[5]; //长
			}
			$width		 = ''; //宽
			if(isset($rowData[6]) && $rowData[6]!= ''){
				$width		 = $rowData[6]; //宽
			}
			$heigh		 = ''; //高
			if(isset($rowData[7]) && $rowData[7]!= ''){
				$heigh		 = $rowData[7]; //高
			}
			$instructions	 = ''; //备注
			if(isset($rowData[8]) && $rowData[8]!= ''){
				$instructions	 = $rowData[8]; //公司名称
			}
	
			//echo $address1;
			$asnorders	 = self::getAsnOrder($rowData);
			
			
			$asnRow = self::checkwarehouse($jxwarehousename, $asnRow);
			$asnRow = self::checkwarehousemd($mdwarehousename, $asnRow);
			$asnRow = self::checkRefCode($ref_code,$asnRow);
			$asnRow = self::checkTrafName($traf_name,$asnRow);
			$asnRow = self::checkRoughweight($roughweight, $asnRow);
			$asnRow = self::checkLength($length, $asnRow);
			$asnRow = self::checkWidth($width, $asnRow);
			$asnRow = self::checkHeight($heigh, $asnRow);
			$asnRow = self::checkInstructions($instructions, $asnRow);
			
			$asnRow = self::checkOrders($asnorders, $asnRow);
			//print_r($asnRow);
			return $asnRow;
			//print_r($orderProduct);
		}else{
			
		}
	}
	/**
	 * @author william-fan
	 * @todo 得到订单信息
	 */
	public static function getAsnOrder($rowData){
		//print_r($rowData);
		$orderArr = array_slice($rowData,9);//从第十列往后都是订单的信息
		//$productArr = array_slice(18, array_values($rowData));
		return $orderArr;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验交货仓库
	 */
	public static function checkwarehouse($jxwarehousename,$asnRow){
		if($jxwarehousename!=''){
			$warehousejh = Service_Warehouse::getByField($jxwarehousename,'warehouse_name'); //交货仓库
			if(!empty($warehousejh)){
				if($warehousejh['is_jihuo']=='1'){
					$asnRow['warehouseId'] = $warehousejh['warehouse_id'];
					$asnRow['warehouse_name'] = $jxwarehousename;
				}else{
					$asnRow['is_valid'] = '0';
					$error = $asnRow['error'];
					$error[] = "交货仓库不支持集货模式";
					$asnRow['error'] = $error;
				}
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = "交货仓库不存在";
				$asnRow['error'] = $error;
			}
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = '交货仓库必填';
			$asnRow['error'] = $error;
		}
		return $asnRow;	
	}
	/**
	 * @author william-fan
	 * @todo 用于校验目的仓库
	 */
	public static function checkwarehousemd($mdwarehousename,$asnRow){
		//开始校验目的仓
		if($mdwarehousename!=''){
			$warehousemd = Service_Warehouse::getByField($mdwarehousename,'warehouse_name');
			if($warehousemd['is_jihuo']=='1'){
				$asnRow['to_warehouse'] = $warehousemd['warehouse_id'];
				$asnRow['to_warehouse_name'] = $mdwarehousename;
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = "目的仓库不支持集货模式";
				$asnRow['error'] = $error;
			}
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = "目的仓库不存在";
			$asnRow['error'] = $error;
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验参考号
	 */
	public static function checkRefCode($ref_code,$asnRow){
		if($ref_code!=''){
			$asnRow['ref_code'] = $ref_code;
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = "客户参考号必填";
			$asnRow['error'] = $error;
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验航空单号
	 */
	public static function checkTrafName($traf_name,$asnRow){
		if($asnRow['warehouseId']!='' && $asnRow['warehouseId']!='1'){
			//非日本仓 要检验航空单号
			if(!empty($traf_name)){
				$asnRow['traf_name'] = $traf_name;
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = $asnRow['warehouse_name']."航空单号必填";
				$asnRow['error'] = $error;
			}
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验毛重
	 */
	public static function checkRoughweight($roughweight,$asnRow){
		if($roughweight){
			if(is_numeric($roughweight) && $roughweight>0){
				$asnRow['roughweight'] = $roughweight;
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = "毛重必须是大于0的数字";
				$asnRow['error'] = $error;
			}
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验长
	 */
	public static function checkLength($length,$asnRow){
		if("" != $length){
			if(is_numeric($length) && $length>0){
				$asnRow['length'] = $length;
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = "长必须是大于0的数字";
				$asnRow['error'] = $error;
			}
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = "长必填";
			$asnRow['error'] = $error;
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验宽
	 */
	public static function checkWidth($width,$asnRow){
		if("" != $width){
			if(is_numeric($width) && $width>0){
				$asnRow['width'] = $width;
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = "宽必须是大于0的数字";
				$asnRow['error'] = $error;
			}
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = "宽必填";
			$asnRow['error'] = $error;
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于校验高
	 */
	public static function checkHeight($heigh,$asnRow){
		if("" != $heigh){
			if(is_numeric($heigh) && $heigh>0){
				$asnRow['height'] = $heigh;
			}else{
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$error[] = "高必须是大于0的数字";
				$asnRow['error'] = $error;
			}
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = "高必填";
			$asnRow['error'] = $error;
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于设置备注
	 */
	public static function checkInstructions($instructions,$asnRow){
		if($instructions!=''){
			$asnRow['instructions'] = $instructions;
		}
		return $asnRow;
	}
	/**
	 * @author william-fan
	 * @todo 用于设置校验订单
	 */
	public static function checkOrders($asnorders,$asnRow){
		//error_reporting(E_ALL);
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		
		if(!empty($asnorders)){
			//$skunumber=count($orderProducts);
			$error = $asnRow['error'];
			foreach($asnorders as $keyo=>$ordercode){
				$orderInfo = Service_Orders::getByField($ordercode,'order_code');
				if(!empty($orderInfo)){
					if($orderInfo['order_status']!='2'){
						$error[] = Ec_Lang::getInstance()->getTranslate('orderCode').' '.$ordercode.Ec_Lang::getInstance()->getTranslate('IsNotRecognizedInTheState');
					}
					if(isset($asnRow['warehouseId']) && $asnRow['warehouseId']!=$orderInfo['warehouse_id'] ){
						$error[] = Ec_Lang::getInstance()->getTranslate('DeliveryWarehousesAndWarehouseDeliveryOrdersAreInconsistent'); //交货仓不一致
					}
					if(isset($asnRow['to_warehouse']) && $asnRow['to_warehouse']!='' && $asnRow['to_warehouse']!=$orderInfo['to_warehouse_id'] ){
						$error[] = Ec_Lang::getInstance()->getTranslate('PurposeWarehousesAndWarehousePurposesInconsistentOrders'); //目的仓不一致
					}
					if(isset($asnRow['to_warehouse']) && $asnRow['to_warehouse']!=''){
						//校验目的仓正确性
						$warehousemd = Service_Warehouse::getByField($asnRow['to_warehouse']);
						if(!(!empty($warehousemd) && $warehousemd['is_first']=='0')){
							$error[] = Ec_Lang::getInstance()->getTranslate('ObjectiveWarehousePropertyError');//"目的仓属性错误";
						}
					}
				}else{
					$error[] = Ec_Lang::getInstance()->getTranslate('orderCode').' '.$ordercode.''.Ec_Lang::getInstance()->getTranslate('DoesNotExist');
				}
			}
			if(!empty($error)){
				$asnRow['is_valid'] = '0';
				$error = $asnRow['error'];
				$asnRow['error'] = $error;
			}else{
				$asnRow['asn_order'] = $asnorders;
			}
		}else{
			$asnRow['is_valid'] = '0';
			$error = $asnRow['error'];
			$error[] = "订单必填";
			$asnRow['error'] = $error;
		}
		return $asnRow;
	}
	
}
