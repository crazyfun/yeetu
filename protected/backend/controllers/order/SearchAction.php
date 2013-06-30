<?php
class SearchAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("订单管理"));
      return true;
    }

  protected function do_action(){	
  	$order_id=$_REQUEST['order_id'];
  	$create_id=$_REQUEST['create_id'];
  	$create_time=$_REQUEST['create_time'];
  	$operate_time=$_REQUEST['operate_time'];
  	$trave_category=$_REQUEST['trave_category'];
  	$trave_name=$_REQUEST['trave_name'];
  	$order_status=$_REQUEST['order_status'];
  	$pay_status=$_REQUEST['pay_status'];
  	$total_price=$_REQUEST['total_price'];
  	$is_invoice=$_REQUEST['is_invoice'];
  	
  	$relation_id=$_REQUEST['relation_id'];
  	$order_level=$_REQUEST['order_level'];
  	$order_style=$_REQUEST['order_style'];
  	$order_source=$_REQUEST['order_source'];
  	$pay_style=$_REQUEST['pay_style'];
  	
  	$pay_order_status=$_REQUEST['pay_order_status'];
  	
	  $model=new Traveorder();
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
		
		if(!empty($pay_style)){
			array_push($condition,"t.pay_style=:pay_style");
			$params[':pay_style']=$pay_style;
			$page_params['pay_style']=$pay_style;
			$com_condition['付款方式:w%']=$pay_style;
			
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
		//线路分类
		if(!empty($trave_category)){
			array_push($condition,"trave.trave_category=:trave_category");
			$params[':trave_category']=$trave_category;
			$page_params['trave_category']=$trave_category;
			$trave_category_datas=CV::$TRAVE_CATEGORY;
			$com_condition['线路分类:w%']=$trave_category_datas[$trave_category];
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
		
		//关联着
		if(!empty($relation_id)){
			array_push($condition,"t.relation_id=:relation_id");
			$params[':relation_id']=$relation_id;
			$page_params['relation_id']=$relation_id;
			$user=new User();
			$select_admin=$user->get_select_admin();
			$com_condition['关联者:w%']=$select_admin[$relation_id];
		}
		
		
		
		//订单等级
		if(!empty($order_level)){
			array_push($condition,"t.order_level=:order_level");
			$params[':order_level']=$order_level;
			$page_params['order_level']=$order_level;
			$order_level_datas=CV::$ORDER_LEVEL;
			$com_condition['订单等级:w%']=$order_level_datas[$order_level];
		}
		
		//下单方式
		
		if(!empty($order_style)){
			array_push($condition,"t.order_style=:order_style");
			$params[':order_style']=$order_style;
			$page_params['order_style']=$order_style;
			$order_style_datas=CV::$ORDER_STYLE;
			$com_condition['下单方式:w%']=$order_style_datas[$order_style];
		}
		

		//来源地
		if(!empty($order_source)){
			array_push($condition,"t.order_source=:order_source");
			$params[':order_source']=$order_source;
			$page_params['order_source']=$order_source;
			$order_source_datas=CV::$ORDER_SOURCE;
			$com_condition['来源地:w%']=$order_source_datas[$order_source];
		}
		
		
		//付款状态
		if(!empty($pay_status)){
			array_push($condition,"t.pay_status=:pay_status");
			$params[':pay_status']=$pay_status;
			$page_params['pay_status']=$pay_status;
			$pay_status_datas=CV::$PAY_STATUS;
			$com_condition['付款状态:w%']=$pay_status_datas[$pay_status];
		}
		
		
		//付款状态
		if(!empty($pay_order_status)){
			switch($pay_order_status){
				case '1':
				  array_push($condition,"(t.order_status='1' OR t.order_status='2' OR t.order_status='3' OR t.order_status='4' OR t.order_status='5')");
					$page_params['pay_order_status']=$pay_order_status;
				  break;
				case '2':
				  array_push($condition,"(t.order_status='6' OR t.order_status='7')");
					$page_params['pay_order_status']=$pay_order_status;
				  break;
				case '3':
					array_push($condition,"(t.order_status='8')");
					$page_params['pay_order_status']=$pay_order_status;
				  break;
			}
		}
		
    //价钱
     if(!empty($total_price)){
    	$total_price=html_entity_decode($total_price);
    	$total_price_array=explode('-',$total_price);
    	if(count($total_price_array)>=2){
    		$r_first_value=$total_price_array[0];
    		$r_last_value=$total_price_array[1];
    		if(empty($r_last_value)){
    			
    			array_push($condition,"t.total_price>:r_first_value");
    		  $params[':r_first_value']=$r_first_value;
    		  $com_condition['价钱:大于w%']=$r_first_value;
    		}else{
    			
    			array_push($condition,":r_first_value<=t.total_price AND t.total_price<=:r_last_value");
    			$params[':r_first_value']=$r_first_value;
    			$params[':r_last_value']=$r_last_value;
    			$com_condition['价钱:大于w%小于'.$r_last_value]=$r_first_value;
    		}
    	}else{
    	 	array_push($condition,"t.total_price=:r_first_value");
    		$params[':r_first_value']=$total_price;
    		$com_condition['价钱:等于w%']=$total_price;
    	}
    	$page_params['total_price']=$total_price;
    	
    }
    //订单ID
		if(!empty($is_invoice)){
			
			array_push($condition,"t.is_invoice=:is_invoice");
			$params[':is_invoice']=intval($is_invoice)-1;
			$page_params['is_invoice']=$is_invoice;
			$invoice_array=array(''=>'发票','1'=>'不需要','2'=>'需要');
			$com_condition['发票:w%']=$invoice_array[intval($is_invoice)-1];
		}
    $validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
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
		$com_condition_search=Util::com_search_condition($com_condition);
    $this->display('index',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'order_id'=>$order_id,'create_id'=>$create_id,'create_time'=>$create_time,'operate_time'=>$operate_time,'trave_category'=>$trave_category,'trave_name'=>$trave_name,'order_status'=>$order_status,'pay_status'=>$pay_status,'total_price'=>$total_price,'is_invoice'=>$is_invoice,'relation_id'=>$relation_id,'order_level'=>$order_level,'order_style'=>$order_style,'order_source'=>$order_source,'pay_style'=>$pay_style));
		
		
	
  }
 
 
    
}
?>
