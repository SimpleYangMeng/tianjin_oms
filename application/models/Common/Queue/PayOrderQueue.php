<?php
/**
* 支付单添加到申报队列
*/
class PayOrderQueue
{

    private $status = array(
        'send_before' => 2,
        'send_after' => 4
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '支付单申报',
        'api_code'  =>  'PayOrder',
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
        $payOrderData = Service_PayOrder::getByStatus( $this->status['send_before'] , $pageSize , $minId);
        
        if(empty($payOrderData)){
            return false;
        }

        $db = Common_Common::getAdapter();
        $db->beginTransaction ();

        $insertQueueRows = array();

        foreach ($payOrderData as $key => $payOrder) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $payOrder['po_id'];
            $insertQueueRow['refer_code'] = $payOrder['po_code'];
            $insertQueueRow['ref_cus_code'] = $payOrder['customer_code'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );

            //修改状态
            $updatePersonItem = Service_PayOrder::update(array(
                'app_status' => $this->status['send_after'],
                'app_time' => date ( "Y-m-d H:i:s" )
            ), $payOrder['po_id']);
            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
               continue;
            }
            //队列日志记录
            $payOrderLogRow = array(
                    'po_id' => $payOrder['po_id'],
                    'po_code' => $payOrder['po_code'],
                    'pl_status_from' => $this->status['send_before'],
                    'pl_status_to' => $this->status['send_after'],
                    'pl_ip' => Common_Common::getIP(),
                    'pl_comments' => '插入队列, 待发送海关',
                    'user_id'=>0
            );
            if(Service_PayOrderLog::add($payOrderLogRow) === false){
                Common_Queue::debug('['.$payOrder['po_code'].']插入队列失败！');
                $db->rollback ();
                continue;
            }
            $insertQueueRows[] = $insertQueueRow;
            $minId = $payOrder['po_id'];
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
        $rowTotal = Service_PayOrder::getByCondition(array( 'app_status' => $this->status['send_before'], 'status'=>1) , 'count(*)');
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
