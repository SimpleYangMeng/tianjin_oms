<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_CiqBackMessHead
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CiqBackMessHead();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CiqBackMessHead();
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
    public function update($row, $value, $field = "bmb_id")
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
    public function getByField($value, $field = 'bmb_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
	/**
     * [getByStatus description]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  [type]  $minId    [description]
     * @return [type]            [description]
     */
    public function getByStatus($status, $apiCode, $minId, $pageSize = 0)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("status = ?", $status);
        $select->where("cbmh_id > ?", $minId);
        $select->where("message_type = ?", $apiCode);
        $select->limit($pageSize);
        $sql = $select->__toString();
//echo $sql;die();
        return $this->_table->getAdapter()->fetchAll($sql);
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
        if(isset($condition['message_id']) && !empty($condition['message_id'])){
            $select->where("message_id = ? ", $condition["message_id"]);
        }
        if(isset($condition['message_type']) && !empty($condition['message_type'])){
            $select->where("message_type = ? ", $condition["message_type"]);
        }
        if(isset($condition['message_time']) && !empty($condition['message_time'])){
            $select->where("message_time = ? ", $condition["message_time"]);
        }
		if(isset($condition['status']) && !empty($condition['status'])){
            $select->where("status = ? ", $condition["status"]);
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
