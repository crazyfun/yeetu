<?php
class StatusAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }

  protected function do_action(){	
  	$trave_order=new Traveorder();
    $id=$_GET['id'];
   	$pay_status=$_GET['pay_status'];
   	$order_status=$_GET['order_status'];
   	$attributes=array();
   	if(!empty($pay_status)){
   		$attributes['pay_status']=$pay_status;
   	}
   	if(!empty($order_status)){
   		$attributes['order_status']=$order_status;
   	}
   	$attributes['operate_time']=Util::current_time('timestamp');
   	$result=$trave_order->update_table_datas($id,$attributes);
   	if($result){
   		if($order_status=='8'){
   		 $trave_order_datas=$trave_order->get_table_datas($id);
   		 $email_total_nums=$trave_order_datas->adult_nums+$trave_order_datas->child_nums;
			 $trave_name=$trave_order_datas->trave->trave_name;  
			 $start_date= $trave_order_datas->start_date;
			 $total_price=$trave_order_datas->total_price;
			 $user_login=$trave_order_datas->user->user_login;
			 
       $send_mail=new SendMail("Cancel Order");
       $user=new User();
       $validate_flag=$user->validate_user_email($trave_order_datas->user->email_validate);
		   if($validate_flag){
		   	
		      $send_mail->send_order_cancel_mail("",$trave_order_datas->user->email,$trave_name,$start_date,$total_price,$user_login,$email_total_nums);
		   }
		  }
		  
		  if($order_status=='6'){
		  	$user=new User();
		    $trave_order_datas=$trave_order->get_table_datas($id);
		    $email_total_nums=$trave_order_datas->adult_nums+$trave_order_datas->child_nums;
		    $send_mail=new SendMail("Formal Order");
        $validate_flag=$user->validate_user_email($trave_order_datas->user->email_validate);
		    if($validate_flag){
		        $send_mail->send_order_formal_mail("",$trave_order_datas->user->email,$trave_order_datas->trave->trave_name,$trave_order_datas->start_date,$trave_order_datas->total_price,$trave_order_datas->user->user_login,$email_total_nums);
		    }
		      
		  }
   		 $this->controller->redirect($this->controller->createUrl("order/index"));
   	}
   	
  }
 
 
    
}
?>
