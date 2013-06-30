<?php
class ConsultingController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter +add,delete',
		);
	}
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
  	  $user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $consulting_datas= Consulting::model()->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$id),'with'=>array('Trave')));
  	  $trave_permissions_type=$consulting_datas->Trave->trave_sregion;
  	  if(($trave_permissions_type!=$permissions_type)&&$permissions_type){
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
		  'index'=>'application.backend.controllers.consulting.IndexAction',
		  'add'=>'application.backend.controllers.consulting.AddAction',
		  'search'=>'application.backend.controllers.consulting.SearchAction',
		  'delete'=>'application.backend.controllers.consulting.DeleteAction',
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
