<?php
require_once (__DIR__.'/../config.php');

$flagFile = APPLICATION_PATH . '/../data/log/CiqRecordCompaniesQueueCron.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flagFile}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 企业备案队列插入开始.', "\r\n";

$object = Common_CiqQueue::getInstance('RecordCompanies');
$object->run();

echo "[" . date('Y-m-d H:i:s') . "] 企业备案队列插入结束\r\n";

@unlink($flagFile);
