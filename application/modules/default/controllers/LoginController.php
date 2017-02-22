<?php
class Default_LoginController extends Ec_Controller_DefaultAction
{
	// --------------------------------------------------------------------
	public function preDispatch()
    {
        $this->tplDirectory	= "default/views/login/";
    }

    // --------------------------------------------------------------------
    /**
     * 登陆首页
     * 
     */
    public function indexAction()
    {
    	$loginInfo	= Service_Login::getLoginInfo();
    	if (empty($loginInfo['id'])) {
		
			$lang=Ec_Lang::getInstance()->getCurrentLanguage();
    		if($lang==''){
    			$lang='zh_CN'; //默认为中文
    		}
    		$this->view->lang = $lang;
            //投诉建议
            $condition = array(
                'ciq_status_arr' => array('0', '1', '2', '3', '4'),
            );
            $feedBacks = Service_Feedback::getByCondition($condition, '*', 5, 1, 'add_time desc');
            if(is_array($feedBacks) && !empty($feedBacks)){
                foreach ($feedBacks as $key => $value) {
                    $feedBacks[$key]['message'] = Common_Common::utf_substr($value['message'], 40);
                    $feedBacks[$key]['message_type'] = $value['message_type'] == 0 ? '咨询' : '投诉';
                    $feedBacks[$key]['ciq_status'] = Service_Feedback::getCiqStatus($value['ciq_status']);
                }
            }
            //公告
            $noticeData = Service_SjNotice::getByCondition(array('sn_decl_status'=>1), '*', 5, 1, 'sn_add_time desc');
            if(!empty($noticeData)){
                foreach ($noticeData as $key => $value) {
                    $noticeData[$key]['sn_title'] = Common_Common::utf_substr($value['sn_title'], 40);
                }
            }
            $this->view->feedBacks = $feedBacks;
            $this->view->noticeData = $noticeData;
    		echo $this->view->render($this->tplDirectory . 'index.tpl');
    	} else {
    		$this->_redirect('/merchant');
    	}
    	
    }

    // --------------------------------------------------------------------
    /**
     * 登陆检测
     * 
     */
	public function checkAction()
	{
		$verify	= new Common_Verifycode();
		$value	= $this->getRequest()->getParam('verify');
		$state	= $verify->is_true($value);
        //关闭验证码
		$state	= true;
        $result = array();
		if ($state) {
            $time	= date('Y-m-d H:i:s');
            $name	= $this->getRequest()->getParam('username');
            $pwd	= $this->getRequest()->getParam('password');
			$name = trim($name);
            $result	= Service_Login::check($name, md5($pwd));
            //die("<script>alert('" . $result . "');window.history.back();</script>");
		} else {
            $result['ask'] = "0";
            $result['errorMsg'] = "验证码错误，请重新填写.";
			//die("<script>alert('验证码错误，请重新填写.');window.history.back();</script>");
		}
        die(json_encode($result));
	}

	// --------------------------------------------------------------------
	/**
	 * 注销登陆
	 *
	 */
	public function outAction()
	{
		Service_Login::outLogin();
	}
	
	// --------------------------------------------------------------------
	/**
	 * 验证码
	 *
	 */
    public function verifyCodeAction()
    {
    	$verify	= new Common_Verifycode();    	
    	$verify->set_img_size(60,23);
    	echo $verify->render();
    }

}
/* End of file LoginController.php */
/* Location: /application/modules/default/controllers/LoginController.php */