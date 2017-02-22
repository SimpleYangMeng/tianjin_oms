<?php

/**
*
*/
class Common_IdNumberCheck
{
    const PAGESIZE = 5;
    public static $status = array(
        'verifiy_before' => 0,
        'verifiy_ing' => 1,
        'verifiy_success' => 2,
        'verifiy_fail' => 3,
        'error' => 4,
    );


    /**
     * 队列循环数据
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public static function getIdNumCheckData()
    {
        $idNumberCheck = Service_IdNumberCheck::getByStatus( self::$status['verifiy_before'],self::PAGESIZE);
        if(empty($idNumberCheck)){
            return false;
        }
        // var_dump($idNumberCheck);exit;
        foreach ($idNumberCheck as $key => $value) {
            //天津的号码跳出
            if(preg_match('/^120\d{14,}[\d\w]/i', $value['idNumber'])){
                continue;
            }
            $xml = self::getXmlCheck($value);
            $result =  self::getNciicCheck($xml);//api return;
            // print_r($result);exit;
            if($result['ask'] == 1){
                $db = Common_Common::getAdapter();
                $db->beginTransaction ();
                if(self::getVerifiy($result['result'],$value) === false){
                    throw new Exception("身份证验证失败！");
                    $db->rollback ();
                    continue;
                }else{
                    echo '验证成功!';
                }
                $db->commit();
            }

        }
    }

    /**
     * 回执报文处理
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public static function getVerifiy($result,$data)
    {
        //模拟结果报文
        // $result = file_get_contents('C:\Users\events\Desktop\1\job\tyes.xml');
        // $result = file_get_contents('C:\Users\events\Desktop\1\job\no.xml');
        // header( 'Content-Type:text/xml;charset=utf-8 ');
        //解析回执
        // print_r($result);exit;
        $xmlObject = simplexml_load_string($result->out);
        $xmlArray = Common_Message::analyzeResult($xmlObject);
        // print_r($xmlArray);exit;

        $incId = $data['inc_id'];

        //正常情况
        if(isset($xmlArray['ROW']['INPUT']) && !empty($xmlArray['ROW']['INPUT'])){
            $data = array();//返回数据
            $verifiyResult = array();//结果
            $result_gmsfhm ='';
            $result_xm ='';
            $data = $xmlArray['ROW'];
            $verifiyResult = $data['OUTPUT']['ITEM'];
            $idNumber = $data['INPUT']['gmsfhm'];//身份证号码
            $xm = $data['INPUT']['xm'];//身份姓名
            // print_r($idNumber); //身份证号码
            // print_r($idNumName);exit; //结果
            $rows = array();
            $row = array();
            foreach ($verifiyResult as $k => $v) {
                $v['result_gmsfhm'] = isset($v['result_gmsfhm']) ? trim($v['result_gmsfhm']) :'';
                $v['result_xm']     = isset($v['result_xm']) ? trim($v['result_xm']) :'';
                if(trim($v['result_gmsfhm']) == '一致'){
                    $result_gmsfhm = 1;
                }elseif(trim($v['result_xm']) == '一致'){
                    $result_xm = 1;
                }
                $rows[] = array(
                        'errorcode'=>isset($v['errorcode']) ? $v['errorcode'] :'',
                        'errormesage'=>isset($v['errormesage']) ? $v['errormesage'] :'',
                        'errormesagecol'=>isset($v['errormesagecol']) ? $v['errormesagecol'] :'',
                        'gmsfhm'=>isset($v['gmsfhm']) ? $v['gmsfhm'] :'',
                        'result_gmsfhm'=>isset($v['result_gmsfhm']) ? $v['result_gmsfhm'] :'',
                        'result_xm'=>isset($v['result_xm']) ? $v['result_xm'] :''
                );
            }
            //拼接结果字段
            list($array1, $array2)= $rows;
            foreach ($array1 as $key => $value) {
                if($value == ''){
                    $row[$key] = $array2[$key];
                }else{
                    $row[$key] = $value;
                }
            }

            // $IdNmuberCheck = Service_IdNumberCheck::getByField($idNumber,'idNumber');
            $IdNmuberCheck = Service_IdNumberCheck::getByField($idNumber,'idNumber');
            $account = Service_Account::getByCondition(array('account_real_name'=>$xm,'account_id_code'=>$idNumber));
            $row['inc_id'] = $IdNmuberCheck['inc_id'];
            $row['gmsfhm'] = $idNumber;
            $row['xm'] = $xm;
            // print_r($row);exit;
            if(empty($IdNmuberCheck)){
                continue;
            }
            if($result_gmsfhm==1 && $result_xm==1){// 验证通过
               // echo  $IdNmuberCheck['inc_id'];exit;
                if($IdNmuberCheck){
                    Service_IdNumberCheck::update(array('status'=>self::$status['verifiy_success']), $incId);
                    //子账号验证
                    if(!empty($account)){
                        Service_Account::update(array('account_auth_status'=>'2'),$account[0]['account_id']);
                    }
                    //订单验证
                    $orders = Service_Orders::getByField($incId,'inc_id');
                    if(!empty($orders)){
                        Service_Orders::update(array('id_check_status'=>'1'), $incId,'inc_id');
                    }
                }
            }else{//验证不通过
                Service_IdNumberCheck::update(array('status'=>self::$status['verifiy_fail']), $incId);
                //子账号验证
                if(!empty($account)){
                    Service_Account::update(array('account_auth_status'=>'3'),$account[0]['account_id']);
                }
                $orders = Service_Orders::getByField($incId,'inc_id');
                if(!empty($orders)){
                    Service_Orders::update(array('id_check_status'=>'2'), $incId,'inc_id');
                }
            }
            //更新业务逻辑
            // $orders = Service_Orders::getByField($incId,'inc_id');
            // if(!empty($orders)){
            //     Service_Orders::update(array('id_check_status'=>'1'), $incId,'inc_id');
            // }
            return Service_IdNumberCheckResult::add($row);//验证结果
        }else{
            //异常情况 （添加记录状态，不更新ORDERS表，更新INNUMBERCHECK表为异常状态）
            $row = array(
                        'errorcode'=>isset($xmlArray['ROWS']['ROW']['ErrorCode']) ? $xmlArray['ROWS']['ROW']['ErrorCode'] :'',
                        'errormsg'=>isset($xmlArray['ROWS']['ROW']['ErrorMsg']) ? $xmlArray['ROWS']['ROW']['ErrorMsg'] :'',
                        'inc_id'=>isset($data['inc_id']) ? $data['inc_id'] :'',
                        'errormesage'=>isset($xmlArray['ROWS']['ROW']['ErrorMesage']) ? $xmlArray['ROWS']['ROW']['ErrorMesage'] :''
            );
            //NowNumber
            Service_IdNumberCheck::update(array('status'=>self::$status['error']), $data['inc_id']);
            Service_Orders::update(array('id_check_status'=>'2'), $data['inc_id'],'inc_id');
            //子账户
            $rowAccount = array('account_real_name'=>$data['id_name'],'account_id_code'=>$data['idNumber']);
            $account = Service_Account::getByCondition($rowAccount);
            if(!empty($account)){
                Service_Account::update(array('account_auth_status'=>'3'),$account[0]['account_id']);
            }

            //订单

            $date = date('Y-m-d H:i:s');
            file_put_contents( APPLICATION_PATH."/../data/log/".'idNumberError.log', $date.'  :'.$result.PHP_EOL ,FILE_APPEND);
            return Service_IdNumberCheckResult::add($row);//异常结果
        }
        echo 'sucess run!!';
    }

    //拼接身份接口报文
    public static function getXmlCheck($array)
    {
        $xml  = "<?xml version='1.0' encoding='utf-8'?>";
        $xml .= "<ROWS>";
        $xml .= "<INFO><SBM>工商银行北京分行东城区支行</SBM></INFO>";//使用单位
        $xml .= "<ROW><GMSFHM>公民身份号码</GMSFHM><XM>姓名</XM></ROW>";
        $fsd = substr($array['idNumber'], 0,5);
        $xml .= "<ROW FSD='".$fsd."' YWLX='身份验证'><GMSFHM>".$array['idNumber']."</GMSFHM><XM>".$array['id_name']."</XM></ROW>";//GMSFHM身份证;姓名XM;FSD身份证前6位;YWLX业务类型
        $xml .= "</ROWS>";
        // header( 'Content-Type:text/xml;charset=utf-8 ');
        // echo $xml;exit;
        return $xml;

    }

    /**
     * 验证身份证接口
     * @param  string  $xml [description]
     * @return [xml]        [description]
     */
    public static function getNciicCheck($xml='')
    {
        // header("Content-type: text/html; charset=utf-8");
        if(empty($xml)){
            return;
        }
        $result = array(
            'ask' => 0,
            'result' => 0,
        );

        $licenseCode = file_get_contents(APPLICATION_PATH.'/../public/license.txt');
        $date = date('Y-m-d H:i:s');
        $res    = '';
        // $client = new SoapClient(self::url,array( 'trace' => 1 ));
        try{
            $client         = new SoapClient(APPLICATION_PATH.'/../public/NciicServices.wsdl');
            $params = array(
                'inLicense'   => $licenseCode,
                'inConditions' => $xml,
            );
            $res    = $client->nciicCheck($params);
            $result['ask'] = 1;
            $result['result'] = $res;
        }catch(Exception $e){
            echo $e->getMessage();
            file_put_contents( APPLICATION_PATH."/../data/log/".'idNumberCheck.log', $date.'  :'.$e->getMessage().PHP_EOL ,FILE_APPEND);
        }
        return $result;
    }


}
