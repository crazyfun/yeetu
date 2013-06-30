<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
	$id = $_GET['id'];
	if(empty($id)){
	   	$this->controller->bc(array("限制IP"=>array('ip_filter/index'),"增加限制IP"));	
	}else{
		$this->controller->bc(array("限制IP"=>array('ip_filter/index'),"修改限制IP"));
	}
	$model = empty($id) ? new IpFilter() : IpFilter::model()->findByPK($id);
  	if(isset($_POST['IpFilter'])){
		$expire_time = $_REQUEST['expire_time'];
		$ip_address = $_POST['IpFilter']['ip_address'];
		$_POST['IpFilter']['expire_time'] = strtotime($expire_time);
		
	//	$check_model = new IpFilter();
	//	if(!$check_model->check_repeat_ip($ip_address,$id)){
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
	//	}else{
			$model->attributes=$_POST['IpFilter'];
			if($model->validate() && $model->save()){
				$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
	//	}
	}
	$this->display('add',array('model'=>$model));
  } 
}
?>
