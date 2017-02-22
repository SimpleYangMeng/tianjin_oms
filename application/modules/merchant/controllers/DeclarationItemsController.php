<?php

class Merchant_DeclarationItemsController extends Ec_Controller_Action {

    public function preDispatch() {
        $this->tplDirectory = "merchant/views/declaration/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    public function indexAction() {
        $this->listAction();
    }

    /* 备货订单列表 */
    public function listAction() {
       // $this->view->orders_status = $orders_status;
        echo Ec::renderTpl($this->tplDirectory . "declaration-item-list.tpl", 'noleftlayout');
    }

}
