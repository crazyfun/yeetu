<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("用户管理"));
     return true;
  }
  protected function do_action(){	
		$model=new User();
	  $user_login=$_REQUEST['user_login'];
	  $level=$_REQUEST['level'];
	  $user_active=$_REQUEST['user_active'];
	  $status=$_REQUEST['status'];
	  $create_time=$_REQUEST['create_time'];
	  $user_phone=$_REQUEST['user_phone'];
		$com_condition['用户名:w%']=$user_login;
		if(!empty($level)){
			 $level_datas=CV::$USER_LEVEL;
			 $com_condition['用户等级:w%']=$level_datas[$level];
		}
		if(!empty($user_active)){
			$user_active_datas=array(''=>'是否激活','1'=>'未激活','2'=>'已激活');
			$com_condition['激活:w%']=$user_active_datas[$user_active];
		}
		
		if(!empty($status)){
			$status_datas=array(''=>'是否是管理员','1'=>'普通用户','2'=>'管理员');
			$com_condition['管理员:w%']=$status_datas[$status];
		}

	  if(!empty($create_time)){
			   $com_condition['注册时间:w%']=$create_time;
		}
		if(!empty($user_phone)){
			   $com_condition['手机号码:w%']=$user_phone;
		}

		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'create_name'=>$create_name,'information_theme'=>$information_theme,'information_recommend'=>$information_recommend,'user_login'=>$user_login,'level'=>$level,'user_active'=>$user_active,'status'=>$status,'create_time'=>$create_time));
  } 
}
?>
