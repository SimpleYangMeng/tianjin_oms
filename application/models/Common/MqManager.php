<?php
/**
 * Created by PhpStorm.
 * User: WilliamFan
 * Date: 15-11-28
 * Time: 下午2:16
 */
class Common_MqManager
{
    const APPKEY  = 'asdf$2015@bh';
    private $conn = ''; //队列管理器的连接

    private $connReceive = ''; //接收管理连接
    /*private $channelName='EN_TO_TRANS'; //mq通道
    private $connectionName='192.168.31.230';//mq连接地址
    private $qMgrName = 'QM_ENTERPRISE'; //队列管理器名称*/

    private $channelName    = 'CLIENT_C_SEND';  //mq发送通道
    private $connectionName = '10.128.132.205'; //mq连接地址
    private $qMgrName       = 'QM_ENTERPRISE';  //队列管理器名称
    private $qName          = 'CUSTOM_QUEUE';   //mq发送队列名称

    private $channelNameReceive = 'CLIENT_C_REC';     //mq接收通道
    private $qNameReceive       = 'ENTERPRISE_QUEUE'; //mq接收队列

    private $connectionNameReceive = '10.128.132.205';

    /*private $channelName='MQ_PUT'; //mq通道
    private $connectionName='192.168.31.222';//mq连接地址
    private $qMgrName = 'QM_ENTERPRISE'; //队列管理器名称
    private $qName = 'CUSTOM_QUEUE'; //队列名称*/

    private $openUserObj = ''; //打开mq使用的对象

    private $comp_code = ''; //完成代码
    private $reason    = ''; //原因代码

    private $error = ''; //错误信息

    private $mqcno = array(
    ); //mq发送连接参数

    //mq接收连接参数
    private $mqReceiveCno = array();

    private $applIdentityData = '';

    private $msg                = '';
    private $receiveopenUserObj = '';

    /**
     * ObjectQMgrName对应“队列管理器”
     * ChannelName对应“mq通道”
     * ConnectionName对应“MQ地址IP”
     * ObjectName对应“队列名称”
     *  接收队列（队列管理器、MQ地址IP一样）
     *
     */

