<?php
class RepeatactiveAction extends BaseAction{
  
    protected function beforeAction(){
       $this->controller->init_page();
       $this->controller->pt($this->id,array());
       return true;
    }
  
  protected function do_action(){	
    $model=new User();
		$user_id=$_GET['user_id'];
		$user_datas=$model->get_table_datas($user_id,array());
		$send_mail=new SendMail("Registe Email");
		$registe_active=$this->controller->createAbsoluteUrl("register/useractive",array('user_id'=>$user_datas->id,'active_code'=>Util::hc($user_datas->email,$user_datas->salt)));
		$registe_active=CHtml::link($registe_active,$registe_active);
		$send_mail->send_register_mail("",$user_datas->email,$user_datas->user_login,$registe_active);
	  $this->display('register_accomplish',array('model'=>$user_datas,'user_id'=>$user_id)); 
  }
 
}
?>
