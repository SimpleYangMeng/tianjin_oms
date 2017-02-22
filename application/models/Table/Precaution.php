<?php
/**
 * 预警表
 */
class Table_Precaution {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_Precaution();
  }

  /**
   * 数据入库
   * 
   * @param array $data    字段 => 值
   * @return mixed         返回主键值
   */
  public function insert($data) {
    return $this->_table->insert($data);
  }

  /**
   * 数据更新
   * 
   * @param array $data     字段 => 值
   * @param mixed $value    需要检索的字段值
   * @param string $key     需要检索的字段，默认为主键
   * @return integer        所更新的行数
   */
  public function update($data, $value, $key = 'precaution_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->update($data, $where);
  }

  /**
   * 数据删除
   * 
   * @param mixed $value    需要检索的字段值
   * @param string $key     需要检索的字段，默认为主键
   * @return integer        所删除的行数
   */
  public function delete($value, $key = 'precaution_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->delete($where);
  }

  /**
   * 通过指定字段获取数据
   * 
   * @param integer $value 主键值
   * @return mixed
   */
  public function getByField($value, $key = 'precaution_id') {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*')->where("{$key}=?", $value);

    return $this->_table->getAdapter()->fetchRow($select);
  }
}
