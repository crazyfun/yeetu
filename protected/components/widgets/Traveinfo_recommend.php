<?php
class Traveinfo_recommend extends CWidget
{

	public function run(){
		$traveinfo=new TravelInfor();
		$traveinfo_recommend=$traveinfo->get_traveinfo_recommend();
		$this->render('traveinfo_recommend',array('traveinfo_recommend'=>$traveinfo_recommend));
	}

}