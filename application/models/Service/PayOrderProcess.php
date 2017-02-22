<?php
/**
 * @author simple
 */
class Service_PayOrderProcess {
    protected $_error = array();
    protected $_param = null;
    public $_date = null;
    protected $_customerId = null;
    protected $_customer = null;
    protected $_addData = null;
    protected $_updateData;

    public function __construct($data=array()) {
        $this->setUser();
        $this->_date = date('Y-m-d H:i:s');
        if(is_array($data)) {
            foreach($data as $key=>$value) {
                $p = '_'.$key;
                $this->$p = $value;
            }
        }
    }
    /**
     * 初始化用户
     */
    public function setUser() {
        $session = new Zend_Session_Namespace("customerAuth");;
        $customer = $session->data;
        $this->_customerId = $customer['id'];;
        $this->_customer = $customer;
    }
    
    /**
     * 数据表字段
     * @return multitype:string
     */
    public static function getTitle() {
        return array(
                'po_code' => '支付单号',
                'pay_no' => '支付企业交易单号',
                'app_time' => '申报时间',
                'app_status' => '业务状态',
                'order_code' => '订单号码',
                'ecommerce_platform_customer_code' => '电商平台编码',
                'ecommerce_platform_customer_name' => '电商平台名称',
                'customer_code' => '客户代码',
                'enp_name' => '电商企业名称',
                'pay_customer_code' => '支付企业客户代码',
                'pay_enp_name' => '支付企业名称',
                'pay_account_code' => '支付企业子账号客户代码',
                'pay_type' => '支付类型',
                'reference_no' => '客户参考号',
                'status' => '支付单状态',
                'goods_value' => '订单商品货款',
                'freight_fee' => '订单商品运费',
                'pay_currency_code' => '货币币种',
                'pay_amount' => '支付金额',
                'cosignee_code' => '支付人证件号码',
                'cosignee_name' => '支付人姓名',
                'cosignee_address' => '支付人地址',
                'cosignee_telephone' => '支付人电话',
                'cosignee_country_id' => '支付人所在国家',
                'pro_amount' => '优惠金额',
                'pro_remark' => '优惠金额说明',
                'note' => '备注',
                'add_time' => '添加时间',
                'update_time' => '最后修改时间',
                'fml_cmbl_status' => '海关审核状态',
                'fml_comment' => '异常原因',
                'pay_time' => '支付时间',
        );
    }
    
    /**
     * 字段对应关系
     * @return multitype:string
     */
    public static function getMap() {
        return array(
                'po_id' => 'po_id',
            //    'po_code' => 'po_code',
            //    'app_time' => 'app_time',
            //   'app_status' => 'app_status',
                'pay_no' => 'pay_no',
            //    'order_code' => 'order_code',
                'ecommerce_platform_customer_code' => 'ecommerce_platform_customer_code',
                'ecommerce_platform_customer_name' => 'ecommerce_platform_customer_name',
                'customer_code' => 'customer_code',
                'enp_name' => 'enp_name',
                'pay_customer_code' => 'pay_customer_code',
                'pay_enp_name' => 'pay_enp_name',
                'pay_account_code' => 'pay_account_code',
            //    'pay_type' => 'pay_type',
                'reference_no' => 'reference_no',
            //    'status' => 'status',
            //    'goods_value' => 'goods_value',
            //    'freight_fee' => 'freight_fee',
                'pay_currency_code' => 'pay_currency_code',
                'pay_amount' => 'pay_amount',
                'cosignee_code' => 'cosignee_code',
                'cosignee_name' => 'cosignee_name',
            //    'cosignee_address' => 'cosignee_address',
            //    'cosignee_telephone' => 'cosignee_telephone',
            //    'cosignee_country_id' => 'cosignee_country_id',
            //    'pro_amount' => 'pro_amount',
            //    'pro_remark' => 'pro_remark',
                'note' => 'note',
            //    'add_time' => 'add_time',
            //    'update_time' => 'update_time',
            //    'fml_cmbl_status' => 'fml_cmbl_status',
            //    'fml_comment' => 'fml_comment',
                'pay_time' => 'pay_time',
        );
    }
    
