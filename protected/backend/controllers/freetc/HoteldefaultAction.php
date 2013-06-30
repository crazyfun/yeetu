<?php
class HoteldefaultAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
  }
  protected function do_action(){	
    $trave_id=$_GET['trave_id'];
    $hotel_id=$_GET['hotel_id'];
    $trave=new Trave();
    $conditions['default_hotel']=$hotel_id;
    $trave->update_table_datas($trave_id,$conditions,array());
		$this->controller->redirect($this->controller->createUrl("freetc/travehotels",array('trave_id'=>$trave_id)));
  }  
}
?>
