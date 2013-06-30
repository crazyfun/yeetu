<?php
class EditAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("邮件模版管理"=>array('emailtemplates/index'),'修改邮件模版'));
		$id = isset($_GET['id']) ? (int) $_GET['id'] : 
			(isset($_POST['EmailTemplates']['id']) ? (int) $_POST['EmailTemplates']['id'] : 0);
				
		if (empty($id) || (!$model = EmailTemplates::model()->findByPk($id))) {
			$this->controller->ff('没有找到该邮件模板');
			$this->controller->redirect(array('index'));
		}
		
		if (isset($_POST['EmailTemplates'])) {
			
			//禁止修改email_templates_name
			if (isset($_POST['EmailTemplates']['email_templates_name']))
				unset($_POST['EmailTemplates']['email_templates_name']);
			
				$model->attributes = $_POST['EmailTemplates'];
			
			if ($model->save()) {
				$this->controller->sf('邮件模板编辑成功');
				$this->controller->redirect(array('index', 'id'=>$model->id));
			} else {
				$this->controller->ff('邮件模板编辑失败');
			}
		}
		
		$this->display('email_templates', array('model' => $model));
		
	}
}