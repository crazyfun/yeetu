<?php
class IndexAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("问答"));
		$this->display('index', array('model' => Question::model()));
	}
}