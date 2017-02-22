<?php

/**
 * @todo 创建/更新订单
 * @author luffyzhao
 */
class Api_Order extends Api_Web
{
    /**
     * 转换字段对应
     * @var array
     */
    protected $fields = array(
        'opType' => 'opType',
        "ieType" => 'ie_type',//进出口类型
        "iePort" => 'ie_port',//主管海关代码
        "goodsAmount" => 'goods_amount',//订单商品货款
        "freight" => 'freight',//订单商品运费
        "currencyCode" => 'currency_code',//currencyCode
        "proAmount" => 'pro_amount',//优惠金额
        "proRemark" => 'pro_remark',//优惠信息说明
        "referenceNo" => 'reference_no',//交易订单号
        "ecommercePlatformCustomerCode" => 'ecommerce_platform_customer_code',//电商平台备案编码
        "note" => 'note',//备注
        "consignee" => 'consignee',//收货人名称
        "consigneeCountry" => 'consignee_country',//收货人所在国
        "consigneeAddress" => 'consignee_addres',//收货人地址
        "consigneeTelephone" => 'consignee_telephone',//收货人电话
        "consigneeFax" => 'consignee_fax',//收货人传真
        "consigneeIdNumber" => 'consignee_id_number',//收货人身份证
        "consigneeEmail" => 'consignee_email',//收货人电子邮件
        'orderProduct' => 'orderProduct',
        //3-12新加
        'taxTotal' => 'tax_total',//订单商品税款
        'acctualPaid' => 'acctual_paid',//实际支付金额
        'buyerRegNo' => 'buyer_reg_no',//订购人注册号
        'buyerIdType' => 'buyer_id_type',//订购人证件类型
        'buyerName' => 'buyer_name',//订购人姓名
        'buyerId' => 'buyer_id',//订购人证件号码
        'payCode' => 'pay_code',//支付企业代码
        'payName' => 'pay_name',//支付企业名称
        'payNo' => 'pay_no',//支付单号
    );

    public function run()
    {
        $opType = $this->_param['opType'];

        // 操作类型
        $process = new Service_OrderProcess();

        switch ($opType) {
            case 'Add':
                if(!isset($this->_param['data'])){
                    $this->_error[] = '参数不存在！';
                    return false;
                }
                $orderInfoOriginal = $this->_param['data'];
                if(($orderInfo = $this->translate($orderInfoOriginal)) === false){
                    $this->_error[] = '数据转换失败！';
                    return false;
                }
                $result = $process->createOrderTransaction($orderInfo, $this->_customer['account_code'], true);
                break;

            case "Update":
                if(!isset($this->_param['data'])){
                    $this->_error[] = '参数不存在！';
                    return false;
                }
                $orderInfoOriginal = $this->_param['data'];

                if(($orderInfo = $this->translate($orderInfoOriginal)) === false){
                    $this->_error[] = '数据转换失败！';
                    return false;
                }
                $result = $this->checkGet($orderInfoOriginal);
                if($result['ask'] == '1'){
                    $condition = $result['data'];
                    $res = Service_Orders::getByCondition(array('reference_no'=>$condition['reference_no'],'customer_code'=>$condition['customer_code']));
                    if(!empty($res)){
                        if($res[0]['order_status'] != '2'){
                            $this->_error[] = '订单状态不为异常，不能修改！';
                            return false;
                        }
                        $result = $process->updateOrderTransaction($orderInfo, $res[0]['order_code'], $this->_customer['account_code'], true);
                    }else{
                        $result['ask'] = 0;
                        $result['error'][] = '没有数据';
                    }
                }
                break;

            case 'Get':
                $arr['referenceNo'] = $this->_param['data']['referenceNo'] ? $this->_param['data']['referenceNo'] : '';
                $arr['customerCode'] = $this->_param['HeaderRequest']['customerCode'] ? $this->_param['HeaderRequest']['customerCode'] : '';
                $result = $this->checkGet($arr);
                if($result['ask'] == '1'){
                    $condition = $result['data'];
                    $res = Service_Orders::getByCondition(array('reference_no'=>$condition['reference_no'],'customer_code'=>$condition['customer_code']));
                    if(!empty($res)){
                        $result['ask'] = 1;
                        //$status = Service_Orders::getOrderStatus();
                        $this->_success = array('orderNo'=>$res[0]['order_code'],'status'=>$res[0]['order_status'], 'ciqStatus'=>$res[0]['ciq_status']);
                    }else{
                        $result['ask'] = 0;
                        $result['error'][] = '没有数据';
                    }
                }
                break;

            default:
                $this->_error[] = '操作类型错误,只能是Add、Update';
                return false;
        }
        if($result['ask'] == 0){
            $this->_error = $result['error'];
            return false;
        }else{
            $this->_message = '成功！';
            switch ($opType) {
                case 'Add':
                    if(isset($result['orderCode'])){
                        $this->_message = '添加订单成功';
                        $this->_success['orderNo'] = $result['orderCode'];
                    }
                    break;

                case 'Update':
                    $this->_message = '更新订单成功';
                    $this->_success['orderNo'] = $res[0]['order_code'];
                    break;

                case 'Get':
                    $this->_message = '获取订单成功！';
                    break;

                default:
                    # code...
                    break;
            }
        }
        return true;
    }

