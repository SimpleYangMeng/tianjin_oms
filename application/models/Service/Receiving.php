<?php
class Service_Receiving
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Receiving|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Receiving();
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
    public static function update($row, $value, $field = "receiving_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "receiving_id")
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
    public static function getByField($value, $field = 'receiving_id', $colums = "*")
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
	
	public static function getByWhere($where, $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByWhere($where, $colums);
    }
	
	public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = new Table_Receiving();
        return $model->getByStatus($status, $pageSize , $minId);
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
     * 状态统计
     * @author solar
     * @param int $customer_id
     * @param int $model_type
     */
    public static function stat($customer_id, $model_type) {
    	$model = self::getModelInstance();
    	return $model->stat($customer_id, $model_type);
    }
	
	public static function getByCiqStatus($status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByCiqStatus($status, $pageSize , $minId);
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
        
              'E0'=>'receiving_id',
              'E1'=>'receiving_code',
              'E2'=>'reference_no',
              'E3'=>'warehouse_id',
              'E4'=>'supplier_id',
              'E5'=>'receiving_update_user',
              'E6'=>'receiving_add_user',
              'E7'=>'customer_id',
              'E8'=>'customer_code',
              'E9'=>'receiving_type',
              'E10'=>'receiving_status',
              'E11'=>'contacter',
              'E12'=>'contact_phone',
              'E13'=>'receiving_description',
              'E14'=>'receiving_add_time',
              'E15'=>'receiving_update_time',
        );
        return $row;
    }

}