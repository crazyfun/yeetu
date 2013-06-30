<?php
class IndexAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->init_page();
    	return true;
    }
  protected function do_action(){	
  	   $trave_sregion=$_GET['trave_sregion'];
  	   $trave_region=$_GET['trave_region'];
  	   $trave_id=$_GET['trave_id'];
       $trave_area=new Travearea();
     
       $trave_area_datas=$trave_area->get_trave_area_op($trave_id);
       
       $json_array=array();
       foreach((array)$trave_area_datas as $key => $value){
       	 $tem_array=array();
       	 $tem_array['name']=$value;
       	 array_push($json_array,$tem_array);
       } 
       $json_trave_area_datas=json_encode($json_array);
		   $this->display('index',array('trave_sregion'=>$trave_sregion,'trave_region'=>$trave_region,'json_trave_area_datas'=>$json_trave_area_datas));
  }
 
 
    
}
?>
