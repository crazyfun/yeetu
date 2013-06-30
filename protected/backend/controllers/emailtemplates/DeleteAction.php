<?php
class DeleteAction extends BaseAction
{
	protected function do_action()
	{
		$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
		
		if (empty($id) || (!$model = EmailTemplates::model()->findByPk($id))) {
			$this->controller->ff('没有找到该邮件模板');
			$this->controller->redirect(array('index'));
		}
		
		if ($model->delete()) 
			$this->controller->sf('删除邮件模板成功');
		else
			$this->controller->ff('删除邮件模板失败');
		
		$this->controller->redirect(array('index'));
	}
}