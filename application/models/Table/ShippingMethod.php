<?php
class Table_ShippingMethod
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ShippingMethod();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ShippingMethod();
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
    public function update($row, $value, $field = "sm_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "sm_id")
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
    public function getByField($value, $field = 'sm_id', $colums = "*")
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
        
        if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
            $select->where($table.".sm_code = ?",$condition["sm_code"]);
        }
        if(isset($condition["sm_name_cn"]) && $condition["sm_name_cn"] != ""){
            $select->where("sm_name_cn = ?",$condition["sm_name_cn"]);
        }
        if(isset($condition["sm_name"]) && $condition["sm_name"] != ""){
            $select->where("sm_name = ?",$condition["sm_name"]);
        }
        if(isset($condition["sm_mp_fee"]) && $condition["sm_mp_fee"] != ""){
            $select->where("sm_mp_fee = ?",$condition["sm_mp_fee"]);
        }
        if(isset($condition["sm_reg_fee"]) && $condition["sm_reg_fee"] != ""){
            $select->where("sm_reg_fee = ?",$condition["sm_reg_fee"]);
        }
        if(isset($condition["sm_addons"]) && $condition["sm_addons"] != ""){
            $select->where("sm_addons = ?",$condition["sm_addons"]);
        }
        if(isset($condition["sm_discount"]) && $condition["sm_discount"] != ""){
            $select->where("sm_discount = ?",$condition["sm_discount"]);
        }
        if(isset($condition["sm_delivery_time_min"]) && $condition["sm_delivery_time_min"] != ""){
            $select->where("sm_delivery_time_min = ?",$condition["sm_delivery_time_min"]);
        }
        if(isset($condition["sm_delivery_time_max"]) && $condition["sm_delivery_time_max"] != ""){
            $select->where("sm_delivery_time_max = ?",$condition["sm_delivery_time_max"]);
        }
        if(isset($condition["sm_delivery_time_avg"]) && $condition["sm_delivery_time_avg"] != ""){
            $select->where("sm_delivery_time_avg = ?",$condition["sm_delivery_time_avg"]);
        }
        if(isset($condition["sm_is_volume"]) && $condition["sm_is_volume"] != ""){
            $select->where("sm_is_volume = ?",$condition["sm_is_volume"]);
        }
        if(isset($condition["sm_vol_rate"]) && $condition["sm_vol_rate"] != ""){
            $select->where("sm_vol_rate = ?",$condition["sm_vol_rate"]);
        }
        if(isset($condition["sm_status"]) && $condition["sm_status"] != ""){
            $select->where("sm_status = ?",$condition["sm_status"]);
        }
        if(isset($condition["sm_class_code"]) && $condition["sm_class_code"] != ""){
            $select->where("sm_class_code = ?",$condition["sm_class_code"]);
        }
        if(isset($condition["sm_logo"]) && $condition["sm_logo"] != ""){
            $select->where("sm_logo = ?",$condition["sm_logo"]);
        }
        if(isset($condition["sm_return_address"]) && $condition["sm_return_address"] != ""){
            $select->where("sm_return_address = ?",$condition["sm_return_address"]);
        }
        if(isset($condition["sm_discount_min"]) && $condition["sm_discount_min"] != ""){
            $select->where("sm_discount_min = ?",$condition["sm_discount_min"]);
        }
        if(isset($condition["sm_mp_fee_min"]) && $condition["sm_mp_fee_min"] != ""){
            $select->where("sm_mp_fee_min = ?",$condition["sm_mp_fee_min"]);
        }
        if(isset($condition["sm_reg_fee_min"]) && $condition["sm_reg_fee_min"] != ""){
            $select->where("sm_reg_fee_min = ?",$condition["sm_reg_fee_min"]);
        }
        if(isset($condition["sm_limit_volume"]) && $condition["sm_limit_volume"] != ""){
            $select->where("sm_limit_volume = ?",$condition["sm_limit_volume"]);
        }
        if(isset($condition["sm_limit_weight"]) && $condition["sm_limit_weight"] != ""){
            $select->where("sm_limit_weight = ?",$condition["sm_limit_weight"]);
        }
        if(isset($condition["sm_sort"]) && $condition["sm_sort"] != ""){
            $select->where("sm_sort = ?",$condition["sm_sort"]);
        }
        if(isset($condition["sm_is_tracking"]) && $condition["sm_is_tracking"] != ""){
            $select->where("sm_is_tracking = ?",$condition["sm_is_tracking"]);
        }
        if(isset($condition["sm_is_validate_remote"]) && $condition["sm_is_validate_remote"] != ""){
            $select->where("sm_is_validate_remote = ?",$condition["sm_is_validate_remote"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["sm_fee_type"]) && $condition["sm_fee_type"] != ""){
            $select->where("sm_fee_type = ?",$condition["sm_fee_type"]);
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


   public function getJoinShipmentByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "",$groupBy="")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->joinLeft('sm_country_map', 'sm_country_map.sm_code='.$table.'.sm_code',array('sm_country_map.country_id'));
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
            $select->where($table.".sm_code = ?",$condition["sm_code"]);
        }
        if(isset($condition["country_ids"]) && $condition["country_ids"] != ""){
            $select->where("sm_country_map.country_id in(?)",$condition["country_ids"]);
        } 
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("sm_country_map.warehouse_id = ",$condition["warehouse_id"]);
        }
        if(isset($condition["warehouse_ids"]) && $condition["warehouse_ids"] != ""){
        	$select->where("sm_country_map.warehouse_id in (?)",$condition["warehouse_ids"]);
        }
        if(isset($condition["warehouse_ids"]) && $condition["warehouse_ids"] != ""){
        	$select->where("shipping_method.warehouse_id in (?)",$condition["warehouse_ids"]);
        }
        if(isset($condition["sm_status"]) && $condition["sm_status"] != ""){
        	$select->where("shipping_method.sm_status = ?",$condition["sm_status"]);
        }
		if(isset($groupBy) && $groupBy != ""){		
			$select->group($groupBy); 
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
			//echo $sql;		
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }	
	
	
	
}