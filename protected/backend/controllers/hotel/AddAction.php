<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Hotel();
  	if(isset($_POST['Hotel'])){
  		$this->controller->bc(array("酒店管理"=>array('hotel/index'),'增加酒店'));
  		if(!empty($_POST['Hotel']['id'])){
  			$model=$model->get_table_datas($_POST['Hotel']['id']);
  		}
			$model->id=$_POST['Hotel']['id'];
			$model->attributes=$_POST['Hotel'];
		if($model->validate()){
			$model->insert_hotel();
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}else{
		$id=$_REQUEST['id'];
		if(!empty($id)){
			   $this->controller->bc(array("酒店管理"=>array('hotel/index'),'修改酒店'));
			 	$model=$model->get_table_datas($id,array());
		}else{
			$this->controller->bc(array("酒店管理"=>array('hotel/index'),'增加酒店'));
		}
	}
	$this->display('add',array('model'=>$model));
  } 
}
?>
