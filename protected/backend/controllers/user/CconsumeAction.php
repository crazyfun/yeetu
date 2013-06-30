<?php
class CconsumeAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		$this->controller->bc(array("抵押券明细"));

		$user_login=$_REQUEST['user_login'];
		$coupon_type=$_REQUEST['coupon_type'];
		$coupon_desc=$_REQUEST['coupon_desc'];
		$coupon_category=$_REQUEST['coupon_category'];
		$coupon_number=$_REQUEST['coupon_number'];
		$create_time=$_REQUEST['create_time'];
		if(!empty($user_login)){
			$com_condition['用户名:w%']=$user_login;
		}
		if(!empty($coupon_type)){
			$coupon_type_values=CV::$CREDIT_TYPE;
			$com_condition['操作动作:w%']=$coupon_type_values[$coupon_type];
		}
		if(!empty($coupon_desc)){
			$com_condition['操作描述:w%']=$coupon_desc;
		}
		if(!empty($coupon_category)){
			$coupon_category_datas=CV::$COUPON_CATEGORY;
			$com_condition['消费类型:w%']=$coupon_category_datas[$coupon_category];
		}
		if(!empty($coupon_number)){
			$com_condition['抵用劵:w%']=$coupon_number;
		}
		if(!empty($create_time)){
			$com_condition['创建时间:w%']=$create_time;
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$model=new CouponConsume();
		$this->display('coupon_consume',array('model'=>$model,'com_condition_search'=>$com_condition_search,'user_login'=>$user_login,'coupon_type'=>$coupon_type,'coupon_desc'=>$coupon_desc,'coupon_category'=>$coupon_category,'coupon_number'=>$coupon_number,'create_time'=>$create_time));
	} 
}
?>
