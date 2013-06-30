<?php
class AddhotelAction extends BaseAction{
  
  protected function beforeAction(){
    	$this->controller->check_login("",CV::RETURN_ADMIN_INDEX,array());
    	$this->controller->init_page();
    	$this->controller->bc(array("酒店管理"=>array('hotels/index'),'增加酒店'));
      return true;
    }
    
  protected function do_action(){	
  	$model=new Hotels();
		if(isset($_POST['Hotels'])){
			 if(!empty($_POST['Hotels']['id'])){
			   $model=$model->get_table_datas($_POST['Hotels']['id']);	
			}
			 $model->attributes=$_POST['Hotels'];
			 //$model->id=$_POST['Hotels']['id'];
			 $model->hotel_city=$_POST['hotel_city_id'];
			 $model->hotel_type=$_POST['hotel_type'];
			 $select_image=$_POST['select_image'];
			 if($select_image){
			 	
			 	   $hotels_image_datas=$model->get_table_datas($_POST['Hotels']['id']);
			     $model->hotel_img=$hotels_image_datas->hotel_img;
			     
			  	 if($model->validate()&&$model->insert_hotel()){
			  	 	   $model=$model->get_table_datas($_POST['Hotels']['id']);
			  	 	   $this->controller->f(CV::SUCCESS_ADMIN_OPERATE); 
			  	 }else{
			  	 	   $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  	}
			 }else{
			   $upload_file=CUploadedFile::getInstance($model, 'hotel_img');
			   if(!empty($upload_file->name)){
			   	  
			      $model->hotel_img=$model->rename_file($upload_file->name);
			   } 
      if($model->validate()&&$upload_file!=null){
			  if($model->insert_hotel()){
			  	   $image_path=$model->get_image_path();
			  		//保存图片
			  		 $trave_image_path=$image_path.$model->hotel_img;
			  		 $upload_file->saveAs($trave_image_path);
			  		 Util::cut_trave_image(120,90,$image_path,$model->hotel_img); 
			  		 Util::cut_trave_image(39,49,$image_path,$model->hotel_img);
			       $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  }else{
			  	$this->controller->f(CV::ERROR_ADMIN_DATABASE);
			  }
			}else{
				$this->controller->f(CV::FAILED_ADMIN_OPERATE);
			}
		 }
		}
       $hotel_city_name=$model->get_hotel_city($_POST['hotel_city_id']);
	  $this->display('add_hotel',array('model' => $model,'hotel_city_name'=>$hotel_city_name));
  }  
}
?>
