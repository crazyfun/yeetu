<?php
class RepeatactiveAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_login_page();
    	return true;
    }
  

  protected function do_action(){	
		$user_email=$_GET['user_email'];
		$model=new User("forgotpassword");
		$model->email=$user_email;
		if($model->validate() && $model->send_forgot_password()){
				$this->display('forgot_password_success',array('model'=>$model,'user_email'=>$user_email));
	  }
  }
 
 
    
}
?>
