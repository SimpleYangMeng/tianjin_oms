<?php
/**
 * @author william-fan
 * @todo菜鸟对接类库
 */
//require_once("AES.php");
class Service_CainiaoApiProcess{
	private $cainiao_public_key='cscm1010';
    private $cs_cm_public_key = 'cs-cm';
    private $param = '';//参数
    private $error = array();
    private $baowen = ''; //解密菜鸟报文内容
    private $baowenArr = ''; //报文转换成数组
    private $baowenObj = ''; //simplexml_load_string报文的对象
    private $customerCode = 'C0254'; //默认客户代码
    private $warehouse_id = '3';
    private $am_id = '';
    private $eweWsdl = "http://www.everfast.com.au/EweBaohong/BaohongService.svc?singleWsdl";
    private $eweSalt = '3.14159';
    private $partnerCode = 'baohong';
    private $return = '0';
    private $tongbu = false; //是否接收菜鸟的单就同步过去
    private $exception = array(
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
    /**
     * @author william-fan
     * @todo 保宏错误代买转到菜鸟的错误代码
     */
    public function getCainiaoErrorCode($baohongCode){
        $cainiaoCode = '';
        foreach($this->exception as $key=>$value){
            if($value==$baohongCode){
                return $key;
            }
        }
        return $cainiaoCode;
    }
    /**
     * @author william-fan
     * @todo 返回菜鸟格式的报文
     */
    public function getCainiaoResult($baohongResult){
        //$dom = new DOMDocument('1.0', 'UTF-8');
        $dom = new DOMDocument();
        $responses = $dom->createElement('responses');
        $reponseItems = $dom->createElement('responseItems');
        $reponse = $dom->createElement("response");
        if($baohongResult['ask']=='1'){
            $reponse->appendChild($dom->createElement('success','true'));
            $reponse->appendChild($dom->createElement('reason',''));
            $reponse->appendChild($dom->createElement('reasonDesc',''));
        }else{
            $errors = $baohongResult['error'];
            //var_dump($errors);
            $reason = '';
            if(isset($baohongResult['error'])){
                $reason = strip_tags(implode(";",$errors));
            }
            //file_put_contents('sss.txt',var_export($reason,true));
            $reason = html_entity_decode($reason);
            $reason.= $baohongResult['message'];
            //var_dump($reason);
            $reponse->appendChild($dom->createElement('success','false'));
            $reponse->appendChild($dom->createElement('reason',$reason));
            $reponse->appendChild($dom->createElement('reasonDesc',''));
        }
        $reponseItems->appendChild($reponse);
        $responses->appendChild($reponseItems);
        $dom->appendChild($responses);
        $string =  $dom->saveXML();
        return trim(str_replace('<?xml version="1.0"?>','',$string));
    }
    /**
     * @author william-fan
     * @todo 获取加密数据
     */
    public function getEncrypt($data){
        $value = Security::encrypt($data , $this->cainiao_public_key);
        return $value;
    }
    public function getDecrypt($data){
        $value = Security::decrypt($data , $this->cainiao_public_key);
        return $value;
    }
    /**
     * @author william-fan
     * @todo 获取wsdl
     */
    private function get_wsdl() {
        $filePath = APPLICATION_PATH.'/../data/wsdl/BaohongService.wsdl';
        return file_get_contents($filePath);
    }
    public function setParam($param){
        $this->param = $param;
        //echo "<pre>";
    }
    /**
     * @author william-fan
     * @todo 校验数据的有效性
     */
    public function validator(){
        $this->validatorSafe();

        /*$doc = new DOMDocument();
        $xml=$doc->loadXML();
        var_dump($xml);*/

        libxml_use_internal_errors(true);
        $baowenObj = simplexml_load_string($this->baowen);
        if (!$baowenObj) {
            $this->error[] = 'Message parse error';
        }else{
            $this->baowenObj = $baowenObj;
            $this->baowenArr = Common_Common::objectToArray($this->baowenObj);
        }
    }
    /**
     * @author william-fan
     * @todo 校验订单数据
     */
    public function validatorOrder($eventBody){
        $paid = $eventBody['paymentDetail']['paid'];
        if(empty($paid)){
            throw new Exception('paid exception ',$this->exception['S12']);
        }
        //exit;
        $tradeDetail = $eventBody['tradeDetail'];
        if(empty($tradeDetail)){
            throw new Exception('tradeDetail exception',$this->exception['S12']);
        }
        $tradeOrders = $tradeDetail['tradeOrders'];
        if(empty($tradeOrders)){
            throw new Exception('tradeOrders exception',$this->exception['S12']);
        }

        $logisticsDetail = $eventBody['logisticsDetail'];
        if(empty($logisticsDetail)){
            throw new Exception("logisticsDetail exception",$this->exception['S12']);
        }

        $logisticsOrders = $logisticsDetail['logisticsOrders'];
        if(empty($logisticsOrders)){
            throw new Exception("logisticsOrders exception",$this->exception['S12']);
        }

        $tradeOrder = $tradeOrders['tradeOrder'];
        if(empty($tradeOrder)){
            throw new Exception("tradeOrder exception",$this->exception['S12']);
        }


        $buyer = $tradeOrder['buyer'];
        if(empty($buyer)){
            throw new Exception("tradeOrder exception",$this->exception['S13']);
        }
        //tm_order_address_book（订单收件人）

        $items = $tradeOrder['items'];
        if(empty($items)){
            throw new Exception("items exception",$this->exception['S13']);
        }

        //tm_order_product
        foreach($items as $key=>$item){
            //$tmOrderProductRow['order_code'] = $ordersCode;
            $tmOrderProductRow['itemId'] = isset($item['itemId'])?$item['itemId']:'';

            $tmOrderProductRow['itemName'] = isset($item['itemName'])?$item['itemName']:'';
            $tmOrderProductRow['itemCategoryName'] = isset($item['itemCategoryName'])?$item['itemCategoryName']:'';
            $tmOrderProductRow['itemUnitPrice'] = isset($item['itemUnitPrice'])?$item['itemUnitPrice']:'';
            $tmOrderProductRow['itemQuantity'] = isset($item['itemQuantity'])?$item['itemQuantity']:0;
            $tmOrderProductRow['itemRemark'] = isset($item['itemRemark'])?$item['itemRemark']:'';

        }

        $logisticsOrder = $logisticsOrders['logisticsOrder'];
        if(empty($logisticsOrder)){
            throw new Exception("logisticsOrder exception",$this->exception['S13']);
        }

        if(!(isset($logisticsOrder['taobaoLogisticsId']) && $logisticsOrder['taobaoLogisticsId']!='')){
            throw new Exception("taobao logistic id can't be empty",$this->exception['B0002']);
        }
        //S12
        $tmLogisticCondition = array(
             'taobaoLogisticsId'=>$logisticsOrder['taobaoLogisticsId'],
        );
        $count = Service_TmLogisticOrder::getByCondition($tmLogisticCondition,"count(*)");
        if($count>0){
            //throw new Exception("taobao logistic id can't be duplicate",$this->exception['B0002']);
            $this->return = '1';
        }
    }
    /**
     * @author william-fan
     * @todo 校验取消订单数据
     */
    public function validatorCancelOrder($eventBody){
        $logisticsDetail = $eventBody['logisticsDetail'];
        if(empty($logisticsDetail)){
            throw new Exception("logisticsDetail exception",$this->exception['B0002']);
        }
        $logisticsOrders = $logisticsDetail['logisticsOrders'];
        if(empty($logisticsOrders)){
            throw new Exception("logisticsDetail exception",$this->exception['B0002']);
        }
        $logisticsOrder = $logisticsOrders['logisticsOrder'];
        if(empty($logisticsOrder)){
            throw new Exception("logisticsOrder exception",$this->exception['B0002']);
        }
        $taobaoLogisticsId = $logisticsOrder['taobaoLogisticsId'];
        if(empty($taobaoLogisticsId)){
            throw new Exception("taobaoLogisticsId exception",$this->exception['B0002']);
        }
        $tmLogisticCondition = array(
            'taobaoLogisticsId'=>$taobaoLogisticsId
        );
        $count = Service_TmLogisticOrder::getByCondition($tmLogisticCondition,'count(*)');
        if($count<=0){
            throw new Exception("taobaoLogisticsId not exists",$this->exception['S12']);
        }else{
            $logisticOrder = Service_TmLogisticOrder::getByField($taobaoLogisticsId,'taobaoLogisticsId');
            $logisticsCode = array(
                'SUCCESS',
                ''
            );
            if(!in_array($logisticsOrder['logisticsCode'],$logisticsCode)){
                throw new Exception("无法取消",$this->exception['S12']);
            }
            Service_TmOrders::getByField($taobaoLogisticsId,'taobaoLogisticsId');
        }
    }
    /**
     * @author william-fan
     * @todo 校验退货订单
     */
    public function validatorRefundOrder($eventBody){
        $logisticsDetail = $eventBody['logisticsDetail'];
        if(empty($logisticsDetail)){
            throw new Exception("logisticsDetail exception",$this->exception['B0002']);
        }
        $logisticsOrders = $logisticsDetail['logisticsOrders'];
        if(empty($logisticsOrders)){
            throw new Exception("logisticsDetail exception",$this->exception['B0002']);
        }
        $logisticsOrder = $logisticsOrders['logisticsOrder'];
        if(empty($logisticsOrder)){
            throw new Exception("logisticsOrder exception",$this->exception['B0002']);
        }
        $taobaoLogisticsId = $logisticsOrder['taobaoLogisticsId'];
        if(empty($taobaoLogisticsId)){
            throw new Exception("taobaoLogisticsId exception",$this->exception['B0002']);
        }
        $tmLogisticCondition = array(
            'taobaoLogisticsId'=>$taobaoLogisticsId
        );
        $count = Service_TmLogisticOrder::getByCondition($tmLogisticCondition,'count(*)');
        if($count<=0){
            throw new Exception("taobaoLogisticsId not exists",$this->exception['S12']);
        }else{
            $logisticOrder = Service_TmLogisticOrder::getByField($taobaoLogisticsId,'taobaoLogisticsId');
            $logisticsCode = array(
                'STOCKOUT',
                'ACCEPT'
            );
            if(in_array($logisticsOrder['logisticsCode'],$logisticsCode)){
                throw new Exception("can't refund",$this->exception['S12']);
            }
        }
    }
    /**
     * @author william-fan
     * @todo 校验对仓异议
     */
    public function validatorDissentOrder($eventBody){
        $logisticsDetail = $eventBody['logisticsDetail'];
        if(empty($logisticsDetail)){
            throw new Exception("logisticsDetail exception",$this->exception['B0002']);
        }
        $logisticsOrders = $logisticsDetail['logisticsOrders'];
        if(empty($logisticsOrders)){
            throw new Exception("logisticsDetail exception",$this->exception['B0002']);
        }
        $logisticsOrder = $logisticsOrders['logisticsOrder'];
        if(empty($logisticsOrder)){
            throw new Exception("logisticsOrder exception",$this->exception['B0002']);
        }
        $taobaoLogisticsId = $logisticsOrder['taobaoLogisticsId'];
        if(empty($taobaoLogisticsId)){
            throw new Exception("taobaoLogisticsId exception",$this->exception['B0002']);
        }
        $tmLogisticCondition = array(
            'taobaoLogisticsId'=>$taobaoLogisticsId
        );
        $count = Service_TmLogisticOrder::getByCondition($tmLogisticCondition,'count(*)');
        if($count<=0){
            throw new Exception("taobaoLogisticsId not exists",$this->exception['S12']);
        }else{
            $logisticOrder = Service_TmLogisticOrder::getByField($taobaoLogisticsId,'taobaoLogisticsId');
            $order = Service_TmOrders::getByField($logisticOrder['order_code'],'order_code');
            $orderStatus = array(
                '6',
            );
            if(!in_array($order['order_status'],$orderStatus)){
                throw new Exception("Dissent of order cannot be requested until the warehouse has weighed the goods.",$this->exception['S12']);
            }
        }
    }
    /**
     * @author william-fan
     * @todo 用于校验数据的安全性(签名是否正常)
     */
    public function validatorSafe(){
        //签名
        $error = array();
        $logistics_interface = $this->param['logistics_interface']; //加密的报文(菜鸟目前没有加密)
        $decodeLogistics_interface = $logistics_interface;

        $this->baowen = $decodeLogistics_interface; //报文信息

        $mdString=md5($decodeLogistics_interface.$this->cainiao_public_key);
        $asring = pack('H*',$mdString);

        $jisuan = base64_encode($asring);
        //file_put_contents($this->param['msg_id'].'-报文.txt',var_export($decodeLogistics_interface,true));
        //file_put_contents($this->param['msg_id'].'-秘钥.txt',var_export($jisuan,true));
        if($jisuan!=$this->param['data_digest']){
            $error[] = 'Signature error!';
        }
        if(!trim($this->param['msg_id'])){
            //$error[] = 'msg_id is empty';
        }
        if(!trim($this->param['msg_type'])){
            $error[] = 'msg_type is empty';
        }
        $this->error = array_merge($error,$this->error);
    }
    /**
     * @author william-fan
     * @todo 订单接口(下发订单报文信息指令给海外CP)
     */
    public function OWCreateOrderService($request){
        $logistics_interface = $request['logistics_interface'];
        $data_digest = $request['data_digest'];
        $msg_type = $request['msg_type'];
        $msg_id = $request['msg_id'];

        $paramArr['logistics_interface'] = $logistics_interface;
        $paramArr['data_digest'] = $data_digest;
        $paramArr['msg_type'] = $msg_type;
        $paramArr['msg_id'] = $msg_id;

        $this->setParam($paramArr);

        //print_r($paramArr);

        $this->validator();
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>''
        );

        //写调用信息
        $amobj = new Service_ApiMessage();
        $apiRow = array(
            'api_type'=>'receive',
            'api_name'=>'OWCreateOrderService',
            'api_caller'=>'cainiao',
            'ref_cus_code'=>$msg_id,
            'add_date'=>date('Y-m-d H:i:s',time()),
            'data_digest'=>$data_digest,
            'msg_type'=>$msg_type
        );
        if($this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']!=''){
            $apiRow['refer_code'] = $this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
        }

        $am_id = $amobj->createApiMessageProcess($apiRow,$logistics_interface,'order');
        $this->am_id = $am_id;
        if(!empty($this->error)){
            $result['error'] = $this->error;
            $cainiaoResult = $this->getCainiaoResult($result);
            return $cainiaoResult;
        }else{
            //无错误接收订单
            //print_r($this->baowenObj);
            $eventHeader = $this->baowenArr['logisticsEvent']['eventHeader'];

            $eventBody = $this->baowenArr['logisticsEvent']['eventBody'];
            $this->validatorOrder($eventBody);
            if($this->return=='1'){
                $result['ask'] = '1';
                $upapiMessageRow = array(
                    'am_status'=>'1',
                    'am_message'=>'系统已存在'.$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']
                );
                $updateResult = $amobj->update($upapiMessageRow,$this->am_id);
                $cainiaoResult = $this->getCainiaoResult($result);
                return $cainiaoResult;
            }

            $baohongResult = $this->OWCreateOrderServiceToBaohong($eventHeader,$eventBody);
            /*echo "baohongResult";
            print_r($baohongResult);*/
            if($baohongResult['ask']=='1'){
                //保宏接收订单
                $upapiMessageRow = array(
                    'am_status'=>'1',
                    'am_message'=>$baohongResult['message']
                );
                $updateResult = $amobj->update($upapiMessageRow,$this->am_id);
            }else{
                //保宏存储不成功,不发ewe
                $upapiMessageRow = array(
                    'am_status'=>'0',
                    'am_message'=>$baohongResult['message']
                );
                //var_dump($this->am_id);
                $updateResult = $amobj->update($upapiMessageRow,$this->am_id);
                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }
            //$this->tongbu = false;
            if($this->tongbu){
                //同步发给ewe
                $eweResult = $this->OWCreateOrderServiceToEwe($eventHeader,$eventBody);
                if($eweResult['ask']=='1'){
                    $upapiMessageRow = array(
                        'am_status'=>'2',
                        'am_ewe_message'=>$eweResult['message']
                    );
                    $amobj->update($upapiMessageRow,$this->am_id);
                }else{
                    $upapiMessageRow = array(
                        'am_ewe_message'=>$eweResult['errorCode'].":".$eweResult['message']
                    );
                    $amobj->update($upapiMessageRow,$this->am_id);
                }
                //print_r($eweResult);
                $cainiaoResult = $this->getCainiaoResult($eweResult);
                return $cainiaoResult;
            }else{
                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }
        }
    }

