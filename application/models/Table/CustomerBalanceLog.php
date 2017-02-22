<?php
class Table_CustomerBalanceLog
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CustomerBalanceLog();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CustomerBalanceLog();
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
    public function update($row, $value, $field = "cbl_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "cbl_id")
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
    public function getByField($value, $field = 'cbl_id', $colums = "*")
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
        
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition["cbl_transaction_value"]) && $condition["cbl_transaction_value"] != ""){
            $select->where("cbl_transaction_value = ?",$condition["cbl_transaction_value"]);
        }
        if(isset($condition['cbl_type'])&&$condition['cbl_type']!=""){
            $select->where(" cbl_type= ? ",$condition['cbl_type']);
        }
        if(isset($condition["cbl_value"]) && $condition["cbl_value"] != ""){
            $select->where("cbl_value = ?",$condition["cbl_value"]);
        }
        if(isset($condition["currency_rate"]) && $condition["currency_rate"] != ""){
            $select->where("currency_rate = ?",$condition["currency_rate"]);
        }
        if(isset($condition["currency_code"]) && $condition["currency_code"] != ""){
            $select->where("currency_code = ?",$condition["currency_code"]);
        }
        if(isset($condition["cbl_note"]) && $condition["cbl_note"] != ""){
            $select->where("cbl_note = ?",$condition["cbl_note"]);
        }
        if(isset($condition["user_id"]) && $condition["user_id"] != ""){
            $select->where("user_id = ?",$condition["user_id"]);
        }
        if(isset($condition["fee_id"]) && $condition["fee_id"] != ""){
            $select->where("fee_id = ?",$condition["fee_id"]);
        }
        if(isset($condition["cbl_current_value"]) && $condition["cbl_current_value"] != ""){
            $select->where("cbl_current_value = ?",$condition["cbl_current_value"]);
        }
        if(isset($condition["cbl_current_hold_value"]) && $condition["cbl_current_hold_value"] != ""){
            $select->where("cbl_current_hold_value = ?",$condition["cbl_current_hold_value"]);
        }
        if(isset($condition["application_code"]) && $condition["application_code"] != ""){
            $select->where("application_code = ?",$condition["application_code"]);
        }
        if(isset($condition["cbl_refer_code"]) && $condition["cbl_refer_code"] != ""){
            $select->where("cbl_refer_code = ?",$condition["cbl_refer_code"]);
        }
		
        if(isset($condition["cblReferType"]) && $condition["cblReferType"] != ""){
            $select->where("cbl_refer_type = ?",$condition["cblReferType"]);
        }		
		
		
        if(isset($condition["cbl_cus_code"]) && $condition["cbl_cus_code"] != ""){
        	$select->where("cbl_cus_code = ?",$condition["cbl_cus_code"]);
        }
        if(isset($condition["add_time_start"]) && $condition["add_time_start"] != ""){
            $select->where("cbl_add_time >= ?",$condition["add_time_start"] . ' 00:00:00');
        }
        if(isset($condition["add_time_end"]) && $condition["add_time_end"] != ""){
            $select->where("cbl_add_time <= ?",$condition["add_time_end"] . ' 23:59:59');
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