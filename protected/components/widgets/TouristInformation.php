<?php
class TouristInformation extends CWidget
{
	public function run()
	{
		$travel_infor=new TravelInfor();
		$trave_info_datas=$travel_infor->get_index_trave_infor();
		$this->render('tourist_information', array('trave_info_datas'=>$trave_info_datas));
	} 
}
