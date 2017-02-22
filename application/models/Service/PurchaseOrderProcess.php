<?php
class Service_PurchaseOrderProcess
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



	public static function getPurchaseOrderStatus(){
		$status['-1'] = Ec_Lang::getInstance()->getTranslate('CloseStatus');//'关闭';
		$status['1'] = Ec_Lang::getInstance()->getTranslate('CommonStatus');//'正常';		
		return $status;
	}


	public static function getPurchaseOrderStatusText($status){
		$status_array = self::getPurchaseOrderStatus();		
		return 	$status_array[$status];	
	}
	


	public static function getStatus(){
		$status['-1'] = Ec_Lang::getInstance()->getTranslate('CloseStatus');//'关闭';
		$status['1'] = Ec_Lang::getInstance()->getTranslate('CommonStatus');//'正常';
		
		
		return $status;
	}
	
	public static function getStatusText($status=0){
		$status_array = self::getStatus();
		return 	$status_array[$status];	
	
	}
   
	
    public static $applicationType = array(
        1 => 'avrived',
        2 => 'receive',
        3 => 'putaway',
    );



    
    public function __construct()
    {
        
        $this->_date = date('Y-m-d H:i:s');
    }
    

    /**
     * @author colinyang
     * @todo 创建一条新的采购单
     * @param
     * @return array('ask' => 0, 'msg' => '','Error'=>array(array('errorCode'=>'','errorMessage')), 'ASNCode' => '');
     */
    public static function  createTransaction($data)
    {
        $result = array('ask' => 0, 'msg' => '', 'error' => array(), 'ASNCode' => '');

        $error = self::validate($data);
		
        //var_dump($error);
        //exit('cccnnn');
        if(!empty($error)){
        	$result['error'] = $error;
        	return $result;
        }
        //exit('fff00sssf');
        try {
            $DB = Common_Common::getAdapter();
            $DB->beginTransaction();
            $date = date('Y-m-d H:i:s');
           
		    $po_row = array();
            $po_row['po_code']	= $data['po_code'];
            $po_row['customer_id'] 		= $data['customer_id'];
			$po_row['supply_code'] 		= $data['supply_code'];
            $po_row['po_description']= $data['po_description'];
			$po_row['po_status']= '1';
			$po_row['create_time']= $date;
			$po_row['update_time']= $date;
            $po_id = Service_PurchaseOrder::add($po_row);
            $product_sku = $data['product_sku'];
            $sku =  $data['sku'];
          
            foreach ($product_sku as $k=>$v) {
                $productList = Service_Product::getByCondition(array('product_sku'=>$v,'customer_id'=>$data['customer_id']),"*");
                $product = $productList[0];                
                if(empty($product)){ continue;}
					$po_detail = array(
							'po_id'=> $po_id,
							'product_id'=>$product['product_id'],													
							'order_quantity'=>trim($sku[$k]),
							'pobd_status'=>'1'
					);
					
					if(!Service_PurchaseOrderBody::add($po_detail)){
						throw new Exception(Ec_Lang::getInstance()->getTranslate('AddPurchaseOrderDetailsFail'));
					}
            	
            }        
            
	        $result['ask']='1';
            $result['msg'] = "采购单[{$po_row['po_code']}]创建成功."; //'ASN创建成功';
            $result['po_code'] = $po_row['po_code'];
			
            $DB->commit();
        }  catch (Exception $e) {
            $DB->rollBack();
            $result['error'][] = $e->getMessage();
            $result['msg'] = $e->getMessage();
            return $result;
        }
        return $result;    
    }
	
  

    /*
    * 更新 ASN 信息（备货模式）
    * @param $order ASN ,$item ASN产品 ,$customerId 客户ID 
    * @return array('ask' => 0, 'msg' => '', 'Error'=>array(),'ASNCode' => '');
    */
    public function updateTransaction($data,$customerId = '', $warehouseId = '')
    {
        $result = array('ask' => 0, 'msg' => '', 'error' => array(), 'ASNCode' => '');
		$data['customerId'] = $customerId;
        $error = self::validate($data);
        //var_dump($error);
        //exit('cccnnn');
        if(!empty($error)){
        	$result['error'] = $error;
        	return $result;
        }
        //print_r($data);var_dump($data['haveconta']=='1');exit;
        $date = date('Y-m-d H:i:s');
        try {
            if (isset($order['ref_id'])) {
                unset($order['ref_id']);
            }
            $DB = Common_Common::getAdapter();
            $DB->beginTransaction();
            //var_dump($customerId);
            
            if ($customerId) {
            	$this->setCustomer($customerId);
            }
            //var_dump($this->_customerInfo);
            $ASNCode = $data['ASNCode'];
            if (empty($ASNCode)) {
                throw new Exception('ASNCode '.Ec_Lang::getInstance()->getTranslate('DoesNotExist'));
            }
            $asnRows = Service_Receiving::getByCondition(array('receiving_code' => $ASNCode, 'customer_id' => $this->_customerId), '*');
            $this->_receiving = $asnRows[0];
            $this->_warehouseId = $asnRows[0]['warehouse_id'];
            if (empty($asnRows)) {
                throw new Exception('ASNCode:' . $ASNCode . ' can not be found.', 20013);
            }
            $ASNRow = $asnRows[0];
            if (!in_array($ASNRow['receiving_status'], array('1')) || (isset($order['receiving_status']) && !in_array($ASNRow['receiving_status'], array('0', '1')))) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('CanNotBeModified').",ASNCode:" . $ASNCode . " ".Ec_Lang::getInstance()->getTranslate('StateDoesNotAllow'));
            }
            if (isset($data['warehouse_id']) && $data['warehouse_id'] == '') {
                throw new Exception("AsnCode:".Ec_Lang::getInstance()->getTranslate('WarehousingDoesNotExist').'.', 20007);
            }

            $warehouseAll = Common_DataCache::getWareHouse();
            if (isset($order['warehouse_id']) && !isset($warehouseAll[$order['warehouse_id']])) {
                throw new Exception(Ec_Lang::getInstance()->getTranslate('WarehousingDoesNotExist').".");
            }

            $order['modified'] = $date;
            
            //$receiving['receiving_code']	= $ASNCode;
            $receiving['reference_no'] 		= $data['ref_code'];
            //$receiving['warehouse_id']		= $warehouseId;
            //$receiving['customer_id']		= $customerId;
            //$receiving['customer_code'] 	= $this->_customerInfo['customer_code'];
            //$receiving['receiving_type']	= isset($data['receiving_type'])?$data['receiving_type']:'0';
            //$receiving['receiving_add_time']= $date;
            $receiving['receiving_update_time'] = $date;
            $receiving['is_delivery']		= $data['is_delivery'];

            //以下新增的内容
            //$receiving['refercence_form_id']= $data['refercence_form_id'];
            $receiving['ie_port']			= $data['ie_port'];
            $receiving['form_type']			= $data['form_type'];
            $receiving['traf_name']			= $data['traf_name'];
            $receiving['wrap_type']			= $data['wrap_type'];
            $receiving['pack_no']			= $data['pack_no'];
            $receiving['traf_mode']			= $data['traf_mode'];
            $receiving['trade_mode']		= $data['trade_mode'];
            $receiving['trans_mode']		= $data['trans_mode'];
            $receiving['roughweight']		= $data['roughweight'];
            $receiving['netweight']			= $data['netweight'];
            if($data['haveconta']=='1'){
            	$receiving['haveconta'] 		= '1';
            	$receiving['conta_id']			= $data['conta_id'];
            	$receiving['conta_model']		= $data['conta_model'];
            	$receiving['conta_wt']			= $data['conta_wt'];
            }else{
            	$receiving['haveconta']			= '0';
            	$receiving['conta_id']			= '';
            	$receiving['conta_model']		= '';
            	$receiving['conta_wt']			= '0';
            }
            $receiving['receiving_description'] = $data['instructions'];
            $receiving['receiving_update_time'] = date("Y-m-d H:i:s");
            
            Service_Receiving::update($receiving, $ASNCode, 'receiving_code');
            $note = 'update';

            $session = new Zend_Session_Namespace('customerAuth');
            $sessionData = $session->data;
            $customerCode = $sessionData['code'];
            
            if(isset($data['product_sku'])){
            	$product_sku = $data['product_sku'];
            	$sku =  $data['sku'];
            	
            	$haveDeclare = false;
            	if(isset($data['declared_value'])){
            		$haveDeclare=true;
            		$declare =$data['declared_value'];
            	}
            	Service_ReceivingDetail::delete($ASNCode, 'receiving_code');
            	foreach ($product_sku as $k=>$v) {
            		//$product = Service_Product::getByField($v,'product_sku');
            		$productList = Service_Product::getByCondition(array('product_sku'=>$v,'customer_code'=>$customerCode),"*");
            		//$product = Service_Product::getByField($v,'product_sku');
            		$product = $productList[0];
            		
            		if($haveDeclare){
            			$declare_vale = $declare[$k];
            		}else{
            			$declare_vale = $product['product_declared_value'];
            		}
            		$receivingDetail = array(
            				'receiving_id'=>$ASNRow['receiving_id'],
            				'receiving_code'=>$ASNCode,
            				'rd_status'=>'0',
            				'product_id'=>$product['product_id'],
            				'product_barcode'=>$product['product_barcode'],
            				'op_declared_value'=>trim($declare_vale),
            				'rd_receiving_qty'=>trim($sku[$k]),
            				'rd_add_time'=>$date
            		);
            		$receivingDetailArr[] = $receivingDetail;
            		if(!Service_ReceivingDetail::add($receivingDetail)){
            			throw new Exception(Ec_Lang::getInstance()->getTranslate('AddASNDetailsFail'));
            		}
            	}
            	foreach ($receivingDetailArr as $val) {
            		$productRow = Service_Product::getByField($val['product_id'], 'product_id', array('product_sku'));
            		$note .= ' sku:' . $productRow['product_sku'] . ' quantity:' . $val['rd_receiving_qty'] . ' ';
            	}
            	$ASNLog = array(
            			'receiving_id'=>$ASNRow['receiving_id'],
            			'receiving_code' => $ASNCode,
            			'user_id'=>'-1',
            			'customer_code' => $this->_customerInfo['customer_code'],
            			'rl_note' => $note,
                        'rl_status_from'=>$ASNRow['receiving_status'],
                        'rl_status_to'=>$ASNRow['receiving_status'],
            			//'rl_add_time'=>date("Y-m-d H:i:s"),
            			//'rl_ip'=>Common_Common::getIP()
            	);
            	//print_r($ASNLog);
            	self::createAsnLog($ASNLog);
            }
            //$DB->rollBack();
            $DB->commit();
            return array('ask' => 1, 'msg' => "收货订单[{$ASNCode}]".Ec_Lang::getInstance()->getTranslate('update').Ec_Lang::getInstance()->getTranslate('success').'.', 'error' => array(), 'ASNCode' => $ASNCode);
        } catch (Zend_Exception $e) {
            $DB->rollBack();
            $result['error'][] = $e->getInternalError();
            $result['msg'] = $e->getInternalError();
            return $result;
        } catch (Exception $e) {
            $DB->rollBack();
            $result['error'][] = $e->getMessage();
            $result['msg'] = $e->getMessage();
            return $result;
        }
    }
	
  




    /**
     * @author william-fan
     * @todo 备货表单数据验证
     * @param array $data
     * @return array('ask' => 0, 'msg' => array(), 'data' => array());
     */
    public static function validate($data = array())
    {
    	$error = array();
        if (empty($data)) {
        	$error[]=Ec_Lang::getInstance()->getTranslate('DataError');//'数据出错';
        	return $error;
        }
		if(!in_array($data['action'],array('create','update'))){
        	$error[]=Ec_Lang::getInstance()->getTranslate('DataError');//'数据出错';
        	return $error;		
		}
		
		
	  	$total_weight = 0;
	 	if(isset($data['sku']) && !empty($data['sku']) ) {
        	$product_sku_array = $data['product_sku'];
			$number_array = $data['sku'];
        	foreach ($number_array as $k=>$number) {
        			$number = trim($number);
					$product = Service_Product::getByField($k,'product_id');
					if(empty($product)){
						$error[] = Ec_Lang::getInstance()->getTranslate('product_not_exist');
						continue;
					}else{						
						 if($product['product_type']!='0'){
						 	$error[] = Ec_Lang::getInstance()->getTranslate('can_not_combine_product');
							continue;							
						 }
						 
						 if($product['product_status']!='1'){
						 	$error[] =  vsprintf(Ec_Lang::getInstance()->getTranslate('product_no_record'),array($product['product_sku']))  ;
							continue;							
						 }						 
						 
					}					
					$sku = $product_sku_array[$k];
        			if(!(preg_match('/^[0-9]+$/i',$number) && is_numeric($number) && $number>0)){
        				$error[] = "产品SKU[{$sku}]".Ec_Lang::getInstance()->getTranslate('NumberMustBeAnInteger');
        			}
        	}
        }else{
			$error[] = Ec_Lang::getInstance()->getTranslate('ProductsMusBeSelected');
		}
		
		
		
        if ("" == $data['po_code']) {
        	$error[] = Ec_Lang::getInstance()->getTranslate('purchase_order_code_required');//采购单号必填
        }else{
		
			 if($data['action']=='create'){
					$condition = array('po_code'=>$data['po_code']);
					$po_orders = Service_PurchaseOrder::getByCondition($condition,'po_code');
					if($po_orders){
						$error[] = Ec_Lang::getInstance()->getTranslate('purchase_order_code_exist'); //采购单号已经存在;
					}		 
			 }	
			 	
			 if($data['action']=='update' && $data['po_id']){
					$condition = array('po_code'=>$data['po_code']);
					$po_orders = Service_PurchaseOrder::getByCondition($condition);
					if($po_orders){
						foreach($po_orders as $po_order){
								if($po_order['po_id']!=$data['po_id']){								
									$error[] = Ec_Lang::getInstance()->getTranslate('purchase_order_code_exist'); //采购单号已经存在;
								}
						}
						
					}		 
			 }		
		
		}
		
		
        if($data['supply_code']==''){
        	$error[] = Ec_Lang::getInstance()->getTranslate('supplier_code_required');//'进出口口岸必填';
        }else{
		     $supplies = Service_Distributor::getByCondition(array('customer_code'=>$data['customer_code'],'distributor_code'=>$data['supply_code']));
			 if(empty($supplies)){			 	
			 	$error[] = Ec_Lang::getInstance()->getTranslate('supplier_code_not_exists');//'进出口口岸必填';
			 }
		}      
       
		 	
    	
        
	


		return $error;
    }
	
	
	
	//关闭采购单项目 colin
	public static function ClosePurchaseOrderItem($customer_id,$pobd_id){
	
				$return = array('ask' => 0, 'message' =>'关闭采购单失败','error'=>'');				
				if(empty($pobd_id)){
					$return['message'] =  '系统错误:采购单项ID必须传递';
					return $return;	
				}
				
				$condition = array();
				$condition['pobd_id'] = $pobd_id;
				$condition['customer_id'] = $customer_id;
				$purchase_order_bodys = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition($condition);
				if(empty($purchase_order_bodys)){
					$return['message'] =  '系统错误:找不到对应采购单项';
				}else{				
					$purchase_order_body = $purchase_order_bodys[0];	
					if($purchase_order_body['pobd_status']=='-1'){
						$return['message'] =  '此采购单项购已经是关闭状态，不能重复关闭';	
						return $return;				
					}else{		
								$row = array();
								$row['pobd_status']='-1';															
								$status = Service_PurchaseOrderBody::update($row,$pobd_id,"pobd_id");
								if($status===false){
									$return['message'] =  '系统错误:采购单项更新失败';
								}else{
									$return['ask'] = '1';						
									$return['message'] =  '采购单项关闭成功';
								}
					
					}
							
				}
				
				return $return;
	
	
	
	}
	
	

}

?>