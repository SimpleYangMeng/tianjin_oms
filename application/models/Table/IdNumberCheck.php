<?php
class Table_IdNumberCheck
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_IdNumberCheck();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_IdNumberCheck();
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
    public function update($row, $value, $field = "inc_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "inc_id")
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
    public function getByField($value, $field = 'inc_id', $colums = "*")
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
        $select->where("inc_id > ?", $minId);
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

        if(isset($condition["inc_id"]) && $condition["inc_id"] != ""){
            $select->where("inc_id = ?",$condition["inc_id"]);
        }
        if(isset($condition["id_name"]) && $condition["id_name"] != ""){
            $select->where("id_name = ?",$condition["id_name"]);
        }
        if(isset($condition["IdType"]) && $condition["IdType"] != ""){
            $select->where("IdType = ?",$condition["IdType"]);
        }
        if(isset($condition["idNumber"]) && $condition["idNumber"] != ""){
            $select->where("idNumber = ?",$condition["idNumber"]);
        }
        if(isset($condition["status"]) && $condition["status"] !== ""){
            $select->where("status = ?",$condition["status"]);
        }

        if(isset($condition["status_array"]) && $condition["status_array"] !== ""){
            $select->where("status IN (?)",$condition["status_array"]);
        }

        if(isset($condition["customs_status"]) && $condition["customs_status"] !== ""){
            $select->where("customs_status = ?",$condition["customs_status"]);
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


    public function getByStatusQ($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("status IN (?)", array(2,3));
        $select->where("customs_status = ?", $status);
        $select->where("inc_type = ? ", 1 );
        $select->where("inc_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        // echo $sql;
        return $this->_table->getAdapter()->fetchAll($sql);
    }
}
