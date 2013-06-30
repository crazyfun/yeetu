<?php
class FlashAdW extends CWidget
{
	public function run()
	{
		$flash_ad=new FlashAd();
		
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$sregion_id=$sregion_session['id'];
		$flash_ad_datas=$flash_ad->get_flash_ad_datas($sregion_id);
	  $flash_ad_length=count($flash_ad_datas);
		$this->render('flash_ad',array('flash_ad_datas'=>$flash_ad_datas,'flash_ad_length'=>$flash_ad_length));
	} 
}
