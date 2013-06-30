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
   $criteria->select='DISTINCT(t.trave_name)';
   $criteria->condition="(t.trave_name LIKE '%$query%' OR t.trave_optimization LIKE '%$query%' OR t.trave_title LIKE '%$query%' ) AND trave_status=:trave_status LIMIT 10";
   $criteria->params=array(':trave_status'=>'2');
   $trave_datas=$trave->findAll($criteria);
   $suggestions=array();
   $datas=array();
   foreach($trave_datas as $key => $value){
   	array_push($suggestions,$value->trave_name);
   }

   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);

  }
 
 
    
}
?>
