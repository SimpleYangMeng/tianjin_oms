<?php
require_once ('config.php');

$flagFile = APPLICATION_PATH . '/../data/log/CiqNoticeDownload.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 下载解析公告报文开始.', "\r\n";

Common_CiqNoticeDownload::downloadFile();

echo "[" . date('Y-m-d H:i:s') . "] 下载解析公告报文结束\r\n";

@unlink($flagFile);
