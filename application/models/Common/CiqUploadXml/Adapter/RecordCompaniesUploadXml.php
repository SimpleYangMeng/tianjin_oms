<?php

/**
*
*/
class RecordCompaniesUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    //接口代码 RecordCompanies->企业备案
    protected $apiCode = 'RecordCompanies';
	
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
    	$customerData = Service_Customer::getByField($itemRow['ref_id'] , 'customer_id');
    	if(empty($customerData)){
            $this->_error[] = "企业备案[{$itemRow['ref_cus_code']}]不存在！";
            return false;
        }
        //属地检验检疫机构代码
        $this->_insUnitCode = $customerData['ins_unit_code'];
        //customerAttribute
        $customerAttributeData = Service_CustomerAttribute::getByCondition(array('customer_code'=>$customerData['customer_code']));
		$customerAttributeXml = array();
        if(!empty($customerAttributeData) && is_array($customerAttributeData)){
			foreach ($customerAttributeData as $key=>$customerAttribute){
				$customerAttributeXml[$key]['URL'] = $customerAttribute['url'];
				$customerAttributeXml[$key]['SITE_NAME'] = $customerAttribute['site_name'];
				$customerAttributeXml[$key]['BUS_SCOPE'] = $customerAttribute['bus_scope'];
			}
		}
        $org_no = $customerData['trade_co'];
        if(empty($org_no)){
            $org_no = $customerData['credit_code'];
        }
		//customer_attached
    	$customerAttachedData = Service_CustomerAttached::getByCondition(array('customer_code'=>$customerData['customer_code']));
    	$customerAttachedXml = array();
        if(!empty($customerAttachedData) && is_array($customerAttachedData)){
			foreach ($customerAttachedData as $key=>$customerAttached){
				//业务类型：固定值1（企业备案）
				$customerAttachedXml[$key]['BIZ_TYPE'] = 1;
				$customerAttachedXml[$key]['ANNEX_NAME'] = $customerAttached['ca_name'];
				$customerAttachedXml[$key]['ANNEX_CONTENT'] = $customerAttached['ca_content'];
				$customerAttachedXml[$key]['ANNEX_TYPE'] = $customerAttached['ca_type'];
                $customerAttachedXml[$key]['REMARK'] = '';
			}
		}
		
        //基本信息
        $baseInfo = array(
        	'ENT_SERIAL_NO' => $customerData['customer_code'],
        	'ENT_CNAME' => $customerData['trade_name'],
        	'ENT_ENAME' => $customerData['trade_name_en'],
        	'ENT_TYPE_PL' => $customerData['is_platform'] == 1 ? 'Y' : 'N',
        	'ENT_TYPE_CBE' => $customerData['is_ecommerce'] == 1 ? 'Y' : 'N',
        	'ENT_TYPE_LST' => $customerData['is_shipping'] == 1 ? 'Y' : 'N',
        	'ENT_TYPE_STO' => $customerData['is_storage'] == 1 ? 'Y' : 'N',
        	'ENT_TYPE_PAY' => $customerData['is_pay'] == 1 ? 'Y' : 'N',
        	'ENT_TYPE_RGL' => $customerData['is_supervision'] == 1 ? 'Y' : 'N',
            'ENT_TYPE_AGE' => $customerData['is_baoguan'] == 1 ? 'Y' : 'N',
        	//'ENT_TYPE_OT' => ($customerData['is_pay'] == 1 || $customerData['is_baoguan'] == 1 || $customerData['is_supervision'] == 1 ) ? 'Y' : 'N',
			'ENT_TYPE_OT' => 'N',
        	//属地检验检疫机构代码
        	'CIQ_ORG_TYPE_CODE' => $customerData['ins_unit_code'],
        	'ORG_NO' => $org_no,
        	'REGISTER_ADDRESS' => $customerData['customer_address'],
        //	'EMP_COUNT' => '',
        //	'SRV_EMPLOYEE_COUNT' => '',
        //	'FAX' => $customerData['customer_fax'],
        	'APPLY_TIME' => date('YmdHis'),
	    	'BUS_LC_NO' => $customerData['bus_lic_reg_num'],
	    	'BUS_LC_SIGN_UNIT' => $customerData['bus_lc_sign_unit'],
			//投资来源（国别/地区) -- 可为空
	        'INVEST_SOURCE_CODE' => '',
	        'LAW_MAN' => $customerData['corporate'],
	    //  'LAW_MAN_TEL' => $customerData['corporate_phone'],
	        'CONTACT_MAN' => $customerData['bus_name'],
	        'CONTACT_MAN_MOBILE' => $customerData['customer_telephone'],
	        'CONTACT_MAN_EMAIL' => $customerData['contact_man_email'],
	        // 'EMERGENCY_MAN' => '',
	        // 'EMERGENCY_MAN_MOBILE' => '',
	        // 'EMERGENCY_MAN_TEL' => '',
	        // 'QA_SAFE_MAN' => '',
	        // 'QA_SAFE_MAN_MOBILE' => '',
	        // 'QA_SAFE_MAN_EMAIL' => '',
	        // 'REMARK' => $customerData['customer_note'],
        );
        
        //企业数组
        $customerInfo = array(
            'EntRegDocument'=>array(
        		//基础格式
                'EntRegHead'=>$baseInfo,
        
        		//网站信息
        		'EntRegWebsiteList' => array(
        			'EntRegWebsiteListInformation' => $customerAttributeXml
        		),
        		
        		//企业备案附件信息
        		'EntRegAnnexList' => array(
        			'EntRegAnnexListInformation' => $customerAttachedXml,
        		),
        		
        		//企业备案代理信息
        		'EntRegAgentList' => array(
        			'EntRegAgentListInformation' => array(
        				'AGENT_ENT_NO' => '',
        				'AGENT_ENT_NAME' => '',
        				'AGENT_ENT_MAN' => '',
        				'AGENT_ENT_TEL' => '',
        				'AGENT_ENT_LAW_MAN' => '',
        				'AGENT_ENT_LAW_MAN_TEL' => '',
        				'AGENT_ENT_ORG_NO' => '',
        				'AGENT_ENT_EMAIL' => '',
        				'AGENT_ENT_COUNTRY' => '',
        				'AGENT_ENT_ADDRESS' => '',
        			),
        		),
            ),
        );
	
    	// echo '<pre>';
    	// print_r($customerInfo);
    	// return false;
	
        return $customerInfo;
    }
}
