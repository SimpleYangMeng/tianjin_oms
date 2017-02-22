<?php
class Default_RegisterController extends Ec_Controller_DefaultAction {
	// --------------------------------------------------------------------
	public function preDispatch() {
		$this->tplDirectory = "default/views/register/";
	}

	// --------------------------------------------------------------------
	/**
	 * 注册首页
	 * @access  public
	 * @return  resource
	 */
	public function indexAction() {
		$session = new Zend_Session_Namespace('RegisterStep');
		$session->step = '0';
		echo Ec::renderTpl($this->tplDirectory . "index.tpl", 'layout');
	}

	// --------------------------------------------------------------------
	/**
	 * 注册步骤
	 *
	 */
	public function stepAction() {
		$current = $this->getRequest()->getParam('current');
		$session = new Zend_Session_Namespace('register');
		if (empty($session->data)) {
			$this->_redirect('/register');
		}
		$this->view->data = $session->data;
		$sessioCurrentStep = $session->data['current'];
		if ($current != $sessioCurrentStep) {
			$this->_redirect('/register/step?current=' . $sessioCurrentStep);
		}
		switch ($current) {
		case '2':
			echo Ec::renderTpl($this->tplDirectory . "step2.tpl", 'layout');
			break;
		case '3_1':
			if (!($this->getRequest()->isPost() && $this->getRequest()->getParam('is_agree'))) {
				$this->_redirect('/register/step?current=3');
			}
			$row = array('customer_status' => '2', 'is_baoguan' => '1');
			$this->view->currency = Common_DataCache::getCurrency();
			$this->view->country = Common_DataCache::getCountry();
			//仓储企业
			$this->view->agent = Service_Customer::getByCondition($row, '*');
			//主管海关
			$this->view->custom = Service_IePort::getAll();
			//属地检验检疫机构
			$this->view->organizations = Service_Organization::getByCondition(array('is_display'=> 1));
			echo Ec::renderTpl($this->tplDirectory . "step3_1.tpl", 'layout');
			break;
		case '4':
			echo Ec::renderTpl($this->tplDirectory . "step4.tpl", 'layout');
			break;
		case '3':
			echo Ec::renderTpl($this->tplDirectory . "step3.tpl", 'layout');
			break;
		}
	}

	// --------------------------------------------------------------------
	/**
	 * 邮件激活
	 *
	 */
	public function activateAction() {
		header('Content-Type: text/html; charset=UTF-8');
		$code = trim($this->getRequest()->getParam('code'));
		$time = trim($this->getRequest()->getParam('time'));
		$cid = trim($this->getRequest()->getParam('cid'));
		if (empty($code) || strlen($code) != 32) {
			die("<script type='text/javascript'>document.body.innerHTML='';alert('您的验证码不合法,请重新发送激活邮件重试.');window.history.back();</script>");
		}
		//一天失效
		if (empty($time) || time() - $time > 3600 * 24 ) {
			die("<script type='text/javascript'>document.body.innerHTML='';alert('您的验证码已失效,请重新发送激活邮件重试.');window.history.back();</script>");
		}
		if (empty($cid)) {
			die("<script type='text/javascript'>document.body.innerHTML='';alert('您的激活链接异常,请重新发送激活邮件重试.');window.history.back();</script>");
		}
		$customerData = Service_Customer::getByWhere(array('customer_id'=> $cid, 'customer_activate_code'=> $code), '*');
		if (empty($customerData)) {
			die("<script type='text/javascript'>document.body.innerHTML='';alert('您的验证码不存在或者已失效,请重新发送激活邮件重试.');window.history.back();</script>");
		}
		/*
		$upData = array(
			//邮件激活标志修改
			'cash_type' => 1,
		);
		*/
		if (!empty($customerData['customer_activate_code']) && ($customerData['customer_activate_code'] == $code) && ($customerData['reg_step'] == 1)) {
		//if ($customerData['reg_step'] == 1) {
			/*
			$upData['reg_step'] = 2;
			$upData['customer_activate_code'] = $code;
			*/
			$upData = array(
				'reg_step' => 2,
				'customer_activate_code' => $code
			);
			$state = Service_Customer::update($upData, $customerData['customer_id'], 'customer_id');
			if ($state) {
				$session = new Zend_Session_Namespace('register');
				$session->data = array(
					'id' => $customerData['customer_id'],
					'code' => $customerData['customer_code'],
					'email' => $customerData['customer_email'],
					'current' => 3,
				);
				$this->_redirect('/register/step?current=3');
			}
		} else {
			if (!empty($customerData['customer_activate_code']) && ($customerData['customer_activate_code'] == $code) && ($customerData['reg_step'] > 1)) {

				$session = new Zend_Session_Namespace('register');
				if ($customerData['reg_step'] == '3') {
					//unset($session);
					$session->unsetAll();
					$this->_redirect('/login');
				}else {
					if($state){
						$session->data = array(
							'id' => $customerData['customer_id'],
							'code' => $customerData['customer_code'],
							'email' => $customerData['customer_email'],
							'current' => 3,
						);
					}
				}
				$this->_redirect('/register/step?current=' . $customerData['reg_step']);
			}
		}
		die("<script type='text/javascript'>document.body.innerHTML='';alert('验证链接无效,请重新发送激活邮件重试.');window.history.back();</script>");
	}

