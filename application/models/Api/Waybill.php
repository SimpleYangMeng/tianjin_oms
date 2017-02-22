<?php

/**
 * @todo 创建/更新 运单
 * @author luffyzhao
 */
class Api_Waybill extends Api_Web
{
    /**
     * 转换字段对应
     * @var array
     */
    protected $fields = array(
        'ebpCode'              => 'customerCode',//电商企业代码
        'ebpName'              => 'ebp_name',//电商企业名称
        'referenceNo'          => 'referenceNo',//交易订单号
        'logNo'                => 'logNo',//运单号
        'trafMode'             => 'trafMode',//运输方式
        'shipName'             => 'shipName',//运输工具名称
        'voyageNo'             => 'voyageNo',//航班航次号
        'billNo'               => 'billNo',//提运单号
        'freight'              => 'freight',//运费
        'goodsValue'           => 'goodsValue',//订单商品货款
        'currencyCode'         => 'currencyCode',//币制
        'insureFee'            => 'insureFee',//保价费
        'weight'               => 'weight',//毛重
        'netWeight'            => 'netWeight',//净重
        'packNumber'           => 'packNo',//件数
        'parcelInfo'           => 'parcelInfo',//包裹单信息
        'goodsInfo'            => 'goodsInfo',//商品信息
        'consignee'            => 'consignee',//收货人名称
        'consigneeCountry'     => 'consigneeCountry',//收货人所在国
        'consigneeProvince'    => 'consigneeProvince',//收货人所在省份
        'consigneeCity'        => 'consigneeCity',//收货人所在城市
        'consigneeDistrict'    => 'consigneeDistrict',//收货人所在区
        'consigneeAddress'     => 'consigneeAddress',//收货人详细地址
        'consigneeTelephone'   => 'consigneeTelephone',//收货人电话
        'shipper'              => 'shipper',//发货人名称
        'shipperAddress'       => 'shipperAddress',//发货人地址
        'shipperTelephone'     => 'shipperTelephone',//发货人电话
        'shipperCountry'       => 'shipperCountry',//发货人所在国
        'note'                 => 'note',//备注
        'iePort'               => 'customsCode',//主管海关代码
        'ieType'               => 'ieType',//进出口类型
        'logisticsCode'        => 'logistic_customer_code',//物流企业代码
        'logisticsName'        => 'logistic_enp_name',//物流企业名称
        'appStatus'            => 'appStatus',
        'accountCode'          => 'account_code',
    );

