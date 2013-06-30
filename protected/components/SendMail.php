<?php
class SendMail{
	protected $mail_template="";
	protected $phpMail="";
	protected $id="";
	protected $email_layout="";
	protected $controller="";
  function __Construct($id=""){
  	$this->mail_template=new EmailTemplates();
  	$this->phpMail=new PhpMail("HTML",'');
  	$this->id=$id;    	
  	$this->email_layout="email/main";
  	$this->controller=new Controller("email");
  	$this->controller->layout=$this->email_layout;
  }
  private function _init_mail(){
		
		//$this->phpMail->Username = "no-reply@41ly.cn";
		//$this->phpMail->Username = "admin@41ly.cn";
		//$this->phpMail->Password = "admin-yeetu-2011";
		//$this->phpMail->Password = "&y3!t0xx%";
		//$this->phpMail->Host = "smtp.ym.163.com";
/*
		$this->phpMail->Username = "gywbd@163.com";
		$this->phpMail->Password = "07124224898";
		$this->phpMail->Host = "smtp.163.com";
*/
		$this->phpMail->Username = "290030958@qq.com";
		$this->phpMail->Password = "f19861031";
		$this->phpMail->Host = "smtp.qq.com";
		$this->phpMail->Port = "25";
		$this->phpMail->CharSet = 'UTF-8';
  }
  
  //设置layout
  public function set_layout($layout=""){
  	if(!empty($layout)){
  		$this->email_layout=$layout;
  		$this->controller->layout=$this->email_layout;
  	}
  }
  
  
 //发送注册邮件
public function send_register_mail($id="",$email,$user_login,$registe_active){
	if(empty($email))
		 return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['registe_active']=$registe_active;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途用户注册",$email_datas);
 if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
 /*
		// multiple recipients
		$time = Util::current_time('mysql');
		$subject = "=?UTF-8?B?".base64_encode("易途用户注册")."?="; 
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
		$message = '<html><head><title>易途用户注册</title></head><body>';
		//获得模板并且替换
    $replace_array['user_login']=$user_login;
    $replace_array['registe_active']=$registe_active;
    $replace_array['time']=$time;
		$content=$this->replace_variable($replace_array);
		
		$message.=$content;
		$message.='</body></html>';
		$headers .= 'To: '.$to. "\r\n";
		$headers .= 'From: admin@41ly.cn' . "\r\n";
		mail($email, $subject, $message, $headers); 
	*/
 }
 
  //发送注册邮件
public function send_admin_active_mail($id="",$email,$user_login,$login_link){
	if(empty($email))
		 return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['login_link']=$login_link;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途用户注册",$email_datas);
 if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;

 }
 
 
  //发送注册激活后的通知邮件
public function send_active_account_mail($id="",$email,$user_login,$login_link){
	if(empty($email))
		 return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['login_link']=$login_link;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途用户激活",$email_datas);
 if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;

 }
 
 //发送会员升级邮件
 public function send_account_upgrade_mail($id="",$email,$user_login,$account_level,$service_link){
 		if(empty($email))
		 return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['account_level']=$account_level;
  $replace_array['service_link']=$service_link;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途会员升级",$email_datas);
 if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
 	
}
 
 //发送重后台直接注册的用户
 