    /**
     * @author william-fan
     * @todo mq初始化
     */
    public function __construct($applIdentityData = '')
    {
        $this->applIdentityData = $applIdentityData;
    }
    /**
     * @author william-fan
     * @todo mq发送连接
     */
    public function setmqcno()
    {
        $this->mqcno = array(
            'Version' => MQSERIES_MQCNO_VERSION_2,
            'Options' => MQSERIES_MQCNO_STANDARD_BINDING,
            'MQCD'    => array(
                'ChannelName'    => $this->channelName,
                'ConnectionName' => $this->connectionName,
                'TransportType'  => MQSERIES_MQXPT_TCP,
            ),
        );
        if ($this->applIdentityData != '') {
            $this->mqcno['MQCD']['ApplIdentityData'] = $this->applIdentityData;
        }
        mqseries_connx($this->qMgrName, $this->mqcno, $this->conn, $this->comp_code, $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
            return;
        }
    }
    /**
     * @author william-fan
     * @todo mq接收连接
     */
    public function setmqcnoReceive()
    {
        $this->mqReceiveCno = array(
            'Version' => MQSERIES_MQCNO_VERSION_2,
            'Options' => MQSERIES_MQCNO_STANDARD_BINDING,
            'MQCD'    => array('ChannelName' => $this->channelNameReceive,
                'ConnectionName'                 => $this->connectionNameReceive,
                'TransportType'                  => MQSERIES_MQXPT_TCP),
        );

        mqseries_connx($this->qMgrName, $this->mqReceiveCno, $this->connReceive, $this->comp_code, $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
            exit;
        }
    }
    /**
     * @author william-fan
     * @todo 设置队列
     */
    public function mqopen($qname)
    {
        $mqods = array('ObjectName' => $qname, 'ObjectQMgrName' => $this->qMgrName);
        /*mqseries_open(
        $this->conn,
        $mqods,
        MQSERIES_MQOO_INPUT_AS_Q_DEF | MQSERIES_MQOO_FAIL_IF_QUIESCING | MQSERIES_MQOO_OUTPUT,
        $this->openUserObj,
        $this->comp_code,
        $this->reason);*/
        mqseries_open(
            $this->conn,
            $mqods,
            MQSERIES_MQOO_FAIL_IF_QUIESCING | MQSERIES_MQOO_OUTPUT,
            $this->openUserObj,
            $this->comp_code,
            $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
            return;
        }
    }
    /**
     * @author william-fan
     * @todo mq接收回执连接
     */
    public function mqReceiveOpen()
    {
        $mqods = array('ObjectName' => $this->qNameReceive, 'ObjectQMgrName' => $this->qMgrName);
        mqseries_open(
            $this->connReceive,
            $mqods,
            MQSERIES_MQOO_FAIL_IF_QUIESCING | MQSERIES_MQOO_OUTPUT,
            $this->receiveopenUserObj,
            $this->comp_code,
            $this->reason);

        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
            return;
        }
    }
    /**
     * @author william-fan
     * @todo 发消息
     */
    public function putMessage($message)
    {

        //签名
        $sign    = md5($message . Common_MqManager::APPKEY);
        $message = $sign . $message;
        // echo $message;

        $qname = $this->qName;
        $this->setmqcno();
        $this->mqopen($qname);
        $result = array(
            'ask'     => '0',
            'message' => '',
            'error'   => '',
        );
        if (empty($message)) {
            $result['message'] = '报文为空';
            return $result;
        }
        $md = array(
            'Version'     => MQSERIES_MQMD_VERSION_1,
            'Expiry'      => MQSERIES_MQEI_UNLIMITED,
            'Report'      => MQSERIES_MQRO_NONE,
            'MsgType'     => MQSERIES_MQMT_DATAGRAM,
            'Format'      => MQSERIES_MQFMT_STRING,
            'Priority'    => 1,
            'Persistence' => MQSERIES_MQPER_PERSISTENT);

        $pmo = array('Options' => MQSERIES_MQPMO_NEW_MSG_ID);
        mqseries_put(
            $this->conn,
            $this->openUserObj,
            $md,
            $pmo,
            $message,
            $this->comp_code,
            $this->reason);

        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
        } else {
            $result['ask'] = '1';
        }
        mqseries_close($this->conn, $this->openUserObj, MQSERIES_MQCO_NONE, $this->comp_code, $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $result['error'] = mqseries_strerror($this->reason);
        }
        mqseries_disc($this->conn, $this->comp_code, $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $result['error'] = mqseries_strerror($this->reason);
        }
        $result['error'] = $this->error;
        return $result;
    }

    public function getMessge2()
    {
        $result = array(
            'ask'     => '0',
            'message' => '',
            'error'   => '',
            'data'    => '',
        );

        /*$mqcno = array(
        'Version' => MQSERIES_MQCNO_VERSION_2,
        'Options' => MQSERIES_MQCNO_STANDARD_BINDING,
        'MQCD' => array('ChannelName' => 'CLIENT_C_REC',
        'ConnectionName' => 'localhost',
        'TransportType' => MQSERIES_MQXPT_TCP)
        );*/

        $mqcno = array(
            'Version' => MQSERIES_MQCNO_VERSION_2,
            'Options' => MQSERIES_MQCNO_STANDARD_BINDING,
            'MQCD'    => array('ChannelName' => $this->channelNameReceive,
                'ConnectionName'                 => $this->connectionNameReceive,
                'TransportType'                  => MQSERIES_MQXPT_TCP),
        );

        mqseries_connx('QM_ENTERPRISE', $mqcno, $conn, $comp_code, $reason);
        if ($comp_code !== MQSERIES_MQCC_OK) {
            $this->error       = mqseries_strerror($reason);
            $result['message'] = $this->error;
            return $result;
        }
        /*$mqods = array('ObjectName' => 'ENTERPRISE_QUEUE', 'ObjectQMgrName' => 'QM_ENTERPRISE');*/

        $mqods = array('ObjectName' => $this->qNameReceive, 'ObjectQMgrName' => $this->qMgrName);
        mqseries_open(
            $conn,
            $mqods,
            MQSERIES_MQOO_INPUT_AS_Q_DEF | MQSERIES_MQOO_FAIL_IF_QUIESCING | MQSERIES_MQOO_OUTPUT,
            $obj,
            $comp_code,
            $reason);
        if ($comp_code !== MQSERIES_MQCC_OK) {
            $this->error       = mqseries_strerror($reason);
            $result['message'] = $this->error;
            return $result;
        }

        $mdg = array();
        $gmo = array('Options' => MQSERIES_MQGMO_FAIL_IF_QUIESCING | MQSERIES_MQGMO_WAIT, 'WaitInterval' => 3000);
        mqseries_get(
            $conn, $obj,
            $mdg,
            $gmo,
            1048576,
            $msg,
            $data_length,
            $comp_code,
            $reason);

        if ($comp_code !== MQSERIES_MQCC_OK) {
            printf("GET CompCode:%d Reason:%d Text:%s<br>", $comp_code, $reason, mqseries_strerror($reason));
            $this->error       = mqseries_strerror($reason);
            $result['message'] = $this->error;
            return $result;
        }

        mqseries_close($conn, $obj, MQSERIES_MQCO_NONE, $comp_code, $reason);
        if ($comp_code !== MQSERIES_MQCC_OK) {
            $this->error       = mqseries_strerror($reason);
            $result['message'] = $this->error;
        }
        mqseries_disc($conn, $comp_code, $reason);
        if ($comp_code !== MQSERIES_MQCC_OK) {
            $this->error       = mqseries_strerror($reason);
            $result['message'] = $this->error;
            return $result;
        }
        $result['ask']  = '1';
        $result['data'] = $msg;
        return $result;
    }

    /**
     * @author william-fan
     * @todo 得到消息
     * 用类暂时获取不到，暂时用getMessge2方法
     */
    public function getMessage()
    {
        /*$this->getMessge2();

        return;*/
        $result = $this->getMessge2();
        return $result;
        $result = array(
            'ask'     => '0',
            'message' => '',
            'error'   => '',
            'data'    => '',
        );
        $this->setmqcnoReceive();
        $this->mqReceiveOpen();

        $mdg = array();
        $gmo = array('Options' => MQSERIES_MQGMO_FAIL_IF_QUIESCING | MQSERIES_MQGMO_WAIT, 'WaitInterval' => 3000);
        mqseries_get(
            $this->connReceive, $this->receiveopenUserObj,
            $mdg,
            $gmo,
            3098,
            $this->msg,
            $data_length,
            $this->comp_code,
            $this->reason);

        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
        } else {
            $result['data'] = $this->msg;
        }

        var_dump($this->msg);
        echo "<br>";

        mqseries_close($this->connReceive, $this->receiveopenUserObj, MQSERIES_MQCO_NONE, $this->comp_code, $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
        }
        mqseries_disc($this->connReceive, $this->comp_code, $this->reason);
        if ($this->comp_code !== MQSERIES_MQCC_OK) {
            $this->error = mqseries_strerror($this->reason);
        }

        return $result;
    }

}
