<?php
class Service_CustomerAttribute {
	/**
	 * @var null
	 */
	public static $_modelClass = null;

	/**
	 * @return Table_Customer|null
	 */
	public static function getModelInstance() {
		if (is_null(self::$_modelClass)) {
			self::$_modelClass = new Table_CustomerAttribute();
		}
		return self::$_modelClass;
	}

	/**
	 * @param $row
	 * @return mixed
	 */
	public static function add($row) {
		$model = self::getModelInstance();
		return $model->add($row);
	}

	/**
	 * @param $row
	 * @param $value
	 * @param string $field
	 * @return mixed
	 */
	public static function update($row, $value, $field = "ca_id") {
		$model = self::getModelInstance();
		return $model->update($row, $value, $field);
	}

	/**
	 * @param $value
	 * @param string $field
	 * @return mixed
	 */
	public static function delete($value, $field = "ca_id") {
		$model = self::getModelInstance();
		return $model->delete($value, $field);
	}

	/**
	 * @param $value
	 * @param string $field
	 * @param string $colums
	 * @return mixed
	 */
	public static function getByField($value, $field = 'ca_id', $colums = "*") {
		$model = self::getModelInstance();
		return $model->getByField($value, $field, $colums);
	}

	/**
	 * @return mixed
	 */
	public static function getAll() {
		$model = self::getModelInstance();
		return $model->getAll();
	}

	/**
	 * @param array $condition
	 * @param string $type
	 * @param int $pageSize
	 * @param int $page
	 * @param string $order
	 * @return mixed
	 */
	public static function getByCondition($condition = array(), $type = '*', $pageSize = 0, $page = 1, $order = "") {
		$model = self::getModelInstance();
		return $model->getByCondition($condition, $type, $pageSize, $page, $order);
	}
}
