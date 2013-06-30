<?php
class CompeletetraveAction extends BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
   $query=$_REQUEST['query'];
   $trave=new Trave();
   $trave_datas=$trave->findAll(array('condition'=>"trave_name LIKE '%$query%' AND trave_status=:trave_status AND recycle=:recycle",'params'=>array(':trave_status'=>'2',':recycle'=>'0'),'with'=>array('Sregion')));
   $suggestions=array();
   $datas=array();
   foreach($trave_datas as $key => $value){
   	array_push($suggestions,$value->trave_name."(".$value->Sregion->district_name.")");
   	$tem_array=array();
   	$tem_array['trave_id']=$value->id;
   	$tem_array['trave_category']=$value->trave_category;
   	$tem_array['trave_package']=$value->is_package;
   	array_push($datas,$tem_array);
   }
   $ajax_array=array('query'=>$query,'suggestions'=>$suggestions,'data'=>$datas);
   echo json_encode($ajax_array);

		
  }
 
 
    
}
?>
