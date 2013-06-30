<?php
class InsuranceAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("订单保险管理"));
     return true;
  }
  protected function do_action(){
  		$model=new Ordercontact();
		$this->display('insurances',array('model'=>$model));
  } 
}
?>
