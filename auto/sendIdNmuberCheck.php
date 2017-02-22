<?php
/**
*	create by events
*   2015-12-15
*   身份证验证接口
*/
require_once ('config.php');

$flagFile = APPLICATION_PATH . '/../data/log/idNumCheckErrorLog.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}
echo '[', date('Y-m-d H:i:s'), '] 身份验证开始.', "\r\n";

Common_IdNumberCheck::getIdNumCheckData();

echo "[" . date('Y-m-d H:i:s') . "] 身份验证结束\r\n";
@unlink($flagFile);
