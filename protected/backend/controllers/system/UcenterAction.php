<?php
class UcenterAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("Ucenter设置"));
     return true;
  }
  protected function do_action(){	
		$this->display('ucenter',array('model'=>$model));
  } 
}
?>
