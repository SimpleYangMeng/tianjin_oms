<?php
class Service_CustomerProcess
{
    /**
     * 生成料件号
     * @param int $customer_id
     * @return string
     */
    public static function generateGoodsId($customer_id)
    {
        $aCustomer    = Service_Customer::getLockInShareMode($customer_id);
        $goods_serial = ++$aCustomer['goods_serial'];
        Service_Customer::update(array('goods_serial' => $goods_serial), $customer_id);
        $customer_short = strtoupper($aCustomer['customer_short']);
        return $customer_short . str_pad($goods_serial, 6, '0', STR_PAD_LEFT);
    }
    /**
     * @author william-fan
     * @todo 用于检测输入
     */
    private function validator($row)
    {
        $error = array();
        if ($row['customer_email'] == '') {
            $error[] = '邮箱不能为空';
        } else if (!preg_match("/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/", $row['customer_email'])) {
            $error[] = '邮箱格式不对';
        } else {
            //判断邮箱的重复性
            $checkEmail  = Service_Customer::getByField($row['customer_email'], 'customer_email');
            $checkEmail2 = Service_Account::getByField($row['customer_email'], 'account_email', "*");
            if (!empty($checkEmail) || !empty($checkEmail2)) {
                $error[] = '该邮箱已经被注册';
            }
        }

        if (strlen($row['customer_password']) < 6) {
            $error[] = '密码必须6位以上(包含6位)';
        }

        if ($row['customer_password'] != $row['re_password']) {
            $error[] = '密码必须相同';
        }
        // if($row['verify']==''){
        //     $error[] = '验证码必填';
        // } else {
        //     if (! $this->Verifycode ( $row ['verify'] )) {
        //         $error [] = '验证码不对';

        //     }
        // }
        return $error;
    }
    /**
     *
     * @author william-fan
     * @todo 用于检测验证码
     */
    public function Verifycode($verifyCode)
    {
        $verify = new Common_Verifycode();
        return $verify->is_true($verifyCode);
    }

    /**
     *
     * @author william-fan
     * @todo 用于处理注册保存
     */
    public function createTransaction($row)
    {
        $result = array("ask" => 0, "message" => "注册失败", 'error' => array());
        $error  = $this->validator($row);
        if (!empty($error)) {
            if (in_array('验证码不对', $error)) {
                $result['authcodeError'] = 1;
            }
            $result['error'] = $error;
        } else {
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try {
                $time         = date('Y-m-d H:i:s', time());
                $mark         = new Common_Customer();
                $customerCode = $mark->markCustomCode('register');
                //$customerCode = Common_GetNumbers::getCode('customer', '', 'E');
                /* var_dump($customerCode);
                echo 'sfff';
                 */
                /*$customer_email=Service_Customer::getByField($row['customer_email'],'customer_email');
                if ($customer_email) {
                throw new Exception("邮件已被使用，请重新填写！");
                 */
                $customerRow = array(
                    'customer_code'          => $customerCode,
                    'customer_password'      => md5($row['customer_password']),
                    'customer_email'         => $row['customer_email'],
                    'customer_activate_code' => $row['customer_activate_code'],
                    'reg_step'               => 1,
                    'customer_reg_time'      => $time,
                );
                $customerId = Service_Customer::add($customerRow);
                if (!$customerId) {
                    throw new Exception("客户注册失败,写入数据库错误");
                }
                //初始化余额
                $balanceRow['customer_code'] = $customerCode;
                $balanceRow['customer_id']   = $customerId;
                Service_CustomerBalance::add($balanceRow);

                //验证是否是ip
                $host = Common_Common::getCurrentDomainName();
                //IP http
                if(Common_Common::isIp($host)){
                    $activePreUrl = 'http://';
                }else {
                    $activePreUrl = 'https://';
                }
                $activeurl = $activePreUrl.$host.'/register/activate?code='.$customerRow['customer_activate_code'].'&cid='.$customerId.'&time='.time();
                $activeHtml = "<a href='$activeurl' target='_blank'>请点击此链接激活您的账户</a>";
                $params     = array(
                    'bodyType' => 'html',
                    'email'    => array($row['customer_email']),
                    'subject'  => '[天津跨境贸易电子商务综合服务平台]账号激活通知',
                    'body'     => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您注册的邮箱是：{$row['customer_email']},<br/>感谢您的注册，{$activeHtml}。<br/>或者复制以下链接到浏览器进行激活：{$activeurl}",
                );
                if (!Common_Email::sendMail($params)) {
                    throw new Exception("客户注册失败,发送邮件失败");
                }
                //$db->rollback();
                $db->commit();
                $result['ask']           = '1';
                $result['message']       = '注册成功,请到邮箱里面查看邮件进行激活';
                $result['customer_code'] = $customerCode;
                $result['customer_id']   = $customerId;
                return $result;
            } catch (Exception $e) {
                $db->rollback();
                $result = array("ask" => 0, "message" => $e->getMessage(), 'errorCode' => $e->getCode());
            }

        }
        return $result;
    }

