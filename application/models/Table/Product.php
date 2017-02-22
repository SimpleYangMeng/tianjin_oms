<?php
class Table_Product
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Product();
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
    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByFieldForUpdate($value, $field = 'product_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        $sql = $select->__toString() . " for update";
        return $this->_table->getAdapter()->fetchRow($sql);
    }
    /**
     * @锁表
     */
    public function getByFieldLock($value, $field = 'product_id', $colums = "*"){
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table, $colums);
    	$select->forUpdate();
    	$select->where("{$field} = ?", $value);
    	return $this->_table->getAdapter()->fetchRow($select);
    }
    public function getByWhere($where, $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        foreach ($where as $field => $value) {
            $select->where("{$field} = ?", $value);
        }
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
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $field);
        if (isset($condition["product_id"]) && $condition["product_id"] != "") {
            $select->where("{$table}.product_id = ?", $condition["product_id"]);
        }
        if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
            $select->where("{$table}.customer_id = ?", $condition["customer_id"]);
        }
        if (isset($condition["hs_code"]) && $condition["hs_code"] != "") {
            $select->where("{$table}.hs_code = ?", $condition["hs_code"]);
        }
        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("{$table}.customer_code in (?)", $condition["customer_code"]);
        }
        if (isset($condition['customs_code']) && $condition['customs_code'] != '') {
            $select->where("{$table}.customs_code = ?", $condition["customs_code"]);
        }
        if (isset($condition['ins_unit_code']) && $condition['ins_unit_code'] != '') {
            $select->where("{$table}.ins_unit_code = ?", $condition["ins_unit_code"]);
        }
        if (isset($condition["product_type"]) && $condition["product_type"] !== "") {
            $select->where("{$table}.product_type = ?", $condition["product_type"]);
        }
        if (isset($condition["product_sku"]) && $condition["product_sku"] !== "") {
            $select->where("{$table}.product_sku = ?", $condition["product_sku"]);
        }
        if (isset($condition["ie_type"]) && $condition["ie_type"] != "") {
            $select->where("{$table}.ie_type = ?", $condition["ie_type"]);
        }
        if (isset($condition["product_title"]) && $condition["product_title"] != "") {
            //前百分号导致索引失效~ -- Notes by simple
            //    $select->where("{$table}.product_title LIKE ?", '%'.$condition["product_title"].'%');
            $select->where("{$table}.product_title LIKE ?", $condition["product_title"] . '%');
        }

        if (isset($condition["product_add_time"]) && $condition["product_add_time"] != "") {
            $select->where("{$table}.product_add_time >= ?", $condition["product_add_time"] . ' 00:00:00');
        }

        if (isset($condition["product_end_time"]) && $condition["product_end_time"] != "") {
            $select->where("{$table}.product_add_time <= ?", $condition["product_end_time"] . '23:59:59');
        }
        if (isset($condition["storage_customer_code"]) && $condition["storage_customer_code"] != "") {
            $select->where("{$table}.storage_customer_code = ?", $condition["storage_customer_code"]);
        }
        if (isset($condition["storage_account_code"]) && $condition["storage_account_code"] != "") {
            $select->where("{$table}.storage_account_code = ?", $condition["storage_account_code"]);
        }
        if (isset($condition["product_barcode"]) && $condition["product_barcode"] != "") {
            $select->where("{$table}.product_barcode = ?", $condition["product_barcode"]);
        }
        if (isset($condition["product_status"]) && $condition["product_status"] !== "") {
            $select->where("{$table}.product_status = ?", $condition["product_status"]);
        }
        if (isset($condition["customs_status"]) && $condition["customs_status"] !== "") {
            $select->where("{$table}.customs_status = ?", $condition['customs_status']);
        }
        if (isset($condition['not_product_id']) && $condition['not_product_id'] != "") {
            $select->where(" product_id <> ?", $condition['not_product_id']);
        }
        if (isset($condition["registerID"]) && $condition["registerID"] != "") {
            $select->where("{$table}.registerID = ?", $condition["registerID"]);
        }
        if (isset($condition["ciq_status"]) && $condition["ciq_status"] !== "") {
            $select->where("{$table}.ciq_status = ?", $condition["ciq_status"]);
        }
        if (isset($condition["customs_status_not"]) && $condition["customs_status_not"] !== "") {
            $select->where("{$table}.customs_status != ?", $condition['customs_status_not']);
        }
        if (isset($condition["ciq_status_not"]) && $condition["ciq_status_not"] !== "") {
            $select->where("{$table}.ciq_status != ?", $condition["ciq_status_not"]);
        }
        //echo $select;
        if ('count(*)' == $field) {
            return $this->_table->getAdapter()->fetchOne($select);
        } else {
            if (!empty($order)) {
                $select->order($order);
            }
            if ($pageSize > 0 && $page > 0) {
                $page = ($page - 1) * $pageSize;
                $select->limit($pageSize, $page);
            }
            $sql = $select->__toString();
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }

    /**
     * 构造自定义SQL语句查询
     *
     * @access    public
     * @param   string    ($field        待返回的字段，默认为所有)
     * @param   string    ($condition    查询条件)
     * @param    mixed    ($value        待转换查询字段值)
     * @return    mixed
     */
    public function getCustomQuery($field = '*', $condition = '', $value = '')
    {
        $table = $this->_table->info('name');
        $sql = "SELECT $field FROM $table $condition";
        $sql = $this->_table->getAdapter()->quoteInto($sql, $value);
        return $this->_table->getAdapter()->fetchAll($sql);
    }
    /**
     * @author william-fan
     * @todo 更加条件获取一行
     */
    public function getRowByCondition($condition = array(), $type = '*')
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
            $select->where("customer_id = ?", $condition["customer_id"]);
        }
        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code = ?", $condition["customer_code"]);
        }
        if (isset($condition["product_sku"]) && $condition["product_sku"] != "") {
            $select->where("product_sku = ?", $condition["product_sku"]);
        }
        if (isset($condition['customs_status']) && $condition['customs_status'] !== "") {
            $select->where("customs_status = ?", $condition['customs_status']);
        }
        if (isset($condition["ciq_status"]) && $condition["ciq_status"] !== "") {
            $select->where("ciq_status = ?", $condition["ciq_status"]);
        }
        if (isset($condition["product_status"]) && $condition["product_status"] !== "") {
            $select->where("product_status = ?", $condition["product_status"]);
        }
        $select->limit(1);
        return $this->_table->getAdapter()->fetchRow($select);
    }
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $status
     * @param unknown_type $pageSize
     * @param unknown_type $minId
     */
	public function getByCiqStatus($status, $pageSize = 0, $minId) {
		$select = $this->_table->getAdapter()->select();
		// $select->forUpdate();
		$table = $this->_table->info('name');
		$select->from($table, '*');
		$select->where("1 =?", 1);
		/*CONDITION_START*/
		$select->where("ciq_status = ?", $status);
		$select->where("product_id > ?", $minId);
		$select->limit($pageSize);
		$sql = $select->__toString();
		return $this->_table->getAdapter()->fetchAll($sql);

	}
}
