<?php
class HelpDeleteAction extends BaseAction
{
	protected function do_action()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
		if (!empty($id)) {
			$id = array_map('intval', (Array) $id);
			Help::model()->deleteAll('id in (:id)',
				array(':id' => implode(',', $id))
			);
		}
		
		$this->controller->redirect(array('index'));
	}
}