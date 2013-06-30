<?php
class CouponAction extends  BaseAction{
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_CREDIT,array());
      $this->controller->init_page();
      $this->controller->user_tag='coupon';
      $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'抵用劵')
      );
	  $this->controller->pt($this->id,array());
    	return true;
    }
  
  protected function do_action(){
   $coupon_status=$_REQUEST['coupon_status'];
   $value_sort=$_REQUEST['value_sort'];
   $time_sort=$_REQUEST['time_sort'];
   $create_time=$_REQUEST['create_time'];
   $user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
   if(!strlen($coupon_status)){
   	  $coupon_status='1';
   }
   if(!isset($_REQUEST['value_sort'])){
    $value_sort="DESC"; 	
   }
   if(!isset($_REQUEST['time_sort'])){
    $time_sort="DESC";	
   }
  
   $order_sort="";
   if(isset($_REQUEST['value_sort'])){
   	$order_sort="t.coupon_value $value_sort";
   }
   else if(isset($_REQUEST['time_sort'])){
   	$order_sort="t.create_time $time_sort";
  }else{
  	$order_sort="t.create_time $time_sort";
  }
   if($coupon_status=='1'){
		$criteria=new CDbCriteria();
		
		
		$criteria->condition="t.user_id=:user_id AND t.coupon_type=:coupon_type";
		if(!empty($create_time)){
			$criteria->addCondition("FROM_UNIXTIME(t.create_time, '%Y-%m')='$create_time'");
		}
		$criteria->params=array(':user_id'=>$user_id,':coupon_type'=>'1');
		$criteria->with=array('Coupon');
		$criteria->order=$order_sort;
		$coupon_consume=new CouponConsume();
		$coupon_consume_number=$coupon_consume->count($criteria);
		$pages=new CPagination($coupon_consume_number);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);//给$criteria->limit offset等符值
		$pages->params=array('coupon_status'=>$coupon_status,'value_sort'=>$value_sort,'time_sort'=>$time_sort,'create_time'=>$create_time);
		$coupon_consume_datas=$coupon_consume->findAll($criteria);
   }else{
   	$criteria=new CDbCriteria();
		$criteria->condition="t.user_id=:user_id AND t.coupon_type=:coupon_type";
		if(!empty($create_time)){
			$criteria->addCondition("FROM_UNIXTIME(t.create_time, '%Y-%m')='$create_time'");
		}
		$criteria->params=array(':user_id'=>$user_id,':coupon_type'=>'2');
		$criteria->with=array('Coupon');
		$criteria->order=$order_sort;
		$coupon_consume=new CouponConsume();
		$coupon_consume_number=$coupon_consume->count($criteria);
		$pages=new CPagination($coupon_consume_number);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);//给$criteria->limit offset等符值
		$pages->params=array('coupon_status'=>$coupon_status,'value_sort'=>$value_sort,'time_sort'=>$time_sort,'create_time'=>$create_time);
		$coupon_consume_datas=$coupon_consume->findAll($criteria);
   }
   $user=new User();
   $user_datas=$user->get_table_datas($user_id);
   $this->display("user_coupon",array('coupon_consume_datas'=>$coupon_consume_datas,'coupon_status'=>$coupon_status,'value_sort'=>$value_sort,'time_sort'=>$time_sort,'user_datas'=>$user_datas,'create_time'=>$create_time,'pages'=>$pages));
  }
 
 
    
}
?>
