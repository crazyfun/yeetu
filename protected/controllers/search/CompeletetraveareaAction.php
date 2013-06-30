<?php
class CompeletetraveareaAction extends BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
   $query=$_GET['query'];
   $travearea=new Travearea();
   
		
	 $criteria=new CDbCriteria;
   $criteria->select='DISTINCT(t.trave_area)';
   $criteria->condition="(t.trave_area LIKE '%$query%') AND trave_status=:trave_status LIMIT 10";
   $criteria->params=array(':trave_status'=>'1');
   $travearea_datas=$travearea->findAll($criteria);
   $suggestions=array();
   $datas=array();
   foreach($travearea_datas as $key => $value){

   	 array_push($suggestions,$value->trave_area);
   }

   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);

  }
 
 
    
}
?>
