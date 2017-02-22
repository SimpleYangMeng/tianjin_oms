<?php
/**
 * Created by JetBrains PhpStorm.
 * User: william
 * Date: 14-9-5
 * Time: 下午3:59
 * To change this template use File | Settings | File Templates.
 */
class Default_ApiRefController extends Ec_Controller_DefaultAction
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

}
