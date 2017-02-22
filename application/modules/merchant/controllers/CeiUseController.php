<?php
class Merchant_CeiUseController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/ceive_use/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }
	/*借领用*/
    public function listAction()
    {	
		$page = $this->_request->getParam('page', 1);
        $pageSize = $this->_request->getParam('pageSize', 20);

        $page = $page ? $page : 1;
        $pageSize = $pageSize ? $pageSize : 20;

        $cu_code = $this->_request->getParam("cu_code","");
		$sku = $this->_request->getParam("sku","");
        $cud_username = $this->_request->getParam("cud_username","");
        $cud_status = $this->_request->getParam("cud_status","");
        $cud_type = $this->_request->getParam("cud_type","");
        $session = new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
        $condition = array(
            'cu_code'=>$cu_code,
            'cud_username'=>$cud_username,
            'cud_status'=>$cud_status,
            'cud_type'=>$cud_type,
			'sku'	=> $sku,
			'account_code'=>$sessionData['account_code'],
        );
        $total = Service_CeiveUseDetail::getByCondition($condition,"count(*)");
        $page = $page>ceil($total/$pageSize)?1:$page;
        $result = Service_CeiveUseDetail::getByCondition($condition,"*",$pageSize, $page,array('cu_id desc'));
        foreach($result as $key=>$value){
			$ceivelList	= Service_CeiveUse::getByField($value['cu_code'], $field = 'cu_code');
			//if(!$ceivelList['warehouse_id']){print_r($value);exit;}
            $warehouse = Service_Warehouse::getByField($ceivelList['warehouse_id'],'warehouse_id',"*");
            $result[$key]['warehouse_name'] = $warehouse['warehouse_name'];
        }
        $this->view->condition = $condition;
        $this->view->result = $result;
        $this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $this->view->count = $total;
        echo Ec::renderTpl($this->tplDirectory . "ceive_use_index.tpl", 'noleftlayout');
    }
    
    public function detailAction() {
		
		$session = new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
		
		$result = array();
		$page = $this->_request->getParam('page', 1);
        $pageSize = $this->_request->getParam('pageSize', 20);

        $page = $page ? $page : 1;
        $pageSize = $pageSize ? $pageSize : 20;
		
		$createUser= '';
		$updateUser ='';
		$cu_code = $this->_request->getParam('cu_code','');
    	$aCeiveUse = Service_CeiveUse::getByField($cu_code,'cu_code','*');
		if($aCeiveUse['cu_create_user_id']){
			$createUserInfo = Service_User::getByField($aCeiveUse['cu_create_user_id'],'user_id',"*");
			$createUser 	=  $createUserInfo['user_name'];
		}
		if($aCeiveUse['cu_update_user_id']){
			$updateUserInfo = Service_User::getByField($aCeiveUse['cu_update_user_id'],'user_id',"*");
			$updateUser 	=  $updateUserInfo['user_name'];
		}
		$w = Service_Warehouse::getByField($aCeiveUse['warehouse_id'],'warehouse_id',"*");
		$aCeiveUse['warehouse_name'] = $w['warehouse_name'];
		$aCeiveUse['createUserName'] = $createUser;
		$aCeiveUse['updateUserName'] = $updateUser;
		$total = Service_CeiveUseDetail::getByCondition(array('cu_code'=>$cu_code,'account_code'=>$sessionData['account_code']),"count(*)");
        $page = $page>ceil($total/$pageSize)?1:$page;
     	$lDetail = Service_CeiveUseDetail::getByCondition(array('cu_code'=>$cu_code,'account_code'=>$sessionData['account_code']),"*",$pageSize, $page,array('cud_id desc'));
		foreach($lDetail as $key=>$val){
			$productInfo	= Service_Product::getByField($val['product_id'],'product_id','*');
			$lDetail[$key]['sku']	= $productInfo['product_sku'];
		}
     	$result['aCeiveUse'] = $aCeiveUse;
     	$result['lDetail'] = $lDetail;
		$this->view->result = $result;
		$this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $this->view->count = $total;
		echo Ec::renderTpl($this->tplDirectory . "ceive_use_detail_index.tpl", 'noleftlayout');
    }
}