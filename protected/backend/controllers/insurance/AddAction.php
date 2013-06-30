<?php
class AddAction extends BaseAction
{
	protected function do_action()
	{
		$model = new Insurance();
        	$this->controller->bc(array("保险管理"=>array('insurance/index'),'增加保险'));
		if (isset($_POST['Insurance'])) {
				$model->attributes = $_POST['Insurance'];
				if ($model->save()) {
					$this->controller->sf('保险添加成功');
					$this->controller->redirect(array('index', 'id'=>$model->id));
				} else {
					$this->controller->ff('保险添加失败');
				}
		}
		
		$this->display('insurance', array('model' => $model));
	}
}