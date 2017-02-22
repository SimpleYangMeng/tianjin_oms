<?php
/**
*
*/
class WayBillCiqQueue
{
    private $status = array(
        'send_before' => 0,
        'send_after' => 1,
        //海关状态
        'app_status_send_before_arr' => array(2, 4, 5, 6, 7),
    );
    private $queueInfo = array(
        'api_code'  =>  'WayBill',
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
    }

    /**
     * 循环插入
     * Enter description here ...
     * @param unknown_type $pageSize
     * @param unknown_type $minId
     */
    private function insertQueue($pageSize = Common_CiqQueue::PAGESIZE , $minId = 0)
    {
        $wayBillRows = Service_Waybill::getByCiqStatus($this->status['app_status_send_before_arr'], $this->status['send_before'] , $pageSize , $minId);
        
        //var_dump($wayBillRows);
        if(empty($wayBillRows)){
            return false;
        }
        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;
        //插入api_message
        //api_message 提交
        foreach ($wayBillRows as $key => $value) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $value['wb_id'];
            $insertQueueRow['refer_code'] = $value['wb_code'];
            $insertQueueRow['ref_cus_code'] = $value['reference_no'];
            $insertQueueRow['add_date'] = $time;
            
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                $waybillByLockData = Service_Waybill::getByFieldLock($value['wb_id'], 'wb_id');
                if($waybillByLockData['ciq_status'] != $this->status['send_before'] || !in_array($waybillByLockData['app_status'], $this->status['app_status_send_before_arr'])){
                    throw new Exception('运单['.$waybillByLockData['wb_code'].']-海关状态['.$waybillByLockData['app_status'].']-商检状态['.$waybillByLockData['ciq_status'].']暂不发送');
                }
                if(Service_CiqApiMessage::add($insertQueueRow) === false){
                    throw new Exception('运单['.$value['wb_code'].']插入队列失败');
                }
                $minId = Service_Waybill::update(array('ciq_status'=>$this->status['send_after'], 'update_time'=>date("Y-m-d H:i:s")), $value['wb_id'], 'wb_id');
                if(!$minId){
                    throw new Exception('运单['.$value['wb_code'].']更新状态失败');
                }
                $log = array(
                    'wb_id'              => $value['wb_id'],
                    'wb_code'            => $value['wb_code'],
                    'wb_ip'              => Common_Common::getIP(),
                    'status_type'        => '2',
                    'wb_status_from'     => $value['app_status'],
                    'wb_status_to'       => $value['app_status'],
                    'wb_ciq_status_from' => $this->status['send_before'],
                    'wb_ciq_status_to'   => $this->status['send_after'],
                    'wb_add_time'        => date('Y-m-d H:i:s',time()),
                    'wb_comments'        => '插入队列,待发送商检',
                    'account_name'       => 'system'
                );
                if(Service_WaybillLog::add($log) === false){
                    throw new Exception('运单['.$value['wb_code'].']日志写入失败');
                }
                $db->commit();
                Common_CiqQueue::debug('运单['.$value['wb_code'].']插入队列成功');
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
        $rowTotal = Service_Waybill::getByCondition(
            array(
                'ciq_status' => $this->status['send_before'],
                'wb_status' => 1,
                'app_status_array' => $this->status['app_status_send_before_arr'],
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
