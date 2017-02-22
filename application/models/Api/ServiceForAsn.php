<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-10-15
 * Time: 下午3:04
 * To change this template use File | Settings | File Templates.
 */
class Api_ServiceForAsn
{
    protected $_customerId = null;

    protected $_customer = null;

    protected $_token = null;

    protected $_key = null;

    protected $_auth = false;

    protected $_error = null;

    protected $_date = null;

    protected $_paramterArr = array();//将传递过来的对象转为数组存储
    public static  $underlineToUpper = array(
        'ASNCode'=>'ASNCode',
        'ie_port'=>'ie_port',
        'instructions'=>'instructions',
        'pack_no'=>'wrapQty',
        'receive_model_type'=>'receive_model_type',
        'ref_code'=>'ref_code',
        'roughweight'=>'roughWeight',
        'netweight'=>'netWeight',
    );


    private function _init ($headerRequest) {
        $this->_customerId = (string) $headerRequest['customerCode'];
        $this->_token = (string) $headerRequest['appToken'];
        $this->_key = (string) $headerRequest['appKey'];
    }
    /**
     * @author william-fan
     * @todo Authenticate
     */
    private function authenticate(){
        $customer = Service_Customer::getByField($this->_customerId, 'customer_code');
        if (! $customer || $customer['customer_status'] != 2) {
            $this->_error = 'No Authority For ' . $this->_customerId . '.';
            return false;
        }
        $this->_customer = $customer;
        $customerAuth = Service_CustomerApi::getByField($this->_customerId, 'customer_code');

        if ($customerAuth && $customerAuth['ca_token'] == $this->_token && $customerAuth['ca_key'] == $this->_key) {
            $this->_auth = true;
            return true;
        }
        $this->_error = 'App Token/App Key Not match for ' . $this->_customerId . '.';
        return false;
    }
    /**
     * @todo 写日志
     */
    private function logError ($error) {
        $logger = new Zend_Log();
        $uploadDir = APPLICATION_PATH . "/../data/log/";
        $writer = new Zend_Log_Writer_Stream($uploadDir . 'api-receiving.log');
        $logger->addWriter($writer);
        $logger->info(date('Y-m-d H:i:s') . ': ' . $error . " \n");
    }

    private function common ($paramter) {

        $this->_paramterArr = Common_Common::objectToArray($paramter);//对象转数组
        $headRequest = $this->_paramterArr['HeaderRequest'];
        $this->_init($headRequest);

        $this->_date = date('Y-m-d H:i:s');


        $this->authenticate();

    }

    public function createAsn($data){
        $this->common($data);
        $result = array(
            'ask' => 'Error',
            'message' => '',
            'ASNCode' => '',
            'error'=>'',
        );
        if($this->_auth === false || $this->_auth == ''){
            $result['error']['errorMessage']    =   $this->_error;
            return $result;
        }


        $headerRequest = $this->_paramterArr['HeaderRequest'] ;
        $customerCode = $headerRequest['customerCode'];
        $customerRow = Service_Customer::getByField($customerCode,'customer_code',"*");

        $asnInfo = $this->_paramterArr['ASNInfo'];
        $asnItems = $asnInfo['ASNItems'];
        $asnInfo = $this->transParam($asnInfo);
        $asnData = array();
        foreach($asnInfo as $k=>$v){
            if($k!="ASNItems"){
                $asnData[$k] = $v;
            }
        }
        if($asnInfo['receive_model_type']=="1"){
            $orderCodeArr = array();
            $OrderInfo = $asnItems['OrderInfo'];
            if(!empty($OrderInfo) && is_array($OrderInfo['0'])){

            }else{
                $OrderInfo = array($OrderInfo);
            }
            foreach($OrderInfo as $key=>$value){
                if($key=="asn_order"){
                    $orderRow = Service_Orders::getByField($value,"order_code","*");
                    $orderCodeArr[$orderRow['order_id']] = $orderRow['order_code'];
                }else{
                    $orderRow = Service_Orders::getByField($value['order_code'],"order_code","*");
                    $orderCodeArr[$orderRow['order_id']] = $value['order_code'];
                }
            }
            $asnData['asn_order'] = $orderCodeArr;
        }else{
            $productSku = array();
            $sku = array();
            $rouweight  =   array();
            $productInfo = $asnItems['productInfo'];
            if(!empty($productInfo) && is_array($productInfo['0'])){

            }else{
                $productInfo = array($productInfo);
            }
            foreach($productInfo as $key=>$value){
                $product = Service_Product::getByCondition(
                array('product_sku'=>$value['product_sku'],'customer_code'=>$customerCode),"*");
                $productSku[$product[0]['product_id']] = $product[0]['product_sku'];
                if (isset($sku[$product[0]['product_id']])) {
                  $sku[$product[0]['product_id']] += $value['quantity'];
                  $rouweight[$product[0]['product_id']] += $value['totalWeight'];
                }
                else {
                  $sku[$product[0]['product_id']] = $value['quantity'];
                  $rouweight[$product[0]['product_id']] = $value['totalWeight'];
                }
            }
            $asnData['product_sku'] = $productSku;
            $asnData['sku'] = $sku;
            $asnData['rouweight']   =   $rouweight;
        }

        $ASNObj = new Service_AsnProccess();
        $doresult = array();
        if($asnInfo['receive_model_type']=="1"){
            //集货模式
            $doresult = $ASNObj->createjihuoTransaction($asnData, $customerRow['customer_id'], $asnInfo['warehouseId']);
            //exit('cc');
        }else{
            $doresult = $ASNObj->createTransaction($asnData, $customerRow['customer_id'], $asnInfo['warehouseId']);
        }
        if (isset($doresult['msg'])) {
            $result['msg'] = $doresult['msg'];
        }
//        $result['error']['errorMessage'] = implode("---", $doresult['error']);
        $result['error']=Common_TransError::Transerror($doresult['error']);
        $result['ask']=$doresult['ask'];
        $result['ASNCode'] = $doresult['ASNCode'];
        $result['time'] = date("Y-m-d H:i:s");
        $result['message'] = $doresult['msg'];
        return $result;
    }

