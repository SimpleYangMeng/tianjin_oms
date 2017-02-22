<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/DeliveredSendMessageCron.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 发送妥投报文开始.', "\r\n";

$object = Common_SendMessage::getInstance('Delivered');
$object->sendMessage();

echo "[" . date('Y-m-d H:i:s') . "] 发送妥投报文结束\r\n";

@unlink($flagFile);
