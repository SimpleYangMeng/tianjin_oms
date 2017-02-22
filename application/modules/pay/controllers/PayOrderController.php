<?php
/**
 * 支付单管理
 * @author simple_pc
 *
 */
class Pay_PayOrderController extends Ec_Controller_Action{
    public $_date;
    public function preDispatch ()
    {
        $this->_date = date('Y-m-d H:i:s');
        $this->tplDirectory = "pay/views/payOrder/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    /**
     * @author simple-yang
     * 新增支付单
     */
    public function addPayOrderAction(){
        $customer = $this->_customerAuth;
        //主账号
        if($customer['account_level'] == 0) {
            die('请用子账户登陆创建(Please use the sub account to create a landing)');
        }
        $this->view->country = Common_DataCache::getCountry();
        $this->view->currencyAll = Common_DataCache::getCurrency();
        $this->view->payOrderAppTypes = Service_PayOrderProcess::getAppType('auto');
        $this->view->companyInfo = Service_Customer::getByField($customer['code'], 'customer_code', array('customer_code', 'customer_company_name', 'trade_name'));
        $this->view->customer = $customer;
        $this->view->payOrderData = array();
        echo Ec::renderTpl($this->tplDirectory . "pay_order_add.tpl", 'noleftlayout');
    }

    /**
     * @author simple-yang
     * 处理新增
     */
    public function addSaveAction(){
        $data = $this->_request->getParams();
        $obj = new Service_PayOrderProcess(array('param'=>$data));
        $result = $obj->createPayOrderTransaction($data);
        die(Zend_Json::encode($result));
    }

    /**
     * @author simple-yang
     * 编辑
     */
    public function editAction(){
		//验证是否有编辑权限
		$customer = $this->_customerAuth;
        //主账号
        if($customer['account_level'] == 0) {
            die('请用子账户登陆创建(Please use the sub account to create a landing)');
        }
		if(empty($customer['customer_priv']['is_pay']) || $customer['customer_priv']['is_pay'] != 1){
            $this->redirect('/default/error/deny');
			die();
		}
        $opId = $this->getRequest()->getParam('poId');
        $payOrderData = Service_PayOrder::getByField($opId);
        $this->view->country = Common_DataCache::getCountry();
        $this->view->currencyAll = Common_DataCache::getCurrency();
        $this->view->payOrderAppTypes = Service_PayOrderProcess::getAppType('auto');
        $this->view->payOrderData = $payOrderData;
        echo Ec::renderTpl($this->tplDirectory . "pay_order_add.tpl", 'noleftlayout');
    }

    /**
     * @author simple-yang
     * 保存编辑
     */
    public function editSaveAction(){
        $data = $this->_request->getParams();
        $obj = new Service_PayOrderProcess(array('param'=>$data));
        $result = $obj->createPayOrderTransaction();
        die(Zend_Json::encode($result));
    }

    /**
     * @author simple-yang
     * 查看详情
     */
    public function getDataByPoidAction(){
        $return = array(
				'ask' => 0,
				'message' => '',
				'data'=> array(),
                'log' => array()
		);
		$opId = $this->getRequest()->getParam('poId');
		$payOrderData = Service_PayOrder::getByField($opId);
		$countryArr = Common_DataCache::getCountry();
        $ciqStatus = Service_PayOrder::getCiqStatus();
        $appStatus = Service_PayOrderProcess::getAppStatus('auto');
		if(!empty($payOrderData) && is_array($payOrderData)){
            $payOrderData = Service_PayOrderProcess::conversionParameter($payOrderData);
			$return['ask'] = 1;
			$return['message'] = 'success';
			$return['data'] = $payOrderData;
            $payOrderLogData = Service_PayOrderLog::getByCondition(array('po_id'=>$opId));
            if(!empty($payOrderLogData) && is_array($payOrderLogData)){
                foreach ($payOrderLogData as $key => $value) {

                    if($value['status_type'] == '1'){
                        $payOrderLogData[$key]['pl_status_from'] = (isset($appStatus[$value['pl_status_from']]) && !empty($appStatus[$value['pl_status_from']])) ? $appStatus[$value['pl_status_from']] : '未知状态';
                        $payOrderLogData[$key]['pl_status_to'] = (isset($appStatus[$value['pl_status_to']]) && !empty($appStatus[$value['pl_status_to']])) ? $appStatus[$value['pl_status_to']] : '未知状态';
                    }else{
                        $payOrderLogData[$key]['ciq_status_from'] = (isset($ciqStatus[$value['ciq_status_from']]) && !empty($ciqStatus[$value['ciq_status_from']])) ? $ciqStatus[$value['ciq_status_from']] : '未知状态';
                        $payOrderLogData[$key]['ciq_status_to'] = (isset($ciqStatus[$value['ciq_status_to']]) && !empty($ciqStatus[$value['ciq_status_to']])) ? $ciqStatus[$value['ciq_status_to']] : '未知状态';
                    }
                    $payOrderLogData[$key]['account_name'] = empty($value['account_name']) ? 'system' : $value['account_name'];
                //    $payOrderLogData[$key]['status_type'] = $value['status_type'] == '1' ? '海关' : '检验检疫';
                }
                $return['log'] = $payOrderLogData;
            }
		}
		die(Zend_Json::encode($return));
    }

    /**
     * @author simple-yang
     * 删除
     */
    public function delAction(){
        /*
        $return = array(
                'ask' => 0,
                'message' => '',
                'errorMessage'=>array('Fail.')
        );
        $opId = $this->getRequest()->getParam('opId');
        if(!empty($opId)){
            $return['ask'] = Service_PayOrder::delete($opId);
            $return['message'] = 'success';
            $return['errorMessage'] = array();
        }
        die(Zend_Json::encode($return));
        */
        $return = array('ask'=>0, 'message'=>'');
        $opId = $this->_request->getParam('opId', 0);
        if(empty($opId)){
            $return['message'] = '请选择你要删除的单号;';
            die(json_encode($return));
        }
        $row = Service_PayOrder::getByField($opId);
        if($row instanceof Zend_Db_Table_Row) {
            $row = $row->toArray();
        }
        if(!$row || $row['pay_customer_code']!=$this->customerAuth->data['code'] || $row['status'] != 1 ){
            $return['message'] = '单号不存在或者状态不允许操作;';
            die(json_encode($return));
        }
        $result = Service_PayOrder::update(array('status'=>2, 'update_time'=>$this->_date), $opId);
        $return['ask'] = $result ? 1 : 0;
        $return['message'] = $result ? '删除成功' : '删除失败';
        die(json_encode($return));
    }

    /**
     * @author simple-yang
     * 支付单列表
     */
    public function payOrderListAction(){
        $customer = $this->_customerAuth;
        $page       = $this->getRequest()->getParam('page', 1);
        $pageSize   = $this->getRequest()->getParam('pageSize', 20);
        $condition  = array(
                'pay_no'                => trim($this->getRequest()->getParam('pay_no', '')),
                'reference_no'          => trim($this->getRequest()->getParam('reference_no', '')),
                'po_code'               => trim($this->getRequest()->getParam('po_code', '')),
                'status'                => 1,
                'app_status'            => trim($this->getRequest()->getParam('app_status', '')),
                'add_start_time'        => $this->getRequest()->getParam('add_start_time', ''),
                'add_end_time'          => $this->getRequest()->getParam('add_end_time', ''),
                'customer_code'         => trim($this->getRequest()->getParam('customer_code', '')),
                'pay_customer_code'     => trim($this->getRequest()->getParam('pay_customer_code', '')),
                'ciq_status'            => trim($this->getRequest()->getParam('ciq_status', '')),
            //    'priv_customer_code_arr'=> $customer['priv_customer_code_arr'],
        );

        //支付企业
        if(isset($customer['customer_priv']['is_pay']) && $customer['customer_priv']['is_pay'] == 1 ){
            $condition['pay_customer_code'] = $customer['code'];
        }
        //电商企业
        if(isset($customer['customer_priv']['is_ecommerce']) && $customer['customer_priv']['is_ecommerce'] == 1 ){
            $condition['ecommerce_platform_customer_code'] = $customer['code'];
        }
        $count = Service_PayOrder::getByCondition($condition, 'count(*)');
        if($count){
            $result = Service_PayOrder::getByCondition($condition, '*', $pageSize, $page, 'po_id DESC');
            if(is_array($result) && !empty($result)){
    			foreach ($result as $k=>$v){
                    /*
    				if(key_exists('cosignee_country_id', $v)){
    					$result[$k]['cosignee_country'] = $countryArr[$v['cosignee_country_id']]['country_code'].'-'.$countryArr[$v['cosignee_country_id']]['country_name'];
    				}
                    */
    				if(key_exists('customer_code', $v)){
    					$customerData = Service_Customer::getByField($v['customer_code'], 'customer_code', array('trade_name'));
    					$result[$k]['customer_data'] = $v['customer_code'].'-'.$customerData['trade_name'];
    				}
    				if(key_exists('pay_customer_code', $v)){
    					$customerData = Service_Customer::getByField($v['pay_customer_code'], 'customer_code', array('trade_name'));
    					$result[$k]['pay_customer_data'] = $v['pay_customer_code'].'-'.$customerData['trade_name'];
    				}
                    /*
                    if(key_exists('ciq_status', $v)){
                        $result[$k]['ciq_status'] = Service_PayOrder::getCiqStatus($v['ciq_status']);
                    }
                    */
    			}
    		}
        }else{
            $result = array();
        }
        $this->view->ciqStatus = Service_PayOrder::getCiqStatus();
        $this->view->appStatusGroupRows = Service_PayOrder::getGroupByCondition($condition, 'app_status');
        $this->view->country = Common_DataCache::getCountry();
        $this->view->currencyAll = Common_DataCache::getCurrency();
        $this->view->appStatus = Service_PayOrderProcess::getAppStatus('auto');
        $this->view->payOrderAppTypes = Service_PayOrderProcess::getAppType('auto');
        $this->view->count      = $count;
        $this->view->result     = $result;
        $this->view->pageSize   = $pageSize;
        $this->view->page       = $page;
        $this->view->condition = $condition;
        $this->view->customerLogin = $customer;
        //可分配给子账号的权限
        $this->view->privilege = Service_AccountPrivilege::getAssignedPrivilege();
        echo Ec::renderTpl($this->tplDirectory.'pay_order_list.tpl', 'noleftlayout');
    }

    /**
     * @author simple-yang
     * @todo 支付单批量导入模板
     */
    public function batchOrderAction(){
        $customer = $this->_customerAuth;
        //主账号
        if($customer['account_level'] == 0) {
            die('请用子账户登陆创建(Please use the sub account to create a landing)');
        }
        if(empty($customer['customer_priv']['is_pay']) || $customer['customer_priv']['is_pay'] != 1){
            $this->redirect('/default/error/deny');
            die();
        }
        echo Ec::renderTpl($this->tplDirectory . "pay_order_batch.tpl", 'noleftlayout');
    }

    /**
     * @author simple-yang
     * @todo 下载模板-CSV
     */
    public function downTempleteAction(){
        $file = strtolower($this->_request->getParam('file',''));
        switch($file){
            case 'orderupload':
                $fullPath = APPLICATION_PATH."/../data/file".'/PayOrderbatchUpload.xls';
                break;
            case 'waybillupload' :
                $fullPath = APPLICATION_PATH."/../data/file".'/waybillbatchUpload.xls';
                break;
        }
        $filename = basename($fullPath);
        echo file_get_contents($fullPath);
        $this->down_header($filename, 'application/vnd.ms-excel');
    }

    /**
    //CSV - 版本
    public function downTempleteAction(){
        self::down_header('import.csv', 'application/vnd.ms-excel');
        $exampleData = array('SOE02010000001', 'C0201', '443695875697121', '68.66', '123.12','RMB','simple','深圳市前海湾保税港区53号', '13888888888', '中国', '100.00', '优惠', '备注');//导出文件内容
        echo iconv("UTF-8", "gb2312", "订单号,客户代码,交易订单号,订单商品货款,订单商品运费,货币币种,收货人名称,收货人地址,收货人电话,收货人所在国家,优惠金额,优惠信息说明,备注")."\r\n";
        $tep = ',';
        foreach ($exampleData as $v){
            echo iconv("UTF-8", "gb2312", $v."\t").$tep;
        }
    }
    */

    /**
     * 下载头部信息
     * @author simple
     * @param string $filename 文件名称
     * @param string $type 下载文件类型
     */
    public static function down_header($filename, $type){
        header("Content-type:$type");
        header("Content-Disposition:attachment;filename=\"".$filename."\"");
        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/download");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires:0");
        header("Pragma:public");
    }

