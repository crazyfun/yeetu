<?php
class CompeleteflightAction extends BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
   $query=$_REQUEST['query'];
   $trave_flight=new TraveFlight();
   $trave_flight_datas=$trave_flight->findAll("go_flight LIKE '%$query%'",array());
   $suggestions=array();
   $datas=array();
   foreach($trave_flight_datas as $key => $value){
   	
   	$suggestions_data=$value->go_flight."(".$value->departure."->".$value->destinations.",".$value->go_flight_type.",".$value->go_flight_time.")";
   	array_push($suggestions,$suggestions_data);
   	$tem_array=array();
   	$tem_array['flight_id']=$value->id;
   	array_push($datas,$tem_array);
   }
   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);

		
  }
 
 
    
}
?>
