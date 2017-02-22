<?php
class Service_Orders
{
    /**
     * 订单类型转换
     * @return [type] [description]
     */
    public static function getOrderType($type = false)
    {
        $types = array(
            0 => '备货模式',
            1 => '集货模式',
        );
        if ($type !== false) {
            return isset($types[$type]) ? $types[$type] : '';
        }
        return $types;
    }

    /**
     * [getCiqStatus 商检状态]
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getCiqStatus($code = false){
        $status = array(
            0 => '草稿',
            1 => '发送',
            2 => '已入库',
            3 => '入库失败',
        );

        if ($code !== false) {
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;        
    }

    /**
     * 订单状态
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getOrderStatus($code = false)
    {
        $status = array(
            0 => '草单',
            1 => '已关联',
            2 => '异常',
            3 => '已发送',
            4 => '已接收',
        );

        if ($code !== false) {
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;
    }

    public static function getCustomsStatus($code = false)
    {
        $status = array(
            0 => '未插入队列',
            1 => '已插入队列',
        );
        if ($code !== false) {
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;
    }

    /**
     * 进出口类型
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getIeType($code = false)
    {
        $ieType = array(
            // 'NI' => '一般进口',
            // 'NE' => '一般出口',
            'I' => '进口',
            'E' => '出口',
        );
        if ($code !== false) {
            return isset($ieType[$code]) ? $ieType[$code] : '';
        }
        return $ieType;
    }
    /**
     * 业务状态
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function getAppStatus($code = false)
    {
        $status = array(
            1 => '暂存',
            2 => '申报',
        );
        if ($code !== false) {
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;
    }

    /**
     * 申报类型
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function getAppType($code = false)
    {
        $types = array(
            1 => '新增',
            2 => '变更',
            3 => '删除',
        );
        if ($code !== false) {
            return isset($types[$code]) ? $types[$code] : '';
        }
        return $types;
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
        $model = new Table_Orders();
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
        $model = new Table_Orders();
        return $model->update($row, $value, $field);
    }

    public static function delete($value, $field = "order_id")
    {
        $model = new Table_Orders();
        return $model->delete($value, $field);
    }

    public static function getByField($value, $field = 'order_id', $colums = "*")
    {
        $model = new Table_Orders();
        return $model->getByField($value, $field, $colums);
    }
    public static function getAll()
    {
        $model = new Table_Orders();
        return $model->getAll();
    }
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = new Table_Orders();
        $rows  = $model->getByCondition($condition, $type, $pageSize, $page, $order);
        return $rows;
    }

    public static function getByFieldLock($value, $field = 'order_id', $colums = "*")
    {
        $model = new Table_Orders();
        return $model->getByFieldLock($value, $field, $colums);
    }

    public static function getGroupByCondition($condition = array(), $field = 'status')
    {
        $model = new Table_Orders();
        $rows  = $model->getGroupByCondition($condition, $field);
        return $rows;
    }

    public static function getByStatus($status, $pageSize = 0, $minId = 0)
    {
        $model = new Table_Orders();
        return $model->getByStatus($status, $pageSize, $minId);
    }

    public static function getByCiqStatus($orderStatusArr, $status, $pageSize = 0, $minId = 0)
    {
        $model = new Table_Orders();
        return $model->getByCiqStatus($orderStatusArr, $status, $pageSize, $minId);
    }

}
