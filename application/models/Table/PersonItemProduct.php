<?php
class Table_PersonItemProduct
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_PersonItemProduct();
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
		if (isset($condition["pim_code"]) && $condition["pim_code"] != "") {
            $select->where("pim_code = ?", $condition["pim_code"]);
            //$select->orWhere("customer_code =?");
        }
        if (isset($condition["pim_id"]) && $condition["pim_id"] != "") {
            $select->where("pim_id = ?", $condition["pim_id"]);
            //$select->orWhere("customer_code =?");
        }
        if (isset($condition["product_id"]) && $condition["product_id"] != "") {
            $select->where("product_id = ?", $condition["product_id"]);
        }
        if (isset($condition["registerID"]) && $condition["registerID"] !== "") {
            $select->where("registerID = ?", $condition["registerID"]);
        }
        if (isset($condition["goods_id"]) && $condition["goods_id"] != "") {
            $select->where("goods_id = ?", $condition["goods_id"]);
        }
         if (isset($condition["country"]) && $condition["country"] != "") {
            $select->where("country = ?", $condition["country"]);
        }
        //echo $select."</br>";//exit;
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
   * 订单拦截查询
   */
  public function getInterceptByCondition($condition, $type = '*', $pageSize = 0, $page = 1, $orderBy = '') {
    $select = $this->_table->getAdapter()->select();
    $table = $this->_table->info('name');

    if ('count(*)' == $type) {
      $select->from($table, 'count(' . $table . '.order_id)');
      $select->joinLeft('order_operation_time AS oot', 'oot.order_code=' . $table . '.order_code', array());
    }
    else {
      $select->from($table, $type);
      $select->joinLeft('order_operation_time AS oot', 'oot.order_code=' . $table . '.order_code', array('cutoff_time'));
    }

    if (isset($condition['customer_code']) && '' !== trim($condition['customer_code'])) {
      $select->where($table . '.customer_code=?', trim($condition['customer_code']));
    }

    if (isset($condition['order_code']) && '' !== trim($condition['order_code'])) {
      $select->where($table . '.order_code=?', trim($condition['order_code']));
    }

    if (isset($condition['reference_no']) && '' !== trim($condition['reference_no'])) {
      $select->where($table . '.reference_no=?', trim($condition['reference_no']));
    }

    if (isset($condition['intercept_status']) && '' !== trim($condition['intercept_status'])) {
      $select->where($table . '.intercept_status=?', trim($condition['intercept_status']));
    }
    else {
      $select->where($table . '.intercept_status!=?', 0);
    }

    if (isset($condition['warehouse_id']) && '' !== trim($condition['warehouse_id'])) {
      $select->where($table . '.warehouse_id=?', trim($condition['warehouse_id']));
    }

    if (isset($condition['cutoff_time_start']) && '' !== trim($condition['cutoff_time_start'])) {
      $select->where('oot.cutoff_time>=?', trim($condition['cutoff_time_start']) . ' 00:00:00');
    }

    if (isset($condition['cutoff_time_end']) && '' !== trim($condition['cutoff_time_end'])) {
      $select->where('oot.cutoff_time<=?', trim($condition['cutoff_time_end'])  . ' 23:59:59');
    }

    if ('count(*)' == $type) {
      return $this->_table->getAdapter()->fetchOne($select);
    }
    else {
      if (!empty($orderBy)) {
        $select->order($orderBy);
      }

      if ($pageSize > 0 and $page > 0) {
        $offset = ($page - 1) * $pageSize;
        $select->limit($pageSize, $offset);
      }

      $sql = $select->__toString();
      return $this->_table->getAdapter()->fetchAll($sql);
    }
  }

    /*
     * @已提交订单
     * @处理待下架
     */
    public function getShipmentByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        $select->where("order_status = 4");
        if (isset($condition["order_code"]) && $condition["order_code"] != "") {
            $select->where("order_code = ?", $condition["order_code"]);
        }

        if (isset($condition["dateFor"]) && $condition["dateFor"] != "") {
            $select->where("add_time >=?", $condition["dateFor"] . ' 00:00:00');
        }

        if (isset($condition["dateTo"]) && $condition["dateTo"] != "") {
            $select->where("add_time <=?", $condition["dateTo"] . ' 23:59:59');
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
        if (isset($condition["order_type_arr"]) && $condition["order_type_arr"] != "") {
        	$select->where("order_type in (?)", $condition["order_type_arr"]);
        }
        if (isset($condition["sm_code"]) && $condition["sm_code"] != "") {
            $select->where("sm_code = ?", $condition["sm_code"]);
        }

        if (isset($condition["order_pick_type"]) && is_array($condition["order_pick_type"])) {
            $select->where("order_pick_type in(?) ", $condition["order_pick_type"]);
        }
        if (isset($condition["reference_no"]) && $condition["reference_no"] != "") {
            $select->where("reference_no = ?", $condition["reference_no"]);
        }
        /*CONDITION_END*/
        if ('count(*)' == $type) {
            $sql = $select->__toString();
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
	public function getCustomerOrderStatusGroup($condition, $type,$group)
	{
	    $select = $this->_table->getAdapter()->select();
	    $table = $this->_table->info('name');
	    $select->from($table, $type);
	    $select->where("1 =?", 1);
	
	    if(isset($condition["orders_code"]) && $condition["orders_code"] != ""){
	        $select->where("orders_code = ?",$condition["orders_code"]);
	    }
	    if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
	        $select->where("customer_id = ?",$condition["customer_id"]);
	    }
	    if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
	        $select->where("warehouse_id = ?",$condition["warehouse_id"]);
	    }
	    if(isset($condition["shipping_method"]) && $condition["shipping_method"] != ""){
	        $select->where("shipping_method = ?",$condition["shipping_method"]);
	    }
	
	    if(isset($condition["problem_status"]) && $condition["problem_status"] != ""){
	        $select->where("problem_status = ?",$condition["problem_status"]);
	    }
	    if(isset($condition["underreview_status"]) && $condition["underreview_status"] != ""){
	        $select->where("underreview_status = ?",$condition["underreview_status"]);
	    }
	    
	    if(isset($condition["customer_order_code"]) && $condition["customer_order_code"] != ""){
	        $select->where("customer_order_code = ?",$condition["customer_order_code"]);
	    }
	    if(isset($condition["add_time_start"]) && $condition["add_time_start"] != ""){
	    	$select->where("add_time >= ?",$condition["add_time_start"]);
	    }
	    if(isset($condition["add_time_end"]) && $condition["add_time_end"] != ""){
			$condition["add_time_end"] .= " 23:59:59";
	    	$select->where("add_time <= ?",$condition["add_time_end"]);
	    }
	    $select->group($group);
	
	    $sql = $select->__toString();
 	    //echo $sql;exit;
	    $result = $this->_table->getAdapter()->fetchAll($sql);
	
	    return $result;
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

    public function getJionOrderOperationTimeByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = ""){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);       
        
         if($type != '*'){
            $select->joinLeft('order_operation_time', 'order_operation_time.order_id=orders.order_id',array());
        }else{
            $select->joinLeft('order_operation_time', 'order_operation_time.order_id=orders.order_id',array('process_time','pack_time','ship_time'));
        }
        
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
	
}