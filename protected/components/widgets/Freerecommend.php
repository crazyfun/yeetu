<?php

class Freerecommend extends CWidget
{
	public $trave_sregion;
	public function run(){
		$trave=new Trave();
		$trave_free_datas=$trave->get_trave_free($this->trave_sregion);
		if(!empty($trave_free_datas)){
		    $this->render("free_recommend",array('trave_free_datas'=>$trave_free_datas,'trave'=>$trave));
		}

	}							 												 					
	
	

}