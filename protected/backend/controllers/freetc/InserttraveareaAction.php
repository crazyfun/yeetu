<?php
class InserttraveareaAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_travearea_page();
     $this->controller->bc(array("国内机+酒店"=>array('freetc/index'),"增加国内机+酒店景区"));
     return true;
  }
  protected function do_action(){	
		$model=new Travearea;
		if(isset($_POST['Travearea'])){
			if(!empty($_POST['Travearea']['id'])){
				$model=$model->get_table_datas($_POST['Travearea']['id']);
			}
			$model->id=$_POST['Travearea']['id'];
			$model->attributes=$_POST['Travearea'];
			$import_image=$_REQUEST['import_image'];
			if($model->validate()){
			  $model->insert_travearea();
			  if(!empty($import_image)){
			  	$image_category=ImageCategory::model();
			  	$image_category_datas=$image_category->find("category_title=:category_title",array(':category_title'=>$model->trave_area));
			  	$images=Images::model();
			  	$images_datas=$images->findAll("image_category=:image_category",array(":image_category"=>$image_category_datas->id));
			  	$trave_image=Traveimage::model();
			  	foreach($images_datas as $key => $value){
			  		$trave_image_data=$trave_image->find("trave_id=:trave_id AND trave_area_id=:trave_area_id AND image_id=:image_id",array(':trave_id'=>$model->trave_id,':trave_area_id'=>$model->id,':image_id'=>$value->id));
			  		if(empty($trave_image_data)){
			  		$trave_image->id=null;
			  		$trave_image->setIsNewRecord(true);
			  		$trave_image->trave_id=$model->trave_id;
			  		$trave_image->trave_area_id=$model->id;
			  		$trave_image->image_id=$value->id;
			  		$trave_image->insert_trave_area_image();
			  	}
			  	}
			  }
			  $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		  }else{
			  $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		  }
		}
		
		$this->display('add_trave_area',array('model' => $model));
  } 
}
?>
