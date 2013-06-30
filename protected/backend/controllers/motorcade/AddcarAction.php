<?php
class AddcarAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$id=$_REQUEST['id'];
		$motorcade_id=$_REQUEST['motorcade_id'];
		$model=new Car;
		if(!empty($id)){
			 $this->controller->bc(array("车队管理"=>array('motorcade/index'),'修改车辆'));
			 $model=$model->get_table_datas($id,array());
		}else{
	         $this->controller->bc(array("车队管理"=>array('motorcade/index'),'增加车辆'));	
		}
		$model->motorcade_id=$motorcade_id;
		$this->display('addcar',array('model'=>$model,'motorcade_id'=>$motorcade_id));
  } 
}
?>