    /**
     * 数据验证
     */
    protected function check() {
        if(!$this->_param){
            $this->_error[] = '请填写创建信息';
            return;
        }
        if(isset($this->_param['po_id']) && !empty($this->_param['po_id'])){
            $row = Service_PayOrder::getByField($this->_param['po_id'], 'po_id');
            if($row instanceof Zend_Db_Table_Row){
                $row = $row->toArray();
            }
            if(!$row || $row['status']==0){
                $this->_error[] = '单号不存在';
                return;
            }
        }
        $title = self::getTitle();
        $map = self::getMap();
        foreach($map as $key=>$value) {
            $this->_addData[$value] = $this->_param[$key];
            if(!isset($this->_param[$key]) || empty($this->_param[$key])){
                if($key=='note' || $key == 'po_id' || $key == 'order_code'){
                    continue;
                }
                //编辑
                if(isset($this->_param['po_id']) && !empty($this->_param['po_id'])){
                    $skipArr = array(
                            'ecommerce_platform_customer_code',
                            'ecommerce_platform_customer_name',
                            'customer_code',
                            'enp_name',
                            'po_code',
                            'app_time',
                            'app_status',
                            'pay_customer_code',
                            'pay_enp_name',
                            'pay_account_code'
                    );
                    if(in_array($key, $skipArr)){
                        continue;
                    }
                }
                $this->_error[] = $title[$key].'不能为空';
            }
        }

        // pay_amount 金额
        $amountRegular = '/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/';
        if(!preg_match($amountRegular, $this->_param['pay_amount'])){
            $this->_error[] = '支付金额格式错误，正确格式：100.00';
        }

        // cosignee_code 身份证验证
        $codeRegular = '/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i';
        if(!preg_match($codeRegular, $this->_param['cosignee_code'])){
            $this->_error[] = '支付人证件号码格式错误';
        }

        // 支付时间验证
        if(!preg_match('/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])(\s{1}(0[1-9]|1[0-9]|2[0-4]):[0-5][0-9]:[0-5][0-9])?$/', $this->_param['pay_time'])){
            $this->_error[] = '支付时间['.$this->_param['pay_time'].']格式错误,正确格式：2016-01-01 12:12:12 或者 2016-01-01';
        }
        
        if(!empty($this->_error)){
            return;
        }
        
        //编辑
        if(!isset($this->_param['po_id']) || empty($this->_param['po_id'])){
            //子账号
            $account_code = isset($this->_addData['pay_account_code']) ? $this->_addData['pay_account_code'] : '';
            $account = Service_Account::getByField($account_code, 'account_code');
            if(empty($account)){
                $this->_error[] = '账号不存在';
            }else {
                if($account['account_level']!='1'){
                    $this->_error[] = '不为子账号,不能操作';
                }else{
                    //找到主账号信息
                    $opFather = Service_Customer::getByField($account['customer_code'], 'customer_code', array('customer_status', 'customer_code', 'trade_name'));
                    if(empty($opFather)){
                        $this->_error[] = '找不到子账号父账号信息';
                    }else{
                        if($opFather['customer_status'] != 2){
                            $this->_error[] = '父账号非正常状态';
                        }else{
                            if($opFather['customer_code']!=$this->_addData['pay_customer_code']){
                                $this->_error [] = "支付企业代码:{$this->_addData['pay_customer_code']}和备案代码:{$opFather['customer_code']}不一致";
                            }
                            if($opFather['trade_name']!=$this->_addData['pay_enp_name']){
                                $this->_error [] = "支付企业名称:{$this->_addData['pay_enp_name']}和备案名称:{$opFather['trade_name']}不一致";
                            }
                        }
                    }
                }
            }
        }

        //检查订单是否存在
        /*
        $orderRow = Service_Orders::getByCondition(array(
                //'order_code' => $this->_addData['order_code'], 
                'reference_no' => $this->_addData['reference_no'],
                
                // 'ecommerce_platform_customer_code' => $this->_addData['ecommerce_platform_customer_code'],
                // 'ecommerce_platform_customer_name' => $this->_addData['ecommerce_platform_customer_name'],
                // 'customer_code' => $this->_addData['customer_code'],
                // 'customer_name' => $this->_addData['enp_name'],
                
            ), array('order_id'));
        if(empty($orderRow)){
            $this->_error[] = '交易订单号：('.$this->_addData['reference_no'].')不存在';
            return;
        }
        */
        //
        /*
        if(trim(strtoupper($orderRow['reference_no'])) != trim(strtoupper($this->_addData['reference_no']))){
            $this->_error[] = '客户参考号：('.$this->_addData['reference_no'].')与订单参考号：('.$orderRow['reference_no'].')不符';
        }
        */
       
        //检查交易单号是否存在
        if(empty($this->_addData['po_id'])){
            /*
            $tmpRow = Service_PayOrder::getByField($this->_addData['order_code'], 'order_code', array('po_code'));
            if(!empty($tmpRow) && $tmpRow){
                $this->_error[] = '订单：('.$this->_addData['order_code'].')已存在, 支付单号：'.$tmpRow['po_code'].'';
                return;
            }
            */

            //$tmpRow = Service_PayOrder::getByField($this->_addData['pay_no'], 'pay_no', array('po_code'));
            $tmpRow = Service_PayOrder::getByCondition(array('pay_customer_code'=>$this->_addData['pay_customer_code'], 'pay_no'=>$this->_addData['pay_no']), array('po_code'));
            if(!empty($tmpRow) && $tmpRow){
                $this->_error[] = '支付单号：('.$this->_addData['pay_no'].')已存在, 支付单号：'.$tmpRow[0]['po_code'].'';
                return;
            }
            //$tmpRow = Service_PayOrder::getByField($this->_addData['reference_no'], 'reference_no', array('po_code'));
            $tmpRow = Service_PayOrder::getByCondition(array('pay_customer_code'=>$this->_addData['pay_customer_code'], 'reference_no'=>$this->_addData['reference_no']), array('po_code'));
            if(!empty($tmpRow) && $tmpRow){
                $this->_error[] = '交易订单号: ('.$this->_addData['reference_no'].')已存在，支付单号：'.$tmpRow[0]['po_code'].'';
                return;
            }
        }

        // customer_code
        $customerData = Service_Customer::getByField($this->_addData['customer_code'], 'customer_code', array('customer_id'));
        if(empty($customerData)){
            $this->_error[] = '企业编码'.$this->_addData['customer_code'].',该企业不存在';
        }

        // pay_customer_code
        $customerData = Service_Customer::getByField($this->_addData['pay_customer_code'], 'customer_code', array('customer_id'));
        if(empty($customerData)){
            $this->_error[] = '支付企业客户代码'.$this->_addData['pay_customer_code'].',该企业不存在';
        }
        
        //pay_currency_code
        /*
        $payCurrencyCode = Service_Country::getByField($this->_addData['pay_currency_code'], 'currency_code', array('currency_code'));
        if(!$payCurrencyCode){
            $this->_error[] = '币种'.$this->_addData['pay_currency_code'].'不存在';
        }

        if(!in_array($this->_addData['customer_code'], $this->_customer['priv_customer_code_arr'])){
            $this->_error[] = $this->_addData['customer_code'].'未绑定该企业;';
        }
        */
       
        //检查订单表里的交易单号是否存在
        $order = Service_Orders::getByCondition(array('reference_no'=>$this->_addData['reference_no'], 'customer_code'=>$this->_addData['customer_code']), array('order_code'), 1, 1);
        if(!$order){
        //    $this->_error[] = '交易单订单号不存在';
            $this->_addData['order_code'] = '';
        }else{
            $this->_addData['order_code'] = $order[0]['order_code'];
        }

        if(!empty($this->_error)){
            return;
        }
    }
    
