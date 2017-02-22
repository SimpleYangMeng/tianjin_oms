<?php
class Service_OtherFee extends Common_Service
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
            self::$_modelClass = new Table_OtherFee();
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
	 * @author william-fan
	 * @todo 用于得到费用单位
	 */
    public static function getFeeUnit(){
    	$feeUnit = array(
    		'1'=>'公斤',
    		'2'=>'单',
    		'3'=>'海关编码'		
    	);
    	return $feeUnit;
    }
	/**
	 * @author william-fan
	 * @todo 是否默认费用
	 */
    public static function getDefaultFee(){
    	$defaultFee = array(
    		'0'=>'否',
    		'1'=>'是'	
    	);
    	return $defaultFee;
    }
    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "fee_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "fee_id")
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
    public static function getByField($value, $field = 'fee_id', $colums = "*")
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

        $validateArr[] = array("name" =>EC::Lang('warehouse'), "value" =>$val["warehouse_id"], "regex" => array("require"));        
        $validateArr[] = array("name" =>EC::Lang('FeeChineseName'), "value" =>$val["fee_name"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('FeeCode'), "value" =>$val["fee_code"], "regex" => array("require"));
        $validateArr[] = array("name" =>EC::Lang('Carrier'), "value" =>$val["fee_application_id"], "regex" => array("require"));
        $validateArr[] = array("name" =>EC::Lang('FeeUnit'), "value" =>$val["fee_unit"], "regex" => array("require"));
        $validateArr[] = array("name" =>EC::Lang('price'), "value" =>$val["fee_value"], "regex" => array("require",'positive1'));
        $validateArr[] = array("name" =>EC::Lang('currency'), "value" =>$val["fee_currency_code"], "regex" => array("require"));
        $validateArr[] = array("name" =>EC::Lang('IsDefaultFee'), "value" =>$val["is_default_fee"], "regex" => array("require"));
        $validateArr[] = array("name" =>EC::Lang('discountMin'), "value" =>$val["fee_discount"], "regex" => array("require"));
        $validateArr[] = array("name" =>EC::Lang('status'), "value" =>$val["status"], "regex" => array("require",));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'fee_id',
              'E1'=>'fee_name',
              'E2'=>'fee_code',
              'E3'=>'warehouse_id',
              'E4'=>'fee_application_id',
              'E5'=>'fee_unit',
              'E6'=>'fee_value',
              'E7'=>'fee_currency_code',
              'E8'=>'is_default_fee',
              'E9'=>'fee_discount',
              'E10'=>'status',
        );
        return $row;
    }
}