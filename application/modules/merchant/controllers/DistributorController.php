<?php
/**
 * 供应商管理模块
 * 
 * @author Daniel Chen
 * @date 2014.05.15
 */
class Merchant_DistributorController extends Ec_Controller_Action {
  public function preDispatch() {
    $this->tplDirectory = 'merchant/views/distributor/';
  }

  /**
   * 供应商列表Action
   */
  public function listAction() {
    $this->view->code = '';
    $this->view->name = '';
    $this->view->status = -1;
    $this->view->total = 0;
    $page = intval($this->_request->getParam('page', 1));
    $size = intval($this->_request->getParam('size', 20));
    $size = ($size < 1) ? 20 : (($size > 1000) ? 1000 : $size);

    if ($this->_request->isPost()) {
      $params = $this->_request->getPost();
      $code = trim($params['distributor_code']);
      $name = trim($params['distributor_name']);
      $status = intval($params['distributor_status']);
      $condition = array();

      if (!empty($code)) {
        $condition['distributor_code'] = $code;
        $this->view->code = $code;
      }

      if (!empty($name)) {
        $condition['distributor_name'] = $name;
        $this->view->name = $name;
      }

      if (in_array($status, array(0, 1), TRUE)) {
        $condition['distributor_status'] = $status;
        $this->view->status = $status;
      }

      $total = Service_Distributor::getCountByCustomerId((int) $this->_customerAuth['id'], $condition);
      $maxPage = ceil($total / $size);
      $data = Service_Distributor::getByCustomerId((int) $this->_customerAuth['id'], $condition, $page, $size);
    }
    else {
      $total = Service_Distributor::getCountByCustomerId((int) $this->_customerAuth['id']);
      $maxPage = ceil($total / $size);
      $data = Service_Distributor::getByCustomerId((int) $this->_customerAuth['id'], array(), $page, $size);
    }

    $page = ($page < 1) ? 1 : (($page > $maxPage) ? $maxPage : $page);
    $this->view->total = $total;
    $this->view->page = $page;
    $this->view->size = $size;
    $this->view->data = $data;

    echo Ec::renderTpl($this->tplDirectory . 'list.tpl', 'noleftlayout');
  }

  /**
   * 供应商数据添加Action
   */
  public function addAction() {
    $this->view->tip = '';
    $this->view->message = '';
    $this->view->code = '';
    $this->view->name = '';
    $this->view->status = 1;

    if ($this->_request->isPost()) {
      $params = $this->_request->getPost();
      $code = trim($params['distributor_code']);
      $name = trim($params['distributor_name']);
      $status = intval(trim($params['distributor_status']));
      $message = array();

      if (empty($code)) {
        array_push($message, Ec_Lang::getInstance()->getTranslate('DistributorCodeIsRequired'));
      }
      elseif (Service_Distributor::isRepeatCode($code, $this->_customerAuth['code'])) {
        array_push($message, sprintf(Ec_Lang::getInstance()->getTranslate('DistributorCodeExists'), $code));
      }

      if (empty($name)) {
        array_push($message, Ec_Lang::getInstance()->getTranslate('DistributorNameIsRequired'));
      }

      if (!in_array($status, array(0, 1), TRUE)) {
        $status = 1;
      }

      if (!empty($message)) {
        $this->view->code = $code;
        $this->view->name = $name;
        $this->view->status = $status;
        $this->view->tip = 'error';
        $this->view->message = implode('；', $message);
      }
      else {
        $data = array(
          'distributor_code' => $code,
          'distributor_name' => $name,
          'distributor_status' => $status,
          'distributor_creator' => $this->_customerAuth['account_id'],
          'distributor_created' => date('Y-m-d H:i:s'),
          'customer_code' => $this->_customerAuth['code'],
          'customer_id' => (int) $this->_customerAuth['id']
        );

        if (Service_Distributor::insert($data)) {
          $this->view->tip = 'info';
        }
        else {
          $this->view->tip = 'error';
          $this->view->message = Ec_Lang::getInstance()->getTranslate('DistributorSystemError');
        }
      }
    }

    echo Ec::renderTpl($this->tplDirectory . 'add.tpl', 'noleftlayout');
  }

