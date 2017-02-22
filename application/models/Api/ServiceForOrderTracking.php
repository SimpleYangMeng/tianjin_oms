<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-5-26
 * Time: 下午3:22
 * To change this template use File | Settings | File Templates.
 */
class Api_ServiceForOrderTracking
{
    protected $_customerId = null;

    protected $_customer = null;

    protected $_token = null;

    protected $_key = null;

    protected $_auth = false;

    protected $_error = null;

    protected $_date = null;

    protected $_paramterArr = array();//将传递过来的对象转为数组存储

    private function _init ($headerRequest) {
        $this->_customerId = (string) $headerRequest['customerCode'];
        $this->_token = (string) $headerRequest['appToken'];
        $this->_key = (string) $headerRequest['appKey'];
    }

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
        $writer = new Zend_Log_Writer_Stream($uploadDir . 'order-tracking.log');
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

    public function getOrderTracking($paramter){
        $this->common($paramter);
        $result = array(
            'ask' => '0',
            'message' => '',
            'orderCode' => '',
            'error' => array(),
            'TrackingInfo'=>""
        );
        if ($this->_error) {
            $result['message'] = $this->_error;
            return $result;
        }
        $orderCode = $this->_paramterArr['orderCode'];
        if (empty($orderCode)) {
            $this->_error= '订单号不能为空';
            $result['ask'] = '0';
            $result['message'] = $this->_error;
            return $result;
        }
        $orders = Service_Orders::getByCondition(array("new_reference_no"=>$orderCode),"*",1,1);
        if(empty($orders)){
            $this->_error= '不存在此交易订单号或订单号'.$orderCode;
            $result['ask'] = '0';
            $result['message'] = $this->_error;
            return $result;
        }
        $shipOrderTracking = Service_ShipOrderTracking::getByCondition(array('order_code'=>$orders[0]['order_code']),"*");
        $result['TrackingInfo'] = $shipOrderTracking;
        $result['ask'] = "1";
        $result['orderCode'] = $orders[0]['order_code'];
        return $result;
    }
}
