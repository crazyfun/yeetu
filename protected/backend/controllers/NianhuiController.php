<?php
class NianhuiController extends AController
{
	public $trave_category='6';
	
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
		 'index'=>'application.backend.controllers.nianhui.IndexAction',
		 'add'=>'application.backend.controllers.nianhui.AddAction',
		 'search'=>'application.backend.controllers.nianhui.SearchAction',
		 'addfreetc'=>'application.backend.controllers.nianhui.AddfreetcAction',
		 'delete'=>'application.backend.controllers.nianhui.DeleteAction',
		 'recommend'=>'application.backend.controllers.nianhui.RecommendAction',
		 'bargain'=>'application.backend.controllers.nianhui.BargainAction',
		 'publish'=>'application.backend.controllers.nianhui.PublishAction',
		 'hot'=>'application.backend.controllers.nianhui.HotAction',
		 'district'=>'application.backend.controllers.nianhui.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.nianhui.SubdistrictAction',
		 'line'=>'application.backend.controllers.nianhui.LineAction',
		 'subline'=>'application.backend.controllers.nianhui.SublineAction',
		 'travedate'=>'application.backend.controllers.nianhui.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.nianhui.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.nianhui.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.nianhui.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.nianhui.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.nianhui.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.nianhui.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.nianhui.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.nianhui.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.nianhui.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.nianhui.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.nianhui.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.nianhui.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.nianhui.OpentraveareaAction',
		 'traveflight'=>'application.backend.controllers.nianhui.TraveflightAction',
		 'searchtraveflight'=>'application.backend.controllers.nianhui.SearchtraveflightAction',
		 'addtraveflight'=>'application.backend.controllers.nianhui.AddtraveflightAction',
		 'inserttraveflight'=>'application.backend.controllers.nianhui.InserttraveflightAction',
		 'deletetraveflight'=>'application.backend.controllers.nianhui.DeletetraveflightAction',
		 'closetraveflight'=>'application.backend.controllers.nianhui.ClosetraveflightAction',
		 'opentraveflight'=>'application.backend.controllers.nianhui.OpentraveflightAction',
		 'ajaxtarea'=>'application.backend.controllers.nianhui.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.nianhui.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.nianhui.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.nianhui.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.nianhui.DeletetraveimageAction',
		 'travehotels'=>'application.backend.controllers.nianhui.TravehotelsAction',
		 'searchth'=>'application.backend.controllers.nianhui.SearchthAction',
		 'hoteldefault'=>'application.backend.controllers.nianhui.HoteldefaultAction',
		 'recycle'=>'application.backend.controllers.nianhui.RecycleAction',
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
