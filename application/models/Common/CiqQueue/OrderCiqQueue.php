<?php
/**
*
*/
class OrderCiqQueue
{
    private $status = array(
        'send_before' => 0,
        'send_after' => 1,
        'order_status_send_before' => array(1, 3, 4),
    );
    //
    private $queueInfo = array(
    	// 100 => RecordCompanies
        'api_code'  =>  'Order',
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
        $orderRows = Service_Orders::getByCiqStatus($this->status['order_status_send_before'], $this->status['send_before'] , $pageSize , $minId);
        if(empty($orderRows)){
            return false;
        }
        //插入api_message
        foreach ($orderRows as $key => $order) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $order['order_id'];
            $insertQueueRow['refer_code'] = $order['order_code'];
            $insertQueueRow['ref_cus_code'] = $order['ecommerce_platform_customer_code'];
            $insertQueueRow['add_date'] = date ( 'Y-m-d H:i:s' );
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                $orderByLockData = Service_Orders::getByFieldLock($order['order_id'], 'order_id');
                if($orderByLockData['ciq_status'] != $this->status['send_before'] || !in_array($orderByLockData['order_status'], $this->status['order_status_send_before'])){
                    throw new Exception('['.$orderByLockData['order_code'].']海关状态['.$orderByLockData['order_status'].']商检状态['.$orderByLockData['ciq_status'].']暂不发送');
                }
                if(Service_CiqApiMessage::add($insertQueueRow) === false) {
                    throw new Exception('订单['.$order['order_code'].']插入队列失败');
                }
                //更新状态
                $minId = Service_Orders::update(array('ciq_status'=>$this->status['send_after']), $order['order_id'], 'order_id');
                if(!$minId){
                    throw new Exception('订单['.$order['order_code'].']更新状态失败');
                }
                //写入日志
                $orderLogRow = array(
                    'order_id' => $order['order_id'],
                    'order_code' => $order['order_code'],
                    'ol_add_time' => date ( 'Y-m-d H:i:s' ),
                    'user_id' => '0',
                    'ol_ip' => Common_Common::getIP(),
                    'ol_comments' => '插入队列,待发送商检',
                    'status_type' => '2',
                    'account_name' => 'system',
                    'order_status_from' => $order['order_status'],
                    'order_status_to' => $order['order_status'],
                    'ciq_status_from' => $this->status['send_before'],
                    'ciq_status_to' => $this->status['send_after']
                );
                if(Service_OrderLog::add($orderLogRow) === false){
                    throw new Exception('订单['.$order['order_code'].']日志写入失败');
                }
                $db->commit();
                Common_CiqQueue::debug('订单['.$order['order_code'].']插入队列成功');
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
        $rowTotal = Service_Orders::getByCondition(array('order_status_array'=> $this->status['order_status_send_before'], 'ciq_status' => $this->status['send_before']), 'count(*)');
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
