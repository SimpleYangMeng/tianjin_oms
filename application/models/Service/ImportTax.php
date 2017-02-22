<?php
/**
 * 行邮税（行李和邮递物品进口税）
 */
class Service_ImportTax {
  /**
   * 计算订单行邮税
   * 
   * @param string $orderCode    订单号
   * @return double              返回需扣的行邮税值，不用扣行邮税的返回0
   */
  public static function calculate($orderCode) {
    $orderCode    = trim($orderCode);
    $orderProduct = Service_OrderProduct::getByCondition(array('order_code' => $orderCode));
    $tax          = 0;

    if ('' === $orderCode || empty($orderProduct)) {
      return $tax;
    }

    foreach ($orderProduct as $item) {
      $product = Service_Product::getByField((int) $item['product_id'], 'product_id');

      if (empty($product)) {
        continue ;
      }

      if (1 === (int) $product['product_type']) { // 组合产品分拆
        $rate  = self::productRate($product['product_id']);
        $total = $item['op_price'] * $item['op_quantity'];

        foreach ($rate as $sub) {
          $tax += $total * $sub['proportion'] * $sub['tax_rate'];
        }
      }
      else {
        $tax += $item['op_price'] * $item['op_quantity'] * $product['parcel_tax'];
      }
    }

    return $tax > 50 ? $tax : 0; // 行邮税不于50时才需扣除
  }

  /**
   * 获取订单行邮税详情
   * 此方法用于接口ServiceForOrder/getTaxByCode
   * 
   * @param string $orderCode    订单号
   * @return array
   */
  public static function detail($orderCode) {
    $orderCode    = trim($orderCode);
    $orderProduct = Service_OrderProduct::getByCondition(array('order_code' => $orderCode));
    $tax          = 0;
    $response     = array(
      'status'    => 0,
      'message'   => '',
      'taxPrice'  => 0,
      'skuDetail' => array(),
    );

    if ('' === $orderCode || empty($orderProduct)) {
      $response['message'] = '缺乏产品信息';

      return $response;
    }

    foreach ($orderProduct as $item) {
      $product = Service_Product::getByField((int) $item['product_id'], 'product_id');

      if (empty($product)) {
        continue ;
      }

      if (1 === (int) $product['product_type']) { // 组合产品分拆
        $rate  = self::productRate($product['product_id']);
        $total = $item['op_price'] * $item['op_quantity'];

        foreach ($rate as $sub) {
          $skuTax = $total * $sub['proportion'] * $sub['tax_rate'];
          $tax   += $total * $sub['proportion'] * $sub['tax_rate'];

          $response['skuDetail'][] = array(
            'sku'           => $sub['sku'],
            'quantity'      => $item['op_quantity'] * $sub['quantity'],
            'declaredPrice' => $item['op_price'] * $sub['proportion'],
            'taxNo'         => $sub['tax_no'],
            'taxRate'       => $sub['tax_rate'],
            'taxPrice'      => $skuTax,
          );
        }
      }
      else {
        $goodsTax = Service_GoodsTax::getByField((int) $product['gt_id'], 'gt_id');
        $skuTax   = $item['op_price'] * $item['op_quantity'] * $product['parcel_tax'];
        $tax     += $skuTax;

        $response['skuDetail'][] = array(
          'sku'           => $product['product_sku'],
          'quantity'      => $item['op_quantity'],
          'declaredPrice' => $item['op_price'],
          'taxNo'         => $goodsTax ? $goodsTax['gt_code'] : '',
          'taxRate'       => $product['parcel_tax'],
          'taxPrice'      => $skuTax,
        );
      }
    }

    if (!empty($response['skuDetail'])) {
      $response['status']   = 1;
      $response['taxPrice'] = ($tax > 50) ? $tax : 0;
    }

    return $response;
  }

