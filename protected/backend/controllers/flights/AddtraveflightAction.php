<?php
class AddtraveflightAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$id=$_REQUEST['id'];
		$model=new TraveFlight();
		if(!empty($id)){
			 $this->controller->bc(array("航班"=>array('flights/traveflight'),'修改航班'));
			 $model=$model->get_table_datas($id,array());
		}else{
		     $this->controller->bc(array("航班"=>array('flights/traveflight'),'增加航班'));	
		}
		$this->display('add_trave_flight',array('model'=>$model));
  } 
}
?>
