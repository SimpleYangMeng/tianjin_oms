<?php
/**
 * 个人物品清单
 * @author simple_pc
 *
 */
class Merchant_PersonalItemsController extends Ec_Controller_Action {
    public function preDispatch() {
        $this->tplDirectory = "merchant/views/personitem/";
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
        $this->view->formType = Common_CommonConfig::getFormType();
        $this->view->customer = $customer;
        $this->view->companyInfo = $companyInfo;
        $this->view->wrapType = Service_WrapType::getAll();
        echo Ec::renderTpl($this->tplDirectory . "person-item-add.tpl", 'noleftlayout');
    }

    /**
     * 添加处理
     */
    public function addSaveAction(){
        // print_r($this->_request->getParams());exit;
        $customer = $this->_customerAuth;
        $data = $this->_request->getParams();
        $data['account_code'] = $customer['account_code'];
        $data['account_name'] = isset($customer['account_name'])?$customer['account_name']:'';
        $obj = new Service_PersonItemProcess(array('param'=>$data));
        $result = $obj->create();
        die(json_encode($result));
    }

    /**
     * 列表页面
     */
    public function listAction() {
        $params = $this->_request->getParams();
        $page = isset($params['page']) && intval($params['page']) > 0 ? intval($params['page']) : 1;
        $pageSize = isset($params['pageSize']) && intval($params['pageSize']) > 0 ? intval($params['pageSize']) : 20;
        $condition = array();
        $status = 0;

        $customerType = '';

        if(isset($this->_customerAuth['customer_priv']['is_storage']) || isset($this->_customerAuth['customer_priv']['is_baoguan'])){
            if($this->_customerAuth['account_level'] == 0){
                $condition['storage_customer_code'] = $this->_customerAuth['code'];
            }else{

                $condition['account_code'] = $this->_customerAuth['account_code'];
            }
        }else{
            die("权限不足！");
        }
        $condition['pim_reference_no'] = isset($params['pim_reference_no']) ? $params['pim_reference_no'] : '';
        $condition['customer_code'] = isset($params['customer_code']) ? $params['customer_code'] : '';
        $condition['logistic_customer_code'] = isset($params['logistic_customer_code']) ? $params['logistic_customer_code'] : '';
        $condition['pay_customer_code'] = isset($params['pay_customer_code']) ? $params['pay_customer_code'] : '';
        $condition['order_code'] = isset($params['order_code']) ? $params['order_code'] : '';
        $condition['wb_code'] = isset($params['wb_code']) ? $params['wb_code'] : '';
        $condition['po_code'] = isset($params['po_code']) ? $params['po_code'] : '';
        $condition['pim_code'] = isset($params['pim_code']) ? $params['pim_code'] : '';
        $condition['customs_status'] = isset($params['customs_status']) ? $params['customs_status'] : '';
        $condition['status'] = isset($params['status']) ? $params['status'] : '';
        $condition['ciq_status'] = isset($params['ciq_status']) ? $params['ciq_status'] : '';
        $condition['order_add_time'] = isset($params['start_time']) ? $params['start_time'] : '';
        $condition['order_end_time'] = isset($params['end_time']) ? $params['end_time'] : '';

        $status = isset($params['status']) ? $params['status'] : '0';

        $count = Service_PersonItem::getByCondition($condition, 'count(*)');

        $personItemRows = array();
        if($count > 0){
            $personItemRows = Service_PersonItem::getByCondition($condition, '*', $pageSize, $page, 'pim_id Desc');
        }
        $statusGroupRows = Service_PersonItem::getGroupByCondition($condition, 'status');

        $this->view->personItemRows = $personItemRows;
        $this->view->customerType = $customerType;
        $this->view->condition = $condition;
        $this->view->customsStatusRows = Service_PersonItem::getCustomsStatus();
        $this->view->appStatusRows = Service_PersonItem::getStatus();
        $this->view->ciqStatus = Service_PersonItem::getCiqStatus();
        $this->view->statusGroupRows = $statusGroupRows;
        $this->view->count = $count;
        $this->view->page = $page;
        $this->view->pageSize = $pageSize;
        $this->view->status = $status;
        echo Ec::renderTpl($this->tplDirectory . "person-item-list.tpl", 'noleftlayout');
    }

