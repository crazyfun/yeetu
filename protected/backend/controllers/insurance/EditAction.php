<?php
class EditAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("保险管理"=>array('insurance/index'),'修改保险'));
		$id = isset($_GET['id']) ? (int) $_GET['id'] : 
			(isset($_POST['Insurance']['id']) ? (int) $_POST['Insurance']['id'] : 0);
				
		if (empty($id) || (!$model = Insurance::model()->findByPk($id))) {
			$this->controller->ff('没有找到保险');
			$this->controller->redirect(array('index'));
		}
		
		if (isset($_POST['Insurance'])) {
				$model->attributes = $_POST['Insurance'];
			
			if ($model->save()) {
				$this->controller->sf('保险编辑成功');
				$this->controller->redirect(array('index', 'id'=>$model->id));
			} else {
				$this->controller->ff('保险编辑失败');
			}
		}
		
		$this->display('insurance', array('model' => $model));
		
	}
}