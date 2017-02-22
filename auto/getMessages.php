<?php
require_once 'config.php';
$flagFile = APPLICATION_PATH . '/../data/log/getMessage.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

echo "开始\n\t";
for ($i = 0; $i < 1000; $i++) {
    $result = Common_MessageToData::fetchMessage();
    if ($result['ask'] != 1) {
        break;
    }
}
echo "结束";

@unlink($flagFile);