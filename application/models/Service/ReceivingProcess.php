<?php
class Service_ReceivingProcess
{
    protected $_asnCode = null;
    protected $_receiving = array();
    protected $_receivingItem = array();
    protected $_asnDetail = array();
    protected $_errorArr = array();
    protected $_params = array();
    protected $_warehouseId = 0;
    protected $_date = '';

    //收货类型
    public static $_asnType = array(
        0 => 'Normal',
        1 => 'Refund',
        2 => 'Reject',
    );

    //状态
    public static $_asnStatus = array(
        0 => 'delete',
        1 => 'Awaiting',
        2 => 'Receiving',
        3 => 'Received',
        4 => 'Abnormal',
    );

    //asnDetail状态
    public static $_asnDetailStatus = array(
        0 => 'Awaiting',
        1 => 'Receiving',
        2 => 'Received',
    );

    public function __construct()
    {
        $this->_date = date('Y-m-d H:i:s');
    }
	
	public static function  getStatusText($status){
			$all_status_array = self::getAllStatus();
			return $all_status_array[$status];
	
	}
	public static function getAllStatus(){	
		$status_array = array();
		$status_array['0'] = "删除";
		$status_array['1'] = "草稿";
		$status_array['2'] = "确认";
		$status_array['3'] = "待审核";
		$status_array['4'] = "审核";
		$status_array['5'] = "在途";
		$status_array['6'] = "收货中";
		$status_array['7'] = "收货完成";
		return $status_array;
	
	}



}