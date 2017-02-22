<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/DeliveredQueueCron.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 妥投回执插入队列开始.', "\r\n";

$object = Common_Queue::getInstance('Delivered');
$object->run();

echo "[" . date('Y-m-d H:i:s') . "] 妥投回执插入队列结束\r\n";

@unlink($flagFile);
