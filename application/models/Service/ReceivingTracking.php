<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-11-5
 * Time: 下午5:09
 * To change this template use File | Settings | File Templates.
 */
class Service_ReceivingTracking
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_CustomerBalance|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ReceivingTracking();
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

    public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order1 = "",$order2 = ""){
        $model = self::getModelInstance();
        return $model->getByCondition($condition, $type, $pageSize, $page, $order1,$order2);
    }
}
