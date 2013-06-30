<?php
class FreetcController extends AController
{
	public $trave_category='5';
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter + add,delete,recycle,recommend,bargain,publish,hot,travehotels,hoteldefault,travedate,addtravedate,deletetravedate,closetravedate,addtravearea,deletetravearea,closetravearea,traveimage,addtraveimage,deletetraveimage',
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
		 'index'=>'application.backend.controllers.freetc.IndexAction',
		 'add'=>'application.backend.controllers.freetc.AddAction',
		 'search'=>'application.backend.controllers.freetc.SearchAction',
		 'addfreetc'=>'application.backend.controllers.freetc.AddfreetcAction',
		 'delete'=>'application.backend.controllers.freetc.DeleteAction',
		 'recommend'=>'application.backend.controllers.freetc.RecommendAction',
		 'bargain'=>'application.backend.controllers.freetc.BargainAction',
		 'publish'=>'application.backend.controllers.freetc.PublishAction',
		 'hot'=>'application.backend.controllers.freetc.HotAction',
		 'district'=>'application.backend.controllers.freetc.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.freetc.SubdistrictAction',
		 'line'=>'application.backend.controllers.freetc.LineAction',
		 'subline'=>'application.backend.controllers.freetc.SublineAction',
		 'travedate'=>'application.backend.controllers.freetc.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.freetc.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.freetc.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.freetc.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.freetc.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.freetc.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.freetc.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.freetc.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.freetc.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.freetc.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.freetc.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.freetc.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.freetc.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.freetc.OpentraveareaAction',
		 'traveflight'=>'application.backend.controllers.freetc.TraveflightAction',
		 'searchtraveflight'=>'application.backend.controllers.freetc.SearchtraveflightAction',
		 'addtraveflight'=>'application.backend.controllers.freetc.AddtraveflightAction',
		 'inserttraveflight'=>'application.backend.controllers.freetc.InserttraveflightAction',
		 'deletetraveflight'=>'application.backend.controllers.freetc.DeletetraveflightAction',
		 'closetraveflight'=>'application.backend.controllers.freetc.ClosetraveflightAction',
		 'opentraveflight'=>'application.backend.controllers.freetc.OpentraveflightAction',
		 'ajaxtarea'=>'application.backend.controllers.freetc.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.freetc.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.freetc.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.freetc.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.freetc.DeletetraveimageAction',
		 'travehotels'=>'application.backend.controllers.freetc.TravehotelsAction',
		 'searchth'=>'application.backend.controllers.freetc.SearchthAction',
		 'hoteldefault'=>'application.backend.controllers.freetc.HoteldefaultAction',
		 'recycle'=>'application.backend.controllers.freetc.RecycleAction',
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
