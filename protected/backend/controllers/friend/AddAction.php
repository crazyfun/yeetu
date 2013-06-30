<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
	$id = $_GET['id'];
	if(empty($id)){
	   	$this->controller->bc(array("友情链接"=>array('system/index'),"增加友情链接"));	
	}else{
		$this->controller->bc(array("友情链接"=>array('system/index'),"修改友情链接"));
	}
	$model = empty($id) ? new FriendLink() : FriendLink::model()->findByPK($id);
  	if(isset($_POST['FriendLink'])){
		$model->attributes=$_POST['FriendLink'];
		if($model->validate() && $model->save()){
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}
		$this->display('add',array('model'=>$model));
  } 
}
?>
