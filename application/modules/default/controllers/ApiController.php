<?php
/**
 * Created by JetBrains PhpStorm.
 * User: william
 * Date: 14-9-5
 * Time: 下午3:59
 * To change this template use File | Settings | File Templates.
 */
class Default_ApiController extends Ec_Controller_DefaultAction
{
    public function webAction()
    {
        header("Content-Type: text/xml;charset=utf-8");
        $request = $this->_request->getParams();

        $method = isset($request['method']) ? $request['method'] : '';

        $defaultMethods = Api_Web::getMethods();
        try {
            if ($method === '') {
                throw new Exception('接口不能为空');
            } else {
                if (!in_array($method, $defaultMethods)) {
                    throw new Exception("接口[{$method}]不存在！");
                }
            }
            $class     = 'Api_' . $method;
            $classPath = APPLICATION_PATH . '/models/Api/' . $method . '.php';

            if (!file_exists($classPath)) {
                throw new Exception("接口[{$method}]不存在！");
            }
            $object = new $class($request);

            //身份验证
            if (($auth = $object->authenticate()) === false) {
                echo $object->getError();
                exit();
            }
            // 签名验证
            if ($object->sign() === false) {
                echo $object->getError();
                exit();
            }
            // 调用接口
            if (($run = $object->run()) === false) {
                echo $object->getError();
                exit();
            }
            echo $object->getSuccess();
        } catch (Exception $e) {
            $result = array(
                'ask'     => 0,
                'message' => '',
                'error'   => array($e->getMessage()),
            );
            echo Common_Message::cearteMessage($result, 'Response');
            exit();
        }
    }

