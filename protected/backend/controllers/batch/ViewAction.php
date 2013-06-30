<?php
class ViewAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("信息管理"=>array('batch/message'),'查看信息'));
		$model=new BatchMessage();
		$id=$_REQUEST['id'];
		if(empty($id)){
			return false;
		}
		$model=$model->get_table_datas($id);
		$this->display('view', array('model' => $model));
	}
}