    /**
     * @author simple-yang
     * @todo 导入检查
     */
    public function batchcheckAction(){
        //header('Content-type:text/html;charset=utf-8');
        set_time_limit(300);
        $payOrderUpload = new Zend_Session_Namespace('PayOrderUpload');
       // $field = 'PayOrderUpload';
        $xlsData = Service_PayOrder::getXLSData($_FILES['PayOrderUpload']);
        //导入读取文件失败提示信息
        if(isset($xlsData['ask']) && $xlsData['ask']=='0'){
            $this->view->uploadinfo = $xlsData;
            die(Ec::renderTpl($this->tplDirectory . "pay_order_batch.tpl", 'noleftlayout'));
        }else{
            $payOrderRows = Service_PayOrder::getDataArr($xlsData);
            //保存到session
            $payOrderUpload->uploadData = $payOrderRows;
           // print_r($payOrderRows);
            $this->view->doupload = true;
            $this->view->uploadData = $payOrderRows;
            die(Ec::renderTpl($this->tplDirectory . "pay_order_upload_edit.tpl", 'noleftlayout'));
        }
    }

    /**
     * @author simple-yang
     * @todo 支付单导入数据返回结果
     */
    public function importAction(){
        $customer = $this->_customerAuth;
        set_time_limit(300);
        ini_set('memory_limit', '1024M');
        $payOrderUpload = new Zend_Session_Namespace('PayOrderUpload');
        $sessionData = $payOrderUpload->uploadData;
        $ids = $this->_request->getParam('select');
        //
        $success = $false = 0;
        $successHtml = $failseHtml = $html = '';
        $index = 1;
        $doupload = true;
        if($doupload){
            foreach ($ids as $val){
                $status = 1;
                $orderRow = $sessionData[$val];
                $orderRow['po_id'] = '';
                $orderRow['status'] = 1;
                $orderRow['pay_customer_code'] = $customer['code'];
                $orderRow['pay_account_code'] = $customer['account_code'];
                $process = new Service_PayOrderProcess(array('param'=>$orderRow));
                $result = $process->createPayOrderTransaction();
                if($result['ask']=='1'){
                    $successHtml .= '<p>第'.$index.'个支付单创建成功'.'</p>';
                    $success++;
                }else {
                    $failseHtml.="<p>第{$index}个支付单".$result['message'][0];
                    if(isset($result['error'])){
                        $error = $result['error'];
                        if(!empty($error)){
                            foreach($error as $key=>$err){
                                $failseHtml.="<div class='error'>{$err}</div>";
                            }
                        }
                    }
                    $failseHtml.='</p>';
                    $false++;
                }
                $index++;

            }
            $uploadResult = "<p>合计：成功{$success}，失败$false</p>";
            $html = $html.$successHtml.$failseHtml.$uploadResult;
        }
        $this->view->uploadResult = $html;
        unset($payOrderUpload->uploadData);
        echo Ec::renderTpl($this->tplDirectory . "pay_order_batch.tpl", 'noleftlayout');
    }
    /**
     * 获取企业名称
     * @return [json]
     */
    public function getCompanyNameByCusCodeAction(){
        $result = array(
                'ask' => 0,
                'message' => '获取企业名称失败;',
                'data'=>array()
        );
        //权限
        $customer = $this->_customerAuth;
        $customer_code = $this->getRequest()->getParam('customer_code');
        if(!empty($customer_code) && in_array($customer_code, $customer['priv_customer_code_arr'])){
            $customerData = Service_Customer::getByField($customer_code, 'customer_code', array('customer_company_name'));
            if(!empty($customerData)){
                $result['ask'] = 1;
                $result['message'] = 'get success';
                $result['data'] = $customerData;
            }
        }
        die(Zend_Json::encode($result));
    }

    /**
     * [FunctionName 获取订单信息]
     * @param string $value [description]
     */
    public function getOrderInfoByOrderCodeAction()
    {
        $customer = $this->_customerAuth;
        $result = array(
                'ask' => 0,
                'message' => '获取订单信息失败(Failed to get the order information)',
                'data'=>array()
        );
        $order_code = $this->getRequest()->getParam('order_code', '');
        if(!empty($order_code)){
            $orderData = Service_Orders::getByField($order_code, 'order_code', array('ecommerce_platform_customer_code', 'ecommerce_platform_customer_name', 'customer_code', 'customer_name', 'reference_no'));
        //    $orderData = Service_Orders::getByCondition(array('order_code'=>$order_code, 'pay_customer_code'=>$customer['code']), array('ecommerce_platform_customer_code', 'ecommerce_platform_customer_name', 'customer_code', 'customer_name', 'reference_no'));
            if(!empty($orderData) && in_array($orderData['customer_code'], $customer['priv_customer_code_arr'])){
                $orderData['enp_name'] = $orderData['customer_name'];
                $result['ask'] = 1;
                $result['message'] = 'get success';
                $result['data'] = $orderData;
            }
        }
        die(Zend_Json::encode($result));
    }
}
