<?php 
class QaController extends AController {
    public $layout='none';

  public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	
    public function actions(){
    	$actionPath = 'application.backend.controllers.qa.';
        return array(
        	'open' => $actionPath . 'OpenAction',
        	'close' => $actionPath . 'CloseAction',
        	'cancel_best' => $actionPath . 'CancelBestAction',
        	'set_best' => $actionPath . 'SetBestAction',
        	'setshit' => $actionPath.'SetshitAction',
        	'edit_answer' => $actionPath . 'EditAnswerAction',
        	'edit_question' => $actionPath .'EditQuestionAction',
        	'delete_question' => $actionPath .'DeleteQuestionAction',
        	'delete_answer' => $actionPath .'DeleteAnswerAction',
		 	'index'=> $actionPath . 'IndexAction',
			'search'=> $actionPath . 'SearchAction',
        	'view'=> $actionPath . 'ViewAction',
        	'shitquestion' => $actionPath.'ShitquestionAction',
         );
    }
    
	public function init() {
		parent::init_page();
	}
	
	protected function beforeAction($action) {
		$this->check_login("",CV::RETURN_ADMIN_INDEX);
		return parent::beforeAction($action);
	}
	
	public function get_page()
	{
		$page = (int) $_GET['page'];
		if (empty($page))
			$page = 1;
		return $page;
	}
}
?>
