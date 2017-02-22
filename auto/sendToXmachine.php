<?php
/**
 * 发送检查数据到光机
 */
require_once ('config.php');
$flagFile = APPLICATION_PATH . '/../data/log/sendToXmachine.lock';

if (@file_exists($flagFile)) {
    echo "Another process is running.\r\n";
    echo "{$flag}\r\n";
    exit();
}

echo '[', date('Y-m-d H:i:s'), '] 发送数据到X光机开始.', "\r\n";
sendToXmachine();
echo "[" . date('Y-m-d H:i:s') . "] 发送数据到X光机结束.\r\n";
@unlink($flagFile);

/**
 * [pageInfo 分页信息]
 * @return [type] [description]
 */
function pageInfo() {
    $rowTotal = Service_CiqCheckMessage::getByCondition(array('ciq_status'=> 1) , 'count(*)');
    if($rowTotal == 0){
        return array(
            'rowTotal' => 0
        );
    }
    $pageSize = Common_CiqQueue::PAGESIZE;
    $pageTotal = ceil($rowTotal / $pageSize);
    return array(
        'rowTotal' => $rowTotal,
        'pageSize'  => $pageSize,
        'pageTotal' => $pageTotal
    );
}

/**
 * [sendToXmachine description]
 * @return [type] [description]
 */
function sendToXmachine(){
    $pageInfo = pageInfo();
    if($pageInfo['rowTotal'] == 0){
        debug('暂无数据处理');
        return true;
    }
    //获取要插入的数据
    $min_id = 0;
    for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
        $min_id = getData($pageInfo['pageSize'] , $min_id);
        if($min_id === false){
            break;
        }
    }
    return true;
}

function getData($pageSize = Common_CiqQueue::PAGESIZE, $min_id = 0){
    $ccm_data = Service_CiqCheckMessage::getByStatus(1, $min_id, $pageSize);
    if(!empty($ccm_data) && is_array($ccm_data)){
        foreach ($ccm_data as $ccm_row) {
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                //调用发送
                $send_res = Service_XmachineProcess::send($ccm_row['pim_code']);
                if(array_key_exists('ask', $send_res) && $send_res['ask'] == 1){
                    //修改状态
                    $min_id = Service_CiqCheckMessage::update(array( 'ciq_status' => 2, 'ccm_update_time'=>date( "Y-m-d H:i:s")), $ccm_row['ccm_id']);
                    if(!$min_id){
                        throw new Exception('发送光机队列ID['.$ccm_row['ccm_id'].']更新状态失败');
                    }
                    debug('物品清单['.$ccm_row['pim_code'].']发送光机成功');
                }else {
                   throw new Exception('物品清单['.$ccm_row['pim_code'].']发送光机失败：'.$send_res['message']);
                }
                $db->commit();
            }catch(Exception $e){
                 $db->rollback();
                 debug($e->getMessage());
                 continue;
            }
        }
    }
    return $min_id;
}

function debug($message = '')
{
    $dateTime = '['.date('Y-m-d H:i:s').']';
    echo $dateTime.$message . "\n\t";
}
