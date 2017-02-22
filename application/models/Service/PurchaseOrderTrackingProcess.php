<?php
class Service_PurchaseOrderTrackingProcess
{
    protected $_orderCode = null;
    protected $_products = null;
    protected $_customerId = null;
    protected $_customerInfo = null;
    protected $_warehouseId = null;
    protected $_error;
    protected $_pro;
    protected $_receiving = array();
    protected $_date = '';

	public static function getStatus(){
		$status['0'] = Ec_Lang::getInstance()->getTranslate('PendingAudit');//'已审核';
		$status['1'] = Ec_Lang::getInstance()->getTranslate('Audited');//'草稿';
		
		return $status;
	}
	
	public static function getStatusText($status=0){
		$status_array = self::getStatus();
		return 	$status_array[$status];	
	
	}
	    
    public function __construct()
    {
        
        $this->_date = date('Y-m-d H:i:s');
    }
    

   

}

?>