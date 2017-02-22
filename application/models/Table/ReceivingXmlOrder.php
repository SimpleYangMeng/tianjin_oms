<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 15-1-30
 * Time: 下午2:06
 * To change this template use File | Settings | File Templates.
 */
class Table_ReceivingXmlOrder
{
    protected $_table = null;

    public function __construct(){
        $this->_table = new DbTable_ReceivingXmlOrder();
    }

    public function getAdapter(){
        return $this->_table->getAdapter();
    }

    public function getInstance(){
        return new Table_ReceivingXmlOrder();
    }

    public function add($row){
        $this->_table->insert($row);
    }

    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function update($row, $value, $field = "rxo_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "rxo_id")
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
    public function getByField($value, $field = 'rxo_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = ""){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);

        if(isset($condition["rx_id"]) && $condition["rx_id"] != ""){
            $select->where("rx_id = ?",$condition["rx_id"]);
        }
        if(isset($condition["sub_receiving_code"]) && $condition["sub_receiving_code"] != ""){
            $select->where("sub_receiving_code = ?",$condition["sub_receiving_code"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ?",$condition["order_code"]);
        }

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
