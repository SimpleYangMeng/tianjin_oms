<?php
class Service_PersonItemProcess
{
    protected $_error = array();
    protected $_param = null;
    public $_date = null;
    protected $_customerId = null;
    protected $_customer = null;
    protected $_addData = null;
    protected $_orderRow = null;
    protected $_waybillRow = null;
    protected $_payRow = null;
    protected $_personRow = null;

    public function __construct($data = array())
    {
        $this->setUser();
        $this->_date = date('Y-m-d H:i:s');
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $p = '_' . $key;
                $this->$p = $value;
            }
        }
    }
    public function setUser()
    {
        $session = new Zend_Session_Namespace("customerAuth");
        $customer = $session->data;
        $this->_customerId = $customer['id'];
        $this->_customer = $customer;
    }
    public static function getTitle()
    {
        return array(
            'pim_reference_no' => '清单内部编号',
            'reference_no' => '客户订单号',
            'form_type' => '业务类型',
            'customer_code' => '电商企业代码',
            'enp_name' => '电商企业名称',
            'ebp_code' => '电商平台代码',
            'ebp_name' => '电商平台名称',
            'buyer_id_type' => '订购人证件类型',
            'buyer_id' => '订购人证件号码',
            'buyer_name' => '订购人姓名',
            'currency' => '币制',
            'storage_customer_code' => '仓储企业代码',
            'storage_name' => '仓储企业名称',
            'agent_customer_code' => '申报单位代码',
            'agent_name' => '申报单位名称',
            'logistic_customer_code' => '物流企业代码',
            'pay_customer_code' => '支付企业代码',
            'log_no' => '运单号',
            'pay_no' => '支付单号',
            'wrap_type' => '外包装类型',
            'ie_port' => '进出口口岸',
            'declare_ie_port' => '申报口岸',
            'traf_mode' => '出入港区运输方式',
            'ship_trade_country' => '发件人国家',
            'ship_name' => '发件人',
            'ship_city' => '发件人城市',
            'declare_no' => '保管员',
            'outset_country_id' => '启运国',
            'aim_country_name' => '抵运国家',
            'receive_name' => '收件人姓名',
            'receive_telphone' => '收件人电话',
            'receive_country_name' => '收件人国家',
            'receive_state' => '州/区域',
            'receive_city' => '城市',
            'receive_id_number' => '收件人身份证',
            'input_company' => '录入单位',
            'agent_address' => '单位地址',
            'agent_post' => '邮编',
            'agent_tel' => '电话',
            'freight' => '运费',
            'insure_fee' => '保费',
            'customs_field' => '监管场所代码',
            'input_no' => '录入员',
            'net_wt' => '净重',
            'gross_wt' => '毛重',
            'pack_no' => '件数',
            'note' => '备注信息',
            'i_e_date' => '进出境日期',
            'input_date' => '录入时间',
            'declare_date' => '申报日期',
            'receiving_address' => '收件人地址',
        );
    }

    public static function getMap()
    {
        return array(
            'pim_reference_no' => 'pim_reference_no',
            'reference_no' => 'reference_no',
            'form_type' => 'form_type',
            'customer_code' => 'customer_code',
            'enp_name' => 'enp_name',
            'ebp_code' => 'ebp_code',
            'ebp_name' => 'ebp_name',
            'buyer_id_type' => 'buyer_id_type',
            'buyer_id' => 'buyer_id',
            'buyer_name' => 'buyer_name',
            'currency' => 'currency',
            'storage_customer_code' => 'storage_customer_code',
            'storage_name' => 'storage_name',
            'agent_customer_code' => 'agent_customer_code',
            'agent_name' => 'agent_name',
            'logistic_customer_code' => 'logistic_customer_code',
            'pay_customer_code' => 'pay_customer_code',
            'log_no' => 'log_no',
            'pay_no' => 'pay_no',
            'wrap_type' => 'wrap_type',
            'ie_port' => 'ie_port',
            'traf_mode' => 'traf_mode',
            'ie_port' => 'ie_port',
            'declare_ie_port' => 'declare_ie_port',
            'ship_trade_country' => 'ship_trade_country',
            'ship_name' => 'ship_name',
            'ship_city' => 'ship_city',
            'declare_no' => 'declare_no',
            'outset_country_id' => 'outset_country_id',
            'aim_country_name' => 'aim_country_name',
            'receive_name' => 'receive_name',
            'receive_name' => 'receive_name',
            'receive_telphone' => 'receive_telphone',
            'receive_country_name' => 'receive_country_name',
            'receive_state' => 'receive_state',
            'receive_city' => 'receive_city',
            'receive_id_number' => 'receive_id_number',
            'input_company' => 'input_company',
            'agent_address' => 'agent_address',
            'agent_post' => 'agent_post',
            'agent_tel' => 'agent_tel',
            'freight' => 'freight',
            'insure_fee' => 'insure_fee',
            'customs_field' => 'customs_field',
            'input_no' => 'input_no',
            'net_wt' => 'net_wt',
            'gross_wt' => 'gross_wt',
            'pack_no' => 'pack_no',
            'note' => 'note',
            'i_e_date' => 'i_e_date',
            'input_date' => 'input_date',
            'declare_date' => 'declare_date',
            'account_code' => 'account_code',
            'receiving_address' => 'receiving_address',
            //'account_name'=>'account_name',
            /*'exit_time' =>'进出境日期',
        'declare_time' =>'申报日期',*/

        );
        /*return array(
    'reference_no' =>'reference_no',
    'customer_code' =>'form_type',
    'customer_code' =>'customer_code',
    'wb_code' =>'运单号',
    'po_code' =>'支付单号',
    'warehouse_id' =>'仓储物流企业',
    'status' =>'状态',
    'exit_time' =>'进出境日期',
    'declare_time' =>'申报日期',
    'ie_port' =>'进出口口岸',
    'declare_ie_port' =>'申报海关',
    'traf_mode' =>'出入港区运输方式',
    'wrap_type' =>'外包装类型',
    'ship_name' =>'发件人',
    'ship_trade_country' =>'发件人海关编码',
    'aim_country_name' =>'抵运国家',
    'receive_name' =>'收件人姓名',
    'receive_telphone' =>'收件人电话',
    'receive_country_name' =>'收件人国家',
    'receive_state' =>'州/区域',
    'receive_city' =>'城市',
    'receive_id_number' =>'收件人身份证',
     */
    }
    /**
     * @author william-fan
     * @todo 不判定是否匹配
     */
    public static function notcheck()
    {
        return array(
            'note',
            //'insureFee',
            //'freight',
            'customs_field',
        );
    }

    protected function check()
    {
        if (!$this->_param) {
            $this->_error[] = '请填写清单信息';
            return;
        }
        // if(isset($this->_param['id']) && !empty($this->_param['id'])){
        //     $row = Service_PersonItem::getByField($this->_param['id'],'wb_id');
        //     if($row instanceof Zend_Db_Table_Row){
        //         $row = $row->toArray();
        //     }
        //     if(!$row || $row['wb_status']==0){
        //         $this->_error[] = '单号不存在';
        //         return;
        //     }
        // }
        if (!isset($this->_param['product']) && empty($this->_param['product'])) {
            $this->_error[] = '请选择产品';
            return;
        }
        $title = self::getTitle();
        // print_r($title);exit;
        $map = self::getMap();
        foreach ($map as $key => $value) {
            if (!isset($this->_param[$key]) || $this->_param[$key] === '') {
                /*if($key=='note'){
                }*/
                if (in_array($key, self::notcheck())) {
                    continue;
                }
                $this->_error[] = $title[$key].'不能为空，请填上或选择';
            }
            $this->_addData[$value] = $this->_param[$key];
        }
        $goodsIdList = $ciqNo =array();
        //保税进口 一般进口 校验
        foreach ($this->_param['product'] as $key => $value) {
            if (!isset($value['registerID']) || empty($value['registerID'])) {
                $errorStr = '产品备案编号:' . $value['registerID'] . '不存在';
                $this->_error[] = $errorStr;
                continue;
            }
            if (empty($value['goods_id'])) {
                $errorStr = '产品备案编号:' . $value['registerID'] . '请填写对应底账料件号';
                $this->_error[] = $errorStr;
                continue;
            }
            /*
            if (in_array($value['goods_id'], $goodsIdList)) {
                $this->_error[] = '产品备案编号:' . $value['registerID'] . '对应底账料件号重复';
                continue;
            }
            */
            if(in_array($value['ciq_g_no'], $ciqNo)){
                $this->_error[] = '产品备案编号:' . $value['registerID'] . '对应检验检疫备案号'.$value['ciq_g_no'].'重复';
                continue;
            }
            if(empty($value['qty_1'])){
                $this->_error[] = '产品备案编号:' . $value['registerID'] . '法定数量不能为空';
                continue;
            }
            if(empty($value['unit_1'])){
                $this->_error[] = '产品备案编号:' . $value['registerID'] . '法定计量单位不能为空';
                continue;
            }
            if(empty($value['ciq_g_no'])){
                $this->_error[] = '料件号'.$value['goods_id'].'商品流水号未填写';
                continue;
            }else {
                $receivingDetailData = Service_ReceivingDetail::getByField($value['ciq_g_no'], 'ciq_g_no', array('cus_goods_id'));
                if(empty($receivingDetailData)){
                    $this->_error[] = '商品流水号:'.$value['ciq_g_no'].'商品暂未入库';
                    continue;
                }else {
                    if(trim(strtoupper($receivingDetailData['cus_goods_id'])) != trim(strtoupper($value['registerID']))){
                        $this->_error[] = '商品流水号:'.$value['ciq_g_no'].'海关备案编号：'.$value['registerID'].'与入库海关备案号：'.$receivingDetailData['cus_goods_id'].'不一致';
                        continue;
                    }
                }
            }
            $goodsIdList[] = $value['goods_id'];
            $ciqNo[] = $value['ciq_g_no'];
            $error = $this->choiceProduct($value);
            if ($error['ask'] == '0') {
                $this->_error = @array_merge($this->_error, $error['error']);
                /*$errorStr='产品备案编号:'.$value['registerID'].implode(',',$error['error']);
            $this->_error[]=$errorStr;*/
            }
            // $customerData = Service_Customer::getByField($product['customer_id']);
            $product = Service_Product::getByField($value['registerID'], 'registerID');
            if ($product['ie_type'] == 'E') {
                $this->_error[] = '非进口产品';
                return;
            }
        }

        if (!empty($this->_error)) {
            return;
        }
        //print_r($this->_addData);

        //判断客户代码（即物流仓储企业）
        // if(!in_array($this->_param['customer_code'],$this->_customer['priv_customer_code_arr'])){
        //     $this->_error[] = '未绑定这个物流仓储企业，不能使用';
        // }

        //检查个人物品清单表里的交易单号是否存在
        // if(empty($this->_param['id'])){
        //     $tmpRow = Service_PersonItem::getByCondition(array('transaction_order_code'=>$this->_param['transactionOrderCode']));
        //     if($tmpRow){
        //         $this->_error[] = '交易单号已存在';
        //         return;
        //     }
        //     $tmpRow = Service_PersonItem::getByCondition(array('log_no'=>$this->_param['logNo']));
        //     if($tmpRow){
        //         $this->_error[] = '物流运单编号已存在';
        //         return;
        //     }
        // }
        if (isset($this->_param['pim_code']) && $this->_param['pim_code'] != '') {
            $personItem = Service_PersonItem::getByField($this->_param['pim_code'], 'pim_code');
            if (!empty($personItem)) {
                $this->_personRow = $personItem;
            }
        }

        $customer = Service_Customer::getByField($this->_param['customer_code'], 'customer_code');
        if (empty($customer)) {
            $this->_error[] = "电商企业{$this->_param['customer_code']}不存在";
        } else {
            if ($customer['is_ecommerce'] != '1') {
                $this->_error[] = "{$this->_param['customer_code']}不属于电商企业";
            }
            if ($customer['trade_name'] != $this->_param['enp_name']) {
                $this->_error[] = "电商企业名称{$this->_param['enp_name']}和注册的{$customer['trade_name']}不一致";
            }
            if ($customer['customer_status'] != '2') {
                $this->_error[] = "电商企业代码{$this->_param['customer_code']}暂未审核通过";
            }
        }
        $ebp = Service_Customer::getByField($this->_param['ebp_code'], 'customer_code');
        if(empty($ebp)){
            $this->_error[] = "电商平台代码{$this->_param['ebp_code']}不存在";
        }else{
            if(empty($this->_param['enp_name'])){
                $this->_error[] = "电商平台代码{$this->_param['ebp_code']}不存在";
            }else{
                if($this->_param['enp_name'] != $ebp['trade_name']){
                    $this->_error[] = "电商平台名称{$this->_param['enp_name']}和注册的{$customer['trade_name']}不一致";
                }
            }
        }

        //验证电商企业是否绑定报关企业
        $is_binding = Service_CustomerAgent::getByCondition(array('customer_code'=>$this->_param['customer_code'], 'agent_customer_code'=>$this->_param['agent_customer_code']));
        if(empty($is_binding)){
            $this->_error[] = '电商企业['.$this->_param['customer_code'].']未选择报关企业['.$this->_param['agent_customer_code'].']';
        }

        if (!preg_match("/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/i", $this->_param['buyer_id'])) {
            $this->_error[] = "订购人身份证格式不正确！";
        }
        if (!preg_match("/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/i", $this->_param['receive_id_number'])) {
            $this->_error[] = "收件人身份证格式不正确！";
        }

        $curr = Service_Currency::getByField($this->_param['currency'],'currency_code');
        if(empty($curr)){
            $this->_error[] = "币制不存在";
        }

        $logisticCustomer = Service_Customer::getByField($this->_param['logistic_customer_code'], 'customer_code');
        if (empty($logisticCustomer)) {
            $this->_error[] = "物流企业{$this->_param['logistic_customer_code']}不存在";
        } else {
            if ($logisticCustomer['is_shipping'] != '1') {
                $this->_error[] = "{$this->_param['logistic_customer_code']}不属于物流企业";
            }
            if ($logisticCustomer['customer_status'] != '2') {
                $this->_error[] = "物流企业代码{$this->_param['logistic_customer_code']}暂未审核通过";
            }
        }
		$accountInfo	= Service_Account::getByField($this->_param['account_code'], 'account_code');
        $sbcustomer = Service_Customer::getByField($accountInfo['customer_code'],'customer_code');
        if(!($sbcustomer['is_storage']=='1'||$sbcustomer['is_baoguan']=='1')){
            $this->_error[] = "子账号的企业必须是仓储和报关企业";
        }

        $validateRegex[] = array('name' => '邮编', 'value' => $this->_param['agent_post'], 'regex' => array('zip'));
        //$validateRegex[]=array('name'=>'收件人电话','value'=>$this->_param['receive_telphone'],'regex'=>array('phone_no'));
        $validateRegex[] = array('name' => '电话', 'value' => $this->_param['agent_tel'], 'regex' => array('phone_no'));
        $validateRegex[] = array('name' => '件数', 'value' => $this->_param['pack_no'], 'regex' => array('integerNoZero'));
        $validateRegex[] = array('name' => '净重', 'value' => $this->_param['net_wt'], 'regex' => array('positive1'));
        $validateRegex[] = array('name' => '毛重', 'value' => $this->_param['gross_wt'], 'regex' => array('positive1'));
        $validateRes = Common_Validator::formValidator($validateRegex);
        if (!empty($validateRes)) {
            $this->_error = array_merge($this->_error, $validateRes);
        }
        $payCustomer = Service_Customer::getByField($this->_param['pay_customer_code'], 'customer_code');
        if (empty($logisticCustomer)) {
            $this->_error[] = "支付企业{$this->_param['pay_customer_code']}不存在";
        } else {
            if ($payCustomer['is_pay'] != '1') {
                $this->_error[] = "{$this->_param['pay_customer_code']}不属于支付企业";
            }
            if ($payCustomer['customer_status'] != '2') {
                $this->_error[] = "{$this->_param['pay_customer_code']}暂未审核通过";
            }
        }
        //判断仓租企业
        //storage_customer_code
        $storageCustomer = Service_Customer::getByField($this->_param['storage_customer_code'], 'customer_code');
        if (empty($storageCustomer)) {
            $this->_error[] = "仓储企业{$this->_param['storage_customer_code']}不存在";
        } else {
            if ($storageCustomer['is_storage'] != '1') {
                $this->_error[] = "{$this->_param['storage_customer_code']}不属于仓储企业";
            }
            if ($storageCustomer['customer_status'] != '2') {
                $this->_error[] = "{$this->_param['storage_customer_code']}暂未审核通过";
            }
            if ($storageCustomer['is_baoguan'] != '1') {
                //$this->_error[] = "电商企业代码{$this->_param['customer_code']}不是报关企业";
            }
        }
        if($this->_param['declare_ie_port']=='0208'){
            $trafeMode = Service_TrafMode::getByField($this->_param['traf_mode']);
            if($trafeMode['traf_mode']!='7'){
                $this->_error[] = '保税区运输方式只能是7(保税区)';
            }
        }
        if($this->_param['declare_ie_port']=='0213'){
            $trafeMode = Service_TrafMode::getByField($this->_param['traf_mode']);
            if($trafeMode['traf_mode']!='Y'){
                $this->_error[] = '东疆运输方式只能是Y(保税港区)';
            }
        }
        $country = Service_Country::getByField($this->_param['outset_country_id'],'country_id');
        if($country['trade_country']!='142'){
            $this->_error[] = '启运国只能是中国';
        }
        if ($this->_param['form_type'] != 'E2A') {
            $this->_error[] = '个人物品清单业务类型必须为E2A';
        }
        $orderCondition = array(
            'customer_code' => $this->_param['customer_code'],
            'reference_no' => $this->_param['reference_no'],
        );
        $orders = Service_Orders::getByCondition($orderCondition, '*', 1, 1);
        if (empty($orders)) {
            $this->_error[] = "客户订单号{$this->_param['reference_no']}不存在";
        } else {
            if (!($orders[0]['order_status'] == '0' || $orders[0]['order_status'] == '2')) {
                $this->_error[] = "订单{$this->_param['reference_no']}不为草稿或异常状态";
            }
            //身份证验证
            if ($orders[0]['id_check_status'] != '1') {
                $this->_error[] = "订单{$this->_param['reference_no']}身份证尚未验证通过";
            }
            $personItem = Service_PersonItem::getByField($orders[0]['order_code'], 'order_code');
            //修改时候
            if (isset($this->_param['pim_code']) && $this->_param['pim_code'] != '') {
                //var_dump('sss');
                if ($personItem['pim_code'] != $this->_personRow['pim_code']) {
                    $this->_error[] = "订单{$this->_param['reference_no']}已关联物品清单{$personItem['pim_reference_no']}";
                }
            } else {
                //创建时候
                if (!empty($personItem)) {
                    $this->_error[] = "订单{$this->_param['reference_no']}已关联物品清单{$personItem['pim_reference_no']}";
                }
            }
            $this->_param['order_code'] = $orders[0]['order_code'];
            $this->_param['order_id'] = $orders[0]['order_id'];
            $this->_orderRow = $orders[0];
        }
        $waybillCondition = array(
            'logistic_customer_code' => $this->_param['logistic_customer_code'],
            'log_no' => $this->_param['log_no'],
        );
        $waybills = Service_Waybill::getByCondition($waybillCondition, '*', 1, 1);
        if (empty($waybills)) {
            $this->_error[] = "运单号:{$this->_param['log_no']}不存在";
        } else {
            if (!($waybills[0]['wb_status'] == '1' || $waybills[0]['wb_status'] == '3')) {
                $this->_error[] = '运单不为草稿或异常状态';
            }
            $personItem = Service_PersonItem::getByField($waybills[0]['wb_code'], 'wb_code');
            //修改时候
            if (isset($this->_param['pim_code']) && $this->_param['pim_code'] != '') {
                if ($personItem['pim_code'] != $this->_personRow['pim_code']) {
                    $this->_error[] = "运单{$this->_param['log_no']}已关联物品清单{$personItem['pim_reference_no']}";
                }
            } else {
                //创建时候
                if (!empty($personItem)) {
                    $this->_error[] = "运单{$this->_param['log_no']}已关联物品清单{$personItem['pim_reference_no']}";
                }
            }
            if($orders[0]['reference_no']!=$waybills[0]['reference_no']){
            	$this->_error[] = "订单号{$orders[0]['reference_no']}和运单的订单号{$waybills[0]['reference_no']}不一致";
            }
            $this->_param['wb_code'] = $waybills[0]['wb_code'];
            $this->_param['wb_id'] = $waybills[0]['wb_id'];
            $this->_waybillRow = $waybills[0];
        }
        $payCondition = array(
            'pay_no' => $this->_param['pay_no'],
            'customer_code' => $this->_param['customer_code'],
        );
        $payOrders = Service_PayOrder::getByCondition($payCondition, '*', 1, 1);
        //print_r($payOrders);
        if (empty($payOrders)) {
            $this->_error[] = "支付单号{$this->_param['pay_no']}不存在";
        } else {
            if (!($payOrders[0]['status'] == '1' || $payOrders[0]['status'] == '3')) {
                $this->_error[] = '支付单不为草稿或异常状态';
            }
            $personItem = Service_PersonItem::getByField($payOrders[0]['po_code'], 'po_code');
            //修改时候
            if (isset($this->_param['pim_code']) && $this->_param['pim_code'] != '') {
                if ($personItem['pim_code'] != $this->_personRow['pim_code']) {
                    $this->_error[] = "支付单{$this->_param['pay_no']}已关联物品清单{$personItem['pim_reference_no']}";
                }
            } else {
                //创建时候
                if (!empty($personItem)) {
                    $this->_error[] = "支付单{$this->_param['pay_no']}已关联物品清单{$personItem['pim_reference_no']}";
                }
            }
            if($orders[0]['reference_no']!=$payOrders[0]['reference_no']){
            	$this->_error[] = "订单号{$orders[0]['reference_no']}和支付单的订单号{$payOrders[0]['reference_no']}不一致";
            }
            $this->_param['po_code'] = $payOrders[0]['po_code'];
            $this->_param['po_id'] = $payOrders[0]['po_id'];
            $this->_payRow = $payOrders[0];
        }
        if ($this->_param['gross_wt'] != '' || $this->_param['net_wt'] != '') {
            if ($this->_param['gross_wt'] <= $this->_param['net_wt']) {
                $this->_error[] = '毛重必须大于净重';
            }
        }
        //查看税费担保
        $taxCondition = array(
            'customer_code' => $this->_param['customer_code'],
            'status' => '4',
            'data_status' => '1',
        );
        $gusTax = Service_TaxationGuarantee::getByCondition($taxCondition, '*', 1, 1);
        if (empty($gusTax)) {
            $this->_error[] = "电商{$this->_param['customer_code']}未做税费担保";
        }

        //处理商品
        $gNoArr = array();
        foreach ($this->_param['product'] as $key => $value) {
            $registerID = $value['registerID'];
            $product = Service_Product::getByField($registerID, 'registerID');
            if (in_array($value['g_no'], $gNoArr)) {
                $this->_error[] = "商品序号{$value['g_no']}重复";
            }
            if (empty($product)) {
                $this->_error[] = "备案编号{$registerID}不存在";
            } else {
                if ($product['customer_code'] != $this->_param['customer_code']) {
                    $this->_error[] = "产品的电商企业代码和所填的电商{$this->_param['customer_code']}不一致";
                } else {
                    $this->_param['product'][$key]['product_id'] = $product['product_id'];
                }
                if ($product['product_status'] != '1') {
                    $this->_error[] = "商品{$product['registerID']}暂未备案通过";
                }
            }
            //校验商品的g_uint
            if (empty($value['g_uint'])) {
                $this->_error[] = "商品{$product['registerID']}申报单位不能为空";
            } else {
                $uom = Service_ProductUom::getByField($value['g_uint'], 'pu_code');
                if (empty($uom)) {
                    $this->_error[] = "商品{$product['registerID']}申报单位不存在";
                }
            }
            if (empty($value['country'])) {
                $this->_error[] = "商品{$product['registerID']}国家不能为空";
            } else {
                $country = Service_Country::getByField($value['country'], 'country_code');
                if (empty($country)) {
                    $this->_error[] = "商品{$product['registerID']}国家不存在";
                }
            }
        }

        // //检查订单表里的交易单号是否存在
        // $order = Service_Orders::getByCondition(array('reference_no'=>$this->_param['transactionOrderCode'],'customer_code'=>$this->_param['customerCode']));
        // if(!$order){
        //     $this->_error[] = '交易单订单号不存在';
        // }else{
        //     $this->_addData['order_code'] = $order[0]['order_code'];
        // }
    }

    public function create($is_api = false)
    {
        $return = array('ask' => 0, 'message' => '操作失败', 'error' => array());
        $this->check();
        if (!empty($this->_error)) {
            $return['error'] = $this->_error;
            return $return;
        }
        if ($is_api) {
            $pil_comments = '添加物品清单';
        } else {
            $pil_comments = '添加物品清单';
        }
        $data = $this->_param;
        $dateTime = date('Y-m-d H:i:s', time());
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $find = Service_PersonItem::getByCondition(array('pim_reference_no'=>$this->_param['pim_reference_no'],'storage_customer_code'=>$this->_param['storage_customer_code']));
            if(!empty($find)){
                throw new Exception('清单内部编号已存在！');
            }
            $rowPersonalItems = array(
                'pim_reference_no' => $this->_param['pim_reference_no'],
                'form_type' => $this->_param['form_type'],
                'order_reference_no' => $this->_param['reference_no'],
                'customer_code' => $this->_param['form_type'],
                'customer_code' => $this->_param['customer_code'],
                'enp_name' => $this->_param['enp_name'],
                'storage_customer_code' => $this->_param['storage_customer_code'],
                'storage_name' => $this->_param['storage_name'],
                'agent_customer_code' => $this->_param['agent_customer_code'],
                'agent_name' => $this->_param['agent_name'],
                'order_code' => $this->_param['order_code'],
                'logistic_customer_code' => $this->_param['logistic_customer_code'],
                'account_code' => $this->_param['account_code'],
                'pay_customer_code' => $this->_param['pay_customer_code'],
                'wb_code' => $this->_param['wb_code'],
                'log_no' => $this->_param['log_no'],
                'pay_no' => $this->_param['pay_no'],
                'po_code' => $this->_param['po_code'],
                'wrap_type' => $this->_param['wrap_type'],
                'ie_port' => $this->_param['ie_port'],
                'traf_mode' => $this->_param['traf_mode'],
                'ie_port' => $this->_param['ie_port'],
                'declare_ie_port' => $this->_param['declare_ie_port'],
                'ship_trade_country_id' => $this->_param['ship_trade_country'],
                'ship_name' => $this->_param['ship_name'],
                'ship_city' => $this->_param['ship_city'],
                'declare_no' => $this->_param['declare_no'],
                'outset_country_id' => $this->_param['outset_country_id'],
                'aim_country_id' => $this->_param['aim_country_name'],
                'receive_name' => $this->_param['receive_name'],
                'receive_name' => $this->_param['receive_name'],
                'receive_telphone' => $this->_param['receive_telphone'],
                'receive_country_id' => $this->_param['receive_country_name'],
                'receive_state' => $this->_param['receive_state'],
                'receive_city' => $this->_param['receive_city'],
                'receive_id_number' => $this->_param['receive_id_number'],
                'input_company' => $this->_param['input_company'],
                'agent_address' => $this->_param['agent_address'],
                'agent_post' => $this->_param['agent_post'],
                'agent_tel' => $this->_param['agent_tel'],
                'freight' => $this->_param['freight'],
                'insure_fee' => $this->_param['insure_fee'],
                'customs_field' => $this->_param['customs_field'],
                'input_no' => $this->_param['input_no'],
                'net_wt' => $this->_param['net_wt'],
                'gross_wt' => $this->_param['gross_wt'],
                'pack_no' => $this->_param['pack_no'],
                'note' => $this->_param['note'],
                'i_e_date' => $this->_param['i_e_date'],
                'input_date' => $this->_param['input_date'],
                'declare_date' => $this->_param['declare_date'],
                'receiving_address' => $this->_param['receiving_address'],
                'customs_status' => '1',
                'pim_add_time' => date('Y-m-d H:i:s', time()),
                'ebp_code' => $this->_param['ebp_code'],
                'ebp_name' => $this->_param['ebp_name'],
                'buyer_id' => $this->_param['buyer_id'],
                'buyer_id_type' => $this->_param['buyer_id_type'],
                'buyer_name' => $this->_param['buyer_name'],
                'currency' => $this->_param['currency'],
            );

            $prefix = $this->_param['declare_ie_port'] . date("Y") . "I";

            $pim_code = Common_GetNumbers::getCode('personItem', 9, $prefix, '物品清单code');
            $rowPersonalItems['pim_code'] = $pim_code;

            //print_r($rowPersonalItems);

            /*echo $pim_code;

            print_r($rowPersonalItems);

             */

            //print_r($this->_param);

            $pimId = Service_PersonItem::add($rowPersonalItems);
            foreach ($data['product'] as $key => $value) {
                $rowPersonItemProduct = array(
                    "pim_id" => $pimId,
                    'pim_code' => $pim_code,
                    'product_id' => $value['product_id'],
                    'registerID' => $value['registerID'],
                    'g_no' => $value['g_no'],
                    'goods_id' => $value['goods_id'],
                    'hs_code' => $value['hs_code'],
                    //'gt_code' => $value['gt_code'],
                    'g_name_cn' => $value['g_name_cn'],
                    "g_model" => $value['g_model'],
                    "g_qty" => $value['g_qty'],
                    'g_uint' => $value['g_uint'],
                    'price' => $value['price'],
                    'total_price' => $value['price'] * $value['g_qty'],
                    'curr' => $value['curr'],
                    'country' => $value['country'],
                    'ciq_g_no' => $value['ciq_g_no'],
                    'qty_1' => $value['qty_1'],
                    'unit_1' => $value['unit_1'],
                    'qty_2' => $value['qty_2'],
                    'unit_2' => $value['unit_2'],
                );
                Service_PersonItemProduct::add($rowPersonItemProduct);
            }
            //添加物品清单日志
            $personItemLog = array(
                'pim_id' => $pimId,
                'pim_code' => $pim_code,
                'pim_status_from' => '1',
                'pim_status_to' => '1',
                'pil_add_time' => $dateTime,
                'user_id' => '-1',
                'pil_ip' => Common_Common::getIP(),
                'pil_comments' => $pil_comments, //'添加物品清单',
                'account_name' => '',
            );
            Service_PersonItemLog::add($personItemLog);
            //添加订单日志
            $orderRow = array(
                'order_status' => '1',
                'update_time' => $dateTime,
            );
            if (!Service_Orders::update($orderRow, $this->_param['order_code'], 'order_code')) {
                throw new Exception('关联订单失败');
            } else {
                //添加订单日志
                $orderLogRow = array(
                    'order_id' => $this->_param['order_id'],
                    'order_code' => $this->_param['order_code'],
                    'ol_type' => '0',
                    'order_status_from' => '0',
                    'order_status_to' => '1',
                    'ol_add_time' => $dateTime,
                    'user_id' => '-1',
                    'ol_ip' => Common_Common::getIP(),
                    'ol_comments' => '物品清单关联订单',
                    'account_name' => isset($this->_param['account_name']) ? $this->_param['account_name'] : '',
                );
                Service_OrderLog::add($orderLogRow);
            }
            $waybillRow = array(
                'app_status' => '2',
                'wb_update_time' => $dateTime,
            );
            if (!Service_Waybill::update($waybillRow, $this->_param['wb_id'])) {
                throw new Exception('关联运单失败');
            } else {
                //添加运单日志
                $waybillLogRow = array(
                    'wb_id' => $this->_param['wb_id'],
                    'wb_code' => $this->_param['wb_code'],
                    'wb_status_from' => '1',
                    'wb_status_to' => '2',
                    'wb_add_time' => $dateTime,
                    'user_id' => '-1',
                    'wb_ip' => Common_Common::getIP(),
                    'wb_comments' => '物品清单关联运单',
                    'account_name' => isset($this->_param['account_name']) ? $this->_param['account_name'] : '',
                );
                Service_WaybillLog::add($waybillLogRow);
            }
            $payRow = array(
                'app_status' => '2',
                'update_time' => $dateTime,
            );
            if (!Service_PayOrder::update($payRow, $this->_param['po_id'])) {
                throw new Exception('关联支付单失败');
            } else {
                //支付单日志
                $payLogRow = array(
                    'po_id' => $this->_param['po_id'],
                    'po_code' => $this->_param['po_code'],
                    'pl_status_from' => '1',
                    'pl_status_to' => '2',
                    'pl_add_time' => $dateTime,
                    'user_id' => '-1',
                    'pl_ip' => Common_Common::getIP(),
                    'pl_comments' => '物品清单关联支付单',
                    'account_name' => isset($this->_param['account_name']) ? $this->_param['account_name'] : '',
                );
                Service_PayOrderLog::add($payLogRow);
            }

            $db->commit();
            //$db->rollback();
            $return['ask'] = 1;
            $return['message'] = '添加成功';
            $return['pimCode'] = $pim_code;
        } catch (Exception $e) {
            $db->rollback();
            $return['error'][] = $e->getMessage();
        }
        //
        return $return;
    }

    /**
     * @author william-fan
     * @todo 用于修改个人物品清单
     */
    public function updateProcess($is_api = false, $pim_code)
    {
        $return = array('ask' => 0, 'message' => '操作失败', 'error' => array());
        $this->check();
        if (!empty($this->_error)) {
            $return['error'] = $this->_error;
            return $return;
        }
        if ($is_api) {
            $pil_comments = 'API更新物品清单';
        } else {
            $pil_comments = '更新物品清单';
        }
        $data = $this->_param;
        $dateTime = date('Y-m-d H:i:s', time());
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            /*
            $find = Service_PersonItem::getByCondition(array($this->_param['pim_reference_no'],'storage_customer_code'=>$this->_param['storage_customer_code']));
            if(!empty($find)){
                throw new Exception('清单内部编号不对客户唯一！');
            }
            */
            if (empty($pim_code)) {
                throw new Exception('物品清单号为空,无法修改');
            }
            $pimRow = Service_PersonItem::getByField($pim_code, 'pim_code');
            if (empty($pimRow)) {
                throw new Exception('物品清单不存在,无法修改');
            }
            /*
            switch ($pimRow['customs_status']) {
                case '2':
                    break;
                case '7':
                    break;
                default:
                    throw new Exception("物品清单只有海关异常和审核不通过的才能重新申报");
            }
            */
            $rowPersonalItems = array(
                'form_type' => $this->_param['form_type'],
                //'order_reference_no' =>$this->_param['reference_no'],
                'customer_code' => $this->_param['form_type'],
                'customer_code' => $this->_param['customer_code'],
                'enp_name' => $this->_param['enp_name'],
                //'storage_customer_code'=>$this->_param['storage_customer_code'],
                //'storage_name'=>$this->_param['storage_name'],
                'agent_customer_code' => $this->_param['agent_customer_code'],
                'agent_name' => $this->_param['agent_name'],
                //'order_code' => $this->_param['order_code'],
                'logistic_customer_code' => $this->_param['logistic_customer_code'],
                'account_code' => $this->_param['account_code'],
                'pay_customer_code' => $this->_param['pay_customer_code'],
                //'wb_code'=>$this->_param['wb_code'],
                //'log_no'=>$this->_param['log_no'],
                //'pay_no'=>$this->_param['pay_no'],
                //'po_code'=>$this->_param['po_code'],
                'wrap_type' => $this->_param['wrap_type'],
                'ie_port' => $this->_param['ie_port'],
                'traf_mode' => $this->_param['traf_mode'],
                'ie_port' => $this->_param['ie_port'],
                'declare_ie_port' => $this->_param['declare_ie_port'],
                'ship_trade_country_id' => $this->_param['ship_trade_country'],
                'ship_name' => $this->_param['ship_name'],
                'ship_city' => $this->_param['ship_city'],
                'declare_no' => $this->_param['declare_no'],
                'outset_country_id' => $this->_param['outset_country_id'],
                'aim_country_id' => $this->_param['aim_country_name'],
                'receive_name' => $this->_param['receive_name'],
                'receive_name' => $this->_param['receive_name'],
                'receive_telphone' => $this->_param['receive_telphone'],
                'receive_country_id' => $this->_param['receive_country_name'],
                'receive_state' => $this->_param['receive_state'],
                'receive_city' => $this->_param['receive_city'],
                'receive_id_number' => $this->_param['receive_id_number'],
                'input_company' => $this->_param['input_company'],
                'agent_address' => $this->_param['agent_address'],
                'agent_post' => $this->_param['agent_post'],
                'agent_tel' => $this->_param['agent_tel'],
                'freight' => $this->_param['freight'],
                'insure_fee' => $this->_param['insure_fee'],
                'customs_field' => $this->_param['customs_field'],
                'input_no' => $this->_param['input_no'],
                'net_wt' => $this->_param['net_wt'],
                'gross_wt' => $this->_param['gross_wt'],
                'pack_no' => $this->_param['pack_no'],
                'note' => $this->_param['note'],
                'i_e_date' => $this->_param['i_e_date'],
                'input_date' => $this->_param['input_date'],
                'declare_date' => $this->_param['declare_date'],
                'receiving_address' => $this->_param['receiving_address'],
                //状态根据情况修改
                //'customs_status' => '1',
                'pim_add_time' => date('Y-m-d H:i:s', time()),
                'is_comparison' => '0',
                'pim_update_time' => date('Y-m-d H:i:s', time()),
                'ebp_code' => $this->_param['ebp_code'],
                'ebp_name' => $this->_param['ebp_name'],
                'buyer_id' => $this->_param['buyer_id'],
                'buyer_id_type' => $this->_param['buyer_id_type'],
                'buyer_name' => $this->_param['buyer_name'],
                'currency' => $this->_param['currency'],
            );

            /*
            $prefix = $this->_param['declare_ie_port'].date("Y")."I";
            $pim_code = Common_GetNumbers::getCode('personItem' , 9 , $prefix , '物品清单code');
            $personCondition = array(
            	'pim_id'=>$pimRow['pim_id'],
            );
            if($pimRow['pim_id']){
            	$personItemProduct = Service_PersonItemProduct::getByCondition($personCondition, '*');
            	foreach ($personItemProduct as $value) {
            		//是从审核不通过的修改要解冻库存
            		if ($pimRow['status'] == '7') {
            			$this->jdStock($value, $pimRow);
            		}
            	}
            }
            */

            //新旧数据对比更新
            self::distinguishUpdate($pimRow, $rowPersonalItems);

            /*
            $pimId = $pimRow['pim_id'];
            if (!Service_PersonItem::update($rowPersonalItems, $pimId)) {
                throw new Exception('更新物品清单失败');
            }
            */

            //清单产品
            Service_PersonItemProduct::delete($pimRow['pim_id'], 'pim_id');
            foreach ($data['product'] as $key => $value) {
                $rowPersonItemProduct = array(
                    "pim_id" => $pimId,
                    'pim_code' => $pim_code,
                    'product_id' => $value['product_id'],
                    'registerID' => $value['registerID'],
                    'g_no' => $value['g_no'],
                    'goods_id' => $value['goods_id'],
                    'hs_code' => $value['hs_code'],
                    //'gt_code' => $value['gt_code'],
                    'g_name_cn' => $value['g_name_cn'],
                    "g_model" => $value['g_model'],
                    "g_qty" => $value['g_qty'],
                    'g_uint' => $value['g_uint'],
                    'price' => $value['price'],
                    'total_price' => $value['price'] * $value['g_qty'],
                    'curr' => $value['curr'],
                    'country' => $value['country'],
                    'ciq_g_no' => $value['ciq_g_no'],
                    'qty_1' => $value['qty_1'],
                    'unit_1' => $value['unit_1'],
                );
                if(!empty($value['qty_2'])){
                    $rowPersonItemProduct['qty_2'] = $value['qty_2'];
                }
                if(!empty($value['unit_2'])){
                    $rowPersonItemProduct['unit_2'] = $value['unit_2'];
                }
                $productInventoryObj = Service_PersonItemProduct::add($rowPersonItemProduct);
            }

            /*
            //添加物品清单日志
            $personItemLog = array(
                'pim_id' => $pimId,
                'pim_code' => $pim_code,
                'pim_status_from' => '1',
                'pim_status_to' => '1',
                'pil_add_time' => $dateTime,
                'user_id' => '-1',
                'pil_ip' => Common_Common::getIP(),
                'pil_comments' => $pil_comments,
                'account_name' => '',
            );
            Service_PersonItemLog::add($personItemLog);

            //添加订单日志
            $orderRow = array(
                'order_status' => '1',
                'update_time' => $dateTime,
            );
            if (!Service_Orders::update($orderRow, $this->_param['order_code'], 'order_code')) {
                throw new Exception('更新订单失败');
            } else {
                //添加订单日志
                $orderLogRow = array(
                    'order_id' => $this->_param['order_id'],
                    'order_code' => $this->_param['order_code'],
                    'ol_type' => '0',
                    'order_status_from' => $this->_orderRow['order_status'],
                    'order_status_to' => '1',
                    'ol_add_time' => $dateTime,
                    'user_id' => '-1',
                    'ol_ip' => Common_Common::getIP(),
                    'ol_comments' => '重新提交物品清单,订单回退到已关联',
                    'account_name' => isset($this->_param['account_name']) ? $this->_param['account_name'] : '',
                );
                Service_OrderLog::add($orderLogRow);
            }
            $waybillRow = array(
                'app_status' => '2',
                'wb_update_time' => $dateTime,
            );
            if (!Service_Waybill::update($waybillRow, $this->_param['wb_id'])) {
                throw new Exception('关联运单失败');
            } else {
                //添加运单日志
                $waybillLogRow = array(
                    'wb_id' => $this->_param['wb_id'],
                    'wb_code' => $this->_param['wb_code'],
                    'wb_status_from' => $this->_waybillRow['app_status'],
                    'wb_status_to' => '2',
                    'wb_add_time' => $dateTime,
                    'user_id' => '-1',
                    'wb_ip' => Common_Common::getIP(),
                    'wb_comments' => '重新提交物品清单,运单回退到已关联',
                    'account_name' => isset($this->_param['account_name']) ? $this->_param['account_name'] : '',
                );
                Service_WaybillLog::add($waybillLogRow);
            }
            $payRow = array(
                'app_status' => '2',
                'update_time' => $dateTime,
            );
            if (!Service_PayOrder::update($payRow, $this->_param['po_id'])) {
                throw new Exception('关联支付单失败');
            } else {
                //支付单日志
                $payLogRow = array(
                    'po_id' => $this->_param['po_id'],
                    'po_code' => $this->_param['po_code'],
                    'pl_status_from' => '1',
                    'pl_status_to' => '2',
                    'pl_add_time' => $dateTime,
                    'user_id' => '-1',
                    'pl_ip' => Common_Common::getIP(),
                    'pl_comments' => '重新提交物品清单,支付单回退到已关联',
                    'account_name' => isset($this->_param['account_name']) ? $this->_param['account_name'] : '',
                );
                Service_PayOrderLog::add($payLogRow);
            }
            */
            $db->commit();
            //$db->rollback();
            $return['ask'] = 1;
            $return['message'] = '重新提交成功';
            $return['pimCode'] = $pim_code;
        }catch (Exception $e) {
            $db->rollback();
            $return['error'][] = $e->getMessage();
        }
        return $return;
    }

    public function choiceProduct($orderPorductRow, $ie_type = '', $ie_port = '')
    {
        // print_r($orderPorductRow);die();
        $result = array(
            "ask" => 0,
            "message" => '物品清单创建失败！',
            'error' => array(),
        );
        $error = $newOrderPorductRow = array();
        $newOrderPorductRow = $orderPorductRow;
        $registerID = trim($orderPorductRow['registerID']);
        $goodsId = $orderPorductRow['goods_id'];
        $productRow = Service_Product::getByField($registerID, 'registerID');
        $newOrderPorductRow['product_id'] = $productRow['product_id'];

        if (empty($productRow)) {
            $error[] = $goodsId . '商品不存在！';
        }

        if ($ie_type != '' && $productRow['ie_type'] != $ie_type) {
            $error[] = $goodsId . '进出口类型不正确！';
        }

        if ($ie_port != '' && $productRow['customs_code'] != $ie_port) {
            $error[] = $goodsId . '主管海关代码不正确！';
        }

        if (!isset($orderPorductRow['g_uint'])) {
            $error[] = $goodsId . '计量单位不能为空！';
        } elseif ($orderPorductRow['g_uint'] != $productRow['pu_code']) {
            /*$productUomRows = Common_DataCache::getProductUomCode();
        foreach ($productUomRows as  $productUomRow) {
        if($productUomRow['name'] == $orderPorductRow['g_uint']){
        $newOrderPorductRow['g_uint'] = $puCode = $productUomRow['code'];
        $newOrderPorductRow['g_uint_name'] = $productUomRow['name'];
        }
        }
        if($newOrderPorductRow['g_uint'] != $productRow['g_unit']){
        $error[]   =   $goodsId.'计量单位和申报的不一致！';
         */
        }
        if (!is_numeric($orderPorductRow['qty_1']) || ($orderPorductRow['qty_1'] < 0.00001)) {
            $error[] = $goodsId . "法定数量不是有效的数字！";
        }

        $unit_1 = Service_ProductUom::getByField($orderPorductRow['unit_1'],'pu_code');
        if(empty($unit_1)){
            $error[] = $goodsId.'法定计量单位不存在';
        }

        if(!empty($orderPorductRow['qty_2'])){
            if (!is_numeric($orderPorductRow['qty_2']) || ($orderPorductRow['qty_2'] < 0.00001)) {
                $error[] = $goodsId . "第二数量不是有效的数字！";
            }
        }

        if(!empty($orderPorductRow['unit_2'])){
            $unit_2 = Service_ProductUom::getByField($orderPorductRow['unit_2'],'pu_code');
            if(empty($unit_2)){
                $error[] = $goodsId.'第二计量单位不存在';
            }
        }

        if ($orderPorductRow['hs_code'] != $productRow['hs_code']) {
            $error[] = $goodsId . "商品海关编码不正确！";
        }
		if (empty($orderPorductRow['g_name_cn'])) {
            $error[] = $goodsId . "商品海关品名不能为空！";
        }
		/*
		if ($orderPorductRow['g_name_cn'] != $productRow['hs_goods_name']) {
            $error[] = $goodsId . "商品海关品名不正确！";
        }
		*/
        if ($orderPorductRow['g_model'] != $productRow['product_model']) {
            $error[] = $goodsId . "商品规格不正确！";
        }

        if (trim($orderPorductRow['curr']) != $productRow['currency_code']) {
            $error[] = $goodsId . "币制不正确！";
        }
        if (!is_numeric($orderPorductRow['g_qty']) || ($orderPorductRow['g_qty'] <= 0)) {
            $error[] = $goodsId . "成交数量不是有效的数字！";
        }

        if (!preg_match("/^\d+(\.[\d]{0,2})?$/", $orderPorductRow['price'])) {
            $error[] = $goodsId . "成交单价不是一个有效的货币数值！";
        }
        /*if(!preg_match("/^\d+(\.[\d]{0,2})?$/",$orderPorductRow['total_price'])){
        $error[] = $goodsId."成交总价不是一个有效的货币数值！";
         */
        if (!empty($error)) {
            $result['error'] = $error;
        } else {
            $result['ask'] = 1;
            $result['orderPorductRow'] = $newOrderPorductRow;
        }
        return $result;
    }
    public function getProduct($goodsId)
    {
        $result = array(
            "ask" => 0,
            "message" => '物品清单创建失败！',
            'error' => array(),
        );
        try {
            $inventory = Service_ProductInventory::getByField($goodsId, 'goods_id');
            if (empty($inventory)) {
                throw new Exception('对应底账料件号[' . $goodsId . ']不存在');
            }
            $productRow = Service_Product::getByField($inventory['cus_goods_id'], 'registerID');
            if (empty($productRow)) {
                throw new Exception('对应底账料件号[' . $goodsId . ']不存在');
            }
            $uom = Service_ProductUom::getByField($productRow['g_unit'], 'pu_code');
            $country = Service_Country::getByField($productRow['country_code_of_origin'], 'country_code');
            $newOrderPorductRow = array(
                'registerID' => $productRow['registerID'],
                'product_id' => $productRow['product_id'],
                //'gt_code' => $productRow['gt_code'],
                'hs_code' => $productRow['hs_code'],
                'g_name_cn' => $productRow['hs_goods_name'],
                'g_model' => $productRow['product_model'],
                'g_uint' => $productRow['g_unit'],
                'g_uint_name' => $uom['pu_name'],
                'country' => $productRow['country_code_of_origin'],
                'countryName' => $country['country_name'],
                'goods_id' => $inventory['goods_id'],
            );

        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
        if (!empty($error)) {
            $result['error'] = $error;
        } else {
            $result['ask'] = 1;
            $result['orderPorductRow'] = $newOrderPorductRow;
        }
        return $result;
    }

    /**
     * @todo 解冻库存
     * $rowPersonItemProduct
     */
    public function jdStock($value, $pimRow)
    {
        //解冻库存
		$condition = array(
			'customer_code'=>$pimRow['storage_customer_code'],
			'warehouse_status'=>'5',
			'ie_type'=>'I',
		);
        $warehouseInfos = Service_Warehouse::getByCondition($condition,'*');
		if (empty($warehouseInfos)) {
            throw new Exception('未找到对应账册信息');
        }
        $param = array(
            'operationType' => 3, //物品清单审核失败
            'quantity' => $value['g_qty'],
            'goodsId' => $value['goods_id'],
            'warehouseCode' => $warehouseInfos[0]['warehouse_code'],
            'note' => '物品清单解冻库存！',
        );
        $productInventoryObj = new Service_ProductInventoryProcess();
        $result = $productInventoryObj->update($param);
        if ($result['state'] == '0') {
            throw new Exception('库存更新失败:' . $result['message']['errorMse']);
        }
    }

    /**
     * [distinguishUpdate 不同情况分别更新]
     * @param  [type] $old_row      [description]
     * @param  [type] $new_row      [description]
     * @return [type]               [description]
     */
    private static function distinguishUpdate($old_row, $new_row){
        $ask = false;
        //检疫已放行，海关审核未通过，整体状态审核未通过
        if(in_array($old_row['ciq_status'], array(6)) && in_array($old_row['customs_status'], array(7)) && in_array($old_row['status'], array(7))){
            self::customsNopassUpdate($old_row, $new_row);
            $ask = true;
        }
        //全部都审核不通过
        if(in_array($old_row['ciq_status'], array(7)) && in_array($old_row['customs_status'], array(7)) && in_array($old_row['status'], array(7))){
            self::allNopassUpdate($old_row, $new_row);
            $ask = true;
        }
        //检疫审核不通过，海关作废，总状态审核不通过
        if(in_array($old_row['ciq_status'], array(7)) && in_array($old_row['customs_status'], array(4)) && in_array($old_row['status'], array(7))){
            self::customsVoidUpdate($old_row, $new_row);
            $ask = true;
        }
        //检疫审核不通过，海关审核通过，总状态审核不通过
        if(in_array($old_row['ciq_status'], array(7)) && in_array($old_row['customs_status'], array(6)) && in_array($old_row['status'], array(7))){
            self::ciqNopassUpdate($old_row, $new_row);
            $ask = true;
        }
        if($ask == false){
            throw new Exception('物品清单['.$old_row['pim_code'].']状态不允许修改');
        }
    }

    /**
     * [customsNopassUpdate 检疫已放行，海关审核未通过，整体状态审核未通过]
     * @param  [type] $old_row [description]
     * @param  [type] $new_row [description]
     * @return [type]          [description]
     */
    private static function customsNopassUpdate($old_row, $new_row){
        //修改字段
        $update_arr = self::getUpdateField($old_row, $new_row);
        if(empty($update_arr)){
            throw new Exception('物品清单['.$old_row['pim_code'].']未做任何修改');
        }

        //海关修改
        $customs_flag = self::isHaveField($update_arr, self::getSetFields('person_item', 1));
        //检疫修改
        $ciq_flag = self::isHaveField($update_arr, self::getSetFields('person_item', 2));

        //只修改海关
        if($customs_flag == true &&  $ciq_flag == false){

        //只修改检疫
        }else if($customs_flag == false && $ciq_flag == true){

        //海关检疫都修改
        }else if($customs_flag == true && $ciq_flag == true){

        }
    }
    /**
     * [allNopassUpdate 全部都审核不通过]
     * @param  [type] $old_row [description]
     * @param  [type] $new_row [description]
     * @return [type]          [description]
     */
    private static function allNopassUpdate($old_row, $new_row){}
    /**
     * [customsVoidUpdate 检疫审核不通过，海关作废，总状态审核不通过]
     * @param  [type] $old_row [description]
     * @param  [type] $new_row [description]
     * @return [type]          [description]
     */
    private static function customsVoidUpdate($old_row, $new_row){}
    /**
     * [ciqNopassUpdate 检疫审核不通过，海关审核通过，总状态审核不通过]
     * @param  [type] $old_row [description]
     * @param  [type] $new_row [description]
     * @return [type]          [description]
     */
    private static function ciqNopassUpdate($old_row, $new_row){}


    /**
     * [getUpdateField 获取修改字段数组]
     * @param  [type] $old_row [原始数据]
     * @param  [type] $new_row [修改完数据]
     * @return [type]          [修改过的字段数组]
     */
    private static function getUpdateField($old_row, $new_row){
        $update_arr = array();
        $no_check_arr = array();
        if(!empty($new_row) && is_array($new_row)){
            foreach ($new_row as $key => $row) {
                //排除不更新的
                if(!in_array($key, $no_check_arr)){
                    //有变化
                    if(strcasecmp(trim($row), trim($old_row[$key]))){
                        $update_arr[] = $key;
                    }
                }
            }
        }
        return $update_arr;
    }

    /**
     * [getSetFields 返回配置字段]
     * @param  string  $table_name [表名]
     * @param  integer $filed_type [字段类型]
     * @return [type]              [配置字段数组一维]
     */
    private static function getSetFields($table_name='person_item', $filed_type = 1){
        $fields = Service_FieldSetting::getByCondition(array('table_name'=>$table_name, 'filed_type'=>$filed_type));
        if(!empty($fields) && is_array($fields)){
            $return = array();
            foreach ($fields as $field) {
                $return[] = $field;
            }
            return $return;
        }else {
            return false;
        }
    }

    /**
     * [isUpdateField 检测是否有修改字段]
     * @param  [type]  $update_arr [description]
     * @param  [type]  $screen_arr [description]
     * @return boolean             [description]
     */
    private static function isHaveField($update_arr, $screen_arr){
        $count = count(array_intersect($update_arr, $screen_arr));
        return $count > 0 ? true : false;
    }
}
