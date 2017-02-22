<?php
/**
*   2015-12-15
*   身份证验证接口
*/
require_once ('config.php');
/*
$flagFile = APPLICATION_PATH . '/../data/log/TjIdNmuberCheck.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}
*/
echo '[', date('Y-m-d H:i:s'), '] 天津地区身份验证开始.', "\r\n";

Common_GetReceipt::getInstance('LBR002');

echo "[" . date('Y-m-d H:i:s') . "] 天津地区身份验证结束\r\n";
//@unlink($flagFile);