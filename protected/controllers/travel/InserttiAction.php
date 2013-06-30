<?php
class InserttiAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_ORDER,'',array());
    	$this->controller->init_order_page();
      $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		  $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
    	return true;
    }
  protected function do_action(){
		  $travel_action=$_POST['travel_action'];
		  $trave_id=$_POST['trave_id'];
		  $adult_nums=$_POST['hidden_adult_nums'];
		  $child_nums=$_POST['hidden_child_nums'];
		  $adult_price=$_POST['hidden_adult_price'];
		  $child_price=$_POST['hidden_child_price'];
		  $start_time=$_POST['hidden_start_date'];
		  $total_price=$_POST['hidden_total_price'];
		  $insurance_ids=$_POST['hidden_insurance_ids'];
		  $travel_people_json=$_POST['travel_people_json'];
		  $order_remark=$_POST['order_remark'];
		  $coupon_value=$_POST['coupon_value'];
		  $start_date_id=$_POST['start_date_id'];

			switch($travel_action){
					case '1':
						
					  	$ordercontact=new Ordercontact("OrderContact");
		  				$ordercontact->contact_name=$_POST['real_name'];
		 				  $ordercontact->contact_phone=$_POST['user_phone'];
		  				$ordercontact->contact_email=$_POST['email'];
		  				$ordercontact->contact_address=$_POST['user_address'];
		  				$ordercontact->area_code=$_POST['area_code'];
		  				$ordercontact->user_telephone=$_POST['user_telephone'];
		  				$ordercontact->order_agree=$_POST['order_agree'];
      				$total_nums=$adult_nums+$child_nums;
      				$travel_people=array();
      				$trave=new Trave();
      	 		 $trave_datas=$trave->get_table_datas($trave_id);
      	 		  $this->controller->pt($this->id,array($trave_datas->trave_name.'旅游线路在线预定_核对订单-易途旅游网'));
      				for($ii=1;$ii <= $total_nums;$ii++){
      					$tem_array=array();
      					$tem_array['real_name']=$_POST['real_name_'.$ii];
      					$tem_array['code_type']=$_POST['code_type_'.$ii];
      					$tem_array['user_code']=$_POST['user_code_'.$ii];
      					$tem_array['nation']=$_POST['nation_'.$ii];
      					$tem_array['valid_year']=$_POST['valid_year_'.$ii];
      					$tem_array['valid_month']=$_POST['valid_month_'.$ii];
      					$tem_array['valid_day']=$_POST['valid_day_'.$ii];
      					$tem_array['year']=$_POST['year_'.$ii];
      					$tem_array['month']=$_POST['month_'.$ii];
      					$tem_array['day']=$_POST['day_'.$ii];
      					$tem_array['user_sex']=$_POST['user_sex_'.$ii];
      					$tem_array['user_phone']=$_POST['user_phone_'.$ii];
  
		            $this->controller->set_trave_category($trave_datas->trave_category);
		            
		            if($trave_datas->trave_category=='2'&&empty($insurance_ids)){
		            	if(empty($_POST['real_name_'.$ii])){	
      					  }
      					if(empty($_POST['user_phone_'.$ii])){	
      					}else{
      						if(!Util::is_phone($_POST['user_phone_'.$ii])){
      							$ordercontact->addError("error_user_phone_".$ii,"手机号码格式不正确");
      						}
      				  }
      						if($_POST['code_type_'.$ii]=='1'){
      							if(empty($_POST['user_code_'.$ii])){
      								
      							}else{
      						  if(!Util::validation_filter_id_card($_POST['user_code_'.$ii])){
      								$ordercontact->addError("error_user_code_".$ii,"身份证格式不正确");
      						  }
      						}
      					 }
		            	
		            }else{
		            	if(empty($_POST['real_name_'.$ii])){
      						$ordercontact->addError("error_real_name_".$ii,"姓名不能为空");
      					}
      					if(empty($_POST['user_phone_'.$ii])){
      						$ordercontact->addError("error_user_phone_".$ii,"手机号码不能为空");
      					}else{
      						if(!Util::is_phone($_POST['user_phone_'.$ii])){
      							$ordercontact->addError("error_user_phone_".$ii,"手机号码格式不正确");
      						}
      				  }
      						if($_POST['code_type_'.$ii]=='1'){
      							if(empty($_POST['user_code_'.$ii])){
      								$ordercontact->addError("error_user_code_".$ii,"身份证不能为空");
      							}else{
      						  if(!Util::validation_filter_id_card($_POST['user_code_'.$ii])){
      								$ordercontact->addError("error_user_code_".$ii,"身份证格式不正确");
      						  }
      						}
      					 }
		            }
      					$travel_people[$ii]=$tem_array;
      		 }
        	 $errors=$ordercontact->getErrors();
					 if($ordercontact->validate()&&empty($errors)){
					  $tem_user_data=array();
     		 		$tem_user_data['real_name']=$_POST['real_name'];
      	 		$tem_user_data['user_phone']=$_POST['user_phone'];
      	 		$tem_user_data['email']=$_POST['email'];
      	 		$tem_user_data['user_address']=$_POST['user_address'];
     		 		$tem_user_data['area_code']=$_POST['area_code'];
      	 		$tem_user_data['user_telephone']=$_POST['user_telephone'];
      	 		$travel_people[0]=$tem_user_data;
      	 		$travel_people_json=json_encode($travel_people);
		     		//设置Token防止重复刷新
		    		$token_key=$this->controller->get_token("insertorder");
		    		$user=new User();
		        $user_id=Yii::app()->user->id;
		        $user_datas=$user->get_table_datas($user_id);
		        $total_coupon_value=$this->get_coupon_value($trave_id,$adult_nums);
				    $this->display('travel_check',array('trave_datas'=>$trave_datas,'trave_id'=>$trave_id,'start_time'=>$start_time,'total_price'=>$total_price,'insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'adult_price'=>$adult_price,'child_price'=>$child_price,'token_key'=>$token_key,'travel_people'=>$travel_people,'travel_people_json'=>$travel_people_json,'user_datas'=>$user_datas,'total_coupon_value'=>$total_coupon_value,'start_date_id'=>$start_date_id));
				   }else{
				      $this->display('travel_info',array('model'=>$ordercontact,'trave_id'=>$trave_id,'start_time'=>$start_time,'total_price'=>$total_price,'insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'adult_price'=>$adult_price,'child_price'=>$child_price,'travel_people'=>$travel_people,'errors'=>$errors,'start_date_id'=>$start_date_id));
			     }
					   break;
					case '2':
						$this->controller->pt($this->id,array('订单','签约付款'));
              $trave=new Trave();
      	 		  $trave_datas=$trave->get_table_datas($trave_id);
      	 		  $this->controller->pt($this->id,array($trave_datas->trave_name.'旅游线路在线预定_签约付款-易途旅游网'));
      	 		  $user_id=Yii::app()->user->id;
					    $user=new User();
		          $user_datas=$user->get_table_datas($user_id);

      	 		  $this->controller->check_order_error($total_price,$trave_id,$start_date_id,$start_time,$adult_nums,$child_nums,$insurance_ids);
					   if(!empty($coupon_value)){
					    	$total_coupon_value=$this->get_coupon_value($trave_id,$adult_nums);
		            $user_coupon=$user_datas->coupon;
		            if($coupon_value > $total_coupon_value){
		            	  $this->controller->f(CV::FAILED_TOTAL_COUPON);
      	 		        $token_key=$this->controller->get_token("insertorder");
      	 		        $travel_people=json_decode($travel_people_json,true);
		            	  $this->display('travel_check',array('trave_datas'=>$trave_datas,'trave_id'=>$trave_id,'start_time'=>$start_time,'total_price'=>$total_price,'insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'adult_price'=>$adult_price,'child_price'=>$child_price,'token_key'=>$token_key,'travel_people'=>$travel_people,'travel_people_json'=>$travel_people_json,'user_datas'=>$user_datas,'total_coupon_value'=>$total_coupon_value,'start_date_id'=>$start_date_id,'order_remark'=>$order_remark));
		            	  exit();
		            }else{
		            	if($coupon_value > $user_coupon){
		            	   $this->controller->f(CV::FAILED_USER_COUPON);
      	 		         $token_key=$this->controller->get_token("insertorder");
      	 		         $travel_people=json_decode($travel_people_json,true);
		            	   $this->display('travel_check',array('trave_datas'=>$trave_datas,'trave_id'=>$trave_id,'start_time'=>$start_time,'total_price'=>$total_price,'insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'adult_price'=>$adult_price,'child_price'=>$child_price,'token_key'=>$token_key,'travel_people'=>$travel_people,'travel_people_json'=>$travel_people_json,'user_datas'=>$user_datas,'total_coupon_value'=>$total_coupon_value,'start_date_id'=>$start_date_id,'order_remark'=>$order_remark));
		            	   exit();
		              }else{
		              	if($coupon_value > $total_price){
		              	  $this->controller->f(CV::FAILED_ZERO_COUPON);
      	 		          $token_key=$this->controller->get_token("insertorder");
      	 		          $travel_people=json_decode($travel_people_json,true);
		            	    $this->display('travel_check',array('trave_datas'=>$trave_datas,'trave_id'=>$trave_id,'start_time'=>$start_time,'total_price'=>$total_price,'insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums,'adult_price'=>$adult_price,'child_price'=>$child_price,'token_key'=>$token_key,'travel_people'=>$travel_people,'travel_people_json'=>$travel_people_json,'user_datas'=>$user_datas,'total_coupon_value'=>$total_coupon_value,'start_date_id'=>$start_date_id,'order_remark'=>$order_remark));
		            	    exit();
		                }else{
		                	$coupon_consume=new CouponConsume();
		                	$coupon_desc="用户预订线路:".$trave_datas->trave_name."使用抵用劵";
   		                $result=$coupon_consume->insert_coupon_consume_datas($user_id,'2',$coupon_value,$coupon_desc,'3');
		                }
		            }
		         }
		       }
		          $total_price=$total_price-intval($coupon_value);
		  				$trave_order=new Traveorder();
		 					$trave_order->trave_id=$trave_id;
		 					$trave_order->start_date_id=$start_date_id;
		  				$trave_order->adult_nums=$adult_nums;
		  				$trave_order->adult_price=$adult_price;
		  				$trave_order->child_nums=$child_nums;
		  				$trave_order->child_price=$child_price;
		  				$trave_order->start_date=$start_time;
		  				$trave_order->total_price=$total_price;
		  				$trave_order->coupon_value=$coupon_value;
		  				$trave_order->insurance_ids=$insurance_ids;
		  				$trave_order->pay_status='1';
		  				$trave_order->order_status='1';
              $trave_order->order_style='1';
              $trave_order->order_source='1';
              $trave_order->order_level='3';
              $trave_order->suppliers_settle='1';
		  				$trave_order->order_remark=$order_remark;
		  				//设置Token防止重复刷新
		  				$isToken=$this->controller->is_token($_POST['token_key'],"insertorder",true);
		 				  if($isToken&&$trave_order->insert_traveorder()){
		 				  	$trave_attributes['trave_numbers']=$trave_datas->trave_numbers+1;
		 				  	$trave->update_table_datas($trave_id,$trave_attributes);

		 				  	$credit=new Credit();
						    $user_id=Yii::app()->user->id;
			          $credit_desc="会员在线预定线路:".$trave_datas->trave_name.",赠送积分";
                $credit->set_credit_vars($user_id,"make_an_order",'1',$credit_desc);
                
                
                $email_total_nums=$adult_nums+$child_nums;
                $send_mail=new SendMail("Make Order");
                 $validate_flag=$user_datas->validate_user_email();
		             if($validate_flag){
		                  $send_mail->send_order_success_mail("",$user_datas->email,$trave_datas->trave_name,$start_time,$total_price,$user_datas->user_login,$email_total_nums);
		             }
		      
		             
                
		 				  	//插入联系人的信息资料
		  	 				 $order_contact_datas=json_decode($travel_people_json,true);
		  	 				 $order_id=$trave_order->id;
		  	  			 foreach((array)$order_contact_datas as $key => $value){
		  	  					$order_contact=new Ordercontact();
		  	  					if($key==0){
      	      				 $order_contact->trave_order_id=$order_id;
      	       				 $order_contact->trave_id=$trave_id;
      	      				 $order_contact->contact_name=$value['real_name'];
      	      				 $order_contact->contact_phone=$value['user_phone'];
      	      				 $order_contact->contact_email=$value['email'];
      	      				 $order_contact->contact_telephone=empty($value['area_code'])?"":($value['area_code']."-").$value['user_telephone'];
      	       				 $order_contact->main_contact='1';
      	       				 $order_contact->contact_address=$value['user_address'];
      	       				 $order_contact->save();
		  	  					}else{
      	       					$order_contact->trave_order_id=$order_id;
      	       					$order_contact->trave_id=$trave_id;
      	       					$order_contact->contact_name=$value['real_name'];
      	      					$order_contact->contact_code_type=$value['code_type'];
                        $order_contact->contact_code=$value['user_code'];
                        $order_contact->nation=$value['nation'];
                        $order_contact->valid_date=$value['valid_year']."-".$value['valid_month']."-".$value['valid_day'];
      	       	 				$order_contact->contact_birthday=$value['year']."-".$value['month']."-".$value['day'];
      	      				 	$order_contact->contact_sex=$value['user_sex'];
      	       				 	$order_contact->contact_phone=$value['user_phone'];
      	      				 	$order_contact->save();
		  	  					}
		  	 				 }
		  	 				 $this->display('travel_pay',array('trave_datas'=>$trave_datas,'trave_id'=>$trave_id,'order_id'=>$order_id,'total_price'=>$total_price));
		 					 }else{
		 					  $this->controller->redirect($this->controller->createUrl('error/errorrefresh',array()));	
		 					 }
					   break;
					default:
					   break;
				}
  }
  function get_coupon_value($trave_id,$total_nums){
  	$user_id=Yii::app()->user->id;
  	$trave=new Trave();
  	$system=new System();
  	$user=new User();
  	$user_datas=$user->get_table_datas($user_id);
  	$user_level=$user_datas->level;
  	$user_level_coupon=0;
  	if($user_level=='3'){
  		$user_level_coupon=$system->get_system_value("golden_coupon");
  	}
  	if($user_level=='4'){
  		$user_level_coupon=$system->get_system_value("diamond_coupon");
  	}
  	$trave_datas=$trave->get_table_datas($trave_id);
  	$trave_coupon=$trave_datas->coupon;
  	$total_coupon=intval($trave_coupon)*$total_nums+$user_level_coupon;
  	return $total_coupon;

  }
 
 
    
}
?>