    /**
     * 数据封装
     */
    public static function conversionParameter($payOrderData){
        if(empty($payOrderData)){
            return false;
        }
        /*
        if(key_exists('app_status', $payOrderData)){
            $appStatus = self::getAppStatus('auto');
            $payOrderData['app_status'] = $appStatus[$payOrderData['app_status']];
        }
        */
		/*
        if(key_exists('app_type', $payOrderData)){
            $appTypes = self::getAppType('auto');
            $payOrderData['app_type'] = $appTypes[$payOrderData['app_type']];
        }
		*/
        if(key_exists('app_time', $payOrderData) && $payOrderData['app_time'] == '0000-00-00 00:00:00'){
           $payOrderData['app_time'] = '暂未申报';
        }
        if(key_exists('ciq_status', $payOrderData)){
            $payOrderData['ciq_status'] = Service_PayOrder::getCiqStatus($payOrderData['ciq_status']);
        }
        return $payOrderData;
    }
    
    /**
     * 创建支付单
     */
    public function createPayOrderTransaction() {
        $return = array('ask'=>0, 'message'=>'');
        $this->check();
        if(!empty($this->_error)){
            $return['message'] = $this->_error;
            return $return;
        }
        $result = array();
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
		
        if(empty($this->_param['po_id'])){
        //    $addRow = $this->_addData;
            $po_code = Common_GetNumbers::getCode('pay_order', 10, 'PO', '支付单编号');
            $addRow = array(
                    'po_code' => $po_code,
                    'pay_no' => $this->_addData['pay_no'],
                //    'order_code' => empty($this->_addData['order_code']) ? '' : $this->_addData['order_code'],
                    'ecommerce_platform_customer_code' => $this->_addData['ecommerce_platform_customer_code'],
                    'ecommerce_platform_customer_name' => $this->_addData['ecommerce_platform_customer_name'],
                    'customer_code' => $this->_addData['customer_code'],
                    'enp_name' => $this->_addData['enp_name'],
                    'pay_customer_code' => $this->_addData['pay_customer_code'],
                    'pay_enp_name' => $this->_addData['pay_enp_name'],
                    'pay_account_code' => $this->_addData['pay_account_code'],
                    'reference_no' => $this->_addData['reference_no'],
                    'pay_currency_code' => $this->_addData['pay_currency_code'],
                    'pay_amount' => $this->_addData['pay_amount'],
                    'cosignee_code' => $this->_addData['cosignee_code'],
                    'cosignee_name' => $this->_addData['cosignee_name'],
                    'note' => $this->_addData['note'],
                    'add_time' => $this->_date,
                    'update_time' => $this->_date,
                    'pay_time' => $this->_addData['pay_time'],
            );

            try {
                //验证只有子账号才能操作
                Service_Account::getAccountTypeException($addRow['pay_account_code']);
                $poId = Service_PayOrder::add($addRow);
                if(!$poId){
                    throw new Exception("新增数据异常", 500);
                }
                $acData = Service_Account::getByField($addRow['pay_account_code'], 'account_code', array('account_id', 'account_name'));
                $userId = !empty($this->_customer['id']) ? $this->_customer['id'] : $acData['account_id'];
                $userName = !empty($this->_customer['account_name']) ? $this->_customer['account_name'] : $acData['account_name'];
                $polData = array(
                        'po_id' => $poId,
                        'po_code' => $po_code,
                        'pl_add_time' => $this->_date,
                        'user_id' => empty($userId) ? 0 : $userId,
                        'pl_ip' => Common_Common::getRealIp(),
                        'pl_comments' => '新增支付单',
                        'account_name' => empty($userName) ? 'interface' : $userName
                );
                $polId = Service_PayOrderLog::add($polData);
                if(!$polId){
                    throw new Exception("支付单日志写入异常", 501);
                }
                $db->commit();
            //    $db->rollback();
                $return['ask'] = 1;
                $return['message'] = '添加成功,支付单号：'.$po_code;
                $return['po_code'] = $po_code;
            }catch (Exception $e){
                $db->rollback();
                $return = array('ask'=>0, 'message'=>$e->getMessage(), 'errorCode'=>$e->getCode());
            }
        }else {
            $updateRow = array(
                    'order_code' => $this->_addData['order_code'],
                    'ecommerce_platform_customer_code' => $this->_addData['ecommerce_platform_customer_code'],
                    'ecommerce_platform_customer_name' => $this->_addData['ecommerce_platform_customer_name'],
                    'customer_code' => $this->_addData['customer_code'],
                    'enp_name' => $this->_addData['enp_name'],
                    'pay_customer_code' => $this->_addData['pay_customer_code'],
                    'pay_enp_name' => $this->_addData['pay_enp_name'],
                    'pay_account_code' => $this->_addData['pay_account_code'],
                    'reference_no' => $this->_addData['reference_no'],
                    'pay_currency_code' => $this->_addData['pay_currency_code'],
                    'pay_amount' => $this->_addData['pay_amount'],
                    'cosignee_code' => $this->_addData['cosignee_code'],
                    'cosignee_name' => $this->_addData['cosignee_name'],
                    'note' => $this->_addData['note'],
                    'update_time' => $this->_date,
                    'pay_time' => $this->_addData['pay_time'],
            );
            try {
                //验证只有子账号才能操作
                Service_Account::getAccountTypeException($updateRow['pay_account_code']);
                $result = Service_PayOrder::update($updateRow, $this->_param['po_id']);
                if(!$result){
                    throw new Exception('更新异常或者未做修改', 500);
                }
                $db->commit();
            //    $db->rollback();
                $return['ask'] = 1;
                $return['message'] = '更新成功';
            }catch (Exception $e){
                $db->rollback();
                $return = array('ask'=>0, 'message'=>$e->getMessage(), 'errorCode'=>$e->getCode());
            }
        }
        return $return;
    }

