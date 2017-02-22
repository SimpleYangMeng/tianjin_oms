<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_CiqBackMessBody
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CiqBackMessBody();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CiqBackMessBody();
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
    public function update($row, $value, $field = "cbmb_id")
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
    public function getByField($value, $field = 'cbmb_id', $colums = "*")
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
        if(isset($condition['cbmb_id']) && !empty($condition['cbmb_id'])){
            $select->where("cbmb_id = ?", $condition["cbmb_id"]);
        }
        if(isset($condition['cbmh_id']) && !empty($condition['cbmh_id'])){
            $select->where("cbmh_id = ?", $condition["cbmh_id"]);
        }
        if(isset($condition['receipt_type']) && !empty($condition['receipt_type'])){
            $select->where("receipt_type = ?", $condition["receipt_type"]);
        }
        if(isset($condition['receipt_no']) && !empty($condition['receipt_no'])){
            $select->where("receipt_no = ?", $condition["receipt_no"]);
        }
    	if(isset($condition['status']) && !empty($condition['status'])){
            $select->where("status = ?", $condition["status"]);
        }
    	if(isset($condition['msg_code']) && !empty($condition['msg_code'])){
            $select->where("msg_code = ?", $condition["msg_code"]);
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
