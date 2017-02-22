<?php
/**
 * 供应商Service
 * 
 * @author Daniel Chen
 * @date 2014.05.16
 */
class Service_Distributor {
  private static $_model = NULL;

  /**
   * 获取Table_Distributor对象
   * 
   * @return object Table_Distributor
   */
  private static function getModelInstance() {
    if (is_null(self::$_model)) {
      self::$_model = new Table_Distributor();
    }

    return self::$_model;
  }

  /**
   * @see Table_Distributor::insert()
   */
  public static function insert($data) {
    $model = self::getModelInstance();

    return $model->insert($data);
  }

  /**
   * @see Table_Distributor::update()
   */
  public static function update($data, $value, $key = NULL) {
    $model = self::getModelInstance();

    return $model->update($data, $value, $key);
  }

  /**
   * @see Table_Distributor::delete()
   */
  public static function delete($value, $key = NULL) {
    $model = self::getModelInstance();

    return $model->delete($value, $key);
  }

  /**
   * @see Table_Distributor::getByPrimaryKey()
   */
  public static function getByPrimaryKey($value) {
    $model = self::getModelInstance();

    return $model->getByPrimaryKey($value);
  }

  /**
   * @see Table_Distributor::getByCode()
   */
  public static function getByCode($code, $customer, $status = 1) {
    $model = self::getModelInstance();

    return $model->getByCode($code, $customer, $status = 1);
  }

  /**
   * @see Table_Distributor::getByCustomerCode()
   */
  public static function getByCustomerCode($code, $condition = array(), $page = 1, $size = 20) {
    $model = self::getModelInstance();

    return $model->getByCustomerCode($code, $condition, $page, $size);
  }

  /**
   * @see Table_Distributor::getByCustomerId()
   */
  public static function getByCustomerId($id, $condition = array(), $page = 1, $size = 20) {
    $model = self::getModelInstance();

    return $model->getByCustomerId($id, $condition, $page, $size);
  }

  /**
   * @see Table_Distributor::getCountByCustomerCode()
   */
  public static function getCountByCustomerCode($code, $condition = array()) {
    $model = self::getModelInstance();

    return $model->getCountByCustomerCode($code, $condition);
  }

  /**
   * @see Table_Distributor::getCountByCustomerId()
   */
  public static function getCountByCustomerId($id, $condition = array()) {
    $model = self::getModelInstance();

    return $model->getCountByCustomerId($id, $condition);
  }

  /**
   * @see Table_Distributor::isRepeatCode()
   */
  public static function isRepeatCode($distributor, $customer, $except = NULL) {
    $model = self::getModelInstance();

    return $model->isRepeatCode($distributor, $customer, $except);
  }
  
	public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
	{
		$model = self::getModelInstance();
		return $model->getByCondition($condition, $type, $pageSize, $page, $order);
	}    
  
}
