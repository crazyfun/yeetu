<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Agency();
  	if(isset($_POST['Agency'])){
  		$this->controller->bc(array("旅行社管理"=>array('agency/index'),'增加旅行社'));
  		if(!empty($_POST['Agency']['id'])){
  			$model=$model->get_table_datas($_POST['Agency']['id']);
  		}
			$model->id=$_POST['Agency']['id'];
			$model->attributes=$_POST['Agency'];
		if($model->validate()){
			$model->insert_agency();
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}else{
		$id=$_REQUEST['id'];
		if(!empty($id)){
				$this->controller->bc(array("旅行社管理"=>array('agency/index'),'修改旅行社'));
			 	$model=$model->get_table_datas($id,array());
		}else{
				$this->controller->bc(array("旅行社管理"=>array('agency/index'),'增加旅行社'));
		}
	}
	$this->display('add',array('model'=>$model));
  } 
}
?>
