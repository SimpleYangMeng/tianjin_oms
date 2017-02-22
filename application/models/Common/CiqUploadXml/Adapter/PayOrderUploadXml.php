<?php

/**
*
*/
class PayOrderUploadXml extends ShangJianXmlParent
{
    //操作对应的状态
    protected $status = 0;
    protected $apiCode = 'PayOrder';
	
    /**
     * 生成报文
     * @param [array] [队列api_message里的一行数据]
     * @return [type] [description]
     */
    public function createBodyXml($itemRow)
    {
        // print_r($itemRow);exit;
    	$payOrderRow = Service_PayOrder::getByField($itemRow['ref_id'], 'po_id');
    	if(empty($payOrderRow)){
            $this->_error[] = "支付ID:[{$itemRow['po_id']}]不存在";
            return false;
        }
        $customerRow = Service_Customer::getByField($payOrderRow['pay_customer_code'], 'customer_code');
        if(empty($customerRow)){
            $this->_error[] = "支付企业[{$payOrderRow['pay_customer_code']}]不存在";
            return false;
        }
        if(empty($customerRow['ciq_reg_num'])){
            $this->_error[] = "支付企业[{$payOrderRow['pay_customer_code']}]检验检疫备案号不存在";
            return false;
        }
        //属地检验检疫机构代码
        $this->_insUnitCode = $customerRow['ins_unit_code'];
        $currency = Service_Currency::getByField($payOrderRow['pay_currency_code'], 'currency_code', array('b_bbd_currency_code'));
        if(empty($currency['b_bbd_currency_code'])){
            $this->_error[] = "支付企业[{$payOrderRow['pay_customer_code']}]币种[{$payOrderRow['pay_currency_code']}]检验检疫币制编号不存在";
            return false;
        }
        //支付单数组
        $payOrderInfo = array(
            'PaymentDocument'=>array(
        		//支付单备案代理信息
        		'PaymentHead' => array(
        				'PAY_SERIAL_NO' => $payOrderRow['po_id'],//支付单流水号
        				'PAYMENT_NO' => $payOrderRow['pay_no'],//支付交易号
        				'ORDER_NO' => $payOrderRow['po_code'],//订单编号
        				'CBECODE' => $payOrderRow['ecommerce_platform_customer_code'],//电商企业代码
        				'CBENAME' => $payOrderRow['ecommerce_platform_customer_name'],//电商企业名称
                        'PAYMENT_CODE' => $customerRow['ciq_reg_num'],//支付企业编号
                        'PAYMENT_NAME' => $customerRow['trade_name'],//支付企业名称
                        'AMOUNT' => $payOrderRow['pay_amount'],//费用（支付金额）
                        'CURRENCY_CODE' => $currency['b_bbd_currency_code'],//币制编号
                        'PAYMENT_TIME' => $payOrderRow['add_time'],//date('Ymdhis', strtotime($payOrderRow['add_time'])), //支付时间
        				'REMARK' => $payOrderRow['note'],//备注
        		),
            ),
        );
        
	// echo '<pre>';
	// print_r($payOrderInfo);
	// return false;
	
        return $payOrderInfo;
    }
}
