<?php
class EdituserphoneAction extends  BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_page();
		  $this->controller->user_tag='information';
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'修改手机号码')
      );
		  $this->controller->pt($this->id,array('修改手机号码'));
    	return true;
    }

  
  protected function do_action(){
    $user=new User("EditPhone");
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
	  $user_datas=$user->get_table_datas($user_id);
	  if(isset($_POST['User'])){
	  	 if(!empty($user_id)){
	  	 	$user=$user->get_table_datas($user_id);
	  	 }
	  	 $user->setScenario("EditPhone");
	  	 $user->id=$user_id;
	  	 $user->attributes=$_POST['User'];
	  	 $user->user_active='1';
	  	 if(($_POST['User']['user_phone']!=$user_datas->user_phone)){
	  	   if($user->validate()&&$user->send_registe_phone()){
	  	 	 
			     $update_result=$user->insert_user();
			     $this->controller->f(CV::SUCCESS_OPERATE);
			   }
			 }else{
			 	   $this->controller->f(CV::ERROR_USER_PHONE);
			}
	  }
		  $this->display("edit_userphone",array("user_datas"=>$user_datas,'model'=>$user));
		
   	
  }
  
}
?>
