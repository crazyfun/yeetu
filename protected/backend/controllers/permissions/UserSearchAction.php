<?php
class UserSearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("设置用户权限"));
     return true;
  }
  protected function do_action(){	
		$model=new User();
	  $user_login=$_REQUEST['user_login'];
	  $user_active=$_REQUEST['user_active'];
	  $status=$_REQUEST['status'];
		$com_condition['用户名:w%']=$user_login;

		if(!empty($user_active)){
			$user_active_datas=array(''=>'是否激活','1'=>'未激活','2'=>'已激活');
			$com_condition['激活:w%']=$user_active_datas[$user_active];
		}
		
		if(!empty($status)){
			$status_datas=array(''=>'是否是管理员','1'=>'普通用户','2'=>'管理员');
			$com_condition['管理员:w%']=$status_datas[$status];
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('user',array('model'=>$model,'com_condition_search'=>$com_condition_search,'user_active'=>$user_active,'status'=>$status));
  } 
}
?>
