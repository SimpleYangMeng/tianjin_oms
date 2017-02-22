<?php
class Table_SmsLog
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_SmsLog();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_SmsLog();
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
    	$select->where("1=?",1);
    	if (isset($condition["status"]) && $condition["status"] !== "") {
    		$select->where("status=?", $condition["status"]);
    	}
    	if (isset($condition["status_arr"]) && $condition["status_arr"] !== "") {
    		$select->where("status in(?)", $condition["status_arr"]);
    	}
    	if (isset($condition["sms_type"]) && $condition["sms_type"] !== "") {
    		$select->where("sms_type=?", $condition["sms_type"]);
    	}
		
    	if (isset($condition["php_session_code"]) && $condition["php_session_code"] !== "") {
    		$select->where("php_session_code=?", $condition["php_session_code"]);
    	}		

    	if (isset($condition["customer_id"]) && $condition["customer_id"] !== "") {
    		$select->where("customer_id=?", $condition["customer_id"]);
    	}	
		
    	if (isset($condition["order_code"]) && $condition["order_code"] !== "") {
    		$select->where("order_code=?", $condition["order_code"]);
    	}	

    	if (isset($condition["add_time_start"]) && $condition["add_time_start"] !== "") {
    		$select->where("pub_date>=?", $condition["add_time_start"]." 00:00:00");
    	}				
    	if (isset($condition["add_time_end"]) && $condition["add_time_end"] !== "") {
    		$select->where("pub_date<=?", $condition["add_time_end"]." 23:59:59");
    	}	
    	if (isset($condition["is_repeat"]) && $condition["is_repeat"] !=="") {
    		$select->where("is_repeat=?", $condition["is_repeat"]);
    	}	
		
    	if (isset($condition["sent_time_start"]) && $condition["sent_time_start"] !== "") {
    		$select->where("sent_time>=?", $condition["sent_time_start"]);
    	}				
    	if (isset($condition["sent_time_end"]) && $condition["sent_time_end"] !== "") {
    		$select->where("sent_time<=?", $condition["sent_time_end"]);
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
			//echo $sql;
    		return $this->_table->getAdapter()->fetchAll($sql);
    	}    	
    } 

  

}