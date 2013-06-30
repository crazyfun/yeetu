<?php
class EditcouponAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		$user_id=$_REQUEST['id'];
		$model=new CouponConsume();
		if(isset($_POST['CouponConsume'])){
			$coupon=$_POST['coupon'];
			$model->attributes=$_POST['CouponConsume'];
			$model->coupon_value=$coupon;
			$model->user_id=$user_id;

			$user_coupon_model=new User();
			$user_coupon_model=$user_coupon_model->get_table_datas($user_id);
			$user_coupon=$user_coupon_model->coupon;

			if($_POST['CouponConsume']['coupon_type']=='2'){
				if($user_coupon < $coupon){
					$error_coupon="你输入的抵用劵大于用户抵用劵";
				}
			}
			if($model->validate()&&empty($error_coupon)){
				$result=$model->insert_coupon_consume_datas($user_id,$_POST['CouponConsume']['coupon_type'],$coupon,$_POST['CouponConsume']['coupon_desc']);
				if($result){
					$this->controller->redirect($this->controller->createUrl('user/index'));
				}else{
					$this->controller->f(CV::FAILED_ADMIN_OPERATE);
				}
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		}
		if(!empty($user_id)){
			$user_model=new User();
			$user_datas=$user_model->get_table_datas($user_id,array());
		}
		$this->display('edit_coupon',array('model'=>$model,'user_id'=>$user_id,'coupon'=>$coupon,'user'=>$user_datas,'error_coupon'=>$error_coupon));
	} 
}
?>
