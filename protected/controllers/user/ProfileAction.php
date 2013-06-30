<?php
class ProfileAction extends BaseAction{
  
   protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_INDEX,array());
      $this->controller->init_page();
		  $this->controller->user_tag='information';
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'个人资料')
      );
	$this->controller->pt($this->id,array());
    	return true;
    }
   
  protected function do_action(){
		$user=new User();
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$user_datas=$user->get_table_datas($user_id);
		$this->display("user_profile",array("user_datas"=>$user_datas));
  }
 
 
    
}
?>
