<?php
class DetailAction extends  BaseAction{
  
    protected function beforeAction(){
    
      
    	$this->controller->init_page();
    	return true;
    }
  protected function do_action(){
  	$ts = time();
		$trave_id=$_GET['id'];
		$con=$_GET['con'];
		$tc=$_GET['tc'];
		$trave=Trave::model();
		$trave=$trave->find(array('condition'=>'id=:trave_id AND trave_status=:trave_status AND recycle=:recycle','params'=>array(':trave_id'=>$trave_id,':trave_status'=>'2',':recycle'=>'0')));
		if(empty($trave->id)){
			 $this->controller->redirect($this->controller->createUrl('error/error404',array()));
		}
		$this->controller->set_trave_category($trave->trave_category);
		$this->_set_trave_breadcrumbs($this->controller->menu_tag,$trave->trave_name);
		$trave_category_name=$this->get_trave_category_name($trave->trave_category);
		
		
		$this->controller->pt($this->id,array($trave->trave_name."_线路报价_景点_要多少钱-易途旅游网"));
		$this->controller->desc("易途旅游网（41ly.cn）".$trave_category_name.",提供最佳".$trave->Sregion->district_name."到".$trave->Region->district_name.",".$trave->trave_name."相关的旅游景点门票,旅行线路价格报价,攻略大全,旅游地图,酒店住宿,特色美食等专业服务.");
		$this->controller->kw($trave->trave_optimization);
		
		
		
		if(!Yii::app()->user->isGuest){
			//设置用户的历史浏览记录
			$trave_history=new TraveHistory();
			$conditions['trave_id']=$trave_id;
			$conditions['create_id']=Yii::app()->user->id;
			$trave_history_datas=$trave_history->get_table_datas("",$conditions);
			if(!empty($trave_history_datas)){
				$trave_history_time=$trave_history_datas[0]['create_time'];
				$trave_history_id=$trave_history_datas[0]['id'];
				$date=new Date();
				$diff_date=$date->dateDiff(intval($trave_history_time));
				//一天跟新一次
				if(abs($diff_date)>=1){
					 
					 $update_datas['create_time']=Util::current_time('timestamp');
					 $trave_history->update_table_datas($trave_history_id,$update_datas);
					 $credit=new Credit();
			     $user_id=Yii::app()->user->id;
			     $credit_desc="会员浏览线路:".$trave->trave_name.",赠送积分";
           $credit->set_credit_vars($user_id,"browser_per_route",'1',$credit_desc);
			  }
			}else{
			  $trave_history->trave_id=$trave_id;
			  $trave_history->insert_trave_history();
			}
			
	  }
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
