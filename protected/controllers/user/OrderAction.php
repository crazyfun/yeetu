<?php
class OrderAction extends  BaseAction{
  
	protected function beforeAction(){
		$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_ORDER,array());
		$this->controller->init_page();
		$this->controller->user_tag='order';
		$this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
			array('用户中心'=>array("user/index"),'我的订单')
		);
		$this->controller->pt($this->id,array());
		return true;
	}

	protected function do_action(){
		$user_id=$_GET['user_id'];
		$order_status=$_REQUEST['order_status'];
		
	 $value_sort=$_REQUEST['value_sort'];
   $time_sort=$_REQUEST['time_sort'];
   $operate_time_sort=$_REQUEST['operate_time_sort'];
   
   if(!isset($_REQUEST['value_sort'])){
    $value_sort="DESC"; 	
   }
   if(!isset($_REQUEST['time_sort'])){
    $time_sort="DESC";	
  }
  if(!isset($_REQUEST['operate_time_sort'])){
    $operate_time_sort="DESC";	
  }
  
   $order_sort="";
   if(isset($_REQUEST['value_sort'])){
   	$order_sort="t.total_price $value_sort";
   }
   else if(isset($_REQUEST['time_sort'])){
   	$order_sort="t.create_time $time_sort";
   }else if(isset($_REQUEST['operate_time_sort'])){
  	$order_sort="t.operate_time $operate_time_sort";
   }else{
  	$order_sort="t.create_time $time_sort";
   }

  
  
  
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$criteria=new CDbCriteria();
		$criteria->select = 'trave_id, id, create_time, total_price, create_id,pay_status,order_status';
		$criteria->with = array('trave'=> array('select' => 'trave_name,trave_title'));
		if(!empty($order_status)){
			switch($order_status){
				case '1':
				  $tem_condition="t.create_id=:user_id AND (t.order_status='1' OR t.order_status='2' OR t.order_status='3' OR t.order_status='4' OR t.order_status='5')";
				  break;
				case '2':
				  $tem_condition="t.create_id=:user_id AND (t.order_status='6' OR t.order_status='7') ";
				  break;
				case '3':
				  $tem_condition="t.create_id=:user_id AND t.order_status='8'";
				  break;
				default:
				  break;
				
			}
			$criteria->condition=$tem_condition;
			$criteria->params=array(':user_id'=>$user_id);
		}else{
			$criteria->condition="t.create_id=:user_id";
			$criteria->params=array(':user_id'=>$user_id);
		}

		if (($create_time = $_GET['create_time']) && preg_match('/^\d{4}\/\d{2}/', $create_time)) {
			$criteria->addCondition('SELECT FROM_UNIXTIME(t.create_time, "%Y/%m")="' . $create_time . '"');
		}
		if ($s = trim($_GET['s'])) {
			$criteria->addSearchCondition('trave.trave_name', $s);
		}
		
		$criteria->order=$order_sort;
		$trave_order=new Traveorder();
		$dataProvider=new CActiveDataProvider($trave_order, array(
			'criteria' =>$criteria,
			'pagination' => array(
				'pageSize' => 20
			),
			'sort' => array(
				'sortVar'=>'sort',
				'defaultOrder' => 't.create_time DESC',
			)
		)); 

		$pages = $dataProvider->getPagination();
		$trave_order_datas = $dataProvider->getData();
		$trave_order_nums=$trave_order->get_order_nums($user_id);
		$this->display("user_order",array(
			'pages'=>$pages,
			'value_sort'=>$value_sort,
			'time_sort'=>$time_sort,
			'operate_time_sort'=>$operate_time_sort,
			'trave_order_datas'=>$trave_order_datas,
			'trave_order_nums'=>$trave_order_nums,
			'order_status'=>$order_status,
			'create_time' => isset($create_time) ? $create_time : '', 
			's' => isset($s) ? $s : '',
		));
  }
}
?>
