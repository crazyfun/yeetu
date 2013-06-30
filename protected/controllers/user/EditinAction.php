<?php
class EditinAction extends  BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_page();
		  $this->controller->user_tag='information';
		  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'修改个人资料')
      );
      $this->controller->pt($this->id,array());
    	return true;
    }
  
 protected function do_action(){
    $user=new User("EditIn");
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		if(isset($_POST['User'])){
			if(!empty($user_id)){
	  	 	$user=$user->get_table_datas($user_id);
	  	 }
	  	 $user->setScenario("EditIn");
	  	 $user->id=$user_id;
	  	 $user->user_sex=$_POST['user_sex'];
	  	 $user->attributes=$_POST['User'];
	  	 if($user->validate()){
	  	 	   $result=$user->insert_user();
	  	 	   $user_datas=$user->get_table_datas($user_id);
	  	 	   $this->controller->f(CV::SUCCESS_EDITIN);
	  	 	   $this->display("user_editin",array("model"=>$user,'user_datas'=>$user_datas));
	     }else{
	     	 $user_datas=$user->get_table_datas($user_id);
	     	 $this->display("user_editin",array("model"=>$user,'user_datas'=>$user_datas));
	    }
	  }else{
	  	$user_datas=$user->get_table_datas($user_id);
		  $this->display("user_editin",array("model"=>$user_datas,'user_datas'=>$user_datas));
		 }
   	
  }
 
 
    
}
?>
