<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
	$id = $_GET['id'];
	if(empty($id)){
	  	$this->controller->bc(array("首页热景/主题管理"=>array('hotview/index'),"增加首页热景/主题"));	
	}else{
		$this->controller->bc(array("首页热景/主题管理"=>array('hotview/index'),"修改首页热景/主题"));
	}
	$model = empty($id) ? new HotView() : HotView::model()->findByPK($id);
  	if(isset($_POST['HotView'])){
		$model->attributes=$_POST['HotView'];
		if($model->validate() && $model->save()){
			$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}else{
			$this->controller->f(CV::FAILED_ADMIN_OPERATE);
		}
	}
		$this->display('add',array('model'=>$model));
  } 
}
?>
