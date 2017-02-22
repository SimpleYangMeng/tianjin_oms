<?php
class Service_GoodsListProcess
{
    protected $_error = array();
    protected $_param = null;
    public $_date = null;
    protected $_customerId = null;
    protected $_customer = null;
    protected $_addData = null;
    protected $_wayBillOrder = null;
    protected $_payOrder = null;
    protected $_order = null;

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
    public function setUser() {
        $session = new Zend_Session_Namespace("customerAuth");;
        $customer = $session->data;
        $this->_customerId = $customer['id'];;
        $this->_customer = $customer;
    }
    private function reset() {
        $this->_wayBillOrder = null;
        $this->_payOrder = null;
        $this->_order = null;

    }
    public static function getTitle() {
        return array(
            'gl_reference_no'=>'清单内部编号',
            'reference_no' =>'客户订单号',
            'form_type'=>'业务类型',
            'customer_code' =>'电商企业代码',
            'enp_name'=>'电商企业名称',
            'storage_customer_code'=>'仓储企业代码',
            'storage_name'=>'仓储企业名称',
            'agent_customer_code'=>'申报单位代码',
            'agent_name'=>'申报单位名称',
            'agent_address'=>'申报单位地址',
            'agent_post'=>'申报单位邮编',
            'agent_tel'=>'申报单位电话',
            'log_no'=>'运单号',
            'pay_no'=>'支付单号',
            'wrap_type' =>'外包装类型',
            'ie_port' =>'进出口岸',
            'declare_ie_port'=>'申报海关',
            'traf_mode' =>'出入港区运输方式',
            'traf_name'=>'运输工具名称',
            'declare_no'=>'保管员',
            'departure_or_destination_country'=>'启运国/抵运国',
            'input_company'=>'录入单位',
            'freight'=>'运费',
            'insure_fee'=>'保费',
            'customs_field'=>'监管场所代码',
            'input_no'=>'录入员',
            'net_weight'=>'净重',
            'gross_weight'=>'毛重',
            'pack_no'=>'件数',
            'note'=>'备注信息',
            'ie_date'=>'进出境日期',
            'input_date'=>'录入时间',
            'declare_date'=>'申报日期',
            'account_code'=>'操作人',
            'owner_code'=>'收发货人代码',
            'owner_name'=>'收发货人名称',
            'bill_no'=>'提运单号',
            'cus_license'=>'许可证号',
            'flight_or_voyage_number'=>'航班航次号',
            'filled_date'=>'填制日期',
            'port_of_departure'=>'指运港',
        );
    }

    public static function getMap() {
        return array(
            'gl_reference_no'=>'gl_reference_no',
            'reference_no' =>'reference_no',
            'form_type' =>'form_type',
            'customer_code' =>'customer_code',
            'enp_name'=>'enp_name',
            'storage_customer_code'=>'storage_customer_code',
            'storage_name'=>'storage_name',
            'agent_customer_code'=>'agent_customer_code',
            'agent_name'=>'agent_name',
            'agent_address'=>'agent_address',
            'agent_post'=>'agent_post',
            'agent_tel'=>'agent_tel',
            'log_no'=>'log_no',
            'pay_no'=>'pay_no',
            'ie_port' =>'ie_port',
            'declare_ie_port' =>'declare_ie_port',
            'wrap_type' =>'wrap_type',
            'traf_mode' =>'traf_mode',
            'traf_name' =>'traf_name',
            'declare_no'=>'declare_no',
            'departure_or_destination_country'=>'departure_or_destination_country',
            'input_company'=>'input_company',
            'freight'=>'freight',
            'insure_fee'=>'insure_fee',
            'customs_field'=>'customs_field',
            'input_no'=>'input_no',
            'net_weight'=>'net_weight',
            'gross_weight'=>'gross_weight',
            'pack_no'=>'pack_no',
            'note'=>'note',
            'ie_date'=>'ie_date',
            'input_date'=>'input_date',
            'declare_date'=>'declare_date',
            'account_code'=>'account_code',
            'owner_code'=>'owner_code',
            'owner_name'=>'owner_name',
            'bill_no'=>'bill_no',
            'cus_license'=>'cus_license',
            'flight_or_voyage_number'=>'flight_or_voyage_number',
            'filled_date'=>'filled_date',
            'port_of_departure'=>'port_of_departure',
        );
    }
    /**
     * @author william-fan
     * @todo 不判定是否匹配
     */
    public static function notcheck(){
        return array(
            'note',
            'insureFee',
            'freight'
        );
    }

