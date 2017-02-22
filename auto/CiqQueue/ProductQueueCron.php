<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/CiqProductQueueCron.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 商品备案队列插入开始.', "\r\n";

$object = Common_CiqQueue::getInstance('Product');
$object->run();

echo "[" . date('Y-m-d H:i:s') . "] 商品备案队列插入结束\r\n";

@unlink($flagFile);
