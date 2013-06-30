<?php
class LogoutAction extends  BaseAction{
  protected function beforeAction(){
        $this->controller->init_login_page();
        return true;
  }
  protected function do_action(){
  	  require_once('config.inc.php');
  	  require_once('uc_client/client.php');
      Yii::app()->user->logout();
      $ucsynlogout = uc_user_synlogout();
		  $this->display('loginoutsuccess',array('ucsynlogout'=>$ucsynlogout));
   	
  }
 
 
    
}
?>
