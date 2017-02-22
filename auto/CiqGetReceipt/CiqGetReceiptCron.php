<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/ciqGetReceipt.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 接收报文开始.', "\r\n";

/* 回执编号对照 
 * 200 - 企业备案回执
 * 201 - 企业锁定
 * 210 - 商品备案回执
 * 350 - 订单回执
 * 351 - 运单回执
 * 352 - 支付单回执
 * 230 - 物品清单回执(出区进口单)
 * 220 - 入库单回执
 * 221 - 入区单检疫
 * 226 - 入库单布控
 * 228 - 二维码回执
 * 231 - 物品清单检疫
 * 236 - 物品清单布控
 * 552 - 咨询投诉
 */

$getReceipt = array(
	'200',
    '210',
    '211',
    '350',
    '351',
    '352',
    '230',
    '220',
    '228',
    '552',
    '201',
    '231',
    '236',
    '221',
    '226'
);
foreach ($getReceipt as $key => $value) {
    Common_CiqReceipt::getInstance($value);
}

echo "[" . date('Y-m-d H:i:s') . "] 接收报文结束\r\n";

@unlink($flagFile);
