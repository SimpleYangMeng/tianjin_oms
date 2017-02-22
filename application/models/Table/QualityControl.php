<?php
class Table_QualityControl
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_QualityControl();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_QualityControl();
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
    public function update($row, $value, $field = "qc_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "qc_id")
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
    public function getByField($value, $field = 'qc_id', $colums = "*")
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
        
        if(isset($condition["qc_code"]) && $condition["qc_code"] != ""){
            $select->where("qc_code = ?",$condition["qc_code"]);
        }
        if(isset($condition["receiving_id"]) && $condition["receiving_id"] != ""){
            $select->where("receiving_id = ?",$condition["receiving_id"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where("receiving_code = ?",$condition["receiving_code"]);
        }
        if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
            $select->where("product_barcode = ?",$condition["product_barcode"]);
        }
        if(isset($condition["product_id"]) && $condition["product_id"] != ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition["qc_operator_id"]) && $condition["qc_operator_id"] != ""){
            $select->where("qc_operator_id = ?",$condition["qc_operator_id"]);
        }
        if(isset($condition["qc_quantity"]) && $condition["qc_quantity"] != ""){
            $select->where("qc_quantity = ?",$condition["qc_quantity"]);
        }
        if(isset($condition["qc_received_quantity"]) && $condition["qc_received_quantity"] != ""){
            $select->where("qc_received_quantity = ?",$condition["qc_received_quantity"]);
        }
        if(isset($condition["qc_quantity_sellable"]) && $condition["qc_quantity_sellable"] != ""){
            $select->where("qc_quantity_sellable = ?",$condition["qc_quantity_sellable"]);
        }
        if(isset($condition["qc_quantity_unsellable"]) && $condition["qc_quantity_unsellable"] != ""){
            $select->where("qc_quantity_unsellable = ?",$condition["qc_quantity_unsellable"]);
        }
        if(isset($condition["qc_status"]) && $condition["qc_status"] != ""){
            $select->where("qc_status = ?",$condition["qc_status"]);
        }
        if(isset($condition["lc_code"]) && $condition["lc_code"] != ""){
            $select->where("lc_code = ?",$condition["lc_code"]);
        }
        if(isset($condition["qc_note"]) && $condition["qc_note"] != ""){
            $select->where("qc_note = ?",$condition["qc_note"]);
        }
        if(isset($condition['abnormal'])&&$condition['abnormal']!=""){
            if($condition['abnormal']>0){
                $select->where("qc_quantity_unsellable > 0");
            }else{
                $select->where("qc_quantity_unsellable = 0");
            }

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

    public function getJoinProductByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = ""){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->joinLeft("product","product.product_id=".$table.".product_id",array('product_sku'));
        $select->joinLeft("receiving","receiving.receiving_code=".$table.".receiving_code",array('reference_no'));
        $select->where("1 =?", 1);

        if(isset($condition["qc_code"]) && $condition["qc_code"] != ""){
            $select->where("qc_code = ?",$condition["qc_code"]);
        }
        if(isset($condition["receiving_id"]) && $condition["receiving_id"] != ""){
            $select->where("receiving_id = ?",$condition["receiving_id"]);
        }
        if(isset($condition['reference_no'])&&$condition['reference_no']!=""){
            $select->where("reference_no= ?",$condition['reference_no']);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where($table.".warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where($table.".receiving_code = ?",$condition["receiving_code"]);
        }
        if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
            $select->where($table.".product_barcode = ?",$condition["product_barcode"]);
        }
        if(isset($condition['product_sku'])&&$condition['product_sku']!=""){
            $select->where("product.product_sku = ? ",$condition['product_sku']);
        }
        if(isset($condition["product_id"]) && $condition["product_id"] != ""){
            $select->where($table.".product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where($table.".customer_code = ?",$condition["customer_code"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where($table.".customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition["qc_operator_id"]) && $condition["qc_operator_id"] != ""){
            $select->where("qc_operator_id = ?",$condition["qc_operator_id"]);
        }
        if(isset($condition["qc_quantity"]) && $condition["qc_quantity"] != ""){
            $select->where("qc_quantity = ?",$condition["qc_quantity"]);
        }
        if(isset($condition["qc_received_quantity"]) && $condition["qc_received_quantity"] != ""){
            $select->where("qc_received_quantity = ?",$condition["qc_received_quantity"]);
        }
        if(isset($condition["qc_quantity_sellable"]) && $condition["qc_quantity_sellable"] != ""){
            $select->where("qc_quantity_sellable = ?",$condition["qc_quantity_sellable"]);
        }
        if(isset($condition["qc_quantity_unsellable"]) && $condition["qc_quantity_unsellable"] != ""){
            $select->where("qc_quantity_unsellable = ?",$condition["qc_quantity_unsellable"]);
        }
        if(isset($condition["qc_status"]) && $condition["qc_status"] != ""){
            $select->where("qc_status = ?",$condition["qc_status"]);
        }
        if(isset($condition["lc_code"]) && $condition["lc_code"] != ""){
            $select->where("lc_code = ?",$condition["lc_code"]);
        }
        if(isset($condition["qc_note"]) && $condition["qc_note"] != ""){
            $select->where("qc_note = ?",$condition["qc_note"]);
        }
        if(isset($condition['abnormal'])&&$condition['abnormal']!=""){
            if($condition['abnormal']>0){
                $select->where("qc_quantity_unsellable > 0");
            }else{
                $select->where("qc_quantity_unsellable = 0");
            }

        }
        if(isset($condition['qc_add_time'])&&$condition['qc_add_time']!=""){
            $select->where(" qc_add_time>= ?",$condition['qc_add_time']." 00:00:00");
            $select->where(" qc_add_time<= ?",$condition['qc_add_time']." 23:59:59");
        }
        if(isset($condition['qc_finish_time_start'])&&$condition['qc_finish_time_start']!=""){
            $select->where(" qc_finish_time>= ?",$condition['qc_finish_time_start']." 00:00:00");
        }
        if(isset($condition['qc_finish_time_end'])&&$condition['qc_finish_time_end']!=""){
            $select->where(" qc_finish_time<= ?",$condition['qc_finish_time_end']." 23:59:59");
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