<?php
class MotorcadeController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter +delete,add,settle,car,addcar,deletecar',
		);
	}
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		$motorcade_id=$_GET['motorcade_id'];
		if(!empty($motorcade_id)){
			$id=$motorcade_id;
		}
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
  	  $user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $validate_datas= Motorcade::model()->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$id),'with'=>array('User')));
  	  $user_permissions_type=$validate_datas->User->permissions_type;
  	  if(($user_permissions_type!=$permissions_type)&&$permissions_type){
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
		  'index'=>'application.backend.controllers.motorcade.IndexAction',
		  'add'=>'application.backend.controllers.motorcade.AddAction',
		  'search'=>'application.backend.controllers.motorcade.SearchAction',
		  'searchcar'=>'application.backend.controllers.motorcade.SearchcarAction',
		  'delete'=>'application.backend.controllers.motorcade.DeleteAction',
		  'deletecar'=>'application.backend.controllers.motorcade.DeletecarAction',
		  'car'=>'application.backend.controllers.motorcade.CarAction',
		  'addcar'=>'application.backend.controllers.motorcade.AddcarAction',
		  'insertcar'=>'application.backend.controllers.motorcade.InsertcarAction',
		  'settle'=>'application.backend.controllers.motorcade.SettleAction',
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
