<?php
/**
*
*/
class CheckResultCiqQueue
{
    private $status = array(
        'send_before' => 1,
        'send_after' => 2,
    );
    //
    private $queueInfo = array(
    	// 100 => RecordCompanies
        'api_code' => 'CheckResult',
        'status' => 0
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
        $ccrRows = Service_CiqCheckResult::getByCiqStatus($this->status['send_before'] ,$minId ,$pageSize);
        if(empty($ccrRows)){
            return false;
        }
        //插入api_message
        foreach ($ccrRows as $key => $ccrInfo) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $ccrInfo['ccr_id'];
            $insertQueueRow['refer_code'] = $ccrInfo['entryid'];
            $insertQueueRow['ref_cus_code'] = $ccrInfo['logisticsNo'];
            $insertQueueRow['add_date'] = date ( 'Y-m-d H:i:s' );
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                $ccrInfoByLockData = Service_CiqCheckResult::getByFieldLock($ccrInfo['ccr_id'], 'ccr_id');
                if($ccrInfoByLockData['ciq_status'] != $this->status['send_before']){
                    throw new Exception('查验结果ID['.$ccrInfoByLockData['ccr_id'].']状态['.$ccrInfoByLockData['ciq_status'].']暂不发送');
                }
                if(Service_CiqApiMessage::add($insertQueueRow) === false) {
                    throw new Exception('查验结果ID['.$ccrInfo['ccr_id'].']插入队列失败');
                }
                //更新状态
                $minId = Service_CiqCheckResult::update(array('ciq_status'=>$this->status['send_after']), $ccrInfo['ccr_id'], 'ccr_id');
                if(!$minId){
                    throw new Exception('查验结果ID['.$ccrInfo['ccr_id'].']更新状态失败');
                }
                $db->commit();
                Common_CiqQueue::debug('查验结果ID['.$ccrInfo['ccr_id'].']插入队列成功');
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
        //海关状态为已关联
        $rowTotal = Service_CiqCheckResult::getByCondition(array('ciq_status' => $this->status['send_before']), 'count(*)');
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
