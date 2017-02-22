<?php
/**
 * 账号权限映射数据表
 * 
 * @author Daniel Chen
 */

class Table_AccountPrivilegeMap {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_AccountPrivilegeMap();
  }

  /**
   * 账号权限映射数据表数据插入
   * 
   * @param array $data 字段 => 值
   * @return mixed 所插入行的主键值
   */
  public function insert($data) {
    return $this->_table->insert($data);
  }

  /**
   * 账号权限映射数据表数据删除
   * 
   * @param array $condition 字段 => 值
   * @return integer 所删除的行数
   */
  public function delete($condition) {
    $where = '1=1';

    foreach ($condition as $field => $value) {
      $where .= ' AND ' . $this->_table->getAdapter()->quoteInto("{$field}=?", $value);
    }

    return $this->_table->delete($where);
  }

  /**
   * 获取子账号权限
   * 
   * @param integer $id 子账号ID
   */
  public function getByAccountId($id) {
    $table = $this->_table->info('name');
    $sql = "SELECT b.*
            FROM {$table} AS a
            LEFT JOIN account_privilege AS b ON a.privilege_id=b.privilege_id
            WHERE a.account_id=?
            ORDER BY b.module_id ASC,b.sort_id ASC";
    $sql = $this->_table->getAdapter()->quoteInto($sql, (int) $id);

    return $this->_table->getAdapter()->fetchAll($sql);
  }
}
