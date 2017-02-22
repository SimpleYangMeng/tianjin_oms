<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/GetReceiptCron.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 接收报文开始.', "\r\n";

$getReceipt = array(
    "ZCR002","ZCR004","BIR002","BAR002","BAR004","BAR010","BAR012","BIR006","BIR004",
    "BIR008","BAR006","BAR008","BUR006","BUR008","BUR002","BUR004","BUR016","BUR010",
    "BUR012","BUR028",'BKK001','BKK002','SDD001','BUR022','BUR024','ERR001','YTR002',
    'ZCR006','ZCR008','BUR020','BUS018','BUS020','LBR002'
);
foreach ($getReceipt as $key => $value) {
    Common_GetReceipt::getInstance($value);
}

echo "[" . date('Y-m-d H:i:s') . "] 接收报文结束\r\n";

@unlink($flagFile);