    public function aaAction(){

        echo 'sss';
        echo "<pre>";

        $file = '/home/tianjin/svnoms/tianjin_oms/application/../data/ciq_IODeclCfReceived/2016/01/25/14536956419670070.xml';

        function parseIntoTable($xmlFile)
        {
            $type = array(
                //产品备案
                '110' => 'GoodsRegReceived',
                //企业备案
                '200' => 'EntRegReceived',
                //商品备案状态回执
                '210' => 'GoodsRegReceived',
                //订单
                '350' => 'OrderReceived',
                //运单
                '351' => 'BillReceived',
                //支付单
                '352' => 'PaymentReceived',
                //物品清单
                '230' => 'IODeclReceived',
                //入库单
                '220' => 'IIDeclReceived',
                //二维码
                '228' => 'IIQR',
                '226' => 'IIDeclCfReceived',//入库单抽验
                '236' => 'IODeclCfReceived',//物品清单抽验
                //咨询建议
                '552' => 'ConsultComplainReceived',
            );


            $result = array('ask'=>0,'message'=>'');

            var_dump(is_file($xmlFile));

            if(is_file($xmlFile))
            {
                try{
                    $db = Common_Common::getAdapter();
                    $db->beginTransaction();
                    $xml = file_get_contents($xmlFile);
                    $xmlObj = simplexml_load_string($xml);
                    $xmlData = Common_Message::analyzeResult($xmlObj);
                    print_r($xmlData);
                    $xmlType = $xmlData['MessageHead']['MESSAGE_TYPE'];
                    if(isset($type[$xmlType])){
                        $xmlStringPre 	= $type[$xmlType];
                        $file 			= pathinfo($xmlFile);
                        //保存文件路径
                        $targetPath 	= APPLICATION_PATH . '/../data/ciq_'.$type[$xmlType].'/'.date('Y/m/d');
                        if(!is_dir($targetPath)){
                            if(!Common_Common::createPath($targetPath)){
                                throw new Exception('创建目录失败');
                            }
                        }
                        $targetFile 	= $targetPath.'/'.$file['basename'];
                        //消息存在不处理
                        /*
                        $cbmhId = Service_CiqBackMessHead::getByField($xmlData['MessageHead']['MESSAGE_ID'], 'message_id', array('cbmh_id'));
                        if( $cbmhId ){
                            throw new Exception('该条记录已存在消息头ID:'.$cbmhId['cbmh_id']);
                        }
                        */
                        $header	= array(
                            'message_id'	=> isset($xmlData['MessageHead']['MESSAGE_ID']) ? $xmlData['MessageHead']['MESSAGE_ID'] : '',
                            'message_type'	=> isset($xmlData['MessageHead']['MESSAGE_TYPE']) ? $xmlData['MessageHead']['MESSAGE_TYPE'] : '',
                            'send_code'		=> isset($xmlData['MessageHead']['SEND_CODE']) ? $xmlData['MessageHead']['SEND_CODE'] : '',
                            'recipt_code'	=> isset($xmlData['MessageHead']['RECIPT_CODE']) ? $xmlData['MessageHead']['RECIPT_CODE'] : '',
                            'add_time'		=> isset($xmlData['MessageHead']['MESSAGE_TIME']) ? $xmlData['MessageHead']['MESSAGE_TIME'] : '',
                            'update_time'	=> date('Y-m-d H:i:s'),
                            'status'		=> '-1',
                            'file_path'		=> $targetFile,
                        );
                        $lastId = Service_CiqBackMessHead::add($header);
                        if(!$lastId){
                            throw new Exception('头部写入失败');
                        }
                        var_dump($xmlStringPre);

                        $receiptType = isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_TYPE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_TYPE'] : '';
                        //企业备案
                        if($receiptType == '200'){
                            $attribute = isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE6'])&&!empty($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE6']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE6'] : '';
                            //商品备案
                        }else if($receiptType == '210'){
                            $attribute = isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE7'])&&!empty($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE7']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['ATTRIBUTE7'] : '';
                        }else {
                            $attribute = '';
                        }
                        $body	= array(
                            'cbmh_id'		=> $lastId,
                            'receipt_type'	=> $receiptType,
                            'receipt_no'	=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_NO']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECEIPT_NO'] : '',
                            'msg_code'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_CODE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_CODE'] : '',
                            'msg_name'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_NAME']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_NAME'] : '',
                            'msg_desc'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_DESC']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['MSG_DESC'] : '',
                            'msg_time'		=> date('Y-m-d H:i:s'),
                            'attribute'		=> $attribute,
                            'back_field'	=> '',
                            'status'		=> -1,
                            'from_id'		=> isset($xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECIPT_CODE']) ? $xmlData['MessageBody'][$xmlStringPre.'Document'][$xmlStringPre.'Head']['RECIPT_CODE'] : '',
                            'update_time'	=> date('Y-m-d H:i:s'),
                        );
                        print_r($body);

                        if(!Service_CiqBackMessBody::add($body)){
                            throw new Exception('表体写入失败');
                        }
                        if(!copy($xmlFile, $targetFile)){
                            throw new Exception('拷贝文件失败');
                        }
                        @unlink($xmlFile);
                    }else{
                        throw new Exception('类型未找到');
                    }
                    //$db->commit();
                    $db->rollback();
                    $result['ask'] = 1;
                    $result['message'] = '处理成功';
                }catch(Exception $e){
                    $db->rollback();
                    //	throw new Exception($e->getMessage());
                    $result['message'] = $e->getMessage();
                }
            }else{
                $result['message'] = '报文不存在';
            }
            return $result;
        }

        parseIntoTable($file);



    }

    public function testAction(){
        echo 'ss';
        echo "<pre>";
        $value = 'ZCR008';
        Common_GetReceipt::getInstance($value);
    }
    public function productAction(){
        //$date = '2015-07-01 23:30:30';
        $date = '2016-07-31 00:00:00';
        //echo  strtotime($date);
        $aa = Common_Common::getEndDate(($date));
        print_r($aa);



    }

  /**
   * 支付宝支付信息推送
   */
  public function alipayAction() {
    $param    = $this->getRequest()->getParams();
    $response = Service_AlipayPayOrderProcess::transform($param);

    header('content-type: text/html; charset=utf-8');

    if (TRUE !== $response) {
      echo 'fail';
    }
    else {
      echo 'success';
    }
  }
}
