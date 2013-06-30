<?php
class EditQuestionAction extends BaseAction
{
	protected function do_action() 
	{
		$this->controller->bc(array("问答"=>array('qa/index'),'编辑问答'));
		$id = $_GET['id'] ? (int) $_GET['id'] : (int) $_POST['Question']['id'];
		if (empty($id) || (!$question = Question::model()->findByPk($id))) {
			$this->controller->redirect(array('index'));
			return;
		}
		
		if ($_POST['Question']) {
			$question->attributes = $_POST['Question'];
			if ($question->save()) {
				$this->controller->sf('问题编辑成功');
				$this->controller->redirect(array('qa/view', 'id'=>$question->id));
			} else {
				$this->controller->ff('问题编辑失败');
			}
		}
		
		$categories = QuestionCategory::model()->get_all_categories();
		
		$this->display('edit_question', 
			array(
				'model' => $question,
				'categories' => $categories,
			));
	}
}