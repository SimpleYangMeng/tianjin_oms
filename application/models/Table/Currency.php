<?php
class Table_Currency
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Currency();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Currency();
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
    public function update($row, $value, $field = "currency_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "currency_id")
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
    public function getByField($value, $field = 'currency_id', $colums = "*")
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
        
        if(isset($condition["currency_name_en"]) && $condition["currency_name_en"] != ""){
            $select->where("currency_name_en = ?",$condition["currency_name_en"]);
        }
        if(isset($condition["currency_name"]) && $condition["currency_name"] != ""){
            $select->where("currency_name = ?",$condition["currency_name"]);
        }
        if(isset($condition["currency_code"]) && $condition["currency_code"] != ""){
            $select->where("currency_code = ?",$condition["currency_code"]);
        }
        if(isset($condition["currency_symbol_left"]) && $condition["currency_symbol_left"] != ""){
            $select->where("currency_symbol_left = ?",$condition["currency_symbol_left"]);
        }
        if(isset($condition["currency_symbol_right"]) && $condition["currency_symbol_right"] != ""){
            $select->where("currency_symbol_right = ?",$condition["currency_symbol_right"]);
        }
        if(isset($condition["currency_decimal_point"]) && $condition["currency_decimal_point"] != ""){
            $select->where("currency_decimal_point = ?",$condition["currency_decimal_point"]);
        }
        if(isset($condition["currency_thousands_point"]) && $condition["currency_thousands_point"] != ""){
            $select->where("currency_thousands_point = ?",$condition["currency_thousands_point"]);
        }
        if(isset($condition["currency_decimal_places"]) && $condition["currency_decimal_places"] != ""){
            $select->where("currency_decimal_places = ?",$condition["currency_decimal_places"]);
        }
        if(isset($condition["currency_rate"]) && $condition["currency_rate"] != ""){
            $select->where("currency_rate = ?",$condition["currency_rate"]);
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