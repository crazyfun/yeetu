<?php
class UseractiveAction extends BaseAction{
  
  protected function beforeAction(){
       $this->controller->init_page();
       $this->controller->pt($this->id,array());
       return true;
  }
  protected function do_action(){	
    $user_id=$_GET['user_id'];
		$active_code=$_GET['active_code'];
		$model=new User();
		$user_datas=$model->get_table_datas($user_id,array());
		$user_active=Util::hc($user_datas->email,$user_datas->salt);
		if($user_active==$active_code){
			 $update_array['user_active']=2;
			 $update_array['email_validate']=2;
			 $model->update_table_datas($user_datas->id,$update_array);
			 
       $login_link=$this->controller->createAbsoluteUrl("site/login",array());
			 $send_mail=new SendMail("Active Account");
			 $send_mail->send_active_account_mail("",$user_datas->email,$user_datas->user_login,$login_link);
			  	 
			  	 
			 $this->display('register_complete',array('model'=>$user_datas));
		}else{
			 $this->controller->f(CV::REGISTE_ACTIVECODE);
			 $this->display('register_failed',array('model'=>$user_datas,'user_id'=>$user_id));
		}
  }
 
}
?>
