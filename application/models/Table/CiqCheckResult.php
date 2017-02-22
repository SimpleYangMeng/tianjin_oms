<?php
class Table_CiqCheckResult
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CiqCheckResult();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CiqCheckResult();
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
    public function update($row, $value, $field = "ccr_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "ccr_id")
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
    public function getByField($value, $field = 'ccr_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    /**
     * [getByFieldLock 锁表]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByFieldLock($value, $field = 'ccr_id', $colums = '*'){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->forUpdate();
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
        if(isset($condition["entryid"]) && $condition["entryid"] != ""){
            $select->where("entryid = ?",$condition["entryid"]);
        }
        if(isset($condition["orderNo"]) && $condition["orderNo"] != ""){
            $select->where("orderNo = ?",$condition["orderNo"]);
        }
        if(isset($condition["logisticsNo"]) && $condition["logisticsNo"] != ""){
            $select->where("logisticsNo = ?",$condition["logisticsNo"]);
        }
        if(isset($condition["logisticsCode"]) && $condition["logisticsCode"] != ""){
            $select->where("logisticsCode = ?",$condition["logisticsCode"]);
        }
        if(isset($condition["checkResult"]) && $condition["checkResult"] != ""){
            $select->where("checkResult = ?",$condition["checkResult"]);
        }
        if(isset($condition["checkType"]) && $condition["checkType"] != ""){
            $select->where("checkType = ?",$condition["checkType"]);
        }
        if(isset($condition["ciq_status"]) && $condition["ciq_status"] != ""){
            $select->where("ciq_status = ?",$condition["ciq_status"]);
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

    /**
     * [getByCiqStatus description]
     * @param  [type]  $ciq_status   [description]
     * @param  integer $pageSize [description]
     * @param  [type]  $min_id    [description]
     * @return [type]            [description]
     */
    public function getByCiqStatus($ciq_status, $min_id, $pageSize = 0)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1=?", 1);
        /*CONDITION_START*/
        $select->where("ciq_status = ?", $ciq_status);
        $select->where("ccr_id > ?", $min_id);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }
}
