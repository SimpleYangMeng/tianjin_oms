<?php

class Default_SimpleTestController extends Ec_Controller_DefaultAction
{
    protected $_header = null;
    protected $_url = 'http://60.29.211.84:7002/default/api/web';

    public function preDispatch()
    {
        $this->view->errMsg = '';
        $this->tplDirectory = "default/views/test/";
        $this->_header = array(
            'customerCode'=>trim($this->_request->getParam('customerCode','')),
            'appToken'=>trim($this->_request->getParam('appToken','')),
            'appKey'=>trim($this->_request->getParam('appKey','')),
        );
    }
    public function lockAction(){
        Common_CiqReceipt::getInstance('210');
    }

    public function soapAction(){
        $message = 
        array(
            'head'=>
            array(
                'entryid' => '02082016I000000478',
                'ieFlage' => 'I',
                'orderNo' => 'OC0000002475',
                'logisticsNo' => '50002195307885',
                'logisticsCode' => '0208W00021',
                'logisticsName' => '天津天保宏信物流中心有限公司',
                'checkResult' => 'P',
                'checkDate' => '2016-05-04',
                'checkType' => 'A',
                'checkMan' => 'simple',
                'checkOpinion' => '查验放行'
            )
        );
        $messageObject = new Common_Message();
        //生成报文
        $xml = $messageObject->cearteResult($message, 'message');
        //echo $xml;exit;
        try{
            //$client = new SoapClient("http://60.29.211.84:7002/default/xmachine-soap");
            $option = array(
                'soap_version' => SOAP_1_1,
                'trace'        => 1,
            );
            $client = new SoapClient("http://60.29.211.84:7002/default/xmachine-soap");
            /*
            var_dump($client->__getFunctions());
            echo '<hr />';
            var_dump($client->__getTypes());
            echo '<hr />';
            */
            $request = array(
                'checkData'=>$xml
            );
            $res = $client->checkResult($request);
            //$resObj = Common_Common::objectToArray($resObj);
            var_dump($res->return);
        }catch (Exception $e){
            echo $e->getMessage();
            echo '<hr />';
            echo $e->getTraceAsString();
        }
        //var_dump($resObj->result);
    }

    /**
     * @todo 物品清单
     **/
    public function personAction(){
    	$string = 'afsfsd';

        echo $string{1};
        exit;

    	$arr = array(
    			'pim_reference_no'          => '111',          //内部清单编号
    			'declare_ie_port'           => '0213',           //申报口岸
    			'form_type'                 => 'E2A',                 //业务类型
    			'customer_code'             => 'D000000002',             //电商企业代码
    			'enp_name'                  => '河北万千贸易有限公司',                  //电商企业名称
    			'whCode'                    => 'C000000008',     //仓储企业代码
    			'whName'                    => '天津雅马哈电子乐器有限公司',              //仓储企业名称
    			'agent_customer_code'       => 'C000000008',       //申报单位代码
    			'agent_name'                => '天津雅马哈电子乐器有限公司',                //申报单位名称
    			'logistic_customer_code'    => 'W000000003',    //物流企业代码
    			'pay_customer_code'         => 'Z000000003',         //支付企业代码
    			'reference_no'              => 'reference_no',              //客户订单号
    			'log_no'                    => 'log_no',                    //运单号
    			'pay_no'                    => 'pay_no',                    //支付单号
    			'wrap_type'                 => '1',                 //外包装类型
    			'ie_port'                   => '3105',                   //进出口口岸
    			'traf_mode'                 => '5',                 //出入港区运输方式
    			'ship_trade_country'        => 'JP',        //发件人国家
    			'ship_name'                 => '小泉松子',                 //发件人
    			'ship_city'                 => '名古屋',                 //发件人城市
    			'declare_no'                => '张三丰',                //报关员
    			'outset_country_id'         => 'JP',         //启运国
    			'aim_country_name'          => 'CN',          //抵运国家
    			'receive_name'              => 'receive_name',              //收件人姓名
    			'receive_telphone'          => 'receive_telphone',          //收件人电话
    			'receive_country_name'      => 'receive_country_name',      //收件人国家
    			'receive_state'             => 'receive_state',             //州/区域
    			'receive_city'              => 'receive_city',              //收件人城市
    			'receive_id_number'         => '412826198808091618',         //收件人身份证
    			'input_company'             => 'input_company',             //录入单位
    			'agent_address'             => 'agent_address',             //单位地址
    			'agent_post'                => 'agent_post',                //邮编
    			'agent_tel'                 => 'agent_tel',                 //电话
    			'freight'                   => '0',                   //运费
    			'insure_fee'                => '0',                //保费
    			'customs_field'             => 'customs_field',             //监管场所代码
    			'input_no'                  => 'input_no',                  //录入员
    			'net_wt'                    => '1',                    //净重
    			'gross_wt'                  => '0.8',                  //毛重
    			'pack_no'                   => '1',                   //件数
    			'i_e_date'                  => '2015-12-18',                  //进出境日期
    			'input_date'                => '2015-12-18',                //录入时间
    			'declare_date'              => '2015-12-18',              //申报日期
    			'note'                      => 'note',                      //备注
    			'product'                   => 'product',               //产品信息
    			'account_code'              => 'account_code',
    			'account_name'              => 'account_name',
    	);
    	
    	$url = 'http://tianjinoms.baohong.com/default/api-ref/web';
    	$url = $this->_url;

        $data = $this->http_request($this->_url,500,array(),$arr);
        
        print_r($data);
    	
    }

