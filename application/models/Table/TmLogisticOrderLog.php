<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-9-17
 * Time: 下午5:56
 * To change this template use File | Settings | File Templates.
 */
class Table_TmLogisticOrderLog
{
    protected $_table = null;

    public function __construct(){
        $this->_table = new DbTable_TmLogisticOrderLog();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_TmLogisticOrderLog();
    }

    /**
     * @param $row
     * @return mixed
     */
    public function add($row)
    {
        return $this->_table->insert($row);
    }
}
