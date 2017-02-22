<?php

/**
 *
 */
class AccountReceipt
{
    //'05' => '6',//暂停使用
    /**
     * 接收回执
     * @param  array  $bodyRow [description]
     * @param  array  $headRow [description]
     * @return [type]          [description]
     */
    public static function receiveReceipt(array $bodyRow, array $headRow)
    {
        $formId       = $bodyRow['form_id'];
        $warehouseRow = Service_Warehouse::getByField($formId, 'warehouse_code');
        if (empty($warehouseRow)) {
            return;
        }

        if ($warehouseRow['warehouse_status'] == 3) {
            if ($bodyRow['feedback_flag'] == '01') {
                self::update($warehouseRow, 3, 4, $bodyRow['feedback_mess']);
            } else {
                self::update($warehouseRow, 3, 6, $bodyRow['feedback_mess']);
            }
        }
        /**
         * 该账册还没走到这个流程时
         */
        else {
            return;
        }

    }

    /**
     * 审核回执
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function receiveExamine(array $bodyRow, array $headRow)
    {
        $formId       = $bodyRow['form_id'];
        $warehouseRow = Service_Warehouse::getByField($formId, 'warehouse_code');
        if (empty($warehouseRow)) {
            throw new Exception("账册号[{$formId}]不存在");
        }

        if ($warehouseRow['warehouse_status'] == 4) {
            $warehouseStatus = ($bodyRow['feedback_flag'] == '03') ? 5 : 6;
            self::update($warehouseRow, 4, $warehouseStatus, $bodyRow['feedback_mess']);
        }else if ($warehouseRow['warehouse_status'] == 5) {
            if ($bodyRow['feedback_flag'] == '05') {
                self::update($warehouseRow, 5, 1, $bodyRow['feedback_mess']);
            }else if($bodyRow['feedback_flag'] == '07'){
				self::update($warehouseRow, 5, 7, $bodyRow['feedback_mess']);
			}
        } else if ($warehouseRow['warehouse_status'] == 1) {
            if ($bodyRow['feedback_flag'] == '08') {
                self::update($warehouseRow, 1, 5, $bodyRow['feedback_mess']);
            }else if($bodyRow['feedback_flag'] == '07'){
				self::update($warehouseRow, 1, 7, $bodyRow['feedback_mess']);
			}
        }
        /**
         * 该账册还没走到这个流程时
         */
        else {
            throw new Exception("账册[{$warehouseRow['warehouse_code']}]还没走到[海关已接收]流程");
        }
    }

    /**
     * [update description]
     * @param  [type] $warehouseRow [description]
     * @param  [type] $statusFrom   [description]
     * @param  [type] $statusTo     [description]
     * @return [type]               [description]
     */
    private static function update($warehouseRow, $statusFrom, $statusTo, $feedbackMess)
    {
        $rowsAffected = Service_Warehouse::update(array(
            'warehouse_status' => $statusTo,
        ), $warehouseRow['warehouse_id']);

        if ($rowsAffected === false) {
            throw new Exception("账册[{$warehouseRow['warehouse_code']}]接收回执:执行账册更新错误");
        }
        $warehouseLogRow = array(
            'warehouse_id'   => $warehouseRow['warehouse_id'],
            'warehouse_code' => $warehouseRow['warehouse_code'],
            'type'           => '0',
            'status_from'    => $statusFrom,
            'status_to'      => $statusTo,
            'ip'             => Common_Common::getIP(),
            'comments'       => $feedbackMess,
            'user_id'        => 0,
        );
        if (Service_WarehouseLog::add($warehouseLogRow) === false) {
            throw new Exception("账册[{$warehouseRow['warehouse_code']}]日志创建失败");
        }
    }

}
