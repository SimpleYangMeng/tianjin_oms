<?php
class Table_InventoryBatch
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_InventoryBatch();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_InventoryBatch();
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
    public function update($row, $value, $field = "ib_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "ib_id")
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
    public function getByField($value, $field = 'ib_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
    
    public function getByWhere($where)
    {
    	if(empty($where)) return array();
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table, '*');
    	foreach($where as $field=>$value) {
    		$select->where($field.'=?', $value);
    	}
    	return $this->_table->getAdapter()->fetchRow($select);
    }
    
    public function listByWhere($where)
    {
    	if(empty($where)) return array();
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table, '*');
    	foreach($where as $field=>$value) {
    		$select->where($field.'=?', $value);
    	}
    	return $this->_table->getAdapter()->fetchAll($select);
    }
    
    public function getForUpdate($ib_id) {
    	$sql = 'select * from inventory_batch where ib_id='.$ib_id.' for update;';
    	return $this->_table->getAdapter()->fetchRow($sql);
    }
    
    public function updateByField($row, $field) {
    	$aWhere = array();
    	foreach($field as $key=>$value) {
    		$aWhere[] = $this->_table->getAdapter()->quoteInto("{$key}= ?", $value);
    	} 
    	return $this->_table->update($row, implode(' AND ', $aWhere));
    }

    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, "*");
        return $this->_table->getAdapter()->fetchAll($select);
    }

    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $orderBy
     * @return array|string
     */
    public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        
        if(isset($condition["lc_code"]) && $condition["lc_code"] != ""){
            $select->where("lc_code = ?",$condition["lc_code"]);
        }
        if(isset($condition["product_id"]) && $condition["product_id"] != ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["box_code"]) && $condition["box_code"] != ""){
            $select->where("box_code = ?",$condition["box_code"]);
        }
        if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
            $select->where("product_barcode = ?",$condition["product_barcode"]);
        }
        if(isset($condition["reference_no"]) && $condition["reference_no"] != ""){
            $select->where("reference_no = ?",$condition["reference_no"]);
        }
        if(isset($condition["application_code"]) && $condition["application_code"] != ""){
            $select->where("application_code = ?",$condition["application_code"]);
        }
        if(isset($condition["supplier_id"]) && $condition["supplier_id"] != ""){
            $select->where("supplier_id = ?",$condition["supplier_id"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where("receiving_code = ?",$condition["receiving_code"]);
        }
        if(isset($condition["receiving_id"]) && $condition["receiving_id"] != ""){
            $select->where("receiving_id = ?",$condition["receiving_id"]);
        }
        if(isset($condition["lot_number"]) && $condition["lot_number"] != ""){
            $select->where("lot_number = ?",$condition["lot_number"]);
        }
        if(isset($condition["ib_status"]) && $condition["ib_status"] != ""){
            $select->where("ib_status = ?",$condition["ib_status"]);
        }
        if(isset($condition["ib_hold_status"]) && $condition["ib_hold_status"] != ""){
            $select->where("ib_hold_status = ?",$condition["ib_hold_status"]);
        }
        if(isset($condition["ib_quantity"]) && $condition["ib_quantity"] != ""){
            $select->where("ib_quantity = ?",$condition["ib_quantity"]);
        }
        if(isset($condition["ib_note"]) && $condition["ib_note"] != ""){
            $select->where("ib_note = ?",$condition["ib_note"]);
        }
        if(isset($condition['customer_code'])&&$condition['customer_code']!=""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
		
        if(isset($condition["product_id_array"]) && $condition["product_id_array"] != "" && is_array($condition["product_id_array"])&&!empty($condition["product_id_array"])){
            $select->where("product_id IN(?)",$condition["product_id_array"]);
        }
        if(isset($condition['production_time'])&&$condition['production_time']!=""){
            $select->where(" production_time = ? ",$condition['production_time']);
        }
        if(isset($condition['not_production_time'])&&$condition['not_production_time']!=""){
            $select->where(" production_time <> ? and production_time <>'0000-00-00'",$condition['not_production_time']);
        }
        if(isset($condition['is_production_time'])&&$condition['is_production_time']!=""){
            $select->where(" production_time <> '0000-00-00' and production_time > ?",$condition['is_production_time']);
        }
        if(isset($condition['production_time_expire'])&&$condition['production_time_expire']!=""){
            $select->where(" production_time <= ? and production_time>'0000-00-00'",$condition['production_time_expire']);
        }
        if(isset($condition['ib_expire'])&&$condition['ib_expire']!=""){
            $select->where(" ib_expire = ? ",$condition['ib_expire']);
        }
        if(isset($condition['production_time_start'])&&$condition['production_time_start']!=""){
            $select->where(" production_time >= ?",$condition['production_time_start']);
        }
        if(isset($condition['production_time_end'])&&$condition['production_time_end']!=""){
            $select->where(" production_time <= ?",$condition['production_time_end']);
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
    
    /**
     * 可选择盘点列表查询
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $orderBy
     */
    public function getTakeStockLocations($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table.' as ib', $type);
    	$select->joinLeft('product as p', 'ib.product_barcode=p.product_barcode', 'customer_code');
    	if(isset($condition["wa_code"]) && $condition["wa_code"] != ""){
    		$select->joinLeft('location as l', 'ib.lc_code=l.lc_code', '');
    		$select->where("l.wa_code = ?",$condition["wa_code"]);
    	}    	
    	/*CONDITION_START*/
    	if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
    		$select->where("ib.warehouse_id = ?",$condition["warehouse_id"]);
    	}
    	if(isset($condition["lc_code"]) && $condition["lc_code"] != ""){
    		$select->where("ib.lc_code = ?",$condition["lc_code"]);
    	}
    	if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
    		$select->where("ib.product_barcode = ?",$condition["product_barcode"]);
    	}
    	if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
    		$select->where("p.customer_code = ?",$condition["customer_code"]);
    	}
    	
    	$select->where('ib.ib_hold_status = 0');
    	
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
    
    public function listTakeStockLocation($condition) {
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table.' as ib', array('lc_code','product_barcode','ib_quantity','ib_status','ib_hold_status'));
    	$select->joinLeft('product as p', 'ib.product_barcode=p.product_barcode', 'customer_code');
    	$select->joinLeft('inventory_batch_outbound AS ibo', 'ib.ib_id=ibo.ib_id', 'ibo_id');
    	if(isset($condition["wa_code"]) && $condition["wa_code"] != ""){
    		$select->joinLeft('location as l', 'ib.warehouse_id=l.warehouse_id and ib.lc_code=l.lc_code', '');
    		$select->where("l.wa_code = ?",$condition["wa_code"]);
    	}
    	/*CONDITION_START*/
    	if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
    		$select->where("ib.warehouse_id = ?",$condition["warehouse_id"]);
    	}
    	if(isset($condition["lc_code"]) && $condition["lc_code"] != ""){
    		$select->where("ib.lc_code = ?",$condition["lc_code"]);
    	}
    	if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
    		$select->where("ib.product_barcode = ?",$condition["product_barcode"]);
    	}
    	if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
    		$select->where("p.customer_code = ?",$condition["customer_code"]);
    	}
    	//$select->where('ibo.ibo_id is null');
    	$select->order(array('ib.lc_code','ib.product_barcode'));
    	$sql = $select->__toString();
    	return $this->_table->getAdapter()->fetchAll($sql);
    }
    
    /**
     * 根据ib_id数组查询盘点记录
     * @author solar
     * @param array $ib_ids
     * @return array
     */
    public function getTakeStockAll($ib_ids) {
    	if(!is_array($ib_ids) || empty($ib_ids)) return array();
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table.' as ib', "*");
    	$select->joinLeft('product as p', 'ib.product_barcode=p.product_barcode', 'customer_code');
    	$select->where('ib.ib_id IN(?)', $ib_ids);
    	return $this->_table->getAdapter()->fetchAll($select);
    }
    
}