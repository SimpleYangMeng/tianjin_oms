<?php
class Merchant_CustomerController extends Ec_Controller_Action{
	public function preDispatch()
	{
		$this->tplDirectory = "merchant/views/customer/";
		$params = self::getFrontController()->getRequest()->getParams();
		$this->view->ac = $params['action'];
	}
	public function showAction(){
		echo Ec::renderTpl($this->tplDirectory . "showedit.tpl",'noleftlayout');
		//echo $this->view->render($this->tplDirectory . "showedit.tpl");
	}
	public function editAction(){

		$user	= $this->_customerAuth;
		//print_r($user);
		if($this->_request->isPost()){

			$cab_firstname			= $this->_request->getParam('cab_firstname','');
			$cab_lastname			= $this->_request->getParam('cab_lastname','');
			$cab_phone				= $this->_request->getParam('cab_phone','');
			$cab_fax				= $this->_request->getParam('cab_fax','');
			$cab_state				= $this->_request->getParam('cab_state','');
			$cab_city				= $this->_request->getParam('cab_city','');
			$postcode				= $this->_request->getParam('postcode','');
			$cab_street_address1	= $this->_request->getParam('cab_street_address1','');
			$cab_id					= $this->_request->getParam('id');

			$logo					= $this->_request->getParam('logo','');

			$data['cab_firstname']		= $cab_firstname;
			$data['cab_id']				= $cab_id;
			$data['cab_lastname']		= $cab_lastname;

			$data['cab_phone']			= $cab_phone;
			$data['cab_fax']			= $cab_fax;
			$data['cab_state']			= $cab_state;
			$data['cab_city']			= $cab_city;
			$data['customer_postno']			= $postcode;
			$data['cab_street_address1']= $cab_street_address1;

			$data['cab_id']				= $cab_id;
			$data['customer_id']		= $user['id'];

			$imgs	= array();
			$fields	= empty($_FILES) ? '' : array_keys($_FILES);
			//$path	= './upload/images';
			$path = APPLICATION_PATH.'/../data/images/register/'.$user['code'];

			$isDir	= Common_Common::createPath($path);
			if ($isDir && !empty($fields)) {
				foreach ($fields as $field) {
					$state	= Common_Common::uploadImg($_FILES, $field, $path);
					if ($state['error']) {
						$msg	= strip_tags($state['msg']);
						$imageresult['ask']='1';
						$imageresult['message']=$msg;
						die(Zend_Json_Encoder::encode($imageresult));
					}
					$imgs[$field]	= $state['msg']['file_name'];
				}
			}
			$data['customer_logo']		= empty($logo) ? '' : $logo;
			$data['customer_license']	= empty($imgs['license']) ? '' : $imgs['license'];
			$data['customer_idcard']	= empty($imgs['identity']) ? '' : $imgs['identity'];

			$result = Service_CustomerProcess::updateCustomerTransaction($data,$user['id']);
			/*
			if($result['ask']=='1'){
				die("<script>document.write('{$result['message']}');setTimeout('window.history.back();', 2000);</script>");
			}else{
				die("<script>document.write('{$result['message']}');setTimeout('window.history.back();', 2000);</script>");
			}
			*/
			die(Zend_Json_Encoder::encode($result));
		}

		$userInfo = Service_Customer::getByField($user['id']);
		if($userInfo['customer_logo']!='' && @file_get_contents($userInfo['customer_logo'])!==false){
			$userInfo['customer_logo_url'] = $userInfo['customer_logo'];
		}

		$this->view->currency	= Common_DataCache::getCurrency();
		$this->view->country	= Common_DataCache::getCountry();
		$this->view->userInfo	= $userInfo;
		$customerAddressInfo = Service_CustomerAddressBook::getByField($userInfo['customer_code'],'customer_code');
		$this->view->customerAddress = $customerAddressInfo;
		echo Ec::renderTpl($this->tplDirectory . "edit.tpl",'noleftlayout');
		//echo $this->view->render($this->tplDirectory . "edit.tpl");
	}


