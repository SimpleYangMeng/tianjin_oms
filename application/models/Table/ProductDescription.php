<?php
class Table_ProductDescription
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ProductDescription();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ProductDescription();
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
    public function update($row, $value, $field = "pd_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "pd_id")
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
    public function getByField($value, $field = 'pd_id', $colums = "*")
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
        
        if(isset($condition["site_name"]) && $condition["site_name"] != ""){
            $select->where("site_name = ?",$condition["site_name"]);
        }
        if(isset($condition["product_id"]) && $condition["product_id"] != ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["language_id"]) && $condition["language_id"] != ""){
            $select->where("language_id = ?",$condition["language_id"]);
        }
        if(isset($condition["pd_name"]) && $condition["pd_name"] != ""){
            $select->where("pd_name = ?",$condition["pd_name"]);
        }
        if(isset($condition["pd_title"]) && $condition["pd_title"] != ""){
            $select->where("pd_title = ?",$condition["pd_title"]);
        }
        if(isset($condition["pd_keyword"]) && $condition["pd_keyword"] != ""){
            $select->where("pd_keyword = ?",$condition["pd_keyword"]);
        }
        if(isset($condition["pd_description_short"]) && $condition["pd_description_short"] != ""){
            $select->where("pd_description_short = ?",$condition["pd_description_short"]);
        }
        if(isset($condition["pd_description"]) && $condition["pd_description"] != ""){
            $select->where("pd_description = ?",$condition["pd_description"]);
        }
        if(isset($condition["pd_attention"]) && $condition["pd_attention"] != ""){
            $select->where("pd_attention = ?",$condition["pd_attention"]);
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