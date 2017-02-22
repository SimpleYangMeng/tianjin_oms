<?php

/**
 * @todo 物品清单
 * @author luffyzhao
 */
class Api_PersonItem extends Api_Web
{
    /**
     * 转换字段对应
     * @var array
     */
    /*protected $fields = array(
        'pim_code'               => 'pim_code',
        'listRefCode'            => 'pim_reference_no', //内部清单编号
        'declare_ie_port'        => 'declare_ie_port', //申报口岸
        'form_type'              => 'form_type', //业务类型
        'customer_code'          => 'customer_code', //电商企业代码
        'enp_name'               => 'enp_name', //电商企业名称
        'whCode'                 => 'storage_customer_code', //仓储企业代码
        'whName'                 => 'storage_name', //仓储企业名称
        'agent_customer_code'    => 'agent_customer_code', //申报单位代码
        'agent_name'             => 'agent_name', //申报单位名称
        'logistic_customer_code' => 'logistic_customer_code', //物流企业代码
        'pay_customer_code'      => 'pay_customer_code', //支付企业代码
        'reference_no'           => 'reference_no', //客户订单号
        'log_no'                 => 'log_no', //运单号
        'pay_no'                 => 'pay_no', //支付单号
        'wrap_type'              => 'wrap_type', //外包装类型
        'ie_port'                => 'ie_port', //进出口口岸
        'traf_mode'              => 'traf_mode', //出入港区运输方式
        'ship_trade_country'     => 'ship_trade_country', //发件人国家
        'ship_name'              => 'ship_name', //发件人
        'ship_city'              => 'ship_city', //发件人城市
        'declare_no'             => 'declare_no', //报关员
        'outset_country_id'      => 'outset_country_id', //启运国
        'aim_country_name'       => 'aim_country_name', //抵运国家
        'receive_name'           => 'receive_name', //收件人姓名
        'receive_telphone'       => 'receive_telphone', //收件人电话
        'receive_country_name'   => 'receive_country_name', //收件人国家
        'receive_state'          => 'receive_state', //州/区域
        'receive_city'           => 'receive_city', //收件人城市
        'receive_id_number'      => 'receive_id_number', //收件人身份证
        'input_company'          => 'input_company', //录入单位
        'agent_address'          => 'agent_address', //单位地址
        'agent_post'             => 'agent_post', //邮编
        'agent_tel'              => 'agent_tel', //电话
        'freight'                => 'freight', //运费
        'insure_fee'             => 'insure_fee', //保费
        'customs_field'          => 'customs_field', //监管场所代码
        'input_no'               => 'input_no', //录入员
        'net_wt'                 => 'net_wt', //净重
        'gross_wt'               => 'gross_wt', //毛重
        'pack_no'                => 'pack_no', //件数
        'i_e_date'               => 'i_e_date', //进出境日期
        'input_date'             => 'input_date', //录入时间
        'declare_date'           => 'declare_date', //申报日期
        'note'                   => 'note', //备注
        'product'                => 'product', //产品信息
        'account_code'           => 'account_code',
        'account_name'           => 'account_name',
        'receiving_address'      => 'receiving_address',
    );*/

    protected $fields = array(
        'pim_code'                      => 'pim_code',
        'listRefNo'                   => 'pim_reference_no', //内部清单编号
        'payEnpCode'                    => 'pay_customer_code', //支付企业代码
        'referenceNo'                   => 'reference_no', //客户订单号
        'logNo'                          => 'log_no', //运单号
        'payNo'                          => 'pay_no', //支付单号
        'consigneeIdNumber'             => 'receive_id_number', //收件人身份证
        'weight'                         => 'gross_wt', //毛重
        'netWeight'                      => 'net_wt', //净重
        'logisticsCode'                 => 'logistic_customer_code',//物流企业代码
        'freight'                        => 'freight', //运费
        'insureFee'                      => 'insure_fee', //保费
        'currencyCode'                   => 'currency', //币种（新增）
        'consigneeCountry'              => 'receive_country_name',
        'consignee'                     => 'receive_name', //收件人姓名
        'consigneeTelephone'            => 'receive_telphone',
        'consigneeProvince'             => 'receive_state',//收件人省
        'consigneeCity'                  => 'receive_city', //收件人城市
        'consigneeAddress'              => 'receiving_address',//收件人地址
        'agentAddress'                   => 'agent_address',//单位地址
        'agentPost'                      => 'agent_post', //邮编
        'agentTelephone'                => 'agent_tel', //单位电话
        'shipperName'                    => 'ship_name',//发件人
        'shipperCountry'                => 'ship_trade_country',//发件人国家
        'shipperCity'                   => 'ship_city',//发件人城市
        'ebpCode'                       => 'customer_code',//电商企业代码
        'ebpName'                       => 'enp_name', //电商企业名称
        'declPort'                      => 'declare_ie_port',//申报口岸
        'iePort'                        => 'ie_port', //进出口口岸
        'storageCode'                   => 'storage_customer_code', //仓储企业代码
        'storageName'                   => 'storage_name', //仓储企业名称
        'agentCode'                     => 'agent_customer_code', //申报单位代码
        'agentName'                     => 'agent_name', //申报单位名称
        'inputName'                     => 'input_no', //录入员
        'inputCompany'                   => 'input_company', //录入单位
        'declareName'                   => 'declare_no', //报关员
        'ieDate'                         => 'i_e_date',//进出境日期
        'inputDate'                      => 'input_date', //录入时间
        'declareDate'                    => 'declare_date',//申报日期
        'wrapType'                       => 'wrap_type', //外包装类型
        'trafMode'                       => 'traf_mode',//运输方式
        'leaveCountry'                  => 'outset_country_id', //启运国
        'destinationCountry'            => 'aim_country_name', //抵运国家
        'formType'                       => 'form_type', //业务类型
        'packNumber'                     => 'pack_no', //件数
        'note'                            => 'note', //备注
        'ecommercePlatformCustomerCode'=> 'ebp_code', //电商平台代码
        'ecommercePlatformCustomerName'=> 'ebp_name',//电商平台名称
        'buyerIdType'                    => 'buyer_id_type',//订购人证件类型
        'buyerIdNumber'                  => 'buyer_id', //订购人证件号码
        'buyerName'                      => 'buyer_name',//订购人姓名
        'product'                        => 'product', //产品信息
    );

