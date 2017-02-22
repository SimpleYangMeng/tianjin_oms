<?php

/**
 * @author luffyzhao
 * @todo 商品新增修改进程
 */
class Service_ProductProcess
{

    private $type = '';
    /**
     * 接口字段对照
     * @var array
     */
    private $interfaceFields = array();

    /**
     * 界面字段对照
     * @var array
     */
    private $webFields = array();

    protected $_errors  = array();
    protected $customer = array(); //电商企业

    /**
     * 构造函数
     * @param string $type 通过什么进来的
     */
    public function __construct($type = 'web')
    {
        $this->type = $type;
    }

    /**
     * @author william-fan
     * @todo 检查商品属性是否合格
     */
    public function validate($row, $customerId)
    {
        $account_code = isset($row['account_code']) ? $row['account_code'] : '';

        if ($account_code === '') {
            $this->_errors[] = '账号不能为空';
        } else {
            $account = Service_Account::getByField($account_code, 'account_code');
            if (empty($account)) {
                $this->_errors[] = '账号不存在';
            } else {
                if ($account['account_level'] != '1') {
                    $this->_errors[] = '不为子账号,不能操作';
                } else {
                    //找到主账号信息
                    $opFather = Service_Customer::getByField($account['customer_code'], 'customer_code');
                    if (empty($opFather)) {
                        $this->_errors[] = '找不到子账号父账号信息';
                    } else {
                        if ($opFather['customer_status'] != '2') {
                            $this->_errors[] = '父账号非正常状态';
                        } else {
                            if ($opFather['customer_code'] != $row['storage_customer_code']) {
                                $this->_errors[] = "申报企业代码:{$row['storage_customer_code']}和备案名称:{$opFather['customer_code']}不一致";
                            }
                            if ($opFather['trade_name'] != $row['storage_enp_name']) {
                                $this->_errors[] = "申报企业名称:{$row['storage_enp_name']}和备案名称:{$opFather['trade_name']}不一致";
                            }
                        }
                    }
                    $row['storage_account_code'] = $row['account_code'];
                    $row['account_name']         = $account['account_name'];
                }
            }
        }
        $customer = null;
        if (!isset($row['customer_code']) || $row['customer_code'] == '') {
            $this->_errors[] = '客户代码必填';
        } else {
            $customer = Service_Customer::getByField($row['customer_code'], 'customer_code'); //电商企业
            if (!empty($customer)) {
                if ($customer['customer_status'] != '2') {
                    $this->_errors[] = "电商企业代码{$row['customer_code']}暂未审核通过";
                }
                if ($customer['is_ecommerce'] != '1') {
                    $this->_errors[] = "电商企业代码{$row['customer_code']}不是电商企业";
                }
                if ($customer['trade_name'] != $row['enp_name']) {
                    $this->_errors[] = "电商企业名称:{$row['enp_name']}和备案名称:{$customer['trade_name']}不一致";
                }
                /*if($customer['ie_type']!=$row['ie_type']){
                $this->_errors [] = "电商企业进出口类型和备案不一致";
                }*/
                $row['customer_id'] = $customer['customer_id'];
                $this->customer     = $customer;
            } else {
                $this->_errors[] = "电商企业代码{$row['customer_code']}不存在";
            }
        }

        if (!isset($row['customs_code']) || $row['customs_code'] == '') {
            $this->_errors[] = '主管海关代码必填'; //
        } else {
            $ieport = Service_IePort::getByField($row['customs_code'], 'ie_port');
            if (empty($ieport)) {
                $this->_errors[] = '主管海关不存在';
            }
        }
		if (1 != $row['gift_flag'] && 0 != $row['gift_flag']) {
            $this->_errors[] = '是否赠品填写错误';
        }
        if (!isset($row['ins_unit_code']) || $row['ins_unit_code'] == '') {
            $this->_errors[] = '属地检验检疫机构必填'; //
        } else {
            $check = Service_Organization::getByField($row['ins_unit_code'], 'organization_code');
            if (empty($check)) {
                $this->_errors[] = '属地检验检疫机构不存在';
            }
            if(isset($opFather['ins_unit_code'])){
                if($opFather['ins_unit_code'] == '120000'){
                    if($row['ins_unit_code'] != $opFather['ins_unit_code']){
                        $this->_errors[] = '商品属地检验检疫机构与企业不符';
                    }
                }else{
                    if($row['ins_unit_code'] != '120000' && $row['ins_unit_code'] != $opFather['ins_unit_code']){
                        $this->_errors[] = '商品属地检验检疫机构与企业不符';
                    }
                }
            }
        }

        if ($row['product_title'] == '') {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('productTitle') . Ec_Lang::getInstance()->getTranslate('require'); // '商品名称必须填写';
        }

        //去掉计量单位
        if (trim($row['pu_code']) === '') {
            $this->_errors[] = '申报单位必填'; // '商品单位必须填写';
        } else {
            $puInfo = Service_ProductUom::getByField($row['pu_code'], 'pu_code');
            if (empty($puInfo)) {
                $this->_errors[] = '申报单位' . $row['pu_code'] . '无效';
            }
        }
        if ($customer && $row['product_barcode'] != '') {
            if (!preg_match('/^[0-9a-zA-Z\- ]{1,18}$/', $row['product_barcode'])) {
                $error[] = Ec_Lang::getInstance()->getTranslate('CustomerizeBarcode_tip');
            } else {
                /*if ($row['action'] == "add") {
                    $productInfo = Service_Product::getByCondition(array(
                        'product_barcode' => $row['product_barcode'],
                        'customer_id'     => $customer['customer_id'],
                    ));
                    if ($productInfo) {
                        $this->_errors[] = '商品条码[' . $row['product_barcode'] . ']重复';
                    }
                } else {
                    $productInfo = Service_Product::getByCondition(array(
                        'product_barcode' => $row['product_barcode'],
                        'customer_id'     => $row['customer_id'],
                        'not_product_id'  => $row['product_id'],
                    ));
                    if ($productInfo) {
                        $this->_errors[] = '商品条码[' . $row['product_barcode'] . ']重复';
                    }
                }*/
            }
        }

        if (empty($row['product_declared_value']) || !is_numeric($row['product_declared_value']) || $row['product_declared_value'] <= 0) {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('Declared_value_must_be_a_positive_amount');
        }

        if (empty($row['product_weight']) || !is_numeric($row['product_weight']) || $row['product_weight'] <= 0) {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('The_weight_must_be_filled_out_and_must_be_positive');
        } else {
            if ($row['product_weight'] < 0.00001) {
                $this->_errors[] = Ec_Lang::getInstance()->getTranslate('roughweight') . Ec_Lang::getInstance()->getTranslate('Support_the_five_decimal_places');
            }
        }
        if (empty($row['product_net_weight']) || !is_numeric($row['product_net_weight']) || $row['product_net_weight'] <= 0) {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('The_net_weight_must_be_filled_out_and_must_be_positive');
        } else {
            if ($row['product_net_weight'] < 0.00001) {
                $this->_errors[] = Ec_Lang::getInstance()->getTranslate('NetWeight') . Ec_Lang::getInstance()->getTranslate('Support_the_five_decimal_places');
            }
        }

        if ($row['product_weight'] < $row['product_net_weight']) {
            $this->_errors[] = '毛重不能小于净重';
        }
        if (!preg_match('/^[0-9]+(.[0-9]{1,4})?$/', $row['product_weight'])) {
            $this->_errors[] = '毛重最多保留小数四位';
        }
        if (!preg_match('/^[0-9]+(.[0-9]{1,4})?$/', $row['product_net_weight'])) {
            $this->_errors[] = '净重最多保留小数四位';
        }
		if (empty($row['hs_name'])) {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('海关品名必填');
        }
        if (empty($row['hs_code'])) {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('海关编码必填');
        } else {
            $hsCode = Service_Hscodes::getByField($row['hs_code'], 'hs_code');
            if (empty($hsCode)) {
                $this->_errors[] = '海关编码不存在';
            } else if ($hsCode['hs_code_status'] == '-1') {
                $this->_errors[] = '海关编码不存在';
            } else {
                $hsUom = Service_HsUom::getByField($row['hs_code'], 'hs_code');
                if (empty($hsUom)) {
                    $this->_errors[] = '海关法定单位不存在';
                } else {
                    /*if($hsUom['hu_status'] == '-1'){
                    $this->_errors[] = '海关法定单位废止';
                    }else{*/
                    if ($hsUom['pu_code_law'] != $row['g_unit']) {
                        $this->_errors[] = '海关编码法定单位和选择的法定单位不一致';
                    }
                    if (empty($hsUom['pu_code_second'])) {
                        if (!empty($row['second_unit'])) {
                            $this->_errors[] = '海关编码第二单位为空';
                        }
                    } else {
                        if ($hsUom['pu_code_second'] != $row['second_unit']) {
                            $this->_errors[] = '海关编码第二单位与选择的第二单位不一致';
                        }
                    }
                    /*}*/
                }
            }
        }
        //var_dump($row ['product_model']);

        if ('' === trim($row['product_sku'])) {
            $this->_errors[] = '商品货号必填';
        } else {
            if (!preg_match('/^[0-9a-zA-Z\- ]{1,50}$/', $row['product_sku'])) {
                $error[] = '商品货号只能为数字、字母、-及空格且不能超50位';
            } else {
                /*if ($row['action'] == "add") {
                    $productInfo = Service_Product::getByCondition(array(
                        'product_sku' => $row['product_sku'],
                        'customer_id' => $customer['customer_id'],
                    ));
                    if ($productInfo) {
                        $this->_errors[] = '商品货号[' . $row['product_sku'] . ']已经存在';
                    }
                } else {
                    $productInfo = Service_Product::getByCondition(array(
                        'product_sku'    => $row['product_sku'],
                        'customer_id'    => $row['customer_id'],
                        'not_product_id' => $row['product_id'],
                    ));
                    if ($productInfo) {
                        $this->_errors[] = '商品货号[' . $row['product_sku'] . ']已经存在';
                    }
                }*/
            }
        }

        if (empty($row['product_model'])) {
            $this->_errors[] = Ec_Lang::getInstance()->getTranslate('规格型号必填');
        }

        $ciqGoodsCategories = self::getCiqGoodsCategories();

        if (!isset($ciqGoodsCategories[$row['goods_categories']])) {
            $this->_errors[] = '不存在商品分类【' . $row['goods_categories'] . '】';
        }

        if ('' === trim($row['element'])) {
            $this->_errors[] = '主要成分必填';
        }

        if ('' == trim($row['use_way'])) {
            $this->_errors[] = '用途必填';
        }else{
			$userWayInfo = Service_SjUseWay::getByField($row['use_way'],'x_code');
			if(empty($userWayInfo)){
				$this->_errors[] = '用途填写错误';
			}
		}
        if ('' === trim($row['enterprises_name'])) {
            $this->_errors[] = '生产企业必填';
        }

        if ('' === trim($row['supplier'])) {
            $this->_errors[] = '供应商必填';
        }

        $currency = Service_Currency::getByField($row['currency_code'], 'currency_code');
        if (empty($currency)) {
            $this->_errors[] = "币种不存在";
        }
        //is_law_regulation
        if (isset($row['is_law_regulation'])) {
            if (!($row['is_law_regulation'] == '0' || $row['is_law_regulation'] == '1')) {
                $this->_errors[] = "是否符合法律法规必须填写";
            }
            /*if ($row['is_law_regulation'] != '1') {
                $this->_errors[] = "是否符合法律法规申明只能为是";
            }*/
        }else {
            $this->_errors[] = "是否符合法律法规申明必填";
        }

        //print_r($row);
        if ($row['ie_type'] == 'I') {
            //进口判断申报币种为RMB
            if ($row['currency_code'] != 'CNY') {
                $this->_errors[] = '进口商品申报币种须为CNY';
            }
            //不用这个判断,暂时去掉
            /*if(!empty($opFather)){
            if($opFather['ie_type']!=$row['ie_type']){
            $this->_errors[] = '申报企业的进出口类型和备案的不一致';
            }
            }*/
			/*
            if (empty($row['gt_code'])) {
                $this->_errors[] = Ec_Lang::getInstance()->getTranslate('行邮税号必填');
            } else {
                $goodsTax = Service_GoodsTax::getByField($row['gt_code'], 'gt_code');
                if (empty($goodsTax)) {
                    $this->_errors[] = '行邮税税号不存在';
                } else {
                    if (!$goodsTax['gt_rate'] > 0) {
                        $this->_errors[] = '行邮税率不存在';
                    } else {
                        $row['gt_id']      = $goodsTax['gt_id'];
                        $row['parcel_tax'] = $goodsTax['gt_rate'];
                    }
                }
            }
			*/
            if (empty($row['country_code_of_origin'])) {
                $this->_errors[] = "原产国不能为空.{$row['country_code_of_origin']}";
            } else {
                $countryInfo = Service_Country::getByField($row['country_code_of_origin'], 'country_code');
                if (empty($countryInfo)) {
                    $this->_errors[] = "原产国填写错误.";
                }
            }
        } elseif ($row['ie_type'] == 'E') {
            //出口判断申报币种为USD
            if ($row['currency_code'] != 'USD') {
                $this->_errors[] = '出口商品申报币种须为USD';
            }
            //不用这个判断,暂时去掉
            /*if(!empty($opFather)){
        if($opFather['ie_type']!=$row['ie_type']){
        $this->_errors[] = '申报企业的进出口类型和备案的不一致';
        }
        }*/
        }else{
            $this->_errors[] = '商品进出口类型只能是I或者E';
        }
        // 中文特殊字符
        $specialCharsPattern_cn = array(
            "！",
            "￥",
            "（",
            "）",
            "【",
            "】",
            "、",
            "；",
            "：",
            "“",
            "”",
            "‘",
            "’",
            "？",
            "《",
            "》",
            "。",
            "…",
        );
        $specialCharsPattern = "/[\\\'\":;?~`!@#$^&=)({}\[\]]/";
        // UNICODE正则表达式：去除\u200b空白字符
        $unicodeSpacePattern = array(
            '/\x{200b}/u',
            '/\x{a0}/u',
        );

        // print_r($row);exit;
        return $row;
    }

