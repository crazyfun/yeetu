<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		$this->controller->bc(array("用户管理"));
		$model=new User();
		$this->display('index',array('model'=>$model));
	} 
}
?>
