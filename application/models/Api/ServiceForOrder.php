<?php
class Api_ServiceForOrder {

 protected $_customerId = null;
    
    protected $_customer = null;

    protected $_token = null;

    protected $_key = null;

    protected $_auth = false;

    protected $_error = null;    

    protected $_date = null;

    protected $_paramterArr = array();//将传递过来的对象转为数组存储
    

    private function _init ($headerRequest) {
        set_time_limit(60);
        ini_set('memory_limit', '512M');
        $this->_customerId = (string) $headerRequest['customerCode'];
        $this->_token = (string) $headerRequest['appToken'];
        $this->_key = (string) $headerRequest['appKey'];
    }
    /**
     * @author william-fan
     * @todo Authenticate
     */
	private function authenticate(){
        $customer = Service_Customer::getByField($this->_customerId, 'customer_code');
        if (! $customer || $customer['customer_status'] != 2) {
            $this->_error = 'No Authority For ' . $this->_customerId . '.';
            return false;
        }
        $this->_customer = $customer;
        $customerAuth = Service_CustomerApi::getByField($this->_customerId, 'customer_code');
        //file_put_contents('token.txt', $this->_token);
        
        //file_put_contents('authenticate.txt', var_export($customerAuth,true).$this->_customerId.$this->_token.'>>>>'. $this->_key);
        // return true;
        if ($customerAuth && $customerAuth['ca_token'] == $this->_token && $customerAuth['ca_key'] == $this->_key) {
            $this->_auth = true;
            return true;
        }
        $this->_error = 'App Token/App Key Not match for ' . $this->_customerId . '.';
        return false;
    }
	/**
	 * @todo 写日志
	 */
    private function logError ($error) {
        $logger = new Zend_Log();
        $uploadDir = APPLICATION_PATH . "/../data/log/";
        $writer = new Zend_Log_Writer_Stream($uploadDir . 'api-order.log');
        $logger->addWriter($writer);
        $logger->info(date('Y-m-d H:i:s') . ': ' . $error . " \n");
    }
    
	/**
	 * @author william-fan
	 * @todo 对wsdl 自动将多维数组转为一维数组的处理
	 */
    private function multiArr ($arr) {
        $return = array();
        if(is_array($arr)){
            $isMulti = true;
            foreach($arr as $k=>$v){
                if(!is_int($k)){
                    $isMulti = false;
                }
            }
            if(!$isMulti){
                $return[] = $arr;
            }else{
                $return = $arr;
            }             
        }else if(is_string($arr)){
            $return[] = $arr;
        }
        return $return;
    }
    
    /**
     * @author william-fam
     * @todo 公共方法
     */ 
    private function common ($paramter) {
		// var_dump($paramter);exit;
        // 对象转数组
        $this->_paramterArr = Common_Common::objectToArray($paramter);//对象转数组 
        $headRequest = $this->_paramterArr['HeaderRequest'];
        $this->_init($headRequest);
        //print_r($this->_paramterArr);
        //$this->_token = $this->_paramterArr['appToken'];
        //file_put_contents('error002.txt', '00000221'.$this->_token.var_export($this->_paramterArr,true));
        $this->_date = date('Y-m-d H:i:s');
        //file_put_contents('common.txt', '00000221'.$this->_token.var_export($this->_paramterArr,true));
        
        $this->authenticate();
        /* exit;
        file_put_contents('error003.txt', '0000020000555'.var_export($this->_paramterArr,true));return; */
    }

  /**
   * 根据订单号或交易订单号获取行邮税
   */
  public function getTaxByCode($params) {
    $response = array('ask' => 0, 'message' => '');

    $this->common($params);

    if ($this->_error) {
      $response['message'] = $this->_error;

      return $response;
    }

    $orderCode = trim($this->_paramterArr['orderCode']);

    if ('' === $orderCode) {
      $response['message'] = '订单号或交易订单号不能为空';

      return $response;
    }

    $order = Service_Orders::getByCondition(array(
      'orderCode_or_referenceNo' => $orderCode,
      'customer_id'              => $this->_customer['customer_id'],
    ));

    if (empty($order)) {
      $response['message'] = '订单号或交易订单号[' . $orderCode . ']不存在';

      return $response;
    }

    $order  = $order[0];
    $detail = Service_ImportTax::detail($order['order_code']);

    if (0 === $detail['status']) {
      $response['message'] = '订单号或交易订单号[' . $orderCode . ']' . $detail['message'];

      return $response;
    }

    $response['ask']     = 1;
    $response['message'] = '订单行邮税相关信息已返回';
    $response['data']    = array(
      'orderCode'   => $order['order_code'],
      'referenceNo' => $order['reference_no'],
      'orderStatus' => $order['order_status'],
      'taxPrice'    => $detail['taxPrice'],
      'skuDetail'   => $detail['skuDetail'],
    );

    return $response;
  }