 public function send_admin_register_mail($id="",$email,$user_login,$password){
 	if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['password']=$password;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	$result=$this->phpMail->sendMail($email,"易途管理员注册用户",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
 }
 
 
  //发送重后台增加订单的用户
 
 public function send_order_register_mail($id="",$email,$user_login,$password){
 	if(empty($email))
		  return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['password']=$password;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	$result=$this->phpMail->sendMail($email,"易途管理员增加订单注册用户",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
 }
 
 
 
  //发送注册邮件
	public function send_edit_mail($id="",$email,$user_login,$registe_active){
		if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['registe_active']=$registe_active;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	$result=$this->phpMail->sendMail($email,"易途用户修改邮箱",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
/*
		// multiple recipients
		$time = Util::current_time('mysql');
		$subject = "=?UTF-8?B?".base64_encode("易途用户注册")."?="; 
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
		$message = '<html><head><title>易途用户注册</title></head><body>';
		//获得模板并且替换
    $replace_array['user_login']=$user_login;
    $replace_array['registe_active']=$registe_active;
    $replace_array['time']=$time;
		$content=$this->replace_variable($replace_array);
		
		$message.=$content;
		$message.='</body></html>';
		$headers .= 'To: '.$to. "\r\n";
		$headers .= 'From: admin@41ly.cn' . "\r\n";
		mail($email, $subject, $message, $headers); 
		*/
 }
 //email重设密码
 public function send_forgot_password_mail($id="",$email,$user_login,$reset_password,$login_active){

 	 if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['reset_password']=$reset_password;
  $replace_array['login_active']=$login_active;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	
	$result=$this->phpMail->sendMail($email,"易途用户忘记密码",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}
 //发送付款成功后的邮件
 public function send_pay_success_mail($id="",$email,$trave_name,$start_date,$total_price,$people_nums,$user_login){
 	 if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['people_nums']=$people_nums;
  $replace_array['user_login']=$user_login;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	
  $result=$this->phpMail->sendMail($email,"易途旅游线路付款成功",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}


 //发送预定成功后的邮件
 public function send_order_success_mail($id="",$email,$trave_name,$start_date,$total_price,$user_login,$total_nums){
 	 if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容

	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['user_login']=$user_login;
  $replace_array['people_num']=$total_nums;
  $replace_array['time']=$time;
  
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途旅游线路预定成功",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}


//发送修改出发日期的邮件
public function send_modify_start_date($id="",$email,$trave_name,$start_date,$total_price,$user_login,$total_nums,$old_start_date){
	if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['user_login']=$user_login;
  $replace_array['people_num']=$total_nums;
  $replace_array['former_start_date']=$old_start_date;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途用户订单的出发地修改成功",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}


//发送取消订单邮件
 public function send_order_cancel_mail($id="",$email,$trave_name,$start_date,$total_price,$user_login,$total_nums){
 	 if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['user_login']=$user_login;
  $replace_array['people_num']=$total_nums;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途管理员取消订单",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}

//发送被用户取消的订单的邮件
public function send_order_cancel_by_own_mail($id="",$email,$trave_name,$start_date,$total_price,$user_login,$total_nums){
   if(empty($email))
		  return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['user_login']=$user_login;
  $replace_array['people_num']=$total_nums;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途用户取消订单",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}

 //发送转成正式订单邮件的邮件
 public function send_order_formal_mail($id="",$email,$trave_name,$start_date,$total_price,$user_login,$total_nums){
 	 if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['user_login']=$user_login;
  $replace_array['people_num']=$total_nums;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
  $result=$this->phpMail->sendMail($email,"易途管理员生成订单",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}


 //发送自动过期订单邮件的邮件
 public function send_outofdate_order_mail($id="",$email,$trave_name,$start_date,$total_price,$user_login,$total_nums){
 	 if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
		$this->_init_mail();
	//密送名單
	//$phpmailer->AddBCC( "crazy_fun@163.com", 'GVO' );
	//發送內容
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['start_date']=$start_date;
  $replace_array['total_price']=$total_price;
  $replace_array['user_login']=$user_login;
  $replace_array['people_num']=$total_nums;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$base_url="http://www.41ly.cn";
  $email_datas='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>无标题文档</title><style type="text/css"></style></head><body><table width="100%" cellspacing="0" style="background-color: rgb(243, 243, 243);" class="backgroundTable"><tbody><tr><td valign="top" align="center"><table width="680" cellspacing="0" cellpadding="0" style="border: 0px none rgb(0, 0, 0); margin-top: 10px;" id="contentTable"><tbody><tr><td><table width="680" cellspacing="0" cellpadding="0"><tbody><tr><td style="background-color:#0053c2; border-top: 3px solid #003986; border-bottom: 0px none rgb(255, 255, 255); padding: 15px;" class="headerBar"><div style="height: 40px; color: rgb(255, 255, 255); font-size: 14px; font-family: Helvetica; font-weight: normal; text-align: left;" class="headerBarText"> <img style="float: left; display: inline-block; margin-bottom: 0pt;" src="'.$base_url.'/css/images/logo.jpg" class="logo"> <span style="float: left; display: block; padding: 21px 0pt 0pt; margin-left:5pt;">让旅途更实惠、便捷、惬意</span><span style="float: right; display: block; padding: 21px 0pt 0pt; margin: 0pt;">热线电话:021-56880166</span></div></td></tr></tbody></table><div style="margin:20px 0;">';
  $email_datas.=$content;
  $email_datas.='</div></td></tr><tr><td height="50px" style="background-color: rgb(226, 226, 226);"></td></tr><tr><td style="color: rgb(146, 146, 146); padding-top: 20px; text-align: center; font-size: 11px; font-family: Helvetica,Arial,sans-serif;"><p>Copyright© 2010-2019 GirlMen All Rights Reserved </p><p>隐私保护易途网版权所有沪ICP备05000883号</p></td></tr></tbody></table></td></tr></tbody></table></body></html>';
  $result=$this->phpMail->sendMail($email,"易途管理员生成订单",$email_datas);
  if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;
}




  //发送在线咨询回复的邮件
public function send_consulting_reply($id="",$email,$trave_name,$consulting_content,$reply_content,$create_time){
	if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$replace_array['trave_name']=$trave_name;
  $replace_array['consulting_content']=$consulting_content;
  $replace_array['reply_content']=$reply_content;
  $replace_array['time']=date('Y-m-d H:i:s',$create_time);
  $replace_array['reply_time']=Util::current_time('mysql');;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	$result=$this->phpMail->sendMail($email,"易途在线咨询回复",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;

 }
 
 
 
   //发送在线咨询的邮件
public function send_consulting($id="",$email,$trave_name,$consulting_content){
	if(empty($email))
		  return;
		$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['trave_name']=$trave_name;
  $replace_array['consulting_content']=$consulting_content;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$email_datas=$this->controller->render("../email/email",array('email_datas'=>$content), true);
	$result=$this->phpMail->sendMail($email,"易途在线咨询",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;

 }
 
 
    //发送生日邮件
public function send_birthday_email($id="",$email,$user_login){
	
	if(empty($email))
		  return;
	$this->id=empty($id)?$this->id:$id;
	$this->_init_mail();
	$time=Util::current_time('mysql');
	$replace_array['user_login']=$user_login;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$base_url="http://www.41ly.cn";
	$email_datas='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>无标题文档</title><style type="text/css"></style></head><body><table width="100%" cellspacing="0" style="background-color: rgb(243, 243, 243);" class="backgroundTable"><tbody><tr><td valign="top" align="center"><table width="680" cellspacing="0" cellpadding="0" style="border: 0px none rgb(0, 0, 0); margin-top: 10px;" id="contentTable"><tbody><tr><td><table width="680" cellspacing="0" cellpadding="0"><tbody><tr><td style="background-color:#0053c2; border-top: 3px solid #003986; border-bottom: 0px none rgb(255, 255, 255); padding: 15px;" class="headerBar"><div style="height: 40px; color: rgb(255, 255, 255); font-size: 14px; font-family: Helvetica; font-weight: normal; text-align: left;" class="headerBarText"> <img style="float: left; display: inline-block; margin-bottom: 0pt;" src="'.$base_url.'/css/images/logo.jpg" class="logo"> <span style="float: left; display: block; padding: 21px 0pt 0pt; margin-left:5pt;">让旅途更实惠、便捷、惬意</span><span style="float: right; display: block; padding: 21px 0pt 0pt; margin: 0pt;">热线电话:021-56880166</span></div></td></tr></tbody></table><div style="margin:20px 0;">';
  $email_datas.=$content;
  $email_datas.='</div></td></tr><tr><td height="50px" style="background-color: rgb(226, 226, 226);"></td></tr><tr><td style="color: rgb(146, 146, 146); padding-top: 20px; text-align: center; font-size: 11px; font-family: Helvetica,Arial,sans-serif;"><p>Copyright© 2010-2019 GirlMen All Rights Reserved </p><p>隐私保护易途网版权所有沪ICP备05000883号</p></td></tr></tbody></table></td></tr></tbody></table></body></html>';
 	$result=$this->phpMail->sendMail($email,"易途旅游网生日提醒",$email_datas);
	if($result){
		 $this->save_batch_message($email,'1',$email_datas);	
  }
	return $result;

 }
 
 //发送预定线路成功后的短信
 
public function send_pay_phone($id="",$phone_num,$user_login,$trave_name,$trave_time,$total_price){
	if(empty($phone_num)){
		return false;
	}
	$time=Util::current_time('mysql');
	$phone_sms=new SMS();
	$replace_array['user_login']=$user_login;
	$replace_array['trave_name']=$trave_name;
	$replace_array['trave_time']=$trave_time;
	$replace_array['total_price']=$total_price;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$content=@mb_convert_encoding($content,"GB2312","UTF-8");
  $result=$phone_sms->send($phone_num,$content);
  $this->save_batch_message($phone_num,'2',$content);
 

}
 
 //发送生日短信
public function send_birthday_phone($id="",$phone_num,$user_login){
	if(empty($phone_num)){
		return false;
	}
	$time=Util::current_time('mysql');
	$phone_sms=new SMS();
	$replace_array['user_login']=$user_login;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$content=@mb_convert_encoding($content,"GB2312","UTF-8");
  $result=$phone_sms->send($phone_num,$content);
  $this->save_batch_message($phone_num,'2',$content);
  return $result;
	
}

//短信验证码
public function send_forgot_phone($id="",$phone_num,$phone_verification){
	if(empty($phone_num)){
		return false;
	}
	$time=Util::current_time('mysql');
	$phone_sms=new SMS();
	$replace_array['phone_verification']=$phone_verification;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$content=@mb_convert_encoding($content,"GB2312","UTF-8");
  $result=$phone_sms->send($phone_num,$content);
  $this->save_batch_message($phone_num,'2',$content);
  return $result;
	
}

//短信重设密码
function send_reset_phone($id="",$phone_num,$reset_password){

	if(empty($phone_num)){
		return false;
	}
	$time=Util::current_time('mysql');
	$phone_sms=new SMS();
	$replace_array['reset_password']=$reset_password;
  $replace_array['time']=$time;
	$content=$this->replace_variable($replace_array);
	$content=@mb_convert_encoding($content,"GB2312","UTF-8");
  $result=$phone_sms->send($phone_num,$content);
  $this->save_batch_message($phone_num,'2',$content);
  return $result;
}

//发送批量短信

function send_batch_phone($batch_phone,$content){
	if(empty($batch_phone)||empty($content)){
		return;
	}
	$phone_sms=new SMS();
	$content=@mb_convert_encoding($content,"GB2312","UTF-8");
	if(is_array($batch_phone)){
		foreach($batch_phone as $key => $value){
		  
			$phone_sms->send($value,$content);
		}
		$result=true;
	}else{
		$result=$phone_sms->send($batch_phone,$content);
	}
	return $result;
}
//发送批量邮件
function send_batch_email($batch_email,$title,$content){
	if(empty($batch_email)||empty($content))
		  return;
	$this->_init_mail();
	if(is_array($batch_email)){
		foreach($batch_email as $key => $value){
			$result=$this->phpMail->sendMail($value,$title,$content);
		}
		$result=true;
	}else{
		$result=$this->phpMail->sendMail($batch_email,$title,$content);
	}
	
	return $result;
}

public function save_batch_message($message,$batch_type,$content){
	
	$batch_message=new BatchMessage();
  $batch_message->message=$message;
  $batch_message->batch_type=$batch_type;
  $batch_message->content=$content;
  $batch_message->status='1';
  $batch_message->send_date=time();	
  if($batch_message->validate()){
	  	$batch_message->save();
	}
}

 //用邮件模板替换
 public function replace_variable($replace_array){
 	 $email_template_data=$this->get_email_templates_contents();
	 $content=$email_template_data->email_templates_content;
	 $replace_key=array();
	 $replace_value=array();
	 foreach((array)$replace_array as $key => $value){
	 	$key_name="{{"."$".$key."}}";
	 	array_push($replace_key,$key_name);
	 	array_push($replace_value,$value);
	 }
 	 $content=str_replace($replace_key, $replace_value, $content);
 	 return $content;
 }
 //获得邮件模板
 private function get_email_templates_contents(){
 	 if(empty($this->id))
 	    return;
 	 $condition['email_templates_name']=$this->id;
 	 $email_template_datas=$this->mail_template->get_table_datas($pk_id="",$condition);
 	 if(is_array($email_template_datas))
 	   $email_template_data=$email_template_datas[0];
 	 else
 	   $email_template_data=$email_template_datas;
 	 return $email_template_data;
 }
 
 

 public function get_id(){
 	return $this->id;
 }
 public function set_id($id){
 	 $this->id=$id;

 }
     /* 取得变量的名字 */
 public function getVarName(&$variable){ 
     $save = $variable; 
     $allvar = $GLOBALS;
     foreach($allvar as $k=>$v) {
       if ($variable == $v) { 
          if ($variable == $GLOBALS[$k]) {
          	//还原变量值
            $variable = $save;
            return $k;
        }
     }
   }
 }

}


?>
