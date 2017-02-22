<?php
class Table_SmCountryMap
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_SmCountryMap();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_SmCountryMap();
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
    public function update($row, $value, $field = "smcm_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "smcm_id")
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
    public function getByField($value, $field = 'smcm_id', $colums = "*")
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
        
        if(isset($condition["country_id"]) && $condition["country_id"] != ""){
            $select->where("country_id = ?",$condition["country_id"]);
        }		
        if(isset($condition["country_ids"]) && $condition["country_ids"] != ""){
            $select->where("country_id in(?)",$condition["country_ids"]);
        }
		
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["province_id"]) && $condition["province_id"] != ""){
            $select->where("province_id = ?",$condition["province_id"]);
        }
        if(isset($condition["city_id"]) && $condition["city_id"] != ""){
            $select->where("city_id = ?",$condition["city_id"]);
        }
        if(isset($condition["country_name"]) && $condition["country_name"] != ""){
            $select->where("country_name = ?",$condition["country_name"]);
        }
        if(isset($condition["country_code"]) && $condition["country_code"] != ""){
            $select->where("country_code = ?",$condition["country_code"]);
        }
        if(isset($condition["area"]) && $condition["area"] != ""){
            $select->where("area = ?",$condition["area"]);
        }
        if(isset($condition["sm_id"]) && $condition["sm_id"] != ""){
            $select->where("sm_id = ?",$condition["sm_id"]);
        }
        if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
            $select->where("sm_code = ?",$condition["sm_code"]);
        }
        if(isset($condition["smcm_fee_type"]) && $condition["smcm_fee_type"] != ""){
            $select->where("smcm_fee_type = ?",$condition["smcm_fee_type"]);
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

    public function getLeftJoinCountryByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->joinLeft('country', 'country.country_id='.$table.'.country_id',array('country_name_en','country_code'));
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        if(isset($condition["country_id"]) && $condition["country_id"] != ""){
            $select->where("country_id = ?",$condition["country_id"]);
        }
        if(isset($condition["warehouse_id"]) && $condition["warehouse_id"] != ""){
            $select->where("warehouse_id = ?",$condition["warehouse_id"]);
        }
        if(isset($condition["province_id"]) && $condition["province_id"] != ""){
            $select->where("province_id = ?",$condition["province_id"]);
        }
        if(isset($condition["city_id"]) && $condition["city_id"] != ""){
            $select->where("city_id = ?",$condition["city_id"]);
        }
        if(isset($condition["country_name"]) && $condition["country_name"] != ""){
            $select->where("country_name = ?",$condition["country_name"]);
        }
        if(isset($condition["country_code"]) && $condition["country_code"] != ""){
            $select->where("country_code = ?",$condition["country_code"]);
        }
        if(isset($condition["area"]) && $condition["area"] != ""){
            $select->where("area = ?",$condition["area"]);
        }
        if(isset($condition["sm_id"]) && $condition["sm_id"] != ""){
            $select->where("sm_id = ?",$condition["sm_id"]);
        }
        if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
            $select->where("sm_code = ?",$condition["sm_code"]);
        }
        if(isset($condition["smcm_fee_type"]) && $condition["smcm_fee_type"] != ""){
            $select->where("smcm_fee_type = ?",$condition["smcm_fee_type"]);
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
    
    public function getByInCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
    	$select = $this->_table->getAdapter()->select();
    	$table = $this->_table->info('name');
    	$select->from($table, $type);
    	$select->where("1 =?", 1);
    	/*CONDITION_START*/
    
    	if(isset($condition["country_id_arr"]) && is_array($condition["country_id_arr"])){
    		$select->where("country_id in(?)",$condition["country_id_arr"]);
    	}
    	if(isset($condition["warehouse_id_arr"]) && is_array($condition["warehouse_id_arr"])){
    		$select->where("warehouse_id in(?)",$condition["warehouse_id_arr"]);
    	}
    
    	if(isset($condition["province_id_arr"]) && is_array($condition["province_id_arr"])){
    		$select->where("province_id in(?)",$condition["province_id_arr"]);
    	}
    
    	if(isset($condition["city_id_arr"]) && is_array($condition["city_id_arr"])){
    		$select->where("city_id in(?)",$condition["city_id_arr"]);
    	}
    
    	if(isset($condition["country_name"]) && $condition["country_name"] != ""){
    		$select->where("country_name = ?",$condition["country_name"]);
    	}
    	if(isset($condition["country_code"]) && $condition["country_code"] != ""){
    		$select->where("country_code = ?",$condition["country_code"]);
    	}
    	if(isset($condition["area"]) && $condition["area"] != ""){
    		$select->where("area = ?",$condition["area"]);
    	}
    	if(isset($condition["sm_id"]) && $condition["sm_id"] != ""){
    		$select->where("sm_id = ?",$condition["sm_id"]);
    	}
    	if(isset($condition["sm_code"]) && $condition["sm_code"] != ""){
    		$select->where("sm_code = ?",$condition["sm_code"]);
    	}
    	if(isset($condition["smcm_fee_type"]) && $condition["smcm_fee_type"] !== ""){
    		$select->where("smcm_fee_type = ?",$condition["smcm_fee_type"]);
    	}
    	if(isset($condition["smcm_calc_type"]) && $condition["smcm_calc_type"] !== ""){
    		$select->where("smcm_calc_type = ?",$condition["smcm_calc_type"]);
    	}
    
    	if(isset($condition["smcm_type_arr"]) && is_array($condition["smcm_type_arr"])){
    		$select->where("smcm_fee_type in(?)",$condition["smcm_type_arr"]);
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