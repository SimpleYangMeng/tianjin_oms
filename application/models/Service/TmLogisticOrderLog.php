<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-9-17
 * Time: 下午6:00
 * To change this template use File | Settings | File Templates.
 */
class Service_TmLogisticOrderLog
{
    /**
     * @var nullwilliam-凡
     */
    public static $_modelClass = null;

    /**
     * @return Table_TrafMode|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_TmLogisticOrderLog();
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
}
