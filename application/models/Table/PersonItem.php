<?php
class Table_PersonItem
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_PersonItem();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_PersonItem();
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
    public function update($row, $value, $field = "pim_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?",$value);
		/*
		$db = Common_Common::getAdapter();
		$profiler = $db->getProfiler();
		$this->_table->update($row, $where);
		$query = $profiler->getLastQueryProfile();
		//echo $query;exit;
		//echo $query->getQuery();

		exit;
		*/
         return $this->_table->update($row, $where);
	}

    /**
     * @param array $row
     * @param array $values
     * @param string $field
     */
    public function updateIn($row, $values, $field = "pim_id")
    {
    	$where = $this->_table->getAdapter()->quoteInto("{$field} IN(?)", $values);
    	return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "pim_id")
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
    public function getByField($value, $field = 'pim_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
    public function getByFieldLock($value, $field = 'pim_id', $colums = "*")
    {
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table, $colums);
    	$select->forUpdate();
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

    private function _setCondition($select, $condition=array())
    {
        if (isset($condition["status"]) && $condition["status"] !== "") {
            $select->where("status = ?", $condition["status"]);
        }
        if (isset($condition["customs_status"]) && $condition["customs_status"] !== "") {
            $select->where("customs_status = ?", $condition["customs_status"]);
        }
        if (isset($condition["customs_status_arr"]) && $condition["customs_status_arr"] !== "") {
            $select->where("customs_status in (?)", $condition["customs_status_arr"]);
        }
        if (isset($condition["account_code"]) && $condition["account_code"] !== "") {
            $select->where("account_code = ?", $condition["account_code"]);
        }
        if (isset($condition["status_arr"]) && $condition["status_arr"] !== "") {
            $select->where("status in (?)", $condition["status_arr"]);
        }

        if (isset($condition["priv_customer_code_arr"]) && $condition["priv_customer_code_arr"] != "") {
            $select->where("customer_code IN ( ? )", $condition["priv_customer_code_arr"]);
        }
        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code = ?", $condition["customer_code"]);
        }
        if (isset($condition["order_status"]) && $condition["order_status"] != "") {
            $select->where("status = ?", $condition["order_status"]);
        }
        if(isset($condition["order_status_arr"]) && $condition["order_status_arr"][0]=='100'){$condition["order_status_arr"]="";}
        if (isset($condition["order_status_arr"]) && $condition["order_status_arr"] != "") {
            $select->where("status in (?)", $condition["order_status_arr"]);
        }
        if (isset($condition["order_code"]) && $condition["order_code"] != "") {
            $select->where("order_code = ?", $condition["order_code"]);
        }
        if (isset($condition["wb_code"]) && $condition["wb_code"] != "") {
            $select->where("wb_code = ?", $condition["wb_code"]);
        }
        if (isset($condition["po_code"]) && $condition["po_code"] != "") {
            $select->where("po_code = ?", $condition["po_code"]);
        }
        if (isset($condition['is_comparison']) && $condition['is_comparison'] != ''){
            $select->where("is_comparison = ?", $condition["is_comparison"]);
        }
        if (isset($condition["pim_reference_no"]) && $condition["pim_reference_no"] != "") {
            $select->where("pim_reference_no = ?", $condition["pim_reference_no"]);
        }
        if (isset($condition["logistic_customer_code"]) && $condition["logistic_customer_code"] != "") {
            $select->where("logistic_customer_code = ?", $condition["logistic_customer_code"]);
        }
        if (isset($condition["pay_customer_code"]) && $condition["pay_customer_code"] != "") {
            $select->where("pay_customer_code = ?", $condition["pay_customer_code"]);
        }
        if (isset($condition["pim_code"]) && $condition["pim_code"] != "") {
            $select->where("pim_code = ?", $condition["pim_code"]);
        }
        if (isset($condition["add_time_start"]) && $condition["add_time_start"] != "") {
            $select->where("pim_add_time >=?", $condition["add_time_start"] . ' 00:00:00');
        }
        if (isset($condition["add_time_end"]) && $condition["add_time_end"] != "") {
            $select->where("pim_add_time <=?", $condition["add_time_end"] . ' 23:59:59');
        }
        if(isset($condition['storage_customer_code']) && $condition['storage_customer_code'] != ''){
            $select->where("storage_customer_code = ?", $condition["storage_customer_code"]);
        }
        if (isset($condition['ciq_status']) && $condition['ciq_status'] !== ''){
            $select->where("ciq_status = ?", $condition["ciq_status"]);
        }
        if (isset($condition['customs_status_array']) && $condition['customs_status_array'] !== ''){
            $select->where("customs_status IN (?) ", $condition["customs_status_array"]);
        }
        if (isset($condition['status_not']) && $condition['status_not'] !== ''){
            $select->where('status != ?',$condition['status_not']);
        }
        return $select;
    }

    /**
     * [getByStatus description]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  [type]  $minId    [description]
     * @return [type]            [description]
     */
    public function getByStatus($status, $pageSize = 0 , $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("customs_status = ?", $status);
        //查找只有对比的
        $select->where('is_comparison = ?','1');
        $select->where("pim_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }

    /**
     * [getByIdForUpdate description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getByIdForUpdate($id){
        $select = $this->_table->getAdapter()->select();
        $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, 'pim_id');
        $select->where("1 =?", 1);
        $select->where("pim_id = ?", $id);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
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

        if (isset($condition["order_code"]) && $condition["order_code"] != "") {
            $select->where("`orders`.order_code = ?", $condition["order_code"]);
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

	/**
	 * 计算订单的重量
	 * @author solar
	 * @param string $order_code
	 * @return number
	 */
	public function calculateWeight($order_code) {
		$select = $this->_table->getAdapter()->select();
		$select->from('order_product as op', array('op_quantity'));
		$select->joinLeft('product as p', 'op.product_id=p.product_id',array('p.product_weight','p.product_id','p.product_type'));
		$select->where('op.order_code=?', $order_code);
		$order_products = $this->_table->getAdapter()->fetchAll($select);
		$orderWeight = 0;
		if(empty($order_products)){
			return 0;
		}
		foreach($order_products as $order_product){
			if($order_product['product_type']=='1'){
				$orderWeight+=Service_Product::getCombineProductWeight($order_product['product_id'])*$order_product['op_quantity'];
			}else{
				$orderWeight+=$order_product['product_weight']*$order_product['op_quantity'];
			}

		}

		return $orderWeight;
	}

	/**
	 * @author william-fan
	 * @todo 更加条件获取一行
	 */
	public function getRowByCondition($condition = array(),$type = '*'){
		$select = $this->_table->getAdapter()->select();
		$table = $this->_table->info('name');
		$select->from($table, $type);
		$select->where("1 =?", 1);
		/*CONDITION_START*/

		if (isset($condition["order_code"]) && $condition["order_code"] != "") {
			$select->where("order_code = ?", $condition["order_code"]);
		}
		if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
			$select->where("customer_id = ?", $condition["customer_id"]);
		}
		if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
			$select->where("customer_code = ?", $condition["customer_code"]);
		}
		if (isset($condition["reference_no"]) && $condition["reference_no"] != "") {
			$select->where("reference_no = ?", $condition["reference_no"]);
		}
    if (isset($condition["except_deleted_status"]) && $condition["except_deleted_status"]) {
      $select->where("order_status != ?", 0);
    }
		$select->limit(1);
		return $this->_table->getAdapter()->fetchRow($select);
	}

	/**
	 * 仓库状态统计
	 * @author solar
	 * @param int $customer_id
	 * @param int $model_type
	 * @param int $warehouse_id
	 */
	public function stat($customer_id, $model_type, $warehouse_id) {
		$select = $this->_table->getAdapter()->select();
		$table = $this->_table->info('name');
		$select->from($table, 'order_status, count(*) as num');
		$select->where('customer_id=?', $customer_id);
		$select->where("order_mode_type=?", $model_type);
		if($warehouse_id!=0) $select->where('warehouse_id=?', $warehouse_id);
		$select->group('order_status');
		return $this->_table->getAdapter()->fetchAll($select);
	}
	/**
	 *
	 * @param unknown $condition
	 * @param string $type
	 * @param number $pageSize
	 * @param number $page
	 * @param string $orderBy
	 * @return string|multitype:
	 */
    public function getJionOrderOperationTimeByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = ""){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        if (isset($condition["order_status"]) && $condition["order_status"] != "") {
        	$select->where("status = ?", $condition["order_status"]);
        }
        if($condition["order_status_arr"][0]=='18'){$condition["order_status_arr"]="";}
        if (isset($condition["order_status_arr"]) && $condition["order_status_arr"] != "") {
        	$select->where("status in (?)", $condition["order_status_arr"]);
        }
        if (isset($condition["order_code"]) && $condition["order_code"] != "") {
        	$select->where("order_code = ?", $condition["order_code"]);
        }
        if (isset($condition["wb_code"]) && $condition["wb_code"] != "") {
        	$select->where("wb_code = ?", $condition["wb_code"]);
        }
        if (isset($condition["pim_code"]) && $condition["pim_code"] != "") {
        	$select->where("pim_code = ?", $condition["pim_code"]);
        }
        if (isset($condition["pim_code"]) && $condition["pim_code"] != "") {
        	$select->where("pim_code = ?", $condition["pim_code"]);
        }
        if (isset($condition["pim_code"]) && $condition["pim_code"] != "") {
        	$select->where("pim_code = ?", $condition["pim_code"]);
        }
        if (isset($condition["add_time_start"]) && $condition["add_time_start"] != "") {
        	$select->where("pim_add_time >=?", $condition["add_time_start"] . ' 00:00:00');
        }
        if (isset($condition["add_time_end"]) && $condition["add_time_end"] != "") {
        	$select->where("pim_add_time <=?", $condition["add_time_end"] . ' 23:59:59');
        }
        /*
		if($type != '*'){
            $select->joinLeft('order_operation_time', 'order_operation_time.order_id=orders.order_id',array());
        }else{
            $select->joinLeft('order_operation_time', 'order_operation_time.order_id=orders.order_id',array('process_time','pack_time','ship_time'));
        }
        */
        /*
        if (isset($condition["order_code"]) && $condition["order_code"] != "") {
            $select->where($table.".order_code = ?", $condition["order_code"]);
            //$select->orWhere("customer_code =?");
        }
        if(isset($condition['orderCodeArr'])&&!empty($condition['orderCodeArr'])){
            $select->where($table.".order_code in(?)", $condition['orderCodeArr']);
        }
        if(isset($condition["new_reference_no"])&&$condition['new_reference_no']!=""){
            $select->where("(orders.order_code = '".$condition['new_reference_no']."') or (orders.reference_no = ?)",$condition['new_reference_no']);
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

        if (isset($condition["to_warehouse_id"]) && $condition["to_warehouse_id"] != "") {
            $select->where("to_warehouse_id = ?", $condition["to_warehouse_id"]);
        }

        if (isset($condition["order_type"]) && $condition["order_type"] != "") {
            $select->where("order_type = ?", $condition["order_type"]);
        }
        if (isset($condition["sm_code"]) && $condition["sm_code"] != "") {
            $select->where("sm_code = ?", $condition["sm_code"]);
        }
        if (isset($condition["order_status"]) && $condition["order_status"] != "") {
            $select->where("order_status = ?", $condition["order_status"]);
        }
        if($condition["order_status_arr"][0]=='18'){$condition["order_status_arr"]="";}
        if (isset($condition["order_status_arr"]) && $condition["order_status_arr"] != "") {
            $select->where("order_status in (?)", $condition["order_status_arr"]);
        }
        if (isset($condition["problem_status"]) && $condition["problem_status"] != "") {
            $select->where("problem_status = ?", $condition["problem_status"]);
        }
        if (isset($condition["underreview_status"]) && $condition["underreview_status"] != "") {
            $select->where("underreview_status = ?", $condition["underreview_status"]);
        }
        if (isset($condition["order_pick_type"]) && $condition["order_pick_type"] != "") {
            $select->where("order_pick_type = ?", $condition["order_pick_type"]);
        }
        if (isset($condition["reference_no"]) && $condition["reference_no"] != "") {
            $select->where("reference_no = ?", $condition["reference_no"]);
        }
        if (isset($condition["picker_id"]) && $condition["picker_id"] != "") {
            $select->where("picker_id = ?", $condition["picker_id"]);
        }
        if (isset($condition["add_time_start"]) && $condition["add_time_start"] != "") {
            $select->where("add_time >=?", $condition["add_time_start"] . ' 00:00:00');
        }

        if (isset($condition["add_time_end"]) && $condition["add_time_end"] != "") {
            $select->where("add_time <=?", $condition["add_time_end"] . ' 23:59:59');
        }
        if(isset($condition["order_mode_type"]) && $condition["order_mode_type"] != ""){
            $select->where("order_mode_type = ?", $condition["order_mode_type"]);
        }
        if(isset($condition['interceptStatusArr'])&&!empty($condition['interceptStatusArr'])){
            $select->where("intercept_status in(?)",$condition['interceptStatusArr']);
        }
        if (isset($condition["shipDateFor"]) && $condition["shipDateFor"] != "") {
            $select->where("order_operation_time.ship_time >=?", $condition["shipDateFor"]);
        }
        if (isset($condition["shipDateTo"]) && $condition["shipDateTo"] != "") {
            $select->where("order_operation_time.ship_time <=?", $condition["shipDateTo"]);
        }
        */

        //echo $select."<br>";

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
    /**
     * [getByCiqStatus 商检状态]
     * @param  [type] $customsStatusArr [description]
     * @param  [type] $status           [description]
     * @param  [type] $pageSize         [description]
     * @param  [type] $minId            [description]
     * @return [type]                   [description]
     */
    public function getByCiqStatus($customsStatusArr, $status, $pageSize, $minId){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 = ?", 1);
        /*CONDITION_START*/
        if(isset($status) && $status !== ''){
            $select->where("ciq_status = ?", $status);
        }
        if(isset($customsStatusArr) && !empty($customsStatusArr)){
            $select->where("customs_status IN (?) ", $customsStatusArr);
        }
        $select->where("is_comparison = ? ", 1);
        $select->where('pim_id > ?', $minId);
        /*CONDITION_END*/
        $select->limit($pageSize);
        $sql = $select->__toString();
        //echo $sql;
        return $this->_table->getAdapter()->fetchAll($sql);
    }

}
