<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_SjUseWay
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_SjUseWay();
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
    public function update($row, $value, $field = 'suw_id')
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
    public function getByField($value, $field = 'suw_id', $colums = '*')
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
        if(isset($condition['suw_id']) && $condition['suw_id'] != ''){
            $select->where('suw_id = ? ',$condition['suw_id']);
        }
        if(isset($condition['x_code']) && $condition['x_code'] != ''){
            $select->where('x_code = ? ',$condition['x_code']);
        }
        if(isset($condition['x_name']) && $condition['x_name'] != ''){
            $select->where('x_name = ? ',$condition['x_name']);
        }
        if(isset($condition['x_seq_no']) && $condition['x_seq_no'] != ''){
            $select->where('x_seq_no = ? ',$condition['x_seq_no']);
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