<?php
class AddcAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new ImageCategory();
  	if(isset($_POST['ImageCategory'])){
  		$this->controller->bc(array("图片分类管理"=>array('images/category'),"增加图片分类"));
  		if(!empty($_POST['ImageCategory']['id'])){
  			$model=$model->get_table_datas($_POST['ImageCategory']['id']);
  		}
			$model->id=$_POST['ImageCategory']['id'];
			$model->attributes=$_POST['ImageCategory'];
			if($model->validate()){
			  $model->insert_images_category();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("图片分类管理"=>array('images/category'),"修改图片分类"));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("图片分类管理"=>array('images/category'),"增加图片分类"));	
			}
		}
		$this->display('addc',array('model'=>$model));
  } 
}
?>
