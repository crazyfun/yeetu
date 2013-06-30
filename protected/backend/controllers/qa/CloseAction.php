<?php
class CloseAction extends BaseAction
{
	protected function do_action()
	{
		$id = (int) $_GET['id'];
		if (empty($id) || 
			(!$question = Question::model()->findByPk($id)) || 
			Question::CLOSED == $question->status) 
		{
			$this->controller->redirect(array('index'));
			return;
		}
		
		//$page = $this->controller->get_page();
		
		$question->status = Question::CLOSED;
		if ($question->save()) {
			$this->controller->sf('关闭问题成功');
		} else {
			$this->controller->ff('关闭问题失败');
		}
		
		$this->controller->redirect(array('qa/index'));
	}
}