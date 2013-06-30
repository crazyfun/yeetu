<?php
class EditcreditAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		$user_id=$_REQUEST['id'];
		$model=new Credit();
		if(isset($_POST['Credit'])){
			$credit_value=$_POST['credit_value'];
			$model->attributes=$_POST['Credit'];
			$model->credit_value=$credit_value;
			$model->user_id=$user_id;

			$user_credit_model=new User();
			$user_credit_model=$user_credit_model->get_table_datas($user_id);
			$user_credit=$user_credit_model->credit;
			if($_POST['Credit']['credit_type']=='2'){
				if($user_credit < $credit_value){
					$error_credit="你输入的积分大于用户积分";
				}
			}

			if($model->validate()&&empty($error_credit)){
				$result=$model->insert_credit_consume_datas($user_id,$_POST['Credit']['credit_type'],$credit_value,$_POST['Credit']['credit_desc']);
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
		$this->display('edit_credit',array('model'=>$model,'user_id'=>$user_id,'credit_value'=>$credit_value,'user'=>$user_datas,'error_credit'=>$error_credit));
	} 
}
?>
