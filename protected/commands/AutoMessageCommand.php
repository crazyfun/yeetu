<?php
class AutoMessageCommand extends CConsoleCommand
{
	public function run($args){
		
		$batch_message=new BatchMessage();
		$batch_message_datas=$batch_message->findAll(array('select'=>'*','condition'=>"custom_date=:custom_date AND status<>:status",'params'=>array(':custom_date'=>date('Y-m-d'),':status'=>'1')));
		$send_mail=new SendMail();
		$user=new User();
		foreach($batch_message_datas as $key => $value){
			$is_all=$value->is_all;
			$batch_type=$value->batch_type;
			$current_time=time();
			if(empty($is_all)){
				switch($batch_type){
					case '1':
					   $result=$send_mail->send_batch_email($value->message,$value->title,$value->content);
					   if($result){
					   	$batch_message->update_table_datas($value->id,array('status'=>'1','send_date'=>$current_time),array());
					   }
					   break;
					case '2':
					   $result=$send_mail->send_batch_phone($value->message,$value->content);
					   $batch_message->update_table_datas($value->id,array('status'=>'1','send_date'=>$current_time),array());
					   break;
					default:
					   break;
				}
			}else{
					switch($batch_type){
					case '1':
					     $user_datas=$user->findAll(array('select'=>'email','condition'=>'email_validate=2 AND user_active=2','params'=>array()));
      	  			foreach($user_datas as $key1 => $value1){
      	  				   $send_mail->send_batch_email($value1->email,$value->title,$value->content);
      	  			}
      	  		 $batch_message->update_table_datas($value->id,array('status'=>'1','send_date'=>$current_time),array());
					   break;
					case '2':
					     $user_datas=$user->findAll(array('select'=>'user_phone','condition'=>'user_active=2','params'=>array()));
      	  			foreach($user_datas as $key1 => $value1){
      	  				  $send_mail->send_batch_phone($value1->user_phone,$value->title,$value->content);
      	  			}
      	  			$batch_message->update_table_datas($value->id,array('status'=>'1','send_date'=>$current_time),array());
					   break;
					default:
					   break;
					}
				}
		}
   }
}
