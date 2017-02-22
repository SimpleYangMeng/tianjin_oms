<?php
/**
 *
 * @desc 物流相关
 */
class Logistic_IndexController extends Ec_Controller_Action
{

    public function preDispatch()
    {
        $this->tplDirectory = "logistic/views/index/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    /**
     * 创建运单
     */
    public function createAction()
    {
        $customer = $this->_customerAuth;
        //主账号
        if ($customer['account_level'] == 0) {
            die('请用子账户登陆创建(Please use the sub account to create a landing)');
        }
        $companyInfo = Service_Customer::getByField($customer['code'], 'customer_code', array('customer_code', 'customer_company_name', 'trade_name'));
        if ($this->_request->isPost()) {
            //die(json_encode(array('ask'=>1,'msg'=>array('123'))));
            $data = $this->_request->getParams();
            //加入子账号的代码
            $data['account_code'] = $customer['account_code'];
            $obj = new Service_WaybillProcess(array('param' => $data));
            $result = $obj->create();
            die(json_encode($result));
        }
        $id = $this->_request->getParam('id', 0);
        $wbData = array();
        if ($id) {
            //验证是否有编辑权限
            $customer = $this->_customerAuth;
            if (empty($customer['customer_priv']['is_shipping']) || $customer['customer_priv']['is_shipping'] != 1) {
                die('No authority');
            }
            $wbData = Service_Waybill::getByField($id, 'wb_id');
            if ($wbData instanceof Zend_Db_Table_Row) {
                $wbData = $wbData->toArray();
            }
            /*if(!$wbData || $wbData['customer_code']!=$this->customerAuth->wbData['code']){
            die('单号不存在');
            }*/
            if (!$wbData) {
                die('单号不存在');
            }
        }
        $currencyRow = Service_Currency::getAll();
        $currency = array();
        foreach ($currencyRow as $value) {
            $currency[] = array('code' => $value['currency_code'], 'name' => $value['currency_name']);
        }
        $this->view->customer = $customer;
        $this->view->companyInfo = $companyInfo;
        $this->view->data = $wbData;
        $this->view->country = Service_Country::getAll();
        $this->view->customsCodes = Service_IePort::getAll();
        $this->view->trafTools = Service_TrafTool::getAll();
        $this->view->traf = Service_TrafMode::getByCondition(array('is_display' => 1));
        $this->view->currency = $currency;
        $this->view->appType = Service_WaybillProcess::getAppType();
        $this->view->appStatus = Service_WaybillProcess::getAppStatus();
        $this->view->ieType = Service_WaybillProcess::getIeType();
        echo Ec::renderTpl($this->tplDirectory . 'create-waybill.tpl', 'noleftlayout');
        exit;
    }

    /**
     * @author simple-yang
     * 运单列表
     */
    public function waybillListAction()
    {
        $customer = $this->_customerAuth;
        $ciqStatus = Service_Waybill::getCiqStatus();
        /*
        $priv_customer = array();
        if(!empty($customer['priv_customer_code_arr']) && is_array($customer['priv_customer_code_arr'])){
        foreach ($customer['priv_customer_code_arr'] as $key => $value) {
        $customerData = Service_Customer::getByField($value, 'customer_code', array('customer_company_name'));
        $priv_customer[$value] = !empty($customerData) ? $value.'-'.$customerData['customer_company_name'] : $value.'-未知公司';
        }
        }
         */
        $orderCode = $this->_request->getParam('orderCode', '');
        $trackingCode = $this->_request->getParam('trackingCode', '');
        $wbCode = $this->_request->getParam('wbCode', '');
        $customerCode = $this->_request->getParam('customerCode', '');
        $referenceNo = $this->_request->getParam('referenceNo', '');
        $appStatus = $this->_request->getParam('app_status', '');
        $ciq_status = $this->_request->getParam('ciq_status', '');
        $startTime = $this->_request->getParam('start_time', '');
        $endTime = $this->_request->getParam('end_time', '');
        $condition = array(
            'order_code' => $orderCode,
            'log_no' => $trackingCode,
            'wb_status' => 1,
            'reference_no' => $referenceNo,
            'wb_code' => $wbCode,
            'customer_code' => $customerCode,
            'start_time' => $startTime,
            'end_time' => $endTime,
            //    'logistic_customer_code' => $customer['code'],
            'app_status' => $appStatus,
            'ciq_status' => $ciq_status,
        );
        // print_r($condition);exit;
        //支付企业
        if (isset($customer['customer_priv']['is_shipping']) && $customer['customer_priv']['is_shipping'] == 1) {
            $condition['logistic_customer_code'] = $customer['code'];
        }
        //电商企业
        if (isset($customer['customer_priv']['is_ecommerce']) && $customer['customer_priv']['is_ecommerce'] == 1) {
            $condition['customer_code'] = $customer['code'];
        }

        if ($this->_request->isPost()) {
            $return = array('ask' => 1, 'data' => array(), 'total' => 0);
            $page = $this->_request->getParam('page', 0);
            $pageSize = $this->_request->getParam('pageSize', 1);
            $total = Service_Waybill::getByCondition($condition, 'count(*)');
            if ($total > 0) {
                $result = Service_Waybill::getByCondition($condition, '*', $pageSize, $page, array('wb_id desc'));
                if (!empty($result) && is_array($result)) {
                    foreach ($result as $key => $value) {
                        $customerData = Service_Customer::getByField($value['customer_code'], 'customer_code', array('trade_name'));
                        $logisticCustomerData = Service_Customer::getByField($value['logistic_customer_code'], 'customer_code', array('trade_name'));
                        $result[$key]['customer_code'] = $value['customer_code'] . '-' . $customerData['trade_name'];
                        $result[$key]['logistic_customer_code'] = $value['logistic_customer_code'] . '-' . $logisticCustomerData['trade_name'];
                    }
                }
                /*$groupDate = Service_Waybill::getGroupByCondition($condition, 'app_status');
                $return['groupDate'] = $groupDate;*/
                $return['data'] = $result;
            }
            $return['total'] = $total;
            $return['ciqStatus'] = $ciqStatus;
            $return['appStatusGroupRows'] = Service_Waybill::getGroupByCondition($condition, 'app_status');
            $return['appStatus'] = Service_WaybillProcess::getAppStatus('auto');
            die(json_encode($return));
        }

        $layout = new Zend_Layout();
        $layout->useMyPage = true;
        $this->view->appType = json_encode(Service_WaybillProcess::getAppType('auto'));
        $this->view->fmlStatus = json_encode(array('-1' => '待发送', '1' => '待审核', '2' => '审核中', '3' => '审核通过', '4' => '审核不通过'));
        $this->view->appStatusJson = json_encode(Service_WaybillProcess::getAppStatus('auto'));
        $trafRows = Service_TrafMode::getAll();
        $traf = array();
        foreach ($trafRows as $value) {
            $traf[$value['tfm_id']] = $value['traf_mode_name'];
        }
        $this->view->ciqStatus = $ciqStatus;
        $this->view->condition = $condition;
        $this->view->appStatusGroupRows = Service_Waybill::getGroupByCondition($condition, 'app_status');
        $this->view->appStatus = Service_WaybillProcess::getAppStatus('auto');
        $this->view->traf = json_encode($traf);
        $this->view->customerLogin = $customer;
        echo Ec::renderTpl($this->tplDirectory . 'waybill-list.tpl', 'noleftlayout');
        exit;
    }

    /**
     * 导入运单模板
     */
    public function uploadWaybillAction()
    {
        $customer = $this->_customerAuth;
        //主账号
        if ($customer['account_level'] == 0) {
            die('请用子账户登陆创建(Please use the sub account to create a landing)');
        }
        echo Ec::renderTpl($this->tplDirectory . 'upload-waybill.tpl', 'noleftlayout');
        exit;
    }

    /**
     * @author simple-yang
     * 删除运单
     */
    public function deleteWaybillAction()
    {
        $return = array('ask' => 0, 'message' => '');
        $id = $this->_request->getParam('id', 0);
        if (empty($id)) {
            $return['message'] = '请选择你要删除的单号';
            die(json_encode($return));
        }
        $row = Service_Waybill::getByField($id, 'wb_id');
        if ($row instanceof Zend_Db_Table_Row) {
            $row = $row->toArray();
        }
        /*
        if(!$row || $row['customer_code']!=$this->customerAuth->data['code'] || $row['wb_status']!=1){
        $return['message'] = '单号不存在或者状态不允许操作';
        die(json_encode($return));
        }
         */
        $result = Service_Waybill::update(array('wb_status' => 0, 'wb_update_time' => date('Y-m-d H:i:s')), $id, 'wb_id');
        $return['ask'] = $result ? 1 : 0;
        $return['message'] = $result ? '删除成功' : '删除失败';
        die(json_encode($return));
    }

    /**
     * @author simple-yang
     * 查看运单
     */
    public function publicViewAction()
    {
        $wbId = $this->_request->getParam('wb_id', 0);
        $wbStatus = Service_WaybillProcess::getAppStatus('auto');
        $wbData = Service_Waybill::getByField($wbId, 'wb_id');
        $ciqStatus = Service_Waybill::getCiqStatus();
        $wbLogData = Service_WaybillLog::getByCondition(array('wb_id' => $wbId));
        if (!empty($wbLogData) && is_array($wbLogData)) {
            foreach ($wbLogData as $key => $value) {
                if($value['status_type'] == '1'){
                    $wbLogData[$key]['wb_status_from'] = (isset($wbStatus[$value['wb_status_from']]) && !empty($wbStatus[$value['wb_status_from']])) ? $wbStatus[$value['wb_status_from']] : '未知状态';
                    $wbLogData[$key]['wb_status_to'] = (isset($wbStatus[$value['wb_status_to']]) && !empty($wbStatus[$value['wb_status_to']])) ? $wbStatus[$value['wb_status_to']] : '未知状态'; 
                }else{
                    $wbLogData[$key]['wb_ciq_status_from'] = (isset($ciqStatus[$value['wb_ciq_status_from']]) && !empty($ciqStatus[$value['wb_ciq_status_from']])) ? $ciqStatus[$value['wb_ciq_status_from']] : '未知状态';
                    $wbLogData[$key]['wb_ciq_status_to'] = (isset($ciqStatus[$value['wb_ciq_status_to']]) && !empty($ciqStatus[$value['wb_ciq_status_to']])) ? $ciqStatus[$value['wb_ciq_status_to']] : '未知状态';
                }
                $wbLogData[$key]['account_name'] = empty($value['account_name']) ? 'system' : $value['account_name'];
            }
        }
        $this->view->wbData = Service_WaybillProcess::conversionParameter($wbData);
        $this->view->wbLogData = $wbLogData;
        echo Ec::renderTpl($this->tplDirectory . "waybill-view.tpl", 'noleftlayout');
    }

    /**
     * @author simple-yang
     * @todo 选择导入
     */
    public function batchcheckAction()
    {
        //header('Content-type:text/html;charset=utf-8');
        set_time_limit(300);
        $waybillUpload = new Zend_Session_Namespace('waybillUpload');
        $xlsData = Service_PayOrder::getXLSData($_FILES['waybillUpload']);
        //导入读取文件失败提示信息
        if (isset($xlsData['ask']) && $xlsData['ask'] == '0') {
            $this->view->uploadinfo = $xlsData;
            die(Ec::renderTpl($this->tplDirectory . "upload-waybill.tpl", 'noleftlayout'));
        } else {
            $waybillRows = Service_WaybillProcess::getDataArr($xlsData);
            //保存到session
            $waybillUpload->uploadData = $waybillRows;
            // print_r($waybillRows);
            $this->view->doupload = true;
            $this->view->uploadData = $waybillRows;
            die(Ec::renderTpl($this->tplDirectory . "waybill-upload-edit.tpl", 'noleftlayout'));
        }
    }

    /**
     * @author simple-yang
     * @todo 支付单导入数据返回结果
     */
    public function importAction()
    {
        $customer = $this->_customerAuth;
        set_time_limit(300);
        ini_set('memory_limit', '1024M');
        $waybillUpload = new Zend_Session_Namespace('waybillUpload');
        $sessionData = $waybillUpload->uploadData;
        $ids = $this->_request->getParam('select');
        //初始化提示数据
        $success = $false = 0;
        $successHtml = $failseHtml = $html = '';
        $index = 1;
        $doupload = true;
        if ($doupload) {
            foreach ($ids as $val) {
                $status = 1;
                $waybillRow = $sessionData[$val];

                //申报类型 业务状态
                $waybillRow['appType'] = 1;
                $waybillRow['appStatus'] = 0;
                // $customer = $this->_customerAuth;
                $waybillRow['logisticCustomerCode'] = $customer['code'];
                $trafMode = Service_TrafMode::getByField($waybillRow['trafMode'], 'traf_mode_name', array('tfm_id'));
                if (!empty($trafMode)) {
                    $waybillRow['trafMode'] = $trafMode['tfm_id'];
                    $process = new Service_WaybillProcess(array('param' => $waybillRow));
                    $result = $process->create();
                    if ($result['ask'] == '1') {
                        $successHtml .= '<p>第' . $index . '个运单创建成功' . '</p>';
                        $success++;
                    } else {
                        $failseHtml .= "<p>第{$index}个运单" . $result['message'];
                        if (isset($result['error'])) {
                            $error = $result['error'];
                            if (!empty($error)) {
                                foreach ($error as $key => $err) {
                                    $failseHtml .= "<div class='error'>{$err}</div>";
                                }
                            }
                        }
                        $failseHtml .= '</p>';
                        $false++;
                    }
                } else {
                    $failseHtml .= "<p>第{$index}个运单运输方式不匹配";
                    $false++;
                }
                $index++;
            }
            $uploadResult = "<p>合计：成功{$success}，失败$false</p>";
            $html = $html . $successHtml . $failseHtml . $uploadResult;
        }
        $this->view->uploadResult = $html;
        unset($waybillUpload->uploadData);
        echo Ec::renderTpl($this->tplDirectory . "upload-waybill.tpl", 'noleftlayout');
    }

    /**
     * @author
     * @todo 省份
     */
    public function provinceAction()
    {
        $response = array();
        $country_id = $this->_request->getParam('country_id');
        if (!is_numeric($country_id)) {
            exit(json_encode($response));
        }

        if ($country_id == '49' || $country_id == '50' || $country_id == '51') {
            $condition = array('parent_id' => 1);
            $term = $this->_request->getParam('term', '');
            if ($term != '') {
                $condition['region_name_like'] = $term;
            }
            $province_array = Service_Region::getByCondition($condition);
            foreach ($province_array as $key => $province) {
                $response[] = $province['region_name'];
            }
            exit(json_encode($response));
        }
        exit(json_encode($response));
    }

    /**
     * @author
     * @todo 城市
     */
    public function cityAction()
    {
        $response = array();
        $country_id = $this->_request->getParam('country_id');
        if (!is_numeric($country_id)) {
            exit(json_encode($response));
        }

        if ($country_id == '49' || $country_id == '50' || $country_id == '51') {
            $condition = array('parent_id' => 2);
            $term = $this->_request->getParam('term', '');
            if ($term != '') {
                $condition['region_name_like'] = $term;
            }
            $province_name = $this->_request->getParam('province_id', '');
            if ($province_name == '') {
                exit(json_encode($response));
            }
            $province = Service_Region::getByField($province_name, 'region_name');
            if (!empty($province)) {
                $condition['parent_id'] = $province['region_id'];
            }
            $city_array = Service_Region::getByCondition($condition);
            //print_r($province_array);
            foreach ($city_array as $key => $city) {
                $response[] = $city['region_name'];
            }
            exit(json_encode($response));
        }
        exit(json_encode($response));
    }
    /**
     * @author
     * @todo 区县
     */
    public function districtAction()
    {
        $response = array();
        $country_id = $this->_request->getParam('country_id');
        if (!is_numeric($country_id)) {
            exit(json_encode($response));
        }

        if ($country_id == '49' || $country_id == '50' || $country_id == '51') {
            $condition = array('parent_id' => 3);
            $term = $this->_request->getParam('term', '');
            if ($term != '') {
                $condition['region_name_like'] = $term;
            }
            $city_name = $this->_request->getParam('city_id', '');
            if ($city_name == '') {
                exit(json_encode($response));
            }
            $province = Service_Region::getByField($city_name, 'region_name');
            if (!empty($province)) {
                $condition['parent_id'] = $province['region_id'];
            }
            $city_array = Service_Region::getByCondition($condition);
            //print_r($province_array);
            foreach ($city_array as $key => $city) {
                $response[] = $city['region_name'];
            }
            exit(json_encode($response));
        }
        exit(json_encode($response));
    }
    /**
     * 获取企业名称
     * @return [json]
     */
    public function getCompanyNameByCusCodeAction()
    {
        $result = array(
            'ask' => 0,
            'message' => '获取企业名称失败;',
            'data' => array(),
        );
        //权限
        //    $customer = $this->_customerAuth;
        $customer_code = strtoupper($this->getRequest()->getParam('customer_code'));
        //    if(!empty($customer_code) && in_array($customer_code, $customer['priv_customer_code_arr'])){
        if (!empty($customer_code)) {
            $customerData = Service_Customer::getByField($customer_code, 'customer_code', array('trade_name', 'customer_company_name'));
            if (!empty($customerData)) {
                $result['ask'] = 1;
                $result['message'] = 'get success';
                $result['data'] = $customerData;
            }
        }
        die(Zend_Json::encode($result));
    }
}
