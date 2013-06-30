<?php
class PhoneverificationAction extends  BaseAction{
  
   protected function beforeAction(){
    if(Yii::app()->request->isAjaxRequest){
    	return true;
     }else{
     	return false;
     }
    }
  protected function do_action(){	
		  $user_phone=$_REQUEST['user_phone'];
			 if(empty($user_phone)){
			 	   echo "请输入手机号码";
			 }else{
			 	 if(!Util::is_phone($user_phone)){
			 	 	  echo "手机号码格式不正确";
			 	 }else{
			 	  	$send_mail=new SendMail("Forgot Phone");
			 	  	$phone_verification=Util::randStr(6,'NUMBER');
			 	  	$phone_result=$send_mail->send_forgot_phone("",$user_phone,$phone_verification);
			 	  	if($phone_result){
			 	  	  Yii::app()->session->setTimeout(5*60);
			 	    	Yii::app()->session->add("phone_verification",Util::hc($phone_verification,""));
			 	    	$this->controller->_send_phone_time++;
			 	    	echo "成功发送,5分钟内自动过期。";
			 	  	}else{
			 	  		echo "发送不成功,请重新发送。";
			 	  	}
			 	}
			}
  }
}
?>
