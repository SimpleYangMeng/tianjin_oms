<?php
class Table_FtpMessageReceivelist
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_FtpMessageReceivelist();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_FtpMessageReceivelist();
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
    public function update($row, $value, $field = "fmr_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "fmr_id")
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
    public function getByField($value, $field = 'fmr_id', $colums = "*")
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
        
        if(isset($condition["fmt_type"]) && $condition["fmt_type"] != ""){
            $select->where("fmt_type = ?",$condition["fmt_type"]);
        }
        if(isset($condition["refercence_no"]) && $condition["refercence_no"] != ""){
            $select->where("refercence_no = ?",$condition["refercence_no"]);
        }
        if(isset($condition["ems_cop_no"]) && $condition["ems_cop_no"] != ""){
            $select->where("ems_cop_no = ?",$condition["ems_cop_no"]);
        }
        if(isset($condition["fmr_comment"]) && $condition["fmr_comment"] != ""){
            $select->where("fmr_comment = ?",$condition["fmr_comment"]);
        }
        if(isset($condition["fmr_failed_count"]) && $condition["fmr_failed_count"] != ""){
            $select->where("fmr_failed_count = ?",$condition["fmr_failed_count"]);
        }
        if(isset($condition["fmr_status"]) && $condition["fmr_status"] != ""){
            $select->where("fmr_status = ?",$condition["fmr_status"]);
        }
        if(isset($condition["fmr_receive_time"]) && $condition["fmr_receive_time"] != ""){
            $select->where("fmr_receive_time = ?",$condition["fmr_receive_time"]);
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