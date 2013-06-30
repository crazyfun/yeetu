<?php
class CreditAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		return true;
	}
	protected function do_action(){	
		$this->controller->bc(array("积分明细"));
		$user_login=$_REQUEST['user_login'];
		$credit_type=$_REQUEST['credit_type'];
		$credit_desc=$_REQUEST['credit_desc'];
		$create_time=$_REQUEST['create_time'];
		if(!empty($user_login)){
			$com_condition['用户名:w%']=$user_login;
		}
		if(!empty($credit_type)){
			$credit_type_values=CV::$CREDIT_TYPE;
			$com_condition['操作动作:w%']=$credit_type_values[$credit_type];
		}
		if(!empty($credit_desc)){
			$com_condition['操作描述:w%']=$credit_desc;
		}
		if(!empty($create_time)){
			$com_condition['创建时间:w%']=$create_time;
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$model=new Credit();
		$this->display('credit',array('model'=>$model,'com_condition_search'=>$com_condition_search,'user_login'=>$user_login,'credit_type'=>$credit_type,'credit_desc'=>$credit_desc,'create_time'=>$create_time));
	} 
}
?>
