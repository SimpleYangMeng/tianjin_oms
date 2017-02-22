<?php

/**
*
*   $queue = array(
*         'PersonItem'
*     );
*
*     foreach ($queue as $key => $value) {
*         try {
*             $object = Common_SendMessage::getInstance($value);
*             //发送报文
*             $object->sendMessage();
*             //获取回执
*             $object->getReceipt();
*         } catch (Exception $e) {
*
*         }
*     }
*/
class Common_ShangjianXml
{
	//实例
    static private  $instance   =  array();     
    /**
     * 取得实例
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public static function getInstance($type)
    {
        if(isset(self::$instance[$type]) && self::$instance[$type]){
            return self::$instance[$type];
        }
        include_once APPLICATION_PATH . "/models/Common/CiqUploadXml/Adapter.php";
        self::$instance[$type] = new Adapter($type);
        return self::$instance[$type];
    }

}
