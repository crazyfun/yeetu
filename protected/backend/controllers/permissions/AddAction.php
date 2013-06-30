<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Permissions();
  	if(isset($_POST['Permissions'])){
  		$this->controller->bc(array("权限管理"=>array('permissions/index'),"增加权限"));
  		if(!empty($_POST['Permissions']['id'])){
  			$model=$model->get_table_datas($_POST['Permissions']['id']);
  		}
      $model->attributes=$_POST['Permissions'];
			$permission_value=$_REQUEST['permission_value'];
			if(!empty($permission_value)){
			  $model->permissions_value=implode(",",$permission_value);
			}
			if($model->validate()){
			  $model->insert_permissions();
			  $model->set_permissions($model->permissions_name,$permission_value);
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("权限管理"=>array('permissions/index'),"修改权限"));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("权限管理"=>array('permissions/index'),"增加权限"));	
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
