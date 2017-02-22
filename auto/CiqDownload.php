<?php
require_once ('config.php');

$flagFile = APPLICATION_PATH . '/../data/log/CiqDownload.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 下载解析报文开始.', "\r\n";

Common_CiqDownload::downloadFile();

echo "[" . date('Y-m-d H:i:s') . "] 下载解析报文结束\r\n";

@unlink($flagFile);