    /**
     * @author william-fan
     * @todo 新增商品
     * @return [type] [description]
     */
    public function createProductTransaction($productInfo, $customerCode, $picUrlArr = array(), $picLinkArr = array(), $imageArray = array(), $isInterface = false)
    {
        $result = array(
            "ask"        => 0,
            "message"    => Ec_Lang::getInstance()->getTranslate('ProductCreationFailed'),
            'actionType' => 'create',
        );

        $row = self::fomatRow($productInfo);
        // print_r($row);
        $row = $this->validate($row, $customerCode); //校验错误填上一些附加的商品信息
        if (empty($imageArray) && $isInterface === false) {
            $this->_errors[] = "请上传附件信息";
        }
        if ($isInterface && (!isset($productInfo['attached_message']) || empty($productInfo['attached_message']))) {
            $this->_errors[] = "请上传附件信息";
        }
        if (!empty($this->_errors)) {
            $result['error'] = $this->_errors;
            return $result;
        }
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $row['product_add_time']    = date("Y-m-d H:i:s");
            $row['product_update_time'] = date("Y-m-d H:i:s");

            if ($this->customer['customs_reg_num'] == '') {
                //throw new Exception('企业海关编码为空,无法生成备案号');
            }
            if (strlen($this->customer['customs_reg_num']) != 14) {
                //throw new Exception('电商企业编码不为14位');
            }

            //$registerId = Common_GetNumbers::getCode('productRegisterID',);
            //4位关区代码 + 1位进出口 + 14位电商企业 + 8位流水号 (四位关区去掉)
            //$prefix = $row['ie_type'] . $this->customer['customs_reg_num'];
            $prefix = $row['ie_type'].$this->customer['customer_code'];
            
            $registerId = Common_GetNumbers::getCode('productRegisterID', 8, $prefix, '商品备案');

            $productRow = array(
                'ie_type'                => $row['ie_type'],
                'customer_code'          => $row['customer_code'],
                'customer_id'            => $row['customer_id'],
                'enp_name'               => $row['enp_name'],
                'customs_code'           => $row['customs_code'],
                'ins_unit_code'          => $row['ins_unit_code'],
                'storage_customer_code'  => $row['storage_customer_code'],
                'storage_enp_name'       => $row['storage_enp_name'],
                'storage_account_code'   => $row['storage_account_code'],
                'brand'                  => $row['brand'],
                'product_title'          => $row['product_title'],
                'product_model'          => $row['product_model'],
                'pu_code'                => $row['pu_code'],
                'product_declared_value' => $row['product_declared_value'],
                'currency_code'          => $row['currency_code'],
                'product_weight'         => $row['product_weight'],
                'product_net_weight'     => $row['product_net_weight'],
                'hs_code'                => $row['hs_code'],
                'product_barcode'        => $row['product_barcode'],
                'product_status'         => '0', // 测试阶段暂时初始为草稿状态
                'registerID'             => $registerId,
                'product_add_time'       => $row['product_add_time'],
                'product_update_time'    => $row['product_update_time'],
                'product_description'    => $row['product_description'],
                'brand'                  => $row['brand'],
                'g_unit'                 => $row['g_unit'],
                'second_unit'            => $row['second_unit'],
                'product_sku'            => $row['product_sku'],
                'element'                => $row['element'],
                'use_way'                => $row['use_way'],
                'enterprises_name'       => $row['enterprises_name'],
                'supplier'               => $row['supplier'],
                'goods_categories'       => $row['goods_categories'],
                'is_law_regulation'      => $row['is_law_regulation'],
				'hs_goods_name'			 => $row['hs_name'],
            );
            if ($productRow['ie_type'] == 'I') {
                //$productRow['gt_code']                = $row['gt_code'];
                //$productRow['gt_id']                  = $row['gt_id'];
                $productRow['country_code_of_origin'] = $row['country_code_of_origin'];
                $productRow['parcel_tax']             = $row['parcel_tax'];
            }
            // print_r($productRow);exit;

            if (!$productId = Service_Product::add($productRow)) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('add_product_unsuccessfully'));
            }
            $row['product_id'] = $productId;

            // 新增商品时间节点记录
            Service_ProductTimeline::insert(array(
                'product_id'  => $productId,
                'create_time' => $row['product_add_time'],
            ));

            $attachedType = self::getCiqAttachedType();
            Service_ProductAttached::delete($productId, 'product_id');
            if ($isInterface === false) {
                $linuxTmpPath = APPLICATION_PATH . '/../public';
                $basePath     = APPLICATION_PATH . "/../data/images/{$row['customer_id']}/{$productId}/";
                if (!file_exists($basePath)) {
                    mkdir($basePath, 0777, true);
                }

                foreach ($imageArray as $key => $val) {
                    foreach ($val as $k => $v) {
                        $fileName = basename($linuxTmpPath . $v['path']);
                        if (copy($linuxTmpPath . $v['path'], $basePath . $fileName)) {
                            @unlink($linuxTmpPath . $v['path']); // 复制成功后删掉临时文件
                            $attachmentRow = array(
                                "product_id"     => $productId,
                                "pa_path"        => "/{$row['customer_id']}/{$productId}/{$fileName}",
                                "pa_file_type"   => "img",
                                "pa_status"      => "1",
                                "pa_update_time" => date("Y-m-d H:i:s"),
                                "pa_content"     => base64_encode(file_get_contents($basePath . $fileName)),
                                "pa_name"        => $v['name'],
                                "pa_type"        => $v['type'],
                            );
                            if (!Service_ProductAttached::add($attachmentRow)) {
                                throw new Exception("添加附件信息失败");
                            }
                        } else {
                            throw new Exception("内部错误");
                        }
                    }
                }
            } else {
                // 接口过来的附件信息
                $attachedMessageCount = 0;

                foreach ($productInfo['attached_message'] as $attachedItem) {
                    $attachmentRow = array(
                        "product_id"     => $productId,
                        "pa_path"        => "",
                        "pa_file_type"   => "img",
                        "pa_status"      => "1",
                        "pa_update_time" => date("Y-m-d H:i:s"),
                        "pa_content"     => $attachedItem['annexContent'],
                        "pa_name"        => $attachedItem['annexName'],
                        "pa_remark"      => $attachedItem['remark'],
                        "pa_type"        => $attachedItem['annexType'],
                    );
                    if (!isset($attachedType[$attachedItem['annexType']])) {
                        throw new Exception('不存在附件类型【' . $attachedItem['annexType'] . '】');
                    }
                    if (!Service_ProductAttached::add($attachmentRow)) {
                        throw new Exception("添加附件信息失败");
                    }
                    ++$attachedMessageCount;
                }

                if (!$attachedMessageCount) {
                    throw new Exception('缺乏附件信息');
                }
            }

            $customer   = Service_Customer::getByField($customerCode, 'customer_code');
            $customerId = $customer['customer_id'];
            Service_ProductAttached::addLink($picLinkArr, $productId);
            Service_ProductAttached::copyImages($picUrlArr, $customerId, $productId);

            $logRow = array(
                'product_id'   => $productId,
                'pl_type'      => '0',
                'customer_id'  => $customerId,
                'pl_add_time'  => date("Y-m-d H:i:s"),
                'pl_statu_pre' => '1',
                'pl_statu_now' => '1',
                'pl_note'      => '海关商品备案编号:[' . $registerId . '] 创建成功',
                'pl_ip'        => Common_Common::getIP(),
                'account_name' => $row['account_name'],
            );
            // print_r($logRow);exit;
            // self::writeOrderLog($logRow);

            if (!Service_ProductLog::add($logRow)) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('AddLogError'));
            }
            $result['productId']  = $productId;
            $result['registerID'] = $registerId;
            $db->commit();
            //$db->rollback();
            $result['ask']     = 1;
            $result['message'] = Ec_Lang::getInstance()->getTranslate('add_product_successfully');
        } catch (Exception $e) {
            $db->rollback();
            $result['errorCode'] = $e->getCode();
            $result['message']   = $e->getMessage();
            $result['error']     = array($e->getMessage());
        }
        return $result;
    }

    /**
     *
     * @todo 获取图片
     */
    private static function getOldAttach($productId)
    {
        $con = array(
            'product_id' => $productId,
        );
        $productAttachRows = Service_ProductAttached::getByCondition($con);

        return $productAttachRows;
    }

    /**
     *
     * @param unknown_type $productAttachRows
     * @todo 删除图片
     */
    private static function deleteOldAttach($productAttachRows)
    {
        // 删除图片
        foreach ($productAttachRows as $row) {
            if ($row['pa_file_type'] == 'img') {
                @unlink(APPLICATION_PATH . "/../data/images/" . $row['pa_path']);
            }
            if (!Service_ProductAttached::delete($row['pa_id'], 'pa_id')) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('InternalErrorDeletePictureError')); //
            }
        }
    }

    /**
     * @author william-fan
     * @todo 用于更新商品
     * @row 更新的商品信息
     */
    public function updateProductTransaction($row, $productId, $customerCode, $picUrlArr = array(), $picLinkArr = array(), $imageArray = array(), $isInterface = false)
    {
        $result = array(
            "ask"        => 0,
            "message"    => Ec_Lang::getInstance()->getTranslate('EcProductModify') . Ec_Lang::getInstance()->getTranslate('fail'),
            "actionType" => 'update',
        );
        if (!$productId) {
            $result['message'] = '商品不存在';
            return $result;
        }
        $row = self::fomatRow($row);
        $row = $this->validate($row, $customerCode);
        if (empty($imageArray) && $isInterface === false) {
            $this->_errors[] = "请上传附件信息";
        }
        if ($isInterface && (!isset($productInfo['attached_message']) || empty($productInfo['attached_message']))) {
            $this->_errors[] = "请上传附件信息";
        }
        if (!empty($this->_errors)) {
            $result['error'] = $this->_errors;
            return $result;
        }
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $product = Service_Product::getByField($productId, 'product_id');
            if (empty($product)) {

            }
            // 在什么情况下不可更新 ---------------------------------------占位
            if ($product['storage_account_code'] != $row['storage_account_code']) {
                // 非本人不能更新
                // 无权限
                throw new Exception(Ec_Lang::getInstance()->getTranslate('EcProductModify') . Ec_Lang::getInstance()->getTranslate('fail') . "," . Ec_Lang::getInstance()->getTranslate('NoAuthority'));
            }
            if ($product['product_status'] != '2') {
                throw new Exception("product status error!");
            }
            $customer      = Service_Customer::getByField($customerCode, 'customer_code'); //电商企业
            $customer_code = $customer['customer_code'];

            $datetime = date("Y-m-d H:i:s");

            $productRow = array(
                'customer_code'          => $row['customer_code'],
                'customer_id'            => $row['customer_id'],
                'product_title'          => $row['product_title'],
                'product_model'          => $row['product_model'],
                'pu_code'                => $row['pu_code'],
                'product_declared_value' => $row['product_declared_value'],
                'currency_code'          => $row['currency_code'],
                'product_weight'         => $row['product_weight'],
                'product_net_weight'     => $row['product_net_weight'],
                'product_barcode'        => $row['product_barcode'],
                'product_update_time'    => $datetime,
                'product_description'    => $row['product_description'],
                'brand'                  => $row['brand'],
                'g_unit'                 => $row['g_unit'],
                'second_unit'            => $row['second_unit'],
                'product_sku'            => $row['product_sku'],
                'element'                => $row['element'],
                'use_way'                => $row['use_way'],
                'enterprises_name'       => $row['enterprises_name'],
                'supplier'               => $row['supplier'],
                'goods_categories'       => $row['goods_categories'],
				'hs_goods_name'			 => $row['hs_name'],
            );
            if ($row['ie_type'] == 'I') {
                //$productRow['gt_code']                = $row['gt_code'];
                //$productRow['gt_id']                  = $row['gt_id'];
                $productRow['country_code_of_origin'] = $row['country_code_of_origin'];
                $productRow['parcel_tax']             = $row['parcel_tax'];
            }
            if (!Service_Product::update($productRow, $productId)) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('InternalErrorUpdateProductFailure'));
            }
            if (!$isInterface) {
                $linuxTmpPath = APPLICATION_PATH . '/../public';
                $basePath     = APPLICATION_PATH . "/../data/images/{$row['customer_id']}/{$productId}/";
                if (!file_exists($basePath)) {
                    mkdir($basePath, 0777, true);
                }
                Service_ProductAttached::delete($productId, 'product_id');
                foreach ($imageArray as $key => $val) {
                    foreach ($val as $k => $v) {
                        $fileName = '';
                        if (false === strpos($v, "/images/temp")) {
                            $file     = APPLICATION_PATH . "/../data/images" . $v;
                            $fileName = basename($file);
                        } else {
                            $file     = $linuxTmpPath . $v;
                            $fileName = basename($file);
                            if (!copy($linuxTmpPath . $v, $basePath . $fileName)) {
                                throw new Exception("内部错误");
                            }
                        }
                        $attachmentRow = array(
                            "product_id"     => $productId,
                            "pa_path"        => "/{$row['customer_id']}/{$productId}/{$fileName}",
                            "pa_file_type"   => "img",
                            "pa_status"      => "1",
                            "pa_update_time" => date("Y-m-d H:i:s"),
                            "pa_content"     => base64_encode(file_get_contents($file)),
                            "pa_name"        => $fileName,
                            "pa_type"        => $key,
                        );
                        if (!Service_ProductAttached::add($attachmentRow)) {
                            throw new Exception("添加附件信息失败");
                        }
                    }
                }
            } else {
                // 通过接口过来的附件信息
                $attachedMessageCount = 0;

                foreach ($productInfo['attached_message'] as $attachedItem) {
                    $attachmentRow = array(
                        "product_id"     => $productId,
                        "pa_path"        => "",
                        "pa_file_type"   => "img",
                        "pa_status"      => "1",
                        "pa_update_time" => date("Y-m-d H:i:s"),
                        "pa_content"     => $attachedItem['annexContent'],
                        "pa_name"        => $attachedItem['annexName'],
                        "pa_remark"      => $attachedItem['remark'],
                        "pa_type"        => $attachedItem['annexType'],
                    );
                    if (!Service_ProductAttached::add($attachmentRow)) {
                        throw new Exception("添加附件信息失败");
                    }
                    ++$attachedMessageCount;
                }

                if (!$attachedMessageCount) {
                    throw new Exception('缺乏附件信息');
                }
            }
            $customerId = $customer['customer_id'];
            $logRow     = array(
                'product_id'   => $productId,
                'pl_type'      => '0',
                'customer_id'  => $customerId,
                'pl_add_time'  => date("Y-m-d H:i:s"),
                'pl_note'      => 'registerID:[' . $product['registerID'] . '] Content Update',
                'pl_ip'        => Common_Common::getIP(),
                'account_name' => $row['account_name'],
            );
            if (!Service_ProductLog::add($logRow)) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('AddLogError'));
            }

            //$db->commit ();
            $db->rollback();
            $result['productId']  = $productId;
            $result['registerID'] = $product['registerID'];
            $result['ask']        = 1;
            $result['message']    = Ec_Lang::getInstance()->getTranslate('ProductUpdateSuccess'); // "产品更新成功";
        } catch (Exception $e) {
            $db->rollback();
            $result['message']    = $e->getMessage();
            $result['errorCode']  = $e->getCode();
            $result['error']      = array($e->getMessage());
            $result['registerID'] = $row['registerID'];
        }
        return $result;
    }

    /**
     * 用于参数转换
     * @return [type] [description]
     */
    private function translate($productInfo)
    {

        $info = $fileds = array();
        if ($this->type == 'web') {
            $fileds = $this->webFields;
        } elseif ($this->type == 'interface') {
            $fileds = $this->interfaceFields;
        } else {
            throw new Exception('只能通过界面或者接口创建商品！');
        }

        if (!empty($fileds)) {
            foreach ($fileds as $key => $value) {
                if (isset($productInfo[$key])) {
                    $info[$value] = $productInfo[$key];
                }
            }
        } //有时候转进来的值不要做转换
        else {
            $info = $productInfo;
        }
        return $info;
    }

    /**
     * 去除空格
     * @param  string $value [description]
     * @return [type]        [description]
     */
    private function fomatRow($row)
    {
        foreach ($row as $k => $v) {
            if (!is_array($v)) {
                $row[$k] = trim($v);
            } else {
                $row[$k] = ($v);
            }
        }
        return $row;
    }

    private static function createRegisterID($customer)
    {
        $rgisterID = "";
        if ($customer['customs_reg_num'] == '') {
            throw new Exception('企业海关编码为空,无法生成备案号');
        }
        /*$application = Service_Application::getByField('productRegisterID', 'application_code');
        $time = date('Y-m-d H:i:s');
        $number = 1;
        if (!isset($application['current_number']) || intval($application['current_number']) <= 0) {
        $result = Service_Application::add(array(
        'current_number' => $number,
        'app_add_time' => $time
        ));
        } else {
        $oldNumber = intval($application['current_number']);
        $number = $oldNumber + 1;
        $result = Service_Application::update(array(
        'application_code' => 'productRegisterID',
        'current_number' => $number,
        'app_update_time' => $time
        ), $application['application_id']);
        }*/
        //Service_Comm

        Common_GetNumbers::getCode('productRegisterID', 10, 'OC', '订单code');

        /*if ($result === false) {
    throw new Exception("生成备案编号失败！");
    }
    //防止数字过大而使用科学记数
    $numberString = number_format($number, 0, '', '');
    return sprintf("%018s", $numberString);*/
    }

    public function generateXml($productId)
    {
        $result          = array('ask' => 0, 'path' => '', 'messageId' => '');
        $genArrayData    = array();
        $productInfo     = Service_Product::getByField($productId, 'product_id');
        $customerInfo    = Service_Customer::getByField($productInfo['customer_code'], 'customer_code');
        $productAttached = Service_ProductAttached::getByCondition(array('product_id' => $productId));
        if ($productInfo['country_code_of_origin']) {
            $countryInfo = Service_Country::getByField($productInfo['country_code_of_origin'], 'country_code');
        }
        $productArray = array(
            'GOODS_SERIAL_NO'     => $productId,
            'ENT_CODE'            => '', //商检备案号
            'DECL_ENT_CODE'       => $customerInfo['ciq_reg_num'], //申报单位代码
            //'DECL_ENT_CODE'        => '4100300022',    //申报单位代码
            'GOODS_CATEGORIES'    => $productInfo['goods_categories'], //商品大类
            'IE_FLAG'             => $productInfo['ie_type'], //进出口标志
            'APPLY_TIME'          => date('YmdHis'),
            'HSCODE'              => $productInfo['hs_code'],
            'GOODS_SKU_NO'        => $productInfo['product_sku'],
            'GOODS_NAME'          => $productInfo['product_title'],
            'MASTER_BASE'         => $productInfo['element'],
            'SPEC'                => $productInfo['product_model'],
            'ORIGIN_COUNTRY'      => $countryInfo['b_bbd_country_code'],
            'PRO_ENT'             => $productInfo['enterprises_name'], //生产企业
            'BRAND'               => $productInfo['brand'], //产品品牌
            'SUPPLIER'            => $productInfo['supplier'], //供应商
            'QTY_UNIT_CODE'       => $productInfo['pu_code'], //包装单位代码
            'SMALL_QTY_UNIT_CODE' => $productInfo['pu_code'], //最小包装单位代码
            'USE_WAY'             => $productInfo['use_way'], //用途
        );
        $productAttachment = array();
        foreach ($productAttached as $key => $val) {
            $productAttachment[$key]['BIZ_TYPE']      = 1;
            $productAttachment[$key]['ANNEX_NAME']    = $val['pa_name'];
            $productAttachment[$key]['ANNEX_CONTENT'] = $val['pa_content'];
            $productAttachment[$key]['ANNEX_TYPE']    = $val['pa_type'];
            $productAttachment[$key]['REMARK']        = '';
        }
        $messageId     = date('YmdHis') . str_pad(floor(microtime() * 1000), 3, '0', STR_PAD_LEFT);
        $productHeader = array(
            'MESSAGE_ID'   => $messageId,
            'MESSAGE_TYPE' => '110',
            'MESSAGE_TIME' => date("Y-m-d H:i:s"),
            'SEND_CODE'    => $messageId,
            'RECIPT_CODE'  => $messageId,
        );
        $genArrayData = array(
            'MessageHead' => $productHeader,
            'MessageBody' => array(
                'GoodsRegDocument' => array(
                    'GoodsRegHead'      => $productArray,
                    'GoodsRegAnnexList' => array(
                        'GoodsRegAnnexListInformation' => $productAttachment,
                    ),
                ),
            ),
        );
        $fileName      = $messageId . '.xml';
        $messageObject = new Common_Message();
        $xml           = $messageObject->cearteResult($genArrayData, 'RequestMessage');
        $savePath      = APPLICATION_PATH . '/../data/xml/' . date('Y/m/d') . DIRECTORY_SEPARATOR . 'ciqProduct';
        $filePath      = $savePath . DIRECTORY_SEPARATOR . $fileName;
        if (!is_dir($savePath)) {
            if (!Common_Common::createPath($savePath)) {
                throw new Exception('路径创建失败');
            }
        }
        file_put_contents($filePath, $xml);
        return array('ask' => 1, 'path' => $filePath, 'messageId' => $messageId);
    }

    /**
     * 商检商品大类
     */
    public static function getCiqGoodsCategories()
    {
        return array(
            '食品'                => '食品',
            '化妆品'             => '化妆品',
            '保健食品'          => '保健食品',
            '一次性卫生用品' => '一次性卫生用品',
            '轻工业产品'       => '轻工业产品',
            '其它'                => '其它',
        );
    }

    /**
     * 商检附件类型
     */
    public static function getCiqAttachedType()
    {
        return array(
            '201' => '认证、注册、备案等资质',
            '202' => '商品取得的自由销售证明',
            '203' => '第三方检验鉴定证书',
            '204' => '产品说明的中文对照材料',
            '205' => '消费警示',
            '206' => '其他可提供的证明材料',
            '207' => '产品中文标签图片',
        );
    }
}