    /**
     * @author william-fan
     * @todo 用于创建订单
     */
    public function createOrder($paramter){
    	$this->common($paramter);
        $result = array(
                'ask' => '0',
                'message' => '',
                'orderCode' => '',
                'error' => array(),
        );
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
        $orderInfo = $this->_paramterArr['OrderInfo'];
        $paramOrder = $orderInfo; //订单原来传递的参数
        $orderInfo = $this->transParam($orderInfo);
        $status = '1';
        if(isset($orderInfo) && $orderInfo['orderStatus']){
        	$status = $orderInfo['orderStatus'];
        }
        //$status = $orderInfo['orderStatus'];
        $orderInfo=Api_OrderCheck::TransformData($orderInfo, $this->_customer);
        if($orderInfo['is_valid']=='0'){
			$result['error'] = Common_TransError::Transerror($orderInfo['error']);        	
        	$result['message']='创建订单失败';
          $result['orderCode'] = isset($orderInfo['existed_order_code']) ? $orderInfo['existed_order_code'] : '';
        	return $result;
        }
        $process = new Service_OrderProcess();
        if($paramOrder['orderModel']=='1'){
        	//集货模式的订单创建
        	$doresult = $process->createjhOrderTransaction($orderInfo);
        }else{
        	//备货模式的订单创建
        	$doresult = $process->createOrderTransaction($orderInfo);
        }
        

        if($doresult['ask']=='1'){
        	$result['ask'] = '1';
        	$result['message'] = $doresult['message'];
        	$result['orderCode'] = $doresult['ordersCode'];
        	//更新状态
        	if(!in_array($status, array(1,2,4))){//不再允许更新的状态之内
        		$result['ask'] = '1';
        		$result['message'] = $result['message'].';移动状态失败状态不允许';
        		$result['error'] = Common_TransError::Transerror(array('订单状态移动失败,状态不允许'));
        		return $result;
        	}else{//更新状态
        		if($status=='2'){
        			//确认确认
        			$moveresult=$process->confirm($result['orderCode'],$this->_customer['customer_id']);
        			if($moveresult['ask']=='0'){
        				$result['message'] = $result['message'].';移至确认失败';
        				$result['error'] = Common_TransError::Transerror($moveresult['error']);
        			}else{
        				$result['message'] = $result['message'].';移至确认成功';
        			}
        		}elseif($status=='4'){
        			//先确认订单 ，然后提交订单
        			$moveresult=$process->confirm($result['orderCode'],$this->_customer['customer_id']);
        			if($moveresult['ask']=='0'){
        				$result['message'] = $result['message'].';移至确认失败';
        				$result['error'] = Common_TransError::Transerror($moveresult['error']);
        			}else{
        				$result['message'] = $result['message'].';移至确认成功';
        				//确认成功 然后 提交订单
        				$moveresult=$process->submit($result['orderCode'],$this->_customer['customer_id']);
        				if($moveresult['result']=='0'){
        					$result['message'] = $result['message'].';移至已提交失败';
        					$result['error'] = Common_TransError::Transerror($moveresult['error']);
        				}else{
        					//提交
        					$result['message'] = $result['message'].';移至已提交成功';
        				}
        			}
        		}else{
        			
        		}
        		
        		/* $return1 = $process->submit($return['ordersCode'], $status);
        		$result['message'] = $return1['message'];
        		if(!$return1['ask']){//状态更新失败
        			$result['ask'] = 'SuccessWithWarning';
        			return $result;
        		} */
        	}
        }else{
        	$result['message'] = $doresult['message'];
        	$result['error'] = Common_TransError::Transerror($doresult['error']);
        }
        //var_dump($result);
        return $result;
    }
    /**
     * @author william-fan
     * @todo 更新单个订单
     */
    public function updateOrder($paramter){
    	$this->common($paramter);
    	$result = array(
            'ask' => '0',
            'message' => '',
            'orderCode' => '',
            'error' => array(),
        );
    	if ($this->_error) {
    		$result['message'] = $this->_error;
    		return $result;
    	}
    	$orderInfo = $this->_paramterArr['OrderInfo'];
    	//print_r($orderInfo);exit;
    	/* echo "原始参数：";
    	print_r($orderInfo); */
    	$ordersCode = $orderInfo['orderCode'];
    	$result['orderCode'] = $ordersCode;
    	if(empty($ordersCode)){
    		$this->_error = '订单号不能为空 ';
    		$result['message'] = $this->_error;
    		return $result;
    	}
        
    	$order = Service_Orders::getOrderAllInfo($ordersCode, $this->_customer['customer_id']);
    	if(empty($order)){
    		$this->_error = '订单不存在 '.$ordersCode;
    		$result['message'] = $this->_error;
    		return $result;
    	}

        
    	//updateTransParam
    	$transOrder = $this->updateTransParam($orderInfo, $order);
    	/* echo "转换参数";
    	print_r($transOrder);exit; */
    	
    	$orderInfo=Api_OrderCheck::TransformData($transOrder, $this->_customer);
    	if($orderInfo['is_valid']=='0'){
    		$result['error'] = Common_TransError::Transerror($orderInfo['error']);
    		$result['message']='更新失败';
    		return $result;
    	}
    	$process = new Service_OrderProcess();
    	if($order['order_mode_type']=='0'){
    		//备货模式订单更新
    		$doresult = $process->updateOrderTransaction($orderInfo, $ordersCode,$this->_customer['customer_id']);
    		$result['message'] = $doresult['message'];
    		$result['error']=Common_TransError::Transerror($doresult['error']);
    	}elseif($order['order_mode_type']=='1'){
    		//集货模式订单更新
    		$doresult = $process->updatejhOrderTransaction($orderInfo, $ordersCode,$this->_customer['customer_id']);
    		$result['message'] = $doresult['message'];
    		$result['error'] = Common_TransError::Transerror($doresult['error']);
    	}else{
    		$result['message'] = '订单模型未知';
    	}
    	return $result;
    }
    /**
     * @author william-fan
     * @todo 更新订单状态
     */
 	public function updateOrderStatus($paramter) {

        $this->common($paramter);
        $result = array(
                'ask' => '0',
                'message' => '更新订单状态失败',
                'error' => array(),
        );

        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
        
        $ordersCode = $this->_paramterArr['orderCode'];
        //$result['orderCode'] = $ordersCode;

        if (empty($ordersCode)) {
            $this->_error = '订单号不能为空';
            $result['message'] = $this->_error;
            return $result;
        }
        $order = Service_Orders::getByField($ordersCode, 'order_code');
        if (empty($order)) {
            $this->_error = '订单不存在-->' . $ordersCode;
            $result['message'] = $this->_error;
            return $result;
        }
        //$process = new Api_ServiceForOrder();
        
        $status = $this->_paramterArr['orderStatus'];
        $remark = trim($this->_paramterArr['remark']);

        if (-1 == $status) {
          $doresult = $this->updateOrderStatusProcess($status, array('order_code' => $order['order_code'], 'intercept_reason' => $remark));
        }
        else {
          $doresult = $this->updateOrderStatusProcess($status, $order);
        }
        if($doresult['ask']=='1'){
        	$result['ask'] = 1;
        	$result['message'] = $doresult['message'];
        }else{
        	$result['message'] = $doresult['message'];
        	$result['error'] = Common_TransError::Transerror($doresult['error']);
        }
        return $result;
    }
    /**
     * @author william-fan
     * @todo 用于批量订单状态更新处理
     */
    private function updateOrderStatusProcess($status,$orderInfo){
    	$result = array(
                'ask' => '0',
                'message' => '',
                'error' => array(),
        );
    	$process = new Service_OrderProcess();
    	switch($status){
    		case "-1":
    			$result=$process->interceptTranslate($orderInfo,$this->_customer['customer_id']);
    			break;
    		case "0":
    			$result=$process->deleteTranslate($orderInfo['order_code'],$this->_customer['customer_id'],TRUE);
    			break;
    		case "1":
    			if($orderInfo['order_status']!='2'){
    				$result['message'] = '订单状态不允许直接移到草稿状态';
    			}else{
    				$result=$process->draftTranslate($orderInfo['order_code'],$this->_customer['customer_id']);
    			}
    			break;
    		case "2":
    			var_dump($orderInfo['order_status']);
    			if($orderInfo['order_status']=='1'){
    				$result=$process->confirm($orderInfo['order_code'],$this->_customer['customer_id']);
    			}else{
    				$result['message'] = '订单状态不允许到已确认';
    			}
    			break;
    		case "4":
    			if($orderInfo['order_status']=='2'){
    				$result=$process->submit($orderInfo['order_code'],$this->_customer['customer_id']);
    			}else{
    				$result['message'] = '订单状态不允许到已确认';
    			}
    			break;
    		default:
    			$result['message'] = '状态错误';
    			break;				
    	}
    	$result['error'] = Common_TransError::Transerror($result['error']);
    	return $result;
    }
    /**
     * @author william-fan
     * @todo 查询单个订单
     */
    public function getOrderByCode($paramter) {
    	$this->common($paramter);
    	$result = array(
    			'ask' => '1',
    			'Data' => array(),
    			'Error' => array()
    	);
    	if ($this->_error) {
    		$result['message'] = $this->_error;
    		return $result;
    	}
    
    	$ordersCode = $this->_paramterArr['orderCode'];
    	//$detailLevel = $this->_paramterArr['detailLevel'];
    	 
    	if (empty($ordersCode)) {
    		$this->_error= '订单号不能为空';
    		$result['ask'] = '0';
    		$result['Error'] = Common_TransError::Transerror(array($this->_error));
        unset($result['Data']);
    		return $result;
    	}
        $condition = array(
            'orderCode_or_referenceNo'=>$ordersCode,
            'customer_id'=>$this->_customer['customer_id']
        );
        $order = Service_Orders::getByCondition($condition,"*");
    	//$order = Service_Orders::getOrderAllInfo($ordersCode, $this->_customer['customer_id']);
    	if (empty($order)) {
    		$this->_error= '订单不存在 ' . $ordersCode;
    		$result['ask'] = '0';
    		$result['Error'] = Common_TransError::Transerror(array($this->_error));
        unset($result['Data']);
    		return $result;
    	}else{
            $order = Service_Orders::getOrderAllInfo($order[0]['order_code'], $this->_customer['customer_id']);
    		$warehousetc = '';
    		$warehouseInfo=Service_Warehouse::getByField($order['warehouse_id']);
    		if(!empty($warehouseInfo)){
    			$warehousetc = $warehouseInfo['warehouse_code'];
    		}
    		$order['warehouse_name'] = $warehousetc;
    		$warehousemd = '';
    		$mdwarehouseinfo = Service_Warehouse::getByField($order['to_warehouse_id']);
    		if(!empty($mdwarehouseinfo)){
    			$warehousemd = $mdwarehouseinfo['warehouse_code'];
    		}
    		$order['to_warehouse_name'] = $warehousemd;
    	}
    	//print_r($order);
    	//         print_r($this->_customer);exit;
    	$orderProducts = $order['order_product'];
    	$orderDetail = array();
    	if($orderProducts){
    		foreach($orderProducts as $keyo=>$vallueo){
    			$orderDetail[] = array(
    				'skuNo'=>$vallueo['product_sku'],
    				'skuName'=>$vallueo['product_title'],
    				'skuCnName'=>$vallueo['product_title_en'],	
    				'quantity'=>$vallueo['op_quantity'],		
    			);
    		}
    	}
		$shipOrderConditon = array(
			'order_code'=>$order['order_code']		
		);
    	$shipOrders = Service_ShipOrder::getByCondition($shipOrderConditon,'*');
    	$trackingNumber = trim($order['ref_tracking_number']);
      $soWeight = '';
    	if(!empty($shipOrders)){
    		foreach ($shipOrders as $key=>$value){
    			if($value['tracking_number']!=''){
    				if ('' === $trackingNumber) {
              $trackingNumber = $value['tracking_number'];
            }
            $soWeight = $value['so_weight'];
    				break;
    			}
    		}
    	}
    	
    	$orderInfo = array(
    			'orderCode' => $order['order_code'],
    			'orderType' => $order['order_type'],
    			'warehouseCode' => $order['warehouse_name'],
    			'toWarehouseCode' => $order['to_warehouse_name'],
    			'smCode' => $order['sm_code'],
    			'orderStatus' => $order['order_status'],
    			'countryName' =>$order['country_name'],
    			'provinceName'=> $order['oab_state'],
    			'referenceNo' => $order['reference_no'],
    			'trackingNumber'=> $trackingNumber,
    			'consigneeName'=> $order['oab_lastname'].$order['oab_firstname'],
    			'consigneeCompany' => $order['oab_company'],
    			'consigneePostcode' => $order['oab_postcode'],
    			'consigneeAddress1' => $order['oab_street_address1'],
    			'consigneeAddress2' => $order['oab_street_address2'],
    			'consigneePhone' => $order['oab_phone'],
    			'consigneeEmail' => $order['oab_email'],
    			'grossWt' => $soWeight, // $order['grossWt'],
				'currencyCode'=>$order['currency_code'],
    			'idType' => $order['IdType'],
    			'idNumber' => $order['idNumber'],
    			'Remark' => $order['remark'],
    			'OrderDetailType' => $orderDetail,
          'amount' => $order['charge'],
          'discountRate' => $order['discount'],
          'deliveryFee' => $order['delivery_fee'],
          'couponRate' => $order['coupon'],
          'invoiceCode' => $order['invoice_code'],
          'transactionOrderCode' => $order['transaction_order_code'],
    	);
    	$result['Data'] = $orderInfo;
    	return $result;
    }
    
