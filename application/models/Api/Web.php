<?php

/**
 * @author luffyzhao
 */
abstract class Api_Web
{
    private $_appKey         = '';
    private $_originalParams = array();

    protected $_customer; //调用者的客户id
    protected $_error   = array();
    protected $_param   = array(); //请求的数据
    protected $_message = '';
    protected $_success = array();

    protected static $service = array(
        'Order',
        'PersonItem',
        'Waybill',
        'Product',
        'PayOrder',
        'Loader',
		'Receiving',
    );

    public static function getMethods()
    {
        return self::$service;
    }

    /**
     * [__construct description]
     * @param array $request 请求的信息
     */
    public function __construct($request)
    {
        if (!is_array($request) || empty($request)) {
            throw new exception('请求的信息不能为空');
        }
        $this->_originalParams = $this->_param = $request;
        if (isset($this->_param['data'])) {
            if (!is_array($this->_param['data'])) {
                $this->_param['data'] = json_decode($this->_param['data'], true);
                if (is_null($this->_param['data'])) {
                    throw new exception('请求的json格式不正确');
                }
            }
        }
    }

    abstract public function run();

    /**
     * 签名
     * @return [type] [description]
     */
    public function sign()
    {
        if (!isset($this->_param['sign'])) {
            throw new exception('sign不能为空！');
        }

        $signString = $this->linkSignParam();

        if ($this->verifySignString($signString)) {
            return true;
        }
        $this->error[] = '签名不正确！';
        return false;
    }

    /**
     * 新的身份认证
     * @return [type] [description]
     */
    public function authenticate()
    {
        $customerCode = isset($this->_param['customerCode']) ? $this->_param['customerCode'] : '';
        $accountCode  = isset($this->_param['accountCode']) ? $this->_param['accountCode'] : '';
        $appToken     = isset($this->_param['appToken']) ? $this->_param['appToken'] : '';
        $method       = isset($this->_param['method']) ? $this->_param['method'] : '';

        if ($customerCode == '') {
            $this->_error[] = '主账号代码不能为空!';
            return false;
        }

        switch ('') {
            case $customerCode:
                $this->_error[] = '主账号代码不能为空!';
            case $accountCode:
                $this->_error[] = '子账号代码不能为空!';
            case $appToken:
                $this->_error[] = 'Token不能为空!';
        }

        if (!empty($this->_error)) {
            return false;
        }

        $customerRow = Service_Customer::getByField($customerCode, 'customer_code');

        if (empty($customerRow)) {
            $this->_error[] = '主账号不存在';
            return false;
        } else {
            if ($customerRow['customer_status'] != 2) {
                $this->_error[] = "主账户不可用.";
                return false;
            }
        }

        $accountRow = Service_Account::getByField($accountCode, 'account_code');
        if (empty($accountRow) || $accountRow['customer_code'] != $customerCode) {
            $this->_error[] = '子账号不存在';
            return false;
        }
        $customerRow['account_code'] = $accountRow['account_code'];
        $this->_customer             = $customerRow;

        $customerAuthRow = Service_CustomerApi::getByField($customerRow['customer_code'], 'customer_code');

        if ($customerAuthRow && $customerAuthRow['ca_token'] == $appToken) {
            //检查权限
            if (($privilege = $this->checkPrivilege($method)) === false) {
                return false;
            }
        }
        $this->_appKey = $customerAuthRow['ca_key'];

        return true;
    }

    /**
     * 身份认证
     * @param  array  $param [description]
     * @return [type]        [description]
     */
    public function oldAuthenticate()
    {
        if (!isset($this->_param['HeaderRequest']) || empty($this->_param['HeaderRequest'])) {
            $this->_error[] = '缺少[HeaderRequest]参数';
            return false;
        }
        $headerRequest = $this->_param['HeaderRequest'];
        $method        = $this->_param['method'];
        $accountRow    = null;

        if (!isset($headerRequest['customerCode'])) {
            $this->_error[] = '缺少[customerCode]参数';
            return false;
        } else {
            if (!is_scalar($headerRequest['customerCode'])) {
                $this->_error[] = '参数[customerCode]数据类型不正确';
                return false;
            } else if ($headerRequest['customerCode'] === '') {
                $this->_error[] = '参数[customerCode]不能为空';
                return false;
            }
        }
        if (!isset($headerRequest['accountCode'])) {
            $this->_error[] = '缺少[accountCode]参数';
            return false;
        } else {
            if (!is_scalar($headerRequest['accountCode'])) {
                $this->_error[] = '参数[accountCode]数据类型不正确';
                return false;
            } else if ($headerRequest['accountCode'] === '') {
                $this->_error[] = '参数[accountCode]不能为空';
                return false;
            }
        }
        //检查主账号
        $customer = Service_Customer::getByField($headerRequest['customerCode'], 'customer_code');
        if ($customer instanceof Zend_Db_Table_Row) {
            $customer = $customer->toArray();
        }
        if (!$customer) {
            $this->_error[] = "[customerCode:{$headerRequest['customerCode']}]不存在！";
            return false;
        } else {
            if ($customer['customer_status'] != 2) {
                $this->_error[] = "[customerCode:{$headerRequest['customerCode']}]账户不可用.";
                return false;
            }
        }
        //查询子账号
        $accountRow = Service_Account::getByField($headerRequest['accountCode'], 'account_code');
        if ($accountRow instanceof Zend_Db_Table_Row) {
            $accountRow = $accountRow->toArray();
        }
        //子账号不存在，或子账号的customer_code不等于传入的主账号
        if (!$accountRow || ($accountRow['customer_code'] != $headerRequest['customerCode'])) {
            $this->_error[] = "[accountCode:{$headerRequest['accountCode']}]不存在！";
            return false;
        }
        //判断操作类型
        if (!isset($this->_param['opType'])) {
            $this->_error[] = "缺少[opType]参数,或[opType]参数为空.";
            return false;
        } else {
            if ($this->_param['opType'] === '') {
                $this->_error[] = "缺少[opType]参数,或[opType]参数为空.";
                return false;
            }
        }
        $customer['account_code'] = $accountRow['account_code'];
        $this->_customer          = $customer;
        //验证token
        $customerAuth = Service_CustomerApi::getByField($customer['customer_code'], 'customer_code');
        if ($customerAuth && $customerAuth['ca_token'] == $headerRequest['appToken']) {
            //检查权限
            if (($privilege = $this->checkPrivilege($method)) === false) {
                return false;
            }
            $this->_appKey = $customerAuth['ca_key'];
            return true;
        }

        $this->_error[] = "AppToken不存在!";
        return false;
    }

