<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("抵用劵管理"));
     return true;
  }
  protected function do_action(){	
  	$model=new Coupon();
		$this->display('index',array('model'=>$model));
  } 
}
?>
