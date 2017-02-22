<?php
class Service_OrderOperationTime
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_OrderOperationTime|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_OrderOperationTime();
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
    public static function update($row, $value, $field = "oot_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "oot_id")
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
    public static function getByField($value, $field = 'oot_id', $colums = "*")
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
        
              'E0'=>'oot_id',
              'E1'=>'order_id',
              'E2'=>'order_code',
              'E3'=>'cutoff_time',
              'E4'=>'submit_time',
              'E5'=>'process_time',
              'E6'=>'pack_time',
              'E7'=>'ship_time',
              'E8'=>'import_time',
              'E9'=>'delivered_time',
              'E10'=>'update_time',
              'E11'=>'process_user_id',
              'E12'=>'pack_user_id',
              'E13'=>'import_user_id',
              'E14'=>'ship_user_id',
              'E15'=>'delivered_user_id',
              'E16'=>'cutoff_user_id',
        );
        return $row;
    }

}