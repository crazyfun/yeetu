<?php
class WeeklyTop10 extends CWidget
{
	public function run()
	{
		$travel=new Trave();
		$trave_sregion=$this->controller->trave_sregion;
		$trave_datas=$travel->get_weekly_top10($trave_sregion);
		$this->render('weekly_top_10', array('trave_datas'=>$trave_datas));
	} 
}
