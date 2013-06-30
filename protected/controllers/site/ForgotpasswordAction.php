<?php
class ForgotpasswordAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_login_page();
		$this->controller->pt($this->id,array());
    	return true;
    }
  
  protected function do_action(){	
		$model=new User();
		$this->display('forgot_password',array('model'=>$model));
  }
 
 
    
}
?>
