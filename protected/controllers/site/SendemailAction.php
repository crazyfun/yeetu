<?php
class SendemailAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_login_page();
    	$this->controller->pt($this->id,array());
    	return true;
    }
  protected function do_action(){	
		$model=new User("forgotpassword");
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->validate() && $model->send_forgot_password()){
				  $this->display('forgot_password_success',array('model'=>$model,'user_email'=>$_POST['User']['email']));
			}else{
				  $this->display('forgot_password',array('model'=>$model));
			}
		}
   	
  }
 
 
    
}
?>
