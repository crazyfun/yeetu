<?php
class TypeEditAction extends BaseAction
{
	
	protected function do_action()
	{
		$this->controller->bc(array("帮助分类"=>array("help/type_index"),'编辑帮助分类'));
		$id = isset($_GET['id']) ? $_GET['id'] : $_POST['HelpType']['id'];
		
		$model = HelpType::model()->findByPk($id);
		
		if ($model === NULL) {
			$this->controller->redirect(array('add'));
		}
		
		if (isset($_POST['HelpType'])) {
			$model->attributes = $_POST['HelpType'];
			if ($model->save()) {
				$this->controller->sf('修改成功');
				$this->controller->redirect(array('type_edit', 'id'=>$model->id));
			} else {
				$this->controller->ff('修改失败');
			}
		}

		$this->display('type', array('model' => $model, 'action'=>$this->id));
	}
}
