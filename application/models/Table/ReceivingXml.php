<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 15-1-22
 * Time: 下午2:11
 * To change this template use File | Settings | File Templates.
 */
class Table_ReceivingXml
{
    protected $_table = null;

    public function __construct(){
        $this->_table = new DbTable_ReceivingXml();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance(){
        return new Table_ReceivingXml();
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
    public function update($row, $value, $field = "rx_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "rx_id")
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
    public function getByField($value, $field = 'rx_id', $colums = "*")
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

        if(isset($condition["rx_id"]) && $condition["rx_id"] != ""){
            $select->where("rx_id = ?",$condition["rx_id"]);
        }
        if(isset($condition["receiving_code"]) && $condition["receiving_code"] != ""){
            $select->where("receiving_code = ?",$condition["receiving_code"]);
        }
        if(isset($condition["sub_receiving_code"]) && $condition["sub_receiving_code"] != ""){
            $select->where("sub_receiving_code = ?",$condition["sub_receiving_code"]);
        }
        if(isset($condition["gross_wt"]) && $condition["gross_wt"] != ""){
            $select->where("gross_wt = ?",$condition["gross_wt"]);
        }
        if(isset($condition["net_wt"]) && $condition["net_wt"] != ""){
            $select->where("net_wt = ?",$condition["net_wt"]);
        }
        if(isset($condition["pack_no"]) && $condition["pack_no"] != ""){
            $select->where("pack_no = ?",$condition["pack_no"]);
        }
        if(isset($condition["refercence_form_id"]) && $condition["refercence_form_id"] != ""){
            $select->where("refercence_form_id = ?",$condition["refercence_form_id"]);
        }
        if(isset($condition["receiving_xml_status"]) && $condition["receiving_xml_status"] != ""){
            $select->where("receiving_xml_status = ?",$condition["receiving_xml_status"]);
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
