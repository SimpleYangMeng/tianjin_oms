<?php
/**
 * 退货ASN订单关联Service
 */
class Service_ReceivingReturnOrder {
  private static $_model = NULL;

  /**
   * 获取Table_ReceivingReturnOrder对象
   * 
   * @return object Table_ReceivingReturnOrder
   */
  private static function getModelInstance() {
    if (is_null(self::$_model)) {
      self::$_model = new Table_ReceivingReturnOrder();
    }

    return self::$_model;
  }

  /**
   * 插入数据
   * 
   * @see Table_ReceivingReturnOrder::insert()
   */
  public static function insert($data) {
    $model = self::getModelInstance();

    return $model->insert($data);
  }

  /**
   * 根据退货ASN ID获取关联订单
   * 
   * @see Table_ReceivingReturnOrder::getByReceivingId()
   */
  public static function getByReceivingId($value) {
    $model = self::getModelInstance();

    return $model->getByReceivingId($value);
  }

  /**
   * 根据退货ASN单号获取关联订单
   * 
   * @see Table_ReceivingReturnOrder::getByReceivingCode()
   */
  public static function getByReceivingCode($value) {
    $model = self::getModelInstance();

    return $model->getByReceivingCode($value);
  }

  /**
   * 根据退货ASN订单号获取关联订单
   * 
   * @param integer $value    退货ASN订单号
   * @return mixed
   */
  public static function getByOrderCode($value) {
    $model = self::getModelInstance();

    return $model->getByOrderCode($value);
  }
}
