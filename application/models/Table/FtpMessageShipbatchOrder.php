<?php
class Table_FtpMessageShipbatchOrder
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_FtpMessageShipbatchOrder();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_FtpMessageShipbatchOrder();
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
    public function update($row, $value, $field = "fmso_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "fmso_id")
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
    public function getByField($value, $field = 'fmso_id', $colums = "*")
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

        if(isset($condition["fmt_code"]) && $condition["fmt_code"] != ""){
            $select->where("fmt_code = ?",$condition["fmt_code"]);
        }
        if(isset($condition["fmt_type"]) && $condition["fmt_type"] != ""){
            $select->where("fmt_type = ?",$condition["fmt_type"]);
        }
        if(isset($condition["sb_code"]) && $condition["sb_code"] != ""){
            $select->where("sb_code = ?",$condition["sb_code"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ?",$condition["order_code"]);
        }
        if((isset($condition["fml_status"]) && $condition["fml_status"] !== "")){
            $select->where("fml_status = ?",$condition["fml_status"]);
        }
        if((isset($condition["fml_status_arr"]) && $condition["fml_status_arr"] !== "")){
            $select->where("fml_status in (?)",$condition["fml_status_arr"]);
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