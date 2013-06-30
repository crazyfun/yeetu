<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new TravelInfor();
  	if(isset($_POST['TravelInfor'])){
  		$this->controller->bc(array("资讯列表"=>array('tinfor/index'),'增加旅游资讯'));
  		if(!empty($_POST['TravelInfor']['id'])){
  		  $model=$model->get_table_datas($_POST['TravelInfor']['id']);
  		}
			$model->id=$_POST['TravelInfor']['id'];
			$model->attributes=$_POST['TravelInfor'];
			
			if($model->validate()){
			  $model->insert_travel_infor();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("资讯列表"=>array('tinfor/index'),'修改旅游资讯'));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("资讯列表"=>array('tinfor/index'),'增加旅游资讯'));
			}
		}
		$this->display('add_tinfor',array('model'=>$model));
  } 
}
?>
