<?php
class Travemore extends CWidget
{
	public $trave_category;
	public $trave_sregion;
	public $province_id;
	public function run(){
		$trave=new Trave();
		$trave_more=$trave->get_trave_more($this->trave_category,$this->trave_sregion,$this->province_id);	 
    $this->render("trave_more",array('trave_more'=>$trave_more,'trave'=>$trave,'province_id'=>$this->province_id));
	}							 												 					

}