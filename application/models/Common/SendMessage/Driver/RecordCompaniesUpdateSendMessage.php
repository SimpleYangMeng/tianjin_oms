<?php

/**
*
*/
class RecordCompaniesUpdateSendMessage extends SendMessageParent
{
    protected $messageType = 'BAA001';
    //操作对应的状态
    protected $status = 0;

    protected $functionCode = 3;
    //接口代码
    protected $apiCode = 'RecordCompaniesUpdate';


    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createMessage($itemRow)
    {
        $customerData = Service_Customer::getByField($itemRow['ref_cus_code'] , 'customer_code');
        if(empty($customerData)){
            // print_r($warehouseRow)
            $this->_error = "企业备案[{$itemRow['ref_cus_code']}]不存在！";
            return false;
        }
        $customerAgentData = Service_CustomerAgent::getByCondition(array('customer_id'=>$customerData['customer_id']));
        $agentCodeArr = $agentNameArr =array();
        if(!empty($customerAgentData) && is_array($customerAgentData)){
            foreach ($customerAgentData as $value) {
                $agentCodeArr[] = $value['agent_customer_code'];
                $agentNameArr[] = $value['agent_customer_name'];
            }
        }
        //动态数据
        $nowTime = date('YmdHis', time()).rand(100,999);
        // $customerData = Service_Customer::getByField($itemRow['ref_id']);
        // print_r($customerData['validity_date']);exit;
        $customerRegTime = date('YmdHis', strtotime($customerData['customer_reg_time'])).rand(1,9);
        $validityDate = date('YmdHis', strtotime($customerData['validity_date'])).rand(1,9);
        if(empty($customerData)){
            return false;
        }
        $customerType = Common_Common::customerType($customerData);

        // $customerData['business_type']
        $businessType = Common_Common::businessType($customerData);
        $header = $this->getXmlHeader($itemRow['am_id']);

        $declaration = array(
            'ENTERPRISE' => array(
                'SEQ_ID' => $customerData['customs_seq_id'],//唯一序列号(插入API返回的ID补全13位数，首位替换为类型)
                'ENP_DM_CODE' => $customerData['customer_code'],//企业代码
                'CUSTOM_CODE' => $customerData['customs_code'],//主管海关
                'ENP_TYPE' => $customerType,//企业类型
                'ENP_NAME' => $customerData['trade_name'],//企业名称
                'CN_ENP_CODE' => $customerData['trade_co'],//企业组织机构代码(最大10位数)
                'CUS_CODE' => $customerData['customs_reg_num'],//企业海关10位编码
                // 'STORE_ADDRESS' => $customerData['customer_province'].$customerData['customer_city'].$customerData['customer_address'],//企业注册地址
                'STORE_ADDRESS' => $customerData['customer_address'],//企业注册地址
                'STORE_POST' => $customerData['customer_postno'],//邮政编码
                'TEL_NUM' => $customerData['customer_telephone'],//联系电话

                'LINK_MAN' => $customerData['bus_name'],//联系人姓名
                'TAX_CODE' => $customerData['bus_lic_reg_num'],//营业执照编号
                'WWW_URL' => $customerData['bus_web_address'],//电商平台网站(电商企业必填)
                'CN_ICP_CODE' => $customerData['customer_c_i_c'],//ICP备案号(电商企业必填)
                'STORE_NAME' => $customerData['eshop_name'],//网店名称(电商企业必填)
                'AGENT_CODE' => !empty($agentCodeArr) ? join(',', $agentCodeArr) : $customerData['agent_code'],//申报单位代码(电商企业必填)
                'AGENT_NAME' => !empty($agentNameArr) ? join(',', $agentNameArr) : $customerData['agent_name'],//申报单位名称(电商企业必填)
                'NOTE_S' => $customerData['customer_note'],//备注
                'CREDIT_CODE' => $customerData['credit_code'],//统一社会信用代码
                'REGISTRATION_DATE' => $customerRegTime,//注册日期
                'LEGAL_PERSON' => $customerData['corporate'],//企业法人或负责人
                'LEGAL_PERSON_ID' => $customerData['corporate_num'],//企业法人或负责人证件号码
                'LEGAL_PERSON_PHONE' => $customerData['corporate_phone'],//企业法人或负责人联系电话
                'VALID_DATE' => $validityDate,//有效期
                'PAY_LICENSE' => $customerData['pay_bus_lic'],//支付业务许可证
                'EXPRESS_LICENSE' => $customerData['exp_bus_lic'],//快递业务许可证
                'STORE_AREA' => $customerData['warehouse_area'],//仓库面积
                'JG_CERTIFICATE_ID' => $customerData['reg_sit_cer_no'],//监管场所批准证书编号
                'FORM_TYPE' => $businessType,//业务类型(保税进口:BI，保税出口:BE，一般进口:NI，一般出口:NE) 目前最多支持5位
                'ATTACHMENT' => array(//附件
                        'NAME'=>'',
                        'CONTENT'=>''
                )
            ),
        );

        $messageArray = array(
            'Head' => $header,
            'Declaration' => $declaration
        );
        $messageObject = new Common_Message();
        $xml = $messageObject -> cearteMessage($messageArray);
        if($xml === false){
            $this->_error = "企业备案[{$itemRow['ref_cus_code']}] ".Common_Message::getError();
            return false;
        }

        return $xml;
    }


