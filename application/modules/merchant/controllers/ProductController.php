<?php

class Merchant_ProductController extends Ec_Controller_Action
{
    /* public function init(){
    $params = self::getFrontController()->getRequest()->getParams();
    $this->view->ac = $params['action'];
    } */
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/product/";
        $params = self::getFrontController()->getRequest()->getParams();
        $this->view->ac = $params['action'];
        $this->view->url = $_SERVER['REDIRECT_URL'];
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
        //echo $this->view->url;exit;
    }

    /**
     * 选择产品弹出框
     */
    public function repositoryAction()
    {
        $page = $this->getRequest()->getParam('page', 1);
        $pageSize = $this->getRequest()->getParam('pageSize', 20);

        //是否验证客户代码
        $customer = $this->_request->getParam('customer');
        $cusCode = $this->getRequest()->getParam('cusCode', array());
        $condition = array(
            //'customer_id'        => $this->_customerAuth['id'],
            'product_sku'    => trim($this->getRequest()->getParam('sku')),
            'product_title'  => $this->getRequest()->getParam('title'),
            'pc_id'          => $this->getRequest()->getParam('type'),
            'product_status' => '1',
            'comefrom'       => 'psearchdialog',
        );

        if ($customer == 'true') {
            $condition['customer_id'] = $this->_customerAuth['id'];
            $customer = 'true';
        }
        //客户code
        if (!empty($cusCode)) {
            $condition['customer_code'] = $cusCode;
        }

        $from = $this->_request->getParam('from', '');
        //判断参数的有效性
        $inject = true;
        switch ($from) {
            case 'product':
                $inject = false;
                $condition['product_type'] = 0;
                break;
            case 'productCombine':
                $inject = false;
                $condition['product_type'] = 0;
                break;
            case 'asn':
                $condition['product_type'] = 0;
                $condition['customer_id'] = $this->_customerAuth['id'];
                $inject = false;
            case 'order':
                $inject = false;
        }
        $this->view->from = $from;
        $this->view->params = $condition;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        $this->view->count = Service_Product::getByCondition($condition, 'count(*)');
        $result = Service_Product::getByCondition($condition, '*', 'product_id DESC', $pageSize, $page);
        $category = Common_DataCache::getProductCategory();

        if (!empty($result)) {
            foreach ($result as $keyp => $valuep) {
                if ($valuep['product_type'] == '1') {
                    $result[$keyp]['product_weight'] = Service_Product::getCombineProductWeight($valuep['product_id']);
                }
                $result[$keyp]['product_title_short'] = '';
                if (mb_strlen($valuep['product_title'], 'utf8') > 20) {
                    $result[$keyp]['product_title_short'] = mb_substr($result[$keyp]['product_title'], 0, 20, 'utf8') . '...';
                } else {
                    $result[$keyp]['product_title_short'] = $result[$keyp]['product_title'];
                }
                if (isset($category[$valuep['pc_id']])) {
                    $result[$keyp]['pc_name'] = $category[$valuep['pc_id']]['pc_name'];
                } else {
                    $result[$keyp]['pc_name'] = '';
                }
            }
        }
        $this->view->result = $result;
        $this->view->category = $category;
        $this->view->user = $this->_customerAuth;
        //用户筛选
        $this->view->customer = $customer;
        $this->view->cusCode = $cusCode;
        echo $this->view->render($this->tplDirectory . "repository.tpl");
    }

    /*产品列表*/
    public function indexAction()
    {
        $lang = Ec_Lang::getInstance()->getCurrentLanguage();
        $this->view->lang = $lang;
        $page = $this->getRequest()->getParam('page', 1);
        $pageSize = $this->getRequest()->getParam('pageSize', 20);
        $customer = $this->_customerAuth;
        $customs = Common_CommonConfig::getcustomsInfo();
        $condition = array(
            //'customer_id'        => 1,
            'ie_type'          => $this->getRequest()->getParam('ie_type'),
            'product_type'     => $this->getRequest()->getParam('product_type'),
            'comefrom'         => 1,
            'product_sku'      => $this->getRequest()->getParam('sku'),
            'product_title'    => $this->getRequest()->getParam('title'),
            'pc_id'            => $this->getRequest()->getParam('type'),
            'product_add_time' => $this->getRequest()->getParam('start_time'),
            'product_end_time' => $this->getRequest()->getParam('end_time'),
            'product_status'   => $this->getRequest()->getParam('productStatus', ''),
            'customs_status'   => $this->getRequest()->getParam('customsStatus', ''),
            'ciq_status'       => $this->getRequest()->getParam('ciqStatus', ''),
            'customer_code'    => $this->getRequest()->getParam('customer_code'),
            'customs_code'     => $this->getRequest()->getParam('customs_code', ''),
            'registerID'       => $this->getRequest()->getParam('registerID', ''),
            'hs_code'          => $this->_request->getParam('hs_code'),
            'ins_unit_code'   => $this->_request->getParam('ins_unit_code')
        );
        foreach ($customs as $row) {
            $customShow[$row['ie_port']] = $row['ie_port_name'];
        }
        if (isset($customer['customer_priv']['is_ecommerce']) && $customer['customer_priv']['is_ecommerce'] == '1') {
            //电商企业只能查询该电商的产品
            $condition['customer_code'] = $customer['code'];
            $this->view->is_ecommerce = '1';
        }
        if (isset($customer['customer_priv']['is_storage']) && $customer['customer_priv']['is_storage'] == '1') {
            //物流仓租企业
            //账号查询所有
            if ($customer['account_level'] == '1') {
                //子账号
                //$condition['storage_account_code'] = $customer['account_code'];
                //子账号也可以查所有的备案商品
                $condition['storage_customer_code'] = $customer['code'];
            } else {
                //主账号
                $condition['storage_customer_code'] = $customer['code'];
            }
            $this->view->is_storage = '1';
        }

        $flag = true;
        $productList = array();
        if ($flag) {
            $productList = Service_Product::getByCondition($condition, '*', 'product_id DESC', $pageSize, $page);
        }
        if(!empty($productList)){
            foreach ($productList as $key => $value) {
                $productList[$key]['ins_unit_name'] = '';
                if($value['ins_unit_code']){
                    $check_org_item = Service_Organization::getByField($value['ins_unit_code'],'organization_code');
                    if(!empty($check_org_item)){
                        $productList[$key]['ins_unit_name'] = $check_org_item['organization_name'];
                    }
                } 
            }
        }

        $productStatus = Service_Product::getStatus(); //Common_CommonConfig::getProductStatus();
        $this->view->customerList = $this->_customerAuth['priv_customer_code_arr'];
        $this->view->condition = $condition;
        $this->view->params = $condition;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        $this->view->count = Service_Product::getByCondition($condition, 'count(*)');
        $this->view->result = $productList;
        $this->view->category = Common_DataCache::getProductCategory();
        $this->view->user = $this->_customerAuth;
        $this->view->ieType = Common_CommonConfig::getIeType2();
        $this->view->customShow = $customShow;
        $this->view->customs = $customs;
        $this->view->customsStatus = Service_Product::getCustomsStatus();
        $this->view->ciqStatus = Service_Product::getCiqStatus();
        $this->view->productStatus = $productStatus;
        $this->view->checkOrg = Service_Organization::getByCondition(array('is_display'=>'1'));
        echo Ec::renderTpl($this->tplDirectory . "index.tpl", 'noleftlayout');
    }

    /**
     * @author william-fan
     * @todo 普通产品新增修改(目前只让电商可以新增)
     */
    public function addAction()
    {
        $customer = $this->_customerAuth;
        error_reporting(E_ALL ^ E_NOTICE);
        //session_start();
        $this->view->uom = Common_DataCache::getProductUom();
        $this->view->category = Common_DataCache::getProductCategory();
        $this->view->session_name = session_name();
        $this->view->sessionid = session_id();

        $productId = $this->_request->getParam('productId', '');

        if ($productId) {
            $productInfo = Service_Product::getProductAllInfo($productId);
            if ($productInfo) {
                $this->view->productInfo = $productInfo;
            }
        }
        //$action = '增加';
        $action = Ec_Lang::getInstance()->getTranslate('ProductAdd');
        $actionLabel = 'add';
        if (!empty($productId)) {
            $action = Ec_Lang::getInstance()->getTranslate('ProductModify');
            $actionLabel = 'update';
        }
        if ($customer['customer_priv']) {
            if (isset($customer['customer_priv']['is_ecommerce']) && $customer['customer_priv']['is_ecommerce'] == '1') {
                $this->view->customer = $customer;
                $this->view->is_ecommerce = '1';
            }
            if (isset($customer['customer_priv']['is_storage']) && $customer['customer_priv']['is_storage'] == '1') {
                $this->view->customer = $customer;
            }
        }
        $taxList = Service_GoodsTax::getAll();
        $this->view->taxList = $taxList;
        $this->view->customerJson = json_encode($this->_customerAuth['priv_customer_code_arr']);
        $this->view->product_id = $productId;
        $this->view->action = $action;
        $this->view->actionLabel = $actionLabel;
        $this->view->checkOrg = Service_Organization::getByCondition(array('is_display'=>'1'));
        // $this->view->customer = $customer;
        $this->view->countryArr = Service_Country::getAll();
        $this->view->currency = Service_Currency::getAll();
        $this->view->ieType = Common_CommonConfig::getIeType2();
        $this->view->customs = Common_CommonConfig::getcustomsInfo();
        $this->view->ciqGoodsCategories = Service_ProductProcess::getCiqGoodsCategories();
        $this->view->ciqAttachedType = Service_ProductProcess::getCiqAttachedType();
        $this->view->sjUseWay = Service_SjUseWay::getAll();
        echo Ec::renderTpl($this->tplDirectory . "add-all.tpl", 'noleftlayout');
    }

    /*普通产品增加修改*/
    public function addSaveAction()
    {
        $state = array(
            'statusCode'   => 200,
            'message'      => Ec_Lang::getInstance()->getTranslate('ProductAdd') . Ec_Lang::getInstance()->getTranslate('success') . '！',
            'navTabId'     => 'productList',
            'callbackType' => 'forward',
            'forwardUrl'   => '/merchant/product/add',
        );
        $customer = $this->_customerAuth;

        $picUrl = $this->_request->getParam('picUrl', array());
        $picLink = $this->_request->getParam('picLink', array());
        $imageArray = array();
        $imageSelect = $this->_request->getParam('imageSelect');
        $attachedType = $this->_request->getParam('attachedType');
        $image = $this->_request->getParam('image', array());
        $imageCount = 1;
        $ciqAttachedType = Service_ProductProcess::getCiqAttachedType();
        $error = array();
        foreach ($image as $key => $val) {
            foreach ($val as $k => $v) {
                if ('' === trim($imageSelect[$key][$k]) || '' ===trim($attachedType[$key][$k])) {
                    $error[] = "附件" . ($key + 1) . "名称或类型必填";
                }
                elseif (!isset($ciqAttachedType[$attachedType[$key][$k]])) {
                    $error[] = "附件" . ($key + 1) . "类型【" . $attachedType[$key][$k] . "】无效";
                }
                else {
                    $imageArray[$key][$k] = array(
                        'path' => $v,
                        'name' => $imageSelect[$key][$k],
                        'type' => $attachedType[$key][$k],
                    );
                }
                $imageCount++;
            }
        }
        $hs_elements = array();
        $he_ids = $this->_request->getParam('he_id', array());
        foreach ($he_ids as $he_id => $hevalue) {
            $hs_elements[] = array('he_id' => $he_id, 'hem_detail' => $hevalue);
        }

        $time = date('Y-m-d H:i:s');
        $data = array(
            'ie_type'                => $this->getRequest()->getParam('ie_type'),
            'customer_code'          => $this->getRequest()->getParam('customer_code'),
            'enp_name'               => $this->getRequest()->getParam('enp_name'),
            //'customer_id' => $user['id'],
            'customs_code'           => $this->getRequest()->getParam('customs_code'),
            'ins_unit_code'           => $this->getRequest()->getParam('ins_unit_code',''),
            'storage_customer_code'  => $this->getRequest()->getParam('storage_customer_code'),
            'storage_enp_name'       => $this->getRequest()->getParam('storage_enp_name'),
            'product_title'          => $this->getRequest()->getParam('title'),
            'product_model'          => trim($this->_request->getParam('product_model', '')), // 产品型号
            'pu_code'                => $this->_request->getParam('pu_code', ''),
            'product_declared_value' => $this->getRequest()->getParam('declared_value'),
            'country_code_of_origin' => $this->_request->getParam('country_code_of_origin', ''),
            'currency_code'          => $this->getRequest()->getParam("currency_code", ""),
            'gt_code'                => trim($this->_request->getParam('gt_code')),
            'product_weight'         => $this->getRequest()->getParam('product_weight', '0'),
            'product_net_weight'     => $this->getRequest()->getParam('product_net_weight', '0'),
            'hs_code'                => $this->getRequest()->getParam('hs_code', '0'),
            'product_barcode'        => trim($this->getRequest()->getParam('barcode')),
            'product_description'    => $this->_request->getParam('product_description', ''),
            'brand'                  => $this->_request->getParam('brand', ''),
            'g_unit'                 => $this->_request->getParam('law_code', ''),
            'second_unit'            => $this->_request->getParam('second_code', ''),
            'product_sku' => trim($this->_request->getParam('product_sku', '')),
            'goods_categories' => trim($this->_request->getParam('goods_categories', '')),
            'element' => trim($this->_request->getParam('element', '')),
            'use_way' => trim($this->_request->getParam('use_way', '')),
            'enterprises_name' => trim($this->_request->getParam('enterprises_name', '')),
            'supplier' => trim($this->_request->getParam('supplier', '')),
            'is_law_regulation' => $this->_request->getParam('is_law_regulation', 1),
			'hs_name' => trim($this->_request->getParam('hs_name', '')),
        );
        $data['account_code'] = $customer['account_code'];

        // print_r($data);exit;
        $productId = $this->_request->getParam('product_id', '');

        $productObj = new Service_ProductProcess();

        if ($productId) {
            $data['action'] = 'update';
            $data['product_id'] = $productId;
            if (!empty($error)) {
                $result['ask'] = 0;
                $result['actionType'] = "update";
                $result['error'] = $error;
                $result['message'] = Ec_Lang::getInstance()->getTranslate('EcProductModify');
                die(json_encode($result));
            }

            $result = $productObj->updateProductTransaction($data, $productId, $data['customer_code'], $picUrl, $picLink, $imageArray);
        } else {
            if (!empty($error)) {
                $result['ask'] = 0;
                $result['actionType'] = "create";
                $result['error'] = $error;
                $result['message'] = Ec_Lang::getInstance()->getTranslate('ProductCreationFailed');
                die(json_encode($result));
            }
            $data['product_status'] = 1;
            $data['action'] = 'add';
            $result = $productObj->createProductTransaction($data, $data['customer_code'], $picUrl, $picLink, $imageArray);
        }
        die(json_encode($result));
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $state = array(
            'statusCode'   => 300,
            'message'      => '参数错误，载入失败！',
            'callbackType' => 'closeCurrent',
        );
        if (!empty($id) || is_int($id)) {
            $result = Service_Product::getCustomQuery('*', "where product_id=$id");
            if (!empty($result)) {
                $result = $result[0];
                $result['attached'] = Service_ProductAttached::getCustomQuery('*', "where product_id=$id and pa_file_type='img' order by pa_sort");
                $this->view->uom = Common_DataCache::getProductUom();
                $this->view->category = Common_DataCache::getProductCategory();
                $this->view->result = $result;
                echo $this->view->render($this->tplDirectory . "edit.tpl");
                return true;
            }
        }
        Common_Common::outJson($state);
    }

    public function editSaveAction()
    {
        $state = array(
            'statusCode'   => 200,
            'message'      => '修改信息成功！',
            'navTabId'     => 'productList',
            'callbackType' => 'closeCurrent',
        );
        $id = $this->getRequest()->getParam('eid');
        $user = $this->_customerAuth;
        $userId = $user['id'];
        $time = date('Y-m-d H:i:s');
        $data = array(
            'product_sku'            => $this->getRequest()->getParam('sku'),
            'product_title_en'       => $this->getRequest()->getParam('title_en'),
            'product_title'          => $this->getRequest()->getParam('title'),
            'pu_code'                => $this->getRequest()->getParam('uom'),
            'product_length'         => $this->getRequest()->getParam('length'),
            'product_width'          => $this->getRequest()->getParam('weight'),
            'product_height'         => $this->getRequest()->getParam('height'),
            'product_sales_value'    => $this->getRequest()->getParam('sales_value'),
            'product_purchase_value' => $this->getRequest()->getParam('purchase_value'),
            'product_declared_value' => $this->getRequest()->getParam('declared_value'),
            'product_barcode_type'   => $this->getRequest()->getParam('barcode_type'),
            'pc_id'                  => $this->getRequest()->getParam('type'),
            'product_add_time'       => $time,
        );
        if (1 == $this->getRequest()->getParam('barcode_type')) {
            $data['product_barcode'] = $this->getRequest()->getParam('barcode');
        }
        $flag = Service_Product::customUpdate($data, "product_id=$id and customer_id=$userId");
        if (empty($flag)) {
            $state = array(
                'statusCode' => 300,
                'message'    => '修改信息出错，请重新提交！',
            );
        } else {
            $path = './upload/merchant/' . $user['code'] . '/product';
            $isDir = Common_Common::createPath($path);
            $count = $this->getRequest()->getParam('imgs');
            if ($isDir) {
                if (empty($count)) {
                    $imgs = array();
                    $upload = Common_Common::uploadImg($_FILES, 'pic', $path, false);
                    if ($upload['error']) {
                        $state = array(
                            'statusCode' => 300,
                            'message'    => '产品基本信息修改成功，上传图片产生错误：' . strip_tags($upload['msg']),
                        );
                        Common_Common::outJson($state);
                    }
                    if (!empty($upload['msg'])) {
                        foreach ($upload['msg'] as $key => $file) {
                            $flag = Service_ProductAttached::add(array(
                                'pa_path'      => trim($path, ".") . '/' . $file['file_name'],
                                'pa_file_type' => 'img',
                                'product_id'   => $id,
                            ));
                            if (empty($flag)) {
                                $state = array(
                                    'statusCode' => 300,
                                    'message'    => '产品基本信息修改成功，保存图片产生错误！',
                                );
                            }
                        }
                    }
                } else {
                    $imgs = Service_ProductAttached::getCustomQuery('*', "where product_id=$id and pa_file_type='img' order by pa_sort");
                    $sum = empty($imgs) ? 0 : count($imgs);
                    $total = count($_FILES);
                    for ($i = 1; $i <= $total; $i++) {
                        $field = 'pic_' . $i;
                        if (!empty($_FILES[$field]['name'])) {
                            $upload = Common_Common::uploadImg($_FILES, $field, $path);
                            if ($upload['error']) {
                                $state = array(
                                    'statusCode' => 300,
                                    'message'    => '产品基本信息修改成功，上传图片产生错误：' . strip_tags($upload['msg']),
                                );
                                Common_Common::outJson($state);
                            }
                            $fname = trim($path, ".") . '/' . $upload['msg']['file_name'];
                            $index = $i - 1;
                            if ($index < $sum) {
                                $flag = Service_ProductAttached::update(array('pa_path' => $fname), $imgs[$index]['pa_id'], 'pa_id');
                                $flag && Common_Common::delFile(trim($imgs[$index]['pa_path'], '/'));
                            } else {
                                Service_ProductAttached::add(array(
                                    'pa_path'      => $fname,
                                    'pa_file_type' => 'img',
                                    'product_id'   => $id,
                                ));
                            }
                        }
                    }
                }
            }
        }
        Common_Common::outJson($state);
    }

    public function delAction()
    {
        $id = $this->getRequest()->getParam('productId');
        $state = array(
            'statusCode' => 300,
            'message'    => '参数错误，删除失败！',
        );
        if (!empty($id) || is_int($id)) {
            $flag = Service_Product::delete($id, 'product_id');
            if (!empty($flag)) {
                $imgs = Service_ProductAttached::getCustomQuery('pa_path', "where product_id=$id");
                if (!empty($imgs)) {
                    foreach ($imgs as $key => $val) {
                        Common_Common::delFile(trim($val['pa_path'], '/'));
                    }
                    Service_ProductAttached::delete($id, 'product_id');
                }
                $state = array(
                    'statusCode' => 200,
                    'message'    => '删除成功！',
                );
            }
        }
        Common_Common::outJson($state);
    }

    /**
     * @author william-fan
     * @todo 用于组合产品的操作
     */
    public function combineAction()
    {
        $productInfo = array();
        $customer = $this->_customerAuth;
        $customerId = $customer['id'];
        $customerCode = $customer['code'];
        if ($this->_request->isPost()) {
            $picUrl = $this->_request->getParam('picUrl', array());
            $picLink = $this->_request->getParam('picLink', array());

            $row = array(
                'product_title_en' => $this->_request->getParam('product_title_en', ''),
                'product_title'    => $this->_request->getParam('product_title_cn', ''),
                'product_sku'      => $this->_request->getParam('product_sku', ''),
                'customer_id'      => $customerId,
                'customer_code'    => $customerCode,
                'product_type'     => '1',
            );

            $subs = array();
            $subArr = $this->_request->getParam('sub', array());
            foreach ($subArr as $sub_productId => $quantity) {
                $subs[] = array(
                    'product_id' => $sub_productId,
                    'quantity'   => $quantity,
                );
            }

            $row['subs'] = $subs;
            $productId = $this->_request->getParam('product_id', '');
            if ($productId) {
                $result = Service_Product::updateCombineProductTransaction($row, $customerId, $productId, $picUrl, $picLink);
            } else {
                $row['product_status'] = 1;
                $result = Service_Product::createCombineProductTransaction($row, $customerId, $picUrl, $picLink);
            }

            if (!empty($result['error'])) {
                foreach ($result['error'] as $k => $v) {
                    $result['error'][$k] = preg_replace('/^([0-9]+)/', '', $v);
                }
            }

            die(Zend_Json::encode($result));
            exit;
        }
        $this->view->session_name = session_name();
        $this->view->sessionid = session_id();

        $this->view->user = $this->_customerAuth;

        $productId = $this->_request->getParam('productId', '');
        $this->view->product_id = $productId;

        if (!empty($productId)) {
            $productInfo = Service_Product::getProductAllInfo($productId, $customerId);
            if ($productInfo['product_type'] == '0') {
                //exit('cccccccc');
                $this->_redirect("/merchant/product/add/productId/" . $productId);
                exit;
            }
            $this->view->productCombineInfo = $productInfo;
        }

        $actionLabel = "add";
        $action = Ec_Lang::getInstance()->getTranslate('CombineProductAdd');

        if (!empty($productId)) {
            $action = Ec_Lang::getInstance()->getTranslate('CombineProductModify');
            $actionLabel = "update";
        }
        $this->view->action = $action;
        $this->view->is_combine = 1; /*为组合产品*/
        $this->view->actionLabel = $actionLabel;

        echo Ec::renderTpl($this->tplDirectory . "product-create-combine.tpl", 'noleftlayout');

    }

    public function combineAddAction()
    {
        echo $this->view->render($this->tplDirectory . "combineAdd.tpl");
    }

    public function singleUploadimgAction()
    {
        $customerId = $this->_customerAuth['id'];
        $return = array(
            "ask"     => 0,
            "message" => "Upload Fail",
        );
        $relativePath = '/images/temp/';
        $linuxTmpPath = APPLICATION_PATH . '/../public' . $relativePath;
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $fileext = pathinfo($_FILES['Filedata']['name']);
            $tempFileName = $customerId . uniqid() . "." . $fileext['extension'];
            if (!file_exists($linuxTmpPath)) {
                mkdir($linuxTmpPath, 0777, true);
            }
            $targetFile = trim($linuxTmpPath) . $tempFileName;
            if (move_uploaded_file($tempFile, $targetFile)) {
                $return['ask'] = 1;
                $return['src'] = $relativePath . $tempFileName;
            }
        }
        die(Zend_Json::encode($return));
    }

    /**
     * @author william-fan
     * @todo用于上传图片
     */
    public function uploadimgAction()
    {
        //debug_print_backtrace();
        $return = array(
            "ask"     => 0,
            "message" => "Upload Fail",
        );
        $customerId = $this->_customerAuth['id'];
        //file_put_contents('test001.txt', $customerId);
        $result = Service_ProductAttached::uploadImage($_FILES['Filedata'], $customerId);
        //file_put_contents('test002.txt', var_export($result,true));
        if ($result) {
            $return['ask'] = 1;
            $return['data'] = $result;
            $return['message'] = "";
        }
        die(Zend_Json::encode($return));

        $targetFolder = '/uploads'; // Relative to the root

        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        //file_put_contents('test5.txt',$verifyToken);
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/test/uploadify' . $targetFolder;
            $targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }

    }

    public function batchUploadImageAction()
    {
        $imageArray = array();
        $imageSession = new Zend_Session_Namespace('imageSession');
        if (isset($imageSession->data)) {
            $imageSession->__unset("imageSession");
        }

        $customer = $this->_customerAuth;
        $customerCode = $customer['code'];
        $customerId = $customer['id'];
        $allowImageType = array('jpg', 'jpeg', 'gif', 'png');
        $relativePath = '/images/temp/' . uniqid();
        $linuxTmpPath = APPLICATION_PATH . '/../public' . $relativePath;
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = APPLICATION_PATH . "/../data/images/zip/" . $customerCode;
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $targetFile = trim($targetPath) . '/' . $_FILES['Filedata']['name'];
            $fileTypes = array('zip');
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                if (move_uploaded_file($tempFile, $targetFile)) {
                    if (!file_exists($linuxTmpPath)) {
                        mkdir($linuxTmpPath, 0777, true);
                    } else {
                        rmdir($linuxTmpPath);
                    }
                    $zip = new ZipArchive;
                    if ($zip->open($targetFile) === true) {
                        $zip->extractTo($linuxTmpPath);
                        $zip->close();
                        $dirPath = opendir($linuxTmpPath);
                        while ($dirName = readdir($dirPath)) {
                            if ($dirName != "." && $dirName != "..") {
                                $fullpath = $linuxTmpPath . "/" . $dirName;
                                if (is_dir($fullpath)) {
                                    $productInfo = Service_Product::getByWhere(array("product_sku" => $dirName, 'customer_id' => $customerId));
                                    $imageArray[$dirName]['is_valid'] = 1;
                                    if (!empty($productInfo)) {
                                        $filePathDir = opendir($fullpath);
                                        while ($fileName = readdir($filePathDir)) {
                                            if ($fileName != "." && $fileName != "..") {
                                                if (is_file($fullpath . "/" . $fileName)) {
                                                    $filesize = abs(filesize($fullpath . "/" . $fileName));
                                                    if ($filesize <= 307200) {
                                                        $fileAttribute = pathinfo($fullpath . "/" . $fileName);
                                                        if (in_array(strtolower($fileAttribute['extension']), $allowImageType)) {
                                                            $prefixImage = substr($fileAttribute['basename'], 0, 2);
                                                            if (in_array($prefixImage, array("1_", "2_", "3_", "4_")) ||
                                                                in_array($prefixImage, array("1-", "2-", "3-", "4-")
                                                                )
                                                            ) {
                                                                $imageArray[$dirName][$prefixImage][] = $relativePath . "/" . $dirName . "/" . $fileName;
                                                            } else {
                                                                $imageArray[$dirName]['error'][] = $fileName . '命名错误';
                                                            }
                                                        } else {
                                                            $imageArray[$dirName]['error'][] = $fileName . '不是合法图片';
                                                        }
                                                    } else {
                                                        $imageArray[$dirName]['error'][] = $fileName . '图片太大';
                                                    }
                                                } else {
                                                    $imageArray[$dirName]['error'][] = $fileName . '不是文件';
                                                }
                                            }
                                        }
                                        $tmp = $imageArray[$dirName];
                                        unset($tmp['is_valid']);
                                        if (empty($tmp)) {
                                            $imageArray[$dirName]['error'][] = $dirName . '文件夹为空';
                                        }
                                    } else {
                                        $imageArray[$dirName]['error'][] = $dirName . '不存在';
                                    }
                                    if (!empty($imageArray[$dirName]['error'])) {
                                        $imageArray[$dirName]['is_valid'] = 0;
                                    }
                                }
                            }
                        }
                    } else {
                        echo $_FILES['Filedata']['name'] . '不可读';
                        exit;
                    }
                    $imageSession->data = $imageArray;
                    echo 1;
                    exit;
                }
            } else {
                echo 'Invalid file type.';
            }
        }
        $this->view->session_name = session_name();
        $this->view->sessionid = session_id();
        echo Ec::renderTpl($this->tplDirectory . "image-upload.tpl", 'noleftlayout');
    }

    public function batchUploadImagePreviewAction()
    {
        $sessionData = array();
        $imageSession = new Zend_Session_Namespace('imageSession');
        if (isset($imageSession->data) || empty($imageSession->data)) {
            $sessionData = $imageSession->data;
        } else {
            $sessionData['base']['error'][] = "无文件信息";
        }
        $this->view->imageData = $sessionData;
        echo Ec::renderTpl($this->tplDirectory . "image-upload-preview.tpl", 'noleftlayout');
    }

    public function doBatchImageInsertAction()
    {
        $selectedData = array();
        $customer = $this->_customerAuth;
        $customerCode = $customer['code'];
        $customerId = $customer['id'];
        $tmpImagePath = $linuxTmpPath = APPLICATION_PATH . '/../public';
        $ids = $this->_request->getParam('select');
        $imageSession = new Zend_Session_Namespace('imageSession');
        if (isset($imageSession->data) && !empty($imageSession->data)) {
            $sessionData = $imageSession->data;
            foreach ($ids as $id) {
                if ($sessionData[$id]) {
                    unset($sessionData[$id]['is_valid']);
                    $selectedData[$id]['sku'] = $id;
                    $selectedData[$id]['images'] = $sessionData[$id];
                }
            }
        } else {
            $this->_redirect('/merchant/product/batch-upload-image');
        }
        if (empty($ids)) {
            $this->_redirect('/merchant/product/batch-upload-image');
        }
        $DB = Common_Common::getAdapter();
        $errorCount = 0;
        $successCount = 0;
        $resutlData = array();
        foreach ($selectedData as $key => $val) {
            $DB->beginTransaction();
            try {
                $productInfo = Service_Product::getByWhere(array("product_sku" => $val['sku'], 'customer_id' => $customerId));
                $basePath = APPLICATION_PATH . "/../data/images/{$customerId}/{$productInfo['product_id']}/";
                if (!file_exists($basePath)) {
                    mkdir($basePath, 0777, true);
                }
                if (!empty($productInfo) && (3 == $productInfo['product_status'] || 2 == $productInfo['product_status'])) {
                    Service_ProductAttached::delete($productInfo['product_id'], 'product_id');
                    $successFlag = true;
                    foreach ($val['images'] as $k => $v) {
                        foreach ($v as $v1) {
                            $fileName = basename($tmpImagePath . $v1);
                            if (copy($tmpImagePath . $v1, $basePath . $fileName)) {
                                $attachmentRow = array(
                                    "product_id"     => $productInfo['product_id'],
                                    "pa_path"        => "/{$customerId}/{$productInfo['product_id']}/{$fileName}",
                                    "pa_file_type"   => "img",
                                    "pa_status"      => "1",
                                    "pa_update_time" => date("Y-m-d H:i:s"),
                                    "pa_content"     => base64_encode(file_get_contents($tmpImagePath . $v1)),
                                    "pa_name"        => $fileName,
                                    "pa_type"        => substr($k, 0, 1),
                                );
                                if (!Service_ProductAttached::add($attachmentRow)) {
                                    $successFlag = false;
                                    break;
                                }
                            } else {
                                $successFlag = false;
                                break;
                            }
                        }
                    }
                    if ($successFlag) {
                        $resutlData[$key]['message'] = Ec_Lang::getInstance()->getTranslate('add_product_success');
                        $DB->commit();
                    } else {
                        $resutlData[$key]['message'] = Ec_Lang::getInstance()->getTranslate('add_product_unsuccess');
                        $DB->rollBack();
                        continue;
                    }
                } else {
                    $resutlData[$key]['message'] = "未找到产品或产品状态错误";
                    $errorCount++;
                    $DB->rollBack();
                    continue;
                }
            } catch (Zend_Exception $exe) {
                $resutlData[$key]['message'] = $exe->getMessage();
                $DB->rollBack();
                continue;
            }
        }
        $result = array("ask" => '1', 'data' => $resutlData);
        $this->view->result = $result;
        if (isset($imageSession->data)) {
            $imageSession->__unset("imageSession");
        }

        echo Ec::renderTpl($this->tplDirectory . "image-upload.tpl", 'noleftlayout');
    }

    /**
     * @author william-fan
     * @todo 查看图片
     */
    public function viewAttachAction()
    {

        $attachId = $this->_request->getParam('aid', "");

        if ($attachId) {
            $productAttach = Service_ProductAttached::getByField($attachId, 'pa_id');
            if (empty($productAttach)) {
                header("Location: /images/noimg.jpg");
                exit;
            }
            $path = APPLICATION_PATH . "/../data/images/" . $productAttach['pa_path'];

            if ($productAttach['pa_file_type'] == 'img' && file_exists($path)) {
                header('Content-Type: image/jpeg');
                echo file_get_contents($path);
            } else {
                header("Location: " . $productAttach['pa_path']);
            }
            exit();
        }

        header("Location: /images/noimg.jpg");
    }

    /**
     * @author william-fan
     * @todo 产品库存表
     */
    public function inventoryAction()
    {
        $page = $this->getRequest()->getParam('page', 1);
        $pageSize = $this->getRequest()->getParam('pageSize', 20);

        $condition = array();
        $product_sku = $this->getRequest()->getParam('sku');

        $condition = array(
            'customer_id' => $this->_customerAuth['id'],
            'product_sku' => $product_sku,
        );

        $warehouse_id = $this->_request->getParam("warehouse_id", "");
        $condition["warehouse_id"] = $warehouse_id;
        $condition['customer_id'] = $this->_customerAuth['id'];
        if ($product_sku != '') {
            $product = Service_Product::getByField($product_sku, 'product_sku');
            if (!empty($product)) {
                $condition['product_id'] = $product['product_id'];
            }
        }

        /* 以下为业务逻辑方法调用 */
        $count = Service_ProductInventory::getByCondition($condition, 'count(*)');
        $return['count'] = $count;

        if ($count) {
            $cacheProduct = array();
            $rows = Service_ProductInventory::getByCondition($condition, '*', $pageSize, $page);
            foreach ($rows as $k => $v) {
                $product = Common_DataCache::getProduct($v['product_id'], $this->_customerAuth['id']);

                $rows[$k]['product_sku'] = $product['product_sku'];
                $rows[$k]['product_title_en'] = $product['product_title_en'];
                $rows[$k]['product_id'] = $product['product_id'];

                $warehouse = Common_DataCache::getWarehouse(0, $v['warehouse_id']);

                $rows[$k]['warehouse_code'] = $warehouse['warehouse_code'];
                $rows[$k]['warehouse_id'] = $warehouse['warehouse_id'];
            }

            $return['data'] = $rows;
            $return['ask'] = 1;
            $return['message'] = "";
        }
        /* echo '<pre>';
        print_r($condition);
        print_r($rows);
        echo '</pre>'; */
        $this->view->result = $rows;
        $this->view->condition = $condition;
        $warehouse = Common_DataCache::getWarehouse();
        $this->view->warehouse = $warehouse;
        $this->view->count = $count;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        echo Ec::renderTpl($this->tplDirectory . "product-inventory.tpl", 'noleftlayout');
    }

    /**
     * @author william-fan
     * @todo 用于获取hs_element相关信息
     */
    public function getElementAction()
    {
        if ($this->_request->isPost()) {
            $hs_code = $this->_request->getParam('hs_code', ''); //海关编码
            $product_id = $this->_request->getParam('product_id', '');
            $user = $this->_customerAuth;
            $customerId = $user['id'];
            if ($product_id) {
                //修改的情况
                $productInfo = Service_Product::getProductAllInfo($product_id, $customerId);
                $return = array(
                    'ask'          => '0',
                    'hs_elements'  => '',
                    'hs_uom'       => '',
                    'hs_attribute' => '',
                );
                if (isset($productInfo['hs_element_maps'])) {
                    $return['ask'] = '1';
                    $return['hs_elements'] = $productInfo['hs_element_maps'];
                }
                if (isset($productInfo['hs_uom_map'])) {
                    $return['ask'] = '1';
                    $return['hs_uom'] = $productInfo['hs_uom_map'];
                }
                $hsAttribute = Service_HsAttribute::getByField($productInfo['hs_code'], 'hs_code');
                if (!empty($hsAttribute)) {
                    $return['hs_attribute'] = $hsAttribute;
                }
                die(Zend_Json::encode($return));
            } else {
                //新增的情况
                $return = array(
                    'ask'          => '0',
                    'hs_elements'  => '',
                    'hs_uom'       => '',
                    'hs_attribute' => '',
                );
                if (empty($hs_code)) {
                    die(Zend_Json::encode($return));
                } else {
                    $hs_codes = Service_Hscodes::getByCondition(array('hs_code' => $hs_code, 'hs_code_status' => '1'));
                    if (empty($hs_codes)) {
                        die(Zend_Json::encode($return));
                    }
                }
                $condition = array(
                    'hs_code'   => $hs_code,
                    'he_status' => '1',
                );
                //print_r($condition);
                $hsElements = Service_HsElement::getByCondition($condition, '*', 0, 0, 'he_sort asc');
                if (!empty($hsElements)) {
                    $return['hs_elements'] = $hsElements;
                    foreach ($hsElements as $hse => $vhse) {

                    }
                    $return['ask'] = '1';
                }
                $conditionuom = array(
                    'hs_code' => $hs_code,
                );
                $hsUoms = Service_HsUom::getByCondition($condition, '*', 0, 0);

                if (!empty($hsUoms)) {
                    $hsUom = $hsUoms[0];
                    $puLaw = Service_ProductUom::getByField($hsUom['pu_code_law'], 'pu_code');
                    $hsUom['pu_name_law'] = $puLaw['pu_name'];
                    if ($hsUom['pu_code_second'] != '') {
                        $pusecond = Service_ProductUom::getByField($hsUom['pu_code_second'], 'pu_code');
                        if ($pusecond) {
                            $hsUom['pu_name_second'] = $pusecond['pu_name'];
                        }
                    }
                    $return['hs_uom'] = $hsUom;
                    $return['ask'] = '1';
                }
                $hsAttribute = Service_HsAttribute::getByField($hs_code, 'hs_code');
                if (!empty($hsAttribute)) {
                    $return['hs_attribute'] = $hsAttribute;
                }
                //print_r($return);
                die(Zend_Json::encode($return));
            }
        }
    }

    public function inventoryLogAction()
    {
        $productId = $this->_request->getParam('productId', "");
        $pi_id = $this->_request->getParam('pi_id', "");
        $inventory = Service_ProductInventory::getByField($pi_id, 'pi_id', "*");
        $customer = Service_Customer::getByField($inventory['customer_id'], "customer_id", "*");
        $inventory['customer_code'] = $customer['customer_code'];
        $warehouse = Service_Warehouse::getByField($inventory['warehouse_id'], "warehouse_id", "*");
        $inventory['warehouse_code'] = $warehouse['warehouse_code'];
        $this->view->inventory = $inventory;

        $productInventoryLog = Service_ProductInventoryLog::getByCondition(array('product_id' => $productId), "*");
        foreach ($productInventoryLog as $k => $v) {
            $warehouse = Service_Warehouse::getByField($v['warehouse_id'], "warehouse_id", "*");
            $productInventoryLog[$k]['warehouse_code'] = $warehouse['warehouse_code'];
        }

        $this->view->productInventoryLog = $productInventoryLog;

        $inventoryBatch = Service_ProductInventory::getByCondition(array('product_id' => $productId), "*");
        foreach ($inventoryBatch as $k => $v) {
            $warehouse = Service_Warehouse::getByField($v['warehouse_id'], "warehouse_id", "*");
            $inventoryBatch[$k]['warehouse_code'] = $warehouse['warehouse_code'];
        }
        $this->view->inventoryBatch = $inventoryBatch;
        echo $this->view->render($this->tplDirectory . "product-detail.tpl");
        //echo Ec::renderTpl($this->tplDirectory . "product-detail.tpl", 'layout-index');
    }

    public function playflashAction()
    {
        echo Ec::renderTpl($this->tplDirectory . 'play-flash.tpl', 'noleftlayout');
    }

    /*产品详细信息*/
    public function detailAction()
    {
        ini_set('memory_limit', '512M');
        $this->view->ieType = Common_CommonConfig::getIeType2();
        $this->view->currency = Service_Currency::getCurrency();
        $this->view->currencycode = Service_Currency::getCurrencyCode();

        $productId = $this->_request->getParam("productId", "");
        $sku = trim($this->_request->getParam("sku", ""));
        $customer = $this->_customerAuth;
        $customerId = $customer['id'];
        $customer_code = $customer['code'];
        $productRow = Service_Product::getProductAllInfo($productId, $customerId, $sku);
        $productId = $productRow['product_id'];
        if (empty($productRow)) {
            exit('没有找到对应的产品资料.');
        }

        $productRow['ins_unit_name'] = '';
        if($productRow['ins_unit_code']){
            $check_org_item = Service_Organization::getByField($productRow['ins_unit_code'],'organization_code');
            $productRow['ins_unit_name'] = $check_org_item['organization_name'];
        }

        if ($productRow['product_type'] == '0' && $productRow['country_code_of_origin']) {
            $country_array = Service_Country::getByField($productRow['country_code_of_origin'], "country_code", "*");
            $productRow['country_code_of_origin_name'] = $country_array['country_name'];
            $productRow['trade_country'] = $country_array['trade_country'];
        }

        $productUom = Service_ProductUom::getByField($productRow['g_unit'], "pu_code", "*");
        $productSecondUom = Service_ProductUom::getByField($productRow['second_unit'], "pu_code", "*");
         $puCode = Service_ProductUom::getByField($productRow['pu_code'], "pu_code", "*");
        $productRow['first_uom'] = $productUom['pu_name'];
        $productRow['second_uom'] = $productSecondUom['pu_name'];
        $productRow['product_uom'] = $puCode['pu_name'];
        $productStatus = Service_Product::getStatus(); //Common_CommonConfig::getProductStatus();
        $ciqStatus = Service_Product::getCiqStatus();
        $customsStatus = Service_Product::getCustomsStatus();
        $iePortInfo = Service_IePort::getByField($productRow['customs_code'], 'ie_port');

        if ('' != $productRow['gt_code']) {
            $goodsTaxInfo = Service_GoodsTax::getByField($productRow['gt_code'], 'gt_code', array('gt_rate', 'gt_name'));
            if (!empty($goodsTaxInfo)) {
                $productRow['gt_rate'] = $goodsTaxInfo['gt_rate'];
                $productRow['gt_name'] = str_replace('－', '', $goodsTaxInfo['gt_name']);
            }
        }
        //商检用途
        $proUseWay = Service_SjUseWay::getByField($productRow['use_way'], 'x_code', array('x_name'));
        if(!empty($proUseWay)){
            $productRow['use_way'] = $proUseWay['x_name'];
        }
        $this->view->productRow = $productRow;
        $this->view->productStatus = $productStatus;
        $this->view->ciqStatus = $ciqStatus;
        $this->view->customsStatus = $customsStatus;

        $productLog = Service_ProductLog::getByCondition(array('product_id' => $productId), "*");
        $this->view->logStatus = array(
            '0' => '删除',
            '1' => '确认',
        );
        $this->view->productLog = $productLog;

        //0:在途;1:收货中;2:处理完成
        $this->view->asnStatusArr = array(
            '0' => '在途',
            '1' => '收货中',
            '2' => '处理完成',
        );
        $this->view->orderProduct = Service_OrderProduct::getByCondition(array('product_id' => $productId), "*");

        $productImage = Service_ProductAttached::getByCondition(array('product_id' => $productId), "*");

        $this->view->serverName = $_SERVER['SERVER_NAME'];
        $this->view->productImage = $productImage;
        $this->view->attachedType = Service_ProductProcess::getCiqAttachedType();
        $this->view->iePortInfo=$iePortInfo;
        //国检附件
        $supervisionAttachedData = array();
        $supervisionCode = Common_DataCache::getSupervisionCode();
        if (in_array($productRow['supervision_flag'], $supervisionCode)) {
            $supervision = Common_DataCache::getSupervision();
            $supervisionType = Common_DataCache::getTypeBySupervisionCode($productRow['supervision_flag']);
            $supervisionAttached = Service_ProductSupervisionAttached::getByCondition(array('product_id' => $productId), '*');
            $this->view->supervisionAttached = $supervisionAttached;
        }
        if ($productRow['product_type'] == "1") {
            $productCombineRelation = Service_ProductCombineRelation::getByCondition(array('product_id' => $productId), "*");
            $pcr = array();
            foreach ($productCombineRelation as $pcrk => $pcrv) {
                $p = Service_Product::getByField($pcrv['pcr_product_id'], 'product_id', "*");
                $category = Service_ProductCategory::getByField($p['pc_id'], "pc_id", "*");
                $p['category_name'] = $category['pc_name'];
                $p['pcr_quantity'] = $pcrv['pcr_quantity'];
                $p['pcr_add_time'] = $pcrv['pcr_add_time'];
                $pcr[] = $p;
            }
            $this->view->pcr = $pcr;
            echo Ec::renderTpl($this->tplDirectory . "combine-detail.tpl", 'noleftlayout');
        } else {
            echo Ec::renderTpl($this->tplDirectory . "detail.tpl", 'noleftlayout');
        }
        //echo Ec::renderTpl($this->tplDirectory . "detail.tpl",'noleftlayout');
        //echo $this->view->render($this->tplDirectory . "detail.tpl");
    }

    /*弹出框框以让客户选择海关编码--by colin-yang*/
    public function hscodeAuxiliaryInputAction()
    {

        $page = $this->getRequest()->getParam('page', 1);
        $pageSize = $this->getRequest()->getParam('pageSize', 20);
        $condition = array(
            'p_name'         => $this->getRequest()->getParam('p_name'),
            'hs_code'        => $this->getRequest()->getParam('s_hs_code'),
            'hs_code_status' => 1,

        );

        $from = $this->_request->getParam('from', '');
        $globals_hs_code = $this->_request->getParam("global_hs_code", "");
        //判断参数的有效性
        $inject = true;
        switch ($from) {
            case 'product':
                $inject = false;
                break;
            case 'asn':
                $inject = false;
            case 'order':
                $inject = false;
        }

        $this->view->from = $from;
        $this->view->params = $condition;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        $this->view->globals_hs_code = $globals_hs_code;

        $this->view->count = Service_Hscodes::getByCondition($condition, 'count(*)');

        $result = Service_Hscodes::getByCondition($condition, '*', 'hs_code DESC', $pageSize, $page);

        $this->view->result = $result;

        echo $this->view->render($this->tplDirectory . "hscodeAuxiliaryInput.tpl");
    }

    /*通过导入EXCEL文件*/
    public function batchInputAction()
    {
        $result = array("ask" => 0, "message" => "不明错误，导致失败", 'error' => array(), 'data' => array());
        $path = APPLICATION_PATH . '/../data';
        //$field = $this->getRequest()->getParam('XMLForInput', 'XMLForInput');
        $field = 'XMLForInput';
        $config = array();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '10000000000';
        $config['encrypt_name'] = true;
        $upload = new Common_UploadFile($config);
        $upload->set_upload_path($path);
        if (!$upload->do_upload($_FILES, $field)) {
            $result['error'] = "文件上传失败";
            echo json_encode($result);
            exit;
        }

        $resultArray = $upload->data();
        $full_path = $resultArray['full_path'];
        if (empty($resultArray) || empty($full_path)) {
            $result = array("ask" => 0, "message" => "上传文件失败", 'error' => array());
            echo json_encode($result);
            exit;
        }

        $resultArray = Common_Upload::readEXCEL($full_path);

        if (empty($resultArray) || !is_array($resultArray)) {
            $result = array("ask" => 0, "message" => "由于文件内容不符合预期导致数据为空.", 'error' => array());
            echo json_encode($result);
            exit;
        }
        @unlink($full_path);
        //读取product表根据XML中的SKU
        $found_product_results = array();

        $category = Common_DataCache::getProductCategory();
        foreach ($resultArray as $key => $row) {
            if ($key < 1) {
                continue;
            }
            //标题行不读
            $productsku = $row[0];
            $product_number = $row[1];
            $rouweight = $row[2];
            if (empty($productsku)) {
                continue;
            }

            $condition = array('product_sku' => $productsku, 'customer_id' => $this->_customerAuth['id']);
            $productInfo = Service_Product::getByCondition($condition);
            if (empty($productInfo)) {
                $product = array(
                    'product_id'     => '0',
                    'product_sku'    => $productsku,
                    'product_title'  => '',
                    'pc_id'          => '',
                    'product_weight' => '',
                    'product_number' => '',
                    'is_valid'       => '0',
                    'error'          => "SKU不存在<br/>",
                    'error_number'   => 1,
                );

                $found_product_results[] = $product;
                continue;
            } //if(empty($productInfo))

            $productInfo = $productInfo[0];
            if ($productInfo['product_type'] == '1') {
                $productInfo['product_weight'] = Service_Product::getCombineProductWeight($productInfo['product_id']);
            }

            $product = array(
                'product_id'     => $productInfo['product_id'],
                'product_sku'    => $productInfo['product_sku'],
                'product_title'  => $productInfo['product_title'],
                'pc_id'          => $productInfo['pc_id'],
                'product_weight' => $productInfo['product_weight'],
                'product_number' => $product_number,
                'rouweight'      => $rouweight,
                'is_valid'       => '1',
                'error'          => '',
                'error_number'   => 0,

            );
            //$found_product_results[] = $product;
            if (isset($category[$product['pc_id']])) {
                $product['pc_name'] = $category[$product['pc_id']]['pc_name'];
            } else {
                $product['pc_name'] = '';
            }

            //判断产品类型是否正确
            /*
            if($productInfo['product_type']!='0'){
            $product['is_valid'] = '0'; //这个产品不能使用
            $product['error'].='不为普通产品<br/>';
            $product['error_number']+=1;
            }*/

            //判断产品状态是否正确
            if ($productInfo['product_status'] != '1') {
                $product['is_valid'] = '0';
                $product['error'] .= '产品未备案<br/>';
                $product['error_number'] += 1;

            }
            $product_number = intval($product_number);
            if (!($product_number && is_numeric($product_number) && $product_number > 0)) {
                $product['error'] .= '产品数量必填<br/>';
                $product['error_number'] += 1;

            }
            //$rouweight = intval($rouweight);
            /*if(!($rouweight && is_numeric($rouweight) && $rouweight>0)){
            $product['error'].= '毛重必填<br/>';
            $product['error_number']+=1;
            }    */
            /*
            //判断客户是否一致
            if($productInfo['customer_id']!=$this->_customerAuth['id']){
            $product['is_valid'] = '0';
            $productError = $product['error'];
            $productError[] = $productInfo['product_sku'].'产品和客户不一致';
            $product['error'] = $productError;
            }
             */

            $found_product_results[] = $product;

        } //foreach($resultArray

        if (empty($found_product_results) || !is_array($found_product_results)) {
            $result = array("ask" => 0, "message" => "在产品资料库中抄不到对应的数据.", 'error' => array());
            echo json_encode($result);
            exit;
        }
        //从所有合格不合格的数据中分离出合格与不合格

        $correct_product_results = array();
        $incorrect_product_results = array();

        foreach ($found_product_results as $k => $row) {

            if ($row['error_number'] > 0) {
                $incorrect_product_results[] = $row;
            } else {
                $correct_product_results[] = $row;
            }

        }
        //echo "sdf";exit;

        $result = array("ask" => '1', 'data' => $correct_product_results, 'errordata' => $incorrect_product_results);

        if ($result['errordata'][0]['error_number'] > 0) {
            $result['data'] = '';
        }
        echo json_encode($result);
        exit;

    } //function end

    /*城市*/
    public function cityInputAction()
    {
        $province_id = $this->getRequest()->getParam('province_id', 0);
        if (!$province_id) {
            echo "";
            exit;
        } //if(!$province_id)
        $city_array = Service_Region::getByCondition(array('parent_id' => $province_id));
        echo json_encode($city_array);
        exit;

    } //function end

    /**
     * @author william-fan
     * @todo 选择产品模板
     */
    public function selectProductTempleteAction()
    {
        $fullPath = APPLICATION_PATH . "/../data/file" . '/productDemo.xls';
        //方法2
        $filename = basename($fullPath);
        header("Content-Type: APPLICATION/OCTET-STREAM");
        //Force the download
        $header = "Content-Disposition: attachment; filename=" . $filename . ";";
        header($header);
        //     header("Content-Transfer-Encoding: binary");
        //     header("Content-Length: ".$len);
        echo file_get_contents($fullPath);
        exit;
    }

    /**
     * @author colin-yang
     * @todo 用于下载产品模板
     */
    public function productSelectTempleteAction()
    {
        $fullPath = APPLICATION_PATH . "/../data/file" . '/productSelect.xls';
        //方法2
        $filename = basename($fullPath);
        header("Content-Type: APPLICATION/OCTET-STREAM");
        //Force the download
        $header = "Content-Disposition: attachment; filename=" . $filename . ";";
        header($header);
        //     header("Content-Transfer-Encoding: binary");
        //     header("Content-Length: ".$len);
        echo file_get_contents($fullPath);
        exit;
    }

    public function safeInventoryListAction()
    {
        $page = $this->getRequest()->getParam('page', 1);
        $pageSize = $this->getRequest()->getParam('pageSize', 20);
        $condition = array(
            'customer_id'      => $this->_customerAuth['id'],
            'product_sku_like' => $this->getRequest()->getParam('product_sku'),
            'warehouse_id'     => $this->getRequest()->getParam('warehouse_id'),
        );
        $this->view->condition = $condition;
        $this->view->params = $condition;
        $this->view->pageSize = $pageSize;
        $this->view->page = $page;
        $this->view->count = Service_SafeInventory::getByCondition($condition, "count(*)");
        $result = Service_SafeInventory::getByCondition($condition, '*', $pageSize, $page, 'si_id DESC');
        foreach ($result as $key => $value) {
            $warehouse = Service_Warehouse::getByField($value['warehouse_id'], "warehouse_id", "*");
            $result[$key]['warehouse_code'] = $warehouse['warehouse_code'];
            $result[$key]['warehouse_name'] = $warehouse['warehouse_name'];
        }
        $this->view->result = $result;
        $this->view->warehouse = Service_Warehouse::getAll();
        echo Ec::renderTpl($this->tplDirectory . 'safe-inventory-list.tpl', 'noleftlayout');
    }

    public function addSafeInventoryAction()
    {
        //$si_id = $this->_request->getParam('si_id',"0");
        $safeNumber = $this->_request->getParam('safeNumber', "");
        $productSku = $this->_request->getParam("product_sku", "");
        $warehouse_id = $this->_request->getParam('warehouse_id', "");
        $productId = $this->_request->getParam("product_id", "");
        $error = array();
        $productInfo = array();
        if (empty($productSku)) {
            //please_select_product
            $error[] = Ec_Lang::getInstance()->getTranslate('please_select_product');
        } else {
            foreach ($productSku as $key => $value) {
                $p = array();
                $p['safe_number'] = $safeNumber[$key];
                $p['product_sku'] = $productSku[$key];
                $p['product_id'] = $productId[$key];
                if (!(is_numeric($safeNumber[$key]) && intval($safeNumber[$key]) == $safeNumber[$key] && $safeNumber[$key] > 0)) {
                    $error[] = Ec_Lang::getInstance()->getTranslate('product') . $productSku[$key] . Ec_Lang::getInstance()->getTranslate('Safety_stock_must_be_a_positive_integer');
                }
                $productInfo[] = $p;
            }
        }
        $result = array(
            'state'   => '0',
            'message' => array(),
            'error'   => array(),
        );
        if (!empty($error)) {
            $result['error'] = $error;
            die(json_encode($result));
        }
        $messageArr = array();
        foreach ($productInfo as $k => $v) {
            $sf = Service_SafeInventory::getByCondition(
                array('product_sku' => $v['product_sku'], 'warehouse_id' => $warehouse_id), "product_id", "*");
            if (!empty($sf)) {
                $update = array(
                    'safe_number'  => $v['safe_number'],
                    'warehouse_id' => $warehouse_id,
                    'update_time'  => date("Y-m-d H:i:s"),
                );
                Service_SafeInventory::update($update, $sf[0]['si_id'], "si_id");
                $messageArr[] = Ec_Lang::getInstance()->getTranslate('product') . $v['product_sku'] . "," . Ec_Lang::getInstance()->getTranslate('safety_stock_update_success');
            } else {
                $row = array(
                    'safe_number'  => $v['safe_number'],
                    'product_id'   => $v['product_id'],
                    'product_sku'  => $v['product_sku'],
                    'warehouse_id' => $warehouse_id,
                    'customer_id'  => $this->_customerAuth['id'],
                    'add_time'     => date("Y-m-d H:i:s"),
                );
                Service_SafeInventory::add($row);
                $messageArr[] = Ec_Lang::getInstance()->getTranslate('product') . $v['product_sku'] . Ec_Lang::getInstance()->getTranslate('safety_stock_add_success');
            }
        }
        $result['state'] = "1";
        $result['message'] = $messageArr;
        die(json_encode($result));

    }

    public function editSafeInventoryAction()
    {
        $si_id = $this->_request->getParam('si_id', "0");
        $safeNumber = $this->_request->getParam('safe_number', "");

        $error = array();

        if (!(is_numeric($safeNumber) && intval($safeNumber) == $safeNumber && $safeNumber > 0)) {
            $error[] = Ec_Lang::getInstance()->getTranslate('Safety_stock_must_be_a_positive_integer'); //Safety_stock_must_be_a_positive_integer
        }
        $result = array(
            'state'   => '0',
            'message' => '',
            'error'   => array(),
        );
        if (!empty($error)) {
            $result['error'] = $error;
            die(json_encode($result));
        }
        $sfRow = Service_SafeInventory::getByField($si_id, "si_id", "*");
        $update = array(
            'safe_number' => $safeNumber,
            'update_time' => date("Y-m-d H:i:s"),
        );
        Service_SafeInventory::update($update, $si_id, "si_id");
        $result['state'] = "1";
        $result['message'] = Ec_Lang::getInstance()->getTranslate('product') . $sfRow['product_sku'] . Ec_Lang::getInstance()->getTranslate('safety_stock_update_success');
        die(json_encode($result));
    }

    //Unknown_error_resulting_in_failure
    public function batchInputSafeNumberAction()
    {
        $result = array("ask" => 0, "message" => Ec_Lang::getInstance()->getTranslate('Unknown_error_resulting_in_failure'), 'data' => array());
        $path = APPLICATION_PATH . '/../data';
        //$field = $this->getRequest()->getParam('XMLForInput', 'XMLForInput');
        $field = 'XMLForInput';
        $config = array();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '10000000000';
        $config['encrypt_name'] = true;
        $upload = new Common_UploadFile($config);
        $upload->set_upload_path($path);
        if (!$upload->do_upload($_FILES, $field)) {
            $result['message'] = Ec_Lang::getInstance()->getTranslate('Failed_to_upload_file');
            echo json_encode($result);
            exit;
        }

        $resultArray = $upload->data();
        $full_path = $resultArray['full_path'];
        if (empty($resultArray) || empty($full_path)) {
            $result = array("ask" => 0, "message" => Ec_Lang::getInstance()->getTranslate('Failed_to_upload_file'));
            echo json_encode($result);
            exit;
        }

        $resultArray = Common_Upload::readEXCEL($full_path);

        if (empty($resultArray) || !is_array($resultArray)) {
            $result = array("ask" => 0, "message" => Ec_Lang::getInstance()->getTranslate('The_contents_of_the_file_does_not_match_the_expected_result_data_is_empty'));
            echo json_encode($result);
            exit;
        }
        @unlink($full_path);
        //读取product表根据XML中的SKU
        $found_product_results = array();
        $category = Common_DataCache::getProductCategory();
        $dataArray = array();
        foreach ($resultArray as $key => $row) {
            if ($key < 1) {
                continue;
            }
            $productSku = $row[0];
            $warehouseCode = $row[1];
            $safeNumber = $row[2];
            $em = array();
            $errorMessage = "";
            if ($productSku == "") {
                $errorMessage .= Ec_Lang::getInstance()->getTranslate('SKU_cannot_be_empty');
            }
            if ($warehouseCode == "") {
                $errorMessage .= Ec_Lang::getInstance()->getTranslate('The_warehouse_can_not_be_empty');
            }
            if ($safeNumber == "") {
                $errorMessage .= Ec_Lang::getInstance()->getTranslate('Safety_stock_can_not_be_empty');
            }
            if ($errorMessage != "") {
                $em['product_sku'] = $productSku;
                $em['error'] = $errorMessage;
                $dataArray[] = $em;
                continue;
            }
            $warehouse = Service_Warehouse::getByField($warehouseCode, "warehouse_name", "*");
            if (empty($warehouse)) {
                $errorMessage .= vsprintf(Ec_Lang::getInstance()->getTranslate('warehouse_not_existsEc_Lang'), array($warehouseCode));
                $em['product_sku'] = $productSku;
                $em['error'] = $errorMessage;
                $dataArray[] = $em;
                continue;
            }
            $condition = array(
                'product_sku' => $productSku,
                'customer_id' => $this->_customerAuth['id'],
            );
            $product = Service_Product::getByCondition($condition, "*");
            if (empty($product)) {
                $errorMessage .= vsprintf(Ec_Lang::getInstance()->getTranslate('product_not_exists'), array($productSku));
                $em['product_sku'] = $productSku;
                $em['error'] = $errorMessage;
                $dataArray[] = $em;
                continue;
            }
            if (!(is_numeric($safeNumber) && intval($safeNumber) == $safeNumber && $safeNumber > 0)) {
                $errorMessage .= Ec_Lang::getInstance()->getTranslate('Safety_stock_must_be_a_positive_integer');
                $em['product_sku'] = $productSku;
                $em['error'] = $errorMessage;
                $dataArray[] = $em;
                continue;
            }
            $safeInventory = Service_SafeInventory::getByCondition(
                array(
                    'product_id'   => $product[0]['product_id'],
                    'warehouse_id' => $warehouse['warehouse_id'],
                ), "product_id", "*");
            if (!empty($safeInventory)) {
                $updateSI = array(
                    'safe_number' => $safeNumber,
                    'update_time' => date("Y-m-d H:i:s"),
                );
                Service_SafeInventory::update($updateSI, $safeInventory[0]['product_id'], 'product_id');
                $errorMessage .= vsprintf(Ec_Lang::getInstance()->getTranslate('product_safety_stock_update_success'), array($productSku));
                $em['product_sku'] = $productSku;
                $em['error'] = $errorMessage;
                $dataArray[] = $em;
                continue;
            } else {
                $addRow = array(
                    'product_id'   => $product[0]['product_id'],
                    'product_sku'  => $productSku,
                    'customer_id'  => $this->_customerAuth['id'],
                    'safe_number'  => $safeNumber,
                    'warehouse_id' => $warehouse['warehouse_id'],
                    'add_time'     => date("Y-m-d H:i:s"),
                    'update_time'  => date("Y-m-d H:i:s"),
                );
                Service_SafeInventory::add($addRow);
                $errorMessage .= vsprintf(Ec_Lang::getInstance()->getTranslate('product_safety_stock_add_success'), array($productSku));
                $em['product_sku'] = $productSku;
                $em['error'] = $errorMessage;
                $dataArray[] = $em;
            }
        }
        //$result['message'] = "";
        $result['data'] = $dataArray;
        $result['ask'] = "1";
        //die("1");
        echo json_encode($result);
        exit;
    }

    public function deleteSafeInventoryAction()
    {
        $si_id = $this->_request->getParam('si_id', "");
        Service_SafeInventory::delete($si_id, "si_id");
        $this->_redirect("/merchant/product/safe-inventory-list");
    }

    public function productSfTempleteAction()
    {
        $fullPath = APPLICATION_PATH . "/../data/file" . '/safenumber.xls';
        //方法2
        $filename = basename($fullPath);
        header("Content-Type: APPLICATION/OCTET-STREAM");
        //Force the download
        $header = "Content-Disposition: attachment; filename=" . $filename . ";";
        header($header);
        //     header("Content-Transfer-Encoding: binary");
        //     header("Content-Length: ".$len);
        echo file_get_contents($fullPath);
        exit;
    }

    public function getProductInventoryLogAction()
    {
        $page = $this->_request->getParam('page', 1);
        $pageSize = $this->_request->getParam('pageSize', 20);

        $page = $page ? $page : 1;
        $pageSize = $pageSize ? $pageSize : 20;
        $pageSize = min($pageSize, 1000);
        $productId = $this->_request->getParam("product_id", "");
        $count = Service_ProductInventoryLog::getByCondition(array('product_id' => $productId), "count(*)");
        $page = $page > ceil($count / $pageSize) ? ceil($count / $pageSize) : $page;
        $productInventoryLog = Service_ProductInventoryLog::getByCondition(array('product_id' => $productId), "*", $pageSize, $page, "pil_id desc");

        foreach ($productInventoryLog as $k => $v) {
            $warehouse = Service_Warehouse::getByField($v['warehouse_id'], "warehouse_id", "*");
            $productInventoryLog[$k]['warehouse_code'] = $warehouse['warehouse_code'];
            $productInventoryLog[$k]['warehouse_name'] = $warehouse['warehouse_name'];
            $productInventoryLog[$k]['from_it_code'] = Ec_Lang::getInstance()->getTranslate($v['from_it_code']);
            $productInventoryLog[$k]['to_it_code'] = Ec_Lang::getInstance()->getTranslate($v['to_it_code']);
        }

        $return = array(
            'url'      => $_SERVER['REQUEST_URI'],
            'page'     => $page,
            'pageSize' => $pageSize,
            'total'    => $count,
            'data'     => $productInventoryLog,
        );
        die(json_encode($return));
    }

    public function exportAction()
    {
        require_once APPLICATION_PATH . '/../libs/PHPExcel.php';
        require_once APPLICATION_PATH . '/../libs/PHPExcel/IOFactory.php';
        $table = new PHPExcel();
        $table->getDefaultStyle()->getFont()->setName('宋体');
        $table->setActiveSheetIndex(0);
        $table->setActiveSheetIndex(0)->setTitle(Ec_Lang::getInstance()->getTranslate('product'));
        $objActSheet = $table->setActiveSheetIndex(0);

        $objActSheet->getColumnDimension('A')->setWidth(10);
        $objActSheet->getColumnDimension('B')->setWidth(20);
        $objActSheet->getColumnDimension('C')->setWidth(20);
        $objActSheet->getColumnDimension('D')->setWidth(10);
        $objActSheet->getColumnDimension('E')->setWidth(10);
        $objActSheet->getColumnDimension('F')->setWidth(10);
        $objActSheet->getColumnDimension('G')->setWidth(10);

        $objActSheet->setCellValue('A1', Ec_Lang::getInstance()->getTranslate('ProductSKU'));
        $objActSheet->setCellValue('B1', Ec_Lang::getInstance()->getTranslate('productTitle'));
        $objActSheet->setCellValue('C1', Ec_Lang::getInstance()->getTranslate('BarcodeType'));
        $objActSheet->setCellValue('D1', Ec_Lang::getInstance()->getTranslate('productBarcode1'));
        $objActSheet->setCellValue('E1', Ec_Lang::getInstance()->getTranslate('ProductCategory'));
        $objActSheet->setCellValue("F1", Ec_Lang::getInstance()->getTranslate('productStatus'));
        $objActSheet->setCellValue("G1", Ec_Lang::getInstance()->getTranslate('customsDeclarationElement'));
        $objActSheet->setCellValue("H1", Ec_Lang::getInstance()->getTranslate('goodsTaxCode'));
        $objActSheet->setCellValue("I1", Ec_Lang::getInstance()->getTranslate('goodsId'));
        $objActSheet->setCellValue("J1", Ec_Lang::getInstance()->getTranslate('CustomsGoodsName'));
        $objActSheet->setCellValue("K1", Ec_Lang::getInstance()->getTranslate('businessCode'));
        $objActSheet->setCellValue("L1", Ec_Lang::getInstance()->getTranslate('addTime'));

        $condition = array(
            'customer_id'      => $this->_customerAuth['id'],
            'product_type'     => $this->getRequest()->getParam('product_type'),
            'comefrom'         => 1,
            'product_sku'      => $this->getRequest()->getParam('sku'),
            'product_title'    => $this->getRequest()->getParam('title'),
            'pc_id'            => $this->getRequest()->getParam('type'),
            'product_add_time' => $this->getRequest()->getParam('start_time'),
            'product_end_time' => $this->getRequest()->getParam('end_time'),
            'product_status'   => $this->getRequest()->getParam('status'),

        );
        $pageSize = 20;
        $index = 2;
        $count = Service_Product::getByCondition($condition, 'count(*)');
        if ($count) {
            $category = Common_DataCache::getProductCategory();
            $status = array("备案中", "已备案", "草稿", "确认");
            $tempCategory = array();
            foreach ($category as $key => $val) {
                $tempCategory[$val['pc_id']] = $val['pc_name'];
            }
            $pages = ceil($count / $pageSize);
            for ($page = 1; $page <= $pages; $page++) {
                $result = Service_Product::getByCondition($condition, '*', 'product_id DESC', $pageSize, $page);
                foreach ($result as $key => $val) {
                    $type = '';
                    $customsDeclarationElement = array();
                    $objActSheet->setCellValueExplicit("A" . $index, $val['product_sku'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("B" . $index, $val['product_title'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $hsElementMap = Service_HsElementMap::getByCondition(array('product_id' => $val['product_id']));
                    $productGoods = Service_ProductGoods::getByField($val['product_id'], 'product_id'); //产品备案
                    $registerID = isset($productGoods['registerID']) ? $productGoods['registerID'] : '';
                    foreach ($hsElementMap as $v) {
                        $customsDeclarationElement[] = $v['hem_detail'];
                    }
                    if (0 == $val['product_barcode_type']) {
                        $type = '默认类型';
                    } else if (1 == $val['product_barcode_type']) {
                        $type = '自定义类型';
                    } else if (2 == $val['product_barcode_type']) {
                        $type = '序列类型';
                    }
                    $objActSheet->setCellValueExplicit("C" . $index, $type, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("D" . $index, $val['product_barcode'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("E" . $index, $tempCategory[$val['pc_id']], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("F" . $index, $status[$val['product_status']], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("G" . $index, join('|', $customsDeclarationElement), PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("H" . $index, $val['gt_code'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("I" . $index, $val['goods_id'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("J" . $index, $val['hs_goods_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("K" . $index, $registerID, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objActSheet->setCellValueExplicit("L" . $index, $val['product_add_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $index++;
                }
            }
        }
        $objWriter = PHPExcel_IOFactory::createWriter($table, 'Excel5');
        header("Pragma: public");
        header("Expires: 0");
        header("Accept-Ranges: bytes");
        header('cache-control:must-revalidate');
        header("Content-Disposition: attachment; filename=product" . date('Y-m-d') . ".xls");
        header("Content-Type:APPLICATION/OCTET-STREAM;charset=utf-8");
        $objWriter->save('php://output');
    }

    /**
     * @author luffy丶大叔
     * 联动监管类别附件
     */
    public function getProductSupervisionTypeAction()
    {
        $product_sku = trim($this->_request->getParam('product_sku', ""));
        $result = array(
            'state'   => '0',
            'message' => '',
            'error'   => '',
        );
        if ($product_sku) {
            $productRow = Service_Product::getByField($product_sku, 'product_sku', array('supervision_flag', 'product_id', 'product_status', 'customer_id'));
            if ($productRow && $productRow['customer_id'] == $this->_customerAuth['id']) {
                if ($productRow['product_status'] == 2 || $productRow['product_status'] == 3) {
                    $type = Common_DataCache::getTypeBySupervisionCode($productRow['supervision_flag']);
                    if ($type && is_array($type)) {
                        $types = array();
                        //取得附件
                        foreach ($type as $key => $item) {
                            $condition = array(
                                'product_id' => $productRow['product_id'],
                                'st_id'      => $key,
                            );
                            $data = Service_ProductSupervisionAttached::getByCondition($condition, '*');
                            $types[$key] = array(
                                'name' => $item,
                                'data' => $data,
                            );
                        }

                        $result['state'] = '1';
                        $result['data'] = $types;
                    } else {
                        $result['error'] = '监管类别附件名称不存在！';
                    }
                } else {
                    $result['error'] = '产品已提交至备案！';
                }
            } else {
                $result['error'] = 'SUK对应的产品不存在！';
            }
        } else {
            $result['error'] = 'sku不能为空！';
        }
        die(json_encode($result));
    }

    /**
     * @author luffy丶大叔
     * @todo 产品附件上传
     */
    public function batchUploadAttachedAction()
    {
        echo Ec::renderTpl($this->tplDirectory . "batch-upload-attached.tpl", 'noleftlayout');
    }

    /**
     * @author luffy丶大叔
     * @throws 上传附件
     */
    public function uploadHtml5Action()
    {
        $result = array(
            'state'   => '0',
            'message' => '',
            'error'   => array(),
        );
        if (!$this->_request->isPost()) {
            $result['error'] = '未知错误！';
            die(json_encode($result));
        }

        $product_sku = trim($this->_request->getParam('product_sku', ""));
        $data = $this->_request->getParam('data', "");
        $key = $this->_request->getParam('key', '');
        $sum = intval($this->_request->getParam('sum', 1));

        if ($product_sku && $data) {
            $db = Service_QualityControl::getModelInstance()->getAdapter();
            $db->beginTransaction();
            try {
                $productRow = Table_Product::getInstance()->getByFieldForUpdate($product_sku, 'product_sku');
                if (!$productRow) {
                    throw new Exception('产品不存在！');
                }
                if ($productRow['product_status'] == 2 || $productRow['product_status'] == 3) {

                    $count = Service_ProductSupervisionAttached::getByCondition(array(
                        'product_id' => $productRow['product_id'],
                    ), 'count(*)');
                    if ($count > 20) {
                        throw new Exception('国检类别附件最多上传20个！');
                    }
                    $condition = array(
                        'product_id' => $productRow['product_id'],
                        'st_id'      => $key,
                    );
                    $max = Service_ProductSupervisionAttached::getByCondition($condition, 'max(sort)');
                    $max = ($max == '') ? 0 : $max;
                    $sort = $max + 1;
                    $filePath = "/home/supervision_data/" . date('Ymd') . "/";
                    if (!is_dir($filePath)) {
                        if (!mkdir($filePath, 0777, true)) {
                            throw new Exception("目录创建不成功【{$filePath}】不可写");
                        }
                    }
                    if (!is_writable($filePath)) {
                        throw new Exception("文件目录【{$filePath}】不可写");
                    }
                    $fileNmae = $filePath . "{$productRow['goods_id']}-{$productRow['supervision_flag']}-{$key}-{$sort}";
                    if ($fileext = Common_DataCache::html5Upload($data, $fileNmae)) {
                        $row = array(
                            'product_id'       => $productRow['product_id'],
                            'st_id'            => $key,
                            'supervision_flag' => $productRow['supervision_flag'],
                            'fileext'          => $fileext,
                            'filepath'         => $fileNmae . $fileext,
                            'sort'             => $sort,
                        );
                        $psa_id = Service_ProductSupervisionAttached::add($row);
                        $result['data'] = array(
                            'product_id' => $productRow['product_id'],
                            'psa_id'     => $psa_id,
                        );
                        $result['state'] = 1;
                        $db->commit();
                    } else {
                        throw new Exception('文件上传错误！');
                    }
                } else {
                    throw new Exception('产品已提交至备案不能上传附件！');
                }
            } catch (Exception $exc) {
                $db->rollBack();
                $result['error'] = $exc->getMessage();
            }
        }
        die(json_encode($result));
    }

    /**
     * @author luffy丶大叔
     * @todo 删除产品附件
     */
    public function delProductSupervisionTypeAction()
    {
        $result = array(
            'state'   => '0',
            'message' => '',
            'error'   => array(),
        );
        if (!$this->_request->isPost()) {
            $result['error'] = '未知错误！';
            die(json_encode($result));
        }
        $db = Service_QualityControl::getModelInstance()->getAdapter();
        $db->beginTransaction();
        try {
            $psa_id = intval($this->_request->getParam('psa_id', 0));
            if (!$psa_id) {
                throw new Exception('参数错误!');
            }
            $row = Service_ProductSupervisionAttached::getByField($psa_id);
            if (!$row) {
                throw new Exception('数据不存在或者已删除!');
            }
            $productRow = Table_Product::getInstance()->getByFieldForUpdate($row['product_id'], 'product_id', array('customer_id', 'product_status'));
            if (!$productRow || $productRow['customer_id'] != $this->_customerAuth['id']) {
                throw new Exception('产品不存在!');
            }
            if (!($productRow['product_status'] == 2 || $productRow['product_status'] == 3)) {
                throw new Exception('产品已提交至备案不能上传附件!');
            }
            if (!file_exists($row['filepath'])) {
                throw new Exception("【{{$row['filepath']}}】文件不存在!");
            }
            if (!unlink($row['filepath'])) {
                throw new Exception("【{$row['filepath']}】文件删除失败!");
            }
            if (Service_ProductSupervisionAttached::delete($psa_id)) {
                $result['state'] = 1;
            } else {
                throw new Exception('没有成功删除!');
            }
            $db->commit();
        } catch (Exception $exc) {
            $db->rollBack();
            $result['error'] = $exc->getMessage();
        }
        die(json_encode($result));
    }
    /**
     * [printAction 下载CIQ备案表格]
     * @return [type] [description]
     */
    public function printAction()
    {
        $productId = $this->_request->getParam('productId', "");
        if (empty($productId)) {
            header("Location:/");
            exit;
        }else {
            $productData = Service_Product::getByField($productId);
            if(empty($productData)){
                die('Products not found');
            }
            $use_way = Service_SjUseWay::getByField($productData['use_way'], 'x_code', array('x_name'));
            //最小单位
            $pu_name = Service_ProductUom::getByField($productData['pu_code'], 'pu_code', array('pu_name'));
            //法定单位
            $g_unit = Service_ProductUom::getByField($productData['g_unit'], 'pu_code', array('pu_name'));
            //属地检验检疫机构
            $ins_unit_code = Service_Organization::getByField($productData['ins_unit_code'], 'organization_code', array('organization_name'));
            $productData['use_way'] = $use_way['x_name'];
            $productData['pu_code'] = $pu_name['pu_name'];
            $productData['g_unit'] = $g_unit['pu_name'];
            $productData['ins_unit_code'] = $productData['ins_unit_code'].'-'.$ins_unit_code['organization_name'];
        }
        $this->view->productData = $productData;
        echo $this->view->render($this->tplDirectory . "print.tpl");
    }
}
