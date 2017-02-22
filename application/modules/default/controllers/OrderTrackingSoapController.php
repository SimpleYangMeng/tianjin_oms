<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 14-5-26
 * Time: 下午3:48
 * To change this template use File | Settings | File Templates.
 */
class Default_OrderTrackingSoapController extends Zend_Controller_Action
{
    public function preDispatch(){
        $this->tplDirectory	= "default/views/default/";
    }
    public function indexAction () {
        $this->_forward('wsdl');
    }

    public function webServiceAction () {
        $input = file_get_contents('php://input');
        if(!empty($input)){
            $server = new SoapServer(APPLICATION_PATH . "/../data/wsdl/ServiceForOrderTracking.wsdl");
            $server->setClass('Api_ServiceForOrderTracking');
            $server->handle();
        }else{
            echo 'Invalid SOAP request';
        }
        exit;
    }
    public function wsdlAction () {
        $host = $this->_request->getHttpHost();
        //echo $host;exit;
        header("Content-type: text/xml; Charset=utf-8");
        $content = file_get_contents(APPLICATION_PATH . "/../data/wsdl/ServiceForOrderTracking.wsdl");
        $content = preg_replace('/www\.jinkouoms\.com/', $host, $content);
        echo $content;
        exit();
    }
    public function wsdlFileAction () {
        $host = $this->_request->getHttpHost();
        $content =  file_get_contents(APPLICATION_PATH . "/../data/wsdl/ServiceForOrderTracking.wsdl");
        $content = preg_replace('/www\.jinkouoms\.com/',$host,$content);
        $fileName = preg_replace('/([a-zA-Z_0-9]+)\.([a-zA-Z_0-9]+)\.([a-zA-Z_0-9]+)/e', 'strtolower(\\1)', $host);
        $fileName = APPLICATION_PATH.'/../data/cache/'.$fileName.'-ServiceForOrderTracking.wsdl';
        if(!file_exists($fileName)){
            file_put_contents($fileName, $content);
        }
        Common_Common::downloadFile($fileName);
        exit;
    }
}
