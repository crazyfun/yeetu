<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Motorcade();
  	if(isset($_POST['Motorcade'])){
  		$this->controller->bc(array("车队管理"=>array('motorcade/index'),'增加车队'));
  		if(!empty($_POST['Motorcade']['id'])){
  			$model=$model->get_table_datas($_POST['Motorcade']['id']);
  		}
		$model->id=$_POST['Motorcade']['id'];
		$model->attributes=$_POST['Motorcade'];
		if($model->validate()){
			$model->insert_motorcade();
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}else{
		$id=$_REQUEST['id'];
		if(!empty($id)){
			 $this->controller->bc(array("车队管理"=>array('motorcade/index'),'修改车队'));
			 $model=$model->get_table_datas($id,array());
		}else{
		     $this->controller->bc(array("车队管理"=>array('motorcade/index'),'增加车队'));	
		}
	}
	$this->display('add',array('model'=>$model));
  } 
}
?>
