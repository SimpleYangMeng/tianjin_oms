<?php
/**
 * Product Timeline
 */
class Table_ProductTimeline {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_ProductTimeline();
  }

  /**
   * 数据入库
   * 
   * @param array $data
   * @return mixed
   */
  public function insert(array $data) {
    return $this->_table->insert($data);
  }

  /**
   * 数据更新
   * 
   * @param array   $data
   * @param integer $productId
   * @return integer
   */
  public function update(array $data, $productId) {
    $where = $this->_table->getAdapter()->quoteInto('product_id=?', (int) $productId);

    return $this->_table->update($data, $where);
  }

  /**
   * 数据删除
   * 
   * @param integer $productId
   * @return integer
   */
  public function delete($productId) {
    $where = $this->_table->getAdapter()->quoteInto('product_id=?', (int) $productId);

    return $this->_table->delete($where);
  }

  /**
   * 数据检索
   * 
   * @param integer $productId
   * @return mixed
   */
  public function retrieve($productId) {
    $select = $this->_table->getAdapter()->select();
    $table  = $this->_table->info('name');
    $select->from($table, '*');
    $select->where('product_id=?', (int) $productId);

    return $this->_table->getAdapter()->fetchRow($select);
  }
}
