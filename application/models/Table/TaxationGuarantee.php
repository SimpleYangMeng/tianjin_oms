<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_TaxationGuarantee
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_TaxationGuarantee();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_TaxationGuarantee();
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
    public function update($row, $value, $field = "tg_id")
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
    public function getByField($value, $field = 'tg_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
    /**
     * 获取全部数据
     * @return [array] 
     */
    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, "*");
        return $this->_table->getAdapter()->fetchAll($select);
    }
    /**
     * [getByStatus 根据状态返回数据]
     * @param  [type]  $status   [数据状态]
     * @param  integer $pageSize [description]
     * @param  [type]  $minId    [description]
     * @return [type]            [description]
     */
    public function getByStatus($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        //$select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("status = ?", $status);
        $primaryKey = $this->_table->info('primary');
        $select->where("{$primaryKey[1]} > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }
    /**
     * 删除
     * @param int $value 
     * @param string $field 
     * @return number
     */
    public function delete($value, $field = "tg_id")
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
        if(isset($condition["customer_code"]) && !empty($condition["customer_code"])){
        	$select->where("customer_code = ?", $condition["customer_code"]);
        }
        if(isset($condition["g_type"]) && !empty($condition["g_type"])){
            $select->where("g_type = ?", $condition["g_type"]);
        }
        if(isset($condition["status"]) && !empty($condition["status"])){
            $select->where("status = ?", $condition["status"]);
        }
        if(isset($condition["status_arr"]) && !empty($condition["status_arr"])){
            $select->where("status in (?)", $condition["status_arr"]);
        }
        if(isset($condition["currency_code"]) && !empty($condition["currency_code"])){
            $select->where("currency_code = ?", $condition["currency_code"]);
        }
        if(isset($condition["guarantee_basis"]) && !empty($condition["guarantee_basis"])){
            $select->where("guarantee_basis = ?", $condition["guarantee_basis"]);
        }
        if(isset($condition["storage_customer_code"]) && !empty($condition["storage_customer_code"])){
            $select->where("storage_customer_code = ?", $condition["storage_customer_code"]);
        }
        if(isset($condition["data_status"]) && !empty($condition["data_status"])){
            $select->where("data_status = ?", $condition["data_status"]);
        }
        if(isset($condition['add_start_time']) && !empty($condition['add_start_time'])){
            $select->where("add_time >= ?", $condition["add_start_time"].' 00:00:00');
        }
        if(isset($condition['add_end_time']) && !empty($condition['add_end_time'])){
            $select->where("add_time <= ?", $condition["add_end_time"]. ' 23:59:59');
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