	/**
	 * [usessionAction 清除session test]
	 * @return [type] [description]
	 */
	public function usessionAction(){
		$session = new Zend_Session_Namespace('register');
		$session->unsetAll();
		var_dump($session->id);
	}

	/**
	 * 保存注册账号
	 *
	 */
	public function saveAction() {
		$time = date('Y-m-d H:i:s');
		$name = $this->_request->getParam('username', '');
		$pwd = $this->_request->getParam('userpwd', '');
		$repwd = $this->_request->getParam('repwd', '');
		$registerRow = array(
			'customer_password' => $pwd,
			're_password' => $repwd,
			'customer_email' => $name,
			'customer_activate_code' => md5($time),
			'reg_step' => 1,
			'verify' => $this->_request->getParam('verify', ''),
		);
		//print_r($registerRow);
		$process = new Service_CustomerProcess();
		$result = $process->createTransaction($registerRow);
		if ($result['ask'] != '0') {
			//die("<script type='text/javascript'>alert('');window.history.back();</script>");
			//echo json_encode($result);
			$session = new Zend_Session_Namespace('register');
			$session->data = array(
				'id' => $result['customer_id'],
				'code' => $result['customer_code'],
				'email' => $name,
				'current' => 2,
			);
			//$this->_redirect('/register/step?current=2');
		}
		die(json_encode($result));
		/*
		exit;
		$verify	= new Common_Verifycode();
		$value	= $this->getRequest()->getParam('verify');
		$state	= $verify->is_true($value);
		if ($state) {
			$time	= date('Y-m-d H:i:s');
			$name	= $this->getRequest()->getParam('username');
			$pwd	= $this->getRequest()->getParam('userpwd');
			$state	= Service_Customer::getByField($name, 'customer_email', 'customer_id');
			if (is_array($state)) {
				die("<script type='text/javascript'>alert('邮件已被使用，请重新填写！');window.history.back();</script>");
			}
			$mark	= new Common_Customer();
			$code	= $mark->markCustomCode('register');
			if (empty($code)) {
				die("<script type='text/javascript'>alert('生成编码失败，请重新填写！');window.history.back();</script>");
			}
			$lastId	= Service_Customer::add(
				array(
					'customer_code'			=> $code,
					'customer_password'		=> md5($pwd),
					'customer_email'		=> $name,
					'customer_activate_code'=> substr(md5($time),0,12),
					'reg_step'				=> 1,
					'customer_reg_time'		=> $time
				)
			);
			if (empty($lastId)) {
				die("<script type='text/javascript'>alert('保存数据出错，请重新填写！');window.history.back();</script>");
			}
			$state	= Common_Email::send(array(
				'email'		=> $name,
				'subject'	=> '注册账户验证--OMS',
				'bodyType'	=> 'html',
				'body'		=> '请复制该链URL接至浏览器进行访问激活账户！<br/>链接地址：https://192.168.25.128:6666/register/activate?code='.substr(md5($time),0,12)
			));
			if (empty($state)) {
				die("<script type='text/javascript'>alert('验证邮件发送失败，请重新填写！');window.history.back();</script>");
			}
			$session= new Zend_Session_Namespace('register');
			$session->data	= array(
				'id'		=> $lastId,
				'code'		=> $code,
				'email'		=> $name,
				'current'	=> 2
			);
			$this->_redirect('/register/step?current=2');
		} else {
			die("<script type='text/javascript'>alert('验证码错误，请重新填写！');window.history.back();</script>");
		}
		*/
	}

