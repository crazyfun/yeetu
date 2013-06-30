<?php
class SearchfAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	 $this->controller->bc(array("结算信息"));
      return true;
    }
  protected function do_action(){	
  	$order_id=$_REQUEST['order_id'];
    $trave_id=$_REQUEST['trave_id'];
    $agency_id=$_REQUEST['agency_id'];
  	$create_time=$_REQUEST['create_time'];
  	$create_id=$_REQUEST['create_id'];
	  $model=new AgencyFinan();
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

   //线路名称
    if(!empty($trave_id)){
			array_push($condition,"Trave.trave_name LIKE :trave_id");
			$params[':trave_id']="%$trave_id%";
			$page_params['trave_id']=$trave_id;
			$com_condition['线路名称:w%']=$trave_id;
		}
		//供应商名称
		if(!empty($agency_id)){
			array_push($condition,"Agency.agency_name LIKE :agency_id");
			$params[':agency_id']="%$agency_id%";
			$page_params['agency_id']=$agency_id;
			$com_condition['供应商名称:w%']=$agency_id;
		}
		
		//结算时间
		if(!empty($create_time)){
			array_push($condition,"FROM_UNIXTIME(t.create_time,'%Y-%m-%d')=:create_time");
			$params[':create_time']=$create_time;
			$page_params['create_time']=$create_time;
			$com_condition['结算时间:w%']=$create_time;
		}
		//结算人
		if(!empty($create_id)){
			array_push($condition,"User.user_login LIKE :user_login");
			$params[':user_login']="%$create_id%";
			$page_params['create_id']=$create_id;
			$com_condition['结算人:w%']=$create_id;
		}
		

    $model=new AgencyFinan();
    
    $validate_sregion=$this->controller->validate_sregion();
	  if($validate_sregion){
	    $validate_sregion=" AND ".$validate_sregion;
	  }
	  
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
  	
		$criteria=new CDbCriteria;
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'select'=>'*',
			    'condition'=>implode(' AND ',$condition),
			    'params'=>$params,
			    'with'=>array('User'=>array('select'=>'id,user_login'),'Trave'=>array('select'=>'trave.trave_name,trave.trave_category,trave.trave_sregion,trave.trave_region','condition'=>'(1=1)'.$validate_sregion,'params'=>array(),'together'=>true),'Agency'=>array('select'=>'agency_name')),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
          
      ),
      'sort'=>$sort,
		));
		$com_condition_search=Util::com_search_condition($com_condition);
    $this->display('finan',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'order_id'=>$order_id,'create_time'=>$create_time,'create_id'=>$create_id,'trave_id'=>$trave_id,'agency_id'=>$agency_id));
  }
}
?>
