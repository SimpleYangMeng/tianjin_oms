<?php
class Service_PersonItemProduct
{

    public static $_modelClass = null;

    public static $orderType = array(
        '0' => 'Normal',
//             '1'=>'RTV',
        '2' => 'Transfer',
        '3' => 'Self Pickup',
    );
    public static function getOrderType()
    {
        $status[0] = '普通';
        $status[1] = '转仓';
        $status[2] = '退货';
        return $status;
    }

    /**
     *
     * @return Table_Product null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_PersonItemProduct();
        }
        return self::$_modelClass;
    }

    /**
     * 物品清单产品合并
     * @author luffy<luffyzhao@vip.126.com>
     * @dateTime 2016-01-20T17:39:44+0800
     * @param    [type]                   $personItemProduct [description]
     * @return   [type]                                      [description]
     */
    public static function productMerge($personItemProduct)
    {
        if (empty($personItemProduct) || !is_array($personItemProduct)) {
            return false;
        }
        $personItemProductRows = array();
        foreach ($personItemProduct as $product) {
            if (isset($personItemProductRows[$product['registerID']])) {
                $personItemProductRows[$product['registerID']]['total_price'] += $product['total_price'];
                $personItemProductRows[$product['registerID']]['g_qty'] += $product['g_qty'];
            } else {
                $personItemProductRows[$product['registerID']] = $product;
            }
        }
        return $personItemProductRows;
    }
    /*
     * Create A Record
     *
     * @param
     *            rowSet
     * @return boolean
     */
    public static function add($row)
    {
        $model = new Table_PersonItemProduct();
        return $model->add($row);
    }

    /*
     * Update One Row
     *
     * @param $row rowSet
     * @param $order_id int
     * @return boolean
     */
    public static function update($row, $value, $field = "order_id")
    {
        $model = new Table_PersonItemProduct();
        return $model->update($row, $value, $field);
    }

    public static function delete($value, $field = "order_id")
    {
        $model = new Table_PersonItemProduct();
        return $model->delete($value, $field);
    }

    public static function getByField($value, $field = 'order_id', $colums = "*")
    {
        $model = new Table_PersonItemProduct();
        return $model->getByField($value, $field, $colums);
    }
    public static function getAll()
    {
        $model = new Table_PersonItemProduct();
        return $model->getAll();
    }
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = new Table_PersonItemProduct();
        $rows  = $model->getByCondition($condition, $type, $pageSize, $page, $order);
        return $rows;
    }

    public static function getInterceptByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = '')
    {
        $model = new Table_PersonItemProduct();
        $rows  = $model->getInterceptByCondition($condition, $type, $pageSize, $page, $order);

        return $rows;
    }

    public static function getRowByCondition($condition, $type = '*')
    {
        $model = new Table_PersonItemProduct();
        return $model->getRowByCondition($condition, $type);
    }
    /**
     * 计算订单的重量
     * @author solar
     * @param string $order_code
     * @return number
     */
    public static function calculateWeight($order_code)
    {
        $model = new Table_PersonItemProduct();
        return $model->calculateWeight($order_code);
    }

    /**
     * 状态统计
     * @author solar
     * @param int $customer_id
     * @param int $model_type
     * @param int $warehouse_id
     */
    public static function stat($customer_id, $model_type, $warehouse_id)
    {
        $model = new Table_PersonItemProduct();
        return $model->stat($customer_id, $model_type, $warehouse_id);
    }

    public static function getJionOrderOperationTimeByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = new Table_PersonItemProduct();
        return $model->getJionOrderOperationTimeByCondition($condition, $type, $pageSize, $page, $order);
    }

    public static function getLeftJoinAllByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = new Table_PersonItemProduct();
        return $model->getLeftJoinAllByCondition($condition, $type, $pageSize, $page, $order);
    }

}
