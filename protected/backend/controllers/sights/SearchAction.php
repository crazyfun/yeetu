<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("景区管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Sights();
	  $sights_name=$_REQUEST['sights_name'];
		if(!empty($sights_name)){
			 $com_condition['变量名:w%']=$sights_name;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'sights_name'=>$sights_name));
  } 
}
?>
