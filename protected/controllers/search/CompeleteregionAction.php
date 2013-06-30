<?php
class CompeleteregionAction extends BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
      $query=$_GET['query'];
      $trave=new Trave();
			$trave_datas=$trave->findAll(
			array(
		      'select'=>'Distinct(t.trave_region) as trave_region ',
			    'condition'=>'t.trave_status=:trave_status',
			    'params'=>array(':trave_status'=>'2'),
			    'with'=>array('Region'=>array("select"=>'Region.district_name','condition'=>'Region.district_name LIKE :query','params'=>array(':query'=>'%'.$query.'%'),'together'=>true)),
			    'order'=>'t.id DESC',
			    'limit'=>'10',
			 
			));
	$suggestions=array();	
   foreach($trave_datas as $key => $value){
   	 array_push($suggestions,$value->Region->district_name);
   }
   $suggestions=array_unique($suggestions);
   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);
  }
 
 
    
}
?>
