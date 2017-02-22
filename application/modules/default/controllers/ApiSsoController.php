<?php
/**
 * 接口注册、登陆
 */
class Default_ApiSsoController extends Ec_Controller_DefaultAction
{
    protected static $defaultMethods = array(
        'Sso'
    );

    /**
     * [ssoAction description]
     * @return [type] [description]
     */
    public function ssoAction()
    {
        header("Content-Type: text/xml;charset=utf-8");
        $request = $this->_request->getParams();
        $method = isset($request['method']) ? $request['method'] : '';
        $defaultMethods = self::$defaultMethods;
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
}