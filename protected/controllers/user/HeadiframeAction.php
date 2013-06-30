<?php
class HeadiframeAction extends  BaseAction{
  
    protected function beforeAction(){
    	return true;
    }
    protected function afterAction(){
    	$user_id=$_GET['user_id'];
		  $user_id=empty($user_id)?(Yii::app()->user->id):$user_id;
    	$user=new User();
			$this->controller->head_img=$user->get_user_head(70,70,$user_id);
			$this->controller->user_id=$user_id;
    	return true;
    }
    
   
  protected function do_action(){
		$user_id=$_GET['user_id'];
		$user_id=empty($user_id)?(Yii::app()->user->id):($user_id);
		$user=new User();
		$file_error="";
		if(isset($_POST['User'])){
	 		$upload_file=CUploadedFile::getInstance($user, 'head_img');
			if(!empty($upload_file->name)){
			  $head_img=$user->rename_file($upload_file->name,$user_id);
			}
			$file_size=$upload_file->getSize();
			if(($file_size/1024)<=1024){
				$file_type=$upload_file->getType();
		 if(!$upload_file->getHasError()&&(($file_type=='image/jpeg')||($file_type=='image/gif')||($file_type=='image/png'))){	
		 	
	 		if($user->validate()&&$upload_file!=null){
	 		 $user_datas=$user->get_table_datas($user_id); 
	 		 $update_datas['head_img']=$head_img;
	 		 $result=$user->updateByPk($user_id,$update_datas,"",array());
			 if($result){
			 	$image_path=$user->get_image_path($user_id);
			  //保存图片
			  $trave_image_path=$image_path.$head_img;
			  $upload_file->saveAs($trave_image_path);
			  $this->cut_trave_image($image_path,$head_img);
			  $head_img=Util::rename_thumb_file(70,70,$image_path,$head_img);
			  $this->delete_trave_image($image_path,$user_datas->head_img);
			}	
     } 
    }else{  	 
			 $file_error="文件类型只支持jpg,gif,png图片";
	  }	
   }else{
			 $file_error="请勿上传超过1M的文件";
	 }
  } 
  if(!empty($head_img))
    $head_img="/".$head_img;
		$this->display_partial("user_headiframe",array('image_src'=>$head_img,'file_error'=>$file_error));
  }
  function cut_trave_image($image_path,$head_img){
  	    Util::cut_trave_image(70,70,$image_path,$head_img);
			  Util::cut_trave_image(60,60,$image_path,$head_img);
			  Util::cut_trave_image(50,50,$image_path,$head_img);
  }
  
   function delete_trave_image($image_path,$head_img){
  	    Util::delete_file($head_img,$image_path);
			  $delete_thumb_file=Util::rename_thumb_file(70,70,$image_path,$head_img);
			  Util::delete_file($delete_thumb_file);
			  $delete_thumb_file=Util::rename_thumb_file(60,60,$image_path,$head_img);
			  Util::delete_file($delete_thumb_file);
			  $delete_thumb_file=Util::rename_thumb_file(50,50,$image_path,$head_img);
			  Util::delete_file($delete_thumb_file);
  }
 
 
    
}
?>
