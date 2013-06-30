<?php

class Travebargain extends CWidget
{
	public $trave_category;
	public $trave_sregion;
	public function run(){
		$trave=new Trave();
		$trave_bargain=$trave->get_bargain_travel($this->trave_category,$this->trave_sregion);	 
		if(!empty($trave_bargain)){
			$this->render("trave_bargain",array('trave_bargain'=>$trave_bargain,'trave'=>$trave));
		}
		
	}							 												 					

}