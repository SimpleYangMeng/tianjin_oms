<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-7-5
 * Time: 下午4:51
 * To change this template use File | Settings | File Templates.
 */
class Merchant_FinanceController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/finance/";
        $params = self::getFrontController()->getRequest()->getParams();
        $this->view->ac = $params['action'];
    }

    public function listAction(){
        $page		= $this->getRequest()->getParam('page', 1);
        $pageSize	= $this->getRequest()->getParam('pageSize', 20);
        $session	= new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
        $condition	= array(
            'customer_code'		=> $sessionData['code'],
            'cbl_type'            => $this->_request->getParam('cbl_type',""),
            'cbl_refer_code'  => $this->_request->getParam('cbl_refer_code',""),
        	'cbl_cus_code'  => $this->_request->getParam('cbl_cus_code',""),
			'cblReferType'  => $this->_request->getParam('cblReferType',""),
			'add_time_start'  => $this->_request->getParam('add_time_start',""),
			'add_time_end'  => $this->_request->getParam('add_time_end',""),
			'cbl_note'  => $this->_request->getParam('cbl_note',""),
			
        );
		
        //$tranactionCode = $this->_request->getParam('transaction_code',"");
        /* if($condition['transaction_code']!=""){
            $orderRow = Service_Orders::getByCondition(array('new_reference_no'=>$condition['transaction_code']),"*");
            if(!empty($orderRow)){
                $condition['cbl_refer_code'] = $orderRow[0]['order_code'];
            }
        }else{
            $condition['cbl_refer_code'] = "";
        } */
        $this->view->row = Service_CustomerBalance::getByField($sessionData['code'],"customer_code","*");
        $count = Service_CustomerBalanceLog::getByCondition($condition,"count(*)");
        $this->view->count = $count;
        $this->view->condition		= $condition;
        $this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $result = Service_CustomerBalanceLog::getByCondition($condition,"*",$pageSize,$page,"cbl_id DESC");
        foreach($result as $key=>$value){
            $user = Service_User::getByField($value['user_id'],"user_id","*");
            $result[$key]['user_code'] = $user['user_code'];
        }
        $this->view->result = $result;
        $this->view->customer_currency = $sessionData['customer_currency'];
        $this->view->cblType =Service_CustomerBalance::getCblTypes();
		 
        $this->view->cblReferType = Service_CustomerBalance::getCblReferTypes();
        echo Ec::renderTpl($this->tplDirectory . "finance-list.tpl",'noleftlayout');
    }
	
    public function depositListAction(){
        $page		= $this->getRequest()->getParam('page', 1);
        $pageSize	= $this->getRequest()->getParam('pageSize', 20);
        $session	= new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
        $condition	= array(
            'customer_code'		=> $sessionData['code'],
            'cdo_payment_status'            => $this->_request->getParam('cdo_payment_status',""),
        );
        $this->view->condition		= $condition;
        $this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $count = Service_CustomerDepositOrder::getByCondition($condition,"count(*)");
        $this->view->count = $count;
        $this->view->result = Service_CustomerDepositOrder::getByCondition($condition,"*",$pageSize,$page,"");
		
        echo Ec::renderTpl($this->tplDirectory . "deposit-list.tpl",'noleftlayout');
    }

    public function rechargeAction(){
        $session	= new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
        $customer = Service_Customer::getByField($sessionData['code'],'customer_code',"*");
        $balance = Service_CustomerBalance::getByField($sessionData['code'],"customer_code","*");
        $this->view->customer = $customer;
        $this->view->balance = $balance;
        echo Ec::renderTpl($this->tplDirectory . "recharge.tpl",'noleftlayout');
    }
   /**
     * @author colin-fan
     * @todo 用于导出交易记录信息
     */
    public function exportAction(){
		set_time_limit(600);
    	/* $productCodes = $this->_request->getParam('productCodes');
    	if(!$productCodes || !is_array($productCodes)){exit("请选择产品");}
    	
    	header("Pragma: public");
    	header("Expires: 0");
    	header("Accept-Ranges: bytes");
    	header(mb_convert_encoding("Content-Disposition: attachment; filename=运单凭证".date('YmdHis').".zip",'gbk','utf-8'));
    	header("Content-Type:APPLICATION/OCTET-STREAM;charset=gb2312"); */
    	

    	$customer = $this->_customerAuth;
		
    	$customerId = $customer['id'];    	
    	$cb_arr = $this->_request->getParam('cb_arr','');    	
    	$exportformat = 'xls';
    	$fileName = 'finance'.date('YmdHis').'.'.$exportformat;	
		
		$customerCode_lang = Ec_Lang::getInstance()->getTranslate('customerCode');
    	$feeName_lang  = Ec_Lang::getInstance()->getTranslate('feeName');
		$reference_type_lang  = Ec_Lang::getInstance()->getTranslate('reference_type');
		$reference_lang = Ec_Lang::getInstance()->getTranslate('reference');
		$CustomerReference2_lang = Ec_Lang::getInstance()->getTranslate('CustomerReference2');
		$DebitsType_lang = Ec_Lang::getInstance()->getTranslate('DebitsType');
		$exchange_amount_lang = Ec_Lang::getInstance()->getTranslate('exchange_amount');
		$Currency_lang = Ec_Lang::getInstance()->getTranslate('Currency');
		$currencyRate_lang = Ec_Lang::getInstance()->getTranslate('currencyRate');
		$currency_amount_equivalent_to_the_customer_lang = Ec_Lang::getInstance()->getTranslate('currency_amount_equivalent_to_the_customer');
    	$CustomerCurrency_lang = Ec_Lang::getInstance()->getTranslate('CustomerCurrency');
		
		$AvailableBalance_lang = Ec_Lang::getInstance()->getTranslate('AvailableBalance');
		$FreezeBalance_lang = Ec_Lang::getInstance()->getTranslate('FreezeBalance');
		$FeeHappenDate_lang = Ec_Lang::getInstance()->getTranslate('FeeHappenDate');
		
		if(!empty($cb_arr)){		//通过选择的订单获取
					
    		if($exportformat=='xls'){
    			$orderHtml = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><table border="1"><tr>';	
				$htmlTitle .= "<td>{$customerCode_lang}</td>";
				$htmlTitle .= "<td>{$feeName_lang}</td>";
				$htmlTitle .= "<td>{$reference_type_lang}</td>";
				$htmlTitle .= "<td>{$reference_lang}</td>";
				$htmlTitle .= "<td>{$CustomerReference2_lang}</td>";
    			$htmlTitle .= "<td>{$DebitsType_lang}</td>";
    			$htmlTitle .= "<td>{$exchange_amount_lang}</td>";
				$htmlTitle .= "<td>{$Currency_lang}</td>";
    			$htmlTitle .= "<td>{$currencyRate_lang}</td>";    			
    			$htmlTitle .= "<td>{$currency_amount_equivalent_to_the_customer_lang}</td>";
				$htmlTitle .= "<td>{$CustomerCurrency_lang}</td>";
    			$htmlTitle .= "<td>{$AvailableBalance_lang}</td>";
				$htmlTitle .= "<td>{$FreezeBalance_lang}</td>";
    			$htmlTitle .= "<td>{$FeeHappenDate_lang}</td>"; 
    			$titlesku = '';
    			$orderContent = '';
    			$max = 1;				
    			foreach($cb_arr as $key=>$cb_id){
    				 $customerBalanceLog = Service_CustomerBalanceLog::getByField($cb_id, 'cbl_id');
					 if(!$customerBalanceLog){continue;}
					 $customerBalanceLog['cbl_type_text'] = Service_CustomerBalanceLog::getTypeText($customerBalanceLog['cbl_type']);
					 
					 $customerBalanceLog['customer_currency'] = $customer['customer_currency'];
					 $customerBalanceLog['cbl_refer_type_text'] = Service_CustomerBalanceLog::getCblReferTypeText($customerBalanceLog['cbl_refer_type']); 
    				
    				 $orderContent.="<tr>";
					 //客户ID
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['customer_code']}</td>";
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_note']}</td>";
			
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_refer_type_text']}</td>";
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_refer_code']}</td>";
					 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_cus_code']}</td>";
									 
					  
					 //交易类型				 
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_type_text']}</td>";

    				 //金额    				 
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_value']}</td>";

    				 //币种
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['currency_code']}</td>";
    				 //汇率
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['currency_rate']}</td>";
    				 //折合客户币种金额
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_transaction_value']}</td>";
    				 //客户币种
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['customer_currency']}</td>";
					 
    				 //可用余额
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_current_value']}</td>";
    				 //冻结金额
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_current_hold_value']}</td>";					 
    				 //时间
    				 $orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_add_time']}</td>";    
    				 
    				 
    				 $orderContent.="</tr>";
    			}   	
				$html = $orderHtml.$htmlTitle.$orderContent.'</table>';				
    	        header('Pragma:public');		
    			header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
    	        header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");   
    			//file_put_contents(APPLICATION_PATH . "/../data/{$fileName}",$html);
				echo $html;
    			exit;
    			//echo $orderHtml;exit;
    			
    		}elseif($exportformat=='csv'){
    			
    		}
    			
    	}else{		
				
       			$customer = $this->_customerAuth;
    			$customerId = $customer['id'];  		
        		$condition	= array(
            		'customer_id'=>$customerId,
					'cbl_refer_code'=>$this->_request->getParam('cbl_refer_code',""),
					'cbl_cus_code'=>$this->_request->getParam('cbl_cus_code',""),
					'cblReferType'=>$this->_request->getParam('cblReferType',""),
            		'cbl_type'=>$this->_request->getParam('cbl_type',""),
            		'transaction_code'=>$this->_request->getParam('transaction_code',""),
					'add_time_start'=>$this->_request->getParam('add_time_start',""),
					'add_time_end'=>$this->_request->getParam('add_time_end',""),
					'cbl_note'  => $this->_request->getParam('cbl_note',""),					
        		);
			//print_r($_POST);exit;
			
        /*
        		if($condition['transaction_code']!=""){
            		$orderRow = Service_Orders::getByCondition(array('new_reference_no'=>$condition['transaction_code']),"*");
            		if(!empty($orderRow)){
                		$condition['cbl_refer_code'] = $orderRow[0]['order_code'];
            		}
				}else{
            		$condition['cbl_refer_code'] = "";
        		} 
		*/			   		

    				

    		$count = Service_CustomerBalanceLog::getByCondition($condition, 'count(*)');
			
    		if($count>0){
    			$pageSize = 20;
    			$pages = ceil($count/20);

    			$orderHtml = '<table border="1"><tr>';
				$htmlTitle .= "<td>{$customerCode_lang}</td>";
				$htmlTitle .= "<td>{$feeName_lang}</td>";
				$htmlTitle .= "<td>{$reference_type_lang}</td>";
				$htmlTitle .= "<td>{$reference_lang}</td>";
				$htmlTitle .= "<td>{$CustomerReference2_lang}</td>";
    			$htmlTitle .= "<td>{$DebitsType_lang}</td>";
    			$htmlTitle .= "<td>{$exchange_amount_lang}</td>";
				$htmlTitle .= "<td>{$Currency_lang}</td>";
    			$htmlTitle .= "<td>{$currencyRate_lang}</td>";    			
    			$htmlTitle .= "<td>{$currency_amount_equivalent_to_the_customer_lang}</td>";
				$htmlTitle .= "<td>{$CustomerCurrency_lang}</td>";
    			$htmlTitle .= "<td>{$AvailableBalance_lang}</td>";
				$htmlTitle .= "<td>{$FreezeBalance_lang}</td>";
    			$htmlTitle .= "<td>{$FeeHappenDate_lang}</td>";  
    			$titlesku = '';
    			$orderContent = '';

    			$max = 1;

    			for($page=1;$page<=$pages;$page++){
    				$rows = Service_CustomerBalanceLog::getByCondition($condition, '*', $pageSize,$page,'cbl_id desc');
					if(!$rows){continue;}
					
    				foreach($rows as $keyo=>$customerBalanceLog){
						$customerBalanceLog['cbl_type_text'] = Service_CustomerBalanceLog::getTypeText($customerBalanceLog['cbl_type']);					 
						$customerBalanceLog['cbl_refer_type_text'] = Service_CustomerBalanceLog::getCblReferTypeText($customerBalanceLog['cbl_refer_type']); 
					    $customerBalanceLog['customer_currency'] = $customer['customer_currency'];
						
						$orderContent.="<tr>";					 	 
						//客户ID												
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['customer_code']}</td>";
						//费用名称
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_note']}</td>";
						//参考类型
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_refer_type_text']}</td>";
						//参考号
					 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_refer_code']}</td>";	
						//客户参考号
						$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_cus_code']}</td>";					
						//交易类型 
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_type_text']}</td>";

    				 	//金额    				 
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_value']}</td>";
    				 	//汇率
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['currency_rate']}</td>";
    					 //币种
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['currency_code']}</td>";
    				 	//折合人民币
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_transaction_value']}</td>";
		 				//客户币种
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['customer_currency']}</td>";    				 	
						//可用余额
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_current_value']}</td>";
    				 	//冻结金额
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_current_hold_value']}</td>";					 
    				 	//时间
    				 	$orderContent.="<td style='vnd.ms-excel.numberformat:@;'>{$customerBalanceLog['cbl_add_time']}</td>"; 
	    			
	    				$orderContent.="</tr>";
    				}

    			}   			
    		
    	        header('Pragma:public');		
    			header('Content-Type:application/x-msexecl;name="' . $fileName . ".{$exportformat}");
    	        header("Content-Disposition:inline;filename=" . $fileName . ".{$exportformat}");
    			echo $orderHtml.$htmlTitle.$orderContent.'</table>';
    		}
    	}
    	exit;
    }
	
}