    /**
     * @author william-fan
     * @todo 用于处理菜鸟的订单到保宏
     */
    public function OWCreateOrderServiceToBaohong($eventHeader,$eventBody){
        $result = array("ask"=>0,"message"=>"");
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try{
            $this->validatorOrder($eventBody);
            /*echo "<pre>";
            print_r($eventBody);*/
            $paid = $eventBody['paymentDetail']['paid'];
            if(empty($paid)){
                throw new Exception('paid exception ',$this->exception['S12']);
            }
            //exit;
            $tradeDetail = $eventBody['tradeDetail'];
            if(empty($tradeDetail)){
                throw new Exception('tradeDetail exception',$this->exception['S12']);
            }
            $tradeOrders = $tradeDetail['tradeOrders'];
            if(empty($tradeOrders)){
                throw new Exception('tradeOrders exception',$this->exception['S12']);
            }

            $logisticsDetail = $eventBody['logisticsDetail'];
            if(empty($logisticsDetail)){
                throw new Exception("logisticsDetail exception",$this->exception['S12']);
            }

            $logisticsOrders = $logisticsDetail['logisticsOrders'];
            if(empty($logisticsOrders)){
                throw new Exception("logisticsOrders exception",$this->exception['S12']);
            }

            $logisticEventRow['eventType'] = $eventHeader['eventType'];
            $logisticEventRow['eventTime'] = $eventHeader['eventTime'];
            $logisticEventRow['eventSource'] = $eventHeader['eventSource'];
            $logisticEventRow['eventTarget'] = $eventHeader['eventTarget'];
            //print_r($logisticEventRow);
            //tm_logistic_event
            $tle_id = Service_TmLogisticEvent::add($logisticEventRow);
            if(!$tle_id){
                throw new Exception("Add the event error",$this->exception['S13']);
            }

            $tradeOrder = $tradeOrders['tradeOrder'];
            if(empty($tradeOrder)){
                throw new Exception("tradeOrder exception",$this->exception['S12']);
            }

            $logisticsOrder = $logisticsOrders['logisticsOrder'];
            if(empty($logisticsOrder)){
                throw new Exception("logisticsOrder exception",$this->exception['S13']);
            }
            if($logisticsOrder['taobaoLogisticsId']==''){
                throw new Exception("taobaoLogisticsId is empty",$this->exception['S13']);
            }
            //tm_orders(不止一个循环)
            foreach($tradeOrders as $key=>$tradeOrder){
                $tmOrdersRow['tle_id'] = $tle_id;
                $tmOrdersRow['customer_code'] = $this->customerCode;
                $ordersCode = Common_GetNumbers::getCode('order', $this->customerCode, 'SO');
                $tmOrdersRow['order_code'] = $ordersCode;
                $tmOrdersRow['warehouse_id'] = $this->warehouse_id;
                $tmOrdersRow['tradeOrderId'] = $tradeOrder['tradeOrderId'];
                $tmOrdersRow['tradeOrderValue'] = $paid['tradeOrderValue'];
                $tmOrdersRow['tradeOrderValueUnit'] = isset($paid['tradeOrderValueUnit'])?$paid['tradeOrderValueUnit']:'';
                $tmOrdersRow['totalShippingFee'] = isset($paid['totalShippingFee'])?$paid['totalShippingFee']:'0.00';
                $tmOrdersRow['totalShippingFeeUnit'] = isset($paid['totalShippingFeeUnit'])?$paid['totalShippingFeeUnit']:'';
                $tmOrdersRow['payableWeight'] = isset($paid['payableWeight'])?$paid['payableWeight']:'0.00';
                $tmOrdersRow['tradeRemark'] = isset($tradeOrder['tradeRemark'])?$tradeOrder['tradeRemark']:'';
                $tmOrdersRow['add_time'] = date("Y-m-d H:i:s",time());
                $tmOrdersRow['taobaoLogisticsId'] = isset($logisticsOrder['taobaoLogisticsId'])?$logisticsOrder['taobaoLogisticsId']:'';
                $tmo_id = Service_TmOrders::add($tmOrdersRow);
                if(!$tmo_id){
                    throw new Exception("data add exception",$this->exception['S07']);
                }
            }



            $buyer = $tradeOrder['buyer'];
            if(empty($buyer)){
                throw new Exception("tradeOrder exception",$this->exception['S13']);
            }
            //tm_order_address_book（订单收件人）
            $tmOrderAddressBookRow['order_code'] = $ordersCode;
            $tmOrderAddressBookRow['wangwangId'] = isset($buyer['wangwangId'])?$buyer['wangwangId']:'';
            $tmOrderAddressBookRow['name'] = isset($buyer['name'])?$buyer['name']:'';
            $tmOrderAddressBookRow['phone'] = isset($buyer['phone'])?$buyer['phone']:'';
            $tmOrderAddressBookRow['mobile'] = isset($buyer['mobile'])?$buyer['mobile']:'';
            $tmOrderAddressBookRow['phone'] = isset($buyer['phone'])?$buyer['phone']:'';
            $tmOrderAddressBookRow['email'] = isset($buyer['email'])?$buyer['email']:'';
            $tmOrderAddressBookRow['country'] = isset($buyer['country'])?$buyer['country']:'';
            $tmOrderAddressBookRow['province'] = isset($buyer['province'])?$buyer['province']:'';
            $tmOrderAddressBookRow['city'] = isset($buyer['city'])?$buyer['city']:'';
            $tmOrderAddressBookRow['district'] = isset($buyer['district'])?$buyer['district']:'';
            $tmOrderAddressBookRow['streetAddress'] = isset($buyer['streetAddress'])?$buyer['streetAddress']:'';
            $tmOrderAddressBookRow['zipCode'] = isset($buyer['zipCode'])?$buyer['zipCode']:'';
            $tmOrderAddressBookRow['identityNumber'] = isset($buyer['identityNumber'])?$buyer['identityNumber']:'';
            $tmOrderAddressBookRow['oab_type'] = '0';
            //exit;
            $tmoab_id = Service_TmOrderAddressBook::add($tmOrderAddressBookRow);
            if(!$tmoab_id){
                throw new Exception("data add exception",$this->exception['S07']);
            }
            /*$db->rollback();
            exit('sss');*/

            $items = $tradeOrder['items'];
            if(empty($items)){
                throw new Exception("items exception",$this->exception['S13']);
            }

            //tm_order_product
            foreach($items as $key=>$item){
                $tmOrderProductRow['order_code'] = $ordersCode;
                $tmOrderProductRow['itemId'] = isset($item['itemId'])?$item['itemId']:'';

                $tmOrderProductRow['itemName'] = isset($item['itemName'])?$item['itemName']:'';
                $tmOrderProductRow['itemCategoryName'] = isset($item['itemCategoryName'])?$item['itemCategoryName']:'';
                $tmOrderProductRow['itemUnitPrice'] = isset($item['itemUnitPrice'])?$item['itemUnitPrice']:'';
                $tmOrderProductRow['itemQuantity'] = isset($item['itemQuantity'])?$item['itemQuantity']:0;
                $tmOrderProductRow['itemRemark'] = isset($item['itemRemark'])?$item['itemRemark']:'';

                $top_id = Service_TmOrderProduct::add($tmOrderProductRow);
                if(!$top_id){
                    throw new Exception("data add exception",$this->exception['S07']);
                }
            }



            /*$tmLogisticCondition = array(
                'taobaoLogisticsId'=>
            );
            Service_TmLogisticOrder::getByCondition()*/



            //tm_logistic_order
            $tmLogisticOrderRow['order_code'] = $ordersCode;
            $tmLogisticOrderRow['segmentCode'] = isset($logisticsOrder['segmentCode'])?$logisticsOrder['segmentCode']:'';
            $tmLogisticOrderRow['carrierCode'] = isset($logisticsOrder['carrierCode'])?$logisticsOrder['carrierCode']:'';
            $tmLogisticOrderRow['itemsIncluded'] = isset($logisticsOrder['itemsIncluded'])?$logisticsOrder['itemsIncluded']:'';
            $tmLogisticOrderRow['taobaoLogisticsId'] = isset($logisticsOrder['taobaoLogisticsId'])?$logisticsOrder['taobaoLogisticsId']:'';
            $tmLogisticOrderRow['occurTime'] = isset($logisticsOrder['occurTime'])?$logisticsOrder['occurTime']:'';
            $tmLogisticOrderRow['mailNo'] = isset($logisticsOrder['mailNo'])?$logisticsOrder['mailNo']:'';
            $tmLogisticOrderRow['logisticsRemark'] = isset($logisticsOrder['logisticsRemark'])?$logisticsOrder['logisticsRemark']:'';
            $tmLogisticOrderRow['customCode'] = isset($logisticsOrder['customCode'])?$logisticsOrder['customCode']:'';
            $tmLogisticOrderRow['customName'] = isset($logisticsOrder['customName'])?$logisticsOrder['customName']:'';
            $tmLogisticOrderRow['customContact'] = isset($logisticsOrder['customContact'])?$logisticsOrder['customContact']:'';


            $tlo_id = Service_TmLogisticOrder::add($tmLogisticOrderRow);
            if(!$tlo_id){
                throw new Exception("data add exception",$this->exception['S07']);
            }

            //tm_order_log
            $tmOrderLogRow['order_code'] = $ordersCode;
            $tmOrdersRow['order_status_from'] = '1';
            $tmOrdersRow['order_status_to'] = '1';
            $tmOrdersRow['ol_comments'] = '保宏接收菜鸟订单';

            $tmo_id = Service_TmOrderLog::add($tmOrderLogRow);
            if(!$tmo_id){
                throw new Exception("data add exception",$this->exception['S07']);
            }

            //tm_order_address_book（海外仓地址）
            $receiverDetail = $logisticsOrder['receiverDetail'];
            if(!empty($receiverDetail)){
                $tmOrderAddressBookRow['order_code'] = $ordersCode;
                $tmOrderAddressBookRow['code'] = isset($receiverDetail['code'])?$receiverDetail['code']:'';
                $tmOrderAddressBookRow['wangwangId'] = isset($receiverDetail['wangwangId'])?$receiverDetail['wangwangId']:'';
                $tmOrderAddressBookRow['name'] = isset($receiverDetail['name'])?$receiverDetail['name']:'';
                $tmOrderAddressBookRow['phone'] = isset($receiverDetail['phone'])?$receiverDetail['phone']:'';
                $tmOrderAddressBookRow['mobile'] = isset($receiverDetail['mobile'])?$receiverDetail['mobile']:'';
                $tmOrderAddressBookRow['phone'] = isset($receiverDetail['phone'])?$receiverDetail['phone']:'';
                $tmOrderAddressBookRow['email'] = isset($receiverDetail['email'])?$receiverDetail['email']:'';
                $tmOrderAddressBookRow['country'] = isset($receiverDetail['country'])?$receiverDetail['country']:'';
                $tmOrderAddressBookRow['province'] = isset($receiverDetail['province'])?$receiverDetail['province']:'';
                $tmOrderAddressBookRow['city'] = isset($receiverDetail['city'])?$receiverDetail['city']:'';
                $tmOrderAddressBookRow['district'] = isset($receiverDetail['district'])?$receiverDetail['district']:'';
                $tmOrderAddressBookRow['streetAddress'] = isset($receiverDetail['streetAddress'])?$receiverDetail['streetAddress']:'';
                $tmOrderAddressBookRow['zipCode'] = isset($receiverDetail['zipCode'])?$receiverDetail['zipCode']:'';
                $tmOrderAddressBookRow['oab_type'] = '2';

                $tmoab_id = Service_TmOrderAddressBook::add($tmOrderAddressBookRow);
                if(!$tmoab_id){
                    throw new Exception("data add exception",$this->exception['S07']);
                }

            }

            //tm_order_address_book（发货人详情）
            if(isset($logisticsOrder['senderDetail'])){
                $senderDetail = $logisticsOrder['senderDetail'];
                $tmOrderAddressBookRow['order_code'] = $ordersCode;
                $tmOrderAddressBookRow['wangwangId'] = isset($senderDetail['wangwangId'])?$senderDetail['wangwangId']:'';
                $tmOrderAddressBookRow['name'] = isset($senderDetail['name'])?$senderDetail['name']:'';
                $tmOrderAddressBookRow['phone'] = isset($senderDetail['phone'])?$senderDetail['phone']:'';
                $tmOrderAddressBookRow['mobile'] = isset($senderDetail['mobile'])?$senderDetail['mobile']:'';
                $tmOrderAddressBookRow['phone'] = isset($senderDetail['phone'])?$senderDetail['phone']:'';
                $tmOrderAddressBookRow['email'] = isset($senderDetail['email'])?$senderDetail['email']:'';
                $tmOrderAddressBookRow['country'] = isset($senderDetail['country'])?$senderDetail['country']:'';
                $tmOrderAddressBookRow['province'] = isset($senderDetail['province'])?$senderDetail['province']:'';
                $tmOrderAddressBookRow['city'] = isset($senderDetail['city'])?$senderDetail['city']:'';
                $tmOrderAddressBookRow['district'] = isset($senderDetail['district'])?$senderDetail['district']:'';
                $tmOrderAddressBookRow['streetAddress'] = isset($senderDetail['streetAddress'])?$senderDetail['streetAddress']:'';
                $tmOrderAddressBookRow['zipCode'] = isset($senderDetail['zipCode'])?$senderDetail['zipCode']:'';
                $tmOrderAddressBookRow['oab_type'] = '1';

                $tmoab_id = Service_TmOrderAddressBook::add($tmOrderAddressBookRow);
                if(!$tmoab_id){
                    throw new Exception("data add exception",$this->exception['S07']);
                }
            }
            $result['ask']='1';
            $db->commit();
            //$db->rollback();
        }catch(Exception $e){
            $db->rollback();
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
        }
        return $result;
    }
    /**
     * @author william-fan
     * @todo 用于将菜鸟传到保宏的订单传到ewe
     */
    public function OWCreateOrderServiceToEwe($eventHeader,$eventBody,$am_id=''){
        $result = array("ask"=>'0',"message"=>"");
        try{
            //$wsdl =$this->get_wsdl();
            $client = new SoapClient($this->eweWsdl);
            //$client = new SoapClient($wsdl, array('location' => "http://www.everfast.com.au/EweBaohong/BaohongService.svc"));

            $paragram['xml'] = $this->baowen;
            $paragram['partnerCode'] = $this->partnerCode;
            //file_put_contents('xml.xml',$this->baowen);
            //$this->eweSalt.$eventHeader['eventTime'].$this->partnerCode;
            $md5string =md5($this->eweSalt.$eventHeader['eventTime'].$this->partnerCode);
            $asring = pack('H*',$md5string);

            $digist = base64_encode($asring);

            $paragram['digest'] = $digist;

            $owresult  = $client->OWRequest($paragram);
            $owresult = Common_Common::objectToArray($owresult);
            if(!empty($am_id)){
                $this->am_id = $am_id;
            }
            if(!isset($owresult['OWRequestResult']['IsError'])){
                throw new Exception('Network timeout',$this->exception['S17']);
            }
            if($owresult['OWRequestResult']['IsError']){
                $errorCode = $owresult['OWRequestResult']['ErrorCode'];
                $amobj = new Service_ApiMessage();
                $amRow = Service_ApiMessage::getByField($this->am_id,"am_id","*");
                $sendCount = $amRow['send_count']+1;
                $upapiMessageRow = array(
                    'am_ewe_message'=>$errorCode.":".$owresult['OWRequestResult']['Message'],
                    'send_count'=>$sendCount
                );
                if($sendCount>=3){
                    $upapiMessageRow['am_status'] = '2';
                }
                $amobj->update($upapiMessageRow,$this->am_id);
                throw new Exception($owresult['OWRequestResult']['Message'],$this->exception[$errorCode]);
            }else{
                 $amobj = new Service_ApiMessage();
                 //EWE接单
                 $upapiMessageRow = array(
                      'am_status'=>'2'
                 );
                 $amobj->update($upapiMessageRow,$this->am_id);
                 $result['ask'] = '1';
            }
        }catch(Exception $e){
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
        }
        return $result;
    }

