<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("酒店管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Hotel();
	  $hotel_name=$_REQUEST['hotel_name'];
		if(!empty($hotel_name)){
			 $com_condition['变量名:w%']=$hotel_name;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'sights_name'=>$hotel_name));
  } 
}
?>
