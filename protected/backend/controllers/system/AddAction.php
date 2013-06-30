<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new System();
  	if(isset($_POST['System'])){
  		$this->controller->bc(array("系统变量设置"=>array('system/index'),"增加系统变量"));
  		if(!empty($_POST['System']['id'])){
  			$model=$model->get_table_datas($_POST['System']['id']);
  		}
			$model->id=$_POST['System']['id'];
			$model->attributes=$_POST['System'];
			if($model->validate()){
			  $model->insert_system();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("系统变量设置"=>array('system/index'),"修改系统变量"));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("系统变量设置"=>array('system/index'),"增加系统变量"));	
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
