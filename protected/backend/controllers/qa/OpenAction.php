<?php
class OpenAction extends BaseAction
{
	protected function do_action()
	{
		$id = (int) $_GET['id'];
		if (empty($id) || 
			(!$question = Question::model()->findByPk($id)) || 
			Question::CLOSED != $question->status) 
		{
			$this->controller->redirect(array('index'));
			return;
		}
		
		if (0 != $question->best_id)
			$question->status = Question::SOLVED;
		else 
			$question->status = Question::UNSOLVED;
		
		if ($question->save()) {
			$this->controller->sf('开启问题成功');
		} else {
			$this->controller->ff('开启问题失败');
		}
		
		$this->controller->redirect(array('qa/index'));
	}
}