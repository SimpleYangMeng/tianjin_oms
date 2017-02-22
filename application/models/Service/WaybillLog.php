<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:55
 * To change this template use File | Settings | File Templates.
 */
class Service_WaybillLog
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Customer|null
     */
    public static function getModelInstance(){
        if (is_null(self::$_modelClass)){
            self::$_modelClass = new Table_WaybillLog();
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
    public static function update($row, $value, $field = "wl_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "wl_id")
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
    public static function getByField($value, $field = 'wl_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }
    /**
     * [getByWhere 多条件获取]
     * @param  [type] $where  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByWhere($where, $colums = "*")
    {
        if(empty($where) || !is_array($where)){
            return false;
        }
        $model = self::getModelInstance();
        return $model->getByWhere($where, $colums);
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
     * [getByStatus 根据状态返回数据]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  integer $minId    [description]
     * @return [type]            [description]
     */
    public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByStatus($status, $pageSize , $minId);
    }
}
