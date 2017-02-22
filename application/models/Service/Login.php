<?php
class Service_Login
{

    public static $_modelClass = null;

    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Customer();
        }
        return self::$_modelClass;
    }

    public static function add($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }

    public static function update($row, $value, $field = "country_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    public static function delete($value, $field = "country_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    public static function getAll()
    {
        $model = self::getModelInstance();
        return $model->getAll();
    }

    /**
     * 获取自定义SQL语句查询结果
     *
     * @access  public
     * @param   string  ($field     待返回的字段，默认为所有)
     * @param   string  ($condition 查询条件)
     * @param   mixed   ($value     待转换查询字段值)
     * @return  mixed
     */
    public static function getCustomQuery($field = '*', $condition = '', $value = '')
    {
        $model = self::getModelInstance();
        return $model->getCustomQuery($field, $condition, $value);
    }

    /**
     * [getByWhere 多条件获取]
     * @param  [type] $where  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByWhere($where, $colums = "*")
    {
        if(empty($where) || !is_array($where)){
            return false;
        }
        $model = self::getModelInstance();
        return $model->getByWhere($where, $colums);
    }

    /**
     * 检查登陆信息
     *
     * @param   string      ($username  登陆账号)
     * @param   string      ($password  账号密码)
     * @return  mixed
     */
    public static function check($account, $password)
    {
        //$msg  = '';
        //$info   = self::getCustomQuery('*', "where customer_email='$account' and customer_password='$password'");
        $accountInfo = Service_Account::getByCondition(array('account_email' => $account, 'account_password' => $password), "*", 1, 1);
        $return = array();
        if (empty($accountInfo)) {
            //$info = self::getCustomQuery('*', "where customer_email='$account' and customer_password='$password'");
            $where = array(
                'customer_email' => $account,
                'customer_password' => $password
            );
            $info = self::getByWhere($where);
            if ($info) {
                //未完成注册
                if ($info['customer_status'] == 0) {
                    $session           = new Zend_Session_Namespace('register');
                    $session->data     = array(
                        'id'      => $info['customer_id'],
                        'code'    => $info['customer_code'],
                        'email'   => $info['customer_email'],
                        'current' => 3,
                    );

                    if($info['cash_type'] == 0){
                        $return['ask'] = '3';
                        $return['errorMsg'] = "邮件未激活，请到邮箱激活注册。<a style='color:#0088CC;' href='/register/resend'>点击重新发送</a>";
                    }else {
                        $return['ask'] = "-1";
                        //$return['errorMsg'] = '未注册完成';
                        $return['current'] = '3';
                    }
                }
            } else {
                $return['ask']      = "0";
                $return['errorMsg'] = '账户或密码错误';
            }
            return $return;
        } else {
            $accountRow = $accountInfo[0];
            $info       = Service_Customer::getByField($accountRow['customer_code'], 'customer_code', "*");
            //未完成注册
            if ($info['customer_status'] == 0) {
                $session           = new Zend_Session_Namespace('register');
                $session->data     = array(
                    'id'      => $info['customer_id'],
                    'code'    => $info['customer_code'],
                    'email'   => $info['customer_email'],
                    'current' => 3,
                );

                if($info['cash_type'] == 0){
                    $return['ask'] = '3';
                    $return['errorMsg'] = "邮件未激活，请到邮箱激活注册。<a style='color:#0088CC;' href='/register/resend'>点击重新发送</a>";
                }else {
                    $return['ask'] = "-1";
                    //$return['errorMsg'] = '未注册完成';
                    $return['current'] = '3';
                }
               
                return $return;
            }

            //主账号
            if ($accountRow['account_level'] == "0") {
                //未完成注册
                if ($info['reg_step'] < 3) {
                    if($info['cash_type'] == 0){
                        $current = $info['reg_step'];
                        $return['ask'] = '3';
                        $return['errorMsg'] = "邮件未激活，请到邮箱激活注册。<a style='color:#0088CC;' href='/register/resend'>点击重新发送</a>";
                    }else {
                        $current       = $info['reg_step'] + 1;
                        $return['ask']      = "-1";
                        $retutn['errorMsg'] = "";
                        $return['current']  = $current;
                    }
                    $session       = new Zend_Session_Namespace('register');
                    $session->data = array(
                        'id'      => $info['customer_id'],
                        'code'    => $info['customer_code'],
                        'email'   => $info['customer_email'],
                        'current' => $current,
                    );
                    return $return;
                    /*die("<script>window.location.href='/register/step?current=$current';</script>");*/
                }
                if ($info['customer_status'] == 1) {
                    $return['ask']           = "2";
                    $return['customer_code'] = $info['customer_code'];
                    if($info['ciq_status'] != 3){
                        $return['errorMsg'] = '检验检疫';
                    }
                    if($info['customs_status'] != 4){
                        $return['errorMsg'] .= '海关';
                    }
                    $return['errorMsg'] .= '暂未通过审核';
                    return $return;
                }
                if ($info['customer_status'] == 3) {
                    $return['ask']      = "0";
                    $return['errorMsg'] = '账户已停用';
                    return $return;
                }
                /*
                if ($info['customer_status'] == 4) {
                    $return['ask']           = "2";
                    $return['customer_code'] = $info['customer_code'];
                    $return['errorMsg'] = '暂未通过审核';
                    if($info['ciq_status'] != 3){
                        $return['errorMsg'] = '商检暂未通过审核';
                    }
                    if($info['customs_status'] != 4){
                        $return['errorMsg'] = '海关暂未通过审核';
                    }
                    return $return;
                }
                */
                //self::setLoginInfo($info);

                // 0:未完成注册;1:待审核;2:已审核;3:停用;4:暂未通过审核;
                // 0:未完成注册;1:待发送海关;2:海关已审核;3:停用;4:暂未通过审核5:已发送海关;6:海关已接收;
            } else {
                if ($accountRow['account_status'] == "0") {
                    $return['ask']      = "0";
                    $return['errorMsg'] = '您的账户被禁用';
                    return $return;
                }
                if ($info['customer_status'] == 1) {
                    $return['ask']           = "2";
                    $return['customer_code'] = $info['customer_code'];
                    if($info['ciq_status'] != 3){
                        $return['errorMsg'] = '检验检疫';
                    }
                    if($info['customs_status'] != 4){
                        $return['errorMsg'] .= '海关';
                    }
                    $return['errorMsg'] .= '暂未通过审核';
                    return $return;
                }
                if ($info['customer_status'] == 3) {
                    $return['ask']      = "0";
                    $return['errorMsg'] = '主账户已停用';
                    return $return;
                }
                /*
                if ($info['customer_status'] != 2) {
                    $return['ask']           = "2";
                    $return['customer_code'] = $info['customer_code'];
                    $return['errorMsg']      = '主账户状态不是已审核';
                    if($info['ciq_status'] != 3){
                        $return['errorMsg'] = '主账户商检暂未通过审核';
                    }
                    if($info['customs_status'] != 4){
                        $return['errorMsg'] = '主账户海关暂未通过审核';
                    }
                    return $return;
                }
                */
            }
            $session       = new Zend_Session_Namespace('customerAuth');
            $session->data = array(
                'id'                => $info['customer_id'],
                'code'              => $info['customer_code'],
                'firstname'         => $info['customer_firstname'],
                'lastname'          => $info['customer_lastname'],
                'email'             => $info['customer_email'],
                'status'            => $info['customer_status'],
                'company'           => $info['trade_name'],
                'lasttime'          => $info['last_login_time'],
                'ieType'            => $info['ie_type'],
                'customs_code'      => $info['customs_code'],
                'customer_currency' => $info['customer_currency'],
                'account_code'      => $accountRow['account_code'],
                'account_email'     => $accountRow['account_email'],
                'account_name'      => $accountRow['account_name'],
                'account_id'        => $accountRow['account_id'],
                'account_level'     => $accountRow['account_level'],
                'customs_reg_num'   => $info['customs_reg_num'],
                //  'customer_type'=>$info['customer_type']
                /*
            'customer_priv' => array(
            'is_ecommerce' => $info['is_ecommerce'],
            'is_shipping' => $info['is_shipping'],
            'is_pay' => $info['is_pay'],
            'is_storage' => $info['is_storage']
            )
             */
            );

            $customer_priv = array();
            if ($info['is_ecommerce']) {
                $customer_priv['is_ecommerce'] = $info['is_ecommerce'];
            }
            if ($info['is_shipping']) {
                $customer_priv['is_shipping'] = $info['is_shipping'];
            }
            if ($info['is_pay']) {
                $customer_priv['is_pay'] = $info['is_pay'];
            }
            if ($info['is_storage']) {
                $customer_priv['is_storage'] = $info['is_storage'];
            }
            if ($info['is_supervision']) {
                $customer_priv['is_supervision'] = $info['is_supervision'];
            }
            if ($info['is_platform']) {
                $customer_priv['is_platform'] = $info['is_platform'];
            }
            if ($info['is_baoguan']) {
                $customer_priv['is_baoguan'] = $info['is_baoguan'];
            }
            $session->data['customer_priv'] = $customer_priv;

            self::updateLoginInfo($info['customer_id']);
            $return['ask']      = "1";
            $return['errorMsg'] = "";

            /*die("<script>window.location.href='/merchant';</script>");*/
        }
        //新增权限 customer_code 数组
        if (key_exists('code', $session->data) && !empty($session->data['code'])) {
            $session->data['priv_customer_code_arr'] = Common_Customer::getBindCustomer($session->data['code']);
        } else {
            $session->data['priv_customer_code_arr'] = array();
        }
        return $return;
    }

    /**
     * 保存登陆信息
     * @param   array       ($result    账户信息)
     * @param   int         ($keep      存储时间)
     * @return  void
     */
    public static function setLoginInfo($result, $keep = false)
    {
        $session       = new Zend_Session_Namespace('customerAuth');
        $session->data = array(
            'id'                => $result['customer_id'],
            'code'              => $result['customer_code'],
            'firstname'         => $result['customer_firstname'],
            'lastname'          => $result['customer_lastname'],
            'email'             => $result['customer_email'],
            'status'            => $result['customer_status'],
            'company'           => $result['customer_company_name'],
            'lasttime'          => $result['last_login_time'],
            'customer_currency' => $result['customer_currency'],
        );
        if (!empty($keep)) {
            $session->setExpirationSeconds($keep);
        }
    }

    /**
     * 更新登陆信息
     *
     * @param   int         ($id        账户ID)
     * @return  void
     */
    public static function updateLoginInfo($id)
    {
        $data = array(
            'last_login_time' => date('Y-m-d H:i:s'),
        );
        return self::update($data, $id, 'customer_id');
    }

    /**
     * 获取登陆信息
     *
     * @return  array
     */
    public static function getLoginInfo()
    {
        $session = new Zend_Session_Namespace('customerAuth');
        return $session->data;
    }

    /**
     * 登陆状态
     *
     * @return  void
     */
    public static function isLogin()
    {
        $info = self::getLoginInfo();
        if (empty($info['id'])) {
            self::outLogin();
        }
    }

    /**
     * 注销登陆
     *
     * @return   void
     */
    public static function outLogin()
    {
        $session = new Zend_Session_Namespace('customerAuth');
        $session->unsetAll();
        //Zend_Session::destroy();
        die("<script>window.location.href='/login';</script>");
    }

}
