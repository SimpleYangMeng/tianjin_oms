<?php

/**
*
*/

abstract class SendMessageParent
{
    protected $pageSize = 100;
    protected $_error = array();
    //发送接收方
    protected $sendAndReceiver = array(
        'sendMessage' => array(
            'senderID' => 'BH',
            'receiverID' => 'CUSTOMS'
        ),
        'getReceipt' => array(
            'senderID' => 'CUSTOMS',
            'receiverID' => 'BH'
        )
    );

    abstract protected function createMessage($itemRow);
    abstract protected function handleReceipt($receiveReceipt);

    public function __construct()
    {
        $class =  get_class($this);
        if(!isset($this->status)){
            throw new Exception('操作对应状态变量不存在！'.$class.'::status');
        }

        if(!isset($this->_status)){
            throw new Exception('操作对应状态变量不存在！'.$class.'::_status');
        }

        if(!isset($this->apiCode)){
            throw new Exception('操作对应状态变量不存在！'.$class.'::apiCode');
        }
    }
    /**
     * 开始
     * @param  [type] $action [description]
     * @return [type]         [description]
     */
    public function begin($action)
    {
        if(isset($this->status[$action])){
            $this->_status = $action;
        }else{
            throw new Exception("参数错误");
        }

        $pageInfo = $this->getTotalByApiCode();

        if($pageInfo['rowTotal'] == 0){
            return ;
        }
        //获取要插入的数据
        $minId = 0;
        for ($page=1; $page <= $pageInfo['pageTotal']; $page++) {
            $minId = $this->choiceMessageRow($pageInfo['pageSize'] , $minId);
            if($minId === false){
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
    protected function choiceMessageRow($pageSize , $minId)
    {
        if(!isset($this->status[$this->_status])){
            throw new Exception('参数错误！');
        }
        $status = $this->_status;
        $itemRows = Service_ApiMessage::getByStatus($this->status[$status] , $this->apiCode, $minId, $pageSize);
        if(empty($itemRows)){
            return true;
        }
        foreach ($itemRows as  $itemRow) {
            $minId = $itemRow['am_id'];
            // 发送报文
            if($status == 'sendMessage'){
                $xml = '';
                //还没生成报文
                if($itemRow['file_path'] == '' || !file_exists($itemRow['file_path'])){
                    if(($xml = $this->createMessage($itemRow)) === false){
                        $this->debug();
                        continue;
                    }
                    if($this->saveMessage($xml , $itemRow) === false){
                        $this->debug();
                        continue;
                    }
                }else{
                    $xml = file_get_contents($itemRow['file_path']);
                }
                $receiveReceipt = $this->send($xml);
                if($receiveReceipt['ask'] == 0){
                    echo $receiveReceipt['error'];
                }else{
                    echo '成功';
                }
                die();


            //获取回执还不知道什么情况
            }elseif($status == 'getReceipt'){

            }
            // 解析回执xml
            $xmlObject = simplexml_load_string($receiveReceipt);
            $xmlArray = Common_Message::analyzeResult($xmlObject);
            // 处理回执
            $this->handleReceipt($xmlArray);

        }
    }

    /**
     * 保存报文文件并插入数据库
     * @param  [type] $xmlString [description]
     * @return [type]            [description]
     */
    protected function saveMessage($xmlString , $itemRow)
    {
        $path = APPLICATION_PATH . '/../data/xml/' . $this->apiCode . '/';
        $filename = $path . $itemRow['refer_code'] . '-' . $itemRow['ref_cus_code'] . '.xml';
        if(Common_Common::createPath($path) === false){
            $this->_error = "创建目录[{$path}]失败！";
            return false;
        }
        if(file_put_contents($filename , $xmlString) === false){
            $this->_error = "保存报文[{$filename}]失败！";
            return false;
        }

        $hasUpdate = Service_ApiMessage::update(array(
               'file_path' => $filename,
        ), $itemRow['am_id']);

        if($hasUpdate === false){
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
            'api_code'=>$this->apiCode,
            'am_status' => $this->status[$this->_status]
        ) , 'count(*)');

        if($rowTotal == 0){
            return array(
                'rowTotal' => 0
            );
        }

        $pageTotal = ceil($rowTotal / $this->pageSize);

        return array(
            'rowTotal' => $rowTotal,
            'pageSize'  => $this->pageSize,
            'pageTotal' => $pageTotal
        );
    }

    /**
     * [getSendTime description]
     * @return [type] [description]
     */
    protected function getSendTime()
    {
        $time2 = $time1 = 0;
        list($time2 , $time1) = explode(' ' , microtime());
        $sendTime = date('Ymdhis', $time1).intval($time2 * 1000);
        return $sendTime;
    }

    protected function getXmlHeader($messageId)
    {
        $xmlHeader = array();
        $xmlHeader['MessageID'] = $messageId;
        $xmlHeader['FunctionCode'] = ($this->_status == 'sendMessage') ? 2 : 1;
        $xmlHeader['MessageType'] = $this->messageType;
        $xmlHeader['SenderID'] = $this->sendAndReceiver[$this->_status]['senderID']; #不知道 什么东西
        $xmlHeader['ReceiverID'] = $this->sendAndReceiver[$this->_status]['receiverID']; #不知道 什么东西
        $xmlHeader['SendTime'] = $this->getSendTime();
        $xmlHeader['Version'] = '1.0';
        return $xmlHeader;
    }

    /**
     * [debug description]
     * @param  [type] $msg [description]
     * @return [type]      [description]
     */
    protected function debug()
    {
        if(is_array($this->_error)){
            echo implode("\n\t" , $this->_error);
        }else{
            echo $this->_error."\n\t";
        }
    }
    /**
     * 报文发送类
     * @param  string $value [description]
     * @return [type]        [description]
     */
    protected function send($xml)
    {
        $object = new Common_MqManager();
        return $object->putMessage('R_TRANS_TO_EN', $xml);
    }
}
