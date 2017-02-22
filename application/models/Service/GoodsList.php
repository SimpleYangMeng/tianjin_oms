<?php
class Service_GoodsList {
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
            self::$_modelClass = new Table_GoodsList();
        }
        return self::$_modelClass;
    }

    /**
     * 个人物品清单状态
     * @param  boolean $code [description]
     * @return [type]        [description]
     */
    public static function getStatus($code = false)
    {

        $status = array(
            0 => "已关联",
            1 => "对比异常",
            2 => "待审核",
            3 => "审核中",
            4 => "已审核",
            5 => "审核退单",
            6 => "布控"
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
		$model = self::getModelInstance();
		return $model->add($row);
	}

	/*
	 * Update One Row
	 *
	 * @param $row rowSet
	 * @param $pim_id int
	 * @return boolean
	 */
	public static function update($row, $value , $field = "gl_id")
	{
		$model = self::getModelInstance();
		return $model->update($row, $value,$field);
	}

	public static function delete($value , $field = "gl_id")
	{
		$model = self::getModelInstance();
		return $model->delete($value,$field);
	}

	public static function getByField($value, $field = 'gl_id', $columns = "*")
	{
		$model = self::getModelInstance();
		return $model->getByField($value, $field, $columns);
	}
    /**
     * [getByStatus 根据状态返回数据]
     * @param  [type]  $status   [description]
     * @param  integer $pageSize [description]
     * @param  integer $minId    [description]
     * @return [type]            [description]
     */
    public static function getByStatus($status, $pageSize = 0 , $minId = 0){
        $model = self::getModelInstance();
        return $model->getByStatus($status, $pageSize , $minId);
    }
    
	public static function getByCondition($condition = array (), $type = '*', $pageSize = 0, $page = 1, $order = "")
	{
		$model = self::getModelInstance();
		$rows = $model->getByCondition($condition, $type, $pageSize, $page, $order);
		return $rows;
	}

    /**
     * @param array $params
     * @return array
     */
    public  function getFields()
    {
        $row = array(
            'E0'=>'gl_id',
            'E1'=>'gl_code',
            'E2'=>'gl_reference_no',
            'E3'=>'form_type',
            'E4'=>'customer_code',
            'E5'=>'enp_name',
            'E6'=>'wb_code',
            'E7'=>'log_no',
            'E8'=>'logistic_customer_code',
            'E9'=>'account_code',
            'E10'=>'pay_customer_code',
            'E11'=>'po_code',
            'E12'=>'pay_no',
            'E13'=>'storage_customer_code',
            'E14'=>'storage_name',
            'E15'=>'agent_customer_code',
            'E16'=>'agent_name',
            'E17'=>'warehouse_id',
            'E18'=>'order_code',
            'E19'=>'order_reference_no',
            'E20'=>'status',
            'E21'=>'exit_time',
            'E22'=>'declare_time',
            'E23'=>'ie_port',
            'E24'=>'declare_ie_port',
            'E25'=>'traf_mode',
            'E26'=>'wrap_type',
            'E27'=>'ship_name',
            'E28'=>'ship_city',
            'E29'=>'ship_trade_country_id',
            'E30'=>'aim_country_id',
            'E31'=>'outset_country_id',
            'E32'=>'receive_name',
            'E33'=>'receive_state',
            'E34'=>'receive_country_id',
            'E35'=>'receiving_address',
            'E36'=>'receive_city',
            'E37'=>'receive_id_number',
            'E38'=>'receive_telphone',
            'E39'=>'input_company',
            'E40'=>'declare_no',
            'E41'=>'agent_address',
            'E42'=>'agent_post',
            'E43'=>'agent_tel',
            'E44'=>'freight',
            'E45'=>'insure_fee',
            'E46'=>'customs_field',
            'E47'=>'net_wt',
            'E48'=>'gross_wt',
            'E49'=>'input_no',
            'E50'=>'pack_no',
            'E51'=>'i_e_date',
            'E52'=>'input_date',
            'E53'=>'declare_date',
            'E54'=>'note',
            'E55'=>'gl_add_time',
            'E56'=>'gl_update_time',
        );
        return $row;
    }
}
