<?php
/**
 * 支付宝支付报文
 */
class Table_AlipayPayOrder {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_AlipayPayOrder();
  }

  public function insert($data) {
    return $this->_table->insert($data);
  }

  public function update($data, $value, $field = 'apo_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$field}=?", $value);

    return $this->_table->update($data, $where);
  }

  public function delete($value, $field = 'apo_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$field}=?", $value);

    return $this->_table->delete($where);
  }

  public function getByField($value, $field = 'apo_id', $column = '*') {
    $select = $this->_table->getAdapter()->select();
    $table  = $this->_table->info('name');

    $select->from($table, $column)->where("{$field}=?", $value);

    return $this->_table->getAdapter()->fetchRow($select);
  }

  public function getByCondition($condition, $column = '*', $orderBy = array('apo_id DESC'), $size = 0, $page = 1) {
    $select = $this->_table->getAdapter()->select();
    $table  = $this->_table->info('name');

    $select->from($table, $column);

    if (isset($condition['apo_id']) && '' !== trim($condition['apo_id'])) {
      $select->where('apo_id=?', (int) trim($condition['apo_id']));
    }

    if (isset($condition['apo_id_gt']) && '' !== trim($condition['apo_id_gt'])) {
      $select->where('apo_id>?', (int) trim($condition['apo_id_gt']));
    }

    if (isset($condition['pay_transaction_no']) && '' !== trim($condition['pay_transaction_no'])) {
      $select->where('pay_transaction_no=?', trim($condition['pay_transaction_no']));
    }

    if (isset($condition['order_no']) && '' !== trim($condition['order_no'])) {
      $select->where('order_no=?', trim($condition['order_no']));
    }

    if (isset($condition['pay_merchant_code']) && '' !== trim($condition['pay_merchant_code'])) {
      $select->where('pay_merchant_code=?', trim($condition['pay_merchant_code']));
    }

    if (isset($condition['payer_cert_no']) && '' !== trim($condition['payer_cert_no'])) {
      $select->where('payer_cert_no=?', trim($condition['payer_cert_no']));
    }

    if (isset($condition['notify_time_start']) && '' !== trim($condition['notify_time_start'])) {
      $select->where('notify_time>=?', trim($condition['notify_time_start']));
    }

    if (isset($condition['notify_time_end']) && '' !== trim($condition['notify_time_end'])) {
      $select->where('notify_time<=?', trim($condition['notify_time_end']));
    }

    if (isset($condition['pay_time_str_start']) && '' !== trim($condition['pay_time_str_start'])) {
      $select->where('pay_time_str>=?', trim($condition['pay_time_str_start']));
    }

    if (isset($condition['pay_time_str_end']) && '' !== trim($condition['pay_time_str_end'])) {
      $select->where('pay_time_str<=?', trim($condition['pay_time_str_end']));
    }

    if (isset($condition['receive_time_start']) && '' !== trim($condition['receive_time_start'])) {
      $select->where('receive_time>=?', trim($condition['receive_time_start']));
    }

    if (isset($condition['receive_time_end']) && '' !== trim($condition['receive_time_end'])) {
      $select->where('receive_time<=?', trim($condition['receive_time_end']));
    }

    if (isset($condition['transform_time_start']) && '' !== trim($condition['transform_time_start'])) {
      $select->where('transform_time>=?', trim($condition['transform_time_start']));
    }

    if (isset($condition['transform_time_end']) && '' !== trim($condition['transform_time_end'])) {
      $select->where('transform_time<=?', trim($condition['transform_time_end']));
    }

    if ('count(*)' === $column) {
      return (int) $this->_table->getAdapter()->fetchOne($select);
    }
    else {
      if (!empty($orderBy)) {
        $select->order($orderBy);
      }

      if ($size > 0 && $page > 0) {
        $offset = ($page - 1) * $size;
        $select->limit($size, $offset);
      }

      return $this->_table->getAdapter()->fetchAll($select);
    }
  }
}
