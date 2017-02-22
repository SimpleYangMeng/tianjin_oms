<?php
class Table_CustomerAttribute {
	protected $_table = null;

	public function __construct() {
		$this->_table = new DbTable_CustomerAttribute();
	}

	public function getAdapter() {
		return $this->_table->getAdapter();
	}

	public static function getInstance() {
		return new Table_CustomerAttribute();
	}

	/**
	 * @param $row
	 * @return mixed
	 */
	public function add($row) {
		return $this->_table->insert($row);
	}

	/**
	 * @param $row
	 * @param $value
	 * @param string $field
	 * @return mixed
	 */
	public function update($row, $value, $field = "ca_id") {
		$where = $this->_table->getAdapter()->quoteInto("{$field}= ?", $value);
		return $this->_table->update($row, $where);
	}

	/**
	 * @param $value
	 * @param string $field
	 * @param string $colums
	 * @return mixed
	 */
	public function getByField($value, $field = 'ca_id', $colums = "*") {
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
	public function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $orderBy = "") {
		$select = $this->_table->getAdapter()->select();
		$table = $this->_table->info('name');
		$select->from($table, $type);
		$select->where("1 =?", 1);
		/*CONDITION_START*/

		if (isset($condition["customer_code"]) && $condition["customer_code"] != "") {
			$select->where("customer_code = ?", $condition["customer_code"]);
		}
		if (isset($condition["url"]) && $condition["url"] != "") {
			$select->where("url = ?", $condition["url"]);
		}
		if (isset($condition["site_name"]) && $condition["site_name"] != "") {
			$select->where("site_name = ?", $condition["site_name"]);
		}
		if (isset($condition["bus_scope"]) && $condition["bus_scope"] != "") {
			$select->where("bus_scope = ?", $condition["bus_scope"]);
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
