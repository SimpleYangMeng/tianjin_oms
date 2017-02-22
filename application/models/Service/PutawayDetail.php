<?php
class Service_PutawayDetail
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_PutawayDetail|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_PutawayDetail();
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
    public static function update($row, $value, $field = "pd_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "pd_id")
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
    public static function getByField($value, $field = 'pd_id', $colums = "*")
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
        
              'E0'=>'pd_id',
              'E1'=>'putaway_id',
              'E2'=>'putaway_code',
              'E3'=>'receiving_code',
              'E4'=>'lc_code',
              'E5'=>'pd_type',
              'E6'=>'product_barcode',
              'E7'=>'product_id',
              'E8'=>'pd_quantity',
              'E9'=>'pd_lot_number',
              'E10'=>'warehouse_id',
              'E11'=>'pd_note',
              'E12'=>'pd_status',
              'E13'=>'putaway_user_id',
              'E14'=>'pd_add_time',
              'E15'=>'pd_update_time',
              'E16'=>'pd_putaway_time',
        );
        return $row;
    }

}