    /**
     * 获取错误
     * @return [type] [description]
     */
    public function getError()
    {
        if (empty($this->_error)) {
            return null;
        }
        $result = array(
            'ask'     => 0,
            'message' => $this->_message,
            'error'   => $this->_error,
        );
        return $this->cearteResult($result);
    }

    /**
     * 获取成功时返回的数据
     * @return [type] [description]
     */
    public function getSuccess()
    {
        $result = array(
            'ask'     => 1,
            'message' => $this->_message,
        );
        return $this->cearteResult(array_merge($result, $this->_success));
    }

    /**
     * 对比 签名
     * @param  string $value [description]
     * @return [type]        [description]
     */
    private function verifySignString($verify)
    {
        $sign     = $this->_param['sign'];
        $signType = $this->_param['signType'];

        switch ($signType) {
            case 'MD5':
                $newSign = md5($verify . '&' . $this->_appKey);
                break;
            default:
                $this->_error[] = "签名类型不存在";
                return false;
                break;
        }

        if (strtolower($sign) != strtolower($newSign)) {
            $this->_error[] = '签名不正确！';
            // $this->_error[] = $verify . '&' . $this->_appKey;
            return false;
        }

        return true;
    }

    /**
     * 获取sign
     * @return [type] [description]
     */
    private function linkSignParam()
    {
        $request = $this->deleteDoNotVerify();
        ksort($request);
        $signString = '';
        foreach ($request as $key => $value) {
            $signString .= "{$key}={$value}&";
        }
        $signString = rtrim($signString, '&');
        return $signString;
    }

    /**
     * 去除不要sign的字段
     * @param string $value [description]
     */
    private function deleteDoNotVerify()
    {
        $request    = $this->_originalParams;
        $newRequest = array();
        if (empty($request)) {
            return $newRequest;
        }
        $deleteParams = array(
            'sign', 'signType', 'module', 'controller', 'action',
        );
        foreach ($request as $key => $value) {
            // 剔除sign和sign_type参数
            if (!in_array($key, $deleteParams)) {
                $newRequest[$key] = $value;
            }
        }

        return $newRequest;
    }

    /**
     * 检查权限
     * @param  string $apiname aip名称
     * @return [type]          [description]
     */
    protected function checkPrivilege($api)
    {
        $companyTypeArray = @include_once dirname(__FILE__) . '/WebApiPrivileges.php';
        if (!$companyTypeArray) {
            //$api不在权限数组里
            $this->_error[] = '系统异常';
            return false;
        }
        // 检查权限
		$hasPrivileges = false;
        foreach ($companyTypeArray as $key => $value) {
            if ($this->_customer[$key] == '1' && $hasPrivileges == false) {
                foreach ($value as $item) {
                    if ($item['apiName'] == $api) {
                        //必须要设置opType
                        if (isset($item['opType'])) {
                            if (is_array($item['opType']) && in_array($this->_param['opType'], $item['opType'])) {
                                $hasPrivileges = true;
								break;
                            } else if (is_scalar($item['opType']) && $this->_param['opType'] == $item['opType']) {
                                $hasPrivileges = true;
								break;
                            }
                        } 
                    }
                }
            }
        }
		if($hasPrivileges == false){
			$this->_error[] = $this->_customer['customer_code'] . '无权限调用' . $api;
			return false;
		}
		return true;
    }

    /**
     * 获取客户id
     * @return [type] [description]
     */
    public function getCustomerId()
    {
        return $this->_customerId;
    }

    /**
     * 用于参数转换
     * @param  string $type 类型
     * @param  array  $param 要转换的数据
     * @return array
     */
    protected function translate($param)
    {
        if (!isset($this->fields)) {
            throw new Exception("类型不存在！");
        }
        $fields = $this->fields;

        $info = array();

        foreach ($fields as $key => $val) {
            if (isset($param[$key])) {
                $info[$val] = $param[$key];
            } else {
                $info[$val] = '';
            }
        }
        // $method = 'verification';
        if (method_exists($this, 'verification')) {
            if (($info = $this->verification($info, $param)) === false) {
                return false;
            }
        }

        return $info;
    }

    /**
     * [cearteResult description]
     * @param  [type] $dataInfo [description]
     * @return [type]           [description]
     */
    private function cearteResult($dataInfo)
    {
        return Common_Message::cearteMessage($dataInfo, 'Response');
    }
}
