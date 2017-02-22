<?php

/**
 * @todo 创建/更新/获取 支付单
 * @author luffyzhao
 */
class Api_PayOrder extends Api_Web
{
    /**
     * 转换字段对应
     * @var array
     */
    protected $fields = array(
            'payNo' => 'pay_no',//支付企业支付单号
            'appTime' => 'app_time',
            'status' => 'app_status',
            'ebpCode' => 'customer_code',//电商企业代码
            'ebpName' => 'enp_name',//电商企业名称
            'ecommercePlatformCustomerCode' => 'ecommerce_platform_customer_code',//电商平台代码
            'ecommercePlatformCustomerName' => 'ecommerce_platform_customer_name',//电商平台名称
            'payEnpCode' => 'pay_customer_code',//支付企业代码
            'payEnpName' => 'pay_enp_name',//支付企业名称
            'referenceNo' => 'reference_no',//交易订单号
            'currencyCode' => 'pay_currency_code',//币制
            'payAmount' => 'pay_amount',//支付金额
            'cosigneeCode' => 'cosignee_code',//支付人证件号码
            'cosigneeName' => 'cosignee_name',//cosigneeName
            'note' => 'note',//备注
			'payAccountCode'=>'pay_account_code',
            'payTime' => 'pay_time',//支付时间
    );

    /**
     * [run description]
     * @return [type] [description]
     */
    public function run()
    {
        if(!isset($this->_param['opType']) && empty($this->_param['opType'])){
            $this->_error[] = '[opType]为必须参数';
            return false;
        }
        $opType = $this->_param['opType'];
		$this->_param['data']['payAccountCode'] = $this->_param['accountCode'];
        switch ($opType) {
            //新增
            case 'Add':
                if(!isset($this->_param['data']) || empty($this->_param['data'])){
                    $this->_error[] = '[data]参数不存在！';
                    return false;
                }
                if(($payOrderInfo = $this->translate($this->_param['data'])) === false){
                    return false;
                }
                $payOrderInfo['po_id'] = '';
                $process = new Service_PayOrderProcess(array('param'=>$payOrderInfo));
                $result = $process->createPayOrderTransaction();
                break;
                
            //编辑
            case "Update":

                if(!isset($this->_param['data']) || empty($this->_param['data'])){
                    $this->_error[] = '[data]参数不存在！';
                    return false;
                }
                if(($payOrderInfo = $this->translate($this->_param['data'])) === false){
                    return false;
                }
                if(!$this->checkGet($payOrderInfo)){
                    return false;
                }
                $where = array(
                    'pay_no' => $payOrderInfo['pay_no'],
                    'pay_customer_code' => $payOrderInfo['pay_customer_code'],
                    'status' => 1,
                );
                $process = new Service_PayOrderProcess(array('param'=>$payOrderInfo));
                $result = $process->updatePayOrderTransaction($where);
                break;

            //获取
            case 'Get':
				$this->_param['data']['payEnpCode'] = $this->_param['customerCode'];
                $payOrderInfo = array(
                        'pay_no' => (!isset($this->_param['data']['payNo']) || empty($this->_param['data']['payNo'])) ? '' : $this->_param['data']['payNo'],
                        'pay_customer_code' => (!isset($this->_param['data']['payEnpCode']) || empty($this->_param['data']['payEnpCode'])) ? '' : $this->_param['data']['payEnpCode'],
                );
                if(!$this->checkGet($payOrderInfo)){
                    return false;
                }
                $where = array(
                    'pay_no' => $payOrderInfo['pay_no'],
                    'pay_customer_code' => $payOrderInfo['pay_customer_code'],
                    'status' => 1,
                );
                $payOrderData = Service_PayOrderProcess::getPayOrderBywhere($where);
                if(!empty($payOrderData) && is_array($payOrderData)){
                    $payOrderData = $this->returnDataPackage($payOrderData);
                    $result['ask'] = 1;
                    $this->_success = $payOrderData;
                    $this->_message = 'success';
                    return true;
                }else {
                    $this->_error[] = '支付单不存在!';
                    return false;
                }
                break;
            default:
                $this->_error[] = '操作类型错误,只能是Add、Update、Get';
                return false;
        }

        if($result['ask'] == 0){
            $this->_error = $result['message'];
            return false;
        }

        if($result['ask'] == 1 && isset($result['po_code'])){
            $this->_success['payCode'] = $result['po_code'];
            $this->_message = '支付单操作成功';
        }else{
            $this->_success = 1;
            $this->_message = '支付单操作成功';
        }
        return true;
    }


    /**
     * [returnDataPackage 返回数据格式化]
     * @param  [type] $payOrderData [description]
     * @return [type]               [description]
     */
    protected function returnDataPackage($payOrderData){
        $fields = array_flip($this->fields);
        $fields['po_code'] = 'payCode';
        $fields['ciq_status'] = 'ciqStatus';
        $returnPayOrderData = array();
        foreach($fields as $key=>$value) {
            //if(isset($payOrderData[$key]) && !empty($payOrderData[$key])){
            if(isset($payOrderData[$key])){
                $returnPayOrderData[$value] = $payOrderData[$key];
            }
        }
        return $returnPayOrderData;
    }

    /**
     * [checkGet 参数检查]
     * @param  [type] $payOrderInfo [description]
     * @return [type]              [description]
     */
    protected function checkGet($payOrderInfo){
        $mustArr = array(
                'pay_no' => '支付单号',
                'pay_customer_code' => '客户代码'
        );
        foreach ($mustArr as $key=>$value) {
            if(!isset($payOrderInfo[$key]) || empty($payOrderInfo[$key])){
                $this->_error[] = $value.'为必须参数';
            }
        }
        return empty($this->_error) ? true : false ;
    }
}
