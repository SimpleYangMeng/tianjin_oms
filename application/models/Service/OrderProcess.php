<?php
class Service_OrderProcess
{

    private $fieldsRegex = array(
        "ie_type"       => array(
            'name'  => '进出口标志',
            'regex' => array(
                'IN[I,E]', 'require',
            ),
        ),
        "customs_code"  => array(
            'name'  => '主管海关代码',
            'regex' => array(
                'require',
            ),
        ),
        "app_status"    => array(
            'name'  => '业务状态',
            'regex' => array(
                'require', 'IN[1,2]',
            ),
        ),
        "goods_amount"  => array(
            'name'  => '订单商品货款',
            'regex' => array(
                'require', 'FiveDecimalPlaces', 'gt[0]',
            ),
        ),
        "freight"       => array(
            'name'  => '订单商品运费',
            'regex' => array(
                'require', 'FiveDecimalPlaces',
            ),
        ),
        "pro_amount"    => array(
            'name'  => '优惠金额',
            'regex' => array(
                'FiveDecimalPlaces',
            ),
        ),
        "tax_total"    => array(
            'name'  => '订单商品税款',
            'regex' => array(
                'FiveDecimalPlaces',
            ),
        ),
        "acctual_paid"    => array(
            'name'  => '实际支付金额',
            'regex' => array(
                'require','FiveDecimalPlaces',
            ),
        ),
        "buyer_reg_no"    => array(
            'name'  => '订购人注册号',
            'regex' => array(
                'require',
            ),
        ),
        "buyer_name"    => array(
            'name'  => '订购人姓名',
            'regex' => array(
                'require',
            ),
        ),
        "currency_code" => array(
            'name'  => '币制',
            'regex' => array(
                'require',
            ),
        ),
        "reference_no"  => array(
            'name'  => '交易订单号',
            'regex' => array(
                'require',
            ),
        ),
    );

    /**
     * 界面字段对照
     * @var array
     */
    private $webFields = array();

