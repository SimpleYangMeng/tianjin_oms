<?php
class Service_ShipWeightPrice extends Common_Service
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ShipWeightPrice|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ShipWeightPrice();
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
    public static function update($row, $value, $field = "swp_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "swp_id")
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
    public static function getByField($value, $field = 'swp_id', $colums = "*")
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
        
        $validateArr[] = array("name" =>EC::Lang('firstWeight'), "value" =>$val["swp_weight"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('addedWeight'), "value" =>$val["swp_exces_weight"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('firstWeightFee'), "value" =>$val["swp_cost"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('firstWeightCost'), "value" =>$val["swp_price"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('addedWeightFee'), "value" =>$val["swp_exces_cost"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('addedWeightCost'), "value" =>$val["swp_exces_price"], "regex" => array("require","positive1",));
        $validateArr[] = array("name" =>EC::Lang('currencyCode'), "value" =>$val["currency_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('shipArea'), "value" =>$val["area"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('smCode'), "value" =>$val["sm_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('chargeType'), "value" =>$val["swp_calc_type"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('warehouse'), "value" =>$val["warehouse_id"], "regex" => array("require",));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'swp_id',
              'E1'=>'swp_weight',
              'E2'=>'swp_exces_weight',
              'E3'=>'swp_price',
              'E4'=>'swp_exces_price',
              'E5'=>'currency_code',
              'E6'=>'area',
              'E7'=>'sm_code',
              'E8'=>'swp_calc_type',
              'E9'=>'sm_id',
              'E10'=>'warehouse_id',
              'E11'=>'swp_cost',
              'E12'=>'swp_exces_cost',
        );
        return $row;
    }

}