    /**
     * [dealwithReceipt description]
     * @param  [type] $value         [description]
     * @return [type]                [description]
     */
    protected function getDealWithReceipt($value,$xml)
    {
        $date = date('Y-m-d H:i:s', strtotime($value['FEEDBACK_DATE'].$value['FEEDBACK_TIME']));
        $customerData = Service_Customer::getByField(trim($value['FORM_ID']),'customs_seq_id');
        if(empty($customerData)){
            return;
        }
        if($value['FEEDBACK_FLAG'] == '01'){//海关接受申报
            $row = array(
                'api_type'=>'receive',
                'receiving_data'=>$xml,
                'am_status'=>'2',
                'receiving_count'=>'1',
                'receiving_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            //待审核
            Service_Customer::update(array('customer_status'=>'5'),$customerData['customer_id']);
        }elseif($value['FEEDBACK_FLAG'] == '02'){//海关退回申报
            $row = array(
                'api_type'=>'receive',
                'receiving_data'=>$xml,
                'am_status'=>'3',//已退回
                'receiving_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            //海关审核表示已经存在退回，清空用户到第二步注册状态之前，并且邮件告知用户（暂时不处理这种情况）
        }elseif($value['FEEDBACK_FLAG'] == '03'){//审核成功
            // print_r($customerData['customer_id']);exit;
            $row = array(
                'api_type'=>'receive',
                'check_data'=>$xml,
                'am_status'=>'5',
                'check_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            //已审核
            Service_Customer::update(array('customer_status'=>'2'),$customerData['customer_id']);
        }elseif($value['FEEDBACK_FLAG'] == '04'){//审核失败
            $row = array(
                'api_type'=>'receive',
                'check_data'=>$xml,
                'am_status'=>'4',
                'check_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            //审核失败
            Service_Customer::update(array('customer_status'=>'4'),$customerData['customer_id']);
        }elseif($value['FEEDBACK_FLAG'] == '05'){//暂停使用
            //改变状态为5，用户登录时不给登录，给予提示！(暂时不能登录)
            $row = array(
                'api_type'=>'receive',
                'check_data'=>$xml,
                'am_status'=>'6',
                'check_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            Service_Customer::update(array('customer_status'=>'6'),$customerData['customer_id']);
        }elseif($value['FEEDBACK_FLAG'] == '07'){//终止使用
            //改变状态为3，用户登录时不给登录，给予提示！（海关停用账号）
            $row = array(
                'api_type'=>'receive',
                'check_data'=>$xml,
                'am_status'=>'7',
                'check_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            Service_Customer::update(array('customer_status'=>'3'),$customerData['customer_id']);
        }elseif($value['FEEDBACK_FLAG'] == '08'){//恢复使用
            //改变状态为2
            $row = array(
                'api_type'=>'receive',
                'check_data'=>$xml,
                'am_status'=>'8',
                'check_time'=>$date
            );
            Service_ApiMessage::update($row,$customerData['customer_id'],'ref_id');
            Service_Customer::update(array('customer_status'=>'2'),$customerData['customer_id']);
        }
    }

}
