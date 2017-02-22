<?php
/**
 * 光机接口
 */
class Api_ServiceForXmachine
{
    public $checkData;
    protected $_error = array();
    //将传递过来的对象转为数组存储
    protected $_paramterArr = array();
    protected $_date;

    private function common ($checkData) {
        //对象转数组
        $this->checkData = Common_Common::objectToArray($checkData);
        $this->_date = date('Y-m-d H:i:s');
    }

    /**
     * [checkResult 接收接口数据]
     * @param  [type] $checkData [description]
     * @return [type]           [description]
     */
    public function checkResult($checkData){
        //模拟接口数据
        /*
        $checkData = '<?xml version="1.0" encoding="UTF-8"?>
<message><entryid>02082016I000000478</entryid><ieFlage>I</ieFlage><orderNo>OC0000002475</orderNo><logisticsNo>50002195307885</logisticsNo><logisticsCode>0208W00021</logisticsCode><logisticsName>天津天保宏信物流中心有限公司</logisticsName><checkResult>P</checkResult><checkDate>2016-05-04</checkDate><checkType>A</checkType><checkMan>simple</checkMan><checkOpinion>查验放行</checkOpinion></message>';
        */
        $messageObject = new Common_Message();
        $result = array(
            'result' => 'failure',
            'msg' => '入库失败',
            'code' => '1002'
        );
        $this->common($checkData);
        $this->logError('接收接口数据-XML:'.var_export($this->checkData, true));
        if(is_array($this->checkData) && !empty($this->checkData) && array_key_exists('checkData', $this->checkData)){
            $xmlObj = simplexml_load_string($this->checkData['checkData']);
            $checkDataArr = Common_Message::analyzeResult($xmlObj);
            //$this->logError('数组数据:'.var_export($checkDataArr, true));
            $insertData = $this->check($checkDataArr);
            $this->logError('数组数据:'.var_export($insertData, true));
            if(!empty($this->_error)){
                $result['msg'] = join(',', $this->_error);
            }else {
                $insertData['ccr_add_time'] = date('Y-m-d H:i:s');
                $ccr_id = Service_CiqCheckResult::add($insertData);
                if($ccr_id){
                    $result['result'] = 'success';
                    $result['msg'] = '入库成功';
                    $result['code'] = $ccr_id;
                }
            }
        }else {
            $result['code'] = '1001';
            $result['msg'] = '数据格式异常';
        }
        $result = $messageObject->cearteResult($result, 'message');
        //记录日志
        $this->logError('返回数据:'.var_export($result, true));
        return array('return' => $result);
    }

    /**
     * [check 检测数据]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function check($data){
        if(empty($data)){
            $this->_error[] = '请求数据为空';
        }
        if(!is_array($data) || !array_key_exists('head', $data)){
            $this->_error[] = '数据格式异常';
        }
        return $data['head'];
    }
    /**
     * @todo 写日志
     */
    private function logError ($error) {
        $logger = new Zend_Log();
        $uploadDir = APPLICATION_PATH . "/../data/log/";
        $writer = new Zend_Log_Writer_Stream($uploadDir . 'xmachine.log');
        $logger->addWriter($writer);
        $logger->info(date('Y-m-d H:i:s') . ': ' . $error . " \r\n");
    }
}