    /**
     * [updateCheck 接口更新校验]
     * @return [type] [description]
     */
    public function updateCheck(){
        if(!$this->_param){
            $this->_error[] = '请填写创建信息';
            return;
        }
        $title = self::getTitle();
        $map = self::getMap();
        foreach($map as $key=>$value) {
            if(isset($this->_param[$key]) && !empty($this->_param[$key])){
                $this->_updateData[$value] = $this->_param[$key];
            }
        }
        // pay_amount 金额
        if(isset($this->_updateData['pay_amount']) && !empty($this->_updateData['pay_amount'])){
            $amountRegular = '/^\d+(\.\d+)?$/';
            if(!preg_match($amountRegular, $this->_updateData['pay_amount'])){
                $this->_error[] = '支付金额格式错误，正确格式：100.00';
            }
        }

        // cosignee_code 身份证验证
        if(isset($this->_updateData['pay_amount']) && !empty($this->_updateData['pay_amount'])){
            $codeRegular = '/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i';
            if(!preg_match($codeRegular, $this->_updateData['cosignee_code'])){
                $this->_error[] = '支付人证件号码格式错误';
            }
        }
        // pay_customer_code
        if(isset($this->_updateData['pay_customer_code']) && !empty($this->_updateData['pay_customer_code'])){
            $customerData = Service_Customer::getByField($this->_updateData['pay_customer_code'], 'customer_code');

            if(empty($customerData)){
                $this->_error[] = '企业编码'.$this->_updateData['pay_customer_code'].',该企业不存在';
            }

            if($customerData['customer_status'] != 2){
                $this->_error[] = '父账号非正常状态';
            }else{
                if($customerData['customer_code']!=$this->_updateData['pay_customer_code']){
                    $this->_error [] = "支付企业代码:{$this->_updateData['pay_customer_code']}和备案代码:{$customerData['customer_code']}不一致";
                }
                if(isset($this->_updateData['pay_enp_name']) && !empty($this->_updateData['pay_enp_name'])){
                    if($customerData['trade_name']!=$this->_updateData['pay_enp_name']){
                        $this->_error [] = "支付企业名称:{$this->_updateData['pay_enp_name']}和备案名称:{$customerData['trade_name']}不一致";
                    }
                }
            }
        }

    }

