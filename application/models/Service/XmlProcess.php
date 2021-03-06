<?php
class Service_XmlProcess
{
	private static $xml = null;  
    private static $encoding = 'UTF-8';  
  
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {  
        self::$xml = new DomDocument($version, $encoding);  
        self::$xml->formatOutput = $format_output;  
        self::$encoding = $encoding;  
    }  

    public static function &createXML($nodeName, $arr=array()) {  
        $xml = self::getXMLRoot();  
        $xml->appendChild(self::convert($nodeName, $arr));  
  
        self::$xml = null;
        return $xml;  
    }  
  
    private static function &convert($nodeName, $arr=array()){
  
        $xml = self::getXMLRoot();  
        $node = $xml->createElement($nodeName);
        if(is_array($arr)){  
		
            if(isset($arr['@attributes'])) {  
                foreach($arr['@attributes'] as $key => $value) {  
                    if(!self::isValidTagName($key)) {  
                        throw new Exception('[Array2XML] Illegal character in attribute name. attribute: '.$key.' in node: '.$nodeName);  
                    }  
                    $node->setAttribute($key, self::bool2str($value));  
                }  
                unset($arr['@attributes']); //remove the key from the array once done.  
            }
			
            if(isset($arr['@value'])) {  
                $node->appendChild($xml->createTextNode(self::bool2str($arr['@value'])));  
                unset($arr['@value']);
                return $node;  
            } else if(isset($arr['@cdata'])) {  
                $node->appendChild($xml->createCDATASection(self::bool2str($arr['@cdata'])));  
                unset($arr['@cdata']);
                return $node;  
            }  
        }
		
        if(is_array($arr)){  
            foreach($arr as $key=>$value){  
                if(!self::isValidTagName($key)) {  
                    throw new Exception('[Array2XML] Illegal character in tag name. tag: '.$key.' in node: '.$nodeName);  
                }  
                if(is_array($value) && is_numeric(key($value))) {  
                    foreach($value as $k=>$v){  
                        $node->appendChild(self::convert($key, $v));  
                    }  
                } else {
                    $node->appendChild(self::convert($key, $value));  
                }  
                unset($arr[$key]); //remove the key from the array once done.  
            }  
        }  
  
        if(!is_array($arr)) {  
            $node->appendChild($xml->createTextNode(self::bool2str($arr)));  
        }  
  
        return $node;  
    }  

    private static function getXMLRoot(){  
        if(empty(self::$xml)) {  
            self::init();  
        }  
        return self::$xml;  
    }  
  
    private static function bool2str($v){
        $v = $v === true ? 'true' : $v;  
        $v = $v === false ? 'false' : $v;  
        return $v;  
    }  
  
    private static function isValidTagName($tag){  
        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';  
        return preg_match($pattern, $tag, $matches) && $matches[0] == $tag;  
    }
	
	/**
	 * 生成XML文档
	 * @param string $path
	 * @return int|string
	 */
	public static function generate($path='',$root='root',$arrayData) {
		$xml	= self::createXML($root,$arrayData);
		if($path) return $xml->save($path);
		return $xml->saveXML();
	}
}