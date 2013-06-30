<?php
class SearchAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     $this->controller->bc(array("咨询列表"));
     return true;
  }
  protected function do_action(){	
		$model=new TravelInfor();
		$information_title=$_REQUEST['information_title'];
		$create_name=$_REQUEST['create_name'];
		$information_theme=$_REQUEST['information_theme'];
		$information_recommend=$_REQUEST['information_recommend'];
		$model->information_title=$information_title;
		$com_condition['资讯名称:w%']=$information_title;
		$com_condition['发布人:w%']=$create_name;
		if(!empty($information_theme))
		   $com_condition['资讯主题:w%']=$model->get_infor_theme($information_theme);
		if(!empty($information_recommend)){
		  $com_condition['推荐:w%']="是";
	 }
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'com_condition_search'=>$com_condition_search,'create_name'=>$create_name,'information_theme'=>$information_theme,'information_recommend'=>$information_recommend));
  } 
}
?>
