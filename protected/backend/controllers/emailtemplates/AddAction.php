<?php
class AddAction extends BaseAction
{
	protected function do_action()
	{
		$model = new EmailTemplates();
        $this->controller->bc(array("邮件模版管理"=>array('emailtemplates/index'),'增加邮件模版'));
		if (isset($_POST['EmailTemplates'])) {
				$model->attributes = $_POST['EmailTemplates'];
				if ($model->save()) {
					$this->controller->sf('邮件模板添加成功');
					$this->controller->redirect(array('index', 'id'=>$model->id));
				} else {
					$this->controller->ff('邮件模板添加失败');
				}
		}
		
		$this->display('email_templates', array('model' => $model));
	}
}