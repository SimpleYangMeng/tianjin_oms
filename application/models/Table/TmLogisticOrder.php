<?php
    /**
     * @var null william-凡
     */
class Table_TmLogisticOrder
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_TmLogisticOrder();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_TmLogisticOrder();
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
    public function update($row, $value, $field = "tlo_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "tlo_id")
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
    public function getByField($value, $field = 'tlo_id', $colums = "*")
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
        
        if(isset($condition["order_code"]) && $condition["order_code"] != ""){
            $select->where("order_code = ?",$condition["order_code"]);
        }
        if(isset($condition["segmentCode"]) && $condition["segmentCode"] != ""){
            $select->where("segmentCode = ?",$condition["segmentCode"]);
        }
        if(isset($condition["carrierCode"]) && $condition["carrierCode"] != ""){
        	$select->where("carrierCode = ?",$condition["carrierCode"]);
        }
        if(isset($condition["itemsIncluded"]) && $condition["itemsIncluded"] != ""){
            $select->where("itemsIncluded = ?",$condition["itemsIncluded"]);
        }
        if(isset($condition["taobaoLogisticsId"]) && $condition["taobaoLogisticsId"] != ""){
            $select->where("taobaoLogisticsId = ?",$condition["taobaoLogisticsId"]);
        }
        if(isset($condition["mailNo"]) && $condition["mailNo"] != ""){
            $select->where("mailNo = ?",$condition["mailNo"]);
        }
        if(isset($condition["logisticsCode"]) && $condition["logisticsCode"] != ""){
            $select->where("logisticsCode = ?",$condition["logisticsCode"]);
        }
        if(isset($condition["packingType"]) && $condition["packingType"] != ""){
            $select->where("packingType = ?",$condition["packingType"]);
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