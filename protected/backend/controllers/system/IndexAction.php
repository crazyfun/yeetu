<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("系统变量设置"));
     return true;
  }
  protected function do_action(){	
  	$model=new System();
		$this->display('index',array('model'=>$model));
  } 
}
?>
