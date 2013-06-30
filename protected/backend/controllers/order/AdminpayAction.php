<?php
class AdminpayAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array('订单管理'=>array('order/index'),"订单付款"));
      return true;
    }
  protected function do_action(){	
  	$model=new Orderpay();
  	$order_id=$_REQUEST['order_id'];
  	if(isset($_POST['Orderpay'])){
  		if(!empty($_POST['Orderpay']['id'])){
				$model=$model->get_table_datas($_POST['Orderpay']['id']);
			}
			$model->id=$_POST['Orderpay']['id'];
			$model->order_id=$order_id;
			$model->attributes=$_POST['Orderpay'];
			$model->operate_id=Yii::app()->user->id;
			if($model->validate()){
				$model->insert_orderpay();
				
				$trave_order=new Traveorder();
				$update_datas['pay_style']=$_POST['Orderpay']['trade_type'];
				$trave_order->update_table_datas($order_id,$update_datas);
				
				$trave=new Trave();
				$user=new User();
				$trave_order_datas=$trave_order->get_table_datas($order_id);
				$trave_datas=$trave->get_table_datas($trave_order_datas->trave_id);
        $user_datas=$user->get_table_datas($trave_order_datas->create_id);

				if(!empty($user_datas->user_phone)){
		       $send_mail=new SendMail("Pay Phone");
		       $send_mail->send_pay_phone("",$user_datas->user_phone,$user_datas->user_login,$trave_datas->trave_name,$trave_order_datas->start_date,$_POST['Orderpay']['total_fee']);
		    }
		    $people_nums=intval($trave_order_datas->adult_nums)+intval($trave_order_datas->child_nums);
		    $send_mail=new SendMail("Pay Email");
        $validate_flag=$user_datas->validate_user_email();
		    if($validate_flag){
		       $send_mail->send_pay_success_mail("",$user_datas->email,$trave_datas->trave_name,$trave_order_datas->start_date,$_POST['Orderpay']['total_fee'],$people_nums,$user_datas->user_login);
		    }   
 
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
  	}
    $this->display("admin_pay",array('model'=>$model,'order_id'=>$order_id));
  }  
}
?>
