<?php
class Default_ForgetPasswordController extends Ec_Controller_DefaultAction
{
	// --------------------------------------------------------------------
	public function preDispatch()
    {
        $this->tplDirectory	= "default/views/forgetpassword/";
    }

    // --------------------------------------------------------------------
    /**
     * 忘记密码首页
     * @access  public	 
     * @return  resource
     */
    public function indexAction()
    {       
    	echo Ec::renderTpl($this->tplDirectory . "index.tpl", 'layout');
    }
	
	/*重置密码*/	
    public function resetAction()
    {       
		$session= new Zend_Session_Namespace('forgetpassword');
    	 //$session->data	= array('email'=> 'f5escenter@163.com');
		if(!$session->data || !$session->data['email']){
			$this->_redirect('/login');
		}		
		$email = $session->data['email'];
		$UserArray = Service_Account::getByField($email, 'account_email',"*");
		if(!$UserArray || !$UserArray['forget_password_auth_code']){
			$this->_redirect('/login');
		}
		
		if($this->getRequest()->isPost()){
		
			$parms	= $this->getRequest()->getParams();


  			$verify	= new Common_Verifycode();
			$value	= $this->getRequest()->getParam('verify');	
			$state	= $verify->is_true($value);
			
			$info = "";
			$error=0;	
			if(!$state){
				$info='<li class="error">'.'验证码错误'.'</li>';				
				$error++;
			}
			if($parms['password']==''){
				$info.='<li class="error">'.'密码不能为空'.'</li>';				
				$error++;
			}
			if(strlen($parms['password'])<6){
				$info.='<li class="error">'.'密码长度必须6位(含6位)以上'.'</li>';				
				$error++;
			}						
			
			if($parms['password'] && $parms['password']!=$parms['con-password']){
				$info.='<li class="error">'.'两次输入密码不等'.'</li>';				
				$error++;
			}	
					
				
				if($error==0){	
							if(md5($parms['password']) == $UserArray['account_password']){
							//$info='<li class="success">'.'密码更新成功.'.'</li>';
							$this->redirect('/forget-password/success');
							exit;	
							//$error++;			
							}							
							$password = md5($parms['password']);
							$row = array('account_password'=>$password);
							$status=Service_Account::update($row,$UserArray['account_id'],'account_id');
							if($status){
								$row = array('forget_password_auth_code_create_date'=>'','forget_password_auth_code'=>'');	
								$status=Service_Account::update($row,$UserArray['account_id'],'account_id');
								$info='<li class="success">'.'密码更新成功.'.'</li>';	
								$this->redirect('/forget-password/success');
							}else{							
								$info='<li class="error">'.'密码更新失败，由于系统错误.'.$email.'</li>';
							}
				}
				if($info){$this->view->errorinfo=$info;}
						
		}// is post
		
		
    	echo Ec::renderTpl($this->tplDirectory . "reset.tpl", 'layout');
    }	
	
	/*成功更新密码*/
	public function successAction(){
		
		echo Ec::renderTpl($this->tplDirectory . "success.tpl", 'layout');	
	}
	
    // --------------------------------------------------------------------
    /**
     * 忘记密码验证用户名【即邮箱】和验证码的正确性
     * 
     */
    public function confirmUserAction()
    {
    	$verify	= new Common_Verifycode();
		$value	= $this->getRequest()->getParam('verify');
		$email = $username = $this->getRequest()->getParam('username');
		$state	= $verify->is_true($value);		
		$result = array("ask"=>0,"message"=>"",'error'=>array());				
		if(!$email){
			$result['error'][] = "用户名或邮箱不能为空.";
			echo json_encode($result);
			exit;
		}
		
		if($state){	
				$UserArray = Service_Account::getByField($email, 'account_email');
				if(!$UserArray){
					$result['error'][] = "不存在的用户名或邮箱.";
					echo json_encode($result);
					exit;					
				}else{
					$result = array("ask"=>1,"message"=>"用户验证通过");					
					echo json_encode($result);
					exit;				
				}

				
					
		}else{
				$result['authcodeError']=1;
				$result['error'][] = "验证码错误";		
		}//
		echo json_encode($result);
		exit;
    }


