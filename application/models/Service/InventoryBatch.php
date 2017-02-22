<?php
class Service_InventoryBatch
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_InventoryBatch|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_InventoryBatch();
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
    public static function update($row, $value, $field = "ib_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "ib_id")
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
    public static function getByField($value, $field = 'ib_id', $colums = "*")
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
        
              'E0'=>'ib_id',
              'E1'=>'lc_code',
              'E2'=>'product_id',
              'E3'=>'product_barcode',
              'E4'=>'reference_no',
              'E5'=>'application_code',
              'E6'=>'supplier_id',
              'E7'=>'warehouse_id',
              'E8'=>'receiving_code',
              'E9'=>'receiving_id',
              'E10'=>'lot_number',
              'E11'=>'ib_status',
              'E12'=>'ib_hold_status',
              'E13'=>'ib_quantity',
              'E14'=>'ib_fifo_time',
              'E15'=>'ib_note',
              'E16'=>'ib_add_time',
              'E17'=>'ib_update_time',
        );
        return $row;
    }

}