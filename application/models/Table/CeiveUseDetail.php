<?php
class Table_CeiveUseDetail
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CeiveUseDetail();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CeiveUseDetail();
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
    public function update($row, $value, $field = "cud_id")
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
    public function getByField($value, $field = 'cud_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
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

        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
		$select->join('product', 'ceive_use_detail.product_id = product.product_id', '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        
        if(isset($condition["cu_code"]) && $condition["cu_code"] != ""){
            $select->where("cu_code = ?",$condition["cu_code"]);
        }
        if(isset($condition["cud_username"]) && $condition["cud_username"] != ""){
            $select->where("cud_username = ?",$condition["cud_username"]);
        }
        if(isset($condition["cud_status"]) && $condition["cud_status"] !== ""){
            $select->where("cud_status = ?",$condition["cud_status"]);
        }
        if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
            $select->where("product_barcode = ?",$condition["product_barcode"]);
        }
		if(isset($condition["product_id"]) && $condition["product_id"] !== ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
		if(isset($condition["cud_type"]) && $condition["cud_type"] !== ""){
            $select->where("cud_type = ?",$condition["cud_type"]);
        }
		if(isset($condition["sku"]) && $condition["sku"] != ""){
            $select->where("product_sku = ?",$condition["sku"]);
        }
		if(isset($condition["account_code"]) && $condition["account_code"] != ""){
            $select->where("customer_code = ?",$condition["account_code"]);
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
