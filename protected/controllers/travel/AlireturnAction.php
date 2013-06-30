<?php
class AlireturnAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_order_page();
    	return true;
    	
    }
  protected function do_action(){
   	$params = Yii::app()->getParams();
		$alipay=new Alipay();
		$verify_result = $alipay->return_verify($params->partner);
		//$verify_result=true;
		if($verify_result) {   //认证合格
			//获取支付宝的反馈参数
			$trade_no  = $_GET['trade_no'];
			$dingdan   = $_GET['out_trade_no'];   //获取支付宝传递过来的订单号
			$total     = $_GET['total_fee'];      //获取支付宝传递过来的总价格
			$receive_name    =$_GET['receive_name'];    //获取收货人姓名
			$receive_address =$_GET['receive_address']; //获取收货人地址
			$receive_zip     =$_GET['receive_zip'];     //获取收货人邮编
			$receive_phone   =$_GET['receive_phone'];   //获取收货人电话
			$receive_mobile  =$_GET['receive_mobile'];  //获取收货人手机
			
		  $explode_dingdan=explode('-',$dingdan);
		  $count_dingdan=count($explode_dingdan);
		  if($count_dingdan>=2){
		  	$dingdan=$explode_dingdan[0];
		  	$order_separate_id=$explode_dingdan[1];
		  	$order_separate=new OrderSeparate();
		  	$order_separate_datas=$order_separate->get_table_datas($order_separate_id);
		  	$order_separate_status=$order_separate_datas->status;
		  }else{
		  	$order_separate_status=false;
		  }
		  
			$trave_order=new Traveorder();
			$trave_order_datas=$trave_order->get_table_datas($dingdan);
			$order_user_id=$trave_order_datas->create_id;

			$order_serial=new OrderSerial();
      $serial_value=$order_serial->get_serial_value($dingdan);
      $order_total_price=$serial_value['total_price'];
      
			if(Yii::app()->user->id == $order_user_id&&!$order_separate_status&&$order_total_price==$total&&(($trave_order_datas->pay_status=='1')||($trave_order_datas->pay_status=='3'))){
				$t = Yii::app()->db->beginTransaction();
				try{
          $order_pay=new Orderpay();
          $order_pay->notify_id=$trade_no;
          $order_pay->order_id=$dingdan;
          $order_pay->total_fee=$total;
          $order_pay->trade_type='2';
          $order_pay->receive_name=$receive_name;
          $order_pay->receive_zip=$receive_zip;
          $order_pay->receive_address=$receive_address;
          $order_pay->receive_phone=$receive_phone;
          $order_pay->receive_mobile=$receive_mobile;
          $result=$order_pay->insert_orderpay();
          if($result){
          	$separate_id=$serial_value['separate_id'];
          	if(!empty($separate_id)){
          		  $order_separate=new OrderSeparate();
          		  $order_separate->update_table_datas($separate_id,array('status'=>'1'),array());
          		
          	}
          	//发送支付成功邮件
          	$trave_id=$trave_order_datas->trave_id;
          	$trave=new Trave();
          	$user=new User();
          	$trave_datas=$trave->get_table_datas($trave_id);
          	$trave_name=$trave_datas->trave_name;
          	$user_datas=$user->get_table_datas($order_user_id);
          	$user_email=$user_datas->email;
          	$start_date=$trave_order_datas->start_date;
          	
          	if(!empty($user_datas->user_phone)){
		               $send_mail=new SendMail("Pay Phone");
		               $send_mail->send_pay_phone("",$user_datas->user_phone,$user_datas->user_login,$trave_name,$trave_order_datas->start_date,$total);
		        }
		        
		        
          	$people_nums=intval($trave_order_datas->adult_nums)+intval($trave_order_datas->child_nums);
          	$credit=new Credit();
			      $credit_desc="会员成功付款线路:".$trave_name.",赠送积分";
            $credit->insert_credit_consume_datas($order_user_id,'1',$total,$credit_desc);
                
            $send_mail=new SendMail("Pay Email");
            $validate_flag=$user_datas->validate_user_email();
		        if($validate_flag){
		          $send_mail->send_pay_success_mail("",$user_email,$trave_name,$start_date,$order_total_price,$people_nums,$user_datas->user_login);
		        }
		        
            
          }
					$t->commit();	
				}catch(Exception $e){
					$t->rollback();
				}
				$operate_result_content="你的易途订单号为:".$dingdan.",支付总价钱:".$total."元,成功支付.查看我的<a href='".$this->controller->createUrl('user/order')."'>订单</a>";
				$this->controller->sf($operate_result_content);
				$this->display('travel_pay_success',array());
			}else{

				$this->controller->f(CV::ERROR_PAY);
				$this->display('travel_pay_success',array());
			}
		}else{
			  $this->controller->f(CV::ERROR_PAYCODE);
				$this->display('travel_pay_success',array());
		}
  }
 
 
    
}
?>
