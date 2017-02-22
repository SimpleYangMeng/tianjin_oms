<?php
class Table_CeiveUse
{
    protected $_table = null;

    public function __construct()
    {
        $this->_table = new DbTable_CeiveUse();
    }

    public function getAdapter()
    {
        return $this->_table->getAdapter();
    }

    public static function getInstance()
    {
        return new Table_CeiveUse();
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
    public function update($row, $value, $field = "cu_id")
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
    public function getByField($value, $field = 'cu_id', $colums = "*")
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

        $select = $this->_table->getAdapter()->select();
        $table = $this->_table->info('name');
        $select->from($table, $type);
        $select->where("1 =?", 1);
        /*CONDITION_START*/
        
        if(isset($condition["cu_code"]) && $condition["cu_code"] != ""){
            $select->where("cu_code = ?",$condition["cu_code"]);
        }
        if(isset($condition["cu_username"]) && $condition["cu_username"] != ""){
            $select->where("cu_username = ?",$condition["cu_username"]);
        }
        if(isset($condition["cu_status"]) && $condition["cu_status"] !== ""){
            $select->where("cu_status = ?",$condition["cu_status"]);
        }
        if(isset($condition["cu_type"]) && $condition["cu_type"] !== ""){
            $select->where("cu_type = ?",$condition["cu_type"]);
        }
		if(isset($condition["sku"]) && $condition["sku"] != ""){
			$productInfo	= Service_Product::getByField($condition["sku"], $field = 'product_sku', $colums = "*");
			if(!empty($productInfo)){
				$ceiveUseDetail	= Service_CeiveUseDetail::getByCondition(array('product_id'=>$productInfo['product_id']));
				if(!empty($ceiveUseDetail)){
					$tmp	= array();
					foreach($ceiveUseDetail as $k=>$v){
						$tmp[]	= $v['cu_code'];
					}
					$select->Where('cu_code IN(?)',$tmp);
				}
			}
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
			echo $sql;
            return $this->_table->getAdapter()->fetchAll($sql);
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
