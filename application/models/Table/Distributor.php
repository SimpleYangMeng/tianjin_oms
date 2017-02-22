<?php
/**
 * 供应商Table
 * 
 * @author Daniel Chen
 * @version 1.2
 * @date 2014.06.13
 */
class Table_Distributor {
  protected $_table = NULL;

  /**
   * 供应商数据表主键
   * 
   * @var string $_key
   */
  protected $_key = 'distributor_id';

  /**
   * 搜寻条件包含以下字段时将采取相等比较
   * 
   * @var array $_strictField
   */
  protected $_strictField = array(
    'distributor_id',
    'customer_id',
    'customer_code',
    'distributor_status'
  );

  public function __construct() {
    $this->_table = new DbTable_Distributor();
  }

  /**
   * 供应商数据插入
   * 
   * @param array $data 字段 => 值
   * @return mixed 所插入行的主键值
   */
  public function insert($data) {
    return $this->_table->insert($data);
  }

  /**
   * 供应商数据更新
   * 
   * @param array $data 字段 => 值
   * @param mixed $value 需要检索的字段值
   * @param string $key 需要检索的字段，默认为主键
   * @return integer 所更新的行数
   */
  public function update($data, $value, $key = NULL) {
    $key = empty($key) ? $this->_key : $key;
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->update($data, $where);
  }

  /**
   * 供应商数据删除
   * 
   * @param mixed $value 需要检索的字段值
   * @param string $key 需要检索的字段，默认为主键
   * @return integer 所删除的行数
   */
  public function delete($value, $key = NULL) {
    $key = empty($key) ? $this->_key : $key;
    $where = $this->_table->getAdapter()->quoteInto("{$key}=?", $value);

    return $this->_table->delete($where);
  }

  /**
   * 通过主键值获取供应商数据
   * 
   * @param integer $value 主键值
   * @return mixed
   */
  public function getByPrimaryKey($value) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*')->where($this->_key . '=?', $value);

    return $this->_table->getAdapter()->fetchRow($select);
  }

  /**
   * 通过供应商代码获取制定客户供应商数据
   * 
   * @param string $code 供应商代码
   * @param string $customer 客户代码或客户ID
   * @param integer $status 状态，1可用，0不可用
   * @return mixed
   */
  public function getByCode($code, $customer, $status = 1) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*');

    if (is_int($customer)) {
      $select->where('customer_id=?', $customer);
    }
    else {
      $select->where('customer_code=?', $customer);
    }

    $select->where('distributor_status=?', $status)
           ->where('distributor_code=?', $code);

    return $this->_table->getAdapter()->fetchRow($select);
  }

  /**
   * 通过客户代码获取供应商数据
   * 
   * @param string $code 客户代码
   * @param array $condition 限制检索条件，字段 => 值，默认为空
   * @param integer $page 当前页码
   * @param integer $size 每页显示的记录数
   * @return mixed
   */
  public function getByCustomerCode($code, $condition = array(), $page = 1, $size = 20) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*')->where('customer_code=?', $code);

    foreach ($condition as $field => $value) {
      if (in_array($field, $this->_strictField, TRUE)) {
        $select->where("{$field}=?", $value);
      }
      else {
        $select->where("{$field} LIKE ?", '%' . $value . '%');
      }
    }

    if ($size > 0 && $page > 0) {
      $select->limit($size, ($page - 1) * $size);
    }

    return $this->_table->getAdapter()->fetchAll($select);
  }

  /**
   * 通过客户代码获取供应商数据
   * 
   * @param string $id 客户ID
   * @param array $condition 限制检索条件，字段 => 值，默认为空
   * @param integer $page 当前页码
   * @param integer $size 每页显示的记录数
   * @return mixed
   */
  public function getByCustomerId($id, $condition = array(), $page = 1, $size = 20) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, '*')->where('customer_id=?', $id);

    foreach ($condition as $field => $value) {
      if (in_array($field, $this->_strictField, TRUE)) {
        $select->where("{$field}=?", $value);
      }
      else {
        $select->where("{$field} LIKE ?", '%' . $value . '%');
      }
    }

    if ($size > 0 && $page > 0) {
      $select->limit($size, ($page - 1) * $size);
    }

    return $this->_table->getAdapter()->fetchAll($select);
  }

  /**
   * 通过客户代码获取供应商总记录数
   * 
   * @param string $code 客户代码
   * @param array $condition 限制检索条件，字段 => 值，默认为空
   * @return mixed
   */
  public function getCountByCustomerCode($code, $condition = array()) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, 'count(*)')->where('customer_code=?', $code);

    foreach ($condition as $field => $value) {
      if (in_array($field, $this->_strictField, TRUE)) {
        $select->where("{$field}=?", $value);
      }
      else {
        $select->where("{$field} LIKE ?", '%' . $value . '%');
      }
    }

    return $this->_table->getAdapter()->fetchOne($select);
  }

  /**
   * 通过客户代码获取供应商总记录数
   * 
   * @param string $id 客户ID
   * @param array $condition 限制检索条件，字段 => 值，默认为空
   * @return mixed
   */
  public function getCountByCustomerId($id, $condition = array()) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, 'count(*)')->where('customer_id=?', $id);

    foreach ($condition as $field => $value) {
      if (in_array($field, $this->_strictField, TRUE)) {
        $select->where("{$field}=?", $value);
      }
      else {
        $select->where("{$field} LIKE ?", '%' . $value . '%');
      }
    }

    return $this->_table->getAdapter()->fetchOne($select);
  }

  /**
   * 验证供应商代码，同一个客户的供应商代码不能重复
   * 
   * @param string $distributor 供应商代码
   * @param string $customer 客户代码或客户ID
   * @param integer $except 排除主键值为$except的情况
   * @return boolean 重复时返回TRUE，否则返回FALSE
   */
  public function isRepeatCode($distributor, $customer, $except = NULL) {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');
    $select->from($table, $this->_key);

    if (is_int($customer)) {
      $select->where('customer_id=?', $customer);
    }
    else {
      $select->where('customer_code=?', $customer);
    }

    $select->where('distributor_code=?', $distributor);

    if (!empty($except)) {
      $select->where($this->_key . '!=?', $except);
    }

    return (bool) $this->_table->getAdapter()->fetchOne($select);
  }
  

   public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        } 
        if(isset($condition["distributor_code"]) && $condition["distributor_code"] != ""){
            $select->where("distributor_code = ?",$condition["distributor_code"]);
        } 		    
		   
        /*CONDITION_END*/
        if ('count(*)' == $type) {
            return $this->_table->getAdapter()->fetchOne($select);
        } else {
            if (!empty($orderBy)) {
                $select->order($orderBy);
            }
            if ($pageSize > 0 and $page > 0) {
                $start = ($page - 1) * $pageSize;
                $select->limit($pageSize, $start);
            }
            $sql = $select->__toString();
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }    
  
  
}
