<?php
class EditAnswerAction extends BaseAction
{
	protected function do_action()
	{
		$this->controller->bc(array("问答"=>array('qa/index'),'编辑回答'));
		$id = $_GET['id'] ? (int) $_GET['id'] : (int) $_POST['Answer']['id'];
		if (empty($id) || (!$answer = Answer::model()->findByPk($id))) {
			$this->controller->redirect(array('index'));
			return;
		}
		
		$page = $this->controller->get_page();
			
		if ($_POST['Answer']) {
			$answer->attributes = $_POST['Answer'];
			if ($answer->save()) {
				$this->controller->sf('回答编辑成功');
				$this->controller->redirect(array(
					'qa/view', 
					'id'=>$answer->question_id,
					'page' => $page
				));
			} else {
				$this->controller->ff('回答编辑失败');
			}
		}
		
		$this->display('edit_answer', 
			array(
				'model' => $answer
			));
	}
}