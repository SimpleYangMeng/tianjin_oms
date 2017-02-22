<?php
class Default_LoadjsController extends Zend_Controller_Action{
	public function init()
	{
		$this->view = Zend_Registry::get('EcView');
	}
	
	public function preDispatch()
	{
		$this->tplDirectory = "default/views/js/";
	}
	public function loadjsAction(){
		$jsName = $this->_request->getParam('name','');
		$jsPath = APPLICATION_PATH.'/../public/js/';
		switch($jsName){
			case 'order':
				echo $this->view->render($this->tplDirectory . "orderjs.tpl");
				break;
            case 'personItem':
                echo $this->view->render($this->tplDirectory . "personItem.tpl");
                break;
			case 'receiving':
				echo $this->view->render($this->tplDirectory . "receivingjs.tpl");
				break;
			case 'myframe':						
				echo $this->view->render($this->tplDirectory . "jquery.myframe.tpl");
				break;	
			case 'switchToAdvancedSearch':						
				echo $this->view->render($this->tplDirectory . "switchToAdvancedSearch.tpl");
				break;				
			
			case 'main':
				echo $this->view->render($this->tplDirectory . "main.tpl");
			break;	
			
			case 'purchaseorder':	
				echo $this->view->render($this->tplDirectory . "purchaseorder.tpl");
				break;


			case 'purchaseorderTracking':	
				echo $this->view->render($this->tplDirectory . "purchaseorderTracking.tpl");
				break;			
			
			case 'pagination':
				echo $this->view->render($this->tplDirectory . "paginationjs.tpl");
				
		}
		
		 //var_dump(file_exists());
	}
}