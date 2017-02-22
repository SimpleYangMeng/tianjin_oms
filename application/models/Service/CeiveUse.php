<?php
class Service_CeiveUse
{
    /**
     * @var null
     */
    public static function add($row)
	{
		$model = new Table_CeiveUse();
		return $model->add($row);
	}
	
	public static function update($row, $value , $field = "cu_id")
	{
		$model = new Table_CeiveUse();
		return $model->update($row, $value,$field);
	}
	
	public static function delete($value , $field = "cu_id")
	{
		$model = new Table_CeiveUse();
		return $model->delete($value,$field);
	}
	
	public static function getByField($value, $field = 'cu_id', $colums = "*")
	{
		$model = new Table_CeiveUse();
		return $model->getByField($value, $field, $colums);
	}
	public static function getAll()
	{
		$model = new Table_CeiveUse();
		return $model->getAll();
	}
	public static function getByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = "")
	{
		$model = new Table_CeiveUse();
		$rows = $model->getByCondition($condition, $type, $pageSize, $page, $order);
		return $rows;
	}
	
	public static function getRowByCondition($condition, $type = '*')
	{
		$model = new Table_CeiveUse();
		return $model->getRowByCondition($condition, $type);
	}
}