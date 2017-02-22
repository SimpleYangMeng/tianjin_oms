<?php
class Service_Hscodes
{
    /**
     * @var null
     */
    public static $_modelClass = null;
	
    public static $productType = array(
    		0=>'普通产品',
    		1=>'组合产品',
    );
    
    /**
     * @return Table_Product|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Hscodes();
        }
        return self::$_modelClass;
    }

    /**
     * @param $row
     * @return mixed
     */
    public static function add($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "product_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }
    
    public static function customUpdate($data, $condition, $value = '')
    {
    	$model = self::getModelInstance();
    	return $model->customUpdate($data, $condition, $value);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "product_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'product_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        $model = self::getModelInstance();
        return $model->getAll();
    }
    //获取产品封面图片链接
    public static function getProductSingleImageUrl($productId){
    	return "http://".$_SERVER['HTTP_HOST']."/merchant/product/view-image/id/".$productId;
    }
    //获取attach图片链接
    public static function getAttachUrlByAid($aid){
    	return "http://".$_SERVER['HTTP_HOST']."/merchant/product/view-attach/aid/".$aid;
    }
    //获取上传时的图片链接
    public static function getUploadUrlByName($fileName){
    	return "http://".$_SERVER['HTTP_HOST']."/merchant/product/view-upload-image/fileName/".$fileName;
    }
    /**
     * @author william-fan
     * @todo 用于得到订单信息
     */
	public static function getProductAllInfo($productId,$customerId){
        $product = Service_Product::getByField($productId, 'product_id');
        if ($product&&$product['customer_id']==$customerId) {
            if ($product['product_type'] == 1) {
                $combines = Service_ProductCombineRelation::getByCondition(array(
                        'product_id' => $productId
                ), "*");
                $subs = array();
                foreach ($combines as $v) {
                    $sub = Service_Product::getByField($v['pcr_product_id'], 'product_id');
                    $v['pcr_product_sku'] = $sub['product_sku'];
                    $subs[] = $v;
                }
                $product['subs'] = $subs;
            }
            if ($product['product_type'] == 0) {
                $con = array(
                        'product_id' => $productId
                );
                $attaches = Service_ProductAttached::getByCondition($con);
                foreach ($attaches as $key => $attach) {
                    if ($attach['pa_file_type'] == 'img') {
                        $attaches[$key]['url'] = self::getAttachUrlByAid($attach['pa_id']);
                    } else {
                        $attaches[$key]['url'] = $attach['pa_path'];
                    }
                }
                $product['attach'] = $attaches;
                if($product['pc_id']){
                    $category = Common_DataCache::getCategory($product['pc_id']);                    
                }
                
                //获取hs_element_map
                $conHs = array(
                	'product_id'=>$productId
                );
                $hsElementMaps = Service_HsElementMap::getByCondition($con);
                if(!empty($hsElementMaps)){
                	foreach ($hsElementMaps as $hsm=>$valuehsm){
                		$hselement = Service_HsElement::getByField($valuehsm['he_id']);
                		//print_r($hselement);
                		$hsElementMaps[$hsm]['hs_code'] = $hselement['hs_code'];
                		$hsElementMaps[$hsm]['he_name'] = $hselement['he_name'];
                	}
                }
                $product['hs_element_maps'] = $hsElementMaps;
                
                //获取hs_uom_map
                $conditonUomMap = array(
                	'product_id'=>$productId		
                ); 
                $hsUomMaps = Service_HsUomMap::getByCondition($conditonUomMap);
                $hsUomMap = '';
                if(!empty($hsElementMaps)){
                	$hsUomMap = $hsUomMaps[0];
                	$hsUom = Service_HsUom::getByField($hsUomMap['hu_id']);
                	
                	$puLaw = Service_ProductUom::getByField($hsUom['pu_code_law'],'pu_code');
                	
                	if($hsUom['pu_code_second']!=''){
                		$puSecond = Service_ProductUom::getByField($hsUom['pu_code_second'],'pu_code');
                		$hsUomMap['pu_name_second'] = $puSecond['pu_name'];
                	}
                	
                	$hsUomMap['pu_name_law'] = $puLaw['pu_name'];

                }
                $product['hs_uom_map'] = $hsUomMap;
                
            }                       
            $product['category_name'] = empty($category) ? "--" : $category['pc_name'];
            if ($product['product_type'] == 2) {                
                $attrRow = Service_ProductAttribute::getByField($productId, 'product_id');
                // print_r($attrRow);exit;
                $product['ext'] = unserialize($attrRow['pa_value']);
            }
            $product['product_status_cn'] = $product['product_status'] == 1 ? "可用" : "不可用";
            $product['product_type_title'] = self::$productType[$product['product_type']];
            
            return $product;
        }
        return false;
    }
    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public static function getByCondition($condition = array(), $field = '*', $order = '', $pageSize = 20, $page = 0)
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $field, $order, $pageSize, $page);
    }

    /**
     * @param $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();
        
        return  Common_Validator::formValidator($validateArr);
    }

    /**
     * 获取自定义SQL语句查询结果
     *
     * @access	public
     * @param   string	($field		待返回的字段，默认为所有)
     * @param   string	($condition	查询条件)
     * @param	mixed	($value		待转换查询字段值)
     * @return	mixed
     */
    public static function getCustomQuery($field = '*', $condition = '', $value = '')
    {
    	$model = self::getModelInstance();
    	return $model->getCustomQuery($field, $condition, $value);
    }
    /**
     * @author william-fan
     * @todo检查订单有效性
     */
    public static function validate($row,$customer_code){
    	$error = array();
    	if("" == $row['product_sku']){
    		$error[] = Ec_Lang::getInstance()->getTranslate('ProductSKU').Ec_Lang::getInstance()->getTranslate('require');//"产品sku必填";
    	}elseif (!preg_match('/^[0-9a-zA-Z\-]{1,12}$/', $row['product_sku'])){
    		$error[] = Ec_Lang::getInstance()->getTranslate('ProductSkuRequiredMustBeAlphanumericCharactersAndUnderscores');//"产品sku必填必须是字母数字下划线";
    	}
    	if($row['product_title']==''){
    		$error[] = Ec_Lang::getInstance()->getTranslate('productTitle').Ec_Lang::getInstance()->getTranslate('require');//'产品名称必须填写';
    	}
    	if($row['pu_code']==''){
    		$error[] = Ec_Lang::getInstance()->getTranslate('p_unit').Ec_Lang::getInstance()->getTranslate('require');//'产品单位必须填写';
    	}
    	if($row['pc_id']==''){
    		$error[] = Ec_Lang::getInstance()->getTranslate('ProductCategory').Ec_Lang::getInstance()->getTranslate('require');//'产品目录必须填写';
    	}
    	if($row['product_weight']==''){
    		$error[] = Ec_Lang::getInstance()->getTranslate('ProductWeight').Ec_Lang::getInstance()->getTranslate('require');//'产品重量必填';
    	}
    	if(isset($row['hs_element'])){
    		foreach ($row['hs_element'] as $hs=>$vahs){
    			$hscheck=Service_HsElement::getByField($vahs['he_id']);
    			if($vahs['hem_detail']==''){
    				$error[] = "{$hscheck['he_name']}".Ec_Lang::getInstance()->getTranslate('require');
    			}
    		}
    	}
    	if($row['pu_code_law']=='' || $row['pu_code_law']<=0 || !is_numeric($row['pu_code_law']) ){
    		$error[] = Ec_Lang::getInstance()->getTranslate('LegalUnitMustBeGreaterThan0');//'法定单位必须是大于0的数字';
    	}
    	return $error;
    }
    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'product_id',
              'E1'=>'product_sku',
              'E2'=>'product_barcode',
              'E3'=>'customer_code',
              'E4'=>'customer_id',
              'E5'=>'product_title_en',
              'E6'=>'product_title',
              'E7'=>'product_status',
              'E8'=>'product_receive_status',
              'E9'=>'pu_code',
              'E10'=>'product_length',
              'E11'=>'product_width',
              'E12'=>'product_height',
              'E13'=>'product_net_weight',
              'E14'=>'product_weight',
              'E15'=>'product_sales_value',
              'E16'=>'product_purchase_value',
              'E17'=>'product_declared_value',
              'E18'=>'product_is_qc',
              'E19'=>'product_barcode_type',
              'E20'=>'product_type',
              'E21'=>'pc_id',
              'E22'=>'pce_id',
              'E23'=>'product_add_time',
              'E24'=>'product_update_time',
        );
        return $row;
    }
    /* 去除空格 */
    public static function fomatRow($row){
    	foreach($row as $k=>$v){
    		if(!is_array($v)){
    			$row[$k] = trim($v);
    		}else{
    			$row[$k] = ($v);
    		}
    	}
    	return $row;
    }
	/**
	 * @createDate 2013-06-08
	 * @author william
	 * @todo 创建普通产品
	 *  
	 */
	public static function createProductTransaction($row,$customer_code,$picUrlArr=array(),$picLinkArr=array()){	   
	    $result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('ProductCreationFailed'),'actionType'=>'create');
	    $row = self::fomatRow($row);
	    //print_r($row);
	    $error = self::validate($row,$customer_code);
	    if(!empty($error)){
	        $result['error'] = $error;
	        return $result;
	    }
	     
	    $db = Common_Common::getAdapter();
	    $db->beginTransaction();
	    try{
	        $con = array('product_sku'=>$row['product_sku'],'customer_code'=>$customer_code);
	        $products = Service_Product::getByCondition($con,"*",0,0,'',0);
	        if(!empty($products)){
	            throw new Exception("sku已存在");
	        }	      
	        //条形码  
	        $row['product_barcode'] = $row['product_barcode_type']==1?$row['product_barcode']:($customer_code.'-'.$row['product_sku']);

	        if(empty($row['product_barcode'])){
	            throw new Exception("产品条码为空");
	        }
	        $con = array('product_barcode'=>$row['product_barcode']);
	        $product = Service_Product::getByCondition($con,"*");
	        if(!empty($product)){
	            throw new Exception("产品条码已存在");
	        }
	        
	        $row['product_add_time'] = date("Y-m-d H:i:s");
	        $row['product_update_time'] = date("Y-m-d H:i:s");
	        //$row['product_type']=0;

	        $productRow = array(
	        	'product_sku' => $row['product_sku'],
	        	'customer_code'=>$row['customer_code'],
	        	'customer_id' => $row['customer_id'],
	        	'product_title_en' =>$row['product_title_en'],
	        	'product_title' => $row['product_title'],
	        	'pu_code' => $row['pu_code'],
	        	'product_length' =>$row['product_length'],
	        	'product_width' =>$row['product_width'],
	        	'product_height' =>$row['product_height'],
	        	'product_weight' => $row['product_weight'],
	        	'product_sales_value' =>$row['product_sales_value'],
	        	'product_purchase_value' =>$row['product_purchase_value'],
	        	'product_declared_value' =>$row['product_declared_value'],
	        	'product_barcode_type' =>$row['product_barcode_type'],
	        	'product_type' =>$row['product_type'], 
	        	'pc_id' =>$row['pc_id'],
	        	'product_add_time' =>$row['product_add_time'],
	        	'product_barcode' =>$row['product_barcode'],
	        	'hs_code'		  =>$row['hs_code'],	
	        );
	        
	        
	        if(!$productId = Service_Product::add($productRow)){
	            throw new Exception("插入产品出错");
	        }
	        $row['product_id'] = $productId;
	        
	        //添加hs_element_map
	        if(isset($row['hs_element'])){
	        	$hs_elements=$row['hs_element'];
	        	if(!empty($hs_elements)){
	        		foreach($hs_elements as $hsk=>$hs_element){
	        			$hscheck=Service_HsElement::getByField($hs_element['he_id']);
	        			if(!empty($hscheck) && $hscheck['hs_code']==$row['hs_code']){
	        				$hsElementMapRow = array(
	        					'he_id'=>$hs_element['he_id'],
	        					'product_id'=>$productId,
	        					'hem_detail'=>$hs_element['hem_detail'],
	        					'hem_add_time'=>date('Y-m-d H:i:s',time())			
	        				);
	        				//print_r($hsElementMapRow);
	        				if(!Service_HsElementMap::add($hsElementMapRow)){
	        					throw new Exception("插入海关编码与产品关系出错");
	        				}
	        			}else{
	        				throw new Exception("海关编码不存在或者错误--{$hs_element['he_id']}");
	        			}
	        		}
	        	}
	        }
	        
	        //添加hs_uom_map
	        if(isset($row['hu_id'])){
	        	$huCheck = Service_HsUom::getByField($row['hu_id']);
	        	if(!empty($huCheck) && $huCheck['hs_code']==$row['hs_code']){
	        		$hsUomMapLawRow = array(
	        			'hu_id'=>$row['hu_id'],
	        			'product_id'=>$productId,
	        			'hum_quantity_law'=>$row['pu_code_law'],
	        			'hum_quantity_second'=>$row['pu_code_second'],	
	        			'hum_add_time'=>date('Y-m-d H:i:s',time())		
	        		); 
	        		if(!Service_HsUomMap::add($hsUomMapLawRow)){
	        			throw new Exception("添加海关申报单位和产品关系出错");
	        		}
	        	}else{
	        		throw new Exception("海关申报单位不存在或者出错");
	        	}
	        }	        

	        
	        $customer = Service_Customer::getByField($customer_code,'customer_code');
	        $customerId = $customer['customer_id'];
	        /* var_dump($customer);
	        var_dump($customer_code);
	         $db->rollback();
	        exit; */
	        Service_ProductAttached::addLink($picLinkArr, $productId);
	        Service_ProductAttached::copyImages($picUrlArr, $customerId, $productId);
	        
	        //料件号
	        $uProduct['goods_id'] = 'BH'.str_pad($productId, 8, '0', STR_PAD_LEFT);
	        Service_Product::update($uProduct, $productId);

	        $logRow = array(
	                'product_id' => $productId,
	                'pl_type'=>'0',
	                'customer_id'=>$customerId,
	                'pl_add_time'=>date("Y-m-d H:i:s"),
	        		'pl_statu_pre'=>'1',
	        		'pl_statu_now'=>'1',
	                'pl_note'=>'ProductSku:['.$row['product_sku'].'] Create',
	                'pl_ip'=>Common_Common::getIP(),
	        );
	        //             print_r($logRow);exit;
	        //self::writeOrderLog($logRow);
	        
	        if(!Service_ProductLog::add($logRow)){
	        	throw new Exception("添加日志错误");
	        }
	        
	        
	        /*  $row['c_app_type'] = 0;
	        $row['c_code'] = $row['product_barcode']; */
	        //self::dataToWarehouse($row);
	        $result['productId'] = $productId;
	        $db->commit();
	        //$db->rollback();
	        $result['ask'] = 1;
	        $result['message'] = "产品创建成功";
	    }catch(Exception $e){
	        $db->rollback();
	        $result['errorCode'] = $e->getCode();
	        $result['message'] = $e->getMessage();
	        $result['error'] = array();
	    }
	    return $result;
	}
	/**
	 * @todo 获取图片
	 */
	private static function getOldAttach($productId){
		$con = array('product_id'=>$productId);
		$productAttachRows = Service_ProductAttached::getByCondition($con);
		 
		return $productAttachRows;
	}
	/**
	 * @param unknown_type $productAttachRows
	 * @todo 删除图片
	 */
	private static function deleteOldAttach($productAttachRows){
		// 	            删除图片
		foreach($productAttachRows as $row){
			if($row['pa_file_type']=='img'){
				@unlink(APPLICATION_PATH."/../data/images/".$row['pa_path']);
			}
			if(!Service_ProductAttached::delete($row['pa_id'],'pa_id')){
				throw new Exception("内部错误!删除图片失败");
			}
		}
	}
    /* 更新普通产品 */
	public static function updateProductTransaction($row,$productId,$customerId,$picUrlArr=array(),$picLinkArr=array()){	  
	    $result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('EcProductModify').Ec_Lang::getInstance()->getTranslate('fail'),"actionType"=>'update');
	    
	    $row = self::fomatRow($row);
	    $error = self::validate($row,$customerId);
	    if(!empty($error)){
	        $result['error'] = $error;
	        return $result;
	    }
	
	    $db = Common_Common::getAdapter();
	    $db->beginTransaction();
	    try{
	        $product = Service_Product::getByField($productId,'product_id');
	        //在什么情况下不可更新 ---------------------------------------占位
	        if($product['customer_id']!=$customerId){//非本人不能更新
	        	//无权限
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('EcProductModify').Ec_Lang::getInstance()->getTranslate('fail').",".Ec_Lang::getInstance()->getTranslate('NoAuthority'));
	        }
	        if($product['product_receive_status'] >0){//第一次收货 之后 不可更新
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('UpdateProductFailProductMustNotNoASN'));
	        }
	        if($product['have_asn']=='1'){
	        	throw new Exception(Ec_Lang::getInstance()->getTranslate('UpdateProductFailProductMustNotNoASN'));
	        }
	        $customer = Service_Customer::getByField($customerId);
	        $customer_code = $customer['customer_code'];
	        
	        //条形码
	        //$row['product_barcode'] = $row['product_barcode_type']==1?$row['product_barcode']:($customerId.'-'.$product['product_sku']);
	        $row['product_barcode'] = $row['product_barcode_type']==1?$row['product_barcode']:($customer_code.'-'.$row['product_sku']);
	        

	        if(isset($row['product_sku'])){
	        	//unset($row['product_sku']);
	        }
	        if(isset($row['product_id'])){
	        	//unset($row['product_id']);
	        }
	        
	        
	        if(empty($row['product_barcode'])){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('ProductBarcodeIsEmpty'));
	        }
	        $con = array('product_barcode'=>$row['product_barcode']);
	        $products = Service_Product::getByCondition($con,"*");
	       
	        if(!empty($products)){
	            $products = $products[0];
	            if($products['product_id']!=$productId){
	                throw new Exception(Ec_Lang::getInstance()->getTranslate('ProductBarcodeIsExist'));	                
	            }
	        }
	        
	        $row['product_update_time'] = date("Y-m-d H:i:s");

	        
	        $productRow = array(
	        		'customer_code'=>$row['customer_code'],
	        		'customer_id' => $row['customer_id'],
	        		'product_title_en' =>$row['product_title_en'],
	        		'product_title' => $row['product_title'],
	        		'pu_code' => $row['pu_code'],
	        		'product_length' =>$row['product_length'],
	        		'product_width' =>$row['product_width'],
	        		'product_height' =>$row['product_height'],
	        		'product_weight' => $row['product_weight'],
	        		'product_sales_value' =>$row['product_sales_value'],
	        		'product_purchase_value' =>$row['product_purchase_value'],
	        		'product_declared_value' =>$row['product_declared_value'],
	        		'product_barcode_type' =>$row['product_barcode_type'],
	        		'product_type' =>$row['product_type'],
	        		'pc_id' =>$row['pc_id'],
	        		'product_update_time' =>$row['product_add_time'],
	        		'product_barcode' =>$row['product_barcode'],
	        		'hs_code'		  =>$row['hs_code'],
	        );
	        
	        if(!Service_Product::update($productRow,$productId)){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('InternalErrorUpdateProductFailure'));
	        }


	        //添加hs_element_map
	        if(isset($row['hs_element'])){
	        	$hs_elements=$row['hs_element'];
	        	if(!empty($hs_elements)){
	        		Service_HsElementMap::delete($productId,'product_id');
	        		foreach($hs_elements as $hsk=>$hs_element){
	        			$hscheck=Service_HsElement::getByField($hs_element['he_id']);
	        			if(!empty($hscheck) && $hscheck['hs_code']==$row['hs_code']){
	        				$hsElementMapRow = array(
	        						'he_id'=>$hs_element['he_id'],
	        						'product_id'=>$productId,
	        						'hem_detail'=>$hs_element['hem_detail'],
	        						'hem_add_time'=>date('Y-m-d H:i:s',time())
	        				);
	        				//print_r($hsElementMapRow);
	        				if(!Service_HsElementMap::add($hsElementMapRow)){
	        					throw new Exception(Ec_Lang::getInstance()->getTranslate('InsertCustomsCodesAndProductRelationshipsError'));
	        				}
	        			}else{
	        				throw new Exception(Ec_Lang::getInstance()->getTranslate('CustomsCodeDoesNotExistOrError')."--{$hs_element['he_id']}");
	        			}
	        		}
	        	}
	        }
	         
	        //添加hs_uom_map
	        if(isset($row['hu_id'])){ 	
	        	Service_HsUomMap::delete($productId,'product_id');
	        	$huCheck = Service_HsUom::getByField($row['hu_id']);
	        	if(!empty($huCheck) && $huCheck['hs_code']==$row['hs_code']){
	        		$hsUomMapLawRow = array(
	        				'hu_id'=>$row['hu_id'],
	        				'product_id'=>$productId,
	        				'hum_quantity_law'=>$row['pu_code_law'],
	        				'hum_quantity_second'=>$row['pu_code_second'],
	        				'hum_add_time'=>date('Y-m-d H:i:s',time())
	        		);
	        		if(!Service_HsUomMap::add($hsUomMapLawRow)){
	        			throw new Exception(Ec_Lang::getInstance()->getTranslate('AddCustomsDeclarationError'));
	        		}
	        	}else{
	        		throw new Exception(Ec_Lang::getInstance()->getTranslate('CustomsReportingUnitDoesNotExistOrError'));
	        	}
	        }
	         
	        
	        
	        $attaches = self::getOldAttach($productId);
	         
	        Service_ProductAttached::addLink($picLinkArr, $productId);
	        Service_ProductAttached::copyImages($picUrlArr, $customerId, $productId);
	         
	        self::deleteOldAttach($attaches);
	        $logRow = array(
	                'product_id' => $productId,
	                'pl_type'=>'0',
	                'customer_id'=>$customerId,
	                'pl_add_time'=>date("Y-m-d H:i:s"),
	                'pl_note'=>'ProductSku:['.$product['product_sku'].'] Content Update',
	                'pl_ip'=>Common_Common::getIP(),
	        );
	        //             print_r($logRow);exit;
	        //self::writeOrderLog($logRow);
	        if(!Service_ProductLog::add($logRow)){
	        	throw new Exception(Ec_Lang::getInstance()->getTranslate('AddLogError'));
	        }
	        //self::dataToWarehouse($row);
	        $db->commit();
	        //$db->rollback();
	        $result['productId'] = $productId;	    
	        $result['ask'] = 1;
	        $result['message'] = Ec_Lang::getInstance()->getTranslate('ProductUpdateSuccess');//"产品更新成功";
	    }catch(Exception $e){
	        $db->rollback();
	        $result['message'] = $e->getMessage();
	        $result['errorCode'] = $e->getCode();
	    }
	    return $result;
	}
	

	public static function validateCombine($row,$customerId){
        $err = array();
        if ("" == $row['product_title']) {
            $err[] = Ec_Lang::getInstance()->getTranslate('pname').Ec_Lang::getInstance()->getTranslate('require'); //"产品名称必填";
        }
        if ("" == $row['product_sku']) {
            $err[] =  Ec_Lang::getInstance()->getTranslate('ProductSKU').Ec_Lang::getInstance()->getTranslate('require');//"产品sku必填";
        }elseif (!preg_match('/^[0-9a-zA-Z\-]{1,12}$/', $row['product_sku'])){
        	$err[] = Ec_Lang::getInstance()->getTranslate('ProductSkuRequiredMustBeAlphanumericCharactersAndUnderscores');//"产品sku只能是数字字母破折号";
        }
        if(!isset($row['subs'])){
            $err[] = Ec_Lang::getInstance()->getTranslate('SubSkuMustChoose');//"子sku必须选择";
        }
        $subs = $row['subs'];
        $sum = 0;
       
        foreach ($subs as $v) {
            $pcr_product_id = $v['product_id'];
            $qty = $v['quantity'];
            $product = Service_Product::getByField($pcr_product_id,'product_id');
            if(!$product){
                $err[] = "Product_id:[{$pcr_product_id}] ".Ec_Lang::getInstance()->getTranslate('DoesNotExist');
                continue;
            }
            if($product['product_type']==1){
                $err[] = Ec_Lang::getInstance()->getTranslate('ProductCanMotBeCombined')."-->[{$product['product_sku']}]";
                continue;
            }
            if ($qty == 0) {               
                $err[] = Ec_Lang::getInstance()->getTranslate('QuantityCanNotBeZero')."-->[{$product['product_sku']}]";
                continue;
            }
        
            $sum += $qty;
        }
        if ($sum < 2) {
            $err[] = Ec_Lang::getInstance()->getTranslate('PleaseSelectAtLeastTwoProducts');//"请至少选择两个产品";
        }
        return $err;
        
    }

	/**
	 * @author william-fan
	 * @todo 用于创建组合产品
	 **/
	public static function createCombineProductTransaction($row,$customerId,$picUrlArr=array(),$picLinkArr=array()){
	    $result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('AddCombinationProductsError'));
	    $row = self::fomatRow($row);

	    $error = self::validateCombine($row,$customerId);	

	    if(!empty($error)){
	        $result['error'] = $error;
	        return $result;
	    }
	
	    $db = Common_Common::getAdapter();
	    $db->beginTransaction();
	    try{
	        $subs = $row['subs'];

	        unset($row['subs']);
	        $con = array('product_sku'=>$row['product_sku'],'customer_id'=>$customerId);
	        $product = Service_Product::getByCondition($con,"*",0,0,'',0);
	        if(!empty($product)){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('TheSkuAlreadyExists'));
	        }
	        
	        $row['product_add_time'] = date("Y-m-d H:i:s");
