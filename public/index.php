<?php
@header('Content-Type:text/html;charset=utf-8');

if ('120.24.52.244' === $_SERVER['HTTP_HOST']) {
    // 禁止使用IP访问网站
    exit('<h1>禁止使用IP地址访问网站，请使用域名imoms.globex.cn代替！</h1>');
}
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL|E_STRICT);//开启错误报告
//error_reporting(0);//关闭错误报告
// error_reporting(E_ALL);
// error_reporting(0);//关闭错误报告
ini_set("soap.wsdl_cache_enabled", "0");
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());

    return $usec + $sec;
}

$start_t = microtime_float();

//error_reporting(0);//开启错误报告
date_default_timezone_set('Asia/Shanghai'); //配置地区
// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../libs'),
    realpath(APPLICATION_PATH . '/models'),
    realpath(APPLICATION_PATH . '/modules'),
    APPLICATION_PATH,
    get_include_path(),
)));
define('WEB_URL', 'http://' . $_SERVER['HTTP_HOST']);
/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/server.ini'
);

$application->bootstrap();
//$application->getBootstrap()->getResource("frontController")->setParam('useDefaultControllerAlways', true);
$application->run();
