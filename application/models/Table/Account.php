<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-1-15
 * Time: 上午10:08
 * To change this template use File | Settings | File Templates.
 */
class Table_Account
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_Account();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_Account();
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
    public function update($row, $value, $field = "account_id")
    {
        $where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
        return $this->_table->update($row, $where);
    }

    /**
     * @param $value
     * @param string $field
     * @param string $colums
     * @return mixed
     */
    public function getByField($value, $field = 'account_id', $colums = "*")
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

        if(isset($condition["customer_code"]) && $condition["customer_code"] != ""){
            $select->where("customer_code = ?",$condition["customer_code"]);
        }
        if(isset($condition["account_code"]) && $condition["account_code"] != ""){
            $select->where("account_code = ?",$condition["account_code"]);
        }
        if(isset($condition["account_email"]) && $condition["account_email"] != ""){
            $select->where("account_email = ?",$condition["account_email"]);
        }
        if(isset($condition["account_password"]) && $condition["account_password"] != ""){
            $select->where("account_password = ?",$condition["account_password"]);
        }
        if(isset($condition["account_name"]) && $condition["account_name"] != ""){
            $select->where("account_name = ?",$condition["account_name"]);
        }
        if(isset($condition["add_time"]) && $condition["add_time"] != ""){
            $select->where("add_time = ?",$condition["add_time"]);
        }
        if(isset($condition["account_update_time"]) && $condition["account_update_time"] != ""){
            $select->where("account_update_time = ?",$condition["account_update_time"]);
        }
        if(isset($condition["account_status"]) && $condition["account_status"] != ""){
            $select->where("account_status = ?",$condition["account_status"]);
        }
        if(isset($condition["account_level"]) && $condition["account_level"] != ""){
            $select->where("account_level = ?",$condition["account_level"]);
        }
        if(isset($condition["account_id_code"]) && $condition["account_id_code"] != ""){
            $select->where("account_id_code = ?",$condition["account_id_code"]);
        } 
        if(isset($condition["account_real_name"]) && $condition["account_real_name"] != ""){
            $select->where("account_real_name = ?",$condition["account_real_name"]);
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
