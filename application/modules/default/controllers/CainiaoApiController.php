<?php
/**
 * Created by JetBrains PhpStorm.
 * User: william
 * Date: 14-9-5
 * Time: 下午3:59
 * To change this template use File | Settings | File Templates.
 */
class Default_CainiaoApiController extends Ec_Controller_DefaultAction{
    /**
     * @author william-fan
     * @todo 用于接收菜鸟订单,取消订单，以及其它的报文信息，根据消息类型判断
     */
    public function pullOrderAction(){
        //header("Content-Type: text/plain");
        //setlocale(LC_ALL, 'zh_CN');
        header("Content-Type: text/plain;charset=utf-8");
        $request = $this->_request->getParams();
        $msg_type = $request['msg_type'];
        //$file_name = APPLICATION_PATH.'/../data/cainiao/'.'file_cainiao'.date("Y-m-d H:i:s",time()).'.txt';
        //file_put_contents($file_name,var_export($request,true));
        //echo $msg_type;exit;
        switch(strtolower($msg_type)){
            //订单
            case "tmall.logistics.event.wms.create":
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response =   $cainiaoObj->OWCreateOrderService($request);
                echo $response;
                return $response;
                break;
            //取消订单
            case "tmall.logistics.event.wms.cancel":
                //echo 'sss';return;
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response =   $cainiaoObj->OWCancelOrderService($request);
                echo $response;
                return $response;
                break;
            //退货
            case "tmall.logistics.event.wms.refund":
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response =   $cainiaoObj->OWRefundOrderService($request);
                echo $response;
                return $response;
                break;
            //对仓异议
            case "tmall.logistics.event.wms.dissent":
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response =   $cainiaoObj->OWDissentOrderService($request);
                echo $response;
                return $response;
                break;
            //发货
            case "tmall.logistics.event.wms.send":
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response =   $cainiaoObj->OWSendOutOrderService($request);
                echo $response;
                return $response;
                break;
            //干线
            case "os_trunk_send":
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response =   $cainiaoObj->osTrunkGainMsgService($request);
                echo $response;
                return $response;
                break;
            //未知
            default:
                $result = array(
                    'ask'=>'0',
                    'message'=>'message type error!'
                );
                $cainiaoObj = new Service_CainiaoApiProcess();
                $response = $cainiaoObj->getCainiaoResult($result);
                echo $response;
                return $response;
        }
    }
}