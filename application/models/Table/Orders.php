<?php
class Table_Orders
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Orders();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Orders();
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
    public function update($row, $value, $field = "order_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?",$value);
         return $this->_table->update($row, $where);
	}

    /**
     * @param array $row
     * @param array $values
     * @param string $field
     */
    public function updateIn($row, $values, $field = "order_code")
    {
    	$where = $this->_table->getAdapter()->quoteInto("{$field} IN(?)", $values);
    	return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "order_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->delete($where);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'order_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, "*");
        return $this->_table->getAdapter()->fetchAll($select);
    }

    public function getByFieldLock($value, $field = 'order_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->forUpdate();
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
        // 请到方法里。后面的getGroupByCondition要同步使用！
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
     * [getGroupByCondition description]
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
        // 请到方法里。后面的getGroupByCondition要同步使用！
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
     * [_setCondition description]
     * @param [type] $select    [description]
     * @param array  $condition [description]
     */
    private function _setCondition($select, $condition=array())
    {
        if (isset($condition["order_code"]) && $condition["order_code"] != "") {
            $select->where("order_code = ?", $condition["order_code"]);
            //$select->orWhere("customer_code =?");
        }
        if(isset($condition['orderCodeArr'])&&!empty($condition['orderCodeArr'])){
            $select->where("order_code in(?)", $condition['orderCodeArr']);
        }

        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code = ?", $condition["customer_code"]);
        }

        if (isset($condition["pay_customer_code"]) && $condition["pay_customer_code"] != "") {
            $select->where("pay_customer_code = ?", $condition["pay_customer_code"]);
        }

        if (isset($condition["logistic_customer_code"]) && $condition["logistic_customer_code"] != "") {
            $select->where("logistic_customer_code = ?", $condition["logistic_customer_code"]);
        }

        if (isset($condition["account_code"]) && $condition["account_code"] != "") {
            $select->where("account_code = ?", $condition["account_code"]);
        }

        if (isset($condition["storage_customer_code"]) && $condition["storage_customer_code"] != "") {
            $select->where("storage_customer_code = ?", $condition["storage_customer_code"]);
        }

        if (isset($condition["order_type"]) && $condition["order_type"] !== "") {
            $select->where("order_type = ?", $condition["order_type"]);
        }

        if (isset($condition["order_status"]) && $condition["order_status"] !== "") {
            $select->where("order_status = ?", $condition["order_status"]);
        }

        if (isset($condition["order_status_array"]) && $condition["order_status_array"] != '' && is_array($condition["order_status_array"])) {
            $select->where("order_status IN (?)", $condition["order_status_array"]);
        }

        if (isset($condition["ie_type"]) && $condition["ie_type"] !== "") {
            $select->where("ie_type = ?", $condition["ie_type"]);
        }

        if (isset($condition["customs_code"]) && $condition["customs_code"] !== "") {
            $select->where("customs_code = ?", $condition["customs_code"]);
        }

        if (isset($condition["reference_no"]) && $condition["reference_no"] != "") {
            $select->where("reference_no = ?", $condition["reference_no"]);
        }
        
        if (isset($condition["ciq_status"]) && $condition["ciq_status"] !== "") {
            $select->where("ciq_status = ?", $condition["ciq_status"]);
        }

        // if(isset($condition["order_mode_type"]) && $condition["order_mode_type"] !== ""){
        //     $select->where("order_mode_type = ?", $condition["order_mode_type"]);
        // }

        if(isset($condition["ecommerce_platform_customer_code"]) && $condition["ecommerce_platform_customer_code"] !== ""){
            $select->where("ecommerce_platform_customer_code = ?", $condition["ecommerce_platform_customer_code"]);
        }        if(isset($condition["order_add_time"]) && $condition["order_add_time"] !== ""){
            $select->where("add_time > ?", $condition["order_add_time"]);
        }

        if(isset($condition["order_end_time"]) && $condition["order_end_time"] !== ""){
            $select->where("add_time < ?", $condition["order_end_time"]);
        }
        if (isset($condition["order_status_not"]) && $condition["order_status_not"] !== "") {
            $select->where("order_status != ?", $condition["order_status_not"]);
        }
        if (isset($condition["ciq_status_not"]) && $condition["ciq_status_not"] !== "") {
            $select->where("ciq_status != ?", $condition["ciq_status_not"]);
        }

        return $select;
    }

    public function getByStatus($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("order_status = ?", $status);
        $select->where("order_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        // echo $sql;
        return $this->_table->getAdapter()->fetchAll($sql);
    }
    /**
     * 
     * Enter description here ...
     * @param unknown_type $status
     * @param unknown_type $pageSize
     * @param unknown_type $minId
     */
    public function getByCiqStatus($orderStatusArr, $status, $pageSize = 0, $minId) {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 = ? ", 1);
        /*CONDITION_START*/
        if(isset($orderStatusArr) && !empty($orderStatusArr)){
            $select->where("order_status IN (?) ", $orderStatusArr);
        }
        if(isset($status) && $status !== ''){
            $select->where("ciq_status = ?", $status);
        }
        /*
        $select->where("order_status IN (?) ", $orderStatusArr);
        $select->where("ciq_status = ?", $status);
        */
        $select->where("order_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }
}
