<?php
class NationController extends AController
{
	public $trave_category='1';
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
		 'index'=>'application.backend.controllers.nation.IndexAction',
		 'add'=>'application.backend.controllers.nation.AddAction',
		 'search'=>'application.backend.controllers.nation.SearchAction',
		 'addnation'=>'application.backend.controllers.nation.AddnationAction',
		 'delete'=>'application.backend.controllers.nation.DeleteAction',
		 'recommend'=>'application.backend.controllers.nation.RecommendAction',
		 'bargain'=>'application.backend.controllers.nation.BargainAction',
		 'hot'=>'application.backend.controllers.nation.HotAction',
		 'publish'=>'application.backend.controllers.nation.PublishAction',
		 'district'=>'application.backend.controllers.nation.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.nation.SubdistrictAction',
		 'line'=>'application.backend.controllers.nation.LineAction',
		 'subline'=>'application.backend.controllers.nation.SublineAction',
		 'travedate'=>'application.backend.controllers.nation.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.nation.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.nation.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.nation.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.nation.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.nation.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.nation.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.nation.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.nation.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.nation.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.nation.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.nation.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.nation.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.nation.OpentraveareaAction',
		 'traveroute'=>'application.backend.controllers.nation.TraverouteAction',
		 'addtraveroute'=>'application.backend.controllers.nation.AddtraverouteAction',
		 'inserttraveroute'=>'application.backend.controllers.nation.InserttraverouteAction',
		 'deletetraveroute'=>'application.backend.controllers.nation.DeletetraverouteAction',
		 'ajaxtarea'=>'application.backend.controllers.nation.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.nation.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.nation.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.nation.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.nation.DeletetraveimageAction',
		 'recycle'=>'application.backend.controllers.nation.RecycleAction',
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
