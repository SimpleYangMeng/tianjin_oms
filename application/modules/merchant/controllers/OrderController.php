<?php

class Merchant_OrderController extends Ec_Controller_Action {

    public function preDispatch ()
    {
        $this->tplDirectory = "merchant/views/order/";
    }
    /**
     * 创建订单
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function createAction()
    {

        if($this->_request->isPost()){
            $params = $this->_request->getParams();
            $result = array(
                'ask'=>'0',
                'message'=>''
            );
            // print_r($params['product']);die();
            if(!isset($params['product'])){
                die(json_encode($result));
            }
            $productData = array(
                "quantity","price","total_price","currency_code","gift_flag","product_model","note"
            );
            //订单数据
            $orderRequestRow = array(
                'ie_type' => $params['ie_type'],
                'customs_code' => $params['ie_port'],
                'app_status' => '2',
                'goods_amount' => $params['goods_amount'],
                'freight' => $params['freight'],
                'currency_code' => $params['currency_code'],
                'pro_amount' => $params['pro_amount'],
                'pro_remark' => $params['pro_remark'],
                'reference_no' => $params['reference_no'],
                'tax_total' => $params['tax_total'],
                'acctual_paid' => $params['acctual_paid'],
                'buyer_reg_no' => $params['buyer_reg_no'],
                'buyer_name' => $params['buyer_name'],
                'buyer_id' => $params['buyer_id'],
                'ecommerce_platform_customer_code' => $params['ecommerce_platform_customer_code'],
                'note' => isset($params['note']) ? $params['note'] : ''
            );
            //订单收货人数据
            $orderAddressBookRequestRow = array(
                'consignee' => $params['consignee'],
                'consignee_country' => $params['consignee_country'],
                'consignee_addres' => $params['consignee_addres'],
                'consignee_telephone' => $params['consignee_telephone'],
                'consignee_fax' => $params['consignee_fax'],
                'consignee_id_number' => $params['consignee_id_number'],
                'consignee_email' => $params['consignee_email'],
            );
            $orderPorductRequestRows = $params['product'];

            $orderInfo = array(
                'orderRow' => $orderRequestRow,
                'orderAddressBookRow' => $orderAddressBookRequestRow,
                'orderPorductRows' => $orderPorductRequestRows,
            );

            $object = new Service_OrderProcess();
            if(isset($params['order_code'])){
                $result = $object->updateOrderTransaction($orderInfo, $params['order_code'], $this->_customerAuth['account_code']);
            }else{
                $result = $object->createOrderTransaction($orderInfo, $this->_customerAuth['account_code']);
            }
            die(json_encode($result));
        }


        $iePortRows = Common_DataCache::getIePort();
        $appTypeRows = Common_CommonConfig::getOrderAppStatus();
        $ieTypeRows = Service_Orders::getIeType();
        $currencyRows = Common_DataCache::getCurrency();
        $countryRows = Common_DataCache::getCountry();
        $this->view->customerAuthRows = $this->_customerAuth;
        $this->view->currencyRows = $currencyRows;
        $this->view->ieTypeRows = $ieTypeRows;
        $this->view->appTypeRows = $appTypeRows;
        $this->view->iePortRows = $iePortRows;
        $this->view->countryRows = $countryRows;
        echo Ec::renderTpl($this->tplDirectory . 'order-create.tpl', 'noleftlayout');
        exit;

    }

    /**
     * [listAction description]
     * @return [type] [description]
     */
    public function listAction()
    {

        $params = $this->_request->getParams();
        $page       = isset($params['page']) ? intval($params['page']) : 1;
        $pageSize   = isset($params['pageSize']) ? intval($params['pageSize']) : 20;
        $customerType = '';
        $conditioin = array();
        $conditioin['customer_code'] = $this->_customerAuth['code'];
        $conditioin['order_status'] = isset($params['order_status']) ? $params['order_status'] : '';
        $conditioin['order_code'] = isset($params['order_code']) ? $params['order_code'] : '';
        $conditioin['reference_no'] = isset($params['reference_no']) ? $params['reference_no'] : '';
        $conditioin['order_add_time'] = isset($params['start_time']) ? $params['start_time'] : '';
        $conditioin['order_end_time'] = isset($params['end_time']) ? $params['end_time'] : '';
        $conditioin['customs_code'] = isset($params['customs_code']) ? $params['customs_code'] : '';
        $conditioin['ciq_status'] = isset($params['ciq_status']) ? $params['ciq_status'] : '';
        // 下面两个参数是定死的
        $conditioin['ie_type'] = $params['type'];

        $iePortRows = Common_DataCache::getIePort();

        $count = Service_Orders::getByCondition($conditioin , 'count(*)');
        $statusGroupRows = Service_Orders::getGroupByCondition($conditioin, 'order_status');
        if($count > 0){
            $ordersRows = Service_Orders::getByCondition($conditioin , '*' , $pageSize , $page, 'order_id DESC');
            if(is_array($ordersRows) && !empty($ordersRows)){
                $newOrdersRows = array();
                foreach ($ordersRows as $key => $value) {
                    $newOrdersRows[$key] = $value;
                    $newOrdersRows[$key]['status'] = Service_Orders::getOrderStatus($value['order_status']);
                    $newOrdersRows[$key]['app_status'] = Service_Orders::getAppStatus($value['app_status']);
                    $newOrdersRows[$key]['app_type'] = Service_Orders::getAppType($value['app_type']);
                    $newOrdersRows[$key]['customs_code'] = $iePortRows[$value['customs_code']]['ie_port_name'];
                    $newOrdersRows[$key]['ciq_status'] = Service_Orders::getCiqStatus($value['ciq_status']);
                }
                $this->view->newOrdersRows = $newOrdersRows;
            }
        }

        $this->view->count = $count;
        $this->view->orderStatus = Service_Orders::getOrderStatus();
        $this->view->page = $page;
        $this->view->pageSize = $pageSize;
        $this->view->conditioin = $conditioin;
        $this->view->statusGroupRows = $statusGroupRows;
        $this->view->customerType = $customerType;
        $this->view->iePortRows = $iePortRows;
        $this->view->ciqStatus = Service_Orders::getCiqStatus();
        echo Ec::renderTpl($this->tplDirectory . 'order-list.tpl', 'noleftlayout');
        exit;

    }

