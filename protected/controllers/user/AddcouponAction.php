<?php
class AddcouponAction extends  BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login(CV::UNLOGIN_USER,CV::RETURN_USER_CREDIT,array());
      $this->controller->init_page();
      $this->controller->user_tag='coupon';
      $this->controller->breadcrumbs=BC::_($this->controller->id,$this->id,
    	     array('用户中心'=>array("user/index"),'增加抵用劵')
      );
	  $this->controller->pt($this->id,array());
    	return true;
    }
  
  protected function do_action(){
   $user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
   $model=new Coupon('ResumeCoupon');
   if(isset($_POST['Coupon'])){
   	$model->attributes=$_POST['Coupon'];
   	if($model->validate()){
   		$coupon_number=$_POST['Coupon']['coupon_number'];
   		$coupon_datas=$model->get_table_datas("",array('coupon_number'=>$coupon_number));
   		$coupon_price=$coupon_datas[0]['coupon_price'];
   		$coupon_id=$coupon_datas[0]['id'];
   		$coupon_desc="用户使用抵用劵";
   		$coupon_consume=new CouponConsume();
   		$result=$coupon_consume->insert_coupon_consume_datas($user_id,'1',$coupon_price,$coupon_desc,'1',$coupon_id);
   		if($result){
   			
   			$update_datas['coupon_status']='2';
   			$update_datas['user_time']=Util::current_time('timestamp');
   			$model->update_table_datas($coupon_id,$update_datas);
   		}
   	}
   }
   $user=new User();
   $user_datas=$user->get_table_datas($user_id);
   $this->display("add_coupon",array('model'=>$model,'user_datas'=>$user_datas));		
  }
 
 
    
}
?>
