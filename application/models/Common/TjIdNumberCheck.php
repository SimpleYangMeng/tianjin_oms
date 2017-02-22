<?php

/**
*
*/
class Common_TjIdNumberCheck
{
    const PAGESIZE = 5;
    const WSDL_URL = 'http://10.120.207.11:8080/kab/services/DataTransfer?wsdl';
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
    public static function idNumCheckData()
    {
        $idNumberCheck = Service_IdNumberCheck::getByStatus( self::$status['verifiy_before'],self::PAGESIZE);
        if(empty($idNumberCheck)){
            echo '暂无数据处理';
            return false;
        }
        foreach ($idNumberCheck as $key => $idrow) {
            //天津的号码才处理
            if(preg_match('/^120\d{14,}[\d\w]/i', $idrow['idNumber'])){
                $idNameArr = array(
                    'idcard' => $idrow['idNumber'],
                    'name' => $idrow['id_name']
                );
                // echo '<pre>';
                // print_r($idrow);
                //调用接口验证
                $check_return = self::tjCheckIdNumber($idNameArr);
                $db = Common_Common::getAdapter();
                $db->beginTransaction ();
                $do_res = self::doResult($idrow, $check_return);
                if($do_res['ask'] == 0){
                    $db->rollback ();
                    echo '身份证['.$idrow['id_name'].'-'.$idrow['idNumber'].']验证失败';
                    continue;
                }else {
                    $db->commit ();
                    echo '身份证['.$idrow['id_name'].'-'.$idrow['idNumber'].']验证成功';
                }
            }
        }
    }

    /**
     * [tjCheckIdNumber 调用天津公安局接口验证]
     * @param  [array] $idNameArr [验证数据数组]
     * array(
     *       'idcard' => '120105198511081529',
     *       'name' => '肖珊'
     *  )
     * @return [type]            [0/1 OK/NG]
     */
    private static function tjCheckIdNumber($idNameArr){
        $return = array('ask'=>0, 'message'=>'');
        if(empty($idNameArr) || !array_key_exists('idcard', $idNameArr) || !array_key_exists('name', $idNameArr)){
            $return['message'] = '数据错误';
            return $return;
        }
        try{
            $client = new SoapClient(self::WSDL_URL, array('encoding'=>'utf-8','cache_wsdl' => 0,'compression'=>true));
            $client->soap_defencoding = 'utf-8';
            $client->xml_encoding = 'utf-8';
            $check_res = $client->__soapCall('confirmIdentityHandllerRequest', array('parameters'=> $idNameArr));
            if(isset($check_res->return) && $check_res->return == 1){
                $return['ask'] = 1;
                $return['message'] = '验证成功';
            }else {
                $return['message'] = '验证失败';
            }
        }catch(Exception $e) {
            $return['message'] = $e->getMessage();
        }
        return $return;
    }

    /**
     * 回执报文处理
     * @param  string $type [description]
     * @return [type]       [description]
     */
    private static function doResult($idrow, $check_return)
    {
        $return = array('ask' => 0, 'message'=>'身份证['.$idrow['idNumber'].']验证回执处理失败:'.$check_return['message']);
        if(!empty($idrow) && is_array($idrow)){
            $account = Service_Account::getByCondition(array('account_real_name'=>$idrow['id_name'], 'account_id_code'=>$idrow['idNumber']));
            $result_gmsfhm = $result_xm = '';
            //验证成功
            if(array_key_exists('ask', $check_return) && $check_return['ask'] == 1){
                $result_gmsfhm = $result_xm = '一致';
                Service_IdNumberCheck::update(array('status'=>self::$status['verifiy_success']), $idrow['inc_id']);
                //子账号验证
                if(!empty($account)){
                    Service_Account::update(array('account_auth_status'=>'2'),$account[0]['account_id']);
                }
                //订单验证
                $orders = Service_Orders::getByField($idrow['inc_id'], 'inc_id');
                if(!empty($orders)){
                    Service_Orders::update(array('id_check_status'=>'1'), $idrow['inc_id'],'inc_id');
                }
            //不一致
            }else {
                $result_gmsfhm = $result_xm = '不一致';
                Service_IdNumberCheck::update(array('status'=>self::$status['verifiy_fail']), $idrow['inc_id']);
                //子账号验证
                if(!empty($account)){
                    Service_Account::update(array('account_auth_status'=>'3'),$account[0]['account_id']);
                }
                $orders = Service_Orders::getByField($idrow['inc_id'],'inc_id');
                if(!empty($orders)){
                    Service_Orders::update(array('id_check_status'=>'2'), $idrow['inc_id'],'inc_id');
                }
            }
            $icrow = array(
                'inc_id' => $idrow['inc_id'],
                'gmsfhm' => $idrow['idNumber'],
                'result_gmsfhm' => $result_gmsfhm,
                'xm' => $idrow['id_name'],
                'errorcode' => $check_return['ask'],
                'result_xm' => $result_xm,
                'errormsg' => '天津公安局接口返回'.$check_return['ask'],
                'errormesage' => '',
                'errormesagecol' => '',
            );
            if(Service_IdNumberCheckResult::add($icrow)){
                $return['ask'] = 1;
                $return['message'] = '身份证['.$idrow['idNumber'].']验证回执处理成功';
            }
        }
        return $return;
    }
}