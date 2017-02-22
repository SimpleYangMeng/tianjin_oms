<?php
class Table_OtherFee
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_OtherFee();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_OtherFee();
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
    public function update($row, $value, $field = "fee_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "fee_id")
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
    public function getByField($value, $field = 'fee_id', $colums = "*")
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
        
        if(isset($condition["fee_code"]) && $condition["fee_code"] != ""){
            $select->where("fee_code = ?",$condition["fee_code"]);
        }
        if(isset($condition["fee_name"]) && $condition["fee_name"] != ""){
            $select->where("fee_name = ?",$condition["fee_name"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] !== ""){
        	$select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["application_code"]) && $condition["application_code"] != ""){
            $select->where("application_code = ?",$condition["application_code"]);
        }
        if(isset($condition["fee_unit"]) && $condition["fee_unit"] !== ""){
            $select->where("fee_unit = ?",$condition["fee_unit"]);
        }
        if(isset($condition["fee_value"]) && $condition["fee_value"] != ""){
            $select->where("fee_value = ?",$condition["fee_value"]);
        }
        if(isset($condition["fee_currency_code"]) && $condition["fee_currency_code"] !== ""){
            $select->where("fee_currency_code = ?",$condition["fee_currency_code"]);
        }
        if(isset($condition["is_default_fee"]) && $condition["is_default_fee"] != ""){
            $select->where("is_default_fee = ?",$condition["is_default_fee"]);
        }
        if(isset($condition["warehouse_id_arr"]) && is_array($condition["warehouse_id_arr"])){
            $select->where("warehouse_id in(?)",$condition["warehouse_id_arr"]);
        }
        if(isset($condition["fee_discount"]) && $condition["fee_discount"] !== ""){
            $select->where("fee_discount = ?",$condition["fee_discount"]);
        }
        if(isset($condition["status"]) && $condition["status"] !== ""){
            $select->where("status = ?",$condition["status"]);
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