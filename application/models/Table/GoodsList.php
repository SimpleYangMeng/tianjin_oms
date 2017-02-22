<?php
class Table_GoodsList
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_GoodsList();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_GoodsList();
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
    public function update($row, $value, $field = "gl_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?",$value);
         return $this->_table->update($row, $where);
	}

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "gl_id")
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
    public function getByField($value, $field = 'gl_id', $columns = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $columns);
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

    /*
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
        if(isset($condition['gl_id']) && $condition['gl_id']==='') {
            $select->where('gl_id in (?)',$condition['gl_id']);
        }
        if(isset($condition['status']) && $condition['status']==='') {
            $select->where('status = ?',$condition['status']);
        }
        if(isset($condition['gl_code']) && $condition['gl_code']==='') {
            $select->where('gl_code = ?',$condition['gl_code']);
        }
        if(isset($condition['gl_reference_no']) && $condition['gl_reference_no']==='') {
            $select->where('gl_reference_no = ?',$condition['gl_reference_no']);
        }
        if(isset($condition['customer_code']) && $condition['customer_code']==='') {
            $select->where('customer_code = ?',$condition['customer_code']);
        }
        if(isset($condition['account_code']) && $condition['account_code']==='') {
            $select->where('account_code = ?',$condition['account_code']);
        }
        if(isset($condition['form_type']) && $condition['form_type']==='') {
            $select->where('form_type = ?',$condition['form_type']);
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

    public function getLeftJoinAllByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->joinLeft('order_address_book', 'order_address_book.order_id=orders.order_id',array('oab_country_id'));
        $select->joinLeft('order_operation_time', 'order_operation_time.order_id=orders.order_id',array('process_time','pack_time','ship_time'));
        $select->joinLeft('country', 'country.country_id=order_address_book.oab_country_id',array('country_name_en','country_code'));
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        if (isset($condition["order_status"]) && $condition["order_status"] != "") {
            $select->where("order_status = ?", $condition["order_status"]);
        }

        if (isset($condition["reference_no"]) && $condition["reference_no"] != "") {
            $select->where("reference_no = ?", $condition["reference_no"]);
        }

        if (isset($condition["dateFor"]) && $condition["dateFor"] != "") {
            $select->where("add_time >=?", $condition["dateFor"]);
        }
        if (isset($condition["dateTo"]) && $condition["dateTo"] != "") {
            $select->where("add_time <=?", $condition["dateTo"]);
        }

        if (isset($condition["printDateFor"]) && $condition["printDateFor"] != "") {
            $select->where("process_time >=?", $condition["printDateFor"]);
        }
        if (isset($condition["printDateTo"]) && $condition["printDateTo"] != "") {
            $select->where("process_time <=?", $condition["printDateTo"]);
        }

        if (isset($condition["packDateFor"]) && $condition["packDateFor"] != "") {
            $select->where("pack_time >=?", $condition["packDateFor"]);
        }
        if (isset($condition["packDateTo"]) && $condition["packDateTo"] != "") {
            $select->where("pack_time <=?", $condition["packDateTo"]);
        }

        if (isset($condition["shipDateFor"]) && $condition["shipDateFor"] != "") {
            $select->where("ship_time >=?", $condition["shipDateFor"]);
        }
        if (isset($condition["shipDateTo"]) && $condition["shipDateTo"] != "") {
            $select->where("ship_time <=?", $condition["shipDateTo"]);
        }

        if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
            $select->where("customer_id = ?", $condition["customer_id"]);
        }
        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code = ?", $condition["customer_code"]);
        }
        if (isset($condition["warehouse_id"]) && $condition["warehouse_id"] != "") {
            $select->where("warehouse_id = ?", $condition["warehouse_id"]);
        }
        if (isset($condition["order_type"]) && $condition["order_type"] != "") {
            $select->where("order_type = ?", $condition["order_type"]);
        }

        if (isset($condition["sm_code"]) && $condition["sm_code"] != "") {
            $select->where("sm_code = ?", $condition["sm_code"]);
        }

        if (isset($condition["order_pick_type"]) && is_array($condition["order_pick_type"])) {
            $select->where("order_pick_type in(?) ", $condition["order_pick_type"]);
        }

        if (isset($condition["status"]) && is_array($condition["status"])) {
            $select->where("status = ? ", $condition["status"]);
        }

        /*CONDITION_END*/
        if ('count(*)' == $type) {
           // echo   $select->__toString();die;
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
