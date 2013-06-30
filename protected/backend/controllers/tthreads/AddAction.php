<?php
class AddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new TraveThreads();
  	if(isset($_POST['TraveThreads'])){
  		$this->controller->bc(array("线路游记/攻略管理"=>array("tthreads/index"),'增加线路游记/攻略'));
  		if(!empty($_POST['TraveThreads']['id'])){
  			$model=$model->get_table_datas($_POST['TraveThreads']['id']);
  		}
  		  
			  $model->attributes=$_POST['TraveThreads'];
			  $select_image=$_POST['select_image'];
			  if($select_image){
			  	 $threads_datas=$model->get_table_datas($_POST['TraveThreads']['id']);
			     $model->image_src=$threads_datas->image_src;
			  	 if($model->validate()&&$model->insert_tthreads()){
			  	 	   $model=$model->get_table_datas($_POST['TraveThreads']['id']);
			  	 	   $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  	 }else{
			  	 	   $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  	}
			  }else{
			  	
			  	$upload_file=CUploadedFile::getInstance($model,'image_src');
			    if(!empty($upload_file->name)){
			    	
			      $model->image_src=$model->rename_file($upload_file->name);
			    }
			  
			  	if($model->validate()&&$upload_file!=null){
			  	 if($model->insert_tthreads()){
			  		 $image_path=$model->get_image_path();
			  		//保存图片
			  		 $threads_path=$image_path.$model->image_src;
			  		 $upload_file->saveAs($threads_path);	
			  		 Util::cut_trave_image(75,75,$image_path,$model->image_src);		  		 
			  		 $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  	 }
		      }else{
			      $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		      }	
			} 
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("线路游记/攻略管理"=>array("tthreads/index"),'修改线路游记/攻略'));
			 	$model=$model->get_table_datas($id,array());
			}else{
			  	$this->controller->bc(array("论线路游记/攻略管理"=>array("tthreads/index"),'增加线路游记/攻略'));	
			}
		}
		$this->display('add',array('model'=>$model)); 
  } 
}
?>
