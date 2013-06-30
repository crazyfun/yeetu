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
	  	$add_datas['status']=$status;
	  	$update_flag=$model->update_table_datas($id,$add_datas);
		}
		$this->controller->redirect($this->controller->createUrl("user/index",array()));
  } 
}
?>
