<?php
class AutoBirthdayCommand extends CConsoleCommand
{
	public function run($args){
		$user=new User();
		$user_datas=$user->findAll(array('select'=>'user_login,user_phone,email,email_validate','condition'=>"FROM_UNIXTIME(UNIX_TIMESTAMP(user_birthday),'%m-%d')=:user_birthday AND user_active=2",'params'=>array(':user_birthday'=>date('m-d'))));
		foreach($user_datas as $key => $value){
			if(($value->email_validate=='2')&&!empty($value->email)){
				 $send_mail=new SendMail("Birthday Email");
				 $result=$send_mail->send_birthday_email("",$value->email,$value->user_login);
			}
			if(!empty($value->user_phone)){
				 $send_mail=new SendMail("Birthday Phone");
				 $result=$send_mail->send_birthday_phone("",$value->user_phone,$value->user_login);
				 
			}
		}
  }
}