  /**
   * 供应商数据编辑Action
   */
  public function editAction() {
    $distributorId = intval($this->_request->getParam('id', 0));
    $data = Service_Distributor::getByPrimaryKey($distributorId);

    if (!$distributorId || empty($data)) {
      $this->_redirect('/merchant/distributor/list');
      exit();
    }

    $this->view->tip = '';
    $this->view->message = '';
    $this->view->distributorId = $distributorId;
    $this->view->code = $data['distributor_code'];
    $this->view->name = $data['distributor_name'];
    $this->view->status = $data['distributor_status'];

    if ($this->_request->isPost()) {
      $params = $this->_request->getPost();
      $code = trim($params['distributor_code']);
      $name = trim($params['distributor_name']);
      $status = intval(trim($params['distributor_status']));
      $message = array();

      if (empty($code)) {
        array_push($message, Ec_Lang::getInstance()->getTranslate('DistributorCodeIsRequired'));
      }
      elseif (Service_Distributor::isRepeatCode($code, $this->_customerAuth['code'], $distributorId)) {
        array_push($message, sprintf(Ec_Lang::getInstance()->getTranslate('DistributorCodeExists'), $code));
      }

      if (empty($name)) {
        array_push($message, Ec_Lang::getInstance()->getTranslate('DistributorNameIsRequired'));
      }

      if (!in_array($status, array(0, 1), TRUE)) {
        $status = 1;
      }

      $this->view->code = $code;
      $this->view->name = $name;
      $this->view->status = $status;

      if (!empty($message)) {
        $this->view->tip = 'error';
        $this->view->message = implode('；', $message);
      }
      else {
        $data = array(
          //'distributor_code' => $code,
          'distributor_name' => $name,
          'distributor_status' => $status,
          'distributor_modifier' => $this->_customerAuth['account_id'],
          'distributor_modified' => date('Y-m-d H:i:s')
        );

        if (Service_Distributor::update($data, $distributorId)) {
          $this->view->tip = 'info';
        }
        else {
          $this->view->tip = 'error';
          $this->view->message = Ec_Lang::getInstance()->getTranslate('DistributorSystemError');
        }
      }
    }

    echo Ec::renderTpl($this->tplDirectory . 'edit.tpl', 'noleftlayout');
  }

  /**
   * 供应商详情Action
   */
  public function viewAction() {
    $distributorId = intval($this->_request->getParam('id', 0));
    $data = Service_Distributor::getByPrimaryKey($distributorId);

    if (!$distributorId || empty($data)) {
      $this->_redirect('/merchant/distributor/list');
      exit();
    }

    $this->view->distributorId = $data['distributor_id'];
    $this->view->code = $data['distributor_code'];
    $this->view->customerCode = $data['customer_code'];
    $this->view->name = $data['distributor_name'];
    $this->view->status = $data['distributor_status'];
    $this->view->creator = '';
    $this->view->created = $data['distributor_created'];
    $this->view->modifier = '';
    $this->view->modified = '';

    if ($data['distributor_creator']) {
      $customer = Service_Account::getByField($data['distributor_creator'], 'account_id');

      if ($customer && 1 === (int) $customer['account_level']) {
        $this->view->creator = $customer['account_name']; // 子账号显示用户名
      }
      elseif ($customer) { // 主账号显示客户代码
        $this->view->creator = $customer['customer_code'];
      }
      else {
        $this->view->creator = '';
      }
    }

    if ($data['distributor_modifier']) {
      $customer = Service_Account::getByField($data['distributor_modifier'], 'account_id');

      if ($customer && 1 === (int) $customer['account_level']) {
        $this->view->modifier = $customer['account_name']; // 子账号显示用户名
      }
      elseif ($customer) { // 主账号显示客户代码
        $this->view->modifier = $customer['customer_code'];
      }
      else {
        $this->view->modifier = '';
      }
    }

    if ('0000-00-00 00:00:00' != $data['distributor_modified']) {
      $this->view->modified = $data['distributor_modified'];
    }

    echo Ec::renderTpl($this->tplDirectory . 'detail.tpl', 'noleftlayout');
  }

