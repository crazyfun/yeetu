<?php
class ProcessAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
		$model=new GroupCustomize();
		$id=$_REQUEST['id'];
		if(!empty($id)){
			$update_datas['status']='2';
			$update_datas['operate_id']=Yii::app()->user->id;
			$update_datas['operate_time']=Util::current_time('timestamp');
			$model->update_table_datas($id,$update_datas);
		}
		$this->controller->redirect($this->controller->createUrl("gcustomize/index",array()));
  } 
}
?>
