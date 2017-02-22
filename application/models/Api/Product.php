<?php
/* @desc 产品接口
 *
 */
class Api_Product extends Api_Web
{

    protected $fields = null;

    public function __construct($paramString = '')
    {
        parent::__construct($paramString);
        $this->setFields();
    }

    protected function setFields()
    {
        $this->fields = array(
            'registerId'      => 'registerID',
            'ieType'          => 'ie_type',
            'iePort'    	  => 'customs_code',
            'insUnitCode'     => 'ins_unit_code',
            'hsCode'          => 'hs_code',
            'productName'     => 'product_title',
            'brand'           => 'brand',
            'productModel'    => 'product_model',
            'legalUnit'       => 'g_unit',
            'legalUnit2'      => 'second_unit',
            'declPrice'       => 'product_declared_value',
            'originCountry'   => 'country_code_of_origin',
            'currencyCode'    => 'currency_code',
            'taxCode'         => 'gt_code',
            'taxName'         => 'tax_name',
            'giftFlag'        => 'gift_flag',
            'ebpCode'         => 'customer_code',
            'ebpName'         => 'enp_name',
            'agentCode'       => 'storage_customer_code',
            'agentName'       => 'storage_enp_name',
            'appTime'         => 'app_time', //这个字段没用到
            'netWeight'       => 'product_net_weight',
            'grossWeight'     => 'product_weight',
            'barCode'         => 'product_barcode',
            'notes'           => 'product_description',
            'goodsCategories' => 'goods_categories',
            'itemNo'          => 'product_sku',
            'masterBase'      => 'element',
            'productionCompany' => 'enterprises_name',
            'supplier'        => 'supplier',
            'unit'        	  => 'pu_code',
            'useWay'          => 'use_way',
            'isLawRegulation' => 'is_law_regulation',
			'hsName' 		  => 'hs_name',
        );
    }

    public function getFieldText()
    {
        return array(
            'product_id'                => '产品ID',
            'product_sku'               => '商品货号',
            'ie_type'                   => '进出口类型',
            'customer_code'             => '电商企业代码',
            'enp_name'                  => '电商企业名称',
            'customer_id'               => '用户ID',
            'ins_unit_code'             => '属地检验检疫机构',
            'storage_customer_code'     => '仓储企业代码',
            'storage_enp_name'          => '仓储企业名称',
            'storage_account_code'      => '仓储企业客户代码',
            'customs_code'              => '主管海关代码',
            'product_barcode'           => '产品条码',
            'product_title_en'          => '产品英文名称',
            'product_title'             => '产品中文名称',
            'product_status'            => '产品状态',
            'product_receive_status'    => '收货状态',
            'hs_code'                   => '商品海关编码',
            'hs_goods_name'             => '海关品名',
            'currency_code'             => '申报币种',
            'pu_code'                   => '申报单位',
            'g_unit'                    => '产品法定单位',
            'second_unit'               => '第二计量单位',
            'product_length'            => '产品长度',
            'product_width'             => '产品宽度',
            'product_height'            => '产品高度',
            'product_net_weight'        => '产品净重',
            'product_weight'            => '产品重量',
            'product_sales_value'       => '产品销售价',
            'product_purchase_value'    => '产品采购价',
            'product_declared_value'    => '产品申报价值',
            'product_type'              => '产品类型',
            'product_add_time'          => '产品添加时间',
            'product_update_time'       => '产品最后更新时间',
            'have_asn'                  => '是否已创建入库单',
            'e_commerce_website_code'   => '电商平台代码',
            'e_commerce_website_name'   => '电商平台名称',
            'country_code_of_origin'    => '原产国编码',
            'applyEnterpriseCode'       => '预归类企业代码',
            'applyEnterprise'           => '预归类企业名称',
            'applyUser'                 => '申请人',
            'parcel_tax'                => '行邮税税率',
            'gt_code'                   => '行邮税号',
            'brand'                     => '产品品牌',
            'product_description'       => '产品备注',
            'distributor_id'            => '',
            'gt_id'                     => '关联行邮税ID',
            'record_status'             => '备案状态',
            'country_code_of_producing' => '生产国',
            'code_ts'                   => 'CCIC物品税号',
            'specifications_and_models' => 'CCIC规格型号',
            'element'                   => 'CCIC主要成分',
            'barcode'                   => 'CICC',
            'inspection_flag'           => 'CICC',
            'gift_flag'                 => '是否是赠品',
            'enterprises_name'          => '生产企业',
            'enterprises_country'       => '供应商国别',
            'standards'                 => '适用标准',
            'certification'             => '认证情况',
            'supervision_flag'          => '监管类别标志',
            'food_enterprise_number'    => '境外食品生产企业注册号',
            'registerID'                => '备案编号',
            'warning_flag'              => '企业风险明示标志',
            'ciq_status'                => '国检审核状态',
            'cmbl_status'               => '招保状态',
            'cicc_create_xml'           => '是否创建报文标志',
            'brand_country'             => '品牌国家',
            'product_model'             => '产品规格',
            'backup_code'               => '海关备案号',
            'inspection_code'           => '商检备案号',
            'element'                   => '主要成分',
            'use_way'                   => '用途',
            'supplier'                  => '供应商',
            'is_law_regulation'         => '是否符合法律法规',
			'hsName' 		  			=> '海关品名',
        );
    }

