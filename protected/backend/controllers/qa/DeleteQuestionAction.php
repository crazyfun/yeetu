<?php
class DeleteQuestionAction extends BaseAction
{
	protected function do_action()
	{
		$ids = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
		if (!empty($ids)) {
			$ids = array_map('intval', (array) $ids);
			if ($num = Question::model()->deleteAll(' id IN (:ids) ', 
				array(':ids' => implode(', ', $ids))))
			{
				$this->controller->sf('已删除' . $num . '个问题');
				Answer::model()->delete_by_quesionIds($ids);
			}
		}
		$this->controller->redirect(array('index'));
	}
}
