<?php
class EmailTemplatesController extends AController
{
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function actions()
	{
		$path = 'application.backend.controllers.emailtemplates.';
		return array(
			'index' => $path.'IndexAction',
			'edit' => $path.'EditAction',
			'add' => $path.'AddAction',
			'delete' => $path.'DeleteAction',
		);
	}
	
	public function init(){
		parent::init_page();
	}
	
	public function beforeAction($action)
	{
		$this->check_login("",CV::RETURN_ADMIN_INDEX);
		return parent::beforeAction($action);
	}
}
