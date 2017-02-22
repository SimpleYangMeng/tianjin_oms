<?php
class Service_GoodsListLog
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_OrderLog|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_GoodsListLog();
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
    public static function update($row, $value, $field = "gll_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "gll_id")
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
    public static function getByField($value, $field = 'gll_id', $columns = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $columns);
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
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
            'E0'=>'gll_id',
            'E1'=>'gl_id',
            'E2'=>'gl_code',
            'E3'=>'gl_status_from',
            'E4'=>'gl_status_to',
            'E5'=>'gll_add_time',
            'E6'=>'user_id',
            'E7'=>'gll_ip',
            'E8'=>'gll_comments',
            'E9'=>'account_name',
        );
        return $row;
    }

}