<?php
class EmailAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_EMAIL,array());
    	$this->controller->init_page();
    	$this->controller->user_tag='email';
    	$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'邮件订阅管理')
      );
		$this->controller->pt($this->id,array('邮件订阅'));
    	return true;
    }
   
  protected function do_action(){
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$user=new User();
		$user_datas=$user->get_table_datas($user_id);
		$this->display("user_email",array('user_datas'=>$user_datas));
  }
 
 
    
}
?>
