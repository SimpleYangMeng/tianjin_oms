<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/FeedBackUploadXmlCron.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 咨询投诉发送商检备案报文开始.', "\r\n";

$object = Common_ShangjianXml::getInstance('FeedBack');
$object->uploadXml();

echo "[" . date('Y-m-d H:i:s') . "] 咨询投诉发送商检备案报文结束\r\n";

@unlink($flagFile);
