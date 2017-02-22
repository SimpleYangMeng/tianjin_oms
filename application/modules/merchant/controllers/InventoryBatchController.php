<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-7-5
 * Time: 下午4:51
 * To change this template use File | Settings | File Templates.
 */
class Merchant_InventoryBatchController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/inventoryBatch/";
        $params = self::getFrontController()->getRequest()->getParams();
        $this->view->ac = $params['action'];
    }
	/*批次库存列表*/
    public function listAction(){
        $page		= $this->getRequest()->getParam('page', 1);
        $pageSize	= $this->getRequest()->getParam('pageSize', 20);
        $session	= new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
		
		$product_sku_s = trim($this->_request->getParam('product_sku_s',""));
		$warehouse_id_s = $this->_request->getParam('warehouse_id_s',"");		
		$receiving_code_s = $this->_request->getParam('receiving_code_s',"");
		$reference_no_s = $this->_request->getParam('reference_no_s',"");
        $ib_expire = $this->_request->getParam("ib_expire","");
        $production_time_start = $this->_request->getParam("production_time_start","");
        $production_time_end = $this->_request->getParam("production_time_end","");
		
		$formvar_array = array(
            'product_sku'		=> $product_sku_s,       
            'warehouse_id'  => $warehouse_id_s,
			'receiving_code'  => $receiving_code_s,
			'reference_no'  => $reference_no_s,
        );  
		
		$product_id_array = array();
		if($product_sku_s){
			$product_array = Service_Product::getByCondition(array('comefrom'=>1,'product_sku'=>$product_sku_s));
			if($product_array){	
				foreach($product_array as $row){		
					$product_id_array[] = $row['product_id'];
				}
			}
		}//if($product_sku_s){	
		
		
        $condition	= array(
			'product_sku'=>$product_sku_s,
            'product_id_array'=>$product_id_array,       
            'warehouse_id'=>$warehouse_id_s,	
			'customer_code'=>$sessionData['code'],	
			'receiving_code'  => $receiving_code_s,
			'reference_no'  => $reference_no_s,
            'ib_expire'=>$ib_expire,
            'production_time_start'=>$production_time_start,
            'production_time_end'=>$production_time_end,
        ); 		     
   		
        $count =  Service_InventoryBatch::getByCondition($condition,"count(*)");
        $this->view->count = $count;
        $this->view->condition		= $condition;
        $this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $result =  Service_InventoryBatch::getByCondition($condition,"*",$pageSize,$page,"ib_id DESC");
        foreach($result as $key=>$value){
            $product_row = Service_Product::getByField($value['product_id'],"product_id","*");
            $result[$key]['product_sku'] = $product_row['product_sku'];
			
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
    	$customerCode = $customer['code'];    	
      $session	= new Zend_Session_Namespace('customerAuth');
      $sessionData = $session->data;
    	
    	$inventoryArr = $this->_request->getParam('Arr','');    	
    	$exportformat = 'xls';
    	$fileName = 'inventorybatch'.date('YmdHis');
    	header('Pragma:public');
    	header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
		header('Content-Type:application/x-msexcel;charset=utf-8;name="' . $fileName . ".{$exportformat}");
    	header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");    	
    	
		$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
		
		$sku_lang = Ec_Lang::getInstance()->getTranslate('sku');
		$warehouse_lang = Ec_Lang::getInstance()->getTranslate('warehouse');		
		$quantity_lang = Ec_Lang::getInstance()->getTranslate('quantity');
		$CustomerReference2_lang = Ec_Lang::getInstance()->getTranslate('CustomerReference2');
		$ReceiveCode_lang = Ec_Lang::getInstance()->getTranslate('ReceiveCode');
		$time_of_putting_on_shelf_lang = Ec_Lang::getInstance()->getTranslate('time_of_putting_on_shelf');
		$updateTime_lang = Ec_Lang::getInstance()->getTranslate('updateTime');
		
		//echo "<pre>";
    	if(!empty($inventoryArr)){
    		//通过选择的库存记录获取
    		if($exportformat=='xls'){
    			$orderHtml .= '<table border="1"><tr>';	
				$htmlTitle  = "<td>{$sku_lang}</td>";			
    			$htmlTitle .= "<td>{$warehouse_lang}</td>";
    			$htmlTitle .= "<td>{$quantity_lang}</td>";
    			$htmlTitle .= "<td>{$CustomerReference2_lang}</td>";
    			$htmlTitle .= "<td>{$ReceiveCode_lang}</td>";
    			$htmlTitle .= "<td>{$time_of_putting_on_shelf_lang}</td>";
    			$htmlTitle .= "<td>{$updateTime_lang}</td>";    			
				$htmlTitle .= '</tr>';      			
    			$titlesku = '';
    			$orderContent = '';
    			$max = 1;
    			foreach($inventoryArr as $key=>$inventory_id){
    				 
					 $inventory_info =  Service_InventoryBatch::getByField($inventory_id,'ib_id');
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
    				 //仓库
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['warehouse_name']}</td>";
    				 //数量   				
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['ib_quantity']}</td>";
    				 //客户参考号
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['reference_no']}</td>";
    				 //入库单号
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['receiving_code']}</td>";
    				 //状态
						 
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['ib_add_time']}</td>";
    				 //更新时间
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['ib_update_time']}</td>";
    				
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
    		 
			$product_sku_s = trim($this->_request->getParam('product_sku_s',""));
			$warehouse_id_s = $this->_request->getParam('warehouse_id_s',"");		
			$receiving_code_s = $this->_request->getParam('receiving_code_s',"");
			$reference_no_s = $this->_request->getParam('reference_no_s',"");
			$product_id_array = array();
			if($product_sku_s){
				$product_array = Service_Product::getByCondition(array('comefrom'=>1,'product_sku'=>$product_sku_s));
				if($product_array){	
					foreach($product_array as $row){		
						$product_id_array[] = $row['product_id'];
					}
				}
			}//if($product_sku_s){

        	$condition	= array(
				'product_sku'=>$product_sku_s,
            	'product_id_array'=>$product_id_array,       
            	'warehouse_id'=>$warehouse_id_s,	
				'customer_code'=>$sessionData['code'],	
				'receiving_code'  => $receiving_code_s,
				'reference_no'  => $reference_no_s,			
        	); 	
		     
   		
        	$count =  Service_ProductInventory::getByCondition($condition,"count(*)");    		
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);
    			$orderHtml = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">';
    			$orderHtml .= '<table border="1"><tr>';
				$htmlTitle  = "<td>{$sku_lang}</td>";			
    			$htmlTitle .= "<td>{$warehouse_lang}</td>";
    			$htmlTitle .= "<td>{$quantity_lang}</td>";
    			$htmlTitle .= "<td>{$CustomerReference2_lang}</td>";
    			$htmlTitle .= "<td>{$ReceiveCode_lang}</td>";
    			$htmlTitle .= "<td>{$time_of_putting_on_shelf_lang}</td>";
    			$htmlTitle .= "<td>{$updateTime_lang}</td>";      	  
				$htmlTitle .= '</tr>'; 
    			$titlesku = '';
    			$orderContent = '';
    			
    			$max = 1;
    			
    			for($page=1;$page<=$pages;$page++){
    				$rows =  Service_InventoryBatch::getByCondition($condition, '*', $pageSize,$page,'ib_id desc');
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
					 $orderContent.="<tr>";					
 				 	//产品SKU
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['product_sku']}</td>";
    				 //仓库
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['warehouse_name']}</td>";
    				 //数量   				
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['ib_quantity']}</td>";
    				 //客户参考号
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['reference_no']}</td>";
    				 //入库单号
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['receiving_code']}</td>";
    				 //状态
					
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['ib_add_time']}</td>";
    				 //更新时间
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$inventory_info['ib_update_time']}</td>";
    				
    				 $orderContent.="</tr>";		 
	    				
	    				
	    				
    				}
    				 
    			}    			
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	}
    	exit;
    }	


	

  
}
