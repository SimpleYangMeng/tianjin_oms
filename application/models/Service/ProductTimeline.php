<?php
/**
 * Product Timeline
 */
class Service_ProductTimeline {
  private static $_model = NULL;

  private static function getModelInstance() {
    if (is_null(self::$_model)) {
      self::$_model = new Table_ProductTimeline();
    }

    return self::$_model;
  }

  /**
   * @see Table_ProductTimeline::insert()
   */
  public static function insert(array $data) {
    $model = self::getModelInstance();

    return $model->insert($data);
  }

  /**
   * @see Table_ProductTimeline::update()
   */
  public static function update(array $data, $productId) {
    $model = self::getModelInstance();

    return $model->update($data, $productId);
  }

  /**
   * @see Table_ProductTimeline::delete()
   */
  public static function delete($productId) {
    $model = self::getModelInstance();

    return $model->delete($productId);
  }

  /**
   * @see Table_ProductTimeline::retrieve()
   */
  public static function retrieve($productId) {
    $model = self::getModelInstance();

    return $model->retrieve($productId);
  }

  /**
   * @see self::retrieve()
   * @return array    没有检索到数据时，各个字段返回空字符串
   */
  public static function get($productId) {
    $data = self::retrieve($productId);

    if (empty($data)) {
      $data = array(
        'product_id'          => '',
        'create_time'         => '',
        'confirm_time'        => '',
        'upload_tax_time'     => '',
        'send_cmbl_time'      => '',
        'audit_custom_time'   => '',
        'audit_ciq_time'      => '',
        'return_draft_time'   => '',
        'first_received_time' => '',
      );
    }

    return $data;
  }

  /**
   * @see self::update()
   * @param boolean $restrict    当记录不存在时，是否强制插入一条记录，默认TRUE
   */
  public static function set(array $data, $productId, $restrict = TRUE) {
    if (TRUE === $restrict) {
      $productId = (int) $productId;
      $timeline  = self::retrieve($productId);

      if (empty($timeline) && $productId > 0) {
        self::insert(array('product_id' => $productId));
      }
    }

    return self::update($data, $productId);
  }
}
