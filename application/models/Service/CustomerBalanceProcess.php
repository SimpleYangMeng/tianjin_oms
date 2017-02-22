<?php
class Service_CustomerBalanceProcess
{
	/**
	 * 订单预扣费
	 * @author solar
	 * @param string $order_code
	 * @param int $customer_id
	 * @return true|string
	 */
    public function freezeFee($order_code, $customer_id) {
    	$customerRow = Service_Customer::getByField($customer_id);
    	$balanceRow = Service_CustomerBalance::getByField($customer_id, 'customer_id');
        $orderRow = Service_Orders::getByField($order_code, 'order_code');
    	if(empty($balanceRow)) return '找不到账户余额记录';
    	//if($customerRow['cash_type']==2) return true;	//月结，不用冻结
        //集货转运类的订单在确认到提交时，无须冻结金额，在日本仓出货的时候也无须扣款，只在目的仓出货的时候发生扣款动作
        if($orderRow['warehouse_id']=="1"&&$orderRow['order_mode_type']=="1") return true;
    	$currencyRow = Service_Currency::getByField($customerRow['customer_currency'], 'currency_code');
        $addressRow = Service_OrderAddressBook::getByField($order_code, 'order_code');
    	$weight = Service_Orders::calculateWeight($order_code);
    	$objCalculate = new Common_CalculateShipping();
    	$keys = array(
            'customerCode'=>$orderRow['customer_code'],
    		'warehouseId' => $orderRow['warehouse_id'],
    		'countryId' => $addressRow['oab_country_id'],
    		'smCode' => $orderRow['sm_code'],
    		'weight' => $weight,
    		'provinceId'=>$addressRow['oab_state_id'],
    		'cityId'=>$addressRow['oab_city_id']
    	);
        if($orderRow['to_warehouse_id']>0){
    		$key['warehouseId'] = $orderRow['to_warehouse_id'];
    	}
    	$objCalculate->setParams($keys);
    	$result = $objCalculate->getRate();
    	if($result['state'] == 0)
    		return is_array($result['error']) ? implode(',', $result['error']) : $result['error'];
    	$fee = $result['data']['cost']['totalCost'];
    	$convert_fee = round($fee / $currencyRow['currency_rate'], 2);
    	//冻结金额
    	$able_fee = floatval($balanceRow['cb_value'] - $convert_fee);
    	if($customerRow['cash_type']==1){
            if($able_fee < 0) return '账户余额不足，无法冻结金额';
        }
    	$hold_fee = $balanceRow['cb_hold_value'] + $convert_fee;
    	$uBalance['cb_value'] = $able_fee;
    	$uBalance['cb_hold_value'] = $hold_fee;
    	$uBalance['cb_update_time'] = date('Y-m-d H:i:s');
    	$uResult = Service_CustomerBalance::update($uBalance, $balanceRow['cb_id']);
    	//if(!$uResult) return '更新余额数据失败';
    	//记录余额日记
    	$aBalanceLog['customer_code'] = $customerRow['customer_code'];
    	$aBalanceLog['customer_id'] = $customer_id;
    	$aBalanceLog['cbl_type'] = 0;
    	$aBalanceLog['cbl_transaction_value'] = $convert_fee;
    	$aBalanceLog['cbl_value'] = $fee;
    	$aBalanceLog['currency_rate'] = $currencyRow['currency_rate'];
    	$aBalanceLog['currency_code'] = 'RMB';
    	$aBalanceLog['cbl_note'] = '物流运费';
    	$aBalanceLog['user_id'] = -1;
    	$aBalanceLog['cbl_current_value'] = $able_fee;
    	$aBalanceLog['cbl_current_hold_value'] = $hold_fee;
    	$aBalanceLog['application_code'] = 1;
    	$aBalanceLog['cbl_refer_code'] = $order_code;
    	$aBalanceLog['cbl_cus_code'] = $orderRow['reference_no'];
    	$aBalanceLog['cbl_add_time'] = date('Y-m-d H:i:s');
        if($convert_fee>0){
            $aResult = Service_CustomerBalanceLog::add($aBalanceLog);
            if(!$aResult) return '记录余额日志失败';
        }
    	$uOrder['shipping_fee_estimate'] = $convert_fee;
    	$uOrder['update_time'] = date('Y-m-d H:i:s');
    	Service_Orders::update($uOrder, $order_code, 'order_code');
    	return true;
    }
    /**
     * @author william-fan
     * @todo 订单预付费检查
     */
    public function freezeFeeCheck($order_code, $customer_id) {
    	$customerRow = Service_Customer::getByField($customer_id);
    	$currencyRow = Service_Currency::getByField($customerRow['customer_currency'], 'currency_code');
    	$orderRow = Service_Orders::getByField($order_code, 'order_code');
    	$addressRow = Service_OrderAddressBook::getByField($order_code, 'order_code');
    	$weight = Service_Orders::calculateWeight($order_code);
    	$objCalculate = new Common_CalculateShipping();
    	$keys = array(
    			'warehouseId' => $orderRow['warehouse_id'],
    			'countryId' => $addressRow['oab_country_id'],
    			'smCode' => $orderRow['sm_code'],
    			'weight' => $weight,
    			'provinceId'=>$addressRow['oab_state_id'],
    			'cityId'=>$addressRow['oab_city_id']
    	);
    	//以目的仓计算
    	if($orderRow['to_warehouse_id']>0){
    		$keys['warehouseId'] = $orderRow['to_warehouse_id'];
    	}
    	$objCalculate->setParams($keys);
    	$result = $objCalculate->getRate();
    	if($result['state'] == 0){
    		return is_array($result['error']) ? implode(',', $result['error']) : $result['error'];
    	}else{
    		return true;
    	}
    }
    /* 解冻订单金额
    * @author william
    * @param string $order_code
    * @return true|string
    */
    public static function unfreezeFee($order_code) {
    	$aOrder = Service_Orders::getByField($order_code, 'order_code');
    	if(empty($aOrder)) return '找不到订单'.$order_code;
    	if($aOrder['shipping_fee_estimate'] == 0) return true;
    	$aCustomer = Service_Customer::getByField($aOrder['customer_id']);
    	//if($aCustomer['cash_type']==2) return true;	//月结
    	$aBalance = Service_CustomerBalance::getByField($aOrder['customer_id'], 'customer_id');
    	if(empty($aBalance)) return '找不到客户账户余额记录';
    	//处理
    	$balanceRow = Service_CustomerBalance::getForUpdate($aBalance['cb_id']);
    	$hold_value = $balanceRow['cb_hold_value'] - $aOrder['shipping_fee_estimate'];

		if($hold_value < 0) return '账户金额异常，冻结余额不足';
    	$uBalance['cb_value'] = $balanceRow['cb_value'] + $aOrder['shipping_fee_estimate'];
    	$uBalance['cb_hold_value'] = $hold_value;
    	$uBalance['cb_update_time'] = date('Y-m-d H:i:s');
    	$uResult = Service_CustomerBalance::update($uBalance, $balanceRow['cb_id']);
    	//if(!$uResult) return '更新余额数据失败';
    	$balanceShipCondition = array(
    			'customer_id'=>$aOrder['customer_id'],
    			'cbl_type'=>'0',
    			'fee_id' => '0',
    			'cbl_refer_code'=>$aOrder['order_code']
    	);
    	$shipfees = Service_CustomerBalanceLog::getByCondition($balanceShipCondition,'*',1,1);
    	if(empty($shipfees)){
    		return '不存在冻结运费记录';
    	}
    	$shipfee = $shipfees[0];
    	//解冻日志
    	$currencyRow= Service_Currency::getByField($aCustomer['customer_currency'],"currency_code","*");
    	$aBalanceLog['customer_code'] = $aCustomer['customer_code'];
    	$aBalanceLog['customer_id'] = $aCustomer['customer_id'];
    	$aBalanceLog['cbl_type'] = 1;
    	$aBalanceLog['cbl_transaction_value'] = $aOrder['shipping_fee_estimate'];
    	$aBalanceLog['cbl_value'] = $shipfee['cbl_value'];
    	$aBalanceLog['currency_rate'] = $currencyRow['currency_rate'];
    	$aBalanceLog['currency_code'] = $shipfee['currency_code'];
    	$aBalanceLog['cbl_note'] = '物流运费';
    	$aBalanceLog['user_id'] = '0';
    	$aBalanceLog['cbl_current_value'] = $uBalance['cb_value'];
    	$aBalanceLog['cbl_current_hold_value'] = $uBalance['cb_hold_value'];
    	$aBalanceLog['application_code'] = 1;
    	$aBalanceLog['cbl_refer_code'] = $order_code;
    	$aBalanceLog['cbl_add_time'] = date('Y-m-d H:i:s');
		$aBalanceLog['cbl_cus_code']	= $aOrder['reference_no'];
        if($aOrder['shipping_fee_estimate']>0){
            $aResult = Service_CustomerBalanceLog::add($aBalanceLog);
            //self::unfreezeAllOtherFee($aOrder);
            return $aResult ? true : '记录余额日志失败';
        }
        return true;
    }
    
    

}