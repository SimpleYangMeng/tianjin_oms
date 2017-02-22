<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-3-21
 * Time: 下午3:41
 * To change this template use File | Settings | File Templates.
 */
class Merchant_QualityControlController extends Ec_Controller_Action
{
    public function preDispatch ()
    {
        $this->tplDirectory = "merchant/views/QC/";
        // $this->tplDirectory = "merchant/account_config/";
        $this->customerAuth = new Zend_Session_Namespace("customerAuth");
    }

    public function listAction(){
        $page = $this->_request->getParam('page', 1);
        $pageSize = $this->_request->getParam('pageSize', 20);

        $page = $page ? $page : 1;
        $pageSize = $pageSize ? $pageSize : 20;

        $qc_code = $this->_request->getParam("qc_code","");
        $receiving_code = $this->_request->getParam("receiving_code","");
        $product_sku = $this->_request->getParam("product_sku","");
        $abnormal = $this->_request->getParam("abnormal","");
        $qc_add_time = $this->_request->getParam("qc_add_time","");
        $qc_finish_time_start = $this->_request->getParam("qc_finish_time_start","");
        $qc_finish_time_end = $this->_request->getParam("qc_finish_time_end","");
        $qc_status = $this->_request->getParam("qc_status","");
        $warehouseId = $this->_request->getParam("warehouse_id","");
        $reference_no = $this->_request->getParam("reference_no","");
        $session = new Zend_Session_Namespace('customerAuth');
        $sessionData = $session->data;
        $condition = array(
            'qc_code'=>$qc_code,
            'receiving_code'=>$receiving_code,
            'qc_add_time'=>$qc_add_time,
            'qc_finish_time_start'=>$qc_finish_time_start,
            'qc_finish_time_end'=>$qc_finish_time_end,
            'abnormal'=>$abnormal,
            'product_sku'=>$product_sku,
            'customer_code'=>$sessionData['code'],
            'qc_status'=>$qc_status,
            'warehouse_id'=>$warehouseId,
            'reference_no'=>$reference_no
        );

        $total = Service_QualityControl::getJoinProductByCondition($condition,"count(*)");
        $page = $page>ceil($total/$pageSize)?1:$page;
        $result = Service_QualityControl::getJoinProductByCondition($condition,"*",$pageSize, $page,array('qc_id desc'));
        foreach($result as $key=>$value){
            $w = Service_Warehouse::getByField($value['warehouse_id'],'warehouse_id',"*");
            $result[$key]['warehouse_name'] = $w['warehouse_name'];
        }
        $this->view->condition = $condition;
        $this->view->result = $result;
        $this->view->pageSize	= $pageSize;
        $this->view->page		= $page;
        $this->view->count = $total;
        $this->view->warehouse = Service_Warehouse::getAll();
        echo Ec::renderTpl($this->tplDirectory . "quality_control_index.tpl", 'noleftlayout');
    }

    public function qcAction()
    {

        $qcCode = $this->_request->getParam('code',"");
        //$qcRow = Service_QualityControl::getByField($qcCode,'qc_code',"*");
        $qcData=array();
        if(!empty($qcCode)){
            $qcObj= new Service_QualityControlProcess();
            $qcCodeArr[] = $qcCode;
            foreach($qcCodeArr as $key =>$val){
                $result=$qcObj->getQcOrder($val);
                if($result['state']){
                    $qcData[]=$result['data'];
                }
            }
            $this->view->data=$qcData;
        }
        echo $this->view->render($this->tplDirectory . "qc_submit_detail.tpl");
        //echo Ec::renderTpl($this->tplDirectory . );
    }
}
