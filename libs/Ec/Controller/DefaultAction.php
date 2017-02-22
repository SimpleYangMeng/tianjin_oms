<?php
class Ec_Controller_DefaultAction extends Zend_Controller_Action
{

    public function init()
    {
        parent::init();
        $this->view = Zend_Registry::get('EcView');
    }

    //当不存在的方法时调用
    public function __call($methodName, $args)
    {
        $this->_forward('error', 'error', 'default');
    }
}
