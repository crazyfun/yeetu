<?php

class HelpAddAction extends BaseAction
{
	
	protected function do_action()
	{
		$this->controller->bc(array("帮助列表"=>array("help/index"),'增加帮助列表'));
		$model=new Help;
		if(isset($_POST['Help']))
		{
			
			$model->attributes = $_POST['Help'];
			if ($model->save()) {
				$this->controller->sf('保存成功');
				$this->controller->redirect(array('help_edit', 'id'=>$model->id));
			} else {
				$this->controller->ff('保存失败');
			}
		}
		$this->display('help', array('model' => $model, 'action'=>$this->id));
	}
}