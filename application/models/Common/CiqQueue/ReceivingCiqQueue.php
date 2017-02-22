<?php
/**
*
*/
class ReceivingCiqQueue
{
    private $status = array(
        'send_before' => -1,
        'send_after' => 0
    );
    //
    private $queueInfo = array(
    	// 100 => RecordCompanies
        'api_code'  =>  'Receiving',
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
        // print_r($pageInfo);exit;
        //获取要插入的数据
        $minId = 0;
        for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->insertQueue($pageInfo['pageSize'] , $minId);
            if($minId === false){
                break;
            }
        }
        echo "插入队列成功\r\n";
    }

	/**
	 * 循环插入
	 * Enter description here ...
	 * @param unknown_type $pageSize
	 * @param unknown_type $minId
	 */
    private function insertQueue($pageSize = Common_CiqQueue::PAGESIZE , $minId = 0)
    {
        $receivingRows = Service_Receiving::getByCiqStatus($this->status['send_before'] , $pageSize , $minId);
        if(empty($receivingRows)){
            return false;
        }
        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;
        //插入api_message
        //api_message 提交
        foreach ($receivingRows as $key => $value) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $value['receiving_id'];
            $insertQueueRow['refer_code'] = $value['receiving_code'];
            $insertQueueRow['ref_cus_code'] = $value['customer_code'];
            $insertQueueRow['add_date'] = $time;
            
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                Service_CiqApiMessage::add($insertQueueRow);
                $minId = Service_Receiving::update(array('ciq_status'=>$this->status['send_after']), $value['receiving_id']);
            }catch(Exception $e){
                 $db->rollback();
            }
            $db->commit();
        }
        return $minId;
    }

    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_Receiving::getByCondition(array('ciq_status' => $this->status['send_before']), 'count(*)');
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
