<?php
class ViewAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }

  protected function do_action(){	
  
   	
  }
 
 
    
}
?>