  /**
   * 查找供应商相关数据AJAX请求，用于【产品管理】“产品新增”
   */
  public function ajaxAction() {
    $json = array('status' => FALSE, 'data' => array(), 'message' => 'ERROR_INVALID_REQUEST');

    if ($this->_request->isPost()) {
      $type = trim($this->_request->getPost('type', 0));

      if (1 == $type) {
        $code = trim($this->_request->getPost('code', ''));
        $data = array();

        if (!empty($code)) {
          $data = Service_Distributor::getByCode($code, (int) $this->_customerAuth['id']);
        }

        if (!empty($data)) {
          $json = array(
            'status' => TRUE,
            'data' => array(
              'distributor_id' => $data['distributor_id'],
              'distributor_name' => $data['distributor_name'],
              'distributor_code' => $data['distributor_code']
            ),
            'message' => 'INFO_SUCCESS'
          );
        }
        else {
          $json['message'] = 'INFO_NO_DATA';
        }
      }
      elseif (2 == $type) {
        $code = trim($this->_request->getPost('code', ''));
        $name = trim($this->_request->getPost('name', ''));
        $page = intval($this->_request->getPost('page', 1));
        $size = intval($this->_request->getPost('size', 20));
        $total = 0;
        $condition = array(
          'distributor_code' => $code,
          'distributor_name' => $name,
          'distributor_status' => 1
        );
        $distributorName = Ec_Lang::getInstance()->getTranslate('DistributorName');
        $distributorCode = Ec_Lang::getInstance()->getTranslate('DistributorCode');
        $distributorSelect = Ec_Lang::getInstance()->getTranslate('DistributorSelect');
        $distributorOperationSelect = Ec_Lang::getInstance()->getTranslate('DistributorOperationSelect');
        $distributorNoSearchData = Ec_Lang::getInstance()->getTranslate('DistributorNoSearchData');
        $table = '<tr><th style="width:30%;">' . $distributorCode . '</th><th style="width:50%;">' . $distributorName . '</th><th style="width:20%;">' . $distributorSelect . '</th></tr>';
        $total = Service_Distributor::getCountByCustomerCode($this->_customerAuth['code'], $condition);
        $page = ($page < 0) ? 1 : ($page > ceil($total / $size) ? ceil($total / $size) : $page);
        $data = Service_Distributor::getByCustomerCode($this->_customerAuth['code'], $condition, $page, $size);

        if (empty($data)) {
          $table .= '<tr class="even"><td colspan="3" style="text-align:center;">' . $distributorNoSearchData . '</td></tr>';
        }
        else {
          foreach ($data as $index => $item) {
            if (0 == $index % 2) {
              $table .= '<tr class="even">';
            }
            else {
              $table .= '<tr class="odd">';
            }

            $table .= '<td style="text-align:center;">' . $item['distributor_code'] . '</td>';
            $table .= '<td>' . $item['distributor_name'] . '</td>';
            $table .= '<td style="text-align:center;"><input type="button" class="button" value="' . $distributorOperationSelect . '"';
            $table .= ' onclick="selectDistributor(' . $item['distributor_id'];
            $table .= ', \'' . htmlspecialchars($item['distributor_code']) . '\', \'';
            $table .= htmlspecialchars($item['distributor_name']) . '\');" />';
          }
        }

        $json = array(
          'status' => TRUE,
          'data' => array(
            'total' => $total,
            'page' => $page,
            'size' => $size,
            'html' => $table
          ),
          'message' => 'INFO_REQUEST_SUCCESS'
        );
      }
    }

    exit(Zend_Json::encode($json));
  }
}
