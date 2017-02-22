<?php
class Service_XmachineProcess{
    //上线的时候更换IP - 测试IP
    private static $apiUrl = 'http://172.16.2.25:8299/TJWebservices.asmx?wsdl';
    private static $client;

    /**
     * [__construct 生成实例]
     */
    public function __construct() {
        try {
            self::$client = new SoapClient($this->apiUrl, array("trace" => true, "connection_timeout" => 200));
        }catch (Exception $e) {
            try {
                self::$client = new SoapClient($this->apiUrl, array("trace" => true, "connection_timeout" => 200));
            } catch (Exception $e) {
                self::$client = NULL;
            }
        }
    }

    /**
     * [send 调用接口发送数据]
     * @param  [type] $pim_code [description]
     * @return [type]           [description]
     */
    public static function send($pim_code){

        $date = date('Y-m-d H:i:s');
        $person_arr = $head = $list = array();

        $list = array(
            0 =>array (
                'ListNo' => '',
                'goodsNo' => '',
                'goodsName' => '',
                'quantity' => '',
                'unit' => '',
                'itemNo' => ''
            ),
        );

        $return = array(
            'ask' => 0,
            'message' => '',
        );

        if(empty($pim_code)){
            $return['message'] = '物品清单号码为必填';
            return $return;
        }

        $person_item_data = Service_PersonItem::getByField($pim_code, 'pim_code');
        if(empty($person_item_data)){
            $return['message'] = '物品清单不存在';
            return $return;
        }
        $storage_customer_data = Service_Customer::getByField($person_item_data['storage_customer_code'], 'customer_code');
        if($storage_customer_data['is_business_in'] == 1 || $storage_customer_data['is_normal_in']){
            $ieFlage = 'I';
        }else if($storage_customer_data['is_business_export'] == 1 || $storage_customer_data['is_normal_export']){
            $ieFlage = 'E';
        }else {
            $ieFlage = 'I';
        }
        $logistics_data = Service_Customer::getByField($person_item_data['logistic_customer_code'], 'customer_code');
        //清单产品
        $person_item_products = Service_PersonItemProduct::getByCondition(array('pim_code'=>$pim_code));
        $total_price = 0;
        if(!empty($person_item_products) && is_array($person_item_products)){
            foreach ($person_item_products as $key => $value) {
                $total_price += $value['total_price'];
                $list[$key]['ListNo'] = $value['pimp_id'];
                $list[$key]['goodsNo'] = $value['g_no'];
                $list[$key]['goodsName'] = $value['g_name_cn'];
                $list[$key]['quantity'] = $value['g_qty'];
                $list[$key]['unit'] = $value['g_uint'];
                $list[$key]['itemNo'] = $value['registerID'];
            }
        }

        $head = array(
            'entryid' => $person_item_data['pim_code'],
            'ieFlage' => $ieFlage,
            'orderNo' => $person_item_data['order_code'],
            'logisticsNo' => $person_item_data['wb_code'],
            'logisticsCode' => $person_item_data['logistic_customer_code'],
            'logisticsName' => $logistics_data['trade_name'],
            'wrapType' => $person_item_data['wrap_type'],
            'packNum' => $person_item_data['pack_no'],
            'grossWt' => $person_item_data['gross_wt'],
            'netWt' => $person_item_data['net_wt'],
            'goodsValue' => $total_price,
            'freight' => $person_item_data['freight'],
            'controlledStatus' => $person_item_data['customs_status'] == 8 ? 1 : 0,
            'controlledDate' => $person_item_data['customs_status'] == 8 ? $person_item_data['pim_update_time'] : '',
            //布控人
            'operator' => '海关',
            'messageTime' => $date,
            'note' => $person_item_data['note'],
        );
        $person_arr = array(
            'head' => $head,
            'lists' => array('list' => $list),
        );
        $messageObject = new Common_Message();
        //生成报文
        $xml = $messageObject->cearteResult($person_arr, 'message');
        /*
        echo $xml;
        die();
        */
        //调用接口发送
        if (NULL === self::$client) {
            self::$client = new SoapClient(self::$apiUrl);
        }
        try{
            //调用接口发送报文
            $send_res = self::$client->SendXRay_data($xml);
            /*
            $send_res = '<?xml version="1.0" encoding="utf-8"?><message><result>success</result><msg>发送成功</msg><code>200</code></message>';
            */
            $send_res = json_decode(json_encode(simplexml_load_string($send_res)), true);
            //发送成功
            if(is_array($send_res) && array_key_exists('result', $send_res) && $send_res['result'] == 'success'){
                $return['ask'] = 1;
            }
            $return['message'] = $send_res['msg'];
        }catch(Exception $e){
            $return['message'] = $e->getMessage();
        }
        return $return;
    }
}