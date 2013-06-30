<?php
class AddAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
      return true;
    }

  protected function do_action(){	
		$id=$_REQUEST['id'];
		$model=new Trave;
		$category_region_name="";
		$trave_region_name="";
		$trave_sregion_name="";
		if(!empty($id)){
			 $this->controller->bc(array("国内机+酒店"=>array('freetc/index'),"修改国内机+酒店线路"));
			 $model=$model->get_table_datas($id,array());
			  //显示线路区域分类和线路类别选择
			 $trave_region=$model->trave_region;
			 $trave_linetype=$model->trave_linetype;
			 $trave_sregion=$model->trave_sregion;
			 $trave_hotels=$model->trave_hotels;
			 
			 $hotels_model=new Hotels();
			 $hotels_datas=$hotels_model->findAll("FIND_IN_SET(id,'$trave_hotels')>0",array());
			 $hotels_datas_json=array();
			 foreach((array)$hotels_datas as $key => $value){
			 	if(empty($trave_hotels_name)){
			 		$trave_hotels_name=$value['hotel_name'];
			 	}else{
			 		$trave_hotels_name.=",".$value['hotel_name'];
			 	}
			 	$tem_json=array('id'=>$value['id'],'name'=>$value['hotel_name']);
			 	array_push($hotels_datas_json,$tem_json);
			 }
			 $category_model=new Category();
			 $category_datas=$category_model->findAll("FIND_IN_SET(id,'$trave_linetype')>0",array());
			 $category_datas_json=array();
			 foreach((array)$category_datas as $key => $value){
			 	if(empty($category_region_name)){
			 		$category_region_name=$value['category_name'];
			 	}else{
			 		$category_region_name.=",".$value['category_name'];
			 	}
			 	$tem_json=array('id'=>$value['id'],'name'=>$value['category_name']);
			 	array_push($category_datas_json,$tem_json);
			 }
			 $district_model=new District();
			 $district_datas= $district_model->findAll("id='$trave_region'",array());
			 foreach((array)$district_datas as $key => $value){
			 	if(empty($trave_region_name)){
			 		$trave_region_name=$value['district_name'];
			 	}
      }
      $district_sdatas= $district_model->findAll("id='$trave_sregion'",array());
			 foreach((array)$district_sdatas as $key => $value){
			 	if(empty($trave_sregion_name)){
			 		$trave_sregion_name=$value['district_name'];
			 	}
      }
		}else{
			$this->controller->bc(array("年会酒店"=>array('nianhui/index'),"修改年会酒店线路"));
		}
		$this->display('add_freetc',array('model'=>$model,'category_region_name'=>$category_region_name,'trave_region_name'=>$trave_region_name,'trave_sregion_name'=>$trave_sregion_name,'trave_hotels_name'=>$trave_hotels_name,'category_datas_json'=>json_encode($category_datas_json),'hotels_datas_json'=>json_encode($hotels_datas_json)));
  }
 
 
    
}
?>
