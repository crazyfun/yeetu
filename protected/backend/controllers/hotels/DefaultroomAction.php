<?php
class DefaultroomAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
  }
  protected function do_action(){	
    $room_id=$_GET['room_id'];
    $is_default=$_GET['is_default'];
    $hotel_id=$_GET['hotel_id'];
    $hotel_room=new HotelRoom();
    $conditions['is_default']=$is_default;
    $hotel_room->update_table_datas($room_id,$conditions,array());
		$this->controller->redirect($this->controller->createUrl("hotels/room",array('hotel_id'=>$hotel_id)));
  }  
}
?>
