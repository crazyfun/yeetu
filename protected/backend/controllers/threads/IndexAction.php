<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("论坛游记/攻略"));
     return true;
  }
  protected function do_action(){	
  	$model=new BbsThreads();
  	$bbs_type=$_POST['bbs_type'];
		$this->display('index',array('model'=>$model,'bbs_type'=>$bbs_type));
  } 
}
?>
