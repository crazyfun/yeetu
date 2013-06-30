<?php
class ViewAction extends BaseAction {
	public function do_action() 
	{
		$this->controller->bc(array("问答"=>array('qa/index'),'查看问答'));
		$id = (int) $_GET['id'];
		if (empty($id) || !($question = Question::model()->findByPk($id))) {
			$this->controller->redirect(array('index'));
			return;
		}
		
		$page = (int) $_GET['page'];
		if (empty($page))
			$page = 1;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
 
  	
		$answer_data_provider = new CActiveDataProvider(
			Answer,
			array(
				'criteria' => array(
					'condition' => 'question_id = :question_id AND id != :id',
					//'order' => 'create_time DESC',
					'params' => array(':question_id' => $question->id, ':id' => $question->best_id),
				),
				'pagination' => array(
					'pageSize' => 20,
					'pageVar' => 'page',
				),
				'sort'=>$sort,
			)
		);
		
		$this->display('view', array(
			'question' => $question, 
			'answer_data_provider' => $answer_data_provider,
			'page' => $page,
		));
	}
}