    /**
     * [viewAction description]
     * @return [type] [description]
     */
    public function viewAction()
    {
        $orderCode = trim($this->_request->getParam('order_code'));

        $conditioin = array();

        if($this->_customerAuth['account_level'] == 0){
            $conditioin['customer_code'] = $this->_customerAuth['code'];
        }else{
            $conditioin['account_code'] = $this->_customerAuth['account_code'];
        }
        $conditioin['order_code'] = $orderCode;

        $orderRows = Service_Orders::getByCondition($conditioin);
        if(empty($orderRows) || !isset($orderRows[0])){
            die('找不到这个订单编号！');
        }
        $orderRow = $orderRows[0];
        $orderRow['ie_name'] = Service_Orders::getIeType($orderRow['ie_type']);
        $orderRow['app_status'] = Service_Orders::getAppStatus($orderRow['app_status']);
        $orderRow['order_status'] = Service_Orders::getOrderStatus($orderRow['order_status']);
        $orderRow['customs_status'] = Service_Orders::getCustomsStatus($orderRow['customs_status']);
        $orderRow['ciq_status'] = Service_Orders::getCiqStatus($orderRow['ciq_status']);



        $orderProductRows = Service_OrderProduct::getByCondition(array(
            'order_code' => $orderCode
        ));

        $orderAddressBookRow = Service_OrderAddressBook::getByField($orderCode , 'order_code');
        $countryRow = Common_DataCache::getCountryByCode($orderAddressBookRow['consignee_country']);
        $orderAddressBookRow['country_name'] = $countryRow['country_name'];

        $orderLogRows = Service_OrderLog::getByCondition(array(
            'order_code' => $orderCode
        ));


        foreach ($orderProductRows as $key => $orderProductRow) {
            $orderProductRows[$key]['pu_code'] =  Common_DataCache::getProductUomByCode($orderProductRow['pu_code']);
        }

        $this->view->orderLogRows = $orderLogRows;
        $this->view->orderAddressBookRow = $orderAddressBookRow;
        $this->view->orderProductRows = $orderProductRows;
        $this->view->orderRow = $orderRow;
        $this->view->currency = Service_Currency::getCurrency();
        $this->view->ieport = Service_Currency::getIePort();

        echo Ec::renderTpl($this->tplDirectory . 'order-view.tpl', 'noleftlayout');
        exit;
    }


    /**
     * [editAction description]
     * @return [type] [description]
     */
    public function editAction()
    {
        if($this->_customerAuth['account_level'] == 0){
            die('只有子账号才可以修改！');
        }

        $orderCode = trim($this->_request->getParam('order_code'));
        $conditioin = array();
        if(isset($this->_customerAuth['customer_priv']['is_ecommerce'])){
            $conditioin['customer_code'] = $this->_customerAuth['code'];
        }else{
            die();
        }

        $conditioin['order_code'] = $orderCode;

        $orderRows = Service_Orders::getByCondition($conditioin);
        if(empty($orderRows) || !isset($orderRows[0])){
            die('找不到这个订单编号！');
        }
        $orderRow = $orderRows[0];

        $orderProductRows = Service_OrderProduct::getByCondition(array(
            'order_code' => $orderCode
        ));

        $orderAddressBookRow = Service_OrderAddressBook::getByField($orderCode , 'order_code');
        $countryRow = Common_DataCache::getCountryByCode($orderAddressBookRow['consignee_country']);
        $orderAddressBookRow['country_name'] = $countryRow['country_name'];

        $iePortRows = Common_DataCache::getIePort();
        $appTypeRows = Common_CommonConfig::getOrderAppStatus();
        $ieTypeRows = Service_Orders::getIeType();
        $currencyRows = Common_DataCache::getCurrency();
        $countryRows = Common_DataCache::getCountry();
        $this->view->currencyRows = $currencyRows;
        $this->view->ieTypeRows = $ieTypeRows;
        $this->view->appTypeRows = $appTypeRows;
        $this->view->iePortRows = $iePortRows;
        $this->view->countryRows = $countryRows;


        $this->view->orderAddressBookRow = $orderAddressBookRow;
        $this->view->orderProductRows = json_encode($orderProductRows);
        $this->view->orderRow = $orderRow;

        echo Ec::renderTpl($this->tplDirectory . 'order-edit.tpl', 'noleftlayout');
        exit;
    }

