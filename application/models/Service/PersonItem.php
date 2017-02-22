<?php
class Service_PersonItem
{


    /**
     * 个人物品海关状态
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getCustomsStatus($code = false)
    {

        $status = array(
            0 => "停用",
            1 => "已关联",
            2 => "异常",
            3 => "已发送",
            4 => "作废",
            5 => "已接收",
            6 => "已审核",
            7 => '审核不通过',
            8 => '布控',
            9 => '已关联载货单',
        );
        if($code !== false){
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;
    }
    /**
     * [getCiqStatus 商检状态]
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getCiqStatus($code = false)
    {

        $status = array(
            0 => "草稿",
            3 => "已发送",
            5 => '已接收',
            6 => "已审核",//商检通过
            7 => '审核不通过',
        );
        if($code !== false){
            return isset($status[$code]) ? $status[$code] : '';
        }
        return $status;
    }
    /**
     * [getStatus 总状态]
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getStatus($code = false)
    {

        $status = array(
            0 => "未审核",
            6 => "已审核",
            7 => "审核不通过",//商检通过
            9 => '已关联载货单',
        );
        if($code !== false){
            return isset($status[$code]) ? $status[$code] : '';
        }
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
		$model = new Table_PersonItem();
		return $model->add($row);
	}

	/*
	 * Update One Row
	 *
	 * @param $row rowSet
	 * @param $pim_id int
	 * @return boolean
	 */
	public static function update($row, $value , $field = "pim_id")
	{
		$model = new Table_PersonItem();
		return $model->update($row, $value,$field);
	}

	public static function delete($value , $field = "pim_id")
	{
		$model = new Table_PersonItem();
		return $model->delete($value,$field);
	}

	public static function getByField($value, $field = 'pim_id', $colums = "*")
	{
		$model = new Table_PersonItem();
		return $model->getByField($value, $field, $colums);
	}
	public static function getByFieldLock($value, $field = 'pim_id', $colums = "*")
	{
		$model = new Table_PersonItem();
		return $model->getByFieldLock($value, $field, $colums);
	}
	public static function getAll()
	{
		$model = new Table_PersonItem();
		return $model->getAll();
	}
	public static function getByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = "")
	{
		$model = new Table_PersonItem();
		$rows = $model->getByCondition($condition, $type, $pageSize, $page, $order);
		return $rows;
	}
	public static function getByWhere($where, $colums = "*")
    {
        $model = new Table_PersonItem();
        return $model->getByWhere($where, $colums);
    }
    public static function getGroupByCondition($condition=array(), $field= 'status')
    {
        $model = new Table_PersonItem();
        $rows = $model->getGroupByCondition($condition, $field);
        return $rows;
    }

    public static function getByIdForUpdate($id){
        $model = new Table_PersonItem();
        return $model->getByIdForUpdate($id);
    }

    public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = new Table_PersonItem();
        return $model->getByStatus($status, $pageSize , $minId);
    }

  	public static function getInterceptByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = '') {
		$model = new Table_PersonItem();
		$rows  = $model->getInterceptByCondition($condition, $type, $pageSize, $page, $order);
		return $rows;
	}

	public static function getRowByCondition($condition, $type = '*')
	{
		$model = new Table_PersonItem();
		return $model->getRowByCondition($condition, $type);
	}
	/**
	 * 计算订单的重量
	 * @author solar
	 * @param string $order_code
	 * @return number
	 */
	public static function calculateWeight($order_code) {
		$model = new Table_PersonItem();
		return $model->calculateWeight($order_code);
	}

	/**
	 * 状态统计
	 * @author solar
	 * @param int $customer_id
	 * @param int $model_type
	 * @param int $warehouse_id
	 */
	public static function stat($customer_id, $model_type, $warehouse_id) {
		$model = new Table_PersonItem();
		return $model->stat($customer_id, $model_type, $warehouse_id);
	}

    public static function getJionOrderOperationTimeByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = ""){
        $model = new Table_PersonItem();
        return $model->getJionOrderOperationTimeByCondition($condition, $type, $pageSize, $page, $order);
    }

    public static function getLeftJoinAllByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = "") {
        $model = new Table_PersonItem();
        return $model->getLeftJoinAllByCondition($condition, $type, $pageSize, $page, $order);
    }
    
    public static function getByCiqStatus($customsStatusArr, $status, $pageSize, $minId){
        $model = new Table_PersonItem();
        return $model->getByCiqStatus($customsStatusArr, $status, $pageSize, $minId);
    }

    public static function getByConditionLock($condition, $type, $pageSize, $page, $order){
        $model = new Table_PersonItem();
        return $model->getByConditionLock($condition, $type, $pageSize, $page, $order);
    }
}
