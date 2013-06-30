<?php
class PermissionsController extends AController
{
	
	public function filters() {
		return array(
		  //'accessControl', // perform access control for CRUD operations
			'EditFilter +delete,add',
			'SetAdminFilter + setadmin,setpermissions',
		);
	}
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
    	$user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $validate_datas= Permissions::model()->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$id),'with'=>array('User')));
  	  $validate_user_id=$validate_datas->create_id;
  	  if(($validate_user_id!=$user_id)&&$permissions_type){
  		  $this->redirect($this->createUrl("error/error403"));
  	  }else{
	      $filterChain->run();
	    }
	  }else{
	  	$filterChain->run();
	  }
	}
	
	
	public function FilterSetAdminFilter($filterChain) {
		$id=$_GET['id'];
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
    	$user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $set_user_datas=User::model()->get_table_datas($id);
  	  $set_permissions_type=$set_user_datas->permissions_type;
  	  $user_status=$set_user_datas->status;
  	  if(($user_status=='2')&&($set_permissions_type!=$permissions_type)&&$permissions_type){
  		  $this->redirect($this->createUrl("error/error403"));
  	  }else{
	      $filterChain->run();
	    }
	  }else{
	  	$filterChain->run();
	  }
	}

	public function actions()
	{
		return array(
		  'index'=>'application.backend.controllers.permissions.IndexAction',
		  'add'=>'application.backend.controllers.permissions.AddAction',
		  'search'=>'application.backend.controllers.permissions.SearchAction',
		  'delete'=>'application.backend.controllers.permissions.DeleteAction',
		  'userindex'=>'application.backend.controllers.permissions.UserIndexAction',
		  'usersearch'=>'application.backend.controllers.permissions.UserSearchAction',
		  'setadmin'=>'application.backend.controllers.permissions.SetadminAction',
		  'setpermissions'=>'application.backend.controllers.permissions.SetpermissionsAction',
		  'setfp'=>'application.backend.controllers.permissions.SetfpAction',
		);
	}
	 public function f($msg_code){ 
     if($msg_code == CV::SUCCESS_ADMIN_OPERATE){
       $this->sf("操作成功");
     }
     if($msg_code == CV::FAILED_ADMIN_OPERATE){
     	$this->ff("操作失败");
     }
     if($msg_code == CV::ERROR_ADMIN_DATABASE){
     	 $this->ff("操作数据库错误");
     }
    }
}
