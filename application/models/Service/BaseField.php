<?php
class Service_BaseField extends Common_Service
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_BaseField|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_BaseField();
        }
        return self::$_modelClass;
    }

    /**
     * @param $row
     * @return mixed
     */
    public static function add($row)
    {
        $model = self::getModelInstance();
        return $model->add($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = 'pbf_id')
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = 'pbf_id')
    {
        $model = self::getModelInstance();
        return $model->delete($value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'pbf_id', $colums = '*')
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

    /**
     * @return mixed
     */
    public static function getAll()
    {
        $model = self::getModelInstance();
        return $model->getAll();
    }

    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $order
     * @return mixed
     */
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = '')
    {
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $type, $pageSize, $page, $order);
    }

    /**
     * @param $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();
        
        return  Common_Validator::formValidator($validateArr);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getFields()
    {
        $row = array(
              'E0' => 'pbf_id',
              'E1' => 'table_name',
              'E2' => 'field_name',
              'E3' => 'field_desc'
        );
        return $row;
    }

    /**
     * [getTableName 获取表名]
     * @return [type] [description]
     */
    public static function getTableName(){
        return array(
            'customer' => '企业备案表体',
            'customer_attribute' => '企业备案附加表',
            'customer_attached' => '企业备案附件表',
            'product' => '商品表体',
            'person_item' => '物品清单表体',
            'person_item_product' => '物品清单商品表',
            'orders' => '订单表体',
            'order_product' => '订单商品',
            'pay_order' => '支付单表体',
            'waybill' => '运单表体',
        );
    }
}