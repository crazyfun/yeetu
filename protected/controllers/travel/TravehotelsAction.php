<?php
class TravehotelsAction extends  BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
    $trave_id=$_REQUEST['trave_id'];
    $limit=$_REQUEST['limit'];
    $trave_date=strftime("%Y-%m-%d", strtotime($_REQUEST['trave_date']));
		$trave=new Trave();
    $trave_datas=$trave->get_table_datas($trave_id);
    $is_package=$trave_datas->is_package;
    $default_hotel=$trave_datas->default_hotel;
    $trave_select_hotels=$trave_datas->trave_hotels;
    $trave_route_number=intval($trave_datas->trave_route_number)-1;
		$trave_hotels=new Hotels();
   
		if(!empty($limit)){
			if(!empty($default_hotel)){
			 $condition['id']=$default_hotel;
			 $trave_hotels_datas=$trave_hotels->get_table_datas("",$condition);
			}else{
			  
			 $condition="FIND_IN_SET(id,:trave_hotels)>0";
			 $params=array(':trave_hotels'=>$trave_select_hotels);
			 $trave_hotels_datas=$trave_hotels->findAll(array('condition'=>$condition,'params'=>$params,'limit'=>'1'));
			}

		}else{

			$condition="FIND_IN_SET(id,:trave_hotels)>0";
			$params=array(':trave_hotels'=>$trave_select_hotels);
			$trave_hotels_datas=$trave_hotels->findAll($condition,$params);
		}
		
		
		if($is_package=='1'){
			$this->display_partial("hotels_package",array('trave_hotels_datas'=>$trave_hotels_datas,'trave_date'=>$trave_date,'trave_route_number'=>$trave_route_number));
		}else{
			$this->display_partial("hotels",array('trave_hotels_datas'=>$trave_hotels_datas,'trave_date'=>$trave_date,'trave_route_number'=>$trave_route_number));
		}
		
  }
 
 
    
}
?>