    public function run()
    {
        $opType = ucfirst($this->_param['opType']);
        // 操作类型
        $process      = new Service_ProductProcess();
        $attachedType = Service_ProductProcess::getCiqAttachedType();
        switch ($opType) {
            case 'Add':
                if (!isset($this->_param['data'])) {
                    $this->_error[] = '缺少[data]参数';
                    return false;
                }
                $productInfoOriginal = $this->_param['data'];
                if (!$productInfoOriginal) {
                    $this->_error[] = '参数[data]必须是JSON格式';
                    return false;
                }
                if (($productInfo = $this->translate($productInfoOriginal)) === false) {
                    return false;
                }
                if (!isset($productInfoOriginal['attachedFile']) || !is_array($productInfoOriginal['attachedFile']) || count($productInfoOriginal['attachedFile']) < 1) {
                    $this->_error[] = '缺乏附件信息';
                    return false;
                }
                foreach ($productInfoOriginal['attachedFile'] as $key => $item) {
                    if (!isset($attachedType[$item['annexType']])) {
                        $this->_error[] = '附件' . ($key + 1) . '类型【' . $item['annexType'] . '】无效';
                    }
                    if ('' === trim($item['annexContent'])) {
                        $this->_error[] = '附件' . ($key + 1) . '内容不能为空';
                    }
                    if ('' === trim($item['annexName'])) {
                        $this->_error[] = '附件' . ($key + 1) . '名称不能为空';
                    }
                }
                if (!empty($this->_error)) {
                    return false;
                }
                $productInfo['attached_message'] = $productInfoOriginal['attachedFile'];
                $productInfo['action']           = 'add';
                $productInfo['account_code']     = $this->_customer['account_code'];
                $result                          = $process->createProductTransaction($productInfo, $this->_customer['account_code'], array(), array(), array(), true);
                // $result['registerID'] =
                break;
            case "Update":
                if (!isset($this->_param['data'])) {
                    $this->_error[] = '参数[data]不存在';
                    return false;
                }
                $productInfoOriginal = $this->_param['data'];
                if (!$productInfoOriginal) {
                    $this->_error[] = '参数[data]必须是JSON格式';
                    return false;
                }
				if(empty($productInfoOriginal['registerId'])){
					$this->_error[] = '商品备案编号必填';
                    return false;
				}
                if (($productInfo = $this->translate($productInfoOriginal)) === false) {
                    return false;
                }
                if (!isset($productInfoOriginal['attachedFile']) || empty($productInfoOriginal['attachedFile'])) {
                    $this->_error[] = '缺乏附件信息';
                    return false;
                }
                $product                  = Service_Product::getByCondition(array('registerID' => $productInfo['registerID'], 'customer_code' => $productInfo['customer_code']));
                if (!$product) {
                    $this->_error[] = '产品不存在';
                    return false;
                }
                if (2 !== (int) $product[0]['product_status']) {
                    $this->_error[] = '当前产品状态不允许更新';
                    return false;
                }
                $productInfo['attached_message'] = $productInfoOriginal['attachedFile'];
                $productInfo['action']           = 'update';
                $productInfo['account_code']     = $this->_customer['account_code'];
                $productInfo['product_id']       = $product[0]['product_id'];
                $result                          = $process->updateProductTransaction($productInfo, $product[0]['product_id'], $this->_customer['account_code'], array(), array(), array(),true);
				$result['registerID']            = $productInfo['registerID'];
                break;
            case 'Get':
                if (!isset($this->_param['data']['registerId'])) {
                    $this->_error[] = '缺少产品ID参数';
                    return false;
                }
                if ($this->_param['data']['registerId'] === '') {
                    $this->_error[] = '产品ID不能为空';
                    return false;
                }
                $fields                   = $this->fields;
                $fields['ciq_status']     = 'ciq_status';
                $fields['customs_status'] = 'customs_status';
                unset($fields['taxName']);
                unset($fields['appTime']);
                //判断用户
                $product = Service_Product::getByCondition(array('registerID' => $this->_param['data']['registerId']));
				if (empty($product)) {
                    $this->_error[] = '产品不存在';
                    return false;
                }
				if ($product[0]['customer_code'] != $this->_customer['customer_code'] && $product[0]['storage_customer_code'] != $this->_customer['customer_code']) {
                    $this->_error[] = '产品不存在';
                    return false;
                }
				$result['registerID'] = $product[0]['registerID'];
                $result['ask']        = 1;
                break;
            default:
                $this->_error[] = '操作类型错误,只能是Add、Update';
                return false;
        }
        if ($result['ask'] == 0) {
            $this->_error = $result['error'];
            return false;
        }
        $this->_success['registerId'] = $result['registerID'];
        switch ($opType) {
            case 'Add':
                $this->_message = '添加产品成功';
                break;
            case 'Update';
                $this->_message = '更新产品成功';
                break;
            case 'Get':
                $this->_success['ciqStatus']    = $product[0]['ciq_status'];
				$this->_success['status']      	= $product[0]['product_status'];
				$this->_success['ciqBackCode']  = $product[0]['inspection_code'];
                $this->_success['customsStatus']= $product[0]['customs_status'];
                break;
        }
        return true;
    }

    /* @desc 验证产品数据正确性
     * @param $params 产品数据
     * @param  $param 原始产品数据
     */
    protected function verification($data, $originalData)
    {
        return $data;
    }

}
