<?php
class Merchant_MenuController extends Ec_Controller_DefaultAction
{


    public function preDispatch()
    {
        $this->view->errMsg = '';
        $this->tplDirectory = "merchant/views/default/";
    }   

    public function headerInnerAction(){
        echo $this->view->render($this->tplDirectory . 'header-inner.tpl');
    }
    public function headerAction(){
        $session			= new Zend_Session_Namespace('RegisterStep');
        $session->step = '4';
        $this->view->step = $session->step;
        //echo $this->view->render($this->tplDirectory ."header.tpl");
    }
}