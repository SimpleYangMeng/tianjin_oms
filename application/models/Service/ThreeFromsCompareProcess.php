<?php
/**
 * 三单比对
 */
class Service_ThreeFromsCompareProcess
{
    private $pim_code    = '';
    private $data        = '';
    private $_error      = '';
    private $_success    = '';
    private $checkStatus = '1'; //校验状态

    public function __construct()
    {

    }
    private function init()
    {
        $this->pim_code    = '';
        $this->data        = '';
        $this->_error      = '';
        $this->_success    = '';
        $this->checkStatus = '1';
    }
    private function getFunction($type)
    {
        switch ($type) {
            case '3BILL_UNIT_CHK':
                $type = 'BILL_UNIT_CHK';
                break;

            case '3BILL_CURR_CHK':
                $type = 'BILL_CURR_CHK';
                break;

            case '3BILL_JE_CHK':
                $type = 'BILL_JE_CHK';
                break;

            case '3BILL_NUM_CHK':
                $type = 'BILL_NUM_CHK';
                break;

            case 'ALL_BILL_CHK':
                break;

            case 'checkProductInventory':
                break;

            case 'checkIdName':
                $type = 'checkIdName';
                break;
            case 'checkTotalPrice':
                $type = 'checkTotalPrice';
                break;
            case 'checkPuCode':
                $type = 'checkPuCode';
                break;
            default:
                $type = 'ALL_BILL_CHK';
                break;
        }
        return $this->{$type}();
    }
    public function getError()
    {
        return $this->_error;
    }
    public function getSuccess()
    {
        return $this->_success;
    }
    /**
     * [getInstance 实例化]
     * @return [type] [description]
     */
    public static function getInstance()
    {
        return new Service_ThreeFromsCompareProcess();
    }
    /**
     * @todo 获取
     */
    public function getCompare($pim_code)
    {
        $this->init();
        $this->pim_code = $pim_code;
        $froms          = Service_FromsCompare::getByCondition(array(), '*', '', '', 'fc_level ASC');
        $db             = Common_Common::getAdapter();
        $db->beginTransaction();
        $return = array(
            'ask'     => '0',
            'message' => '校验失败',
            'error'   => '',
        );
        try {
            $this->getData();   
            foreach ($froms as $key => $value) {
                if ($value['fc_witch'] == '1') {
                    $result = $this->getFunction($value['fc_code']);
                    if (is_array($result)) {
                        if ($this->checkStatus == '0') {
                            if ($this->data['customs_status'] == '1') {
                                $time       = date('Y-m-d H:i:s', time());
                                $orderError = $waybillError = $payOrderError = false;
                                if (!empty($result['error']['order_code'])) {
                                    $orderItem = Service_Orders::getByField($result['error']['order_code'], 'order_code');
                                    /*if(!empty($orderItem)){
                                if($orderItem['order_status'] != '1'){
                                $orderError = true;
                                }
                                }*/
                                }
                                if (!empty($result['error']['wb_code'])) {
                                    $waybill = Service_Waybill::getByField($result['error']['wb_code'], 'wb_code');
                                    /*if(!empty($waybill)){
                                if($waybill['app_status'] != '2'){
                                $waybillError = true;
                                }
                                }*/
                                }
                                if (!empty($result['error']['po_code'])) {
                                    $payOrder = Service_PayOrder::getByField($result['error']['po_code'], 'po_code');
                                    /*if(!empty($payOrder)){
                                if($payOrder['app_status'] != '2'){
                                $payOrderError = true;
                                }
                                }*/
                                }

                                if ($orderError && $waybillError && $payOrderError) {
                                    $log = array(
                                        'pim_id'          => $result['error']['pim_id'],
                                        'pim_code'        => $result['error']['pim_code'],
                                        'pim_status_from' => 1,
                                        'pim_status_to'   => 1,
                                        'pil_comments'    => $result['error']['msg'],
                                        'account_name'    => '',
                                    );
                                    $this->addLog($log);
                                } else {
                                    Service_PersonItem::update(array('is_comparison' => 1, 'customs_status' => '2', 'pim_update_time' => $time), $result['error']['pim_id']);
                                    $log = array(
                                        'pim_id'          => $result['error']['pim_id'],
                                        'pim_code'        => $result['error']['pim_code'],
                                        'pim_status_from' => 1,
                                        'pim_status_to'   => 2,
                                        'pil_comments'    => $result['error']['msg'],
                                        'account_name'    => '',
                                    );
                                    $this->addLog($log);

                                    Service_Orders::update(array('order_status' => 2, 'update_time' => $time), $result['error']['order_code'], 'order_code');
                                    $orderLog = array(
                                        'order_id'          => $orderItem['order_id'],
                                        'order_code'        => $result['error']['order_code'],
                                        'ol_type'           => '0',
                                        'order_status_from' => '1',
                                        'order_status_to'   => '2',
                                        'ol_add_time'       => $time,
                                        'user_id'           => '0',
                                        'ol_ip'             => Common_Common::getIP(),
                                        'ol_comments'       => '三单比对异常',
                                        'account_name'      => '',
                                    );
                                    Service_OrderLog::add($orderLog);

                                    Service_Waybill::update(array('app_status' => 3, 'update_time' => $time), $result['error']['wb_code'], 'wb_code');
                                    $waybillLog = array(
                                        'wb_id'          => $waybill['wb_id'],
                                        'wb_code'        => $result['error']['wb_code'],
                                        'wb_status_from' => '2',
                                        'wb_status_to'   => '3',
                                        'wb_add_time'    => $time,
                                        'user_id'        => '0',
                                        'wb_ip'          => Common_Common::getIP(),
                                        'wb_comments'    => '三单比对异常',
                                        'account_name'   => '',
                                    );
                                    Service_WaybillLog::add($waybillLog);

                                    Service_PayOrder::update(array('app_status' => 3, 'update_time' => $time), $result['error']['po_code'], 'po_code');
                                    $payOrderLog = array(
                                        'po_id'          => $payOrder['po_id'],
                                        'po_code'        => $result['error']['po_code'],
                                        'pl_status_from' => '2',
                                        'pl_status_to'   => '3',
                                        'pl_add_time'    => $time,
                                        'user_id'        => '0',
                                        'pl_ip'          => Common_Common::getIP(),
                                        'pl_comments'    => '三单比对异常',
                                        'account_name'   => '',
                                    );

                                    Service_PayOrderLog::add($payOrderLog);
                                }

                                $this->_error = array('fc_code' => $value['fc_code'], 'pim_code' => $pim_code, 'msg' => $result['error']['msg']);
                                $db->commit();
                                return $return;
                            }
                        }
                    } else {
                        //物品清单不存在
                        $this->_error = array('fc_code' => $value['fc_code'], 'pim_code' => $pim_code, 'msg' => $result); //$result;
                        $db->rollBack();
                        return $return;
                    }
                }
            }
            if ($this->checkStatus == '1') {
                Service_PersonItem::update(array('is_comparison' => 1), $result['success']['pim_id']);
                $log = array(
                    'pim_id'          => $result['success']['pim_id'],
                    'pim_code'        => $result['success']['pim_code'],
                    'pim_status_from' => 1,
                    'pim_status_to'   => 1,
                    'pil_comments'    => '三单比对成功！',
                    'account_name'    => '',
                );
                $this->addLog($log);
                $this->_success    = array('pim_code' => $pim_code, 'msg' => '三单比对成功！');
                $return['ask']     = 1;
                $return['message'] = '校验成功！';
            }
            $db->commit();
        } catch (Exception $e) {
            $this->_error = array('pim_code' => $pim_code, 'msg' => $e->getMessage());
            $db->rollBack();
        }
        return $return;
    }
    /**
     * [check 验证]
     * @param  [type] $type        [description]
     * @param  [type] $personItems [description]
     * @return [type]              [description]
     */
    /*public function check($type){
    $return = array('status'=>1,'message'=>'success','errorMsg'=>array());
    $error = $this->getFunction($type);

    if(count($error) > 0){
    $return['message'] = 'fail';
    $return['status'] = 0;
    $return['errorMsg'] = $error;
    }
    return $return;
    }*/
    /**
     * 添加日志
     */
    public static function addLog($value)
    {
        $row['pim_id']          = $value['pim_id'];
        $row['pim_code']        = $value['pim_code'];
        $row['pim_status_from'] = $value['pim_status_from'];
        $row['pim_status_to']   = $value['pim_status_to'];
        $row['pil_add_time']    = date('Y-m-d H:i:s', time());
        $row['user_id']         = 0;
        $row['pil_ip']          = Common_Common::getIP();
        $row['pil_comments']    = $value['pil_comments'];
        Service_PersonItemLog::add($row);
        return;
    }
    /**
     * [getData 获取数据数组]
     * @return [type] [description]
     */
    private function getData()
    {
        $pim_code = $this->pim_code;
        if (!empty($pim_code)) {
            $res = Service_PersonItem::getByCondition(array('pim_code' => $pim_code, 'customs_status' => '1', 'is_comparison' => '0'));
            if (!empty($res)) {
                $row    = $res[0];
                $pimRow = Service_PersonItem::getByFieldLock($row['pim_id']);
                /*if($pimRow['customs_status']=='1'){

                }*/
                $data = array(
                    'pim_id'                => $row['pim_id'],
                    'pim_code'              => $row['pim_code'],
                    'status'                => $row['status'],
                    'order_code'            => $row['order_code'],
                    'wb_code'               => $row['wb_code'],
                    'po_code'               => $row['po_code'],
                    'agent_customer_code'   => $row['agent_customer_code'],
                    'declare_ie_port'       => $row['declare_ie_port'],
                    'storage_customer_code' => $row['storage_customer_code'],
                    'receive_name'          => $row['receive_name'],
                    'customs_status'        => $row['customs_status'],
                    'ciq_status'            => $row['ciq_status'],
                    'buyer_id'              => $row['buyer_id'],
                    'buyer_name'            => $row['buyer_name'],
                    'freight'               => $row['freight'],
                    'insure_fee'            => $row['insure_fee'],
                );
                if (!empty($row['order_code'])) {
                    $orderItem = Service_Orders::getByField($row['order_code'], 'order_code');
                    if (!empty($orderItem)) {
                        $orderItem     = Service_Orders::getByFieldLock($orderItem['order_id']);
                        $data['order'] = array('currency_code' => $orderItem['currency_code']);
                    } else {
                        $data['order'] = array();
                    }
                } else {
                    $data['order'] = array();
                }
                if (!empty($row['wb_code'])) {
                    $waybill = Service_Waybill::getByField($row['wb_code'], 'wb_code');
                    if (!empty($waybill)) {
                        $waybill         = Service_Waybill::getByFieldLock($waybill['wb_id']);
                        $data['waybill'] = array(
                            'wb_code'   => $waybill['wb_code'],
                            'consignee' => $waybill['consignee'],
                        );
                    } else {
                        $data['waybill'] = array();
                    }
                } else {
                    $data['waybill'] = array();
                }
                if (!empty($row['po_code'])) {
                    $payOrder = Service_PayOrder::getByField($row['po_code'], 'po_code');
                    if (!empty($payOrder)) {
                        Service_PayOrder::getByFieldLock($payOrder['po_id']);
                        $data['payOrder'] = array('pay_currency_code' => $payOrder['pay_currency_code'], 'pay_amount' => $payOrder['pay_amount']);
                    } else {
                        $data['payOrder'] = array();
                    }
                } else {
                    $data['payOrder'] = array();
                }
                if (!empty($row['pim_code'])) {
                    $personItemProduct = Service_PersonItemProduct::getByCondition(array('pim_code' => $row['pim_code']));
                    $personItemProduct = Service_PersonItemProduct::productMerge($personItemProduct);
                    if (!empty($personItemProduct)) {
                        foreach ($personItemProduct as $key => $value) {
                            $data['product'][] = $value;
                            /*array(
                        'goods_id'=>$value['goods_id'],
                        'g_qty'=>$value['g_qty'],
                        'g_uint'=>$value['g_uint'],//申报单位
                        'price'=>$value['price'],
                        'total_price'=>$value['total_price'],
                        'curr'=>$value['curr'],
                        'country'=>$value['country'],
                        'g_model'=>$value['g_model'],
                        'hs_code'=>$value['hs_code'],
                        'g_name_cn'=>$value['g_name_cn'],
                        );*/
                        }
                    } else {
                        $data['product'] = array();
                    }
                }
                if (!empty($row['order_code'])) {
                    $orderProduct = Service_OrderProduct::getByCondition(array('order_code' => $row['order_code']));
                    if (!empty($orderProduct)) {
                        foreach ($orderProduct as $key => $value) {
                            $data['orderProduct'][$value['product_id']] = array(
                                'pu_code'  => $value['pu_code'],
                                'quantity' => $value['quantity'],
                            );
                        }
                    } else {
                        $data['orderProduct'] = array();
                    }
                }
            } else {
                $data = array();
            }
            $this->data = $data;
        } else {
            $this->data = '';
        }
    }
    /**
     * @todo [物品清单缺少三单中任一单电子数据核查]
     */
    private function ALL_BILL_CHK()
    {
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        if (!empty($personItems)) {

            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );

            if ($personItems['customs_status'] == '' || !isset($personItems['customs_status'])) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的海关状态不存在！');
            } else if ($personItems['customs_status'] != '1') {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的海关状态不为已关联！');
            } else if (!empty($personItems['order_code']) && !empty($personItems['wb_code']) && !empty($personItems['po_code'])) {
                if (empty($personItems['order'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的订单信息不存在！');
                } else if (empty($personItems['waybill'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的运单信息不存在！');
                } else if (empty($personItems['payOrder'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的支付单信息不存在！');
                }
            } else {
                if (empty($personItems['order_code'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的订单号不存在！');
                } else if (empty($personItems['wb_code'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的运单号不存在！');
                } else {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的支付单号不存在！');
                }
            }
            if ($personItems['receive_name'] != $personItems['waybill']['consignee']) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】收件人和运单的收件人不一致！');
            }
            if (!empty($error)) {
                $error             = array_merge($error, $error_head);
                $this->checkStatus = '0';
            } else {
                $success = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id']);
            }
            return array('error' => $error, 'success' => $success);
        } else {
            return '物品清单不存在！';
        }
    }
    /**
     * @todo [物品清单申报单位与订单计量单位不一致核查]
     */
    private function BILL_UNIT_CHK()
    {
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        if (!empty($personItems)) {

            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );
            if ($personItems['customs_status'] == '' || !isset($personItems['customs_status'])) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的海关状态不存在！');
            } else if ($personItems['customs_status'] != '1') {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的海关状态不为已关联！');
            } else {
                if (!isset($personItems['order_code']) || !isset($personItems['orderProduct']) || empty($personItems['order']) || empty($personItems['orderProduct'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的产品订单信息不存在！');
                } else if (!isset($personItems['pim_code']) || !isset($personItems['product']) || empty($personItems['pim_code']) || empty($personItems['product'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的产品信息不存在！');
                } else {
                    foreach ($personItems['product'] as $key => $value) {
                        if (!isset($personItems['orderProduct'][$value['product_id']])) {
                            $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的产品种类与订单产品种类不一致！');
                            break;
                        } else if ($value['g_uint'] !== $personItems['orderProduct'][$value['product_id']]['pu_code']) {
                            $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的申报单位' . $value['g_uint'] . '与订单计量单位' . $personItems['orderProduct'][$value['product_id']]['pu_code'] . '不一致！');
                            break;
                        }
                        $productTemp[$value['product_id']]['product_id'] = $value['product_id'];
                    }
                    if (empty($error)) {
                        if (isset($productTemp) && !empty($productTemp)) {
                            if (count($productTemp) != count($personItems['orderProduct'])) {
                                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的产品种类与订单产品种类总数不一致！');
                            }
                        }
                    }
                }
            }

            if (!empty($error)) {
                $error             = array_merge($error, $error_head);
                $this->checkStatus = '0';
            } else {
                $success = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id']);
            }
            return array('error' => $error, 'success' => $success);
        } else {
            return '物品清单不存在！';
        }
    }
    /**
     * @todo [物品清单币制与订单币制、支付单币制不一致]
     */
    private function BILL_CURR_CHK()
    {
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        if (!empty($personItems)) {

            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );

            if ($personItems['customs_status'] == '' || !isset($personItems['customs_status'])) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的海关状态不存在！');
            } else if ($personItems['customs_status'] != '1') {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的海关状态不为已关联！');
            } else if (!isset($personItems['order_code']) || !isset($personItems['order']) || empty($personItems['order']) || empty($personItems['order_code'])) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的订单信息不存在！');
            } else if (!isset($personItems['po_code']) || !isset($personItems['payOrder']) || empty($personItems['po_code']) || empty($personItems['payOrder'])) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的支付信息不存在！');
            } else if (!isset($personItems['product']) || empty($personItems['product'])) {
                $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的币制不存在！');
            } else {
                if (!isset($personItems['order']['currency_code']) || empty($personItems['order']['currency_code'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的订单币值不存在！');
                } else if (!isset($personItems['payOrder']['pay_currency_code']) || empty($personItems['payOrder']['pay_currency_code'])) {
                    $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的支付币值不存在！');
                } else {
                    foreach ($personItems['product'] as $k => $val) {
                        if (!(($val['curr'] == $personItems['payOrder']['pay_currency_code']) && ($val['curr'] == $personItems['order']['currency_code']))) {
                            $error = array('msg' => '物品清单【' . $personItems['pim_code'] . '】的物品清单币制与订单币制、支付单币制不一致!');
                            break;
                        }
                    }
                    if (empty($error)) {
                        $success = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id']);
                    }
                }
            }
            if (!empty($error)) {
                $error             = array_merge($error, $error_head);
                $this->checkStatus = '0';
            }
            return array('error' => $error, 'success' => $success);
        } else {
            return '物品清单不存在！';
        }
    }
    /**
     * @todo [物品清单总价+应征税款与支付单支付总金额进行比较，当比较结果超出预设比对参数（按百分比设置）]
     */
    private function BILL_JE_CHK()
    {
        return array();
    }
    /**
     * @todo [物品清单数量比对：物品清单申报单位与订单计量单位相同时，物品清单申报数量与订单购买数量不一致]
     */
    private function BILL_NUM_CHK()
    {
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        if (!empty($personItems)) {

            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );

            if ($personItems['customs_status'] == '' || !isset($personItems['customs_status'])) {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的订单状态不存在！');
            } else if ($personItems['customs_status'] != '1') {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的订单状态不为已关联！');
            } else if (!isset($personItems['product']) || empty($personItems['product'])) {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的申报数量不存在！');
            } else if (!isset($personItems['order_code']) || !isset($personItems['order']) || empty($personItems['order']) || empty($personItems['order_code'])) {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的订单信息不存在！');
            } else {
                foreach ($personItems['product'] as $k => $val) {
                    if (!isset($personItems['orderProduct'][$val['product_id']]) || empty($personItems['orderProduct'][$val['product_id']])) {
                        $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的订单产品不存在!');
                        break;
                    }
                    $productTemp[$val['product_id']]['g_qty'] = isset($productTemp[$val['product_id']]) ? ($productTemp[$val['product_id']]['g_qty'] + $val['g_qty']) : $val['g_qty'];
                    /*if($val['g_qty'] != $personItems['orderProduct'][$k]['quantity']){
                $error = array('pim_code'=>$personItems['pim_code'],'pim_id'=>$personItems['pim_id'],'msg'=>'物品清单【'.$personItems['pim_code'].'】的申报数量与订单购买数量不一致！');
                break;
                }*/
                }
                if (empty($error)) {
                    if (isset($productTemp) && !empty($productTemp)) {
                        if (count($productTemp) != count($personItems['orderProduct'])) {
                            $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的产品种类与订单产品种类总数不一致！');
                        } else {
                            foreach ($productTemp as $k => $val) {
                                if (!isset($personItems['orderProduct'][$k])) {
                                    $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的产品种类与订单产品种类不一致！');
                                    break;
                                } else if ($val['g_qty'] != $personItems['orderProduct'][$k]['quantity']) {
                                    $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的申报数量与订单购买数量不一致！');
                                    break;
                                }
                            }
                        }
                    }
                }

                if (empty($error)) {
                    $success = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id']);
                }
            }
            if (!empty($error)) {
                $error             = array_merge($error, $error_head);
                $this->checkStatus = '0';
            }
            return array('error' => $error, 'success' => $success);
        } else {
            return '物品清单号不存在！';
        }
    }
    /**
     * [checkProductInventory ]
     * @return [type] [description]
     */
    private function checkProductInventory()
    {
        $personItems         = $this->data;
        $productInventoryObj = new Service_ProductInventoryProcess();
        $error               = array();
        $success             = array();
        if (!empty($personItems)) {

            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );

            if ($personItems['customs_status'] == '' || !isset($personItems['customs_status'])) {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的订单状态不存在！');
            } else if ($personItems['customs_status'] != '1') {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '物品清单【' . $personItems['pim_code'] . '】的订单状态不为已关联！');
            } else if (!isset($personItems['agent_customer_code']) || !isset($personItems['declare_ie_port']) || empty($personItems['agent_customer_code']) || empty($personItems['declare_ie_port'])) {
                $error = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id'], 'msg' => '申报企业客户代码或者申报海关不存在');
            } else {
                $warehouseCondition = array(
                    'customer_code' => $personItems['storage_customer_code'],
                    'ie_type'       => 'I',
                    'warehouse_status'=>'5',
                    'customs_code'  => $personItems['declare_ie_port'],
                );
                $warehouse = Service_Warehouse::getByCondition($warehouseCondition, '*', 1, 1);
                if(empty($warehouse)){
                    $error = array('msg' => "仓储企业{$personItems['storage_customer_code']}不存在审核通过的账册");
                }else{
                    $wh_no = $warehouse[0]['warehouse_code'];
                    if($warehouse[0]['customer_code']!=$personItems['storage_customer_code']){
                        $error = array('msg' => "仓储企业{$personItems['storage_customer_code']}账册和查找的不一致");
                    }else{
                        foreach ($personItems['product'] as $k => $val) {
                            //判断商品和库存的信息
                            $condition = array(
                                'warehouse_code' => $wh_no,
                                'goods_id'       => $val['goods_id'],
                            );

                            $inventorys = Service_ProductInventory::getByCondition($condition, '*', 1, 1);

                            if (empty($inventorys)) {
                                $error = array('msg' => "料件{$val['goods_id']}库存不存在");
                                break;
                            } else {
                                //校验其它信息
                                $inventory = $inventorys[0];

                                //校验规格型号
                                if ($inventory['g_model'] !== $val['g_model']) {
                                    $error = array('msg' => "料件{$val['goods_id']}库存规格型号和个人物品清单的规格型号不一致");
                                    break;
                                }
                                if ($val['g_uint'] !== $inventory['stock_unit']) {
                                    $error = array('msg' => "料件{$val['goods_id']}库存申报单位" . $val['g_uint'] . "和个人物品清单的申报单位" . $inventory['stock_unit'] . "不一致");
                                    break;
                                }
                                if ($inventory['origin_country'] !== $val['country']) {
                                    $error = array('msg' => "料件{$val['goods_id']}库存国家和个人物品清单的国家不一致");
                                    break;
                                }
                                if ($inventory['code_ts'] !== $val['hs_code']) {
                                    $error = array('msg' => "料件{$val['goods_id']}库存海关编码和个人物品清单的海关编码不一致");
                                    break;
                                }
                                if ($inventory['hs_name'] !== $val['g_name_cn']) {
                                    $error = array('msg' => "料件{$val['goods_id']}库存品名和个人物品清单的品名不一致");
                                    break;
                                }

                            }
                            $param = array(
                                'operationType' => 2, //物品清单审核失败
                                'quantity'      => $val['g_qty'],
                                'goodsId'       => $val['goods_id'],
                                'warehouseCode' => $wh_no,
                                'note'          => '三单比对库存成功！',
                            );
                            $result = $productInventoryObj->update($param);
                            if ($result['state'] == '0') {
                                $error = array('msg' => '料件'.$val['goods_id'].'库存更新失败:' . $result['message'][0]['errorMsg']);
                                break;
                            }
                        }
                    }
                }
            }
            if (!empty($error)) {
                $error             = array_merge($error, $error_head);
                $this->checkStatus = '0';
            } else {
                $success = array('pim_code' => $personItems['pim_code'], 'pim_id' => $personItems['pim_id']);
            }
        } else {
            return '物品清单不存在！';
        }
        return array('error' => $error, 'success' => $success);
    }

    /**
     * 验证订购人支付人
     */
    private function checkIdName(){
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        if (!empty($personItems)) {

            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );

            $pay_order  = Service_PayOrder::getByField($personItems['po_code'], 'po_code');

            //支付人和订购人
            if(strcasecmp(trim($personItems['buyer_name']), trim($pay_order['cosignee_name']))){
                $error = array('msg' => '物品清单['.$personItems['pim_code'].']订购人['.$personItems['buyer_name'].']和支付人['.$pay_order['cosignee_name'].']不一致');
            }

            //支付人和订购人身份证对比
            if(strcasecmp(trim($personItems['buyer_id']), trim($pay_order['cosignee_code']))){
                $error = array('msg' => '物品清单['.$personItems['pim_code'].']订购人证件号['.$personItems['buyer_id'].']和支付人证件号['.$pay_order['cosignee_code'].']不一致');
            }

            if (!empty($error)) {
                $error = array_merge($error, $error_head);
                $this->checkStatus = '0';
            }

            return array('error' => $error, 'success' => $success);
        } else {
            return '物品清单号不存在！';
        }
    }

    /**
     * 验证总价
     */
    private function checkTotalPrice(){
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        if (!empty($personItems)) {
            $total_price = 0;
            $total_price += $personItems['freight'];
            $total_price += $personItems['insure_fee'];
            $error_head = array(
                'pim_code'   => $personItems['pim_code'],
                'pim_id'     => $personItems['pim_id'],
                'wb_code'    => $personItems['wb_code'],
                'order_code' => $personItems['order_code'],
                'po_code'    => $personItems['po_code'],
            );
            $person_items_product = Service_PersonItemProduct::getByCondition(array('pim_id' => $personItems['pim_id']));
            if(!empty($person_items_product) && is_array($person_items_product)){
                foreach ($person_items_product as $pi_product) {
                    $total_price += $pi_product['total_price'];
                }
            }
            //总价超过 2000 对比异常
            if( $total_price > 2000 ){
                $error = array('msg' => '物品清单['.$personItems['pim_code'].']总价超过2000');
            }

            if (!empty($error)) {
                $error = array_merge($error, $error_head);
                $this->checkStatus = '0';
            }

            return array('error' => $error, 'success' => $success);
        } else {
            return '物品清单号不存在！';
        }
    }
    /*
        abby
        法定单位为"035"的清单物品净重与法定数量一致 
    */
    private function checkPuCode(){
        $personItems = $this->data;
        $error       = array();
        $success     = array();
        $flag=false;
        $pim_code=$personItems['pim_code'];
        $pi=Service_PersonItem::getByField($pim_code,'pim_code');
        $net_wt=$pi['net_wt'];//pi 净重
        $wt=0;//pip 总和重量
        $person_item_product = Service_PersonItemProduct::getByCondition(array('pim_code' => $pim_code));
        if(empty($person_item_product)){
        	$error['msg']="清单编码[".$pim_code."],物品不存在";
        	return  $error;
        }
    	foreach ($person_item_product as $key => $value) {
            if($value['g_uint']=="035"){ 
                $flag=true;
                continue;
            }else{ 
                break;
            }
        }
        if($flag){ 
            foreach ($person_item_product as $key => $value) {
                $wt+=$value['g_qty']*$value['qty_1'];
            }
           // echo '【debug:'.$msg.$net_wt.';'.$wt.';'.bccomp($net_wt,$wt)."】";
            if($wt>0){ 
                $msg="清单编码[".$pim_code."],";
                if(bccomp($net_wt,$wt)==0){ 
                    $success['msg']= $msg."清单净重与物品总重量一致";  
                }else{ 
                    $error['msg']=$msg."清单净重与物品总重量不符";      
                }
            }else{ 
                $error['msg']=$msg."清单物品总和重量为0";
            }
        }
        if($error){ 
            $error['pim_id']=$personItems['pim_id'];
            $error['pim_code']=$personItems['pim_code'];
            $this->checkStatus = '0';
        }else{ 
            $success['pim_id']=$personItems['pim_id'];
            $success['pim_code']=$personItems['pim_code'];  
            $this->checkStatus = '1'; 
        }
        return array('error' => $error, 'success' => $success);
    } 
}
