<?php
class Service_CustomerAddressBook
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_CustomerAddressBook|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_CustomerAddressBook();
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
    public static function update($row, $value, $field = "cab_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "cab_id")
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
    public static function getByField($value, $field = 'cab_id', $colums = "*")
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
        
              'E0'=>'cab_id',
              'E1'=>'customer_code',
              'E2'=>'customer_id',
              'E3'=>'cab_type',
              'E4'=>'cab_company',
              'E5'=>'cab_firstname',
              'E6'=>'cab_lastname',
              'E7'=>'cab_country_id',
              'E8'=>'cab_zone_id',
              'E9'=>'cab_state',
              'E10'=>'cab_city',
              'E11'=>'cab_suburb',
              'E12'=>'cab_street_address1',
              'E13'=>'cab_street_address2',
              'E14'=>'cab_postcode',
              'E15'=>'cab_phone',
              'E16'=>'cab_cell_phone',
              'E17'=>'cab_fax',
              'E18'=>'cab_email',
              'E19'=>'cab_note',
              'E20'=>'cab_updata_time',
        );
        return $row;
    }

}