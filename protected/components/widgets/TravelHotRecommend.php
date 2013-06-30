<?php
class TravelHotRecommend extends CWidget
{
  public $trave_category;
	public function run()
	{
		$trave=new Trave();
		$trave_sregion=Yii::app()->getController()->trave_sregion;
		$trave_hot_recommend=$trave->get_trave_hot_recommend($this->trave_category,$trave_sregion);
		$trave_category_id=$this->trave_category;
		$this->render('travel_hot_recommend', array('trave_hot_recommend'=>$trave_hot_recommend,'trave'=>$trave));
	} 
}