    /**
     * [testAction 顺风调试]
     * @return [type] [description]
     */
    public function testAction(){
        /*
        $data = '{sign=5C1972390C39C724B4C10096B7AF6450, appToken=853183BE5874582A, accountCode=U00001837, signType=MD5, customerCode=0213W001201, 
data={
"logNo":"51020490806968",
"iePort":"0208",
"ieType":"I",
"appType":"1",
"ebpCode":"12",
"referenceNo":"11185310227",
"trafMode":null,
"shipName":null,
"voyageNo":null,
"billNo":111,
"freight":55.00,
"goodsValue":111,
"currencyCode":"RMB",
"insureFee":0.00,
"weight":2.75000,
"netWeight":2.50000,
"packNumber":1,
"parcelInfo":"贵爱娘卫生巾大型 18P",
"goodsInfo":"贵爱娘卫生巾大型 18P",
"consignee":"李丽",
"consigneeCountry":"CN",
"consigneeProvince":"天津",
"consigneeCity":"天津",
"consigneeDistrict":"河西区",
"consigneeAddress":"天津市河西区围堤道",
"consigneeTelephone":"13911112345",
"shipper":"天津港保税区跨境仓库（宏信仓库）",
"shipperAddress":"天津市滨海新区天津港保税区津滨大道185号",
"shipperTelephone":"02225763175",
"shipperCountry":"CN",
"note":"",
"ebpName":"天天希杰",
"logisticsCode":"0208W000001",
"logisticsName":"杭州百世网络技术有限公司天津分公司",
"billProvideSiteName":"BEX天津塘沽分部",
"billProvideSiteCode":"300469",
"markDestination":"津-河西",
"pkgCode":"天津市内包"
}, opType=Add, method=Waybill, version=1.0}';
*/
        $array = array(
            'method' => 'Waybill',
            'opType' => 'Add',
            'customerCode' => '0213W001201',
            'accountCode' => 'U00001837',
            'appToken' => '853183BE5874582A',
            'signType' => 'MD5',
            'sign' => '5C1972390C39C724B4C10096B7AF6450',
            'version' => '1.0',
            /*
            'data' => array(
                "logNo"=>"51020490806968",
                "iePort"=>"0216",
                "ieType"=>"I",
                "appType"=>"1",
                "ebpCode"=>"0216D000002",
                "referenceNo"=>"11185310227",
                "trafMode"=> 1,
                "shipName"=> '汽车',
                "voyageNo"=>null,
                "billNo"=>111,
                "freight"=>55.00,
                "goodsValue"=>111,
                "currencyCode"=>"RMB",
                "insureFee"=>0.00,
                "weight"=>2.75000,
                "netWeight"=>2.50000,
                "packNumber"=>1,
                "parcelInfo"=>"贵爱娘卫生巾大型 18P",
                "goodsInfo"=>"贵爱娘卫生巾大型 18P",
                "consignee"=>"李丽",
                "consigneeCountry"=>"CN",
                "consigneeProvince"=>"天津",
                "consigneeCity"=>"天津",
                "consigneeDistrict"=>"河西区",
                "consigneeAddress"=>"天津市河西区围堤道",
                "consigneeTelephone"=>"13911112345",
                "shipper"=>"天津港保税区跨境仓库（宏信仓库）",
                "shipperAddress"=>"天津市滨海新区天津港保税区津滨大道185号",
                "shipperTelephone"=>"02225763175",
                "shipperCountry"=>"CN",
                "note"=>"",
                "ebpName"=>"天津万千贸易有限公司",
                "logisticsCode"=>"0213W001201",
                "logisticsName"=>"顺丰",
                "billProvideSiteName"=>"BEX天津塘沽分部",
                "billProvideSiteCode"=>"300469",
                "markDestination"=>"津-河西",
                "pkgCode"=>"天津市内包",
                "accountCode" => 'U00001837',
            ),
            */
            'data' => array(
                "logNo"=>"51020490806969",
                "iePort"=>"0213",
                "ieType"=>"I",
                "appType"=>"1",
                "ebpCode"=>"0213D001201",
                "referenceNo"=>"11185310228",
                "trafMode"=>null,
                "shipName"=>null,
                "voyageNo"=>null,
                "billNo"=>111,
                "freight"=>55.00,
                "goodsValue"=>111,
                "currencyCode"=>"RMB",
                "insureFee"=>0.00,
                "weight"=>2.75000,
                "netWeight"=>2.50000,
                "packNumber"=>1,
                "parcelInfo"=>"贵爱娘卫生巾大型 18P",
                "goodsInfo"=>"贵爱娘卫生巾大型 18P",
                "consignee"=>"李丽",
                "consigneeCountry"=>"CN",
                "consigneeProvince"=>"天津",
                "consigneeCity"=>"天津",
                "consigneeDistrict"=>"河西区",
                "consigneeAddress"=>"天津市河西区围堤道",
                "consigneeTelephone"=>"13911112345",
                "shipper"=>"天津港保税区跨境仓库（宏信仓库）",
                "shipperAddress"=>"天津市滨海新区天津港保税区津滨大道185号",
                "shipperTelephone"=>"02225763175",
                "shipperCountry"=>"CN",
                "note"=>"",
                "ebpName"=>"信诺B2C",
                "logisticsCode"=>"0213W001201",
                "logisticsName"=>"顺丰",
                "billProvideSiteName"=>"BEX天津塘沽分部",
                "billProvideSiteCode"=>"300469",
                "markDestination"=>"津-河西",
                "accountCode"=>"U00001837",
                "pkgCode"=>"天津市内包"
            ),
        );
        $url = 'http://60.29.211.92:9000/default/api/web';
        $data = $this->http_request($url, 500, array(), $array);
        var_dump($data);
    }
    public function apiTestAction() {
        if(!$this->_request->isPost()){
            $this->view->method = array( 'Order','PersonItem', 'Waybill','Product','PayOrder', 'Loader');
            $this->view->opType = array( 'Add','Get', 'Update');
            echo Ec::renderTpl($this->tplDirectory . "api.tpl", 'layout-img');//使用布局文件
            exit;
        }
        $request = $this->_request->getParams();
        $request = $this->deal($request);
        $method = isset($request['method'])?$request['method']:'';
        $defaultMethods = Api_Web::getMethods();
        try {
            if($method===''){
                throw new Exception('接口不能为空');
            } else {
                if(!in_array($method,$defaultMethods)){
                    throw new Exception("接口[{$method}]不存在！");
                }
            }
            $class = 'Api_'.$method;
            $classPath = APPLICATION_PATH . '/models/Api/' . $method . '.php';

            if(!file_exists($classPath)){
                throw new Exception("接口[{$method}]不存在！");
            }
            $object = new $class($request);

            //身份验证
            if(($auth = $object -> authenticate()) === false){
                $result = $object->getError();
            }else{
                if(($run = $object->run()) === false){
                    $result =  $object->getError();
                }else{
                    $result = $object->getSuccess();
                }
            }
        } catch (Exception $e) {
            $result = array(
                'ask' => 0,
                'message' => '',
                'error' => array($e->getMessage())
            );
            $result = Common_Common::getResult($result);
        }
        $xml = simplexml_load_string($result);
        $data = json_decode(json_encode($xml),TRUE);
        die(json_encode($data));
    }

