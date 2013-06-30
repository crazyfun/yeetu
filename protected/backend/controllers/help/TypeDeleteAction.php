<?php
class TypeDeleteAction extends BaseAction
{
	protected function do_action()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
		
		if (!empty($id)) {
			HelpType::model()->delete_by_ids($id);
		}
		
		$this->controller->redirect(array('type_index'));
	}
}