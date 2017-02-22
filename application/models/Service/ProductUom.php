<?php
class Service_ProductUom
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_ProductUom|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_ProductUom();
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
        $row['pu_update_time']=date('Y-m-d H:i:s');
        return $model->add($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function update($row, $value, $field = "pu_id")
    {
        $model = self::getModelInstance();
        $row['pu_update_time']=date('Y-m-d H:i:s');
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "pu_id")
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
    public static function getByField($value, $field = 'pu_id', $colums = "*")
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
    public static function getKeyVal() {
        $aKeyVal = array();
        $list = self::getAll();
        foreach($list as $row)
            $aKeyVal[$row['pu_code']] = $row['pu_name'];
        return $aKeyVal;
    }

    public static function getNameCodeKV() {
        $kvNameCode = array();
        $list = self::getAll();
        foreach($list as $row)
            $kvNameCode[$row['pu_name']] = $row['pu_code'];
        return $kvNameCode;
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
        
        $validateArr[] = array("name" =>EC::Lang('puCode'), "value" =>$val["pu_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('puName'), "value" =>$val["pu_name"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('puNameEn'), "value" =>$val["pu_name_en"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('puSort'), "value" =>$val["pu_sort"], "regex" => array("positive"));
        return  Common_Validator::formValidator($validateArr);
    }

    /**
     * 获取自定义SQL语句查询结果
     *
     * @access	public
     * @param   string	($field		待返回的字段，默认为所有)
     * @param   string	($condition	查询条件)
     * @param	mixed	($value		待转换查询字段值)
     * @return	mixed
     */
    public static function getCustomQuery($field = '*', $condition = '', $value = '')
    {
    	$model = self::getModelInstance();
    	return $model->getCustomQuery($field, $condition, $value);
    }
    
    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
        
              'E0'=>'pu_id',
              'E1'=>'pu_code',
              'E2'=>'pu_name',
              'E3'=>'pu_name_en',
              'E4'=>'pu_sort',
              'E5'=>'pu_update_time',
        );
        return $row;
    }

}