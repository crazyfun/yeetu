<?php
class Error404Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->layout='none';
        return true;
    }
   protected function do_action(){
	      $this->display('error_404', array());
  }
}
?>
