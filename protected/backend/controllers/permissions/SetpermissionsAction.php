<?php
class SetpermissionsAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new User();
  	if(isset($_POST['User'])){
  		$this->controller->bc(array("设置用户权限"=>array('permissions/userindex'),"分配权限"));
  		if(!empty($_POST['User']['id'])){
  			$model=$model->get_table_datas($_POST['User']['id']);
  		}
      $model->attributes=$_POST['User'];
      $permissions=$_POST['permissions'];
      $permissions_value=implode(",",$permissions);
      $model->permissions=$permissions_value;
      $result=$model->save();
      if($result){
      	Permissions::model()->set_user_permissions($_POST['User']['id'],$permissions);
      	$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
      }else{
      	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
      }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
			 	$model=$model->get_table_datas($id,array());
			}
			$this->controller->bc(array("设置用户权限"=>array('permissions/userindex'),"分配权限"));
		}
		$this->display('set_permissions',array('model'=>$model));
  } 
}
?>
