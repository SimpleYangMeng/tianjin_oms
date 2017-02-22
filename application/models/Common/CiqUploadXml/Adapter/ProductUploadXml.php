<?php
/**
* 产品生成 XML 
*/
class ProductUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    //接口代码 Product->产品备案
    protected $apiCode = 'Product';
	
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
    	$productInfo = Service_Product::getByField($itemRow['ref_id'] , 'product_id');
    	if(empty($productInfo)){
            $this->_error[] = "商品ID[{$itemRow['refer_code']}]不存在";
            return false;
        }
        $genArrayData	= array();
        //电商企业
		$customerInfo	= Service_Customer::getByField($productInfo['customer_code'], 'customer_code', array('ciq_reg_num', 'ins_unit_code'));
		if(empty($customerInfo)){
			$this->_error[] = "商品ID[{$itemRow['refer_code']}]电商企业[{$productInfo['customer_code']}]不存在";
            return false;
		}
		//仓储企业
		$storageCustomerInfo = Service_Customer::getByField($productInfo['storage_customer_code'], 'customer_code');
		if(empty($storageCustomerInfo)){
			$this->_error[] = "商品ID[{$itemRow['refer_code']}]仓储企业[{$productInfo['storage_customer_code']}]不存在";
            return false;
		}
		//属地检验检疫机构代码
        $this->_insUnitCode = $productInfo['ins_unit_code'];
        
		$productAttached= Service_ProductAttached::getByCondition(array('product_id'=>$itemRow['ref_id']));
		if(!empty($productInfo['country_code_of_origin'])){
			$countryInfo = Service_Country::getByField($productInfo['country_code_of_origin'], 'country_code');
			if(empty($countryInfo['b_bbd_country_code'])){
				$this->_error[] = "商品ID[{$itemRow['refer_code']}]原产国编码[{$productInfo['country_code_of_origin']}]检验检疫编码为空";
            	return false;
			}
		}else {
			$this->_error[] = "商品ID[{$itemRow['refer_code']}]原产国编码为空";
            return false;
		}
		$productArray	= array(
			'GOODS_SERIAL_NO'	=> $itemRow['ref_id'],
			'ENT_CODE'			=> $customerInfo['ciq_reg_num'],		//企业备案号
			'DECL_ENT_CODE'		=> $storageCustomerInfo['ciq_reg_num'],	//申报单位代码
			'GOODS_CATEGORIES'	=> $productInfo['goods_categories'],	//商品大类
			'IE_FLAG'			=> $productInfo['ie_type'],				//进出口标志
			'APPLY_TIME'		=> date('YmdHis'),
			'HSCODE'			=> $productInfo['hs_code'],
			'GOODS_SKU_NO'		=> $productInfo['product_sku'],
			'GOODS_NAME'		=> $productInfo['product_title'],
			'MASTER_BASE'		=> $productInfo['element'],
			'SPEC'				=> $productInfo['product_model'],
			'ORIGIN_COUNTRY'	=> $countryInfo['b_bbd_country_code'],
			'PRO_ENT'			=> $productInfo['enterprises_name'],		//生产企业
			'BRAND'				=> $productInfo['brand'],					//产品品牌
			'SUPPLIER'			=> $productInfo['supplier'],				//供应商
			'QTY_UNIT_CODE'		=> $productInfo['pu_code'],					//包装单位代码
			'SMALL_QTY_UNIT_CODE'	=> $productInfo['pu_code'],				//最小包装单位代码
			'USE_WAY'			=> $productInfo['use_way'],					//用途
			'ACCORD_WITH' => ( !empty($productInfo['is_law_regulation']) && $productInfo['is_law_regulation'] == 1 ) ? 'Y' : 'N' ,	//是否符合我国法律法规和标准要求的申明
		);
		$productAttachment = array();
		foreach($productAttached as $key=>$val){
			$productAttachment[$key]['BIZ_TYPE']	= 2;
			$productAttachment[$key]['ANNEX_NAME']	= $val['pa_name'];
			$productAttachment[$key]['ANNEX_CONTENT']	= $val['pa_content'];
			$productAttachment[$key]['ANNEX_TYPE']	= $val['pa_type'];
			$productAttachment[$key]['REMARK']	= '';
		}
		$prductArr = array(
			'GoodsRegDocument'	=> array(
				'GoodsRegHead'	=> $productArray,
				'GoodsRegAnnexList'=> array(
					'GoodsRegAnnexListInformation' => $productAttachment,
				)
			)
		);
		
		// echo '<pre>';
		// print_r($prductArr);
		// return false;
	
        return $prductArr;
    }
}
