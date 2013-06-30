<?php
class RecycletraveController extends AController
{
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter + restore,delet',
		);
	}
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
  	  $user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $trave_datas=Trave::model()->get_table_datas($id);
  	  $trave_permissions_type=$trave_datas->trave_sregion;
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
		 'index'=>'application.backend.controllers.recycletrave.IndexAction',
		 'restore'=>'application.backend.controllers.recycletrave.RestoreAction',
		 'search'=>'application.backend.controllers.recycletrave.SearchAction',
		 'delet'=>'application.backend.controllers.recycletrave.DeletAction',
		);
	}
	//获取景区的途径
	function get_trave_route_name($trave_route){
		$travearea_model=new Travearea;
  	$condition['trave_id']=$trave_id;
  	$condition['trave_status']='1';
    $travearea_datas=$travearea_model->get_table_datas("",$condition);
    $travearea_data=$travearea_datas['datas'];
    $trave_area_name="";
    foreach((array)$travearea_data as $key => $value){
      if(empty($trave_area_name)){
      	$trave_area_name.=$value->trave_area;
      }else{
      	$trave_area_name.="-".$value->trave_area;
      }
    } 
  	return $trave_area_name;
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
	
	function init_travedate_page(){
		$this->layout="none";
		Util::reset_vars();
	}
	
	function init_travearea_page(){
		$this->layout="none";
		Util::reset_vars();
	}
	
}
