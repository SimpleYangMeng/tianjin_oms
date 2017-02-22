<?php
class Common_Common
{

    /**
     * @return mixed
     */
    public static function getIP()
    {
        if (@$_SERVER['HTTP_CLIENT_IP'] && @$_SERVER['HTTP_CLIENT_IP'] != 'unknown') {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (@$_SERVER['HTTP_X_FORWARDED_FOR'] && @$_SERVER['HTTP_X_FORWARDED_FOR'] != 'unknown') {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(isset($_SERVER['REMOTE_ADDR'])){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = "0.0.0.0";
        }
        return $ip;
    }
    /*
     * @return Zend_Db_Adapter
     */
    public static function getAdapter () {
        $model = new Table_Receiving();
        return $model->getAdapter();
    }
    /**
     * 产生随机字符
     * @param $length
     * @param int $numeric
     * @return string
     */
    public static function random($length, $numeric = 0)
    {
        PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
        $seed = base_convert(md5(print_r($_SERVER, 1) . microtime()), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        $hash = '';
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $seed[mt_rand(0, $max)];
        }
        return $hash;
    }

    /**
     * 文件下载
     */
    public static function downloadFile($file)
    {
        // if (!is_file($file)) { die("<b>404 File not found!</b>"); }
        // Gather relevent info about file
        $len = filesize($file);
        $filename = basename($file);
        $file_extension = strtolower(substr(strrchr($filename, "."), 1));
        // This will set the Content-Type to the appropriate setting for the file
        switch ($file_extension) {
            case "pdf":
                $ctype = "application/pdf";
                break;
            case "exe":
                $ctype = "application/octet-stream";
                break;
            case "zip":
                $ctype = "application/zip";
                break;
            case "doc":
                $ctype = "application/msword";
                break;
            case "xls":
                $ctype = "application/vnd.ms-excel";
                break;
            case "ppt":
                $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg":
                $ctype = "image/jpg";
                break;
            case "mp3":
                $ctype = "audio/mpeg";
                break;
            case "wav":
                $ctype = "audio/x-wav";
                break;
            case "mpeg":
            case "mpg":
            case "mpe":
                $ctype = "video/mpeg";
                break;
            case "mov":
                $ctype = "video/quicktime";
                break;
            case "avi":
                $ctype = "video/x-msvideo";
                break;
            // The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
            case "php":
            case "htm":
            case "html":
            case "txt":
                die("<b>Cannot be used for " . $file_extension . " files!</b>");
                break;
            default:
                $ctype = "application/force-download";
        }
        ob_end_clean();
        // Begin writing headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        // Use the switch-generated Content-Type
        header("Content-Type: $ctype");
        // Force the download
        $header = "Content-Disposition: attachment; filename=" . $filename . ";";
        header($header);
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $len);
        @readfile($file);
        exit();
    }

    /**
     * 获取服务器IP
     * @return string
     */
    public static function getRealIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else if(isset($_SERVER['REMOTE_ADDR'])){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = "0.0.0.0";
        }
        return $ip;
    }

    /**
     * 对象转数组
     * @param $obj
     * @return mixed
     */
    public static function objectToArray($obj)
    {
        $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
        if (is_array($_arr)) {
            foreach ($_arr as $key => $val) {
                $val = (is_array($val) || is_object($val)) ? self::objectToArray($val) : $val;
                $arr[$key] = $val;
            }
        }
        return $arr;
    }

    /*
     * 页面延迟跳转，并提示
     */
    public static function redirect($url, $msg)
    {
        $second = 3;
        $millisecond = $second * 1000;
        // 用html方法实现页面延迟跳转
        echo "<html>\n";
        echo "<head>\n";
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo "<meta http-equiv='refresh' content='{$second};url=" . $url . "'>\n";
        echo "</head>\n";
        echo "<body style='text-align:center;padding-top:100px;line-height:25px;'>\n";
        echo $msg . "</br>\n";
        echo "页面将在{$second}秒后自动跳转...</br>\n";
        echo "<a href='" . $url . "'>如果没有跳转，请点这里跳转</a>\n";
        echo "</body>\n";
        echo "</html>\n";
        exit();

        // 用js方法实现页面延迟跳转
        echo $msg . "</br>";
        echo "页面将在3秒后自动跳转...</br>";
        echo "<a href='" . $url . "'>如果没有跳转，请点这里跳转</a>";
        echo "<script language='javascript'>setTimeout(\"window.location.href='" . $url . "'\",{$millisecond})</script>";
        exit();
    }

