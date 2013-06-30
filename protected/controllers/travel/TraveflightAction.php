<?php
class TraveflightAction extends  BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
    $trave_id=$_REQUEST['trave_id'];
    $trave_date=$_REQUEST['trave_date'];
    $std_value=$_REQUEST['std_value'];
    $std_value=strftime("%Y-%m-%d", strtotime($std_value)); 
    $trave_date_class=new Travedate();
    $trave_date_datas=$trave_date_class->get_table_datas($trave_date,array());
    $flight_id=$trave_date_datas->flight_id;
    $back_flight_id=$trave_date_datas->back_flight_id;
    $flight_price=$trave_date_datas->flight_price;
    
		$trave_flight=new TraveFlight();
		$trave_flight_datas=$trave_flight->get_table_datas($flight_id,array());
		$back_trave_flight_datas=$trave_flight->get_table_datas($back_flight_id,array());
		
		$trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id,array());
		$is_package=$trave_datas->is_package;
		if($is_package=='1'){
		   $this->display_partial("flight_package",array('trave_flight'=>$trave_flight,'trave_flight_datas'=>$trave_flight_datas,'back_trave_flight_datas'=>$back_trave_flight_datas,'trave_date'=>$std_value,'trave_id'=>$trave_id,'flight_price'=>$flight_price));
		}else{
			 $this->display_partial("flight",array('trave_flight'=>$trave_flight,'trave_flight_datas'=>$trave_flight_datas,'back_trave_flight_datas'=>$back_trave_flight_datas,'trave_date'=>$std_value,'trave_id'=>$trave_id,'flight_price'=>$flight_price));

		}
		
  }
 
 
    
}
?>