   // --------------------------------------------------------------------
    /**
     * 如何邮件收到的验证码后的验证
     * 
     */
    public function confirmauthAction()
    {	
	
		$email	= $this->getRequest()->getParam('email');
		$password_authcode	= $this->getRequest()->getParam('password_authcode');
		$result = array("ask"=>0,"message"=>"",'error'=>array());	
		if(!$email){
					$result['error'][] = "用户名或邮箱不能为空.";
					echo json_encode($result);
					exit;		
		}
		if(!$password_authcode){
					$result['error'][] = "请输入您系统发到你注册邮箱的验证码.";
					echo json_encode($result);
					exit;
		}
		
		
		
		
		$UserArray = Service_Account::getByCondition(array('account_email'=>$email,'forget_password_auth_code'=>$password_authcode));
		
				
				if(!$UserArray){
					$result['error'][] = "不存在的用户名或邮箱.";
					echo json_encode($result);
					exit;					
				}else{
					$result = array("ask"=>1,"message"=>"验证码正确，请不要刷新页面，正在跳转到重置密码页面...");
					$session= new Zend_Session_Namespace('forgetpassword');
    	 			$session->data= array('email'=> $email,'password_authcode'=>$password_authcode);										
					echo json_encode($result);
					exit;				
				}

				
					
		
		
    }
  
   /*生成忘记密码的验证码*/
	public function authAction()
	{
	
		$email = $username = $this->getRequest()->getParam('username');		
		$result = array("ask"=>0,"message"=>"",'error'=>array());				
		if(!$email){
			$result['error'][] = "用户名或邮箱不能为空.";
			echo json_encode($result);
			exit;
		}
        $UserArray = Service_Account::getByField($email,'account_email',"*");
		//$UserArray = Service_Customer::getByField($email, 'customer_email');
		
		if(!$UserArray){
				$result['error'][] = "不存在的用户名或邮箱.";
				echo json_encode($result);
				exit;					
		}			
					
		$id = $UserArray['account_id'];
		$code	= Common_Common::randomkeys(5);
		
		$now = date('Y-m-d H:i:s');
		$state	= Service_Account::update(array('forget_password_auth_code_create_date'=>$now,'forget_password_auth_code'=>$code), $id, 'account_id');
		
		if (!empty($state)) {
			
			$params = array(
					'bodyType' => 'html',
					'email' => array($email),
					'subject' => '【深圳保宏】忘记密码安全验证',
					'body' => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>尊敬的客户，您好！</strong><br/><br/>",
					
			);
			$params['body'].= "您于{$now}提交的账户安全邮箱验证，验证码为：{$code}，请在页面填写。<br/><br/>";
			$params['body'].= "如非本人操作，请忽略此邮件。";
			$state=Common_Email::sendMail($params);
			
		}		
		if (empty($state)) {
		   $result = array("ask"=>0,"message"=>"邮件发送失败");
		} else {
			$row = array(
			'user_id'=>$id,
			'email_title'=>$params['subject'],
			'email_content'=>$params['body'],
			'pub_date'=>$now,
			'email_type'=>'forget_password'
			);
			//print_r($row);
			Service_EmailLog::add($row);
			$result = array("ask"=>1,"message"=>"邮件发送成功，请查收");
		}
		echo json_encode($result);
		exit;
	}

	
	// --------------------------------------------------------------------
	/**
	 * 验证码
	 *
	 */
    public function verifyCodeAction()
    {
    	$verify	= new Common_Verifycode();    	
    	$verify->set_img_size(85,20);
    	echo $verify->render();
    }
}
/* End of file RegisterController.php */
/* Location: /application/modules/default/controllers/RegisterController.php */