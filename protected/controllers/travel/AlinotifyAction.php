<?php
class AlinotifyAction extends  BaseAction{
  
    protected function beforeAction(){
    	Util::reset_vars();
    	return true;
    }
   
  protected function do_action(){

		$config = Yii::app()->getParams();
		$alipay=new Alipay();
		//$verify_result = $alipay->notify_verify($config->partner,$config->security_code);
		//if($verify_result){
		$dingdan   = $_REQUEST['out_trade_no'];         //获取支付宝传递过来的订单号
		$trade_no  = $_REQUEST['trade_no'];
		$total     = $_REQUEST['total_fee'];            //获取支付宝传递过来的总价格
		$receive_name    =$_REQUEST['receive_name'];    //获取收货人姓名
		$receive_address =$_REQUEST['receive_address']; //获取收货人地址
		$receive_zip     =$_REQUEST['receive_zip'];     //获取收货人邮编
		$receive_phone   =$_REQUEST['receive_phone'];   //获取收货人电话
		$receive_mobile  =$_REQUEST['receive_mobile'];  //获取收货人手机
		 /*
		 获取支付宝反馈过来的状态,根据不同的状态来更新数据库
		 WAIT_BUYER_PAY(表示等待买家付款);
		 WAIT_SELLER_SEND_GOODS(表示买家付款成功,等待卖家发货);
		 WAIT_BUYER_CONFIRM_GOODS(表示卖家已经发货等待买家确认);
		 TRADE_FINISHED(表示交易已经成功结束);
		 */

		if($_REQUEST['trade_status'] == 'WAIT_BUYER_PAY') {                   //等待买家付款
			echo "success";
		}
		else if($_REQUEST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {      //买家付款成功,等待卖家发货
			echo "success";
		}
		else if($_REQUEST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {    //卖家已经发货等待买家确认
			echo "success";
		}
		else if($_REQUEST['trade_status'] == 'TRADE_SUCCESS') {              //交易成功结束
			
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
		  
		  

			//这里放入你自定义代码,比如根据不同的trade_status进行不同操作
			$trave_order=new Traveorder();
			$trave_order_datas=$trave_order->get_table_datas($dingdan);
			$order_user_id=$trave_order_datas->create_id;
			
			$order_serial=new OrderSerial();
      $serial_value=$order_serial->get_serial_value($dingdan);
      $order_total_price=$serial_value['total_price'];
      
			if(!$order_separate_status&&$order_total_price==$total&&(($trave_order_datas->pay_status=='1')||($trave_order_datas->pay_status=='3'))){
				
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
			}
		  echo "success";
		}else{
   
		  	echo "fail";
		}
	//}else{
	 	// echo "fail";
	 //}
  }
 
 
    
}
?>
