<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("车队管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Motorcade();
	  $motorcade_name=$_REQUEST['motorcade_name'];
		if(!empty($motorcade_name)){
			 $com_condition['车队名称:w%']=$motorcade_name;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'motorcade_name'=>$motorcade_name));
  } 
}
?>
