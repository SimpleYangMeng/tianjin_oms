<?php
class Service_EmailLogProcess
{
   
   

    /**
	 * @author colinyang
     * @param $row
     * @param $value
     * @param string $field
	 * @待处理信息
     * @return mixed
     */
    public static function getWaitedHandleMessage()
    {
		
		$sendNumber = 50;//一次发送多少条
        $key = Common_Common::randomkeys(38);
		$rows = Service_EmailLog::getByCondition(array('email_status'=>'0','email_type'=>'submit_id_card'),'*','log_id desc',$sendNumber,1);	
		
		if($rows){
			foreach($rows as $row){
				$data = array(
					'php_session_code'=>$key
				);
				Service_EmailLog::update($data,$row['log_id'],'log_id');	
				
			}//foreach($rows as $row){
		}//if($rows){
		unset($rows);
		$rows = Service_EmailLog::getByCondition(array('email_status'=>'0','email_type'=>'submit_id_card','php_session_code'=>$key),'*','log_id desc');
		//print_r($rows);	
		return $rows;
    }
    
   
   
	
}