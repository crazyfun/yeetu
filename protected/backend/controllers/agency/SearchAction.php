<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("旅行社管理"));
     return true;
  }
  protected function do_action(){	
		$model=new Agency();
		$agency_name=$_REQUEST['agency_name'];
		$agency_address=$_REQUEST['agency_address'];
		$agency_link=$_REQUEST['agency_link'];
		if(!empty($agency_name)){
			 $com_condition['旅游社:w%']=$agency_name;
		}
		if(!empty($agency_address)){
			$com_condition['旅行社地址:w%']=$agency_name;
		}
		if(!empty($agency_link)){
			$com_condition['联系人:w%']=$agency_link;
		}

		$com_condition_search=Util::com_search_condition($com_condition);

		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'agency_name'=>$agency_name,'agency_address'=>$agency_address,'agency_link'=>$agency_link));
  } 
}
?>
