<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 15-1-22
 * Time: 下午2:17
 * To change this template use File | Settings | File Templates.
 */
class Service_ReceivingXml
{
/**
* @var null
*/
    public static $_modelClass = null;

    /**
     * @return Table_EmailQueue|null
     */
    public static function getModelInstance(){
        if (is_null(self::$_modelClass)){
            self::$_modelClass = new Table_ReceivingXml();
        }
        return self::$_modelClass;
    }

    public static function add($row){
        $model = self::getModelInstance();
        return $model->add($row);
    }

    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "rx_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "rx_id")
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
    public static function getByField($value, $field = 'rx_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
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
}
