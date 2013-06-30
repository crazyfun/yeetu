<?php
class HeadAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_HEAD,array());
      $this->controller->init_page();
      $this->controller->user_tag='head';
      $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'修改头像')
      );
	  $this->controller->pt($this->id,array());
    	return true;
    }
   
  protected function do_action(){
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$user=new User();		 
		$this->display("user_head",array('model'=>$user));
  }
 
 
    
}
?>
