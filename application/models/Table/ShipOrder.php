<?php
class Table_ShipOrder
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ShipOrder();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ShipOrder();
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
    public function update($row, $value, $field = "so_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "so_id")
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
    public function getByField($value, $field = 'so_id', $colums = "*")
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
        if(isset($condition["order_id"]) && $condition["order_id"] != ""){
            $select->where("order_id = ?",$condition["order_id"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ?",$condition["order_code"]);
        }
        if(isset($condition["tracking_number"]) && $condition["tracking_number"] != ""){
            $select->where("tracking_number = ?",$condition["tracking_number"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
            $select->where("sm_code = ?",$condition["sm_code"]);
        }
        if(isset($condition["so_status"]) && $condition["so_status"] != ""){
            $select->where("so_status = ?",$condition["so_status"]);
        }
        if(isset($condition["so_weight"]) && $condition["so_weight"] != ""){
            $select->where("so_weight = ?",$condition["so_weight"]);
        }
        if(isset($condition["so_vol_weight"]) && $condition["so_vol_weight"] != ""){
            $select->where("so_vol_weight = ?",$condition["so_vol_weight"]);
        }
        if(isset($condition["so_length"]) && $condition["so_length"] != ""){
            $select->where("so_length = ?",$condition["so_length"]);
        }
        if(isset($condition["so_width"]) && $condition["so_width"] != ""){
            $select->where("so_width = ?",$condition["so_width"]);
        }
        if(isset($condition["so_height"]) && $condition["so_height"] != ""){
            $select->where("so_height = ?",$condition["so_height"]);
        }
        if(isset($condition["so_declared_value"]) && $condition["so_declared_value"] != ""){
            $select->where("so_declared_value = ?",$condition["so_declared_value"]);
        }
        if(isset($condition["so_insurance_value"]) && $condition["so_insurance_value"] != ""){
            $select->where("so_insurance_value = ?",$condition["so_insurance_value"]);
        }
        if(isset($condition["so_shipping_fee"]) && $condition["so_shipping_fee"] != ""){
            $select->where("so_shipping_fee = ?",$condition["so_shipping_fee"]);
        }
        if(isset($condition["currency_code"]) && $condition["currency_code"] != ""){
            $select->where("currency_code = ?",$condition["currency_code"]);
        }
        if(isset($condition["currency_rate"]) && $condition["currency_rate"] != ""){
            $select->where("currency_rate = ?",$condition["currency_rate"]);
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