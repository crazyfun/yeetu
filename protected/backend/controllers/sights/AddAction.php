<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Sights();
  	if(isset($_POST['Sights'])){
  		$this->controller->bc(array("景区管理"=>array('sights/index'),'增加景区'));
  		if(!empty($_POST['Sights']['id'])){
  			$model=$model->get_table_datas($_POST['Sights']['id']);
  		}
			$model->id=$_POST['Sights']['id'];
			$model->attributes=$_POST['Sights'];
		if($model->validate()){
			$model->insert_sights();
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}else{
		$id=$_REQUEST['id'];
		if(!empty($id)){
				$this->controller->bc(array("景区管理"=>array('sights/index'),'修改景区'));
			 	$model=$model->get_table_datas($id,array());
		}else{
		        $this->controller->bc(array("景区管理"=>array('sights/index'),'增加景区'));	
		}
	}
	$this->display('add',array('model'=>$model));
  } 
}
?>
