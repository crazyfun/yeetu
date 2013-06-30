<?php
class CompeletesuppliersAction extends BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
   $query=$_REQUEST['query'];
   $agency=new Agency();
   $agency_datas=$agency->findAll("agency_name LIKE '%$query%'",array());
   $suggestions=array();
   $datas=array();
   foreach($agency_datas as $key => $value){
   	array_push($suggestions,$value->agency_name);
   	$tem_array=array();
   	$tem_array['id']=$value->id;
   	array_push($datas,$tem_array);
   }
   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);

		
  }
 
 
    
}
?>
