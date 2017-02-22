<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user
 * Date: 13-12-25
 * Time: 下午3:03
 * To change this template use File | Settings | File Templates.
 */
class Service_Mail
{
    public static function sendMailWithAtta($emailTo,$customerName,$subject,$body,$attachment='',$cc=''){
        try{
            $config=Zend_Registry::get('config');
            $mailConfig = array('auth'=>$config->mails->config->auth,
                'username'=>$config->mails->config->username,
                'password'=>$config->mails->config->password,
                'port' =>$config->mails->config->port,
                // 'ssl' => $config->mails->config->ssl
            );
            $transport = new Zend_Mail_Transport_Smtp($config->mails->server, $mailConfig);
            $mail = new Zend_Mail('utf-8');
            $mail->addTo($emailTo, $customerName);
            $mail->setFrom($config->mails->from, $config->mails->config->name);

            if($attachment != ''){
                if(is_array($attachment)){
                    foreach($attachment as $atta){
                        $file = explode('/',$atta);
                        $filename = $file[count($file)-1];
                        $content = file_get_contents($atta);
                        $filename = mb_convert_encoding($filename,'GBK','UTF-8');
                        $mail->createAttachment($content, 'application/octet-stream', Zend_Mime::DISPOSITION_ATTACHMENT, Zend_Mime::ENCODING_BASE64, $filename);
                    }
                }else{
                    $file = explode('/',$attachment);
                    $filename = $file[count($file)-1];
                    $content = file_get_contents(iconv('utf-8','gbk',$attachment));
                    $filename = mb_convert_encoding($filename,'GBK','UTF-8');
                    $mail->createAttachment($content, 'application/octet-stream', Zend_Mime::DISPOSITION_ATTACHMENT, Zend_Mime::ENCODING_BASE64, $filename);
                }
            }
            $mail->setBodyHtml($body);
            $mail->send($transport);
            return true;

        }catch (Exception $e){
            return false;
        }
    }
}