    /**
     * @author william-fan
     * @todo 转换参数到程序识别
     */
    private function transParam($orderInfo){
    	$transOrder = array();
    	
    	if(isset($orderInfo['orderModel'])){
    		$transOrder['order_mode_type'] = $orderInfo['orderModel']; //备货模式订单
    	}
    	if(isset($orderInfo['orderCode'])){
    		$transOrder['orderCode'] = $orderInfo['orderCode'];
    	}
    	if(isset($orderInfo['warehouseCode'])){
    		$transOrder['warehouse_code'] = $orderInfo['warehouseCode'];
    	}
    	if(isset($orderInfo['toWarehouseCode'])){
    		$transOrder['to_warehouse_code'] = $orderInfo['toWarehouseCode'];
    	}
    	if(isset($orderInfo['oabCounty'])){
    		$transOrder['oab_country_name'] = $orderInfo['oabCounty'];
    	}
    	if(isset($orderInfo['oabStateName'])){
    		$transOrder['oab_state_name'] = $orderInfo['oabStateName'];
    	}
    	if(isset($orderInfo['oabCity'])){
    		$transOrder['oab_city'] = $orderInfo['oabCity'];
    	}
    	if(isset($orderInfo['smCode'])){
    		$transOrder['sm_code'] = $orderInfo['smCode'];
    	}
        if(isset($orderInfo['oabDistrict'])){
            $transOrder['oab_district'] = $orderInfo['oabDistrict'];
        }
    	if(isset($orderInfo['referenceNo'])){
    		$transOrder['reference_no'] = $orderInfo['referenceNo'];
    	}
        if(isset($orderInfo['trackingNumber'])){
            $transOrder['ref_tracking_number'] = $orderInfo['trackingNumber'];
        }
    	if(isset($orderInfo['oabName'])){
    		$transOrder['oab_firstname'] = $orderInfo['oabName'];
    	}
    	if(isset($orderInfo['oabCompany'])){
    		$transOrder['oab_company'] = $orderInfo['oabCompany'];
    	}
    	if(isset($orderInfo['oabPostcode'])){
    		$transOrder['oab_postcode'] = $orderInfo['oabPostcode'];
    	}
    	if(isset($orderInfo['oabStreetAddress1'])){
    		$transOrder['oab_street_address1'] = $orderInfo['oabStreetAddress1'];
    	}
    	if(isset($orderInfo['oabStreetAddress2'])){
    		$transOrder['oab_street_address2'] = $orderInfo['oabStreetAddress2'];
    	}
    	if(isset($orderInfo['oabPhone'])){
    		$transOrder['oab_phone'] = $orderInfo['oabPhone'];
    	}
    	if(isset($orderInfo['oabEmail'])){
    		$transOrder['oab_email'] = $orderInfo['oabEmail'];
    	}

    	if(isset($orderInfo['grossWt'])){
    		$transOrder['grossWt'] = $orderInfo['grossWt'];
    	}
    	/* if(isset($orderInfo['charge'])){
    		$transOrder['charge'] = $orderInfo['charge'];
    	} */
    	if(isset($orderInfo['currencyCode'])){
    		$transOrder['currency'] = $orderInfo['currencyCode'];
    	}
    	if(isset($orderInfo['idType'])){
    		$transOrder['IdType'] = $orderInfo['idType'];
    	}
    	if(isset($orderInfo['idNumber'])){
    		$transOrder['idNumber'] = $orderInfo['idNumber'];
    	}
        if(isset($orderInfo['payNo'])){
            $transOrder['pay_no'] = $orderInfo['payNo'];
        }
    	if(isset($orderInfo['remark'])){
    		$transOrder['remark'] = $orderInfo['remark'];
    	}
    	if(isset($orderInfo['orderStatus'])){
    		$transOrder['orderStatus'] = $orderInfo['orderStatus'];
    	}

      // 订单折扣
      if (isset($orderInfo['discountRate'])) {
        $transOrder['discount'] = $orderInfo['discountRate'];
      }

      // 订单物流费用
      if (isset($orderInfo['deliveryFee'])) {
        $transOrder['delivery_fee'] = $orderInfo['deliveryFee'];
      }

      // 订单交易总价
      if (isset($orderInfo['amount'])) {
        $transOrder['charge'] = $orderInfo['amount'];
      }

      // 乐天折扣价
      if (isset($orderInfo['couponRate'])) {
        $transOrder['coupon'] = $orderInfo['couponRate'];
      }

      // 配货单类型
      if (isset($orderInfo['invoiceCode'])) {
        $transOrder['invoice_code'] = $orderInfo['invoiceCode'];
      }

      // 乐天订单号
      if (isset($orderInfo['transactionOrderCode'])) {
        $transOrder['transaction_order_code'] = $orderInfo['transactionOrderCode'];
      }

    	//file_put_contents('ya.txt', var_export($orderInfo,true));
    	$pradetail = $orderInfo['orderProduct'];
    	if(!empty($pradetail) && is_array($pradetail['0'])){
    	
    	}else{
    		$pradetail = array($pradetail);
    	}
		if(isset($pradetail)){
			$prodetail = array();
			foreach($pradetail as $key=>$value){
				$prodetail[$key] = array(
					'product_sku'=>$value['productSku'],
					'op_quantity'=>$value['opQuantity'],			
				);
				if(isset($value['transactionPrice'])){
					$prodetail[$key]['op_total_price'] = $value['transactionPrice'];
				}
				if(isset($value['dealPrice'])){
					$prodetail[$key]['op_price'] = $value['dealPrice'];
				}
				if(isset($value['invoicePrice'])){
					$prodetail[$key]['invoice_price'] = $value['invoicePrice'];
				}
			}
			$transOrder['productDeatil'] = $prodetail;
		}
		//print_r($transOrder);
    	return $transOrder;
    }
    
