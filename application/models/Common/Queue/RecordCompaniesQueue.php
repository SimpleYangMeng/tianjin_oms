<?php

/**
 *
 */
class RecordCompaniesQueue
{

    private $status = array(
        'send_before'      => 0,
        'send_after'       => 1,
        'record_companies' => 1,
    );
    private $queueInfo = array(
        'api_type'   => 'send',
        'api_name'   => '企业备案申报',
        'api_code'   => 'RecordCompanies',
        'api_caller' => 'pingtai',
        'am_status'  => 0,
    );

    public function run()
    {
        $pageInfo = $this->pageInfo();
        if ($pageInfo['rowTotal'] == 0) {
            return true;
        }
        //获取要插入的数据
        $minId = 0;
        for ($page = 1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->insertQueue($pageInfo['pageSize'], $minId);
            if ($minId === false) {
                break;
            }
        }
    }

    private function insertQueue($pageSize = Common_Queue::PAGESIZE, $minId = 0)
    {
        $personItemRows = Service_Customer::getByStatus($this->status['send_before'], $pageSize, $minId);
        if (empty($personItemRows)) {
            return false;
        }

        $insertQueueRows = array();
        $time            = date("Y-m-d H:i:s");

        //插入api_message
        //api_message 提交
        foreach ($personItemRows as $key => $value) {
            $insertQueueRow                 = $this->queueInfo;
            $insertQueueRow['ref_id']       = $value['customer_id'];
            $insertQueueRow['refer_code']   = $value['customer_code'];
            $insertQueueRow['ref_cus_code'] = $value['customer_code'];
            $insertQueueRow['add_date']     = $time;
            // print_r($insertQueueRow);exit;
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try {
                if(Service_ApiMessage::add($insertQueueRow) === false){
                    throw new Exception('企业备案'.$value['customer_code'].'插入海关api_message队列失败');
                }
                $row = array(
                    'customer_a_m_a' => 1,
                    'customs_status' => $this->status['send_after'], //已发送
                );
                $minId = Service_Customer::update($row, $value['customer_id'], 'customer_id');
                if(!$minId){
                    throw new Exception('企业备案'.$value['customer_code'].'更新状态为['.$value['send_after'].']失败');
                }
                $db->commit();
            } catch (Exception $e) {
                Common_Queue::debug('['.$e->getMessage().']');
                $db->rollback();
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
        $rowTotal = Service_Customer::getByCondition(array(
            'customs_status'  => $this->status['send_before'],
            'customer_a_m_a'  => '0',
            'customer_status' => '1',
        ), 'count(*)');
        if ($rowTotal == 0) {
            return array(
                'rowTotal' => 0,
            );
        }

        $pageSize = Common_Queue::PAGESIZE;

        $pageTotal = ceil($rowTotal / $pageSize);

        return array(
            'rowTotal'  => $rowTotal,
            'pageSize'  => $pageSize,
            'pageTotal' => $pageTotal,
        );
    }
}
