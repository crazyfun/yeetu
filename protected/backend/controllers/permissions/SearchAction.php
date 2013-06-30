<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("系统变量设置"));
     return true;
  }
  protected function do_action(){	
		$model=new Permissions();
	  $permissions_name=$_REQUEST['permissions_name'];
		if(!empty($permissions_name)){
			 $com_condition['变量名:w%']=$permissions_name;
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'config_name'=>$permissions_name));
  } 
}
?>
