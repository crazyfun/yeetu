<?php
class FreetnController extends AController
{
	public $trave_category='5';
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter + add,delete,recycle,recommend,bargain,publish,hot,travehotels,hoteldefault,travedate,addtravedate,deletetravedate,closetravedate,travearea,addtravearea,deletetravearea,closetravearea,traveimage,addtraveimage,deletetraveimage',
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
		 'index'=>'application.backend.controllers.freetn.IndexAction',
		 'add'=>'application.backend.controllers.freetn.AddAction',
		 'search'=>'application.backend.controllers.freetn.SearchAction',
		 'addfreetn'=>'application.backend.controllers.freetn.AddfreetnAction',
		 'delete'=>'application.backend.controllers.freetn.DeleteAction',
		 'recommend'=>'application.backend.controllers.freetn.RecommendAction',
		 'bargain'=>'application.backend.controllers.freetn.BargainAction',
		 'publish'=>'application.backend.controllers.freetn.PublishAction',
		 'hot'=>'application.backend.controllers.freetn.HotAction',
		 'district'=>'application.backend.controllers.freetn.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.freetn.SubdistrictAction',
		 'line'=>'application.backend.controllers.freetn.LineAction',
		 'subline'=>'application.backend.controllers.freetn.SublineAction',
		 'travedate'=>'application.backend.controllers.freetn.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.freetn.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.freetn.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.freetn.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.freetn.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.freetn.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.freetn.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.freetn.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.freetn.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.freetn.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.freetn.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.freetn.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.freetn.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.freetn.OpentraveareaAction',
		 'traveflight'=>'application.backend.controllers.freetn.TraveflightAction',
		 'searchtraveflight'=>'application.backend.controllers.freetn.SearchtraveflightAction',
		 'addtraveflight'=>'application.backend.controllers.freetn.AddtraveflightAction',
		 'inserttraveflight'=>'application.backend.controllers.freetn.InserttraveflightAction',
		 'deletetraveflight'=>'application.backend.controllers.freetn.DeletetraveflightAction',
		 'closetraveflight'=>'application.backend.controllers.freetn.ClosetraveflightAction',
		 'opentraveflight'=>'application.backend.controllers.freetn.OpentraveflightAction',
		 'ajaxtarea'=>'application.backend.controllers.freetn.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.freetn.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.freetn.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.freetn.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.freetn.DeletetraveimageAction',
		 'travehotels'=>'application.backend.controllers.freetn.TravehotelsAction',
		 'searchth'=>'application.backend.controllers.freetn.SearchthAction',
		 'hoteldefault'=>'application.backend.controllers.freetn.HoteldefaultAction',
		 'recycle'=>'application.backend.controllers.freetn.RecycleAction',
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
	/*
	function init_page(){
		$this->layout="trave";
		Util::reset_vars();
	}
	 */
	
	function init_travedate_page(){
		$this->layout="none";
		Util::reset_vars();
	}
	
	function init_travearea_page(){
		$this->layout="none";
		Util::reset_vars();
	}
	
}
