<?php
class OnlineConsulting extends CWidget
{
	public function run()
	{
		$consulting=new Consulting();
		$sregion_session=Yii::app()->session->get('sregion_datas');
		$sregion_id=$sregion_session['id'];
		$conditions="reply_content <> ''";
		$consulting_datas=$consulting->findAll(array('select'=>'trave_id,consulting_content,reply_content,reply_time','condition'=>$conditions,'params'=>array(),'with'=>array('Trave'=>array('condition'=>'trave_sregion=:trave_sregion','params'=>array(':trave_sregion'=>$sregion_id))),'together'=>true,'order'=>'reply_time DESC','limit'=>'10'));
		$this->render('online_consulting', array('consulting_datas'=>$consulting_datas));
	} 
}
