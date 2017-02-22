<?php
class Table_CiqApiMessage
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CiqApiMessage();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CiqApiMessage();
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
    public function update($row, $value, $field = "cam_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "cam_id")
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
    public function getByField($value, $field = 'cam_id', $colums = "*")
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

        if(isset($condition["api_type"]) && $condition["api_type"] != ""){
            $select->where("api_type = ?",$condition["api_type"]);
        }
        if(isset($condition["api_code"]) && $condition["api_code"] != ""){
            $select->where("api_code = ?",$condition["api_code"]);
        }
        if(isset($condition["ref_id"]) && $condition["ref_id"] != ""){
            $select->where("ref_id = ?",$condition["ref_id"]);
        }
        if(isset($condition["message_type"]) && $condition["message_type"] != ""){
            $select->where("message_type = ?",$condition["message_type"]);
        }
        if(isset($condition["refer_code"]) && $condition["refer_code"] != ""){
        	$select->where("refer_code = ?",$condition["refer_code"]);
        }
        if(isset($condition["ref_cus_code"]) && $condition["ref_cus_code"] != ""){
        	$select->where("ref_cus_code = ?",$condition["ref_cus_code"]);
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
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }

    /**
     * [getByStatus description]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  [type]  $minId    [description]
     * @return [type]            [description]
     */
    public function getByStatus($status, $apiCode, $minId, $pageSize = 0)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("status = ?", $status);
        $select->where("cam_id > ?", $minId);
        $select->where("api_code = ?", $apiCode);
        $select->limit($pageSize);
        $sql = $select->__toString();

        return $this->_table->getAdapter()->fetchAll($sql);
    }
}
