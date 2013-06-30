<?php
class AddAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }
  protected function do_action(){	
  	$id=$_REQUEST['id'];
		$model=new Hotels();
		$hotel_city_name="";
		if(!empty($id)){
			 $this->controller->bc(array("酒店管理"=>array('hotels/index'),'修改酒店'));
			 $model=$model->get_table_datas($id,array());
			  //显示线路区域分类和线路类别选择
			 $hotel_city=$model->hotel_city;
			 $hotel_city_name=$model->get_hotel_city($hotel_city);
		}else{
		     $this->controller->bc(array("酒店管理"=>array('hotels/index'),'增加酒店'));	
		}
		$this->display('add_hotel',array('model'=>$model,'hotel_city_name'=>$hotel_city_name));
  }  
}
?>