    /**
     * [run description]
     * @return [type] [description]
     */
    public function run()
    {
        if (!isset($this->_param['opType']) && empty($this->_param['opType'])) {
            $this->_error[] = '[opType]为必须参数';
            return false;
        }
        $opType = $this->_param['opType'];
        switch ($opType) {
            //新增
            case 'Add':
                if (!isset($this->_param['data']) || empty($this->_param['data'])) {
                    $this->_error[] = '[data]参数不存在！';
                    return false;
                }
                if (($waybillInfo = $this->translate($this->_param['data'])) === false) {
                    return false;
                }
                $waybillInfo['wb_id'] = '';
                $waybillInfo['account_code'] = $this->_param['accountCode'];
                $process              = new Service_WaybillProcess(array('param' => $waybillInfo));
                $result               = $process->create(true);
                break;
            //更新
            case "Update":
                if (!isset($this->_param['data']) || empty($this->_param['data'])) {
                    $this->_error[] = '[data]参数不存在！';
                    return false;
                }
                if (($waybillInfo = $this->translate($this->_param['data'])) === false) {
                    return false;
                }
                $waybillInfo['account_code'] = $this->_param['accountCode'];
                if (!$this->checkInfo($waybillInfo)) {
                    return false;
                }
                $where = array(
                    'log_no'                 => $waybillInfo['logNo'],
                    'logistic_customer_code' => $waybillInfo['logistic_customer_code'],
                    'wb_status'              => 1,
                );
                $process = new Service_WaybillProcess(array('param' => $waybillInfo));
                $result  = $process->updateTransaction($where);
                break;
            //更新妥投状态
            case 'UpdateStatus':
                if (!isset($this->_param['data']) || empty($this->_param['data'])) {
                    $this->_error[] = '[data]参数不存在！';
                    return false;
                }
                //检测参数
                if (!$this->checkDeliveredInfo($this->_param['data'])) {
                    return false;
                }
                $process = new Service_WaybillProcess(array('param' => $this->_param['data']));
                $result  = $process->updateStatusTransaction();
                break;
            //获取
            case 'Get':
                $waybillInfo = array(
                    'logNo'                  => (!isset($this->_param['data']['logNo']) || empty($this->_param['data']['logNo'])) ? '' : $this->_param['data']['logNo'],
                    'logistic_customer_code' => (!isset($this->_param['data']['logisticsCode']) || empty($this->_param['data']['logisticsCode'])) ? '' : $this->_param['data']['logisticsCode'],
                );
                if (!$this->checkInfo($waybillInfo)) {
                    return false;
                }
                $where = array(
                    'log_no'                 => $waybillInfo['logNo'],
                    'logistic_customer_code' => $waybillInfo['logistic_customer_code'],
                    'wb_status'              => 1,
                );
                $waybillData = Service_WaybillProcess::getPayWaybillBywhere($where);
                if (!empty($waybillData) && is_array($waybillData)) {
                    $waybillData              = $this->returnDataPackage($waybillData);
                    $result['ask']            = 1;
                    $this->_success['data'][] = $waybillData;
                    $this->_message           = 'success';
                    return true;
                } else {
                    $this->_error[] = '运单不存在';
                    return false;
                }
                break;
            default:
                $this->_error[] = '操作类型错误, 只能是Add|Update|Get|UpdateStatus';
                return false;
        }

        if ($result['ask'] == 0) {
            $this->_error = $result['message'];
            return false;
        }
        if ($result['ask'] == 1 && isset($result['wb_code'])) {
            $this->_success['data']['wbCode'] = $result['wb_code'];
        } else {
            $this->_success = 1;
        }
        $this->_message = '运单操作成功';
        return true;
    }

    /**
     * [returnDataPackage 返回数据格式化]
     * @param  [type] $waybillData [description]
     * @return [type]               [description]
     */
    protected function returnDataPackage($waybillData)
    {
        //    $fields = array_flip($this->fields);
        $fields = array(
            'log_no'     => 'logNo',
            'wb_code'    => 'wbCode',
            'app_status' => 'status',
            'ciq_status' => 'ciqStatus',
        );
        $returnwaybillData = array();
        foreach ($fields as $key => $value) {
            //if (isset($waybillData[$key]) && !empty($waybillData[$key])) {
            if (isset($waybillData[$key])) {
                $returnwaybillData[$value] = $waybillData[$key];
            }
        }
        return $returnwaybillData;
    }

    /**
     * [checkInfo 参数检查]
     * @param  [type] $waybillInfo [description]
     * @return [type]              [description]
     */
    protected function checkInfo($waybillInfo)
    {
        $mustArr = array(
            'logNo'                  => '运单号',
            'logistic_customer_code' => '客户代码',
        );
        foreach ($mustArr as $key => $value) {
            if (!isset($waybillInfo[$key]) || empty($waybillInfo[$key])) {
                $this->_error[] = $value . '为必须参数';
            }
        }
        return empty($this->_error) ? true : false;
    }

    /**
     * [checkDeliveredInfo 检查妥投数据]
     * @param  [type] $deliveredInfo [description]
     * @return [type]                [description]
     */
    protected function checkDeliveredInfo($deliveredInfo)
    {
        $mustArr = array(
            'logNo'           => '运单号',
            'ieType'          => '进出口类型',
            'logisticsCode'   => '物流企业代码',
            'logisticsName'   => '物流企业名称',
            'deliveredDate'   => '妥投时间',
            'deliveredStatus' => '妥投状态',
            //    'deliveredNote' => '妥投备注',
        );
        foreach ($mustArr as $key => $value) {
            if (!isset($deliveredInfo[$key]) || empty($deliveredInfo[$key])) {
                $this->_error[] = $value . '为必须参数';
            }
        }
        return empty($this->_error) ? true : false;
    }
}
