<?php
class AdminfinanAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("订单财务"=>array('financial/order'),'结算'));
      return true;
    }
  protected function do_action(){	
  	$model=new AgencyFinan();
  	$order_id=$_REQUEST['order_id'];
  	if(isset($_POST['AgencyFinan'])){
  		if(!empty($_POST['AgencyFinan']['id'])){
				$model=$model->get_table_datas($_POST['AgencyFinan']['id']);
			}
			$model->id=$_POST['AgencyFinan']['id'];
			$model->order_id=$order_id;
			$model->attributes=$_POST['AgencyFinan'];
			$model->finan_price=$_POST['finan_price'];
			if($model->validate()){
				$trave_order=new Traveorder();
				$trave_order_datas=$trave_order->get_table_datas($order_id,array());
				$trave_id=$trave_order_datas->trave_id;
				$trave_suppliers=$trave_order_datas->trave->trave_suppliers;
				$model->agency_id=$trave_suppliers;
				$model->trave_id=$trave_id;
				$model->insert_finan();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
  	}
  	$total_pay=$model->get_total_pay($order_id);
  	$already_pay=$model->get_already_pay($order_id);
  	$remain_pay=$model->get_remain_pay($order_id);
    $this->display("admin_finan",array('model'=>$model,'total_pay'=>$total_pay,'already_pay'=>$already_pay,'remain_pay'=>$remain_pay,'order_id'=>$order_id));
  }  
}
?>
