<?php
class ImportpEditAction extends BaseAction
{
	 protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
	protected function do_action(){
		$model=new ImportPhone();
		$id=$_REQUEST['id'];
		if(empty($_POST['ImportPhone'])){
			if(!empty($id)){
				$model=$model->get_table_datas($id);
			}
		}else{
			$model=!empty($_POST['Batch']['id'])?$model->get_table_datas($_POST['ImportPhone']['id']):$model;
	  	$model->attributes=$_POST['ImportPhone'];
	  	if($model->validate()){
	  		$model->save();
	  		$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
	  	}
		}
		$this->display('edit_import_phone', array('model' => $model));
	}
}