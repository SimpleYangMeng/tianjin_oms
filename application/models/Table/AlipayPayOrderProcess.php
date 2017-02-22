<?php
/**
 * 支付宝支付报文
 */
class Service_AlipayPayOrderProcess {
  /**
   * 支付宝传输参数跟数据表字段对应关系
   * 
   * 支付宝参数 => 数据库表字段
   */
  protected static $alipayFieldMap = array(
    'notify_type'       => 'notify_type',         // 通知类型
    'notify_id'         => 'notify_id',           // 通知验证ID
    'notify_time'       => 'notify_time',         // 通知时间
    'sign'              => 'sign',                // 签名
    '_input_charset'    => 'input_charset',       // 字符编码
    'sign_type'         => 'sign_type',           // 签名类型
    'orderNo'           => 'order_no',            // 订单编号
    'eCommerceCode'     => 'e_commerce_code',     // 电商平台编号
    'payMerchantCode'   => 'pay_merchant_code',   // 支付宝商家编号
    'payTransactionNo'  => 'pay_transaction_no',  // 支付宝交易号
    'payAmount'         => 'pay_amount',          // 支付金额（货款+税款+运费）
    'payAmountCurr'     => 'pay_amount_curr',     // 支付金额币制（海关编码，人民币142）
    'payGoodsAmount'    => 'pay_goods_amount',    // 支付货款
    'payTaxAmount'      => 'pay_tax_amount',      // 支付税款
    'freight'           => 'freight',             // 支付运费
    'payTimeStr'        => 'pay_time_str',        // 付款时间
    'payEnterpriseName' => 'pay_enterprise_name', // 支付企业名称
    'payEnterpriseCode' => 'pay_enterprise_code', // 支付企业代码
    'payAccount'        => 'pay_account',         // 买家支付宝账号
    'payerName'         => 'payer_name',          // 买家支付宝姓名
    'payerCertType'     => 'payer_cert_type',     // 支付人证件类型：01身份证、02护照、03其他
    'payerCertNo'       => 'payer_cert_no',       // 支付人证件号码
    '_pending01'        => '_pending01',          // 支付宝待定字段：电商平台名称
    '_pending02'        => '_pending02',          // 支付宝待定字段：电商企业代码
    '_pending03'        => '_pending03',          // 支付宝待定字段：电商企业名称
    '_pending04'        => '_pending04',          // 支付宝待定字段：支付企业子账号
  );

  /**
   * 数据表参数跟支付单数据表字段对应关系
   * 
   * 数据表字段 => 支付单数据表字段
   */
  protected static $payOrderFieldMap = array(
    'pay_transaction_no'  => array(
      'field' => 'pay_no',
      'name'  => '支付交易号',
    ),
    'e_commerce_code'     => array(
      'field' => 'ecommerce_platform_customer_code',
      'name'  => '电商平台代码',
    ),
    '_pending01'          => array( // 支付宝待定字段：电商平台名称
      'field' => 'ecommerce_platform_customer_name',
      'name'  => '电商平台名称',
    ),
    '_pending02'          => array( // 支付宝待定字段：电商企业代码
      'field' => 'customer_code',
      'name'  => '电商企业代码',
    ),
    '_pending03'          => array( // 支付宝待定字段：电商企业名称
      'field' => 'enp_name',
      'name'  => '电商企业名称',
    ),
    '_pending04'          => array( // 支付宝待定字段：支付企业子账号
      'field' => 'pay_account_code',
      'name'  => '支付企业子账号', // U00000010
    ),
    'pay_enterprise_code' => array(
      'field' => 'pay_customer_code',
      'name'  => '支付企业代码', // Z000000003
    ),
    'pay_enterprise_name' => array(
      'field' => 'pay_enp_name',
      'name'  => '支付企业名称',
    ),
    'order_no'            => array(
      'field' => 'reference_no',
      'name'  => '电商订单编号',
    ),
    'pay_amount_curr'     => array(
      'field' => 'pay_currency_code',
      'name'  => '支付币制',
    ),
    'pay_amount'          => array(
      'field' => 'pay_amount',
      'name'  => '支付金额',
    ), 
    'payer_cert_no'       => array(
      'field' => 'cosignee_code',
      'name'  => '支付人证件号码',
    ),
    'payer_name'          => array(
      'field' => 'cosignee_name',
      'name'  => '支付人姓名',
    ),
  );

