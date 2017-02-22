<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_Waybill
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Waybill();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Waybill();
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
    public function update($row, $value, $field = "wb_id")
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
    public function getByField($value, $field = 'wb_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
    /**
     * [getByWhere 多条件获取]
     * @param  [type] $where  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByWhere($where, $colums = "*") {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        foreach($where as $field=>$value) {
            $select->where("{$field} = ?", $value);
        }
        return $this->_table->getAdapter()->fetchRow($select);
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
        $select->where("app_status = ?", $status);
        $primaryKey = $this->_table->info('primary');
        $select->where("{$primaryKey[1]} > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
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
        $select->where("1 = ?", 1);
        /*CONDITION_START*/
        if(isset($condition['start_time']) && !empty($condition['start_time'])){
            $select->where("wb_add_time >= ?", $condition["start_time"].' 00:00:00');
        }
        if(isset($condition['end_time']) && !empty($condition['end_time'])){
            $select->where("wb_add_time <= ?", $condition["end_time"]. ' 23:59:59');
        }

        /*CONDITION_START*/
       $select = $this->_setCondition($select, $condition);
        /*CONDITION_END*/
        if ('count(*)' == $type) {
            //$sql = $select->__toString();
            //echo $sql;die();
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
     * [getGroupByCondition 分组统计]
     * @param  [type] $condition [description]
     * @param  [type] $field     [description]
     * @return [type]            [description]
     */
    public function getGroupByCondition($condition, $field)
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, array(
            $field,'count(*) as n'
        ));
        /*CONDITION_START*/
        if(isset($condition[$field])){
            unset($condition[$field]);
        }
        $select = $this->_setCondition($select, $condition);
        /*CONDITION_END*/
        $select->group($field);
        $sql = $select->__toString();
        $fieldGroup = $this->_table->getAdapter()->fetchAll($sql);
        $fieldGroupRows = array();
        if(!empty($fieldGroup)){
            foreach ($fieldGroup as $key => $value) {
                $fieldGroupRows[$value[$field]] = $value['n'];
            }
        }
        $fieldGroupRows[$field.'Total'] = (array_sum($fieldGroupRows) > 0) ? array_sum($fieldGroupRows) : 0;
        return $fieldGroupRows;
    }

   /**
     * [_setCondition 封装条件]
     * @param [type] $select    [description]
     * @param array  $condition [description]
     */
    private function _setCondition($select, $condition=array())
    {
        if(isset($condition["customer_code"]) && !empty($condition["customer_code"])){
            $select->where("customer_code = ? ", $condition["customer_code"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] !== ""){
            $select->where("order_code = ? ", $condition["order_code"]);
        }
        if(isset($condition["logistic_customer_code"]) && $condition["logistic_customer_code"] !== ""){
            $select->where("logistic_customer_code = ? ",$condition["logistic_customer_code"]);
        }
        if(isset($condition["log_no"]) && $condition["log_no"] !== ""){
            $select->where("log_no = ? ",$condition["log_no"]);
        }
        if(isset($condition["reference_no"]) && $condition["reference_no"] !== ""){
            $select->where("reference_no = ? ", $condition["reference_no"]);
        }
        if(isset($condition["wb_status"]) && $condition["wb_status"] !== ""){
            $select->where("wb_status = ? ",$condition["wb_status"]);
        }
        if(isset($condition["app_status"]) && $condition["app_status"] !== ""){
            $select->where("app_status = ? ",$condition["app_status"]);
        }
        if (isset($condition["app_status_array"]) && $condition["app_status_array"] != '' && is_array($condition["app_status_array"])) {
            $select->where("app_status IN (?)", $condition["app_status_array"]);
        }
        if(isset($condition["ciq_status"]) && $condition["ciq_status"] !== ""){
            $select->where("ciq_status = ? ",$condition["ciq_status"]);
        }
        if(isset($condition["wb_code"]) && $condition["wb_code"] !== ""){
            $select->where("wb_code = ? ",$condition["wb_code"]);
        }
        return $select;
    }
    /**
     * [getByCiqStatus 商检状态]
     * @param  [type] $appStatusArr [description]
     * @param  [type] $status       [description]
     * @param  [type] $pageSize     [description]
     * @param  [type] $minId        [description]
     * @return [type]               [description]
     */
    public function getByCiqStatus($appStatusArr, $status, $pageSize, $minId){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 = ?", 1);
        /*CONDITION_START*/
        if(isset($status) && $status !== ''){
            $select->where("ciq_status = ?", $status);
        }
        if(isset($appStatusArr) && !empty($appStatusArr)){
            $select->where("app_status IN (?) ", $appStatusArr);
        }
        $select->where('wb_status = ?', 1);
        $select->where('wb_id > ?', $minId);
        /*CONDITION_END*/
        $select->limit($pageSize);
        $sql = $select->__toString();
        //echo $sql;
        return $this->_table->getAdapter()->fetchAll($sql);
    }
    /**
     * [getByFieldLock 加锁]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByFieldLock($value, $field = 'wb_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->forUpdate();
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
}
