<?php
class SearchpayAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("付款信息管理"));
      return true;
    }
  protected function do_action(){	
  	$order_id=$_REQUEST['order_id'];
  	$notify_id=$_REQUEST['notify_id'];
  	$trade_type=$_REQUEST['trade_type'];
  	$create_time=$_REQUEST['create_time'];
  	$web_notify_id=$_REQUEST['web_notify_id'];
  	$create_id=$_REQUEST['create_id'];
  	$operate_id=$_REQUEST['operate_id'];
	  $model=new Orderpay();
		//搜索
		$condition=array();
		$params=array();
		$page_params=array();
		//订单ID
		if(!empty($order_id)){
			array_push($condition,"t.order_id=:order_id");
			$params[':order_id']=$order_id;
			$page_params['order_id']=$order_id;
			$com_condition['订单号:w%']=$order_id;
		}
		//订单者ID
		if(!empty($notify_id)){
			array_push($condition,"t.notify_id=:notify_id");
			$params[':notify_id']=$notify_id;
			$page_params['notify_id']=$notify_id;
			$com_condition['外部流水号:w%']=$notify_id;
		}
		
		
		//订单者ID
		if(!empty($web_notify_id)){
			array_push($condition,"t.web_notify_id=:web_notify_id");
			$params[':web_notify_id']=$web_notify_id;
			$page_params['web_notify_id']=$web_notify_id;
			$com_condition['内部流水号:w%']=$web_notify_id;
		}
		
		
		
		//订单者ID
		if(!empty($trade_type)){
			array_push($condition,"t.trade_type=:trade_type");
			$params[':trade_type']=$trade_type;
			$page_params['trade_type']=$trade_type;
			$order_style_datas=CV::$ORDER_STYLE;
			$com_condition['付款方式:w%']=$order_style_datas[$trade_type];
		}
		
		
		//下单时间
		if(!empty($create_time)){
			array_push($condition,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			$params[':create_time']=$create_time;
			$page_params['create_time']=$create_time;
			$com_condition['付款时间:w%']=$create_time;
		}
		
		
		
		//订单者ID
		if(!empty($create_id)){
			array_push($condition,"User.user_login LIKE :user_login");
			$params[':user_login']="%$create_id%";
			$page_params['create_id']=$create_id;
			$com_condition['付款人:w%']=$create_id;
		}
		
		
		//操作者ID
		if(!empty($operate_id)){
			array_push($condition,"OUser.user_login LIKE :user_login");
			$params[':user_login']="%$operate_id%";
			$page_params['operate_id']=$operate_id;
			$com_condition['操作人:w%']=$operate_id;
		}
		

    $model=new Orderpay();
    $validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'select'=>'*',
			    'condition'=>implode(' AND ',$condition),
			    'params'=>$params,
			    'with'=>array('User','OUser','Order'=>array('select'=>'id','condition'=>'','params'=>array(),'with'=>array('trave'=>array('select'=>'trave_sregion','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true)),'together'=>true)),
			   
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
          
      ),
      'sort'=>$sort,
		));
		$com_condition_search=Util::com_search_condition($com_condition);
    $this->display('order_pay',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'order_id'=>$order_id,'notify_id'=>$notify_id,'trade_type'=>$trade_type,'create_time'=>$create_time,'web_notify_id'=>$web_notify_id,'create_id'=>$create_id,'operate_id'=>$operate_id));
  }
}
?>
