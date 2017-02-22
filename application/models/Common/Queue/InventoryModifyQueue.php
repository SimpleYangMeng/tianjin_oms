<?php

/**
*
*/
class InventoryModifyQueue
{

    private $status = array(
        'send_before' => 1,
        'send_after' => 2
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '账册调整申报',
        'api_code'  =>  'InventoryModify',
        'api_caller'=>  'pingtai',
        'am_status' =>  0
    );


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


    private function insertQueue($pageSize = Common_Queue::PAGESIZE , $minId = 0)
    {
        $inventoryModifyRows = Service_InventoryModify::getByStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($inventoryModifyRows)){
            return false;
        }
        $db = Common_Common::getAdapter();
        $db->beginTransaction ();

        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;

        foreach ($inventoryModifyRows as $key => $val) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $val['im_id'];
            $insertQueueRow['refer_code'] = $val['im_code'];
            $insertQueueRow['ref_cus_code'] = $val['customer_code'];
            $insertQueueRow['add_date'] = $time;

            //修改状态
            $updateFlag = Service_InventoryModify::update(array(
                'status' => $this->status['send_after']
            ) , $val['im_id']);
            //修改失败，这条先不插入队列
            if($updateFlag === false){
               continue;
            }
            $insertQueueRows[] = $insertQueueRow;
            $minId = $val['im_id'];
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
        $rowTotal = Service_InventoryModify::getByCondition(array(
            'status' => $this->status['send_before'],
        ) , 'count(*)');

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
