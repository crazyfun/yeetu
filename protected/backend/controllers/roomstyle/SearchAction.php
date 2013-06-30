<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("酒店房型管理"));
     return true;
  }
  protected function do_action(){	
		$model=new RoomStyle();
	  $room_style=$_REQUEST['room_style'];
		if(!empty($room_style)){
			 $com_condition['房型名:w%']=$room_style;
		}
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'room_style'=>$room_style));
  } 
}
?>
