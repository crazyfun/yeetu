<?php
class TravelController extends Controller
{
	//线路类型
	public $trave_category="";
	//出发城市的名字
	public $trave_sregion_name="";
	
	//出发城市的英文名字
	public $trave_sregion_en_name="";
	//出发城市的ID号
	public $trave_sregion="";
	
	
 public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			//'SynchronousFilter',
			'SregionFilter + domestic,peripheral,nation,group,free,bargain,detail,travelmore,travelorder,travelinfo,insertti,userorder,travelpay,alireturn,alinotify,yeereturn,travelforder,travelfinfo,insertfti,travelpreview',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		);
	}
	
	
	public function actions()
	{
		return array(
		  'domestic' => 'application.controllers.travel.DomesticAction',
		  'peripheral'=>'application.controllers.travel.PeripheralAction',
		  'nation'=>'application.controllers.travel.NationAction',
		  'group'=>'application.controllers.travel.GroupAction',
		  'free'=>'application.controllers.travel.FreeAction',
		  'bargain'=>'application.controllers.travel.BargainAction',
		  'travelmore'=>'application.controllers.travel.TravelmoreAction',
		  'detail'=>'application.controllers.travel.DetailAction',
		  'travelpreview'=>'application.controllers.travel.TravelPreviewAction',
		  'travelorder'=>'application.controllers.travel.TravelorderAction',
		  'travelinfo'=>'application.controllers.travel.TravelinfoAction',
		  'insertti'=>'application.controllers.travel.InserttiAction',
		  'userorder'=>'application.controllers.travel.UserorderAction',
		  'travelpay'=>'application.controllers.travel.TravelpayAction',
		  'alireturn'=>'application.controllers.travel.AlireturnAction',
		  'alinotify'=>'application.controllers.travel.AlinotifyAction',
		  'yeereturn'=>'application.controllers.travel.YeereturnAction',
		  'travesdate'=>'application.controllers.travel.TravesdateAction',
		  'travelcomments'=>'application.controllers.travel.TravelcommentsAction',
		  'commentdatas'=>'application.controllers.travel.CommentdatasAction',
		  'consultingdatas'=>'application.controllers.travel.ConsultingdatasAction',
		  'imagecode'=>'application.controllers.travel.ImagecodeAction',
		  'consultimagecode'=>'application.controllers.travel.ConsultimagecodeAction',
		  'consulting'=>'application.controllers.travel.ConsultingAction',
		  'traveflight'=>'application.controllers.travel.TraveflightAction',
		  'travehotels'=>'application.controllers.travel.TravehotelsAction',
		  'travelforder'=>'application.controllers.travel.TravelforderAction',
		  'travelfinfo'=>'application.controllers.travel.TravelfinfoAction',
		  'insertfti'=>'application.controllers.travel.InsertftiAction',
		);
	}
	
