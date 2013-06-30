<?php
class InsertcarAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Car();
  	$motorcade_id=$_REQUEST['motorcade_id'];
  	if(isset($_POST['Car'])){
  		$this->controller->bc(array("车队管理"=>array('motorcade/index'),'增加车辆'));	
  		if(!empty($_POST['Car']['id'])){
  			$model=$model->get_table_datas($_POST['Car']['id']);
  		}
		$model->attributes=$_POST['Car'];
		if($model->validate()){
			  $model->insert_car();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}
	$this->display('addcar',array('model'=>$model,'motorcade_id'=>$motorcade_id));
  } 
}
?>
