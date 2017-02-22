<?php
class Common_Customer
{
	// --------------------------------------------------------------------
	public function markCustomCode($code, $length = 8, $prefix = 'U')
	{
		if (empty($code)) {
			return FALSE;
		}
		$val	= $this->_getCurrentNumber($code); 
		$val	= str_pad($val, $length, '0', STR_PAD_LEFT);
		return strtoupper($prefix . $val);
	}

	// --------------------------------------------------------------------
	private function _getCurrentNumber($code = '', $initialVal = 88)
	{
		$time		= date('Y-m-d H:i:s');
		$condition	= array(
			'application_code'	=> $code
		);
		$application= Service_Application::getByCondition($condition);	
		if (empty($application)) {
			$data	= array(
				'application_code'	=> $code,
				'current_number'	=> $initialVal,
				'app_add_time'		=> $time
			);
			Service_Application::add($data);
		} else {
			if (!empty($application[0]['current_number'])) {
				$initialVal	= (int)$application[0]['current_number'] + 1;		
			}
			$data	= array(
				'current_number'	=> $initialVal, 
				'app_update_time'	=> $time
			);
			Service_Application::update($data, $application[0]['application_id']);
		}
		return $initialVal;
	}

    /**
     * @author william-fan
     * @todo 用于得到物流企业绑定的客户，支付企业绑定的客户,电商企业自己
     */
    public static function getBindCustomer($customer_code){
    	/*
        $customer = Service_Customer::getByField($customer_code, 'customer_code', 'customer_type');
        $customerCodes = array();
        if(!empty($customer)){
            switch($customer['customer_type']){
            	//电商
                case '1':
                    $customerCodes = array($customer_code);
                    break;
				//物流企业
                case '2':
                    $condition = array(
                        'cab_customer_code'=>$customer_code,
                        'customer_type'=>'2'
                    );
                    $bincustomer = Service_CustomerApplyBinding::getByCondition($condition,'*');
                    if(!empty($bincustomer)){
                        foreach($bincustomer as $k=>$v){
                            if(!in_array($v['customer_code'],$customerCodes)){
                                $customerCodes[] = $v['customer_code'];
                            }
                        }
                    }
                    break;
				//支付企业
                case '3':
                    $condition = array(
                        'cab_customer_code'=>$customer_code,
                        'customer_type'=>'3'
                    );
                    $bincustomer = Service_CustomerApplyBinding::getByCondition($condition,'*');
                    if(!empty($bincustomer)){
                        foreach($bincustomer as $k=>$v){
                            if(!in_array($v['customer_code'],$customerCodes)){
                                $customerCodes[] = $v['customer_code'];
                            }
                        }
                    }
                    break;
            }
        }
        */
    	$customer = Service_Customer::getByField($customer_code, 'customer_code', array('is_ecommerce', 'is_shipping', 'is_pay', 'is_storage'));
    	$customerCodes = array();
    	if(!empty($customer)){
    		//电商
    		if($customer['is_ecommerce'] == 1){
    			$customerCodes[] = $customer_code;
    		}
    		
    		//物流
    		if($customer['is_shipping'] == 1){
    			$condition = array(
    					'cab_customer_code' => $customer_code,
    					'customer_type' => 2
    			);
    			$bincustomer = Service_CustomerApplyBinding::getByCondition($condition, array('customer_code'));
    			if(!empty($bincustomer)){
    				foreach($bincustomer as $k=>$v){
    					if(!in_array($v['customer_code'],$customerCodes)){
    						$customerCodes[] = $v['customer_code'];
    					}
    				}
    			}
    		}
    		
    		//支付
    		if($customer['is_pay'] == 1){
    			$condition = array(
    					'cab_customer_code' => $customer_code,
    					'customer_type' => 3
    			);
    			$bincustomer = Service_CustomerApplyBinding::getByCondition($condition, array('customer_code'));
    			if(!empty($bincustomer)){
    				foreach($bincustomer as $k=>$v){
    					if(!in_array($v['customer_code'],$customerCodes)){
    						$customerCodes[] = $v['customer_code'];
    					}
    				}
    			}
    		}
    		
    		//仓储
    		if($customer['is_storage'] == 1){
    			$condition = array(
    					'cab_customer_code' => $customer_code,
    					'customer_type' => 4
    			);
    			$bincustomer = Service_CustomerApplyBinding::getByCondition($condition, array('customer_code'));
    			if(!empty($bincustomer)){
    				foreach($bincustomer as $k=>$v){
    					if(!in_array($v['customer_code'],$customerCodes)){
    						$customerCodes[] = $v['customer_code'];
    					}
    				}
    			}
    		}
    	}
        return array_unique($customerCodes);
    }
}	