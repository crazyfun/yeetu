<?php
class TravelpayAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_ORDER,'',array());
    	$this->controller->init_order_page();
    	$trave_id=$_POST['trave_id'];
    	$trave=new Trave();
    	$trave_datas=$trave->get_table_datas($trave_id);
    	$this->controller->pt($this->id,array($trave_datas->trave_name.'旅游线路在线预定_签约付款-易途旅游网'));
		  $this->controller->desc("易途旅游网(41ly.cn)——最简单易用方便实惠的旅游线路在线预订平台,一站式个性化旅游服务提供商;跟团游＋自助游＋公司旅游专家;周边游,国内游,出境游,公司旅游;");
		  $this->controller->kw("旅游,旅游网,旅游网站,自助游,跟团游,公司旅游");
    	return true;
    	
    }
   
  protected function do_action(){
   	$trave_id=$_POST['trave_id'];
		$order_id=$_POST['order_id'];
		$total_price=$_POST['total_price'];
		$separate_id=$_POST['separate_id'];
		$is_invoice=$_POST['is_invoice'];
		$pay_type=$_POST['pay_type'];
		if(empty($pay_type)){
			  	$this->controller->tf("请选择支付接口");
			  	$this->display('travel_pay',array('trave_id'=>$trave_id,'order_id'=>$order_id,'total_price'=>$total_price,'separate_id'=>$separate_id));
		}else{
			  	//设置是否需要发票
		      $trave_order=new Traveorder();
		      $update_datas['is_invoice']=$is_invoice;
          $result1=$trave_order->update_table_datas($order_id,$update_datas,array());
          switch($pay_type){
		      	case '1':
		      	 if(isset($_POST['pament'])){
		      	 	   $trave_order=new Traveorder();
		      	 	   $attibutes['pay_style']=$pay_type;
		      	 	   $trave_order->update_table_datas($order_id,$attibutes);
		      	     $this->controller->yeepay();
		      	     exit();
		      	  }
		      	  break;
		      	case '2':
							 if(isset($total_price)&& is_numeric($total_price)){
							 	$trave_order=new Traveorder();
							 	$attibutes['pay_style']=$pay_type;
		      	 	  $trave_order->update_table_datas($order_id,$attibutes);
								$params= Yii::app()->getParams();
								$base_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].'/';
								$trave=new Trave();
		  					$trave_datas=$trave->get_table_datas($trave_id);
		  					$trave_name=$trave_datas->trave_name;
		  					$this->controller->serial_order_details($order_id,$trave_id,$total_price,$separate_id);
		  					$trave_descrbe="你正在预定易途线路:".$trave_datas->trave_name;
		  					$show_url=$base_url."travel/traveldetail?trave_id=".$trave_id;
		  					$payment=array();
		  					$order=array();
		  					$payment['alipay_pay_method']='2';
		  					$payment['alipay_partner']=$params->partner;
		 					 	$payment['_input_charset']=$params->_input_charset;
		  					$payment['seller_email']=$params->seller_email;
		  					$payment['return_url']=$base_url.$params->return_url;
		  					$payment['notify_url']=$base_url.$params->notify_url;
		  					$payment['alipay_key']=$params->security_code;
		  					$order['out_trade_no']=empty($separate_id)?$order_id:($order_id."-".$separate_id);
		  					$order['subject']=$trave_name;
		  					$order['body']=$trave_descrbe;
		  					$order['price']=$total_price;
		  					$alipay=new Alipay();
		  					$alipay_button=$alipay->get_code($order,$payment);
							}
		      	   break;
		      	default:
		      	  break;
		  }
		  
		  
		  
		  $this->display('travel_pay_check',array('trave_id'=>$trave_id,"is_invoice"=>$is_invoice,"pay_type"=>$pay_type,"order_id"=>$order_id,"total_price"=>$total_price,'separate_id'=>$separate_id,'alipay_button'=>$alipay_button));
	 }
  }
 
 
    
}
?>
