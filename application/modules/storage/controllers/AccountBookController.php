<?php

class Storage_AccountBookController extends Ec_Controller_Action
{

    public function preDispatch()
    {
        if (!isset($this->_customerAuth['customer_priv']['is_storage']) || $this->_customerAuth['customer_priv']['is_storage'] != 1) {
            die('仓储企业才可以管理帐册！');
        }
        $this->tplDirectory = "storage/views/book/";
    }

    /**
     * 帐册管理
     * @return [type] [description]
     */
    public function indexAction()
    {

        $params                        = $this->_request->getParams();
        $page                          = isset($params['page']) ? $params['page'] : 1;
        $pageSize                      = isset($params['pageSize']) ? $params['pageSize'] : 20;
        $condition                     = array();
        $condition['customer_code']    = $this->_customerAuth['code'];
        $condition['warehouse_name']   = isset($params['warehouse_name']) ? $params['warehouse_name'] : '';
        $condition['warehouse_code']   = isset($params['warehouse_code']) ? $params['warehouse_code'] : '';
        $condition['ie_type']          = isset($params['ie_type']) ? $params['ie_type'] : '';
        $condition['customs_code']     = isset($params['customs_code']) ? $params['customs_code'] : '';
        $condition['warehouse_status'] = isset($params['warehouse_status']) ? $params['warehouse_status'] : '';

        $count         = Service_Warehouse::getByCondition($condition, 'count(*)');
        $warehouseRows = array();
        if ($count > 0) {
            $warehouseRows = Service_Warehouse::getByCondition($condition, '*', $pageSize, $page);
        }
        $statusGroupRows = Service_Warehouse::getGroupByCondition($condition, 'warehouse_status');

        $this->view->count           = $count;
        $this->view->page            = $page;
        $this->view->pageSize        = $pageSize;
        $this->view->condition       = $condition;
        $this->view->warehouseRows   = $warehouseRows;
        $this->view->ieTypeRows      = Common_CommonConfig::getIeType2();
        $this->view->customsCodeRows = Common_DataCache::getIePort();
        $this->view->statusRows      = Service_Warehouse::getStatus();
        $this->view->statusGroupRows = $statusGroupRows;
        echo Ec::renderTpl($this->tplDirectory . 'account_list.tpl', 'noleftlayout');
        exit;

    }

    /**
     * 添加账册
     */
    public function addAction()
    {

        if ($this->_request->isPost()) {
            $result = array(
                'ask'     => '0',
                'message' => '',
                'error'   => array(),
            );

            $params = $this->_request->getParams();
            $data   = array(
                'trade_co'           => $params['trade_co'],
                'trade_name'         => $params['trade_name'],
                'area'               => $params['area'],
                'address'            => $params['address'],
                'contacter'          => $params['contacter'],
                'phone_no'           => $params['phone_no'],
                'note'               => $params['note'],
                'ie_type'            => $params['ie_type'],
                'customs_code'       => $params['customs_code'],
                'customs_using_code' => $params['customs_using_code'],
            );

            $accountBookProcess = new Service_AccountBookProcess();

            $result = $accountBookProcess->createProductTransaction($data, $this->_customerAuth['account_code']);

            die(json_encode($result));
        }

        $this->view->customsCodeRows = Common_DataCache::getIePort();
        $this->view->ieTypeRows      = Common_CommonConfig::getIeType2();
        echo Ec::renderTpl($this->tplDirectory . 'account-create.tpl', 'noleftlayout');
        exit;
    }

    /**
     * 查看账册
     * @param string $value [description]
     */
    public function viewAction()
    {
        $warehouseCode = $this->_request->getParam('warehouse_code', '');
        if (empty($warehouseCode)) {
            die('账册不存在！');
        }
        $warehouseRow = Service_Warehouse::getByField($warehouseCode, 'warehouse_code');
        if ($warehouseRow['customer_code'] != $this->_customerAuth['code']) {
            die('账册不存在！');
        }

        $warehouseLogRows = Service_WarehouseLog::getByCondition(array(
            'warehouse_id' => $warehouseRow['warehouse_id'],
        ));
        $productInventoryRows = Service_ProductInventory::getByCondition(array(
            'warehouse_code' => $this->_customerAuth['code'],
            'ie_type'        => $warehouseRow['ie_type'],
        ));
        $this->view->productInventoryRows = $productInventoryRows;
        $this->view->warehouseLogRows     = $warehouseLogRows;
        $this->view->warehouseRow         = $warehouseRow;
        $this->view->ieTypeRows           = Common_CommonConfig::getIeType2();
        $this->view->customsCodeRows      = Common_DataCache::getIePort();
        $this->view->statusRows           = Service_Warehouse::getStatus();
        echo Ec::renderTpl($this->tplDirectory . 'account-detail.tpl', 'noleftlayout');
    }

}