public function FilterSynchronousFilter($filterChain){
    require_once('config.inc.php');
  	require_once('uc_client/client.php');
  	$user_id=Yii::app()->user->id;
  	if(!empty($user_id)){
  	 $user_datas=User::model()->find(array('select'=>'user_login,credit','condition'=>'id=:user_id','params'=>array(':user_id'=>$user_id)));
  	 $user_login=$user_datas->user_login;
  	 $user_credit=$user_datas->credit;
  	 list($dz_uid,$dz_user_login,$dz_user_email) = uc_get_user($user_login);
		 $dz_credit=uc_user_getcredit(1,$dz_uid,1);
		 if($user_credit!=$dz_credit){
			 $update_credit_datas['credit']=$dz_credit;
			 $credit_result=User::model()->update_table_datas($user_id,$update_credit_datas,array());
		 }
		}
		$filterChain->run();
	}
	public function FilterSregionFilter($filterChain) {
    Util::get_sregion();
    $sregion_session=Yii::app()->session->get('sregion_datas');
		$trave_id=$_REQUEST['id'];
		if(!empty($trave_id)){
		 $trave=new Trave();
		 $trave_datas=$trave->find(array('select'=>'trave_sregion','condition'=>'id=:trave_id ','params'=>array(':trave_id'=>$trave_id)));
		 $t_trave_sregion=$trave_datas->trave_sregion;
		 if(intval($t_trave_sregion)!=intval($sregion_session['id'])){
			 $district=new District();
       $district_datas=$district->find(array('select'=>'id,district_name,district_en_name','condition'=>'id=:id','params'=>array(':id'=>$t_trave_sregion)));
       $sregion_datas=array();
       $sregion_datas['id']=$district_datas->id;
       $sregion_datas['name']=$district_datas->district_name;
       $sregion_datas['en_name']=$district_datas->district_en_name;
       $sregion_session=$sregion_datas;
       if(!empty($sregion_session['id'])){
          Yii::app()->session->add('sregion_datas',$sregion_session);
       }
		 }
	 }
		$this->trave_sregion=$sregion_session['id'];
		$this->trave_sregion_name=$sregion_session['name'];
		$this->trave_sregion_en_name=$sregion_session['en_name'];
		$filterChain->run();
	}
		//易宝
	public function yeepay(){
		Util::reset_vars();
		$trave_id=$_POST['trave_id'];
		$order_id=$_POST['order_id'];
		$total_price=$_POST['total_price'];
		$is_invoice=$_POST['is_invoice'];
		$separate_id=$_POST['separate_id'];
		if(isset($total_price)&& is_numeric($total_price)){

			$trave=new Trave();
		  $trave_datas=$trave->get_table_datas($trave_id);

		  $this->serial_order_details($order_id,$trave_id,$total_price,$separate_id);
		  
		  $trave_name=$trave_datas->trave_name;
		  $trave_descrbe="你正在预定易途线路:".$trave_datas->trave_name;
			$config = Yii::app()->getParams();
			$base_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'/';
			
			$yee = new Yeepay($config->merID, $config->merchantKey);
			$tranId = md5(time());
			$p2_Order = empty($separate_id)?$order_id:($order_id."-".$separate_id);
			$servic_name = mb_convert_encoding($trave_name,'GB2312','UTF-8');
			$notes = mb_convert_encoding($trave_descrbe,'GB2312','utf-8');
			$hmac = $yee->getReqHmacString($p2_Order,
			$total_price,
			'CNY',
			$servic_name,
			$notes,
			'',
			$base_url.'travel/yeereturn',
			$tranId,
			'',
			1);
			$reqURL_onLine = $yee->getReqUrl();
			echo '<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />';
			echo '<body onload="document.yeepay.submit();">';
			echo "<form name='yeepay' action='$reqURL_onLine' method='post'>\n";
			echo "<input type='hidden' name='p0_Cmd' value='Buy'>";
			echo "<input type='hidden' name='p1_MerId' value='{$config->merID}'>\n";
			echo "<input type='hidden' name='p2_Order' value='$p2_Order'>\n";
			echo "<input type='hidden' name='p3_Amt' value='{$total_price}'>\n";
			echo "<input type='hidden' name='p4_Cur' value='CNY'>\n";
			echo "<input type='hidden' name='p5_Pid' value='".$servic_name."'>";
			echo "<input type='hidden' name='p6_Pcat' value='".$notes."'>";
			echo "<input type='hidden' name='p7_Pdesc' value=''>";
			echo "<input type='hidden' name='p8_Url' value='{$base_url}travel/yeereturn'>";
			echo "<input type='hidden' name='p9_SAF' value='0'>";
			echo "<input type='hidden' name='pa_MP' value='$tranId'>";
			echo "<input type='hidden' name='pd_FrpId' value=''>";
			echo "<input type='hidden' name='pr_NeedResponse' value='1'>";
			echo "<input type='hidden' name='hmac' value='$hmac'>";
			echo "</form>";
			echo "</body>";
		
		}
	}

