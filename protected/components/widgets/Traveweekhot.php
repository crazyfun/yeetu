<?php

class Traveweekhot extends CWidget
{
	public $trave_category;
	public $trave_sregion;
	public function run(){
		$trave=new Trave();
		$trave_week_datas=$trave->get_trave_week_hot($this->trave_category,$this->trave_sregion);
		if(!empty($trave_week_datas)){
			if(($this->trave_category=='4')||($this->trave_category=='5')){
				$this->render("trave_week_hot_img",array('trave_week_datas'=>$trave_week_datas,'trave'=>$trave));
			}else{
		    $this->render("trave_week_hot",array('trave_week_datas'=>$trave_week_datas,'trave'=>$trave));
		  }
		}
	}							 												 					
	
	

}