<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_PayOrder
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_PayOrder();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Account();
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
    public function update($row, $value, $field = "po_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ? ", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * [updateByArr 数组更新]
     * @param  [type] $data  [更新数组]
     * @param  [type] $where [条件数组]
     * @return [type]        [description]
     */
    public function updateByWhere($data, $where){
        if(empty($where) || !is_array($where)){
            return false;
        }
        foreach ($where as $key => $value) {
            $where = $this->_table->getAdapter()->quoteInto("{$key}= ? ", $value);
        }
        return $this->_table->update($data, $where);
    }
    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'po_id', $colums = '*')
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    /**
     * [getByFieldLock 锁表]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByFieldLock($value, $field = 'po_id', $colums = '*'){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->forUpdate();
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    /**
     * [getByWhere 多条件获取]
     * @param  [type] $where  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByWhere($where, $colums = '*') {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        foreach($where as $field=>$value) {
            $select->where("{$field} = ?", $value);
        }
        return $this->_table->getAdapter()->fetchRow($select);
    }
    /**
     * 删除
     * @param int $value
     * @param string $field
     * @return number
     */
    public function delete($value, $field = "po_id")
    {
    	$where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
    	return $this->_table->delete($where);
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
     * [getByCiqStatus 根据状态返回数据]
     * @param  [type]  $status   [数据状态]
     * @param  integer $pageSize [description]
     * @param  [type]  $minId    [description]
     * @return [type]            [description]
     */
    public function getByCiqStatus($appStatusArr, $status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        //$select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        //验证商检状态
        if(isset($appStatusArr) && !empty($appStatusArr)){
            $select->where("app_status IN (?) ", $appStatusArr);
        }
        if(isset($status) && $status !== ''){
            $select->where("ciq_status = ?", $status);
        }
        $select->where("status = ?", 1);
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
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ? ", $condition["customer_code"]);
        }
        if(isset($condition["priv_customer_code_arr"]) && !empty($condition["priv_customer_code_arr"])){
            $select->where("customer_code IN (?)", $condition["priv_customer_code_arr"]);
        }
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ? ", $condition["order_code"]);
        }
        if(isset($condition["pay_no"]) && $condition["pay_no"] != ""){
            $select->where("pay_no = ? ", $condition["pay_no"]);
        }
        if(isset($condition["status"]) && $condition["status"] != ""){
            $select->where("status = ? ", $condition["status"]);
        }
        if(isset($condition["app_status"]) && $condition["app_status"] != ""){
            $select->where("app_status = ? ", $condition["app_status"]);
        }
        if (isset($condition["app_status_array"]) && $condition["app_status_array"] != '' && is_array($condition["app_status_array"])) {
            $select->where("app_status IN (?)", $condition["app_status_array"]);
        }
        if(isset($condition["ciq_status"]) && $condition["ciq_status"] != ""){
            $select->where("ciq_status = ? ", $condition["ciq_status"]);
        }
        if(isset($condition["add_start_time"]) && $condition["add_start_time"] != ""){
            $select->where("add_time >= ? ", $condition["add_start_time"].' 00:00:00');
        }
        if(isset($condition["add_end_time"]) && $condition["add_end_time"] != ""){
            $select->where("add_time <= ? ", $condition["add_end_time"].' 23:59:59');
        }
        if(isset($condition["cosignee_telephone"]) && $condition["cosignee_telephone"] != ""){
            $select->where("cosignee_telephone = ? ", $condition["cosignee_telephone"]);
        }
        if(isset($condition["cosignee_country_id"]) && $condition["cosignee_country_id"] != ""){
            $select->where("cosignee_country_id = ? ",$condition["cosignee_country_id"]);
        }
        if(isset($condition["pay_customer_code"]) && $condition["pay_customer_code"] != ""){
            $select->where("pay_customer_code = ? ",$condition["pay_customer_code"]);
        }
        if(isset($condition['po_code']) && $condition['po_code'] != ''){
            $select->where("po_code = ? ",$condition["po_code"]);
        }
        if(isset($condition['not_po_code']) && $condition['not_po_code'] != ''){
            $select->where("po_code <> ? ",$condition["not_po_code"]);
        }
        if(isset($condition['reference_no']) && $condition['reference_no'] != ''){
            $select->where("reference_no = ? ",$condition["reference_no"]);
        }
        if(isset($condition['ecommerce_platform_customer_code']) && $condition['ecommerce_platform_customer_code'] != ''){
            $select->where("ecommerce_platform_customer_code = ? ",$condition["ecommerce_platform_customer_code"]);
        }

        return $select;
    }
}
