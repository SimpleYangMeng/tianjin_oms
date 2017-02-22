<?php
/**
 * @author simple <[<email address>]>
 */
class Storage_TaxationGuaranteeController extends Ec_Controller_Action {
	public $_date;
    public function preDispatch() {
    	$this->_date = date('Y-m-d H:i:s');
        $this->tplDirectory = "storage/views/guarantee/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    /**
     * @return [type]
     */
    public function indexAction(){
    	$this->addAction();
    }
    /**
	 * 添加税费担保信息
     */
    public function addAction(){
        //验证是否有编辑权限
        $customer = $this->_customerAuth;
        $tgData = Service_TaxationGuarantee::getByCondition(array('customer_code'=>$customer['code'], 'data_status'=>1,'status_arr'=>array('1','2','3','4','7')), array('customer_code'));
        if(!empty($tgData) && is_array($tgData)){
            die('<span class="blue">您已经创建税费担保，请到列表查询。</span>');
        }
        //主账号
        if($customer['account_level'] == 0) {
            die('请用子账户登陆创建(Please use the sub account to create a landing)');
        }

        $companyInfo = Service_Customer::getByField($customer['code'], 'customer_code', array('customer_code', 'customer_company_name', 'trade_name'));
        //处理数据提交
    	if($this->_request->isPost()){
            $data = $this->_request->getParams();
            if(key_exists('tg_bank_name', $data) && !empty($data['tg_bank_name'])){
                /*
                list($tgNankName, $tgBankCode) = explode('-', $data['bank']);
                $data['tg_bank_name'] = $tgNankName;
                $data['tg_bank_code'] = $tgBankCode;
                unset($data['bank']);
                */
                $bankCode = Service_Bank::getByField($data['tg_bank_name'], 'bank_name_cn', array('bank_code'));
                $data['tg_bank_code'] = empty($bankCode['bank_code']) ? '' : $bankCode['bank_code'];
            }else{
                $data['tg_bank_name'] = '';
                $data['tg_bank_code'] = '';
            }
            $obj = new Service_TaxationGuaranteeProcess(array('param'=>$data));
            $result = $obj->create();
            die(json_encode($result));
        }
        $data = array();
        $tg_id = $this->_request->getParam('tg_id', 0);
        if($tg_id){
            if(empty($customer['customer_priv']['is_storage']) || $customer['customer_priv']['is_storage'] != 1){
                die('No authority');
            }
            $data = Service_TaxationGuarantee::getByField($tg_id, 'tg_id');
            if($data instanceof Zend_Db_Table_Row){
                $data = $data->toArray();
            }
            /*if(!$data || $data['customer_code']!=$this->customerAuth->data['code']){
                die('单号不存在');
            }*/
            if(!$data){
                die('单号不存在');
            }
        }
        $this->view->customer = $customer;
        $this->view->companyInfo = $companyInfo;
        $this->view->data = $data;
        $this->view->banks = Service_Bank::getByCondition(array('status'=> 1), array('bank_name_cn'));
    	$this->view->cTypes = Service_TaxationGuaranteeProcess::getGtype();
        $this->view->customsCodes = Service_IePort::getAll();
    	$currencyRow = Service_Currency::getAll();
    	$currency = array();
        foreach($currencyRow as $value) {
            $currency[] = array('code'=>$value['currency_code'],'name'=>$value['currency_name']);
        }
        $this->view->currency = $currency;
        echo Ec::renderTpl($this->tplDirectory . "add.tpl", 'noleftlayout');
    }

    /**
     * [税费担保列表 description]
     * @return [type] [description]
     */
    public function listAction(){
        $customer = $this->_customerAuth;
        /*
        $priv_customer = array();
        if(!empty($customer['priv_customer_code_arr']) && is_array($customer['priv_customer_code_arr'])){
            foreach ($customer['priv_customer_code_arr'] as $key => $value) {
                $customerData = Service_Customer::getByField($value, 'customer_code', array('customer_company_name'));
                $priv_customer[$value] = !empty($customerData) ? $value.'-'.$customerData['customer_company_name'] : $value.'-未知公司';
            }
        }
        */
        $page = $this->_request->getParam('page', 1);
        $pageSize = $this->_request->getParam('pageSize', 20);
        $g_type = $this->_request->getParam('g_type','');
        $customer_code = $this->_request->getParam('customer_code','');
        $currency_code = $this->_request->getParam('currency_code','');
        $guarantee_basis = $this->_request->getParam('guarantee_basis','');
        $status = $this->_request->getParam('status','');
        $addStartTime = $this->_request->getParam('add_start_time', '');
        $addEndTime = $this->_request->getParam('add_end_time', '');
        $condition = array(
                'g_type' => $g_type,
                'customer_code' => $customer_code,
                'status' => $status,
                'currency_code' => $currency_code,
                'guarantee_basis' => $guarantee_basis,
                'data_status' => 1,
                //申报企业编码
                'customer_code' => $customer['code'],
                'add_start_time' => $addStartTime,
                'add_end_time' => $addEndTime
        );
        if($this->_request->isPost()){
            $return = array(
            	'ask'=>1,
            	'data'=>array(),
            	'total'=>0
            );
            $total = Service_TaxationGuarantee::getByCondition($condition, 'count(*)');
            if($total>0){
                $result = Service_TaxationGuarantee::getByCondition($condition, '*', $pageSize, $page, array('tg_id desc'));
                $return['data'] = $result;
            }
            $return['total'] = $total;
            die(json_encode($return));
            /*
            $flag = false;
            if(empty($condition['customer_code'])){
                $condition['customer_code'] = $customer['priv_customer_code_arr'];
                $flag = true;
            }else {
                if(in_array($condition['customer_code'], $customer['priv_customer_code_arr'])){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }
            if($flag){
                $total = Service_TaxationGuarantee::getByCondition($condition, 'count(*)');
                if($total>0){
                    $result = Service_TaxationGuarantee::getByCondition($condition, '*', $pageSize, $page, array('tg_id desc'));
                    $return['data'] = $result;
                }
                $return['total'] = $total;
            }
            */
        }
        $layout = new Zend_Layout();
        $layout->useMyPage	= true;
    	$currencyRow = Service_Currency::getAll();
    	$currency = array();
        foreach($currencyRow as $value) {
            $currency[] = array('code'=>$value['currency_code'],'name'=>$value['currency_name']);
        }
        $this->view->currency = $currency;
        $this->view->cTypes = Service_TaxationGuaranteeProcess::getGtype();
        $this->view->jsoncTypes = Zend_Json::encode(Service_TaxationGuaranteeProcess::getGtype());
        $this->view->status = Service_TaxationGuaranteeProcess::getStatus();
        $this->view->jsonStatus = Zend_Json::encode(Service_TaxationGuaranteeProcess::getStatus());
        $this->view->customerLogin = $customer;
        echo Ec::renderTpl($this->tplDirectory .'list.tpl', 'noleftlayout');
        exit;
    }

    /**
     * [查看详情 description]
     * @return [type] [description]
     */
    public function viewAction(){
		$return = array(
				'ask' => 0,
				'message' => '',
				'data'=>array()
		);
    	$tgId = $this->_request->getParam('tg_id', 0);
    	$cTypes = Service_TaxationGuaranteeProcess::getGtype();
    	$status = Service_TaxationGuaranteeProcess::getStatus();
        $tgData = Service_TaxationGuarantee::getByField($tgId, 'tg_id');
    	$iePort = Service_Currency::getIePort();
    	if(!empty($tgData) && is_array($tgData)){
    		$tgData['g_type'] = $cTypes[$tgData['g_type']];
    		$tgData['status'] = $status[$tgData['status']];
            $tgData['tg_bank_name'] = $tgData['tg_bank_name'];
    		$return['ask'] = 1;
			$return['message'] = 'success';
			$return['data'] = $tgData;
    	}
	//	$return['data']['customs_code'] = $return['data']['customs_code'].' '.$iePort[$return['data']['customs_code']];
		$iePortName = (!isset($iePort[$return['data']['customs_code']]) || empty($iePort[$return['data']['customs_code']])) ? '' : $iePort[$return['data']['customs_code']];
		$return['data']['customs_code'] = $return['data']['customs_code'].' '.$iePortName;
    	die(Zend_Json::encode($return));
    }

    /**
     * [删除数据 description]
     * @return [type] [description]
     */
    public function deleteAction(){
    	$return = array('ask'=>0, 'message'=>'');
        $tg_id = $this->_request->getParam('tg_id', 0);
        if(empty($tg_id)){
            $return['message'] = '请选择你要删除的单号;';
            die(json_encode($return));
        }
        $row = Service_TaxationGuarantee::getByField($tg_id, 'tg_id');
        if($row instanceof Zend_Db_Table_Row) {
            $row = $row->toArray();
        }
        if(!$row || $row['storage_customer_code']!=$this->customerAuth->data['code'] || $row['status']==-1){
            $return['message'] = '单号不存在或者状态不允许操作;';
            die(json_encode($return));
        }
        $result = Service_TaxationGuarantee::update(array('data_status'=>-1, 'update_time'=>$this->_date), $tg_id, 'tg_id');
        $return['ask'] = $result ? 1 : 0;
        $return['message'] = $result ? '删除成功' : '删除失败';
        die(json_encode($return));
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
    //	if(!empty($customer_code) && in_array($customer_code, $customer['priv_customer_code_arr'])){
        if(!empty($customer_code)){
    		$customerData = Service_Customer::getByField($customer_code, 'customer_code', array('trade_name'));
    		if(!empty($customerData)){
    			$result['ask'] = 1;
    			$result['message'] = 'get success';
    			$result['data'] = $customerData;
    		}
    	}
    	die(Zend_Json::encode($result));
    }

}