    protected function check() {
        if(!$this->_param){
            $this->_error[] = '请填写清单信息';
            return;
        }
        if(!isset($this->_param['product']) && empty($this->_param['product'])){
            $this->_error[] = '请选择产品';
            return;
        }
        $title = self::getTitle();
        //print_r($title);exit;
        $map = self::getMap();
        foreach($map as $key=>$value) {
            if(!isset($this->_param[$key]) || is_null($this->_param[$key]) || (is_string($this->_param[$key]) && $this->_param[$key]==='')){
                /*if($key=='note'){
                }*/
                if(in_array($key,self::notcheck())){
                    continue;
                }
                $this->_error[] = $title[$key].'不能为空，请填上或选择';
            }
            $this->_addData[$value] = $this->_param[$key];
        }
        if(!empty($this->_error)){
            return;
        }

        $customer = Service_Customer::getByField($this->_param['customer_code'],'customer_code');
        if(empty($customer)){
            $this->_error[] = "电商企业{$this->_param['customer_code']}不存在";
        }else{
            if($customer['is_ecommerce']!='1'){
                $this->_error[] = "{$this->_param['customer_code']}不属于电商企业";
            }
            if($customer['trade_name']!=$this->_param['enp_name']){
                $this->_error[] = "电商企业名称{$this->_param['enp_name']}和注册的{$customer['customer_company_name']}不一致";
            }
        }
        $typeRows = Common_CommonConfig::getFormType('e');
        $type = array();
        foreach($typeRows as $value) {
            $type[] = $value['form_type'];
        }
        if(!in_array($this->_param['form_type'],$type)){
            $this->_error[] = '货物清单业务类型必须为出口类型';
        }
        //检测客户订单号是否已创建货物清单
        $goodsList = Service_GoodsList::getByCondition(array('order_reference_no'=>$this->_param['reference_no']));

        $orderCondition = array(
            'customer_code'=>$this->_param['customer_code'],
            'reference_no'=>$this->_param['reference_no'],
        );
        $orders = Service_Orders::getByCondition($orderCondition,'*',1,1);
        $typeRows = Common_CommonConfig::getFormType('e');
        $type = array();
        foreach($typeRows as $value) {
            $type[] = $value['form_type'];
        }
        if(empty($orders)){
            $this->_error[] = "客户订单号{$this->_param['reference_no']}不存在";
        }else{
            if($orders[0]['order_status']!='0'){
                $this->_error[] = "订单{$this->_param['reference_no']}不为草稿状态";
            }
            if(!in_array($orders[0]['ie_type'],$type)) {
                $this->_error[] = "订单{$this->_param['reference_no']}不是出口类型订单";
            }
            //身份证验证
            if($orders[0]['id_check_status']!='1'){
                $this->_error[] = "订单{$this->_param['reference_no']}身份证尚未验证通过";
            }
            $this->_order = $orders[0];
        }
        //有订单号才去查询
        if($this->_order) {
            //检测客户订单号是否已创建货物清单
            /*$goodsList = Service_GoodsList::getByCondition(array('order_reference_no'=>$this->_param['reference_no']));
            if($goodsList) {
                $this->_error[] = "客户订单号{$this->_param['reference_no']}已创建货品清单";
            }*/
            $waybillCondition = array(
                'log_no'=>$this->_param['log_no'],
                //'order_code'=>$this->_order['order_code'],
            );
            $waybills =Service_Waybill::getByCondition($waybillCondition,'*',1,1);
            if(empty($waybills)){
                $this->_error[] = "运单号:{$this->_param['log_no']}不存在";
            }else{
                if($waybills[0]['order_code'] != $this) {

                }
                if($waybills[0]['wb_status']!='1'){
                    $this->_error[] = '运单不为草稿状态';
                }
                if($waybills[0]['ie_type']!='BE'){
                    $this->_error[] = '运单类型不是出口';
                }
                $this->_wayBillOrder = $waybills[0];
            }
            $payCondition = array(
                'pay_no'=>$this->_param['pay_no'],
                'customer_code'=>$this->_param['customer_code'],
                //'order_code'=>$this->_order['order_code'],
            );
            $payOrders = Service_PayOrder::getByCondition($payCondition,'*',1,1);
            //print_r($payOrders);
            if(empty($payOrders)){
                $this->_error[] = "支付单号{$this->_param['pay_no']}不存在";
            }else{
                if($payOrders[0]['status']!=1){
                    $this->_error[] = '支付单不为草稿状态';
                }
                $this->_payOrder = $payOrders[0];
            }
        }
        if($this->_param['gross_weight']!=''||$this->_param['net_weight']!=''){
            if($this->_param['gross_weight']<=$this->_param['net_weight']){
                $this->_error[] = '毛重必须大于净重';
            }
        }
        //处理商品
        $gNoArr = array();

        //取出默认的产品excel的字段
        $detailField = $this->getDetailField();
        $detailField = array_flip($detailField);

        foreach($this->_param['product'] as $key=>$value){
            $tp = array_merge($detailField,$value);
            $tp['customer_code'] = $this->_param['customer_code'];
            $result = $this->choiceProduct($tp,'E','',true);
            if($result['ask']==0){
                $this->_error = array_merge($this->_error,$result['error']);
                continue;
            }
            if(in_array($value['g_no'],$gNoArr)){
                $this->_error[] = "商品序号{$value['g_no']}重复";
                continue;
            }
            $this->_param['product'][$key]['product_id'] = $result['orderProductRow']['product_id'];
        }
    }

