<?php
class Service_ShipOrder
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ShipOrder|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ShipOrder();
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
    public static function update($row, $value, $field = "so_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "so_id")
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
    public static function getByField($value, $field = 'so_id', $colums = "*")
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
    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
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
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'so_id',
              'E1'=>'so_code',
              'E2'=>'order_id',
              'E3'=>'order_code',
              'E4'=>'tracking_number',
              'E5'=>'warehouse_id',
              'E6'=>'sm_code',
              'E7'=>'so_status',
              'E8'=>'so_weight',
              'E9'=>'so_vol_weight',
              'E10'=>'so_length',
              'E11'=>'so_width',
              'E12'=>'so_height',
              'E13'=>'so_declared_value',
              'E14'=>'so_insurance_value',
              'E15'=>'so_shipping_fee',
              'E16'=>'currency_code',
              'E17'=>'currency_rate',
              'E18'=>'so_add_time',
              'E19'=>'so_ship_time',
              'E20'=>'so_update_time',
        );
        return $row;
    }

}