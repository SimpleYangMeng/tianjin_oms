<?php
/**
 * @author simple
 */
class Service_TaxationGuaranteeProcess {
    protected $_error = array();
    protected $_param = null;
    public $_date = null;
    protected $_customerId = null;
    protected $_customer = null;
    protected $_addData = null;

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
                'g_type' => '担保类型',
                'customs_code' => '主管海关代码',
                'customer_code' => '企业代码',
                'customer_company_name' => '企业名称',
                'currency_code' => '担保币种',
                'tg_value' => '担保金额',
                'tg_bank_name' => '担保人',
                'tg_bank_code' => '担保银行简码',
                'tg_v_time' => '保函有效期限',
                'tg_limit_time' => '担保期限',
                'storage_customer_code' => '申报单位代码',
                'storage_customer_company_name' => '申报单位名称',
                'guarantee_basis' => '担保依据',
                'note' => '备注信息',
                'add_time' => '申请时间',
                'add_customer_code' => '添加人'
        );
    }

    /**
     * 字段对应关系
     * @return multitype:string
     */
    public static function getMap() {
        return array(
                'tg_id' => 'tg_id',
                'g_type'=> 'g_type',
                'customs_code' => 'customs_code',
                'customer_code' => 'customer_code',
                'customer_company_name' => 'customer_company_name',
                'currency_code' => 'currency_code',
                'tg_value' => 'tg_value',
                'tg_bank_name' => 'tg_bank_name',
                'tg_bank_code' => 'tg_bank_code',
                'tg_v_time' => 'tg_v_time',
                'tg_limit_time' => 'tg_limit_time',
                'storage_customer_code' => 'storage_customer_code',
                'storage_customer_company_name' => 'storage_customer_company_name',
                'guarantee_basis' => 'guarantee_basis',
                'note' => 'note',
                'add_time' => 'add_time',
                'add_customer_code' => 'add_customer_code',
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
        //编辑
        if(isset($this->_param['id']) && !empty($this->_param['id'])){
            $row = Service_TaxationGuarantee::getByField($this->_param['id'], 'tg_id');
            if($row instanceof Zend_Db_Table_Row){
                $row = $row->toArray();
            }
            if(!$row || $row['wb_status']==0){
                $this->_error[] = '单号不存在';
                return;
            }
        }
        $title = self::getTitle();
        $map = self::getMap();
        $excludeArr = array(
                'note',
                'tg_id',
                'tg_bank_code'
        );
        foreach($map as $key=>$value) {
            if($key == 'add_time'){
                continue;
            }
            $this->_addData[$value] = $this->_param[$key];
            if(!isset($this->_param[$key]) || $this->_param[$key]===''){

                if(in_array($key, $excludeArr)){
                    continue;
                }
                $this->_error[] = '<span class="blue">'.$title[$key].'</span>为必填项';
            }
        }
        // customer_code
        /*
        $customerData = Service_Customer::getByField($this->_param['customer_code'], 'customer_code', array('customer_id'));
        if(empty($customerData)){
            $this->_error[] = '被担保企业编码'.$this->_param['customer_code'].',该企业不存在;';
        }
        */

        // customs_code
        $customerCustomsCode = Service_Customer::getByCondition(array('customer_code'=>$this->_param['customer_code'], 'custom_codes'=>$this->_param['customs_code']), array('business_type', 'is_business_in'));
        if(empty($customerCustomsCode)){
            $this->_error[] = '申请企业编码与企业主管海关代码不一致;';
        }else{
            $customerCustomsCode = $customerCustomsCode[0];
            // 进口单位才能建税费担保单
            if( !($customerCustomsCode['business_type'] == 1 || $customerCustomsCode['is_business_in'] == 1) ){
                $this->_error[] = '该企业(<span class="blue">'.$this->_param['customer_code'].'</span>)不是进口企业, 不允许创建税费担保;';
            }
        }

        // storage_customer_code
        $storageCustomer = Service_Customer::getByField($this->_param['storage_customer_code'], 'customer_code', array('is_ecommerce'));
        if(empty($storageCustomer) || $storageCustomer['is_ecommerce'] != 1 ){
            $this->_error[] = '申报单位代码: <span class="blue">'.$this->_param['storage_customer_code'].'</span>该企业不存在或者该企业不是电商企业;';
        }

        /*
        if(empty($this->_param['tg_id'])){
            $guaranteeData = Service_TaxationGuarantee::getByField($this->_param['guarantee_basis'], 'guarantee_basis', array('guarantee_basis'));
            if(!empty($guaranteeData) && trim($this->_param['guarantee_basis']) == trim($guaranteeData['guaranteeData'])){
                $this->_error[] = '该担保依据已申请，请核对后再试;';
            }
        }
        */

        // guarantee_basis
        $guaranteeData = Service_TaxationGuarantee::getByField($this->_param['guarantee_basis'], 'guarantee_basis', array('tg_id', 'guarantee_basis'));
        /*
        if(!preg_match('/^[A-Za-z\d\-.\_.]+$/i', $this->_param['guarantee_basis'])){
            $this->_error[] = '<span class="blue">担保依据</span>格式不对(字母数字下划线短横线),示例格式：TJ-123456789;';
        }
        */
        //^\w{2}(1[9][0-9][0-9]|2[0][0-9][0-9])\d{8}$
        //保函 BH+4位年份+4位关区代码+4位顺序号，
        //保证金系统编码规则为BJ+4位年份+4位关区代码+4位顺序号

        $tg_v_time = strtotime($this->_param['tg_v_time']);
        $tg_limit_time = strtotime($this->_param['tg_limit_time']);

        if($tg_v_time < time()){
             $this->_error[] = '<span class="blue">有效期限:'.$this->_param['tg_v_time'].'已过期</span>';
        }
        if($tg_limit_time < time()){
             $this->_error[] = '<span class="blue">担保期限:'.$this->_param['tg_limit_time'].'已过期</span>';
        }
        //保证金
        if($this->_param['g_type'] == 1){
            //依据规则
            $basis_reg = '/^BJ(1[9][0-9][0-9]|2[0][0-9][0-9])\d{8}$/i';
            if(!preg_match($basis_reg, $this->_param['guarantee_basis'])){
                $this->_error[] = '<span class="blue">担保依据</span>格式不对,示例格式：BJ201602130001';
            }
            //担保期限
            if($tg_v_time != $tg_limit_time){
                $this->_error[] = '<span class="blue">有效期限、担保期限请保持一致</span>;有效期限：'.$this->_param['tg_v_time'].',担保期限：'.$this->_param['tg_limit_time'];
            }
        //保函
        }else {
            $basis_reg = '/^BH(1[9][0-9][0-9]|2[0][0-9][0-9])\d{8}$/i';
            if(!preg_match($basis_reg, $this->_param['guarantee_basis'])){
                $this->_error[] = '<span class="blue">担保依据</span>格式不对,示例格式：BH201602130001';
            }
            //担保期限
            if($tg_limit_time > $tg_v_time ){
                $this->_error[] = '<span class="blue">担保期限不能超过有效期限</span>;有效期限：'.$this->_param['tg_v_time'].',担保期限：'.$this->_param['tg_limit_time'];
            }
            $limit = round(($tg_v_time - $tg_limit_time ) / 86400 ) + 1 ;
            if( $limit < 60 ){
                $this->_error[] = '<span class="blue">担保期限必须大于有效期限2个月(60天)</span>;有效期限：'.$this->_param['tg_v_time'].',担保期限：'.$this->_param['tg_limit_time'];
            }
        }

        //新增
        if(empty($this->_param['tg_id'])){
            if(!empty($guaranteeData)){
                $this->_error[] = '该担保依据(<span class="blue">'.$guaranteeData['guarantee_basis'].'</span>)已申请，请核对后再试;';
            }
        //编辑
        }else{
            if(!empty($guaranteeData) && $this->_param['tg_id'] != $guaranteeData['tg_id']){
                $this->_error[] = '该担保依据(<span class="blue">'.$guaranteeData['guarantee_basis'].'</span>)已申请，请核对后再试;';
            }
        }

        // tg_value
        if(!preg_match('/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/', $this->_param['tg_value'])){
            $this->_error[] = '<span class="blue">担保金额</span>格式不对,金额格式：1000.00';
        }

        //判断客户代码（即物流仓储企业）
        /*
        if(!in_array($this->_param['customer_code'], $this->_customer['priv_customer_code_arr'])){
            $this->_error[] = '<span class="blue">'.$this->_param['customer_code'].'</span>未绑定该企业;';
        }
        */
        if(!empty($this->_error)){
            return;
        }
    }

    /**
     * 数据封装
     */
    public static function conversionParameter($resData){

        if(empty($resData)){
            return false;
        }

        return $resData;
    }

    /**
     * 创建税费担保
     */
    public function create() {
        $return = array('ask'=>0, 'message'=>'Fail');
        $this->check();
        if(!empty($this->_error)){
            $return['message'] = $this->_error;
            return $return;
        }
        $result = array();
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        if(empty($this->_param['tg_id'])){
            /*
            $addRow = $this->_addData;
            $addRow['add_time'] = $addRow['update_time'] = $this->_date;
            */
            $addRow = array(
                    'g_type'=> $this->_addData['g_type'],
                    'customs_code' => $this->_addData['customs_code'],
                    'customer_code' => $this->_addData['customer_code'],
                    'customer_company_name' => $this->_addData['customer_company_name'],
                    'currency_code' => $this->_addData['currency_code'],
                    'tg_value' => $this->_addData['tg_value'],
                    'tg_bank_name' => $this->_addData['tg_bank_name'],
                    'tg_bank_code' => $this->_addData['tg_bank_code'],
                    'tg_v_time' => $this->_addData['tg_v_time'],
                    'tg_limit_time' => $this->_addData['tg_limit_time'],
                    'storage_customer_code' => $this->_addData['storage_customer_code'],
                    'storage_customer_company_name' => $this->_addData['storage_customer_company_name'],
                    'guarantee_basis' => $this->_addData['guarantee_basis'],
                    'note' => $this->_addData['note'],
                    'add_time' => $this->_date,
                    'update_time' => $this->_date,
                    'add_customer_code' => $this->_customer['account_code'],
            );
            try {
                //验证只有子账号才能操作
                Service_Account::getAccountTypeException($this->_customer['account_code']);
                $result = Service_TaxationGuarantee::add($addRow);
                if(!$result){
                    throw new Exception("税费申报添加异常", 500);
                }
                $db->commit();
                $return['ask'] = 1;
                $return['message'] = '添加成功';
            }catch (Exception $e){
                $db->rollback();
                $return = array('ask'=>0, 'message'=>$e->getMessage(), 'errorCode'=>$e->getCode());
            }
        }else {
            $updateRow = $this->_addData;
            $updateRow['update_time'] = $this->_date;
            try {
                //验证只有子账号才能操作
                Service_Account::getAccountTypeException($updateRow['storage_customer_code']);
                $result = Service_TaxationGuarantee::update($this->_addData, $this->_param['tg_id']);
                if(!$result){
                    throw new Exception('更新异常或者未做修改', 500);
                }
                $db->commit();
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
     * 担保类型
     * @param string $lang 语言类型
     * @return multitype:multitype:string
     */
    public static function getGtype($lang = 'auto'){
        $tmp = array(
                'zh_CN' => array(
                    //    ''  => '全部',
                        '1' => '保证金',
                        '2' => '保函',
                    //    '3' => '其他'
                ),
                'en_US' => array(
                    //    ''  => 'all',
                        '1' => 'Bond',
                        '2' => 'Letter of guarantee',
                    //    '3' => 'Other'
                )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
    }

    /**
     * 发送状态
     * @param string $lang 语言类型
     * @return multitype:multitype:string
     */
    public static function getStatus($lang = 'auto'){
        $tmp = array(
                'zh_CN' => array(
                        '0' => '全部',
                        '1' => '草稿',
                        '2' => '待审核',
                        '3' => '审核中',
                        '4' => '已审核',
                        '5' => '审核不通过',
                        '7' => '暂停使用',
                ),
                'en_US' => array(
                        '0' => 'All',
                        '1' => 'Draft',
                        '2' => 'Pending audit',
                        '3' => 'Auditing',
                        '4' => 'Audited',
                        '5' => 'noPass',
                        '7' => 'suspend',
                )
        );
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
    }
}