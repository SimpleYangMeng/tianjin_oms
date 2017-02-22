<?php
class Table_ShipOrderTracking
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ShipOrderTracking();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ShipOrderTracking();
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
    public function update($row, $value, $field = "sot_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "sot_id")
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
    public function getByField($value, $field = 'sot_id', $colums = "*")
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
        
        if(isset($condition["so_id"]) && $condition["so_id"] != ""){
            $select->where("so_id = ?",$condition["so_id"]);
        }
        if(isset($condition["so_code"]) && $condition["so_code"] != ""){
            $select->where("so_code = ?",$condition["so_code"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ?",$condition["order_code"]);
        }
        if(isset($condition["sot_location"]) && $condition["sot_location"] != ""){
            $select->where("sot_location = ?",$condition["sot_location"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["sot_description"]) && $condition["sot_description"] != ""){
            $select->where("sot_description = ?",$condition["sot_description"]);
        }
        if(isset($condition["sot_type"]) && $condition["sot_type"] != ""){
            $select->where("sot_type = ?",$condition["sot_type"]);
        }
        if(isset($condition["sot_time_offset"]) && $condition["sot_time_offset"] != ""){
            $select->where("sot_time_offset = ?",$condition["sot_time_offset"]);
        }
        if(isset($condition["tracking_number"]) && $condition["tracking_number"] != ""){
            $select->where("tracking_number = ?",$condition["tracking_number"]);
        }
        if(isset($condition["ref_tracking_number"]) && $condition["ref_tracking_number"] != ""){
            $select->where("ref_tracking_number = ?",$condition["ref_tracking_number"]);
        }
        if(isset($condition['status_desc'])&&$condition['status_desc']!=""){
            $select->where(" status_desc = ?",$condition['status_desc']);
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