<?php
class HelpController extends AController
{
	public $layout = 'none';
	
	public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	
	public function actions()
	{
		$path = 'application.backend.controllers.help.';
		return array(
			'index' => $path.'HelpIndexAction',
			'help_add' => $path.'HelpAddAction',
			'help_edit' => $path.'HelpEditAction',
			'help_delete' => $path.'HelpDeleteAction',
			'type_index'=>$path.'TypeIndexAction',
			'type_add'=>$path.'TypeAddAction',
			'type_edit'=>$path.'TypeEditAction',
			'type_delete'=>$path.'TypeDeleteAction',
		);
	}
	
	public function init() {
		parent::init_page();
	}
	
	protected function beforeAction($action) {
		$this->check_login("",CV::RETURN_ADMIN_INDEX);
		return parent::beforeAction($action);
	}
}
