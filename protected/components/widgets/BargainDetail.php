<?php

class BargainDetail extends CWidget
{
	public $trave_category;
	public $trave_sregion;
	public function run(){
		$trave=new Trave();
		$trave_bargin_detail=$trave->get_trave_bargin_detail($this->trave_category,$this->trave_sregion); 
    $this->render("bargain_detail",array('trave_bargin_detail'=>$trave_bargin_detail,'trave'=>$trave,'trave_category'=>$this->trave_category));
	}							 												 					
	
	

}