	/*客户基本信息*/
	public function baseinfoAction(){
		$user	= $this->_customerAuth;
		$userInfo = Service_Customer::getByField($user['id']);

		if($userInfo['customer_logo']!='' && @file_get_contents($userInfo['customer_logo'])!==false){
			$userInfo['customer_logo_url'] = $userInfo['customer_logo'];
		}
		$customerTypeSecond = array();
		$customerTypeThird = array();
		$customerTypeTwo['customer_company_name'] = '';
		$customerTypeThree['customer_company_name'] = '';
		if($userInfo['customer_type'] == 1){
			$customerTypeTwo = Service_CustomerApplyBinding::getByCondition(array('customer_code'=>$userInfo['customer_code'],'customer_type'=>'2'));
			$customerTypeThree = Service_CustomerApplyBinding::getByCondition(array('customer_code'=>$userInfo['customer_code'],'customer_type'=>'3'));
			if(!empty($customerTypeTwo)){
				$customerTypeTwo = Service_Customer::getByField($customerTypeTwo['0']['cab_customer_code'],'customer_code');
				$customerTypeThree = Service_Customer::getByField($customerTypeThree['0']['cab_customer_code'],'customer_code');
			}

			//
			$customerTypeSecond = Service_Customer::getByCondition(array('customer_type'=>'2','customer_status'=>'2','cab_status'=>'1'));
			$customerTypeThird = Service_Customer::getByCondition(array('customer_type'=>'3','customer_status'=>'2','cab_status'=>'1'));
		}
		// print_r($customerTypeTwo);exit;
		$businessType = '';
		$businessType = Service_Customer::businessType($userInfo);
		// print_r($businessType);exit;
		
		$this->view->business = $businessType ? implode('|', $businessType) : '';
		$this->view->currency	= Common_DataCache::getCurrency();
		$this->view->country	= Common_DataCache::getCountry();
		$this->view->customer	= $userInfo;
		$this->view->customerTypeSecond	= $customerTypeSecond;
		$this->view->customerTypeThird	= $customerTypeThird;
		$this->view->ieport = Service_IePort::getByField($userInfo['customs_code'], 'ie_port');
		
		// $this->view->customerTypeTwo	= $customerTypeTwo['customer_company_name'];
		// $this->view->customerTypeThree	= $customerTypeThree['customer_company_name'];
		$customerAddressInfo = Service_CustomerAddressBook::getByField($userInfo['customer_code'],'customer_code');
		$this->view->customerAddress = $customerAddressInfo;
		echo Ec::renderTpl($this->tplDirectory . "customer_detail.tpl",'noleftlayout');
		//echo $this->view->render($this->tplDirectory . "edit.tpl");
	}
	/**
	 * @author william-fan
	 * @todo 用于获取用户的图片信息
	 */
	public function imageAction(){
		$user	= $this->_customerAuth;
		$path = APPLICATION_PATH.'/../data/images/register/'.$user['code'];
		$userInfo = Service_Customer::getByField($user['id']);
		$imagetype = $this->_request->getParam('imagetype','');
		switch($imagetype){
			case 'license':
				header('Content-Type: image/jpeg');
				echo file_get_contents($path.'/'.$userInfo['customer_license']);
				break;
			case 'idcard':
				header('Content-Type: image/jpeg');
				echo file_get_contents($path.'/'.$userInfo['customer_idcard']);
				break;
		}
	}
	/*密码修改*/
    public function changePasswordAction(){
        if($this->_request->isPost()){
            $account_code = $this->_request->getParam("account_code","");
            $new_password1 = $this->_request->getParam("new_password1","");
            $pwd = md5($new_password1);
            $acount = Service_Account::getByField($account_code,'account_code',"*");
            $row = array(
                'account_password'=>$pwd,
				'account_update_time'=>date('Y-m-d H:i:s',time()),
            );
            if($acount['account_level']=="0"){
                $customerRow = array(
                    'customer_password'=>$pwd,
                    'password_update_time'=>date("Y-m-d H:i:s"),
                );
                Service_Customer::update($customerRow,$acount['customer_code'],'customer_code');
            }
            if(Service_Account::update($row,$account_code,'account_code')){
                $result = array(
                    'ask'=>1,
                    'message'=>Ec_Lang::getInstance()->getTranslate('password_update_successfully')
                );
            }else{
				$result = array(
                    'ask'=>0,
                    'message'=>Ec_Lang::getInstance()->getTranslate('password_update_failed')
                );
			}
			die(json_encode($result));
        }else{
            $session	= new Zend_Session_Namespace('customerAuth');
            $data = $session->data;
            $this->view->account_code = $data['account_code'];
			echo Ec::renderTpl($this->tplDirectory . "change-password.tpl",'noleftlayout');
            //echo $this->view->render($this->tplDirectory . "change-password.tpl","layout");
        }
    }
    public function checkpwdAction(){
        $account_code = $this->_request->getParam('account_code','');
        $oldPassword = $this->_request->getParam('password','');
        $account = Service_Account::getByField($account_code,'account_code',"*");
        /*$pw = md5($oldPassword);
        $row = array(
            'customer_password'=>$pw
        );
        Service_Customer::update($row,$customer_code,'customer_code');*/
        if(md5($oldPassword)==$account['account_password']){
            die("1");
        }else{
            die("0");
        }
    }
    public function changeTokenAction(){
        $id = $this->_request->getParam('id',"");
        $customerRow = Service_Customer::getByField($id,'customer_id',"*");
        $ca_key = md5($customerRow['customer_code'].date("Y-m-d H:i:s"));
        $ca_token = strtoupper(substr(md5(substr($ca_key,0,16).$customerRow['customer_code']),0,16));
        $row = array(
            'ca_token'=>$ca_token,
            'ca_key'=>$ca_key,
            'ca_update_time'=>date("Y-m-d H:i:s")
        );
        if(Service_CustomerApi::update($row,$id,'customer_id')){
            $return['state'] = "1";
            $data = array(
                'token'=>$ca_token,
                'key'=>$ca_key
            );
            $return['data'] = $data;
        }else{
            $return['state'] = "0";
            $data = array(
                'token'=>'',
                'key'=>''
            );
            $return['data'] = $data;
        }
        die(json_encode($return));
    }
    public function requireTokenAction(){
        $id = $this->_request->getParam("id","");
        $customerRow = Service_Customer::getByField($id,'customer_id',"*");
        $ca_key = md5($customerRow['customer_code'].date("Y-m-d H:i:s"));
        $ca_token = strtoupper(substr(md5(substr($ca_key,0,16).$customerRow['customer_code']),0,16));
        $row = array(
            'customer_id'=>$id,
            'customer_code'=>$customerRow['customer_code'],
            'ca_status'=>'1',
            'ca_token'=>$ca_token,
            'ca_key'=>$ca_key,
            'ca_add_time'=>date("Y-m-d H:i:s"),
            'ca_update_time'=>date("Y-m-d H:i:s")
        );
        if(Service_CustomerApi::add($row)){
            $return['state'] = "1";
            $data = array(
                'token'=>$ca_token,
                'key'=>$ca_key
            );
            $return['data'] = $data;
        }else{
            $return['state'] = "0";
            $data = array(
                'token'=>'',
                'key'=>''
            );
            $return['data'] = $data;
        }
        die(json_encode($return));
    }


