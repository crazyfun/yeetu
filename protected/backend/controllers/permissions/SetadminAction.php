<?php
class SetadminAction extends BaseAction{
  protected function beforeAction(){
    
     return true;
  }
  protected function do_action(){	
		$model=new User();
		$id=$_REQUEST['id'];
		$status=$_REQUEST['status'];
		if(!empty($id)){
			$user_datas=$model->get_table_datas(Yii::app()->user->id);
	  	$add_datas['status']=$status;
	  	if($status=='1'){
	  	   $add_datas['permissions_type']="";
	  	}else{
	  		$add_datas['permissions_type']=$user_datas->permissions_type;
	  	}
	  	$update_flag=$model->update_table_datas($id,$add_datas);
		}
		$this->controller->redirect($this->controller->createUrl("permissions/userindex",array()));
  } 
}
?>
