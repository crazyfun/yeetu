<?php
class CategoryAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("图片分类管理"));
     return true;
  }
  protected function do_action(){	
  	$model=new ImageCategory();
  	$category_title=$_REQUEST['category_title'];
		$this->display('category',array('model'=>$model,'category_title'=>$category_title));
  } 
}
?>
