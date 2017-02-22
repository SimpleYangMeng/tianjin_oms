<?php

/**
* 报文生成类
* 直接传数组就可以生成xml
* @author luffyzhao
* $header = array(
*            "MessageID" => '0001',
*            "FunctionCode" => 'ABS001',
*            "MessageType" => '01',
*            "SenderID" => '发送方代码',
*            "ReceiverID" => '接受方代码',
*            "SendTime" => '20151120213052124',
*            "Version" => '1.0'
*        );
*
*        $declaration = array(
*            'SEQ_ID' => '唯一序列号'
*        );
*
*        $messageArray = array(
*            'Head' => $header,
*            'Declaration' => $declaration
*        );
*        try {
*            $messageObject = new Common_Message('product');
*            echo $messageObject -> cearteResult($messageArray);
*        } catch (Exception $e) {
*            echo $e->getMessage();
*        }
*/
class Common_Message
{
    private static $_error;

    private $obj = null;
    private $_xmlObject = array();


    /**
     * [cearteMessage description]
     * @param  [type] $dataInfo [description]
     * @return [type]           [description]
     */
    public static function cearteMessage($dataInfo, $type="Message")
    {
        $object = new Common_Message();
        try {
            $xml = $object->cearteResult($dataInfo, $type);
        } catch (Exception $e) {
            self::$_error = $e->getMessage();
            return false;
        }
        return $xml;
    }
    /**
     * [getError description]
     * @return [type] [description]
     */
    public static function getError()
    {
        return self::$_error;
    }

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->obj = new DomDocument('1.0', 'UTF-8');
    }
    /**
     * [cearteResult description]
     * @param  [type] $headerInfo [description]
     * @param  [type] $dataInfo   [description]
     * @return [type]             [description]
     */
    public function cearteResult($dataInfo, $type="Message")
    {

        //验证数据
        $this->verification($dataInfo);
        $Message = $this->cearte($dataInfo, $type);
        $this->insertParent($this->obj, $Message);

        $MessageXML =  $this->obj->saveXML();

        return $MessageXML;
    }

    /**
     * [cearte description]
     * @param  [type] $info [description]
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function cearte($info , $type)
    {
        if(!is_array($info) || empty($info)){
            throw new Exception('参数错误');
        }
        $element = array();
        foreach ($info as $key => $value) {
            if(is_array($value) && empty($value)){
                continue;
            }
            if(is_numeric($key)){
                if(is_array($value)){
                    foreach ($value as $elementKey => $elementValue) {
                        if(empty($element[$key])){
                            $element[$key] = $this->obj->createElement($type);
                        }
                        $this->insertParent($element[$key], $this->cearteChildElement($elementKey, $elementValue));
                    }
                }else{
                    $element[$key] = $this->obj->createElement($type, $value);
                }
            }else{
                if(empty($element)){
                    $element = $this->obj->createElement($type);
                }
                $this->insertParent($element, $this->cearteChildElement($key, $value));
            }
        }
        return $element;
    }


    /**
     * [cearteChildElement description]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    private function cearteChildElement($elementKey, $elementValue)
    {
        $element = null;
        if(is_array($elementValue)){
            $element = $this->cearte($elementValue , $elementKey);
        }else{
            $element = $this->obj->createElement($elementKey);
            $elementValue = htmlentities ( $elementValue ,  ENT_QUOTES  |  ENT_IGNORE ,  "UTF-8" );
            $text = $this->obj->createTextNode($elementValue);
            $element->appendchild($text);
        }
        return $element;
    }

    /**
     * [insertParent description]
     * @param  [type] &$parentElement [description]
     * @param  [type] $childElement   [description]
     * @return [type]                 [description]
     */
    private function insertParent(&$parentElement, $childElement)
    {
        if(is_array($childElement)){
            foreach ($childElement as $key => $value) {
                $parentElement->appendChild($value);
            }
        }else{
            $parentElement->appendChild($childElement);
        }

    }



    /**
     * 数组是否有序数组
     * @param  [type] $info [description]
     * @return [type]       [description]
     */
    private function judgeArrayType($info)
    {
        $keys = key($info);
        if(!is_array($keys)){
            return false;
        }
        return is_numeric(current($keys));
    }

    private function verification($dataInfo)
    {
        // if(!isset($dataInfo['Head'])){
        //     throw new Exception('报文头不存在！');
        // }
        // if(!isset($dataInfo['Declaration'])){
        //     throw new Exception('报文体不存在！');
        // }
        //验证报文头字段
        // $headerObject = new headerVerificationForMessage();
        // $headerObject->run($dataInfo['Head']);

    }

    /**
     * [analyzeResult description]
     * @param  [type] $xmlString [description]
     * @return [type]            [description]
     */
    public static function analyzeResult($xmlObject)
    {
        $xmlArray = (array)$xmlObject;
        if(empty($xmlArray)){
            return '';
        }
        $data = array();
        foreach ($xmlArray as $key => $value) {
            if(!is_string($value)){
                $data[$key] = self::analyzeResult($value);
            }else{
                $data[$key] = $value;
            }
        }
        return $data;
    }


}


/**
 *  验证基类
 */
abstract class verificationForMessage
{
    protected $fields;
    protected $className;

    /**
     * 验证
     * @param  [type] $headerInfo [description]
     * @return [type]             [description]
     */
    public function run($headerInfo)
    {
        foreach ($this->fields as $field => $verification) {
            // required验证
            if(!isset($headerInfo[$field]) && $verification['required']){
                throw new Exception( $this->className .'验证字段:'. $verification['desc'] .'['. $field .']不存在！');
            }
            // 长度验证
            if(isset($verification['max'])){
                if(strlen( $headerInfo[$field] ) > $verification['max']){
                    throw new Exception( $this->className .'验证字段:'. $verification['desc'] .'['. $field .']长度不能大于'.$verification['max']);
                }
            }

            if(isset($verification['pattern'])){
                if(!preg_match("/^{$verification['pattern']}$/" , $headerInfo[$field])){
                    throw new Exception( $this->className .'验证字段:'. $verification['desc'] .'['. $field .']正则验证不通过！');
                }
            }
        }
    }
}

/**
* 报文头部验证
* array('required'=>true , 'type'=>'varchar' , 'max'=>50 , 'desc'=>'报文版本'),
*
*/
class headerVerificationForMessage extends verificationForMessage
{
    protected $className = '报文头';

    protected $fields = array(
        'MessageID' => array('required'=>true , 'type'=>'varchar' , 'max'=>50 , 'desc'=>'报文编号'),
        "FunctionCode" => array('required'=>true , 'desc' => '报文功能代码'),
        "MessageType" => array('required'=>true , 'type'=>'varchar' , 'max'=>6 , 'desc'=>'报文类型代码'),
        "SenderID" => array('required'=>true , 'desc'=>'发送方代码'),
        "ReceiverID" => array('required'=>true , 'desc'=>'接受方代码'),
        "SendTime" => array('required'=>true , 'type'=>'varchar' , 'max'=>17 , 'pattern'=>'((((1[6-9]|[2-9]\d)\d{2})(0[13578]|1[02])(0[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})(0[13456789]|1[012])(0[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})02(0[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))0229))(20|21|22|23|[0-1]\d)[0-5]\d[0-5]\d\d{3}' , 'desc'=>'发送时间'),
        "Version" => array('required'=>true , 'type'=>'varchar' , 'max'=>50 , 'default'=>'1.0' , 'desc'=>'报文版本')
    );
}
