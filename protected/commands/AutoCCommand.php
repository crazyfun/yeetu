<?php
class AutoCCommand extends CConsoleCommand
{

	public function run($args){
    $trave_order=new Traveorder();
		$trave_order_datas=$trave_order->findAll(array('select'=>'id,trave_id,adult_nums,start_date,child_nums,total_price,order_status,create_id,create_time,operate_time','condition'=>" pay_status='1' AND (order_status='1' OR order_status='2' OR order_status='3' OR order_status='4' OR order_status='5') AND UNIX_TIMESTAMP(start_date)<=UNIX_TIMESTAMP(NOW())",'params'=>array()));
		$user=new User();
		foreach($trave_order_datas as $key => $value){
			     $sql="UPDATE {{traveorder}} SET order_status='8',operate_time=NOW() WHERE id='$value->id'";
           $command = Yii::app()->db->createCommand($sql);
           $command->execute();
			     $total_nums=intval($value->adult_nums)+intval($value->child_nums);
			     $send_mail=new SendMail("Out of Date Order");
			     $validate_flag=$user->validate_user_email($value->user->email_validate);
		       if($validate_flag){
			       $send_mail->send_outofdate_order_mail("",$value->user->email,$value->trave->trave_name,$value->start_date,$value->total_price,$value->user->user_login,$total_nums);
			     }
		}
   }


/*
   public function actionOrder(){
   	 $trave_order=new Traveorder();
		$trave_order_datas=$trave_order->findAll(array('select'=>'id,trave_id,adult_nums,start_date,child_nums,total_price,order_status,create_id,create_time,operate_time','condition'=>" pay_status='1' AND (order_status='1' OR order_status='2' OR order_status='3' OR order_status='4' OR order_status='5') AND UNIX_TIMESTAMP(start_date)<=UNIX_TIMESTAMP(NOW())",'params'=>array()));
		$user=new User();
		foreach($trave_order_datas as $key => $value){
			     $sql="UPDATE {{traveorder}} SET order_status='8',operate_time=NOW() WHERE id='$value->id'";
           $command = Yii::app()->db->createCommand($sql);
           $command->execute();
			     $total_nums=intval($value->adult_nums)+intval($value->child_nums);
			     $send_mail=new SendMail("Out of Date Order");
			     $validate_flag=$user->validate_user_email($value->user->email_validate);
		       if($validate_flag){
			       $send_mail->send_outofdate_order_mail("",$value->user->email,$value->trave->trave_name,$value->start_date,$value->total_price,$value->user->user_login,$total_nums);
			     }
		}
   }
   
   */
   

}