    /**
     * @author william-fan
     * @todo 用于取消订单
     */
    public function OWCancelOrderService($request){
        $logistics_interface = $request['logistics_interface'];
        $data_digest = $request['data_digest'];
        $msg_type = $request['msg_type'];
        $msg_id = $request['msg_id'];

        $paramArr['logistics_interface'] = $logistics_interface;
        $paramArr['data_digest'] = $data_digest;
        $paramArr['msg_type'] = $msg_type;
        $paramArr['msg_id'] = $msg_id;
        //echo "<pre>";
        //LOGISTICS_CANCEL

        $this->setParam($paramArr);
        /*echo "<pre>";
        //print_r($paramArr);
        print_r($this->param);*/
        $this->validator();
        //print_r($this->baowenArr);
        //var_dump($this->baowen);
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>''
        );
        if(!empty($this->error)){
            $result['error'] = $this->error;
            $cainiaoResult = $this->getCainiaoResult($result);
            return $cainiaoResult;
        }else{

            //写调用信息
            $amobj = new Service_ApiMessage();
            $apiRow = array(
                'api_type'=>'receive',
                'api_name'=>'OWCancelOrderService',
                'api_caller'=>'cainiao',
                'ref_cus_code'=>$msg_id,
                'add_date'=>date('Y-m-d H:i:s',time()),
                'data_digest'=>$data_digest,
                'ref_cus_code'=>$msg_id,
                'am_status'=>'1',
                'msg_type'=>$msg_type
            );

            if($this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']!=''){
                //
                $apiRow['refer_code'] = $this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            }

            $am_id = $amobj->createApiMessageProcess($apiRow,$logistics_interface,'order_cancel');
            $this->am_id = $am_id;
            //var_dump($am_id);exit;
            if($this->tongbu){
                //无错误接收订单
                //print_r($this->baowenObj);
                $eventHeader = $this->baowenArr['logisticsEvent']['eventHeader'];

                $eventBody = $this->baowenArr['logisticsEvent']['eventBody'];

                $baohongResult = $this->OWCancelOrderServiceToEwe($eventHeader,$eventBody);

                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }else{
                if($am_id){
                    $result['ask'] = '1';
                }
                $cainiaoResult = $this->getCainiaoResult($result);
            }
            return $cainiaoResult;
        }
    }
    /**
     * @author william-fan
     * @todo 用于向EWE发送取消订单信息
     */
    public function OWCancelOrderServiceToEwe($eventHeader,$eventBody,$am_id=''){
        $result = array(
            'ask'=>'0',
            'message'=>'cancel failse'
        );
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try{
            $this->validatorCancelOrder($eventBody);
            $tradeDetail = $eventBody['tradeDetail'];

            $logisticId = $eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            $tmOrders = Service_TmOrders::getByField($logisticId,'taobaoLogisticsId');
            if(empty($tmOrders)){
                throw new Exception("taobaoLogisticsId not exists",$this->exception['S12']);
            }
            if($tmOrders['order_status']=='0' && $tmOrders['problem_status']=='2'){
                $result['ask'] = '1';
                $result['message'] = 'this order have cancel';
                $db->rollback();
                $amobj = new Service_ApiMessage();
                $upapiMessageRow = array(
                    'am_status'=>'2',
                );
                if(!empty($this->am_id)){
                    $amobj->update($upapiMessageRow,$this->am_id);
                }else{
                    $amobj->update($upapiMessageRow,$am_id);
                }
                return $result;
            }

            //这里调用ewe接口传数据给取消定案ewe

            $client = new SoapClient($this->eweWsdl);

            $paragram['xml'] = $this->baowen;
            $paragram['partnerCode'] = $this->partnerCode;
            //file_put_contents('xml.xml',$this->baowen);
            //$this->eweSalt.$eventHeader['eventTime'].$this->partnerCode;
            $md5string =md5($this->eweSalt.$eventHeader['eventTime'].$this->partnerCode);
            $asring = pack('H*',$md5string);

            $digist = base64_encode($asring);

            $paragram['digest'] = $digist;

            $owresult  = $client->OWRequest($paragram);
            $owresult = Common_Common::objectToArray($owresult);

            if(!empty($am_id)){
                $this->am_id = $am_id;
            }

            if(!isset($owresult['OWRequestResult']['IsError'])){
                throw new Exception('Network timeout',$this->exception['S17']);
            }

            if($owresult['OWRequestResult']['IsError']){
                $errorCode = $owresult['OWRequestResult']['ErrorCode'];
                $amobj = new Service_ApiMessage();
                $amRow = Service_ApiMessage::getByField($this->am_id,"am_id","*");
                $sendCount = $amRow['send_count']+1;
                $upapiMessageRow = array(
                    'am_ewe_message'=>$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message'],
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'],
                    'send_count'=>$sendCount
                );
                if($sendCount>=3){
                    $upapiMessageRow['am_status'] = '2';
                }
                $amobj->update($upapiMessageRow,$this->am_id);
                //添加日志
                $tmOrderLogRow = array(
                    'order_code'=>$tmOrders['order_code'],
                    'order_status_from'=>$tmOrders['order_status'],
                    'order_status_to'=>$tmOrders['order_status'],
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'调用ewe返回数据：'.$owresult['errorCode'].":".$owresult['message']
                );
                Service_TmOrderLog::add($tmOrderLogRow);
                throw new Exception($owresult['OWRequestResult']['Message'],$this->exception[$errorCode]);
            }else{
                $amobj = new Service_ApiMessage();
                //EWE接单
                $upapiMessageRow = array(
                    'am_status'=>'2',
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']
                );
                $amobj->update($upapiMessageRow,$this->am_id);

                //更新订单状态
                $tmOrdersRow = array(
                    'order_status'=>'0',
                    'problem_status'=>'2',
                    'update_time'=>date("Y-m-d H:i:s")
                );
                Service_TmOrders::update($tmOrdersRow,$tmOrders['order_code'],'order_code');
                //添加日志
                $tmOrderLogRow = array(
                    'order_code'=>$tmOrders['order_code'],
                    'order_status_from'=>$tmOrders['order_status'],
                    'order_status_to'=>'0',
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'取消订单'
                );
                Service_TmOrderLog::add($tmOrderLogRow);

                $result['ask'] = '1';
            }
            $db->commit();
        }catch (Exception $e){
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
            $db->rollback();
        }
        return $result;
    }
    /**
     * @author william-fan
     * @todo 用于菜鸟退货信息指令
     */
    public function OWRefundOrderService($request){
        $logistics_interface = $request['logistics_interface'];
        $data_digest = $request['data_digest'];
        $msg_type = $request['msg_type'];
        $msg_id = $request['msg_id'];

        $paramArr['logistics_interface'] = $logistics_interface;
        $paramArr['data_digest'] = $data_digest;
        $paramArr['msg_type'] = $msg_type;
        $paramArr['msg_id'] = $msg_id;

        //LOGISTICS_CANCEL

        $this->setParam($paramArr);
        /*echo "<pre>";
        //print_r($paramArr);
        print_r($this->param);*/
        $this->validator();
        //print_r($this->baowenArr);
        //var_dump($this->baowen);
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>''
        );
        if(!empty($this->error)){
            $result['error'] = $this->error;
            $cainiaoResult = $this->getCainiaoResult($result);
            return $cainiaoResult;
        }else{

            //写调用信息
            $amobj = new Service_ApiMessage();
            $apiRow = array(
                'api_type'=>'receive',
                'api_name'=>'OWRefundOrderService',
                'api_caller'=>'cainiao',
                'ref_cus_code'=>$msg_id,
                'add_date'=>date('Y-m-d H:i:s',time()),
                'data_digest'=>$data_digest,
                'ref_cus_code'=>$msg_id,
                'am_status'=>'1',
                'msg_type'=>$msg_type
            );

            if($this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']!=''){
                $apiRow['refer_code'] = $this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            }

            $am_id = $amobj->createApiMessageProcess($apiRow,$logistics_interface,'order_refund');
            $this->am_id = $am_id;

            if($this->tongbu){
                //无错误接收订单
                //print_r($this->baowenObj);
                $eventHeader = $this->baowenArr['logisticsEvent']['eventHeader'];

                $eventBody = $this->baowenArr['logisticsEvent']['eventBody'];

                $baohongResult = $this->OWRefundOrderServiceToEwe($eventHeader,$eventBody);

                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }else{
                if($am_id){
                    $result['ask'] = '1';
                }
                $cainiaoResult = $this->getCainiaoResult($result);
            }
            return $cainiaoResult;
        }
    }
    /**
     * @author william-fan
     * @todo 用于向EWE发退货信息指令
     */
    public function OWRefundOrderServiceToEwe($eventHeader,$eventBody,$am_id=''){
        $result = array(
            'ask'=>'0',
            'message'=>''
        );
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try{
            $this->validatorRefundOrder($eventBody);
            $tradeDetail = $eventBody['tradeDetail'];

            $logisticId = $eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            $tmOrders = Service_TmOrders::getByField($logisticId,'taobaoLogisticsId');
            if(empty($tmOrders)){
                throw new Exception("taobaoLogisticsId not exists",$this->exception['S12']);
            }
            if($tmOrders['order_status']=='0' && $tmOrders['problem_status']=='3'){
                $result['ask'] = '1';
                $result['message'] = 'this order have refund';
                $db->rollback();
                $amobj = new Service_ApiMessage();
                $upapiMessageRow = array(
                    'am_status'=>'2',
                );
                if(!empty($this->am_id)){
                    $amobj->update($upapiMessageRow,$this->am_id);
                }else{
                    $amobj->update($upapiMessageRow,$am_id);
                }
                return $result;
            }

            /*if($tmOrders['order_status']==''){
                throw new Exception("");
            }*/
            //这里调用ewe接口传数据给取消定案ewe

            $client = new SoapClient($this->eweWsdl);

            $paragram['xml'] = $this->baowen;
            $paragram['partnerCode'] = $this->partnerCode;
            //file_put_contents('xml.xml',$this->baowen);
            //$this->eweSalt.$eventHeader['eventTime'].$this->partnerCode;
            $md5string =md5($this->eweSalt.$eventHeader['eventTime'].$this->partnerCode);
            $asring = pack('H*',$md5string);

            $digist = base64_encode($asring);

            $paragram['digest'] = $digist;

            $owresult  = $client->OWRequest($paragram);
            $owresult = Common_Common::objectToArray($owresult);

            if(!empty($am_id)){
                $this->am_id = $am_id;
            }

            if(!isset($owresult['OWRequestResult']['IsError'])){
                throw new Exception('Network timeout',$this->exception['S17']);
            }

            if($owresult['OWRequestResult']['IsError']){
                $errorCode = $owresult['OWRequestResult']['ErrorCode'];
                $amobj = new Service_ApiMessage();
                $amRow = Service_ApiMessage::getByField($this->am_id,"am_id","*");
                $sendCount = $amRow['send_count']+1;
                $upapiMessageRow = array(
                    'am_ewe_message'=>$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message'],
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'],
                    'send_count'=>$sendCount
                );
                if($sendCount>=3){
                    $upapiMessageRow['am_status'] = '2';
                }
                $amobj->update($upapiMessageRow,$this->am_id);
                $tmOrderLogRow = array(
                    'order_code'=>$tmOrders['order_code'],
                    'order_status_from'=>$tmOrders['order_status'],
                    'order_status_to'=>$tmOrders['order_status'],
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'调用ewe返回数据：'.$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message']
                );
                Service_TmOrderLog::add($tmOrderLogRow);
                throw new Exception($owresult['OWRequestResult']['Message'],$this->exception[$errorCode]);
            }else{
                $amobj = new Service_ApiMessage();
                //EWE接单
                $upapiMessageRow = array(
                    'am_status'=>'2',
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']
                );
                $amobj->update($upapiMessageRow,$this->am_id);

                //更新订单状态
                $tmOrdersRow = array(
                    'order_status'=>'0',
                    'problem_status'=>'3',
                    'update_time'=>date("Y-m-d H:i:s")
                );
                Service_TmOrders::update($tmOrdersRow,$tmOrders['order_code'],'order_code');
                //添加日志
                $tmOrderLogRow = array(
                    'order_code'=>$tmOrders['order_code'],
                    'order_status_from'=>$tmOrders['order_status'],
                    'order_status_to'=>'0',
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'取消订单'
                );
                Service_TmOrderLog::add($tmOrderLogRow);

                $result['ask'] = '1';
            }
            $db->commit();
        }catch (Exception $e){
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
            $db->rollback();
        }
        return $result;
    }
    /**
     * @author william-fan
     * @todo 对仓异议信息
     */
    public function OWDissentOrderService($request){
        $logistics_interface = $request['logistics_interface'];
        $data_digest = $request['data_digest'];
        $msg_type = $request['msg_type'];
        $msg_id = $request['msg_id'];

        $paramArr['logistics_interface'] = $logistics_interface;
        $paramArr['data_digest'] = $data_digest;
        $paramArr['msg_type'] = $msg_type;
        $paramArr['msg_id'] = $msg_id;

        //LOGISTICS_CANCEL

        $this->setParam($paramArr);
        /*echo "<pre>";
        //print_r($paramArr);
        print_r($this->param);*/
        $this->validator();
        //print_r($this->baowenArr);
        //var_dump($this->baowen);
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>''
        );
        if(!empty($this->error)){
            $result['error'] = $this->error;
            $cainiaoResult = $this->getCainiaoResult($result);
            return $cainiaoResult;
        }else{
            //写调用信息
            $amobj = new Service_ApiMessage();
            $apiRow = array(
                'api_type'=>'receive',
                'api_name'=>'OWDissentOrderService',
                'api_caller'=>'cainiao',
                'ref_cus_code'=>$msg_id,
                'add_date'=>date('Y-m-d H:i:s',time()),
                'data_digest'=>$data_digest,
                'ref_cus_code'=>$msg_id,
                'am_status'=>'1',
                'msg_type'=>$msg_type
            );

            if($this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']!=''){
                $apiRow['refer_code'] = $this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            }

            $am_id = $amobj->createApiMessageProcess($apiRow,$logistics_interface,'order_dissent');
            $this->am_id = $am_id;

            if($this->tongbu){
                //无错误接收订单
                //print_r($this->baowenObj);
                $eventHeader = $this->baowenArr['logisticsEvent']['eventHeader'];

                $eventBody = $this->baowenArr['logisticsEvent']['eventBody'];

                $baohongResult = $this->OWDissentOrderServiceToEwe($eventHeader,$eventBody);
                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }else{
                if($am_id){
                    $result['ask'] = '1';
                }
                $cainiaoResult = $this->getCainiaoResult($result);
            }
            return $cainiaoResult;
        }

    }
    /**
     * @author william-fan
     * @todo 对仓异议信息传给EWE
     */
    public function OWDissentOrderServiceToEwe($eventHeader,$eventBody,$am_id=''){
        $result = array(
            'ask'=>'0',
            'message'=>''
        );
        try{
            $this->validatorDissentOrder($eventBody);
            $tradeDetail = $eventBody['tradeDetail'];

            //这里调用ewe接口传对仓异议给ewe

            $client = new SoapClient($this->eweWsdl);

            $paragram['xml'] = $this->baowen;
            $paragram['partnerCode'] = $this->partnerCode;
            //file_put_contents('xml.xml',$this->baowen);
            //$this->eweSalt.$eventHeader['eventTime'].$this->partnerCode;
            $md5string =md5($this->eweSalt.$eventHeader['eventTime'].$this->partnerCode);
            $asring = pack('H*',$md5string);

            $digist = base64_encode($asring);

            $paragram['digest'] = $digist;

            $owresult  = $client->OWRequest($paragram);
            $owresult = Common_Common::objectToArray($owresult);

            if(!empty($am_id)){
                $this->am_id = $am_id;
            }

            if(!isset($owresult['OWRequestResult']['IsError'])){
                throw new Exception('Network timeout',$this->exception['S17']);
            }

            if($owresult['OWRequestResult']['IsError']){
                $errorCode = $owresult['OWRequestResult']['ErrorCode'];
                $amobj = new Service_ApiMessage();
                $amRow = Service_ApiMessage::getByField($this->am_id,"am_id","*");
                $sendCount = $amRow['send_count']+1;
                $upapiMessageRow = array(
                    'am_ewe_message'=>$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message'],
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'],
                    'send_count'=>$sendCount
                );
                if($sendCount>=3){
                    $upapiMessageRow['am_status'] = '2';
                }
                $amobj->update($upapiMessageRow,$this->am_id);
                throw new Exception($owresult['OWRequestResult']['Message'],$this->exception[$errorCode]);
            }else{
                $amobj = new Service_ApiMessage();
                //EWE接单
                $upapiMessageRow = array(
                    'am_status'=>'2',
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']
                );
                $amobj->update($upapiMessageRow,$this->am_id);
                $result['ask'] = '1';
            }

        }catch (Exception $e){
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
        }
        return $result;
    }
    /**
     * @author william-fan
     * @todo 发货信息指令
     */
    public function OWSendOutOrderService($request){
        $logistics_interface = $request['logistics_interface'];
        $data_digest = $request['data_digest'];
        $msg_type = $request['msg_type'];
        $msg_id = $request['msg_id'];

        $paramArr['logistics_interface'] = $logistics_interface;
        $paramArr['data_digest'] = $data_digest;
        $paramArr['msg_type'] = $msg_type;
        $paramArr['msg_id'] = $msg_id;

        //LOGISTICS_CANCEL

        $this->setParam($paramArr);
        /*echo "<pre>";
        //print_r($paramArr);
        print_r($this->param);*/
        $this->validator();
        //print_r($this->baowenArr);
        //var_dump($this->baowen);
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>''
        );
        if(!empty($this->error)){
            $result['error'] = $this->error;
            $cainiaoResult = $this->getCainiaoResult($result);
            return $cainiaoResult;
        }else{

            //写调用信息
            $amobj = new Service_ApiMessage();
            $apiRow = array(
                'api_type'=>'receive',
                'api_name'=>'OWSendOutOrderService',
                'api_caller'=>'cainiao',
                'ref_cus_code'=>$msg_id,
                'add_date'=>date('Y-m-d H:i:s',time()),
                'data_digest'=>$data_digest,
                'ref_cus_code'=>$msg_id,
                'am_status'=>'1',
                'msg_type'=>$msg_type
            );
            if($this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']!=''){
                $apiRow['refer_code'] = $this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            }
            $am_id = $amobj->createApiMessageProcess($apiRow,$logistics_interface,'order_send');
            $this->am_id = $am_id;

            if($this->tongbu){
                //无错误接收订单
                //print_r($this->baowenObj);
                $eventHeader = $this->baowenArr['logisticsEvent']['eventHeader'];

                $eventBody = $this->baowenArr['logisticsEvent']['eventBody'];

                $baohongResult = $this->OWSendOutOrderServiceToEwe($eventHeader,$eventBody);

                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }else{
                if($am_id){
                    $result['ask'] = '1';
                }
                $cainiaoResult = $this->getCainiaoResult($result);
            }
            return $cainiaoResult;
        }
    }
    /**
     * @author william-fan
     * @todo 发货信息指令传给EWE
     */
    public function OWSendOutOrderServiceToEwe($eventHeader,$eventBody,$am_id=''){
        //调用ewewebservice
        $result = array(
            'ask'=>'0',
            'message'=>'send '
        );
        $db = Common_Common::getAdapter();
        $db->beginTransaction();
        try{
            $this->validatorRefundOrder($eventBody);
            $tradeDetail = $eventBody['tradeDetail'];

            $logisticId = $eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            $tmOrders = Service_TmOrders::getByField($logisticId,'taobaoLogisticsId');
            if(empty($tmOrders)){
                throw new Exception("taobaoLogisticsId not exists",$this->exception['S12']);
            }
            if($tmOrders['order_status']<'6'){
                $result['ask'] = '0';
                $result['message'] = 'this order have not weight';
                $db->rollback();
                return $result;
            }
            if($tmOrders['order_status']>'6'){
                $result['ask'] = '1';
                $result['message'] = 'this order have send out';
                $db->rollback();
                $amobj = new Service_ApiMessage();
                $upapiMessageRow = array(
                    'am_status'=>'2',
                );
                if(!empty($this->am_id)){
                    $amobj->update($upapiMessageRow,$this->am_id);
                }else{
                    $amobj->update($upapiMessageRow,$am_id);
                }
                return $result;
            }

            //这里调用ewe接口传发货信息指令传给EWE

            $client = new SoapClient($this->eweWsdl);

            $paragram['xml'] = $this->baowen;
            $paragram['partnerCode'] = $this->partnerCode;
            //file_put_contents('xml.xml',$this->baowen);
            //$this->eweSalt.$eventHeader['eventTime'].$this->partnerCode;
            $md5string =md5($this->eweSalt.$eventHeader['eventTime'].$this->partnerCode);
            $asring = pack('H*',$md5string);

            $digist = base64_encode($asring);

            $paragram['digest'] = $digist;

            $owresult  = $client->OWRequest($paragram);
            $owresult = Common_Common::objectToArray($owresult);

            if(!empty($am_id)){
                $this->am_id = $am_id;
            }

            if(!isset($owresult['OWRequestResult']['IsError'])){
                throw new Exception('Network timeout',$this->exception['S17']);
            }

            if($owresult['OWRequestResult']['IsError']){
                $errorCode = $owresult['OWRequestResult']['ErrorCode'];
                $amobj = new Service_ApiMessage();
                $amRow = Service_ApiMessage::getByField($this->am_id,"am_id","*");
                $sendCount = $amRow['send_count']+1;
                $upapiMessageRow = array(
                    'am_ewe_message'=>$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message'],
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'],
                    'send_count'=>$sendCount
                );
                if($sendCount>=3){
                    $upapiMessageRow['am_status'] = '2';
                }
                $amobj->update($upapiMessageRow,$this->am_id);
                throw new Exception($owresult['OWRequestResult']['Message'],$this->exception[$errorCode]);
            }else{
                $amobj = new Service_ApiMessage();
                //EWE接单
                $upapiMessageRow = array(
                    'am_status'=>'2',
                    'refer_code'=>$eventBody['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']
                );
                $amobj->update($upapiMessageRow,$this->am_id);

                //更新订单状态
                $tmOrdersRow = array(
                    'order_status'=>'7',
                    'update_time'=>date("Y-m-d H:i:s")
                );
                Service_TmOrders::update($tmOrdersRow,$tmOrders['order_code'],'order_code');
                //添加日志
                $tmOrderLogRow = array(
                    'order_code'=>$tmOrders['order_code'],
                    'order_status_from'=>$tmOrders['order_status'],
                    'order_status_to'=>'7',
                    'ol_add_time'=>date("Y-m-d H:i:s"),
                    'ol_comments'=>'接收发货指令'
                );
                Service_TmOrderLog::add($tmOrderLogRow);
                $db->commit();
                $result['ask'] = '1';
                $result['message'] = 'send order success!';
            }
        }catch (Exception $e){
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
            $db->rollback();
        }
        return $result;
    }
    /**
     * @author william-fan
     * @todo 获取航空干线信息
     */
    public function osTrunkGainMsgService($request){
        $logistics_interface = $request['logistics_interface'];
        $data_digest = $request['data_digest'];
        $msg_type = $request['msg_type'];
        $msg_id = $request['msg_id'];

        $paramArr['logistics_interface'] = $logistics_interface;
        $paramArr['data_digest'] = $data_digest;
        $paramArr['msg_type'] = $msg_type;
        $paramArr['msg_id'] = $msg_id;

        //LOGISTICS_CANCEL

        $this->setParam($paramArr);
        /*echo "<pre>";
        //print_r($paramArr);
        print_r($this->param);*/
        $this->validator();
        //print_r($this->baowenArr);
        //var_dump($this->baowen);
        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>''
        );
        if(!empty($this->error)){
            $result['error'] = $this->error;
            $cainiaoResult = $this->getCainiaoResult($result);
            return $cainiaoResult;
        }else{

            //写调用信息
            $amobj = new Service_ApiMessage();
            $apiRow = array(
                'api_type'=>'receive',
                'api_name'=>'osTrunkGainMsgService',
                'api_caller'=>'cainiao',
                'ref_cus_code'=>$msg_id,
                'add_date'=>date('Y-m-d H:i:s',time()),
                'data_digest'=>$data_digest,
                'ref_cus_code'=>$msg_id,
                'am_status'=>'1',
                'msg_type'=>$msg_type,
                'am_message'=>'success',
            );
            if($this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId']!=''){
                $apiRow['refer_code'] = $this->baowenArr['logisticsEvent']['eventBody']['logisticsDetail']['logisticsOrders']['logisticsOrder']['taobaoLogisticsId'];
            }
            $am_id = $amobj->createApiMessageProcess($apiRow,$logistics_interface,'trunkGain');
            $this->am_id = $am_id;

            if($this->tongbu){
                //无错误接收订单
                //print_r($this->baowenObj);
                $eventHeader = $this->baowenArr['logisticsEvent']['eventHeader'];

                $eventBody = $this->baowenArr['logisticsEvent']['eventBody'];

                $baohongResult = $this->osTrunkGainMsgServiceToEwe($eventHeader,$eventBody);

                $cainiaoResult = $this->getCainiaoResult($baohongResult);
                return $cainiaoResult;
            }else{
                if($am_id){
                    $result['ask'] = '1';
                }
                $cainiaoResult = $this->getCainiaoResult($result);
            }
            return $cainiaoResult;
        }
    }
    /**
     * @author william-fan
     * @todo 航空干线信息传给Ewe
     */
    public function osTrunkGainMsgServiceToEwe($eventHeader,$eventBody,$am_id=''){
        //调用ewewebservice
        $result = array(
            'ask'=>'0',
            'message'=>''
        );
        try{
            $this->validatorRefundOrder($eventBody);
            $tradeDetail = $eventBody['tradeDetail'];

            //这里调用ewe接口传发货信息指令传给EWE

            $client = new SoapClient($this->eweWsdl);

            $paragram['xml'] = $this->baowen;
            $paragram['partnerCode'] = $this->partnerCode;
            //file_put_contents('xml.xml',$this->baowen);
            //$this->eweSalt.$eventHeader['eventTime'].$this->partnerCode;
            $md5string =md5($this->eweSalt.$eventHeader['eventTime'].$this->partnerCode);
            $asring = pack('H*',$md5string);

            $digist = base64_encode($asring);

            $paragram['digest'] = $digist;

            $owresult  = $client->OWRequest($paragram);
            $owresult = Common_Common::objectToArray($owresult);
            if(!empty($am_id)){
                $this->am_id = $am_id;
            }
            if(!isset($owresult['OWRequestResult']['IsError'])){
                throw new Exception('Network timeout',$this->exception['S17']);
            }
            if($owresult['OWRequestResult']['IsError']){
                $errorCode = $owresult['OWRequestResult']['ErrorCode'];
                $amobj = new Service_ApiMessage();
                $amRow = Service_ApiMessage::getByField($this->am_id,"am_id","*");
                $sendCount = $amRow['send_count']+1;
                $upapiMessageRow = array(
                    'am_ewe_message'=>$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message'],
                    'update_date'=>date("Y-m-d H:i:s",time()),
                    'send_count'=>$sendCount
                );
                if($sendCount>=3){
                    $upapiMessageRow['am_status'] = '2';
                }
                $amobj->update($upapiMessageRow,$this->am_id);
                throw new Exception($owresult['OWRequestResult']['Message'],$this->exception[$errorCode]);
            }else{
                $amobj = new Service_ApiMessage();
                //EWE接单
                $upapiMessageRow = array(
                    'am_status'=>'2',
                    'am_ewe_message'=>$owresult['OWRequestResult']['ErrorCode'].":".$owresult['OWRequestResult']['Message']
                );
                $status=$amobj->update($upapiMessageRow,$this->am_id);
                $result['ask'] = '1';
            }

        }catch (Exception $e){
            $result = array("ask"=>0,"message"=>$e->getMessage(),'errorCode'=>$this->getCainiaoErrorCode($e->getCode()));
        }
        return $result;
    }


}