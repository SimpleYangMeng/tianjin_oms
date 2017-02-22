<?php
class Table_ShipOrderDetail
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ShipOrderDetail();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ShipOrderDetail();
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
    public function update($row, $value, $field = "sod_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "sod_id")
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
    public function getByField($value, $field = 'sod_id', $colums = "*")
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
        
        if(isset($condition["so_code"]) && $condition["so_code"] != ""){
            $select->where("so_code = ?",$condition["so_code"]);
        }
        if(isset($condition["so_id"]) && $condition["so_id"] != ""){
            $select->where("so_id = ?",$condition["so_id"]);
        }
        if(isset($condition["order_id"]) && $condition["order_id"] != ""){
            $select->where("order_id = ?",$condition["order_id"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ?",$condition["order_code"]);
        }
        if(isset($condition["op_id"]) && $condition["op_id"] != ""){
            $select->where("op_id = ?",$condition["op_id"]);
        }
        if(isset($condition["op_title"]) && $condition["op_title"] != ""){
            $select->where("op_title = ?",$condition["op_title"]);
        }
        if(isset($condition["sod_quantity"]) && $condition["sod_quantity"] != ""){
            $select->where("sod_quantity = ?",$condition["sod_quantity"]);
        }
        if(isset($condition["op_description"]) && $condition["op_description"] != ""){
            $select->where("op_description = ?",$condition["op_description"]);
        }
        if(isset($condition["cn_description"]) && $condition["cn_description"] != ""){
            $select->where("cn_description = ?",$condition["cn_description"]);
        }
        if(isset($condition["hs_code"]) && $condition["hs_code"] != ""){
            $select->where("hs_code = ?",$condition["hs_code"]);
        }
        if(isset($condition["op_unit_price"]) && $condition["op_unit_price"] != ""){
            $select->where("op_unit_price = ?",$condition["op_unit_price"]);
        }
        if(isset($condition["op_subtotal"]) && $condition["op_subtotal"] != ""){
            $select->where("op_subtotal = ?",$condition["op_subtotal"]);
        }
        if(isset($condition["op_origin"]) && $condition["op_origin"] != ""){
            $select->where("op_origin = ?",$condition["op_origin"]);
        }
        if(isset($condition["op_declared_value"]) && $condition["op_declared_value"] != ""){
            $select->where("op_declared_value = ?",$condition["op_declared_value"]);
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