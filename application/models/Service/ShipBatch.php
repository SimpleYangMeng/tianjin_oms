<?php
class Service_ShipBatch
{
    protected static $status = array(
        '0'=>'草稿','1'=>'已完成','2'=>'已审核','3'=>'已出货'
    );
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ShipBatch|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ShipBatch();
        }
        return self::$_modelClass;
    }

    public static function getStatus() {
        return self::$status;
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
    public static function update($row, $value, $field = "sb_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "sb_id")
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
    public static function getByField($value, $field = 'sb_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }
	
	public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = new Table_ShipBatch();
        return $model->getByStatus($status, $pageSize , $minId);
    }
	
	public static function getByMarkDeleteStatus($status, $pageSize = 0 , $minId = 0){
        $model = new Table_ShipBatch();
        return $model->getByMarkDeleteStatus($status, $pageSize , $minId);
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

}