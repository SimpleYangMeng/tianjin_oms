<?php
class Table_GoodsListDetail
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_GoodsListDetail();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_GoodsListDetail();
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
    public function update($row, $value, $field = "gld_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?",$value);
         return $this->_table->update($row, $where);	
	}

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "gld_id")
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
    public function getByField($value, $field = 'gld_id', $columns = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $columns);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
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

        if (isset($condition["gl_id"]) && $condition["gl_id"] != "") {
            $select->where("gl_id = ?", $condition["gl_id"]);
        }

        if (isset($condition["gl_code"]) && $condition["gl_code"] != "") {
            $select->where("gl_code = ?", $condition["gl_code"]);
        }

        if (isset($condition["product_id"]) && $condition["product_id"] != "") {
            $select->where("product_id = ?", $condition["product_id"]);
        }

        if (isset($condition["register_id"]) && $condition["register_id"] != "") {
            $select->where("register_id = ?", $condition["register_id"]);
        }

        //echo $select."</br>";//exit;
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