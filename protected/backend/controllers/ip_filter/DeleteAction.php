<?php
class DeleteAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
	$id = $_GET['id'];
	$model = IpFilter::model()->findByPK($id);
	if($model != null){
		$model->delete();
	}

	$this->controller->redirect(array("ip_filter/index"));
  } 
}
?>
