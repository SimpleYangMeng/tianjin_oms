<?php

/**
*
*/
class PersonItemQueue
{

    private $status = array(
        'send_before' => 1,
        'send_after' => 3
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '物品清单申报',
        'api_code'  =>  'PersonItem',
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
        $personItemRows = Service_PersonItem::getByStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($personItemRows)){
            return false;
        }
        $insertQueueRows = array();
        $time = date ( "Y-m-d H:i:s" );;

        foreach ($personItemRows as $key => $personItemRow) {
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            $personItemRow = Service_PersonItem::getByFieldLock($personItemRow['pim_id']);
            if($personItemRow['customs_status']!='1'){
                Common_Queue::debug('['.$personItemRow['pim_code'].']海关状态不为！');
            }
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $personItemRow['pim_id'];
            $insertQueueRow['refer_code'] = $personItemRow['pim_code'];
            $insertQueueRow['ref_cus_code'] = $personItemRow['pim_code'];
            $insertQueueRow['add_date'] = $time;

            if(Service_ApiMessage::add($insertQueueRow) === false){
                Common_Queue::debug('['.$personItemRow['pim_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }


            //修改状态
            $updatePersonItem = Service_PersonItem::update(array(
                'customs_status' => $this->status['send_after']
            ) , $personItemRow['pim_id']);
            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
               continue;
            }
            //插入商品日志
            $logRow = array(
                "pim_id" => $personItemRow['pim_id'],
                "pim_code" => $personItemRow['pim_code'],
                'pim_status_from'=>$this->status['send_before'],
                'pim_status_to'=>$this->status['send_after'],
                'pil_comments'=>'物品清单插入队列',
                'pil_add_time'=>date ( "Y-m-d H:i:s" ),
                "pil_ip" => Common_Common::getIP(),
            );
            if(Service_PersonItemLog::add($logRow) === false){
                Common_Queue::debug('['.$personItemRow['pim_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }

            $db->commit();
            //exit;

            $insertQueueRows[] = $insertQueueRow;
            $minId = $personItemRow['pim_id'];
        }

        /*$insertData = Common_Queue::insertBatch($insertQueueRows);

        $sql = "INSERT INTO `". Common_Queue::TABLE ."` " . $insertData;
        //插入队列失败
        if($db->query($sql) === false){
            $db->rollback ();
            return $minId;
        }*/

        return $minId;
    }


    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_PersonItem::getByCondition(array(
            'customs_status' => $this->status['send_before'],
            'is_comparison'=>'1'
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
