<?php
class CreditAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_CREDIT,array());
      $this->controller->init_page();
      $this->controller->user_tag='credit';
      $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'用户积分')
      );
	  $this->controller->pt($this->id,array());
    	return true;
    }
  
  protected function do_action(){

   
   $value_sort=$_REQUEST['value_sort'];
   $time_sort=$_REQUEST['time_sort'];
   
   $create_time=$_REQUEST['create_time'];
   $credit_type=$_REQUEST['credit_type'];
   $user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
   
   

   if(!isset($_REQUEST['value_sort'])){
    $value_sort="DESC"; 	
   }
   if(!isset($_REQUEST['time_sort'])){
    $time_sort="DESC";	
  }
  
  
   $order_sort="";
   if(isset($_REQUEST['value_sort'])){
   	$order_sort="t.credit_value $value_sort";
   }
   else if(isset($_REQUEST['time_sort'])){
   	$order_sort="t.create_time $time_sort";
  }else{
  	$order_sort="t.create_time $time_sort";
  }

		$criteria=new CDbCriteria();
		$criteria->condition="t.user_id=:user_id";
		if(!empty($create_time)){
			$criteria->addCondition("FROM_UNIXTIME(t.create_time, '%Y-%m')='$create_time'");
		}
		if(!empty($credit_type)){
			$criteria->addCondition("t.credit_type='$credit_type'");
		}
		$criteria->params=array(':user_id'=>$user_id);
		$criteria->order=$order_sort;
		$credit_consume=new Credit();
		$credit_consume_number=$credit_consume->count($criteria);
		$pages=new CPagination($credit_consume_number);
		$pages->pageSize=20;
		$pages->applyLimit($criteria);//给$criteria->limit offset等符值
		$pages->params=array('value_sort'=>$value_sort,'time_sort'=>$time_sort,'credit_type'=>$credit_type,'create_time'=>$create_time);
		$credit_consume_datas=$credit_consume->findAll($criteria);
   
   
   $user=new User();
   $user_datas=$user->get_table_datas($user_id);
   $this->display("user_credit",array('credit_consume_datas'=>$credit_consume_datas,'value_sort'=>$value_sort,'time_sort'=>$time_sort,'user_datas'=>$user_datas,'create_time'=>$create_time,'credit_type'=>$credit_type,'pages'=>$pages));
  }
 
 
    
}
?>
