<?php
class Service_SmCountryMap
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_SmCountryMap|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_SmCountryMap();
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
    public static function update($row, $value, $field = "smcm_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "smcm_id")
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
    public static function getByField($value, $field = 'smcm_id', $colums = "*")
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

    public static function getLeftJoinCountryByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
        $model = self::getModelInstance();
        return $model->getLeftJoinCountryByCondition($condition, $type, $pageSize, $page, $order);
    }

    /**
     * @param $val
     * @return array
     */
    public static function validator($val)
    {
        $validateArr = $error = array();
        
        $validateArr[] = array("name" =>EC::Lang('country'), "value" =>$val["country_id"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('warehouse'), "value" =>$val["warehouse_id"], "regex" => array("require",));
       // $validateArr[] = array("name" =>EC::Lang('country_code'), "value" =>$val["country_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('shipArea'), "value" =>$val["area"], "regex" => array("require",));
       // $validateArr[] = array("name" =>EC::Lang('smCode'), "value" =>$val["sm_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('chargeType'), "value" =>$val["smcm_fee_type"], "regex" => array("require",));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'smcm_id',
              'E1'=>'country_id',
              'E2'=>'warehouse_id',
              'E3'=>'province_id',
              'E4'=>'city_id',
              'E5'=>'country_name',
              'E6'=>'country_code',
              'E7'=>'area',
              'E8'=>'sm_id',
              'E9'=>'sm_code',
              'E10'=>'smcm_fee_type',
        );
        return $row;
    }
    
    /**
     * @desc 用于物流计费
     */
    public static function getByInCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {
    	$model = self::getModelInstance();
    	return $model->getByInCondition($condition, $type, $pageSize, $page, $order);
    }

}