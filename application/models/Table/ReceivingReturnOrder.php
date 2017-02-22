<?php
/**
 * 退货ASN关联订单表
 */
class Table_ReceivingReturnOrder {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_ReceivingReturnOrder();
  }

  /**
   * 插入数据
   * 
   * @param array $data    关联数组
   * @return integer
   */
  public function insert($data) {
    return $this->_table->insert($data);
  }

  /**
   * 根据退货ASN ID获取关联订单
   * 
   * @param integer $value    退货ASN ID
   * @return mixed
   */
  public function getByReceivingId($value) {
    $select = $this->_table->getAdapter()->select();
    $table  = $this->_table->info('name');
    $select->from($table, '*')->where('receiving_id=?', $value);

    return $this->_table->getAdapter()->fetchAll($select);
  }

  /**
   * 根据退货ASN单号获取关联订单
   * 
   * @param integer $value    退货ASN单号
   * @return mixed
   */
  public function getByReceivingCode($value) {
    $select = $this->_table->getAdapter()->select();
    $table  = $this->_table->info('name');
    $select->from($table, '*')->where('receiving_code=?', $value);

    return $this->_table->getAdapter()->fetchAll($select);
  }

  /**
   * 根据退货ASN订单号获取关联订单
   * 
   * @param integer $value    退货ASN订单号
   * @return mixed
   */
  public function getByOrderCode($value) {
    $select = $this->_table->getAdapter()->select();
    $table  = $this->_table->info('name');
    $select->from($table, '*')->where('order_code=?', $value);

    return $this->_table->getAdapter()->fetchRow($select);
  }
}
