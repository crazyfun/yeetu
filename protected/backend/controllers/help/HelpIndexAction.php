<?php

class HelpIndexAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("帮助列表"));
		$help_type=$_REQUEST['help_type'];
		$title=$_REQUEST['title'];
		$type_id = isset($_GET['type_id']) ? $_GET['type_id'] : $_POST['type_id'];
		$model=new Help;
		if($type_id)
			$model->type_id = $type_id;
		
		$this->display('help_index', array('model' => $model,'help_type'=>$help_type,'title'=>$title));
	}
}