    /**
     * 新增产品
     * @return [type] [description]
     */
    public function createOrderTransaction($orderInfo, $customerCode, $is_api = false)
    {
        $result = array(
            "ask"     => 0,
            "message" => '订单创建失败！',
            'error'   => array(),
        );
        $info = $this->validate($orderInfo, $customerCode, 'add');
        if (!empty($info['error'])) {
            $result['error'] = $info['error'];
            return $result;
        }
        if ($is_api) {
            $ol_comments = 'api-添加！';
        } else {
            $ol_comments = '添加！';
        }

        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $time = date("Y-m-d H:i:s");

            $orderRow            = $info['info']['orderRow'];
            $orderAddressBookRow = $info['info']['orderAddressBookRow'];

            //身份验证 begin
            $orderAddressBookRowTemp['consignee'] = $orderRow['buyer_name'];
            $orderAddressBookRowTemp['consignee_id_number'] = $orderRow['buyer_id'];
            $data                        = $this->validateIdNum($orderAddressBookRowTemp);

            $orderRow['inc_id']          = $data['inc_id'];
            $orderRow['id_check_status'] = $data['id_check_status'];
            //身份验证 end

            $orderPorductRows = $info['info']['orderPorductRows'];

            $orderRow['pro_amount']   = isset($orderRow['pro_amount']) ? $orderRow['pro_amount'] : '0.00';
            $orderRow['pro_remark']   = isset($orderRow['pro_remark']) ? $orderRow['pro_remark'] : '';
            $orderRow['note']         = isset($orderRow['note']) ? $orderRow['note'] : '';
            $orderRow['update_time']  = $orderRow['add_time']  = $time;
            $orderRow['account_code'] = $customerCode;
            $orderRow['app_type']     = 1;
            $orderRow['order_code']   = Common_GetNumbers::getCode('order', 10, 'OC', '订单code');
            $orderRow['buyer_id_type'] = 1;
            $orderRow['buyer_id'] = $orderRow['buyer_id'];

            $orderId = Service_Orders::add($orderRow);

            if ($orderId == false) {
                throw new Exception("订单创建失败！");
            }

            $orderLogRow = array(
                "order_id"          => $orderId,
                "order_code"        => $orderRow['order_code'],
                "ol_add_time"       => $time,
                "user_id"           => '-1',
                "ol_ip"             => Common_Common::getIP(),
                "ol_comments"       => $ol_comments,
                "account_name"      => $customerCode,
                'order_status_from' => 0,
                'order_status_to'   => 0,
            );
            if (Service_OrderLog::add($orderLogRow) == false) {
                throw new Exception("订单日志创建失败！");
            }

            $orderAddressBookRow['order_id']   = $orderId;
            $orderAddressBookRow['order_code'] = $orderRow['order_code'];
            if (Service_OrderAddressBook::add($orderAddressBookRow) == false) {
                throw new Exception("订单收货人信息创建失败！");
            }

            foreach ($orderPorductRows as $orderPorductRow) {
                $orderPorductRow['order_id']   = $orderId;
                $orderPorductRow['order_code'] = $orderRow['order_code'];
                if (Service_OrderProduct::add($orderPorductRow) == false) {
                    throw new Exception("订单产品信息创建失败！");
                }
            }
            $result['ask']       = 1;
            $result['message']   = '订单创建成功！';
            $result['orderCode'] = $orderRow['order_code'];
            // $db->rollback();
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            $result['error'][] = $e->getMessage();
        }
        return $result;
    }

    /**
     * [updateOrderTransaction description]
     * @param  [type] $orderInfo    [description]
     * @param  [type] $orderCode    [description]
     * @param  [type] $customerCode [description]
     * @return [type]               [description]
     */
    public function updateOrderTransaction($orderInfo, $orderCode, $customerCode, $is_api = false)
    {
        $result = array(
            "ask"     => 0,
            "message" => '订单修改失败！',
            'error'   => array(),
        );

        if ($is_api) {
            $ol_comments = 'api-修改！';
        } else {
            $ol_comments = '修改！';
        }

        $info = $this->validate($orderInfo, $customerCode, 'update');
        if (!empty($info['error'])) {
            $result['error'] = $info['error'];
            return $result;
        }

        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $time = date("Y-m-d H:i:s");

            $orderRow            = $info['info']['orderRow'];
            $orderAddressBookRow = $info['info']['orderAddressBookRow'];
            $orderPorductRows    = $info['info']['orderPorductRows'];

            $orderAddressBookRowTemp['consignee'] = $orderRow['buyer_name'];
            $orderAddressBookRowTemp['consignee_id_number'] = $orderRow['buyer_id'];
 
            $data                        = $this->validateIdNum($orderAddressBookRowTemp);
            $orderRow['inc_id']          = $data['inc_id'];
            $orderRow['id_check_status'] = $data['id_check_status'];

            $orderRow['update_time']  = $time;
            $orderRow['account_code'] = $customerCode;
            $orderRow['app_type']     = 1;
            $orderRow['order_status'] = 0;
            $orderRow['buyer_id_type'] = 1;
            $orderRow['buyer_id'] = $orderRow['buyer_id'];

            $orderRowOriginal = Service_Orders::getByFieldLock($orderCode, 'order_code');
            $orderRow         = $this->newOrOriginalContrast($orderRowOriginal, $orderRow);

            if (Service_Orders::update($orderRow, $orderCode, 'order_code') === false) {
                throw new Exception('订单修改失败！');
            }

            $orderLogRow = array(
                "order_id"          => $orderRowOriginal['order_id'],
                "order_code"        => $orderCode,
                "ol_add_time"       => $time,
                "user_id"           => '-1',
                "ol_ip"             => Common_Common::getIP(),
                "ol_comments"       => $ol_comments,
                "account_name"      => $customerCode,
                'order_status_from' => $orderRowOriginal['order_status'],
                'order_status_to'   => 0,
            );

            if (Service_OrderLog::add($orderLogRow) == false) {
                throw new Exception("订单修改失败。原因：订单日志创建失败！");
            }

            if (Service_OrderAddressBook::update($orderAddressBookRow, $orderCode, 'order_code') === false) {
                throw new Exception("订单收货人信息更新失败！");
            }

            //删除重插
            if (Service_OrderProduct::delete($orderCode, 'order_code') === false) {
                throw new Exception("订单修改失败。原因：订单商品修改失败！");
            }

            foreach ($orderPorductRows as $orderPorductRow) {
                $orderPorductRow['order_id']   = $orderRowOriginal['order_id'];
                $orderPorductRow['order_code'] = $orderRowOriginal['order_code'];
                if (Service_OrderProduct::add($orderPorductRow) == false) {
                    throw new Exception("订单产品信息创建失败！");
                }
            }

            $result['ask']       = 1;
            $result['message']   = '订单更新成功！';
            $result['orderCode'] = $orderRowOriginal['order_code'];
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            $result['error'][] = $e->getMessage();
        }

        return $result;
    }

    /**
     * [choiceProduct description]
     * @param  [type] $orderPorductRow [description]
     * @return [type]                  [description]
     */
    public function choiceProduct($orderPorductRow, $customerCode, $ie_type = '', $ie_port = '')
    {
        // print_r($orderPorductRow);die();
        $orderPorductRow = array_map('trim', $orderPorductRow);
        $result          = array(
            "ask"     => 0,
            "message" => '订单创建失败！',
            'error'   => array(),
        );

        $error              = $newOrderPorductRow              = array();
        $newOrderPorductRow = $orderPorductRow;

        $registerID                       = $orderPorductRow['registerID'];
        $productRow                       = Service_Product::getByField($registerID, 'registerID');
        $newOrderPorductRow['product_id'] = $productRow['product_id'];

        if (empty($productRow)) {
            $error[] = $registerID . '商品不存在！';
            // return $result['error'];
        }

        if ($customerCode != $productRow['customer_code']) {
            $error[] = $registerID . '商品不存在！';
        }

        if ($ie_type != '' && $productRow['ie_type'] != $ie_type) {
            $error[] = $registerID . '进出口类型不正确！';
        }

        if (!isset($orderPorductRow['pu_code'])) {
            $error[] = $registerID . '计量单位不能为空！';
        }
        if (!isset($orderPorductRow['item_desc']) || $orderPorductRow['item_desc'] === '') {
            $error[] = $registerID . '企业商品描述不能为空！';
        }
        // elseif($orderPorductRow['pu_code'] != $productRow['g_unit'])
        // {
        //     $productUomRows = Common_DataCache::getProductUomCode();
        //     foreach ($productUomRows as  $productUomRow) {
        //         if($productUomRow['name'] == $orderPorductRow['pu_code']){
        //             $newOrderPorductRow['pu_code'] = $puCode = $productUomRow['code'];
        //         }
        //     }
        //     if($newOrderPorductRow['pu_code'] != $productRow['g_unit']){
        //         $error[]   =   $registerID.'计量单位不正确！';
        //     }
        // }

        if ($orderPorductRow['hs_code'] != $productRow['hs_code']) {
            $error[] = $registerID . "商品海关编码不正确！";
        }

        if ($orderPorductRow['product_title'] != $productRow['product_title']) {
            $error[] = $registerID . "商品标题不正确！";
        }

        // if ($orderPorductRow['product_model'] != $productRow['product_model']) {
        //     $error[] = $registerID . "商品规格不正确！";
        // }

        if ($orderPorductRow['brand'] != $productRow['brand']) {
            $error[] = $registerID . "品牌不正确！";
        }

        if ($productRow['product_status'] != '1') {
            $error[] = $registerID . "不是备案状态！";
        }

        if ($orderPorductRow['currency_code'] != $productRow['currency_code']) {
            $error[] = $registerID . "申报币种不正确！";
        }

        if (!is_numeric($orderPorductRow['quantity']) || ($orderPorductRow['quantity'] <= 0)) {
            $error[] = $registerID . "成交数量不是一个有效的数字！";
        }

        if (!preg_match("/^\d+(\.[\d]{0,2})?$/", $orderPorductRow['price'])) {
            $error[] = $registerID . "成交单价不是一个有效的货币数值！";
        }

        if (!preg_match("/^\d+(\.[\d]{0,2})?$/", $orderPorductRow['total_price'])) {
            $error[] = $registerID . "成交总价不是一个有效的货币数值！";
        }

        if (!isset($orderPorductRow['origin_country']) || $orderPorductRow['origin_country'] === '') {
            $error[] = $registerID . '原产国不能为空！';
        }else{
            $country = Service_Country::getByField($orderPorductRow['origin_country'], 'country_code');
            if(empty($country)){
                $error[] = $registerID . '原产国不存在！';
            }
        }

        if (!is_numeric($orderPorductRow['gift_flag'])) {
            $newOrderPorductRow['gift_flag'] = ($orderPorductRow['gift_flag'] == '否') ? 0 : 1;
        }

        if (!empty($error)) {
            $result['error'] = $error;
        } else {
            $result['ask']             = 1;
            $result['orderPorductRow'] = $newOrderPorductRow;
            $result['productRow']      = $productRow;
        }
        return $result;

    }

    /**
     * 验证
     * @param  [type] $payOrderInfo [description]
     * @param  [type] $customerCode [description]
     * @return [type]               [description]
     */
    private function validate($orderInfo, $customerCode, $type)
    {
        $orderInfoResult = $error = $info = array();
        $accountRow      = Service_Account::getByField($customerCode, 'account_code');
        if ($accountRow['account_level'] == 0) {
            $error[] = '只有子账号才能操作';
        } else {
            $orderRow            = $orderInfo['orderRow'];
            $orderAddressBookRow = $orderInfo['orderAddressBookRow'];
            $orderPorductRows    = $orderInfo['orderPorductRows'];

            $orderAddressBookRow = array_map('trim', $orderAddressBookRow);
            $orderRow            = array_map('trim', $orderRow);

            foreach ($this->fieldsRegex as $field => $regex) {
                if (!isset($orderRow[$field])) {
                    $this->fieldsRegex[$field]['value'] = '';
                } else {
                    $this->fieldsRegex[$field]['value'] = $orderRow[$field];
                }
            }
            $error = Common_Validator::formValidator($this->fieldsRegex);
            if (isset($orderRow['pro_amount']) && $orderRow['pro_amount'] !== '' && !preg_match("/^\d+(\.\d+)?$/", $orderRow['pro_amount'])) {
                $error[] = '优惠金额只能为数值类型';
            }
			if('CNY' != $orderRow['currency_code']){
				$error[] = '币制只能为CNY';
			}
            $customerRow = Service_Customer::getByField($accountRow['customer_code'], 'customer_code');

            $orderRow['customer_code'] = $customerRow['customer_code'];
            $orderRow['customer_name'] = $customerRow['trade_name'];
            $orderRow['customer_id']   = $customerRow['customer_id'];

            if (isset($orderRow['ecommerce_platform_customer_code']) && $orderRow['ecommerce_platform_customer_code'] != '') {
                $platformCustomerRow = Service_Customer::getByField($orderRow['ecommerce_platform_customer_code'], 'customer_code');
                if (empty($platformCustomerRow) || $platformCustomerRow['is_ecommerce'] == 0) {
                    $error[] = '电商平台备案编码不存在！';
                } else {
                    $orderRow['ecommerce_platform_customer_code'] = $platformCustomerRow['customer_code'];
                    $orderRow['ecommerce_platform_customer_name'] = $platformCustomerRow['trade_name'];
                }
            } else {
                $orderRow['ecommerce_platform_customer_code'] = $customerRow['customer_code'];
                $orderRow['ecommerce_platform_customer_name'] = $customerRow['trade_name'];
            }

            if ($type == 'add') {
                $orderCount = Service_Orders::getByCondition(array(
                    'customer_code' => $customerRow['customer_code'],
                    'reference_no'  => $orderRow['reference_no'],
                ), 'count(*)');

                if ($orderCount > 0) {
                    $error[] = '交易订单号已存在！';
                }
            }
            if(empty($orderRow['buyer_id'])){
                $error[] = "订购人身份证必填！";
            }else{
                if (!preg_match("/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/i", $orderRow['buyer_id'])) {
                    $error[] = "订购人身份证格式不正确！";
                }
            }

            $iePortRow = Service_IePort::getByField($orderRow['customs_code'], 'ie_port');
            if (empty($iePortRow)) {
                $error[] = '主管海关代码不存在';
            }
            if (!isset($orderAddressBookRow['consignee_country'])) {
                $error[] = '收货人所在国不存在';
            }
            $regexCountryCode = Common_DataCache::getCountryByCode($orderAddressBookRow['consignee_country']);
            if ($regexCountryCode === false) {
                $error[] = '收货人所在国不存在';
            }
            if (!isset($orderAddressBookRow['consignee_addres']) || $orderAddressBookRow['consignee_addres']=='') {
                $error[] = '收货人地址必填';
            }
            if (!isset($orderAddressBookRow['consignee_telephone']) || $orderAddressBookRow['consignee_telephone']=='') {
                $error[] = '收货人电话必填';
            }

            if (!preg_match("/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/i", $orderAddressBookRow['consignee_id_number'])) {
                $error[] = "订单身份证格式不正确！";
            }

            // print_r($orderPorductRows);die();
            $ieType = false;
            if (!empty($orderPorductRows)) {
                foreach ($orderPorductRows as $registerID => $orderPorductRow) {
                    $orderPorductRow['registerID'] = $registerID;
                    $choiceResult                  = $this->choiceProduct($orderPorductRow, $customerRow['customer_code'], $orderRow['ie_type'], $orderRow['customs_code']);
                    if ($choiceResult['ask'] == 0) {
                        $error = array_merge($error, $choiceResult['error']);
                    } else {
                        $orderPorductRows[$registerID] = $choiceResult['orderPorductRow'];
                        $ieType                        = ($ieType === false) ? $choiceResult['productRow']['ie_type'] : $ieType;
                        if ($ieType != $choiceResult['productRow']['ie_type']) {
                            $error[] = '所选商品不是同种进出口类型！';
                        }
                    }
                }
            } else {
                $error[] = '订单商品信息不能为空';
            }

            $orderInfoResult = array(
                'orderRow'            => $orderRow,
                'orderAddressBookRow' => $orderAddressBookRow,
                'orderPorductRows'    => $orderPorductRows,
            );
        }

        return array(
            'error' => $error,
            'info'  => $orderInfoResult,
        );
    }

    /**
     * 身份证验证
     * @param  [type] $payOrderInfo [description]
     * @param  [type] $customerCode [description]
     * @return [type]               [description]
     */
    private function validateIdNum($orderAddressBookRow)
    {
        $idNumberCheck = Service_IdNumberCheck::getByCondition(array(
            'id_name'  => $orderAddressBookRow['consignee'],
            'idNumber' => $orderAddressBookRow['consignee_id_number'],
        ));

        if (empty($idNumberCheck)) {
            $row = array(
                'id_name'  => $orderAddressBookRow['consignee'],
                'IdType'   => 1,
                'status'   => 0,
                'idNumber' => $orderAddressBookRow['consignee_id_number'],
            );
            $incId = Service_IdNumberCheck::add($row);
            $data  = array(
                'inc_id'          => $incId,
                'id_check_status' => 0,
            );
            return $data;
        } else {
            if ($idNumberCheck[0]['status'] == 2) {
//验证通过
                $data = array(
                    'inc_id'          => $idNumberCheck[0]['inc_id'],
                    'id_check_status' => 1,
                );
                return $data;
            } elseif ($idNumberCheck[0]['status'] == 3) {
//验证不通过
                $data = array(
                    'inc_id'          => $idNumberCheck[0]['inc_id'],
                    'id_check_status' => 0,
                );
                return $data;
            }
            return array(
                'inc_id'          => $idNumberCheck[0]['inc_id'],
                'id_check_status' => 0,
            );
        }
    }

    /**
     * 验证修改数据
     * @param  [type] $originalData [description]
     * @param  [type] $newData      [description]
     * @return [type]               [description]
     */
    private function newOrOriginalContrast($originalData, $newData)
    {
        $info = array();
        foreach ($originalData as $key => $value) {
            if (isset($newData[$key])) {
                $info[$key] = $newData[$key];
            }
        }
        return $info;
    }
}
