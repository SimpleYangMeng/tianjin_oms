<?php

/**
*
*/
class Common_GetReceipt
{
    // TJ跨境电商报文回执 对照 操作表
    private $typeContrast = array(
        // 账册备案接收回执
        'ZCR002' => 'AccountReceipt::receiveReceipt',
        // 账册备案审核回执
        'ZCR004' => 'AccountReceipt::receiveExamine',
        // 电子订单接收回执
        'BIR002' => 'OrdedrReceipt::receiveReceipt',
        'BAR002' => 'RecordCompaniesReceipt::receiveReceipt',//企业接受回执
        'BAR004' => 'AuditRecordCompaniesReceipt::receiveReceipt',//企业审核回执
        //税费担保回执处理
        'BAR010' => 'TaxationGuaranteeReceipt::receiveReceipt',
        'BAR012' => 'TaxationGuaranteeReceipt::receiveExamine',
        //支付单回执处理
        'BIR006' => 'PayOrderReceipt::receiveReceipt',
        //运单回执处理
        'BIR004' => 'WaybillReceipt::receiveReceipt',
        //妥投回执处理
        'YTR002' => 'DeliveredReceipt::receiveReceipt',
        // 身份证回执
        'BIR008' => 'IdNumberCheckReceipt::receiveReceipt',
        'BAR006' => 'ProductReceipt::productReceive',//商品备案接收回执
        'BAR008' => 'ProductReceipt::productCheck',//商品审核回执
        'BUR006' => 'PersonItemReceipt::personItemReceive',//物品清单接收回执
        'BUR008' => 'PersonItemReceipt::personItemCheck',//物品清单审核回执
        'BUR020' => 'PersonItemReceipt::personItemVoid',//清单作废
        'BKK001' => 'PersonItemReceipt::personItemBukong',
        'BKK002' => 'PersonItemReceipt::personItemjiekong',
		//出入库单
		'BUR002' => 'ReceivingReceipt::receive',
		'BUR004' => 'ReceivingReceipt::receiveCheck',
		'BUR016' => 'ReceivingReceipt::receiveCheckAdd',
		//载货单
		'BUR010' => 'ShipBatchReceipt::receive',
		'BUR012' => 'ShipBatchReceipt::receiveCheck',
		'BUR028' => 'ShipBatchReceipt::receiveCheckPass',
		//载货单申请删除
		'BUR018' => 'ShipBatchDeleteReceipt::receive',
		'BUS012' => 'ShipBatchDeleteReceipt::receiveCheck',
        //税费
        'SDD001' => 'TaxReceipt::receiveReceipt',
        //货物清单
        'BUR022' =>'GoodsListReceipt::goodsListReceive',
        'BUR024' =>'GoodsListReceipt::GoodsListCheck',
		//错误回执
		'ERR001' =>'ErrorReceipt::receive',
		//账册调整
		'ZCR006' => 'InventoryModifyReceipt::receive',
		'ZCR008' => 'InventoryModifyReceipt::receiveCheck',
        //余额修改
        'LBR002' => 'BalanceReceipt::receiveReceipt',
    );
    /**
     * 每次处理pageSize个报文 。
     * @var integer
     */
    private $pageSize = 20;
    /**
     * messageType
     * @var string
     */
    private $messageType = '';
    /**
     * 代码
     * @var integer
     */
    private $headStatusBefore = 1;

    private $headStatusAfter = 4;

    private $bodyStatusBefore = 0;

    private $bodyStatusAfter = 1;

    public static function getInstance($type)
    {
        $object = new Common_GetReceipt();
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
     * 文件 加载
     * @return [type] [description]
     */
    private function loadMessageTypeFile()
    {
        $messageType = $this->messageType;

        $methods = explode('::', $this->typeContrast[$messageType]);
        $file = current($methods) . '.php';
        $filePath = APPLICATION_PATH . '/models/Common/GetReceipt/' . $file;
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
        $itemRows = Service_BackMessageHead::getByStatus($this->headStatusBefore , $this->messageType, $minId, $pageSize);
        if(empty($itemRows)){
            return true;
        }

        foreach ($itemRows as  $itemRow) {
            $minId = $itemRow['bmh_id'];
            $messageBodyRows = Service_BackMessageBody::getByCondition(array(
                'bmh_id' => $minId,
                'status' => $this->bodyStatusBefore
            ));
            $errorNumber = 0;

            // body 数据表里的数据为空时，也把Head状态改为导入正常完成
            if(!empty($messageBodyRows)){

                foreach ($messageBodyRows as $messageBodyKey => $messageBodyRow) {
                    $printMessage = "messagetype[{$itemRow['messagetype']}]下from_id[{$messageBodyRow['form_id']}]：{$messageBodyRow['feedback_mess']}";
                    $db = Common_Common::getAdapter();
                    $db->beginTransaction();
                    try {
                        $return = call_user_func_array($this->typeContrast[$this->messageType] , array($messageBodyRow, $itemRow));
                        //print_r($return);
                        if(!empty($return)){
                        	if($return['ask']=='0'){
                        		throw new Exception('处理回执异常:'.$return['message'].$return['error']);
                        	}
                        }
                        // 成功 更改状态
                        $result = Service_BackMessageBody::update(array(
                            'status' => $this->bodyStatusAfter
                        ), $messageBodyRow['bmb_id']);
                        if(!$result){
                            throw new Exception("更新back_message_body失败");
                        }
                        $this->debug($printMessage);
                        $db->commit ();
                        //$db->rollback ();
                    } catch (Exception $e) {
                        $this->debug($printMessage .' 失败原因：'. $e->getMessage());
                        $db->rollback ();
                        $errorNumber++;
                    }
                }
            }

            if($errorNumber == 0){
                Service_BackMessageHead::update(array(
                    'read_flag' => $this->headStatusAfter
                ), $itemRow['bmh_id']);
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
        $rowTotal = Service_BackMessageHead::getByCondition(array(
            'messagetype'=>$this->messageType,
            'read_flag' => $this->headStatusBefore
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

