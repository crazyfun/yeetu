<?php
class CancelorderAction extends  BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_page();
    	return true;
    }
  
  protected function do_action(){
    $order_id=$_GET['id'];
		$order_status=$_REQUEST['order_status'];
		$trave_order=new Traveorder();
		$update_datas['order_status']='8';
		$update_result=$trave_order->update_table_datas($order_id,$update_datas,array());
		if($update_result){
			 $trave_order_datas=$trave_order->get_table_datas($order_id);
   		 $email_total_nums=$trave_order_datas->adult_nums+$trave_order_datas->child_nums;
			 $trave_name=$trave_order_datas->trave->trave_name;  
			 $start_date= $trave_order_datas->start_date;
			 $total_price=$trave_order_datas->total_price;
			 $user_login=$trave_order_datas->user->user_login;
       $send_mail=new SendMail("Cancel By Own");
       $user=new User();
       $validate_flag=$user->validate_user_email($trave_order_datas->user->email_validate);
		   if($validate_flag){
		      $send_mail->send_order_cancel_by_own_mail("",$trave_order_datas->user->email,$trave_name,$start_date,$total_price,$user_login,$email_total_nums);
		   }
			$this->controller->redirect($this->controller->createUrl("user/order",array('order_status'=>$order_status)));
		}
  }
 
 
    
}
?>
