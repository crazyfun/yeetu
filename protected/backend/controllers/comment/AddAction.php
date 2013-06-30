<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("用户评论"=>array('comment/index'),"用户评论修改"));
     return true;
  }
  protected function do_action(){	
  	$model=new TraveComment();
  	if(isset($_POST['TraveComment'])){
  		if(!empty($_POST['TraveComment']['id'])){
  			$model=$model->get_table_datas($_POST['TraveComment']['id']);
  		}
			$model->id=$_POST['TraveComment']['id'];
			$model->attributes=$_POST['TraveComment'];
			if($model->validate()){
			  $model->insert_trave_comment();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
			 	$model=$model->get_table_datas($id,array());
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