    protected $productFields = array(
        'registerId'=>'registerID',
        //'gtCode'=>'gt_code',
        'gNo'=>'g_no',
        'goodsId'=>'goods_id',
        'hsCode'=>'hs_code',
        'hsName'=>'g_name_cn',
        'productModel'=>'g_model',
        'unitPrice'=>'price',
        'quantity'=>'g_qty',
        'legalQty'=>'qty_1',
        'unit'=>'g_uint',
        'legalQty2'=>'qty_2',
        'legalUnit2'=>'unit_2',
        'legalUnit'=>'unit_1',
        'currencyCode'=>'curr',
        'originCountry'=>'country',
        'ciqGNo'=>'ciq_g_no',
    );


    public function run()
    {
        $opType = $this->_param['opType'];
        if ($opType == 'Add' || $opType == 'Update') {
            if (!isset($this->_param['data'])) {
                $this->_error[] = '参数不存在！';
                return false;
            }
            $info = $this->_param['data'];
            // $this->_error = $info;
            // return false;
            if (($info = $this->translate($info)) === false) {
                return false;
            }

            if (isset($info['traf_mode']) && $info['traf_mode'] != '') {
                $traf_mode = Service_TrafMode::getByField($info['traf_mode'], 'traf_mode');
                if (!empty($traf_mode)) {
                    $info['traf_mode'] = $traf_mode['tfm_id'];
                }
            }
            if (isset($info['ship_trade_country']) && $info['ship_trade_country'] != '') {
                $country = Service_Country::getByField($info['ship_trade_country'], 'country_code');
                if (!empty($country)) {
                    $info['ship_trade_country'] = $country['country_id'];
                }
            }
            if (isset($info['receive_country_name']) && $info['receive_country_name'] != '') {
                $country = Service_Country::getByField($info['receive_country_name'], 'country_code');
                if (!empty($country)) {
                    $info['receive_country_name'] = $country['country_id'];
                }
            }
            if (isset($info['aim_country_name']) && $info['aim_country_name'] != '') {
                $country = Service_Country::getByField($info['aim_country_name'], 'country_code');
                if (!empty($country)) {
                    $info['aim_country_name'] = $country['country_id'];
                }
            }
            if (isset($info['outset_country_id']) && $info['outset_country_id'] != '') {
                $country = Service_Country::getByField($info['outset_country_id'], 'country_code');
                if (!empty($country)) {
                    $info['outset_country_id'] = $country['country_id'];
                }
            }

            /*if(isset($info['product']) && $info['product'] != ''){
        foreach ($info['product'] as $key => $value) {
        if(isset($value['country']) && $value['country'] != ''){
        $country = Service_Country::getByField($value['country'],'country_code');
        if(!empty($country)){
        $info['product'][$key]['country'] = $country['country_id'];
        }
        }
        }
        }*/
        } else {
            $info = array(
                'pim_reference_no'      => $this->_param['data']['listRefNo'] ? $this->_param['data']['listRefNo'] : '',
                'storage_customer_code' => $this->_customer['customer_code'] ? $this->_customer['customer_code'] : '',
            );
        }

        // 操作类型
        switch ($opType) {
            case 'Add':
                if (isset($this->_customer['customer_code']) && !empty($this->_customer['customer_code']) && isset($this->_param['whCode']) && !empty($this->_param['whCode'])) {
                    if ($this->_customer['customer_code'] != $this->_param['whCode']) {
                        $result['ask']     = 0;
                        $result['error'][] = '参数whCode错误！';
                        break;
                    }
                }

                $info['account_code'] = $this->_customer['account_code'];
                $account              = Service_Account::getByField($this->_customer['account_code'], 'account_code', 'account_name');
                $info['account_name'] = $account['account_name'];
                $obj                  = new Service_PersonItemProcess(array('param' => $info));
                $result               = $obj->create(true);
                break;

            case 'Get':
                $result = $this->checkGet($info);
                if ($result['ask'] == '1') {
                    $condition = $result['data'];
                    $res       = Service_PersonItem::getByCondition(array(
                        'pim_reference_no'      => $condition['pim_reference_no'],
                        'storage_customer_code' => $condition['storage_customer_code'],
                    ), array('status', 'customs_status', 'ciq_status','pim_code'));
                    if (!empty($res)) {
                        $result['ask']  = 1;
                        //$this->_success = $res[0];
                        /*
						$this->_success['listRefNo'] = $condition['pim_reference_no'];
						$this->_success['refItemNo'] = $res[0]['pim_code'];
						$this->_success['status'] = $res[0]['status'];
                        */
                        $this->_success = array(
                            'listRefNo' => $condition['pim_reference_no'],
                            'refItemNo' => $res[0]['pim_code'],
                            'status' => $res[0]['status'],
                            'customsStatus' => $res[0]['customs_status'],
                            'ciqStatus' => $res[0]['ciq_status']
                        );
                    } else {
                        $result['ask']     = 0;
                        $result['error'][] = '没有数据';
                    }
                }
                break;
            default:
                $this->_error[] = '操作类型错误,只能是Add、Get';
                return false;
        }
        if ($result['ask'] == 0) {
            $this->_message = '失败！';
            $this->_error   = $result['error'];
            return false;
        } else {
            $this->_message = '成功！';
        }
        if (isset($result['pimCode'])) {
            $this->_message = '创建成功！';
            $this->_success = array('pimCode' => $result['pimCode']);
        }
        return true;
    }
    /**
     * [checkGet 清单查询验证请求参数]
     * @param  [type] $info [description]
     * @return [type]       [description]
     */
    private function checkGet($info)
    {
        $return = array('ask' => 0, 'error' => '', 'error !');
        if (empty($info)) {
            $return['error'][] = '请求参数不存在！';
            return $return;
        }
        if (!isset($info['pim_reference_no']) || $info['pim_reference_no'] == '') {
            $return['error'][] = '清单内部编号为空或者不存在！';
            return $return;
        }
        if (!isset($info['storage_customer_code']) || $info['storage_customer_code'] == '') {
            $return['error'][] = '企业编码为空或者不存在！';
            return $return;
        }
        $return['data'] = array('storage_customer_code' => $info['storage_customer_code'], 'pim_reference_no' => $info['pim_reference_no']);
        $return['ask']  = 1;
        return $return;
    }

