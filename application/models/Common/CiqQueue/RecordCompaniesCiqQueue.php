<?php
/**
*
*/
class RecordCompaniesCiqQueue
{
    private $status = array(
        'send_before' => 0,
        'send_after' => 1
    );
    private $queueInfo = array(
    	// 100 => RecordCompanies
        'api_code'  =>  'RecordCompanies',
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
        $customerRows = Service_Customer::getByCiqStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($customerRows)){
            return false;
        }
        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;
        //插入api_message
        //api_message 提交
        foreach ($customerRows as $key => $value) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $value['customer_id'];
            $insertQueueRow['refer_code'] = $value['customs_code'];
            $insertQueueRow['ref_cus_code'] = $value['customer_code'];
            $insertQueueRow['add_date'] = $time;
            
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                Service_CiqApiMessage::add($insertQueueRow);
                $minId = Service_Customer::update(array('ciq_status'=>$this->status['send_after']), $value['customer_id'], 'customer_id');
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
        $rowTotal = Service_Customer::getByCondition(
        	array(
        		'ciq_status' => $this->status['send_before'],
				'customer_status' => 1
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