    /**
     * 字符串截取
     * @param $str
     * @param $len
     * @return string
     */
    public static function utf_substr($str, $len)
    {
        for ($i = 0; $i < $len; $i++) {
            $temp_str = substr($str, 0, 1);
            if (ord($temp_str) > 127) {
                $i++;
                if ($i < $len) {
                    $new_str[] = substr($str, 0, 3);
                    $str = substr($str, 3);
                }
            } else {
                $new_str[] = substr($str, 0, 1);
                $str = substr($str, 1);
            }
        }
        return join('', $new_str);
    }

    //清除wsdl缓存文件
    public static function clearWsdlTmp()
    {
        $dir = ini_get('soap.wsdl_cache_dir'); // 查找跟目录下file文件夹中的文件
        if (is_dir($dir)) {
            if ($dir_handle = opendir($dir)) {
                while (false !== ($file_name = readdir($dir_handle))) {
                    if ($file_name == '.' or $file_name == '..') {
                        continue;
                    } else {
                        //     					echo $file_name."\n";
                        if (preg_match('/^(wsdl).*/', $file_name)) {

                            @unlink($dir . "/" . $file_name);

                        }

                    }
                }
            }
            return true;
        }
        return false;
    }

    //清除wsdl缓存文件
    public static function clearWsdlCacheFile()
    {
        $dir = APPLICATION_PATH . '/../data/cache';
        if (is_dir($dir)) {
            if ($dir_handle = opendir($dir)) {
                while (false !== ($file_name = readdir($dir_handle))) {
                    if ($file_name == '.' or $file_name == '..') {
                        continue;
                    } else {
                        //     					echo $file_name."\n";
                        if (preg_match('/.*(wsdl)$/', $file_name)) {

                            @unlink($dir . "/" . $file_name);

                        }

                    }
                }
            }
            return true;
        }
        return false;
    }

