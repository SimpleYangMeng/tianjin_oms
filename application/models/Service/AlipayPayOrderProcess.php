<?php
/**
 * 支付宝支付报文
 */
class Service_AlipayPayOrderProcess {
  /**
   * 支付宝子账号
   */
  protected static $alipayAccount = 'U00000010';

/*
// 测试环境支付宝公钥
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDS92pDVyWNT7dzG9zH0opH44z
9FayCZTX5iqGUxUjPi667IkyaqrsmDPqKsJp47lJ29lzs+Qv8zjPPdmnxjFteMrf
pc4ui24gL1iZnchwX87Ox/+Xrm8HFmKlhmUO9n/QgTT+Nz1RGMEN1+HijvsoAhS0
TS8XjSfzRkrwvK2pJQIDAQAB
-----END PUBLIC KEY-----

// 正式环境支付宝公钥
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRA
FljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQE
B/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5Ksi
NG9zpgmLCUYuLkxpLQIDAQAB
-----END PUBLIC KEY-----
*/

  /**
   * 支付宝公钥
   */
  protected static $alipayPublicKey = <<<ALIPAYPUBLICKEY
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDS92pDVyWNT7dzG9zH0opH44z
9FayCZTX5iqGUxUjPi667IkyaqrsmDPqKsJp47lJ29lzs+Qv8zjPPdmnxjFteMrf
pc4ui24gL1iZnchwX87Ox/+Xrm8HFmKlhmUO9n/QgTT+Nz1RGMEN1+HijvsoAhS0
TS8XjSfzRkrwvK2pJQIDAQAB
-----END PUBLIC KEY-----
ALIPAYPUBLICKEY;

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
      'field' => 'customer_code',
      'name'  => '电商企业代码',
    ),
    'pay_enterprise_code' => array(
      'field' => 'pay_customer_code',
      'name'  => '支付企业代码',
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

  /**
   * 把支付宝传参转换为系统支付单
   * 
   * @param array $data    支付宝参数
   * @return boolean
   */
  public static function transform($data) {
    $data           = self::getParam($data);
    $alipayData     = self::filterAlipayData($data);
    $signString     = '';
    $signType       = '';
    $paramString    = array();
    $alipayPayOrder = array();
    $doNextAction   = TRUE;
    $apoId          = 0;
    $date           = date('Y-m-d H:i:s');
    $db             = Common_Common::getAdapter();

    // 去掉签名字段
    if (isset($data['sign'])) {
      $signString = $data['sign'];
      unset($data['sign']);
    }

    // 去掉签名类型
    if (isset($data['sign_type'])) {
      $signType = $data['sign_type'];
      unset($data['sign_type']);
    }

    // 字段按字母顺序排序
    ksort($data, SORT_STRING);

    foreach ($data as $k => $v) {
      $paramString[] = $k . '=' . $v;
    }

    // 按签名规则拼凑参数字符串
    $paramString = implode('&', $paramString);

    // START 支付宝支付信息验签校验
    $db->beginTransaction();

    try {
      // 数据验签
      $publicKey    = openssl_pkey_get_public(self::$alipayPublicKey);
      $verifyStatus = @openssl_verify($paramString, base64_decode($signString), $publicKey);
      @openssl_free_key($publicKey);

      // 数据无法通过验签
      if (!$verifyStatus) {
        throw new Exception('数据无法通过验签:' . $paramString . '#' . $signString);
      }

      if (!isset($alipayData['pay_transaction_no']) || '' === $alipayData['pay_transaction_no']) {
        throw new Exception('支付交易号不能为空');
      }

      $alipayPayOrder = Service_AlipayPayOrder::getByField($alipayData['pay_transaction_no'], 'pay_transaction_no');

      if (!empty($alipayPayOrder)) { // 幂等控制：已发过支付单，无需再处理，只作更新操作
        $apoId      = $alipayPayOrder['apo_id'];
        $alipayData = $alipayPayOrder;

        if (1 === (int) $alipayPayOrder['transform_status']) { // 已成功转换为平台支付单，无需再操作
          $doNextAction = FALSE;
        }
      }
      else { // 不存在，则插入数据表
        $alipayData['receive_time'] = $date;

        $apoId = Service_AlipayPayOrder::insert($alipayData);

        if (!$apoId) {
          throw new Exception('系统异常，请稍后再试');
        }
      }

      $db->commit();
    }
    catch (Exception $e) {
      $db->rollback();

      return $e->getMessage();
    }
    // END 支付宝支付信息验签校验

    // 无需下一步操作
    if (!$doNextAction) {
      return TRUE;
    }

    // START 支付宝支付信息转换为系统支付单
    $db->beginTransaction();

    try {
      $platformData = self::filterPlatformData($alipayData);
      $validate     = self::validate($platformData);

      if (!$validate['isValid']) {
        throw new Exception(implode('；', $validate['error']));
      }

      $platformData = $validate['data'];

      $platformData['pay_account_code'] = self::$alipayAccount; // 子账号

      // 子账号验证
      $account = Service_Account::getByField($platformData['pay_account_code'], 'account_code');

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

      // 检查币种是否存在
      $currency = Service_Currency::getByField($platformData['pay_currency_code'], 'currency_hs_code');

      if (empty($currency)) {
        throw new Exception('支付币制[' . $platformData['pay_currency_code'] . ']不存在', 101);
      }

      $platformData['pay_currency_code'] = $currency['currency_code'];

      // 判断电商企业代码有效性
      $eCustomer = Service_Customer::getByField($platformData['customer_code'], 'customer_code', array('customer_status', 'customer_code', 'trade_name', 'is_ecommerce'));

      if (empty($eCustomer) || 2 !== (int) $eCustomer['customer_status'] || 1 !== (int) $eCustomer['is_ecommerce']) {
        throw new Exception('电商企业代码[' . $platformData['customer_code'] . ']不存在', 101);
      }

      $platformData['enp_name'] = $eCustomer['trade_name'];

      // 验证订单是否存在
      $order = Service_Orders::getByCondition(array(
        'reference_no'  => $platformData['reference_no'],
        'customer_code' => $platformData['customer_code'],
      ));

      if (empty($order)) {
        throw new Exception('电商企业[' . $platformData['customer_code'] . ']不存在订单[' . $platformData['reference_no'] . ']', 101);
      }

      $platformData['ecommerce_platform_customer_code'] = $order[0]['ecommerce_platform_customer_code'];
      $platformData['ecommerce_platform_customer_name'] = $order[0]['ecommerce_platform_customer_name'];

      // 检查是否已经存在支付单
      $payOrder = Service_PayOrder::getByCondition(array(
        'pay_customer_code' => $platformData['pay_customer_code'],
        'pay_no'            => $platformData['pay_no'],
      ));

      if (empty($payOrder)) {
        $poCode = Common_GetNumbers::getCode('pay_order', 10, 'PO', '支付单编号');

        $platformData['po_code']     = $poCode;
        $platformData['add_time']    = $date;
        $platformData['update_time'] = $date;

        // 添加系统支付单
        $poId = Service_PayOrder::add($platformData);

        if (!$poId) {
          throw new Exception('系统异常，请稍后再试[支付单写入异常]', 101);
        }

        // 添加操作日志
        $polId = Service_PayOrderLog::add(array(
          'po_id'        => $poId,
          'po_code'      => $poCode,
          'pl_add_time'  => $date,
          'user_id'      => $account['account_id'],
          'pl_ip'        => Common_Common::getRealIp(),
          'pl_comments'  => '新增支付单[接口推送]',
          'account_name' => $account['account_name'],
        ));

        if (!$polId) {
          throw new Exception('系统异常，请稍后再试[支付单日志写入异常]', 101);
        }
      }

      // 更新支付宝支付单转换状态
      if (
        !Service_AlipayPayOrder::update(array(
          'transform_time'   => $date,
          'transform_status' => 1,
          'transform_remark' => '转换支付单成功',
        ), $apoId, 'apo_id')
      ) {
        throw new Exception('系统异常，请稍后再试[支付宝支付信息状态更新异常]', 101);
      }

      $db->commit();

      return TRUE;
    }
    catch (Exception $e) {
      $db->rollback();

      // 更新支付宝支付单转换状态
      if ($apoId && 101 === (int) $e->getCode()) {
        Service_AlipayPayOrder::update(array(
          'transform_time'   => $date,
          'transform_status' => 2,
          'transform_remark' => $e->getMessage(),
        ), $apoId, 'apo_id');
      }

      return $e->getMessage();
    }
    // END 支付宝支付信息转换为系统支付单
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
      if (isset($data[$param]) && '' !== trim($data[$param])) {
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
   * 获取支付宝传递过来的参数
   * 
   * @param array $data    请求参数
   * @return array
   */
  private static function getParam($data) {
    $validField = array_keys(self::$alipayFieldMap);
    $validData  = array();

    foreach ($validField as $field) {
      if (isset($data[$field]) && '' !== trim($data[$field])) {
        $validData[$field] = trim($data[$field]);
      }
    }

    return $validData;
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
