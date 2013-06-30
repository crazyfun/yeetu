<?php
class AddcategoryAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("线路分类"=>array('category/index'),'增加线路分类'));
      return true;
    }

  protected function do_action(){	
		$model=new Category;
		if(isset($_POST['Category'])){
			if(!empty($_POST['Category']['id'])){
				$model=$model->get_table_datas($_POST['Category']['id']);
			}
			$model->id=$_POST['Category']['id'];
			$model->attributes=$_POST['Category'];
			$model->parent_id=$_POST['parent_id'];
			if($model->validate()){
			  $model->insert_category();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
		  	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}
		$this->display('add_category',array('model' => $model));
  }
 
 
    
}
?>
