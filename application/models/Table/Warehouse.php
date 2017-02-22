<?php
class Table_Warehouse
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Warehouse();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Warehouse();
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
    public function update($row, $value, $field = "warehouse_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "warehouse_id")
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
    public function getByField($value, $field = 'warehouse_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, "*");
        return $this->_table->getAdapter()->fetchAll($select);
    }

    public function getByStatus($status, $pageSize = 0, $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("warehouse_status = ?", $status);
        $select->where("warehouse_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        // echo $sql;
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
        $table  = $this->_table->info('name');
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
     * [getGroupByCondition description]
     * @param  [type] $condition [description]
     * @param  [type] $field     [description]
     * @return [type]            [description]
     */
    public function getGroupByCondition($condition, $field)
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, array(
            $field, 'count(*) as n',
        ));
        /*CONDITION_START*/
        if (isset($condition[$field])) {
            unset($condition[$field]);
        }
        // 请到方法里。后面的getGroupByCondition要同步使用！
        $select = $this->_setCondition($select, $condition);
        /*CONDITION_END*/
        $select->group($field);
        $sql            = $select->__toString();
        $fieldGroup     = $this->_table->getAdapter()->fetchAll($sql);
        $fieldGroupRows = array();
        if (!empty($fieldGroup)) {
            foreach ($fieldGroup as $key => $value) {
                $fieldGroupRows[$value[$field]] = $value['n'];
            }
        }
        $fieldGroupRows[$field . 'Total'] = (array_sum($fieldGroupRows) > 0) ? array_sum($fieldGroupRows) : 0;
        return $fieldGroupRows;
    }

    /**
     * [_setCondition description]
     * @param [type] $select    [description]
     * @param array  $condition [description]
     */
    private function _setCondition($select, $condition = array())
    {

        if (isset($condition["warehouse_code"]) && $condition["warehouse_code"] != "") {
            $select->where("warehouse_code = ?", $condition["warehouse_code"]);
        }
        if (isset($condition["warehouse_status"]) && $condition["warehouse_status"] != "") {
            $select->where("warehouse_status = ?", $condition["warehouse_status"]);
        }
		if(isset($condition['not_warehouse_status'])&&!empty($condition['not_warehouse_status'])){
            $select->where("warehouse_status not in(?)", $condition['not_warehouse_status']);
        }
        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code = ?", $condition["customer_code"]);
        }

        if (isset($condition["ie_type"]) && $condition["ie_type"] != "") {
            $select->where("ie_type = ?", $condition["ie_type"]);
        }
        if(isset($condition["warehouse_status"]) && $condition["warehouse_status"] != ""){
        	$select->where("warehouse_status = ?",$condition["warehouse_status"]);
        }
        
        if (isset($condition["warehouse_name"]) && $condition["warehouse_name"] != "") {
            $select->where("warehouse_name = ?", $condition["warehouse_name"]);
        }

        if (isset($condition["customs_using_code"]) && $condition["customs_using_code"] != "") {
            $select->where("customs_using_code = ?", $condition["customs_using_code"]);
        }

        if (isset($condition["customs_code"]) && $condition["customs_code"] != "") {
            $select->where("customs_code = ?", $condition["customs_code"]);
        }
        return $select;
    }
}
