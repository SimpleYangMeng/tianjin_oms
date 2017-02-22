<?php

/**
*
*/
class Adapter
{
    private $_type = '';

    public function __construct($type)
    {
        $class = $type . 'UploadXml';
        $classPath = APPLICATION_PATH . "/models/Common/CiqUploadXml/Adapter/{$class}.php";
        if(!file_exists($classPath)){
            throw new Exception('报文类型[' . $type . ']不存在!');
        }
        include_once(APPLICATION_PATH . '/models/Common/CiqUploadXml/ShangJianXmlParent.php');
        include_once($classPath);
        if(!class_exists($class)){
            throw new Exception('报文类型[' . $type . ']的类['. $class .']不存在!');
        }
        $this->_type = new $class();
    }

    /**
     * [FunctionName 调用开始方法]
     * @param string $value [description]
     */
    public function uploadXml()
    {
        $this->_type->begin();
    }
}
