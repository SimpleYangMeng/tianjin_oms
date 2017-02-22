<?php
class Table_EmailTemplate
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_EmailTemplate();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_EmailTemplate();
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
    public function update($row, $value, $field = "et_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "et_id")
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
    public function getByField($value, $field = 'et_id', $colums = "*")
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
        
        if(isset($condition["et_title"]) && $condition["et_title"] != ""){
            $select->where("et_title = ?",$condition["et_title"]);
        }
        if(isset($condition["et_name"]) && $condition["et_name"] != ""){
            $select->where("et_name = ?",$condition["et_name"]);
        }
        if(isset($condition["et_from"]) && $condition["et_from"] != ""){
            $select->where("et_from = ?",$condition["et_from"]);
        }
        if(isset($condition["et_to"]) && $condition["et_to"] != ""){
            $select->where("et_to = ?",$condition["et_to"]);
        }
        if(isset($condition["et_copyto"]) && $condition["et_copyto"] != ""){
            $select->where("et_copyto = ?",$condition["et_copyto"]);
        }
        if(isset($condition["et_content"]) && $condition["et_content"] != ""){
            $select->where("et_content = ?",$condition["et_content"]);
        }
        if(isset($condition["et_type"]) && $condition["et_type"] != ""){
            $select->where("et_type = ?",$condition["et_type"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
        if(isset($condition["et_count"]) && $condition["et_count"] != ""){
            $select->where("et_count = ?",$condition["et_count"]);
        }
        if(isset($condition["et_default"]) && $condition["et_default"] != ""){
            $select->where("et_default = ?",$condition["et_default"]);
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