	/**
	 * 重发验证码
	 */
	public function resendAction() {
		header('Content-Type: text/html; charset=UTF-8');
		$session = new Zend_Session_Namespace('register');
		if (empty($session)) {
			$this->_redirect('/login');
		}
		$id = $session->data['id'];
		$email = $session->data['email'];
		$code = md5(date('Y-m-d H:i:s'));
		$upRes = Service_Customer::update(array('customer_activate_code'=>$code, 'cash_type'=>0), $id, 'customer_id');
		if ($upRes) {
			//验证是否是ip
            $host = Common_Common::getCurrentDomainName();
            //IP http
            if(Common_Common::isIp($host)){
                $activePreUrl = 'http://';
            }else {
                $activePreUrl = 'https://';
            }
			$activeurl = $activePreUrl.$host.'/register/activate?code='.$code.'&cid='.$id.'&time='.time();

			$activeHtml = "<a href='$activeurl' target='_blank'>请点击此链接激活您的账户</a>";
			$params = array(
				'bodyType' => 'html',
				'email' => array($email),
				'subject' => '[天津跨境贸易电子商务综合服务平台]账号激活通知',
				'body' => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您注册的邮箱是：{$email},<br/>感谢您的注册，{$activeHtml}。<br/>或者复制以下链接到浏览器进行激活：{$activeurl}",
			);
			$state = Common_Email::sendMail($params);
			/* 
			$state	= Common_Email::send(array(
				'email'		=> $email,
				'subject'	=> '注册账户验证--OMS',
				'bodyType'	=> 'html',
				'body'		=> '请复制该链URL接至浏览器进行访问激活账户！<br/>链接地址：https://192.168.25.128:6666/register/activate?code='.$code
			)); 
			*/
		}
		if (empty($state)) {
			die("<script type='text/javascript'>alert('验证邮件发送失败，请重新填写');window.history.back();</script>");
		} else {
			die("<script type='text/javascript'>alert('验证邮件发送成功，请您查收');window.history.back();</script>");
		}
	}

