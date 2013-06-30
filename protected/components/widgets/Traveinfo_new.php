<?php
class Traveinfo_new extends CWidget
{

	public function run(){
		$traveinfo=new TravelInfor();
		$traveinfo_new=$traveinfo->get_traveinfo_new();
		$this->render('traveinfo_new',array('traveinfo_new'=>$traveinfo_new));
	}

}