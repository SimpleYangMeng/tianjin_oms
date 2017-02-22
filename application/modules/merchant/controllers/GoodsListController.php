<?php
/**
 * 个人物品清单
 * @author simple_pc
 *
 */
class Merchant_GoodsListController extends Ec_Controller_Action {
    public function preDispatch() {
        $this->tplDirectory = "merchant/views/goodslist/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

	/**
     * 默认列表
     */
    public function indexAction() {
        $this->listAction();
    }

    /**
     * 新增物品清单
     */
    public function addAction(){
        $customer = $this->_customerAuth;
        $companyInfo = Service_Customer::getByField($customer['code'], 'customer_code');
        //$this->view->priv_customer_code_arr = array('C0204', 'C2020');
        $this->view->currencyAll = Common_DataCache::getCurrency();
        $this->view->country = Service_Country::getAll();
        $this->view->warehouse = Service_Warehouse::getAll();
        $this->view->iePorts = Service_IePort::getAll();
        $this->view->traf = Service_TrafMode::getAll();
        $this->view->formType = Common_CommonConfig::getFormType('e');
        $this->view->customer = $customer;
        $this->view->companyInfo = $companyInfo;
        $this->view->wrapType = Service_WrapType::getAll();
        echo Ec::renderTpl($this->tplDirectory . "goods-list-add.tpl", 'noleftlayout');
    }

    /**
     * 添加处理
     */
    public function addSaveAction(){
        // print_r($this->_request->getParams());exit;
        $customer = $this->_customerAuth;
        $data = $this->_request->getParams();
        $data['account_code'] = $customer['account_code'];
        $data['account_name'] = $customer['account_name'];
        //print_r($data);
        $obj = new Service_GoodsListProcess(array('param'=>$data));
        $result = $obj->create();
        die(json_encode($result));
    }

    /**
     * 列表页面
     */
    public function listAction() {
        $customer = $this->_customerAuth;
        //支付企业
        if(isset($customer['customer_priv']['is_shipping']) && $customer['customer_priv']['is_shipping'] == 1 ){
            $condition['logistic_customer_code'] = $customer['code'];
        }
        //电商企业
        if(isset($customer['customer_priv']['is_ecommerce']) && $customer['customer_priv']['is_ecommerce'] == 1 ){
            $condition['customer_code'] = $customer['code'];
        }

        if($this->_request->isPost()){
            $return = array('ask'=>1,'data'=>array(),'total'=>0);
            $page = $this->_request->getParam('page',0);
            $pageSize = $this->_request->getParam('pageSize',1);
            $total = Service_Waybill::getByCondition($condition,'count(*)');
            if($total>0){
                $result = Service_Waybill::getByCondition($condition,'*',$pageSize,$page,array('wb_id desc'));
                if(!empty($result) && is_array($result)){
                    foreach ($result as $key => $value) {
                        $customerData = Service_Customer::getByField($value['customer_code'], 'customer_code', array('trade_name'));
                        $logisticCustomerData = Service_Customer::getByField($value['logistic_customer_code'], 'customer_code', array('trade_name'));
                        $result[$key]['customer_code'] = $value['customer_code'].'-'.$customerData['trade_name'];
                        $result[$key]['logistic_customer_code'] = $value['logistic_customer_code'].'-'.$logisticCustomerData['trade_name'];
                    }
                }
                $return['data'] = $result;
            }
            $return['total'] = $total;
            die(json_encode($return));
        }
        $layout = new Zend_Layout();
        $layout->useMyPage	= true;
        echo Ec::renderTpl($this->tplDirectory .'goods-list.tpl', 'noleftlayout');
        exit;
    }

    /**
     * @todo 用于获取商品信息
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

            $filename   =   APPLICATION_PATH.'/../data/cache/person-productSelect'.rand(1000 , 9999).'.xls';
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

            if(empty($productData) || !isset($productData[0]) || count($productData[0]) != 13){
                $result['error'][][] =  '数据不对！';
                die(json_encode($result));
            }


            $excelTitle = $productData[0];
            unset($productData[0]);
            $success = $error = array();
            $object = new Service_GoodsListProcess();
            $unit = array();
            $num = 1;
            foreach ($productData as $productRow) {
                $tmpProduct = $object->changeParameter($productRow);
                $tmpProduct['g_unit_name'] = $tmpProduct['g_unit'];
                $registerID = $tmpProduct['register_id'];
                $_error = array();
                //转换一下单位，excel文件里的单位是pu_name
                if(!in_array($tmpProduct['g_unit'],$unit)) {
                    $pu = Service_ProductUom::getByCondition(array('pu_name'=>$tmpProduct['g_unit']));
                    if($pu){
                        $unit[$pu[0]['pu_code']] = $tmpProduct['g_unit'];
                    }else{
                        $unit['_'.$num.$tmpProduct['g_unit']] = $tmpProduct['g_unit'];
                        ++$num;
                    }
                }
                $tmpProduct['g_unit'] = array_search($tmpProduct['g_unit'],$unit);
                $choiceResult = $object->choiceProduct($tmpProduct,'E');
                if($choiceResult['ask']==0){
                    $error[$registerID] = $choiceResult['error'];
                }else{
                    $success[$registerID] = $choiceResult['orderProductRow'];
                }
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
}
