<?php
/**
 * 支付宝支付报文
 */
class Service_AlipayPayOrder {
  private static $_model = NULL;

  private function __construct() {
    // Intentionally left blank.
  }

  private function __clone() {
    // Intentionally left blank.
  }

  private static function getModelInstance() {
    if (is_null(self::$_model)) {
      self::$_model = new Table_AlipayPayOrder();
    }

    return self::$_model;
  }

  public static function insert($data) {
    $model = self::getModelInstance();

    return $model->insert($data);
  }

  public static function add($data) {
    return self::insert($data);
  }

  public static function update($data, $value, $field = 'apo_id') {
    $model = self::getModelInstance();

    return $model->update($data, $value, $field);
  }

  public static function delete($value, $field = 'apo_id') {
    $model = self::getModelInstance();

    return $model->delete($value, $field);
  }

  public static function getByField($value, $field = 'apo_id', $column = '*') {
    $model = self::getModelInstance();

    return $model->getByField($value, $field, $column);
  }

  public static function getByCondition($condition, $column = '*', $orderBy = array('apo_id DESC'), $size = 0, $page = 1) {
    $model = self::getModelInstance();

    return $model->getByCondition($condition, $column, $orderBy, $size, $page);
  }
}
