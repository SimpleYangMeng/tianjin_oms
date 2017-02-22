<?php
class Service_ShipBatchAttribute extends Common_Service
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ShipBatchAttribute|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ShipBatchAttribute();
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
    public static function update($row, $value, $field = "sba_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "sba_id")
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
    public static function getByField($value, $field = 'sba_id', $colums = "*")
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
        $validateArr[] = array("name" =>'出入口口岸', "value" =>$val["ie_port"], "regex" => array("require"));
        $validateArr[] = array("name" =>'业务类型', "value" =>$val["form_type"], "regex" => array("require"));
        $validateArr[] = array("name" =>'运输工具', "value" =>$val["traf_name"], "regex" => array("require"));
        $validateArr[] = array("name" =>'车号或船号', "value" =>$val["voyage_no"], "regex" => array("require"));
        $validateArr[] = array("name" =>'成交方式', "value" =>$val["trans_mode"], "regex" => array("require"));
        $validateArr[] = array("name" =>'出入港区运输方式', "value" =>$val["traf_mode"], "regex" => array("require"));
        //$validateArr[] = array("name" =>'包装种类', "value" =>$val["wrap_type"], "regex" => array("require"));
        $validateArr[] = array("name" =>'目的地', "value" =>$val["country_id"], "regex" => array("require",'positive'));
        if(isset($val['conta_id'])) {
        	$validateArr[] = array("name" =>'集装箱号', "value" =>$val["conta_id"], "regex" => array("require"));
        	$validateArr[] = array("name" =>'集装箱规格号', "value" =>$val["conta_model"], "regex" => array("require"));
        	$validateArr[] = array("name" =>'集装箱自重', "value" =>$val["conta_wt"], "regex" => array("require",'positive1'));
        }
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'sba_id',
              'E1'=>'sb_code',
              'E2'=>'refercence_form_id',
              'E3'=>'ie_port',
              'E4'=>'form_type',
              'E5'=>'traf_name',
              'E6'=>'voyage_no',
              'E7'=>'wrap_type',
              'E8'=>'traf_mode',
              'E9'=>'trade_mode',
              'E10'=>'trans_mode',
              'E11'=>'conta_id',
              'E12'=>'country_id',
              'E13'=>'conta_model',
              'E14'=>'pack_no',
              'E15'=>'conta_wt',
        );
        return $row;
    }

}