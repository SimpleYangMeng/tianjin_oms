<?php
/**
 *
 */
class Default_FromsCompareController extends Ec_Controller_DefaultAction{

    public function indexAction(){
        $object = Service_ThreeFromsCompareProcess::getInstance();
        $object->getCompare('02132015I000000514');
        var_dump($object->getError());
        exit();
    }
}
