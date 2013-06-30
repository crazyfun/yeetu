<?php
class SearchAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
        $this->controller->bc(array("酒店管理"));
      return true;
    }
  protected function do_action(){	
	  $model=new Hotels();
		//搜索
		$hotel_name=$_REQUEST['hotel_name'];
		$hotel_city=$_REQUEST['hotel_city_id'];
		$condition=array();
		$params=array();
		$page_params=array();
		if(!empty($hotel_name)){
			array_push($condition,"(t.hotel_name LIKE :hotel_name OR t.id=:hotel_id)");
			$params[':hotel_name']="%$hotel_name%";
			$params[':hotel_id']=$hotel_name;
			$page_params['hotel_name']=$hotel_name;
		}
		if(!empty($hotel_city)){
			array_push($condition,"t.hotel_city=:hotel_city");
			$params[':hotel_city']=$hotel_city;
			$page_params['hotel_city']=$hotel_city;
		}
		
		$criteria=new CDbCriteria;
		
		$sort=new CSort();
  	$sort->attributes=array();
  	$sort->defaultOrder="t.create_time DESC";
  	$sort->params=$page_params;
  	
		$active_data_provider=new CActiveDataProvider($model, array(
			'criteria'=>array(
			    'condition'=>implode(" AND ",$condition),
			    'params'=>$params,
			    'with'=>array(),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params, 
      ),
      'sort'=>$sort,
		));
		if(!empty($hotel_city)){
			$hotel_city_name=$model->get_hotel_city($hotel_city);
		}
		$com_condition['酒店名称:w%']=$hotel_name;
		$com_condition['酒店所在城市:w%']=$hotel_city_name;
		$com_condition_search=Util::com_search_condition($com_condition);
		$this->display('index',array('model'=>$model,'active_data_provider'=>$active_data_provider,'com_condition_search'=>$com_condition_search,'hotel_name'=>$hotel_name,'hotel_city_name'=>$hotel_city_name,'hotel_city_id'=>$hotel_city));
  }  
}
?>