  public static function transform($data) {
    $alipayData   = self::filterAlipayData($data);
    $platformData = self::filterPlatformData($alipayData);
    $isNew        = TRUE;
    $db           = Common_Common::getAdapter();

    $db->beginTransaction();

    try {
      $validate = self::validate($platformData);

      if (!$validate['isValid']) {
        throw new Exception(implode('；', $validate['error']));
      }

      $alipayPayOrder = Service_AlipayPayOrder::getByField($alipayData['pay_transaction_no'], 'pay_transaction_no');
      $platformData   = $validate['data'];
      $apoId          = 0;
      $doNextAction   = TRUE;

      if (!empty($alipayPayOrder)) { // 幂等控制：已发过支付单，无需再处理，只作更新操作
        $apoId = $alipayPayOrder['apo_id'];
        $isNew = FALSE;
        //Service_AlipayPayOrder::update($alipayData, $apoId, 'apo_id');

        if (1 === (int) $alipayPayOrder['transform_status']) { // 已成功转换为平台支付单，无需再操作
          $doNextAction = FALSE;
        }
      }
      else { // 不存在，则插入数据表
        $alipayData['receive_time'] = date('Y-m-d H:i:s');

        $apoId = Service_AlipayPayOrder::insert($alipayData);

        if (!$apoId) {
          throw new Exception('系统异常，请稍后再试');
        }
      }

      if ($doNextAction) {
        // 子账号验证
        $account = $account = Service_Account::getByField($platformData['pay_account_code'], 'account_code');

        if (empty($account) || 1 !== (int) $account['account_level']) {
          throw new Exception('子账号代码[' . $platformData['pay_account_code'] . ']不存在', 101);
        }

        if ($account['customer_code'] !== $platformData['pay_customer_code']) {
          throw new Exception('子账号代码[' . $platformData['pay_account_code'] . ']不归属于支付企业[' . $platformData['pay_customer_code'] . ']', 101);
        }

        // 主帐号验证
        $customer = Service_Customer::getByField($platformData['pay_customer_code'], 'customer_code', array('customer_status', 'customer_code', 'trade_name', 'is_pay'));

        if (empty($customer) || 2 !== (int) $customer['customer_status'] || 1 !== (int) $customer['is_pay']) {
          throw new Exception('支付企业代码[' . $platformData['pay_account_code'] . ']不存在', 101);
        }

        if ($customer['trade_name'] !== $platformData['pay_enp_name']) {
          throw new Exception('支付企业名称与备案的支付企业名称[' . $customer['trade_name'] . ']不一致', 101);
        }

        // 验证订单是否存在
        $order = Service_Orders::getByCondition(array(
          'reference_no'  => $platformData['reference_no'],
          'customer_code' => $platformData['customer_code'],
        ));

        if (empty($order)) {
          throw new Exception('电商企业[' . $platformData['customer_code'] . ']不存在订单[' . $platformData['reference_no'] . ']', 101);
        }

        // 检查是否已经存在支付单
        $payOrder = Service_PayOrder::getByCondition(array(
          'pay_customer_code' => $platformData['pay_customer_code'],
          'pay_no'            => $platformData['pay_no'],
        ));

        if (empty($payOrder)) {
          $poCode = Common_GetNumbers::getCode('pay_order', 10, 'PO', '支付单编号');
          $date   = date('Y-m-d H:i:s');

          $platformData['po_code']     = $poCode;
          $platformData['add_time']    = $date;
          $platformData['update_time'] = $date;

          if (!Service_PayOrder::add($platformData)) {
            throw new Exception('系统异常，请稍后再试', 101);
          }

          if (
            Service_AlipayPayOrder::update(array(
              'transform_time'   => date('Y-m-d H:i:s'),
              'transform_status' => 1,
            ), $apoId, 'apo_id')
          ) {
            throw new Exception('系统异常，请稍后再试', 101);
          }
        }
      }

      $db->commit();

      return TRUE;
    }
    catch (Exception $e) {
      $db->rollback();

      if ($isNew && 101 === (int) $e->getCode()) {
        $date = date('Y-m-d H:i:s');

        $alipayData['receive_time']     = $date;
        $alipayData['transform_time']   = $date;
        $alipayData['transform_status'] = 2;

        Service_AlipayPayOrder::insert($alipayData);
      }

      return $e->getMessage();
    }
  }

  /**
   * 过滤支付宝参数
   * 
   * @param array $data
   * @return array
   */
  private static function filterAlipayData($data) {
    $filter = array();

    foreach (self::$alipayFieldMap as $param => $field) {
      if (isset($data[$param])) {
        $filter[$field] = trim($data[$param]);
      }
    }

    return $filter;
  }

  /**
   * 过滤平台参数
   * 
   * @param array $data
   * @return array
   */
  private static function filterPlatformData($data) {
    $filter = array();

    foreach (self::$payOrderFieldMap as $field => $item) {
      if (isset($data[$field])) {
        $filter[$item['field']] = array(
          'name'  => $item['name'],
          'value' => trim($data[$field]),
        );
      }
      else {
        $filter[$item['field']] = array(
          'name'  => $item['name'],
          'value' => '',
        );
      }
    }

    return $filter;
  }

  /**
   * 支付单数据项初步验证（值是否为空）
   * 
   * @param array $data
   * @return array
   */
  private static function validate($data) {
    $error  = array();
    $filter = array();

    foreach ($data as $field => $item) {
      $filter[$field] = $item['value'];

      if ('' === $item['value']) {
        $error[] = $item['name'] . '不能为空';
      }
    }

    return array(
      'isValid'  => empty($error) ? TRUE : FALSE,
      'error'    => $error,
      'data'     => $filter,
    );
  }
}
