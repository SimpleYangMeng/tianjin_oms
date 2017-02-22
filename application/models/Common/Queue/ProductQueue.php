<?php

/**
*
*/
class ProductQueue
{

    private $status = array(
        'send_before' => 2,
        'send_after' => 5
    );
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '商品',
        'api_code'  =>  'Product',
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
            $minId = $this->insertQueue($pageInfo['pageSize'] , $minId,$page);
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
    private function insertQueue($pageSize = Common_Queue::PAGESIZE ,$page=1)
    {
        $condition = array(
            'customs_status'=>$this->status['send_before'],
        );
        $data = Service_Product::getByCondition($condition,'*','',$pageSize,$page);

        if(empty($data)){
            return false;
        }

        $insertQueueRows = array();

        foreach ($data as $key => $row) {
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();

            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $row['product_id'];
            $insertQueueRow['refer_code'] = $row['registerID'];
            $insertQueueRow['ref_cus_code'] = $row['product_barcode'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );

            if(Service_ApiMessage::add($insertQueueRow) === false){
                Common_Queue::debug('['.$row['registerID'].']插入队列失败！');
                $db->rollback ();
                continue;
            }

            //修改状态
            $updateItem = Service_Product::update(array(
                'customs_status' => $this->status['send_after'],
                'product_update_time' => date ( "Y-m-d H:i:s" )
            ), $row['product_id']);

            //修改失败，这条先不插入队列
            if($updateItem === false){
                Common_Queue::debug('['.$row['registerID'].']插入队列失败！');
                $db->rollback ();
                continue;
            }
            //插入商品日志
            $logRow = array(
                "product_id" => $row['product_id'],
                "pl_type" => 1,
                "user_id" => 0,
                "customer_id" => $row['customer_id'],
                'pl_statu_pre'=>0,
                'pl_statu_now'=>0,
                'pl_note'=>'商品插入队列',
                'pl_add_time'=>date ( "Y-m-d H:i:s" ),
                "pl_ip" => Common_Common::getIP(),
            );
            if(Service_ProductLog::add($logRow) === false){
                Common_Queue::debug('['.$row['registerID'].']插入队列失败！');
                $db->rollback ();
                continue;
            }
            $minId = $row['product_id'];
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
        $rowTotal = Service_Product::getByCondition(array(
            'customs_status' => $this->status['send_before']
        ) , 'count(*)');

        if($rowTotal == 0){
            return array(
                'rowTotal' => 0
            );
        }

        $pageSize = Common_Queue::PAGESIZE;
        $pageSize = 1;

        $pageTotal = ceil($rowTotal / $pageSize);

        return array(
            'rowTotal' => $rowTotal,
            'pageSize'  => $pageSize,
            'pageTotal' => $pageTotal
        );
    }


}
