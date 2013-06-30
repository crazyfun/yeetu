<?php
class MonthTop10 extends CWidget
{
	public function run()
	{
	
		$travel=new Trave();
		$trave_sregion=$this->controller->trave_sregion;
		$trave_datas=$travel->get_month_top10($trave_sregion);

		$this->render('month_top_10', array('trave_datas'=>$trave_datas));
	} 
}
