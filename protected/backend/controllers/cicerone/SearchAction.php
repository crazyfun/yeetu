<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("导游管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Cicerone();
	  $cicerone_name=$_REQUEST['cicerone_name'];
		if(!empty($cicerone_name)){
			 $com_condition['变量名:w%']=$cicerone_name;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'cicerone_name'=>$cicerone_name));
  } 
}
?>
