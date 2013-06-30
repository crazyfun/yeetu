<?php
class OrderprintAction extends BaseAction{
  
    protected function beforeAction(){
    	
    	$this->controller->init_print_page();
      return true;
    }

  protected function do_action(){	
  	 $order_id=$_GET['id'];
  	 $trave_order=new Traveorder();
  	 $trave_route=new Traveroute();
  	 $order_contact=new Ordercontact();
  	 $trave_order_datas=$trave_order->with('trave')->find(array('select'=>'t.trave_id,t.adult_nums,t.child_nums,t.total_price,t.start_date','condition'=>'t.id=:order_id','params'=>array(":order_id"=>$order_id)));
  	 $trave_id=$trave_order_datas->trave_id;
  	 $trave_route_datas=$trave_route->findAll(array('condition'=>'trave_id=:trave_id','params'=>array(':trave_id'=>$trave_id)));
  	 $order_contact_datas=$order_contact->find(array('select'=>'contact_name','condition'=>'trave_order_id=:order_id','params'=>array(':order_id'=>$order_id)));
	   $this->display('print',array('trave_order_datas'=>$trave_order_datas,'trave_route_datas'=>$trave_route_datas,'order_contact_datas'=>$order_contact_datas));
  }
  
}
?>
