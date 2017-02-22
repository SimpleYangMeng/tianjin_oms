<?php
class Service_CiqCheckResult extends Common_Service
{
	public function getBasePath() {
		return APPLICATION_PATH.'/../data/ciqdata';
	}
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_IePort|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_CiqCheckResult();
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
    public static function update($row, $value, $field = "ccr_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "ccr_id")
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
    public static function getByField($value, $field = 'ccr_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByField($value, $field, $colums);
    }
    /**
     * [getByFieldLock 锁表]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByFieldLock($value, $field = 'ccr_id', $colums = "*"){
        $model = self::getModelInstance();
        return $model->getByFieldLock($value,$field,$colums);
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

        $validateArr[] = array("name" =>EC::Lang('消息类型'), "value" =>$val["api_type"], "regex" => array("require",));
        $validateArr[] = array("name" =>EC::Lang('接口名称'), "value" =>$val["api_name"], "regex" => array("require",));
        return  Common_Validator::formValidator($validateArr);
    }

    /**
     * [getByCiqStatus description]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  integer $min_id    [description]
     * @return [type]            [description]
     */
    public static function getByCiqStatus($status, $min_id , $pageSize = 0){
        $model = self::getModelInstance();
        return $model->getByCiqStatus($status, $min_id, $pageSize);
    }
}