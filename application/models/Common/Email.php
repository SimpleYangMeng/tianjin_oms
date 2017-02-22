<?php
class Common_Email
{
    /*
     * 发送邮件
     * $params['email']=>接收Email string|array
     * $params['bodyType']=>内容类型 text(default)|html
     * $params['subject']=>邮件主题
     * $params['body']=>邮件内容
     *
     * option 可选
     * $params['addCc']=>抄送Email string|array
     * $params['addBcc']=>密送Email string|array
     * 附件 支持多个
     * $params['attachment']=>array('file'=>文件,'fileType'=>'image/png','fileName'=>接收时显示的文件名)
     * @return bool
     */
    public static function send($params = array())
    {
    	try{
    		$files = array(
    				'email' => '',
    				'subject' => '',
    				'body' => '',
    		);
    		foreach ($files as $key => $val) {
    			if (!isset($params[$key]) || $params[$key] == '') {
    				return false;
    			}
    		}
    		$mailObj = Ec::setupMail();
    		$mailObj->addTo($params['email']);
    		$mailObj->setSubject($params['subject']);
    		if (!isset($params['bodyType']) || $params['bodyType'] == '' || !in_array($params['bodyType'], array('text', 'html'))) {
    			$mailObj->setBodyText($params['body']);
    		} else {
    			$mailObj->setBodyHtml($params['body']);
    		}
    		
    		//抄送Email
    		if (isset($params['addCc']) && !empty($params['addCc'])) {
    			$mailObj->addCc($params['addCc']);
    		}
    		
    		//密送Email
    		if (isset($params['addBcc']) && !empty($params['addBcc'])) {
    			$mailObj->addBcc($params['addBcc']);
    		}
    		
    		//附件
    		if (isset($params['attachment']) && !empty($params['attachment'])) {
    			$attachmentArr = Common_Common::multiArr($params['attachment']);
    			foreach ($attachmentArr as $val) {
    				$mailObj->createAttachment($val['file'], $val['fileType'], Zend_Mime::DISPOSITION_INLINE, Zend_Mime::ENCODING_BASE64, $val['fileName']);
    			}
    		}
    		
    		//发送
    		$return = $mailObj->send();
    		if ($return) {
    			return true;
    		}
    		return false;
    	}catch(Exception $e){
    		return false;
    	}
    }

    /*
     * @param $params
     * @return bool
     */
    public static function sendMail($params = array())
    {
        try {
            $config = Zend_Registry::get('config');
            if ($config->mails->send) {
                $result = self::send($params);
            } else {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public static function demo()
    {
        $params = array(
            'bodyType' => 'test',
            'email' => array('williamfan@cargofe.com.cn'),
            'subject' => 'test' . date('Y-m-d H:i:s'),
            'body' => '<span>test</span>',
            /*  'attachment'=>array(
                  'file'=>file_get_contents($url),
                  'fileType'=>'image/gif',
                  'fileName'=>'order.gif'
              )*/
        );
        $rr = Common_Email::send($params);
        var_dump($rr);
    }

}