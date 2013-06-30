<?php
class DeleteroomAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }
  protected function do_action(){	
    $model=new HotelRoom();
		$id=$_REQUEST['id'];
		$hotel_id=$_REQUEST['hotel_id'];
		if(!empty($id)){
			if(is_array($id)){
				foreach($id as $key => $value){
					$model->delete_table_datas($value);
				}
			}else{
			  $model->delete_table_datas($id);
			}
		}
		$this->controller->redirect($this->controller->createUrl("hotels/room?hotel_id=$hotel_id",array()));
  }  
}
?>
