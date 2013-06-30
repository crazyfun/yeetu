<?php
class OrderviewAction extends  BaseAction{
  
	protected function beforeAction(){
		$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_ORDER,array());
		$this->controller->init_page();
		$this->controller->user_tag='order';
		$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
			array('用户中心'=>array("user/index"),'查看订单')
		);
		$order_id=$_GET['id'];
		$order_check=$this->check_order_user($order_id);
		if(!$order_check){
			$this->controller->redirect($this->controller->createUrl('error/error404',array()));
		}
		return true;
	}

	protected function do_action(){
		$order_id=$_GET['id'];
		$trave_order=new Traveorder();
		$trave_order_datas=$trave_order->with('trave',array('select'=>'trave.trave_sregion,trave.trave_region,trave.trave_name','condition'=>'','params'=>array()))->findByPk($order_id,"",array());
		$this->controller->pt($this->id,array('查看订单'.$trave_order_datas->trave->trave_name.'_会员中心-易途旅游网'));
		$this->display("order_view",array('trave_order_datas'=>$trave_order_datas));
  }
  protected function check_order_user($order_id){
  	 $trave_order=new Traveorder();
  	 $trave_order_datas=$trave_order->find(array('select'=>'create_id','condition'=>'id=:order_id','params'=>array(':order_id'=>$order_id)));
  	 $create_id=$trave_order_datas->create_id;
  	 $user_id=Yii::app()->user->id;
  	 if($create_id==$user_id){
  	   return true;	
  	 }else{
  	   return false;	
  	}
  }
}
?>
