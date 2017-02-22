<?php
class Service_Feedback
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Feedback|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_Feedback();
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
    public static function update($row, $value, $field = "feedback_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "feedback_id")
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
    public static function getByField($value, $field = 'feedback_id', $colums = "*")
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
     * [getByCiqStatus 获取商检数据]
     * @param  [type] $status   [description]
     * @param  [type] $pageSize [description]
     * @param  [type] $minId    [description]
     * @return [type]           [description]
     */
    public static function getByCiqStatus($status, $pageSize, $minId){
        $model = self::getModelInstance();
        return $model->getByCiqStatus($status, $pageSize, $minId);
    }
    
    /**
     * [getByFieldLock 锁表]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public static function getByFieldLock($value, $field = 'feedback_id', $colums = "*")
    {
        $model = self::getModelInstance();
        return $model->getByFieldLock($value, $field, $colums);
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
              'E0'=>'feedback_id',
              'E1'=>'first_name',
              'E2'=>'last_name',
              'E3'=>'email',
              'E4'=>'message_type',
              'E5'=>'phone',
              'E6'=>'message',
              'E7'=>'status',
              'E8'=>'add_time',
        );
        return $row;
    }

    /**
     * [getCiqStatus 商检状态]
     * @return [type] [description]
     */
    public static function getCiqStatus($code = false){
        //0:未发送; 1:已发送; 2:申报失败; 3:待回复; 4:已回复
        $status = array(
            0 => '未发送',
            1 => '已发送',
            2 => '申报失败',
            3 => '待回复',
            4 => '已回复',
        );
        if ($code !== false) {
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;        
    }
}