<?php

/**
 * @author luffyzhao
 * @todo 产品新增修改进程
 */
class Service_AccountBookProcess
{

    private $fieldsRegex = array(
        "area"      => array(
            'name'  => '仓库面积',
            'regex' => array(
                'TwoDecimalPlaces', 'require',
            ),
        ),
        "contacter" => array(
            'name'  => '联系人',
            'regex' => array(
                'length[2,6]', 'require', 'GB18030',
            ),
        ),
        "address"   => array(
            'name'  => '仓库地址',
            'regex' => array(
                'length[4,20]', 'require', 'GB18030',
            ),
        ),
        "phone_no"  => array(
            'name'  => '电话号码',
            'regex' => array(
                'phone_no', 'require',
            ),
        ),
    );
    /**
     * 通过方式进来的
     * @var string
     */
    private $type = '';
    /**
     * 字段对照
     * @var array
     */
    private $fields = array(
        'trade_co'     => 'trade_co',
        'trade_name'   => 'trade_name',
        'area'         => 'area',
        'address'      => 'address',
        'contacter'    => 'contacter',
        'phone_no'     => 'phone_no',
        'note'         => 'note',
        'ie_type'      => 'ie_type',
        'customs_code' => 'customs_code',
    );

    /**
     * 构造函数
     * @param string $type [description]
     */
    public function __construct($type = '')
    {
        $this->type = $type;
    }

    /**
     * 新增账册
     * @return [type] [description]
     */
    public function createProductTransaction($accountBookInfo, $customerCode)
    {
        $result = array(
            "ask"     => 0,
            "message" => '账册创建失败！',
            'error'   => array(),
        );

        $data = $this->validate($accountBookInfo, $customerCode);

        if (!empty($data['error'])) {
            $result['error'] = $data['error'];
            return $result;
        }
        $count = Service_Warehouse::getByCondition(array(
            'customer_code'        => $data['data']['customer_code'],
            'ie_type'              => $data['data']['ie_type'],
            'not_warehouse_status' => array('6','7'),
        ), 'count(*)');

        if ($count > 0) {
            $ieTypeRows        = Common_CommonConfig::getIeType2();
            $result['error'][] = $ieTypeRows[$data['data']['ie_type']] . '类型的账册已存在！';
            return $result;
        }

        $warehouseIdRow = Service_Warehouse::getByCondition(array(
            'ie_type'              => $data['data']['ie_type'],
            'customs_using_code'   => $data['data']['customs_using_code'],
            'not_warehouse_status' => array('6','7'),
        ), 'count(*)');
        if (!empty($warehouseIdRow)) {
            $result['error'][] = '海关账册进出口唯一编码重复';
            return $result;
        }

        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {

            $time = date("Y-m-d H:i:s");
            $info = $data['data'];
            // 账册号自动生成
            $prefix                 = "W{$info['customs_code']}" . $info['ie_type'];
            $info['warehouse_code'] = Common_GetNumbers::getCode('warehouseCode', 6, $prefix, '账册编号');
            $info['add_time']       = $time;
            $info['update_time']    = $time;

            $warehouseId = Service_Warehouse::add($info);
            if ($warehouseId === false) {
                throw new Exception('账册创建失败！');
            }

            $warehouseLogRow = array(
                'warehouse_id'   => $warehouseId,
                'warehouse_code' => $info['warehouse_code'],
                'type'           => '1',
                'status_from'    => 0,
                'status_to'      => 0,
                'ip'             => Common_Common::getIP(),
                'comments'       => '增加',
                'user_id'        => 1,
                'account_code'   => $customerCode,
            );

            if (Service_WarehouseLog::add($warehouseLogRow) === false) {
                throw new Exception('账册日志创建失败！');
            }

            $result['ask']           = 1;
            $result['message']       = '账册创建成功';
            $result['warehouseCode'] = $info['warehouse_code'];
            $db->commit();
        } catch (Exception $e) {
            $result['error'][] = $e->getMessage();
            $db->rollback();
        }
        return $result;
    }

    /**
     * 更新产品
     * @param  [type] $productInfo  [description]
     * @param  [type] $customerCode [description]
     * @return [type]               [description]
     */
    public function updatePayOrderTransaction($accountBookInfo, $warehouseCode, $customerCode)
    {
        $result = array(
            "ask"     => 0,
            "message" => '账册创建失败！',
            'error'   => array(),
        );

        $data = $this->validate($info, $customerCode);

        if (!empty($data['error'])) {
            $result['error'] = $data['error'];
            return $result;
        }

        $info         = $data['data'];
        $hasAuthority = Service_Warehouse::getByCondition(array(
            'customer_code'  => $customerCode,
            'warehouse_code' => $warehouseCode,
        ));
        if (empty($hasAuthority)) {
            $result['error'][] = '没有找到这个帐册';
            return $result;
        }

        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try {
            $hasUpdate = Service_Warehouse::update($info, $warehouseCode, 'warehouse_code');
            if ($hasUpdate !== false) {
                $result['ask']           = 1;
                $result['message']       = '账册更新成功';
                $result['warehouseCode'] = $info['warehouse_code'];
                $db->commit();
            }
        } catch (Exception $e) {
            $db->rollback();
        }
        return $result;
    }

    /**
     * 验证数据
     * @param  [type] $payOrderInfo [description]
     * @param  [type] $customerCode [description]
     * @return [type]               [description]
     */
    private function validate($accountBookInfo, $customerCode)
    {
        // echo $customerCode;die();
        $error      = $info      = array();
        $accountRow = Service_Account::getByField($customerCode, 'account_code');
        if ($accountRow['account_level'] == 0) {
            $error[] = '只有子账号才能操作';
        } else {

            foreach ($this->fieldsRegex as $field => $regex) {
                if (!isset($accountBookInfo[$field])) {
                    $this->fieldsRegex[$field]['value'] = '';
                } else {
                    $this->fieldsRegex[$field]['value'] = $accountBookInfo[$field];
                }
            }

            //主管海关代码
            $iePortRow = Service_IePort::getByField($accountBookInfo['customs_code'], 'ie_port');
            if (empty($iePortRow)) {
                $error[] = '主管海关代码不存在';
            }

            $customerRow = Service_Customer::getByField($accountRow['customer_code'], 'customer_code');
            if ($accountBookInfo['customs_code'] != $customerRow['customs_code']) {
                $error[] = '主管海关代码和企业备案的海关代码不一样！';
            }

            if ($customerRow['customer_code'] != $accountBookInfo['trade_co']) {
                $error[] = '主账号代码不正确！';
            }
            // echo $customerRow['trade_co'];
            if ($customerRow['trade_name'] != $accountBookInfo['trade_name']) {
                $error[] = '经营单位名称不正确！';
            }

            $accountBookInfo['customer_code'] = $accountRow['customer_code'];
            $accountBookInfo['account_code']  = $accountRow['account_code'];
        }

        return array(
            'error' => $error,
            'data'  => $accountBookInfo,
        );

    }

    /**
     * 去除空格
     * @param  string $value [description]
     * @return [type]        [description]
     */
    private function fomatRow($row)
    {
        foreach ($row as $k => $v) {
            if (!is_array($v)) {
                $row[$k] = trim($v);
            } else {
                $row[$k] = ($v);
            }
        }
        return $row;
    }

}