/*
	
	public function paypal(){
		Yii::app ()->session->init();
		Util::reset_vars();
		$trave_id=$_POST['trave_id'];
		$order_id=$_POST['order_id'];
		$total_price=$_POST['total_price'];
		$is_invoice=$_POST['is_invoice'];
		$total_price="0.01";
		if(isset($total_price)&& is_numeric($total_price)){
			$trave=new Trave();
		  $trave_datas=$trave->get_table_datas($trave_id);
		  $trave_name=$trave_datas->trave_name;
		  $trave_descrbe="你正在预定易途线路:".$trave_datas->trave_name;
			$config = Yii::app()->getParams();
			$paypal = new Paypal($config->pal_account,$config->pal_passwd,$config->pal_sign);
			$shopList = array(array('name'=>'$trave_name',
									'amt'=>$total_price,
									'qty'=>1,
									'remark'=>'$trave_descrbe'));
			$base_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'?r=';
			$return_url = $base_url.$config->pal_return;
			$cancel_url = $base_url.$config->pal_cancel;
			$prepareResult = $paypal->SetExpressCheckout($shopList,
			$return_url,
			$cancel_url,
			'USD',
			'');
			$ACK = strtoupper($prepareResult['ACK']);
			if($ACK == 'SUCCESS'){
				$paypal_content=Yii::app()->session->get("paypal_content");
				if(empty($paypal_content)){
				   Yii::app()->session->add("paypal_content",array('token'=>$prepareResult['TOKEN'],'order_id'=>$order_id,'paypal_type'=>'USD'));
				 }else{
				 	 $_SESSION['paypal_content']=array('token'=>$prepareResult['TOKEN'],'order_id'=>$order_id,'paypal_type'=>'USD');
				}
				header("location:".$paypal->getPaypalUrl().$prepareResult['TOKEN']);
				exit;
			}
			else{
				$this->ff("未正常交易,请重试");
				$this->render('travel_pay_success',array());
			}
		}
		else {
			  $this->ff("付款信息验证失败,请重试");
				$this->render('travel_pay_success',array());
		}
	}
	public function actionPalcancel(){
		Yii::app ()->session->init();
		$this->init_order_page();
		$paypal_content=Yii::app()->session->get("paypal_content");
		$session_token=$paypal_content['token'];
		if($session_token==$_GET['token']){
			Yii::app()->session->remove("paypal_content");
		  $this->ff("你取消了Paypal支付");
		}else{
			$this->ff("此连接非Paypal安全链接,请联系易途管理员");
		}
		$this->render('travel_pay_success',array());
	}

	public function actionPalreturn(){
			$this->init_order_page();
			Yii::app ()->session->init();
			$paypal_content=Yii::app()->session->get("paypal_content");
		  $session_token=$paypal_content['token'];
		  if($session_token!=$_GET['token']){
		  	$this->ff("此连接非Paypal安全链接,请联系易途管理员");
		  	exit;
		  }
			$config = Yii::app()->getParams();
			$paypal = new Paypal($config->pal_account,$config->pal_passwd,$config->pal_sign);
			$info = $paypal->GetExpressCheckoutDetails($_GET['token']);
			$info['ACK'] = strtoupper($info['ACK']);
			if($info['ACK']=='SUCCESS'){
				$order_id=$paypal_content['order_id'];
				$trave_order=new Traveorder();
	      $trave_order_datas=$trave_order->get_table_datas($order_id);
		    $order_user_id=$trave_order_datas->create_id;
		    $order_total_price=$trave_order_datas->total_price;
		   if(Yii::app()->user->id == $order_user_id&&$order_total_price==$info['AMT']&&$info['CURRENCYCODE']==$paypal_content['paypal_type']){
					$doResult = $paypal->DoExpressCheckoutPayment($_GET['token'],
					$info['AMT'],
					$info['CURRENCYCODE'],
					$_GET['PayerID']);
					$doResult['ACK'] = strtoupper($doResult['ACK']);
					if($doResult['ACK']=='SUCCESS'){
						$t = Yii::app()->db->beginTransaction();
						try{
							  $order_pay=new Orderpay();
          			$order_pay->notify_id=$_GET['PayerID'];
          			$order_pay->order_id=$order_id;
          			$order_pay->total_fee=$info['AMT'];
          			$order_pay->trade_type='3';
          			$result=$order_pay->insert_orderpay();
          			if($result){
          				$update_datas['pay_status']='2';
          				$result1=$trave_order->update_table_datas($dingdan,$update_datas,array());
          			}
							$t->commit();
						}catch(Exception $e){
							$t->rollback();
						}
					 Yii::app()->session->remove("paypal_content");
					 $operate_result_content="你的易途订单号为:".$order_id.",支付总价钱:".$info['AMT']."元,成功支付.";
				   $this->sf($operate_result_content);
				   $this->render('travel_pay_success',array());
					}else{
						$this->ff("paypal付款失败,请重试");
				    $this->render('travel_pay_success',array());
					}
				
			}else{
				    $this->ff("付款信息验证失败,请重试");
				    $this->render('travel_pay_success',array());
		  }
	  }else{
	  	  $this->ff("paypal付款失败,请重试");
				$this->render('travel_pay_success',array());
	  } 
			
	}
	*/
	
	
	//获取线路的所有时间和价钱
	function get_trave_details_prices($trave_id){
		$trave_date_class=new Travedate();
		$trave=new Trave();
		$trave_date_datas=$trave_date_class->findAll(array('select'=>'trave_id,date_type,trave_date,child_price,adult_price,seats','condition'=>'trave_id=:trave_id AND trave_status=:trave_status','params'=>array(':trave_id'=>$trave_id,':trave_status'=>'1')));
		$trave_date_datas_array=array();
		foreach($trave_date_datas as $key => $value){
			$tem_array=array();
			$trave_date_array=explode(",",$value['trave_date']);
			
			$trave_date=$trave_date_array[0];
			$trave_price=$value['adult_price'];
			$seats=$value->seats;
			if(!empty($trave_date_array[1])&&!empty($trave_date_array[2])){
				$trave=new Trave();
				if($value->date_type=='1'){
				  $rules_dates=$trave->get_rules_date($trave_date,$trave_date_array[1],$trave_date_array[2]);
				}else{
					$rules_dates=$trave->get_period_date($trave_date,$trave_date_array[1],$trave_date_array[2]);
				}
				foreach($rules_dates as $key1 => $value1){
					$trave_date_value=$value1;
					//if(strtotime($trave_date_value) > time()){
					$tem_array1=array();
					$tem_array1['trave_date']=$trave_date_value;
			    $tem_array1['trave_price']=$trave_price;
			    $tem_array1['seats']=$seats;
			    $in_array_flag=$trave->is_unique_date($trave_date_datas_array,$tem_array1['trave_date']);
			    if(!$in_array_flag){
       		 	 array_push($trave_date_datas_array,$tem_array1);
          }
         //}
				}
			}
			if(!empty($trave_date)){
			$trave_date_value=$trave_date;
			//if(strtotime($trave_date_value) > time()){
			$tem_array2=array();
			$tem_array2['trave_date']=$trave_date_value;
			$tem_array2['trave_price']=$trave_price;
			$tem_array2['seats']=$seats;
			$in_array_flag=$trave->is_unique_date($trave_date_datas_array,$tem_array2['trave_date']);
			if(!$in_array_flag){
		
       	 array_push($trave_date_datas_array,$tem_array2);
      }
    // }
     }
		}
	
	
		//计算预定时间的余位
	  foreach($trave_date_datas_array as $key => $value){
	  	$seats=$value['seats'];
	  	$start_date=$value['trave_date'];
	  	if(empty($seats)){
	  		$trave_date_datas_array[$key]['seats']="电询";
	  	}else{
	  		$traveorder=new Traveorder();
	  		$total_nums=$traveorder->get_trave_date_peoples($trave_id,$start_date);
	  		$diff_nums=$seats-$total_nums;	  	
	  		if($diff_nums<=0){
	  			$trave_date_datas_array[$key]['seats']="满座";
	  		}else{
	  			$trave_date_datas_array[$key]['seats']="充足";
	  		}
	  	}
	  }
		return json_encode($trave_date_datas_array);
	}

	
	function travel_comments(){
		$trave_id=$_GET['id'];
		$trave_comment=new TraveComment();
		$comment_dataProvider = new CActiveDataProvider($trave_comment,array(
		  'criteria'=>array(
			    'condition'=>'trave_id=:trave_id',
			    'params'=>array(':trave_id'=>$trave_id),
			    'order'=>'create_time DESC',
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>array('id'=>$trave_id)
          
      ),
		));
		 $ts = time();
		$user_id=Yii::app()->user->id;
		if(!empty($user_id)){
			$user=new User();
			$user_datas=$user->get_table_datas($user_id);
			$user_login=$user_datas->user_login;
			$user_img=$user->get_user_head(50,50,$user_id);
		}
		
		$travel_comment=$this->renderPartial("travel_comment",array('trave_id'=>$trave_id,'comment_dataProvider'=>$comment_dataProvider,'user_login'=>$user_login,'user_img'=>$user_img,'ts'=>$ts),true);
		return $travel_comment;	
	}
	
	
		//获取保险信息
	function travel_insurance($params){
   $insurance_ids=$params['insurance_ids'];
   $adult_nums=$params['adult_nums'];
   $child_nums=$params['child_nums'];
	 $insurance=new Insurance();
	 $conditions=" FIND_IN_SET(id,'$insurance_ids')>0 ORDER BY id ASC";
	 $insurance_datas=$insurance->findAll($conditions,array());
	 $insurance_content=$this->renderPartial("trave_insurance",array('insurance_datas'=>$insurance_datas,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums),true);
		return $insurance_content;
	}
	
	
	
	function travel_consulting(){
		$trave_id=$_REQUEST['id'];

		$trave_consulting=new Consulting();
		$consulting_dataProvider = new CActiveDataProvider($trave_consulting,array(
		  'criteria'=>array(
			    'condition'=>'trave_id=:trave_id',
			    'params'=>array(':trave_id'=>$trave_id),
			    'order'=>'create_time DESC',
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>array('id'=>$trave_id)
          
      ),
		));
		 $ts = time();
		$user_id=Yii::app()->user->id;
		if(!empty($user_id)){
			$user=new User();
			$user_datas=$user->get_table_datas($user_id);
			$user_login=$user_datas->user_login;
			$user_img=$user->get_user_head(50,50,$user_id);
		}
		

		$travel_consulting=$this->renderPartial("travel_consulting",array('trave_id'=>$trave_id,'consulting_dataProvider'=>$consulting_dataProvider,'user_login'=>$user_login,'user_img'=>$user_img,'ts'=>$ts),true);
		return $travel_consulting;
		
	}
	//获取航班信息
	function travel_flight(){
		
		$start_date_id=$_POST['start_date_id'];
		$trave_id=$_REQUEST['trave_id'];
		if(!empty($_REQUEST['select_trave_date'])){
		  $trave_date=strftime("%Y-%m-%d", strtotime($_REQUEST['select_trave_date']));
		}else{
			$trave_date=strftime("%Y-%m-%d", strtotime($_REQUEST['hidden_start_date']));
			
		}
		$trave_date_class=new Travedate();
    $trave_date_datas=$trave_date_class->get_table_datas($start_date_id,array());
    $flight_id=$trave_date_datas->flight_id;
    $back_flight_id=$trave_date_datas->back_flight_id;
		$trave_flight=new TraveFlight();
		$trave_flight_datas=$trave_flight->get_table_datas($flight_id,array());
		$back_trave_flight_datas=$trave_flight->get_table_datas($back_flight_id,array());
		$flight_package=$this->renderPartial("trave_flight",array('trave_flight'=>$trave_flight,'trave_flight_datas'=>$trave_flight_datas,'back_trave_flight_datas'=>$back_trave_flight_datas,'trave_date'=>$trave_date,'trave_id'=>$trave_id),true);
		return $flight_package;
	}
	
	//获取酒店信息
	function travel_hotels(){
		 
		$room_id=$_REQUEST['hidden_room_id'];
		if(!empty($_REQUEST['select_trave_date'])){
		  $trave_date=strftime("%Y-%m-%d", strtotime($_REQUEST['select_trave_date']));
		}else{
			$trave_date=strftime("%Y-%m-%d", strtotime($_REQUEST['hidden_start_date']));
		}
		$trave_route_number=$_REQUEST['hidden_trave_route_number'];
		$room_nums=$_REQUEST['room_nums'];
		$hotel_room=new HotelRoom();
	  $conditions="id=:room_id";
	  $params=array(':room_id'=>$room_id);
		$hotel_room_datas=$hotel_room->findAll($conditions,$params);
		$hotel_package=$this->renderPartial("trave_hotels",array('hotel_room_datas'=>$hotel_room_datas,'trave_date'=>$trave_date,'trave_route_number'=>$trave_route_number,'room_nums'=>$room_nums),true);
		return $hotel_package;
	}
	//预存入订单的信息
	function serial_order_details($order_id,$trave_id,$total_price,$separate_id){
		            $order_serial=new OrderSerial();
		            $order_serial_datas=$order_serial->get_table_datas("",array('order_id'=>$order_id));
		            if(empty($order_serial_datas)){
		  						$serial_array['trave_id']=$trave_id;
		  						$serial_array['total_price']=$total_price;
		  						$serial_array['separate_id']=$separate_id;
		  						$serial_array['create_id']=Yii::app()->user->id;
		  						$order_serial->serial_value=serialize($serial_array);
		 							$order_serial->order_id=$order_id;
		  				 		$order_serial->insert_order_serial();
		  				  }else{
		  				  	$serial_array['trave_id']=$trave_id;
		  						$serial_array['total_price']=$total_price;
		  						$serial_array['separate_id']=$separate_id;
		  						$serial_array['create_id']=Yii::app()->user->id;
		  						$order_serial->update_table_datas("",array('serial_value'=>serialize($serial_array),array('order_id'=>$order_id)));
		  				  }
	}
	
	//检测订单错误
	function check_order_error($total_price,$trave_id,$start_date_id,$start_time,$adult_nums,$child_nums,$insurance_ids){
		$trave_date=new Travedate();
		$trave_date_datas=$trave_date->get_table_datas($start_date_id);
		$seats=$trave_date_datas->seats;
		$adult_price=$trave_date_datas->adult_price;
		$child_price=$trave_date_datas->child_price;
	
		if(!empty($seats)){
		   $traveorder=new Traveorder();
	  	 $total_nums=$traveorder->get_trave_date_peoples($trave_id,$start_time);
	     $diff_nums=$seats-$total_nums;
	    
	    if($diff_nums<=0){
	   	   $this->redirect($this->createUrl('error/errorseats',array()));
	    }
	  }
	  
	  $total_p_nums=intval($adult_nums)+intval($child_nums);
	  $tem_total_price=0;
	  $tem_total_price=intval($adult_price*$adult_nums)+intval($child_price*$child_nums);
	  
	  if(!empty($insurance_ids)){
	  	  $insurance=new Insurance();
	  	  $insurance_ids_array=explode(",",$insurance_ids);
	  	  foreach($insurance_ids_array as $key => $value){
	  	  	$insurance_datas=$insurance->get_table_datas($value);
	  	  	$insurance_pice=$insurance_datas->insurance_pice;
	  	  	$tem_total_price+=intval($insurance_pice*$total_p_nums);
	  	  }
	  }
	
	  if($tem_total_price!=$total_price){
	  	$this->redirect($this->createUrl('error/errororder',array()));
	  }

	}
	//检测自由行的订单错误
	function check_free_order_error($hidden_total_price,$trave_id,$start_date_id,$start_time,$adult_nums,$child_nums,$insurance_ids,$room_nums,$hidden_room_id,$hidden_trave_route_number){
		$trave_date=new Travedate();
		$trave_date_datas=$trave_date->get_table_datas($start_date_id);
		$seats=$trave_date_datas->seats;
		if(!empty($seats)){
		   $traveorder=new Traveorder();
	  	 $total_nums=$traveorder->get_trave_date_peoples($trave_id,$start_time);
	     $diff_nums=$seats-$total_nums;
	    if($diff_nums<=0){
	   	   $this->controller->redirect($this->controller->createUrl('error/errorseats',array()));
	    }
	  }
	  $total_p_nums=intval($adult_nums)+intval($child_nums);
	  $tem_total_price=0;
	  if(!empty($insurance_ids)){
	  	  $insurance=new Insurance();
	  	  $insurance_ids_array=explode(",",$insurance_ids);
	  	  foreach($insurance_ids_array as $key => $value){
	  	  	$insurance_datas=$insurance->get_table_datas($value);
	  	  	$insurance_pice=$insurance_datas->insurance_pice;
	  	  	$tem_total_price+=intval($insurance_pice*$total_p_nums);
	  	  }
	  }
	  $trave=new Trave();
	  $trave_datas=$trave->get_table_datas($trave_id,array());
	  $is_package=$trave_datas->is_package;
	  if($is_package=='1'){
	  	$adult_price=$trave_date_datas->adult_price;
	  	$child_price=$trave_date_datas->child_price;
	  	$tem_total_price+=($adult_price*$adult_nums+$child_price*$child_nums);
	  }else{
	  
	     $trave_flight_price=$trave_date_datas->flight_price;
	     $tem_total_price+=intval($trave_flight_price*$total_p_nums);
	  
	     $hotel_room=new HotelRoom();
	     $hotel_room_datas=$hotel_room->get_table_datas($hidden_room_id);
	     $hotel_room_price=$hotel_room_datas->room_yprice;
	     $tem_total_price+=intval($hotel_room_price*$room_nums*$hidden_trave_route_number);
	  }
	  
	  
	  if($tem_total_price!=$hidden_total_price){
	  	$this->redirect($this->createUrl('error/errororder',array()));
	  }
	  
	  
	}
	
	
	//判断显示的线路类别
	function set_trave_category($trave_category){
		$this->trave_category=$trave_category;
		 switch($trave_category){
		 	case '1':
		 	   $this->menu_tag="n_travel";
		 	   break;
		 	case '2':
		 	   $this->menu_tag="p_travel";
		 	   break;
		 	case '3':
		 	   $this->menu_tag="d_travel";
		 	   break;
		 	case '4':
		 	    $this->menu_tag="g_travel";
		 	   break;
		 	case '5':
		 	   $this->menu_tag="s_travel";
		 	   break;
		 	default:
		 	   break;	
		}
	}
	

	
	public function f($msg_code){ 
		
		if($msg_code==CV::FAILED_TRAVE_OPERATE){
     	$this->ff("操作失败，请更正以下错误。");
     }
     if($msg_code==CV::SUCCESS_TRAVE_OPERATE){
     	$this->sf("提交成功，我们的团队专员会尽快与您联系。");
     }
     if($msg_code==CV::UNLOGIN_ORDER){
    	$this->ff("您还未登录，只有已登录会员才能预订，您也可以拨打021-56880166直接咨询客服。");
      }
     if($msg_code==CV::UNLOGIN_COMMENT){
     	$this->ff("您还未登录,请先登录后再评论");
     }
     if($msg_code==CV::ERROR_PAY){
     	$this->ff("付款信息验证失败,请重试");
     }
     if($msg_code==CV::ERROR_PAYCODE){
     	$this->ff('支付宝支付认证错误,请联系易途管理员');
     }
     if($msg_code==CV::FAILED_TOTAL_COUPON){
     	$this->ff('抵用值大于可抵用余额');
     }
     if($msg_code==CV::FAILED_USER_COUPON){
     	$this->ff('您的抵用劵不足,请充值');
     }
     if($msg_code==CV::FAILED_ZERO_COUPON){
     	$this->ff("抵用值大于支付总价钱");
     }
    }
  
	function init_page(){
		$this->layout="travel/main";
		Util::reset_vars();
	}
	
	function init_free_page(){
		$this->layout="travel/main2";
		Util::reset_vars();
	}
	function init_order_page(){
		$this->layout="travel/main1";
		Util::reset_vars();
	}
	
	function init_bargain_page(){
		$this->layout="travel/main3";
		Util::reset_vars();
	}
	
}
