<?php

class Merchant_PurchaseOrderController extends Ec_Controller_Action
{

    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/purchaseOrder/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
        //print_r($this->customerAuth);
        //$this->customerId = Service_Login::getLoginInfo()->customer['customer_id'];
        $this->customerId = $this->_customerAuth['id'];
    }
	/*创建采购单*/
    public function purchaseOrderCreateAction()
    {
	   $customer = $this->_customerAuth;
	   $ASNCode = $this->_request->getParam('ASNCode', ''); 
       $customerId = $customer['id'];		
	   $this->view->actions = Ec_Lang::getInstance()->getTranslate('purchase_order_create');//"新增";
	   $this->view->actionLabel="add";
       $this->view->receivingDetail = $receivingDetail; 	 	
       echo Ec::renderTpl($this->tplDirectory . 'purchase-order-create.tpl', 'noleftlayout');
    }
		
	
 	//新增或编辑采购单		
 	public function purchaseOrderSaveAction() {    
 			$po_id = $this->_request->getParam('po_id', '');
			if ($this->_request->isPost()) {
            	$data = $this->getRequest()->getParams(); 
				if($data){
					foreach($data as $k =>&$v){
						if(!is_array($v)){  $v = trim($v);}				
					}
				
				}
    
   			$customer = $this->_customerAuth;
			$data['customer_id'] = $customer['id'];
            $data['customer_code'] = $customer['code'];
            //$validate = $ASNObj->validate($data);
           
			//print_r($data);exit;           
            if (empty($po_id)) {   
					$data['action'] = 'create';	         		
            		$doresult = Service_PurchaseOrderProcess::createTransaction($data);
            	
            } else {
				$data['action'] = 'update';	 
                $data['po_id'] = $po_id;   
				exit;     
                $doresult = Service_PurchaseOrderProcess::updateTransaction($data);
                
            }
            //print_r($doresult);
            if (isset($doresult['msg'])) {
                $result['msg'] = $doresult['msg'];
            }
            $result['error']=$doresult['error'];
            $result['ask']=$doresult['ask'];
            $result['ASNCode'] = $doresult['ASNCode'];
			die(json_encode($result));
        } 
 
 	}		

	/*采购订单列表*/
	public function purchaseOrderListAction() {  
 			$customer = $this->_customerAuth;
       
        	$purchase_order_status_list = Service_PurchaseOrderProcess::getStatus();
       
        //if ($this->_request->isPost()) {
            //$customerId = $this->customerId;
			$purchaseOrderBody = new Service_PurchaseOrderBody();
            $customerId = $customer['id'];
            $page = $this->_request->getParam('page', 1);
            $pageSize = $this->_request->getParam('pageSize', 20);

            $po_code = trim($this->_request->getParam('po_code', ''));
			$product_sku = trim($this->_request->getParam('product_sku', ''));
            $pobd_status = $this->_request->getParam('pobd_status', '');
            
            $created_start	= trim($this->_request->getParam('created_start',''));
            $created_end	= trim($this->_request->getParam('created_end',''));
			
			$params = array();
			$params['created_start'] = $created_start;			
			$params['created_end'] = $created_end;	
			$params['product_sku'] = $product_sku;	
			$params['po_code'] = $po_code;	
			$params['pobd_status'] = $pobd_status;
			
            $created_start	= ($created_start)?$created_start.' 00:00:00':'';
            $created_end	= ($created_end)?$created_end.' 59:59:59':'';

            $page = $page ? $page : 1;
            $pageSize = $pageSize ? $pageSize : 20;
            $condition = array(
                'po_code' => $po_code,
				'product_sku'=>$product_sku,
                'pobd_status' => $pobd_status,               
				'created_start'=>$created_start,
            	'created_end'  =>$created_end,
            	'customer_id'=>$customerId,
            );       
					
            $count = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition($condition, 'count(*)');
            $result='';
            if ($count > 0) {                
                $result = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition($condition, '*', $pageSize, $page, array('purchase_order.po_id desc','product.product_id'));
   				foreach( $result as &$row){						
								
								$row['pobd_status_text'] = Service_PurchaseOrderProcess::getStatusText($row['pobd_status']);
										
						
						
					
				}
            }
            
          
   
            $this->view->page		= $page;
            $this->view->pageSize	= $pageSize;
            $this->view->count		= $count;
            
            //die(Zend_Json::encode($return));
        //}
 
        $this->view->result = $result;
        $this->view->params = $params;
		$this->view->purchase_order_status_list = $purchase_order_status_list;
        echo Ec::renderTpl($this->tplDirectory . "purchase-order-list.tpl", 'noleftlayout');

	}	
	
	/*区外收货管理*/
	public function outofareaReceivedListAction() {  
 		
		$customer = $this->_customerAuth;
        $allStatus = Service_AsnProccess::getAsnStatus();
        $allType = Service_AsnProccess::getAsnType();
        $warehouseAll = Common_DataCache::getWarehouse();
        $warehouse = array();
     
        //if ($this->_request->isPost()) {
            //$customerId = $this->customerId;
            $customerId = $customer['id'];
            $page = $this->_request->getParam('page', 1);
            $pageSize = $this->_request->getParam('pageSize', 20);

            $tracking_number = trim($this->_request->getParam('tracking_number', ''));
            $po_code = $this->_request->getParam('po_code', '');       
         

            $created_start	= trim($this->_request->getParam('created_start',''));
            $created_end	= trim($this->_request->getParam('created_end',''));
            $created_start	= ($created_start)?$created_start.' 00:00:00':'';
            $created_end	= ($created_end)?$created_end.' 59:59:59':'';
			
            $page = $page ? $page : 1;
            $pageSize = $pageSize ? $pageSize : 20;
            $condition = array(
                'tracking_number' => $tracking_number,               
                'po_code' => $po_code,               
                'customer_id' => $customerId,
				'created_start'=>$created_start,
            	'created_end'  =>$created_end,            	
            );       
			 
            $count = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition($condition, 'count(*)');
            
			$result='';
            if ($count > 0) {                
                $result = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition($condition, '*', $pageSize, $page, array('purchase_order_tracking.po_t_id desc','product.product_id'));
   				foreach( $result as &$row){
				
					
					if($row['po_id']){
						$po = Service_PurchaseOrder::getByField($row['po_id'],'po_id');
						if($po){
							$row['po_code'] = $po['po_code'];
						}
					}
					if($row['receiving_id']){
						$receive = Service_Receiving::getByField($row['receiving_id'],'receiving_id');
						if($receive){
							$row['receiving_code'] = $receive['receiving_code'];
						}
						
					}
					$row['po_tb_status_text'] = Service_PurchaseOrderTrackingProcess::getStatusText($row['po_tb_status']);
					
				}
            }
            
          
           
            $this->view->page		= $page;
            $this->view->pageSize	= $pageSize;
            $this->view->count		= $count;
            
            //die(Zend_Json::encode($return));
        //}
 
        $this->view->result = $result;
        $this->view->params = $condition;
        echo Ec::renderTpl($this->tplDirectory . "outofarea-received-list.tpl", 'noleftlayout');		
		

	}	
	
	
	
	
  /*
    * 获取收货记录 详细产品
    */
    public function purchaseReceivedDetailAction()
    {
        $po_t_id = $this->_request->getParam('po_t_id', '0');
		$customer = $this->_customerAuth;
		if(empty($po_t_id)){
			echo Ec_Lang::getInstance()->getTranslate('PurchaseReceivedIDRequired');
			exit;		
		}


		$condition = array();
		$condition['po_t_id'] = $po_t_id;
		$condition['customer_id'] = $customer['id'];
		
		
        $purchase_order_tracking_body_rows = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition($condition,"*");
		$purchaseOrderTrackingRow = $purchase_order_tracking_body_rows[0];
		if(empty($purchase_order_tracking_body_rows)){
			echo Ec_Lang::getInstance()->getTranslate('data_not_found');
			exit;		
		}		
		
		
       
		
		
		
		
		
       

        foreach($purchase_order_tracking_body_rows as $key=>&$value){
			if($value['product_id']){
				$product = Service_Product::getByField($value['product_id'],"product_id","*");
				if($product){
						$value['product_sku'] = $product['product_sku'];
						$value['product_title'] = $product['product_title'];
				}
           	// $batchDetail[$key]['product_sku'] = $P['product_sku'];
			
			}
		
		
         
        }
        $this->view->purchase_order_tracking_body_rows = $purchase_order_tracking_body_rows;
		$this->view->purchaseOrderTrackingRow = $purchaseOrderTrackingRow;
        echo Ec::renderTpl($this->tplDirectory . "purchase_received_detail.tpl", 'noleftlayout');
    }	
	
		



  /*
    * 区外收货详情
    */
    public function outofareaReceivedDetailAction()
    {
        $po_id = $this->_request->getParam('po_id', '');
		$customer = $this->_customerAuth;
		if(empty($po_id)){
			echo Ec_Lang::getInstance()->getTranslate('PurchaseReceivedIDRequired');
			exit;		
		}


		$condition = array();
		$condition['po_id'] = $po_id;
		$condition['customer_id'] = $customer['id'];
		
		$PurchaseOrderBody = new Service_PurchaseOrderBody();		
        $purchase_order_body_rows = $PurchaseOrderBody->getJoinPurchaseBodyByCondition($condition,"*");
		
		$purchase_order_row = $purchase_order_body_rows[0];
		if(empty($purchase_order_body_rows)){
			echo Ec_Lang::getInstance()->getTranslate('data_not_found');
			exit;		
		}			
       
	
        foreach($purchase_order_body_rows as $key=>&$value){
			if($value['product_id']){
				$product = Service_Product::getByField($value['product_id'],"product_id","*");
				if($product){
						$value['product_sku'] = $product['product_sku'];
						$value['product_title'] = $product['product_title'];
				}
          
			
			}
		
		
         
        }
        $this->view->purchase_order_body_rows = $purchase_order_body_rows;
		$this->view->purchase_order_row = $purchase_order_row;
        echo Ec::renderTpl($this->tplDirectory . "outofarea-received-detail.tpl", 'noleftlayout');
    }
	
	
	
	   /*供应商编码辅助输入*/
		public function supplycodeAuxiliaryInputAction()
		{
			$customer = $this->_customerAuth;
			$page		= $this->getRequest()->getParam('page', 1);
			$pageSize	= $this->getRequest()->getParam('pageSize', 20);
			
			$selected_supply_code = $this->_request->getParam("selected_supply_code","");
			$supplier_code = $this->_request->getParam("supplier_code","");
			$supplier_name = $this->_request->getParam("supplier_name","");
			
			$condition	= array(
				'distributor_name'		=> $supplier_name,
				'distributor_code'      => $supplier_code,
				'distributor_status'=>'1'			                    
			);
			
			$from = 'product';
			
		
			$this->view->from = $from;
			$this->view->params		= $condition;
			$this->view->pageSize	= $pageSize;
			$this->view->page		= $page;
			$this->view->selected_supply_code = $selected_supply_code;
			
			$this->view->count = Service_Distributor::getCountByCustomerCode($customer['code'],$condition);
			
			$result = Service_Distributor::getByCustomerCode($customer['code'],$condition,$page,$pageSize);
			
			$this->view->result = $result;
			
			$params	= array(
				'supplier_code'		=> $supplier_code,
				'supplier_name'      => $supplier_name,
				'selected_supply_code'	=>$selected_supply_code		                    
			);
						
			$this->view->params = $params;		
			echo $this->view->render($this->tplDirectory . "supplyAuxiliaryInput.tpl");
		}	
		
		
		/*关闭采购单*/
	    public function closePurchaseOrderAction(){	
		
				$return = array('ask' => 0, 'message' =>'关闭采购单失败','error'=>'');	
				$customer = $this->_customerAuth;
				$customer_id = 	$customer['id'];
				$po_id = $this->_request->getParam("po_id","");
				if(empty($po_id)){
					$return['message'] =  '系统错误:采购单ID必须传递';
				}
				
				$condition = array();
				$condition['po_id'] = $po_id;
				$condition['customer_id'] = $customer_id;
				$purchase_orders = Service_PurchaseOrder::getByCondition($condition);
				if(empty($purchase_orders)){
					$return['message'] =  '系统错误:找不到对应采购单';
				}else{				
					$purchase_order = 	$purchase_orders[0];	
					if($purchase_order['po_status']=='0'){
						$return['message'] =  '系统错误:找不到对应采购单';					
					}else{		
						$row = array();
						$row['po_status']='0';			
						$status = Service_PurchaseOrder::update($row, $po_id,"po_id");
						if($status===false){
							$return['message'] =  '系统错误:采购单更新失败';
						}else{
							$return['ask'] = '1';						
							$return['message'] =  '采购单关闭成功';
						}
					
					}
							
				}
				
				die(Zend_Json::encode($return));
				
							
		        //$is_created_asn
		
		
		}					
 



		/*关闭采购单项*/
	    public function closePurchaseOrderbodyAction(){	
				$customer = $this->_customerAuth;
				$customer_id = 	$customer['id'];
				$pobd_id = $this->_request->getParam("pobd_id","");
				$return = Service_PurchaseOrderProcess::ClosePurchaseOrderItem($customer_id,$pobd_id);
				die(Zend_Json::encode($return));
		}




		/*关闭快递到货项*/
	    public function closePurchaseOrderTrackingBodyAction(){	
		
				$return = array('ask' => 0, 'message' =>'审核区外收货项失败','is_overpass_error'=>0,'error'=>'');	
				$customer = $this->_customerAuth;
				$customer_id = 	$customer['id'];
				$po_tb_id = $this->_request->getParam("po_tb_id","");
				$is_force = $this->_request->getParam("is_force","");
				if(empty($po_tb_id)){
					$return['message'] =  '系统错误:区外收货项ID必须传递';
				}
				
				$condition = array();
				$condition['po_tb_id'] = $po_tb_id;
				$condition['customer_id'] = $customer_id;
				$purchase_order_tracking_bodys = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition($condition);
								
				if(empty($purchase_order_tracking_bodys)){
					$return['message'] =  '系统错误:找不到对应区外收货项';
				}else{				
					$purchase_order_tracking_body = $purchase_order_tracking_bodys[0];
					
					if($purchase_order_tracking_body['po_tb_status']=='1'){
						$return['message'] =  '此区外收货项已经是已审核状态，不能重复审核';					
					}else{		
					
								$po_id = $purchase_order_tracking_body['po_id'];
								$product_id = $purchase_order_tracking_body['product_id'];
								if($po_id=='' || $product_id==""){
									$return['message'] =  '系统错误:找不到对应采购单项(由于参数为空)';								
								}else{
										$condition =  array();
										$condition['product_id'] = $product_id;
										$condition['po_id'] = $po_id;
										$purchase_order_bodys = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition($condition);
										if(empty($purchase_order_bodys)){
											$return['message'] =  '系统错误:找不到对应采购单项';	
										}else{
												$purchase_order_body = $purchase_order_bodys[0];
												if($purchase_order_body['pobd_status']=='-1'){
													$return['message'] =  '对应采购单项已经关闭';	
													die(Zend_Json::encode($return));
												}												
												
												
												if($is_force!='1'){
													if($purchase_order_body['received_quantity']+$purchase_order_tracking_body['received_quantity']>$purchase_order_body['order_quantity']){
													//超过采购量													
														$return['is_overpass_error'] =  '1';
														$rest = $purchase_order_body['order_quantity'] - $purchase_order_body['received_quantity'];
														$return['message'] =  '超过待收数量'.$rest;	
														die(Zend_Json::encode($return));													
													
													}
												}
												
												try {
														$DB = Common_Common::getAdapter();
														$DB->beginTransaction();
													
														$row1 = array();
														$row1['pobd_status'] =  1;
														
														if($is_force!='1'){//如果强制关闭
															$row1['received_quantity'] =  $purchase_order_body['received_quantity']+$purchase_order_tracking_body['received_quantity'];
															if($purchase_order_body['received_quantity']+$purchase_order_tracking_body['received_quantity']==$purchase_order_body['order_quantity']){
																$row1['pobd_status'] =  '-1';
															}
														}else{														
															$row1['received_quantity'] = $purchase_order_body['order_quantity'];															
															$row1['pobd_status'] =  '-1';																													
														}
														$pobd_id = $purchase_order_body['pobd_id'];
														Service_PurchaseOrderBody::update($row1,$pobd_id,"pobd_id");
														
														$row = array();
														$row['po_tb_status']='1';															
														Service_PurchaseOrderTrackingBody::update($row,$po_tb_id,"po_tb_id");																	
															
														
														$return['ask'] = '1';						
														$return['message'] =  '区外收货项审核成功';										
														
														$DB->commit();												
												}catch (Exception $e) {
														$DB->rollBack();
														$result['ask'] = '0';
														$error = $e->getMessage();
														$result['message'] = '区外收货项审核失败'.$error;
														die(Zend_Json::encode($return));
												}
													
													
													
													
												
												
												
												
																		

										}
								
								}//if($po_id=='' || $product_id==""){					
								
								
								
					
					}//if($purchase_order_tracking_body['po_tb_status']=='1'){
							
				}
				
				die(Zend_Json::encode($return));
				
							
		        //$is_created_asn
		
		
		}




   /**
     * @author colin
     * @todo 用于导出采购订单信息
     */
    public function purchaseOrderExportAction(){
		set_time_limit(0);
    	$customer = $this->_customerAuth;
    	$customerId = $customer['id'];  
		$customer_code = $customer['code'];    	
    	$orderArr = $this->_request->getParam('orderArr','');
    	$exportformat = $this->_request->getParam('dateformate','xls');
    	$exportformat = 'xls';
    	$fileName = 'purchaseorder'.date('YmdHis').'.'.$exportformat;

    	if(!empty($orderArr)){		//通过选择的订单获取
					
    		if($exportformat=='xls'){
    			$orderHtml = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><table border="1"><tr>';
				$htmlTitle  = '<td>客户代码</td>';			
    			$htmlTitle .= '<td>采购单号</td>';
    			$htmlTitle .= '<td>供应商代码</td>';
    			$htmlTitle .= '<td>SKU</td>';
    			$htmlTitle .= '<td>产品名称</td>';
    			$htmlTitle .= '<td>采购数量</td>';
    			$htmlTitle .= '<td>待收数量</td>';
    			$htmlTitle .= '<td>状态</td>';
				$htmlTitle .= '<td>创建时间</td>';
    			$htmlTitle .= '<td>备注</td>';              
    			$htmlTitle .='</tr>';
    			$orderContent = '';
    			$max = 1;
    			foreach($orderArr as $key=>$pobd_id){
						$data_rows = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition(array('pobd_id'=>$pobd_id,'customer_id'=>$customerId));  				
						if(empty($data_rows)){continue;}
						$data_row = $data_rows[0];						
						$data_row['pobd_status_text'] = Service_PurchaseOrderProcess::getStatusText($data_row['pobd_status']);
						$data_row['rest_quantity'] = $data_row['order_quantity']- $data_row['received_quantity'];			
				 
						 $orderContent.="<tr>";
						 //客户代码
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customer_code}</td>";					 
						 //采购单号						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['po_code']}</td>";
						 //供应商代码						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['supply_code']}</td>";
						 //SKU
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['product_sku']}</td>";
						 //产品名称
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['product_title']}</td>";
						 //采购数量
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['order_quantity']}</td>";
						 //待收数量
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['rest_quantity']}</td>";
						 //状态
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['pobd_status_text']}</td>";
						 //创建时间	
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['create_time']}</td>";
						 //备注
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['po_description']}</td>";	
						 					 	 
						 $orderContent.="</tr>";                   
    				 

    			}

				$html = $orderHtml.$htmlTitle.$orderContent.'</table>';				

								
    	        header('Pragma:public');		
    			header('Content-Type:application/x-msexecl;name="' . $fileName );
    	        header("Content-Disposition:inline;filename=" . $fileName );
    			//file_put_contents(APPLICATION_PATH . "/../data/{$fileName}",$html);
				echo $html;
    			exit;
    			//echo $orderHtml;exit;
    			
    		}   			
    	}else{
    		//获取全部情况
    		$condition = array();
            $po_code = trim($this->_request->getParam('po_code', ''));
			$product_sku = trim($this->_request->getParam('product_sku', ''));
            $pobd_status = $this->_request->getParam('pobd_status', '');
            
            $created_start	= trim($this->_request->getParam('created_start',''));
            $created_end	= trim($this->_request->getParam('created_end',''));		
			
            $created_start	= ($created_start)?$created_start.' 00:00:00':'';
            $created_end	= ($created_end)?$created_end.' 59:59:59':'';           
            $condition = array(
                'po_code' => $po_code,
				'product_sku' => $product_sku,
                'pobd_status' => $pobd_status,               
				'created_start'=>$created_start,
            	'created_end'  =>$created_end,
            	'customer_id'=>$customerId,
            );       
					
            $count = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition($condition, 'count(*)');
            $result='';
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);

                $orderHtml = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><table border="1"><tr>';
				$htmlTitle  = '<td>客户代码</td>';			
    			$htmlTitle .= '<td>采购单号</td>';
    			$htmlTitle .= '<td>供应商代码</td>';
    			$htmlTitle .= '<td>SKU</td>';
    			$htmlTitle .= '<td>产品名称</td>';
    			$htmlTitle .= '<td>采购数量</td>';
    			$htmlTitle .= '<td>待收数量</td>';
    			$htmlTitle .= '<td>状态</td>';
				$htmlTitle .= '<td>创建时间</td>';
    			$htmlTitle .= '<td>备注</td>'; 
                $htmlTitle .='</tr>';
                $orderContent = '';

    			$max = 1;

    			for($page=1;$page<=$pages;$page++){
              		$rows = Service_PurchaseOrderBody::getJoinPurchaseBodyByCondition($condition, '*', $pageSize, $page, array('purchase_order.po_id desc','product.product_id'));
   					if(empty($rows)){continue;}
    				foreach($rows as $keyo=>$row){
					
						$product = Service_Product::getByField($row['product_id'],'product_id');	
						if($product){
							$row['product_sku'] = $product['product_sku'];
							$row['product_title'] = $product['product_title'];
						}
						
						$row['pobd_status_text'] = Service_PurchaseOrderProcess::getStatusText($row['pobd_status']);												
						$row['rest_quantity'] =   $row['order_quantity']- $row['received_quantity'];
    					$orderContent.="<tr>";
						//客户代码
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customer_code}</td>";
						//采购单号						
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['po_code']}</td>";
						//供应商代码
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['supply_code']}</td>";
						//SKU
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['product_sku']}</td>";
						//产品名称
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['product_title']}</td>";
						//采购数量
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['order_quantity']}</td>";
						//待收数量
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['rest_quantity']}&nbsp;</td>";
						//状态
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['pobd_status_text']}</td>";
						//创建时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['create_time']}</td>";
						//备注
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['po_description']}&nbsp;</td>";
						$orderContent.="</tr>";                        
    				}

    			}

    	        header('Pragma:public');
    			header('Content-Type:application/x-msexecl;name="' . $fileName );
    	        header("Content-Disposition:inline;filename=" . $fileName );
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	}
    	exit;
    }
	




   /**
     * @author colin
     * @todo 用于导出收货信息
     */
    public function outofareaReceivedExportAction(){
		set_time_limit(0);
    	$customer = $this->_customerAuth;
    	$customerId = $customer['id'];  
		$customer_code = $customer['code'];    	
    	$orderArr = $this->_request->getParam('orderArr','');
    	$exportformat = $this->_request->getParam('dateformate','xls');
    	$exportformat = 'xls';
    	$fileName = 'outofareaReceived'.date('YmdHis').'.'.$exportformat;

    	if(!empty($orderArr)){		//通过选择的订单获取
					
    		if($exportformat=='xls'){
    			$orderHtml = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><table border="1"><tr>';
				$htmlTitle  = '<td>客户代码</td>';			
    			$htmlTitle .= '<td>快递单号</td>';
				$htmlTitle .= '<td>快递公司</td>';
				$htmlTitle .= '<td>采购单号</td>';
    			$htmlTitle .= '<td>供应商代码</td>';
    			$htmlTitle .= '<td>SKU</td>';
    			$htmlTitle .= '<td>产品名称</td>';
    			$htmlTitle .= '<td>实收数量</td>';    			
    			$htmlTitle .= '<td>状态</td>';
				$htmlTitle .= '<td>收货单号</td>';
				$htmlTitle .= '<td>创建时间</td>';
    			$htmlTitle .= '<td>备注</td>';              
    			$htmlTitle .='</tr>';
    			$orderContent = '';
    			$max = 1;
    			foreach($orderArr as $key=>$po_tb_id){
						$data_rows = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition(array('po_tb_id'=>$po_tb_id,'customer_id'=>$customerId));  				
						if(empty($data_rows)){continue;}						
						$data_row = $data_rows[0];		
					
						if($data_row['receiving_id']){
							$receiving = Service_Receiving::getByField($data_row['receiving_id'],'receiving_id');
							if($receiving){
								$data_row['receiving_code'] = $receiving['receiving_code'];
							}
						
						}

						if($data_row['po_id']){
							$po = Service_PurchaseOrder::getByField($data_row['po_id'],'po_id');
							if($po){
								$data_row['po_code'] = $po['po_code'];
								$data_row['supply_code'] = $po['supply_code'];
							}
						}						
						$data_row['po_tb_status_text'] = Service_PurchaseOrderTrackingProcess::getStatusText($data_row['po_tb_status']);		
						
						
					
						 
						 
						 $orderContent.="<tr>";
						 //客户代码
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customer_code}</td>";					 
						 //快递单号						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['tracking_number']}</td>";
						 //快递公司						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['express_company']}</td>";
						 //采购单号
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['po_code']}</td>";						
						 //供应商代码						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['supply_code']}</td>";
						 //SKU
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['product_sku']}</td>";
						 //产品名称
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['product_title']}</td>";
						 //实收数量
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['received_quantity']}</td>";
						 //状态
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['po_tb_status_text']}</td>";
						 //收货单号
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['receiving_code']}</td>";						 
						 //创建时间	
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['create_time']}</td>";
						 //备注
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$data_row['note']}</td>";	
						 					 	 
						 $orderContent.="</tr>";                   
    				 

    			}

				$html = $orderHtml.$htmlTitle.$orderContent.'</table>';				

								
    	        header('Pragma:public');		
    			header('Content-Type:application/x-msexecl;name="' . $fileName );
    	        header("Content-Disposition:inline;filename=" . $fileName );
    			//file_put_contents(APPLICATION_PATH . "/../data/{$fileName}",$html);
				echo $html;
    			exit;
    			//echo $orderHtml;exit;
    			
    		}   			
    	}else{
    		//获取全部情况
    		$condition = array();

            $tracking_number = trim($this->_request->getParam('tracking_number', ''));
            $po_code = $this->_request->getParam('po_code', '');       
         

            $created_start	= trim($this->_request->getParam('created_start',''));
            $created_end	= trim($this->_request->getParam('created_end',''));
            $created_start	= ($created_start)?$created_start.' 00:00:00':'';
            $created_end	= ($created_end)?$created_end.' 59:59:59':'';           
            $condition = array(
                'tracking_number' => $tracking_number,               
                'po_code' => $po_code,               
                'customer_id' => $customerId,
				'created_start'=>$created_start,
            	'created_end'  =>$created_end,            	
            );       
			 
            $count = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition($condition, 'count(*)');
			$result='';
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);

                $orderHtml = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><table border="1"><tr>';
				$htmlTitle  = '<td>客户代码</td>';			
    			$htmlTitle .= '<td>快递单号</td>';
				$htmlTitle .= '<td>快递公司</td>';
				$htmlTitle .= '<td>采购单号</td>';
    			$htmlTitle .= '<td>供应商代码</td>';
    			$htmlTitle .= '<td>SKU</td>';
    			$htmlTitle .= '<td>产品名称</td>';
    			$htmlTitle .= '<td>实收数量</td>';    			
    			$htmlTitle .= '<td>状态</td>';
				$htmlTitle .= '<td>收货单号</td>';
				$htmlTitle .= '<td>创建时间</td>';
    			$htmlTitle .= '<td>备注</td>'; 
                $htmlTitle .='</tr>';
                $orderContent = '';

    			$max = 1;

    			for($page=1;$page<=$pages;$page++){
              		$rows = Service_PurchaseOrderTrackingBody::getJoinPurchaseTrackingBodyByCondition($condition, '*', $pageSize, $page, array('purchase_order.po_id desc','product.product_id'));
   					if(empty($rows)){continue;}
    				foreach($rows as $keyo=>$row){
					
						
						
						if($row['receiving_id']){
							$receiving = Service_Receiving::getByField($row['receiving_id'],'receiving_id');
							if($receiving){
								$row['receiving_code'] = $receiving['receiving_code'];
							}
						
						}

						if($row['po_id']){
							$po = Service_PurchaseOrder::getByField($row['po_id'],'po_id');
							if($po){
								$row['po_code'] = $po['po_code'];
								$row['supply_code'] = $po['supply_code'];
							}
						}						
						$row['po_tb_status_text'] = Service_PurchaseOrderTrackingProcess::getStatusText($row['po_tb_status']);		
						
    					 $orderContent.="<tr>";
						 //客户代码
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customer_code}</td>";					 
						 //快递单号						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['tracking_number']}</td>";
						 //快递公司						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['express_company']}</td>";
						 //采购单号
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['po_code']}</td>";						
						 //供应商代码						 
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['supply_code']}</td>";
						 //SKU
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['product_sku']}</td>";
						 //产品名称
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['product_title']}</td>";
						 //实收数量
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['received_quantity']}</td>";
						 //状态
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['po_tb_status_text']}</td>";
						 //收货单号
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['receiving_code']}</td>";						 
						 //创建时间	
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['create_time']}</td>";
						 //备注
						 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['note']}</td>";
						$orderContent.="</tr>";                        
    				}

    			}

    	        header('Pragma:public');
    			header('Content-Type:application/x-msexecl;name="' . $fileName );
    	        header("Content-Disposition:inline;filename=" . $fileName );
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	}
    	exit;
    }
	
	
	
	
	
	
}