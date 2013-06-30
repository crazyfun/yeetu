<?php
class FlashAddAction extends BaseAction{
  protected function beforeAction(){
     $this->controller->init_page();
     return true;
  }
  protected function do_action(){	
  	$model=new FlashAd();
  	if(isset($_POST['FlashAd'])){
  		$this->controller->bc(array("首页flash广告管理"=>array("ad/flashindex"),'增加flash广告'));
  		if(!empty($_POST['FlashAd']['id'])){
  			$model=$model->get_table_datas($_POST['FlashAd']['id']);
  		}
  		  
			  $model->attributes=$_POST['FlashAd'];
			  $select_image=$_POST['select_image'];
			  if($select_image){
			  	 $flash_ad_datas=$model->get_table_datas($_POST['FlashAd']['id']);
			     $model->ad_src=$flash_ad_datas->ad_src;
			  	 if($model->validate()&&$model->insert_flash_ad()){
			  	 	   $model=$model->get_table_datas($_POST['FlashAd']['id']);
			  	 	   $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  	 }else{
			  	 	   $this->controller->f(CV::FAILED_ADMIN_OPERATE);
			  	}
			  }else{
			  	
			  	$upload_file=CUploadedFile::getInstance($model,'ad_src');
			    if(!empty($upload_file->name)){
			    	
			      $model->ad_src=$model->rename_file($upload_file->name);
			    }
			  
			  	if($model->validate()&&$upload_file!=null){
			  	 if($model->insert_flash_ad()){
			  		 $image_path=$model->get_image_path();
			  		//保存图片
			  		 $flash_ad_path=$image_path.$model->ad_src;
			  		 $upload_file->saveAs($flash_ad_path);			  		 
			  		 $this->controller->f(CV::SUCCESS_ADMIN_OPERATE);
			  	 }
		      }else{
			      $this->controller->f(CV::FAILED_ADMIN_OPERATE);
		      }	
			} 
		}else{
			$id=$_REQUEST['id'];
			if(!empty($id)){
				$this->controller->bc(array("首页flash广告管理"=>array("ad/flashindex"),'修改flash广告'));
			 	$model=$model->get_table_datas($id,array());
			}else{
			  	$this->controller->bc(array("首页flash广告管理"=>array("ad/flashindex"),'增加flash广告'));	
			}
		}
		$this->display('flash_add',array('model'=>$model)); 
  } 
}
?>
