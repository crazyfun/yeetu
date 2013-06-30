<?php
class UserIndexAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		$this->controller->bc(array("设置用户权限"));
		$model=new User();
		$this->display('user',array('model'=>$model));
	} 
}
?>