// 	        $row['product_last_modified'] = date("Y-m-d H:i:s");
	        $row['product_type']=1;
	        $row['product_barcode'] = $customerId.'-'.$row['product_sku'];
// 	        print_r($row);exit;
	        $productId = Service_Product::add($row);
	
	        if(!$productId){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('AddCombinationProductsError'));
	        }
	
	        //创建组合产品
	        $weight = self::createSubsAndCalcuWeight($productId, $subs);

	        if(!Service_Product::update(array('product_weight'=>$weight,'product_update_time'=>date("Y-m-d H:i:s")), $productId)){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('AddCombinationProductsError'));
	        }
	        /*
	        self::addPicture($picUrlArr, $customerId, $productId);
	        self::addLink($picLinkArr, $productId); 
	        */
	        $logRow = array(
	                'product_id' => $productId,
	                'pl_type'=>'0',
	                'customer_id'=>$customerId,
	        		'pl_statu_pre'=>'1',
	        		'pl_statu_now'=>'1',
	                'pl_add_time'=>date("Y-m-d H:i:s"),
	                'pl_note'=>'ProductSku:['.$row['product_sku'].'] Create',
	                'pl_ip'=>Common_Common::getIP(),
	        );
	        //             print_r($logRow);exit;
	        //self::writeOrderLog($logRow);
	        if(!Service_ProductLog::add($logRow)){
	        	throw new Exception(Ec_Lang::getInstance()->getTranslate('AddLogError'));
	        }
	         
	        $result['productId'] = $productId;	        
	        $db->commit();
	        //$db->rollback();
	        $result['ask'] = 1;
	        $result['message'] = Ec_Lang::getInstance()->getTranslate('AddCombinationProductsSuccessful');//"添加组合产品成功";
	    }catch(Exception $e){
	        $db->rollback();
	        $result['message'] = $e->getMessage();
	        $result['errorCode'] = $e->getCode();
	    }
	    return $result;
	}
	
    /* 更新组合产品 */
	public static function updateCombineProductTransaction($row,$customerId,$productId,$picUrlArr=array(),$picLinkArr=array()){
	    $result = array("ask"=>0,"message"=>Ec_Lang::getInstance()->getTranslate('UpdateProductFails'));
	    
	    $row = self::fomatRow($row);
	    $error = self::validateCombine($row,$customerId);
	    
	    if(!empty($error)){
	        $result['error'] = $error;
	        return $result;
	    }
	    
	    $db = Common_Common::getAdapter();
	    $db->beginTransaction();
	    $result = array("ask"=>0,"message"=>"");
	    try{
	        $subs = $row['subs'];
	        unset($row['subs']);
	        $product = Service_Product::getByField($productId,'product_id');
	        if(empty($product)){
	            throw new Exception("Product Not Exists",'10028');
	        }	       
	        if($product['customer_id']!=$customerId){//非本人不能更新
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('UpdateProductFailsAuthorityError'));
	        }
	        //需要判断 组合产品 在什么情况下 不可更新-----------------------占位
	        $orderProduct = Service_OrderProduct::getByField($productId, 'product_id');//存在相关订单 不可更新
	        if(!empty($orderProduct)){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('UpdateProductFailedProductsAlreadyExistOrders')."-->{$product['product_sku']}");
	        }
	        
	        if(isset($row['product_sku'])){
	            unset($row['product_sku']);
	        }        
	        if(isset($row['product_id'])){
	            unset($row['product_id']);
	        }      
	        if(isset($row['customer_id'])){
	            unset($row['customer_id']);
	        }

	        $row['product_update_time'] = date("Y-m-d H:i:s");
	       
	        
	        //创建组合产品
	        $weight = self::createSubsAndCalcuWeight($productId, $subs);
	        
	        $row['product_weight'] = $weight;
	        
	        if(!Service_Product::update($row,$productId)){
	            throw new Exception(Ec_Lang::getInstance()->getTranslate('InternalErrorUpdateProductFailure'));
	        }
	        
	   /*      $attaches = self::getOldAttach($productId);
	        
	        self::addLink($picLinkArr, $productId);
	        self::addPicture($picUrlArr, $customerId, $productId);
	        
	        self::deleteOldAttach($attaches); */

	        $logRow = array(
	                'product_id' => $productId,
	                'pl_type'=>'0',
	                'customer_id'=>$customerId,
	                'pl_add_time'=>date("Y-m-d H:i:s"),
	                'pl_note'=>'ProductSku:['.$product['product_sku'].'] Content Update',
	                'pl_ip'=>Common_Common::getIP(),
	        );
	        //             print_r($logRow);exit;
	        //self::writeOrderLog($logRow);
	        if(!Service_ProductLog::add($logRow)){
	        	throw new Exception(Ec_Lang::getInstance()->getTranslate('AddLogError'));
	        } 
	        $db->commit();
	        $result['productId'] = $productId;	    
	        $result['ask'] = 1;
	        $result['message'] = "Product Update Success";
	    }catch(Exception $e){
	        $db->rollback();
	        $result['message'] = $e->getMessage();
	        $result['errorCode'] = $e->getCode();
	    }
	    return $result;
	}
	/**
	 * @author william-fan
	 * @todo 组合产品重量
	 */
	private static function createSubsAndCalcuWeight($productId,$subs){
		Service_ProductCombineRelation::delete($productId,'product_id');
		$weight = 0;
		foreach($subs as $v){
			$pcr_product_id = $v['product_id'];
			$qty = $v['quantity'];
			$subrow = array("product_id"=>$productId,"pcr_product_id"=>$pcr_product_id,"pcr_quantity"=>$qty,'pcr_add_time'=>date('Y-m-d H:i:s',time()));
			$temP = Service_Product::getByField($pcr_product_id,'product_id');
			if($temP['product_type']==1){//判断为组合产品，爆出异常
				throw new Exception("不能选择组合产品进行组合-->[".$temP['product_sku']."]");
			}
			$weight+=$temP['product_weight']*$qty;
			 
			if(!Service_ProductCombineRelation::add($subrow)){
				throw new Exception('添加组合产品失败');
			}
		}
		 
		return $weight;
	}
	
}