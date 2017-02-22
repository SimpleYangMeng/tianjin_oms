<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-4-8
 * Time: 下午6:08
 * To change this template use File | Settings | File Templates.
 */
class Service_ReceivingAttribute
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_CustomerBalance|null
     */
    public static function getModelInstance(){
        if (is_null(self::$_modelClass)){
            self::$_modelClass = new Table_ReceivingAttribute();
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
    public static function update($row, $value, $field = "ra_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public static function getByField($value, $field = 'ra_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }

}
