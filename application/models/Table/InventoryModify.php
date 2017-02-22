<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_InventoryModify
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_InventoryModify();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_InventoryModify();
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
    public function update($row, $value, $field = "im_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'im_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
	
	public function getByStatus($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("status = ?", $status);
        $select->where("im_id > ?", $minId);
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
		if(isset($condition["im_id"]) && $condition["im_id"] != ""){
            $select->where("im_id = ?",$condition["im_id"]);
        }
        if(isset($condition["im_code"]) && $condition["im_code"] != ""){
            $select->where("im_code = ?",$condition["im_code"]);
        }
		if(isset($condition["status"]) && $condition["status"] != 0){
            $select->where("status = ?",$condition["status"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
		if(isset($condition["customs_code"]) && $condition["customs_code"] != ""){
            $select->where("customs_code = ?",$condition["customs_code"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }
		if(isset($condition["ems_no"]) && $condition["ems_no"] != ""){
            $select->where("ems_no = ?",$condition["ems_no"]);
        }
		if(isset($condition["created_start"]) && $condition["created_start"] != ""){
        	$select->where("add_time >= ?",$condition["created_start"]);
        }
        if(isset($condition["created_end"]) && $condition["created_end"] != ""){
        	$select->where("add_time <= ?",$condition["created_end"]);
        }
        /*CONDITION_END*/
        if ('count(*)' == $type) {
			//echo $select->__toString();
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
