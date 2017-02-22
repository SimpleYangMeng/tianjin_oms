<?php
/**
* 妥投添加队列 - simple
*/
class BalanceQueue
{
    private $status = array(
        'send_before' => 0,
        'send_after' => 1
    );

    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '查询余额',
        'api_code'  =>  'Balance',
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
        $balanceData = Service_Balance::getByStatus( $this->status['send_before'] , $pageSize , $minId);
        if(empty($balanceData)){
            return false;
        }
        $db = Common_Common::getAdapter();
        $db->beginTransaction ();
        $insertQueueRows = array();
        foreach ($balanceData as $key => $balanceRow) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $balanceRow['b_id'];
            $insertQueueRow['refer_code'] = $balanceRow['customer_code'];
            $insertQueueRow['ref_cus_code'] = $balanceRow['customer_code'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );
            //修改状态
            $updatePersonItem = Service_Balance::update(array(
                'state' => $this->status['send_after'],
                'update_time' => date('Y-m-d H:i:s')
            ) , $balanceRow['b_id']);
            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
               continue;
            }
            $insertQueueRows[] = $insertQueueRow;
            $minId = $balanceRow['b_id'];
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
        $rowTotal = Service_Balance::getByCondition(array( 'state'=>$this->status['send_before']) , 'count(*)');
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