    /**
     * [updateOrderTransaction description]
     * @author luffy-zhao
     * @param  array  $customerInfo [description]
     * @return [type]               [description]
     */
    public function updateOrderTransaction(array $customerInfo, $customerCode)
    {
        $result = array(
            "ask"     => 0,
            "message" => '企业备案修改失败！',
            'error'   => array(),
        );

        $customerInfoResult = $this->validatorUpdate($customerInfo, $customerCode);
        if (!empty($customerInfoResult['error'])) {
            $result['error'] = $customerInfoResult['error'];
            return $result;
        }

        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $time                              = date("Y-m-d H:i:s");
            $updateRow                         = $customerInfoResult['info'];
            $updateRow['customer_update_time'] = $time;
            // 更新之后状态为已发送海关
            $updateRow['customer_status'] = 5;
            $validUpdate                  = Service_Customer::update($updateRow, $customerCode, 'customer_code');
            if ($validUpdate === false) {
                throw new Exception("企业备案修改失败！", 1);
            }

            $queueObject = Common_Queue::getInstance('RecordCompaniesUpdate');
            $queueObject->run($customerCode);

            $result['ask']     = 1;
            $result['message'] = "企业备案修改成功！";
            $db->commit();
        } catch (Exception $e) {
            $result['error'] = $customerInfoResult['error'];
            $db->rollback();
        }
        return $result;
    }

    /**
     * luffyzhao
     * @param  array  $customerInfo [description]
     * @return [type]               [description]
     */
    private function validatorUpdate(array $customerInfo, $customerCode)
    {
        $error = $info = array();

        $customerRow = Service_Customer::getByField($customerCode, 'customer_code');
        $error       = array();

        $errorCommon = $this->customerCommonDataField($customerInfo);
        $errorType   = $this->validatorCustomerTypeData($customerInfo, $customerRow);
        $error       = array_merge($errorCommon['error'], $errorType['error']);
        $info        = array_merge($errorCommon['info'], $errorType['info']);

        if (!preg_match("/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i", $info['corporate_num'])) {
            $error['corporate_num'] = "格式不正确！";
        }

        if ($customerInfo['bus_lic_reg_num'] == '' && $customerInfo['credit_code'] == '') {
            $error[] = '营业执照编号和社会信用代码二选一';
        }

        // 业务类型
        foreach ($customerInfo['business_type'] as $businessType) {
            $info[$businessType] = 1;
        }
        $info['trade_name_en'] = isset($customerInfo['trade_name_en']) ? $customerInfo['trade_name_en'] : '';
        $info['customer_note'] = isset($customerInfo['customer_note']) ? $customerInfo['customer_note'] : '';

        return array(
            'info'  => $info,
            'error' => $error,
        );

    }

    /**
     * 公共数据验证
     * @param  array  $customerInfo [description]
     * @return [type]               [description]
     */
    private function customerCommonDataField(array $customerInfo)
    {
        $error          = $info          = array();
        $validatorField = array(
            'validity_date', 'corporate_phone', 'corporate_num', 'corporate', 'web_address', 'customer_postno',
            'customer_telephone', 'bus_name', 'customer_address', 'trade_co', 'trade_name_en', 'trade_name',
        );

        foreach ($validatorField as $field) {
            if (!isset($customerInfo[$field]) || empty($customerInfo[$field])) {
                $error[$field] = "必填项！";
            } else {
                $info[$field] = $customerInfo[$field];
            }
        }

        return array(
            'error' => $error,
            'info'  => $info,
        );
    }

    /**
     * 针对不同的企业类型验证不同的数据
     * @author luffy-zhao
     * @param  string $value [description]
     * @return [type]        [description]
     */
    private function validatorCustomerTypeData(array $customerInfo, array $customerRow)
    {
        $error          = $info          = array();
        $validatorField = $this->customerTypeDataField($customerRow);
        foreach ($validatorField as $field) {
            if (!isset($customerInfo[$field]) || empty($customerInfo[$field])) {
                $error[$field] = "必填项！";
            } else {
                $info[$field] = $customerInfo[$field];
            }
        }

        if (isset($customerInfo['agent_code'])) {
            $agentValid = Service_Customer::getByCondition(array(
                'customer_code'   => $customerInfo['agent_code'],
                'is_storage'      => 1,
                'customer_status' => 2,
            ), 'count(*)');
            if ($agentValid == 0) {
                $error['agent_code'] = '不存在或者审核不通过！';
            }
        }

        return array(
            'error' => $error,
            'info'  => $info,
        );
    }

    /**
     * 不同的企业有不同的字段要验证
     * @param  array  $customerRow [description]
     * @return [type]              [description]
     */
    private function customerTypeDataField(array $customerRow)
    {
        $validatorField = array();
        if ($customerRow['is_storage'] == 1) {
            $validatorField = array(
                'customs_reg_num', 'warehouse_area',
            );
        }
        // 验证电商企业数据
        if ($customerRow['is_ecommerce'] == 1) {
            $validatorField = array(
                'agent_code', 'bus_web_address', 'validity_date', 'customer_c_i_c',
            );
        }

        // 验证物流企业数据
        if ($customerRow['is_shipping'] == 1) {
            $validatorField = array(
                'exp_bus_lic',
            );
        }

        // 验证支付企业数据
        if ($customerRow['is_pay'] == 1) {
            $validatorField = array(
                'pay_bus_lic',
            );
        }

        return $validatorField;
    }

    /**
     * @author colin-yang
     * @todo 用于检测输入
     */
    private function completestepvalidator($row, $imgs)
    {
        $error = array();
        if (strtotime($row['validity_date']) - time() <= 0) {
            $error[] = '您的有效期已过期';
        }
        if($row['trade_co'] != ''){
            if (!preg_match('/^[0-9a-zA-Z]{9,9}$/', $row['trade_co'])){
                $error[] = '组织机构代码必须为9位数';
            }
        }
        if($row['ciq_num']!=''){
            if(strlen($row['ciq_num']) != 10) {
            $error[] = '检验检疫编码必须为10位';
        }
        }
        //单位联系人手机
        if(key_exists('customer_telephone', $row) && !empty($row['customer_telephone'])){
            if (!preg_match("/^1[3-5,8]{1}[0-9]{9}$/", $row['customer_telephone'])) {
                $error[] = '单位联系人手机格式不对，范例：13888888888';
            }
        }

        //企业法人联系电话
        if(key_exists('corporate_phone', $row) && !empty($row['corporate_phone'])){
            if (!preg_match("/^([0-9]{3,4}-)?[0-9]{7,8}$/", $row['corporate_phone']) && !preg_match("/^1[3-5,8]{1}[0-9]{9}$/", $row['corporate_phone'])) {
                $error[] = '企业法人联系电话格式不对, 范例：022-88888888 / 13800000000';
            }
        }

        //联系人邮箱
        if(key_exists('contact_man_email', $row) && !empty($row['contact_man_email'])){
            if (!preg_match("/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/", $row['contact_man_email'])) {
                $error[] = '单位联系人邮箱格式不对，范例：aa@bb.com';
            }
        }

        //企业法人证件号码
        if(key_exists('corporate_num', $row) && !empty($row['corporate_num'])){
            if (!preg_match("/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i", $row['corporate_num'])) {
                $error[] = '企业法人证件号码格式不对，范例：510503199011120000';
            }
        }

        //邮政编码
        if(key_exists('customer_postno', $row) && !empty($row['customer_postno'])){
            if (!preg_match("/^[1-9]\d{5}(?!\d)$/", $row['customer_postno'])) {
                $error[] = '邮政编码格式不对，范例：613000';
            }
        }

        // if($row['picking_statement'] && strlen($row['picking_statement'])>300){
        //     $error[] = '配货单声明长度最大为300个字符.';
        // }

        // if($row['picking_statement'] && count(explode("\n",$row['picking_statement']))>3){
        //     $error[] = '配货单声明行数限定在三行以内.';
        // }

    //    print_r($imgs);exit;
        if (empty($imgs['attashed1'])) {
            $error[] = '请上传工商执照';
        }else {
            if(empty($imgs['attashedName1'][0])){
                $error[] = '工商执照文件名称获取失败,请重新上传再试';
            }
        }
        if ($row['is_ecommerce'] == 1 || $row['is_platform'] == 1) {
            if (empty($imgs['attashed2'])) {
                $error[] = '请上传企业质量承诺书声明';
            }else {
                if(empty($imgs['attashedName2'][0])){
                    $error[] = '企业质量承诺书声明文件名称获取失败,请重新上传再试';
                }
            }
            if (empty($imgs['attashed3'])) {
                $error[] = '请上传企业质量管理制度';
            }else {
                if(empty($imgs['attashedName3'][0])){
                    $error[] = '企业质量管理制度文件名称获取失败,请重新上传再试';
                }
            }
            if (empty($imgs['attashed4'])) {
                $error[] = '请上传质量诚信经营承诺书';
            }else {
                if(empty($imgs['attashedName4'][0])){
                    $error[] = '质量诚信经营承诺书文件名称获取失败,请重新上传再试';
                }
            }
            if(!key_exists('agent', $row) || empty($row['agent'])){
                $error[] = '请选择代理报关企业';
            }
        }

        if($row['customs_reg_num']==''){
            //$error[] = '企业海关编码必填';
        }

        //企业类型，组织机构代码 唯一判断
        /* $data = Service_Customer::getByCondition(array('trade_co' => $row['trade_co']));

        if ($data) {
            foreach ($data as $key => $value) {
                $rowType  = Common_Common::customerType($row);
                $dataType = Common_Common::customerType($value);
                if ($rowType == $dataType) {
                    $error[] = '该组织机构企业类型已经注册！';
                }
            }

        } */
        return $error;
    }

    /**
     * @author william-fan
     * @todo 完成注册
     */
    public function completeTransaction($parms, $imgs)
    {
        $session = new Zend_Session_Namespace('register');
        $result  = array("ask" => 0, "message" => "资料完善失败", 'error' => array());
        //验证数据
        $error = $this->completestepvalidator($parms, $imgs);

        if (empty($session->data['id'])) {
            $error[] = '完善资料超时，请重新登陆完善';
        }else {
            $customerData = Service_Customer::getByField($session->data['email'], 'customer_email', array('customer_email', 'customer_id'));
            if(empty($customerData) || $customerData['customer_id'] != $session->data['id']){
                $error[] = '登陆账号验证邮箱为空或者登陆账号和邮箱账户不符，请核对后登陆';
                $session->unsetAll();
            }
        }
        if(isset($parms['is_baoguan']) && $parms['is_baoguan']==1){
            $agentInfo = Service_AgentInfo::getByField($parms['customs_reg_num'],'customs_reg_num');
            if(empty($agentInfo)){
                $error[] = "海关编码{$parms['customs_reg_num']},不在海关给的报关企业白名单之列";
            }else{
                if($agentInfo['agent_name']!=$parms['trade_name']){
                    $error[] = "海关编码{$parms['customs_reg_num']},的海关给的企业名称和注册的不一致";
                }
            }
        }
        if (!empty($error)) {
            $result['error'] = $error;
            return $result;
        }

        //自动生成10位海关编码
        // $customerType = Common_Common::customerType($parms);
        // $customerCode = Common_GetNumbers::getCode($session->data['code'],'10',$customerType,'企业备案编码');
        // $customerCode = Common_Common::autoCustomerCode($session->data['code'],$customerType);
        $customerType = Common_Common::customerType($parms);

        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            //自动生成10位企业代码
            if (isset($parms['cus_dec_ent_num']) && !empty($parms['cus_dec_ent_num'])) {
                $customerCode = Common_GetNumbers::getCode($customerType . '_QYBA', '5', $parms['customs_code'] . $customerType . '1', '企业备案编码');
            } else {
                $customerCode = Common_GetNumbers::getCode($customerType . '_QYBA', '5', $parms['customs_code'] . $customerType . '0', '企业备案编码');
            }

            /*if ($customerType == 'D') {
                //电商企业自动生成11位编码(与customerCode一致)
                $parms['customs_reg_num'] = $customerCode;
            }*/
            $customs_reg_num = $parms['customs_reg_num'];
            //默认非报关企业
            $is_baoguan = !empty($parms['is_baoguan']) ? 1 : 0; 
            if($customs_reg_num{5}=='8'){
                $is_baoguan = 1;
            }
            if($customs_reg_num{6}=='K'){
                $is_baoguan = 1;
            }

            // $customerCode = Common_GetNumbers::getCode($customerType . '_QYBA', '9', $customerType, '企业备案编码');
            $session->data['code'] = $customerCode;
            //自动生成13位唯一序列号SEQ_ID
            $seqId = Common_GetNumbers::getCode('SEQ_ID_QYBA', '11', 'BH', '企业备案SEQ_ID');

            $id    = $session->data['id'];
            $code  = $session->data['code'];
            $email = $session->data['email'];
            $base  = array(
                //'customs_dec_ent_num' => empty($parms['cus_dec_ent_num']) ? '' : $parms['cus_dec_ent_num'],
                'ins_unit_name'       => empty($parms['ins_unit_name']) ? '' : $parms['ins_unit_name'],
                'ins_unit_code'       => empty($parms['ins_unit_code']) ? '' : $parms['ins_unit_code'],
                'bus_lc_sign_unit'    => empty($parms['bus_lc_sign_unit']) ? '' : $parms['bus_lc_sign_unit'],
                'contact_man_email'   => empty($parms['contact_man_email']) ? '' : $parms['contact_man_email'],
                'is_business_in'      => empty($parms['is_business_in']) ? '' : $parms['is_business_in'],
                'is_business_export'  => empty($parms['is_business_export']) ? '' : $parms['is_business_export'],
                'is_normal_in'        => empty($parms['is_normal_in']) ? '' : $parms['is_normal_in'],
                'is_normal_export'    => empty($parms['is_normal_export']) ? '' : $parms['is_normal_export'],
                'trade_name_en'       => empty($parms['trade_name_en']) ? '' : $parms['trade_name_en'],
                'credit_code'         => empty($parms['credit_code']) ? '' : $parms['credit_code'],
                'corporate'           => empty($parms['corporate']) ? '' : $parms['corporate'],
                'corporate_num'       => empty($parms['corporate_num']) ? '' : $parms['corporate_num'],
                'corporate_phone'     => empty($parms['corporate_phone']) ? '' : $parms['corporate_phone'],
                'validity_date'       => empty($parms['validity_date']) ? '' : $parms['validity_date'],
                'pay_bus_lic'         => empty($parms['pay_bus_lic']) ? '' : $parms['pay_bus_lic'],
                'exp_bus_lic'         => empty($parms['exp_bus_lic']) ? '' : $parms['exp_bus_lic'],
                'warehouse_area'      => empty($parms['warehouse_area']) ? '' : $parms['warehouse_area'],
                'reg_sit_cer_no'      => empty($parms['reg_sit_cer_no']) ? '' : $parms['reg_sit_cer_no'],
                // 'business_type'             => empty($parms['business_type']) ? '' : $parms['business_type'],
                'customer_note'       => empty($parms['customer_note']) ? '' : $parms['customer_note'],
                'customs_code'        => empty($parms['customs_code']) ? '' : $parms['customs_code'],
                'agent_name'          => empty($parms['agent_name']) ? '' : $parms['agent_name'],
                'agent_code'          => empty($parms['agent_code']) ? '' : $parms['agent_code'],
                'ie_type'             => empty($parms['ie_type']) ? '' : $parms['ie_type'],
                'customer_c_i_c'      => empty($parms['customer_c_i_c']) ? '' : $parms['customer_c_i_c'],
                'customs_seq_id'      => $seqId,
                'is_ecommerce'        => empty($parms['is_ecommerce']) ? '' : $parms['is_ecommerce'],
                'is_shipping'         => empty($parms['is_shipping']) ? '' : $parms['is_shipping'],
                'is_pay'              => empty($parms['is_pay']) ? '' : $parms['is_pay'],
                'is_storage'          => empty($parms['is_storage']) ? '' : $parms['is_storage'],
                'is_supervision'      => empty($parms['is_supervision']) ? '' : $parms['is_supervision'],
                'is_platform'         => empty($parms['is_platform']) ? '' : $parms['is_platform'],
                'is_baoguan'          => $is_baoguan,
                'trade_name'          => $parms['trade_name'],
                'trade_co'            => $parms['trade_co'],
                'customer_firstname'  => empty($parms['customer_firstname']) ? '' : $parms['customer_firstname'],
                'customer_lastname'   => empty($parms['customer_lastname']) ? '' : $parms['customer_lastname'],
                'customer_telephone'  => empty($parms['customer_telephone']) ? '' : $parms['customer_telephone'],
                'customer_fax'        => empty($parms['customer_fax']) ? '' : $parms['customer_fax'],
                'customer_province'   => empty($parms['customer_province']) ? '' : $parms['customer_province'],
                'customer_fax'        => empty($parms['customer_fax']) ? '' : $parms['customer_fax'],
                'customer_postno'     => empty($parms['customer_postno']) ? '' : $parms['customer_postno'],
                'customer_address'    => empty($parms['customer_address']) ? '' : $parms['customer_address'],
                'customer_provision'  => empty($parms['customer_provision']) ? '' : $parms['customer_provision'],
                'bus_lic_reg_num'     => empty($parms['bus_lic_reg_num']) ? '' : $parms['bus_lic_reg_num'],
                'bus_name'            => empty($parms['bus_name']) ? '' : $parms['bus_name'],
                'web_name'            => empty($parms['web_name']) ? '' : $parms['web_name'],
                'web_address'         => empty($parms['web_address']) ? '' : $parms['web_address'],
                'bus_sco'             => empty($parms['bus_sco']) ? '' : $parms['bus_sco'],
                'customer_signature'  => empty($parms['customer_signature']) ? '' : $parms['customer_signature'],
                'bus_web_address'     => empty($parms['bus_web_address']) ? '' : $parms['bus_web_address'],
                'customs_reg_num'     =>$customs_reg_num,
                'eshop_name'          => empty($parms['eshop_name']) ? '' : $parms['eshop_name'],
                'reg_step'            => 3,
                'customer_status'     => '1',
                'customer_code'       => $code,
                'ciq_num'             => empty($parms['ciq_num']) ? '' : $parms['ciq_num'],
            );
//print_r($base);exit;
// echo $id;exit;
            $book = array(
                'customer_id'         => $id,
                'customer_code'       => $code,
                'cab_company'         => $parms['trade_name'],
                'cab_firstname'       => empty($parms['firstname']) ? '' : $parms['firstname'],
                'cab_lastname'        => empty($parms['lastname']) ? '' : $parms['lastname'],
                'cab_state'           => empty($parms['state']) ? '' : $parms['state'],
                'cab_city'            => empty($parms['city']) ? '' : $parms['city'],
                'cab_postcode'        => empty($parms['postcode']) ? '' : $parms['postcode'],
                'cab_street_address1' => empty($parms['address']) ? '' : $parms['address'],
            );
            $state = Service_Customer::update($base, $id);
            if (!empty($state)) {
                if(Service_CustomerAddressBook::add($book) === false ){
                    throw new Exception('企业联系地址信息写入失败');
                }
            }else {
                throw new Exception('更新企业信息失败');
            }
            $customerRow = Service_Customer::getByField($id, 'customer_id', "*");
            $account     = array(
                'customer_code'       => $code,
                'account_code'        => $code,
                'account_email'       => $customerRow['customer_email'],
                'account_password'    => $customerRow['customer_password'],
                'account_name'        => $code,
                'add_time'            => date("Y-m-d H:i:s"),
                'account_update_time' => date("Y-m-d H:i:s"),
                'account_status'      => '1',
                'account_level'       => '0',
            );
            if(Service_Account::add($account) === false){
                throw new Exception('添加子账号信息失败');
            }
            if (!empty($parms['bus_scope'])) {
                for ($i = 0; $i < count($parms['bus_scope']); $i++) {
                    $cARow = array(
                        'customer_code' => $code,
                        'url'           => $parms['url'][$i],
                        'site_name'     => $parms['site_name'][$i],
                        'bus_scope'     => $parms['bus_scope'][$i],
                    );
                    if(Service_CustomerAttribute::add($cARow) === false){
                        throw new Exception('电商网站信息新增失败');
                    }
                }
            }
            //插入代理报关企业
            if (!empty($parms['agent']) && is_array($parms['agent'])) {
                //删除原有
                Service_CustomerAgent::delete($id, 'customer_id');
                foreach ($parms['agent'] as $agent){
                    $agent_arr = explode('-', $agent);
                    $customerAgentRow = array(
                        'customer_id'           => $id,
                        'customer_code'         => $code,
                        'trade_name'            => isset($parms['trade_name']) ? $parms['trade_name'] : '',
                        'agent_customer_code'   => $agent_arr[0],
                        'agent_customer_name'   => $agent_arr[1],
                        'add_time'              => date('Y-m-d H:i:s')
                    );
                    if(Service_CustomerAgent::add($customerAgentRow) === false){
                        throw new Exception('插入代理报关企业信息新增失败');
                    }
                }
            }
            //附件插入
            if(!empty($imgs['attashed1']) && is_array($imgs['attashed1'])){
                foreach ($imgs['attashed1'] as $key => $value) {
                    $customerAttached = array(
                        'customer_code' => $code,
                        'ca_type'       => 1,
                        'ca_content'    => $value,
                        'ca_add_time'   => date("Y-m-d H:i:s"),
                        'ca_name'       => $imgs['attashedName1'][$key],
                        'ca_file_type'  => $imgs['attashedType1'][$key],
                    );
                    if (!Service_CustomerAttached::add($customerAttached)) {
                        throw new Exception("add attached failure");
                    }
                }
            }

            //电商与电商平台
            if ($base['is_ecommerce'] == 1 || $base['is_platform'] == 1) {
                foreach ($imgs['attashed2'] as $key => $value) {
                    $customerAttached = array(
                        'customer_code' => $code,
                        'ca_type'       => 2,
                        'ca_content'    => $value,
                        'ca_add_time'   => date("Y-m-d H:i:s"),
                        'ca_name'       => $imgs['attashedName2'][$key],
                        'ca_file_type'  => $imgs['attashedType2'][$key],
                    );
                    if (Service_CustomerAttached::add($customerAttached) === false) {
                        throw new Exception("add attached failure");
                    }
                }
                foreach ($imgs['attashed3'] as $key => $value) {
                    $customerAttached = array(
                        'customer_code' => $code,
                        'ca_type'       => 3,
                        'ca_content'    => $value,
                        'ca_add_time'   => date("Y-m-d H:i:s"),
                        'ca_name'       => $imgs['attashedName3'][$key],
                        'ca_file_type'  => $imgs['attashedType3'][$key],
                    );
                    if (!Service_CustomerAttached::add($customerAttached)) {
                        throw new Exception("add attached failure");
                    }
                }
                foreach ($imgs['attashed4'] as $key => $value) {
                    $customerAttached = array(
                        'customer_code' => $code,
                        'ca_type'       => 4,
                        'ca_content'    => $value,
                        'ca_add_time'   => date("Y-m-d H:i:s"),
                        'ca_name'       => $imgs['attashedName4'][$key],
                        'ca_file_type'  => $imgs['attashedType4'][$key],
                    );
                    if (!Service_CustomerAttached::add($customerAttached)) {
                        throw new Exception("add attached failure");
                    }
                }
            }
            //附件插入结束
            if (empty($state)) {
                die("<script>alert('提交信息出错，请重新填写！');window.history.back();</script>");
            } else {
                $session->data = array(
                    'id'      => $id,
                    'code'    => $code,
                    'email'   => $email,
                    'current' => 4,
                );
                //更新激活标志
                $cashRes = Service_Customer::update(array('cash_type' => 1, 'customer_update_time' => date('Y-m-d H:i:s')), $id);
                if(!$cashRes){
                    throw new Exception("更新激活标示失败");
                }
                $db->commit();
                $result['ask']           = '1';
                $result['message']       = '完善资料成功';
                $result['customer_code'] = $code;
                $result['customer_id']   = $id;
                $result['email']         = $email;
                return $result;
            }
            return $result;
        } catch (Exception $e) {
            $db->rollback();
            $result = array("ask" => 0, "error" => $e->getMessage(), 'errorCode' => $e->getCode());
        }
        return $result;
    }

    /**
     * @author william-fan
     * @todo 用于更新客户信息
     */
    public static function updateCustomerTransaction($data, $customerId)
    {
        $result = array("ask" => 0, "message" => Ec_Lang::getInstance()->getTranslate('update_failed'), 'error' => array());
        $db     = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $cab_id          = $data['cab_id'];
            $customerAddress = Service_CustomerAddressBook::getByField($cab_id);
            if (empty($customerAddress)) {
                $result['message'] = Ec_Lang::getInstance()->getTranslate('customer_address_invalid');
                return $result;
            }
            if ($customerAddress['customer_id'] != $customerId) {
                $result['message'] = Ec_Lang::getInstance()->getTranslate('No_permission_to_operate');
                $db->rollback();
                return $result;
            }
            $addressBook['cab_firstname'] = $data['cab_firstname'];
            $addressBook['cab_lastname']  = $data['cab_lastname'];
            $addressBook['cab_phone']     = $data['cab_phone'];
            $addressBook['cab_fax']       = $data['cab_fax'];
            $addressBook['cab_state']     = $data['cab_state'];
            $addressBook['cab_city']      = $data['cab_city'];
            //    $addressBook['cab_postcode']        = $data['postcode'];
            $addressBook['cab_street_address1'] = $data['cab_street_address1'];
            /* echo $cab_id;
            print_r($addressBook);
            exit; */
            Service_CustomerAddressBook::update($addressBook, $cab_id);

            $customerRow = array();
            if (isset($data['customer_logo']) && $data['customer_logo'] != '') {
                $customerRow['customer_logo'] = $data['customer_logo'];
            }
            if (isset($data['customer_license']) && $data['customer_license'] != '') {
                $customerRow['customer_license'] = $data['customer_license'];
            }
            if (isset($data['customer_idcard']) && $data['customer_idcard'] != '') {
                $customerRow['customer_idcard'] = $data['customer_idcard'];
            }
            //print_r($customerRow);
            if (!empty($customerRow)) {
                Service_Customer::update($customerRow, $data['customer_id']);
            }
            $db->commit();
            $result['ask']     = '1';
            $result['message'] = Ec_Lang::getInstance()->getTranslate('update_success');
            return $result;
        } catch (Exception $e) {
            $db->rollback();
            $result = array("ask" => 0, "message" => $e->getMessage(), 'errorCode' => $e->getCode());
        }
        return $result;
    }

}
