<?php
class CompeletetraveAction extends BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
   $query=$_GET['query'];
   $trave=new Trave();
   
		
	 $criteria=new CDbCriteria;
   $criteria->select='DISTINCT(t.trave_optimization)';
   $criteria->condition="(t.trave_optimization LIKE '%$query%') AND trave_status=:trave_status LIMIT 10";
   $criteria->params=array(':trave_status'=>'2');
   $trave_datas=$trave->findAll($criteria);
   $suggestions=array();
   $datas=array();
   foreach($trave_datas as $key => $value){
    
   	$trave_optimization_array=explode(',',$value->trave_optimization);
   	$trave_optimization="";
   	foreach((array)$trave_optimization_array as $key1 => $value1){
   		$pos=strpos($value1, $query);
   		if(is_bool($pos)&&!$pos){
   			continue;
   		}else{
   			$trave_optimization=$value1;
   		}
   	}
   	array_push($suggestions,$trave_optimization);
   }
   $suggestions=array_unique($suggestions);

   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);

  }
 
 
    
}
?>
