<?php
class Service_Currency
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Currency|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Currency();
        }
        return self::$_modelClass;
    }
    public static function getCurrency($lang = 'zh_CN'){
        $currency = Service_Currency::getAll();
        foreach ($currency as $key => $value) {
            $cur['zh_CN'][$value['currency_code']] = $value['currency_name'];
            $cur['en_US'][$value['currency_code']] = $value['currency_name_en'];
        }
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($cur[$lang]) ? $cur[$lang] : $cur;

    }

    public static function getCurrencyCode($lang = 'zh_CN'){
        $currency = Service_Currency::getAll();
        foreach ($currency as $key => $value) {
            $cur['zh_CN'][$value['currency_code']] = $value['b_bbd_currency_code'];
            $cur['en_US'][$value['currency_code']] = $value['b_bbd_currency_code'];
        }
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($cur[$lang]) ? $cur[$lang] : $cur;

    }

    public static function getIePort(){
        $iePort = Service_IePort::getAll();
        foreach ($iePort as $key => $value) {
            $data[$value['ie_port']] = $value['ie_port_name'];
        }
        return isset($data) ? $data : $data;

    }

    public static function getCountry(){
        $country = Service_Country::getAll();
        foreach ($country as $key => $value) {
            $data[$value['country_code']] = $value['country_name'];
        }
        return isset($data) ? $data : $data;

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
    public static function update($row, $value, $field = "currency_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "currency_id")
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
    public static function getByField($value, $field = 'currency_id', $colums = "*")
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

        $validateArr[] = array("name" =>EC::Lang('currencyName'), "value" =>$val["currency_name_en"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('currencyNameEn'), "value" =>$val["currency_name"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('currencyCode'), "value" =>$val["currency_code"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('currencyDecimalPlaces'), "value" =>$val["currency_decimal_places"], "regex" => array("positive"));
        $validateArr[] = array("name" =>EC::Lang('currencyRate'), "value" =>$val["currency_rate"], "regex" => array("require","integer",));
        return  Common_Validator::formValidator($validateArr);
    }


    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(

              'E0'=>'currency_id',
              'E1'=>'currency_name_en',
              'E2'=>'currency_name',
              'E3'=>'currency_code',
              'E4'=>'currency_symbol_left',
              'E5'=>'currency_symbol_right',
              'E6'=>'currency_decimal_point',
              'E7'=>'currency_thousands_point',
              'E8'=>'currency_decimal_places',
              'E9'=>'currency_rate',
              'E10'=>'currency_update_time',
        );
        return $row;
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
}
