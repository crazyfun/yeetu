<?php
class SearchthAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("国内机+酒店"=>array('nianhui/index'),"增加国际机+酒店酒店"));
      return true;
    }
  protected function do_action(){	
	  $model=new Hotels();
		//搜索
		$hotel_name=$_REQUEST['hotel_name'];
		$hotel_city=$_REQUEST['hotel_city_id'];
		$trave_id=$_REQUEST['trave_id'];
		$trave=new Trave();
  	$trave_datas=$trave->get_table_datas($trave_id);
  	$trave_hotels=$trave_datas->trave_hotels;
  	$trave_name=$trave_datas->trave_name;
		$condition=array();
		$params=array();
		$page_params=array();
		if(!empty($hotel_name)){
			array_push($condition,"(t.hotel_name LIKE :hotel_name)");
			$params[':hotel_name']="%$hotel_name%";
			$page_params['hotel_name']=$hotel_name;
		}
		if(!empty($hotel_city)){
			array_push($condition,"t.hotel_city=:hotel_city");
			$params[':hotel_city']=$hotel_city;
			$page_params['hotel_city']=$hotel_city;
		}
		
		array_push($condition,"FIND_IN_SET(id,:trave_hotels)>0");
		$params[':trave_hotels']=$trave_hotels;
		$page_params['trave_id']=$trave_id;
		$criteria=new CDbCriteria;
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>implode(" AND ",$condition),
			    'params'=>$params,
			    'with'=>array(),
			    'order'=>'t.id ASC',
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params, 
      ),
		));
		if(!empty($hotel_city)){
			$hotel_city_name=$model->get_hotel_city($hotel_city);
		}
		$com_condition['酒店名称:w%']=$hotel_name;
		$com_condition['酒店所在城市:w%']=$hotel_city_name;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('trave_hotels',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'trave_name'=>$trave_name,'hotel_city_name'=>$hotel_city_name,'hotel_city_id'=>$hotel_city,'trave_name'=>$trave_name,'trave_id'=>$trave_id));
  }  
}
?>
