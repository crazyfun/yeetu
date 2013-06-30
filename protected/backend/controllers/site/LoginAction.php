<?php
class LoginAction extends BaseAction{

	protected function beforeAction(){
        $this->controller->layout='/layouts/login';
        return true;
    }
   protected function do_action(){	
   	
    $ts = time();
		$model=new User("AdminLogin");
		// collect user input data
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->admin_login()){
			  //Yii::app()->session->add('permissions_type','59');
				$this->controller->redirect(array('site/index'));
			}
		}
		// display the login form
		$this->display('login',array('model'=>$model,'ts'=>$ts));
  
  }
  
  

}
?>