     /**
     * [updatePayOrderTransaction description]
     * @return [type] [description]
     */
    public function updatePayOrderTransaction($where){
        $return = array('ask'=>0, 'message'=>'');
        if(empty($where) || !is_array($where)){
            $return['message'] = '参数错误';
            return $return;
        }
        $this->updateCheck();

        if(!empty($this->_error)){
            $return['message'] = $this->_error;
            return $return;
        }
        $pData = Service_PayOrder::getByWhere($where, array('po_id', 'po_code', 'app_status'));
        //异常状态才能修改
        if(empty($pData) || !is_array($pData) || $pData['app_status'] != 3){
            $this->_error[] = '支付单不存在或者状态不可修改(异常状态可修改)';
            $return['message'] = $this->_error;
            return $return;
        }
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $result = Service_PayOrder::update($this->_updateData, $pData['po_id']);
            if(!$result){
                throw new Exception('更新运单异常或者未做修改', 500);
            }
            $payOrderLogData = array(
                    'po_id' => $pData['po_id'],
                    'po_code' => $pData['po_code'],
                    'pl_status_from' => $pData['app_status'],
                    'pl_status_to' => $pData['app_status'],
                    'pl_add_time' => $this->_date,
                    'user_id' =>  -1 ,
                    'pl_ip' => Common_Common::getRealIp(),
                    'pl_comments' => 'interface update',
                    'account_name' => 'interface',
            );
            if(Service_PayOrderLog::add($payOrderLogData) === false ){
                throw new Exception("运单日志写入异常", 501);
            }
            $db->commit();
        //    $db->rollback();
            $return['ask'] = 1;
            $return['po_code'] = $pData['po_code'];
            $return['message'] = '修改成功';
        }catch (Exception $e){
            $db->rollback();
            $return = array('ask'=>0, 'message'=>$e->getMessage(), 'errorCode'=>$e->getCode());
        }
        
