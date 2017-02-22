<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_SjNotice
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_SjNotice();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_SjUseWay();
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
    public function update($row, $value, $field = 'sn_id')
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
    public function getByField($value, $field = 'sn_id', $colums = '*')
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
    /**
     * [getAll 全部]
     * @return [type] [description]
     */
    public function getAll() {
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
        $select->where('1 = ?', 1);
        /*CONDITION_START*/
        if(isset($condition['sn_id']) && $condition['sn_id'] != ''){
            $select->where('sn_id = ? ',$condition['sn_id']);
        }
        if(isset($condition['sn_notice_serial_no']) && $condition['sn_notice_serial_no'] != ''){
            $select->where('sn_notice_serial_no = ? ',$condition['sn_notice_serial_no']);
        }
        if(isset($condition['sn_title']) && $condition['sn_title'] != ''){
            $select->where('sn_title = ? ',$condition['sn_title']);
        }
        if(isset($condition['sn_is_stop']) && $condition['sn_is_stop'] !== ''){
            $select->where('sn_is_stop = ? ',$condition['sn_is_stop']);
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
