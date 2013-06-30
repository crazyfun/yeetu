<?php
class AddfreetnAction extends BaseAction{
  
    protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	 $this->controller->layout="none";
      return true;
    }

  protected function do_action(){	
	  $model=new Trave;
		if(isset($_POST['Trave'])){
			if(!empty($_POST['Trave']['id'])){
				$model=$model->get_table_datas($_POST['Trave']['id']);
			}
			 $model->attributes=$_POST['Trave'];
			 $model->id=$_POST['Trave']['id'];
			 $model->trave_region=$_POST['trave_region_id'];
			 $model->trave_linetype=$_POST['trave_linetype_id'];
			 $model->trave_hotels=$_POST['trave_hotels_id'];
			 $model->trave_category=$this->controller->trave_category;
			 $model->free_category='2';
			 $model->is_empty_trave_hotels();
			 
		$trave_suppliers_id=$this->check_trave_suppliers($_POST['trave_suppliers_name']);
			 if($trave_suppliers_id){
			 	  $model->trave_suppliers=$trave_suppliers_id;
			}
			
      if($model->validate()){
			  $model->insert_trave();
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		}
   		//显示线路区域分类和线路类别选择



	     $hotels_model=new Hotels();
			 $hotels_datas=$hotels_model->findAll("FIND_IN_SET(id,'$_POST[trave_hotels_id]')>0",array());
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
			 $category_datas=$category_model->findAll("FIND_IN_SET(id,'$_POST[trave_linetype_id]')>0",array());
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
			 $district_datas= $district_model->findAll("id='$_POST[trave_region_id]'",array());
			 foreach((array)$district_datas as $key => $value){
			 	if(empty($trave_region_name)){
			 		$trave_region_name=$value['district_name'];
			 	}
      }
       
	    $this->display('add_freetn',array('model' => $model,'category_region_name'=>$category_region_name,'trave_region_name'=>$trave_region_name,'trave_hotels_name'=>$trave_hotels_name,'category_datas_json'=>json_encode($category_datas_json),'hotels_datas_json'=>json_encode($hotels_datas_json)));
  }
 
 function check_trave_suppliers($trave_suppliers_name){
  	 $agency=new Agency();
  	 $agency_datas=$agency->get_table_datas("",array('agency_name'=>$trave_suppliers_name));
  	 if(!empty($agency_datas)){
  	 	  return false;
  	 }else{
  	 	  $agency->agency_name=$trave_suppliers_name;
  	 	  if($agency->validate()){
  	 	  	 $agency->insert_agency();
  	 	  	 return $agency->id;
  	 	  }
  	 }
  }
    
}
?>
