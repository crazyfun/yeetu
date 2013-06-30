<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new Ad();
  	if(isset($_POST['Ad'])){
  		$this->controller->bc(array("广告位管理"=>array('ad/index'),"增加广告位"));
  		if(!empty($_POST['Ad']['id'])){
  			$model=$model->get_table_datas($_POST['Ad']['id']);
  		}
  		$ad_sregion_id=$_POST['ad_sregion_id'];
			$model->id=$_POST['Ad']['id'];
			$model->attributes=$_POST['Ad'];
			
			if($model->validate()){
			  $model->insert_ad();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("广告位管理"=>array('ad/index'),"修改广告位"));
			 	$model=$model->get_table_datas($id,array());
			}else{
		    	$this->controller->bc(array("广告位管理"=>array('ad/index'),"增加广告位"));	
			}
		}
		$this->display('add',array('model'=>$model));
  }
}
?>
