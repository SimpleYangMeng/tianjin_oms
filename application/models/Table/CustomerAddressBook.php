<?php
class Table_CustomerAddressBook
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CustomerAddressBook();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CustomerAddressBook();
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
    public function update($row, $value, $field = "cab_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "cab_id")
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
    public function getByField($value, $field = 'cab_id', $colums = "*")
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
        if(isset($condition["cab_type"]) && $condition["cab_type"] != ""){
            $select->where("cab_type = ?",$condition["cab_type"]);
        }
        if(isset($condition["cab_company"]) && $condition["cab_company"] != ""){
            $select->where("cab_company = ?",$condition["cab_company"]);
        }
        if(isset($condition["cab_firstname"]) && $condition["cab_firstname"] != ""){
            $select->where("cab_firstname = ?",$condition["cab_firstname"]);
        }
        if(isset($condition["cab_lastname"]) && $condition["cab_lastname"] != ""){
            $select->where("cab_lastname = ?",$condition["cab_lastname"]);
        }
        if(isset($condition["cab_country_id"]) && $condition["cab_country_id"] != ""){
            $select->where("cab_country_id = ?",$condition["cab_country_id"]);
        }
        if(isset($condition["cab_zone_id"]) && $condition["cab_zone_id"] != ""){
            $select->where("cab_zone_id = ?",$condition["cab_zone_id"]);
        }
        if(isset($condition["cab_state"]) && $condition["cab_state"] != ""){
            $select->where("cab_state = ?",$condition["cab_state"]);
        }
        if(isset($condition["cab_city"]) && $condition["cab_city"] != ""){
            $select->where("cab_city = ?",$condition["cab_city"]);
        }
        if(isset($condition["cab_suburb"]) && $condition["cab_suburb"] != ""){
            $select->where("cab_suburb = ?",$condition["cab_suburb"]);
        }
        if(isset($condition["cab_street_address1"]) && $condition["cab_street_address1"] != ""){
            $select->where("cab_street_address1 = ?",$condition["cab_street_address1"]);
        }
        if(isset($condition["cab_street_address2"]) && $condition["cab_street_address2"] != ""){
            $select->where("cab_street_address2 = ?",$condition["cab_street_address2"]);
        }
        if(isset($condition["cab_postcode"]) && $condition["cab_postcode"] != ""){
            $select->where("cab_postcode = ?",$condition["cab_postcode"]);
        }
        if(isset($condition["cab_phone"]) && $condition["cab_phone"] != ""){
            $select->where("cab_phone = ?",$condition["cab_phone"]);
        }
        if(isset($condition["cab_cell_phone"]) && $condition["cab_cell_phone"] != ""){
            $select->where("cab_cell_phone = ?",$condition["cab_cell_phone"]);
        }
        if(isset($condition["cab_fax"]) && $condition["cab_fax"] != ""){
            $select->where("cab_fax = ?",$condition["cab_fax"]);
        }
        if(isset($condition["cab_email"]) && $condition["cab_email"] != ""){
            $select->where("cab_email = ?",$condition["cab_email"]);
        }
        if(isset($condition["cab_note"]) && $condition["cab_note"] != ""){
            $select->where("cab_note = ?",$condition["cab_note"]);
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