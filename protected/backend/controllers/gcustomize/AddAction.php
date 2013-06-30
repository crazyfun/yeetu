<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new GroupCustomize();
  	if(isset($_POST['GroupCustomize'])){
  		$this->controller->bc(array("公司旅游"=>array('gcustomize/index'),'增加公司旅游'));
  		if(!empty($_POST['GroupCustomize']['id'])){
  			$model=$model->get_table_datas($_POST['GroupCustomize']['id']);
  		}
			$model->id=$_POST['GroupCustomize']['id'];
			$model->attributes=$_POST['GroupCustomize'];
			$model->reply_time=$_POST['reply_time'];
		 	$model->transport=$_POST['transport'];
		  $model->stay=$_POST['stay'];
		 	$model->dinning=$_POST['dinning'];
		 	$model->guide=$_POST['guide'];
		 	$model->shopping=$_POST['shopping'];
		 	$model->meeting=$_POST['meeting'];
			if($model->validate()){
			  $model->insert_group();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("公司旅游"=>array('gcustomize/index'),'修改公司旅游'));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("公司旅游"=>array('gcustomize/index'),'增加公司旅游'));
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
