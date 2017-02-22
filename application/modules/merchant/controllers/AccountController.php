<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 下午3:53
 * To change this template use File | Settings | File Templates.
 */
class Merchant_AccountController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/account/";
        // $this->tplDirectory = "merchant/account_config/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    /**
     * [listAction 账号列表]
     * @return [type] [description]
     */
    public function listAction()
    {
        $authStatus = self::getAuthStatus('auto');
        $page       = $this->getRequest()->getParam('page', 1);
        $pageSize   = $this->getRequest()->getParam('pageSize', 20);
        $condition  = array(
            'customer_code' => $this->_customerAuth['code'],
            'account_name'  => trim($this->getRequest()->getParam('account_name')),
            'account_email' => $this->getRequest()->getParam('account_email'),
            // 'account_level'      =>'1'
        );
        $this->view->count      = Service_Account::getByCondition($condition, 'count(*)');
        $this->view->result     = Service_Account::getByCondition($condition, '*', 'account_id DESC', $pageSize, $page);
        $this->view->pageSize   = $pageSize;
        $this->view->page       = $page;
        $this->view->condition  = $condition;
        $this->view->authStatus = $authStatus;
        $this->view->privilege  = Service_AccountPrivilege::getAssignedPrivilege(); // 可分配给子账号的权限
        echo Ec::renderTpl($this->tplDirectory . 'account_list.tpl', 'noleftlayout');
    }

    /**
     * [addAction 增加子账户]
     */
    public function addAction()
    {
        if ($this->_request->isPost()) {
            $result            = array();
            $account_name      = $this->_request->getParam("account_name", "");
            $account_email     = $this->_request->getParam("account_email", "");
            $account_password  = $this->_request->getParam("account_password", "");
            $confirm_password  = $this->_request->getParam("confirm_password", "");
            $account_phone     = $this->_request->getParam("telphone", "");
            $account_real_name = $this->_request->getParam('account_real_name', '');
            $account_id_code   = $this->_request->getParam('account_id_code', '');
            $sessionData       = $this->customerAuth->data;
            $error             = array();
            if ($sessionData['account_level'] == '1') {
                //子账号不能添加子账号
                $error[] = '只有主账号才能添加子账号';
            }
            if (empty($account_name)) {
                $error[] = Ec_Lang::getInstance()->getTranslate('username_require');
            }
            if (empty($account_phone)) {
                $error[] = Ec_Lang::getInstance()->getTranslate('email_require');
            }
            if (!preg_match("/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/", $account_email)) {
                $error[] = Ec_Lang::getInstance()->getTranslate('The_mailbox_is_not_in_the_correct_format');
            }
            if (!preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i', $account_id_code)) {
                $error[] = Ec_Lang::getInstance()->getTranslate('identity_card_number_format_error');
            }
            if (!preg_match('/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/', $account_phone)) {
                $error[] = '电话格式错误';
            }
            if (strlen($account_password) < 6) {
                $error[] = Ec_Lang::getInstance()->getTranslate('change_password_tip');
            }
            $existAcount = Service_Account::getByField($account_email, "account_email", "*");
            $customerRow = Service_Customer::getByField($account_email, 'customer_email', "*");
            if (!empty($existAcount) || !empty($customerRow)) {
                $error[] = Ec_Lang::getInstance()->getTranslate('Mailbox_already_exists');
            }
            //验证重复
            /*
            $isExists = Service_Account::getByField($account_id_code, 'account_id_code', array('account_real_name'));
            if (!empty($isExists)) {
                $error[] = '身份证[' . $account_id_code . '][' . $isExists['account_real_name'] . ']已存在';
            }
            */
            if (!empty($error)) {
                $result['ask']   = '0';
                $result['error'] = $error;
                die(json_encode($result));
            }
            $mark        = new Common_Customer();
            $accountCode = $mark->markCustomCode('register');
            $account     = array(
                'customer_code'       => $sessionData['code'],
                'account_code'        => $accountCode,
                'account_email'       => $account_email,
                'account_password'    => md5($account_password),
                'account_name'        => $account_name,
                'account_phone'       => $account_phone,
                'add_time'            => date("Y-m-d H:i:s"),
                'account_update_time' => date("Y-m-d H:i:s"),
                'account_status'      => 0,
                'account_level'       => '1',
                'account_real_name'   => $account_real_name,
                'account_id_code'     => $account_id_code,
            );

            $idResult = Service_IdNumberCheck::getByCondition(array(
                'IdType'   => 1,
                'idNumber' => $account['account_id_code'],
                'id_name'  => $account['account_real_name'],
            ), array('status'));
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try {
                if (!empty($idResult)) {
                    //已验证
                    if ($idResult[0]['status'] == 2) {
                        $account['account_auth_status'] = 2;
                    } elseif ($idResult[0]['status'] == 3 || $idResult[0]['status'] == 4) {
                        $account['account_auth_status'] = 3;
                    }
                } else {
                    $idNumberRow = array(
                        'id_name'  => $account['account_real_name'],
                        'idNumber' => $account['account_id_code'],
                    );
                    if (Service_IdNumberCheck::add($idNumberRow) === false) {
                        throw new Exception('身份验证信息添加异常', 500);
                    }
                }
                //默认通过
                $account['account_auth_status'] = 2;
                if (Service_Account::add($account) === false) {
                    throw new Exception('子账号添加失败', 500);
                }
                $db->commit();
                $result['ask']     = 1;
                $result['message'] = Ec_Lang::getInstance()->getTranslate('account') . ':' . $account_email . Ec_Lang::getInstance()->getTranslate('Create_successfully');
            } catch (Exception $e) {
                $db->rollback();
                $result = array('ask' => 0, 'message' => $e->getMessage(), 'errorCode' => $e->getCode());
            }
            die(json_encode($result));
        } else {
            echo Ec::renderTpl($this->tplDirectory . 'account_add.tpl', 'noleftlayout');
        }
    }

    /**
     * [forbiddenAction 启用或者禁用账户]
     * @return [type] [description]
     */
    public function forbiddenAction()
    {
        $account_id = $this->_request->getParam("account_id", "");
        $type       = $this->_request->getParam("type", "");
        $account    = Service_Account::getByField($account_id, 'account_id', "*");
        $return     = array(
            'ask'     => '0',
            'message' => '',
        );
        //未认证
        if (isset($account['account_auth_status']) && $account['account_auth_status'] != 2) {
            $return = array(
                'ask'     => 1,
                'message' => Ec_Lang::getInstance()->getTranslate('account') . ':' . $account['account_name'] . Ec_Lang::getInstance()->getTranslate('account_not_auth'),
            );
        } else {
            if ($type == "use") {
                $row = array(
                    'account_status'      => '1',
                    'account_update_time' => date("Y-m-d H:i:s"),
                );
                if (Service_Account::update($row, $account_id, 'account_id')) {
                    $return = array(
                        'ask'     => '1',
                        'message' => Ec_Lang::getInstance()->getTranslate('account') . ':' . $account['account_name'] . Ec_Lang::getInstance()->getTranslate('enable_account_successfully'),
                    );
                }
            } else {
                $row = array(
                    'account_status'      => '0',
                    'account_update_time' => date("Y-m-d H:i:s"),
                );
                if (Service_Account::update($row, $account_id, 'account_id')) {
                    $return = array(
                        'ask'     => '1',
                        'message' => Ec_Lang::getInstance()->getTranslate('account') . ':' . $account['account_name'] . Ec_Lang::getInstance()->getTranslate('disable_account_successfully'),
                    );
                }
            }
        }
        die(json_encode($return));
    }

    /**
     * 分配权限 -- 暂时取消
     */
    public function assignPrivilegeAction()
    {
        $response = array('status' => 0, 'message' => '非法请求');
        if ($this->getRequest()->isPost()) {
            $privilege = $this->getRequest()->getPost('privilege', array());
            $account   = (int) $this->getRequest()->getPost('account', 0);

            if (is_array($privilege) && !empty($privilege) && $account) {
                $result = Service_AccountPrivilege::setAccountPrivilege($privilege, $account, $this->_customerAuth['code']);

                if (true === $result) {
                    $response['status']  = 1;
                    $response['message'] = '权限分配成功';
                } else {
                    $response['message'] = $result;
                }
            } elseif ($account) {
                $response['message'] = '至少需要分配一项权限';
            } else {
                $response['message'] = '传递信息有误';
            }
        }
        exit(Zend_Json::encode($response));
    }

    /**
     * 获取子账号已分配的权限
     */
    public function getAssignedPrivilegeAction()
    {
        $response = array('status' => 0, 'message' => '非法请求', 'data' => array());
        if ($this->getRequest()->isPost()) {
            $account     = (int) $this->getRequest()->getPost('account', 0);
            $accountData = Service_Account::getByField($account, 'account_id', array('account_auth_status'));
            if (isset($accountData['account_auth_status']) && $accountData['account_auth_status'] != 2) {
                $response['message'] = Ec_Lang::getInstance()->getTranslate('account') . ':' . $account['account_name'] . Ec_Lang::getInstance()->getTranslate('account_not_auth');
            } else {
                $privilege = Service_AccountPrivilege::getAccountAssignedPrivilege($account);
                if ($privilege) {
                    $response['status']  = 1;
                    $response['message'] = '请求成功';
                    $response['data']    = $privilege;
                } else {
                    $response['message'] = '没有找到相应权限';
                }
            }
        }
        exit(Zend_Json::encode($response));
    }

    /**
     * 发送状态
     * @author simple-yang
     * @param string $lang 语言种类
     * @return multitype:multitype:string
     */
    private static function getAuthStatus($lang = 'zh_CN')
    {
        $tmp = array(
            'zh_CN' => array(
                '1' => '未验证',
                '2' => '验证成功',
                '3' => '验证失败',
            ),
            'en_US' => array(
                '1' => 'Verification state',
                '2' => 'Authentication success',
                '3' => 'Validation failure',
            ),
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
    }
}
