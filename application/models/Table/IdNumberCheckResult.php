<?php
class Table_IdNumberCheckResult
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_IdNumberCheckResult();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_IdNumberCheckResult();
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
    public function update($row, $value, $field = "incr_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "incr_id")
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
    public function getByField($value, $field = 'incr_id', $colums = "*")
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


    public function getByStatus($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("status = ?", $status);
        $select->where("incr_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }

    /**
     * @param array $condition
     * @param string $type
     * @param int $pageSize
     * @param int $page
     * @param string $orderBy
     * @return array|string
     */
    public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "",$lock='')
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        if(isset($condition["incr_id"]) && $condition["incr_id"] != ""){
            $select->where("incr_id = ?",$condition["incr_id"]);
        }
        if(isset($condition["inc_id"]) && $condition["inc_id"] != ""){
            $select->where("inc_id = ?",$condition["inc_id"]);
        }
        if(isset($condition["result_gmsfhm"]) && $condition["result_gmsfhm"] != ""){
            $select->where("result_gmsfhm = ?",$condition["result_gmsfhm"]);
        }
        if(isset($condition["result_xm"]) && $condition["result_xm"] != ""){
            $select->where("result_xm = ?",$condition["result_xm"]);
        }
        if(isset($condition["errorcode"]) && $condition["errorcode"] !== ""){
            $select->where("errorcode = ?",$condition["errorcode"]);
        }
        if(isset($condition["errormsg"]) && $condition["errormsg"] !== ""){
            $select->where("errormsg = ?",$condition["errormsg"]);
        }
        if(isset($condition["errormesagecol"]) && $condition["errormesagecol"] !== ""){
            $select->where("errormesagecol = ?",$condition["errormesagecol"]);
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
            if(!empty($lock)){
                $sql.=" $lock";
            }
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }

}
