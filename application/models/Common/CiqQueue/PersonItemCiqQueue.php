<?php
/**
*
*/
class PersonItemCiqQueue
{
    private $status = array(
        'send_before' => 0,
        'send_after' => 3,
        //海关状态
        'customs_status_send_before_arr' => array(1, 3, 5, 6, 8, 9),
    );
    private $queueInfo = array(
        'api_code'  =>  'PersonItem',
        'status' =>  0
    );
    
    /**
     * 开始插入
     * Enter description here ...
     */
    public function run()
    {
        $pageInfo = $this->pageInfo();
        if($pageInfo['rowTotal'] == 0){
            return true;
        }
        //print_r($pageInfo);exit;
        //获取要插入的数据
        $minId = 0;
        for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->insertQueue($pageInfo['pageSize'] , $minId);
            if($minId === false){
                break;
            }
        }
    }

    /**
     * 循环插入
     * Enter description here ...
     * @param unknown_type $pageSize
     * @param unknown_type $minId
     */
    private function insertQueue($pageSize = Common_CiqQueue::PAGESIZE , $minId = 0)
    {
        $personItemRows = Service_PersonItem::getByCiqStatus($this->status['customs_status_send_before_arr'], $this->status['send_before'] , $pageSize , $minId);
        if(empty($personItemRows)){
            return false;
        }
        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;
        //插入api_message
        //api_message 提交
        foreach ($personItemRows as $key => $value) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $value['pim_id'];
            $insertQueueRow['refer_code'] = $value['pim_code'];
            $insertQueueRow['ref_cus_code'] = $value['pim_reference_no'];
            $insertQueueRow['add_date'] = $time;
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                $pmByLockData = Service_PersonItem::getByFieldLock($value['pim_id'], 'pim_id');
                if($pmByLockData['ciq_status'] != $this->status['send_before'] || !in_array($pmByLockData['customs_status'], $this->status['customs_status_send_before_arr'])){
                    throw new Exception('物品清单['.$pmByLockData['pim_code'].']-海关状态['.$pmByLockData['customs_status'].']-商检状态['.$pmByLockData['ciq_status'].']暂不发送');
                }
                if(Service_CiqApiMessage::add($insertQueueRow) === false){
                    throw new Exception('物品清单['.$value['pim_code'].']插入队列失败');
                }
                $minId = Service_PersonItem::update(array('ciq_status'=>$this->status['send_after'], 'pim_update_time'=>date('Y-m-d H:i:s')), $value['pim_id'], 'pim_id');
                if(!$minId){
                    throw new Exception('物品清单['.$value['pim_code'].']更新状态失败');
                }
                $log = array(
                    'pim_id'              => $value['pim_id'],
                    'pim_code'            => $value['pim_code'],
                    'pil_ip'              => Common_Common::getIP(),
                    'pim_ciq_status_from' => $this->status['send_before'],
                    'pim_ciq_status_to'   => $this->status['send_after'],
                    'pil_add_time'        => date('Y-m-d H:i:s',time()),
                    'pil_comments'        => '插入队列,待发送商检',
                    'status_type'         => '2',
                    'pim_status_from'     => $value['customs_status'],
                    'pim_status_to'       => $value['customs_status'],
                    'account_name'        => 'system',
                );
                if(Service_PersonItemLog::add($log) === false){
                    throw new Exception('物品清单['.$value['pim_code'].']日志写入失败');
                }
                $db->commit();
                Common_CiqQueue::debug('物品清单['.$value['pim_code'].']插入队列成功');
            }catch(Exception $e){
                $db->rollback();
                Common_CiqQueue::debug($e->getMessage());
                continue;
            }
        }
        return $minId;
    }

    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_PersonItem::getByCondition(
            array(
                'ciq_status' => $this->status['send_before'],
                'customs_status_array' => $this->status['customs_status_send_before_arr'],
                'is_comparison'=>'1'
            ), 'count(*)');
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
}
