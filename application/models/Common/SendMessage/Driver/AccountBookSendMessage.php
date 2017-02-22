<?php

/**
 *
 */
class AccountBookSendMessage extends SendMessageParent
{
    protected $messageType = 'ZCC001';
    //操作对应的状态
    protected $status = 0;
    //接口代码
    protected $apiCode = 'AccountBook';
    //报文类型

    public function createMessage($itemRow)
    {
        $warehouseRow = Service_Warehouse::getByField($itemRow['ref_cus_code'], 'warehouse_code');
        if (empty($warehouseRow)) {
            $this->_error = "账册[{$itemRow['ref_cus_code']}]不存在！";
            return false;
        }
        $xmlArray         = array();
        $xmlArray['Head'] = $this->getXmlHeader($itemRow['am_id']);

        $declaration = array(
            'EMS' => array(
                'CUSTOM_CODE'   => $warehouseRow['customs_code'],
                'IE_TYPE'       => $warehouseRow['ie_type'],
                'CUS_10_CODE'   => $warehouseRow['customs_using_code'],
                'EMS_NO'        => $warehouseRow['warehouse_code'],
                'TRADE_CODE'    => $warehouseRow['trade_co'],
                'TRADE_NAME'    => $warehouseRow['trade_name'],
                'STORE_AREA'    => $warehouseRow['area'],
                'STORE_ADDRESS' => $warehouseRow['address'],
                'D_DATE'        => date('Ymdhis'),
                'CONTAC_CO'     => $warehouseRow['contacter'],
                'TEL_CO'        => $warehouseRow['phone_no'],
                'NOTE_S'        => $warehouseRow['note'],
            ),
        );
        $xmlArray['Declaration'] = $declaration;

        $message = Common_Message::cearteMessage($xmlArray);
        if ($message === false) {
            $this->_error = "账册[{$itemRow['ref_cus_code']}] " . Common_Message::getError();
            return false;
        }

        return $message;
    }

}
