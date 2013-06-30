<?php
class ThemeAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("咨询分类"));
     return true;
  }
  protected function do_action(){	
  	$model=new InforTheme();
		$this->display('theme',array('model'=>$model));
  } 
}
?>
