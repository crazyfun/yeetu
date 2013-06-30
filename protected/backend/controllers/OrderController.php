<?php
class OrderController extends AController
{
 public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
			'EditFilter +add,status,adminpay,separate',
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
	  	$filterChain->run();
	  }
	}
	
	
	
	public function actions()
	{
		return array(
		 'index'=>'application.backend.controllers.order.IndexAction',
		 'search'=>'application.backend.controllers.order.SearchAction',
		 'status'=>'application.backend.controllers.order.StatusAction',
		 'add'=>'application.backend.controllers.order.AddAction',
		 'view'=>'application.backend.controllers.order.ViewAction',
		 'pay'=>'application.backend.controllers.order.PayAction',
		 'searchpay'=>'application.backend.controllers.order.SearchpayAction',
		 'separate'=>'application.backend.controllers.order.SeparateAction',
		 'adminpay'=>'application.backend.controllers.order.AdminpayAction',
		 'insurance'=>'application.backend.controllers.order.InsuranceAction',
		 'search1'=>'application.backend.controllers.order.Search1Action',
		 'orderhf'=>'application.backend.controllers.order.OrderhfAction',
		 'orderhh'=>'application.backend.controllers.order.OrderhhAction',
		 'delete'=>'application.backend.controllers.order.DeleteAction',
		 'orderprint'=>'application.backend.controllers.order.OrderprintAction',
		);
	}

	public function f($msg_code){ 
     if($msg_code == CV::SUCCESS_ADMIN_OPERATE){
       $this->sf("操作成功");
     }
     if($msg_code == CV::FAILED_ADMIN_OPERATE){
     	$this->ff("操作失败");
     }
     if($msg_code == CV::ERROR_ADMIN_DATABASE){
     	 $this->ff("操作数据库错误");
     }
     if($msg_code == CV::FAILED_ADMIN_OPERATE_USER_EMAIL){
     	$this->ff("注册会员数据错误");
     }

    }

	
		//获取保险信息
	function travel_insurance($params){
   $insurance_ids=$params['insurance_ids'];
	 $insurance=new Insurance();
	 $insurance_datas=$insurance->findAll('',array());
	 $insurance_content=$this->renderPartial("order_insurance",array('insurance_datas'=>$insurance_datas,'insurance_ids'=>$insurance_ids),true);
		return $insurance_content;
	}
	
	
			//获取联系人信息
	function travel_contacts($params){
		$order_id=$params['order_id'];
    $ordercontact=new Ordercontact();
    $condition="trave_order_id=:trave_order_id ORDER BY main_contact DESC";
    $params=array(':trave_order_id'=>$order_id);
    $ordercontact_datas=$ordercontact->findAll($condition,$params);
    foreach($ordercontact_datas as $key => $value){
    	$contact_birthday_datas=explode('-',$value->contact_birthday);
    	$ordercontact_datas[$key]->year=$contact_birthday_datas[0];
    	$ordercontact_datas[$key]->month=$contact_birthday_datas[1];
    	$ordercontact_datas[$key]->day=$contact_birthday_datas[2];
    	
    	$valid_date_datas=explode('-',$value->valid_date);
    	
    	$ordercontact_datas[$key]->valid_year=$valid_date_datas[0];
    	$ordercontact_datas[$key]->valid_month=$valid_date_datas[1];
    	$ordercontact_datas[$key]->valid_day=$valid_date_datas[2];
   
    	
    	
    	$contact_telephone=explode('-',$value->contact_telephone);
    	if(count($contact_telephone)>=2){

    	 $ordercontact_datas[$key]->area_code=$contact_telephone[0];
    	 $ordercontact_datas[$key]->user_telephone=$contact_telephone[1];
    
    	}else{
    	 $ordercontact_datas[$key]->user_telephone=$value->contact_telephone;
    	}
    }
	  $contacts_content=$this->renderPartial("order_contacts",array('travel_people'=>$ordercontact_datas,'order_id'=>$order_id),true);
		return $contacts_content;
	} 
	
	function init_print_page(){
		$this->layout="print";
		Util::reset_vars();
	}
	
}