    /**
     * 订单参数验证
     * @param  string $value [description]
     * @return [type]        [description]
     */
    protected function verification($params , $param)
    {
        //订单数据
        $orderRequestRow = array(
            'ie_type' => $params['ie_type'],
            'customs_code' => $params['ie_port'],
            'app_status' => 2,
            'goods_amount' => $params['goods_amount'],
            'freight' => $params['freight'],
            'currency_code' => $params['currency_code'],
            'pro_amount' => $params['pro_amount'],
            'pro_remark' => $params['pro_remark'],
            'reference_no' => $params['reference_no'],
            'ecommerce_platform_customer_code' => $params['ecommerce_platform_customer_code'],
            'note' => isset($params['note']) ? $params['note'] : '',
            //3-12 新加字段
            'tax_total' => isset($params['tax_total']) ? $params['tax_total'] : '',
            'acctual_paid' => isset($params['acctual_paid']) ? $params['acctual_paid'] : '',
            'buyer_reg_no' => isset($params['buyer_reg_no']) ? $params['buyer_reg_no'] : '',
            'buyer_id_type' => isset($params['buyer_id_type']) ? $params['buyer_id_type'] : '',
            'buyer_name' => isset($params['buyer_name']) ? $params['buyer_name'] : '',
            'buyer_id' => isset($params['buyer_id']) ? $params['buyer_id'] : '',
            'pay_code' => isset($params['pay_code']) ? $params['pay_code'] : '',
            'pay_name' => isset($params['pay_name']) ? $params['pay_name'] : '',
            'pay_no' => isset($params['pay_no']) ? $params['pay_no'] : '',
        );

        //订单收货人数据
        $orderAddressBookRequestRow = array(
            'consignee' => $params['consignee'],
            'consignee_country' => $params['consignee_country'],
            'consignee_addres' => $params['consignee_addres'],
            'consignee_telephone' => $params['consignee_telephone'],
            'consignee_fax' => $params['consignee_fax'],
            'consignee_id_number' => $params['consignee_id_number'],
            'consignee_email' => $params['consignee_email'],
        );
        $orderPorductRequestRows = array();
        foreach ($params['orderProduct'] as $product) {
            if(!isset($product['registerId'])){
                $this->_error[] = "格式不正确";
                return false;
            }
            if(isset($orderPorductRequestRows[$product['registerId']])){
                $this->_error[] = "[{$product['registerId']}]重复的商品海关编码.";
                return false;
            }
            $orderPorductRequestRows[$product['registerId']] = array(
                'product_no'=> $product['itemNo'],
                'registerID'=> $product['registerId'],
                'hs_code'=> $product['hsCode'],
                'product_title'=> $product['productName'],
                'product_model'=> $product['productModel'],
                'product_barcode'=> isset($product['productBarcode']) ? $product['productBarcode'] : '',
                'brand'=> $product['brand'],
                'pu_code'=> $product['unit'],
                'currency_code'=> $product['currencyCode'],
                'quantity'=> $product['quantity'],
                'price'=> $product['unitPrice'],
                'total_price'=> $product['totalPrice'],
                'gift_flag'=> $product['giftFlag'],
                'note'=> isset($product['note']) ? $product['note'] : '',
                //3-12 新增字段
                'gift_price' => isset($product['giftPrice']) ? $product['giftPrice'] : '',
                'item_desc' => isset($product['itemDesc']) ? $product['itemDesc'] : '',
                'origin_country' => isset($product['originCountry']) ? $product['originCountry'] : '',
            );
        }
        return array(
            'orderRow' => $orderRequestRow,
            'orderAddressBookRow' => $orderAddressBookRequestRow,
            'orderPorductRows' => $orderPorductRequestRows,
        );
    }
    private function checkGet($param){

        $return = array('ask'=>0,'error'=>'','error !');

        if(!isset($this->fields)){
            $return['error'][] = '类型不存在！';
            return $return;
        }
        $fields = $this->fields;

        $info = array();

        foreach($fields as $key=>$val){
            if(isset($param[$key])){
                $info[$val] = $param[$key];
            }else{
                $info[$val] = '';
            }
        }

        if(empty($info)){
            $return['error'][] = '请求参数不存在！';
            return $return;
        }
        if(!isset($info['reference_no']) || $info['reference_no'] == ''){
            $return['error'][] = '订单交易号为空或者不存在！';
            return $return;
        }
        $return['data'] = array('reference_no'=>$info['reference_no'],'customer_code'=>$this->_customer['customer_code']);
        $return['ask'] = 1;
        return $return;
    }
}
