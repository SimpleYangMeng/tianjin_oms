<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_CustomerLog
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CustomerLog();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CustomerLog();
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
    public function update($row, $value, $field = "cl_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'cl_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    /**
     * 删除
     * @param int $value
     * @param string $field
     * @return number
     */
    public function delete($value, $field = "cl_id")
    {
    	$where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
    	return $this->_table->delete($where);
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
        $select = $this->_setCondition($select, $condition);
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
     * [_setCondition 设置条件]
     * @param [type] $select    [description]
     * @param array  $condition [description]
     */
    private function _setCondition($select, $condition=array()){
        if(isset($condition["cl_id"]) && $condition["cl_id"] != ""){
            $select->where("cl_id = ? ", $condition["cl_id"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ? ", $condition["customer_id"]);
        }
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ? ", $condition["customer_code"]);
        }
        if(isset($condition["status_type"]) && $condition["status_type"] != ""){
            $select->where("status_type = ? ", $condition["status_type"]);
        }
        return $select;
    }
}
