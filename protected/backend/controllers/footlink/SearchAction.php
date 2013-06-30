<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("底部连接"));
     return true;
  }
  protected function do_action(){	
		$model=new Footlink();
	  $footlink_name=$_REQUEST['footlink_name'];
		if(!empty($footlink_name)){
			 $com_condition['变量名:w%']=$footlink_name;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'footlink_name'=>$footlink_name));
  } 
}
?>
