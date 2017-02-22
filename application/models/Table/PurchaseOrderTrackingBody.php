<?php
class Table_PurchaseOrderTrackingBody
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_PurchaseOrderTrackingBody();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new DbTable_PurchaseOrderTrackingBody();
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
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "po_id")
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
    public function getByField($value, $field = 'po_id', $colums = "*")
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
        
        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("customer_id = ?",$condition["customer_id"]);
        }

        if(isset($condition["po_code"]) && $condition["po_code"] != ""){
            $select->where("po_code = ?",$condition["po_code"]);
        }
        if(isset($condition['add_time_start'])&&$condition['add_time_start']!=""){
            $select->where(" cbl_add_time >= ?",$condition['add_time_start']." 00:00:00");
        }
        if(isset($condition['add_time_end'])&&$condition['add_time_end']!=""){
            $select->where(" cbl_add_time <= ?",$condition['add_time_end']." 23:59:59");
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
	
	
	
	
     public  function getJoinPurchaseTrackingBodyByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "")
    {

        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->join('purchase_order_tracking', 'purchase_order_tracking.po_t_id=purchase_order_tracking_body.po_t_id',array('purchase_order_tracking.tracking_number','purchase_order_tracking.express_company','purchase_order_tracking.create_time as f_create_time'));
		$select->join('purchase_order', 'purchase_order.po_id=purchase_order_tracking_body.po_id',array('purchase_order.po_code'));
		$select->join('product', 'product.product_id = purchase_order_tracking_body.product_id',array('product.product_title','product.product_sku'));
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        if (isset($condition["po_tb_id"]) && $condition["po_tb_id"] != "") {
            $select->where("purchase_order_tracking_body.po_tb_id = ?", $condition["po_tb_id"]);
        } 


        if (isset($condition["po_t_id"]) && $condition["po_t_id"] != "") {
            $select->where("purchase_order_tracking.po_t_id = ?", $condition["po_t_id"]);
        } 

        if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
            $select->where("purchase_order.customer_id = ?", $condition["customer_id"]);
        } 		

        if (isset($condition["po_code"]) && $condition["po_code"] != "") {
            $select->where("purchase_order.po_code = ?", $condition["po_code"]);
        } 


        if (isset($condition["tracking_number"]) && $condition["tracking_number"] != "") {
            $select->where("purchase_order_tracking.tracking_number = ?", $condition["tracking_number"]);
        }		
		
        
	    if(isset($condition["created_start"]) && $condition["created_start"] != ""){
	    	$select->where("purchase_order_tracking_body.create_time >= ?",$condition["created_start"]);
	    }
	    if(isset($condition["created_end"]) && $condition["created_end"] != ""){
	    	$select->where("purchase_order_tracking_body.create_time <= ?",$condition["created_end"]);
	    }		
		
				  

        /*CONDITION_END*/
        if ('count(*)' == $type) {
            //echo   $select->__toString();die;
            return $this->_table->getAdapter()->fetchOne($select);
        } else {
            if (!empty($order)) {
                $select->order($order);
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