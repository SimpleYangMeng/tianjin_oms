<?php
class Service_Customer
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Customer|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Customer();
        }
        return self::$_modelClass;
    }

    /**
     * @param $row
     * @return mixed
     */
    public static function add($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }

	/**
     * 取得客户登录信息
     *
     * @return Zend_Session_Namespace
     */
    public static function getLoginInfo ()
    {
        $sessionUser = new Zend_Session_Namespace("customerAuth");
        return $sessionUser;
    }
	/**
     * 设置客户登录信息
     *
     * @param boolean $isLogin
     * @param array $infos
     * @return void
     */
    public static function setLoginInfo ($isLogin, $customer = null)
    {
        $sessionUser = new Zend_Session_Namespace("customerAuth");
        $sessionUser->isLogin = $isLogin;
        if ($isLogin) {
            /*
             * customer对应数据表customer的数据
            */
            Merchant_Service_Customer::update(array('customer_last_login'=>date('Y-m-d H:i:s')), $customer['customer_id'],'customer_id');
            $sessionUser->customer = $customer;
            $sessionUser->lang = "1"; // 临时处理
        } else {
            if (isset($sessionUser->customer)){
                unset($sessionUser->customer);
            }
        }
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
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "customer_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "customer_id")
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }
    /**
     * 共享锁记录
     * @author solar
     * @param int $customer_id
     * @return array
     */
    public static function getLockInShareMode($customer_id) {
        $model = self::getModelInstance();
        return $model->getLockInShareMode($customer_id);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'customer_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        $model = self::getModelInstance();
        return $model->getAll();
    }

    /**
     * 获取自定义SQL语句查询结果
     *
     * @access	public
     * @param   string	($field		待返回的字段，默认为所有)
     * @param   string	($condition	查询条件)
     * @param	mixed	($value		待转换查询字段值)
     * @return	mixed
     */
    public static function getCustomQuery($field = '*', $condition = '', $value = '')
    {
    	$model = self::getModelInstance();
    	return $model->getCustomQuery($field, $condition, $value);
    }

    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $type, $pageSize, $page, $order);
    }

    public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = new Table_Customer();
        return $model->getByStatus($status, $pageSize , $minId);
    }
	/**
	 * 商检状态
	 * Enter description here ...
	 * @param unknown_type $status
	 * @param unknown_type $pageSize
	 * @param unknown_type $minId
	 */
	public static function getByCiqStatus($status, $pageSize = 0 , $minId = 0){
        $model = new Table_Customer();
        return $model->getByCiqStatus($status, $pageSize , $minId);
    }
    /**
     * @param $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();

        $validateArr[] = array("name" =>EC::Lang('email'), "value" =>$val["customer_email"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('status'), "value" =>$val["customer_status"], "regex" => array("positive"));
        $validateArr[] = array("name" =>EC::Lang('salesRep'), "value" =>$val["customer_saler_user_id"], "regex" => array("positive"));
        $validateArr[] = array("name" =>EC::Lang('customerServiceRep'), "value" =>$val["customer_cser_user_id"], "regex" => array("positive"));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(

              'E0'=>'customer_id',
              'E1'=>'customer_code',
              'E2'=>'customer_password',
              'E3'=>'customer_firstname',
              'E4'=>'customer_lastname',
              'E5'=>'customer_email',
              'E6'=>'customer_currency',
              'E7'=>'customer_activate_code',
              'E8'=>'customer_telephone',
              'E9'=>'customer_fax',
              'E10'=>'customer_status',
              'E11'=>'customer_company_name',
              'E12'=>'customer_logo',
              'E13'=>'customer_saler_user_id',
              'E14'=>'customer_cser_user_id',
              'E15'=>'customer_verify_code',
              'E16'=>'customer_signature',
              'E17'=>'reg_step',
              'E18'=>'customer_reg_time',
              'E19'=>'customer_update_time',
              'E20'=>'password_update_time',
              'E21'=>'last_login_time',
              'E22'=>'customer_type',
              'E23'=>'bus_name',
              'E24'=>'bus_sco',
              'E25'=>'bus_lic_reg_num',
              'E26'=>'web_name',
              'E27'=>'web_address',
              'E28'=>'eshop_name',
        );
        return $row;
    }
    /**
     * 获取业务类型
     *
     * @param string $customer    对应的数组 $customer['is_business_in']...
     * @return array('BI'=>'一般进口')
     */
    public static function businessType($param) {
    	$data = array(
    			'is_business_in'=>$param['is_business_in'],
    			'is_business_export'=>$param['is_business_export'],
    			'is_normal_in'=>$param['is_normal_in'],
    			'is_normal_export'=>$param['is_normal_export']
    	);
    	// print_r($data);exit;
    	foreach ($data as $k => $v) {
    		if($v == 1){
    			if($k == 'is_business_in'){
    				$result['BI'] = '保税进口';
    			}
    			if($k == 'is_business_export'){
    				$result['BE'] = '保税出口';
    			}
    			if($k == 'is_normal_in'){
    				$result['NI'] = '一般进口';
    			}
    			if($k == 'is_normal_export'){
    				$result['NE'] = '一般出口';
    			}
    		}
    	}
    	return $result;
    }
    /**
     * [getByFieldLock 锁表]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByFieldLock($value, $field = 'customer_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByFieldLock($value, $field, $colums);
    }
}
