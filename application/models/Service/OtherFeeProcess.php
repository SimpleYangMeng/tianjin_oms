<?php
class Service_OtherFeeProcess
{
	private $refer_code = '';
	private $cus_code = '';
	private $order_code = '';
	private $customer_id = 0;
	private $orderRow = null;
	private $customerRow = null;
	private $currencyRow = null;
	private $balanceRow = null;
	private $balance = 0;
	private $balance_hold = 0;
	
	public function __construct($order_code) {
		$this->order_code = $order_code;
		$this->orderRow = Service_Orders::getByField($order_code, 'order_code');
		$this->refer_code = $this->orderRow['order_code'];
		$this->cus_code = $this->orderRow['reference_no'];
		$this->customer_id = $this->orderRow['customer_id'];
		$this->customerRow = Service_Customer::getByField($this->customer_id);
		$this->currencyRow = Service_Currency::getByField($this->customerRow['customer_currency'], 'currency_code');
		$balanceRow = Service_CustomerBalance::getByField($this->customer_id, 'customer_id');
		$this->balanceRow = Service_CustomerBalance::getForUpdate($balanceRow['cb_id']);
		$this->balance = $this->balanceRow['cb_value'];
		$this->balance_hold = $this->balanceRow['cb_hold_value'];
	}
	
	/**
	 * 订单杂费
	 * @author solar
	 * @param $orderRow
	 */
	public function getOrderFee($orderRow) {
		$fees = array();
		$feeList = Service_OtherFee::getByCondition(array('application_code'=>'order', 'status'=>1));
		foreach($feeList as $feeRow) {
			//判断仓库
			if($feeRow['warehouse_id']!=0 && $feeRow['warehouse_id']!=$orderRow['warehouse_id']) {
				continue;
			}
			//判断集备货
			if($feeRow['model_type']!=-1 && $feeRow['model_type']!=$orderRow['order_mode_type']) {
				continue;
			}
			//判断客户
			/* $where = array('customer_code'=>$orderRow['customer_code'], 'fee_id'=>$feeRow['fee_id']);
			$cofRow = Service_CustomerOtherFee::getByWhere($where);
			if(empty($cofRow)) {
				if($feeRow['is_default_fee']==0) continue;
			} else {
				if($cofRow['status']==0) continue;
				//折扣
				$feeRow['discount'] = $cofRow['discount'];
			} */
			$discount = $this->checkDiscount($feeRow);
			if($discount === false) continue;
			else $feeRow['discount'] = $discount;
			$fees[] = $feeRow;
		}
		return $fees;
	}
	
	/**
	 * 检查是否需要扣费并返回折扣
	 * @param array $fee
	 * @return boolean|float
	 */
	public function checkDiscount($fee) {
		$discount = 1;
		$where = array('customer_code'=>$this->customerRow['customer_code'], 'fee_id'=>$fee['fee_id']);
		$cofRow = Service_CustomerOtherFee::getByWhere($where);
		if(empty($cofRow)) {
			if($fee['is_default_fee']==0) return false;
		} else {
			if($cofRow['status']==0) return false;
			//折扣
			$discount = $cofRow['discount'];
		}
		return $discount;
	}
	
	/**
	 * 冻结杂费
	 * @param array $fee
	 */
	private function freeze($fee) {
    // 行邮税，无需冻结
    if ('XYS' === strtoupper(trim($fee['fee_code']))) {
      return TRUE;
    }

		$discountFee = $fee['fee_value'] * $fee['discount'];	//折扣
		$feeCurrency = Service_Currency::getByField($fee['fee_currency_code'], 'currency_code');
		/* $rmbFee = $discountFee * $feeCurrency['currency_rate'];
		$customer_fee = round($rmbFee/$this->currencyRow['currency_rate'], 2); */
		$rate = $feeCurrency['currency_rate']/$this->currencyRow['currency_rate'];
		$customer_fee = round($discountFee * $rate, 2);		
		if($this->customerRow['cash_type']==1 && $customer_fee>$this->balance) {
			return '账户余额不足';
		}
		$this->balance -= $customer_fee;
		$this->balance_hold += $customer_fee;
		//日志
		$aBalanceLog['customer_code'] = $this->customerRow['customer_code'];
    	$aBalanceLog['customer_id'] = $this->customer_id;
    	$aBalanceLog['cbl_type'] = 0;
    	$aBalanceLog['cbl_transaction_value'] = $customer_fee;
    	$aBalanceLog['cbl_value'] = $discountFee;
    	$aBalanceLog['currency_rate'] = $rate;
    	$aBalanceLog['currency_code'] = $fee['fee_currency_code'];
    	$aBalanceLog['cbl_note'] = $fee['fee_name'];
    	$aBalanceLog['user_id'] = $this->customer_id;
    	$aBalanceLog['fee_id'] = $fee['fee_id'];
    	$aBalanceLog['cbl_current_value'] = $this->balance;
    	$aBalanceLog['cbl_current_hold_value'] = $this->balance_hold;
    	$aBalanceLog['application_code'] = 1;
    	$aBalanceLog['cbl_refer_code'] = $this->refer_code;
    	$aBalanceLog['cbl_cus_code'] = $this->cus_code;
    	$aBalanceLog['cbl_add_time'] = date('Y-m-d H:i:s');
    	Service_CustomerBalanceLog::add($aBalanceLog);
    	return true;
	}
	
	/**
	 * 冻结订单杂费
	 * @author solar
	 * @param string $order_code
	 */
	public function freezeOrderFee() {
		$count = 0;		
		$fees = $this->getOrderFee($this->orderRow);
		foreach($fees as $fee) {
			$result = $this->freeze($fee);
			if($result===true) ++$count; 
			else return $result;
		}
		//修改客户余额
		if($count>0) {
			$uBalance['cb_value'] = $this->balance;
			$uBalance['cb_hold_value'] = $this->balance_hold;
			$uBalance['cb_update_time'] = date('Y-m-d H:i:s');
			Service_CustomerBalance::update($uBalance, $this->balanceRow['cb_id']);
		}
		return true;
	}
	
	/**
	 * 解冻订单杂费
	 * @author solar
	 */
	public function unfreezeOrderFee() {
		$lBalanceLog = Service_CustomerBalanceLog::getByCondition(array('cbl_refer_code'=>$this->order_code));
		foreach($lBalanceLog as $aBalanceLog) {
			if($aBalanceLog['cbl_type']==0 && $aBalanceLog['fee_id']!=0) {
				$this->balance += $aBalanceLog['cbl_transaction_value'];
				$this->balance_hold -= $aBalanceLog['cbl_transaction_value'];
				$aBalanceLog['cbl_type'] = 1;
				$aBalanceLog['cbl_value'] = $aBalanceLog['cbl_value'];
				$aBalanceLog['cbl_transaction_value'] = $aBalanceLog['cbl_transaction_value'];
				$aBalanceLog['currency_rate'] = 1;
				$aBalanceLog['currency_code'] = $aBalanceLog['currency_code'];
				$aBalanceLog['user_id'] = 0;				
				$aBalanceLog['cbl_current_value'] = $this->balance;
				$aBalanceLog['cbl_current_hold_value'] = $this->balance_hold;
				$aBalanceLog['cbl_add_time'] = date('Y-m-d H:i:s');
				unset($aBalanceLog['cbl_id']);
				Service_CustomerBalanceLog::add($aBalanceLog);
			}
		}
	}
	
}