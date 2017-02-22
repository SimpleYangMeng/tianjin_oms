<?php

/**
*
*/
class AccountBookQueue
{

    private $status = array(
        'send_before' => 2,
        'send_after' => 3
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '账册',
        'api_code'  =>  'AccountBook',
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
        $warehouseData = Service_Warehouse::getByStatus( $this->status['send_before'] , $pageSize , $minId);

        if(empty($warehouseData)){
            return false;
        }

        $insertQueueRows = array();

        foreach ($warehouseData as $key => $warehouse) {
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();

            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $warehouse['warehouse_id'];
            $insertQueueRow['refer_code'] = $warehouse['warehouse_code'];
            $insertQueueRow['ref_cus_code'] = $warehouse['warehouse_code'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );

            if(Service_ApiMessage::add($insertQueueRow) === false){
                Common_Queue::debug('['.$warehouse['warehouse_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }

            //修改状态
            $updatePersonItem = Service_warehouse::update(array(
                'warehouse_status' => $this->status['send_after'],
                'update_time' => date ( "Y-m-d H:i:s" )
            ), $warehouse['warehouse_id']);

            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
                Common_Queue::debug('['.$warehouse['warehouse_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }

            $warehouseLogRow = array(
                'warehouse_id' => $warehouse['warehouse_id'],
                'warehouse_code' => $warehouse['warehouse_code'],
                'type' => '0',
                'status_from' => 0,
                'status_to' => 0,
                'ip' => Common_Common::getIP(),
                'comments' => '插入队列',
                'user_id'=>0
            );
            if(Service_WarehouseLog::add($warehouseLogRow) === false){
                Common_Queue::debug('['.$warehouse['warehouse_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }
            // $insertQueueRows[] = $insertQueueRow;
            $minId = $warehouse['warehouse_id'];
            $db->commit();
        }

        // $insertData = Common_Queue::insertBatch($insertQueueRows);

        // $sql = "INSERT INTO `". Common_Queue::TABLE ."` " . $insertData;

        // //插入队列失败
        // if($db->query($sql) === false){
        //     $db->rollback ();
        //     return $minId;
        // }

        return $minId;

    }


    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_Warehouse::getByCondition(array(
            'warehouse_status' => $this->status['send_before']
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
