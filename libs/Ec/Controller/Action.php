<?php

class Ec_Controller_Action extends Zend_Controller_Action
{
    //用户信息
    protected $_customerAuth;
    //左侧菜单信息
    protected $_leftMenu;
    public function init()
    {
    	//$sessionId			= $this->getRequest()->getParam('session');
		//if (!empty($sessionId)) {
		//	Zend_Session::setId($sessionId);
		//}
    	$phpSessId = $this->getRequest()->getParam('PHPSESSID');
    	if (!empty($phpSessId)) {
    		Zend_Session::setId($phpSessId);
    	}
    	Service_Login::isLogin();
    	$this->view = Zend_Registry::get('EcView');
        //保存登陆信息
        $this->_customerAuth = Service_Login::getLoginInfo();
        //获取左侧菜单
        $this->_leftMenu = $this->getLeftMenusArr();
        //验证权限
        $this->checkPriv();
    }

    /**
     * -- simple
     * [getLeftMenusArr 左侧菜单]
     * @return [type] [description]
     */
    protected function getLeftMenusArr(){
        $account = $this->_customerAuth;
        //主账号
        $isMaster = (0 === (int) $account['account_level']) ? TRUE : FALSE;
        if ($isMaster) {
            $menus = Service_AccountPrivilege::getDefaultPrivilege(TRUE, $account['customer_priv']);
        }else {
            $menus = Service_AccountPrivilege::getAccountPrivilege($account['account_id'], $account['customer_priv']);
        }
        return $menus;
    }

    /**
     * -- simple
     * [checkPriv 权限控制
     * @return [type] [description]
     */
    protected function checkPriv(){
        // $this->redirect('/default/error/deny');
        $param = $this->_request->getParams();
        $module = (key_exists('module', $param) && !empty($param['module'])) ? trim(strtolower($param['module'])) : '';
        $controller = (key_exists('controller', $param) && !empty($param['controller'])) ? trim(strtolower($param['controller'])) : '';
        $action = (key_exists('action', $param) && !empty($param['action'])) ? trim(strtolower($param['action'])) : '';
        unset($param['module'], $param['controller'], $param['action']);
        //首页数据不验证，空控制器跳出
        if((empty($module) && empty($controller) && empty($action)) || (!empty($module) && $module == 'merchant' && !empty($controller) && $controller == 'index')){
            return true;
        //以 public 打头的方法跳过验证 --- 用于页面方法，在权限表没有对应记录的方法;
        }else if(preg_match('/^public/', $action)){
            return true;
        } else {
            $realLink = '/'.$module.'/'.$controller.'/'.$action;
            $linkRes = Service_AccountPrivilege::getByField($realLink, 'privilege_link', array('privilege_id'));
            if(!empty($linkRes) && $linkRes){
                $menus = $this->_leftMenu;
                if(!empty($menus) && is_array($menus)){
                    $linkArr = array();
                    foreach ($menus as $key => $menu) {
                        if(!empty($menu['items']) && is_array($menu['items'])){
                            foreach ($menu['items'] as $link) {
                                $linkArr[] = $link['link'];
                            }
                        }
                    }
                }
                // 没有权限跳转
                if(!in_array($realLink, $linkArr)){
                    $this->redirect('/default/error/deny');
                }
            }
        }
    }

    //当不存在的方法时调用
    public function __call($methodName, $args)
    {
        $this->_forward('error', 'error', 'default');
    }
}
