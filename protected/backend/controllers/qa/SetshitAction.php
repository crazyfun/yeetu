<?php
class SetshitAction extends BaseAction
{
	protected function do_action()
	{
		$id = $_GET['id'] ? (int) $_GET['id'] : (int) $_POST['Answer']['id'];
		$shit_status=$_REQUEST['shit_status'];
		if (empty($id) || 
			(!$answer = Answer::model()->findByPk($id)) ||
			(!$question = $answer->question)) 
		{
			$this->controller->redirect(array('index'));
			return;
		}
		$page = $this->controller->get_page();
		$answer->id = $id;
		$answer->shit_status=$shit_status;
		if ($answer->save()) {
			$answer_id=$answer->user_id;
			$question_title=$question->subject;
			$credit=new Credit();
			if(!empty($shit_status)){
			 $credit_desc="设置回答问答:".$question_title."为乱回答,扣除积分";
       $credit->set_credit_vars($answer_id,"shit_answer",'2',$credit_desc);
      }
            		
			$this->controller->sf('设置乱回答成功');
			$this->controller->redirect(array('qa/view', 'id' => $question->id));
		} else {
			$this->controller->ff('设置乱回答失败');
			$this->controller->redirect(array('qa/view', 'id' => $question->id, 'page' => $page));
		}
	}
} 