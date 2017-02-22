<?php
class Table_Hscodes
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Hscodes();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Product();
    }

    /**
     * @param $row
     * @return mixed
     */
    public function add($row)
    {
        return $this->_table->insert($row);
    }


    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function update($row, $value, $field = "product_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }
    
    public function customUpdate($data, $condition, $value = '')
    {
    	$where = $this->_table->getAdapter()->quoteInto($condition, $value);
    	return $this->_table->update($data, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "product_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->delete($where);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'product_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, "*");
        return $this->_table->getAdapter()->fetchAll($select);
    }

    public function getByCondition($condition = array(), $field = '*', $order = '', $pageSize = 20, $page = 0)
    {
    	$select	= $this->_table->getAdapter()->select();
    	$table	= $this->_table->info('name');
    	$select->from($table, $field);
    
    	if (isset($condition["p_name"]) && $condition["p_name"] != "") {
    		$select->where("{$table}.p_name like ?", '%'.$condition["p_name"].'%');
    	}
    	if (isset($condition["hs_code"]) && $condition["hs_code"] != "") {
    		$select->where("{$table}.hs_code like ?", '%'.$condition["hs_code"].'%');
    	}
    	if (isset($condition["hs_code_status"]) && $condition["hs_code_status"] != "") {
    		$select->where("{$table}.hs_code_status = ?", $condition["hs_code_status"]);
    	}
    
    
    	//echo $select;
    	if ('count(*)' == $field) {
			return $this->_table->getAdapter()->fetchOne($select);
    	} else {
    		if (!empty($order)) {
    			$select->order($order);
    		}
    		if ($pageSize > 0 && $page>0) {
    			$page	= ($page - 1) * $pageSize;
    			$select->limit($pageSize, $page);
    		}
    		$sql = $select->__toString();
    		return $this->_table->getAdapter()->fetchAll($sql);
    	}    	
    } 

    /**
     * 构造自定义SQL语句查询
     *
     * @access	public
     * @param   string	($field		待返回的字段，默认为所有)
     * @param   string	($condition	查询条件)
     * @param	mixed	($value		待转换查询字段值)
     * @return	mixed
     */
    public function getCustomQuery($field = '*', $condition = '', $value = '')
    {
    	$table	= $this->_table->info('name');
    	$sql	= "SELECT $field FROM $table $condition";
    	$sql	= $this->_table->getAdapter()->quoteInto($sql, $value);
    	return $this->_table->getAdapter()->fetchAll($sql);
    }

}