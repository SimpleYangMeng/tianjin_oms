<?php
/**
 * 权限模块数据表
 * 
 * @author Daniel Chen
 */

class Table_AccountPrivilegeModule {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_AccountPrivilegeModule();
  }

  /**
   * 权限模块数据表数据插入
   * 
   * @param array $data 字段 => 值
   * @return mixed 所插入行的主键值
   */
  public function insert($data) {
    return $this->_table->insert($data);
  }

  /**
   * 权限模块数据表数据更新
   * 
   * @param array $data 字段 => 值
   * @param mixed $value 需要检索的字段值
   * @param string $key 需要检索的字段，默认为主键
   * @return integer 所更新的行数
   */
  public function update($data, $value, $key = 'module_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->update($data, $where);
  }

  /**
   * 权限模块数据表数据删除
   * 
   * @param mixed $value 需要检索的字段值
   * @param string $key 需要检索的字段，默认为主键
   * @return integer 所删除的行数
   */
  public function delete($value, $key = 'module_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->delete($where);
  }

  /**
   * 通过主键值获取相应数据
   * 
   * @param integer $value 主键值
   * @return mixed
   */
  public function getByPrimaryKey($value) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*')->where('module_id=?', (int) $value);

    return $this->_table->getAdapter()->fetchRow($select);
  }

  /**
   * 通过指定条件获取所有权限模块
   * 
   * @param array $condition 字段 => 值
   * @return mixed
   */
  public function getAllByCondition($condition) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*');

    if (isset($condition['to_show'])) {
      $select->where('to_show=?', (int) $condition['to_show']);
    }

    if (isset($condition['to_assign'])) {
      $select->where('to_assign=?', (int) $condition['to_assign']);
    }

    if (isset($condition['to_admin'])) {
      $select->where('to_admin=?', (int) $condition['to_admin']);
    }

    $select->order('sort_id ASC');

    return $this->_table->getAdapter()->fetchAll($select);
  }
}
