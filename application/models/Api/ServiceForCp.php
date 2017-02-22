<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-9-9
 * Time: 上午11:41
 * To change this template use File | Settings | File Templates.
 */
class Api_ServiceForCp
{
    private $cainiaoOrderUrl = 'http://pac.partner.taobao.com/gateway/pac_message_receiver.do';
    private $cainiaoGanxianUrl = 'http://pac.partner.taobao.com/gateway/express_message_receiver.do';
    private $cainaokey = 'cscm1010'; //秘钥
    private $ganxiankey = 'cscm1010'; //干线key
    private $logistic_provide_id = 'Tran_Store_525614'; //菜鸟给的cp编号
    private $logistic_provide_id_ganxian = 'TRUNK_525673'; //干线code
    private $header = array(
        'Content-type' => 'Content-type: application/x-www-form-urlencoded',
        'charset' => 'UTF-8',
    );
    public function authenticate($customerCode,$token,$key){
        $error = array();
        if($customerCode==""||$token==""||$key==""){
            $error[] = 'customer_code or customer_password or key is null';
            return $error;
        }
        $customer = Service_Customer::getByField($customerCode, 'customer_code',"*");
        if(empty($customer)){
            $error[] = 'Customer ' . $customerCode . 'does not exist';
            return $error;
        }
        $customerAuth = Service_CustomerApi::getByField($customerCode, 'customer_code');
        if ($customerAuth && ($customerAuth['ca_token'] != $token || $customerAuth['ca_key'] != $key)) {
            $error[] = 'App Token/App Key Not match for ' .$customerCode ;
        }
        return $error;
    }

    public function sendToCainiao($xml,$msg_type){
        try{
            $curl_url=$this->cainiaoOrderUrl;
            $logistic_provide_id = $this->logistic_provide_id;
            $cainiao_public_key= $this->cainaokey;
            $mdString=md5($xml.$cainiao_public_key);
            $asring = pack('H*',$mdString);
            $jisuan = base64_encode($asring);
            $ch = curl_init();
            //file_put_contents(APPLICATION_PATH.'/../data/cainiao/'.'baowenEwe-'.date("Y-m-d H:i:s").'.txt',var_export($xml,true));
            //"=".$xml."&logistic_provider_id=".$logistic_provide_id."&msg_type=".$msg_type."&data_digest=".$jisuan
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "logistics_interface=".urlencode($xml)."&logistic_provider_id=".$logistic_provide_id."&msg_type=".$msg_type."&data_digest=".urlencode($jisuan));
            //curl_setopt($ch, CURLOPT_POSTFIELDS, );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//不直接输出，返回到变量
            $response = curl_exec($ch);
            //file_put_contents(APPLICATION_PATH.'/../data/cainiao/'.'cainaoresponse-'.date("Y-m-d H:i:s").'.txt',var_export($response,true));
            if(curl_errno($ch)){
                $result = array(
                    'responseItems'=>array(
                        'response'=>array(
                            'success'=>false,
                            'reason'=>'curl to cainai failse',
                            'reasonDesc'=>'curl to cainai failse'
                        )
                    )
                );
                curl_close($ch);
                return $result;
            }
            curl_close($ch);
            $obj = simplexml_load_string($response);
            $result = Common_Common::objectToArray($obj);
            $result=$this->getResult($result);
            return $result;
        }catch (Exception $e){
            $result = array(
                'responseItems'=>array(
                    'response'=>array(
                        'success'=>false,
                        'reason'=>'',
                        'reasonDesc'=>$e->getMessage(),
                    )
                )
            );
            return $result;
        }
    }
    /**
     * @author william-fan
     * @todo 海外仓干线信息
     */
    public function sendGanxianToCainiao($xml,$msg_type){
        try{
            $curl_url=$this->cainiaoGanxianUrl;
            $logistic_provide_id = $this->logistic_provide_id_ganxian;
            $cainiao_public_key= $this->ganxiankey;
            $mdString=md5($xml.$cainiao_public_key);
            $asring = pack('H*',$mdString);
            $jisuan = base64_encode($asring);
            $ch = curl_init();
            //file_put_contents('baowenEwe-'.date("Y-m-d H:i:s").'.txt',var_export($xml,true));
            $postArr = array(
                'logistics_interface'=>$xml,
                'logistic_provider_id'=>$logistic_provide_id,
                'msg_type'=>$msg_type,
                'data_digest'=>$jisuan
            );
            //"=".$xml."&logistic_provider_id=".$logistic_provide_id."&msg_type=".$msg_type."&data_digest=".$jisuan
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "logistics_interface=".urlencode($xml)."&logistic_provider_id=".$logistic_provide_id."&msg_type=".$msg_type."&data_digest=".urlencode($jisuan));
            //echo "logistics_interface=".$xml."&logistic_provider_id=".$logistic_provide_id."&msg_type=".$msg_type."&data_digest=".$jisuan;
            //curl_setopt($ch, CURLOPT_POSTFIELDS, );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//不直接输出，返回到变量
            $response = curl_exec($ch);
            //file_put_contents(APPLICATION_PATH.'/../data/cainiao/'.'cainaoresponse-'.date("Y-m-d H:i:s").'.txt',var_export($response,true));
            if(curl_errno($ch)){
                $result = array(
                    'responseItems'=>array(
                        'response'=>array(
                            'success'=>false,
                            'reason'=>'curl to cainai failse',
                            'reasonDesc'=>'curl to cainai failse'
                        )
                    )
                );
                curl_close($ch);
                return $result;
            }
            curl_close($ch);
            $obj = simplexml_load_string($response);
            $result = Common_Common::objectToArray($obj);
            $result=$this->getResult($result);
            return $result;
        }catch (Exception $e){
            $result = array(
                'responseItems'=>array(
                    'response'=>array(
                        'success'=>false,
                        'reason'=>'',
                        'reasonDesc'=>$e->getMessage(),
                    )
                )
            );
            return $result;
        }
    }
    /**
     * @author william-fan
     * @todo 不明白菜鸟返回两个格式的xml 处理成统一的
     */
    public function getResult($result){
       /*1) array(
         'success' => false
         'errorCode' => 'S02',
         'errorMsg' => 'digist sign check not pass'
       )
       2)*/
       //网关错误
       if(isset($result['success'])){
           $result = array(
               'responseItems'=>array(
                   'response'=>array(
                       'success'=>$result['success'],
                       'reason'=>$result['errorCode'],
                       'reasonDesc'=>$result['errorMsg'],
                   )
               )
           );
           return $result;
       }elseif(isset($result['is_success'])){
           $result = array(
               'responseItems'=>array(
                   'response'=>array(
                       'success'=>$result['is_success'],
                       'reason'=>$result['error_code'],
                       'reasonDesc'=>$result['error_msg'],
                   )
               )
           );
           return $result;
       }else{
            return $result;
       }
    }

}
