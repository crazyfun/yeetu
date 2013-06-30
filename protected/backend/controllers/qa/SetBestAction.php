<?php
class SetBestAction extends BaseAction
{
	protected function do_action()
	{
		$id = $_GET['id'] ? (int) $_GET['id'] : (int) $_POST['Answer']['id'];
		if (empty($id) || 
			(!$answer = Answer::model()->findByPk($id)) ||
			(!$question = $answer->question)) 
		{
			$this->controller->redirect(array('index'));
			return;
		}
		
		$page = $this->controller->get_page();
		
		$question->best_id = $answer->id;
		
		if (Question::UNSOLVED == $question->status) 
			$question->status = Question::SOLVED;
		if ($question->save()) {
			$answer_id=$answer->user_id;
			$question_title=$question->subject;
			$credit=new Credit();
			$credit_desc="设置问答:".$question_title."为最佳答案,赠送积分";
      $credit->set_credit_vars($answer_id,"set_best_answer",'1',$credit_desc);
            		
			$this->controller->sf('设置最佳答案成功');
			$this->controller->redirect(array('qa/view', 'id' => $question->id));
		} else {
			$this->controller->ff('设置最佳答案失败');
			$this->controller->redirect(array('qa/view', 'id' => $question->id, 'page' => $page));
		}
	}
} 