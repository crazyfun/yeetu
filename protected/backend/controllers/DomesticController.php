<?php
class DomesticController extends AController
{
	public $trave_category='3';
	
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
		 'index'=>'application.backend.controllers.domestic.IndexAction',
		 'add'=>'application.backend.controllers.domestic.AddAction',
		 'search'=>'application.backend.controllers.domestic.SearchAction',
		 'adddomestic'=>'application.backend.controllers.domestic.AdddomesticAction',
		 'delete'=>'application.backend.controllers.domestic.DeleteAction',
		 'recommend'=>'application.backend.controllers.domestic.RecommendAction',
		 'bargain'=>'application.backend.controllers.domestic.BargainAction',
		 'publish'=>'application.backend.controllers.domestic.PublishAction',
		 'hot'=>'application.backend.controllers.domestic.HotAction',
		 'district'=>'application.backend.controllers.domestic.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.domestic.SubdistrictAction',
		 'line'=>'application.backend.controllers.domestic.LineAction',
		 'subline'=>'application.backend.controllers.domestic.SublineAction',
		 'travedate'=>'application.backend.controllers.domestic.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.domestic.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.domestic.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.domestic.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.domestic.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.domestic.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.domestic.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.domestic.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.domestic.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.domestic.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.domestic.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.domestic.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.domestic.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.domestic.OpentraveareaAction',
		 'traveroute'=>'application.backend.controllers.domestic.TraverouteAction',
		 'addtraveroute'=>'application.backend.controllers.domestic.AddtraverouteAction',
		 'inserttraveroute'=>'application.backend.controllers.domestic.InserttraverouteAction',
		 'deletetraveroute'=>'application.backend.controllers.domestic.DeletetraverouteAction',
		 'ajaxtarea'=>'application.backend.controllers.domestic.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.domestic.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.domestic.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.domestic.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.domestic.DeletetraveimageAction',
		 'recycle'=>'application.backend.controllers.domestic.RecycleAction',
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
