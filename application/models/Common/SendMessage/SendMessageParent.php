<?php

/**
 *
 */
abstract class SendMessageParent
{

    protected $pageSize = 100;
    protected $_error   = array();
    //发送接收方
    protected $sendAndReceiver = array(
        'senderID'   => 'BH',
        'receiverID' => 'CUSTOMS',
    );

    protected $functionCode = 2;

    abstract protected function createMessage($itemRow);
    // abstract protected function handleReceipt($itemRow, $receiveReceipt);

    /**
     * 开始
     * @param  [type] $action [description]
     * @return [type]         [description]
     */
    public function begin()
    {
        $pageInfo = $this->getTotalByApiCode();
        if ($pageInfo['rowTotal'] == 0) {
            return;
        }
        //获取要插入的数据
        $minId = 0;
        for ($page = 1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->choiceMessageRow($pageInfo['pageSize'], $minId);
            if ($minId === false) {
                break;
            }
        }
    }

    /**
     * 选择操作行
     * @param  [type] $pageSize [description]
     * @param  [type] $minId    [description]
     * @return [type]           [description]
     */
    protected function choiceMessageRow($pageSize, $minId)
    {
        $status = $this->status;
        if (!($minId >= 0)) {
            //防止sql报错
            return true;
        }
        $itemRows = Service_ApiMessage::getByStatus($status, $this->apiCode, $minId, $pageSize);
        if (empty($itemRows)) {
            return true;
        }
        foreach ($itemRows as $itemRow) {
            $minId = $itemRow['am_id'];
            $xml   = '';
            //还没生成报文
            if ($itemRow['file_path'] == '' || !file_exists($itemRow['file_path'])) {
                if (($xml = $this->createMessage($itemRow)) === false) {
                    $this->debug();
                    continue;
                }
                if ($this->saveMessage($xml, $itemRow) === false) {
                    $this->debug();
                    continue;
                }
            } else {
                $xml = file_get_contents($itemRow['file_path']);
            }
            // echo $xml;die();
            $receiveReceipt = $this->send($xml);
            Common_Queue::debug('[' . $this->apiCode . ']单号[' . $itemRow['refer_code'] . ']发送MQ成功！');
            // 处理回执
            // $this->handleReceipt($itemRow, $receiveReceipt);
            // print_r($receiveReceipt);
            // return false;
            if ($receiveReceipt['ask'] == 0) {
                Service_ApiMessage::update(array(
                    'am_receiving_message' => $receiveReceipt['message'],
                ), $itemRow['am_id']);
                // 成功
            } else {
                Service_ApiMessage::update(array(
                    'am_status'            => 1,
                    'am_receiving_message' => $receiveReceipt['message'],
                ), $itemRow['am_id']);
            }

        }
        return $minId;
    }

    /**
     * 保存报文文件并插入数据库
     * @param  [type] $xmlString [description]
     * @return [type]            [description]
     */
    protected function saveMessage($xmlString, $itemRow)
    {
        $path     = APPLICATION_PATH . '/../data/xml/' . $this->apiCode . '/';
        $filename = $path . $itemRow['refer_code'] . '-' . $itemRow['ref_cus_code'] . '.xml';
        if (Common_Common::createPath($path) === false) {
            $this->_error = "创建目录[{$path}]失败！";
            return false;
        }
        if (file_put_contents($filename, $xmlString) === false) {
            $this->_error = "保存报文[{$filename}]失败！";
            return false;
        }

        $hasUpdate = Service_ApiMessage::update(array(
            'file_path' => $filename,
        ), $itemRow['am_id']);

        if ($hasUpdate === false) {
            $this->_error = "保存报文失败！";
            return false;
        }
        return true;
    }
    /**
     * 获取总数
     * @param  [type] $ApiCode [description]
     * @param  string $type    发送报文：sendMessage  获取回执：getReceipt
     * @return [type]          [description]
     */
    protected function getTotalByApiCode()
    {
        $rowTotal = Service_ApiMessage::getByCondition(array(
            'api_code'  => $this->apiCode,
            'am_status' => "$this->status",
        ), 'count(*)');
        if ($rowTotal == 0) {
            return array(
                'rowTotal' => 0,
            );
        }

        $pageTotal = ceil($rowTotal / $this->pageSize);

        return array(
            'rowTotal'  => $rowTotal,
            'pageSize'  => $this->pageSize,
            'pageTotal' => $pageTotal,
        );
    }

    /**
     * [getSendTime description]
     * @return [type] [description]
     */
    protected function getSendTime()
    {
        $time2               = $time1               = 0;
        list($time2, $time1) = explode(' ', microtime());
        $sendTime            = date('Ymdhis', $time1) . intval($time2 * 1000);
        return $sendTime;
    }

    protected function getXmlHeader($messageId)
    {
        $xmlHeader                 = array();
        $xmlHeader['MessageID']    = $messageId;
        $xmlHeader['FunctionCode'] = $this->functionCode;
        $xmlHeader['MessageType']  = $this->messageType;
        $xmlHeader['SenderID']     = $this->sendAndReceiver['senderID']; #不知道 什么东西
        $xmlHeader['ReceiverID']   = $this->sendAndReceiver['receiverID']; #不知道 什么东西
        $xmlHeader['SendTime']     = $this->getSendTime();
        $xmlHeader['Version']      = '1.0';
        return $xmlHeader;
    }

    /**
     * [debug description]
     * @param  [type] $msg [description]
     * @return [type]      [description]
     */
    protected function debug()
    {
        if (is_array($this->_error)) {
            print implode("\t\n", $this->_error);
        } else {
            print $this->_error . "\t\n";
        }
        $this->_error = array();
    }

    /**
     * 报文发送类
     * @param  string $value [description]
     * @return [type]        [description]
     */
    protected function send($xml)
    {
        $object = new Common_MqManager();
        return $object->putMessage($xml);
        return $this->_curl($xml);
        return array('ask' => 0, 'message' => 'test error');
        return array('ask' => 1, 'message' => 'test success');
        // $object = new Common_MqManager();
        // return $object->putMessage($xml);
    }
    public function _curl($value)
    {

    }
}