        return $return;
    }

    /**
     * [getPayOrderBywhere 接口返回数据]
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    public static function getPayOrderBywhere($where){
        if(empty($where) && is_array($where)){
            return false;
        }
        $payOrderData = Service_PayOrder::getByWhere($where, array('po_code', 'pay_no', 'app_status'));
        $payOrderData = self::conversionParameter($payOrderData);
        return $payOrderData;
    }

    /**
     * @author
     * @todo 用于处理excel文件返回成有效的数组
     */
    public static function getDataArr ($rows)
    {
        /*
         * $customerAuth = new Zend_Session_Namespace("customerAuth");
         * $customer = $customerAuth->data;
         * $customerId = $customer['id'];
         * $customer_code = $customer['code'];
         */
        $payOrderRows = array();
        // 键名--中文对照
        $title = array_flip(self::getTitle());
        foreach ($rows as $key => $rowData) {
            foreach ($title as $k => $v) {
                if (isset($rowData[$k])) {
                    $payOrderRows[$key][$v] = $rowData[$k];
                }

                if ($v == 'cosignee_country_id'){
                    $country = Service_Country::getByField($rowData[$k], 'country_name', array('country_id'));
                    if(!empty($country)){
                        $payOrderRows[$key][$v] = $country['country_id'];
                        //未匹配到国家
                    }else {
                        $payOrderRows[$key][$v] = 'unkown country';
                    }
                }
            }
        }
        return $payOrderRows;
    }

    /**
     * 申报类型
     * @param string $lang 语言类型
     * @return multitype:multitype:string
     */
    public static function getAppType($lang = 'auto'){
        $tmp = array(
                'zh_CN' => array(
                        '1' => '新增',
                        '2' => '变更',
                        '3' => '删除'
                ),
                'en_US' => array(
                        '1' => 'Newly added',
                        '2' => 'Change',
                        '3' => 'Delete'
                )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
    }
    
    /**
     * 业务状态
     * @param string $lang 语言类型
     * @return multitype:multitype:string
     */
    public static function getAppStatus($lang = 'auto'){
        //业务状态:1草单;2:已关联(待发送);3:异常;4:已发送海关;5:海关已接收 6:海关已审核 7:审核不通过
        $tmp = array(
                'zh_CN' => array(
                        '1' => '草稿',
                        '2' => '已关联',
                        '3' => '异常',
                        '4' => '已发送',
                        '5' => '已接收',
                       // '6' => '海关已审核',
                       // '7' => '审核不通过'
                ),
                'en_US' => array(
                        '1' => '草稿',
                        '2' => '已关联',
                        '3' => '异常',
                        '4' => '已发送',
                        '5' => '已接收',
                    // '6' => '海关已审核',
                    // '7' => '审核不通过'
                )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
    }
}