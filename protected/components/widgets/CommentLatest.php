<?php
class CommentLatest extends CWidget
{
	public function run()
	{
		$trave=new Trave();
		$trave_sregion=Yii::app()->getController()->trave_sregion;
		$trave_datas=$trave->get_comment_latest($trave_sregion);
		$trave_comment=new TraveComment();
		$this->render('comment_latest', array('trave_datas'=>$trave_datas,'trave'=>$trave,'trave_comment'=>$trave_comment));
	} 
}
