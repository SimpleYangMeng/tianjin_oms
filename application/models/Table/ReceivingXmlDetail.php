<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 15-1-22
 * Time: 下午2:12
 * To change this template use File | Settings | File Templates.
 */
class Table_ReceivingXmlDetail
{
    protected $_table = null;

    public function __construct(){
        $this->_table = new DbTable_ReceivingXmlDetail();
    }

    public function getAdapter(){
        return $this->_table->getAdapter();
    }

    public function getInstance(){
        return new Table_ReceivingXmlDetail();
    }

    public function add($row){
        $this->_table->insert($row);
    }

    /**
     * @param $row
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function update($row, $value, $field = "rxd_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "rxd_id")
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
    public function getByField($value, $field = 'rxd_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->where("{$field} = ?", $value);
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

        if(isset($condition["rxd_id"]) && $condition["rxd_id"] != ""){
            $select->where("rxd_id = ?",$condition["rxd_id"]);
        }
        if(isset($condition["rx_id"]) && $condition["rx_id"] != ""){
            $select->where("rx_id = ?",$condition["rx_id"]);
        }
        if(isset($condition["from_id"]) && $condition["from_id"] != ""){
            $select->where("from_id = ?",$condition["from_id"]);
        }
        if(isset($condition["sub_receiving_code"]) && $condition["sub_receiving_code"] != ""){
            $select->where("sub_receiving_code = ?",$condition["sub_receiving_code"]);
        }
        if(isset($condition["g_no"]) && $condition["g_no"] != ""){
            $select->where("g_no = ?",$condition["g_no"]);
        }
        if(isset($condition["goods_id"]) && $condition["goods_id"] != ""){
            $select->where("goods_id = ?",$condition["goods_id"]);
        }
        if(isset($condition["merger_g_no"]) && $condition["merger_g_no"] != ""){
            $select->where("merger_g_no = ?",$condition["merger_g_no"]);
        }
        if(isset($condition["code_ts"]) && $condition["code_ts"] != ""){
            $select->where("code_ts = ?",$condition["code_ts"]);
        }
        if(isset($condition["g_name_cn"]) && $condition["g_name_cn"] != ""){
            $select->where("g_name_cn = ?",$condition["g_name_cn"]);
        }
        if(isset($condition["g_model"]) && $condition["g_model"] != ""){
            $select->where("g_model = ?",$condition["g_model"]);
        }
        if(isset($condition["g_qty"]) && $condition["g_qty"] != ""){
            $select->where("g_qty = ?",$condition["g_qty"]);
        }
        if(isset($condition["g_unit"]) && $condition["g_unit"] != ""){
            $select->where("g_unit = ?",$condition["g_unit"]);
        }
        if(isset($condition["decl_price"]) && $condition["decl_price"] != ""){
            $select->where("decl_price = ?",$condition["decl_price"]);
        }
        if(isset($condition["curr"]) && $condition["curr"] != ""){
            $select->where("curr = ?",$condition["curr"]);
        }
        if(isset($condition["qty_1"]) && $condition["qty_1"] != ""){
            $select->where("qty_1 = ?",$condition["qty_1"]);
        }
        if(isset($condition["unit_1"]) && $condition["unit_1"] != ""){
            $select->where("unit_1 = ?",$condition["unit_1"]);
        }
        if(isset($condition["qty_2"]) && $condition["qty_2"] != ""){
            $select->where("qty_2 = ?",$condition["qty_2"]);
        }
        if(isset($condition["unit_2"]) && $condition["unit_2"] != ""){
            $select->where("unit_2 = ?",$condition["unit_2"]);
        }
        if(isset($condition["origin_country"]) && $condition["origin_country"] != ""){
            $select->where("origin_country = ?",$condition["origin_country"]);
        }
        if(isset($condition["decl_total"]) && $condition["decl_total"] != ""){
            $select->where("decl_total = ?",$condition["decl_total"]);
        }
        if(isset($condition['order_code_str'])&&$condition['order_code_str']!=""){
            $select->where("order_code_str like ? ",'%'.$condition['order_code_str'].'%');
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

    public function getByGroupByCondition($condition,$type,$cellType,$groupBy){
        $sql = "  select $type from receiving_xml_detail where 1";
        if(isset($condition["rxd_id"]) && $condition["rxd_id"] != ""){
            $sql.=" and rex_id = '".$condition["rxd_id"]."'";
        }
        if(isset($condition["from_id"]) && $condition["from_id"] != ""){
            $sql.=" and from_id = '".$condition["from_id"]."'";
        }
        if(isset($condition["sub_receiving_code"]) && $condition["sub_receiving_code"] != ""){
            $sql.=" and sub_receiving_code = '".$condition["sub_receiving_code"]."'";
        }
        if(isset($condition["g_no"]) && $condition["g_no"] != ""){
            $sql.=" and g_no = '".$condition["g_no"]."'";
        }
        if(isset($condition["goods_id"]) && $condition["goods_id"] != ""){
            $sql.=" and goods_id = '".$condition["goods_id"]."'";
        }
        if(isset($condition["merger_g_no"]) && $condition["merger_g_no"] != ""){
            $sql.=" and merger_g_no = '".$condition["merger_g_no"]."'";
        }
        if(isset($condition["code_ts"]) && $condition["code_ts"] != ""){
            $sql.=" and code_ts = '".$condition["code_ts"]."'";
        }
        if(isset($condition["g_name_cn"]) && $condition["g_name_cn"] != ""){
            $sql.=" and g_name_cn = '".$condition["g_name_cn"]."'";
        }
        if(isset($condition["g_model"]) && $condition["g_model"] != ""){
            $sql.=" and g_model = '".$condition["g_model"]."'";
        }
        if(isset($condition["g_qty"]) && $condition["g_qty"] != ""){
            $sql.=" and g_qty = '".$condition["g_qty"]."'";
        }
        if(isset($condition["g_unit"]) && $condition["g_unit"] != ""){
            $sql.=" and g_unit = '".$condition["g_unit"]."'";
        }
        if(isset($condition["decl_price"]) && $condition["decl_price"] != ""){
            $sql.=" and decl_price = '".$condition["decl_price"]."'";
        }
        if(isset($condition["curr"]) && $condition["curr"] != ""){
            $sql.=" and curr = '".$condition["curr"]."'";
        }
        if(isset($condition["qty_1"]) && $condition["qty_1"] != ""){
            $sql.=" and qty_1 = '".$condition["qty_1"]."'";
        }
        if(isset($condition["unit_1"]) && $condition["unit_1"] != ""){
            $sql.=" and unit_1 = '".$condition["unit_1"]."'";
        }
        if(isset($condition["qty_2"]) && $condition["qty_2"] != ""){
            $sql.=" and qty_2 = '".$condition["qty_2"]."'";
        }
        if(isset($condition["unit_2"]) && $condition["unit_2"] != ""){
            $sql.=" and unit_2 = '".$condition["unit_2"]."'";
        }
        if(isset($condition["origin_country"]) && $condition["origin_country"] != ""){
            $sql.=" and origin_country = '".$condition["origin_country"]."'";
        }
        if(isset($condition["decl_total"]) && $condition["decl_total"] != ""){
            $sql.=" and decl_total = '".$condition["decl_total"]."'";
        }
        if(isset($condition['order_code_str'])&&$condition['order_code_str']!=""){
            $sql.=" and order_code_str like '%".$condition['order_code_str']."%'";
        }
        $sql.= " group by $groupBy";
        if($cellType=="Col"){
            return $this->_table->getAdapter()->fetchCol($sql);
        }else{
            return $this->_table->getAdapter()->fetchAll($sql);
        }
    }
}
