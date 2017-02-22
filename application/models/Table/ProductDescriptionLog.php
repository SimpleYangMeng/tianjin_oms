<?php
class Table_ProductDescriptionLog
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ProductDescriptionLog();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ProductDescriptionLog();
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
    public function update($row, $value, $field = "pdl_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "pdl_id")
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
    public function getByField($value, $field = 'pdl_id', $colums = "*")
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
        
        if(isset($condition["pdl_product_id"]) && $condition["pdl_product_id"] != ""){
            $select->where("pdl_product_id = ?",$condition["pdl_product_id"]);
        }
        if(isset($condition["pdl_language_id"]) && $condition["pdl_language_id"] != ""){
            $select->where("pdl_language_id = ?",$condition["pdl_language_id"]);
        }
        if(isset($condition["user_id"]) && $condition["user_id"] != ""){
            $select->where("user_id = ?",$condition["user_id"]);
        }
        if(isset($condition["pdl_name"]) && $condition["pdl_name"] != ""){
            $select->where("pdl_name = ?",$condition["pdl_name"]);
        }
        if(isset($condition["pdl_description"]) && $condition["pdl_description"] != ""){
            $select->where("pdl_description = ?",$condition["pdl_description"]);
        }
        if(isset($condition["pdl_description_short"]) && $condition["pdl_description_short"] != ""){
            $select->where("pdl_description_short = ?",$condition["pdl_description_short"]);
        }
        if(isset($condition["pdl_keywords"]) && $condition["pdl_keywords"] != ""){
            $select->where("pdl_keywords = ?",$condition["pdl_keywords"]);
        }
        if(isset($condition["pdl_product_status"]) && $condition["pdl_product_status"] != ""){
            $select->where("pdl_product_status = ?",$condition["pdl_product_status"]);
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