<?php
class Table_ProductAttached
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ProductAttached();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ProductAttached();
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
    public function update($row, $value, $field = "pa_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "pa_id")
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
    public function getByField($value, $field = 'pa_id', $colums = "*")
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
        
        if(isset($condition["product_id"]) && $condition["product_id"] != ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["pa_path"]) && $condition["pa_path"] != ""){
            $select->where("pa_path = ?",$condition["pa_path"]);
        }
        if(isset($condition["pa_file_type"]) && $condition["pa_file_type"] != ""){
            $select->where("pa_file_type = ?",$condition["pa_file_type"]);
        }
        if(isset($condition["pa_status"]) && $condition["pa_status"] != ""){
            $select->where("pa_status = ?",$condition["pa_status"]);
        }
        if(isset($condition["languages_id"]) && $condition["languages_id"] != ""){
            $select->where("languages_id = ?",$condition["languages_id"]);
        }
        if(isset($condition["pa_sort"]) && $condition["pa_sort"] != ""){
            $select->where("pa_sort = ?",$condition["pa_sort"]);
        }
        if(isset($condition["pa_update_time"]) && $condition["pa_update_time"] != ""){
            $select->where("pa_update_time = ?",$condition["pa_update_time"]);
        }
		if(isset($condition["pa_type"]) && $condition["pa_type"] !== ""){
            $select->where("pa_type = ?",$condition["pa_type"]);
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
     * 构造自定义SQL语句查询
     *
     * @access	public
     * @param   string	($field		待返回的字段，默认为所有)
     * @param   string	($condition	查询条件)
     * @param	mixed	($value		待转换查询字段值)
     * @return	mixed
     */
    public function getCustomQuery($field = '*', $condition = '', $value = '')
    {
    	$table	= $this->_table->info('name');
    	$sql	= "SELECT $field FROM $table $condition";
    	$sql	= $this->_table->getAdapter()->quoteInto($sql, $value);
    	return $this->_table->getAdapter()->fetchAll($sql);
    }

}