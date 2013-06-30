<?php
class AddtraverouteAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$id=$_REQUEST['id'];
		$trave_id=$_REQUEST['trave_id'];
		$model=new Traveroute;
		if(!empty($id)){
			 $this->controller->bc(array("跟团游"=>array('group/index'),"修改跟团游行程"));
			 $model=$model->get_table_datas($id,array());
		}else{
			$this->controller->bc(array("跟团游"=>array('group/index'),"增加跟团游行程"));
			$max_route_day_datas=$model->find(array('select'=>'MAX(route_day) as route_day','condition'=>'trave_id=:trave_id','params'=>array(':trave_id'=>$trave_id)));
			$model->route_day=$max_route_day_datas->route_day+1;
		}
		$model->trave_id=$trave_id;
		$this->display('add_trave_route',array('model'=>$model));
  } 
}
?>
