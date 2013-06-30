<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("在线咨询"));
     return true;
  }
  protected function do_action(){	
		$model=new Consulting();
    $consulting_title=$_REQUEST['consulting_title'];
	  $trave_name=$_REQUEST['trave_name'];
    $create_name=$_REQUEST['create_name'];
    $reply_name=$_REQUEST['reply_name'];
		$com_condition['线路名称:w%']=$trave_name;
		$com_condition['咨询内容/回复内容:w%']=$consulting_title;
		$com_condition['咨询人:w%']=$create_name;
		$com_condition['回复人:w%']=$reply_name;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'trave_name'=>$trave_name,'consulting_title'=>$consulting_title,'create_name'=>$create_name,'reply_name'=>$reply_name));
  } 
}
?>
