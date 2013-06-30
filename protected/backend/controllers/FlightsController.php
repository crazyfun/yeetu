<?php
class FlightsController extends AController
{
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter +addtraveflight,deletetraveflight',
		);
	}
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
  	  $user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $flight_datas= TraveFlight::model()->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$id),'with'=>array('User')));
  	  $user_permissions_type=$flight_datas->User->permissions_type;
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
		 'traveflight'=>'application.backend.controllers.flights.TraveflightAction',
		 'searchtraveflight'=>'application.backend.controllers.flights.SearchtraveflightAction',
		 'addtraveflight'=>'application.backend.controllers.flights.AddtraveflightAction',
		 'inserttraveflight'=>'application.backend.controllers.flights.InserttraveflightAction',
		 'deletetraveflight'=>'application.backend.controllers.flights.DeletetraveflightAction',
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
	//初始化需要的数据
	/*
	function init_page(){
		$this->layout="trave";
		Util::reset_vars();
	}
	 */

}
