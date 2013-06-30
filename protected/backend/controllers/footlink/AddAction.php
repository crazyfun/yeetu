<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Footlink();
  	if(isset($_POST['Footlink'])){
  		$this->controller->bc(array("底部连接"=>array('footlink/index'),"增加底部连接"));
  		if(!empty($_POST['Footlink']['id'])){
  			$model=$model->get_table_datas($_POST['Footlink']['id']);
  		}
			$model->id=$_POST['Footlink']['id'];
			$model->attributes=$_POST['Footlink'];
			if($model->validate()){
			  $model->insert_footlink();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("底部连接"=>array('footlink/index'),"修改底部连接"));
			 	$model=$model->get_table_datas($id,array());
			}else{
			    $this->controller->bc(array("底部连接"=>array('footlink/index'),"增加底部连接"));	
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