    public function updateAsn($data){
        $this->common($data);
        $result = array(
            'ask'=>'Error',
            'message'=>'',
            'error'=>'',
            'ASNCode'=>'',
        );

        $headerRequest = $this->_paramterArr['HeaderRequest'];
        $customerCode = $headerRequest['customerCode'];
        $customerRow = Service_Customer::getByField($customerCode,'customer_code',"*");

        $asnCoode = $this->_paramterArr['UpdateASNInfo']['ASNCode'];
        $asnInfo = $this->_paramterArr['UpdateASNInfo'];
        $asnItems = $asnInfo['ASNItems'];
        $asnInfo = $this->transParam($asnInfo);
        $asnData = array();
        foreach($asnInfo as $k=>$v){
            if($k!="ASNItems"){
                $asnData[$k] = $v;
            }
        }

        if($asnInfo['receive_model_type']=="1"){
            $orderCodeArr = array();
			$OrderInfo = $asnItems['OrderInfo'];
            if(!empty($OrderInfo) && is_array($OrderInfo['0'])){

            }else{
                $OrderInfo = array($OrderInfo);
            }
            foreach($OrderInfo as $key=>$value){
                $orderRow = Service_Orders::getByField($value['asn_order'],"order_code","*");
                $orderCodeArr[$orderRow['order_id']] = $orderRow['order_code'];
            }
            $asnData['asn_order'] = $orderCodeArr;
        }else{
            $productSku = array();
            $sku = array();
            $rouweight  =   array();
            $productInfo = $asnItems['productInfo'];
            if(!empty($productInfo) && is_array($productInfo['0'])){

            }else{
                $productInfo = array($productInfo);
            }
            foreach($productInfo as $key=>$value){
                $product = Service_Product::getByCondition(
                    array('product_sku'=>$value['product_sku'],'customer_code'=>$customerCode),"*");
                $productSku[$product[0]['product_id']] = $product[0]['product_sku'];
                $sku[$product[0]['product_id']] = $value['quantity'];
                $rouweight[$product[0]['product_id']] = $value['totalWeight'];
            }
            $asnData['product_sku'] = $productSku;
            $asnData['sku'] = $sku;
            $asnData['rouweight'] = $rouweight;            
        }
        $ASNObj = new Service_AsnProccess();

        if($asnData['receive_model_type']=="0"){
            //备货模式
            $doresult = $ASNObj->updateTransaction($asnData, $customerRow['customer_id'], $asnData['warehouseId']);
        }else{
            $doresult = $ASNObj->updatejihuoTransaction($asnData, $customerRow['customer_id'], $asnData['warehouseId']);
        }
        /*if (isset($doresult['msg'])) {
            $result['msg'] = $doresult['msg'];
        }*/
        $result['error']=Common_TransError::Transerror($doresult['error']);
//        $result['error']['errorMessage']=implode("---", $doresult['error']);
        $result['ask']=$doresult['ask'];
        $result['ASNCode'] = $doresult['ASNCode'];
        return $result;
    }

