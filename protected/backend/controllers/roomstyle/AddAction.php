<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new RoomStyle();
  	if(isset($_POST['RoomStyle'])){
  		$this->controller->bc(array("酒店房型管理"=>array('roomstyle/index'),'增加酒店房型'));
  		if(!empty($_POST['RoomStyle']['id'])){
  			$model=$model->get_table_datas($_POST['RoomStyle']['id']);
  		}
			$model->id=$_POST['RoomStyle']['id'];
			$model->attributes=$_POST['RoomStyle'];
			if($model->validate()){
			  $model->insert_room_style();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("酒店房型管理"=>array('roomstyle/index'),'修改酒店房型'));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("酒店房型管理"=>array('roomstyle/index'),'增加酒店房型'));	
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