	// --------------------------------------------------------------------
	/**
	 * 完善资料
	 *
	 */
	public function completeAction() {
		$session = new Zend_Session_Namespace('register');
		if ($this->getRequest()->isPost() && !empty($session->data)) {
			$imgs = array();
			$path = APPLICATION_PATH . '/../data/images/register/' . $session->data['code'];
			$id = $session->data['id'];
			$code = $session->data['code'];
			$email = $session->data['email'];
			$parms = $this->getRequest()->getParams();
			/*
			$ciqLocalOrg = array(
				'120000' => '天津局本部',
				'120010' => '天津局保税区办事处',
				'120020' => '天津局天津国际机场办事处',
				'120100' => '塘沽局本部',
				'120200' => '天津经济技术开发区局本部',
				'120300' => '天津东港局本部',
				'120400' => '天津静海局本部',
				'120500' => '天津宝坻局本部',
			);
			*/
			//属地检验检疫机构
			$organizations = Service_Organization::getByCondition(array('is_display'=> 1));
			$ciqLocalOrg = array();
			if(!empty($organizations) && is_array($organizations)){
				foreach ($organizations as $key => $value) {
					$ciqLocalOrg[$value['organization_code']] = $value['organization_name'];
				}
			}
			//企业类型
			switch ($parms['customertype']) {
				case 1:
					$parms['is_ecommerce'] = 1;
					break;
				case 2:
					$parms['is_shipping'] = 1;
					break;
				case 3:
					$parms['is_pay'] = 1;
					break;
				case 4:
					$parms['is_storage'] = 1;
					break;
				case 5:
					$parms['is_supervision'] = 1;
					break;
				case 6:
					$parms['is_platform'] = 1;
					break;
				case 7:
					$parms['is_baoguan'] = 1;
					break;
			}
			// $businessType = '';
			foreach ($parms['business_type'] as $key => $value) {
				switch ($value) {
				case 1:
					// $busType = 'BI';
					$parms['is_business_in'] = 1;
					break;
				case 2:
					// $busType = 'BE';
					$parms['is_business_export'] = 1;
					break;
				case 3:
					// $busType = 'NI';
					$parms['is_normal_in'] = 1;
					break;
				case 4:
					// $busType = 'NE';
					$parms['is_normal_export'] = 1;
					break;
				}
				// $businessType[] = $busType;
			}
			// $businessType = implode('|', $businessType);
			// print_r($parms['bus_web_address']);exit;
			if (isset($parms['bus_web_address']) && isset($parms['eshop_name']) && isset($parms['bus_scope'])) {
				$base['url'] = $parms['bus_web_address'];
				$base['site_name'] = $parms['eshop_name'];
				$base['bus_scope'] = $parms['bus_scope'];
				// print_r($base);exit;
			}

			//电商企业代理申报单位多选
			if(isset($parms['agent']) && !empty($parms['agent'])){
				$agent_arr = explode('-', $parms['agent'][0]);
				$parms['agent_code'] = $agent_arr[0];
				$parms['agent_name'] = $agent_arr[1];
			}
			$base = array(
				//'cus_dec_ent_num' => empty($parms['cus_dec_ent_num']) ? '' : $parms['cus_dec_ent_num'],
				'ins_unit_name' => isset($ciqLocalOrg[$parms['ciqOrgTypeCode']]) ? $ciqLocalOrg[$parms['ciqOrgTypeCode']] : '', // empty($parms['ins_unit_name']) ? '' : $parms['ins_unit_name'],
				'ins_unit_code' => isset($ciqLocalOrg[$parms['ciqOrgTypeCode']]) ? $parms['ciqOrgTypeCode'] : '', // empty($parms['ins_unit_code']) ? '' : $parms['ins_unit_code'],
				'url' => empty($parms['bus_web_address']) ? '' : $parms['bus_web_address'],
				'site_name' => empty($parms['eshop_name']) ? '' : $parms['eshop_name'],
				'bus_scope' => empty($parms['bus_scope']) ? '' : $parms['bus_scope'],
				'bus_lc_sign_unit' => empty($parms['bus_lc_sign_unit']) ? '' : $parms['bus_lc_sign_unit'],
				'contact_man_email' => empty($parms['contact_man_email']) ? '' : $parms['contact_man_email'],
				'is_business_in' => empty($parms['is_business_in']) ? '' : $parms['is_business_in'],
				'is_business_export' => empty($parms['is_business_export']) ? '' : $parms['is_business_export'],
				'is_normal_in' => empty($parms['is_normal_in']) ? '' : $parms['is_normal_in'],
				'is_normal_export' => empty($parms['is_normal_export']) ? '' : $parms['is_normal_export'],
				'trade_name_en' => empty($parms['trade_name_en']) ? '' : $parms['trade_name_en'],
				'credit_code' => empty($parms['credit_code']) ? '' : $parms['credit_code'],
				'corporate' => empty($parms['corporate']) ? '' : $parms['corporate'],
				'corporate_num' => empty($parms['corporate_num']) ? '' : $parms['corporate_num'],
				'corporate_phone' => empty($parms['corporate_phone']) ? '' : $parms['corporate_phone'],
				'validity_date' => empty($parms['yz_date']) ? '' : $parms['yz_date'],
				'pay_bus_lic' => empty($parms['pay_bus_lic']) ? '' : $parms['pay_bus_lic'],
				'exp_bus_lic' => empty($parms['exp_bus_lic']) ? '' : $parms['exp_bus_lic'],
				'warehouse_area' => empty($parms['warehouse_area']) ? '' : $parms['warehouse_area'],
				'reg_sit_cer_no' => empty($parms['reg_sit_cer_no']) ? '' : $parms['reg_sit_cer_no'],
				// 'business_type'             => $businessType,
				'customer_note' => empty($parms['note_s']) ? '' : $parms['note_s'],
				'customs_code' => empty($parms['customs_code']) ? '' : $parms['customs_code'],
				'agent_name' => empty($parms['agent_name']) ? '' : $parms['agent_name'],
				'agent_code' => empty($parms['agent_code']) ? '' : $parms['agent_code'],
				'ie_type' => empty($parms['ie_type']) ? '' : $parms['ie_type'],
				'customer_c_i_c' => empty($parms['cn_icp_code']) ? '' : $parms['cn_icp_code'],
				'is_ecommerce' => empty($parms['is_ecommerce']) ? '' : $parms['is_ecommerce'],
				'is_shipping' => empty($parms['is_shipping']) ? '' : $parms['is_shipping'],
				'is_pay' => empty($parms['is_pay']) ? '' : $parms['is_pay'],
				'is_storage' => empty($parms['is_storage']) ? '' : $parms['is_storage'],
				'is_supervision' => empty($parms['is_supervision']) ? '' : $parms['is_supervision'],
				'is_platform' => empty($parms['is_platform']) ? '' : $parms['is_platform'],
				'is_baoguan' => empty($parms['is_baoguan']) ? '' : $parms['is_baoguan'],
				'trade_name' => $parms['trade_name'],
				'trade_co' => empty($parms['trade_co']) ? '' : $parms['trade_co'],
				'customer_firstname' => empty($parms['firstname']) ? '' : $parms['firstname'],
				'customer_lastname' => empty($parms['lastname']) ? '' : $parms['lastname'],
				'customer_telephone' => empty($parms['telphone']) ? '' : $parms['telphone'],
				'customer_fax' => empty($parms['fax']) ? '' : $parms['fax'],
				'reg_step' => 3,
				'customer_province' => empty($parms['province']) ? '' : $parms['province'],
				'customer_postno' => empty($parms['postcode']) ? '' : $parms['postcode'],
				'customer_address' => empty($parms['address']) ? '' : $parms['address'],
				'customer_signature' => empty($parms['signature']) ? '' : $parms['signature'],
				'customer_id' => $id,
				'customer_code' => $code,
				'cab_firstname' => empty($parms['firstname']) ? '' : $parms['firstname'],
				'cab_lastname' => empty($parms['lastname']) ? '' : $parms['lastname'],
				'cab_state' => empty($parms['state']) ? '' : $parms['state'],
				'cab_city' => empty($parms['city']) ? '' : $parms['city'],
				'cab_postcode' => empty($parms['postcode']) ? '' : $parms['postcode'],
				'cab_street_address1' => empty($parms['address']) ? '' : $parms['address'],
				'bus_lic_reg_num' => empty($parms['bus_lic_reg_num']) ? '' : $parms['bus_lic_reg_num'],
				'bus_name' => empty($parms['bus_name']) ? '' : $parms['bus_name'],
				'shop_name' => empty($parms['shop_name']) ? '' : $parms['shop_name'],
				'web_address' => empty($parms['web_address']) ? '' : $parms['web_address'],
				'customs_reg_num' => empty($parms['customs_reg_num']) ? '' : $parms['customs_reg_num'],
				'bus_web_address' => empty($parms['bus_web_address']) ? '' : $parms['bus_web_address'][0],
				'eshop_name' => empty($parms['eshop_name']) ? '' : $parms['eshop_name'][0],
				'bus_sco' => empty($parms['bus_sco']) ? '' : $parms['bus_sco'],
				// 'bus_scope' => empty($parms['bus_scope']) ? '' : $parms['bus_scope'],
				'ciq_num' => empty($parms['ciq_num']) ? '' : $parms['ciq_num'],
				'agent' => empty($parms['agent']) ? '' : $parms['agent'],
			);
			$imgs = array(
				'attashed1' => !isset($parms['attashed1']) ? '' : $parms['attashed1'],
				'attashedName1' => !isset($parms['attashedName1']) ? '' : $parms['attashedName1'],
				'attashedType1' => !isset($parms['attashedType1']) ? '' : $parms['attashedType1'],

				'attashed2' => !isset($parms['attashed2']) ? '' : $parms['attashed2'],
				'attashedName2' => !isset($parms['attashedName2']) ? '' : $parms['attashedName2'],
				'attashedType2' => !isset($parms['attashedType2']) ? '' : $parms['attashedType2'],

				'attashed3' => !isset($parms['attashed3']) ? '' : $parms['attashed3'],
				'attashedName3' => !isset($parms['attashedName3']) ? '' : $parms['attashedName3'],
				'attashedType3' => !isset($parms['attashedType3']) ? '' : $parms['attashedType3'],

				'attashed4' => !isset($parms['attashed4']) ? '' : $parms['attashed4'],
				'attashedName4' => !isset($parms['attashedName4']) ? '' : $parms['attashedName4'],
				'attashedType4' => !isset($parms['attashedType4']) ? '' : $parms['attashedType4'],

			);
			//print_r($base);exit;
			$process = new Service_CustomerProcess();
			$result = $process->completeTransaction($base, $imgs);
			if ($result['ask'] == '1') {
				$session->data = array(
					'id' => $id,
					'code' => $code,
					'email' => $email,
					'current' => 4,
				);
				//$this->_redirect('/register/step?current=4');
			}
			echo json_encode($result);
			exit;
		}
		$this->_redirect('/register');
	}

