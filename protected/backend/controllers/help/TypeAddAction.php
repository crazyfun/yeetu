<?php

class TypeAddAction extends BaseAction
{
	
	protected function do_action()
	{
		$this->controller->bc(array("帮助分类"=>array("help/type_index"),'增加帮助分类'));
		$model=new HelpType;
		if(isset($_POST['HelpType']))
		{
			$model->attributes = $_POST['HelpType'];
			if ($model->save()) {
				$this->controller->sf('保存成功');
				$this->controller->redirect(array('type_edit', 'id'=>$model->id));
			} else {
				$this->controller->ff('保存失败');
			}
		}
		$this->display('type', array('model' => $model, 'action'=>$this->id));
	}
}