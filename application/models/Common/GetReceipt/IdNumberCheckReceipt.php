<?php

/**
*
*/
class IdNumberCheckReceipt
{

    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        $idNumberCheck = Service_IdNumberCheck::getByField($bodyRow['form_id'], 'inc_id');
        // 没有找到这个订单
        if(empty($idNumberCheck)){
            return ;
        }

        if($idNumberCheck['customs_status'] == 1){
            if($bodyRow['feedback_flag'] == '01'){
                Service_IdNumberCheck::update(array(
                    'customs_status' => 2
                ), $idNumberCheck['inc_id']);
            }
        }else{
            throw new Exception("该身份证不是[已发送海关]状态！", 1);
        }

    }
}
