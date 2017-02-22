<?php
class Service_ReceivingDetail
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ReceivingDetail|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ReceivingDetail();
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
    public static function update($row, $value, $field = "rd_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "rd_id")
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
    public static function getByField($value, $field = 'rd_id', $colums = "*")
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
	public static function getByWhere($where, $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByWhere($where, $colums);
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
        
              'E0'=>'rd_id',
              'E1'=>'receiving_id',
              'E2'=>'receiving_code',
              'E3'=>'receiving_line_no',
              'E4'=>'rd_status',
              'E5'=>'product_id',
              'E6'=>'product_barcode',
              'E7'=>'rd_receiving_qty',
              'E8'=>'rd_putaway_qty',
              'E9'=>'rd_received_qty',
              'E10'=>'is_qc',
              'E11'=>'is_priority',
              'E12'=>'rd_note',
              'E13'=>'rd_add_time',
              'E14'=>'rd_update_time',
        );
        return $row;
    }

    public static  function getJoinReceivingByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = ""){
        $model = self::getModelInstance();
        return $model->getJoinReceivingByCondition($condition, $type, $pageSize, $page, $order);
    }

    public static function sumNetWeight($receiving_code) {
        $model = self::getModelInstance();
        return $model->sumNetWeight($receiving_code);
    }

    public static function getGroupProduct($receiving_code){
        $model = self::getModelInstance();
        return $model->getGroupProduct($receiving_code);
    }

    public static function getJoinProductByCondition($condition){
        $model = self::getModelInstance();
        return $model->getJoinProductByCondition($condition);
    }

    public static function calNetWeightByCondition($condition){
        $model = self::getModelInstance();
        return $model->calNetWeightByCondition($condition);
    }

}