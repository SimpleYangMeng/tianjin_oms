<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:55
 * To change this template use File | Settings | File Templates.
 */
class Service_Waybill
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
            self::$_modelClass = new Table_Waybill();
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
     * [getCiqStatus 商检状态]
     * @return [type] [description]
     */
    public static function getCiqStatus(){
        return array(
            '0' => '草稿',
            '1' => '已发送',
            '2' => '已接收',
            '3' => '接收失败',
        );
    }

    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "wb_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "wb_id")
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
    public static function getByField($value, $field = 'wb_id', $colums = "*")
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
    
    /**
     * [getGroupByCondition 分组统计]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function getGroupByCondition($condition=array(), $field= 'app_status')
    {
        $model = self::getModelInstance();
        return $model->getGroupByCondition($condition, $field);
    }
    /**
     * [getByCiqStatus 获取商检数据]
     * @param  [type] $status   [description]
     * @param  [type] $pageSize [description]
     * @param  [type] $minId    [description]
     * @return [type]           [description]
     */
    public static function getByCiqStatus($appStatusArr, $status, $pageSize, $minId){
        $model = self::getModelInstance();
        return $model->getByCiqStatus($appStatusArr, $status, $pageSize, $minId);
    }
    public static function getByFieldLock($value, $field = 'wb_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByFieldLock($value, $field, $colums);
    }
}
