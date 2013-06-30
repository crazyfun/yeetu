<?php
class SearchcarAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("车队管理"=>array('motorcade/index'),'车辆管理'));
     return true;
  }
  protected function do_action(){	
		$model=new Car();
		$car_num=$_REQUEST['car_num'];
		$driver_phone = $_REQUEST['driver_phone'];
		$trave = $_REQUEST['trave'];
		$motorcade_id=$_REQUEST['motorcade_id'];
		if(!empty($car_num)){
			 $com_condition['车牌号:w%']=$car_num;
		}
		if(!empty($driver_phone)){
			$com_condition['驾驶员电话:w%'] = $driver_phone;
		}
		if(!empty($trave)){
			$com_condition['线路名称:w%'] = $trave;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('car',array('model'=>$model,'com_condition_search'=>$com_condition_search,'car_num'=>$car_num,'driver_phone'=>$driver_phone,'trave'=>$trave,'motorcade_id'=>$motorcade_id));
  } 
}
?>
