<?php
class AddAction extends BaseAction{
	protected function beforeAction(){
		$this->controller->init_page();
		$this->controller->bc(array("图片管理"=>array('images/index'),"增加图片/修改图片"));
		return true;
	}
	protected function do_action(){	
		$model=new Images();
		if(isset($_POST['Images'])){
			if(!empty($_POST['Images']['id'])){
				$model=$model->get_table_datas($_POST['Images']['id']);
			}
			//$model->id=$_POST['Traveimage']['id'];
			$model->attributes=$_POST['Images'];
			$select_image=$_POST['select_image'];
			if($select_image){
				$trave_image_datas=$model->get_table_datas($_POST['Images']['id']);
				$model->image_src=$trave_image_datas->image_src;
				if($model->validate()&&$model->insert_images()){
					$model=$model->get_table_datas($_POST['Images']['id']);
					$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
				}else{
					$this->controller->f(CV::FAILED_ADMIN_OPERATE);
				}
			}else{
				$upload_file=CUploadedFile::getInstance($model, 'image_src');
				if(!empty($upload_file->name)){
					$model->image_src=$model->rename_file($upload_file->name);
				}
				
				if($model->validate()&&$upload_file!=null){
					if($model->insert_images()){
						$image_path=$model->get_image_path();
						//保存图片
						$trave_image_path=$image_path.$model->image_src;
						$upload_file->saveAs($trave_image_path);
						 Util::cut_trave_image(310,285,$image_path,$model->image_src);
			  		 Util::cut_trave_image(75,75,$image_path,$model->image_src);
			  		 Util::cut_trave_image(160,120,$image_path,$model->image_src);
			  		 Util::cut_trave_image(60,30,$image_path,$model->image_src);
			  		 Util::cut_trave_image(145,80,$image_path,$model->image_src);
						$this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
					}
				}else{
					$this->controller->f(CV::FAILED_ADMIN_OPERATE);
				}
			}
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("图片管理"=>array('images/index'),"修改图片"));
			 	$model=$model->get_table_datas($id,array());
			}else{
				$this->controller->bc(array("图片管理"=>array('images/index'),"增加图片"));	
			}
			
		}
		$this->display('add',array('model' => $model));
	}
}
?>
