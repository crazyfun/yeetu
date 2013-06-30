<?php
class AddroomAction extends BaseAction{
  protected $hotel_id="";
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->hotel_id=$_REQUEST['hotel_id'];
    	$this->controller->init_page();
    
      return true;
    }
  protected function do_action(){	
  	$id=$_REQUEST['id'];
  	$model=new HotelRoom();
		if(isset($_POST['HotelRoom'])){
			 	$this->controller->bc(array("酒店管理"=>array('hotels/index'),"增加酒店房型"));
			 if(!empty($_POST['HotelRoom']['id'])){
			 	$model=$model->get_table_datas($_POST['HotelRoom']['id']);
			 }
			 $model->attributes=$_POST['HotelRoom'];
			 $model->id=$_POST['HotelRoom']['id'];
             $model->hotel_id=$_POST['HotelRoom']['hotel_id'];
       
      if($model->validate()){
			  if($model->insert_hotel_room()){
			    $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }else{
			  	$this->controller->f(CV::ERROR_ADMIN_DATABASE);
			  }
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		 $this->display('add_room',array('model' => $model));
		}else{	  
		if(!empty($id)){
			 $this->controller->bc(array("酒店管理"=>array('hotels/index'),"修改酒店房型"));
			 $model=$model->get_table_datas($id,array());
		}else{
	        $this->controller->bc(array("酒店管理"=>array('hotels/index'),"增加酒店房型"));
			$model->hotel_id=$this->hotel_id;
		}
		$this->display('add_room',array('model'=>$model));
		}
      
	  
	  
	 
  }  
}
?>