    public function getParamAction() {
        $opType = trim($this->_request->getParam('opType'),'');
        $method = trim($this->_request->getParam('method'),'');
        $param = $this->getParameters($method,$opType);
        die(json_encode($param));
    }

    protected function getParameters($method,$opType) {
        $data = array();
        if(!$method || !$opType){
            return $data;
        }
        switch($method) {
            case 'Product':
                switch($opType){
                    case 'Add';
                        $data = array(
                            'form'=>array(
                                'cusGoodsId'=>'海关商品备案编号',
                                'ieFlag'=>'进出口类型',
                                'customsCode'=>'主管海关代码',
                                'codeTs'=>'商品海关编码',
                                'gName'=>'商品名称',
                                'brand'=>'品牌',
                                'gModel'=>'规格型号',
                                'gUnit'=>'法定计量单位',
                                'unit2'=>'第二计量单位',
                                'declPrice'=>'申报单价',
                                'originCountry'=>'原产国',
                                'curr'=>'币制',
                                'codeTx'=>'行邮税号',
                                'taxName'=>'行邮税名称',//这个字段没用到
                                'gift'=>'是否赠品',
                                'ebcCode'=>'电商企业代码',
                                'ebcName'=>'电商企业名称',
                                'agentCode'=>'申报单位代码',
                                'agentName'=>'申报单位名称',
                                'appTime'=>'申报时间',//这个字段没用到
                                'netWt'=>'净重',
                                'grossWt'=>'毛重',
                                'barCode'=>'条形码',
                                'notes'=>'备注',
                            )
                        );
                        break;
                    case 'Update';
                        $data = array(
                            'form'=>array(
                                'cusGoodsId'=>'海关商品备案编号',
                                'ieFlag'=>'进出口类型',
                                'customsCode'=>'主管海关代码',
                                'codeTs'=>'商品海关编码',
                                'gName'=>'商品名称',
                                'brand'=>'品牌',
                                'gModel'=>'规格型号',
                                'gUnit'=>'法定计量单位',
                                'unit2'=>'第二计量单位',
                                'declPrice'=>'申报单价',
                                'originCountry'=>'原产国',
                                'curr'=>'币制',
                                'codeTx'=>'行邮税号',
                                'taxName'=>'行邮税名称',//这个字段没用到
                                'gift'=>'是否赠品',
                                'ebcCode'=>'电商企业代码',
                                'ebcName'=>'电商企业名称',
                                'agentCode'=>'申报单位代码',
                                'agentName'=>'申报单位名称',
                                'appTime'=>'申报时间',//这个字段没用到
                                'netWt'=>'净重',
                                'grossWt'=>'毛重',
                                'barCode'=>'条形码',
                                'notes'=>'备注',
                            )
                        );
                        break;
                    case 'Get';
                        $data = array(
                            'form'=>array(
                                'cusGoodsId'=>'海关商品备案编号',
                            )
                        );
                        break;
                }
                break;
            case 'Order':
                switch($opType){
                    case 'Add';
                        $data = array(
                            'form'=>array(
                                "ieType"=>'主管海关代码',
                                "iePort"=>'进出口类型',
                                "goodsAmount"=>'订单商品货款',
                                "freight"=>'订单商品运费',
                                "currencyCode"=>'币制',
                                "proAmount"=>'优惠金额',
                                "proRemark"=>'优惠信息说明',
                                "referenceNo"=>'客户交易订单编号',
                                "ecommercePlatformCustomerCode"=>'电商平台备案编码',
                                "note"=>'备注',
                                "consignee"=>'收货人名称',
                                "consigneeCountry"=>'收货人所在国',
                                "consigneeAddres"=>'收货人地址',
                                "consigneeTelephone"=>'收货人电话',
                                "consigneeFax"=>'收货人传真',
                                "consigneeIdNumber"=>'收货人身份证',
                                "consigneeEmail"=>'收货人电子邮件',
                            ),
                            'body'=>array(
                                'orderProduct'=>array(
                                    "itemNo"=>'商品货号',
                                    "gno"=>'商品备案编号',
                                    "gcode"=>'商品编号',
                                    "gname"=>'商品名称',
                                    "gmodel"=>'商品规格型号',
                                    "barCode"=>'条形码',
                                    "brand"=>'品牌',
                                    "unit"=>'计量单位',
                                    "currency"=>'币种',
                                    "qty"=>'数量',
                                    "price"=>'单价',
                                    "total"=>'成交总价',
                                    "giftFlag"=>'是否赠品',
                                    "note"=>'备注',
                                )
                            )
                        );
                        break;
                    case 'Update';
                        $data = array(
                            'form'=>array(
                                "ieType"=>'主管海关代码',
                                "iePort"=>'进出口类型',
                                "goodsAmount"=>'订单商品货款',
                                "freight"=>'订单商品运费',
                                "currencyCode"=>'币制',
                                "proAmount"=>'优惠金额',
                                "proRemark"=>'优惠信息说明',
                                "referenceNo"=>'客户交易订单编号',
                                "ecommercePlatformCustomerCode"=>'电商平台备案编码',
                                "note"=>'备注',
                                "consignee"=>'收货人名称',
                                "consigneeCountry"=>'收货人所在国',
                                "consigneeAddres"=>'收货人地址',
                                "consigneeTelephone"=>'收货人电话',
                                "consigneeFax"=>'收货人传真',
                                "consigneeIdNumber"=>'收货人身份证',
                                "consigneeEmail"=>'收货人电子邮件',
                            ),
                            'body'=>array(
                                'orderProduct'=>array(
                                    "itemNo"=>'商品货号',
                                    "gno"=>'商品备案编号',
                                    "gcode"=>'商品编号',
                                    "gname"=>'商品名称',
                                    "gmodel"=>'商品规格型号',
                                    "barCode"=>'条形码',
                                    "brand"=>'品牌',
                                    "unit"=>'计量单位',
                                    "currency"=>'币种',
                                    "qty"=>'数量',
                                    "price"=>'单价',
                                    "total"=>'成交总价',
                                    "giftFlag"=>'是否赠品',
                                    "note"=>'备注',
                                )
                            )
                        );
                        break;
                    case 'Get';
                        $data = array(
                            'form'=>array(
                                'referenceNo'=>'客户交易订单号',
                                'customerCode'=>'电商企业的海关备案编码',
                            )
                        );
                        break;
                }
                break;
            case 'Waybill':
                switch($opType){
                    case 'Add';
                        $data = array(
                            'form'=>array(
                                'customerCode'=>'电商客户代码',
                                'referenceNo'=>'订单交易单号',
                                'logNo'=>'物流运单编号',
                                'trafMode'=>'运输方式',
                                'shipName'=>'运输工具名称',
                                'voyageNo'=>'航班航次号',
                                'billNo'=>'提运单号',
                                'freight'=>'运费',
                                'goodsValue'=>'订单商品货款',
                                'currencyCode'=>'币制 ',
                                'insureFee'=>'保价费',
                                'weight'=>'毛重',
                                'netWeight'=>'净重',
                                'packNo'=>'件数',
                                'parcelInfo'=>'包裹单信息',
                                'goodsInfo'=>'商品信息',
                                'consignee'=>'收货人名称',
                                'consigneeCountry'=>'收货人所在国',
                                'consigneeProvince'=>'收货人所在省份',
                                'consigneeCity'=>'收货人所在城市/州',
                                'consigneeDistrict'=>'收货人所在区/县',
                                'consigneeAddress'=>'收货人详细地址',
                                'consigneeTelephone'=>'收货人电话',
                                'shipper'=>'发货人名称',
                                'shipperAddress'=>'发货人地址',
                                'shipperTelephone'=>'发货人电话',
                                'shipperCountry'=>'发货人所在国',
                                'note'=>'备注',
                                'appType'=>'操作类型',
                                'customsCode'=>'主管海关代码',
                                'ebpName'=>'电商平台名称',
                                'ieType'=>'进出口类型',
                                'accountCode'=>'物流企业子账号CODE',
                                'logisticCustomerCode'=>'物流企业客户代码',
                                'logisticEnpName'=>'物流企业名称',
                            ),

                        );
                        break;
                    case 'update':
                        $data = array(
                            'form'=>array(
                                'customerCode'=>'电商客户代码',
                                'referenceNo'=>'订单交易单号',
                                'logNo'=>'物流运单编号',
                                'trafMode'=>'运输方式',
                                'shipName'=>'运输工具名称',
                                'voyageNo'=>'航班航次号',
                                'billNo'=>'提运单号',
                                'freight'=>'运费',
                                'goodsValue'=>'订单商品货款',
                                'currencyCode'=>'币制 ',
                                'insureFee'=>'保价费',
                                'weight'=>'毛重',
                                'netWeight'=>'净重',
                                'packNo'=>'件数',
                                'parcelInfo'=>'包裹单信息',
                                'goodsInfo'=>'商品信息',
                                'consignee'=>'收货人名称',
                                'consigneeCountry'=>'收货人所在国',
                                'consigneeProvince'=>'收货人所在省份',
                                'consigneeCity'=>'收货人所在城市/州',
                                'consigneeDistrict'=>'收货人所在区/县',
                                'consigneeAddress'=>'收货人详细地址',
                                'consigneeTelephone'=>'收货人电话',
                                'shipper'=>'发货人名称',
                                'shipperAddress'=>'发货人地址',
                                'shipperTelephone'=>'发货人电话',
                                'shipperCountry'=>'发货人所在国',
                                'note'=>'备注',
                                'appType'=>'操作类型',
                                'customsCode'=>'主管海关代码',
                                'ebpName'=>'电商平台名称',
                                'ieType'=>'进出口类型',
                                'accountCode'=>'物流企业子账号CODE',
                                'logisticCustomerCode'=>'物流企业客户代码',
                                'logisticEnpName'=>'物流企业名称',
                            ),

                        );
                        break;
                    case 'Get';
                        $data = array(
                            'form'=>array(
                                'logNo'=>'运单编号',
                                'logisticCustomerCode'=>'物流企业客户代码',
                            )
                        );
                        break;
                    case 'UpdateStatus':
                        $data = array(
                            'form'=>array(
                                'logNo'=>'运单编号',
                                'appType'=>'申报类型',
                                'ieFlag'=>'进出口类型',
                                'logisticsCode'=>'物流企业代码',
                                'logisticsName'=>'物流企业名称',
                                'deliveredDate'=>'妥投时间',
                                'deliveredStatus'=>'妥投状态',
                                'deliveredNote'=>'妥投备注',
                            ),
                        );
                        break;
                }
                break;
            case 'PersonItem':
                switch($opType){
                    case 'Add';
                        $data = array(
                            'form'=>array(
                                'listRefCode'=>'内部清单编号',
                                'declare_ie_port'=>'申报口岸',
                                'form_type'=>'业务类型',
                                'customer_code'=>'电商企业代码',
                                'enp_name'=>'电商企业名称',
                                'whCode'=>'仓储企业代码',
                                'whName'=>'仓储企业名称',
                                'agent_customer_code'=>'申报单位代码',
                                'agent_name'=>'申报单位名称',
                                'logistic_customer_code'=>'物流企业代码',
                                'pay_customer_code'=>'支付企业代码',
                                'reference_no'=>'客户订单号',
                                'log_no'=>'运单号',
                                'pay_no'=>'支付单号',
                                'wrap_type'=>'外包装类型',
                                'ie_port'=>'进出口口岸',
                                'traf_mode'=>'出入港区运输方式',
                                'ship_trade_country'=>'发件人国家',
                                'ship_name'=>'发件人',
                                'ship_city'=>'发件人城市',
                                'declare_no'=>'报关员',
                                'outset_country_id'=>'启运国',
                                'aim_country_name'=>'抵运国家',
                                'receive_name'=>'收件人姓名',
                                'receive_telphone'=>'收件人电话',
                                'receive_country_name'=>'收件人国家',
                                'receive_state'=>'州/区域',
                                'receive_city'=>'收件人城市',
                                'receive_id_number'=>'收件人身份证',
                                'input_company'=>'录入单位',
                                'agent_address'=>'单位地址',
                                'agent_post'=>'邮编',
                                'agent_tel'=>'电话',
                                'freight'=>'运费',
                                'insure_fee'=>'保费',
                                'customs_field'=>'监管场所代码',
                                'input_no'=>'录入员',
                                'net_wt'=>'净重',
                                'gross_wt'=>'毛重',
                                'pack_no'=>'件数',
                                'i_e_date'=>'进出境日期',
                                'input_date'=>'录入时间',
                                'declare_date'=>'申报日期',
                                'note'=>'备注',
                            ),
                            'body'=>array(
                                  'product'=>array(
                                        'registerID'=>'海关备案编号',
                                        'gt_code'=>'行邮税号',
                                        'g_no'=>'商品序号',
                                        'goods_id'=>'对应底账料件号',
                                        'hs_code'=>'海关编码',
                                        'price'=>'单价',
                                        'g_qty'=>'数量',
                                        'curr'=>'币值',
                                        'g_name_cn'=>'商品名称',
                                        'g_model'=>'规格型号',
                                        'g_uint'=>'单位',
                                        'country'=>'原产国',
                                  )
                            )
                        );
                        break;
                    case 'Get';
                        $data = array(
                            'form'=>array(
                                'listRefCode'=>'内部清单编号',
                                'whCode'=>'仓储企业代码',
                            )
                        );
                        break;
                }
                break;
            case 'PayOrder':
                switch($opType){
                    case 'Add';
                        $data = array(
                            'form'=>array(
                                'payNo'=>'支付企业支付单号',
                                'appType'=>'申报类型',
                                'orderCode'=>'订单编号',
                                'customerCode'=>'电商客户编码',
                                'enpName' =>'电商企业名称',
                                'ecommercePlatformCustomerCode'=>'电商平台的海关备案编码',
                                'ecommercePlatformCustomerName'=>'电商平台名称',
                                'payCustomerCode'=>'支付企业客户代码',
                                'payAccountCode'=>'支付企业子账号客户代码',
                                'payEnpName'=>'支付企业名称',
                                'referenceNo'=>'客户参考号',
                                'payCurrencyCode'=>'支付币值(RMB)',
                                'payAmount'=>'支付金额',
                                'cosigneeCode'=>'支付人证件号码',//支付人证件号
                                'cosigneeName'=>'支付人姓名',  //支付人姓名
                                'note'=>'备注',
                            )
                        );
                        break;
                    case 'Update';
                        $data = array(
                            'form'=>array(
								 'payNo'=>'支付企业支付单号',
                                'appType'=>'申报类型',
                                'orderCode'=>'订单编号',
                                'customerCode'=>'电商客户编码',
                                'enpName' =>'电商企业名称',
                                'ecommercePlatformCustomerCode'=>'电商平台的海关备案编码',
                                'ecommercePlatformCustomerName'=>'电商平台名称',
                                'payCustomerCode'=>'支付企业客户代码',
                                'payAccountCode'=>'支付企业子账号客户代码',
                                'payEnpName'=>'支付企业名称',
                                'referenceNo'=>'客户参考号',
                                'payCurrencyCode'=>'支付币值(RMB)',
                                'payAmount'=>'支付金额',
                                'cosigneeCode'=>'支付人证件号码',//支付人证件号
                                'cosigneeName'=>'支付人姓名',  //支付人姓名
                                'note'=>'备注',
                            )
                        );
                        break;
                    case 'Get';
                        $data = array(
                            'form'=>array(
                                'payNo'=>'支付单号',
                                'payCustomerCode'=>'支付企业客户编号'
                            ),
                        );
                        break;
                }
                break;
            case 'Loader':
                switch($opType){
                    case 'Add';
                        $data = array(
                            'form'=>array(
                                'carNO'=>'车牌号',
                                'refLoaderNo'=>'装载单企业内部编号',
                                'formType'=>'业务类型',
                                'ieType'=>'进出口类型',
                                'declPort'=>'申报口岸',
                                'iePort'=>'进出口岸',
                                'packNo'=>'总件数',
                                'totalWt'=>'总重量',
                                'carWt'=>'车自重',
                                'formNum'=>'单证总数',
                                'agentCode'=>'申报单位代码',
                                'agentName'=>'申报单位名称',
                                'tradeCode'=>'经营单位代码',
                                'tradeName'=>'经营单位名称',
                                'whCode'=>'仓储企业单位代码',
                                'whName'=>'收发货人代码',
                                'ownerCode'=>'收发货人名称',
                                'ownerName'=>'收发货人名称',
                            ),
                            'body'=>array(
                                'personItems'=> array(
                                    'refPersonItemNo'=>'清单内部编号',
                                    'formType'=>'业务类型',
                                ),
                                'products'=>array(
                                    'declNumber'=>'报关单号',
                                    'fzxtGNo'=>'报关单项号',
                                    'formId'=>'出入库单编号',
                                    'gNo'=>'商品序号',
                                    'codeTs'=>'商品编号',
                                    'gnameCn'=>'商品中文名称',
                                    'gnameEn'=>'商品英文名称',
                                    'gModel'=>'商品规格型号',
                                    'gQty'=>'申报数量',
                                    'gUnit'=>'计量单位',
                                    'declPrice'=>'申报单价',
                                    'curr'=>'币种',
                                    'qty1'=>'法定数量',
                                    'unit1'=>'法定单位',
                                    'qty2'=>'第二法定数量',
                                    'unit2'=>'第二法定单位',
                                    'originCountry'=>'原产国/目的地',
                                    'dutyMode'=>'征免方式',
                                    'useTo'=>'用途',
                                    'declTotal'=>'申报总价',
                                    'notes'=>'备注',
                                ),
                            ),
                        );
                        break;
                    case 'Get';
                        $data = array(
                            'form'=>array(
                                'refLoaderNo'=>'装载单企业内部编号',
                            )
                        );
                        break;
                }
                break;
            default:
                break;
        }
        return $data;
    }
    
