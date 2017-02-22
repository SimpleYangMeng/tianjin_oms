<?php

/**
*
*/
class Driver
{
    private $_type = '';

    public function __construct($type)
    {
        $class = $type . 'SendMessage';
        $classPath = APPLICATION_PATH . "/models/Common/SendMessage/Driver/{$class}.php";
        if(!file_exists($classPath)){
            throw new Exception('报文类型[' . $type . ']不存在!');
        }
        include_once(APPLICATION_PATH . '/models/Common/SendMessage/SendMessageParent.php');
        include_once($classPath);
        if(!class_exists($class)){
            throw new Exception('报文类型[' . $type . ']的类['. $class .']不存在!');
        }
        $this->_type = new $class();
    }

    /**
     * [FunctionName description]
     * @param string $value [description]
     */
    public function sendMessage()
    {
        $this->_type->begin('sendMessage');
    }
}
