<?php
class PeripheralController extends AController
{
	public $trave_category='2';
	
	 public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter + add,delete,recycle,recommend,bargain,hot,publish,traveroute,addtraveroute,deletetraveroute,travedate,addtravedate,deletetravedate,closetravedate,travearea,addtravearea,deletetravearea,closetravearea,traveimage,addtraveimage,deletetraveimage',
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
		 'index'=>'application.backend.controllers.peripheral.IndexAction',
		 'add'=>'application.backend.controllers.peripheral.AddAction',
		 'search'=>'application.backend.controllers.peripheral.SearchAction',
		 'addperipheral'=>'application.backend.controllers.peripheral.AddperipheralAction',
		 'delete'=>'application.backend.controllers.peripheral.DeleteAction',
		 'recommend'=>'application.backend.controllers.peripheral.RecommendAction',
		 'bargain'=>'application.backend.controllers.peripheral.BargainAction',
		 'publish'=>'application.backend.controllers.peripheral.PublishAction',
		 'hot'=>'application.backend.controllers.peripheral.HotAction',
		 'district'=>'application.backend.controllers.peripheral.DistrictAction',
		 'subdistrict'=>'application.backend.controllers.peripheral.SubdistrictAction',
		 'line'=>'application.backend.controllers.peripheral.LineAction',
		 'subline'=>'application.backend.controllers.peripheral.SublineAction',
		 'travedate'=>'application.backend.controllers.peripheral.TravedateAction',
		 'searchtravedate'=>'application.backend.controllers.peripheral.SearchtravedateAction',
		 'addtravedate'=>'application.backend.controllers.peripheral.AddtravedateAction',
		 'inserttravedate'=>'application.backend.controllers.peripheral.InserttravedateAction',
		 'deletetravedate'=>'application.backend.controllers.peripheral.DeletetravedateAction',
		 'closetravedate'=>'application.backend.controllers.peripheral.ClosetravedateAction',
		 'opentravedate'=>'application.backend.controllers.peripheral.OpentravedateAction',
		 'travearea'=>'application.backend.controllers.peripheral.TraveareaAction',
		 'searchtravearea'=>'application.backend.controllers.peripheral.SearchtraveareaAction',
		 'addtravearea'=>'application.backend.controllers.peripheral.AddtraveareaAction',
		 'inserttravearea'=>'application.backend.controllers.peripheral.InserttraveareaAction',
		 'deletetravearea'=>'application.backend.controllers.peripheral.DeletetraveareaAction',
		 'closetravearea'=>'application.backend.controllers.peripheral.ClosetraveareaAction',
		 'opentravearea'=>'application.backend.controllers.peripheral.OpentraveareaAction',
		 'traveroute'=>'application.backend.controllers.peripheral.TraverouteAction',
		 'addtraveroute'=>'application.backend.controllers.peripheral.AddtraverouteAction',
		 'inserttraveroute'=>'application.backend.controllers.peripheral.InserttraverouteAction',
		 'deletetraveroute'=>'application.backend.controllers.peripheral.DeletetraverouteAction',
		 'ajaxtarea'=>'application.backend.controllers.peripheral.AjaxtareaAction',
		 'traveimage'=>'application.backend.controllers.peripheral.TraveimageAction',
		 'addtraveimage'=>'application.backend.controllers.peripheral.AddtraveimageAction',
		 'inserttraveimage'=>'application.backend.controllers.peripheral.InserttraveimageAction',
		 'deletetraveimage'=>'application.backend.controllers.peripheral.DeletetraveimageAction',
		 'recycle'=>'application.backend.controllers.peripheral.RecycleAction',		 
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
