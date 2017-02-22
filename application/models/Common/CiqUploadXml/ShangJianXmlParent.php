<?php
/**
 * 
 * Enter description here ...
 * @author 
 *
 */
abstract class ShangJianXmlParent
{
	protected $pageSize = 100;
	//收发方
    protected $_sendAndReceiver = array(
    		'sendCode' => 'BH',
        	'receiverCode' => 'SHANGJIAN',
    );
    //FTP 配置
    protected $_ftpConfig = array(
            'hostname' => '10.128.132.202',
            'username' => 'ftpuser',
            'password' => 'ftpuser',
            'port' => 21
	);
	//FTP路径
	protected $_ftpDir = 'BdsSort/RequestDecl/Source/';
//	protected $_ftpDir = 'BdsSort/RequestDecl';
    //报文内容
    protected $_xml;
    //报文路径
    protected $_xmlPath;
    //属地检验检疫机构代码
    protected $_insUnitCode;
    //错误信息
    protected $_error = array();
    //子类重写方法
    abstract protected function createBodyXml($itemRow);
    
	/**
     * 开始
     * @param  [type] $action [description]
     * @return [type]         [description]
     */
    public function begin()
    {
        $pageInfo = $this->getTotalByApiCode();
        if($pageInfo['rowTotal'] == 0){
        	echo '['.date('Y-m-d H:i:s')."]No data processing\r\n";
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
    protected function choiceMessageRow($pageSize, $minId)
    {
        $status = $this->status;
        $itemRows = Service_CiqApiMessage::getByStatus($status , $this->apiCode, $minId, $pageSize);
        if(empty($itemRows) || !is_array($itemRows)){
            echo '['.date('Y-m-d H:i:s')."]No data processing\r\n";
            return true;
        }
        foreach ($itemRows as $itemRow) {
            $minId = $itemRow['cam_id'];
            //还没生成报文
            if($itemRow['file_path'] == '' || !file_exists($itemRow['file_path'])){
                if(($this->createXml($itemRow)) === false){
                    $this->debug();
                    continue;
                }
                if($this->saveXml($itemRow) === false){
                    $this->debug();
                    continue;
                }
            }else {
                $this->_xmlPath = $itemRow['file_path'];
            }
             //echo $xml;die();
			$receiveReceipt = $this->sendXml();
			//成功
            if($receiveReceipt['ask'] == 1){
                Service_CiqApiMessage::update(array('status'=>1, 'message' => $receiveReceipt['message']), $itemRow['cam_id']);
                echo '['.$this->apiCode.']单号['.$itemRow['refer_code'].']上传成功';
			//失败
            }else{
                Service_CiqApiMessage::update(array('message' => $receiveReceipt['message']), $itemRow['cam_id']);
                echo '['.$this->apiCode.']单号['.$itemRow['refer_code'].']上传失败';
            }
        }
        return $minId;
    }
    
	/**
     * 构建 XML
     * Enter description here ...
     */
    public function createXml($itemRow){
    	//创建报文体
    	$xmlBodyData = $this->createBodyXml($itemRow);

        if(empty($this->_insUnitCode)){
            $this->_error[] = '处理ciq_api_message消息ID['.$itemRow['cam_id'].']消息代码['.$itemRow['api_code'].']'.'属地检验检疫机构为空';
            return false;
        }
        //报文头
        $header = $this->getXmlHeader($itemRow['cam_id'], $itemRow['api_code']);

    	//创建报文体异常
    	if(!$xmlBodyData){
            $this->_error[] = '处理ciq_api_message消息ID['.$itemRow['cam_id'].']消息代码['.$itemRow['api_code'].']'.'生成报文体异常';
    		return false;
    	}
    	//报文数组
    	$messageArray = array(
    		'MessageHead' => $header,
    		'MessageBody' => $xmlBodyData
    	);
    	$messageObject = new Common_Message();
		//生成报文
    	$this->_xml = $messageObject->cearteResult($messageArray, 'RequestMessage');
        if(empty($this->_xml)){
            $this->_error[] = '处理ciq_api_message消息ID['.$itemRow['cam_id'].']消息代码['.$itemRow['api_code'].']'.'生成报文异常';
            return false;
        }
    	/*
    	$this->outPutXml();
    	return false;
    	die();
    	*/
		return true;
    }
    
    /**
     * 保存xml文件
     * Enter description here ...
     * @param $xml 文件路径
     */
    protected function saveXml($itemRow)
    {
    	$path = APPLICATION_PATH . '/../data/ciqxml/' . $this->apiCode . '/';
        $filename = $path . $itemRow['refer_code'] . '-' . $itemRow['ref_cus_code'] . '.xml';
        if(Common_Common::createPath($path) === false){
            $this->_error[] = "创建目录[{$path}]失败";
            return false;
        }
        //写入报文格式
        if(file_put_contents($filename , $this->_xml) === false){
            $this->_error[] = "保存报文[{$filename}]失败";
            return false;
        }
		//保存报文路径
        $pathResult = Service_CiqApiMessage::update(array('file_path' => $filename), $itemRow['cam_id']);
        if($pathResult === false){
            $this->_error[] = "[ciq_api_message]消息ID[{$itemRow['cam_id']}]报文路径更新失败";
            return false;
        }
        $this->_xmlPath = $filename;
        return $filename;
    }
    
	/**
     * 报文头部
     * Enter description here ...
     * @param $messageId
     */
	protected function getXmlHeader($messageId, $apiCode)
    {
        $xmlHeader = array();
        //消息编号
        $xmlHeader['MESSAGE_ID'] = time().$messageId;
        //消息类型
        $xmlHeader['MESSAGE_TYPE'] = self::getMsgType($apiCode);
        //报文产生时间（2015-01-01 13:00:00）
        $xmlHeader['MESSAGE_TIME'] = date('Y-m-d H:i:s');
        //发送方代码
        $xmlHeader['SEND_CODE'] = $messageId;
        //接收方代码
		$xmlHeader['RECIPT_CODE'] = trim($this->_insUnitCode);
	//	$xmlHeader['RECIPT_CODE'] = ;
        return $xmlHeader;
    }

    /**
     * [getMesType 消息类型]
     * @param  [type] $apiCode [description]
     * @return [type]          [description]
     */
    protected static function getMsgType($apiCode){
        switch (strtolower(trim($apiCode))) {
            case 'recordcompanies':
                $messageType = 100;
                break;
            case 'product':
                $messageType = 110;
                break;
            case 'order':
                $messageType = 300;
                break;
            case 'waybill':
                $messageType = 301;
                break;
            case 'payorder':
                $messageType = 302;
                break;
            case 'personitem':
                $messageType = 130;
                break;
			case 'receiving':
                $messageType = 120;
                break;
            case 'feedback':
                $messageType = 502;
                break;
            case 'checkresult':
                $messageType = 401;
                break;
            default:
                $messageType = 100;
                break;
        }
        return $messageType;
    }

    /**
     * 连接 FTP 发送报文
     * Enter description here ...
     */
    protected function sendXml(){
		$return = array(
			'ask' => 1,
			'message' => '',
		);
		$ftp = new Common_Ftp($this->_ftpConfig);
		//连接FTP
		if(!$ftp->connect()){
			$return['ask'] = 0;
			$return['message'] = join('-', $ftp->getError());
		}
		//切换至对应目录
		if(!$ftp->chgdir($this->_ftpDir, true)){
			$return['ask'] = 0;
			$return['message'] = join('-', $ftp->getError());
		}
		//上传文件
		if(!$ftp->upload($this->_xmlPath, basename($this->_xmlPath))){
			$return['ask'] = 0;
			$return['message'] = join('-', $ftp->getError());
		}
		return $return;
    }
    
	/**
     * 获取待发送总数
     * @param  [type] $ApiCode [description]
     * @param  string $type    发送报文：sendMessage  获取回执：getReceipt
     * @return [type]          [description]
     */
    protected function getTotalByApiCode()
    {
        $rowTotal = Service_CiqApiMessage::getByCondition(array(
            'api_code'=>$this->apiCode,
            'status' => $this->status
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
     * [debug 输出错误]
     * @param  [type] $msg [description]
     * @return [type]      [description]
     */
    protected function debug()
    {
        $dateTime = '['.date('Y-m-d H:i:s').']';
        if(is_array($this->_error)){
            //echo $dateTime.implode("\t\n" , $this->_error);
            foreach ($this->_error as $value) {
                echo $dateTime.$value."\t\n";
            }
        }else{
            echo $dateTime.$this->_error."\t\n";
        }
        $this->_error = array();
    }
    
    /**
     * 调试输出 XML
     * Enter description here ...
     * @param unknown_type $xml
     */
	public function outPutXml(){
    	header("Content-type:text/xml");
    	echo $this->_xml;
    }
}