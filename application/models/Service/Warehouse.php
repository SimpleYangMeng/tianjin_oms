<?php
class Service_Warehouse
{
    /**
     * @var null
     */
    public static $_modelClass = null;


    public static function getStatus($code=false)
    {
        # 0:停用;1:待审核;2:审核中;3:已审核;
        $status = array(
            1 => "暂停",
            2 => "待发送海关",
            3 => "已发送海关",
            4 => "海关已接收",
            5 => "海关已审核",
            6 => "审核不通过",
			7 => "终止",
        );

        if($code !== false){
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;
    }
    /**
     * @return Table_Warehouse|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Warehouse();
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
    public static function update($row, $value, $field = "warehouse_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "warehouse_id")
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
    public static function getByField($value, $field = 'warehouse_id', $colums = "*")
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
        $validateArr[] = array("name" =>EC::Lang('warehouseCode'), "value" =>$val["warehouse_code"], "regex" => array("require","english",));
        $validateArr[] = array("name" =>EC::Lang('country'), "value" =>$val["country_id"], "regex" => array("require","integer",));
        $validateArr[] = array("name" =>EC::Lang('status'), "value" =>$val["warehouse_status"], "regex" => array("positive"));
        return  Common_Validator::formValidator($validateArr);
    }

    public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByStatus($status, $pageSize , $minId);
    }


    public static function getGroupByCondition($condition=array(), $field= 'status')
    {
        $rows =  self::getModelInstance()->getGroupByCondition($condition, $field);
        return $rows;
    }

}
