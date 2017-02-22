<?php

/**
*
*/
class OrderQueue
{

    private $status = array(
        'send_before' => 1,
        'send_after' => 3
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '订单',
        'api_code'  =>  'Order',
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
        $ordersData = Service_Orders::getByStatus( $this->status['send_before'] , $pageSize , $minId);

        if(empty($ordersData)){
            return false;
        }

        $insertQueueRows = array();

        foreach ($ordersData as $key => $order) {
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();

            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $order['order_id'];
            $insertQueueRow['refer_code'] = $order['reference_no'];
            $insertQueueRow['ref_cus_code'] = $order['order_code'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );

            if(Service_ApiMessage::add($insertQueueRow) === false){
                Common_Queue::debug('['.$order['order_code'].']插入队列失败');
                $db->rollback ();
                continue;
            }

            //修改状态
            $updatePersonItem = Service_Orders::update(array(
                'order_status' => $this->status['send_after'],
                'app_time' => date("Y-m-d H:i:s"),
                'update_time' => date("Y-m-d H:i:s")
            ), $order['order_id']);

            //修改失败，这条先不插入队列
            if($updatePersonItem === false){
                Common_Queue::debug('['.$order['order_code'].']插入队列失败');
                $db->rollback ();
                continue;
            }

            $orderLogRow = array(
                "order_id" => $order['order_id'],
                "order_code" => $order['order_code'],
                "ol_add_time" => date ( "Y-m-d H:i:s" ),
                "user_id" => '-1',
                "ol_ip" => Common_Common::getIP(),
                "ol_comments" => $order['order_code'].'插入海关队列,待发送海关',
                "account_name" => '',
                'order_status_from' => 0,
                'order_status_to' => 1
            );
            if(Service_OrderLog::add($orderLogRow) === false){
                Common_Queue::debug('['.$order['order_code'].']写入日志失败');
                $db->rollback ();
                continue;
            }
            $minId = $order['order_id'];
            $db->commit();
            Common_Queue::debug('['.$order['order_code'].']插入队列成功');
        }



        return $minId;

    }


    /**
     * 获取分页信息
     * @return [type] [description]
     */
    private function pageInfo()
    {
        $rowTotal = Service_Orders::getByCondition(array(
            'order_status' => $this->status['send_before']
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
