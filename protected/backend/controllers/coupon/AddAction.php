<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Coupon('AddCoupon');
  	if(isset($_POST['Coupon'])){
  		$this->controller->bc(array("抵用劵管理"=>array('coupon/index'),'增加抵用劵'));
  		if(!empty($_POST['Coupon']['id'])){
  			$model=$model->get_table_datas($_POST['Coupon']['id']);
  		}
  		$model->setScenario('AddCoupon');
			$model->id=$_POST['Coupon']['id'];
			$model->attributes=$_POST['Coupon'];
			if(empty($_POST['Coupon']['id'])){
			    $model->coupon_status='1';
			}
			if($model->validate()){
			  $model->insert_coupon();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("抵用劵管理"=>array('coupon/index'),'修改抵用劵'));
			 	$model=$model->get_table_datas($id,array());
			}else{
			    $this->controller->bc(array("抵用劵管理"=>array('coupon/index'),'增加抵用劵'));	
			}
		}
		$this->display('add',array('model'=>$model));
  } 
}
?>
