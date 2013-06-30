<?php
class IndexAction extends BaseAction
{
	protected function do_action()
	{   
		$this->controller->bc(array("邮件模版管理"));
		$email_templates=new EmailTemplates();
		$this->display('index', array('model'=>$email_templates));
	}
}