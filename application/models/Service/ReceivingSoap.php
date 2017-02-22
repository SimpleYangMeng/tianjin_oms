<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-10-15
 * Time: 下午8:17
 * To change this template use File | Settings | File Templates.
 */
class Service_ReceivingSoap
{
    public static  function createAsn(array $data){
        //$this->common($paramter);
        $result = array(
            'ask' => '0',
            'message' => '',
            'asnCode' => '',
            //'error' => $this->_date
        );


        $headerRequest = $data['HeaderRequest'] ;
        $customerCode = $headerRequest['customerCode'];
        $customerRow = Service_Customer::getByField($customerCode,'customer_code',"*");

        $asnInfo = $data['ASNInfo'];
        $asnData = array();
        foreach($asnInfo as $k=>$v){
            if($k!="ASNItems"){
                $asnData[$k] = $v;
            }
        }
        if($asnInfo['receive_model_type']=="1"){
            $orderCodeArr = array();
            foreach($asnInfo['ASNItems']['OrderInfo'] as $key=>$value){
                $orderRow = Service_Orders::getByField($value['asn_order'],"order_code","*");
                $orderCodeArr[$orderRow['order_id']] = $value['asn_order'];
            }
            $asnData['asn_order'] = $orderCodeArr;
        }else{
            $productSku = array();
            $sku = array();
            foreach($asnInfo['ASNItems']['productInfo'] as $key=>$value){
                $product = Service_Product::getByCondition(
                    array('product_sku'=>$value['product_sku'],'customer_code'=>$customerCode),"*");
                $productSku[$product[0]['product_id']] = $product[0]['product_sku'];
                $sku[$product[0]['product_id']] = $value['quantity'];
            }
            $asnData['product_sku'] = $productSku;
            $asnData['sku'] = $sku;
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
            $result['message'] = $doresult['msg'];
        }
        $result['error']=$doresult['error'];
        $result['ask']=$doresult['ask'];
        $result['ASNCode'] = $doresult['ASNCode'];
        return $result;
    }

    public function updateAsn($data){
        $result = array(
            'ask'=>'Error',
            'message'=>'',
            'ASNCode'=>'',
            'time'=>""
        );

        $headerRequest = $data['HeaderRequest'];
        $customerCode = $headerRequest['customerCode'];
        $customerRow = Service_Customer::getByField($customerCode,'customer_code',"*");

        $asnCoode = $data['UpdateASNInfo']['ASNCode'];
        $asnInfo = $data['UpdateASNInfo'];
        $asnData = array();
        foreach($asnInfo as $k=>$v){
            if($k!="ASNItems"){
                $asnData[$k] = $v;
            }
        }

        if($asnInfo['receive_model_type']=="1"){
            $orderCodeArr = array();
            foreach($asnInfo['ASNItems']['OrderInfo'] as $key=>$value){
                $orderRow = Service_Orders::getByField($value['asn_order'],"order_code","*");
                $orderCodeArr[$orderRow['order_id']] = $value['asn_order'];
            }
            $asnData['asn_order'] = $orderCodeArr;
        }else{
            $productSku = array();
            $sku = array();
            foreach($asnInfo['ASNItems']['productInfo'] as $key=>$value){
                $product = Service_Product::getByCondition(
                    array('product_sku'=>$value['product_sku'],'customer_code'=>$customerCode),"*");
                $productSku[$product[0]['product_id']] = $product[0]['product_sku'];
                $sku[$product[0]['product_id']] = $value['quantity'];
            }
            $asnData['product_sku'] = $productSku;
            $asnData['sku'] = $sku;
        }

        $ASNObj = new Service_AsnProccess();

        if($asnData['receive_model_type']=="0"){
            //备货模式
            $doresult = $ASNObj->updateTransaction($asnData, $customerRow['customer_id'], $asnData['warehouseId']);
        }else{
            $doresult = $ASNObj->updatejihuoTransaction($asnData, $customerRow['customer_id'], $asnData['warehouseId']);
        }
        if (isset($doresult['msg'])) {
            $result['message'] = $doresult['msg'];
        }
        $result['error']=$doresult['error'];
        $result['ask']=$doresult['ask'];
        $result['ASNCode'] = $doresult['ASNCode'];
        return $result;
    }

    public function getAsnByCode(array $data){

        $result = array(
            'ask'=>'0',
            'message'=>'',
            'error'=>'',
            'Data'=>'',
            //'error'=>'',
        );
        //$receivingRow = array();
        $receivingCode = $data['ASNCode'];

        $receivingRow = Service_Receiving::getByField($receivingCode,'receiving_code',"*");
        if($receivingRow['receive_model_type']=="1"){
            $receivingOrderDetail = Service_ReceivingOrderDetail::getByCondition(array('receving_code'=>$receivingCode),"*");
            $orders = array();
            foreach($receivingOrderDetail as $key=>$value){
                $orderRow = Service_Orders::getByField($value['order_code'],"order_code","*");
                $orders[] = $orderRow;
            }
            $receivingRow['orderInfo'] = $orders;
        }else{
            $receivingDetail = Service_ReceivingDetail::getByCondition(array('receiving_code'=>$receivingCode),"*");
            $products = array();
            foreach($receivingDetail as $k=>$v){
                $p = Service_Product::getByField($v['product_id'],"product_id","*");
                $products[] = $p;
            }
            $receivingRow['productInfo'] = $products;
        }
        $result['ask'] = "1";
        $result['Data'] = $receivingRow;
        //$result['time'] = date("Y-m-d H:i:s");
        return $result;
    }

}
