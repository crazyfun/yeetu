<?php
class CancelBestAction extends BaseAction
{
	protected function do_action()
	{
		$id = $_GET['id'] ? (int) $_GET['id'] : (int) $_POST['Answer']['id'];
		if (empty($id) || 
			(!$answer = Answer::model()->findByPk($id)) || (!$question = $answer->question)) 
		{
			$this->controller->redirect(array('index'));
			return;
		}
		$page = $this->controller->get_page();
		$question->best_id = 0;
		if (Question::SOLVED == $question->status) 
			$question->status = Question::UNSOLVED;
		if ($question->save()) {
			$answer_id=$answer->user_id;
			$question_title=$question->subject;
			$credit=new Credit();
			$credit_desc="取消问答:".$question_title."为最佳答案,扣除积分";
      $credit->set_credit_vars($answer_id,"set_best_answer",'2',$credit_desc);
			$this->controller->sf('取消最佳答案成功');
			$this->controller->redirect(array('qa/view', 'id' => $question->id));
		} else {
			$this->controller->ff('取消最佳答案失败');
			$this->controller->redirect(array('qa/view', 'id' => $question->id, 'page' => $page));
		}
	}
}