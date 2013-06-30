<?php
class CarAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("车队管理"=>array('motorcade/index'),'车辆管理'));
     return true;
  }
  protected function do_action(){
		$motorcade_id=$_REQUEST['motorcade_id'];
		//初始化数据判断是否登录没有登陆转到登陆页面并且过滤 $_REQUEST的数据
		$model=new Car();
		$this->display('car',array('model'=>$model,'motorcade_id'=>$motorcade_id));
  } 
}
?>
