<?php
class Merchant_ProductBatchUploadController extends Ec_Controller_Action{
	public function preDispatch ()
	{
		$this->tplDirectory = "merchant/views/product/";
		$this->customerAuth = new Zend_Session_Namespace("customerAuth");
	}

    /**
     * @author colin-yang
     * @todo 用于下载批量产品模板
     */
    public function productBatchImportTempleteAction(){
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache'); 
    	$fullPath = APPLICATION_PATH."/../data/file".'/productBatchImport.xls';
    	//方法2
    	$filename = basename($fullPath);
    	header("Content-Type: APPLICATION/OCTET-STREAM");
    	//Force the download
    	$header="Content-Disposition: attachment; filename=".$filename.";";
    	header($header );
    	// 	header("Content-Transfer-Encoding: binary");
    	// 	header("Content-Length: ".$len);
    	echo file_get_contents($fullPath);
    	exit;
    }
	
	
	/**
	 * @author colin yang
	 * @todo 选择产品批量导入
	 */
	public function batchProductInputAction(){		
		echo Ec::renderTpl($this->tplDirectory . "batch-product-import.tpl",'noleftlayout');
	}
	/**
	 * @author william-fan
	 * @todo 产品批量导入检查
	 */
	public function batchProductImportPreviewAction(){		
		$productUpload = new Zend_Session_Namespace('productUpload');
		$field = 'XMLForInput';		
		$xlsData = self::getXLSData($_FILES, $field);
		if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
			//echo 'sss';
			$this->view->uploadinfo = $xlsData;			
			echo Ec::renderTpl($this->tplDirectory . "batch-product-import.tpl",'noleftlayout');
			exit;
		}else{
			$orderRows = $this->_getDataArr($xlsData);			
			$productUpload->uploadData = $orderRows;
			$this->view->uploadData=$orderRows;
			
			echo Ec::renderTpl($this->tplDirectory . "batch-product-import-preview.tpl",'noleftlayout');
		}
	}
	/**
	 * @author colin-yang
	 * @todo 用于实际地写入数据
	 */
	public function doBatchInsertAction(){
		$productUpload = new Zend_Session_Namespace('productUpload');
		$sessionData = $productUpload->uploadData;
		$selectedData = array();
		$allowImageType = array('jpg','jpeg','gif','png');
		if(empty($sessionData)){
			$this->_redirect('/merchant/product-batch-upload/batch-product-input');
		}
		$ids = $this->_request->getParam('select');
		if(empty($ids)){
			$this->_redirect('/merchant/product-batch-upload/batch-product-input');
		}
		foreach($ids as $id){
			if($sessionData[$id])
			$selectedData[] = $sessionData[$id];
		}
		
		if(empty($selectedData)){
			$this->_redirect('/merchant/product-batch-upload/batch-product-input');
		}
 		$DB = Common_Common::getAdapter();
		$ids = $this->_request->getParam('select');
		$system_error_number = 1;		
		foreach($selectedData as $p =>&$prow){
			$prow['error'] = array();
			$prow['error_number']=0;				
			$insertRow = $prow;
			unset($insertRow['error']);	
			unset($insertRow['error_number']);
			unset($insertRow['product_url']);
			unset($insertRow['is_valid']);
			unset($insertRow['pc_name']);
			unset($insertRow['pu_name']);	
			unset($insertRow['country_title']);	
			unset($insertRow['product_url1']);	
			unset($insertRow['product_url2']);	
			unset($insertRow['product_url3']);	
			unset($insertRow['product_url4']);	
			$DB->beginTransaction();
			try{
				$productID =Service_Product::add($insertRow);
				// 新增产品时间节点记录
				Service_ProductTimeline::insert(array('product_id' => $productID, 'create_time' => $insertRow['product_add_time']));
				Service_ProductAttached::delete($productID,'product_id');
				if($prow['product_url1']){
					$imgName = substr($prow['product_url1'], strrpos($prow['product_url1'], '/')+1);
					if(in_array(strtolower($imgName),$allowImageType)){
						ob_start();
						readfile($prow['product_url1']);
						$img = ob_get_contents();
						ob_end_clean();
						$attachmentRow = array('product_id'=>$productID,'pa_file_type'=>'link','pa_path'=>$prow['product_url1'],'pa_content'=>base64_encode($img),"pa_name"=>$imgName,'pa_type'=>1);
						Service_ProductAttached::add($attachmentRow);
					}
				}
				if($prow['product_url2']){
					$imgName = substr($prow['product_url2'], strrpos($prow['product_url2'], '/')+1);
					if(in_array(strtolower($imgName),$allowImageType)){
						ob_start();
						readfile($prow['product_url2']);
						$img = ob_get_contents();
						ob_end_clean();
						$attachmentRow = array('product_id'=>$productID,'pa_file_type'=>'link','pa_path'=>$prow['product_url2'],'pa_content'=>base64_encode($img),"pa_name"=>$imgName,'pa_type'=>2);
						Service_ProductAttached::add($attachmentRow);	
					}
				}
				if($prow['product_url3']){
					$imgName = substr($prow['product_url3'], strrpos($prow['product_url3'], '/')+1);
					if(in_array(strtolower($imgName),$allowImageType)){
						ob_start();
						readfile($prow['product_url3']);
						$img = ob_get_contents();
						ob_end_clean();
						$attachmentRow = array('product_id'=>$productID,'pa_file_type'=>'link','pa_path'=>$prow['product_url3'],'pa_content'=>base64_encode($img),"pa_name"=>$imgName,'pa_type'=>3);
						Service_ProductAttached::add($attachmentRow);	
					}
				}
				if($prow['product_url4']){
					$imgName = substr($prow['product_url4'], strrpos($prow['product_url4'], '/')+1);
					if(in_array(strtolower($imgName),$allowImageType)){
						ob_start();
						readfile($prow['product_url4']);
						$img = ob_get_contents();
						ob_end_clean();
						$attachmentRow = array('product_id'=>$productID,'pa_file_type'=>'link','pa_path'=>$prow['product_url4'],'pa_content'=>base64_encode($img),"pa_name"=>$imgName,'pa_type'=>4);
						Service_ProductAttached::add($attachmentRow);	
					}
				}
				$DB->commit();
			}catch(  Zend_Exception  $exe ){			
				$prow['error'][] = $exe->getMessage();
				$DB->rollBack();									
				continue;
			}	
			$prow['error'][] = Ec_Lang::getInstance()->getTranslate('add_product_success');
		}
		$result = array("ask"=>'1','data'=>$selectedData);
		$this->view->result=$result;	
		if($productUpload){unset($productUpload->uploadData);}
		echo Ec::renderTpl($this->tplDirectory . "batch-product-import.tpl",'noleftlayout');
		
	}
	
	
	/**
	 * @author colin-yang
	 * @todo 读取EXCEL文件数据  
	 */
	public static function getXLSData($uploadFile,$field){
		set_time_limit(300);
		ini_set('memory_limit','1024M');	
		//echo ini_get('memory_limit');exit;
		$customerAuth = new Zend_Session_Namespace("customerAuth");
		
		$customer	= $customerAuth->data;
		$customerId = $customer['id'];
		//print_r($customer);
		//exit('sss');
		$path = APPLICATION_PATH.'/../data/productbatchupload/';
		$path.= $customerId;
		if(!file_exists($path)){
			if(!mkdir($path,0700,true)){
				$result = array("ask"=>0,"message"=>"上传文件失败失败",'error'=>array('上传目录不存在创建文件目录失败'));
				return $result;
			}
		}		
		$config = array();
		$config['upload_path']		= $path;
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= '5250000';
		$config['encrypt_name']		= true;		
		$upload	= new Common_UploadFile($config);
		$upload->set_upload_path($path);		
		if (!$upload->do_upload($_FILES,$field) ){
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
		
		if($resultArray['file_ext'] =='.xls' || $resultArray['file_ext'] =='.xlsx'){		
				$resultArray = Common_Upload::readEXCEL($full_path);		
		}
		
		if($resultArray['file_ext'] =='.csv'){		
				$resultArray = Common_Upload::readCSV($full_path);		
		}
		@unlink($full_path);
		return $resultArray;
	}	
	
	
	/**
	 * @author colin yang
	 * @todo 检查输入数据格式
	 */	
	private function  _getDataArr($productRow){		
		$found_product_results = array();
		$sku_array = array();
		foreach($productRow as $key=>$row){		
			if($key<1){continue;} 
			
			$errorArray = array();
				
			$productsku = trim($row[0]);
			$product_barcode_type_name = $row[6];
			$bar_code = trim($row[7]);
						 
			if(empty($productsku)){continue;}
							
			$product_length =  $row[8];
			$product_width = $row[9];
			$product_height = $row[10];
			
			$currency_code = $row[11];
			$product_declared_value = sprintf("%.2f", $row[12]);	
			$product_weight = sprintf("%.4f", $row[13]);//毛重
			$countryArr = explode(" ", $row[14]);
			$country_title = $countryArr[0];//原产国
			$brand = $row[15];
			$hs_goods_name = $row[16]; //海关品名
			$hs_code = $row[17]; //海关编码
			$is_flash = $row[18]=="是"?"1":"0";
			$product_description = $row[19];
			
			$element = $row[20];	//主要成分
			$barcode = $row[21];	//条码
			$inspection_flag = $row[22]=="法检"?1:0;
			$gift_flag	= $row[23] == "是"?1:0;
			$enterprises_name = $row[24];	//生产企业名称
			$brand_country 	= $row[25];	//品牌原产国
			$brandArr = explode(" ", $brand_country);
			$brand_country = $brandArr[0];
			$standards 	= $row[26]=="国内标准"?1:2;	//适用标准
			$certification 	= $row[27]=="需要"?1:0;	//认证情况
			$supervision_flag 	= $row[28];	//监管类别标志
			$supervisionArr = explode(" ", $supervision_flag);
			$supervision_flag = $supervisionArr[0];
			$food_enterprise_number 	= $row[29];	//境外食品生产企业注册号
			$warning_flag	= $row[30]=="同意"?1:0;
			
			$product_url1 = strip_tags($row[31]);
			$product_url2 = strip_tags($row[32]);
			$product_url3 = strip_tags($row[33]);
			$product_url4 = strip_tags($row[34]);
			//标题行不读
			//print_r($this->_customerAuth);exit;
			
			$product_barcode= $this->_customerAuth['code'].'-'.$productsku;
			$product_title = $row[1];//产品名称
			$product_title_en = $row[2];
			$pc_name = trim($row[4]);//产品类别				
			$customer_id = $this->_customerAuth['id'];	
			$customer_code = $this->_customerAuth['code'];	
			$pu_name = trim($row[5]);//	$pc_id = $row[4]
			$distributor_code = trim($row[3]); // 供应商代码
			$distributor_id = 0; // 供应商ID
			
			$specialCharsPattern_cn = array("！","￥","（","）","【","】","、","；","：","“","”","‘","’","？","《","》","。","…",);
      		$specialCharsPattern    = "/[\\\'\":;?~`!@#$^&=)({}\[\]]/";

			if(empty($pu_name)){ $errorArray[] =  '产品单位不能为空.';}	else{
				$pu_array = Service_ProductUom::getByField($pu_name,"pu_name","*");
				if(empty($pu_array)){ $errorArray[] =  '非法的产品单位.';}	else{
					$pu_code =  (string)$pu_array['pu_code'];
				}	
			}	
			if(empty($currency_code)){
				$errorArray[] =  '申报币种必须填写.';
			}else{
				$currency = Service_Currency::getByField($currency_code,'currency_code');
				if(empty($currency)){
					$errorArray[] =  '申报币种不存在';
				}
			}
			if(empty($pc_name)){ $errorArray[] =  '产品品类不能为空.';}	else{
				$category = Service_ProductCategory::getByField($pc_name,"pc_name","*");
				if(empty($category)){ $errorArray[] =  '非法的产品品类.';}	else{
					$pc_id=  $category['pc_id'];
				}	
			}		       		
			if(empty($product_title)){ $errorArray[] =  '产品标题不能为空';}
			if($product_length){
				$product_length = sprintf("%.2f", $product_length);
				if(!(is_numeric($product_length) && $product_length>0)){ $errorArray[] =  '产品长度必填必为大于0的数';}
			}
			if($product_width){
				$product_width = sprintf("%.2f", $product_width);
				if(!(is_numeric($product_width) && $product_width>0)){ $errorArray[] =  '产品宽度必填必为大于0的数';}
			}
			if($product_height){
				$product_height = sprintf("%.2f", $product_height);
				if(!(is_numeric($product_height) && $product_height>0)){ $errorArray[] =  '产品高度必填必为大于0的数';}				
			}				
			if(!(is_numeric($product_weight) && $product_weight>0)){ $errorArray[] =  '产品毛重必填必为大于0的数';}
			if(!(is_numeric($product_declared_value) && $product_declared_value>0)){ $errorArray[] =  '产品申报价格必须为正的金额';}						 		
			if(in_array($productsku,$sku_array)){ $errorArray[] =  '数据中产品SKU有重复';}
			$sku_array["{$productsku}"] = $productsku;
			$productInfo = Service_Product::getByCondition(array('product_sku'=>$productsku,'customer_id'=>$customer_id));
			if($productInfo){ $errorArray[] =  '产品SKU重复'; }else{											
				if(!preg_match('/^[0-9a-zA-Z\-.]{1,18}$/',$productsku)){
					$errorArray[] = '产品SKU请仅字母、数字和横杠,最大长度为18位.';
				}
			}
			if(empty($hs_goods_name)){
				$errorArray[] =  '海关品名不能为空.';
			}
			if(empty($hs_code) || !preg_match('/^[0-9]{10}$/',$hs_code)){
				$errorArray[] =  '海关编码不能为空,且必须是10位的数字.';
			}else{
				$hs_code_array = Service_Hscodes::getByField($hs_code,'hs_code');
				if(empty($hs_code_array)){
					$errorArray[] =  '非法的海关编码.';
				}
			}
			// 若供应商代码不为空，则验证供应商代码的有效性
			if ('' !== $distributor_code) {
				$distributor = Service_Distributor::getByCode($distributor_code, (int) $this->_customerAuth['id']);
				if (!$distributor) {
				  $errorArray[] = sprintf(Ec_Lang::getInstance()->getTranslate('DistributorCodeInvalid'), $distributor_code);
				}
				else {
				  $distributor_id = $distributor['distributor_id'];
				}
			}
			if(!in_array($product_barcode_type_name,array('自定义类型','默认类型','序列号类型'))){ $errorArray[] =  '条码类型必须指定';}
			switch($product_barcode_type_name)
			{
				case '默认类型':
					$product_barcode_type = 0;
				break;					
				case '自定义类型':
					$product_barcode_type = 1;
				break;
				case '序列号类型':
					$product_barcode_type = 2;
				break;		
				default:
					$product_barcode_type = 0;
			}				
			if($product_barcode_type==1){
				if(empty($bar_code)){
					 $errorArray[] =  '自定义条码类型必须提供条码';
				}else{
					 $product_barcode = $bar_code;
					 if(!preg_match('/^[0-9a-zA-Z\- ]{1,18}$/', $bar_code))
					 {
						$errorArray[] = "自定义条码仅限能输入字母、数字和横杠,最大长度为18位.";						
					 }else{						  
					   $productInfo = Service_Product::getByCondition(array('product_barcode'=>$product_barcode,'customer_id'=>$customer_id));
					   if($productInfo){ $errorArray[] =  '自定义产品条码重复'; }  
					 }
				}
			}									
			if(empty($country_title)){ $errorArray[] =  '原产国不能为空.';}	else{
				$country_array = Service_Country::getByField($country_title,"country_code","*");
				if(empty($country_array)){ $errorArray[] =  '找不到的原产国.';}else{
					if($country_array['trade_country']==''){
					}else{
						$country_code_of_origin = $country_array['country_code'];
					}
				}	
			}
			if(empty($brand)){ $errorArray[] =  '品牌不能为空.'; }else{
				$specialCharsCheck      = preg_match($specialCharsPattern, $brand);
				if($specialCharsCheck){
				  $errorArray[] = '品牌：'.$brand.' 包含特殊字符';
				}
				foreach($specialCharsPattern_cn as $cn_val){
				  $specialCharsCheck_cn   = mb_strstr($brand,$cn_val);
				  if($specialCharsCheck_cn){
				      $errorArray[] = '品牌：'.$brand.' 包含特殊字符';
				  }
				}
				if (!Service_GB18030::isValid($brand)) {
				$errorArray[] = '品牌[' . $brand . ']含有非GB18030字符集字符';
				}       
				$brand	=	preg_replace("/\x{C2A0}/u" , ' ' , $brand);  
			}
			if(empty($element)){ $errorArray[] =  '主要成分不能为空.'; }else{
				$specialCharsCheck      = preg_match($specialCharsPattern, $element);
				if($specialCharsCheck){
				  $errorArray[] = '主要成份：'.$element.' 包含特殊字符';
				}
				foreach($specialCharsPattern_cn as $cn_val){
				  $specialCharsCheck_cn   = mb_strstr($element,$cn_val);
				  if($specialCharsCheck_cn){
				      $errorArray[] = '主要成份：'.$element.' 包含特殊字符';
				  }
				}
				if (!Service_GB18030::isValid($element)) {
				$errorArray[] = '主要成份[' . $element . ']含有非GB18030字符集字符';
				}       
				$element	=	preg_replace("/\x{C2A0}/u" , ' ' , $element);  
			}
			if(empty($enterprises_name)){ $errorArray[] =  '生产企业不能为空.'; }else{
				$specialCharsCheck      = preg_match($specialCharsPattern, $enterprises_name);
				if($specialCharsCheck){
				  $errorArray[] = '生产企业：'.$enterprises_name.' 包含特殊字符';
				}
				foreach($specialCharsPattern_cn as $cn_val){
				  $specialCharsCheck_cn   = mb_strstr($enterprises_name,$cn_val);
				  if($specialCharsCheck_cn){
				      $errorArray[] = '生产企业：'.$enterprises_name.' 包含特殊字符';
				  }
				}
				if (!Service_GB18030::isValid($enterprises_name)) {
				$errorArray[] = '生产企业[' . $enterprises_name . ']含有非GB18030字符集字符';
				}       
				$enterprises_name	=	preg_replace("/\x{C2A0}/u" , ' ' , $enterprises_name);  
			}
			if(empty($brand_country)){ 
				$errorArray[] =  '品牌原产国不能为空.'; 
			}else{
				$countryInfo = Service_Country::getByField($brand_country,"country_code");
				if(empty($countryInfo)){
					$errorArray[] =  '品牌原产国填写错误.'; 
				}
			}
			if(empty($standards)){ $errorArray[] =  '适用标准不能为空.'; }
			if("" === $certification){ $errorArray[] =  '认证情况不能为空.'; }
			if(empty($supervision_flag)){
				$errorArray[] =  '监管类别标志不能为空.'; 
			}else{
				if(!in_array($supervision_flag,array("0101","0102","0201","0202","0203","0204","0205","0206","0301","0401","9999"))){
					$errorArray[] =  '监管类别标志填写错误.';
				}
			}
			
			$product_add_time = $product_update_time = date('Y-m-d H:i:s');
			$product =  array(			 					
				'product_sku'=>$productsku,
				'product_barcode'=>$product_barcode,
				'product_title'=>$product_title,
				'product_title_en'=>$product_title_en,
				'distributor_id' => $distributor_id, // 供应商ID
				'pc_name'=>$pc_name,
				'pc_id'=>$pc_id,								
				'customer_id'=>$customer_id,
				'customer_code'=>$customer_code,
				'pu_name'=>$pu_name,
				'pu_code'=>$pu_code,
				'currency_code'=>$currency_code,								
				'product_barcode_type'=>$product_barcode_type,
				'product_length'=>$product_length,
				'product_width'=>$product_width,
				'product_height'=>$product_height,
				'product_declared_value'=>$product_declared_value,
				'product_weight'=>$product_weight,
				'hs_code'=>$hs_code,
				'hs_goods_name'=>strtoupper($hs_goods_name),
				'product_url'=>$product_url1,
				'product_status'=>2,
				'product_type'=>0,
				'country_code_of_origin'=>$country_code_of_origin,
				'brand'=>$brand,
				'is_flash'=>$is_flash,
				'product_description'=>$product_description,
				'country_title'=>$country_title,
				'element'	=> $element,
				'barcode'	=> $barcode,
				'inspection_flag'=>$inspection_flag,
				'gift_flag'	=> $gift_flag,
				'enterprises_name'=>$enterprises_name,
				'standards'=>$standards,
				'certification'=>$certification,
				'supervision_flag'=>$supervision_flag,
				'brand_country'=>$brand_country,
				'food_enterprise_number'=>$food_enterprise_number,
				'warning_flag'=>$warning_flag,
				'product_url1'=>$product_url1,
				'product_url2'=>$product_url2,
				'product_url3'=>$product_url3,
				'product_url4'=>$product_url4,
				'product_add_time'=>$product_add_time,
				'product_update_time'=>$product_update_time,								
				'is_valid'=>1,		 					
				'error'=>$errorArray,
				'error_number'=>count($errorArray)
			);			
			if(count($errorArray)>0){ $product['is_valid']=0;}				 			
			$found_product_results[] = $product;
		}
		return $found_product_results;
	
	}		
	
	
}