<?php

/**
*
*/
class Common_CiqReceipt
{
    // 商检回执处理
    private $typeContrast = array(
    	//商品备案处理回执
        '210' => 'ProductReceipt::productReceive',
		//商品锁定
        '211' => 'ProductReceipt::productLockReceive',
    	//企业备案
    	'200' => 'RecordCompaniesReceipt::recordCompaniesReceive',
        '201' => 'RecordCompaniesReceipt::lockCompaniesReceive',
        //订单申报回执处理
        '350' => 'OrderReceipt::recordCompaniesReceive',
        //运单回执处理
        '351' => 'WayBillReceipt::recordCompaniesReceive',
        //支付单回执处理
        '352' => 'PayOrderReceipt::recordCompaniesReceive',
        //物品清单回执处理
        '230' => 'PersonItemReceipt::recordCompaniesReceive',
        //物品清单检疫
        '231' => 'PersonItemReceipt::QuarantineReceiv',
        //物品清单布控
        '236' => 'PersonItemReceipt::bkReceive',
		//入库单回执
		'220' => 'ReceivingReceipt::ReceivingReceive',
        //入库单布控
        '226' => 'ReceivingReceipt::ReceivingBk',
    	//入区单检疫
    	'221'=> 'ReceivingReceipt::ReceivingQuarantine',
		//二维码回执
		'228' => 'ReceivingReceipt::ReceivingQrReceive',
        //咨询投诉回执
        '552' => 'FeedBackReceipt::feedBackReceive',
    );
    /**
     * 每次处理pageSize个报文 。
     * @var integer
     */
    private $pageSize = 100;
    /**
     * messageType
     * @var string
     */
    private $messageType = '';
    /**
     * 代码
     * @var integer
     */
    //head 初始状态 -- 未处理
    private $headStatusBefore = -1;
	//head 结束状态 -- 已处理
    private $headStatusAfter = 1;
	//body 未处理
    private $bodyStatusBefore = -1;
	//body 已处理
    private $bodyStatusAfter = 1;
    public static function getInstance($type)
    {
        $object = new Common_CiqReceipt();
        $object->run($type);
    }

    /**
     * 开始
     * @param  [type] $messageType [description]
     * @return [type]              [description]
     */
    public function run($messageType)
    {
        if(!isset($this->typeContrast[$messageType])){
            return false;
        }
        $this->messageType = $messageType;
        // 加载文件

        if(!($this->loadMessageTypeFile())){
            $this->debug("{$messageType}找不到对应的操作！");
            return false;
        }
        $pageInfo = $this->getTotalByApiCode();
        if($pageInfo['rowTotal'] == 0){
            return false;
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
     * 文件 加载
     * @return [type] [description]
     */
    private function loadMessageTypeFile()
    {
        $messageType = $this->messageType;

        $methods = explode('::', $this->typeContrast[$messageType]);
        $file = current($methods) . '.php';
        $filePath = APPLICATION_PATH . '/models/Common/CiqReceipt/' . $file;
        if(!file_exists($filePath)){
            return false;
        }else{
            include_once $filePath;
            if(!method_exists($methods[0], $methods[1])){
                return false;
            }
        }
        return true;
    }

    /**
     * [choiceMessageRow description]
     * @param  [type] $pageSize [description]
     * @param  [type] $minId    [description]
     * @return [type]           [description]
     */
    private function choiceMessageRow($pageSize , $minId)
    {
        $itemRows = Service_CiqBackMessHead::getByStatus($this->headStatusBefore , $this->messageType, $minId, $pageSize);
        if(empty($itemRows)){
            return true;
        }
        foreach ($itemRows as  $itemRow) {
            $minId = $itemRow['cbmh_id'];
            $messageBodyRows = Service_CiqBackMessBody::getByCondition(array(
                'cbmh_id' => $minId,
                'status' => $this->bodyStatusBefore
            ));
            $errorNumber = 0;
            // body 数据表里的数据为空时，也把Head状态改为导入正常完成
            if(!empty($messageBodyRows)){
                foreach ($messageBodyRows as $messageBodyKey => $messageBodyRow) {
                    $printMessage = "message_type[{$itemRow['message_type']}]下cbmh_id[{$messageBodyRow['cbmh_id']}]:{$messageBodyRow['receipt_type']}";
                    $db = Common_Common::getAdapter();
                    $db->beginTransaction();
                    try {
                        $return = call_user_func_array($this->typeContrast[$this->messageType] , array($messageBodyRow, $itemRow));
                        //成功 更改状态
                        $result = Service_CiqBackMessBody::update(array(
                            'status' => $this->bodyStatusAfter,
                            'update_time'=>date('Y-m-d H:i:s',time()),
                        ), $messageBodyRow['cbmb_id']);
                        if(!$result){
                            throw new Exception("更新ciq_back_mess_body失败");
                        }
                        $this->debug($printMessage.'处理成功.');
						$db->commit ();
					//	$db->rollback ();
                    } catch (Exception $e) {
                        $this->debug($printMessage .'失败原因：'. $e->getMessage());
                        $db->rollback ();
                        $errorNumber++;
                    }
                }
            }

            if($errorNumber == 0){
				Service_CiqBackMessHead::update(array(
					'status' => $this->headStatusAfter
				), $itemRow['cbmh_id']);
            }

        }
        return $minId;
    }

    /**
     * [debug description]
     * @param  [type] $msg [description]
     * @return [type]      [description]
     */
    protected function debug($message)
    {
        $dateTime = '['.date('Y-m-d H:i:s').']';
        print $dateTime.$message . "\t\n";
    }

    /**
     * 获取总数
     * @param  [type] $ApiCode [description]
     * @param  string $type    发送报文：sendMessage  获取回执：getReceipt
     * @return [type]          [description]
     */
    protected function getTotalByApiCode()
    {
        $rowTotal = Service_CiqBackMessHead::getByCondition(array(
            'message_type'=>$this->messageType,
            'status' => $this->headStatusBefore
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
}

