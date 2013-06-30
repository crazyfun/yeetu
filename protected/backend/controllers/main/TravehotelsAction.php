<?php
class TravehotelsAction extends  BaseAction{
  
    public function beforeAction(){
    	if(Yii::app()->request->isAjaxRequest){
      	Util::reset_vars();
       	return true;
      }
    }
  
  protected function do_action(){
		$room_id=$_REQUEST['room_id'];
		$trave_id=$_REQUEST['trave_id'];
		$trave_route_number=$_REQUEST['trave_route_number'];
		$room_nums=$_REQUEST['room_nums'];
		$trave=new Trave();
		$trave_datas=$trave->get_table_datas($trave_id);
		$trave_hotels=$trave_datas->trave_hotels;
		$is_package=$trave_datas->is_package;
		if(empty($trave_route_number)){
			$trave_route_number=$trave_datas->trave_number-1;
		}
		$hotel_room=new HotelRoom();
    $criteria=new CDbCriteria;
    $criteria->select='t.id,t.hotel_id,t.room_name,t.room_bed,t.room_broadband,t.room_people,t.room_dinning,t.room_price,t.room_yprice';  // Ö»Ñ¡Ôñ 'title' ÁÐ
    $criteria->with=array('Hotels'=>array('select'=>'Hotels.hotel_name','condition'=>"FIND_IN_SET(Hotels.id,:trave_hotels)",'params'=>array('trave_hotels'=>$trave_hotels)));
    $hotel_room_datas=$hotel_room->findAll($criteria);
    if(!empty($hotel_room_datas))
		  $this->display_partial("order_hotels",array('hotel_room_datas'=>$hotel_room_datas,'trave_route_number'=>$trave_route_number,'room_nums'=>$room_nums,'room_id'=>$room_id,'is_package'=>$is_package));
	 
		
  }
 
 
    
}
?>
