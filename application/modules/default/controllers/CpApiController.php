<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-9-11
 * Time: 下午2:46
 * To change this template use File | Settings | File Templates.
 */
class Default_CpApiController extends Zend_Controller_Action
{
    public function preDispatch(){
        $this->exception = array(
            'S01'=>10001,
            'S02'=>10002,
            'S03'=>10003,
            'S04'=>10004,
            'S05'=>10005,
            'S06'=>10006,
            'S07'=>10007,
            'S08'=>10008,
            'S09'=>10009,
            'S10'=>10010,
            'S11'=>10011,
            'S12'=>10012,
            'S13'=>10013,
            'S14'=>10014,
            'S15'=>10015,
            'S16'=>10016,
            'S17'=>10017,
            'S18'=>10018,
            'B0001'=>10019,
            'B0002'=>10020,
        );
    }

    public function checkorderAction(){
        //$xmlString = $this->_request->getParam("xmlData","");
        try{
            $xmlString = file_get_contents('php://input');
            $customerCode = $this->_request->getParam("customer_code","");
            $token = $this->_request->getParam("token","");
            $key = $this->_request->getParam("key","");
            $acp = new Api_ServiceForCp();
            $error = $acp->authenticate($customerCode,$token,$key);
            if(!empty($error)){
                $message = "";
                foreach($error as $val){
                    $message.=$val.".";
                }
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$message."</errorMsg>".
                    "<errorCode>S02</errorCode>".
                    "</result>";
                echo $returnXml;
                exit;
            }
            $xmlDom= new SimpleXMLElement($xmlString);
        }catch (Exception $e){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$e->getMessage()."</errorMsg>".
                "<errorCode>S02</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }
        $remarkArr = array(
            'SUCCESS'=>'仓库已接单',
            'SECURITY'=>'由于安全监测问题，仓库拒绝接单',
            'OTHER_REASON'=>'仓库拒绝接单',
        );
        $paramterArr = Common_Common::objectToArray($xmlDom);
        $message = "";
        if(!isset($paramterArr['logisticsEvent'])){
            $message.=" node logisticsEvent does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader'])){
            $message.=" node logisticsEvent>eventHeader does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventType'])){
            $message.=" node logisticsEvent>eventHeader>eventType does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTime'])){
            $message.=" node logisticsEvent>eventHeader>eventTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventSource'])){
            $message.=" node logisticsEvent>eventHeader>eventSource does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTarget'])){
            $message.=" node logisticsEvent>eventHeader>eventTarget does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody'])){
            $message.=" node logisticsEvent>eventBody does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder>tradeOrderId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>taobaoLogisticsId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['occurTime'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>occurTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsRemark does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsRemark does not exist.";
        }
        if(isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $logistic_code = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'];
            if($remarkArr[$logistic_code]!=$paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark']){
                $message.="logisticsRemark dose not match";
            }
        }
        if($message!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$message."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticEvent = $paramterArr['logisticsEvent']['eventHeader'];
        $tradeOrderId = $paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'];
        $logisticsOrder = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'];
        $validateMessage = "";
        if($tmLogisticEvent['eventType']==""){
            $validateMessage.=" eventType can not be null.";
        }
        if($tmLogisticEvent['eventTime']==""){
            $validateMessage.=" eventTime can not be null.";
        }
        if($tmLogisticEvent['eventSource']==""){
            $validateMessage.=" eventSource can not be null.";
        }
        if($tmLogisticEvent['eventTarget']==""){
            $validateMessage.=" eventTarget can not be null.";
        }
        if($tradeOrderId==""){
            $validateMessage.=" tradeOrderId can not be null.";
        }
        if($logisticsOrder['taobaoLogisticsId']==""){
            $validateMessage.=" taobaoLogisticsId can not be null.";
        }
        if($logisticsOrder['occurTime']==""){
            $validateMessage.=" occurTime can not be null.";
        }
        if($logisticsOrder['logisticsCode']==""){
            $validateMessage.=" logisticsCode can not be null.";
        }
        if($validateMessage!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$validateMessage."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }
        $meg_type = "tmall.logistics.event.wms.checkorder";
        $acp = new Api_ServiceForCp();
        $result = $acp->sendToCainiao($xmlString,$meg_type);
        if($result['responseItems']['response']['success']=='true'){
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try{
                if($tradeOrderId!=""){
                    $order = Service_TmOrders::getByField($tradeOrderId,"tradeOrderId","*");
                    if(empty($order)){
                        throw new Exception('order '.$tradeOrderId." does't exist", $this->exception['S12']);
                    }
                }
                $tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
                $TmOrderRow = Service_TmOrders::getByField($tmLogisticOrderRow['order_code'],"order_code","*");
                Service_TmLogisticEvent::add($tmLogisticEvent);
                //审单通过
                if($logisticsOrder['logisticsCode']=="SUCCESS"){
                    $updateOrder = array(
                        'order_status'=>4
                    );
                    Service_TmOrders::update($updateOrder,$TmOrderRow['order_code'],"order_code");
                    $tmOrderLog = array(
                        'order_code'=>$TmOrderRow['order_code'],
                        'order_status_from'=>$TmOrderRow['order_status'],
                        'order_status_to'=>'4',
                        'ol_add_time'=>date("Y-m-d H:i:s"),
                        'ol_comments'=>'海外CP审单'
                    );
                    Service_TmOrderLog::add($tmOrderLog);
                }
                Service_TmLogisticOrder::update($logisticsOrder,$logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId");
                $tmLogisticOrderLog = array(
                    'tlo_id'=>$tmLogisticOrderRow['tlo_id'],
                    'taobaoLogisticsId'=>$tmLogisticOrderRow['taobaoLogisticsId'],
                    'logisticsCode_start'=>$tmLogisticOrderRow['logisticsCode'],
                    'logisticsCode_end'=>$logisticsOrder['logisticsCode'],
                    'data_flow'=>"海外CP-->菜鸟",
                    'add_time'=>date("Y-m-d H:i:s"),
                    'remark'=>'海外CP审单',
                );
                Service_TmLogisticOrderLog::add($tmLogisticOrderLog);
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>true</success>".
                    "<errorMsg></errorMsg>".
                    "<errorCode>SUCCESS</errorCode>".
                    "</result>";
                $db->commit();
            }catch (Exception $e){
                $db->rollback();
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$e->getMessage()."</errorMsg>".
                    "<errorCode>".$e->getCode()."</errorCode>".
                    "</result>";
            }
        }else{
            if($result=="curl_error"){
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>curl_error</errorMsg>".
                    "<errorCode>S06</errorCode>".
                    "</result>";
            }else{
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$result['responseItems']['response']['reason'].';'.$result['responseItems']['response']['reasonDesc']."</errorMsg>".
                    "<errorCode>S12</errorCode>".
                    "</result>";
            }
        }
        echo $returnXml;

    }

    public function stockinAction(){
        //$xmlString = $this->_request->getParam("xmlData","");
        try{
            $xmlString = file_get_contents('php://input');
            $customerCode = $this->_request->getParam("customer_code","");
            $token = $this->_request->getParam("token","");
            $key = $this->_request->getParam("key","");
            $acp = new Api_ServiceForCp();
            $error = $acp->authenticate($customerCode,$token,$key);
            if(!empty($error)){
                $message = "";
                foreach($error as $val){
                    $message.=$val.".";
                }
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<errorMsg>".$message."</errorMsg>".
                    "<errorCode>Fail</errorCode>".
                    "</result>";
                echo $returnXml;
                exit;
            }
            $xmlDom= new SimpleXMLElement($xmlString);
        }catch (Exception $e){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$e->getMessage()."</errorMsg>".
                "<errorCode>S02</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $remarkArr = array(
            'SUCCESS'=>'包裹已到达仓库，仓库已入库',
            'PACKAGE_DAMAGED'=>'包裹已到达仓库，包裹破损，仓库拒收',
            'PACKAGE_TOOLARGE'=>'包裹已到达仓库，包裹超长超重，仓库拒收',
            'PACKAGE_MISMATCH'=>'包裹已到达仓库，包裹重量个数不符，仓库拒收',
            'PACKAGE_DANGER'=>'包裹已到达仓库，包裹安全监测不通过，仓库拒收',
            'FREIGHT_COLLECT'=>'包裹已到达仓库，运费到付，仓库拒收',
            'OTHER_REASON'=>'包裹已到达仓库，其他异常情况，仓库拒收',
        );
        $paramterArr = Common_Common::objectToArray($xmlDom);

        $message = "";
        if(!isset($paramterArr['logisticsEvent'])){
            $message.=" node logisticsEvent does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader'])){
            $message.=" node logisticsEvent>eventHeader does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventType'])){
            $message.=" node logisticsEvent>eventHeader>eventType does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTime'])){
            $message.=" node logisticsEvent>eventHeader>eventTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventSource'])){
            $message.=" node logisticsEvent>eventHeader>eventSource does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTarget'])){
            $message.=" node logisticsEvent>eventHeader>eventTarget does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody'])){
            $message.=" node logisticsEvent>eventBody does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder>tradeOrderId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>taobaoLogisticsId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['occurTime'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>occurTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsRemark does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsErrorImgUrl'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsErrorImgUrl does not exist.";
        }
        if(isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $logistic_code = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'];
            if($remarkArr[$logistic_code]!=$paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark']){
                $message.="logisticsRemark dose not match";
            }
        }
        if($message!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$message."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticEvent = $paramterArr['logisticsEvent']['eventHeader'];
        $tradeOrderId = $paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'];
        $logisticsOrder = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'];
        $validateMessage = "";
        if($tmLogisticEvent['eventType']==""){
            $validateMessage.=" eventType can not be null.";
        }
        if($tmLogisticEvent['eventTime']==""){
            $validateMessage.=" eventTime can not be null.";
        }
        if($tmLogisticEvent['eventSource']==""){
            $validateMessage.=" eventSource can not be null.";
        }
        if($tmLogisticEvent['eventTarget']==""){
            $validateMessage.=" eventTarget can not be null.";
        }
        if($logisticsOrder['taobaoLogisticsId']==""){
            $validateMessage.=" taobaoLogisticsId can not be null.";
        }
        if($logisticsOrder['occurTime']==""){
            $validateMessage.=" occurTime can not be null.";
        }
        if($logisticsOrder['logisticsCode']==""){
            $validateMessage.=" logisticsCode can not be null.";
        }
        if($validateMessage!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$validateMessage."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
        if(!empty($tmLogisticOrderRow)){
            $tmLogisticOrderLog = array(
                'tlo_id'=>$tmLogisticOrderRow['tlo_id'],
                'taobaoLogisticsId'=>$tmLogisticOrderRow['taobaoLogisticsId'],
                'logisticsCode_start'=>$tmLogisticOrderRow['logisticsCode'],
                'logisticsCode_end'=>$logisticsOrder['logisticsCode'],
                'data_flow'=>"海外CP-->菜鸟",
                'add_time'=>date("Y-m-d H:i:s"),
                'remark'=>'海外CP入库',
            );
            Service_TmLogisticOrderLog::add($tmLogisticOrderLog);
        }

        $meg_type = "tmall.logistics.event.wms.stockin";
        $acp = new Api_ServiceForCp();
        $result = $acp->sendToCainiao($xmlString,$meg_type);
        if($result['responseItems']['response']['success']=='true'){
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try{
                if($tradeOrderId!=""){
                    $order = Service_TmOrders::getByField($tradeOrderId,"tradeOrderId","*");
                    if(empty($order)){
                        throw new Exception('order '.$tradeOrderId." does't exist", $this->exception['S12']);
                    }
                }
                $TmOrderRow = Service_TmOrders::getByField($tmLogisticOrderRow['order_code'],"order_code","*");
                Service_TmLogisticEvent::add($tmLogisticEvent);

                if($logisticsOrder['logisticsCode']=="SUCCESS"){
                    $updateOrder = array(
                        'order_status'=>5
                    );
                    Service_TmOrders::update($updateOrder,$TmOrderRow['order_code'],"order_code");
                    $tmOrderLog = array(
                        'order_code'=>$TmOrderRow['order_code'],
                        'order_status_from'=>$TmOrderRow['order_status'],
                        'order_status_to'=>'5',
                        'ol_add_time'=>date("Y-m-d H:i:s"),
                        'ol_comments'=>'海外CP入库'
                    );
                    Service_TmOrderLog::add($tmOrderLog);
                }
                Service_TmLogisticOrder::update($logisticsOrder,$logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId");
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>true</success>".
                    "<errorMsg></errorMsg>".
                    "<errorCode>SUCCESS</errorCode>".
                    "</result>";
                $db->commit();
            }catch (Exception $e){
                $db->rollback();
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$e->getMessage()."</errorMsg>".
                    "<errorCode>".$e->getCode()."</errorCode>".
                    "</result>";
            }
        }else{
            if($result=="curl_error"){
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>curl_error</errorMsg>".
                    "<errorCode>S06</errorCode>".
                    "</result>";
            }else{
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$result['responseItems']['response']['reason'].';'.$result['responseItems']['response']['reasonDesc']."</errorMsg>".
                    "<errorCode>S12</errorCode>".
                    "</result>";
            }
        }

        echo $returnXml;
    }

    public function weightAction(){
        //$xmlString = $this->_request->getParam("xmlData","");
        try{
            $xmlString = file_get_contents('php://input');
            $customerCode = $this->_request->getParam("customer_code","");
            $token = $this->_request->getParam("token","");
            $key = $this->_request->getParam("key","");
            $acp = new Api_ServiceForCp();
            $error = $acp->authenticate($customerCode,$token,$key);
            if(!empty($error)){
                $message = "";
                foreach($error as $val){
                    $message.=$val.".";
                }
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<message>".$message."</message>".
                    "<errorCode>Fail</errorCode>".
                    "</result>";
                echo $returnXml;
                exit;
            }
            $xmlDom= new SimpleXMLElement($xmlString);
        }catch (Exception $e){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$e->getMessage()."</errorMsg>".
                "<errorCode>S02</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }
        $paramterArr = Common_Common::objectToArray($xmlDom);

        $message = "";
        if(!isset($paramterArr['logisticsEvent'])){
            $message.=" node logisticsEvent does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader'])){
            $message.=" node logisticsEvent>eventHeader does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventType'])){
            $message.=" node logisticsEvent>eventHeader>eventType does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTime'])){
            $message.=" node logisticsEvent>eventHeader>eventTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventSource'])){
            $message.=" node logisticsEvent>eventHeader>eventSource does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTarget'])){
            $message.=" node logisticsEvent>eventHeader>eventTarget does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody'])){
            $message.=" node logisticsEvent>eventBody does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder>tradeOrderId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>taobaoLogisticsId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['occurTime'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>occurTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsRemark does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsWeight'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsWeight does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['volume'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>volume does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['volume']['length'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>volume>length does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['volume']['width'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>volume>width does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['volume']['height'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>volume>height does not exist.";
        }
        if($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark']!='包裹已称重'){
            $message.="logisticsRemark dose not match";
        }
        if($message!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$message."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticEvent = $paramterArr['logisticsEvent']['eventHeader'];
        $tradeOrderId = $paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'];
        $logisticsOrder = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'];
        $validateMessage = "";
        if($tmLogisticEvent['eventType']==""){
            $validateMessage.=" eventType can not be null.";
        }
        if($tmLogisticEvent['eventTime']==""){
            $validateMessage.=" eventTime can not be null.";
        }
        if($tmLogisticEvent['eventSource']==""){
            $validateMessage.=" eventSource can not be null.";
        }
        if($tmLogisticEvent['eventTarget']==""){
            $validateMessage.=" eventTarget can not be null.";
        }
        if($logisticsOrder['taobaoLogisticsId']==""){
            $validateMessage.=" taobaoLogisticsId can not be null.";
        }
        if($logisticsOrder['occurTime']==""){
            $validateMessage.=" occurTime can not be null.";
        }
        if($logisticsOrder['logisticsWeight']==""){
            $validateMessage.=" logisticsWeight can not be null.";
        }else{
            if(!preg_match("/^[1-9]\d*(.\d+)*$|^0.\d*[1-9]+\d*$/",$logisticsOrder['logisticsWeight'])){
                $validateMessage.=" value of logisticsWeight is not valid.";
            }
        }
        if($logisticsOrder['volume']['length']==""){
            $validateMessage.=" length can not be null.";
        }else{
            if(!preg_match("/^[1-9]\d*(.\d+)*$|^0.\d*[1-9]+\d*$/",$logisticsOrder['volume']['length'])){
                $validateMessage.=" value of length is not valid.";
            }
        }
        if($logisticsOrder['volume']['width']==""){
            $validateMessage.=" length can not be null.";
        }else{
            if(!preg_match("/^[1-9]\d*(.\d+)*$|^0.\d*[1-9]+\d*$/",$logisticsOrder['volume']['width'])){
                $validateMessage.=" value of width is not valid.";
            }
        }
        if($logisticsOrder['volume']['height']==""){
            $validateMessage.=" length can not be null.";
        }else{
            if(!preg_match("/^[1-9]\d*(.\d+)*$|^0.\d*[1-9]+\d*$/",$logisticsOrder['volume']['height'])){
                $validateMessage.=" value of height is not valid.";
            }
        }
        if($validateMessage!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$validateMessage."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
        if(!empty($tmLogisticOrderRow)){
            $tmLogisticOrderLog = array(
                'tlo_id'=>$tmLogisticOrderRow['tlo_id'],
                'taobaoLogisticsId'=>$tmLogisticOrderRow['taobaoLogisticsId'],
                'logisticsCode_start'=>$tmLogisticOrderRow['logisticsCode']?$tmLogisticOrderRow['logisticsCode']:'',
                'logisticsCode_end'=>$logisticsOrder['logisticsCode']?$logisticsOrder['logisticsCode']:'',
                'data_flow'=>"海外CP-->菜鸟",
                'add_time'=>date("Y-m-d H:i:s"),
                'remark'=>'海外CP称重',
            );
            Service_TmLogisticOrderLog::add($tmLogisticOrderLog);
        }

        $meg_type = "tmall.logistics.event.wms.weight";
        $acp = new Api_ServiceForCp();
        $result = $acp->sendToCainiao($xmlString,$meg_type);

        if($result['responseItems']['response']['success']=='true'){
            $db = Common_Common::getAdapter();
            $db->beginTransaction();

            try{
                if($tradeOrderId!=""){
                    $order = Service_TmOrders::getByField($tradeOrderId,"tradeOrderId","*");
                    if(empty($order)){
                        throw new Exception('order '.$tradeOrderId." does't exist", $this->exception['S12']);
                    }
                }
                $TmOrderRow = Service_TmOrders::getByField($tmLogisticOrderRow['order_code'],"order_code","*");
                Service_TmLogisticEvent::add($tmLogisticEvent);

                $updateOrder = array(
                    'order_status'=>6
                );
                //Service_TmOrders::update($updateOrder,$tradeOrderId,"tradeOrderId");
                Service_TmOrders::update($updateOrder,$TmOrderRow['order_code'],"order_code");
                $tmOrderLog = array(
                    'order_code'=>$TmOrderRow['order_code'],
                    'order_status_from'=>$TmOrderRow['order_status'],
                    'order_status_to'=>'6',
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'海外CP称重'
                );
                Service_TmOrderLog::add($tmOrderLog);

                $updateLgOrder = array(
                    'taobaoLogisticsId'=>$logisticsOrder['taobaoLogisticsId'],
                    'occurTime'=>$logisticsOrder['occurTime'],
                    'logisticsRemark'=>$logisticsOrder['logisticsRemark'],
                    'logisticsWeight'=>$logisticsOrder['logisticsWeight'],
                    'length'=>$logisticsOrder['volume']['length'],
                    'width'=>$logisticsOrder['volume']['width'],
                    'height'=>$logisticsOrder['volume']['height'],
                );
                Service_TmLogisticOrder::update($updateLgOrder,$logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId");
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>true</success>".
                    "<errorMsg></errorMsg>".
                    "<errorCode>SUCCESS</errorCode>".
                    "</result>";
                $db->commit();
            }catch (Exception $e){
                $db->rollback();
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$e->getMessage()."</errorMsg>".
                    "<errorCode>".$e->getCode()."</errorCode>".
                    "</result>";
            }
        }else{
            if($result=="curl_error"){
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>curl_error</errorMsg>".
                    "<errorCode>S06</errorCode>".
                    "</result>";
            }else{
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$result['responseItems']['response']['reason'].';'.$result['responseItems']['response']['reasonDesc']."</errorMsg>".
                    "<errorCode>S12</errorCode>".
                    "</result>";
            }
        }
        echo $returnXml;
        exit;
    }

    public function exceptionAction(){
        //$xmlString = $this->_request->getParam("xmlData","");
        try{
            $xmlString = file_get_contents('php://input');
            $customerCode = $this->_request->getParam("customer_code","");
            $token = $this->_request->getParam("token","");
            $key = $this->_request->getParam("key","");
            $acp = new Api_ServiceForCp();
            $error = $acp->authenticate($customerCode,$token,$key);
            if(!empty($error)){
                $message = "";
                foreach($error as $val){
                    $message.=$val.".";
                }
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<errorMsg>".$message."</errorMsg>".
                    "<errorCode>Fail</errorCode>".
                    "</result>";
                echo $returnXml;
                exit;
            }
            $xmlDom= new SimpleXMLElement($xmlString);
        }catch (Exception $e){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$e->getMessage()."</errorMsg>".
                "<errorCode>S02</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }
       $remarkArr = array(
            'SECURITY'=>'包裹安全监测不通过，发生库内异常',
            'LOST'=>'包裹丢失，发生库内异常',
            'DAMAGED'=>'包裹破损，发生库内异常',
            'OTHER_REASON'=>'包裹发生库内异常',
        );
        $paramterArr = Common_Common::objectToArray($xmlDom);

        $message = "";
        if(!isset($paramterArr['logisticsEvent'])){
            $message.=" node logisticsEvent does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader'])){
            $message.=" node logisticsEvent>eventHeader does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventType'])){
            $message.=" node logisticsEvent>eventHeader>eventType does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTime'])){
            $message.=" node logisticsEvent>eventHeader>eventTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventSource'])){
            $message.=" node logisticsEvent>eventHeader>eventSource does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTarget'])){
            $message.=" node logisticsEvent>eventHeader>eventTarget does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody'])){
            $message.=" node logisticsEvent>eventBody does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder>tradeOrderId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>taobaoLogisticsId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['occurTime'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>occurTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsRemark does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsCode does not exist.";
        }
        if(isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $logistic_code = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'];
            if($remarkArr[$logistic_code]!=$paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark']){
                $message.="logisticsRemark dose not match";
            }
        }

        if($message!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$message."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticEvent = $paramterArr['logisticsEvent']['eventHeader'];
        $tradeOrderId = $paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'];
        $logisticsOrder = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'];

        $validateMessage = "";
        if($tmLogisticEvent['eventType']==""){
            $validateMessage.=" eventType can not be null.";
        }
        if($tmLogisticEvent['eventTime']==""){
            $validateMessage.=" eventTime can not be null.";
        }
        if($tmLogisticEvent['eventSource']==""){
            $validateMessage.=" eventSource can not be null.";
        }
        if($tmLogisticEvent['eventTarget']==""){
            $validateMessage.=" eventTarget can not be null.";
        }
        if($logisticsOrder['taobaoLogisticsId']==""){
            $validateMessage.=" taobaoLogisticsId can not be null.";
        }
        if($logisticsOrder['occurTime']==""){
            $validateMessage.=" occurTime can not be null.";
        }
        if($logisticsOrder['logisticsCode']==""){
            $validateMessage.=" logisticsCode can not be null.";
        }
        if($validateMessage!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$validateMessage."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
        if(!empty($tmLogisticOrderRow)){
            $tmLogisticOrderLog = array(
                'tlo_id'=>$tmLogisticOrderRow['tlo_id'],
                'taobaoLogisticsId'=>$tmLogisticOrderRow['taobaoLogisticsId'],
                'logisticsCode_start'=>$tmLogisticOrderRow['logisticsCode'],
                'logisticsCode_end'=>$logisticsOrder['logisticsCode'],
                'data_flow'=>"海外CP-->菜鸟",
                'add_time'=>date("Y-m-d H:i:s"),
                'remark'=>'海外CP回传异常',
            );
            Service_TmLogisticOrderLog::add($tmLogisticOrderLog);
        }

        $meg_type = "tmall.logistics.event.wms.exception";
        $acp = new Api_ServiceForCp();
        $result = $acp->sendToCainiao($xmlString,$meg_type);
        if($result['responseItems']['response']['success']=='true'){
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try{
                if($tradeOrderId!=""){
                    $order = Service_TmOrders::getByField($tradeOrderId,"tradeOrderId","*");
                    if(empty($order)){
                        throw new Exception('order '.$tradeOrderId." does't exist", $this->exception['S12']);
                    }
                }

                $TmOrderRow = Service_TmOrders::getByField($tmLogisticOrderRow['order_code'],"order_code","*");
                Service_TmLogisticEvent::add($tmLogisticEvent);

                Service_TmLogisticOrder::update($logisticsOrder,$logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId");

                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>true</success>".
                    "<errorMsg></errorMsg>".
                    "<errorCode>SUCCESS</errorCode>".
                    "</result>";
                $db->commit();
            }catch (Exception $e){
                $db->rollback();
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$e->getMessage()."</errorMsg>".
                    "<errorCode>".$e->getCode()."</errorCode>".
                    "</result>";
            }
        }else{
            if($result=="curl_error"){
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>curl_error</errorMsg>".
                    "<errorCode>S06</errorCode>".
                    "</result>";
            }else{
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$result['responseItems']['response']['reason'].';'.$result['responseItems']['response']['reasonDesc']."</errorMsg>".
                    "<errorCode>S12</errorCode>".
                    "</result>";
            }
        }

        echo $returnXml;
    }

    public function stockoutAction(){
        //$xmlString = $this->_request->getParam("xmlData","");
        try{
            $xmlString = file_get_contents('php://input');
            $customerCode = $this->_request->getParam("customer_code","");
            $token = $this->_request->getParam("token","");
            $key = $this->_request->getParam("key","");
            $acp = new Api_ServiceForCp();
            $error = $acp->authenticate($customerCode,$token,$key);
            if(!empty($error)){
                $message = "";
                foreach($error as $val){
                    $message.=$val.".";
                }
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$message."</errorMsg>".
                    "<errorCode>Fail</errorCode>".
                    "</result>";
                echo $returnXml;
                exit;
            }
            $xmlDom= new SimpleXMLElement($xmlString);
        }catch (Exception $e){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$e->getMessage()."</errorMsg>".
                "<errorCode>S02</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }
        $remarkArr = array(
            'STOCKOUT'=>'包裹已出库，转交干线物流商',
            'ACCEPT'=>'',
        );
        $paramterArr = Common_Common::objectToArray($xmlDom);

        $message = "";
        if(!isset($paramterArr['logisticsEvent'])){
            $message.=" node logisticsEvent does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader'])){
            $message.=" node logisticsEvent>eventHeader does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventType'])){
            $message.=" node logisticsEvent>eventHeader>eventType does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTime'])){
            $message.=" node logisticsEvent>eventHeader>eventTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventSource'])){
            $message.=" node logisticsEvent>eventHeader>eventSource does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTarget'])){
            $message.=" node logisticsEvent>eventHeader>eventTarget does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody'])){
            $message.=" node logisticsEvent>eventBody does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder>tradeOrderId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>taobaoLogisticsId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['occurTime'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>occurTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'])){
            //$message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsRemark does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>logisticsCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['packingType'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>packingType does not exist.";
        }
        if(isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'])){
            $logistic_code = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsCode'];
            if($remarkArr[$logistic_code]!=$paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark']){
                $message.="logisticsRemark dose not match";
            }
        }
        if($message!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$message."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticEvent = $paramterArr['logisticsEvent']['eventHeader'];
        $tradeOrderId = $paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'];
        $logisticsOrder = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'];

        $validateMessage = "";
        if($tmLogisticEvent['eventType']==""){
            $validateMessage.=" eventType can not be null.";
        }
        if($tmLogisticEvent['eventTime']==""){
            $validateMessage.=" eventTime can not be null.";
        }
        if($tmLogisticEvent['eventSource']==""){
            $validateMessage.=" eventSource can not be null.";
        }
        if($tmLogisticEvent['eventTarget']==""){
            $validateMessage.=" eventTarget can not be null.";
        }
        if($logisticsOrder['taobaoLogisticsId']==""){
            $validateMessage.=" taobaoLogisticsId can not be null.";
        }
        if($logisticsOrder['occurTime']==""){
            $validateMessage.=" occurTime can not be null.";
        }
        if($logisticsOrder['logisticsCode']==""){
            $validateMessage.=" logisticsCode can not be null.";
        }
        if($logisticsOrder['packingType']==""){
            $validateMessage.=" packingType can not be null.";
        }
        if($validateMessage!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$validateMessage."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
        if(!empty($tmLogisticOrderRow)){
            $tmLogisticOrderLog = array(
                'tlo_id'=>$tmLogisticOrderRow['tlo_id'],
                'taobaoLogisticsId'=>$tmLogisticOrderRow['taobaoLogisticsId'],
                'logisticsCode_start'=>$tmLogisticOrderRow['logisticsCode'],
                'logisticsCode_end'=>$logisticsOrder['logisticsCode'],
                'data_flow'=>"海外CP-->菜鸟",
                'add_time'=>date("Y-m-d H:i:s"),
                'remark'=>'海外CP出库',
            );
            Service_TmLogisticOrderLog::add($tmLogisticOrderLog);
        }

        $meg_type = "tmall.logistics.event.wms.stockout";
        $acp = new Api_ServiceForCp();
        $result = $acp->sendToCainiao($xmlString,$meg_type);
        if($result['responseItems']['response']['success']=='true'){
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try{
                if($tradeOrderId!=""){
                    $order = Service_TmOrders::getByField($tradeOrderId,"tradeOrderId","*");
                    if(empty($order)){
                        throw new Exception('order '.$tradeOrderId." does't exist", $this->exception['S12']);
                    }
                }

                $TmOrderRow = Service_TmOrders::getByField($tmLogisticOrderRow['order_code'],"order_code","*");
                Service_TmLogisticEvent::add($tmLogisticEvent);

                $updateOrder = array(
                    'order_status'=>7
                );
                Service_TmOrders::update($updateOrder,$tradeOrderId,"tradeOrderId");
                $tmOrderLog = array(
                    'order_code'=>$TmOrderRow['order_code'],
                    'order_status_from'=>$TmOrderRow['order_status'],
                    'order_status_to'=>'7',
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'海外CP出库'
                );
                Service_TmOrderLog::add($tmOrderLog);

                Service_TmLogisticOrder::update($logisticsOrder,$logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId");

                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>true</success>".
                    "<errorMsg></errorMsg>".
                    "<errorCode>SUCCESS</errorCode>".
                    "</result>";
                $db->commit();
            }catch (Exception $e){
                $db->rollback();
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$e->getMessage()."</errorMsg>".
                    "<errorCode>".$e->getCode()."</errorCode>".
                    "</result>";
            }
        }else{
            if($result=="curl_error"){
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>curl_error</errorMsg>".
                    "<errorCode>S06</errorCode>".
                    "</result>";
            }else{
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$result['responseItems']['response']['reason'].';'.$result['responseItems']['response']['reasonDesc']."</errorMsg>".
                    "<errorCode>S12</errorCode>".
                    "</result>";
            }
        }

        echo $returnXml;
    }
    /**
     * @todo 接收cp干线信息
     */
    public function trunkAction(){
        //$xmlString = $this->_request->getParam("xmlData","");
        try{
            $xmlString = file_get_contents('php://input');
            $customerCode = $this->_request->getParam("customer_code","");
            $token = $this->_request->getParam("token","");
            $key = $this->_request->getParam("key","");
            $acp = new Api_ServiceForCp();
            $error = $acp->authenticate($customerCode,$token,$key);
            if(!empty($error)){
                $message = "";
                foreach($error as $val){
                    $message.=$val.".";
                }
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$message."</errorMsg>".
                    "<errorCode>Fail</errorCode>".
                    "</result>";
                echo $returnXml;
                exit;
            }
            $xmlDom= new SimpleXMLElement($xmlString);
        }catch (Exception $e){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$e->getMessage()."</errorMsg>".
                "<errorCode>S02</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }
        $remarkArr = array(
            'TRUNK_TRANSPORT_CONSIGN'=>'干线物流商揽收包裹成功',
            'TRUNK_TRANSPORT_CONFIRM'=>'航班确定，等待航班起飞',
            //'TRUNK_TRANSPORT_TAKEOFF'=>'',
            'TRUNK_TRANSPORT_TAKEDOWN'=>'航班已到达'
        );
        $paramterArr = Common_Common::objectToArray($xmlDom);

        $message = "";
        if(!isset($paramterArr['logisticsEvent'])){
            $message.=" node logisticsEvent does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader'])){
            $message.=" node logisticsEvent>eventHeader does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventType'])){
            $message.=" node logisticsEvent>eventHeader>eventType does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTime'])){
            $message.=" node logisticsEvent>eventHeader>eventTime does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventSource'])){
            $message.=" node logisticsEvent>eventHeader>eventSource does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventHeader']['eventTarget'])){
            $message.=" node logisticsEvent>eventHeader>eventTarget does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody'])){
            $message.=" node logisticsEvent>eventBody does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail does not exist.";
        }
        /*if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'])){
            $message.=" node logisticsEvent>eventBody>tradeDetail>tradeOrders>tradeOrder>tradeOrderId does not exist.";
        }*/
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>taobaoLogisticsId does not exist.";
        }
        /*if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['senderDetail']['country'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>senderDetail>country does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['senderDetail']['wangwangId'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>senderDetail>wangwangId does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['senderDetail']['name'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>senderDetail>name does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['senderDetail']['phone'])){
            $message.=" node logisticsEvent>eventBody>logisticsDetail>logisticsOrders>logisticsOrder>senderDetail>phone does not exist.";
        }*/

        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['transferPackageCode'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>transferPackageCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['transportNumber'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>transportNumber does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['transportCode'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>transportCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['transportNumber'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>transportNumber does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['fromPortCode'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>fromPortCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['toPortCode'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>toPortCode does not exist.";
        }
        if(!isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['status'])){
            $message.=" node logisticsEvent>eventBody>trunkInfo>status does not exist.";
        }

        if(isset($paramterArr['logisticsEvent']['eventBody']['trunkInfo']['status'])){
            $logistic_code = $paramterArr['logisticsEvent']['eventBody']['trunkInfo']['status'];
            //file_put_contents(APPLICATION_PATH.'/../data/cainiao/'.'debug'.date("Y-m-d H:i:s").'.txt',var_export($logistic_code.':'.$remarkArr[$logistic_code].':'.$paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark'],true));
            if($logistic_code!='TRUNK_TRANSPORT_TAKEOFF'){
                if($remarkArr[$logistic_code]!=$paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['logisticsRemark']){
                    $message.="logisticsRemark dose not match";
                }
            }
        }

        if($message!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$message."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $tmLogisticEvent = $paramterArr['logisticsEvent']['eventHeader'];
        $tradeOrderId = $paramterArr['logisticsEvent']['eventBody']['tradeDetail']['tradeOrders']['tradeOrder']['tradeOrderId'];
        $logisticsOrder = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder'];

        $validateMessage = "";
        if($tmLogisticEvent['eventType']==""){
            $validateMessage.=" eventType can not be null.";
        }
        if($tmLogisticEvent['eventTime']==""){
            $validateMessage.=" eventTime can not be null.";
        }
        if($tmLogisticEvent['eventSource']==""){
            $validateMessage.=" eventSource can not be null.";
        }
        if($tmLogisticEvent['eventTarget']==""){
            $validateMessage.=" eventTarget can not be null.";
        }
        if($logisticsOrder['taobaoLogisticsId']==""){
            $validateMessage.=" taobaoLogisticsId can not be null.";
        }
        if($logisticsOrder['occurTime']==""){
            $validateMessage.=" occurTime can not be null.";
        }
        /*if($logisticsOrder['logisticsCode']==""){
            $validateMessage.=" logisticsCode can not be null.";
        }*/
        /*if($logisticsOrder['packingType']==""){
            $validateMessage.=" packingType can not be null.";
        }*/
        $taobaoLogisticsId = $paramterArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
        $tmOrder = Service_TmOrders::getByField($taobaoLogisticsId,'taobaoLogisticsId');
        if($tmOrder['order_status']!='7'){
            $validateMessage.="order status error";
        }

        if($validateMessage!=""){
            $returnXml = "<?xml version='1.0'?>".
                "<result>".
                "<success>false</success>".
                "<errorMsg>".$validateMessage."</errorMsg>".
                "<errorCode>10012</errorCode>".
                "</result>";
            echo $returnXml;
            exit;
        }

        $meg_type = "OS_TRUNK_CALLBACK";
        $acp = new Api_ServiceForCp();
        $result = $acp->sendGanxianToCainiao($xmlString,$meg_type);
        if($result['responseItems']['response']['success']=='true'){
            $db = Common_Common::getAdapter();
            $db->beginTransaction();
            try{
                if($tradeOrderId!=""){
                    $order = Service_TmOrders::getByField($tradeOrderId,"tradeOrderId","*");
                    if(empty($order)){
                        throw new Exception('order '.$tradeOrderId." does't exist", $this->exception['S12']);
                    }
                }
                /*$tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
                $TmOrderRow = Service_TmOrders::getByField($tmLogisticOrderRow['order_code'],"order_code","*");
                Service_TmLogisticEvent::add($tmLogisticEvent);

                $updateOrder = array(
                    'order_status'=>7
                );
                Service_TmOrders::update($updateOrder,$tradeOrderId,"tradeOrderId");
                $tmOrderLog = array(
                    'order_code'=>$TmOrderRow['order_code'],
                    'order_status_from'=>$TmOrderRow['order_status'],
                    'order_status_to'=>'7',
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'海外CP出库'
                );
                Service_TmOrderLog::add($tmOrderLog);*/
                $tmLogisticOrderRow = Service_TmLogisticOrder::getByField($logisticsOrder['taobaoLogisticsId'],"taobaoLogisticsId","*");
                $arrGanxian = array(
                    'TRUNK_TRANSPORT_CONSIGN',
                    'TRUNK_TRANSPORT_CONFIRM',
                    'TRUNK_TRANSPORT_TAKEOFF',
                    'TRUNK_TRANSPORT_TAKEDOWN'
                );
                switch($logistic_code){
                    case "TRUNK_TRANSPORT_CONSIGN":
                        $UpdateLogisticsOrder = array(
                            'logisticsCode'=>$logistic_code,
                        );
                        if(!in_array($logistic_code,$arrGanxian)){
                            throw new Exception("logistic order error");
                        }
                        break;
                    case "TRUNK_TRANSPORT_CONFIRM":
                        $UpdateLogisticsOrder = array(
                            'logisticsCode'=>$logistic_code,
                        );
                        if($tmLogisticOrderRow['logisticsCode']!='TRUNK_TRANSPORT_CONSIGN'){
                            throw new Exception("logistic order must be TRUNK_TRANSPORT_CONSIGN");
                        }
                        break;
                    case "TRUNK_TRANSPORT_TAKEOFF":
                        $UpdateLogisticsOrder = array(
                            'logisticsCode'=>$logistic_code,
                        );
                        if($tmLogisticOrderRow['logisticsCode']!='TRUNK_TRANSPORT_CONFIRM'){
                            throw new Exception("logistic order must be TRUNK_TRANSPORT_CONFIRM");
                        }
                        break;
                    case "TRUNK_TRANSPORT_TAKEDOWN":
                        $UpdateLogisticsOrder = array(
                            'logisticsCode'=>$logistic_code,
                        );
                        if($tmLogisticOrderRow['logisticsCode']!='TRUNK_TRANSPORT_TAKEOFF'){
                            throw new Exception("logistic order must be TRUNK_TRANSPORT_TAKEOFF");
                        }
                        break;
                    default:
                        break;
                }



                Service_TmLogisticOrder::update($UpdateLogisticsOrder,$tmLogisticOrderRow['taobaoLogisticsId'],"taobaoLogisticsId");
                $tmLogisticOrderLog = array(
                    'tlo_id'=>$tmLogisticOrderRow['tlo_id'],
                    'taobaoLogisticsId'=>$tmLogisticOrderRow['taobaoLogisticsId'],
                    'logisticsCode_start'=>$tmLogisticOrderRow['logisticsCode'],
                    'logisticsCode_end'=>$UpdateLogisticsOrder['logisticsCode'],
                    'data_flow'=>"海外CP-->菜鸟",
                    'add_time'=>date("Y-m-d H:i:s"),
                    'remark'=>'回传干线信息:'.$logistic_code,
                );
                Service_TmLogisticOrderLog::add($tmLogisticOrderLog);
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>true</success>".
                    "<errorMsg></errorMsg>".
                    "<errorCode>SUCCESS</errorCode>".
                    "</result>";
                $db->commit();
            }catch (Exception $e){
                $db->rollback();
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$e->getMessage()."</errorMsg>".
                    "<errorCode>".$e->getCode()."</errorCode>".
                    "</result>";
            }
        }else{
            if($result=="curl_error"){
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>curl_error</errorMsg>".
                    "<errorCode>S06</errorCode>".
                    "</result>";
            }else{
                $returnXml = "<?xml version='1.0'?>".
                    "<result>".
                    "<success>false</success>".
                    "<errorMsg>".$result['responseItems']['response']['reason'].';'.$result['responseItems']['response']['reasonDesc']."</errorMsg>".
                    "<errorCode>S12</errorCode>".
                    "</result>";
            }
        }

        echo $returnXml;
    }


    public function testAction(){
        $xmlString = file_get_contents('php://input');
        //$xmlDom= new SimpleXMLElement($xmlString);
        //$paramterArr = Common_Common::objectToArray($xmlDom);
        echo $xmlString;
    }
}
