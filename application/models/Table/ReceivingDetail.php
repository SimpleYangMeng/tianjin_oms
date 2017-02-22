<?php
class Table_ReceivingDetail
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_ReceivingDetail();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_ReceivingDetail();
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
    public function update($row, $value, $field = "rd_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "rd_id")
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
    public function getByField($value, $field = 'rd_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
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
        
        if(isset($condition["receiving_id"]) && $condition["receiving_id"] != ""){
            $select->where("receiving_id = ?",$condition["receiving_id"]);
        }
        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where("receiving_code = ?",$condition["receiving_code"]);
        }
        if(isset($condition["receiving_line_no"]) && $condition["receiving_line_no"] != ""){
            $select->where("receiving_line_no = ?",$condition["receiving_line_no"]);
        }
        if(isset($condition["rd_status"]) && $condition["rd_status"] != ""){
            $select->where("rd_status = ?",$condition["rd_status"]);
        }
        if(isset($condition["product_id"]) && $condition["product_id"] != ""){
            $select->where("product_id = ?",$condition["product_id"]);
        }
        if(isset($condition["product_barcode"]) && $condition["product_barcode"] != ""){
            $select->where("product_barcode = ?",$condition["product_barcode"]);
        }
        if(isset($condition["rd_receiving_qty"]) && $condition["rd_receiving_qty"] != ""){
            $select->where("rd_receiving_qty = ?",$condition["rd_receiving_qty"]);
        }
        if(isset($condition["rd_putaway_qty"]) && $condition["rd_putaway_qty"] != ""){
            $select->where("rd_putaway_qty = ?",$condition["rd_putaway_qty"]);
        }
        if(isset($condition["rd_received_qty"]) && $condition["rd_received_qty"] != ""){
            $select->where("rd_received_qty = ?",$condition["rd_received_qty"]);
        }
        if(isset($condition["is_qc"]) && $condition["is_qc"] != ""){
            $select->where("is_qc = ?",$condition["is_qc"]);
        }
        if(isset($condition["is_priority"]) && $condition["is_priority"] != ""){
            $select->where("is_priority = ?",$condition["is_priority"]);
        }
        if(isset($condition["rd_note"]) && $condition["rd_note"] != ""){
            $select->where("rd_note = ?",$condition["rd_note"]);
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

    public function getJoinReceivingByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = ""){
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);

        $select->joinLeft('receiving', $table.'.receiving_code=receiving.receiving_code',array('customer_code','reference_no'));
        $select->joinLeft('product', $table.'.product_id=product.product_id',array('product_sku'));
        $select->where("1 =?", 1);

        if(isset($condition["time_start"]) && $condition["time_start"] != ""){
            $select->where("rd_update_time >= ?",$condition["time_start"]." 00:00:00");
        }
        if(isset($condition["time_end"]) && $condition["time_end"] != ""){
            $select->where("rd_update_time <= ?",$condition["time_end"]." 23:59:59");
        }
        if(isset($condition["customer_id"]) && $condition["customer_id"] != ""){
            $select->where("receiving.customer_id = ?",$condition["customer_id"]);
        }
        if(isset($condition['receiving_status'])&&$condition['receiving_status']!=""){
            $select->where("receiving_status = ?",$condition['receiving_status']);
        }
        if(isset($condition['rd_status'])&&$condition['rd_status']!=""){
            $select->where(" rd_status = ?",$condition['rd_status']);
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

    public function sumNetWeight($receiving_code) {
        $select = $this->_table->getAdapter()->select();
        $select->from($this->_table->info('name').' as rd', '');
        $select->joinLeft('product as p', 'rd.product_id=p.product_id', 'sum(p.product_weight*rd.rd_receiving_qty) as net_weight');
        $select->where('rd.receiving_code=?', $receiving_code);
        $row = $this->_table->getAdapter()->fetchRow($select);
        return empty($row) ? 0.00 : $row['net_weight'];
    }

    public function getGroupProduct($receiving_code){
        $select = " SELECT p.hs_code,p.country_code_of_origin,p.pu_code FROM product p JOIN receiving_detail rd ON p.product_id=rd.product_id WHERE 1 and  rd.receiving_code='".$receiving_code."' GROUP BY p.hs_code,p.country_code_of_origin,p.pu_code;";
        return $this->_table->getAdapter()->fetchAll($select);
    }

    public function getJoinProductByCondition($condition = array()){
        $sql = "SELECT rd.*,p.hs_code,p.hs_goods_name,p.currency_code,p.product_declared_value,p.product_weight,p.goods_id,p.pu_code FROM receiving_detail rd JOIN product p on p.product_id=rd.product_id where 1";
        if(isset($condition['goods_id'])&&$condition['goods_id']!=""){
            $sql.= " and p.goods_id= '".$condition['goods_id']."'";
        }
        if(isset($condition['receiving_code'])&&$condition['receiving_code']!=""){
            $sql.= " and rd.receiving_code = '".$condition['receiving_code']."'";
        }
        if(isset($condition['hs_code'])&&$condition['hs_code']!=""){
            $sql.= " and p.hs_code= '".$condition['hs_code']."'";
        }
        if(isset($condition['country_code_of_origin'])&&$condition['country_code_of_origin']!=""){
            $sql.= " and p.country_code_of_origin= '".$condition['country_code_of_origin']."'";
        }
        if(isset($condition['pu_code'])&&$condition['pu_code']!=""){
            $sql.= " and p.pu_code= '".$condition['pu_code']."'";
        }
        if(isset($condition['currency_code'])&&$condition['currency_code']!=""){
            $sql.= " and p.currency_code= '".$condition['currency_code']."'";
        }
        return $this->_table->getAdapter()->fetchAll($sql);
    }

    public function calNetWeightByCondition($condition){
        $sql = " SELECT sum(rd.rd_receiving_qty * p.product_weight) FROM receiving_detail rd JOIN product p on p.product_id=rd.product_id where 1 ";
        if(isset($condition['goods_id'])&&$condition['goods_id']!=""){
            $sql.= " and p.goods_id= '".$condition['goods_id']."'";
        }
        if(isset($condition['product_id'])&&$condition['product_id']!=""){
            $sql.=" and p.product_id = '".$condition['product_id']."'";
        }
        if(isset($condition['receiving_code'])&&$condition['receiving_code']!=""){
            $sql.= " and rd.receiving_code = '".$condition['receiving_code']."'";
        }
        if(isset($condition['hs_code'])&&$condition['hs_code']!=""){
            $sql.= " and p.hs_code= '".$condition['hs_code']."'";
        }
        if(isset($condition['country_code_of_origin'])&&$condition['country_code_of_origin']!=""){
            $sql.= " and p.country_code_of_origin= '".$condition['country_code_of_origin']."'";
        }
        if(isset($condition['pu_code'])&&$condition['pu_code']!=""){
            $sql.= " and p.pu_code= '".$condition['pu_code']."'";
        }
        if(isset($condition['currency_code'])&&$condition['currency_code']!=""){
            $sql.= " and p.currency_code= '".$condition['currency_code']."'";
        }
        return $this->_table->getAdapter()->fetchOne($sql);
    }

}