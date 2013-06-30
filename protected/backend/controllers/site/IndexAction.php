<?php
class IndexAction extends BaseAction{
	protected function beforeAction(){
        $this->controller->layout='main';
        return true;
    }
   protected function do_action(){
     if(Yii::app()->user->isGuest){
			$this->controller->redirect(array("site/login"));
		 }else {
			$this->display("index",array());
		}	
  }

}
?>