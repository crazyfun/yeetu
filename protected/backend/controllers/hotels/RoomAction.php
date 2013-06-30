<?php
class RoomAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("酒店管理"=>array('hotels/index'),"酒店房型管理"));
      return true;
    }
  protected function do_action(){	
  	$hotel_id=$_REQUEST['hotel_id'];
  	
	  $model=new HotelRoom();
		$criteria=new CDbCriteria;
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.id ASC";
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>'hotel_id=:hotel_id',
			    'params'=>array(':hotel_id'=>$hotel_id),
			    'with'=>array(),
			),
			'pagination'=>array(
          'pageSize'=>'20',
      ),
      'sort'=>$sort,
		));
	
		$this->display('room',array('model'=>$model,'active_data_provider'=>$active_data_provider,'hotel_id'=>$hotel_id));
  }  
}
?>
