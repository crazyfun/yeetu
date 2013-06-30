<?php
class SiteController extends AController
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
  public function filters() {
		return array(
		  'accessControl', // perform access control for CRUD operations
		);
	}
	
	
 public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
		  ),
		  'index'=>'application.backend.controllers.site.IndexAction',
		  'imagecode'=>'application.backend.controllers.site.ImagecodeAction',
		  'error'=>'application.backend.controllers.site.ErrorAction',
		  'login'=>'application.backend.controllers.site.LoginAction',
		  'logout'=>'application.backend.controllers.site.LogoutAction',
		  'error403'=>'application.backend.controllers.site.Error403Action',
		  'default'=>'application.backend.controllers.site.DefaultAction',
			
		);
	}
	
	function init_none(){
		$this->layout="none";
		Util::reset_vars();
	}
}
