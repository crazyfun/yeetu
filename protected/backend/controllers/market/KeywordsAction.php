<?php
class KeywordsAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("搜索关键字维护"));
     return true;
  }
  protected function do_action(){	
  	$model=new SearchKeywords();
  	$search_content=$_REQUEST['search_content'];
    $search_ip=$_REQUEST['search_ip'];
		$this->display('keywords',array('model'=>$model,'search_content'=>$search_content,'search_ip'=>$search_ip));
  } 
}
?>
