<?php
class AddthemeAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new InforTheme();
  	if(isset($_POST['InforTheme'])){
  		$this->controller->bc(array("资讯分类"=>array('tinfor/theme'),'增加旅游分类'));
  		if(!empty($_POST['InforTheme']['id'])){
  			$model=$model->get_table_datas($_POST['InforTheme']['id']);
  		}
			$model->id=$_POST['InforTheme']['id'];
			$model->attributes=$_POST['InforTheme'];
			if($model->validate()){
			  $model->insert_infor_theme();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("资讯分类"=>array('tinfor/theme'),'修改旅游分类'));
			 	$model=$model->get_table_datas($id,array());
			}else{
			    $this->controller->bc(array("资讯分类"=>array('tinfor/theme'),'增加旅游分类'));	
			}
		}
		$this->display('add_theme',array('model'=>$model));
  } 
}
?>
