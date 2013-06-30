<?php
class LimitedSpecial extends CWidget
{
	public function run()
	{
		$trave=new Trave();
		$trave_sregion=Yii::app()->getController()->trave_sregion;
		$nation_trave_datas=$trave->get_limited_special('1',$trave_sregion);
		$domestic_trave_datas=$trave->get_limited_special('3',$trave_sregion);
		$peripheral_trave_datas=$trave->get_limited_special('2',$trave_sregion);
		$this->render('limited_special', array('trave'=>$trave,'nation_trave_datas'=>$nation_trave_datas,'domestic_trave_datas'=>$domestic_trave_datas,'peripheral_trave_datas'=>$peripheral_trave_datas));
	} 
}
