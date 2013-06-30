<?php
class SurveyAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("在线调查"));
     return true;
  }
  protected function do_action(){	
  	$model=new OnlineSurvey();
  	$survey_type=$_REQUEST['survey_type'];
    $remote_ip=$_REQUEST['remote_ip'];
		$this->display('survey',array('model'=>$model,'survey_type'=>$survey_type,'remote_ip'=>$remote_ip));
  } 
}
?>
