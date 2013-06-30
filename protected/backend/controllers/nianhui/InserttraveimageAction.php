<?php
class InserttraveimageAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		$this->controller->bc(array("国内机+酒店"=>array('freetc/index'),"增加国内机+酒店图片"));
		return true;

	}
	protected function do_action(){	
		$model=new Traveimage();
		$image_ids=array();
		if(isset($_POST['Traveimage'])){
			$model->attributes=$_POST['Traveimage'];
			$str_image_id=$_REQUEST['image_ids'];
		  $trave_area_images=$model->get_trave_area_images($_POST['Traveimage']['trave_id'],$_POST['Traveimage']['trave_area_id']);
			$image_ids=explode(",",$str_image_id);
			foreach($image_ids as $key => $value){
				$new_model=new Traveimage();
				$new_model->attributes=$_POST['Traveimage'];
				$new_model->image_id=$value;
				if($new_model->validate()){
					$new_model->insert_trave_area_image();
				}else{
					$this->controller->f(CV::FAILED_ADMIN_OPERATE);
					$this->display('add_trave_image',array('model' => $model,'str_image_id'=>$str_image_id));
					exit();
				}
			}
			$diff_array=array_diff($trave_area_images,$image_ids);
			foreach($diff_array as $key => $value){
				$delete_array['trave_id']=$_POST['Traveimage']['trave_id'];
				$delete_array['trave_area_id']=$_POST['Traveimage']['trave_area_id'];
				$delete_array['image_id']=$value;
				$model->delete_table_datas("",$delete_array);
			}
			 $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
		}
		$this->display('add_trave_image',array('model' => $model,'str_image_id'=>$str_image_id));
	}
}
?>
