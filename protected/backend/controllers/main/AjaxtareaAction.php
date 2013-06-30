<?php
class AjaxtareaAction extends BaseAction{
  protected function beforeAction(){
  	if(Yii::app()->request->isAjaxRequest){
     Util::reset_vars();
     return true;
   }
  }
  protected function do_action(){	
		$trave_area=$_REQUEST['trave_area'];
		$trave_id=$_REQUEST['trave_id'];
		$trave_route=$_REQUEST['trave_route'];
		$travearea=new Travearea;
		$travearea->trave_id=$trave_id;
		$travearea->trave_area=$trave_area;
		$travearea->trave_status='1';
		$return=$travearea->insert_travearea();  
		$json_array=array();
		if(empty($return)){
			 $json_array['result']="N";
		}else{
			 $trave_area_op=$travearea->get_trave_area_op($trave_id);
			 $trave_area_select=array();
       $trave_area_default=explode(',',$trave_route);
			 $trave_area_select=UserHmtl::get_select_multiple_value("trave_route",$trave_area_op,$trave_area_default,"","","5");
			 $json_array['result']=$trave_area_select;
		}
	  echo json_encode($json_array);
 }
}
?>
