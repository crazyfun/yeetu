<?php
class OrderAction extends BaseAction{
  
  public function filters() {
		return array(
			'EditFilter + adminfinan',
		);
	}
	
	public function FilterEditFilter($filterChain) {
		$id=$_GET['id'];
		$order_id=$_GET['order_id'];
		if(!empty($order_id)){
			$id=$order_id;
		}
		if(!empty($id)){
    	$user_id=Yii::app()->user->id;
  	  $user_datas=User::model()->get_table_datas($user_id);
  	  $permissions_type=$user_datas->permissions_type;
  	  $order_datas= Traveorder::model()->find(array('condition'=>'t.id=:id','params'=>array(':id'=>$id),'with'=>array('trave')));
  	  $trave_permissions_type=$order_datas->trave->trave_sregion;
  	  if(($trave_permissions_type!=$permissions_type)&&$permissions_type){
  		  $this->redirect($this->createUrl("error/error403"));
  	  }else{
	      $filterChain->run();
	    }
	  }else{
	  	$this->redirect($this->createUrl("error/error404"));
	  }
	}
	
	
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("订单财务"));
      return true;
    }
  protected function do_action(){	
		$model=new Traveorder();
		$criteria=new CDbCriteria;
		$condition=array();
		$trave_condition="";
		$trave_params=array();
		$params=array();
		$page_params=array();
		$trave_with=array('Agency'=>array());
		
			$order_id=$_REQUEST['order_id'];
			$order_status=$_REQUEST['order_status'];
			$is_invoice=$_REQUEST['is_invoice'];
			$trave_id=$_REQUEST['trave_id'];
			$pay_status=$_REQUEST['pay_status'];
			$suppliers_settle=$_REQUEST['suppliers_settle'];
			$trave_suppliers=$_REQUEST['trave_suppliers'];
	  //订单ID
		if(!empty($order_id)){
			array_push($condition,"t.id=:order_id");
			$params[':order_id']=$order_id;
			$page_params['order_id']=$order_id;
			$com_condition['订单ID:w%']=$order_id;
		}

		//供应商
		if(!empty($trave_suppliers)){
			$trave_with['Agency']=array('select'=>'Agency.agency_name','condition'=>"Agency.agency_name LIKE '%$trave_suppliers%'",'params'=>array(),'together'=>true);
			$page_params['trave_suppliers']=$trave_suppliers;
			$com_condition['供应商名称:w%']=$trave_suppliers;
		}
			//线路名称
		if(!empty($trave_id)){
			$trave_condition=" AND trave.trave_name LIKE :trave_name";
			$trave_params[':trave_name']="%".$trave_id."%";
			$page_params['trave_id']=$trave_id;
			$com_condition['旅游线路名称:w%']=$trave_id;
		}
		
		//订单状态
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
		
		//结算状态
		if(!empty($suppliers_settle)){
			array_push($condition,"t.suppliers_settle=:suppliers_settle");
			$params[':suppliers_settle']=$suppliers_settle;
			$page_params['suppliers_settle']=$suppliers_settle;
			$suppliers_settle_datas=CV::$SUPPLIERS_SETTLE;
			$com_condition['结算状态:w%']=$suppliers_settle_datas[$suppliers_settle];
		}
		
		
		 //发票
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
	  $sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
			$active_data_provider=new CActiveDataProvider($model, array(
			 'criteria'=>array(
			    'select'=>'*',
			    'condition'=>implode(' AND ',$condition),
			    'params'=>$params,
			    'with'=>array('trave'=>array('select'=>'trave.id,trave.trave_name','condition'=>'(1=1)'.$validate_sregion.$trave_condition,'params'=>$trave_params,'with'=>$trave_with,'together'=>true)),
			 ),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params,
      ),
      'sort'=>$sort,
     ));
			
		  //$trave_order_datas=$model->findAll(array('condition'=>implode(' AND ',$condition),'params'=>$params));
	   // $order_statist=$model->get_order_statist($trave_order_datas);
	
	 
	
	 $com_condition_search=Util::com_search_condition($com_condition);
		$this->display('order',array('model'=>$model,'active_data_provider'=>$active_data_provider,'order_id'=>$order_id,'pay_status'=>$pay_status,'order_status'=>$order_status,'is_invoice'=>$is_invoice,'trave_id'=>$trave_id,'com_condition_search'=>$com_condition_search,'suppliers_settle'=>$suppliers_settle,'trave_suppliers'=>$trave_suppliers,'condition'=>$condition,'params'=>$params,'trave_condition'=>$trave_condition,'trave_params'=>$$trave_params,'trave_with'=>$trave_with));
   	
  }
 
 
    
}
?>
