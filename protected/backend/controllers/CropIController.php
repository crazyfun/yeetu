<?php
class CropIController extends AController
{
	public function actions()
	{
		return array(
			

		);
	}
	

	
	public function actionIndex(){
		
		 $crop_dir="upload";
		 $move_dir="upload/images/1";
		 Util::makeDirectory($move_dir);
		 $this->crop_dir($crop_dir,$move_dir);
		 echo "操作成功";
		 
    
	}
	
	public function actionImages(){
		 $sql="DROP TABLE IF EXISTS `yt_traveimage1`";
		 $command = Yii::app()->db->createCommand($sql);
     $command->execute();
		 $sql="CREATE TABLE `yt_traveimage1` (
         `id` int(11) unsigned NOT NULL auto_increment,
         `trave_id` int(11) unsigned NOT NULL default '0' COMMENT '线路ID',
         `trave_area_id` int(11) unsigned NOT NULL default '0' COMMENT '线路景区ID',
         `image_id` int(11) unsigned NOT NULL default '0' COMMENT '图片ID',
         `create_id` int(11) unsigned NOT NULL default '0' COMMENT '创建者ID',
         `create_time` int(10) unsigned NOT NULL default '0' COMMENT '创建时间',
         PRIMARY KEY  (`id`),
         KEY `trave_traveimage` (`trave_id`,`trave_area_id`)) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8";
     $command = Yii::app()->db->createCommand($sql);
     $command->execute();
     
     $sql="DROP TABLE IF EXISTS `yt_images`";
     $command = Yii::app()->db->createCommand($sql);
     $command->execute();
     $sql="CREATE TABLE `yt_images` (
       `id` int(11) unsigned NOT NULL auto_increment,
       `image_category` tinyint(2) unsigned NOT NULL default '0' COMMENT '图片分类',
       `image_title` varchar(30) NOT NULL default '' COMMENT '图片名字',
       `image_src` varchar(100) NOT NULL default '' COMMENT '图片连接',
       `image_desc` text NOT NULL COMMENT '图片描述',
       `create_id` int(11) unsigned NOT NULL default '0' COMMENT '创建人ID',
       `create_time` int(11) unsigned NOT NULL default '0' COMMENT '创建时间',
        PRIMARY KEY  (`id`)) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        
       $trave_image=new Traveimage();
       $trave_image_datas=$trave_image->findAll(array('select'=>'*','condition'=>'','params'=>array()));
       foreach($trave_image_datas as $key => $value){
       	 $images=new Images();
       	 $images->id=null;
       	 $images->image_category='1';
       	 $images->image_title=$value->image_name;
       	 $images->image_src=$value->image_src;
       	 $images->image_desc=$value->image_desc;
       	 $images->create_id=$value->create_id;
       	 $images->create_time=$value->create_time;
       	 $images->setIsNewRecord(true);
         $result=$images->insert();
       	 if($result){
       	 	$image_id=$images->id;
       	 	$trave_images1=new Traveimage1();
       	 	$trave_images1->id=null
       	 	$trave_images1->trave_id=$value->trave_id;
       	 	$trave_images1->trave_area_id=$value->trave_area_id;
       	 	$trave_images1->image_id=$image_id;
       	 	$trave_images1->create_id=$value->create_id;
       	 	$trave_images1->create_time=$value->create_time;
       	 	$trave_images1->setIsNewRecord(true);
          $trave_images1->insert();
       	 }
      }
      echo "操作成功";
	}
	
	public function crop_dir($crop_dir,$move_dir){
		$uncrop_dir=array("upload/flashad",'upload/head','upload/hotels','upload/threads','upload/images');
		$handle=opendir($crop_dir);
		while(false !== ($file = readdir($handle))){
			if($file == '.' || $file==".."){
				continue;
			}
			$temp_dir=$crop_dir."/".$file;
			if(in_array($temp_dir,$uncrop_dir)){
				continue;
			}else{
			 if(is_dir($temp_dir)){
				 $this->crop_dir($temp_dir,$move_dir);
			 }else{
			   $image_info = getimagesize($crop_dir."/".$file);
			  $allowed_types=Array (1=>'gif',2 => 'jpg',3 => 'png',7 => 'tiff',8 => 'tiff' ); 
			  if(!isset($allowed_types[$image_info[2]])){
			   	 
			  }else{
				  if(false===stripos(strtolower($file),"thumb")){
				  	 
				  	 if(!file_exists($move_dir."/".$file)){
              $this->cut_trave_image(310,285,$crop_dir."/",$move_dir."/",$file);
              $this->cut_trave_image(160,120,$crop_dir."/",$move_dir."/",$file);
              $this->cut_trave_image(75,75,$crop_dir."/",$move_dir."/",$file);
              $this->cut_trave_image(60,30,$crop_dir."/",$move_dir."/",$file);
			  		  $this->cut_trave_image(145,80,$crop_dir."/",$move_dir."/",$file);
			  		  $image = Yii::app()->image->load($crop_dir."/".$file);
		          $image->save($move_dir."/".$file); 
		        }
				  }
		    }
			 }
		 }
		}
	}
	 	//等比例剪切图片
	public function cut_trave_image($width,$height,$image_path,$move_path,$image_name){
		$image = Yii::app()->image->load($image_path.$image_name);
		$image->resize($width, $height);
		$image->save(Util::rename_thumb_file($width,$height,$move_path,$image_name)); 
	}
	
	
	public function f($msg_code){ 
		if($msg_code == CV::SUCCESS_ADMIN_OPERATE){
			$this->sf("操作成功");
		}
		if($msg_code == CV::FAILED_ADMIN_OPERATE){
			$this->ff("操作失败");
		}
		if($msg_code == CV::ERROR_ADMIN_DATABASE){
			$this->ff("操作数据库错误");
		}
	}
}

?>