	// --------------------------------------------------------------------
	/**
	 * 验证码
	 *
	 */
	public function verifyCodeAction() {
		$verify = new Common_Verifycode();
		$verify->set_img_size(85, 20);
		echo $verify->render();
	}

	// --------------------------------------------------------------------
	/**
	 * 上传文件base64转码
	 */
	public function uplodeimgAction() {
		// $data = 'data:image/jpg;base64,'.base64_encode(file_get_contents($_FILES["file"]["tmp_name"]));
		// print_r($_FILES["file"]['name']);
		$type = explode('.', $_FILES["file"]['name']);
		$extend = end($type);
		$data = base64_encode(file_get_contents($_FILES["file"]["tmp_name"]));
		//获取文件名方式修改
		/*
		$num = Common_Common::random(mt_rand(1,9),'058');
		$name = substr(md5($num), mt_rand(1,9),mt_rand(1,9));
		*/
		$fileName = date('YmdHis').uniqid().'.'.$extend;
		$return = array(
			'jsonrpc' => '2.0',
			'result' => '',
			'atname' => $fileName,
			'type' => $extend,
			'id' => $data
		);
		die(Zend_Json::encode($return));
		//die('{"jsonrpc" : "2.0", "result" : null, "atname" : "' . $name . '", "type" : "' . $type[1] . '", "id" : "' . $data . '"}');
	}
}
/* End of file RegisterController.php */
/* Location: /application/modules/default/controllers/RegisterController.php */
