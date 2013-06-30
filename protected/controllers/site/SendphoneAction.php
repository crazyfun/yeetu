<?php
class SendphoneAction extends BaseAction{
  
   protected function beforeAction(){
    	Yii::app ()->session->init();
    	$this->controller->init_login_page();
    	return true;
    }
   
  protected function do_action(){	
		$model=new User("phone");
		if(isset($_POST['User']))
		{
			$step=$_REQUEST['step'];
			if($step=='1'){
				$model->attributes=$_POST['User'];
				if($model->validate()){
					  $send_mail=new SendMail("Forgot Phone");
			 	  	$phone_verification=Util::randStr(6,'NUMBER');
			 	  	$phone_result=$send_mail->send_forgot_phone("",$model->user_phone,$phone_verification);
			 	  	if($phone_result){
			 	  	  Yii::app()->session->setTimeout(5*60);
			 	    	Yii::app()->session->add("phone_verification",Util::hc($phone_verification,""));
			 	    	$this->display('forgot_password_step2',array('model'=>$model));
			 	  	}else{
			 	  		$this->controller->f(CV::SEND_PHONE_FAILED);
			 	      $this->display('forgot_password',array('model'=>$model));
			 	  	}
				}else{
					$this->display('forgot_password',array('model'=>$model));
				}
			}else if($step=='2'){
				$model->attributes=$_POST['User'];
			  $model->user_phone_verification=$_REQUEST['User']['user_phone_verification'];
			  if($model->validate() && $model->send_forgot_phone()){
				  $this->display('pforgot_password_success',array('model'=>$model,'user_phone'=>$model->user_phone));
			  }else{
				  $this->display('forgot_password_step2',array('model'=>$model));
			  }
			}
			
		}
  }
}
?>
