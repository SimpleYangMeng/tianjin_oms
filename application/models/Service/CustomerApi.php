<?php
class Service_CustomerApi
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_CustomerApi|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_CustomerApi();
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
    public static function update($row, $value, $field = "ca_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "ca_id")
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
    public static function getByField($value, $field = 'ca_id', $colums = "*")
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
        
        $validateArr[] = array("name" =>EC::Lang('customerCode'), "value" =>$val["customer_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('status'), "value" =>$val["ca_status"], "regex" => array("positive"));
        $validateArr[] = array("name" =>EC::Lang('token'), "value" =>$val["ca_token"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('apiKey'), "value" =>$val["ca_key"], "regex" => array("require",));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'ca_id',
              'E1'=>'customer_id',
              'E2'=>'customer_code',
              'E3'=>'ca_status',
              'E4'=>'ca_token',
              'E5'=>'ca_key',
              'E6'=>'ca_add_time',
              'E7'=>'ca_update_time',
        );
        return $row;
    }

}