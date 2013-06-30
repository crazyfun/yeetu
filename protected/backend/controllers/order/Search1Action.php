<?php
class Search1Action extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("订单保险管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Ordercontact();
		$trave_order_id=$_REQUEST['trave_order_id'];
		$trave_name=$_REQUEST['trave_name'];
		$contact_name=$_REQUEST['contact_name'];
		$order_user=$_REQUEST['order_user'];
		$insurance_id=$_REQUEST['insurance_id'];
		if(!empty($trave_order_id)){
			 $com_condition['订单ID:w%']=$trave_order_id;
		}
		if(!empty($trave_name)){
			$com_condition['线路名称:w%']=$trave_name;
		}
		if(!empty($order_user)){
			$com_condition['创建者:w%']=$order_user;
		}
		if(!empty($contact_name)){
			$com_condition['联系人:w%']=$contact_name;
		}
		if(!empty($insurance_id)){
			$com_condition['保险名称:w%']=$insurance_id;
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('insurances',array('model'=>$model,'com_condition_search'=>$com_condition_search,'trave_order_id'=>$trave_order_id,'trave_name'=>$trave_name,'order_user'=>$order_user,'contact_name'=>$contact_name,'insurance_id'=>$insurance_id));
  } 
}
?>
