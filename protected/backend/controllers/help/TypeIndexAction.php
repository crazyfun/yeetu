<?php

class TypeIndexAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("帮助分类"));
		$type_name=$_REQUEST['type_name'];
		$model=new HelpType();
		$this->display('type_index', array('model' => $model,'type_name'=>$type_name));
	}
}
