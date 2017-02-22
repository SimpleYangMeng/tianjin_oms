<?php
/**
* 妥投添加队列 - simple
*/
class DeliveredQueue
{
    private $status = array(
        'send_before' => 6,
        'send_after' => 7
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '妥投申报',
        'api_code'  =>  'Delivered',
        'api_caller'=>  'pingtai',
        'am_status' =>  0
    );

    /**
     * [run description]
     * @return [type] [description]
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
        
        return true;
    }

    /**
     * [insertQueue 封装插入数据]
     * @param  [type]  $pageSize [description]
     * @param  integer $minId    [description]
     * @return [type]            [description]
     */
    private function insertQueue($pageSize = Common_Queue::PAGESIZE , $minId = 0)
    {
        $waybillData = Service_Waybill::getByStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($waybillData)){
            return false;
        }
        
        $db = Common_Common::getAdapter();
        $db->beginTransaction ();

        $insertQueueRows = array();

        foreach ($waybillData as $key => $waybill) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $waybill['wb_id'];
            $insertQueueRow['refer_code'] = $waybill['wb_code'];
            $insertQueueRow['ref_cus_code'] = $waybill['reference_no'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );

            //修改状态
            $updatePersonItem = Service_Waybill::update(array(
                'app_status' => $this->status['send_after'],
                'app_time' => date('Y-m-d H:i:s')
            ) , $waybill['wb_id']);
            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
               continue;
            }
            //队列日志记录
            $waybillLogRow = array(
                    'wb_id' => $waybill['wb_id'],
                    'wb_code' => $waybill['wb_code'],
                    'wb_status_from' => $this->status['send_before'],
                    'wb_status_to' => $this->status['send_after'],
                    'wb_ip' => Common_Common::getIP(),
                    'wb_comments' => '发送至海关端',
                    'user_id'=>0
            );
            
            if(Service_WaybillLog::add($waybillLogRow) === false){
                Common_Queue::debug('['.$waybill['wb_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }
            $insertQueueRows[] = $insertQueueRow;
            $minId = $waybill['wb_id'];
        }
        $insertData = Common_Queue::insertBatch($insertQueueRows);
        $sql = "INSERT INTO `". Common_Queue::TABLE ."` " . $insertData;
        //插入队列失败
        if($db->query($sql) === false){
            $db->rollback ();
            return $minId;
        }
        $db->commit();
        return $minId;
    }


    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_Waybill::getByCondition(array( 'app_status' => $this->status['send_before'], 'wb_status'=> 1) , 'count(*)');
        if($rowTotal == 0){
            return array(
                'rowTotal' => 0
            );
        }
        $pageSize = Common_Queue::PAGESIZE;
        $pageTotal = ceil($rowTotal / $pageSize);
        return array(
            'rowTotal' => $rowTotal,
            'pageSize'  => $pageSize,
            'pageTotal' => $pageTotal
        );
    }
}
