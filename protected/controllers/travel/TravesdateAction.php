<?php
class TravesdateAction extends  BaseAction{
  
    protected function beforeAction(){
      if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }else{
      	return false;
      }
    	
    }
  
  protected function do_action(){
      $trave_id=$_REQUEST['trave_id'];
			$trave_date_datas=$this->controller->get_trave_details_prices($trave_id);
			echo $trave_date_datas;
  }
 
 
    
}
?>
