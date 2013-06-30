<?php
class IndexAction extends BaseAction{
  protected function beforeAction(){
  	 $this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
     $this->controller->init_page();
     $this->controller->bc(array("论坛游记/攻略"));
     return true;
  }
  protected function do_action(){	
  	$model=new TraveThreads();
  	$trave_id=$_POST['trave_id'];
  	$trave_name=$_POST['trave_name'];
  	$title=$_POST['title'];
		$this->display('index',array('model'=>$model,'trave_id'=>$trave_id,'trave_name'=>$trave_name,'title'=>$title));
  } 
}
?>
