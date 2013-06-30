<?php
class ActiveAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$id=$_REQUEST['id'];
		$update_condition['user_active']='2';
		$update_condition['email_validate']='2';
		$user=new User();
		$result=$user->update_table_datas($id,$update_condition,array());
		if($result){
			$user_data=$user->get_table_datas($id,array());
			$send_mail=new SendMail("Active User");
			$login_link=Yii::app()->homeUrl."/site/login";
			$send_mail->send_admin_active_mail("",$user_data->email,$user_data->user_login,$login_link);
		}
		$this->controller->redirect($this->controller->createUrl("user/index",array()));
  } 
}
?>
