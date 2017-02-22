<?php
class Service_ShippingMethod
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ShippingMethod|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ShippingMethod();
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
    public static function update($row, $value, $field = "sm_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "sm_id")
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
    public static function getByField($value, $field = 'sm_id', $colums = "*")
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
        
        $validateArr[] = array("name" =>EC::Lang('smCode'), "value" =>$val["sm_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('processingFee'), "value" =>$val["sm_mp_fee"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('regFee'), "value" =>$val["sm_reg_fee"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('addons'), "value" =>$val["sm_addons"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('discount'), "value" =>$val["sm_discount"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('freightBestTime'), "value" =>$val["sm_delivery_time_min"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('FreightLowestAging'), "value" =>$val["sm_delivery_time_max"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('status'), "value" =>$val["sm_status"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('smClass'), "value" =>$val["sm_class_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('weightMax'), "value" =>$val["sm_limit_weight"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('warehouse'), "value" =>$val["warehouse_id"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('feeType'), "value" =>$val["sm_fee_type"], "regex" => array("require",));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'sm_id',
              'E1'=>'sm_code',
              'E2'=>'sm_name_cn',
              'E3'=>'sm_name',
              'E4'=>'sm_mp_fee',
              'E5'=>'sm_reg_fee',
              'E6'=>'sm_addons',
              'E7'=>'sm_discount',
              'E8'=>'sm_delivery_time_min',
              'E9'=>'sm_delivery_time_max',
              'E10'=>'sm_delivery_time_avg',
              'E11'=>'sm_is_volume',
              'E12'=>'sm_vol_rate',
              'E13'=>'sm_status',
              'E14'=>'sm_class_code',
              'E15'=>'sm_logo',
              'E16'=>'sm_return_address',
              'E17'=>'sm_discount_min',
              'E18'=>'sm_mp_fee_min',
              'E19'=>'sm_reg_fee_min',
              'E20'=>'sm_limit_volume',
              'E21'=>'sm_limit_weight',
              'E22'=>'sm_sort',
              'E23'=>'sm_is_tracking',
              'E24'=>'sm_is_validate_remote',
              'E25'=>'warehouse_id',
              'E26'=>'sm_fee_type',
        );
        return $row;
    }
	

    public static function getJoinShipmentByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "",$groupBy="")
    {
        $model = self::getModelInstance();
        return $model->getJoinShipmentByCondition($condition, $type, $pageSize, $page, $order,$groupBy);
    }	

}