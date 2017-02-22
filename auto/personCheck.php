<?php
/**
 * Created by PhpStorm.
 * User: WilliamFan
 * Date: 15-12-5
 * Time: 下午3:27
 * @todo 校验物品清单
 */
require_once ('config.php');

$flagFile = APPLICATION_PATH . '/../data/log/personCheck.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

$link = fopen($flagFile, 'wb');
fclose($link);

echo '[', date('Y-m-d H:i:s'), '] 校验个人物品清单开始.', "\r\n";

$condition  = array(
    'status'=>'1',
    'is_comparison'=>'0'
);
$count = Service_PersonItem::getByCondition(
    $condition,'count(*)'
);
$pageSize = 100;
//new
$object = Service_ThreeFromsCompareProcess::getInstance();
if($count>0){
    $pages = ceil($count/$pageSize);
    for($page=1;$page<=$pages;$page++){
        $rows = Service_PersonItem::getByCondition($condition,'*',$pageSize,$page);
        foreach($rows as $key=>$row){
            $result = $object->getCompare($row['pim_code']);
            if($result['ask'] == '1'){
                $msg = $object->getSuccess();
                echo $msg['pim_code'].':'.$msg['msg']."\r\n";
            }else{
                $msg = $object->getError();
                if(is_array($msg['msg'])){
                    $msg['msg'] = implode(',', $msg['msg']);
                }
                echo $msg['pim_code'].'验证规则【'.$msg['fc_code'].'】:'.$msg['msg']."\r\n";
            }
        }
    }
}
echo "[" . date('Y-m-d H:i:s') . "] 校验物品清单结束\r\n";
@unlink($flagFile);