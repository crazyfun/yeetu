<?php

class HTraveRegion extends CWidget
{
	public $trave_category;
	public function run(){
		if($this->trave_category=='5'){
			$this->render("trave_free_region",array('trave_category'=>$this->trave_category));
		}else{
      $this->render("htrave_region",array('trave_category'=>$this->trave_category));
     }
	}							 												
}