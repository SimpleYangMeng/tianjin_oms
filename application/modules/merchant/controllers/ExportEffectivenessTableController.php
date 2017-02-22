<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-7-5
 * Time: 下午4:51
 * To change this template use File | Settings | File Templates.
 */
class Merchant_ExportEffectivenessTableController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/timeeffectivetable/";
        $params = self::getFrontController()->getRequest()->getParams();
        $this->view->ac = $params['action'];
    }

    public function indexAction(){ 
		$this->view->current_date = date('Y-m-d');      
        echo Ec::renderTpl($this->tplDirectory . "index.tpl",'noleftlayout');
    }	
	//colin
	public function exportAction(){	
		set_time_limit(500);
		$stype_s = $this->_request->getParam('stype_s','');
		//导出类型
		if(!in_array($stype_s,array('1','2','3'))){ 
			$stype_s = '1';
		}
		
		$time_start = $this->_request->getParam('time_start');
		$time_end = $this->_request->getParam('time_end');
		
		if(empty($time_start) || empty($time_end)){ 
			die("日期必须选择");		
		}
		$date_array = explode('-',$time_start);
		if(!checkdate($date_array[1],$date_array[2],$date_array[0])){
			die("开始日期错误");
		}
				
		$date_array = explode('-',$time_end);
		if(!checkdate($date_array[1],$date_array[2],$date_array[0])){
			die("结束日期错误");
		}
		if(strtotime($time_end)<strtotime($time_start)){
			die("结束日期一定要小于开始日期");
		}
		
		
		switch($stype_s){
			case '1':
				$this->exportbhasnAction($time_start,$time_end);
			break;
			case '2':
				$this->exportbhorderAction($time_start,$time_end);			
			break;
			case '3':
				$this->exportjhorderAction($time_start,$time_end);
			break;						
		
		}
		
		  
	}
	
	
	
  /**
     * @author colin-yang
     * @todo 用于导出ASN记录
     */
    private function exportbhasnAction($time_start='',$time_end=''){   	
    	

			$customer = $this->_customerAuth;
			$customerId = $customer['id']; 
			$red_str_yes = vsprintf("<span style='color:red'>%s</span>",array('是'));		
			$exportformat = 'xls';
			$fileName = 'export_bhasn_with_time'.date('YmdHis');
			header('Pragma:public');
			header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
			header('Content-Type:application/x-msexcel;charset=utf-8;name="' . $fileName . ".{$exportformat}");
			header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");    	

			$condition = array();
			$condition['customer_id'] = $customerId;
			$condition['created_start'] = $time_start;
			$condition['created_end'] = $time_end;
			$condition['receive_model_type'] = '0';
   			
        	$count =  Service_Receiving::getByCondition($condition,"count(*)");    		
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);
    			$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
    			$orderHtml .= '<table border="1">';
				$htmlTitle = '<tr>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" colspan="7" align="right">01-订单ASN</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">01-订单ASN</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">02-国际运输</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">02-国际运输</th>';	
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">&nbsp;</th>';			
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">03-仓库到货</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">04-仓库质检</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">05-仓库收货完成</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">&nbsp;</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;"  align="right">&nbsp;</th>';
				$htmlTitle .= '</tr>';
				$htmlTitle .= '<tr>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">库存类型</td>';			
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">所在仓库</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">ASN当前状态</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">累计时效</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">收货单号</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">客户参考号</td>';
                $htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">ASN创建时间</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">ASN在途时间</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">国际运输发货时间</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">国际运输到货时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">仓库到货时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">仓库质检时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">仓库收货上架时间</td>';				
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">备注</td>';												  
				$htmlTitle .= '</tr>'; 
    			$titlesku = '';
    			$orderContent = '';
    			
    			$max = 1;
    			
    			for($page=1;$page<=$pages;$page++){
    				$rows = Service_Receiving::getByCondition($condition, '*', $pageSize,$page,'receiving_id desc');
    				foreach($rows as $keyo=>$receiving_info){

					 	if(empty($receiving_info)){ continue;}						
						$last_status = $receiving_info['receiving_add_time'];
																	
					 	if($receiving_info['warehouse_id']){
					 		$warehouse_row  = Service_Warehouse::getByField($receiving_info['warehouse_id'],'warehouse_id');
							$receiving_info['warehouse_name'] = $warehouse_row['warehouse_name'];
					 	}
						
						$receive_attrbute_array = Service_ReceivingAttribute::getByField($receiving_info['receiving_code'],'receiving_code');
				 		if($receive_attrbute_array){
							$receiving_info['onway_time'] = $receive_attrbute_array['onway_time'];
							$receiving_info['receiving_time'] = $receive_attrbute_array['receiving_time'];
							$receiving_info['quality_time'] = $receive_attrbute_array['quality_time'];
							$receiving_info['shelf_time'] = $receive_attrbute_array['shelf_time'];
							
						}
						$receiving_info['receiving_status_text'] = Service_AsnProccess::getAsnTypeText('0','0',$receiving_info['receiving_status']);
						//receiving_status_text//
						if($receiving_info['receiving_add_time']=='0000-00-00 00:00:00'){ $receiving_info['receiving_add_time']=""; }
						if($receiving_info['onway_time']=='0000-00-00 00:00:00'){ $receiving_info['onway_time'] = '';}
						if($receiving_info['expected_date']=='0000-00-00 00:00:00'){ $receiving_info['expected_date']=""; }
						if($receiving_info['eda_date']=='0000-00-00 00:00:00'){ $receiving_info['eda_date']=""; }						
						if($receiving_info['receiving_time']=='0000-00-00 00:00:00'){ $receiving_info['receiving_time']=""; }
						if($receiving_info['quality_time']=='0000-00-00 00:00:00'){ $receiving_info['quality_time'] = '';}
						if($receiving_info['shelf_time']=='0000-00-00 00:00:00'){ $receiving_info['shelf_time'] = '';}											

						$receiving_info['last_status_time'] = $receiving_info['receiving_add_time'];
	
						if($receiving_info['receiving_status']=='7'){//如果是已收货完成状态
							$receiving_info['last_status_time'] = 	$receiving_info['shelf_time'];					
						}else{
							$receiving_info['last_status_time'] = 	date('Y-m-d H:i:s');	
						}
						
						$receiving_info['total_export_effectiveness'] = 0;
						if($receiving_info['last_status_time'] && $receiving_info['receiving_add_time'] && strtotime($receiving_info['last_status_time'])>=strtotime($receiving_info['receiving_add_time'])){							
							$distance = strtotime($receiving_info['last_status_time']) - strtotime($receiving_info['receiving_add_time']);							
							$receiving_info['total_export_effectiveness'] = number_format($distance/3600,2);
							
						}
												
						//时效1
						$receiving_info['is_time_over1'] = "";
						if($receiving_info['expected_date'] && $receiving_info['eda_date'] && strtotime($receiving_info['eda_date'])>=strtotime($receiving_info['expected_date'])){							
							$distance = strtotime($receiving_info['eda_date']) - strtotime($receiving_info['expected_date']);
							
							if($distance>120*3600){
								$receiving_info['is_time_over1'] = $red_str_yes;
							}else{
								$receiving_info['is_time_over1'] = "否";
							}
						}
						
						//时效2
						$receiving_info['is_time_over2'] = "";
						if($receiving_info['shelf_time'] && $receiving_info['receiving_time'] && strtotime($receiving_info['shelf_time'])>=strtotime($receiving_info['receiving_time'])){							
							$distance = strtotime($receiving_info['shelf_time']) - strtotime($receiving_info['receiving_time']);
							
							if($distance>24*3600){
								$receiving_info['is_time_over2'] = $red_str_yes;
							}else{
								$receiving_info['is_time_over2'] = "否";
							}
						}						
						
										
    					 //库存类型
					 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>备货</td>";
    				 	//所在仓库
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['warehouse_name']}</td>";
    				 	//ASN当前状态
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['receiving_status_text']}</td>";    				 	
						//累计时效    				
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['total_export_effectiveness']}</td>";
    				 	//收货单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['receiving_code']}</td>";
    				 	//客户参考号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['reference_no']}</td>";
      				 	//ASN创建时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['receiving_add_time']}</td>";
    				 	//ASN在途时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['onway_time']}</td>";
    				 	//国际运输发货时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['expected_date']}</td>";	
    				 	//国际运输到货时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['eda_date']}</td>";					 
    				 	//是否超期
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['is_time_over1']}</td>";
						//仓库到货时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['receiving_time']}</td>";
						//仓库质检时间
						
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['quality_time']}</td>";	
						//仓库收货上架时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['shelf_time']}</td>";					
    				 	//是否超期
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['is_time_over2']}</td>";						
						//备注
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$receiving_info['receiving_description']}</td>";						
						
    				 	$orderContent.="</tr>"; 		 
	    				
	    				
	    				
    				}
    				 
    			}    			
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	
    	exit;
    }//function end	




  /**
     * @author colin-yang
     * @todo 用于导出备货订单记录
     */
    private function exportbhorderAction($time_start='',$time_end=''){   	
    	

    	$customer = $this->_customerAuth;
    	$customerId = $customer['id'];    	
    	
		$red_str_yes = vsprintf("<span style='color:red'>%s</span>",array('是'));	
    		
    	$exportformat = 'xls';
    	$fileName = 'export_bhorder_with_time'.date('YmdHis');
    	header('Pragma:public');
    	header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
		header('Content-Type:application/x-msexcel;charset=utf-8;name="' . $fileName . ".{$exportformat}");
    	header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");    	
    	
		
		
		
			$condition = array();
			$condition['customer_id'] = $customerId;
			$condition['add_time_start'] = $time_start;
			$condition['add_time_end'] = $time_end;	
			$condition['order_mode_type'] = '0';		
			
		     
   		
        	$count =  Service_Orders::getByCondition($condition,"count(*)");    		
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);
    			$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
    			$orderHtml .= '<table border="1">';
				$htmlTitle  ="<tr>";
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" colspan="7" align="right">备货订单发货关注环节</td>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">01-订单创建</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">01-订单创建</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">02-订单处理</th>';	
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">02-订单处理</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">&nbsp;</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">03-清关中</th>';	
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">04-清关完毕</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">05-订单出库</th>';				
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;">&nbsp;</th>';
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">06-订单入网</th>';	
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;">&nbsp;</th>';	
				$htmlTitle .= '<th style="vnd.ms-excel.numberformat:@;" align="right">07-订单签收</th>';	
				$htmlTitle .="</tr>";
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">库存类型</td>';			
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">所在仓库</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单当前状态</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">累计时效</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">交易订单号</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单号</td>';
                $htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">快递单号</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单创建时间</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单提交时间</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">仓库配货单打印时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单装袋时间（快递单号反馈时间）</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">收件人证件上传时间（清关申报开始时间）</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单加挂时间（清关完毕时间）</td>';				
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单出库时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">物流入网时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单已签收时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">备注</td>';
				
																  
				$htmlTitle .= '</tr>'; 
    			$titlesku = '';
    			$orderContent = '';
    			
    			$max = 1;
    			
    			for($page=1;$page<=$pages;$page++){
    				$rows = Service_Orders::getByCondition($condition, '*', $pageSize,$page,'order_id desc');
    				foreach($rows as $keyo=>$row){

					 	if(empty($row)){ continue;}
					 	if($row['warehouse_id']){
					 		$warehouse_row  = Service_Warehouse::getByField($row['warehouse_id'],'warehouse_id');
							$row['warehouse_name'] = $warehouse_row['warehouse_name'];
					 	}	
						$row['order_status_text']= Service_OrderProcess::getOrderStrictStatusText($row['order_status']);					
						$ship_order = Service_ShipOrder::getByField($row['order_code'],'order_code');
						if($ship_order){
							$row['tracking_number'] = $ship_order['tracking_number'];
						}
						$OrderOperationTimeArray = Service_OrderOperationTime::getByField($row['order_code'],'order_code');
						if(!empty($OrderOperationTimeArray)){
							$row['submit_time'] = $OrderOperationTimeArray['submit_time'];
							$row['pack_time'] = $OrderOperationTimeArray['pack_time'];
							$row['ship_time'] = $OrderOperationTimeArray['ship_time'];
							$row['clearance_time'] = $OrderOperationTimeArray['clearance_time'];
							$row['mount_time'] = $OrderOperationTimeArray['mount_time'];
							$row['shipment_time'] = $OrderOperationTimeArray['shipment_time'];
							$row['import_time'] = $OrderOperationTimeArray['import_time'];
							$row['delivered_time'] = $OrderOperationTimeArray['delivered_time'];
						}
	
						if($row['add_time']=='0000-00-00 00:00:00'){ $row['add_time']=""; }
						if($row['submit_time']=='0000-00-00 00:00:00'){ $row['submit_time']=""; }
						if($row['pack_time']=='0000-00-00 00:00:00'){ $row['pack_time']=""; }						
						if($row['ship_time']=='0000-00-00 00:00:00'){ $row['ship_time']=""; }
						if($row['shipment_time']=='0000-00-00 00:00:00'){ $row['shipment_time']=""; }
						if($row['clearance_time']=='0000-00-00 00:00:00'){ $row['clearance_time']=""; }
						if($row['mount_time']=='0000-00-00 00:00:00'){ $row['mount_time']=""; }
						if($row['import_time']=='0000-00-00 00:00:00'){ $row['import_time']=""; }
						if($row['delivered_time']=='0000-00-00 00:00:00'){ $row['delivered_time']=""; }												

						if($row['order_status']=='13'){							
							$row['last_status_time'] = $row['delivered_time'];
						}else{
							$row['last_status_time'] = date('Y-m-d H:i:s');
						}

						$row['total_export_effectiveness'] = 0;
						if($row['last_status_time'] && $row['add_time'] && strtotime($row['last_status_time'])>=strtotime($row['add_time'])){							
							$distance = strtotime($row['last_status_time']) - strtotime($row['add_time']);
							$row['total_export_effectiveness'] = number_format($distance/3600,2);
							
						}							
						
						//时效1(订单装袋时间-订单提交时间) 
						$row['is_time_over1'] = "";
						if($row['ship_time'] && $row['submit_time'] && strtotime($row['ship_time'])>=strtotime($row['submit_time'])){							
							$distance = strtotime($row['ship_time']) - strtotime($row['submit_time']);
							
							if($distance>24*3600){
								$row['is_time_over1'] = $red_str_yes;
							}else{
								$row['is_time_over1'] = "否";
							}
						}
						
						//时效2(订单出库时间-收件人证件上传时间) 
						$row['is_time_over2'] = "";
						if($row['shipment_time'] && $row['clearance_time'] && strtotime($row['shipment_time'])>=strtotime($row['clearance_time'])){							
							$distance = strtotime($row['shipment_time']) - strtotime($row['clearance_time']);
							
							if($distance>24*3600){
								$row['is_time_over2'] = $red_str_yes;
							}else{
								$row['is_time_over2'] = "否";
							}
						}	


						//时效3(物流入网时间-订单出库时间) 
						$row['is_time_over3'] = "";
						if($row['import_time'] && $row['shipment_time'] && strtotime($row['import_time'])>=strtotime($row['shipment_time'])){							
							$distance = strtotime($row['import_time']) - strtotime($row['shipment_time']);
							
							if($distance>24*3600){
								$row['is_time_over3'] = $red_str_yes;
							}else{
								$row['is_time_over3'] = "否";
							}
						}
						
						//时效4(订单已签收时间-物流入网时间) 
						$row['is_time_over4'] = "";
						if($row['delivered_time'] && $row['import_time'] && strtotime($row['delivered_time'])>=strtotime($row['import_time'])){							
							$distance = strtotime($row['delivered_time']) - strtotime($row['import_time']);
							
							if($distance>168*3600){
								$row['is_time_over4'] = $red_str_yes;
							}else{
								$row['is_time_over4'] = "否";
							}
						}												
																
						
						
    					 //库存类型
					 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>备货</td>";
    				 	//所在仓库
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['warehouse_name']}</td>";
					 	//订单当前状态
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['order_status_text']}</td>";					
    				 	//累计时效    				
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['total_export_effectiveness']}</td>";
    				 	//交易订单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['reference_no']}</td>";
    				 	//订单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['order_code']}</td>";
      				 	//快递单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['tracking_number']}</td>";
    				 	//订单创建时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['add_time']}</td>";
    				 	//订单提交时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['submit_time']}</td>";	
    				 	//仓库配货单打印时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['pack_time']}</td>";					 
    				 	//订单装袋时间（快递单号反馈时间）
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['ship_time']}</td>";
						//是否超期
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over1']}</td>";
						//收件人证件上传时间（清关申报开始时间）
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['clearance_time']}</td>";	
						//订单加挂时间（清关完毕时间）
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['mount_time']}</td>";
						//订单出库时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['shipment_time']}</td>";											
						//是否超期
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over2']}</td>";
						//物流入网时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['import_time']}</td>";
						//是否超期
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over3']}</td>";	
						//订单已签收时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['delivered_time']}</td>";
						//是否超期
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over4']}</td>";					
						//备注
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['remark']}</td>";						
						
    				 	$orderContent.="</tr>"; 		 
	    				
	    				
	    				
    				}
    				 
    			}    			
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	
    	exit;
    }//function end		



  /**
     * @author colin-yang
     * @todo 用于导出集货订单记录 2014-04-15
     */
    private function exportjhorderAction($time_start='',$time_end=''){   	
    	

    	$customer = $this->_customerAuth;
    	$customerId = $customer['id'];    	
		$red_str_yes = vsprintf("<span style='color:red'>%s</span>",array('是'));	
    	$exportformat = 'xls';
    	$fileName = 'export_jhorder_with_time'.date('YmdHis');
    	header('Pragma:public');
    	header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
		header('Content-Type:application/x-msexcel;charset=utf-8;name="' . $fileName . ".{$exportformat}");
    	header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");    	
    	
			
		
			$condition = array();
			$condition['customer_id'] = $customerId;
			$condition['add_time_start'] = $time_start;
			$condition['add_time_end'] = $time_end;		
			$condition['order_mode_type'] = '1';		
		     
   		
        	$count =  Service_Orders::getByCondition($condition,"count(*)");    		
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);
    			$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
    			$orderHtml .= '<table border="1">';
				$htmlTitle = '<tr>';
				$htmlTitle .= '<th colspan="8" align="right">集货订单关注环节</th>';
				$htmlTitle .= '<th align="right">01-订单创建</th>';	
				$htmlTitle .= '<th align="right">01-订单创建</th>';
				$htmlTitle .= '<th align="right">02-订单ASN</th>';
				$htmlTitle .= '<th align="right">02-订单ASN</th>';
				$htmlTitle .= '<th align="right">03-国际运输</th>';	
				$htmlTitle .= '<th align="right">03-国际运输</th>';	
				$htmlTitle .= '<th align="right">&nbsp;</th>';
				$htmlTitle .= '<th align="right">04-仓库到货</th>';
				$htmlTitle .= '<th align="right">05-仓库收货</th>';
				$htmlTitle .= '<th align="right">06-订单处理</th>';
				$htmlTitle .= '<th align="right">07-清关中</th>';
				$htmlTitle .= '<th align="right">08-清关完毕</th>';
				$htmlTitle .= '<th align="right">09-订单出库</th>';
				$htmlTitle .= '<th align="right">&nbsp;</th>';
				$htmlTitle .= '<th align="right">10-订单入网</th>';
				$htmlTitle .= '<th align="right">&nbsp;</th>';
				$htmlTitle .= '<th align="right">11-订单签收</th>';	
				$htmlTitle .= '<th align="right">&nbsp;</th>';	
				$htmlTitle .= '<th align="right">&nbsp;</th>';	
				$htmlTitle .= '</tr>';
				$htmlTitle .= '<tr>';				
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">库存类型</td>';			
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">所在仓库</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单当前状态</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">累计时效</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">交易订单号</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单号</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">收货单号</td>';
                $htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">快递单号</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单创建时间</td>';
    			$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单提交时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">ASN创建时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">ASN在途时间（客户发货时间）</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">国际运输发货时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">国际运输到货时间</td>';						
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';	
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">仓库到货时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">仓库收货时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单装袋时间（快递单号反馈时间）</td>';				
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">收件人证件上传时间（清关申报开始时间）</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单加挂时间（清关完毕时间）</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单出库时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">物流入网时间</td>';				
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">订单已签收时间</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">是否超期</td>';
				$htmlTitle .= '<td style="vnd.ms-excel.numberformat:@;">备注</td>';																  
				$htmlTitle .= '</tr>';
 
    			$titlesku = '';
    			$orderContent = '';
    			
    			$max = 1;
    			
    			for($page=1;$page<=$pages;$page++){
    				$rows = Service_Orders::getByCondition($condition, '*', $pageSize,$page,'order_id desc');
    				foreach($rows as $keyo=>$row){

					 	if(empty($row)){ continue;}
					 	if($row['warehouse_id']){
					 		$warehouse_row  = Service_Warehouse::getByField($row['warehouse_id'],'warehouse_id');
							$row['warehouse_name'] = $warehouse_row['warehouse_name'];
					 	}	
						
						$row['order_status_text']= Service_OrderProcess::getOrderStrictStatusText($row['order_status']);
											
						$ship_order = Service_ShipOrder::getByField($row['order_code'],'order_code');
						if($ship_order){
							$row['tracking_number'] = $ship_order['tracking_number'];
						}
						$OrderOperationTimeArray = Service_OrderOperationTime::getByField($row['order_code'],'order_code');
						if(!empty($OrderOperationTimeArray)){
							$row['submit_time'] = $OrderOperationTimeArray['submit_time'];
							$row['pack_time'] = $OrderOperationTimeArray['pack_time'];
							$row['ship_time'] = $OrderOperationTimeArray['ship_time'];
							$row['clearance_time'] = $OrderOperationTimeArray['clearance_time'];
							$row['mount_time'] = $OrderOperationTimeArray['mount_time'];
							$row['import_time'] = $OrderOperationTimeArray['import_time'];
							$row['delivered_time'] = $OrderOperationTimeArray['delivered_time'];
							$row['shipment_time'] = $OrderOperationTimeArray['shipment_time'];
							
						}
						
						
						$ReceivingOrderDetail = Service_ReceivingOrderDetail::getByField($row['order_code'],'order_code');
						if($ReceivingOrderDetail){
							$receiving_code = $ReceivingOrderDetail['receiving_code'];
							$Receiving = Service_Receiving::getByField($receiving_code,'receiving_code');
							
							$receive_attrbute_array = Service_ReceivingAttribute::getByField($receiving_code,'receiving_code');
							if($receive_attrbute_array){
								$row['onway_time'] = $receive_attrbute_array['onway_time'];
								$row['receiving_time'] = $receive_attrbute_array['receiving_time'];
								$row['quality_time'] = $receive_attrbute_array['quality_time'];
								$row['shelf_time'] = $receive_attrbute_array['shelf_time'];
								$row['receiving_time'] = $receive_attrbute_array['receiving_time'];
								
							}
							if($Receiving){
								$row['expected_date'] = $Receiving['expected_date'];
								$row['eda_date'] = $Receiving['eda_date'];	
								$row['receiving_code'] = $Receiving['receiving_code'];	
							}
							
						}
						
						if($row['add_time']=='0000-00-00 00:00:00'){ $row['add_time']=""; }
						if($row['submit_time']=='0000-00-00 00:00:00'){ $row['submit_time']=""; }
						if($row['expected_date']=='0000-00-00 00:00:00'){ $row['expected_date']=""; }
						if($row['eda_date']=='0000-00-00 00:00:00'){ $row['eda_date']=""; }
						if($row['receiving_time']=='0000-00-00 00:00:00'){ $row['receiving_time']=""; }
						if($row['ship_time']=='0000-00-00 00:00:00'){ $row['ship_time']=""; }
						if($row['clearance_time']=='0000-00-00 00:00:00'){ $row['clearance_time']=""; }						
						if($row['import_time']=='0000-00-00 00:00:00'){ $row['import_time']=""; }
						if($row['mount_time']=='0000-00-00 00:00:00'){ $row['mount_time']=""; }
						if($row['shipment_time']=='0000-00-00 00:00:00'){ $row['shipment_time']=""; }
						if($row['delivered_time']=='0000-00-00 00:00:00'){ $row['delivered_time']=""; }
						
						if($row['order_status'] =='13'){							
							$row['last_status_time'] = $row['delivered_time'];
						}else{
							$row['last_status_time'] = date('Y-m-d H:i:s');
						}					
						
							
						$row['total_export_effectiveness'] = 0;
						if($row['last_status_time'] && $row['add_time'] && strtotime($row['last_status_time'])>=strtotime($row['add_time'])){							
							$distance = strtotime($row['last_status_time']) - strtotime($row['add_time']);							
								$row['total_export_effectiveness'] = number_format($distance/3600,2);							
						}						
						
						
						//时效1国际运输到货时间-ASN在途时间（客户发货时间） 
						$row['is_time_over1'] = "";
						if($row['eda_date'] && $row['expected_date'] && strtotime($row['eda_date'])>=strtotime($row['expected_date'])){							
							$distance = strtotime($row['eda_date']) - strtotime($row['expected_date']);
							
							if($distance>120*3600){
								$row['is_time_over1'] = $red_str_yes;
							}else{
								$row['is_time_over1'] = "否";
							}
						}							


						//时效2 订单出库时间 - 订单装袋时间
						$row['is_time_over2'] = "";
						if($row['shipment_time'] && $row['ship_time'] && strtotime($row['eda_date'])>=strtotime($row['expected_date'])){							
							$distance = strtotime($row['shipment_time']) - strtotime($row['ship_time']);
							
							if($distance>48*3600){
								$row['is_time_over2'] = $red_str_yes;
							}else{
								$row['is_time_over2'] = "否";
							}
						}	
						
						
						
						//时效3(物流入网时间-订单出库时间) 
						$row['is_time_over3'] = "";
						if($row['import_time'] && $row['shipment_time'] && strtotime($row['import_time'])>=strtotime($row['shipment_time'])){							
							$distance = strtotime($row['import_time']) - strtotime($row['shipment_time']);
							
							if($distance>24*3600){
								$row['is_time_over3'] = $red_str_yes;
							}else{
								$row['is_time_over3'] = "否";
							}
						}
						
						//时效4(订单已签收时间-物流入网时间) 
						$row['is_time_over4'] = "";
						if($row['delivered_time'] && $row['import_time'] && strtotime($row['delivered_time'])>=strtotime($row['import_time'])){							
							$distance = strtotime($row['delivered_time']) - strtotime($row['import_time']);
							
							if($distance>168*3600){
								$row['is_time_over4'] = $red_str_yes;
							}else{
								$row['is_time_over4'] = "否";
							}
						}							
											
    					 //库存类型
					 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>集货</td>";
    				 	//所在仓库
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['warehouse_name']}</td>";
    				 	//订单当前状态
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['order_status_text']}</td>";						
    				 	//累计时效    				
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['total_export_effectiveness']}</td>";
    				 	//交易订单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['reference_no']}</td>";
    				 	//订单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['order_code']}</td>";
    				 	//收货单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['receiving_code']}</td>";						
      				 	//快递单号
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['tracking_number']}</td>";
    				 	//订单创建时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['add_time']}</td>";
    				 	//订单提交时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['submit_time']}</td>";
    				 	//ASN创建时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['submit_time']}</td>";						
						//ASN在途时间（客户发货时间）
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['submit_time']}</td>";
						//国际运输发货时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['expected_date']}</td>";
						//国际运输到货时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['eda_date']}</td>";	
						//是否超期
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over1']}</td>";												
    				 	//仓库到货时间
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['receiving_time']}</td>";				 
    				 	//仓库收货时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['receiving_time']}</td>";
						
						//订单装袋时间（快递单号反馈时间）
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['ship_time']}</td>";											
						//收件人证件上传时间（清关申报开始时间）
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['clearance_time']}</td>";												
						//订单加挂时间（清关完毕时间）
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['mount_time']}</td>";
						//订单出库时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['shipment_time']}</td>";						
						//是否超期						
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over2']}</td>";							
						//物流入网时间
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['import_time']}</td>";
						//是否超期						
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over3']}</td>";
						//订单已签收时间						
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['delivered_time']}</td>";						
						//是否超期
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['is_time_over4']}</td>";					
						//备注
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$row['remark']}</td>";						
						
    				 	$orderContent.="</tr>"; 		 
	    				
	    				
	    				
    				}
    				 
    			}    			
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	
    	exit;
    }//function end	



  
}
