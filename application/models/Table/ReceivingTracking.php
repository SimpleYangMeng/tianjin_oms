<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-11-5
 * Time: 下午5:07
 * To change this template use File | Settings | File Templates.
 */
class Table_ReceivingTracking
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ReceivingTracking();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ReceivingTracking();
    }

    /**
     * @param $row
     * @return mixed
     */
    public function add($row)
    {
        return $this->_table->insert($row);
    }

    public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy1 = "",$orderBy2 = ""){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);

        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where("receiving_code = ?",$condition["receiving_code"]);
        }
        /*CONDITION_END*/
        if ('count(*)' == $type) {
            return $this->_table->getAdapter()->fetchOne($select);
        } else {
            if (!empty($orderBy1)) {
                $select->order($orderBy1);
            }
            if(!empty($orderBy2)){
                $select->order($orderBy2);
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
