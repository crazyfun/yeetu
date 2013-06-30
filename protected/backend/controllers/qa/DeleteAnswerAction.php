<?php
class DeleteAnswerAction extends BaseAction
{
	protected function do_action()
	{
		$ids = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];	
		if (!empty($ids)) {
			$ids = array_map('intval', (array) $ids);
			$answer_data = Answer::model()->findAll(array(
				'select' => 't.id',
				'with' => array('question'=> array('select'=>'id, best_id, status')),
				'condition' => ' t.id IN (:ids) ', 
				'params' => array(':ids' => implode(', ', $ids))
			));
			
			foreach($answer_data as $answer) {
				$answer->delete();
			}
			$this->controller->sf('回答删除成功');
			$this->controller->redirect(array('qa/view', 'id'=>$_GET['q_id']));
			return;
		}
		
		$this->controller->redirect(array('qa/index'));
	}
}