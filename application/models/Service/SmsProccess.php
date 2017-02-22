<?php
class Service_SmsProccess
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
		$sendNumber = 100;//一次发送多少条
        $key = Common_Common::randomkeys(38);
		$rows = Service_SmsLog::getByCondition(array('status'=>'0','sms_type'=>'submit_id_card'),'*','log_id desc',$sendNumber,1);	
		if($rows){
			foreach($rows as $row){
				$data = array(
					'php_session_code'=>$key
				);
				Service_SmsLog::update($data,$row['log_id'],'log_id');	
				
			}//foreach($rows as $row){
		}//if($rows){
		unset($rows);
		$rows = Service_SmsLog::getByCondition(array('status'=>'0','php_session_code'=>$key),'*','log_id desc');
		//print_r($rows);	
		return $rows;
    }
	
	
   /**
	 * @author colinyang
     * @param $row
     * @param $value
     * @param string $field
	 * @超过24小时没上传就重新发信息
     * @return mixed
     */
    public static function  setReSendMobileMessage($days=2)
    {   
		$start_time = date('Y-m-d H:i:s',time()-(($days+3)*3600*24));
		$end_time = date('Y-m-d H:i:s',time()-$days*3600*24);
		//$now = date('Y-m-d H:i:s',time()-($days-1)*3600*24);	    
		$rows = Service_SmsLog::getByCondition(array('status'=>'1','sms_type'=>'submit_id_card','is_repeat'=>'0','sent_time_start'=>$start_time,'sent_time_end'=>$end_time),'*','log_id desc',NULL,NULL);	
		
		
		if($rows){
			foreach($rows as $row){
				$idcard_row = Service_OrderIdcards::getByField($row['idcard_number'],'idcard_number');
				if(!$idcard_row){
					$data = array(
						'is_repeat'=>'1',
						'status'=>'0',
						'resent_time'=>'',
						'return_message'=>'from me',
					);
					//print_r($data);exit;
					Service_SmsLog::update($data,$row['log_id'],'log_id');	
				}
				
				
				
			}//foreach($rows as $row){
		}//if($rows){
		
		//print_r($rows);	
		return $rows;
    }	
  
    /**
	 * @author colinyang
     * @param $row
     * @param $value
     * @param string $field
	 * @类型
     * @return mixed
     */	
	 public static function getTypeText($type){
	 	$typeText = "未知";
	 	switch($type){
			case '0':
				$typeText = '初始';			
			break;
			case '1':
				$typeText = '成功';			
			break;
			case '2':
				$typeText = '失败';			
			break;			
			default:
			break;
		}
		
		return $typeText;
	 
	 }
   
    /**
	 * @author colinyang
     * @param $row
     * @param $value
     * @param string $field
	 * @类型
     * @return mixed
     */	
	 public static function getTypes(){	 	
		
		return array(
			'0'=>'初始',
			'1'=>'成功',
			'2'=>'失败'	
		
		);
	 
	 }  
	 
	 
	 
  /**
	 * @author colinyang
     * @param $row
     * @param $value
     * @param string $field
	 * @报告
     * @return mixed
     */
    public static function  setSendMobileReport($days=3)
    {   
		$start_time = date('Y-m-d H:i:s',time()-($days+1)*24*3600);
		$end_time = date('Y-m-d H:i:s',time()-$days*24*3600);		
		//$now = date('Y-m-d H:i:s',time()-($days-1)*3600*24);
		$result_rows = array();
		$rows = Service_SmsLog::getByCondition(array('status_arr'=>array('1','2'),'sms_type'=>'submit_id_card','is_repeat'=>'0','add_time_start'=>$start_time),'*','log_id desc',NULL,NULL);	
		if($rows){
			foreach($rows as $row){				
				
				if($row['status']=='1'){
						$notice_time_distance =(time()-strtotime($value['pub_date']))>(24*3600*$days);				
						$idcard_row = Service_OrderIdcards::getByField($row['idcard_number'],'idcard_number');
						if(!$idcard_row &&  $notice_time_distance){
							$result_rows[] = $row;
						}//
				}else{
					 	 $result_rows[] = $row;
				}
				
				
			}//foreach($rows as $row){
		}//if($rows){		
		
		return $result_rows;
    }		  
	
}