    public function create() {
        $return = array('ask'=>0,'message'=>'操作失败','error'=>array());
        $this->reset();
        $this->check();
        if(!empty($this->_error)){
            $return['error'] = $this->_error;
            return $return;
        }
        $data = $this->_param;
        $dateTime = date('Y-m-d H:i:s',time());
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $rowPersonalItems = array(
                'gl_reference_no'=>$this->_param['gl_reference_no'],
                'form_type'=>$this->_param['form_type'],
                'order_reference_no' =>$this->_param['reference_no'],
                'customer_code' =>$this->_param['form_type'],
                'customer_code' =>$this->_param['customer_code'],
                'enp_name'=>$this->_param['enp_name'],
                'storage_customer_code'=>$this->_param['storage_customer_code'],
                'storage_name'=>$this->_param['storage_name'],
                'agent_customer_code'=>$this->_param['agent_customer_code'],
                'agent_name'=>$this->_param['agent_name'],
                'account_code'=>$this->_param['account_code'],
                'log_no'=>$this->_param['log_no'],
                'pay_no'=>$this->_param['pay_no'],
                'wrap_type' =>$this->_param['wrap_type'],
                'traf_mode' =>$this->_param['traf_mode'],
                'traf_name' =>$this->_param['traf_name'],
                'ie_port' =>$this->_param['ie_port'],
                'declare_ie_port' =>$this->_param['declare_ie_port'],
                'declare_no'=>$this->_param['declare_no'],
                'departure_or_destination_country'=>$this->_param['departure_or_destination_country'],
                'input_company'=>$this->_param['input_company'],
                'agent_address'=>$this->_param['agent_address'],
                'agent_post'=>$this->_param['agent_post'],
                'agent_tel'=>$this->_param['agent_tel'],
                'freight'=>$this->_param['freight'],
                'insure_fee'=>$this->_param['insure_fee'],
                'customs_field'=>$this->_param['customs_field'],
                'input_no'=>$this->_param['input_no'],
                'net_weight'=>$this->_param['net_weight'],
                'gross_weight'=>$this->_param['gross_weight'],
                'pack_no'=>$this->_param['pack_no'],
                'note'=>$this->_param['note'],
                'ie_date'=>$this->_param['ie_date'],
                'input_date'=>$this->_param['input_date'],
                'declare_date'=>$this->_param['declare_date'],
                'status'=>'1',
                'filled_date'=>$this->_param['filled_date'],
                'cus_license'=>$this->_param['cus_license'],
                'flight_or_voyage_number'=>$this->_param['flight_or_voyage_number'],
                'bill_no'=>$this->_param['bill_no'],
                'owner_code'=>$this->_param['owner_code'],
                'owner_name'=>$this->_param['owner_name'],
                'gl_add_time'=>date('Y-m-d H:i:s'),
                'port_of_departure'=>$this->_param['port_of_departure'],
            );

            $prefix = $this->_param['declare_ie_port'].date("Y")."E";

            $gl_code = Common_GetNumbers::getCode('GoodsList' , 10 , $prefix , '货物清单code');
            $rowPersonalItems['gl_code'] = $gl_code;

            $glId = Service_GoodsList::add($rowPersonalItems);
            foreach ($data['product'] as $key => $value) {
                $rowGoodsListProduct = array(
                    "gl_id" => $glId,
                    'gl_code'=>$gl_code,
                    'product_id'=>$value['product_id'],
                    'register_id'=>$value['register_id'],
                    'product_barcode'=>$value['product_barcode'],
                    'g_no'=>$value['g_no'],
                    'goods_id'=>$value['goods_id'],
                    'hs_code'=>$value['hs_code'],
                    //'code_tx'=>$value['code_tx'],//不用填
                    'g_name_cn'=>$value['g_name_cn'],
                    "g_model" => $value['g_model'],
                    "g_qty" => $value['g_qty'],
                    'g_unit'=>$value['g_unit'],
                    'price'=>$value['price'],
                    'total_price'=>$value['price']*$value['g_qty'],
                    'currency'=>$value['currency'],
                    'country'=>$value['country'],
                );
                Service_GoodsListDetail::add($rowGoodsListProduct);
            }
            //添加货物清单日志
            $GoodsListLog = array(
                'gl_id'=>$glId,
                'gl_code'=>$gl_code,
                'gl_status_from'=>'1',
                'gl_status_to'=>'1',
                'gll_add_time'=>$dateTime,
                'user_id'=>'-1',
                'gll_ip'=>Common_Common::getIP(),
                'gll_comments'=>'添加货物清单',
                'account_name'=>'',
            );
            Service_GoodsListLog::add($GoodsListLog);
            //添加订单日志
            $orderRow = array(
                'order_status'=>'1',
                'update_time'=>$dateTime
            );
            if(!Service_Orders::update($orderRow,$this->_order['order_code'],'order_code')){
                throw new Exception('关联订单失败');
            }else{
                //添加订单日志
                $orderLogRow = array(
                    'order_id'=>$this->_order['order_id'],
                    'order_code'=>$this->_order['order_code'],
                    'ol_type'=>'0',
                    'order_status_from'=>'0',
                    'order_status_to'=>'1',
                    'ol_add_time'=>$dateTime,
                    'user_id'=>'-1',
                    'ol_ip'=>Common_Common::getIP(),
                    'ol_comments'=>'货物清单关联订单',
                    'account_name'=>$this->_param['account_name'],
                );
                Service_OrderLog::add($orderLogRow);
            }
            $waybillRow = array(
                'wb_status'=>'1',
                'wb_update_time'=>$dateTime
            );
            if(!Service_Waybill::update($waybillRow,$this->_wayBillOrder['wb_id'])){
                throw new Exception('关联运单失败');
            }else{
                //添加运单日志
                $waybillLogRow = array(
                    'wb_id'=>$this->_wayBillOrder['wb_id'],
                    'wb_code'=>$this->_wayBillOrder['wb_code'],
                    'wb_status_from'=>'0',
                    'wb_status_to'=>'1',
                    'wb_add_time'=>$dateTime,
                    'user_id'=>'-1',
                    'wb_ip'=>Common_Common::getIP(),
                    'wb_comments'=>'货物清单关联运单',
                    'account_name'=>$this->_param['account_name'],
                );
                Service_WaybillLog::add($waybillLogRow);
            }
            $payRow = array(
                'status'=>'1',
                'update_time'=>$dateTime
            );
            if(!Service_PayOrder::update($payRow,$this->_payOrder['po_id'])){
                throw new Exception('关联支付单失败');
            }else{
                //支付单日志
                $payLogRow = array(
                    'po_id'=>$this->_payOrder['po_id'],
                    'po_code'=>$this->_payOrder['po_code'],
                    'pl_status_from'=>'0',
                    'pl_status_to'=>'1',
                    'pl_add_time'=>$dateTime,
                    'user_id'=>'-1',
                    'pl_ip'=>Common_Common::getIP(),
                    'pl_comments'=>'货物清单关联支付单',
                    'account_name'=>$this->_param['account_name'],
                );
                Service_PayOrderLog::add($payLogRow);
            }
            //print_r($rowPersonalItems);exit;
            $db->commit();
            //$db->rollback();
            $return['message'] = '添加成功，货物内部清单:'.$gl_code;
        }catch (Exception $e) {
            $db->rollback();
            $return['error'][] = $e->getMessage();
        }
        //
        return $return;
    }

    public function choiceProduct($orderProductRow , $ie_type = '', $ie_port = '',$checkCustomer=false)
    {
        //print_r($orderProductRow);exit;
        $result = array (
            "ask" => 0,
            "message" => '货物清单创建失败！',
            'error' => array()
        );
        $error = array();
        $registerID = $orderProductRow['register_id'];
        $productRow = Service_Product::getByField($registerID , 'registerID');
        $orderProductRow['product_id'] = $productRow['product_id'];

        if(empty($productRow)){
            $error[]   =   $registerID.'商品不存在！';
        }
        if($checkCustomer) {
            if(!isset($orderProductRow['customer_code'])) {
                $this->_error[] = $registerID.'无法验证产品所属的客户';
            } else {
                if($productRow['customer_code']!=$orderProductRow['customer_code']){
                    $this->_error[] = $registerID."产品的电商企业代码和所填的电商{$orderProductRow['customer_code']}不一致";
                }
            }
        }

        /*if(!isset($orderProductRow['code_tx']) || $orderProductRow['code_tx']===''){
            $error[]  =   $registerID.'税号不能为空！';
        }*/

        if($ie_type != '' && $productRow['ie_type'] != $ie_type){
            $error[]  =   $registerID.'进出口类型不正确！';
        }

        if($ie_port != '' && $productRow['customs_code'] != $ie_port){
            $error[]   =   $registerID.'主管海关代码不正确！';
        }
        if(!isset($orderProductRow['g_unit'])){
            $error[]   =   $registerID.'计量单位不能为空！';
        }/*else if($orderProductRow['g_unit'] != $productRow['g_unit']){
            //不校验，在三单对比那里比较了
             $error[]   =   $registerID.'计量单位不正确！';
        }*/

        if($orderProductRow['hs_code'] != $productRow['hs_code']){
            $error[] = $registerID."商品海关编码不正确！";
        }
        if($orderProductRow['g_model'] != $productRow['product_model']){
            $error[] = $registerID."商品规格不正确！";
        }

        if($orderProductRow['currency'] != $productRow['currency_code']){
            $error[] = $registerID."申报币种不正确！";
        }
        if(!is_numeric($orderProductRow['g_qty']) || ($orderProductRow['g_qty'] <= 0)){
            $error[] = $registerID."成交数量不是一个有效的数字！";
        }

        if(!preg_match("/^\d+(\.[\d]{0,2})?$/",$orderProductRow['price'])){
            $error[] = $registerID."成交单价不是一个有效的货币数值！";
        }
        /*if(!preg_match("/^\d+(\.[\d]{0,2})?$/",$orderPorductRow['total_price'])){
            $error[] = $registerID."成交总价不是一个有效的货币数值！";
        }*/
        if(!empty($error)){
            $result['error'] = $error;
        }else{
            $result['ask'] = 1;
            $result['orderProductRow'] = $orderProductRow;
        }
        return $result;
    }

    public function changeParameter($productRow) {
        $array = array(
            "register_id",
            "code_tx",
            "g_no",
            "goods_id",
            "hs_code",
            'product_barcode',
            "price",
            "g_qty",
            "currency",
            "g_name_cn",
            "g_model",
            "g_unit",
            "country",
        );
        $newArray = array();
        foreach($array as $key=>$value) {
            $newArray[$value] = isset($productRow[$key])?$productRow[$key]:'';
        }
        /*foreach ($productRow as $key => $value) {
            if(!isset($array[$key])){
                continue;
            }
            $newArray[$array[$key]] = $value;
        }*/
        return $newArray;
    }

    public function getDetailField() {
        return $array = array(
            "register_id",
            "code_tx",
            "g_no",
            "goods_id",
            "hs_code",
            'product_barcode',
            "price",
            "g_qty",
            "currency",
            "g_name_cn",
            "g_model",
            "g_unit",
            "country",
        );
    }
}