    /**
     * [batchAction description]
     * @return [type] [description]
     */
    public function batchAction()
    {

        echo Ec::renderTpl($this->tplDirectory . 'order-batch.tpl', 'noleftlayout');
        exit;
    }
    /**
     * 列表选择商品
     * @return [type] [description]
     */
    public function getPorductAction()
    {

        $params = $this->_request->getParams();
        $conditioin = array(
            'customer_code' => $this->_customerAuth['code']
        );
        if(isset($params['searchField']) && isset($params['searchOper']) && isset($params['searchString'])){
            $conditioin[$params['searchField']] = $params['searchString'];
        }
        $count = Service_Product::getByCondition($conditioin, 'count(*)');
        $fields = array('registerID','storage_customer_code','registerID','product_title');
        $productRows = Service_Product::getByCondition($conditioin , $fields, "product_id {$params['sord']}", $params['rows'] , $params['page']);

        $responce = array();
        foreach ($productRows as $key => $value) {
            $responce['rows'][$key] = $value;
            $responce['rows'][$key]['id'] = $value['registerID'];
            $responce['rows'][$key]['choice'] = 0;
        }

        $responce['page'] = $params['page'];
        $responce['total'] = ceil($count / $params['rows']);
        $responce['records'] = $count;

        die(json_encode($responce));
    }

    /**
     * 上传文件选择商品
     * @return [type] [description]
     */
    public function findProductAction()
    {
        if($this->_request->isPost()){
            $result = array(
                "ask" => 0,
                "message" => "No Data",
                'error' => array()
            );

            $dataResult  =   $this->_request->getParam('data', '');

            $filename   =   APPLICATION_PATH.'/../data/cache/order-productSelect'.rand(1000 , 9999).'.xls';
            $dataResult =   explode('base64,', $dataResult);
            $dataResult = base64_decode( $dataResult[1] );

            if(!file_put_contents($filename, $dataResult)){
                $result['error'][][] = '上传失败！';
                die(Zend_Json::encode($result));
            }

            try {
                $productData   =   @Common_Upload::readEXCEL($filename);
            } catch (Exception $e) {
                $result['error'][][] =  '只能上传excel文件！';
                die(Zend_Json::encode($result));
            }

            if(empty($productData) || !isset($productData[0]) || count($productData[0]) != 16){
                $result['error'][][] =  '数据不对！';
                die(Zend_Json::encode($result));
            }

            $excelTitle = $productData[0];
            unset($productData[0]);
            $success = $error = $productRepeart = array();
            $object = new Service_OrderProcess();
            $ieType = false;
            foreach ($productData as $orderPorductRow) {
                $orderPorductRow = $this->changeParameter($orderPorductRow);
                $registerID = $orderPorductRow['registerID'];
                $_error = array();
                $choiceResult = $object->choiceProduct($orderPorductRow, $this->_customerAuth['code']);
                if($choiceResult['ask']==0){
                    $error[$registerID] = $choiceResult['error'];
                }else{
                    $success[$registerID] = $choiceResult['orderPorductRow'];
                    $ieType = ($ieType === false) ? $choiceResult['productRow']['ie_type'] : $ieType;
                    if($ieType != $choiceResult['productRow']['ie_type']){
                        $error[] = '所选商品不是同种进出口类型！';
                    }
                }
                if(isset($productRepeart[$registerID])){
                    $error[$registerID] = "[{$registerID}]重复的商品海关编码.";
                }
                $productRepeart[$registerID] = true;
            }
            if(empty($error)){
                $result['ask'] = 1;
                $result['success'] = $success;
            }else{
                $result['error'] = $error;
            }
            unlink($filename);
            die(json_encode($result));
        }
    }

    private function changeParameter($orderPorductRow)
    {
        $array = array(
            "product_no",
            "registerID",
            "hs_code",
            "product_title",
            "item_desc",
            "product_model",
            "product_barcode",
            "brand",
            "pu_code",
            "currency_code",
            "quantity",
            "price",
            "total_price",
            "origin_country",
            "gift_flag",
            "note"
        );

        $newArray = array();
        foreach ($orderPorductRow as $key => $value) {
            $newArray[$array[$key]] = $value;
        }
        return $newArray;
    }


}


