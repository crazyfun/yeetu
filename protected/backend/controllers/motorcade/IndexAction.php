<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("车队管理"));
     return true;
  }
  protected function do_action(){
  	$model=new Motorcade();
	  $this->display('index',array('model'=>$model));
  } 
}
?>
