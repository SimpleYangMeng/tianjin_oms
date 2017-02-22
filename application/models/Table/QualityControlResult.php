<?php
class Table_QualityControlResult
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_QualityControlResult();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_QualityControlResult();
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
    public function update($row, $value, $field = "qcr_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "qcr_id")
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
    public function getByField($value, $field = 'qcr_id', $colums = "*")
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
        
        if(isset($condition["qc_id"]) && $condition["qc_id"] != ""){
            $select->where("qc_id = ?",$condition["qc_id"]);
        }
        if(isset($condition["qc_code"]) && $condition["qc_code"] != ""){
            $select->where("qc_code = ?",$condition["qc_code"]);
        }
        if(isset($condition["pqo_id"]) && $condition["pqo_id"] != ""){
            $select->where("pqo_id = ?",$condition["pqo_id"]);
        }
        if(isset($condition["qcr_quantity_pass"]) && $condition["qcr_quantity_pass"] != ""){
            $select->where("qcr_quantity_pass = ?",$condition["qcr_quantity_pass"]);
        }
        if(isset($condition["qcr_quantity_problem"]) && $condition["qcr_quantity_problem"] != ""){
            $select->where("qcr_quantity_problem = ?",$condition["qcr_quantity_problem"]);
        }
        if(isset($condition["qcr_problem_type"]) && $condition["qcr_problem_type"] != ""){
            $select->where("qcr_problem_type = ?",$condition["qcr_problem_type"]);
        }
        if(isset($condition["qcr_description"]) && $condition["qcr_description"] != ""){
            $select->where("qcr_description = ?",$condition["qcr_description"]);
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