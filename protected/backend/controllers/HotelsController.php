<?php
class HotelsController extends AController
{
	
	 public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter +add,delete,room,addroom,deleteroom,defaultroom',
		);
	}
	
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		$hotel_id=$_GET['hotel_id'];
		if(!empty($hotel_id)){
			$id=$hotel_id;
		}
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
  	  $user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $hotels_datas= Hotels::model()->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$id),'with'=>array('User')));
  	  $user_permissions_type=$hotels_datas->User->permissions_type;
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
		  'index'=>'application.backend.controllers.hotels.IndexAction',
		  'add'=>'application.backend.controllers.hotels.AddAction',
		  'addhotel'=>'application.backend.controllers.hotels.AddhotelAction',
		  'delete'=>'application.backend.controllers.hotels.DeleteAction',
		  'search'=>'application.backend.controllers.hotels.SearchAction',
		  'room'=>'application.backend.controllers.hotels.RoomAction',
		  'addroom'=>'application.backend.controllers.hotels.AddroomAction',
		  'deleteroom'=>'application.backend.controllers.hotels.DeleteroomAction',
		  'defaultroom'=>'application.backend.controllers.hotels.DefaultroomAction',

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
