<?php
class TravelPreviewAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
    	return true;
    }
  protected function do_action(){
  	$ts = time();
		$trave_id=$_GET['id'];
		$con=$_GET['con'];
		$tc=$_GET['tc'];
		$user_id=$_GET['user_id'];
		$trave=Trave::model();
		$trave=$trave->find(array('condition'=>'id=:trave_id','params'=>array(':trave_id'=>$trave_id)));
		$user=new User();
		$user_datas=$user->find(array('select'=>'status','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
		$user_status=$user_datas->status;
		if(empty($trave->id)||$user_status!='2'){
			 $this->controller->redirect($this->controller->createUrl('error/error404',array()));
		}
		$this->controller->set_trave_category($trave->trave_category);
		$this->_set_trave_breadcrumbs($this->controller->menu_tag,$trave->trave_name);
		$trave_category_name=$this->get_trave_category_name($trave->trave_category);
		
		$this->controller->pt($this->id,array($trave->trave_name."线路报价_要多少钱-易途旅游网"));
		$this->controller->desc("易途旅游网（41ly.cn）".$trave_category_name.",提供最佳".$trave->Sregion->district_name."到".$trave->Region->district_name.",".$trave->trave_name."相关的旅游景点门票,旅行线路价格报价,攻略大全,旅游地图,酒店住宿,特色美食等专业服务.");
		$this->controller->kw($trave->trave_optimization);
		
	 if($this->controller->trave_category=='5'){
	 	if($trave->is_package=='1'){
	 	   $this->display('free_detail',array('model'=>$trave,'ts'=>$ts,'con'=>$con,'tc'=>$tc));
	 	}else{
	 		 $this->display('pfree_detail',array('model'=>$trave,'ts'=>$ts,'con'=>$con,'tc'=>$tc));
	 	}
	}else{
		   $this->display('travel_detail',array('model'=>$trave,'ts'=>$ts,'con'=>$con,'tc'=>$tc));
	 }
  }

  private function get_trave_category_name($category_id){
	switch($category_id){
		case '1':
			return "出境旅游";
			break;
		case '2':
			return "周边旅游";
			break;
		case '3':
			return "国内旅游";
			break;
		case '4':
			return "团队旅游";
			break;
		case '5':
			return "自助游";
			break;
		break;
	}
  }
  
  private function  _set_trave_breadcrumbs($menu_tag,$trave_name){
  
  	switch($menu_tag){
		 	case 'n_travel':
    	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发出境旅游'=>array("travel/nation"),$trave_name)
        	);
		 	   break;
		 	case 'p_travel':
		 	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发周边旅游'=>array("travel/peripheral"),$trave_name)
        	);
		 	   break;
		 	case 'd_travel':
		 	  $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发国内旅游'=>array("travel/domestic"),$trave_name)
        	);
		 	   break;
		 	case 'g_travel':
		 	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发团队旅游'=>array("travel/group"),$trave_name)
        	);
        	break;
      case 's_travel':
		 	   $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array($this->controller->trave_sregion_name.'出发自助游'=>array("travel/free"),$trave_name)
        	);

		 	   break;
		 	default:
		 	   break;
		  }
  }
}
?>