    /**
     * @author william-fan
     * @todo 用于修改订单信息
     * $orderRow 更改的订单
     * $orderInfo 订单信息
     */
    private function updateTransParam($orderRow,$orderInfo){
    	$updateRow = array();
    	 
    	$warehouseId = $orderInfo['warehouse_id'];
    	$toWarehouseId = $orderInfo['to_warehouse_id'];
    	
    	$changeOrder = $orderInfo['change_order'];
    	
    	//$orderType = isset($orderRow['order_type'])&&$orderRow['order_type']!==''?$orderRow['ref_tracking_number']:$orderInfo['order_type'];
    	$oabCountry = isset($orderRow['oabCounty'])&&$orderRow['oabCounty']!==''?$orderRow['oabCounty']:$orderInfo['country_name'];
    	
    	$oabState = isset($orderRow['oabStateName'])&&$orderRow['oabStateName']!==''?$orderRow['oabStateName']:$orderInfo['oab_state'];
    	$oabCity = isset($orderRow['oabCity'])&&$orderRow['oabCity']!==''?$orderRow['oabCity']:$orderInfo['oab_city'];
        $oabDistrict=isset($orderRow['oabDistrict'])?$orderRow['oabDistrict']:$orderInfo['oab_district'];
        
    	$smCode	= isset($orderRow['smCode'])&&$orderRow['smCode']!==''?$orderRow['smCode']:$orderInfo['sm_code'];

    	$referenceNo = isset($orderRow['referenceNo'])&&$orderRow['referenceNo']!==''?$orderRow['referenceNo']:$orderInfo['reference_no'];

    	$oabName = isset($orderRow['oabName'])&&$orderRow['oabName']!==''?$orderRow['oabName']:$orderInfo['oab_firstnam'].$orderInfo['oab_lastname'];
    	
    	$oabCompany = isset($orderRow['oabCompany'])&&$orderRow['oabCompany']!==''?$orderRow['oab_company']:$orderInfo['oab_company'];


    	$oabPostcode = isset($orderRow['oabPostcode'])&&$orderRow['oabPostcode']!==''?$orderRow['oabPostcode']:$orderInfo['oab_postcode'];
    	
    	$oabStreetAddress1 = isset($orderRow['oabStreetAddress1'])&&$orderRow['oabStreetAddress1']!==''?$orderRow['oabStreetAddress1']:$orderInfo['oab_street_address1'];
    	$oabStreetAddress2 = isset($orderRow['oabStreetAddress2'])&&$orderRow['oabStreetAddress2']!==''?$orderRow['oabStreetAddress2']:$orderInfo['oab_street_address2'];
    	$oabPhone = isset($orderRow['oabPhone'])&&$orderRow['oabPhone']!==''?$orderRow['oabPhone']:$orderInfo['oab_phone'];
    	$oabEmail = isset($orderRow['oabEmail'])&&$orderRow['oabEmail']!==''?$orderRow['oabEmail']:$orderInfo['oab_email'];
    	$currency = isset($orderRow['currencyCode'])&&$orderRow['currencyCode']!==''?$orderRow['currencyCode']:$orderInfo['currency_code'];
    	$charge = isset($orderRow['amount'])&&$orderRow['amount']!==''?$orderRow['amount']:$orderInfo['charge'];
    	$remark = isset($orderRow['remark'])&&$orderRow['remark']!==''?$orderRow['remark']:$orderInfo['remark'];
    	$idType	= isset($orderRow['idType'])&&$orderRow['idType']!==''?$orderRow['idType']:$orderInfo['IdType'];
    	$idNumber = isset($orderRow['idNumber'])&&$orderRow['idNumber']!==''?$orderRow['idNumber']:$orderInfo['idNumber'];
    	
    	$ordersCode = isset($orderRow['orderCode'])&&$orderRow['orderCode']!==''?$orderRow['orderCode']:$orderInfo['order_code'];
    	
    	
    	$productDetail = isset($orderRow['orderProduct'])?$orderRow['orderProduct']:'';
    	$orderProductinfo = $orderInfo['order_product'];
      $grossWt = isset($orderRow['grossWt']) && '' !== trim($orderRow['grossWt']) ? trim($orderRow['grossWt']) : $orderInfo['grossWt'];
      $discount = isset($orderRow['discountRate']) && '' !== trim($orderRow['discountRate']) ? trim($orderRow['discountRate']) : $orderInfo['discount'];
      $deliveryFee = isset($orderRow['deliveryFee']) && '' !== trim($orderRow['deliveryFee']) ? trim($orderRow['deliveryFee']) : $orderInfo['delivery_fee'];
      $coupon = isset($orderRow['couponRate']) && '' !== trim($orderRow['couponRate']) ? trim($orderRow['couponRate']) : $orderInfo['coupon'];
      $invoiceCode = isset($orderRow['invoiceCode']) && '' !== trim($orderRow['invoiceCode']) ? strtoupper(trim($orderRow['invoiceCode'])) : $orderInfo['invoice_code'];
      $transactionOrderCode = isset($orderRow['transactionOrderCode']) && '' !== trim($orderRow['transactionOrderCode']) ? trim($orderRow['transactionOrderCode']) : $orderInfo['transaction_order_code'];
    	
      $ref_tracking_number = isset($orderRow['trackingNumber']) && '' !== trim($orderRow['trackingNumber']) ? trim($orderRow['trackingNumber']) : $orderInfo['transaction_order_code'];
      $pay_no = isset($orderRow['payNo']) && '' !== trim($orderRow['payNo']) ? trim($orderRow['payNo']) : $orderInfo['payNo'];
    	/* var_dump($orderRow);
    	 var_dump($orderRow['change_order']!=''); */
    
    	//print_r($orderInfo);
    
    	$updateRow['warehouse_id'] = $warehouseId;
    
    	if(isset($orderRow['warehouseCode']) && $orderRow['warehouseCode']!==''){
    		$updateRow['warehouse_code'] = $orderRow['warehouseCode'];
    	}else{
    		$warehouse = Service_Warehouse::getByField($warehouseId);
    		$updateRow['warehouse_code'] = $warehouse['warehouse_code'];
    	}
    	
    	if(isset($orderRow['toWarehouseCode']) && $orderRow['toWarehouseCode']!==''){
    		$updateRow['to_warehouse_code'] = $orderRow['toWarehouseCode'];
    	}else{
    		$warehouse = Service_Warehouse::getByField($warehouseId);
    		$updateRow['to_warehouse_code'] = $warehouse['warehouse_code'];
    	}
    	
    	
    	
    	/* if(isset($orderRow['oab_country_name']) && $orderRow['oab_country_name']!==''){
    		
    	}else{
    		$country = Service_Country::getByField($oabCountry,'country_name');
    		$updateRow['oab_country_name'] = $country['country_name'];
    	} */
    	$updateRow['oab_country_name'] = $oabCountry;
    	
    	
    	$updateRow['change_order'] = $changeOrder;
    	
    	
    	$updateRow['order_mode_type'] = $orderInfo['order_mode_type'];

    	$updateRow['change_order'] = $changeOrder;
    	$updateRow['order_type'] = $orderType;
    	 
    	$updateRow['sm_code'] = $smCode;
    	$updateRow['reference_no'] = $referenceNo;
    	$updateRow['oab_firstname'] = $oabName;
    	$updateRow['oab_company'] = $oabCompany;
    	$updateRow['oab_state_name'] = $oabState;
    	$updateRow['oab_city'] = $oabCity;
        $updateRow['oab_district']=$oabDistrict;
    	$updateRow['oab_postcode'] = $oabPostcode;
    	$updateRow['oab_street_address1'] = $oabStreetAddress1;
    	$updateRow['oab_street_address2'] = $oabStreetAddress2;
    	$updateRow['oab_phone'] = $oabPhone;
    	$updateRow['oab_email'] = $oabEmail;
    	$updateRow['idType'] = $idType;
    	$updateRow['idNumber'] = $idNumber;
    	$updateRow['ref_tracking_number'] = $ref_tracking_number;
        $updateRow['pay_no'] = $pay_no;

    	
    	$updateRow['currency'] = $currency;
    	$updateRow['charge'] = $charge;
    	$updateRow['remark'] = $remark;
		$updateRow['action'] = 'update';
    	$updateRow['ordersCode'] = $ordersCode;
      $updateRow['grossWt'] = $grossWt;
      $updateRow['discount'] = $discount;
      $updateRow['delivery_fee'] = $deliveryFee;
      $updateRow['coupon'] = $coupon;
      $updateRow['invoice_code'] = $invoiceCode;
      $updateRow['transaction_order_code'] = $transactionOrderCode;

    
    	if(isset($orderRow['orderProduct'])){
    		$prodetail = array();
    		$pradetail=$orderRow['orderProduct'];
    		if(!empty($pradetail) && is_array($pradetail['0'])){
    
    		}else{
    			$pradetail = array($pradetail);
    		}
    		foreach($pradetail as $key=>$value){
    			$detailArr = array(
    					'product_sku'=>$value['productSku'],
    					'op_quantity'=>$value['opQuantity'],
    			);
    			if(isset($value['transactionPrice'])){
    				$detailArr['op_total_price'] = $value['transactionPrice'];
    			}
    			if(isset($value['dealPrice'])){
    				$detailArr['op_price'] = $value['dealPrice'];
    			}
    			if(isset($value['invoicePrice'])){
    				$detailArr['invoice_price'] = $value['invoicePrice'];
    			}
    			$prodetail[$key] = $detailArr;
    		}
    		$updateRow['productDeatil'] = $prodetail;
    	}else{
    		$prodetail = array();
    		foreach($orderProductinfo as $key=>$value){
    			$product = Service_Product::getByField($value['product_id']);
    			$detailArr = array(
    					'product_sku'=>$product['product_sku'],
    					'op_quantity'=>$value['op_quantity'],
    			);
 
    			$detailArr['op_price'] = $value['op_price'];
    			$detailArr['op_total_price'] = $value['op_total_price'];
    			if(isset($value['invoicePrice'])){
    				$detailArr['invoice_price'] = $value['invoicePrice'];
    			}
    			$prodetail[$key] = $detailArr;
    		}
    		$updateRow['productDeatil'] = $prodetail;
    	}
    	return $updateRow;
    }
    
