<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Cicerone();
  	if(isset($_POST['Cicerone'])){
  		$this->controller->bc(array("导游管理"=>array('cicerone/index'),'增加导游'));
  		if(!empty($_POST['Cicerone']['id'])){
  			$model=$model->get_table_datas($_POST['Cicerone']['id']);
  		}
			$model->id=$_POST['Cicerone']['id'];
			$model->attributes=$_POST['Cicerone'];
		if($model->validate()){
			$model->insert_cicerone();
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}else{
		$id=$_REQUEST['id'];
		if(!empty($id)){
			    $this->controller->bc(array("导游管理"=>array('cicerone/index'),'修改导游'));
			 	$model=$model->get_table_datas($id,array());
		}else{
		       	$this->controller->bc(array("导游管理"=>array('cicerone/index'),'增加导游'));	
		}
	}
	$this->display('add',array('model'=>$model));
  } 
}
?>
