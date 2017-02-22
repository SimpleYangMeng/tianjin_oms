<?php
/**
 * 权限数据表
 * 
 * @author Daniel Chen
 */

class Table_AccountPrivilege {
  protected $_table = NULL;

  public function __construct() {
    $this->_table = new DbTable_AccountPrivilege();
  }

  /**
   * 权限数据表数据插入
   * 
   * @param array $data 字段 => 值
   * @return mixed 所插入行的主键值
   */
  public function insert($data) {
    return $this->_table->insert($data);
  }

  /**
   * 权限数据表数据更新
   * 
   * @param array $data 字段 => 值
   * @param mixed $value 需要检索的字段值
   * @param string $key 需要检索的字段，默认为主键
   * @return integer 所更新的行数
   */
  public function update($data, $value, $key = 'privilege_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->update($data, $where);
  }

  /**
   * 权限数据表数据删除
   * 
   * @param mixed $value 需要检索的字段值
   * @param string $key 需要检索的字段，默认为主键
   * @return integer 所删除的行数
   */
  public function delete($value, $key = 'privilege_id') {
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->delete($where);
  }

  /**
   * 通过指定条件获取所有权限模块
   * 
   * @param array $condition 字段 => 值
   * @return mixed
   */
  public function getAllByCondition($condition = array()) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*');

    if (isset($condition['module_id']) && is_array($condition['module_id']) && !empty($condition['module_id'])) {
      $select->where('module_id IN (?)', join($condition['module_id'], ','));
    }
    elseif (isset($condition['module_id'])) {
      $select->where('module_id=?', (int) $condition['module_id']);
    }

    if (isset($condition['to_show'])) {
      $select->where('to_show=?', (int) $condition['to_show']);
    }

    if (isset($condition['to_assign'])) {
      $select->where('to_assign=?', (int) $condition['to_assign']);
    }

    if (isset($condition['to_admin'])) {
      $select->where('to_admin=?', (int) $condition['to_admin']);
    }
    
    if (isset($condition['to_account'])) {
      $select->where('to_account=?', (int) $condition['to_account']);
    }
    $select->order('module_id ASC');
    $select->order('sort_id ASC');

    return $this->_table->getAdapter()->fetchAll($select);
  }
  /**
   * 
   * @param array $where 
   * @param unknown $colums
   * @return mixed
   */
  public function getByOrWhere($where, $colums){
  	$select = $this->_table->getAdapter()->select();
  	$table = $this->_table->info('name');
  	$select->from($table, $colums);
  	
  	foreach($where['and'] as $field=>$value) {
  		$select->where("{$field} = ?", $value);
  	}
  	foreach($where['or'] as $field=>$value) {
  		$select->orWhere("{$field} = ?", $value);
  	}
  	return $this->_table->getAdapter()->fetchAll($select);
  }

  /**
   * [getByField 字段查询]
   * @param  [type] $value  [description]
   * @param  string $field  [description]
   * @param  string $colums [description]
   * @return [type]         [description]
   */
  public function getByField($value, $field = 'privilege_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
}
