<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-7-5
 * Time: 下午4:51
 * To change this template use File | Settings | File Templates.
 */
class Merchant_InventoryController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/inventory/";
        $params = self::getFrontController()->getRequest()->getParams();
        $this->view->ac = $params['action'];
    }

    public function listAction(){
	
		$lang=Ec_Lang::getInstance()->getCurrentLanguage();
		$this->view->lang = $lang;
        $page		= $this->getRequest()->getParam('page', 1);
        $pageSize	= $this->getRequest()->getParam('pageSize', 20);
        $session	= new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
		
		$product_sku_s = trim($this->_request->getParam('product_sku_s',""));
		$warehouse_id_s = $this->_request->getParam('warehouse_id_s',"");
        $product_title = $this->_request->getParam("product_title","");
		/*$formvar_array = array(
            'product_sku'		=> $product_sku_s,       
            'warehouse_id'  => $warehouse_id_s,
        );  
		
		$product_id_array = array();
		if($product_sku_s){
			$product_array = Service_Product::getByCondition(array('comefrom'=>1,'product_sku'=>$product_sku_s));
			if($product_array){	
				foreach($product_array as $row){		
					$product_id_array[] = $row['product_id'];
				}
			}
		}*///if($product_sku_s){
		
		
        $condition	= array(
            //'product_id_array'=>$product_id_array,
            'product_sku'=>$product_sku_s,
            'warehouse_id'=>$warehouse_id_s,
            'customer_id'=>$sessionData['id'],
            'product_title'=>$product_title,
        ); 
		     
   		
        $count =  Service_ProductInventory::getJoinProductByCondition($condition,"count(*)");
        $this->view->count = $count;
        $this->view->condition		= $condition;
        $this->view->pageSize	= $pageSize;
        $page = $page>ceil($count/$pageSize)?ceil($count/$pageSize):$page;
        $this->view->page		= $page;
        $result =  Service_ProductInventory::getJoinProductByCondition($condition,"*",$pageSize,$page,"product_barcode DESC");
        foreach($result as $key=>$value){
            //$product_row = Service_Product::getByField($value['product_id'],"product_id","*");
            //$result[$key]['product_sku'] = $product_row['product_sku'];
            $sf = Service_SafeInventory::getByCondition(
                array(
                    'product_sku'=>$value['product_sku'],
                    'warehouse_id'=>$value['warehouse_id']
                ),"*");
            $result[$key]['safe_number'] = isset($sf[0]['safe_number'])?$sf[0]['safe_number']:"0";
			
			if($value['warehouse_id']){
			$warehouse_row  = Service_Warehouse::getByField($value['warehouse_id'],'warehouse_id');
			$result[$key]['warehouse_name'] = $warehouse_row['warehouse_name'];
			}
        }
		
        $this->view->result = $result;
      	$allWarehouse = Service_Warehouse::getByCondition();
		$this->view->allWarehouse = $allWarehouse;
        echo Ec::renderTpl($this->tplDirectory . "list.tpl",'noleftlayout');
    }
	
	
	
  /**
     * @author colin-yang
     * @todo 用于导出库存记录
     */
    public function exportAction(){
    	/* $productCodes = $this->_request->getParam('productCodes');
    	if(!$productCodes || !is_array($productCodes)){exit("请选择产品");}
    	
    	header("Pragma: public");
    	header("Expires: 0");
    	header("Accept-Ranges: bytes");
    	header(mb_convert_encoding("Content-Disposition: attachment; filename=运单凭证".date('YmdHis').".zip",'gbk','utf-8'));
    	header("Content-Type:APPLICATION/OCTET-STREAM;charset=gb2312"); */
    	

    	$customer = $this->_customerAuth;
    	$customerId = $customer['id'];    	
    	
    	$inventoryArr = $this->_request->getParam('Arr','');    	
    	$exportformat = 'xls';
    	$fileName = 'inventory'.date('YmdHis');
    	header('Pragma:public');
    	header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
		header('Content-Type:application/x-msexcel;charset=utf-8;name="' . $fileName . ".{$exportformat}");
    	header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");    	
    	
		$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
		
		$sku_lang = Ec_Lang::getInstance()->getTranslate('sku');
		$productTitle_lang = Ec_Lang::getInstance()->getTranslate('productTitle');
		$the_warehouse_lang = Ec_Lang::getInstance()->getTranslate('the_warehouse');
		$onway_lang = Ec_Lang::getInstance()->getTranslate('onway');
		$Pending_lang = Ec_Lang::getInstance()->getTranslate('Pending');
		$Available_lang = Ec_Lang::getInstance()->getTranslate('Available');
		$SafetyStock_lang = Ec_Lang::getInstance()->getTranslate('SafetyStock');
		$Unavailable_lang = Ec_Lang::getInstance()->getTranslate('Unavailable');
		$shipment_occupation_lang = Ec_Lang::getInstance()->getTranslate('shipment_occupation');
		$Shipped_lang = Ec_Lang::getInstance()->getTranslate('Shipped');
		$pqoUpdateTime_lang = Ec_Lang::getInstance()->getTranslate('pqoUpdateTime');
		//echo "<pre>";
    	if(!empty($inventoryArr)){
    		//通过选择的库存记录获取
    		if($exportformat=='xls'){
    			$orderHtml .= '<table border="1"><tr>';	
				$htmlTitle  = "<td>{$sku_lang}</td>";
                $htmlTitle .= "<td>{$productTitle_lang}</td>";
    			$htmlTitle .= "<td>{$the_warehouse_lang}</td>";
    			$htmlTitle .= "<td>{$onway_lang}</td>";
    			$htmlTitle .= "<td>{$Pending_lang}</td>";
    			$htmlTitle .= "<td>{$Available_lang}</td>";
                $htmlTitle .= "<td>{$SafetyStock_lang}</td>";
    			$htmlTitle .= "<td>{$Unavailable_lang}</td>";
    			$htmlTitle .= "<td>{$shipment_occupation_lang}</td>";
    			$htmlTitle .= "<td>{$Shipped_lang}</td>";
                $htmlTitle .= "<td>过期数</td>";
				$htmlTitle .= "<td>{$pqoUpdateTime_lang}</td>";  
				$htmlTitle .= '</tr>';      			
    			$titlesku = '';
    			$orderContent = '';
    			$max = 1;
    			foreach($inventoryArr as $key=>$inventory_id){
    				 
					 $inventory_info = Service_ProductInventory::getByField($inventory_id,'pi_id');
					 if(empty($inventory_info)){ continue;}
					 if($inventory_info['warehouse_id']){
					 	$warehouse_row  = Service_Warehouse::getByField($inventory_info['warehouse_id'],'warehouse_id');
						$inventory_info['warehouse_name'] = $warehouse_row['warehouse_name'];
					 }
    				 //print_r($orderInfo);
    				 $orderContent.="<tr>";
					
					 if($inventory_info['product_id']){
    				 		$product_array = Service_Product::getByField($inventory_info['product_id'],'product_id');
							$inventory_info['product_sku'] = $product_array['product_sku'];						
					 }
    				 //产品SKU
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['product_sku']}</td>";
                     //产品名称
                     $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$product_array['product_title']}</td>";
    				 //仓库
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['warehouse_name']}</td>";
    				 //在途    				
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_onway']}</td>";
    				 //已收货
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_pending']}</td>";
    				 //可用
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_sellable']}</td>";
                    //安全库存
                    $sf = Service_SafeInventory::getByCondition(
                        array(
                            'product_id'=>$inventory_info['product_id'],
                            'warehouse_id'=>$inventory_info['warehouse_id']
                        ),"*");
                    $safeNumber = isset($sf[0]['safe_number'])?$sf[0]['safe_number']:"0";
                    $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>".$safeNumber."</td>";
    				 //问题库存
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_unsellable']}</td>";
    				 //冻结
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_reserved']}</td>";
    				 //已出货
     				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_shipped']}</td>";					     //已过期
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_expired']}</td>";
    				 //更新时间
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_update_time']}</td>";
    				 $orderContent.="</tr>";
    			}   			
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';    			
    			exit;
    			
    		}elseif($exportformat=='csv'){
    			
    		}
    			
    	}else{
    		//获取全部情况
    		$condition = array();
    		/* 以下为提交数据整理 */
    		 
    		$product_sku_s = $this->_request->getParam("product_sku_s","");
			$warehouse_id_s = $this->_request->getParam("warehouse_id_s","");
            $product_title = $this->_request->getParam("product_title","");

			$product_id_array = array();
			if($product_sku_s){
				$product_array = Service_Product::getByCondition(array('comefrom'=>1,'product_sku'=>$product_sku_s));
				if($product_array){	
					foreach($product_array as $row){		
						$product_id_array[] = $row['product_id'];
					}
				}
			}//if($product_sku_s){
			$customer = $this->_customerAuth;
    		$customerId = $customer['id']; 			
       		$condition	= array(
            'product_id_array'=>$product_id_array,       
            'warehouse_id'=>$warehouse_id_s,
			'customer_id'=>	$customerId,
            'product_title'=>$product_title
        	); 
		     
   		
        	$count =  Service_ProductInventory::getJoinProductByCondition($condition,"count(*)");
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);
    			$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
    			$orderHtml .= '<table border="1"><tr>';
				$htmlTitle  = "<td>{$sku_lang}</td>";
                $htmlTitle .= "<td>{$productTitle_lang}</td>";
    			$htmlTitle .= "<td>{$the_warehouse_lang}</td>";
    			$htmlTitle .= "<td>{$onway_lang}</td>";
    			$htmlTitle .= "<td>{$Pending_lang}</td>";
    			$htmlTitle .= "<td>{$Available_lang}</td>";
                $htmlTitle .= "<td>{$SafetyStock_lang}</td>";
    			$htmlTitle .= "<td>{$Unavailable_lang}</td>";
    			$htmlTitle .= "<td>{$shipment_occupation_lang}</td>";
    			$htmlTitle .= "<td>{$Shipped_lang}</td>";
                $htmlTitle .= "<td>过期数</td>";
				$htmlTitle .= "<td>{$pqoUpdateTime_lang}</td>"; 
				$htmlTitle .= '</tr>'; 
    			$titlesku = '';
    			$orderContent = '';
    			
    			$max = 1;
    			
    			for($page=1;$page<=$pages;$page++){
    				$rows = Service_ProductInventory::getJoinProductByCondition($condition, '*', $pageSize,$page,'pi_id desc');
    				foreach($rows as $keyo=>$inventory_info){

					 	if(empty($inventory_info)){ continue;}
					 	if($inventory_info['warehouse_id']){
					 		$warehouse_row  = Service_Warehouse::getByField($inventory_info['warehouse_id'],'warehouse_id');
							$inventory_info['warehouse_name'] = $warehouse_row['warehouse_name'];
					 	}

				 		if($inventory_info['product_id']){
    				 		$product_array = Service_Product::getByField($inventory_info['product_id'],'product_id');
							$inventory_info['product_sku'] = $product_array['product_sku'];						
					 	}						
    					 //产品SKU
					 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['product_sku']}</td>";
                        //产品名称
                        $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$product_array['product_title']}</td>";
    				 	//仓库
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['warehouse_name']}</td>";
    				 	//在途    				
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_onway']}</td>";
    				 	//已收货
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_pending']}</td>";
    				 	//可用
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_sellable']}</td>";
                        //安全库存
                        $sf = Service_SafeInventory::getByCondition(
                            array(
                                'product_id'=>$inventory_info['product_id'],
                                'warehouse_id'=>$inventory_info['warehouse_id']
                            ),"*");
                        $safeNumber = isset($sf[0]['safe_number'])?$sf[0]['safe_number']:"0";
                        $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>".$safeNumber."</td>";
    				 	//问题库存
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_unsellable']}</td>";
    				 	//冻结
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_reserved']}</td>";
    				 	//已出货
     				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_shipped']}</td>";
                        //已过期
                        $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_expired']}</td>";
    				 	//更新时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['pi_update_time']}</td>";
    				 	$orderContent.="</tr>"; 		 
	    				
	    				
	    				
    				}
    				 
    			}    			
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	}
    	exit;
    }	


	

  
}
