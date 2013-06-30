<?php
class RepeatactiveAction extends  BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_page();
		  $this->controller->user_tag='information';
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'修改密码')
      );
		  $this->controller->pt($this->id,array('修改密码'));
    	return true;
    }
    

  protected function do_action(){
		$model=new User("EditEmail");
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$user_datas=$model->get_table_datas($user_id,array());
		$send_mail=new SendMail("Edit Email");
		$registe_active=$this->controller->createAbsoluteUrl("user/useractive",array('user_id'=>$user_datas->id,'active_code'=>Util::hc($user_datas->email,$user_datas->salt)));
		$registe_active=CHtml::link($registe_active,$registe_active);
		$send_mail->send_register_mail("",$user_datas->email,$user_datas->user_login,$registe_active);
	  $this->display("user_editemail2",array("edit_email"=>$user_datas->email,'user_id'=>$user_id));
  }
 
 
    
}
?>