    //清除超时图片缓存文件
    public static function clearImageTempFile()
    {
        $dir = APPLICATION_PATH . '/../data/images/temp';
        if (is_dir($dir)) {
            if ($dir_handle = opendir($dir)) {
                while (false !== ($file_name = readdir($dir_handle))) {
                    if ($file_name == '.' or $file_name == '..') {
                        continue;
                    } else {
                        // echo $file_name."\n";
                        $a = fileatime($dir . "/" . $file_name);
                        if (time() - $a > 3600) {
                            @unlink($dir . "/" . $file_name);
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 判断是不是soap数组
     * @param array $input
     * @return boolean
     */
    public static function isSoapArray($input)
    {
        if (!is_array($input)) {
            return false;
        }
        $keys = array_keys($input);
        $isInt = true;
        foreach ($keys as $k) {
            if (!is_int($k)) {
                $isInt = false;
            }
        }
        return $isInt;
    }


    /**
     * 判断如果为一维数据转为多维
     * @param $arr
     * @return array
     */
    public static function multiArr($arr)
    {
        $return = array();
        $isMulti = false;
        foreach ($arr as $k => $v) {
            if (is_int($k)) {
                $isMulti = true;
            }
        }
        if (!$isMulti) {
            $return[] = $arr;
        } else {
            $return = $arr;
        }
        return $return;
    }

    /**
     * @param $url
     * @param int $timeout
     * @param array $header
     * @return mixed
     * @throws Exception
     */
    public static function http_request($url, $timeout = 300, $header = array())
    {
        if (!function_exists('curl_init')) {
            throw new Exception('server not install curl');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $data = curl_exec($ch);
        list ($header, $data) = explode("\r\n\r\n", $data);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 301 || $http_code == 302) {
            $matches = array();
            preg_match('/Location:(.*?)\n/', $header, $matches);
            $url = trim(array_pop($matches));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $data = curl_exec($ch);
        }

        if ($data == false) {
            curl_close($ch);
        }
        @curl_close($ch);
        return $data;
    }

    /**
     * 创建文件路径
     *
     * @access	public
     * @param	string		($dir	路径)
     * @param	int			($mode	权限)
     * @return	boolean
     */
    public static function createPath($dir, $mode = 0777)
    {
    	clearstatcache();
    	$path	= preg_replace('/(\/){2,}|(\\\){1,}/','/',$dir);
    	if(is_dir($path)){
    		return true;
    	}else{
    		$dirs	= array();
    		$dirs	= explode("/",$path);
    		$path	= "";
    		foreach($dirs as $element)
    		{
    			$path	.= $element."/";
    			if(!is_dir($path)){
    				@mkdir($path,$mode);
    			}
    		}
    		return is_dir($path);
    	}
    }

    /**
     * 删除文件
     *
     * @access	public
     * @param	string		($file		删除文件)
     * @return	boolean
     */
    public static function delFile($file)
    {
    	return @unlink( realpath($file) );
    }

    /**
     * 输出指定头部编码的json内容
     *
     * @access	public
     * @param	array		($content	输出内容)
     * @param	string		($charset	字符集)
     * @return	void
     */
    public static function outJson($content, $charset = 'utf-8')
    {
    	header("Cache-Control: no-cache, must-revalidate");
    	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    	header("Content-type:application/json;charset=" . $charset);
    	echo json_encode($content);
    	exit;
    }

    /**
     * 上传图片
     *
     * @access	public
     * @param	array		($files		$_FILES)
     * @param	string		($field		上传字段)
     * @param	int			($width		图片宽度)
     * @param	int			($height	图片高度)
     * @param	string		($path		保存路径)
     * @param	boolean		($piece		是否单个)
     * @return	array
     */
	public static function uploadImg($files, $field, $path, $piece = true, $width = 5000, $height = 5000)
    {
    	$config['upload_path']		= $path;
    	$config['allowed_types']	= 'gif|jpg|jpeg|jpe|png';
    	$config['max_size']			= '10000';
    	$config['max_width']		= $width;
    	$config['max_height']		= $height;
    	$config['encrypt_name']		= true;
    	$upload	= new Common_UploadFile($config);
    	$upload->set_upload_path($path);
    	if ( ! $upload->do_upload_auto($files, $field) ){
    		$state	= array('error' => true,  'msg' => $upload->display_errors());
    	}else{
				$state	= array('error' => false, 'msg' => $piece ? $upload->data() : $upload->get_datas());
    	}
    	return $state;
    }

	/*随机函数*/
	public static function  randomkeys($length=30,$pa=1)
	{
		$key='';

 		$pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
 		if($pa==1){ $pattern='1234567890'; }
		for($i=0;$i<$length;$i++)
 		{
   			$key .= $pattern{mt_rand(0,strlen($pattern))};    //生成php随机数
 		}
 		return $key;
	}
	//获取当前网站的域名
	public static function getCurrentDomainName(){
	 $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
	 return $host;
	}
	public static function sendSMS($mobile,$content){
		$userid = '5486';
		$password = '123456qwe';
		$account = 's123';
		$url = 'http://inter.ueswt.com/sms.aspx?action=send';
		$url.="&userid={$userid}";
		$url.="&account={$account}";
		$url.="&password={$password}";
		$url.="&mobile={$mobile}";
		$url.="&content={$content}&sendTime=&extno=";
		return @file_get_contents($url);

	}

        /**
         * 设置单元格
         * @param type $objActSheet
         * @param type $pCoordinate
         * @param type $pValue
         * @param array $tableStyle
         */
        public static function setCell(&$objActSheet , $pCoordinate , $pValue ,$width = 0, $tableStyle = array()) {
            //
            if(empty($tableStyle)){
                $tableStyle =   array(
                    'allborders' => array(
                         'style' => PHPExcel_Style_Border::BORDER_THIN,
                         'color' => array(
                              'rgb' => '000000'
                         )
                    )
                );
            }

            $objActSheet->setCellValue($pCoordinate,$pValue);
            $objActSheet->getStyle($pCoordinate)->getBorders()->applyFromArray($tableStyle);
            $objActSheet->getStyle($pCoordinate)->getAlignment()->setWrapText(true);
            if($width > 0 ) {
                $nLen    = strlen(intval($pCoordinate));
                $sLen   =   strlen($pCoordinate) - $nLen;
                $pCoordinate    =   substr($pCoordinate , $sLen-1 , $nLen);
                $objActSheet->getColumnDimension($pCoordinate)->setWidth($width);
            }
        }
        /**
         * 将html中的<br />换行符转换为文本框中的换行符
         * @param type $text
         * @return type
         */
        public static function br2nl($text){
            return preg_replace('/<br\\s*?\/??>/i',"\n",$text);
        }
		public static function checkjson($data){
            $dataArr = json_decode($data,true);
            $result = array(
                'ask'=>'0',
                'message'=>'',
                'data'=>''
            );
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $result['ask']='1';
                    $result['data'] = $dataArr;
                    break;
                case JSON_ERROR_DEPTH:
                    $result['message']=' - Maximum stack depth exceeded';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $result['message']= ' - Underflow or the modes mismatch';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $result['message']=' - Unexpected control character found';
                    break;
                case JSON_ERROR_SYNTAX:
                    $result['message']= ' - Syntax error, malformed JSON';
                    break;
                case JSON_ERROR_UTF8:
                    $result['message']=' - Malformed UTF-8 characters, possibly incorrectly encoded';
                    break;
                default:
                    $result['message']=' - Unknown error';
                    break;
            }
            return $result;
        }


    /**
     * @author william-fan
     * @todo 返回报文
     */
    public static function getResult($result){
        //$dom = new DOMDocument('1.0', 'UTF-8');
        $dom = new DOMDocument();
        $responses = $dom->createElement('responses');
        $reponseItems = $dom->createElement('responseItems');
        $reponse = $dom->createElement("response");
        if($result['ask']=='1'){
            $reponse->appendChild($dom->createElement('ask','1'));
            $reponse->appendChild($dom->createElement('message',$result['message']));
            $reponse->appendChild($dom->createElement('error',''));
        }else{
            $reponse->appendChild($dom->createElement('ask','0'));
            $reponse->appendChild($dom->createElement('message',$result['message']));
            //var_dump($errors);
            $reason = '';
            $errorDom = $dom->createElement('error');
            if(isset($result['error'])){
                $errors = $result['error'];
                if(!empty($errors)){
                    foreach($errors as $k=>$err){
                        $e = isset($err['errorMessage']) ? $err['errorMessage'] : $err;
                        $errorDom->appendChild($dom->createElement('errorMessage' , $e));
                        $reason .= $e.";";
                    }
                }
            }
            //file_put_contents('sss.txt',var_export($reason,true));
            $reason = html_entity_decode($reason);
            $reason.= $result['message'];

            $reponse->appendChild($errorDom);
            //var_dump($reason);

            $reponse->appendChild($dom->createElement('reason',$reason));
            $reponse->appendChild($dom->createElement('reasonDesc',''));
        }
        $reponseItems->appendChild($reponse);
        $responses->appendChild($reponseItems);
        $dom->appendChild($responses);
        $string =  $dom->saveXML();
        return trim(str_replace('<?xml version="1.0"?>','',$string));
    }

    public static function autoCustomerCode($customerCode,$type,$num=10) {
        if(empty($type) || empty($customerCode)){
            return false;
        }
        for ($i=0; $i < $num-1; $i++) {
            $customerCode = '0'.$customerCode;
            if(strlen($customerCode)>=8){
                return $type.$customerCode;
            }
        }
        return;
    }

    //默认生成13位唯一编码
    public static function autoNum($id='',$num=13){
        for ($i=0; $i < $num-1; $i++) {
            $id = '0'.$id;
            if(strlen($id)>=12){
                return '1'.$id;
            }
        }
        return;
    }

    public static function customerType($parms){
        $key = 0;
        $customerType = array(
            'is_ecommerce'   => $parms['is_ecommerce'],
            'is_shipping'    => $parms['is_shipping'],
            'is_pay'         => $parms['is_pay'],
            'is_storage'     => $parms['is_storage'],
            'is_supervision' => $parms['is_supervision'],
            'is_platform'    => $parms['is_platform'],
            'is_baoguan'     => $parms['is_baoguan']
        );

        foreach ($customerType as $k => $v) {
            if(!empty($v)){
                $key = $k;
            }
        }

        $arrayName = array(
            'is_ecommerce' => 'D',
            'is_shipping' => 'W',
            'is_pay' => 'Z',
            'is_storage' => 'C',
            'is_supervision' => 'J',
            'is_platform' => 'P',
            'is_baoguan' => 'B',
        );
        if(empty($key)){
            return;
        }
        return $arrayName[$key];
    }

	public static function postData($value)
    {
        $curl_url = 'http://192.168.31.230/mqtest/mqapi.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'type'=>'put',
            'xml' => $value
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        return json_decode($response , true);
    }

    public static function businessType($parms){
        $businessType = array(
            'is_business_in'       => $parms['is_business_in'],
            'is_business_export'   => $parms['is_business_export'],
            'is_normal_in'         => $parms['is_normal_in'],
            'is_normal_export'     => $parms['is_normal_export']
        );
        $type = array(
            'is_business_in'       => 'BI',
            'is_business_export'   => 'BE',
            'is_normal_in'         => 'NI',
            'is_normal_export'     => 'NE'
        );

        foreach ($businessType as $key => $value) {
            if($value == 1){
                $business[] = $type[$key];
            }
        }

        return implode('|', $business);
    }
    public static function getEndDate($date){
        $year = date("Y",strtotime($date));
        $date0731 = $year.'-07-31';
        return $date0731;
        if(strtotime($date)>strtotime($date0731)){
            $dateNextYear = ($year+1).'-07-31';
            return $dateNextYear;
        }else{
            return $date0731;
        }
    }

    /**
     * [isIp 验证是否是IP]
     * @param  [type]  $str [description]
     * @return boolean      [description]
     */
    public static function isIp($str){
        if(empty($str)){
            return false;
        }
        $ip = explode('.', $str);
        for($i=0; $i<count($ip); $i++)
        {
            if($ip[$i]>255){
                return fasle;
            }
        }
        return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}(:\d{0,5})?$/', $str) > 0 ? true : false;
    }
}
