<?php
class Service_ApiMessage extends Common_Service {
	public function getBasePath() {
		return APPLICATION_PATH . '/../data/cainiao';
	}
	/**
	 * @var null
	 */
	public static $_modelClass = null;

	/**
	 * @return Table_IePort|null
	 */
	public static function getModelInstance() {
		if (is_null(self::$_modelClass)) {
			self::$_modelClass = new Table_ApiMessage();
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
	public static function update($row, $value, $field = "am_id") {
		$model = self::getModelInstance();
		return $model->update($row, $value, $field);
	}

	/**
	 * @param $value
	 * @param string $field
	 * @return mixed
	 */
	public static function delete($value, $field = "am_id") {
		$model = self::getModelInstance();
		return $model->delete($value, $field);
	}

	/**
	 * @param $value
	 * @param string $field
	 * @param string $colums
	 * @return mixed
	 */
	public static function getByField($value, $field = 'am_id', $colums = "*") {
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

	/**
	 * @param $val
	 * @return array
	 */
	public static function validator($val) {
		$validateArr = $error = array();

		$validateArr[] = array("name" => EC::Lang('消息类型'), "value" => $val["api_type"], "regex" => array("require"));
		$validateArr[] = array("name" => EC::Lang('接口名称'), "value" => $val["api_name"], "regex" => array("require"));
		return Common_Validator::formValidator($validateArr);
	}

	/**
	 * [getByStatus description]
	 * @param  [type]  $status   [description]
	 * @param  integer $pageSize [description]
	 * @param  integer $minId    [description]
	 * @return [type]            [description]
	 */
	public static function getByStatus($status, $apiCode, $minId, $pageSize = 0) {
		$model = self::getModelInstance();
		return $model->getByStatus($status, $apiCode, $minId, $pageSize);
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getFields() {
		$row = array(

			'E0' => 'am_id',
			'E1' => 'api_type',
			'E2' => 'api_name',
			'E3' => 'api_caller',
			'E4' => 'refer_code',
			'E5' => 'ref_cus_code',
		);
		return $row;
	}
	/**
	 * @author william-fan
	 * @todo 用于创建
	 */
	public function createApiMessageProcess($row, $string, $type = 'order') {
		$jamobj = new Service_ApiMessage();

		$relativePath = "/{$type}/" . date('Y/m/d');
		$absolutePath = $this->getBasePath() . $relativePath;
		if (!file_exists($absolutePath)) {
			mkdir($absolutePath, 0777, true);
		}
		$filename = $row['refer_code'];
		if (empty($filename)) {
			$tmpfname = tempnam($absolutePath, $type);
			file_put_contents($tmpfname, $string);
			$row['file_path'] = $tmpfname;
		} else {
			if (file_exists($absolutePath . '/' . $filename)) {
				$tmpfname = tempnam($absolutePath, $type);
				file_put_contents($tmpfname, $string);
				$row['file_path'] = $tmpfname;
			} else {
				file_put_contents($absolutePath . '/' . $filename, $string);
				$row['file_path'] = $absolutePath . '/' . $filename;
			}
		}
		//print_r($row);
		return $jamobj->add($row);
	}
}
