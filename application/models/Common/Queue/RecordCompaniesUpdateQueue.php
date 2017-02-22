<?php

/**
*
*/
class RecordCompaniesUpdateQueue
{
    private $queueInfo = array(
        'api_type'  =>  'send',
        'api_name'  =>  '企业备案修改',
        'api_code'  =>  'RecordCompaniesUpdate',
        'api_caller'=>  'pingtai',
        'am_status' =>  0
    );

    public function run($customerCode)
    {
        $customerRow = Service_Customer::getByField($customerCode, 'customer_code', 'customer_id');
        $time = date ( "Y-m-d H:i:s" );
        $insertQueueRow = $this->queueInfo;
        $insertQueueRow['ref_id'] = $customerRow['customer_id'];
        $insertQueueRow['refer_code'] = $customerCode;
        $insertQueueRow['ref_cus_code'] = $customerCode;
        $insertQueueRow['add_date'] = $time;
        if(Service_ApiMessage::add($insertQueueRow) === false){
            throw new Exception("插入队列失败！");
        }
    }
}
