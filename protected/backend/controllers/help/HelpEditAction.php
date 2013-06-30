<?php
class HelpEditAction extends BaseAction
{
	
	protected function do_action()
	{
		$this->controller->bc(array("帮助列表"=>array("help/index"),'修改帮助列表'));
		$id = isset($_GET['id']) ? (int)$_GET['id'] : (int)$_POST['Help']['id'];
		
		$model = Help::model()->findByPk($id);
		
		if ($model === NULL) {
			$this->controller->redirect(array('add'));
		}
		
		if (isset($_POST['Help'])) {
			$model->attributes = $_POST['Help'];
			if ($model->save()) {
				$this->controller->sf('帮助编辑成功');
				$this->controller->redirect(array('help_edit', 'id'=>$model->id));
			} else {
				$this->controller->ff('帮助编辑失败');
			}
		}

		$this->display('help', array('model' => $model, 'action'=>$this->id));
	}
}
