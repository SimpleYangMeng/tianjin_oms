<?php
class Table_ProductInventory
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ProductInventory();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ProductInventory();
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
    public function update($row, $value, $field = "pi_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "pi_id")
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
    public function getByField($value, $field = 'pi_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getForUpdate($pi_id)
    {
        $sql = 'select * from product_inventory where pi_id=' . $pi_id . ' for update;';
        return $this->_table->getAdapter()->fetchRow($sql);
    }

    public function getByWhProduct($goodsId, $warehouseCode, $ieType = '')
    {
        $colums = "*";
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("warehouse_code = ?", $warehouseCode);
        $select->where("goods_id = ?", $goodsId);
        if ('' != $ieType) {
            $select->where("ie_type = ?", $ieType);
        }

        $sql = $select->__toString();
        $sql .= " for update";
        return $this->_table->getAdapter()->fetchRow($sql);
    }

    public function getByWhere($where, $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $colums);
        foreach ($where as $field => $value) {
            $select->where("{$field} = ?", $value);
        }
        return $this->_table->getAdapter()->fetchRow($select);
    }

    public function getAll()
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
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
    public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "", $lock = '')
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code =?", $condition["customer_code"]);
        }
        if (isset($condition["warehouse_code"]) && $condition["warehouse_code"] != "") {
            $select->where("warehouse_code =?", $condition["warehouse_code"]);
        }
        if (isset($condition["ie_type"]) && $condition["ie_type"] != "") {
            $select->where("ie_type =?", $condition["ie_type"]);
        }

        if (isset($condition["product_barcode"]) && $condition["product_barcode"] != "") {
            $select->where("product_barcode =?", $condition["product_barcode"]);
        }
        if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
            $select->where("customer_id = ?", $condition["customer_id"]);
        }
        if (isset($condition["product_id"]) && $condition["product_id"] != "") {
            $select->where("product_id = ?", $condition["product_id"]);
        }
        if (isset($condition["warehouse_id"]) && $condition["warehouse_id"] != "") {
            $select->where("warehouse_id = ?", $condition["warehouse_id"]);
        }
        if (isset($condition["pi_onway"]) && $condition["pi_onway"] != "") {
            $select->where("pi_onway = ?", $condition["pi_onway"]);
        }
        if (isset($condition["pi_pending"]) && $condition["pi_pending"] != "") {
            $select->where("pi_pending = ?", $condition["pi_pending"]);
        }
        if (isset($condition["pi_sellable"]) && $condition["pi_sellable"] != "") {
            $select->where("pi_sellable = ?", $condition["pi_sellable"]);
        }
        if (isset($condition["pi_unsellable"]) && $condition["pi_unsellable"] != "") {
            $select->where("pi_unsellable = ?", $condition["pi_unsellable"]);
        }
        if (isset($condition["pi_reserved"]) && $condition["pi_reserved"] != "") {
            $select->where("pi_reserved = ?", $condition["pi_reserved"]);
        }
        if (isset($condition["pi_shipped"]) && $condition["pi_shipped"] != "") {
            $select->where("pi_shipped = ?", $condition["pi_shipped"]);
        }
        if (isset($condition["pi_hold"]) && $condition["pi_hold"] != "") {
            $select->where("pi_hold = ?", $condition["pi_hold"]);
        }
        if (isset($condition['goods_id']) && $condition['goods_id'] != "") {
            $select->where("goods_id = ?", $condition["goods_id"]);
        }
        if (isset($condition["product_id_array"]) && is_array($condition["product_id_array"]) && $condition["product_id_array"]) {
            $select->where("product_id IN (?)", $condition["product_id_array"]);
        }
		if(isset($condition["warehouse_array"]) && !empty($condition["warehouse_array"])){
            $select->where("warehouse_code IN (?)",$condition["warehouse_array"]);
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
            if (!empty($lock)) {
                $sql .= " $lock";
            }
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }

    public function getJoinProductByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "")
    {
        $select = $this->_table->getAdapter()->select();
        $table  = $this->_table->info('name');
        $select->from($table, $type);
        $select->joinRight('product', 'product.product_id=' . $table . '.product_id', array('product_title', 'product_title_en', 'product_sku'));
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        if (isset($condition["product_barcode"]) && $condition["product_barcode"] != "") {
            $select->where($table . ".product_barcode =", $condition["product_barcode"]);
        }
        if (isset($condition["customer_id"]) && $condition["customer_id"] != "") {
            $select->where($table . ".customer_id = ?", $condition["customer_id"]);
        }
        if (isset($condition["product_id"]) && $condition["product_id"] != "") {
            $select->where($table . ".product_id = ?", $condition["product_id"]);
        }
        if (isset($condition["warehouse_id"]) && $condition["warehouse_id"] != "") {
            $select->where($table . ".warehouse_id = ?", $condition["warehouse_id"]);
        }
        if (isset($condition["pi_onway"]) && $condition["pi_onway"] != "") {
            $select->where("pi_onway = ?", $condition["pi_onway"]);
        }
        if (isset($condition["pi_pending"]) && $condition["pi_pending"] != "") {
            $select->where("pi_pending = ?", $condition["pi_pending"]);
        }
        if (isset($condition["pi_sellable"]) && $condition["pi_sellable"] != "") {
            $select->where("pi_sellable = ?", $condition["pi_sellable"]);
        }
        if (isset($condition["pi_unsellable"]) && $condition["pi_unsellable"] != "") {
            $select->where("pi_unsellable = ?", $condition["pi_unsellable"]);
        }
        if (isset($condition["pi_reserved"]) && $condition["pi_reserved"] != "") {
            $select->where("pi_reserved = ?", $condition["pi_reserved"]);
        }
        if (isset($condition["pi_shipped"]) && $condition["pi_shipped"] != "") {
            $select->where("pi_shipped = ?", $condition["pi_shipped"]);
        }
        if (isset($condition["pi_hold"]) && $condition["pi_hold"] != "") {
            $select->where("pi_hold = ?", $condition["pi_hold"]);
        }
        if (isset($condition["product_id_array"]) && is_array($condition["product_id_array"]) && $condition["product_id_array"]) {
            $select->where($table . ".product_id IN (?)", $condition["product_id_array"]);
        }
        if (isset($condition['product_title']) && $condition['product_title'] != "") {
            $select->where("product.product_title like ?", "%" . $condition['product_title'] . "%");
        }
        if (isset($condition['product_sku']) && $condition['product_sku'] != "") {
            $select->where("product.product_sku = ? ", $condition['product_sku']);
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
