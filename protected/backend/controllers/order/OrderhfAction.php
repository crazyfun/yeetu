<?php
class OrderhfAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("订单航班管理"));
      return true;
    }

  protected function do_action(){	
  	
  	
  	$order_id=$_REQUEST['order_id'];
  	$create_id=$_REQUEST['create_id'];
  	$create_time=$_REQUEST['create_time'];
  	$operate_time=$_REQUEST['operate_time'];
  	$trave_name=$_REQUEST['trave_name'];
  	$order_status=$_REQUEST['order_status'];
  	$pay_status=$_REQUEST['pay_status'];

  		//搜索
		$condition=array();
		$params=array();
		$page_params=array();
		//订单ID
		if(!empty($order_id)){
			array_push($condition,"t.id=:order_id");
			$params[':order_id']=$order_id;
			$page_params['order_id']=$order_id;
			$com_condition['订单ID:w%']=$order_id;
		}
		

		//订单者ID
		if(!empty($create_id)){
			array_push($condition,"(user.id=:create_id OR user.user_login LIKE '%$create_id%')");
			$params[':create_id']=$create_id;
			$page_params['create_id']=$create_id;
			$com_condition['下单用户ID/用户名称:w%']=$create_id;
		}
		//下单时间
		if(!empty($create_time)){
			array_push($condition,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			$params[':create_time']=$create_time;
			$page_params['create_time']=$create_time;
			$com_condition['下单时间:w%']=$create_time;
		}
		//处理时间
		if(!empty($operate_time)){
			array_push($condition,"FROM_UNIXTIME(t.operate_time,'%Y-%m-%d')=:operate_time");
			$params[':operate_time']=$operate_time;
			$page_params['operate_time']=$operate_time;
			$com_condition['处理时间:w%']=$operate_time;
		}

		//线路名称
		if(!empty($trave_name)){
			array_push($condition,"(trave.trave_name LIKE :trave_name OR trave.trave_suppliers LIKE :trave_name OR trave.trave_number LIKE :trave_name)");
			$params[':trave_name']="%$trave_name%";
			$page_params['trave_name']=$trave_name;
			$com_condition['模糊查询:w%']=$trave_name;
		}//订单状态
		if(!empty($order_status)){
			array_push($condition,"t.order_status=:order_status");
			$params[':order_status']=$order_status;
			$page_params['order_status']=$order_status;
			$order_status_datas=CV::$ORDER_STATUS;
			$com_condition['订单状态:w%']=$order_status_datas[$order_status];
		}
		
		
		//付款状态
		if(!empty($pay_status)){
			array_push($condition,"t.pay_status=:pay_status");
			$params[':pay_status']=$pay_status;
			$page_params['pay_status']=$pay_status;
			$pay_status_datas=CV::$PAY_STATUS;
			$com_condition['付款状态:w%']=$pay_status_datas[$pay_status];
		}
		$validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  
	  
		array_push($condition,"trave.trave_category=:trave_category");
	  $params[':trave_category']='5';
	  $page_params['trave_category']='5';
		$model=new Traveorder();
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
			    'with'=>array('trave'=>array('select'=>'trave.trave_name,trave.trave_category,trave.trave_sregion,trave.trave_region','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true),'user'=>array('select'=>"user.user_login")),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
          
      ),
      'sort'=>$sort,
		));
		$this->display('order_hf',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'order_id'=>$order_id,'create_id'=>$create_id,'create_time'=>$create_time,'operate_time'=>$operate_time,'trave_name'=>$trave_name,'order_status'=>$order_status,'pay_status'=>$pay_status));
   	
  }
 
 
    
}
?>
