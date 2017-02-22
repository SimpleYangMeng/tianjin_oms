<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:55
 * To change this template use File | Settings | File Templates.
 */
class Service_Account
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Customer|null
     */
    public static function getModelInstance(){
        if (is_null(self::$_modelClass)){
            self::$_modelClass = new Table_Account();
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
    public static function update($row, $value, $field = "account_id")
    {
        $model = self::getModelInstance();
        return $model->update($row, $value, $field);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public static function delete($value, $field = "account_id")
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
    public static function getByField($value, $field = 'account_id', $colums = "*")
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
     * @author william-fan
     * @todo 用于校验账户类型
     */
    public static function getAccountType($account_code){
        $model = self::getModelInstance();
        $account =  $model->getByField($account_code, 'account_code');
        if(empty($account)){
            return false;
        }else{
            return $account['account_level'];
        }
    }
    /**
     * @author william-fan
     * @todo 抛出异常
     */
    public static function getAccountTypeException($account_code){
        if(self::getAccountType($account_code)!='1'){
            throw new Exception('只有子账号才能操作');
        }
    }
}
