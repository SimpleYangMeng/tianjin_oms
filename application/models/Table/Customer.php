<?php
class Table_Customer
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Customer();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Customer();
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
    public function update($row, $value, $field = "customer_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @return mixed
     */
    public function delete($value, $field = "customer_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->delete($where);
    }
    public function getLockInShareMode($customer_id)
    {
        $sql = 'SELECT * FROM customer WHERE customer_id=' . $customer_id . ' LOCK IN SHARE MODE;';
        return $this->_table->getAdapter()->fetchRow($sql);
    }
    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'customer_id', $colums = "*")
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

    /**
     * 构造自定义SQL语句查询
     *
     * @access    public
     * @param   string    ($field        待返回的字段，默认为所有)
     * @param   string    ($condition    查询条件)
     * @param    mixed    ($value        待转换查询字段值)
     * @return    mixed
     */
    public function getCustomQuery($field = '*', $condition = '', $value = '')
    {
        $table = $this->_table->info('name');
        $sql   = "SELECT $field FROM $table $condition";
        $sql   = $this->_table->getAdapter()->quoteInto($sql, $value);
        return $this->_table->getAdapter()->fetchAll($sql);
    }

    /**
     * [getByWhere 多条件获取]
     * @param  [type] $where  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByWhere($where, $colums = '*') {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        foreach($where as $field=>$value) {
            $select->where("{$field} = ?", $value);
        }
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
        $table  = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/

        if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
            $select->where("customer_code = ?", $condition["customer_code"]);
        }
        if (isset($condition["customer_password"]) && $condition["customer_password"] != "") {
            $select->where("customer_password = ?", $condition["customer_password"]);
        }
        if (isset($condition["customer_firstname"]) && $condition["customer_firstname"] != "") {
            $select->where("customer_firstname = ?", $condition["customer_firstname"]);
        }
        if (isset($condition["customer_lastname"]) && $condition["customer_lastname"] != "") {
            $select->where("customer_lastname = ?", $condition["customer_lastname"]);
        }
        if (isset($condition["customer_email"]) && $condition["customer_email"] != "") {
            $select->where("customer_email = ?", $condition["customer_email"]);
        }
        if (isset($condition["customer_currency"]) && $condition["customer_currency"] != "") {
            $select->where("customer_currency = ?", $condition["customer_currency"]);
        }
        if (isset($condition["customer_activate_code"]) && $condition["customer_activate_code"] != "") {
            $select->where("customer_activate_code = ?", $condition["customer_activate_code"]);
        }
        if (isset($condition["customer_telephone"]) && $condition["customer_telephone"] != "") {
            $select->where("customer_telephone = ?", $condition["customer_telephone"]);
        }
        if (isset($condition["customer_fax"]) && $condition["customer_fax"] != "") {
            $select->where("customer_fax = ?", $condition["customer_fax"]);
        }
        if (isset($condition["customer_status"]) && $condition["customer_status"] != "") {
            $select->where("customer_status = ?", $condition["customer_status"]);
        }
        if (isset($condition["customer_company_name"]) && $condition["customer_company_name"] != "") {
            $select->where("customer_company_name = ?", $condition["customer_company_name"]);
        }
        if (isset($condition["customer_logo"]) && $condition["customer_logo"] != "") {
            $select->where("customer_logo = ?", $condition["customer_logo"]);
        }
        if (isset($condition["customer_saler_user_id"]) && $condition["customer_saler_user_id"] != "") {
            $select->where("customer_saler_user_id = ?", $condition["customer_saler_user_id"]);
        }
        if (isset($condition["customer_cser_user_id"]) && $condition["customer_cser_user_id"] != "") {
            $select->where("customer_cser_user_id = ?", $condition["customer_cser_user_id"]);
        }
        if (isset($condition["customer_verify_code"]) && $condition["customer_verify_code"] != "") {
            $select->where("customer_verify_code = ?", $condition["customer_verify_code"]);
        }
        if (isset($condition["customer_signature"]) && $condition["customer_signature"] != "") {
            $select->where("customer_signature = ?", $condition["customer_signature"]);
        }
        if (isset($condition["reg_step"]) && $condition["reg_step"] != "") {
            $select->where("reg_step = ?", $condition["reg_step"]);
        }
        if (isset($condition["password_update_time"]) && $condition["password_update_time"] != "") {
            $select->where("password_update_time = ?", $condition["password_update_time"]);
        }
        if (isset($condition["forget_password_auth_code"]) && $condition["forget_password_auth_code"] != "") {
            $select->where("forget_password_auth_code = ?", $condition["forget_password_auth_code"]);
        }
        if (isset($condition["customer_type"]) && $condition["customer_type"] != "") {
            $select->where("customer_type = ?", $condition["customer_type"]);
        }
        if (isset($condition["bus_name"]) && $condition["bus_name"] != "") {
            $select->where("bus_name = ?", $condition["bus_name"]);
        }
        if (isset($condition["bus_sco"]) && $condition["bus_sco"] != "") {
            $select->where("bus_sco = ?", $condition["bus_sco"]);
        }
        if (isset($condition["bus_lic_reg_num"]) && $condition["bus_lic_reg_num"] != "") {
            $select->where("bus_lic_reg_num = ?", $condition["bus_lic_reg_num"]);
        }
        if (isset($condition["web_name"]) && $condition["web_name"] != "") {
            $select->where("web_name = ?", $condition["web_name"]);
        }
        if (isset($condition["web_address"]) && $condition["web_address"] != "") {
            $select->where("web_address = ?", $condition["web_address"]);
        }
        if (isset($condition["bus_web_address"]) && $condition["bus_web_address"] != "") {
            $select->where("bus_web_address = ?", $condition["bus_web_address"]);
        }
        if (isset($condition["ins_unit_code"]) && $condition["ins_unit_code"] != "") {
            $select->where("ins_unit_code = ?", $condition["ins_unit_code"]);
        }
        if (isset($condition["customs_reg_num"]) && $condition["customs_reg_num"] != "") {
            $select->where("customs_reg_num = ?", $condition["customs_reg_num"]);
        }
        if (isset($condition["eshop_name"]) && $condition["eshop_name"] != "") {
            $select->where("eshop_name = ?", $condition["eshop_name"]);
        }

        if (isset($condition["is_storage"]) && $condition["is_storage"] !== "") {
            $select->where("is_storage = ?", $condition["is_storage"]);
        }

        if (isset($condition["is_pay"]) && $condition["is_pay"] !== "") {
            $select->where("is_pay = ?", $condition["is_pay"]);
        }
        if (isset($condition["is_supervision"]) && $condition["is_supervision"] !== "") {
            $select->where("is_supervision = ?", $condition["is_supervision"]);
        }

        if (isset($condition["is_shipping"]) && $condition["is_shipping"] !== "") {
            $select->where("is_shipping = ?", $condition["is_shipping"]);
        }
        if (isset($condition["is_platform"]) && $condition["is_platform"] !== "") {
            $select->where("is_platform = ?", $condition["is_platform"]);
        }
        if (isset($condition["is_ecommerce"]) && $condition["is_ecommerce"] !== "") {
            $select->where("is_ecommerce = ?", $condition["is_ecommerce"]);
        }

        if (isset($condition["custom_code"]) && $condition["custom_code"] !== "") {
            $select->where("custom_code = ?", $condition["custom_code"]);
        }

        if (isset($condition["ie_type"]) && $condition["ie_type"] !== "") {
            $select->where("ie_type = ?", $condition["ie_type"]);
        }
        if (isset($condition["agent_name"]) && $condition["agent_name"] !== "") {
            $select->where("agent_name = ?", $condition["agent_name"]);
        }
        if (isset($condition["agent_code"]) && $condition["agent_code"] !== "") {
            $select->where("agent_code = ?", $condition["agent_code"]);
        }

        if (isset($condition['customs_code']) && !empty($condition['customs_code'])) {
            $select->where("customs_code = ? ", $condition['customs_code']);
        }
        if (isset($condition["customer_a_m_a"]) && $condition["customer_a_m_a"] !== "") {
            $select->where("customer_a_m_a = ?", $condition["customer_a_m_a"]);
        }
        if (isset($condition["trade_name_en"]) && $condition["trade_name_en"] !== "") {
            $select->where("trade_name_en = ?", $condition["trade_name_en"]);
        }
        if (isset($condition["credit_code"]) && $condition["credit_code"] !== "") {
            $select->where("credit_code = ?", $condition["credit_code"]);
        }
        if (isset($condition["corporate"]) && $condition["corporate"] !== "") {
            $select->where("corporate = ?", $condition["corporate"]);
        }
        if (isset($condition["corporate_num"]) && $condition["corporate_num"] !== "") {
            $select->where("corporate_num = ?", $condition["corporate_num"]);
        }
        if (isset($condition["corporate_phone"]) && $condition["corporate_phone"] !== "") {
            $select->where("corporate_phone = ?", $condition["corporate_phone"]);
        }
        if (isset($condition["validity_date"]) && $condition["validity_date"] !== "") {
            $select->where("validity_date = ?", $condition["validity_date"]);
        }
        if (isset($condition["pay_bus_lic"]) && $condition["pay_bus_lic"] !== "") {
            $select->where("pay_bus_lic = ?", $condition["pay_bus_lic"]);
        }
        if (isset($condition["exp_bus_lic"]) && $condition["exp_bus_lic"] !== "") {
            $select->where("exp_bus_lic = ?", $condition["exp_bus_lic"]);
        }
        if (isset($condition["warehouse_area"]) && $condition["warehouse_area"] !== "") {
            $select->where("warehouse_area = ?", $condition["warehouse_area"]);
        }
        if (isset($condition["reg_sit_cer_no"]) && $condition["reg_sit_cer_no"] !== "") {
            $select->where("reg_sit_cer_no = ?", $condition["reg_sit_cer_no"]);
        }
        if (isset($condition["business_type"]) && $condition["business_type"] !== "") {
            $select->where("business_type = ?", $condition["business_type"]);
        }
        if (isset($condition["trade_co"]) && $condition["trade_co"] !== "") {
            $select->where("trade_co = ?", $condition["trade_co"]);
        }
        if (isset($condition["contact_man_email"]) && $condition["contact_man_email"] !== "") {
            $select->where("contact_man_email = ?", $condition["contact_man_email"]);
        }
        if (isset($condition["bus_lc_sign_unit"]) && $condition["bus_lc_sign_unit"] !== "") {
            $select->where("bus_lc_sign_unit = ?", $condition["bus_lc_sign_unit"]);
        }
        if (isset($condition["customs_status"]) && $condition["customs_status"] !== "") {
            $select->where("customs_status = ?", $condition["customs_status"]);
        }
        if (isset($condition["ciq_status"]) && $condition["ciq_status"] !== "") {
            $select->where("ciq_status = ?", $condition["ciq_status"]);
        }
        if (isset($condition["customs_dec_ent_num"]) && $condition["customs_dec_ent_num"] !== "") {
            $select->where("customs_dec_ent_num = ?", $condition["customs_dec_ent_num"]);
        }
        if (isset($condition["is_baoguan"]) && $condition["is_baoguan"] !== "") {
            $select->where("is_baoguan = ?", $condition["is_baoguan"]);
        }
        if (isset($condition['customer_status_not']) && $condition['customer_status_not'] !== "") {
            $select->where('customer_status != ?', $condition['customer_status_not']);
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

    public function getByStatus($status, $pageSize = 0, $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where("customs_status = ?", $status);
        $select->where("customer_status = ?", 1);
        $select->where("customer_id > ?", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);

    }

    public function getByCiqStatus($status, $pageSize = 0, $minId)
    {
        $select = $this->_table->getAdapter()->select();
        // $select->forUpdate();
        $table = $this->_table->info('name');
        $select->from($table, '*');
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        $select->where('customer_status = ? ', 1);
        $select->where("ciq_status = ? ", $status);
        $select->where("customer_id > ? ", $minId);
        $select->limit($pageSize);
        $sql = $select->__toString();
        return $this->_table->getAdapter()->fetchAll($sql);
    }
    /**
     * [getByFieldLock 加锁]
     * @param  [type] $value  [description]
     * @param  string $field  [description]
     * @param  string $colums [description]
     * @return [type]         [description]
     */
    public function getByFieldLock($value, $field = 'customer_id', $colums = "*")
    {
        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $colums);
        $select->forUpdate();
        $select->where("{$field} = ?", $value);
        return $this->_table->getAdapter()->fetchRow($select);
    }
}
