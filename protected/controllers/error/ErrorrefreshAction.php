<?php
class ErrorrefreshAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
    	return true;
    }
  protected function do_action(){	
		$this->display('error_refresh',array());
   	
  }
 
 
    
}
?>
