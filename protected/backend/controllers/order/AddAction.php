<?php
class AddAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }

  protected function do_action(){	
  	$start_date_select=$_REQUEST['start_date_select'];
  	$start_date_id=$_REQUEST['start_date_id'];
  	$start_date=$_REQUEST['start_date'];
    $model=new Traveorder();
		if(isset($_POST['Traveorder'])){
			$user_error=array();
			$this->controller->bc(array("订单管理"=>array('order/index'),'增加订单'));
			if(!empty($_POST['Traveorder']['id'])){
				$model=$model->get_table_datas($_POST['Traveorder']['id']);
				$old_start_date=$model->start_date;
			}else{
				 $model->pay_status='1';
			}
			 $model->attributes=$_POST['Traveorder'];
			 if(empty($start_date_select)){
			 	 $model->start_date_id=$start_date_id;
			 	 $model->start_date=$start_date;
			 }
			 $model->id=$_POST['Traveorder']['id'];
			 if(!empty($_POST['insurance_check']))
			    $model->insurance_ids=implode(",",$_POST['insurance_check']);
			 $model->room_nums=$_POST['room_nums'];
			 $model->trave_route_number=$_POST['trave_route_number'];
			 $model->room_id=$_POST['check_hotel'];
			 $model->operate_id=Yii::app()->user->id;
			 $model->operate_time=Util::current_time('timestamp');
			 $model->suppliers_settle='1';
		   $contact_id=$_POST['contact_id'];
		   $contact_name=$_POST['contact_name'];
		   $contact_phone=$_POST['contact_phone'];
		   $contact_email=$_POST['contact_email'];
		   $area_code=$_POST['area_code'];
		   $user_telephone=$_POST['user_telephone'];
		   $contact_address=$_POST['contact_address'];
		   $people=$_POST['People'];
      if($model->validate()){
      	$insert_user_flag=true;
      	if(empty($_POST['Traveorder']['id'])){
      		if(empty($_POST['Traveorder']['create_id'])){
				    $user_id=$this->insert_user($user_error);
				    if($user_id){
				    	$model->create_id=$user_id;
				    	$coupon_value=$_POST['Traveorder']['coupon_value'];
				    	$coupon_consume=new CouponConsume();
              $conpon_desc="管理员增加订单使用优惠券";
              $coupon_consume->insert_coupon_consume_datas($user_id,'2',$coupon_value,$conpon_desc);
				    }else{
				    	$insert_user_flag=false;
				    	$this->controller->f(CV::FAILED_ADMIN_OPERATE_USER_EMAIL);
				    }
				  }else{
				  	$user_id=$_POST['Traveorder']['create_id'];
				  	$coupon_value=$_POST['Traveorder']['coupon_value'];
				    $coupon_consume=new CouponConsume();
            $conpon_desc="管理员增加订单使用优惠券";
            $coupon_consume->insert_coupon_consume_datas($user_id,'2',$coupon_value,$conpon_desc);
				  }
			  }
			  if($insert_user_flag){
			  	$result=$model->insert_traveorder();
			  	//发送预定成功的邮件
          if(empty($_POST['Traveorder']['id'])){
			  	  $email_total_nums=$model->adult_nums+$model->child_nums;
			  	  $trave_name=$model->trave->trave_name;
			  	  $send_mail=new SendMail();
			  	  $send_mail->set_id("Make Order");
            if(!empty($_POST['Traveorder']['create_id'])){
            	
            	$user=new User();
            	$validate_flag=$user->validate_user_email($model->user->email_validate);
		          if($validate_flag){
		          	$send_mail->send_order_success_mail("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums);
		          }
            }else{
            	$send_mail->send_order_success_mail("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums);
            }
            
            if($model->order_status=='6'){
            	if(!empty($_POST['Traveorder']['create_id'])){
            		  $send_mail->set_id("Formal Order");
            	    $user=new User();
            	    $validate_flag=$user->validate_user_email($model->user->email_validate);
		              if($validate_flag){
		          	     $send_mail->send_order_formal_mail("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums);
		              }
            	}else{
            		    $send_mail->send_order_formal_mail("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums);
            	}
            }
		      }else{
		      	$user=new User();
		      	$email_total_nums=$model->adult_nums+$model->child_nums;
			  	  $trave_name=$model->trave->trave_name;
			  	  $send_mail=new SendMail();
		      	if(empty($start_date_select)){
               $send_mail->set_id("Modify Start Date");
               $validate_flag=$user->validate_user_email($model->user->email_validate);
		           if($validate_flag){
		              $send_mail->send_modify_start_date("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums,$old_start_date);
		           }
		      	}
		      	if($model->order_status=='8'){
		      		 $send_mail->set_id("Cancel Order");
               $validate_flag=$user->validate_user_email($model->user->email_validate);
		           if($validate_flag){
		             $send_mail->send_order_cancel_mail("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums);
		           }
		      	}
		      	if(($model->order_status=='6')){
		      		 $send_mail->set_id("Formal Order");
               $validate_flag=$user->validate_user_email($model->user->email_validate);
		           if($validate_flag){
		             $send_mail->send_order_formal_mail("",$model->user->email,$trave_name,$model->start_date,$model->total_price,$model->user->user_login,$email_total_nums);
		           }
		      	}
		      }
			  }else{
			  	$result=false;
			  }
			  if($result){
			    if($_POST['pay_status']=="2"){
			  		$order_pay=new Orderpay();
          	$order_pay->notify_id="";
          	$order_pay->order_id=$model->id;
          	$order_pay->total_fee=$_POST[Traveorder][total_price];
          	$order_pay->trade_type=$_POST[Traveorder][pay_style];
          	$order_pay->receive_name=$contact_name;
          	$order_pay->receive_zip="";
          	$order_pay->receive_address=$contact_address;
          	$order_pay->receive_phone=empty($area_code)?$user_telephone:($area_code."-".$user_telephone);
          	$order_pay->receive_mobile=$contact_phone;
          	$order_result=$order_pay->insert_orderpay();
       	 }
			  	$ordercontact=new Ordercontact();
			  	if(!empty($contact_id)){
			  		$ordercontact=$ordercontact->get_table_datas($contact_id);
			  	}
			  	$ordercontact->id=$contact_id;
			  	$ordercontact->trave_order_id=empty($_POST['Traveorder']['id'])?$model->id:$_POST['Traveorder']['id'];
			  	$ordercontact->trave_id=$_POST['Traveorder']['trave_id'];
			  	$ordercontact->contact_name=$contact_name;
			  	$ordercontact->contact_phone=$contact_phone;
			  	$ordercontact->contact_email=$contact_email;
			  	$ordercontact->contact_telephone=empty($area_code)?$user_telephone:($area_code."-".$user_telephone);
			  	$ordercontact->contact_address=$contact_address;
			  	$ordercontact->main_contact='1';
			  	$ordercontact->insert_ordercontact();
			    foreach((array)$people as $key => $value){
			    	$ordercontact=new Ordercontact();
			    	if(!empty($value['id'])){
			    		$ordercontact=$ordercontact->get_table_datas($value['id']);
			    	}
			  	  $ordercontact->id=$value['id'];
			  	  $ordercontact->trave_order_id=empty($_POST['Traveorder']['id'])?$model->id:$_POST['Traveorder']['id'];
			  	  $ordercontact->trave_id=$_POST['Traveorder']['trave_id'];
			  	  $ordercontact->contact_name=$value['contact_name'];
			  	  $ordercontact->contact_phone=$value['contact_phone'];
			  	  $ordercontact->contact_code_type=$value['contact_code_type'];
			  	  $ordercontact->contact_code=$value['contact_code'];
			  	  $ordercontact->contact_sex=$value['contact_sex'];
			  	  $ordercontact->contact_birthday=$value['year']."-".$value['month']."-".$value['day'];
			  	  $ordercontact->nation=$value['nation'];
			  	  $ordercontact->valid_date=$value['valid_year']."-".$value['valid_month']."-".$value['valid_day'];
			  	  $ordercontact->insert_ordercontact();
			    }
			    $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }
			  
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		 }else{
		 	 $order_id=$_GET['id'];
		 	 if(!empty($order_id)){
		 	 	  $this->controller->bc(array("订单管理"=>array('order/index'),'修改订单'));
		 	    $model=$model->get_table_datas($order_id,array());
		 	 }else{
		 	 	$this->controller->bc(array("订单管理"=>array('order/index'),'增加订单'));
		 	 }
		 }
	   $this->display('add',array('model'=> $model,'user_error'=>$user_error));
  }
  
 
  protected function insert_user(&$user_error){
  	   require_once('config.inc.php');
  	   require_once('uc_client/client.php');
  	   $user=new User('OrderRegister');
  	   $contact_name=$_POST['contact_name'];
		   $contact_phone=$_POST['contact_phone'];
		   $contact_email=$_POST['contact_email'];
		   $area_code=$_POST['area_code'];
		   $user_telephone=$_POST['user_telephone'];
		   $contact_address=$_POST['contact_address'];
		   if(empty($contact_email)){
		   	$user_error['email']="email不能为空";
		   }else{
		     	$user_datas=$user->get_table_datas("",array('email'=>$contact_email));
		     	if(!empty($user_datas)){
		     		return $user_datas[0]['id'];
		     	}
		  }
		   $user_login=$contact_phone;
		   $user->password="yeetu2011";
			 //保存未修改的password用户发邮件
			 $user->con_password=$user->password; 
		   $user->real_name=$contact_name;
		   $user->user_phone=$contact_phone;
		   $user->user_login=$user_login;
		   $user->email=$contact_email;
		   $user->user_telephone=empty($area_code)?$user_telephone:($area_code."-".$user_telephone);
		   $user->user_address=$contact_address;
		   $user->user_active='2';
			 $user->status='1';
			 $user->level='1';
			 $user->email_validate='2';
			 
		   $uid = uc_user_register($user_login,$user->password,$contact_email);
		  if($uid <= 0) {
			 if($uid == -1) {
			 	          $user_error['user_login']="用户名不合法";
			          	
			  } elseif($uid == -2) {
			  	        $user_error['user_login']="包含要允许注册的词语";
			          	
			  } elseif($uid == -3) {
			  	        $user_error['user_login']="用户名已经存在";
			          	
			  } elseif($uid == -4) {
			  	        $user_error['email']="Email格式有误";
			          	
			  } elseif($uid == -5) {
			  	        $user_error['email']="Email不允许注册";
			          	
			  } elseif($uid == -6) {
			  	        $user_error['email']="该 Email已经被注册";
			          	
			  } 
		  }
		  
	   
		 if($user->validate()&&empty($user_error)){
		   $result=$user->insert_user();
		   if($result){
		   	  $credit=new Credit();
			    $credit_desc="会员:".$user->user_login.",管理员增加订单注册用户赠送积分";
          $credit->set_credit_vars($user->id,"register",'1',$credit_desc);
			  	$coupon_consume=new CouponConsume();
          $system=new System();
			    $coupon_value=$system->get_system_value("register_coupon");
          $conpon_desc="会员:".$user->user_login.",管理员增加订单注册用户赠送优惠券";
          $coupon_consume->insert_coupon_consume_datas($user->id,'1',$coupon_value,$conpon_desc);   
          $send_mail=new SendMail("Admin Registe");
			  	$result=$send_mail->send_order_register_mail("",$user->email,$user->user_login,$user->con_password);
		   	  return $user->id;
		   }else{
		   	  $user_error['operate']="数据库操作错误";
		   }
		 }else{
		 	  $getError=$user->getErrors();
		 	  $user_error=array_merge($user_error,$getError);
		 }
  }

 
    
}
?>
