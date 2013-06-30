<?php
class YeereturnAction extends BaseAction{
  
    protected function beforeAction(){
      $this->controller->init_order_page();
    	return true;
    }
  protected function do_action(){
   	
	  $config = Yii::app()->getParams();
		$yee = new Yeepay($config->merID, $config->merchantKey);
		$yee->getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
		$bRet = $yee->CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
		
		  $explode_dingdan=explode('-',$r6_Order);
		  $count_dingdan=count($explode_dingdan);
		  if($count_dingdan>=2){
		  	$r6_Order=$explode_dingdan[0];
		  }
		  
		  
    $trave_order=new Traveorder();
	  $trave_order_datas=$trave_order->get_table_datas($r6_Order);
		$order_user_id=$trave_order_datas->create_id;

		$order_serial=new OrderSerial();
    $serial_value=$order_serial->get_serial_value($r6_Order);
    $order_total_price=$serial_value['total_price'];  
		if(Yii::app()->user->id == $order_user_id&&$order_total_price==$r3_Amt&&(($trave_order_datas->pay_status=='1')||($trave_order_datas->pay_status=='3'))){
				$t = Yii::app()->db->beginTransaction();
				try{
         $order_pay=new Orderpay();
          $order_pay->notify_id=$r2_TrxId;
          $order_pay->order_id=$r6_Order;
          $order_pay->total_fee=$r3_Amt;
          $order_pay->trade_type='3';
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
          	
          	$credit=new Credit();
						$user_id=Yii::app()->user->id;
			      $credit_desc="会员成功付款线路:".$trave_name.",赠送积分";
            $credit->insert_credit_consume_datas($user_id,'1',$r3_Amt,$credit_desc);
            
            
            $send_mail=new SendMail("Pay Email");
            $send_mail->send_pay_success_mail("",$user_email,$trave_name,$start_date,$order_total_price);
          }
					$t->commit();
				}catch(Exception $e){
					$t->rollback();
				}
				$operate_result_content="你的易途订单号为:".$r6_Order.",支付总价钱:".$r3_Amt."元,成功支付.";
				$this->controller->sf($operate_result_content);
				$this->display('travel_pay_success',array());
			}else{  
				$this->controller->f(CV::CV::ERROR_PAY);
				$this->display('travel_pay_success',array());
			}
  }
 
 
    
}
?>
