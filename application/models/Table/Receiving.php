<?php
class Table_Receiving
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Receiving();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Receiving();
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
    public function update($row, $value, $field = "receiving_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "receiving_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->delete($where);
    }
	
	public function getByWhere($where, $colums = "*") {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        foreach($where as $field=>$value) {
            $select->where("{$field} = ?", $value);
        }
        return $this->_table->getAdapter()->fetchRow($select);
    }
	
    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'receiving_id', $colums = "*")
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
	
	public function getByStatus($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("receiving_status = ?", $status);
        $select->where("receiving_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }
	
	public function getByCiqStatus($status, $pageSize = 0, $minId) {
		$select = $this->_table->getAdapter()->select();
		// $select->forUpdate();
		$table = $this->_table->info('name');
		$select->from($table, '*');
		$select->where("1 =?", 1);
		/*CONDITION_START*/
		$select->where("ciq_status = ?", $status);
		$select->where("receiving_id > ?", $minId);
		$select->limit($pageSize);
		$sql = $select->__toString();
		return $this->_table->getAdapter()->fetchAll($sql);

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

        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where("receiving_code = ?",$condition["receiving_code"]);
        }
        if(isset($condition["reference_no"]) && $condition["reference_no"] != ""){
            $select->where("reference_no = ?",$condition["reference_no"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code in (?)",$condition["customer_code"]);
        }
		if(isset($condition["status_array"]) && !empty($condition["status_array"])){
            $select->where("receiving_status in (?)",$condition["status_array"]);
        }
        if(isset($condition['decl_port']) && $condition['decl_port'] != ''){
            $select->where("decl_port = ?",$condition["decl_port"]);
        }
		if(isset($condition['receiving_status']) && $condition["receiving_status"]==0){ $condition["receiving_status"]=''; }
        if(isset($condition["receiving_status"]) && $condition["receiving_status"] !== ""){
            $select->where("receiving_status = ?",$condition["receiving_status"]);
        }
		if(isset($condition["ciq_status"]) && $condition["ciq_status"] !== ""){
            $select->where("ciq_status = ?",$condition["ciq_status"]);
        }
		if(isset($condition["customs_status"]) && $condition["customs_status"] !== ""){
            $select->where("customs_status = ?",$condition["customs_status"]);
        }
        if(isset($condition["created_start"]) && $condition["created_start"] != ""){
			$condition["created_start"] .= " 00:00:00";
        	$select->where("receiving_add_time >= ?",$condition["created_start"]);
        }
        if(isset($condition["created_end"]) && $condition["created_end"] != ""){
			$condition["created_end"] .= " 23:59:59";
        	$select->where("receiving_add_time <= ?",$condition["created_end"]);
        }
		if(isset($condition["declaration_number"]) && $condition["declaration_number"] != ""){
			$select->where("declaration_number = ?",$condition["declaration_number"]);
        }
		if(isset($condition["list_no"]) && $condition["list_no"] != ""){
			$select->where("list_no = ?",$condition["list_no"]);
        }
        /*CONDITION_END*/
        if ('count(*)' == $type) {
			//echo $select->__toString();exit;
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
     * 各仓库状态统计
     * @author solar
     * @param int $customer_id
     * @param int $model_type
     */
    public function stat($customer_id, $model_type) {
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table, 'warehouse_id,receiving_status,count(*) as num');
    	$select->where('customer_id=?', $customer_id);
    	$select->where("receive_model_type=?", $model_type);
    	$select->group(array('warehouse_id','receiving_status'));
    	return $this->_table->getAdapter()->fetchAll($select);
    }
    
}