<?php
class EditpAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("短信管理"=>array('email/email'),'修改短信'));
		$model=new Batch();
		$id=$_REQUEST['id'];
		if(empty($_POST['Batch'])){
			if(!empty($id)){
				$model=$model->get_table_datas($id);
			}
		}else{
			$model=!empty($_POST['Batch']['id'])?$model->get_table_datas($_POST['Batch']['id']):$model;
	  	$model->attributes=$_POST['Batch'];
	  	$model->batch_type='2';
	  	if($model->validate()){
	  		$model->save();
	  		$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
	  	}
			
		}
		$this->display('edit', array('model' => $model));
	}
}