<?php
/**
 *
 */
class Storage_InventoryController extends Ec_Controller_Action
{
    public function preDispatch()
    {
        $this->tplDirectory = "storage/views/Inventory/";
    }

    /**
     * 料件级库存
     * @return [type] [description]
     */
    public function productInventoryAction()
    {
        $params   = $this->_request->getParams();
        $page     = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 20;
		$warehouseInfo	= Service_Warehouse::getByCondition(array('customer_code'=>$this->_customerAuth['code']));
		$warehouseArray	= array();
		foreach($warehouseInfo as $key=>$val){
			$warehouseArray[]	= $val['warehouse_code'];
		}
        $condition                   = array();
        $condition['goods_id']       = $params['goods_id'];
        $condition['warehouse_array'] = $warehouseArray;
		
        $count = Service_ProductInventory::getByCondition($condition, 'count(*)');

        $productInventoryRows = array();
        if ($count > 0) {
            $productInventoryRows = Service_ProductInventory::getByCondition($condition, '*', $pageSize, $page);
        }

        $this->view->count                = $count;
        $this->view->page                 = $page;
        $this->view->pageSize             = $pageSize;
        $this->view->condition            = $condition;
        $this->view->productInventoryRows = $productInventoryRows;
        echo Ec::renderTpl($this->tplDirectory . 'productInventory.tpl', 'noleftlayout');
        exit;
    }

    public function productViewAction()
    {
        $params              = $this->_request->getParams();
        $piId                = $params['piId'];
        $productInventoryRow = Service_ProductInventory::getByField($piId);
        if ($productInventoryRows) {
            echo "<div>参数错误</div>";
            die();
        }
        $this->view->productInventoryRow = $productInventoryRow;
        echo $this->view->render($this->tplDirectory . 'productView.tpl');
    }

    /**
     * [receivingInventoryAction description]
     * @return [type] [description]
     */
    public function receivingInventoryAction()
    {
        $params   = $this->_request->getParams();
        $page     = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : 20;
		$warehouseInfo	= Service_Warehouse::getByCondition(array('customer_code'=>$this->_customerAuth['code']));
		$warehouseArray	= array();
		foreach($warehouseInfo as $key=>$val){
			$warehouseArray[]	= $val['warehouse_code'];
		}
		
        $condition                   = array();
        $condition['receiving_code'] = $params['receiving_code'];
		$condition['warehouse_array'] = $warehouseArray;

        $count = Service_ReceivingInventory::getByCondition($condition, 'count(*)');

        $receivingInventoryRows = array();
        if ($count > 0) {
            $receivingInventoryRows = Service_ReceivingInventory::getByCondition($condition, '*', $pageSize, $page);
        }
		$this->view->productUom	= Common_DataCache::getProductUomCode();
        $this->view->count                  = $count;
        $this->view->page                   = $page;
        $this->view->pageSize               = $pageSize;
        $this->view->condition              = $condition;
        $this->view->receivingInventoryRows = $receivingInventoryRows;
        echo Ec::renderTpl($this->tplDirectory . 'receivingInventory.tpl', 'noleftlayout');
        exit;
    }
}
