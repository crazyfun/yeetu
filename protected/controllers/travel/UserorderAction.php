<?php
class UserorderAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_ORDER,'',array());
    	$this->controller->init_order_page();
    	return true;
    	
    }
   
  protected function do_action(){
   	$trave_id=$_GET['id'];
		$order_id=$_GET['order_id'];
		$separate_id=$_GET['separate_id'];
		$total_price=$_GET['pay_price'];
		$this->display('travel_pay',array('trave_id'=>$trave_id,'order_id'=>$order_id,'separate_id'=>$separate_id,'total_price'=>$total_price));
  }
 
 
    
}
?>