  /**
   * 根据订单扣除行邮税
   * 
   * @param string $orderCode    订单号
   * @return boolean|string
   */
  public static function withhold($orderCode) {
    $importTax = Service_OtherFee::getByCondition(array(
      'fee_code'         => 'XYS',
      'application_code' => 'order',
      'status'           => 1,
    ));

    if (empty($importTax)) { // 没有设置行邮税杂费，不用扣除
      return TRUE;
    }

    $importTax = $importTax[0];
    $tax       = self::calculate($orderCode); // 计算订单行邮税

    if (!$tax) { // 不用扣除行邮税
      return TRUE;
    }

    $order = Service_Orders::getByField($orderCode, 'order_code');

    if (empty($order)) {
      return '订单【' . $orderCode . '】不存在';
    }

    $customer         = Service_Customer::getByField($order['customer_code'], 'customer_code');
    $customerCurrency = Service_Currency::getByField($customer['customer_currency'], 'currency_code');
    $feeCurrency      = Service_Currency::getByField($importTax['fee_currency_code'], 'currency_code');
    $balance          = Service_CustomerBalance::getByField($customer['customer_id'], 'customer_id');
    $fee              = $tax * $importTax['fee_discount'];
    $currencyRate     = $feeCurrency['currency_rate'] / $customerCurrency['currency_rate'];
    $finalFee         = round($fee * $currencyRate, 2);
    $cbValue          = $balance['cb_value'] - $finalFee;

    if (1 === (int) $customer['cash_type'] && $cbValue < 0) {
      return '账户余额不足';
    }

    // 更新金额
    Service_CustomerBalance::update(array(
      'cb_value'       => $cbValue,
      'cb_update_time' => date('Y-m-d H:i:s'),
    ), (int) $balance['cb_id'], 'cb_id');

    // 金额日志
    Service_CustomerBalanceLog::add(array(
      'customer_code'          => $customer['customer_code'],
      'customer_id'            => $customer['customer_id'],
      'cbl_type'               => 2,
      'cbl_transaction_value'  => $finalFee,
      'cbl_value'              => $fee,
      'currency_rate'          => $currencyRate,
      'currency_code'          => $importTax['fee_currency_code'],
      'cbl_note'               => $importTax['fee_name'],
      'user_id'                => 0,
      'fee_id'                 => $importTax['fee_id'],
      'cbl_current_value'      => $cbValue,
      'cbl_current_hold_value' => $balance['cb_hold_value'],
      'application_code'       => 1,
      'cbl_refer_type'         => 0,
      'cbl_refer_code'         => $orderCode,
      'cbl_cus_code'           => $order['reference_no'],
      'cbl_add_time'           => date('Y-m-d H:i:s'),
    ));

    return TRUE;
  }

  /**
   * 计算组合产品各个产品比率
   * 
   * @param integer $productId    组合产品ID
   * @return array
   */
  public static function productRate($productId) {
    $rate           = array();
    $totalDeclare   = 0;
    $productCombine = Service_ProductCombineRelation::getByCondition(array('product_id' => (int) $productId));

    if (empty($productCombine)) {
      return $rate;
    }

    foreach ($productCombine as $item) {
      $product = Service_Product::getByField((int) $item['pcr_product_id'], 'product_id');

      if (empty($product)) {
        continue ;
      }

      $goodsTax                     = Service_GoodsTax::getByField((int) $product['gt_id'], 'gt_id');
      $totalDeclare                += $product['product_declared_value'] * $item['pcr_quantity'];
      $rate[$product['product_id']] = array(
        'sku'      => $product['product_sku'],
        'quantity' => $item['pcr_quantity'],
        'declare'  => $product['product_declared_value'],
        'tax_rate' => $product['parcel_tax'],
        'tax_no'   => $goodsTax ? $goodsTax['gt_code'] : '',
      );
    }

    if ($totalDeclare > 0) { // 计算产品比重
      foreach ($rate as $id => $item) {
        $rate[$id]['proportion'] = $item['quantity'] * $item['declare'] / $totalDeclare;
      }

      return $rate;
    }

    return array();
  }
}
