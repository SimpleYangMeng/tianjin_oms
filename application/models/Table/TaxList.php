<?php
class Table_TaxList
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_TaxList();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_TaxList();
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
    public function update($row, $value, $field = "tax_list_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    public function customUpdate($data, $condition, $value = '')
    {
        $where = $this->_table->getAdapter()->quoteInto($condition, $value);
        return $this->_table->update($data, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "tax_list_id")
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
    public function getByField($value, $field = 'tax_list_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, "*");
        return $this->_table->getAdapter()->fetchAll($select);
    }

    public function getByCondition($condition = array(), $field = '*', $order = '', $pageSize = 20, $page = 0)
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $field);
        $select->where("1=?", 1);
        if (isset($condition["customer_code"]) && $condition["customer_code"] !== "") {
            $select->where("customer_code=?", $condition["customer_code"]);
        }

        if (isset($condition["tax_pmt_no"]) && $condition["tax_pmt_no"] !== "") {
            $select->where("tax_pmt_no=?", $condition["tax_pmt_no"]);
        }

        if (isset($condition["order_no"]) && $condition["order_no"] !== "") {
            $select->where("order_no=?", $condition["order_no"]);
        }

        if (isset($condition["form_id"]) && $condition["form_id"] !== "") {
            $select->where("form_id=?", $condition["form_id"]);
        }

        //echo $select;
        if ('count(*)' == $field) {
            return $this->_table->getAdapter()->fetchOne($select);
        } else {
            if (!empty($order)) {
                $select->order($order);
            }
            if ($pageSize > 0 && $page > 0) {
                $page = ($page - 1) * $pageSize;
                $select->limit($pageSize, $page);
            }
            $sql = $select->__toString();
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }

}
