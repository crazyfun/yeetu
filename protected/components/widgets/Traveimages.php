<?php

class Traveimages extends CWidget
{
	public $trave_id;
	public function run(){
		$this->renderTraveimages();
	}							 												 					
	function renderTraveimages(){
		$trave_images_datas=$this->get_trave_images();
		$this->render("trave_images",array("trave_images_datas"=>$trave_images_datas));
		
		
	}
	function get_trave_images(){
		  $trave_image=new Traveimage();
  	  $condition="t.trave_id=:trave_id AND Trave_area.trave_status=:trave_status";
  	  $params=array("trave_id"=>$this->trave_id,':trave_status'=>'1');
  	  $trave_images_datas=$trave_image->with(array("Images",'Trave_area'=>array('together'=>true)))->findAll(array('select'=>'t.*','condition'=>$condition,'params'=>$params,'order'=>'t.id ASC'));
  	  return $trave_images_datas;
	}
	

}