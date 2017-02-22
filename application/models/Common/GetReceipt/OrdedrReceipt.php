<?php

/**
*
*/
class OrdedrReceipt
{

    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        $orderRows = Service_Orders::getByCondition(array(
            'reference_no' => $bodyRow['form_id'],
            'customer_code' => $bodyRow['add_field']
        ));
        // 没有找到这个订单
        if(empty($orderRows)){
            return ;
        }

        $orderRow = $orderRows[0];
        if($orderRow['order_status'] == 3){
            if($bodyRow['feedback_flag'] == '01'){
                self::update($orderRow, 3, 4, $bodyRow['feedback_mess']);
            }
        }else{
            throw new Exception("该订单[{$orderRow['order_code']}]不是[已发送海关]状态", 1);
        }

    }

    /**
     * [update description]
     * @param  [type] $warehouseRow [description]
     * @param  [type] $statusFrom   [description]
     * @param  [type] $statusTo     [description]
     * @return [type]               [description]
     */
    private static function update($orderRow, $statusFrom, $statusTo, $feedbackMess)
    {
        $time = date("Y-m-d H:i:s");
        $isUpdate = Service_Orders::update(array(
            'order_status' => $statusTo,
            'update_time' => $time
        ),$orderRow['order_id']);

        if($isUpdate === false){
            throw new Exception("更新订单[{$orderRow['order_code']}]状态失败");
        }

        $orderLogRow = array(
            "order_id" => $orderRow['order_id'],
            "order_code" => $orderRow['order_code'],
            "ol_add_time" => $time,
            "user_id" => '0',
            "ol_ip" => Common_Common::getIP(),
            "ol_comments" => $feedbackMess,
            'order_status_from' => $statusFrom,
            'order_status_to' => $statusTo
        );
        if(Service_OrderLog::add($orderLogRow) == false){
            throw new Exception("订单[{$orderRow['order_code']}]日志创建失败");
        }
    }
}
