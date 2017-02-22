<?php
class Default_IdController extends Ec_Controller_DefaultAction
{

    public function preDispatch(){
        $this->view->errMsg = '';
        $this->tplDirectory = "default/views/idcards/";
    }

    public function indexAction(){
		$this->_redirect('/id/submit-identification');    	
    }  
	
	/*通过身份证号码取得身份证图片*/
    public function getidcardNumberAction(){    
		$result = array();
		$result['ask'] = "0";
        $result['errorMsg'] = "未知错误";
			    
		$idcardNumber = $this->_request->getParam('idcardNumber', "");
		$consigneePerson = $this->_request->getParam('consigneePerson', "");		
		if(empty($idcardNumber) || empty($consigneePerson)){ 
			$result['ask'] = "2";
        	$result['errorMsg'] = "身份号码或名字为空";	
			exit;
		}		 
		
		$idcard_array = Service_OrderIdcards::getByField($idcardNumber, 'idcard_number');
		if($idcard_array ){
			  if($idcard_array['idcard_name']==$consigneePerson){
					$result['ask'] = "1";
					$result['front_side_idcard'] = $idcard_array['front_side_idcard'];					
        			$result['errorMsg'] = "";			  	
			  }else{
					$result['ask'] = "4";
        			$result['errorMsg'] = "身份证姓名不对.";						  
			  }
			
		}else{
			$result['ask'] = "3";
        	$result['errorMsg'] = "身份证号码找不到.";	
				
		}
		
    	die(json_encode($result));
      
    }	
		
	/*提交身份证明步骤1*/
	public function submitIdentificationAction(){
	    $info = array();
		if($this->_request->isPost()){
			$needver	= $this->getRequest()->getParam('needver',1);	
			$verifyCode	= $this->getRequest()->getParam('verify');
			$verify = new Common_Verifycode();
			if(!$verify->is_true($verifyCode) && $needver){
					$info[] = '验证码错误!';
					 $this->view->info = $info;
					 echo Ec::renderTpl($this->tplDirectory . "submit-identification.tpl", 'layout');
					 exit;
			}			 
			$reference_no = trim($this->_request->getParam('reference_no', ""));
			$consignee_person = trim($this->_request->getParam('consignee_person', ""));
			if($reference_no==''){
				$info[] = '交易订单号不能为空!';
			}
			
			if($consignee_person==''){
				$info[] = '收件人不能为空!';
			}
			if($reference_no && $consignee_person){
				$order = Service_Orders::getByField($reference_no,'reference_no');
				$ordercode =  $order['order_code'];
				if(!$order){
					$info[] = '没有找到对应的订单!';
				}else{//找到订单
					 $orderAddress = Service_OrderAddressBook::getByField($ordercode,'order_code');
					 if(!$orderAddress){
					 	$info[] = '没有找到对应的订单地址!';
					 }
					 if($orderAddress['oab_lastname'].$orderAddress['oab_firstname']!=$consignee_person){
					 	$info[] = '收件人姓名不符合!';
					 }else{
                            //错误信息提醒
                            $this->view->info = $info;
    					 	$this->view->reference_no = $reference_no;
    					 	$this->view->consignee_person = $consignee_person;
    					 	$this->view->orderAddress = $orderAddress;
    					 	$this->view->order = $order;
    					 	echo Ec::renderTpl($this->tplDirectory . "submit-identification2.tpl", 'layout');
    					 	exit;
					 }
				
				}//if(!$order){
				
			}
						
			
		}	
		$this->view->info = $info;
		echo Ec::renderTpl($this->tplDirectory . "submit-identification.tpl", 'layout');
	}
	/*第二步*/
	public function submitIdentification2Action(){
		if($this->_request->isPost()){			 
			$reference_no = trim($this->_request->getParam('reference_no', ""));
			$consignee_person = trim($this->_request->getParam('consignee_person', ""));
			$info = array();
			if($reference_no==''){
				$info[] = '交易订单号不能为空!';
			}
						
			if($consignee_person==''){
				$info[] = '收件人不能为空!';
			}
			
			if($reference_no && $consignee_person){
				$order = Service_Orders::getByField($reference_no,'reference_no');
				$ordercode = $order['order_code'];
				if(!$order){
					$info[] = '没有找到对应的订单!';
				}else{//找到订单	
					
					 $orderAddress = Service_OrderAddressBook::getByField($ordercode,'order_code');
					 if(!$orderAddress){
					 	$info[] = '没有找到对应的订单地址!';
					 }
					 if(($orderAddress['oab_lastname'].$orderAddress['oab_firstname'])!=$consignee_person){
					 	$info[] = '收件人姓名不符合!';
					 }				
				}//if(!$order){
				
			}//if($ordercode && $consignee_person){	
			
			if($info){//如果基本信息没填。则返回第一步重新填写
				$this->view->info = $info;
				echo Ec::renderTpl($this->tplDirectory . "submit-identification.tpl", 'layout');
				exit;
			}
			$info = array();
			$idcard_number = trim($this->_request->getParam('idcard_number', ""));
		
			
			if($_FILES['frontsidefile']['size']>0){
						$path = APPLICATION_PATH.'/../data/idcards';
						$state	= Common_Common::uploadImg($_FILES, 'frontsidefile', $path);
						//print_r($state);exit;
						if ($state['error']) {
								$info[]	= strip_tags($state['msg']);						
						}else{	
							$frontsidefile_url = "";				
							if($state['msg']['is_image']){$frontsidefile_url = "/index/view-id-card/fileName/".$state['msg']['file_name'];}
							if(!$frontsidefile_url){ $info[]="身份证正面上传失败.";}
							$fontsidefileName = $state['msg']['file_name'];
						}
					
			}	
				
			if(!$idcard_number){
				$info[]="身份证号码为空";
			}elseif(strlen($idcard_number)!=18){			
				 $info[]="身份证号码必须为18位";			
			}elseif($idcard_number!=$order['idNumber']){
				 $info[]="与订单所指定的身份证号码不相同!";	
			}else{			
				 $history_idcard_array = Service_OrderIdcards::getByField($idcard_number,'idcard_number');
				 if($history_idcard_array){//是否上传过								
						if($frontsidefile_url){
									$data = array(
										'idcard_name'=>$consignee_person,
										'idcard_number'=>$idcard_number,
										'front_side_idcard'=>$frontsidefile_url,												
										'add_time'=>date('Y-m-d H:i:s'),										
										'update_time'=>date('Y-m-d H:i:s'),
										'temp_order_code'=>$reference_no,
										'frontsidefileName'=>$frontsidefileName,
										'session_code'=>Common_Common::randomkeys(30),										
										'ip'=>Common_Common::getIP(),
									);								
																
									Service_OrderIdcards::update($data,$history_idcard_array['idcard_id'],'idcard_id');
									$this->_deleteIdcardFileAction($history_idcard_array['frontsidefileName']);
						}else{						
									$data = array(
										'session_code'=>Common_Common::randomkeys(30),
										'temp_order_code'=>$reference_no,
										'update_time'=>date('Y-m-d H:i:s'),										
										'ip'=>Common_Common::getIP(),
									);
									Service_OrderIdcards::update($data,$history_idcard_array['idcard_id'],'idcard_id');								
						}		
				 		
				 }// if($history_idcard_array){	
				 else
				 {//如果没有身份证		 	


				 	if(!$frontsidefile_url){
				 		$info[]="请上传身份证复印件";
				 	}		 	
				 	
				 	
				 		
				 	if($frontsidefile_url){
				 			
				 		$data = array(
				 				'idcard_name'=>$consignee_person,
				 				'idcard_number'=>$idcard_number,
				 				'front_side_idcard'=>$frontsidefile_url,				 				
				 				'session_code'=>Common_Common::randomkeys(30),
								'temp_order_code'=>$reference_no,
				 				'add_time'=>date('Y-m-d H:i:s'),
				 				'update_time'=>date('Y -m-d H:i:s'),
				 				'update_time'=>date('Y-m-d H:i:s'),
				 				'ip'=>Common_Common::getIP(),
				 		);
				 		Service_OrderIdcards::add($data);
				 	}				 	
				 	
				 	
				 }
				
			}//if(!$idcard_number){		
			
			$this->view->info = $info;
			$this->view->reference_no = $reference_no;
			$this->view->consignee_person = $consignee_person;
			$this->view->idcard_number = $idcard_number;
			$this->view->history_idcard_array = $history_idcard_array;
			$this->view->orderAddress = $orderAddress;
			$this->view->order = $order;
			if($info){
				  echo Ec::renderTpl($this->tplDirectory . "submit-identification2.tpl", 'layout');				
			}else{			 
				 $history_idcard_array = Service_OrderIdcards::getByField($idcard_number,'idcard_number');//是否上传过
				 if($history_idcard_array){
				 		$this->_redirect('/id/submit-identification-preview/session_code/'.$history_idcard_array['session_code']);	
				 }else{
				 		$this->_redirect('/id/submit-identification');
				 }	
				 						
			}
			exit;	
		}//ispost		
		$this->_redirect('/id/submit-identification');
		//读取身份证记录		
			
	}	
	
	
	
