<?php
class SearchconditionAction extends  BaseAction{
  
   protected function beforeAction(){
    if(Yii::app()->request->isAjaxRequest){
    	$this->controller->layout="none";
    	return true;
     }else{
     	return false;
     }
    }
  protected function do_action(){	
		 $trave_category=$_REQUEST['trave_category'];
		 $trave=new Trave();
		 if($trave_category=='2'||$trave_category=='4'){
		 	   $search_trave_category=$trave->get_search_trave_category($trave_category);
		 }
		 if($trave_category=='1'||$trave_category=='3'||$trave_category=='5'){
		 	 $search_trave_category=$trave->get_search_travel_region($trave_category);
		 }
		 echo json_encode($search_trave_category);
  }
}
?>
