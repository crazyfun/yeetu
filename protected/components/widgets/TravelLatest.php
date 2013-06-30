<?php
class TravelLatest extends CWidget
{
   public $show_type;
	public function run()
	{
		$trave=new Trave();
		$trave_sregion=Yii::app()->getController()->trave_sregion;
		$trave_datas=$trave->get_trave_latest($this->show_type,$trave_sregion);
		$this->render('travel_latest', array('trave_datas'=>$trave_datas,'trave'=>$trave));
	} 
}
