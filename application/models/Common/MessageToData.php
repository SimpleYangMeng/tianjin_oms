<?php
/**
 * Created by PhpStorm.
 * User: WilliamFan
 * Date: 15-12-1
 * Time: 下午12:17
 */
class Common_MessageToData
{
    /**
     * @author william-fan
     * @todo  获取消息数据
     */
    public static function fetchMessage()
    {

        $object = new Common_MqManager();
        $data = $object->getMessage();
        var_dump($data);
        $dataPath = APPLICATION_PATH . '/../data/backmessage/';
        if (!file_exists($dataPath)) {
            mkdir($dataPath, 0777, true);
        }
        if ($data['ask'] == '1') {
            //获取成功了,解析报文
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try {
                $xml = $data['data'];
                $xmlObj = simplexml_load_string($xml);
                $xmlData = Common_Message::analyzeResult($xmlObj);
                print_r($xmlData);

                $head = $xmlData['Head'];
                $declaration = $xmlData['Declaration'];
                $filedirectory = $dataPath . $head['MESSAGETYPE'] . '/' . date('Ymd') . '/';
                if (!file_exists($filedirectory)) {
                    mkdir($filedirectory, 0777, true);
                }
                $filename = $head['MESSAGEID'] . '.xml';
                file_put_contents($filedirectory . $filename, $xml);

                $headRow = array(
                    'filedirectory' => $filedirectory,
                    'filename' => $filename,
                    'functioncode' => $head['FUNCTIONCODE'],
                    'senderid' => $head['SENDERID'],
                    'receiverid' => $head['RECEIVERID'],
                    'send_time' => $head['SENDTIME'],
                    'messagetype' => $head['MESSAGETYPE'],
                    'create_time' => date('Y-m-d H:i:s', time()),
                );
                $bmh_id = Service_BackMessageHead::add($headRow);
                if ($bmh_id) {

                    foreach ($declaration as $key => $row) {
                        if ($head['MESSAGETYPE'] == 'SDD001') {
                            if (isset($row['TAX_LIST'][0])) {
                                foreach ($row['TAX_LIST'] as $taxList) {
                                    $bodyRow = array(
                                        'form_id' => $taxList['FORM_ID'],
                                        'feedback_date' => date('Y-m-d H:i:s', strtotime(substr($row['TAX_BILL_PRINT_TIME'], 0, -2))),
                                        'bmh_id' => $bmh_id,
                                    );
                                    Service_BackMessageBody::add($bodyRow);
                                }
                            } else {
                                $bodyRow = array(
                                    'form_id' => $row['TAX_LIST']['FORM_ID'],
                                    'feedback_date' => date('Y-m-d H:i:s', strtotime(substr($row['TAX_BILL_PRINT_TIME'], 0, -2))),
                                    'bmh_id' => $bmh_id,
                                );
                                Service_BackMessageBody::add($bodyRow);
                            }

                        } else {
                            $bodyRow = array(
                                'form_id' => $row['FORM_ID'],
                                'feedback_date' => date('Y-m-d H:i:s', strtotime($row['FEEDBACK_DATE'] . str_pad($row['FEEDBACK_TIME'],6,'0',STR_PAD_LEFT))),
                                'feedback_flag' => $row['FEEDBACK_FLAG'],
                                'feedback_mess' => $row['FEEDBACK_MESS'],
                                'bmh_id' => $bmh_id,
                                'add_field' => $row['NULL_FIELD'],
                            );
                            Service_BackMessageBody::add($bodyRow);
                        }

                    }
                }
                $db->commit();
                $result['ask'] = '1';
            } catch (Exception $e) {
                $db->rollback();
                $result['message'] = $e->getMessage();
            }
        } else {
            $result['message'] = $data['message'];
        }
        return $result;
    }
}