    public function applyAction(){
    	$user	= $this->_customerAuth;
        $customerTypeSecond = $this->_request->getParam('customer_type_second',"");
        $customerTypeThird = $this->_request->getParam('customer_type_third',"");
        // print_r($customerTypeSecond);
        // print_r($customerTypeThird);exit;
        $apply_data = array();
        if($customerTypeSecond){
        	$apply_data['2'] = $customerTypeSecond;
        }
        if($customerTypeThird) {
        	$apply_data['3'] = $customerTypeThird;
        }
        if(empty($apply_data)){
        	$result = array(
                    'state'=>0,
                    'error'=>'请选择需要申请的功能.'
                );
        	die(json_encode($result));
        }
        foreach ($apply_data as $key => $value) {
	        $row = array(
	        'cab_customer_code'=>$value,
	        'customer_code'=>$user['code'],
	        'cab_add_time'=>date("Y-m-d H:i:s"),
	        'customer_type'=>$key
	        );
	        if(Service_CustomerApplyBinding::add($row)){
	        	$result = array(
                    'state'=>1,
                    'message'=>Ec_Lang::getInstance()->getTranslate('apply_successfully')
                );
	        }else{
	        	$result = array(
                    'state'=>0,
                    'error'=>Ec_Lang::getInstance()->getTranslate('apply_fail')
                );
	        }
        }

        die(json_encode($result));
    }


    public function baseinfoUpdateAction()
    {
        $updateCustomerStatus = array(2, 4);
        $customerCode = $this->_customerAuth['code'];

        if($this->_request->isPost()){
            $result = array("ask"=>0,"message"=>"",'error'=>array());
            $params = $this->_request->getParams();
            $customerObject = new Service_CustomerProcess();
            $result = $customerObject->updateOrderTransaction($params, $customerCode);
            die(json_encode($result));
            exit;
        }

        $customerRow = Service_Customer::getByField($customerCode, 'customer_code');
        // 除已审核和审核不通过的备案，其他都不能修改
        if(!in_array($customerRow['customer_status'], $updateCustomerStatus)){
            $this->view->errorTip = '只有已审核和审核不通过状态才可以修改企业备案！';
            echo Ec::renderTpl($this->tplDirectory . "enterprise-record-edit.tpl",'noleftlayout');
            exit;
        }
        $this->view->customerRow = $customerRow;

        echo Ec::renderTpl($this->tplDirectory . "enterprise-record-edit.tpl",'noleftlayout');
    }

}