    /**
     * @author william-fan
     * @todo 用于
     */
    public function createShipbatch($paramter){
    	$this->common($paramter);
    	$result = array(
    			'ask' => '0',
    			'message' => '创建失败',
    			'shipbatchCode' => '',
    			'error' => array(),
    	);
        $result = array(
            'ask' => '0',
            'message' => '',
            'orderCode' => '',
            'error' => array(),
        );
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }

        $shipBatchInfo = $this->_paramterArr['shipbatchInfo'];
        file_put_contents('var.txt',var_export($this->_paramterArr,true));
        $warehouseCode 	= $shipBatchInfo['warehouseCode'];
        $smCode			= $shipBatchInfo['smCode'];
        $batchCode	= $shipBatchInfo['batchCode'];
        $action		= $shipBatchInfo['action'];

        $OrderInfo		= $shipBatchInfo['OrderInfo'];


        $shipbatchInfo = $this->_paramterArr['shipbatchInfo'];
        $result = $this->shipbatchProcess($shipbatchInfo);
        return $result;
    }
    /**
     * @author william-fan
     * @todo 用于创建出货
     */
    private function shipbatchProcess($shipBatchInfo){
        /**
         * 逻辑
         * 1）车牌号可重复，
         * 2）一个批次不能再多个车里面，批次只能在一个车里面
         * 3）批次在完成的情况下不能重复，若在草稿状态下，传了相同的车，和相同的袋子，就将订单加到袋子里面
         * 4）订单在传输完毕不能删除，并且改状态，下次不同的批次下不能传这个订单
         */
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>array(),
            'shipbatchCode'=>'',
        );
        $warehouseCode 	= $shipBatchInfo['warehouseCode'];
        $smCode			= $shipBatchInfo['smCode'];
        $truckNo        = $shipBatchInfo['truckNo'];
        $batchCode	= $shipBatchInfo['batchCode'];
        //$action		= strtolower($shipBatchInfo['action']);


        $warehouse=Service_Warehouse::getByField($warehouseCode,'warehouse_code');
        $smInfo = Service_ShippingMethod::getByField($smCode,'sm_code');
        $error = array();
        if(empty($smCode)){
            $error[] = '运输方式为空';
        }else{
            $smInfo = Service_ShippingMethod::getByField($smCode,'sm_code');
            if(empty($smInfo)){
                $error[] = '运输方式无效';
            }
        }
        if(empty($warehouse)){
            $error[] = '仓库必须填写';
        }else{
            $warehouse=Service_Warehouse::getByField($warehouseCode,'warehouse_code');
            if(empty($warehouse)){
                $error[] = '仓库无效';
            }else{
                $warehouseArr = array($warehouse['warehouse_id'],'0');
                if(!in_array($smInfo['warehouse_id'],$warehouseArr)){
                    $error[] = '该运输方式和仓库不匹配';
                }
            }
        }

        if(empty($batchCode)){
            $error[] = '出区批次为空';
        }else{
            if(mb_strlen($truckNo)>32){
                $error[] = '出区批次大于32位';
            }
        }
        if(empty($truckNo)){
            $error[] = '车牌号无效';
        }else{
            if(mb_strlen($truckNo)>32){
                $error[] = '车牌号大于32位';
            }
        }
        $OrderInfo		= $shipBatchInfo['OrderInfo'];
        if(empty($OrderInfo)){
            $error[] = '订单为空';
        }
        //$result['orderCode'] = $ordersCode;
        if(!empty($error)){
            /*$this->_error = '订单号不能为空 ';
            $result['message'] = $this->_error;*/
            $result['error'] = Common_TransError::Transerror($error);;
            return $result;
        }
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try{
            //
            //sb_truck_no
            /*$condition = array(
                'ob_no'=>$batchCode,
                ''=>
            );
            Service_ShipBatch::getoutboundJoinByCondition();*/
            $total_netweight = 0;
            $total_bagweight = 0;
            $outbound = Service_OutboundBag::getByField($batchCode,'ob_no');
            if(empty($outbound)){
                //批次不存在
                //ship_batch_detail
                //创建出区单,创建袋子，创建出区单袋子关联，创建袋子订单关联，创建ship_order,创建ftp_message_shipbatch_order
                //$shipbatchInfo = Service_ShipBatch::getByField($batchCode,'batchCode');

                //创建出区单
                $warehouseId = $warehouse['warehouse_id'];
                $sb_code = Common_GetNumbers::getCode('shipbatch',$warehouseId, $warehouse['warehouse_code']);
                $warehouse_to = $warehouseId;
                $warehouse_to = intval($warehouse_to);
                $row['sb_code'] = $sb_code;
                $row['sm_code'] = $smCode;
                $row['take_code'] = '';
                $row['warehouse_to'] = $warehouse_to>0 ? $warehouse_to : $warehouseId;
                $row['warehouse_id'] = $warehouseId;
                $row['creater_id'] = '';
                $row['customer_code'] = $this->_customer['customer_code'];
                $row['sb_status'] = 1;
                $row['sb_truck_no'] = $truckNo;
                $row['sb_add_time'] = date('Y-m-d H:i:s');
                $row['sb_update_time'] = date('Y-m-d H:i:s');
                if(!Service_ShipBatch::add($row)){
                    throw new Exception("出区单创建失败!");
                }

                $shipBatchLog = array(
                    'sb_id'=>$result,
                    'sb_code'=>$sb_code,
                    'sbl_type'=>'0',
                    'user_id'=>'-1',
                    'sbl_status_from'=>'0',
                    'sbl_status_to'=>'0',
                    'sbl_note'=>'创建出货单',
                    'sbl_add_time'=>date("Y-m-d H:i:s"),
                    'sbl_ip'=>Common_Common::getIP(),
                );
                if(!Service_ShipBatchLog::add($shipBatchLog)){
                    throw new Exception("出区单日志创建失败!");
                }

                $row = array(
                    'ie_port'=>'',
                    'form_type'=>'',
                    'traf_name'=>'',
                    'voyage_no'=>'',
                    'trans_mode'=>'',
                    'traf_mode'=>'',
                    //'wrap_type'=>'',
                    'country_id'=>''
                );
                $row['sb_code'] = $sb_code;
                if(!Service_ShipBatchAttribute::add($row)) {
                    throw new Exception('创建总单属性失败，请重试');
                }

                $ob_weight = '0';

                //创建袋子
                $outbound_bag = array(
                    'ob_no'=>$batchCode,
                    'warehouse_id'=>$warehouseId,
                    'warehouse_to'=>$warehouse_to,
                    'ob_status'=>'1',
                    'sm_code'=>$smCode,
                    'ob_weight'=>$ob_weight,
                    'creater_id'=>'-1',
                    'ob_add_time'=>date("Y-m-d H:i:s"),
                    'ob_update_time'=>date("Y-m-d H:i:s"),
                );
                if(!Service_OutboundBag::add($outbound_bag)){
                    throw new Exception('袋子创建失败');
                }
                //创建袋子和订单
                $shipbatchDetailRow = array(
                    'sb_code'=>$sb_code,
                    'ob_no'=>$batchCode,
                    'creater_id'=>'-1',
                    'ob_weight'=>'0',
                    'sbd_add_time'=>date("Y-m-d H:i:s")
                );
                if(!Service_ShipBatchDetail::add($shipbatchDetailRow)){
                    throw new Exception('袋子和出区单关联失败');
                }

                if(!empty($OrderInfo) && is_array($OrderInfo['0'])){
                }else{
                    $OrderInfo = array($OrderInfo);
                }
                $prefix = 'SO'.$this->_customer['customer_code'];


                foreach($OrderInfo as $key=>$o){
                    if(strpos($o['orderCode'],$prefix)!==false){
                        $orderCondition = array(
                            'order_code'=>$o['orderCode'],
                            'customer_id'=>$this->_customer['customer_id'],
                            'sm_code'=>$smCode
                        );
                    }else{
                        $orderCondition = array(
                            'new_reference_no'=>$o['orderCode'],
                            'customer_id'=>$this->_customer['customer_id'],
                            'sm_code'=>$smCode
                        );
                    }
                    $orders=Service_Orders::getByCondition($orderCondition,'*');
                    if(empty($orders)){
                        throw new Exception("订单{$o['orderCode']}不存在,或者订单不属于该运输方式");
                    }else{
                        if(count($orders)>=2){
                            throw new Exception("订单{$o['orderCode']}不唯一");
                        }
                        $order = $orders[0];
                        if($order['order_status']!='4'){
                            throw new Exception('订单'.$order['order_code'].'状态不对');
                        }else{
                            $orderRow = array(
                                'order_status'=>'12',
                                'update_time'=>date("Y-m-d H:i:s",time())
                            );
                            if(!Service_Orders::update($orderRow,$order['order_code'],'order_code')){
                                throw new Exception("订单状态修改失败!");
                            }
                        }
                    }
                    $netweight = Service_OrderProduct::getOrderNetWeight($order['order_code']);
					if($netweight<=0){
						$this->logError('订单'.$order['order_code'].'净重必须大于0');
						throw new Exception('订单'.$order['order_code'].'净重必须大于0');
					}
                    $total_netweight+=$netweight;
                    $bagweight = $netweight+0.2; //净重加上0.02为毛重
                    $total_bagweight+=$bagweight;
                    $shipOrder =  Service_ShipOrder::getByField($order['order_code'],'order_code');
                    $change_tracking = $order['ref_tracking_number'];
                    $dateTime = date("Y-m-d H:i:s",time());
                    if(!empty($shipOrder)){
                        //在Ship_Order表插入一条数据，Tracking_No为订单号
                        //存在就更新数据
                        $shipOrderRow = array(
                            'tracking_number'=>$change_tracking,
                            'so_update_time'=>date("Y-m-d H:i:s",time()),
                        );
                        Service_ShipOrder::update($shipOrderRow, $order['order_code']);
                        $soCode = $shipOrder['so_code'];
                    }else{
                        $soCode = $soCode = Common_GetNumbers::getCode('shiporder', $order['customer_code'], 'SP');
                        //不存在就插入数据
                        $shipOrderRow = array(
                            'so_code'=>$soCode,
                            'order_id'=>$order['order_id'],
                            'order_code'=>$order['order_code'],
                            'tracking_number'=>$change_tracking,
                            'warehouse_id'=>$warehouseId,
                            'pp_barcode'=>'',
                            'sm_code'=>$order['sm_code'],
                            'so_status'=>'0',
                            'so_weight'=>$bagweight,
                            'so_vol_weight'=>'',
                            'so_length'=>'',
                            'so_width'=>'',
                            'so_height'=>'',
                            'so_declared_value'=>'',
                            'so_shipping_fee'=>'',
                            'currency_code'=>'',
                            'so_add_time'=>$dateTime,
                            'so_ship_time'=>$dateTime,
                            'so_update_time'=>$dateTime,
                        );
                        if(!Service_ShipOrder::add($shipOrderRow)){
                            throw new Exception("物流信息添加失败");
                        }
                    }

                    //outbound_bag_detail
                    $outboundBagDetail = array(
                        'ob_no'=>$batchCode,
                        'order_id'=>$order['order_id'],
                        'order_code'=>$order['order_code'],
                        'so_code'=>$soCode,
                        'so_weight'=>$bagweight,
                        'obd_add_time'=>$dateTime
                    );
                    if(!Service_OutboundBagDetail::add($outboundBagDetail)){
                        throw new Exception("袋子订单创建失败");
                    }

                    if($order['order_mode_type']=="0"){
                        //$order_code = $order['order_code'];
                        //暂时不处理库存
                        //$piResult = $this->reduceStock($order);
                        //if($piResult !== true) throw new Exception($piResult);
                    }
                    //ftp_message_shipbatch_order
                    $shipbatctOrderRow = array(
                        'fmt_code'=>'MCK',
                        'fmt_type'=>'BSG011',
                        'sb_code'=>$sb_code,
                        'order_code'=>$order['order_code'],
                        'fml_status'=>'1',
                        'fml_add_time'=>$dateTime
                    );
                    if(!Service_FtpMessageShipbatchOrder::add($shipbatctOrderRow)){
                        throw new Exception("添加清关任务失败");
                    }
                }
                $outbound_bag = array(
                    'ob_weight'=>$total_bagweight,
                );
                if(!Service_OutboundBag::update($outbound_bag,$batchCode,'ob_no')){
                    throw new Exception('袋子创建失败');
                }

            }else{
                //
                //Service_ShipBatchDetail::getByField(,'ob_no');
                //有袋子批次
                throw new Exception("批次{$batchCode}已存在");
            }
            $db->commit();
            //$db->rollBack();
            $result['ask']='1';
            $result['message'] = '创建出区单成功';
            $result['shipbatchCode'] = $sb_code;
        }catch (Exception $e){
            $result['message'] = $e->getMessage();
            $db->rollBack();
        }
        return $result;
    }


    /**
     * 扣库存(订单装袋)
     * @author solar
     * @param string $order_code
     * @return boolean
     */
    public function reduceStock($order) {
        $order_code = $order['order_code'];
        $orderProducts = Service_OrderProduct::getOutBillProducts($order_code,'1');
        //print_r($orderProducts);
        if(empty($orderProducts)){
            return false;
        }
        $warehouse_id = $order['to_warehouse_id'];
        $piProccess = new Service_ProductInventoryProcess();
        foreach($orderProducts as $key=>$product) {
            $quantity = $product['op_quantity'];
            $product_id = $product['product_id'];
            if($quantity==0) return '库存异常，产品['.$product_id.']代扣数量为0';
            $params = array(
                'product_id' => $product_id,
                'quantity' => $quantity,
                'operationType' => 6,
                'warehouse_id' => $warehouse_id,
                'reference_code' => $order_code, //操作单号
                'application_code' => 'PutInBag', //操作类型
                'note' => 'api订单出货',
                'reference_code'=>$order_code,
            );
            $result = $piProccess->update($params);
            if($result['state']==0) return '更新库存失败';
        }
        return true;
    }

    /**
     * 统计核销库存并减去批次库存
     * @author solar
     * @param string $order_code
     * @return array|string
     */
    public function statQuantity($order_code) {
        $aQuantity = array();
        $pkList = Service_PickingDetail::getByCondition(array('order_code'=>$order_code), 'ibo_id');
        $ibo_ids = array();
        foreach($pkList as $pkRow) $ibo_ids[] = $pkRow['ibo_id'];
        if(empty($ibo_ids)) return '找不到库存批次';
        $ibo_ids = array_unique($ibo_ids);
        $iboList = Service_InventoryBatchOutbound::listInIboids($ibo_ids);
        foreach($iboList as $iboRow) {
            $ibRow = Service_InventoryBatch::getByField($iboRow['ib_id']);
            $product_id = $ibRow['product_id'];
            if(!isset($aQuantity[$product_id])) $aQuantity[$product_id] = 0;
            $aQuantity[$ibRow['product_id']] += $iboRow['ibo_quantity'];
            $iboRet = Service_InventoryBatchOutbound::delete($iboRow['ibo_id']);
            $ibolRet = Service_InventoryBatchOutboundLog::log($iboRow, '订单出货');
            if(!$iboRet || !$ibolRet) return '数据库异常，删除核销库存失败';
            $ib_quantity = $ibRow['ib_quantity']-$iboRow['ibo_quantity'];
            if($ib_quantity==0) {
                $ibRet = Service_InventoryBatch::delete($ibRow['ib_id']);
                $note = '订单出货删除批次';
            } else {
                $updateRow['ib_quantity'] = $ib_quantity;
                $updateRow['ib_update_time'] = date('Y-m-d H:i:s');
                $ibRet = Service_InventoryBatch::update($updateRow, $ibRow['ib_id']);
                $note = '订单出货修改批次库存';
            }
            $iblRet = Service_InventoryBatchLog::log($ibRow, $ibRow['ib_quantity'], $ib_quantity, $note);
            if(!$iboRet || !$ibolRet) return '数据库异常，更新批次库存失败';
        }
        return $aQuantity;
    }



    public function getShipbatchinfo($paramter){
        $this->common($paramter);
        $result=array(
           'ask'=>'1',
           'message'=>'',
           'shipbatchCode'=>'',
           'batchStatus'=>'',
           'OrderInfo'=>''
        );
        $shipbatchCode = $this->_paramterArr['shipbatchCode'];

        Service_ShipBatch::getByField($shipbatchCode,'sb_code');



        //$this->_customer['customer_id']

    }
    
}