    /**
     * [viewAction description]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function viewAction()
    {
        $pimCode = trim($this->_request->getParam('pim_code'));

        $conditioin = array();
        $conditioin['pim_code'] = $pimCode;
        if(isset($this->_customerAuth['customer_priv']['is_ecommerce'])){
            $conditioin['customer_code'] = $this->_customerAuth['code'];
        }elseif(isset($this->_customerAuth['customer_priv']['is_storage'])){
            if($this->_customerAuth['account_level'] == 0){
                $conditioin['storage_customer_code'] = $this->_customerAuth['code'];
            }else{
                $conditioin['account_code'] = $this->_customerAuth['account_code'];
            }
        }elseif(isset($this->_customerAuth['customer_priv']['is_pay'])){
            $conditioin['pay_customer_code'] = $this->_customerAuth['code'];
        }elseif(isset($this->_customerAuth['customer_priv']['is_shipping'])){
            $conditioin['logistic_customer_code'] = $this->_customerAuth['code'];
        }

        $personItemRows = Service_PersonItem::getByCondition($conditioin, '*');
        if(empty($personItemRows) || !isset($personItemRows[0])){
            die('找不到这个个人物品清单编号！');
        }
        $personItemRow = $personItemRows[0];
        // 获取国家代码
        $iePortRows = Common_DataCache::getIePort();
        $countryRows = Common_DataCache::getCountry();
        $personItemRow['ship_trade_country'] = isset($countryRows[$personItemRow['ship_trade_country_id']]['country_name']) ? $countryRows[$personItemRow['ship_trade_country_id']]['country_name'] : '';
        $personItemRow['aim_country'] = $countryRows[$personItemRow['aim_country_id']]['country_name'];
        $personItemRow['receive_country'] = isset($countryRows[$personItemRow['receive_country_id']]['country_name']) ? $countryRows[$personItemRow['receive_country_id']]['country_name'] : '';
        $personItemRow['declare_ie_port'] = isset($iePortRows[$personItemRow['declare_ie_port']]['ie_port_name']) ? $countryRows[$personItemRow['ship_trade_country_id']]['country_name'] : '';
        $personItemRow['ie_port'] = isset($iePortRows[$personItemRow['ie_port']]['ie_port_name']) ? $iePortRows[$personItemRow['ie_port']]['ie_port_name'] : '';
        //$personItemRow['traf_mode'] = Common_DataCache::getTrafMode(true, $personItemRow['traf_mode']);
        $personItemRow['traf_mode_name'] = '';
        if($personItemRow['traf_mode']!=''){
            $trafe = Service_TrafMode::getByField($personItemRow['traf_mode']);
            if(!empty($trafe)){
                $personItemRow['traf_mode_name'] = $trafe['traf_mode_name'];
                $personItemRow['traf_mode'] = $trafe['traf_mode'];
            }
        }
        $personItemRow['wrap_type_name'] = '';
        if($personItemRow['wrap_type']!=''){
            $wrap = Service_WrapType::getByField($personItemRow['wrap_type'],'wrap_type');
            if(!empty($wrap)){
                $personItemRow['wrap_type_name'] = $wrap['wrap_type_name'];
            }
        }

        $personItemProductRows = Service_PersonItemProduct::getByCondition(array(
            'pim_code' => $personItemRow['pim_code']
        ));
        $personItemLogRows = Service_PersonItemLog::getByCondition(array(
            'pim_code' => $personItemRow['pim_code']
        ));

        $this->view->ciqStatus = Service_PersonItem::getCiqStatus();
        $this->view->wrapTypeRows = Service_WrapType::getAll();
        $this->view->statusRows = Service_PersonItem::getStatus();
        $this->view->customsStatus = Service_PersonItem::getCustomsStatus();
        $this->view->personItemProductRows = $personItemProductRows;
        $this->view->personItemRow = $personItemRow;
        $this->view->personItemLogRows = $personItemLogRows;
        echo Ec::renderTpl($this->tplDirectory . "person-item-detail.tpl", 'noleftlayout');
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

            if(empty($productData) || !isset($productData[0]) || count($productData[0]) != 12){
                $result['error'][][] =  '数据不对！';
                die(json_encode($result));
            }


            $excelTitle = $productData[0];
            unset($productData[0]);
            $success = $error = array();
            $object = new Service_PersonItemProcess();

            foreach ($productData as $porductRow) {
                $productRow = $this->changeParameter($porductRow,'I','');//进口的
                $registerID = $productRow['registerID'];
                $_error = array();
                $choiceResult = $object->choiceProduct($productRow);
                if($choiceResult['ask']==0){
                    $error[$registerID] = $choiceResult['error'];
                }else{
                    $success[$registerID] = $choiceResult['orderPorductRow'];
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
    private function changeParameter($productRow)
    {
        $array = array(
            "registerID",
            "gt_code",
            "g_no",
            "goods_id",
            "hs_code",
            "price",
            "g_qty",
            "curr",
            "g_name_cn",
            "g_model",
            "g_uint",
            "country",
        );

        $newArray = array();
        foreach ($productRow as $key => $value) {
            $newArray[$array[$key]] = $value;
        }
        return $newArray;
    }

    /**
     * [getItemAction 获取产品信息]
     * @return [type] [description]
     */
    public function getItemAction(){
        $goodsId=$this->_request->getParam('goodsId');
         $return = array (
            "ask" => 0,
            "message" => '获取不到对应产品信息',
            'error' => array()
        );
        if(!empty($goodsId)){
            $object = new Service_PersonItemProcess();
            $result = $object->getProduct($goodsId);
            if($result['ask']=='1'){
                $return['ask']=1;
                $return['data']=$result['orderPorductRow'];
               // $return['']
            }else{
                $return['message']=implode(',',$result['error']);
            }
        }
        echo Zend_Json_Encoder::encode($return);
    }
    public function editAction(){
        $pimCode = trim($this->_request->getParam('pim_code'));
        /*$conditioin = array();
        $conditioin['pim_code'] = $pimCode;
        if(isset($this->_customerAuth['customer_priv']['is_ecommerce'])){
            $conditioin['customer_code'] = $this->_customerAuth['code'];
        }elseif(isset($this->_customerAuth['customer_priv']['is_storage'])){
            if($this->_customerAuth['account_level'] == 0){
                $conditioin['storage_customer_code'] = $this->_customerAuth['code'];
            }else{
                $conditioin['account_code'] = $this->_customerAuth['account_code'];
            }
        }elseif(isset($this->_customerAuth['customer_priv']['is_pay'])){
            $conditioin['pay_customer_code'] = $this->_customerAuth['code'];
        }elseif(isset($this->_customerAuth['customer_priv']['is_shipping'])){
            $conditioin['logistic_customer_code'] = $this->_customerAuth['code'];
        }

        $personItemRows = Service_PersonItem::getByCondition($conditioin, '*');*/
        $personItemRow = Service_PersonItem::getByField($pimCode,'pim_code');
        if(empty($personItemRow) || !isset($personItemRow)){
            die('找不到这个个人物品清单编号');
        }
        //$personItemRow = $personItemRows[0];
        // 获取国家代码
       // $iePortRows = Common_DataCache::getIePort();
        /*if($this->_req){

        }*/
        $customer = $this->_customerAuth;
        if($this->_request->isPost()){
            $params = $this->_request->getParams();
            $result = array(
                'ask'=>'0',
                'message'=>'',
                'error'=>''
            );
            $data = $this->_request->getParams();
            $data['account_code'] = $customer['account_code'];
            $data['account_name'] = isset($customer['account_name'])?$customer['account_name']:'';

            $obj = new Service_PersonItemProcess(array('param'=>$data));
            $result = $obj->updateProcess(false,$personItemRow['pim_code']);
            die(json_encode($result));
        }

        $personItemProductRows = Service_PersonItemProduct::getByCondition(array(
            'pim_code' => $personItemRow['pim_code']
        ));
        $personItemCount=1;
        foreach($personItemProductRows as $key=>$pPro){
            $unitInfo=  Service_ProductUom::getByField($pPro['g_uint'], 'pu_code');
            $personItemProductRows[$key]['g_uint_name']=$unitInfo['pu_name'];
            if(!empty($pPro['country'])){
            $countryInfo=  Service_Country::getByField($pPro['country'], 'country_code');
             $personItemProductRows[$key]['countryName']=$countryInfo['country_name'];
            }
            $personItemCount++;
        }
        $this->view->wrapTypeRows = Service_WrapType::getAll();
        $this->view->statusRows = Service_PersonItem::getStatus();
        $this->view->personItemProductRows = $personItemProductRows;
        $this->view->personItemRow = $personItemRow;
         $customer = $this->_customerAuth;
        $companyInfo = Service_Customer::getByField($customer['code'], 'customer_code');
        //$this->view->priv_customer_code_arr = array('C0204', 'C2020');
        $this->view->currencyAll = Common_DataCache::getCurrency();
        $this->view->country = Service_Country::getAll();
        $this->view->warehouse = Service_Warehouse::getAll();
        $this->view->iePorts = Service_IePort::getAll();
        $this->view->traf = Service_TrafMode::getAll();
        $this->view->formType = Common_CommonConfig::getFormType();
        $this->view->customer = $customer;
        $this->view->companyInfo = $companyInfo;
        $this->view->wrapType = Service_WrapType::getAll();
        $this->view->personItemCount=$personItemCount;
        echo Ec::renderTpl($this->tplDirectory . "person-item-edit.tpl", 'noleftlayout');
    }
    /**
     * @author william-fan
     * @todo 三单对比
     */
    public function compareAction(){
        $return = array('ask' => 0, 'message' => "对碰物品清单成功!");
        $orderArr = $this->_request->getParam('orderArr', '');
        if (!empty($orderArr)) {
        	$success = 0;
        	$failse = 0;
        	$failsStr = '';
        	$object = Service_ThreeFromsCompareProcess::getInstance();
        	foreach ($orderArr as $key => $pim_code) {
        		$result = $object->getCompare($pim_code);
        		$orderCode_lang = '物品清单';
        		$reference_no = $result['reference_no'];
        		if (!empty($result) && $result['ask'] == '1') {
        			$success++;
        			$success_lang = '对比成功';
        			$failsStr.="<{$orderCode_lang}>" . "[{$pim_code}]" . "{$success_lang}<br/>";
        		} else {
        			$fail_lang = Ec_Lang::getInstance()->getTranslate('fail');
        			$failsStr.= "<{$orderCode_lang}>" . "[{$pim_code}]" . "{$fail_lang}," . $result['message'] . '<br/>';
        			$failse++;
        		}
        	}
        	if ($success > 0) {
        		$return['ask'] = 1;
                $return['message'] = '对碰物品清单成功';
        	}else{
                $return['message'] = '对碰物品清单成功';
        	}
        	//$return['message'] = '对碰物品清单' . ',' . Ec_Lang::getInstance()->getTranslate('success') . ':' . $success . Ec_Lang::getInstance()->getTranslate('fail') . ' :' . $failse . '<br/>' . $failsStr;
        }
        die(Zend_Json::encode($return));
    }

}
