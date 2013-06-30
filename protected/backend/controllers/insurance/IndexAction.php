<?php
class IndexAction extends BaseAction
{
	protected function do_action()
	{   
		$this->controller->bc(array("保险管理"));
		$this->display('index', array('model'=> new Insurance()));
	}
}