<?php
class Table_ConfigCondition
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ConfigCondition();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ConfigCondition();
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
    public function update($row, $value, $field = "cc_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "cc_id")
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
    public function getByField($value, $field = 'cc_id', $colums = "*")
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
        
        if(isset($condition["config_id"]) && $condition["config_id"] != ""){
            $select->where("config_id = ?",$condition["config_id"]);
        }
        if(isset($condition["cc_column"]) && $condition["cc_column"] != ""){
            $select->where("cc_column = ?",$condition["cc_column"]);
        }
        if(isset($condition["cv_id"]) && $condition["cv_id"] != ""){
            $select->where("cv_id = ?",$condition["cv_id"]);
        }
        if(isset($condition["cc_operator"]) && $condition["cc_operator"] != ""){
            $select->where("cc_operator = ?",$condition["cc_operator"]);
        }
        if(isset($condition["cc_value"]) && $condition["cc_value"] != ""){
            $select->where("cc_value = ?",$condition["cc_value"]);
        }
        if(isset($condition["cc_update_time"]) && $condition["cc_update_time"] != ""){
            $select->where("cc_update_time = ?",$condition["cc_update_time"]);
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