    public function xtestAction(){
         $message = array(
            'entryid' => '1',
            'ieFlage' => '1',
            'orderNo' => '1',
            'logisticsNo' => '1',
            'logisticsCode' => '1',
            'logisticsName' => '1',
            'checkResult' => '1',
            'checkDate' => '1',
            'checkType' => '1',
            'checkMan' => '1',
            'checkOpinion' => '1',
        );
        $paragram['message'] = $message;
        $client = new SoapClient("http://www.tianjinoms.com/default/xmachine-soap");
        var_dump($client->checkResult($paragram));
    } 

    public function deal($data){
        unset($data['module']);
        unset($data['controller']);
        unset($data['action']);
        $request = array(
            'HeaderRequest'=>array(
                    'customerCode'=>$data['customerCode'],
                    'appToken'=>$data['appToken'],
                    'appKey'=>$data['appKey'],
                    'accountCode'=>$data['accountCode'],
            )
        );
        $request['method'] = $data['method'];
        $request['opType'] = $data['opType'];

        unset($data['customerCode']);
        unset($data['appToken']);
        unset($data['appKey']);
        unset($data['accountCode']);
        unset($data['method']);
        unset($data['opType']);

        switch($request['opType']) {
            case 'Add':
            case 'Update':
                if($request['method']=='PersonItem'){
                    if(isset($data['product']) && !empty($data['product'])){
                        $product = array();
                        foreach($data['product'] as $key=>$value){
                            $product[$value['registerID']] = $value;
                        }
                        $data['product'] = $product;
                    }
                }
                //$request = array_merge($request,array('data'=>$data));这个是用来看测试数据的
                $request = array_merge($request,array('data'=>json_encode($data)));
                break;
            case 'Get':
                $request = array_merge($request,$data);
                break;
        }
        return $request;
    }
    
    private function http_request($url, $timeout = 300, $header = array(),$post=array()) {
        if (!function_exists('curl_init')) {
            throw new Exception('server not install curl');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if(!empty($post) and is_string($post)){
            $header[] = 'Content-Length: ' . strlen($post);
        }
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if(!empty($post)){
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
        }
        $data = curl_exec($ch);
        if ($data == false) {
            curl_close($ch);
        }
        @curl_close($ch);
        return $data;
    }
}
