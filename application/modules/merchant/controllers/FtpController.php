<?php

class Merchant_FtpController extends Ec_Controller_Action
{

    public function preDispatch ()
    {
        $this->tplDirectory = "merchant/views/order/";
        // $this->tplDirectory = "merchant/account_config/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }
    public function indexAction ()
    {
    	//$this->listAction();
    	
    	
        //echo Ec::renderTpl($this->tplDirectory . "order-index.tpl",'layout');
    }
    
    public function checkAction(){
    	var_dump(file_exists(APPLICATION_PATH.'/../data/log/checklog'));
  		 /*$state	= Common_Email::send(array(
				'email'		=> 'williamfan@cargofe.com.cn',
				'subject'	=> '注册账户验证--OMS',
				'bodyType'	=> 'html',
				'body'		=> '请复制该链URL接至浏览器进行访问激活账户！<br/>链接地址：http://192.168.25.128:6666/register/activate?code='.substr(md5($time),0,12)
			)); */
    	
    	$params = array(
    			'bodyType' => 'html',
    			'email' => array('williamfan@cargofe.com.cn'),
    			'subject' => 'test' . date('Y-m-d H:i:s'),
    			'body' => "请复制该链URL接至浏览器进行访问}账户！<br/>链接地址：",
    	);
    	var_dump(Common_Email::send($params));
    	
    	Common_Email::demo();
		exit;
			//
			
  		// Common_Email::testSend();
  		//mail('williamfan@cargofe.com.cn', 'test', 'fsdkf');
  		//if(Common_Email::sendMailWithAtta('williamfan@cargofe.com.cn', "System", 'register', ",您好:<br/>此邮件为邮件提醒，只为提醒各位今天有发往UK包材，操作部会处理，请勿误解，谢谢!"))
  		
  		
		var_dump($state);
		exit;
    }
 	/**
 	 * @author william-fan
 	 * @todo 自动生成产品
 	 */
    public function createProductAction(){
    	set_time_limit(0);
    	$barcode_type = '2';
    	
    	$picUrl = array();
    	$picLink = array();
    	
    	$hs_elements = array();
    	$he_ids = $this->_request->getParam('he_id',array());
    	
    	
    	$pu_code_law = '1';
    	$pu_code_second = '';
    	$hu_id = '1';
    	
    	/* function microtime_float()
    	{
    		list($usec, $sec) = explode(" ", microtime());
    		return ((float)$usec + (float)$sec);
    	} */
    	
    	$time_start = microtime_float();
    	 
    	
    	//$user	= $this->_customerAuth;
    	//$userId	= $user['id'];
    	echo '<pre>';
    	$k=1;
    	for($i=50000;$i<=100000;$i++){
    		
    		$product_sku = 'test-'.$i;
    		$customer_code ='E0135';
    		$customer_id = '120';
    		$product_title_en = "test product ".$i;
    		$product_title = "测试产品".$i;
    		$cat_id = rand(1, 9);
    		$length = '1';
    		$width = '1';
    		$height = '1';
    		$product_weight = '1';
    		$sales_value = '10';
    		$purchase_value = '8';
    		$declared_value = '9';
    		
    		
    		$he_ids= array(
    				'1' => 'test-1 '.$i,
    				'2' => 'test-2 '.$i,
    				'3' => 'test-3 '.$i,
    				'4' => 'test-4 '.$i,
    				'5' => 'test-5 '.$i,
    		);
    		 
    		$hs_elements = array();
    		foreach($he_ids as $he_id=>$hevalue){
    			$hs_elements[] = array('he_id'=>$he_id,'hem_detail'=>$hevalue);
    		}
    		
    		
    		$data	= array(
    				'product_sku'			=> $product_sku,
    				'customer_code'			=> $customer_code,
    				'customer_id'			=> $customer_id,
    				'product_title_en'		=> $product_title_en,
    				'product_title'			=> $product_title,
    				'pu_code'				=> '7',
    				'product_length'		=> $length,
    				'product_width'			=> $width,
    				'product_height'		=> $height,
    				'product_weight'		=> $product_weight,
    				'product_sales_value'	=> $sales_value,
    				'product_purchase_value'=> $purchase_value,
    				'product_declared_value'=> $declared_value,
    				'product_barcode_type'	=> $barcode_type,
    				'product_type'			=> 0,
    				'pc_id'					=> $cat_id,
    				'product_add_time'		=> date('Y-m-d H:i:s'),
    				'hs_code'				=> '8471414000',
    				'hs_element'			=> $hs_elements,
    				'hu_id'					=> $hu_id,
    				'pu_code_law'			=> $pu_code_law,
    				'pu_code_second'		=> $pu_code_second,
    		);

    		//print_r($data);
    		
    		$result = Service_Product::createProductTransaction($data, 'E0135',$picUrl,$picLink);
    		//print_r($result);
    		if($result['ask']=='1'){
    			file_put_contents('product.txt', $i."(".microtime_float().')'.'\r\n',FILE_APPEND);
    		}

    		if($i%1000==0){
    			$buffer_size = 4096;
    			$timenow =  microtime_float();
    			$timeuser = $timenow - $time_start;
    			echo str_pad( "<p>创建了第{$k}一百订单({$timeuser})</p>", $buffer_size);
    			ob_flush();
    			flush();
    			$k++;
    			sleep(1);
    		}

    	}
    	
    	

    	$time_end = microtime_float();
    	$time = $time_end - $time_start;
    	
    	echo "用时 $time seconds\n";
    	 
    	echo '</pre>';
    	
    }

    /**
     * @author william-fan
     * @todo 自动生成订单
     */
   public function createOrderAction(){
   		set_time_limit(0);
   	
   		//$customer = $this->_customerAuth;
   		$customerId = '120';
   		   		
   		$warehouse_id = '1';
   		
   		$smCodes = array(
   			'0'=>'USEUB',
   			'1'=>'CNEMS',
   			'2'=>'EUGH',
   			'3'=>'HKDHL',
   			'4'=>'HKGH',
   			'5'=>'HKPY',
   			'6'=>'SGEMS',
   			'7'=>'SGGH',
   			'8'=>'SGPY',	
   		);
   		$time_start = microtime_float();
   		
   		$k = 1;
   		
   		$process = new Service_OrderProcess();
   		echo '<pre>';
   		for($i=414178;$i<80000;$i++){
   			
   			$order_product = array();
   			//$opQty = $this->_request->getParam('sku',array());
   			
   			
   			//$product_id = rand(1272,1000000);
   			$product_id = rand(127126,127146);
   			//echo $product_id;
   			
   			$productInfo = Service_Product::getByField($product_id);
   			//print_r($productInfo);
   			$index = rand(0,8);
   			$sm_code = $smCodes[$index];
   			
   			$qty = rand(1,10);
   			
   			if(!empty($productInfo)){
   				
   				$order_product = array();
   				
   				$order_product[] = array('product_id'=>$product_id,'qty'=>$qty);
   				
   				
   				$row = array(
   						'customer_id'=>$customerId,
   						'warehouse_id'=>$warehouse_id,
   						'to_warehouse_id'=>'',
   						'sm_code'=>'HKEMS',
   						'reference_no'=>'test-'.$i,
   						'remark'=>'test remark '.$i,
   						'order_type'=>'0',
   						'oab_firstname'=>'test first name '.$i,
   						'oab_lastname'=>'test last name '.$i,
   						'oab_company'=>'test company '.$i,
   						'oab_country_id'=>'253',
   						'oab_postcode'=>'123456',
   						'oab_state'=>'纽约',
   						'oab_city'=>'曼哈顿',
   						'oab_street_address1'=>'唐人街',
   						'oab_street_address2'=>'112 号',
   						'consignee_address3'=>'',
   						'oab_phone'=>'123456',
   						'oab_email'=>'fzffzffzw@163.com',
   							
   						'order_product'=>$order_product,
   				);
   				
   				$result = $process->createOrderTransaction($row);
   				
   				//print_r($result);
   				
   				//确认订单
   				if(isset($result['ordersCode']) && $result['ordersCode']!=''){
   					$orders_code = $result['ordersCode'];
   					
   					$result2 = Service_OrderProcess::confirm($orders_code,$customerId);
   					
   					$result3 = Service_OrderProcess::submit($orders_code,$customerId);
   					
   				}
   				
   				
   				
   				if($i%1000==0){
   					$buffer_size = 4096;
   					$timenow =  microtime_float();
   					$timeuser = $timenow - $time_start;
   					echo str_pad( "<p>创建了第{$k}一千订单({$timeuser})</p>", $buffer_size);
   					ob_flush();
   					flush();
   					$k++;
   					sleep(1);
   				}
   				
   				//print_r($result);
   			}else{
   				//continue;
   			}
   		}
   		
   		echo '</pre>';

   }
	
    
    
    
}