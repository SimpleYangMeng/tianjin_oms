<?php
class Service_GoodsListDetail
{
    /**
     * @var null
     */
    public static $_modelClass = null;

    /**
     * @return Table_Location|null
     */
    public static function getModelInstance()
    {
        if (is_null(self::$_modelClass)) {
            self::$_modelClass = new Table_GoodsListDetail();
        }
        return self::$_modelClass;
    }
	public static $orderType = array(
	        '0'=>'Normal',
// 	        '1'=>'RTV',
	        '2'=>'Transfer',
	        '3'=>'Self Pickup',
	        );
	public static function getOrderType(){
		$status[0] = '普通';
		$status[1] = '转仓';
		$status[2] = '退货';
		return $status;
	}
	/*
	 * Create A Record
	 *
	 * @param
	 *       	 rowSet
	 * @return boolean
	 */
	public static function add($row)
	{
		$model = self::getModelInstance();
		return $model->add($row);
	}
	
	/*
	 * Update One Row
	 *
	 * @param $row rowSet       	
	 * @param $order_id int       	
	 * @return boolean
	 */
	public static function update($row, $value , $field = "gld_id")
	{
		$model = self::getModelInstance();
		return $model->update($row, $value,$field);
	}
	
	public static function delete($value , $field = "gld_id")
	{
		$model = self::getModelInstance();
		return $model->delete($value,$field);
	}
	
	public static function getByField($value, $field = 'gld_id', $colums = "*")
	{
		$model = self::getModelInstance();
		return $model->getByField($value, $field, $colums);
	}
	public static function getByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = "")
	{
		$model = self::getModelInstance();
		return $model->getByCondition($condition, $type, $pageSize, $page, $order);
	}

    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
            'E0'=>'gld_id',
            'E1'=>'gl_id',
            'E2'=>'gl_code',
            'E3'=>'product_id',
            'E4'=>'register_id',
            'E5'=>'g_no',
            'E6'=>'goods_id',
            'E7'=>'hs_code',
            'E8'=>'gt_code',
            'E9'=>'g_name_cn',
            'E10'=>'g_model',
            'E11'=>'g_qty',
            'E12'=>'g_uint',
            'E13'=>'price',
            'E14'=>'total_price',
            'E15'=>'currency',
            'E16'=>'country',
        );
        return $row;
    }

}