<?php
class Merchant_BalanceController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "merchant/views/balance/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }
    public function indexAction(){

        $sessionData       = $this->customerAuth->data;
        $authStatus = self::getAuthStatus('auto');
        $page       = $this->getRequest()->getParam('page', 1);
        $pageSize   = $this->getRequest()->getParam('pageSize', 20);
        $condition  = array(
            'customer_code' => $this->_customerAuth['code']
        );
        $query=array('id_code'=>'','name'=>'');
        if($this->_request->isPost()){ 
        	$id_code=$this->_request->getParam('id_code','');
			$name=$this->_request->getParam('name','');
    		!empty($id_code)?
    			$condition['id_code']=$id_code:"";
    		!empty($name)?
    			$condition['name']=$name:"";
    		$query['id_code']=empty($condition['id_code'])?"":$condition['id_code'];
    		$query['name']=empty($condition['name'])?"":$condition['name'];
    	}
    	$this->view->query=$query;
        $this->view->count      = Service_Balance::getByCondition($condition, 'count(*)');
        $this->view->result     = Service_Balance::getByCondition($condition, '*', 'b_id DESC', $pageSize, $page);
        $this->view->pageSize   = $pageSize;
        $this->view->page       = $page;
        $this->view->condition  = $condition;
        $this->view->authStatus = $authStatus;
        echo Ec::renderTpl($this->tplDirectory . "balance_index.tpl", 'noleftlayout');
    }
    public function addAction(){
    	if($this->_request->isPost()){

    		$id_code=$this->_request->getParam('id_code','');
    		$name=$this->_request->getParam('name','');
    		$sessionData       = $this->customerAuth->data;
            $add=true;
            $error             = array();
            $result['ask']   = '0';
            if ($sessionData['account_level'] == '1') {
                //子账号不能添加子账号
                $error[] = '只有主账号才能查询';
            }
            if (empty($id_code)) {
                $error[] = "查询身份证号必须填写";
            }
    		if (!preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i', $id_code)) {
                $error[] = Ec_Lang::getInstance()->getTranslate('identity_card_number_format_error');
            }
            if (empty($name)) {
                $error[] = "查询姓名必须填写";
            }
            if(empty($error)){ 
            	//查询状态
				$condition  = array(
		            'customer_code' => $this->_customerAuth['code'],
		            'id_code' => $id_code,
		            'name' => $name,
		        );
		        $r= Service_Balance::getByCondition($condition, '*', 'b_id DESC');
                if($r){ 
		        	foreach ($r as $key => $value) {
		        		if($value['state']<2){ 
		        			$error[] = "等待查询结果,请勿重复提交";	break;
		        		}else{ 
		        			$update_data['balance']=0;
		        			$update_data['state']=0;
		        			$update_data['create_time']=date('Y-m-d H:i:s');
		        			$r=Service_Balance::update($update_data,$value['b_id']);	
		        			!$r?$error[] = "操作失败":$add=false;
		        		}
		        	}
		        }
		        if(empty($error)&&$add){ 
					$insert_data['id_code']=$this->_request->getParam('id_code','');
		    		$insert_data['name']=$this->_request->getParam('name','');
		    		$insert_data['create_time']=date('Y-m-d H:i:s');
		    		$insert_data['customer_code']=$sessionData['code'];
	            	$r=Service_Balance::add($insert_data);
	            	!$r&&$error[] = "操作失败";
            	}
            }
			if(!empty($error)){ 
				$result['error'] = $error;	
			}else{ 
				$result['ask']   = '1';
				$result['message']="操作成功";
			}
            die(json_encode($result));
    	} else{ 
    		echo Ec::renderTpl($this->tplDirectory . "balance_add.tpl", 'noleftlayout');
    	}
    }
    private static function getAuthStatus($lang = 'zh_CN')
    {
        $tmp = array(
            'zh_CN' => array(
                '0' => '申请中',
                '1' => '已发送海关',
                '2' => '已查询',
            )
        );
            /*'en_US' => array(
                '1' => 'Verification state',
                '2' => 'Authentication success',
                '3' => 'Validation failure',
            ),*/
        //);
        if ($lang == 'auto') {
            $lang = Ec::getLang();
        }
        return isset($tmp[$lang]) ? $tmp[$lang] : $tmp;
    }
    
}