    /**
     * 物品清单转换
     */
    protected function verification($params , $param)
    {
        //清单数据

        $fields = $this->productFields;

        $products = $params['product'];

        $infos = array();

        foreach($products as $kp=>$vp){
            foreach ($fields as $key => $val) {
                if (isset($vp[$key])) {
                    $info[$val] = $vp[$key];
                } /*else {
                    $info[$val] = '';
                }*/
            }
            $infos[$kp] = $info;
        }

        $params['product'] = $infos;
        return $params;
    }

    /**
     * 订单参数验证
     * @param  string $value [description]
     * @return [type]        [description]
     */
/*    protected function verification($params , $param)
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
'note' => isset($params['note']) ? $params['note'] : ''
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

foreach ($params['orderProduct'] as $product) {
$orderPorductRequestRows[$product['gno']] = array(
'product_no'=> $product['itemNo'],
'registerID'=> $product['gno'],
'hs_code'=> $product['gcode'],
'product_title'=> $product['gname'],
'product_model'=> $product['gmodel'],
'product_barcode'=> isset($product['barCode']) ? $product['barCode'] : '',
'brand'=> $product['brand'],
'pu_code'=> $product['unit'],
'currency_code'=> $product['currency'],
'quantity'=> $product['qty'],
'price'=> $product['price'],
'total_price'=> $product['total'],
'gift_flag'=> $product['giftFlag'],
'note'=> isset($product['note']) ? $product['note'] : '',
);
}
return array(
'orderRow' => $orderRequestRow,
'orderAddressBookRow' => $orderAddressBookRequestRow,
'orderPorductRows' => $orderPorductRequestRows,
);
}*/

}