	/*第三步*/
	public function submitIdentificationPreviewAction(){	
	    $info = array();
	    $successOrFail = 0;
		$session_code = trim($this->_request->getParam('session_code', ""));
		if($session_code){
			$history_idcard_array = Service_OrderIdcards::getByField($session_code,'session_code');
			
		}else{
			$this->_redirect('/id/submit-identification/?info[]=找不到会话信息');
			exit;
		}
		if(!$history_idcard_array){
			$this->_redirect('/id/submit-identification/?info[]=找不到会话信息');
			exit;
		}
		$order = Service_Orders::getByField($history_idcard_array['temp_order_code'],'reference_no');	
		if(!$order){
			$this->_redirect('/id/submit-identification/?info[]=找不到订单信息');
			exit;
		}
			
		$ispost = '0';
		if($this->_request->isPost()){	
				$ispost = '1';
				$data = array(
					'status'=>'1',					
				);			 
				$status = Service_OrderIdcards::update($data,$session_code,'session_code');	
				$successOrFail='0';
				if($status===false){
					$info[] = '身份证信息提交失败!!!';
					$successOrFail='0';
				}else{
					$info[] = '身份证信息提交成功!!!';
					$successOrFail='1';						
				}	
				
		}	
		if($history_idcard_array['temp_order_code']){
			$order = Service_Orders::getByField($history_idcard_array['temp_order_code'],'reference_no');
		}		
		if($order){
			 $orderAddress = Service_OrderAddressBook::getByField($order['order_code'],'order_code');	
		}					
		$this->view->orderAddress = $orderAddress;			
		$this->view->history_idcard_array = $history_idcard_array;
		$this->view->info =	$info;
		$this->view->successOrFail = $successOrFail;
		$this->view->ispost = $ispost;
		echo Ec::renderTpl($this->tplDirectory . "submit-identification3.tpl", 'layout');			
	}	
	private function  _deleteIdcardFileAction($filename)
	{
		if(!$filename){return;}	
		$path = APPLICATION_PATH.'/../data/idcards/';
		@unlink($path.$filename);	
			
	}
}