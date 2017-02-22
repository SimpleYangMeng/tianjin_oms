<?php
class Table_ShipWeightPrice
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ShipWeightPrice();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ShipWeightPrice();
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
    public function update($row, $value, $field = "swp_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "swp_id")
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
    public function getByField($value, $field = 'swp_id', $colums = "*")
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
        
        if(isset($condition["swp_weight"]) && $condition["swp_weight"] != ""){
            $select->where("swp_weight = ?",$condition["swp_weight"]);
        }
        if(isset($condition["swp_exces_weight"]) && $condition["swp_exces_weight"] != ""){
            $select->where("swp_exces_weight = ?",$condition["swp_exces_weight"]);
        }
        if(isset($condition["swp_cost"]) && $condition["swp_cost"] != ""){
            $select->where("swp_cost = ?",$condition["swp_cost"]);
        }
        if(isset($condition["swp_exces_cost"]) && $condition["swp_exces_cost"] != ""){
            $select->where("swp_exces_cost = ?",$condition["swp_exces_cost"]);
        }
        if(isset($condition["currency_code"]) && $condition["currency_code"] != ""){
            $select->where("currency_code = ?",$condition["currency_code"]);
        }
        if(isset($condition["area"]) && $condition["area"] != ""){
            $select->where("area = ?",$condition["area"]);
        }
        if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
            $select->where("sm_code = ?",$condition["sm_code"]);
        }
        if(isset($condition["swp_fee_type"]) && $condition["swp_fee_type"] !== ""){
            $select->where("swp_fee_type = ?",$condition["swp_fee_type"]);
        }
        if(isset($condition["sm_id"]) && $condition["sm_id"] != ""){
            $select->where("sm_id = ?",$condition["sm_id"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
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
     * @desc 物流计费
     */
    public function getByInCondition($condition = array(), $type = '*', $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        if (isset($condition["area_arr"]) && is_array($condition["area_arr"])) {
            $select->where("area in(?)", $condition["area_arr"]);
        }
        if (isset($condition["sm_code"]) && $condition["sm_code"] != "") {
            $select->where("sm_code = ?", $condition["sm_code"]);
        }
        if (isset($condition["swp_fee_type"]) && $condition["swp_fee_type"] !== "") {
            $select->where("swp_fee_type = ?", $condition["swp_fee_type"]);
        }
        if (isset($condition["sm_id"]) && $condition["sm_id"] != "") {
            $select->where("sm_id = ?", $condition["sm_id"]);
        }
        if (isset($condition["warehouse_id_arr"]) && is_array($condition["warehouse_id_arr"])) {
            $select->where("warehouse_id in(?)", $condition["warehouse_id_arr"]);
        }
        /*CONDITION_END*/
        if ('count(*)' == $type) {
            return $this->_table->getAdapter()->fetchOne($select);
        } else {
            if (!empty($orderBy)) {
                $select->order($orderBy);
            }
            $sql = $select->__toString();
            return $this->_table->getAdapter()->fetchRow($sql);
        }
    }

}