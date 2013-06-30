<?php
class SearchregionAction extends  BaseAction{
  
   protected function beforeAction(){
    if(Yii::app()->request->isAjaxRequest){
    	$this->controller->layout="none";
    	return true;
     }else{
     	return false;
     }
    }
  protected function do_action(){	
  	 $search_condition=$_REQUEST['search_condition'];
  	 $trave_category=$_REQUEST['trave_category'];
		 $trave=new Trave();
		 $render_html=$this->controller->render("search_region",array('trave'=>$trave,'trave_category'=>$trave_category,'search_condition'=>$search_condition),"true");
		 echo $render_html;
  }
}
?>
