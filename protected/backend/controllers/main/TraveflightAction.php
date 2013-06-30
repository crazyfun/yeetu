<?php
class TraveflightAction extends  BaseAction{
  
    public function beforeAction(){
      	Util::reset_vars();
       	return true;
    }
  
  protected function do_action(){
    $trave_id=$_REQUEST['trave_id'];
    $date_key=$_REQUEST['date_key'];

    $trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id);
		$is_package=$trave_datas->is_package;
		
		$trave_date_class=new Travedate();
    $trave_date_datas=$trave_date_class->find(array('condition'=>'id=:id AND trave_id=:trave_id','params'=>array(':id'=>$date_key,':trave_id'=>$trave_id)));
    $flight_id=$trave_date_datas->flight_id;
    $back_flight_id=$trave_date_datas->back_flight_id;
    $flight_price=$trave_date_datas->flight_price;
		$trave_flight=new TraveFlight();
		$trave_flight_datas=$trave_flight->get_table_datas($flight_id,array());
		$back_trave_flight_datas=$trave_flight->get_table_datas($back_flight_id,array());
    if(!empty($trave_flight_datas))
		   $this->display_partial("order_flight",array('trave_flight'=>$trave_flight,'trave_flight_datas'=>$trave_flight_datas,'back_trave_flight_datas'=>$back_trave_flight_datas,'trave_date'=>$trave_date,'trave_id'=>$trave_id,'flight_price'=>$flight_price,'flight_id'=>$flight_id,'is_package'=>$is_package));

  }
 
 
    
}
?>
