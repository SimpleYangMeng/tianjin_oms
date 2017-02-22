<?php
/**
* 支付单添加到商检申报队列
*/
class PayOrderCiqQueue
{
    private $status = array(
        //发送前状态
        'send_before' => 1,
        //发送后状态
        'send_after' => 4,
        //海关状态
        'app_status_send_before_arr' => array(2, 4, 5),
    );
    private $queueInfo = array(
        'api_code'  =>  'PayOrder',
        'status' =>  0
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
        // print_r($pageInfo);exit;
        //获取要插入的数据
        $minId = 0;
        for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
            // echo $pageInfo['pageTotal'];exit;
            $minId = $this->insertQueue($pageInfo['pageTotal'] , $minId);
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
    private function insertQueue($pageSize = Common_CiqQueue::PAGESIZE , $minId = 0)
    {
        $payOrderData = Service_PayOrder::getByCiqStatus($this->status['app_status_send_before_arr'], $this->status['send_before'] , $pageSize , $minId);
        if(empty($payOrderData)){
            return false;
        }
        // print_r($payOrderData;exit;
        foreach ($payOrderData as $key=>$payOrder) {
            $insertQueueRow = $this->queueInfo;
            $insertQueueRow['ref_id'] = $payOrder['po_id'];
            $insertQueueRow['refer_code'] = $payOrder['po_code'];
            $insertQueueRow['ref_cus_code'] = $payOrder['customer_code'];
            $insertQueueRow['add_date'] = date ( "Y-m-d H:i:s" );
            $db = Common_Common::getAdapter();
            $db->beginTransaction ();
            try{
                $payOrderByLockData = Service_PayOrder::getByFieldLock($payOrder['po_id'], 'po_id');
                if($payOrderByLockData['ciq_status'] != $this->status['send_before'] || !in_array($payOrderByLockData['app_status'], $this->status['app_status_send_before_arr'])){
                    throw new Exception('支付单['.$payOrderByLockData['po_code'].']海关状态['.$payOrderByLockData['app_status'].']商检状态['.$payOrderByLockData['ciq_status'].']暂不发送');
                }
                if(Service_CiqApiMessage::add($insertQueueRow) === false) {
                    throw new Exception('支付单['.$payOrder['po_code'].']插入队列失败');
                }
                //修改状态
                $minId = Service_PayOrder::update(array( 'ciq_status' => $this->status['send_after'], 'update_time'=>date( "Y-m-d H:i:s")), $payOrder['po_id']);
                if(!$minId){
                    throw new Exception('['.$payOrder['po_code'].']更新状态失败');
                }
                //队列日志记录
                $payOrderLogRow = array(
                        'po_id' => $payOrder['po_id'],
                        'po_code' => $payOrder['po_code'],
                        'pl_status_from' => $payOrder['app_status'],
                        'pl_status_to' => $payOrder['app_status'],
                        'ciq_status_from' => $this->status['send_before'],
                        'ciq_status_to' => $this->status['send_after'],
                        'pl_ip' => Common_Common::getIP(),
                        'status_type' => '2',
                        'pl_comments' => '插入队列,待发送商检',
                        'user_id'=>0,
                        'account_name' => 'system'
                );
                if(Service_PayOrderLog::add($payOrderLogRow) === false){
                    throw new Exception('['.$payOrder['po_code'].']日志写入失败');
                }
                $db->commit();
                Common_CiqQueue::debug('['.$payOrder['po_code'].']插入队列成功');
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
        $rowTotal = Service_PayOrder::getByCondition(array('app_status_array'=> $this->status['app_status_send_before_arr'], 'ciq_status' => $this->status['send_before'], 'status'=>1) , 'count(*)');
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
