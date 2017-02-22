<?php

/**
 * luffy丶大叔 
 * <><><><><><><><><><><><><>有妹子加微信不哦！~<><><><><><><><><><><><><><><><>
 * @Author: luffy丶大叔 
 * @Z 2015-8-20 14:00:23
 * @email luffy00789@126.com
 * @encoding UTF-8
*/

class Table_ProductSupervisionAttached
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ProductSupervisionAttached();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ProductSupervisionAttached();
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
    public function update($row, $value, $field = "psa_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }
    
    public function delete($value, $field='psa_id') {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->delete($where);
    }
    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'psa_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
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
        
        if(isset($condition["product_id"]) && $condition["product_id"] !== ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["st_id"]) && $condition["st_id"] !== ""){
            $select->where("st_id = ?",$condition["st_id"]);
        }
        
        /*CONDITION_END*/
        if ('count(*)' == $type) {
            return $this->_table->getAdapter()->fetchOne($select);
        } else if('max(sort)' == $type){
            return $this->_table->getAdapter()->fetchOne($select);
        }else{
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
