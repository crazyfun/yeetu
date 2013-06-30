<?php
class GroupController extends AController
{
	public $trave_category='4';
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter + add,delete,recycle,recommend,bargain,publish,hot,traveroute,addtraveroute,deletetraveroute,travedate,addtravedate,deletetravedate,closetravedate,travearea,addtravearea,deletetravearea,closetravearea,traveimage,addtraveimage,deletetraveimage',
		);
	}
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		$trave_id=$_GET['trave_id'];
		if(!empty($trave_id)){
			$id=$trave_id;
		}
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
		 'index'=>'application.backend.controllers.group.IndexAction',
		 'add'=>'application.backend.controllers.group.AddAction',
		 'search'=>'application.backend.controllers.group.SearchAction',
		 'addgroup'=>'application.backend.controllers.group.AddgroupAction',
		 'delete'=>'application.backend.controllers.group.DeleteAction',
		 'recommend'=>'application.backend.controllers.group.RecommendAction',
		 'bargain'=>'application.backend.controllers.group.BargainAction',
		 'publish'=>'application.backend.controllers.group.PublishAction',
		 'hot'=>'application.backend.controllers.group.HotAction',
		 'district'=>'application.backend.controllers.group.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.group.SubdistrictAction',
		 'line'=>'application.backend.controllers.group.LineAction',
		 'subline'=>'application.backend.controllers.group.SublineAction',
		 'travedate'=>'application.backend.controllers.group.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.group.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.group.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.group.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.group.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.group.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.group.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.group.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.group.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.group.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.group.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.group.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.group.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.group.OpentraveareaAction',
		 'traveroute'=>'application.backend.controllers.group.TraverouteAction',
		 'addtraveroute'=>'application.backend.controllers.group.AddtraverouteAction',
		 'inserttraveroute'=>'application.backend.controllers.group.InserttraverouteAction',
		 'deletetraveroute'=>'application.backend.controllers.group.DeletetraverouteAction',
		 'ajaxtarea'=>'application.backend.controllers.group.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.group.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.group.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.group.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.group.DeletetraveimageAction',
		 'recycle'=>'application.backend.controllers.group.RecycleAction',
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
    
    
	//初始化需要的数据

	function init_page(){
		$this->layout="none";
		Util::reset_vars();
	}

	
	function init_travedate_page(){
		$this->init_page();
	}
	
	function init_travearea_page(){
		$this->init_page();
	}
}
