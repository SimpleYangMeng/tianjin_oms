<?php
/**
*
*/
class FeedBackCiqQueue
{
    private $status = array(
        'send_before' => 0,
        'send_after' => 1,
    );
    //
    private $queueInfo = array(
    	// 100 => RecordCompanies
        'api_code' => 'FeedBack',
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
        $feedBackRows = Service_Feedback::getByCiqStatus($this->status['send_before'] , $pageSize , $minId);
        if(empty($feedBackRows)){
            return false;
        }
        //插入api_message
        foreach ($feedBackRows as $key => $feedBackInfo) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $feedBackInfo['feedback_id'];
            $insertQueueRow['refer_code'] = $feedBackInfo['feedback_id'];
            $insertQueueRow['ref_cus_code'] = 'everyone';
            $insertQueueRow['add_date'] = date ( 'Y-m-d H:i:s' );
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                $feedBackInfoByLockData = Service_Feedback::getByFieldLock($feedBackInfo['feedback_id'], 'feedback_id');
                if($feedBackInfoByLockData['ciq_status'] != $this->status['send_before']){
                    throw new Exception('['.$feedBackInfoByLockData['feedback_id'].']商检状态['.$feedBackInfoByLockData['ciq_status'].']暂不发送');
                }
                if(Service_CiqApiMessage::add($insertQueueRow) === false) {
                    throw new Exception('咨询投诉['.$feedBackInfo['feedback_id'].']插入队列失败');
                }
                //更新状态
                $minId = Service_Feedback::update(array('ciq_status'=>$this->status['send_after']), $feedBackInfo['feedback_id'], 'feedback_id');
                if(!$minId){
                    throw new Exception('咨询投诉['.$feedBackInfo['feedback_id'].']更新状态失败');
                }
                $db->commit();
                Common_CiqQueue::debug('咨询投诉['.$feedBackInfo['feedback_id'].']插入队列成功');
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
        $rowTotal = Service_Feedback::getByCondition(array('ciq_status' => $this->status['send_before']), 'count(*)');
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
