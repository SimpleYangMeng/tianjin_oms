<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-4-8
 * Time: 下午6:02
 * To change this template use File | Settings | File Templates.
 */
class Table_ReceivingAttribute
{
    protected $_table = null;

    public function __construct(){
        $this->_table = new DbTable_ReceivingAttribute();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance(){
        return new Table_ReceivingAttribute();
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
    public function update($row, $value, $field = "ra_id")
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
    public function getByField($value, $field = 'ra_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
}
