<?php
class AdddistrictAction extends BaseAction{
  
 protected function beforeAction(){
    $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    $this->controller->init_page();
    $this->controller->bc(array("线路区域"=>array('district/index'),'增加线路区域'));
    return true;
  }
  protected function do_action(){	
    $model=new District;
		if(isset($_POST['District'])){
			if(!empty($_POST['District']['id'])){
				$model=$model->get_table_datas($_POST['District']['id']);
			}
			$model->id=$_POST['District']['id'];
			$model->attributes=$_POST['District'];
			$model->parent_id=$_POST['parent_id'];
			$model->district_category=$_POST['district_category'];
			if($model->validate()){
			  $model->insert_district();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
		  	$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		 }
		 $this->display('add_district',array('model' => $model));
  }  
}
?>