    public function getAsnByCode($data){
        $this->common($data);
        $result = array(
            'ask'=>'Error',
            'message'=>'',
            'error'=>'',
            'Data'=>'',
        );
        //$receivingRow = array();
        $receivingCode = $this->_paramterArr['ASNCode'];

        $receivingRow = Service_Receiving::getByField($receivingCode,'receiving_code',"*");

        if (empty($receivingRow)) {
          $result['ask'] = 0;
          $result['message'] = '单号[' . $receivingCode . ']不存在';
          $result['error']=Common_TransError::Transerror(array('单号[' . $receivingCode . ']不存在'));
          return $result;
        }

        if($receivingRow['receive_model_type']=="1"){
            $receivingOrderDetail = Service_ReceivingOrderDetail::getByCondition(array('receiving_code'=>$receivingCode),"*");
            $orders = array();
            foreach($receivingOrderDetail as $key=>$value){
                $orderRow = Service_Orders::getByField($value['order_code'],"order_code","*");
                $orders[] = $orderRow;
            }
            $receivingRow['OrderDetail'] = $orders;
        }else{
            $receivingDetail = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode),"*");
            $products = array();
            foreach($receivingDetail as $k=>$v){
                $p = Service_Product::getByField($v['product_id'],"product_id","*");
                $p['rd_receiving_qty'] = $v['rd_receiving_qty'];
                $p['rd_putaway_qty'] = $v['rd_putaway_qty'];
                $p['rd_received_qty'] = $v['rd_received_qty'];
                $p['putaway_time'] = '0000-00-00 00:00:00';
                $qcRow = Service_QualityControl::getByField($v['rd_id'],'rd_id',"*");
                if(empty($qcRow)){
                    $p['rdqc_status'] = "未收货";
                }else{
                    switch($qcRow['qc_status']){
                        case '0':
                            $p['rdqc_status'] = "已收货";
                            break;
                        case '1':
                            $p['rdqc_status'] = "qc中";
                            break;
                        case '2':
                            $p['rdqc_status'] = "已上架";
                            $p['putaway_time'] = $qcRow['qc_update_time'];
                            break;
                    }
                }
                $products[] = $p;
            }
            $receivingRow['productDetail'] = $products;
        }
        $result['ask'] = "1";
        $result['Data'] = $receivingRow;

        return $result;
    }
    /**
     * @author william-fan
     * @todo 转换参数到程序识别
     */
    private function transParam($asnInfo){
        $trans = array();

        if(isset($asnInfo['ASNCode'])){
            $trans['ASNCode'] = $asnInfo['ASNCode']; //备货模式订单
        }

        $trans['ie_port'] = '5345';

        if(isset($asnInfo['warehouseCode'])){
            $warehouseCode = $asnInfo['warehouseCode'];
            $warehouse=Service_Warehouse::getByField($warehouseCode,'warehouse_code');
            $trans['warehouseId'] = $warehouse['warehouse_id'];
        }
        if(isset($asnInfo['toWarehouseCode'])){
            $towarehouseCode = $asnInfo['toWarehouseCode'];
            $towarehouse=Service_Warehouse::getByField($towarehouseCode,'warehouse_code');
            $trans['to_warehouse'] = $towarehouse['warehouse_id'];
        }
        if(isset($asnInfo['wrapQty'])){
            $trans['pack_no'] = $asnInfo['wrapQty'];
        }
        if(isset($asnInfo['wrapType'])){
            $trans['wrap_type'] = $asnInfo['wrapType'];
        }
        if(isset($asnInfo['roughweight'])){
            $trans['roughweight'] = $asnInfo['roughweight'];
        }
        if(isset($asnInfo['billOfLading'])){
            $trans['trake_code'] = $asnInfo['billOfLading'];
        }
        if(isset($asnInfo['cabinetNo'])){
            $trans['cabinet_no'] = $asnInfo['cabinetNo'];
        }
        if(isset($asnInfo['consignor'])){
            $trans['receiving_name'] = $asnInfo['consignor'];
        }
        if(isset($asnInfo['ref_code'])){
            $trans['ref_code'] = $asnInfo['ref_code'];
        }
        if(isset($asnInfo['receive_model_type'])){
            $trans['receive_model_type'] = $asnInfo['receive_model_type'];
        }
        if(isset($asnInfo['volumeWeight'])){
            $trans['volumnweight'] = $asnInfo['volumeWeight'];
        }
        //print_r($transOrder);
        return $trans;
    }

    /**
     * @author william-fan
     * @todo 用于修改订单信息
     * $orderRow 更改的订单
     * $orderInfo 订单信息
     */
    private function updateTransParam($asnRow,$asnInfo){
    }
}
