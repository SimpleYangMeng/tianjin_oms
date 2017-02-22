<?php
class Service_OrderLog
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
            self::$_modelClass = new Table_OrderLog();
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
		
		if($row['order_status_from'] && $row['order_status_to'] && $row['order_status_from']!=$row['order_status_to']){
			$row['ol_type'] = 0;
		}		
        return $model->add($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "ol_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "ol_id")
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
    public static function getByField($value, $field = 'ol_id', $colums = "*")
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
        
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'ol_id',
              'E1'=>'order_id',
              'E2'=>'order_code',
              'E3'=>'ol_type',
              'E4'=>'order_status_from',
              'E5'=>'order_status_to',
              'E6'=>'ol_add_time',
              'E7'=>'user_id',
              'E8'=>'ol_ip',
              'E9'=>'ol_comments',
        );
        return $row;
    }

}