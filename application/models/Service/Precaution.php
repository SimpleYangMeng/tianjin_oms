<?php
/**
 * 预警
 */
class Service_Precaution {
  private static $_model = NULL;

  /**
   * 获取Table_Precaution对象
   * 
   * @return object Table_Precaution
   */
  private static function getModelInstance() {
    if (is_null(self::$_model)) {
      self::$_model = new Table_Precaution();
    }

    return self::$_model;
  }

  /**
   * @see Table_Precaution::insert()
   */
  public static function insert($data) {
    $model = self::getModelInstance();

    return $model->insert($data);
  }

  /**
   * @see Table_Precaution::update()
   */
  public static function update($data, $value, $key = 'precaution_id') {
    $model = self::getModelInstance();

    return $model->update($data, $value, $key);
  }

  /**
   * @see Table_Precaution::delete()
   */
  public static function delete($value, $key = 'precaution_id') {
    $model = self::getModelInstance();

    return $model->delete($value, $key);
  }

  /**
   * @see Table_Precaution::getByField()
   */
  public static function getByField($value, $key = 'precaution_id') {
    $model = self::getModelInstance();

    return $model->getByField($value, $key);
  }
}
